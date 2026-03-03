<?php

/**
 * Class registry interface.
 *
 * @author    Bifrost
 * @copyright Copyright (c) 2026, WordPress
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/wptrainingteam/developer-showcase
 */

declare(strict_types=1);

namespace Bifrost\Noise\Contracts;

/**
 * Defines an interface for creating a registry of class names (not instances),
 * indexed by key.
 */
interface ClassRegistry
{
	/**
	 * Registers a class.
	 *
	 * @param class-string $className
	 */
	public function register(string $key, string $className): void;

	/**
	 * Unregisters a class.
	 */
	public function unregister(string $key): void;

	/**
	 * Checks if a class is registered.
	 */
	public function isRegistered(string $key): bool;

	/**
	 * Returns a class string or `null`.
	 *
	 * @return null|class-string
	 */
	public function get(string $key): ?string;
}
