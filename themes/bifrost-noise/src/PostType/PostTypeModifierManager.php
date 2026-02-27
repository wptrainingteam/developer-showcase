<?php

/**
 * Post type modifier manager.
 *
 * @author    Bifrost
 * @copyright Copyright (c) 2026, WordPress
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/wptrainingteam/developer-showcase
 */

declare(strict_types=1);

namespace Bifrost\Noise\PostType;

use Bifrost\Noise\Contracts\Bootable;

/**
 * Manages the modification of post type settings during WordPress registration.
 *
 * This manager acts as a coordinator between the post type modifier registry and
 * factory. It hooks into WordPress's CPT registration process and applies
 * custom modifications to CPT args when a modifier is registered for that type.
 */
final class PostTypeModifierManager implements Bootable
{
	/**
	 * Sets up the initial object state.
	 */
	public function __construct(
		private readonly PostTypeModifierRegistry $registry,
		private readonly PostTypeModifierFactory  $factory
	) {}

	/**
	 * @inheritDoc
	 */
	public function boot(): void
	{
		add_filter('register_post_type_args', $this->modify(...), 999999, 2);
	}

	/**
	 * Determines if the given type has a registered post type modifier. If
	 * it does, it runs the modifier's `modify()` method over it.
	 */
	private function modify(array $args, string $postType): array
	{
		if (! $this->registry->isRegistered($postType)) {
			return $args;
		}

		$modifier = $this->factory->make($postType);

		return $modifier ? $modifier->modify($args) : $args;
	}
}
