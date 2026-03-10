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
use Bifrost\Noise\Contracts\Bootable;
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
	 * Injects the album's featured image URL into the block attributes
	 * before rendering if the track has no image of its own.
	 */
	private function renderBlockData(array $parsedBlock): array
	{
		if (($parsedBlock['blockName'] ?? '') !== self::BLOCK_NAME) {
			return $parsedBlock;
		}

		$attachmentId = (int) ($parsedBlock['attrs']['id'] ?? 0);

		if ($attachmentId === 0) {
			return $parsedBlock;
		}

		$imageUrl = $this->resolveAlbumImageUrl($attachmentId);

		if ($imageUrl === null) {
			return $parsedBlock;
		}

		$parsedBlock['attrs']['image'] = $imageUrl;

		return $parsedBlock;
	}

	/**
	 * Resolves the album's featured image URL from the attachment's parent post.
	 */
	private function resolveAlbumImageUrl(int $attachmentId): ?string
	{
		$attachment = get_post($attachmentId);

		if (! $attachment instanceof WP_Post || empty($attachment->post_parent)) {
			return null;
		}

		$album = get_post($attachment->post_parent);

		if (! $album instanceof WP_Post || $album->post_type !== Definitions::POST_TYPE_ALBUM) {
			return null;
		}

		$thumbnailId = get_post_thumbnail_id($album->ID);

		if (! $thumbnailId) {
			return null;
		}

		return wp_get_attachment_image_url($thumbnailId, 'full') ?: null;
	}
}
