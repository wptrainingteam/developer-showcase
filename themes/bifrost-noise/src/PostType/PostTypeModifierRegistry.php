<?php

/**
 * Post type modifier registry.
 *
 * @author    Bifrost
 * @copyright Copyright (c) 2026, WordPress
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/wptrainingteam/developer-showcase
 */

declare(strict_types=1);

namespace Bifrost\Noise\PostType;

use TypeError;
use Bifrost\Noise\Contracts\ClassRegistry;

/**
 * Stores the post type modifier classes that can later be instantiated as objects.
 */
final class PostTypeModifierRegistry implements ClassRegistry
{
	/**
	 * Stores the array of post type modifier classnames.
	 */
	protected array $modifiers = [];

	/**
	 * Registers a post type modifier class.
	 *
	 * @param class-string<PostTypeModifier> $className
	 */
	public function register(string $key, string $className): void
	{
		if (! is_subclass_of($className, PostTypeModifier::class)) {
			throw new TypeError(esc_html(sprintf(
				// Translators: %s is a PHP class name.
				__('Only %s classes can be registered', 'bifrost-noise'),
				PostTypeModifier::class
			)));
		}

		$this->modifiers[$key] = $className;
	}

	/**
	 * Unregisters a post type modifier class.
	 */
	public function unregister(string $key): void
	{
		unset($this->modifiers[$key]);
	}

	/**
	 * Checks if a post type modifier class is registered.
	 */
	public function isRegistered(string $key): bool
	{
		return array_key_exists($key, $this->modifiers);
	}

	/**
	 * Returns a post type modifier class string or `null`.
	 *
	 * @return null|class-string<PostTypeModifier>
	 */
	public function get(string $key): ?string
	{
		return $this->isRegistered($key) ? $this->modifiers[$key] : null;
	}
}
