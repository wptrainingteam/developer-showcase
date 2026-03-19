const defaultConfig = require( '@wordpress/scripts/config/webpack.config' );

// With --experimental-modules, defaultConfig is an array of configs
// (one for scripts, one for modules). Export as-is for block auto-discovery.
module.exports = defaultConfig;
