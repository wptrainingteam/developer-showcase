<?php

/**
 * Block service provider.
 *
 * @author    Bifrost
 * @copyright Copyright (c) 2026
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/wptrainingteam/developer-showcase
 */

declare(strict_types=1);

namespace Bifrost\Player\Block;

use Bifrost\Player\Contracts\Bootable;
use Bifrost\Player\Core\ServiceProvider;

use const Bifrost\Player\PLUGIN_DIR;

/**
 * Registers interactive blocks and the playlist track render filter.
 */
final class BlockServiceProvider extends ServiceProvider implements Bootable {

	/**
	 * Boots the block service provider.
	 */
	public function boot(): void {
		add_action( 'init', $this->registerBlocks( ... ) );
		add_action( 'wp_footer', $this->renderPlayer( ... ) );

		$this->container->get( RenderPlaylist::class )->boot();
	}

	/**
	 * Registers the plugin's interactive blocks.
	 */
	private function registerBlocks(): void {
		register_block_type( PLUGIN_DIR . '/build/blocks/audio-player' );
		register_block_type( PLUGIN_DIR . '/build/blocks/play-button' );
	}

	/**
	 * Renders the persistent audio player in the footer.
	 */
	private function renderPlayer(): void {
		echo do_blocks( '<!-- wp:bifrost-player/audio-player /-->' );
	}
}
