<?php

/**
 * Block Bindings Source interface.
 *
 * @author    Bifrost
 * @copyright Copyright (c) 2026, WordPress
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/wptrainingteam/developer-showcase
 */

declare(strict_types=1);

namespace Bifrost\Noise\Block\Binding;

use LogicException;
use WP_Block;

/**
 * The Block Bindings Source contract defines how block binding sources should
 * be implemented within the theme.
 */
abstract class BindingSource
{
	/**
	 * Name of the block binding source. This should always be overridden in
	 * child classes (e.g., `bifrost-music/album`).
	 */
	protected const NAME = '';

	/**
	 * Returns the binding source name (e.g., 'bifrost-music/album').
	 */
	public function getName(): string
	{
		if (static::NAME === '') {
			throw new LogicException(sprintf(
				// Translators: %s is a PHP classname.
				__('%s must define the NAME constant', 'bifrost-noise'),
				static::class
			));
		}

		return static::NAME;
	}

	/**
	 * Returns the human-readable label for the binding source.
	 */
	abstract public function getLabel(): string;

	/**
	 * Returns the array of block context keys this binding uses.
	 */
	public function usesContext(): array
	{
		return [];
	}

	/**
	 * Handles the binding logic and returns the bound value.
	 */
	abstract public function callback(array $args, WP_Block $block, string $name): string|int|null;
}
