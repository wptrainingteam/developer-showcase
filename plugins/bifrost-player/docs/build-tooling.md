# Build Tooling

Configuration files for the JavaScript/CSS build pipeline and PHP autoloading.

## `webpack.config.js`

```js
const defaultConfig = require('@wordpress/scripts/config/webpack.config');
module.exports = defaultConfig;
```

Exports the default `@wordpress/scripts` webpack configuration as-is.

**Critical detail:** When `--experimental-modules` is active (see `package.json`), `@wordpress/scripts/config/webpack.config` returns an **array** of two configs — one for traditional scripts and one for ES modules (script modules). The config must be exported as the array directly. Spreading it into a single object (`{ ...defaultConfig }`) would break the dual-output build.

The `--experimental-modules` flag is what enables `viewScriptModule` support in `block.json`, allowing the Interactivity API store in `view.js` to be built as an ES module.

## `package.json`

```json
{
  "scripts": {
    "build": "wp-scripts build --experimental-modules",
    "start": "wp-scripts start --experimental-modules"
  },
  "dependencies": {
    "@wordpress/interactivity": "^6.0.0"
  },
  "devDependencies": {
    "@wordpress/scripts": "^31.4.0"
  }
}
```

### Scripts

- **`build`** — production build with `--experimental-modules` for script module output.
- **`start`** — development mode with hot reload and the same flag.

### Dependencies

- **`@wordpress/interactivity`** — runtime dependency for the Interactivity API (`store`, `getContext`, `getElement`, `withSyncEvent`). Listed as a production dependency because it's an external (provided by WordPress at runtime via the import map) but needed for module resolution during build.
- **`@wordpress/scripts`** — dev dependency providing webpack, Babel, and the block build pipeline.

Note: `@wordpress/interactivity-router` is not listed as a dependency because it's dynamically imported at runtime (`yield import('@wordpress/interactivity-router')`), and its presence in the import map is handled by the `enqueueRouterModule()` workaround in `InteractiveRouter.php`.

## `composer.json`

```json
{
  "autoload": {
    "psr-4": { "Bifrost\\Player\\": "inc/" },
    "files": ["inc/functions-helpers.php"]
  },
  "require": { "php": ">=8.1" },
  "require-dev": {
    "wp-coding-standards/wpcs": "^3.0",
    "phpcompatibility/phpcompatibility-wp": "*",
    "dealerdirect/phpcodesniffer-composer-installer": "^1.0"
  }
}
```

### Autoloading

- **PSR-4** — maps `Bifrost\Player\` to `inc/`, so `Bifrost\Player\Block\RenderPlaylist` resolves to `inc/Block/RenderPlaylist.php`.
- **Files** — `inc/functions-helpers.php` is always loaded (contains the `plugin()` and `container()` helper functions).

### Scripts

- **`composer build`** — updates dependencies without dev packages and generates an optimized autoloader for production.
- **`composer dev`** — updates all dependencies including dev tools.

### Dev dependencies

- **`wp-coding-standards/wpcs`** — WordPress Coding Standards for PHP_CodeSniffer.
- **`phpcompatibility/phpcompatibility-wp`** — PHP version compatibility checks.
- **`dealerdirect/phpcodesniffer-composer-installer`** — auto-registers PHPCS standards from Composer packages.
