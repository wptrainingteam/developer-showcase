<?php
/**
 * Plugin lifecycle helper.
 *
 * @author    Bifrost
 * @copyright Copyright (c) 2026
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/wptrainingteam/developer-showcase
 */

declare(strict_types=1);

namespace Bifrost\Player;

/**
 * A static class that handles the various duties during the plugin's lifecycle.
 */
final class Lifecycle {

	/**
	 * Initializes the plugin and should be used as a callback on the
	 * `plugins_loaded` action hook.
	 */
	public static function init(): void {
		plugin();
	}

	/**
	 * Bootstraps the plugin and should be used as a callback on the
	 * `plugins_loaded` action hook.
	 */
	public static function boot(): void {
		plugin()->boot();
	}

	/**
	 * Runs when the plugin is activated and should be called via the
	 * `register_activation_hook()` function.
	 */
	public static function activate(): void {
		// No custom capabilities needed for this plugin.
	}

	/**
	 * Runs when the plugin is deactivated and should be called via the
	 * `register_deactivation_hook()` function.
	 */
	public static function deactivate(): void {
	}

	/**
	 * Runs when the plugin is uninstalled and should be called via the
	 * `register_uninstall_hook()` function.
	 */
	public static function uninstall(): void {
		if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
			wp_die(
				sprintf(
					__( '%s should only be called when uninstalling the plugin.', 'bifrost-player' ),
					'<code>' . __METHOD__ . '</code>'
				)
			);
		}
	}
}
