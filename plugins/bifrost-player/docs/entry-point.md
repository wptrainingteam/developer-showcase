# Entry Point

The plugin bootstrap chain: `plugin.php` → `bifrost/framework/register/plugin` hook → `Plugin::register()` → service providers.

## `plugin.php`

**Path:** `/plugin.php`
**Namespace:** `Bifrost\Player`

The WordPress plugin header file and single entry point. Responsibilities:

- Declares the plugin metadata (name, version, requirements, license).
- Defines two constants: `PLUGIN_DIR` (directory path) and `PLUGIN_FILE` (file path).
- Loads the Composer autoloader from `vendor/autoload.php`.
- Registers activation and uninstall hooks via `Plugin`.
- Hooks `Plugin::register()` into `bifrost/framework/register/plugin`, which fires at `plugins_loaded` priority 999.

The framework handles the register → boot lifecycle: it fires the hook (passing its shared `Application` instance), then calls `boot()` on all registered providers. This replaces the previous two-phase approach with `Lifecycle::init()` and `Lifecycle::boot()`.

**Requires:** `bifrost-framework` must be active. If it's not, the hook never fires and the plugin silently does nothing.

## `inc/Plugin.php`

**Path:** `inc/Plugin.php`
**Class:** `Bifrost\Player\Plugin`

A static registration class (following the same pattern as `Bifrost\Music\Plugin`). Declares:

- `PROVIDERS` — the two service providers that compose the plugin:
  - `BlockServiceProvider` — block registration, player rendering, playlist integration.
  - `RouterServiceProvider` — client-side navigation.

### `register(Application $app)`

Receives the framework's shared `Application` instance and registers each provider. The framework's container auto-wires constructor dependencies (service providers receive the container via their parent class constructor).

### `activate()` / `uninstall()`

Static lifecycle hooks called directly from `plugin.php`. `activate()` is a placeholder. `uninstall()` guards against direct invocation outside the uninstall context.
