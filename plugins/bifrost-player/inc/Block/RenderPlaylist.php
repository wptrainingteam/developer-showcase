<?php

/**
 * Playlist block render filter.
 *
 * Injects a bridge callback on core/playlist blocks so that clicking
 * the waveform play button or a track in the playlist triggers the
 * persistent audio player.
 *
 * @author    Bifrost
 * @copyright Copyright (c) 2026
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/wptrainingteam/developer-showcase
 */

declare( strict_types=1 );

namespace Bifrost\Player\Block;

use Bifrost\Player\Contracts\Bootable;
use WP_HTML_Tag_Processor;

/**
 * Filters the rendered output of core/playlist to inject a
 * data-wp-init callback that bridges waveform player events
 * to the persistent bifrost-player store.
 */
final class RenderPlaylist implements Bootable {

	private const BLOCK_NAME = 'core/playlist';

	/**
	 * Registers the WordPress filter hooks.
	 */
	public function boot(): void {
		add_filter( 'render_block', $this->renderBlock( ... ), 10, 2 );
	}

	/**
	 * Injects the playlist bridge init callback on the playlist wrapper.
	 */
	private function renderBlock( string $blockContent, array $block ): string {
		if ( ( $block['blockName'] ?? '' ) !== self::BLOCK_NAME ) {
			return $blockContent;
		}

		$tags = new WP_HTML_Tag_Processor( $blockContent );

		if ( ! $tags->next_tag( 'figure' ) ) {
			return $blockContent;
		}

		$tags->set_attribute(
			'data-wp-init',
			'bifrost-player::callbacks.initPlaylistBridge'
		);

		return $tags->get_updated_html();
	}
}
