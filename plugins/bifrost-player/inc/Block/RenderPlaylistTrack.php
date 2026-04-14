<?php

/**
 * Playlist track render filter.
 *
 * Injects Interactivity API directives on core/playlist-track blocks
 * so that clicking a track triggers the persistent audio player.
 *
 * @author    Bifrost
 * @copyright Copyright (c) 2026
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/wptrainingteam/developer-showcase
 */

declare(strict_types=1);

namespace Bifrost\Player\Block;

use Bifrost\Music\Support\Definitions;
use Bifrost\Framework\Contracts\Bootable;
use WP_HTML_Tag_Processor;
use WP_Post;

/**
 * Filters the rendered output of core/playlist-track to add interactive
 * directives that connect each track to the persistent audio player.
 */
final class RenderPlaylistTrack implements Bootable
{
	/**
	 * Registers the WordPress filter hooks.
	 */
	public function boot(): void
	{
		add_filter('render_block_core/playlist-track', $this->renderBlock(...), 10, 2);
	}

	/**
	 * Injects iAPI directives on the playlist track wrapper element.
	 */
	private function renderBlock(string $blockContent, array $block): string
	{
		$attachmentId = (int) ( $block['attrs']['id'] ?? 0 );

		if ( $attachmentId === 0 ) {
			return $blockContent;
		}

		$trackData = $this->resolveTrackData($attachmentId);

		if ( $trackData === null ) {
			return $blockContent;
		}

		$tags = new WP_HTML_Tag_Processor($blockContent);

		if ( ! $tags->next_tag() ) {
			return $blockContent;
		}

		$tags->set_attribute('data-wp-interactive', 'bifrost-player');
		$tags->set_attribute(
			'data-wp-context',
			wp_json_encode($trackData, JSON_HEX_TAG | JSON_HEX_AMP)
		);
		$tags->set_attribute('data-wp-on--click', 'actions.playTrack');
		$tags->set_attribute('style', 'cursor: pointer;');

		return $tags->get_updated_html();
	}

	/**
	 * Resolves track data (URL, title, artist, image) from an attachment ID.
	 *
	 * @return array{trackUrl: string, trackTitle: string, trackArtist: string, trackImage: string}|null
	 */
	private function resolveTrackData(int $attachmentId): ?array
	{
		$attachment = get_post($attachmentId);

		if ( ! $attachment instanceof WP_Post ) {
			return null;
		}

		$trackUrl = wp_get_attachment_url($attachmentId);

		if ( ! $trackUrl ) {
			return null;
		}

		$trackTitle  = $attachment->post_title ?: '';
		$trackArtist = '';
		$trackImage  = '';

		// Resolve artist and image from parent album.
		if ( ! empty($attachment->post_parent) ) {
			$album = get_post($attachment->post_parent);

			if (
				$album instanceof WP_Post
				&& class_exists(Definitions::class)
				&& $album->post_type === Definitions::POST_TYPE_ALBUM
			) {
				// Get artist from album's parent (artist post).
				if ( ! empty($album->post_parent) ) {
					$artist = get_post($album->post_parent);

					if ( $artist instanceof WP_Post ) {
						$trackArtist = $artist->post_title;
					}
				}

				// Get album artwork from featured image.
				$thumbnailId = get_post_thumbnail_id($album->ID);

				if ( $thumbnailId ) {
					$trackImage = wp_get_attachment_image_url($thumbnailId, 'medium') ?: '';
				}
			}
		}

		return array(
			'trackUrl'    => $trackUrl,
			'trackTitle'  => $trackTitle,
			'trackArtist' => $trackArtist,
			'trackImage'  => $trackImage,
		);
	}
}
