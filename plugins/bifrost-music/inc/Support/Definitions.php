<?php

/**
 * Plugin supporting constants.
 *
 * @author    Bifrost
 * @copyright Copyright (c) 2026
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/wptrainingteam/developer-showcase
 *
 * @deprecated 1.0.0 Use the constants on the respective Content classes instead.
 */

declare(strict_types=1);

namespace Bifrost\Music\Support;

use Bifrost\Music\Content\{
	Album,
	Artist,
	Genre,
	Post
};

/**
 * Stores constants used throughout the plugin.
 */
final class Definitions
{
	public const POST_TYPE_ARTIST = Artist::POST_TYPE;

	public const POST_TYPE_ALBUM = Album::POST_TYPE;

	public const TAXONOMY_GENRE = Genre::TAXONOMY;

	public const POST_META_ARTIST = Post::META_KEY_ARTIST;

	public const POST_META_ALBUM = Post::META_KEY_ALBUM;
}
