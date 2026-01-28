<?php

/**
 * Plugin supporting constants.
 *
 * @author    Bifrost
 * @copyright Copyright (c) 2026
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/wptrainingteam/developer-showcase
 */

declare(strict_types=1);

namespace Bifrost\Music\Support;

/**
 * Stores constants used throughout the plugin.
 */
final class Definitions
{
	public const POST_TYPE_ARTIST = 'music_artist';

	public const POST_TYPE_ALBUM = 'music_album';

	public const POST_TYPE_SONG = 'music_song';

	public const TAXONOMY_GENRE = 'music_genre';
}
