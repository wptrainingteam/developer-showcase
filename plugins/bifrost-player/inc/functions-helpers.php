<?php

/**
 * The helpers functions file houses any necessary PHP functions for the plugin.
 *
 * @author    Bifrost
 * @copyright Copyright (c) 2026
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/wptrainingteam/developer-showcase
 */

declare(strict_types=1);

namespace Bifrost\Player;

use Bifrost\Player\Core\Application;
use Bifrost\Player\Container\{Container, ServiceContainer};

/**
 * Returns the plugin application, which is stored as a single instance in the
 * static `$plugin` variable.
 */
function plugin(): Application {
	static $plugin;

	if ( ! $plugin instanceof Plugin ) {
		$plugin = new Plugin( new ServiceContainer() );
	}

	return $plugin;
}

/**
 * Helper function for quickly accessing the plugin service container.
 */
function container(): Container {
	return plugin()->container();
}
