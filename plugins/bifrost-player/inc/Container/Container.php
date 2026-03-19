<?php

/**
 * Container interface.
 *
 * @author    Bifrost
 * @copyright Copyright (c) 2026
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/wptrainingteam/developer-showcase
 */

declare(strict_types=1);

namespace Bifrost\Player\Container;

/**
 * Defines the dependency injection container interface.
 */
interface Container
{
	/**
	 * Register a transient service (new instance each time).
	 */
	public function transient(string $abstract, mixed $concrete = null): void;

	/**
	 * Register a singleton service (cached instance).
	 */
	public function singleton(string $abstract, mixed $concrete = null): void;

	/**
	 * Register an existing instance as a singleton.
	 */
	public function instance(string $abstract, object $instance): void;

	/**
	 * Resolve a service from the container.
	 */
	public function get(string $abstract): mixed;

	/**
	 * Resolves a service from the container with parameters.
	 */
	public function make(string $abstract, array $parameters = []): object;

	/**
	 * Check if a service is registered with the container.
	 */
	public function has(string $abstract): bool;
}
