<?php

/**
 * Playlist block render filter.
 *
 * Hides the core/playlist waveform player so that track clicks
 * go directly to the persistent audio player (via RenderPlaylistTrack).
 *
 * @author    Bifrost
 * @copyright Copyright (c) 2026
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/wptrainingteam/developer-showcase
 */

declare(strict_types=1);

namespace Bifrost\Player\Block;

use Bifrost\Framework\Contracts\Bootable;
use WP_HTML_Tag_Processor;

/**
 * Filters the rendered output of core/playlist to hide the waveform
 * player. Playback is handled by the persistent bifrost-player instead.
 */
final class RenderPlaylist implements Bootable
{
	private const BLOCK_NAME = 'core/playlist';

	/**
	 * Registers the WordPress filter hooks.
	 */
	public function boot(): void
	{
		add_filter('render_block', $this->renderBlock(...), 10, 2);
	}

	/**
	 * Hides the waveform player inside core/playlist.
	 */
	private function renderBlock(string $blockContent, array $block): string
	{
		if ( ( $block['blockName'] ?? '' ) !== self::BLOCK_NAME ) {
			return $blockContent;
		}

		$tags = new WP_HTML_Tag_Processor($blockContent);

		// Find the waveform player container and hide it.
		while ( $tags->next_tag('div') ) {
			$class = $tags->get_attribute('class') ?? '';

			if ( str_contains($class, 'wp-block-playlist__waveform-player') ) {
				$tags->set_attribute('hidden', true);
				$tags->set_attribute('style', 'display:none');
				break;
			}
		}

		return $tags->get_updated_html();
	}
}
