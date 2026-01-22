<?php

/**
 * Plugin application class.
 *
 * @author    Bifrost
 * @copyright Copyright (c) 2026
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/wptrainingteam/developer-showcase
 */

declare(strict_types=1);

namespace Bifrost\Music;

use Bifrost\Music\Content\ContentServiceProvider;
use Bifrost\Music\Core\Application;
use Bifrost\Music\Editor\EditorServiceProvider;

/**
 * The Plugin class is an implementation of the Application contract. It's used
 * to register the default service providers, bootstrapping the plugin.
 */
final class Plugin extends Application
{
	/**
	 * Defines the plugin's namespace, which is used as a hook prefix.
	 */
	protected const NAMESPACE = 'bifrost/music';

	/**
	 * Defines the plugin's default service providers.
	 */
	protected const PROVIDERS = [
		ContentServiceProvider::class,
		EditorServiceProvider::class
	];
}
