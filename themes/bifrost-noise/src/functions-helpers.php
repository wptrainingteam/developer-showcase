<?php

/**
 * The helpers functions file houses any necessary PHP functions for the theme.
 *
 * @author    Bifrost
 * @copyright Copyright (c) 2026, WordPress
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/wptrainingteam/developer-showcase
 */

declare(strict_types=1);

namespace Bifrost\Noise;

use Bifrost\Noise\Container\{Container, ServiceContainer};
use Bifrost\Noise\Core\Application;

/**
 * Returns the theme application instance.
 */
function theme(): Application
{
	static $theme;

	if (! $theme instanceof Theme) {
		$theme = new Theme(new ServiceContainer());
	}

	return $theme;
}


/**
 * Helper function for quickly accessing the service container. Devs can access
 * any concrete implementation by passing in a reference to its abstract
 * identifier via `container()->get($abstract)`.
 */
function container(): Container
{
	return theme()->container();
}
