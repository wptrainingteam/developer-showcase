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

# Load the autoloader.
if (! class_exists(Plugin::class) && is_file(__DIR__ . '/vendor/autoload.php')) {
	require_once __DIR__ . '/vendor/autoload.php';
}

# Initialize the application and register plugin-phase service providers.
add_action('plugins_loaded', fn() => do_action('bifrost/framework/plugin/register', app()), 999);

# Boot any services registered during the plugin registration phase.
add_action('plugins_loaded', fn() => app()->boot(), 999999);

# Provide a theme registration opportunity on after_setup_theme.
add_action('after_setup_theme', fn() => do_action('bifrost/framework/theme/register', app()), 999);

# Boot any services registered during the theme registration phase.
add_action('after_setup_theme', fn() => app()->boot(), 999999);
