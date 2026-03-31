<?php

/**
 * Playlist Track block renderer.
 *
 * @author    Bifrost
 * @copyright Copyright (c) 2026, WordPress
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/wptrainingteam/developer-showcase
 */

declare(strict_types=1);

namespace Bifrost\Noise\Block\Render;

use Bifrost\Music\Support\Definitions;
use Bifrost\Framework\Contracts\Bootable;
use WP_Post;

/**
 * Filters the `core/playlist-track` block data to inject the parent album's
 * featured image URL into the block attributes before rendering.
 */
final class RenderPlaylistTrack implements Bootable
{
	private const BLOCK_NAME = 'core/playlist-track';

	/**
	 * Registers the WordPress filter hooks.
	 */
	public function boot(): void
	{
		add_filter('render_block_data', $this->renderBlockData(...));
	}

	/**
	 * Automatically injects the track's album and artist data on the front
	 * end if the track/attachment has a parent post of the album post type.
	 */
	private function renderBlockData(array $parsedBlock): array
	{
		if (($parsedBlock['blockName'] ?? '') !== self::BLOCK_NAME) {
			return $parsedBlock;
		}

		$mediaId = (int) ($parsedBlock['attrs']['id'] ?? 0);
		$track   = $mediaId !== 0 ? get_post($mediaId) : null;

		// Merge in the album attributes if the track has an album
		// parent post.
		if ($track instanceof WP_Post && $album = $this->getAlbum($track)) {
			$parsedBlock['attrs'] = array_merge(
				$parsedBlock['attrs'],
				$this->getAlbumAttrs($album)
			);
		}

		return $parsedBlock;
	}

	/**
	 * Returns block attributes derived from the album and its artist.
	 */
	private function getAlbumAttrs(WP_Post $album): array
	{
		$attrs = ['album' => get_the_title($album)];

		if ($artist = $this->getArtist($album)) {
			$attrs['artist'] = get_the_title($artist);
		}

		if ($thumbnailId = get_post_thumbnail_id($album->ID)) {
			$attrs['image'] = wp_get_attachment_image_url($thumbnailId, 'full') ?: null;
		}

		return $attrs;
	}

	/**
	 * Returns the parent album post for a track, or null if none exists.
	 */
	private function getAlbum(WP_Post $attachment): ?WP_Post
	{
		$album = get_post($attachment->post_parent);

		if ($album instanceof WP_Post && $album->post_type === Definitions::POST_TYPE_ALBUM) {
			return $album;
		}

		return null;
	}

	/**
	 * Returns the parent artist post for an album, or null if none exists.
	 */
	private function getArtist(WP_Post $album): ?WP_Post
	{
		$artist = get_post($album->post_parent);

		if ($artist instanceof WP_Post && $artist->post_type === Definitions::POST_TYPE_ARTIST) {
			return $artist;
		}

		return null;
	}
}
