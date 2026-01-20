<?php

/**
 * Abstract service provider.
 *
 * @author    Bifrost
 * @copyright Copyright (c) 2026, WordPress
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/wptrainingteam/developer-showcase
 */

declare(strict_types=1);

namespace Bifrost\Noise\Core;

use Bifrost\Noise\Container\Container;

/**
 * Service providers allow you to connect services to the application container.
 * This base class can be extended with a `register()` method for registering
 * services.
 */
abstract class ServiceProvider
{
	/**
	 * Accepts a container implementation for registering services.
	 */
	public function __construct(protected readonly Container $container)
	{}

	/**
	 * Registers one or more services with the container.
	 */
	public function register(): void
	{
		// Default empty implementation - override if needed.
	}
}
