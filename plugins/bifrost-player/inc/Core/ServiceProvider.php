<?php

/**
 * Abstract service provider.
 *
 * @author    Bifrost
 * @copyright Copyright (c) 2026
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/wptrainingteam/developer-showcase
 */

declare(strict_types=1);

namespace Bifrost\Player\Core;

use Bifrost\Player\Container\Container;

/**
 * Service providers allow you to connect services to the application container.
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
