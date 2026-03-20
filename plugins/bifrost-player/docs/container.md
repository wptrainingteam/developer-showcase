# Container

The dependency injection (DI) container that powers service resolution throughout the plugin.

## `inc/Container/Container.php`

**Path:** `inc/Container/Container.php`
**Interface:** `Bifrost\Player\Container\Container`

Defines the contract for the DI container. Methods:

| Method | Description |
|---|---|
| `transient(abstract, concrete)` | Register a service that creates a new instance each time it's resolved |
| `singleton(abstract, concrete)` | Register a service that is created once and cached |
| `instance(abstract, instance)` | Store an already-created object as a singleton |
| `get(abstract)` | Resolve a service (returns cached singleton if available) |
| `make(abstract, parameters)` | Resolve a service with explicit constructor parameters (always builds fresh) |
| `has(abstract)` | Check if a service is registered |

The `concrete` parameter in `transient()` and `singleton()` is optional — if omitted, the abstract (class name) is used as its own concrete, enabling auto-resolution.

## `inc/Container/ServiceContainer.php`

**Path:** `inc/Container/ServiceContainer.php`
**Class:** `Bifrost\Player\Container\ServiceContainer`

The concrete container implementation. Uses two internal arrays:

- `$bindings` — maps abstract names to `['concrete' => ..., 'shared' => bool]`.
- `$instances` — stores resolved singletons and manually registered instances.

### Resolution flow (`resolve()`)

```
resolve(abstract, parameters)
  1. If abstract exists in $instances and no parameters → return cached instance
  2. Get concrete from $bindings (or use abstract as its own concrete)
  3. Verify it's buildable (Closure or existing class name)
  4. Build the instance
  5. If shared binding and no parameters → cache in $instances
  6. Return instance
```

### Auto-wiring (`build()` + `resolveDependencies()`)

When the concrete is a class name (not a Closure), the container uses reflection to inspect the constructor:

- **No constructor** → `new $concrete()`.
- **With constructor** → resolves each parameter:
  1. Check `$parameters` array (explicit overrides by name).
  2. If type-hinted with a class → recursively resolve from the container.
  3. If no type hint or built-in type → use default value or throw.

This auto-wiring means most classes don't need explicit registration — the container can build them on demand by inspecting their constructor signatures.

### How the plugin uses it

The container is created in `functions-helpers.php` and passed to `Plugin`. During bootstrap:

1. `Application` registers itself: `$container->instance(Container::class, $container)`.
2. Service providers receive the container via their constructor.
3. Providers call `$this->container->get(SomeClass::class)` to resolve dependencies (e.g., `InteractiveRouter`, `RenderPlaylist`).

Since no explicit bindings are registered for most classes, the container auto-wires them via reflection.
