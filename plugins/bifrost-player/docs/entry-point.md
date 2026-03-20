# Entry Point

The plugin bootstrap chain: `plugin.php` → `Lifecycle` → `Plugin` → service providers.

## `plugin.php`

**Path:** `/plugin.php`
**Namespace:** `Bifrost\Player`

The WordPress plugin header file and single entry point. Responsibilities:

- Declares the plugin metadata (name, version, requirements, license).
- Defines two constants: `PLUGIN_DIR` (directory path) and `PLUGIN_FILE` (file path).
- Loads the Composer autoloader from `vendor/autoload.php`.
- Registers activation and uninstall hooks via `Lifecycle`.
- Hooks `Lifecycle::init()` at `plugins_loaded` priority 999 and `Lifecycle::boot()` at priority 999999.

The two-phase `plugins_loaded` approach (init then boot) ensures all service providers are registered before any of them are booted, so cross-provider dependencies resolve correctly.

## `inc/Lifecycle.php`

**Path:** `inc/Lifecycle.php`
**Class:** `Bifrost\Player\Lifecycle`

A static helper class that maps WordPress lifecycle hooks to the plugin application. All methods are static because they are used as direct callbacks in `plugin.php`.

| Method | Hook | Purpose |
|---|---|---|
| `init()` | `plugins_loaded` @ 999 | Calls `plugin()` to create the `Plugin` singleton (triggers provider registration) |
| `boot()` | `plugins_loaded` @ 999999 | Calls `plugin()->boot()` to boot all registered providers |
| `activate()` | `register_activation_hook` | Placeholder for activation logic (currently empty) |
| `uninstall()` | `register_uninstall_hook` | Guards against direct invocation outside the uninstall context |

## `inc/Plugin.php`

**Path:** `inc/Plugin.php`
**Class:** `Bifrost\Player\Plugin`

The concrete application class. Extends `Application` and declares:

- `NAMESPACE = 'bifrost/player'` — used as a prefix for WordPress action hooks (`bifrost/player/register`, `bifrost/player/booted`), allowing external code to hook into the plugin's lifecycle.
- `PROVIDERS` — the two service providers that compose the plugin:
  - `BlockServiceProvider` — block registration, player rendering, playlist integration.
  - `RouterServiceProvider` — client-side navigation.

This class has no methods of its own; all behavior is inherited from `Application`.

## `inc/functions-helpers.php`

**Path:** `inc/functions-helpers.php`
**Namespace:** `Bifrost\Player`

Two namespaced helper functions:

### `plugin(): Application`

Returns the `Plugin` singleton. Uses a `static` variable to ensure only one instance exists. On first call, creates `new Plugin(new ServiceContainer())`, which triggers the full registration chain (default bindings → default providers → `register()` on each provider).

Called by `Lifecycle::init()` and `Lifecycle::boot()`.

### `container(): Container`

Shortcut to `plugin()->container()`. Provides quick access to the DI container from anywhere in the plugin without needing to pass the container around.

This file is autoloaded by Composer via the `files` directive in `composer.json`.
