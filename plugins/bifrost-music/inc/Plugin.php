<?php

/**
 * Plugin lifecycle helper.
 *
 * @author    Bifrost
 * @copyright Copyright (c) 2026, WordPress
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/wptrainingteam/developer-showcase
 */

declare(strict_types=1);

namespace Bifrost\Music;

use Bifrost\Framework\Core\Application;
use Bifrost\Music\Content\ContentServiceProvider;
use Bifrost\Music\Editor\EditorServiceProvider;

/**
 * Registers the plugin's service providers with the framework application.
 */
final class Plugin
{
	/**
	 * Service providers to register with the framework application.
	 *
	 * @var  array<class-string>
	 * @todo Type hint with PHP 8.3+ requirement.
	 */
	private const PROVIDERS = [
		ContentServiceProvider::class,
		EditorServiceProvider::class
	];

	/**
	 * Registers the plugin's service providers.
	 */
	public static function register(Application $app): void
	{
		foreach (self::PROVIDERS as $provider) {
			$app->register($provider);
		}
	}
}
