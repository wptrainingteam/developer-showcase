<?php

/**
 * Block registrar.
 *
 * @author    Bifrost
 * @copyright Copyright (c) 2026
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/wptrainingteam/developer-showcase
 */

declare(strict_types=1);

namespace Bifrost\Player\Block;

use Bifrost\Framework\Contracts\Bootable;

use const Bifrost\Player\PLUGIN_DIR;

/**
 * Registers block types and renders the persistent audio player in the footer.
 */
final class BlockRegistrar implements Bootable
{
	/**
	 * Boots the block registrar.
	 */
	public function boot(): void
	{
		add_action('init', $this->registerBlocks(...));
		add_action('wp_footer', $this->renderPlayer(...));
	}

	/**
	 * Registers the plugin's interactive blocks.
	 */
	private function registerBlocks(): void
	{
		register_block_type(PLUGIN_DIR . '/build/blocks/audio-player');
	}

	/**
	 * Renders the persistent audio player in the footer.
	 */
	private function renderPlayer(): void
	{
		echo wp_kses_post(do_blocks('<!-- wp:bifrost-player/audio-player /-->'));
	}
}
