<?php

/**
 * Post type modifier interface.
 *
 * @author    Bifrost
 * @copyright Copyright (c) 2026, WordPress
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/wptrainingteam/developer-showcase
 */

declare(strict_types=1);

namespace Bifrost\Noise\PostType;

/**
 * Defines the contract for post type modifiers, which should have a single
 * `modify()` method for altering a post type's arguments.
 */
interface PostTypeModifier
{
	/**
	 * Modifies the post type arguments.
	 */
	public function modify(array $args): array;
}
