<?php

/**
 * Play button render filter.
 *
 * Enhances the primary core/button on album pages with Interactivity API
 * directives so clicking it loads the track in the persistent audio player.
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
 * Filters core/button blocks on album pages to add play-button behaviour.
 *
 * The primary (non-outline) button on a music_album page is enhanced with
 * Interactivity API directives so clicking it loads the track in the
 * persistent audio player. Track data is resolved from the current post's
 * first audio attachment.
 */
final class RenderPlayButton implements Bootable
{
	/**
	 * Registers the WordPress filter hooks.
	 */
	public function boot(): void
	{
		add_filter('render_block_core/button', $this->renderBlock(...), 10, 2);
	}

	/**
	 * Injects iAPI directives on the primary button when on an album page.
	 */
	private function renderBlock(string $blockContent, array $block): string
	{
		// Only enhance on album pages.
		if ( ! class_exists(Definitions::class) || get_post_type() !== Definitions::POST_TYPE_ALBUM ) {
			return $blockContent;
		}

		// Only enhance the play-album button.
		$className = $block['attrs']['className'] ?? '';
		if ( ! str_contains($className, 'play-album') ) {
			return $blockContent;
		}

		$trackData = $this->resolveTrackData();

		if ( $trackData === null ) {
			return $blockContent;
		}

		$tags = new WP_HTML_Tag_Processor($blockContent);

		// Add context and interactive namespace to the wrapper div.
		if ( ! $tags->next_tag('div') ) {
			return $blockContent;
		}

		$tags->set_attribute('data-wp-interactive', 'bifrost-player');
		$tags->set_attribute(
			'data-wp-context',
			wp_json_encode($trackData, JSON_HEX_TAG | JSON_HEX_AMP)
		);

		// Add click handler to the <a> tag.
		if ( ! $tags->next_tag('a') ) {
			return $blockContent;
		}

		$tags->set_attribute('data-wp-on--click', 'actions.playTrack');

		return $tags->get_updated_html();
	}

	/**
	 * Resolves track data from the current post's first audio attachment.
	 *
	 * @return array{trackUrl: string, trackTitle: string, trackArtist: string, trackImage: string}|null
	 */
	private function resolveTrackData(): ?array
	{
		$postId = get_the_ID();

		if ( ! $postId ) {
			return null;
		}

		$attachments = get_children(
			array(
				'post_parent'    => $postId,
				'post_type'      => 'attachment',
				'post_mime_type' => 'audio',
				'posts_per_page' => 1,
				'orderby'        => 'menu_order',
				'order'          => 'ASC',
			)
		);

		if ( empty($attachments) ) {
			return null;
		}

		$attachment = reset($attachments);
		$trackUrl   = wp_get_attachment_url($attachment->ID);

		if ( ! $trackUrl ) {
			return null;
		}

		$trackTitle  = $attachment->post_title ?: get_the_title($postId);
		$trackArtist = '';
		$trackImage  = '';

		// Resolve artist from parent (album → artist post).
		$post = get_post($postId);

		if ( $post instanceof WP_Post && ! empty($post->post_parent) ) {
			$artist = get_post($post->post_parent);

			if ( $artist instanceof WP_Post ) {
				$trackArtist = $artist->post_title;
			}
		}

		// Resolve album art from featured image.
		$thumbnailId = get_post_thumbnail_id($postId);

		if ( $thumbnailId ) {
			$trackImage = wp_get_attachment_image_url($thumbnailId, 'medium') ?: '';
		}

		return array(
			'trackUrl'    => $trackUrl,
			'trackTitle'  => $trackTitle,
			'trackArtist' => $trackArtist,
			'trackImage'  => $trackImage,
		);
	}
}
