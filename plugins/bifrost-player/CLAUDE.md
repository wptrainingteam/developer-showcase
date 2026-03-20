# Bifrost Player — Development Notes

Production site: https://developershowcase3.wpcomstaging.com/

Resources to take into account:
- https://developer.wordpress.org/block-editor/reference-guides/interactivity-api/core-concepts/client-side-navigation/
- https://make.wordpress.org/core/2026/02/23/changes-to-the-interactivity-api-in-wordpress-7-0/
- https://make.wordpress.org/core/2025/11/12/changes-to-the-interactivity-api-in-wordpress-6-9/
- https://make.wordpress.org/core/2025/11/12/interactivity-apis-client-navigation-improvements-in-wordpress-6-9/
- https://make.wordpress.org/core/2025/03/24/interactivity-api-best-practices-in-6-8/


## Build toolchain

- **`--experimental-modules`** is required in `wp-scripts build` and `wp-scripts start` for `viewScriptModule` support (script modules / iAPI).
- When `--experimental-modules` is active, `@wordpress/scripts/config/webpack.config` returns an **array** of configs (scripts + modules). Do NOT spread it into a single object (`{ ...defaultConfig }`) — export the array directly: `module.exports = defaultConfig`.
- To get `style-index.css` output for a block, the block **must** have an `editorScript` entry in `block.json` (even if minimal). Without it, wp-scripts' scripts webpack doesn't create an entry and CSS imported in `index.js` is never extracted. A minimal `index.js` that just does `import './style.css'` is enough.

## Interactivity API

- **Generator actions that call `e.preventDefault()`** must be wrapped with `withSyncEvent()`. Without it, the browser processes the default action before the generator resumes from its first `yield`. Example:
  ```js
  navigate: withSyncEvent( function* ( e ) {
      e.preventDefault(); // runs synchronously
      const { actions } = yield import( '@wordpress/interactivity-router' );
      yield actions.navigate( url );
  } ),
  ```
- **`getContext()`** returns the context of the element where the directive fires, not the element where the store is defined. This is what makes cross-block communication work (e.g., play-button sets context, audio-player reads it via `getContext()` in `playTrack`).
- **`data-wp-interactive` namespace conflicts**: Setting `data-wp-interactive="bifrost-player"` on an element inside a `data-wp-interactive="core/playlist"` region overrides the namespace for that subtree. This breaks core directives. Use `namespace::` prefixes instead (e.g., `data-wp-on--click="bifrost-player::actions.foo"`).
- **Cross-namespace directives**: Use the `namespace::` prefix to call actions from a different store without changing the element's namespace (e.g., `data-wp-init="bifrost-player::callbacks.initPlaylistBridge"` on a `core/playlist` element).

## Interactivity Router (client-side navigation)

- **Import map timing**: Blocks rendered during `wp_footer` (like our audio-player) have their `viewScriptModule` processed AFTER the import map is printed. This means `yield import('@wordpress/interactivity-router')` fails with `Failed to resolve module specifier`. Fix: enqueue the block's view script module early via `wp_enqueue_script_module('bifrost-player-audio-player-view-script-module')` in `wp_enqueue_scripts`. This forces WordPress to process the asset file (including dynamic dependencies) before the import map is printed.
- **Script module handle naming**: WordPress auto-generates handles from `block.json`. For non-core blocks: `str_replace('/', '-', blockName) . '-view-script-module'`. Example: `bifrost-player/audio-player` → `bifrost-player-audio-player-view-script-module`.
- **Do NOT use `wp_enqueue_script_module('@wordpress/interactivity-router')` directly** — enqueue the block's own view module instead, which declares the router as a dynamic dependency in its asset file. This matches how blocks normally work (the reference example at `block-development-examples/interactivity-router-2f43f8` doesn't enqueue the router directly either — it works because the block renders in page content, before the import map).
- **Navigation directives go on each `<a>` tag, NOT on a parent container**. The documented example uses `e.target.href`, but this breaks when `<a>` tags contain child elements (images, spans) — `e.target` is the clicked child, not the link. Use `getElement().ref.href` instead, which always returns the element the directive is on. Event delegation from a parent (e.g., `<main>`) breaks because `e.target` is whatever nested element was clicked (image, span), not the link. Use a `render_block` filter with `WP_HTML_Tag_Processor` to add `data-wp-on--click="actions.navigate"` and `data-wp-on--mouseenter="actions.prefetch"` to each `<a>` tag individually. Reference: `block-development-examples/interactivity-router-2f43f8/plugin.php`.
- `data-wp-router-region` marks which sections are replaced during navigation.
- **Block style variation suffix mismatch**: WordPress generates unique numbered class suffixes per page render (e.g., `is-style-site-footer--50` on page A, `--8` on page B). During client-side navigation, the router swaps stylesheets (new CSS targets `--8`) but elements outside router regions keep their old HTML (`--50`). Fix: add router regions to `core/template-part` blocks (header/footer) so their HTML is also updated, keeping suffixes in sync with the new CSS. The persistent audio player (injected via `wp_footer`, outside all regions) is unaffected because it uses custom classes, not block style variations.

