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

use Bifrost\Framework\Core\Application;

# Load the autoloader.
if (! class_exists(Application::class)) {
	if (is_file(__DIR__ . '/vendor/autoload.php')) {
		require_once __DIR__ . '/vendor/autoload.php';
	} elseif (is_file(__DIR__ . '/inc/autoload.php')) {
		require_once __DIR__ . '/inc/autoload.php';
		require_once __DIR__ . '/inc/functions-helpers.php';
		Autoload::register();
	}
}

# Plugin phase: allow consumers to register providers, then boot.
add_action('plugins_loaded', function (): void {
	do_action('bifrost/framework/register/plugin', app());
	app()->boot();
}, 999);

# Theme phase: allow consumers to register providers, then boot.
add_action('after_setup_theme', function (): void {
	do_action('bifrost/framework/register/theme', app());
	app()->boot();
}, 999);
