# Bifrost Player — Development Notes

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
- Navigation links are NOT automatically intercepted. You must add `data-wp-on--click="actions.navigate"` on the router region element and implement an action that calls `actions.navigate(href)` from the router module.
- `data-wp-router-region` marks which sections are replaced during navigation. Elements **outside** router regions (header, footer, audio player via `wp_footer`) persist completely.

## Plugin architecture

- Follows bifrost-music patterns: Application > ServiceProvider > Bootable. Namespace: `Bifrost\Player`.
- The audio player block is injected via `wp_footer` action in `BlockServiceProvider` — no theme template modification needed.
- The router region is injected via `render_block` filter on `core/group` blocks with `tagName: "main"`.
- The playlist bridge is injected via `render_block` filter on `core/playlist` — adds `data-wp-init` for waveform event bridging.

## Core/playlist integration

- `core/playlist` uses a **locked** store (`{ lock: true }`). External stores cannot call its actions directly.
- The waveform player (`WaveformPlayer` class) manages its own `<audio>` element imperatively and dispatches custom events: `waveformplayer:play`, `waveformplayer:pause`, `waveformplayer:ended`.
- Our bridge listens for `waveformplayer:play` on the playlist `<figure>`, pauses the waveform's audio, and transfers playback to the persistent player. This avoids two `<audio>` elements playing simultaneously.
