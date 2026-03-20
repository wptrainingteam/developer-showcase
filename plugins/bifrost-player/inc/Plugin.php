<?php

/**
 * Plugin registration class.
 *
 * @author    Bifrost
 * @copyright Copyright (c) 2026
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/wptrainingteam/developer-showcase
 */

declare(strict_types=1);

namespace Bifrost\Player;

use Bifrost\Framework\Core\Application;
use Bifrost\Player\Block\BlockServiceProvider;
use Bifrost\Player\Router\RouterServiceProvider;

/**
 * Registers the player's service providers with the framework application.
 */
final class Plugin {

	/**
	 * The plugin's service providers.
	 */
	private const PROVIDERS = array(
		BlockServiceProvider::class,
		RouterServiceProvider::class,
	);

	/**
	 * Registers service providers with the framework.
	 */
	public static function register( Application $app ): void {
		foreach ( self::PROVIDERS as $provider ) {
			$app->register( $provider );
		}
	}

	/**
	 * Runs on plugin activation.
	 */
	public static function activate(): void {}

	/**
	 * Runs on plugin uninstall.
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
