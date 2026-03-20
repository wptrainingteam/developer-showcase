# Router

Enables client-side navigation (SPA-like page transitions) so the persistent audio player survives page changes.

## `inc/Router/RouterServiceProvider.php`

**Path:** `inc/Router/RouterServiceProvider.php`
**Class:** `Bifrost\Player\Router\RouterServiceProvider`
**Extends:** `Bifrost\Framework\Core\ServiceProvider` **Implements:** `Bifrost\Framework\Contracts\Bootable`

A thin provider that resolves `InteractiveRouter` from the container and calls its `boot()` method. Exists to keep the provider pattern consistent — the actual logic lives in `InteractiveRouter`.

## `inc/Router/InteractiveRouter.php`

**Path:** `inc/Router/InteractiveRouter.php`
**Class:** `Bifrost\Player\Router\InteractiveRouter`
**Implements:** `Bifrost\Framework\Contracts\Bootable`

The core of the client-side navigation system. Hooks into the WordPress render pipeline to transform a traditional multi-page site into an SPA-like experience.

### Hooks registered on `boot()`

| Hook | Callback | Priority |
|---|---|---|
| `render_block` | `injectRouterRegions()` | 10 |
| `wp_enqueue_scripts` | `enqueueRouterModule()` | 10 |
| `wp_enqueue_scripts` | `markModulesForClientNav()` | 10 |

### `injectRouterRegions(blockContent, block)`

A `render_block` filter that dispatches based on block type:

- **`core/group` with `tagName: "main"`** — adds router region + link directives to the main content area.
- **`core/template-part` with slug `header` or `footer`** — adds router region + link directives to header and footer.

All other blocks pass through unchanged.

### `addRegionAndLinks(blockContent, htmlTag, regionSlug)`

The workhorse method. Uses `WP_HTML_Tag_Processor` to:

1. **Set the router region** on the wrapper element:
   - `data-wp-interactive="bifrost-player"` — namespace for directives.
   - `data-wp-router-region="bifrost-player/{regionSlug}"` — tells the Interactivity Router which DOM sections to swap during navigation.

2. **Inject navigation directives** on every `<a>` tag inside the block:
   - `data-wp-on--click="bifrost-player::actions.navigate"` — intercepts clicks for client-side navigation.
   - `data-wp-on--mouseenter="bifrost-player::actions.prefetch"` — prefetches the target page on hover.
   - Skips links that already have a `data-wp-on--click` attribute to avoid overriding existing handlers.

### Why directives go on each `<a>` individually

Event delegation from a parent container (e.g., `<main>`) doesn't work reliably because `e.target` resolves to whatever nested element was clicked (an image, span, etc.), not the `<a>` tag. Placing directives directly on each `<a>` and using `getElement().ref.href` in the action guarantees the correct href is always resolved.

### `enqueueRouterModule()`

Enqueues the `audio-player` view script module early during `wp_enqueue_scripts`. This is needed because the audio-player block is rendered in `wp_footer`, which happens after the import map is printed. Without early enqueue, the dynamic dependency on `@wordpress/interactivity-router` wouldn't be in the import map, and `yield import(...)` would fail at runtime.

### `markModulesForClientNav()`

Explicitly marks script modules in `CLIENT_NAV_MODULES` for client-side navigation support via `wp_interactivity()->add_client_navigation_support_to_script_module()`.

Currently marks: `@wordpress/block-library/tabs/view`.

**Why this is needed:** Gutenberg's `gutenberg_define_interactivity_modules_support()` relies on a `build/modules/index.php` registry file to mark block-library modules for client navigation. That file is missing from the current Gutenberg build, so no block-library module gets the `data-wp-router-options` attribute. This workaround ensures the router loads these modules when navigating to pages that use them.

### Router regions summary

```
┌──────────────────────────────────────┐
│ data-wp-router-region: header        │  ← swapped on navigation
├──────────────────────────────────────┤
│ data-wp-router-region: main          │  ← swapped on navigation
├──────────────────────────────────────┤
│ data-wp-router-region: footer        │  ← swapped on navigation
├──────────────────────────────────────┤
│ audio-player (wp_footer, no region)  │  ← persists across navigation
└──────────────────────────────────────┘
```
