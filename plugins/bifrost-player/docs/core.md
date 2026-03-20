# Core

The foundational abstractions that the plugin's architecture is built on.

## `inc/Contracts/Bootable.php`

**Path:** `inc/Contracts/Bootable.php`
**Interface:** `Bifrost\Player\Contracts\Bootable`

A single-method interface:

```php
public function boot(): void;
```

Implemented by any class that needs to register WordPress hooks or perform initialization after all services are registered. The `Application` class iterates through its providers and calls `boot()` on each one that implements this interface.

Used by: `Application`, `BlockServiceProvider`, `RouterServiceProvider`, `InteractiveRouter`, `RenderPlaylist`, `RenderPlaylistTrack`.

## `inc/Core/Application.php`

**Path:** `inc/Core/Application.php`
**Class:** `Bifrost\Player\Core\Application` (abstract)

The base application class that orchestrates the register → boot lifecycle. Subclasses (like `Plugin`) declare their configuration via class constants.

### Class constants (overridden by subclasses)

- `NAMESPACE` — a hook prefix string. When set, the application fires `{NAMESPACE}/register` after registration and `{NAMESPACE}/booted` after boot, allowing external code to extend the plugin.
- `PROVIDERS` — an array of `ServiceProvider` class names to register automatically.

### Constructor flow

```
new Application(Container)
  → registerDefaultBindings()     // binds the container to itself
  → registerDefaultProviders()    // iterates PROVIDERS, calls register() on each
  → do_action(NAMESPACE/register) // external extension point
```

### `register(provider)`

Accepts a `ServiceProvider` instance or class name. If a string, validates it's a `ServiceProvider` subclass, then instantiates it with the container. Calls `$provider->register()` and stores it in `$serviceProviders`.

### `boot()`

Iterates `$serviceProviders`, calling `boot()` on each that implements `Bootable`. Then fires `{NAMESPACE}/booted`.

## `inc/Core/ServiceProvider.php`

**Path:** `inc/Core/ServiceProvider.php`
**Class:** `Bifrost\Player\Core\ServiceProvider` (abstract)

Base class for all service providers. Provides:

- A `$container` property (readonly, injected via constructor) so subclasses can register bindings or resolve services.
- A default empty `register()` method that subclasses can override to bind services into the container.

Service providers that also need to hook into WordPress implement `Bootable` and add their hook registrations in `boot()`. The separation between `register()` (bind services) and `boot()` (use services) ensures that all bindings are available before any provider tries to resolve them.
