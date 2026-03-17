<?php

/**
 * Plugin Name:       Bifrost: Framework
 * Plugin URI:        https://github.com/wptrainingteam/developer-showcase
 * Description:       Application framework for Bifrost plugins.
 * Version:           1.0.0
 * Requires at least: 6.9
 * Requires PHP:      8.1
 * Author:            Bifrost
 * Author URI:        https://github.com/wptrainingteam/developer-showcase
 * License:           GPL-3.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain:       bifrost-framework
 */

declare(strict_types=1);

namespace Bifrost\Framework;

# Prevent direct access.
defined('ABSPATH') || exit;

# Define the plugin constants.
const PLUGIN_DIR  = __DIR__;
const PLUGIN_FILE = __FILE__;

# Load the autoloader.
if (! class_exists(Lifecycle::class) && is_file(__DIR__ . '/vendor/autoload.php')) {
	require_once PLUGIN_DIR . '/vendor/autoload.php';
}

# Initialize the application.
add_action('plugins_loaded', app(...), 999);

# Boot registered services.
add_action('plugins_loaded', fn() => app()->boot(), 999999);
