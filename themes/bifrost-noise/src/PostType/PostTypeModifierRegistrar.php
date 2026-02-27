<?php

/**
 * Post type modifier registration class.
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2009-2025, Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/x3p0-dev/x3p0-breadcrumbs
 */

declare(strict_types=1);

namespace Bifrost\Noise\PostType;

/**
 * Registers classes with the post type modifier registry.
 *
 * This class provides a centralized registry of default post type argument
 * modifiers. It maps post types their corresponding modifier classes and
 * handles the registration process with the modifier registry.
 */
final class PostTypeModifierRegistrar
{
	/**
	 * Map of post types to their modifier class names.
	 *
	 * Keys are WordPress post type identifiers (e.g., 'music_artist').
	 * Values are fully qualified class names of modifier implementations.
	 *
	 * @var array<string, class-string>
	 */
	private const MODIFIERS = [
		'music_artist' => Modifiers\Artist::class
	];

	/**
	 * Registers default modifiers with the registry.
	 */
	public static function register(PostTypeModifierRegistry $registry): void
	{
		foreach (self::MODIFIERS as $key => $modifierClass) {
			if (! $registry->isRegistered($key)) {
				$registry->register($key, $modifierClass);
			}
		}
	}
}
