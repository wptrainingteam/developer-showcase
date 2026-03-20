<?php
/**
 * Plugin Name:       Bifrost: Player
 * Plugin URI:        https://github.com/wptrainingteam/developer-showcase
 * Description:       Persistent audio player for the Developer Showcase.
 * Version:           0.0.1
 * Requires at least: 6.9
 * Requires PHP:      8.1
 * Author:            Bifrost
 * Author URI:        https://github.com/wptrainingteam/developer-showcase
 * License:           GPL-3.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain:       bifrost-player
 */

declare(strict_types=1);

namespace Bifrost\Player;

// Prevent direct access.
defined( 'ABSPATH' ) || exit;

// Define the plugin constants.
const PLUGIN_DIR  = __DIR__;
const PLUGIN_FILE = __FILE__;

// Load the autoloader.
if ( ! class_exists( Plugin::class ) && is_file( __DIR__ . '/vendor/autoload.php' ) ) {
	require_once PLUGIN_DIR . '/vendor/autoload.php';
}

// Register activation hook.
register_activation_hook( PLUGIN_FILE, array( Plugin::class, 'activate' ) );

// Register uninstall hook.
register_uninstall_hook( PLUGIN_FILE, array( Plugin::class, 'uninstall' ) );

// Register providers with the framework.
add_action( 'bifrost/framework/register/plugin', array( Plugin::class, 'register' ) );