## Plugin architecture

- Uses **bifrost-framework** for DI container and service provider lifecycle (same as bifrost-music). No local Container/Application/ServiceProvider copies.
- Registers providers via `add_action('bifrost/framework/register/plugin', [Plugin::class, 'register'])`. Requires bifrost-framework to be active.
- Namespace: `Bifrost\Player` (service providers and bootable classes import from `Bifrost\Framework`).
- The audio player block is injected via `wp_footer` action in `BlockServiceProvider` — no theme template modification needed.
- Router regions are injected via `render_block` filter on `core/group` (tagName "main") and `core/template-part` (header/footer). Navigation directives are added to every `<a>` tag inside these regions.

## Core/playlist integration

- `core/playlist` uses a **locked** store (`{ lock: true }`). External stores cannot call its actions directly.
- The core/playlist waveform is hidden via `RenderPlaylist` (`render_block` filter on `core/playlist`). It finds `.wp-block-playlist__waveform-player` and sets `hidden` + `display:none`.
- Track clicks are intercepted by `RenderPlaylistTrack` (`render_block` filter on `core/playlist-track`). It sets `data-wp-interactive="bifrost-player"` and `data-wp-on--click="actions.playTrack"` on each track `<li>`, with track data in `data-wp-context`. This overrides the `core/playlist` namespace for that subtree, so core's `actions.changeTrack` silently no-ops (which is what we want since the in-page waveform is hidden).

## Persistent WaveformPlayer (`@arraypress/waveform-player`)

The persistent audio player embeds its own `WaveformPlayer` instance for seekable playback with waveform visualization. The `<audio>` element in `render.php` is kept as a fallback — `syncPlayback` skips when the waveform is active.

### Initialization

- **Initialize via JS constructor** (`new WaveformPlayer(div, options)`), NOT via `data-waveform-player` attribute. The library's auto-init scans the DOM for `[data-waveform-player]` elements — after CSR navigation, this can re-initialize and corrupt an existing instance.
- **First-time init must be deferred** via `requestAnimationFrame`. The persistent player starts with `hidden` attribute (`display: none`). The Interactivity API removes `hidden` and fires `data-wp-watch` in the same reactive cycle, but the browser hasn't painted yet — the canvas would get 0 dimensions.
- **`syncPlayback` must also check `initPending`**. During the `requestAnimationFrame` delay, the fallback `<audio>` would otherwise start playing, causing dual audio.

### Colors and styling

- **Pass all colors explicitly** in the options object (`waveformColor`, `progressColor`, `buttonColor`, `textColor`, `backgroundColor`). Do NOT use `colorPreset: "dark"` — it reads computed styles which change when the router swaps stylesheets during navigation.
- **Set `singlePlay: false`** to prevent the library from pausing our instance when other WaveformPlayer instances (e.g., core/playlist) exist on the page.

### Surviving client-side navigation

The persistent player lives outside router regions (injected via `wp_footer`), so its DOM is preserved during CSR navigation. However, the router swaps stylesheets — the core/playlist stylesheet (which provides ALL `.waveform-*` layout styles: `.waveform-player`, `.waveform-body`, `.waveform-track`, `.waveform-btn`, `.waveform-container`, `.waveform-container canvas`) is removed when navigating away from album pages. Without those styles, the waveform canvas collapses and the layout breaks.

- **All `.waveform-*` layout styles must be duplicated** in our own `style.css`, scoped under `.bifrost-audio-player__waveform`. This includes `box-sizing`, flex layout on `.waveform-track`, button sizing on `.waveform-btn`, canvas sizing on `.waveform-container canvas`, etc. Copy them from `plugins/gutenberg/build/styles/block-library/playlist/style.css`.
- **Track the loaded URL** (`currentLoadedUrl`) and skip `loadTrack()` when the URL hasn't changed. Without this, `syncWaveform` re-fires after CSR navigation and re-loads the same track, destroying the canvas.
- **The `navigate` action must NOT touch the waveform** — don't destroy, recreate, or pause it. Just let it keep playing.
- **Interactivity state is NOT reset during navigation.** The router calls `populateServerData` with the new page's `wp_interactivity_state` values, but uses `deepMerge(state, newState, false)` — the third arg `false` means it only sets NEW keys, never overwrites existing ones.

### Code style

- **Do NOT remove existing comments** in `view.js` when making changes.
