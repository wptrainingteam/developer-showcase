<?php

/**
 * Post type modifier factory.
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2023-2025, Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/x3p0-dev/bifrost-noise
 */

declare(strict_types=1);

namespace Bifrost\Noise\PostType;

/**
 * Creates post type modifier objects.
 */
final class PostTypeModifierFactory
{
	/**
	 * Sets up the initial object state.
	 */
	public function __construct(private readonly PostTypeModifierRegistry $registry)
	{}

	/**
	 * Creates a new post type modifier object.
	 */
	public function make(string $blockName): ?PostTypeModifier
	{
		if ($modifier = $this->registry->get($blockName)) {
			return new $modifier;
		}

		return null;
	}
}
