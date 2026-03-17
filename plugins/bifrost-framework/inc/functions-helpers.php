<?php

/**
 * The helpers functions file houses any necessary PHP functions for the
 * framework plugin.
 *
 * @author    Bifrost
 * @copyright Copyright (c) 2026, WordPress
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/wptrainingteam/developer-showcase
 */

declare(strict_types=1);

namespace Bifrost\Framework;

use Bifrost\Framework\Container\{Container, ServiceContainer};
use Bifrost\Framework\Core\Application;

/**
 * Returns the primary framework application, stored as a single instance in
 * the static `$app` variable.
 */
function app(): Application
{
	static $app;

	if (! $app instanceof Plugin) {
		$app = new Plugin(new ServiceContainer());
	}

	return $app;
}

/**
 * Helper function for quickly accessing the framework service container.
 */
function container(): Container
{
	return app()->container();
}
