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

use Bifrost\Framework\Contracts\Bootable;
use Bifrost\Framework\Core\ServiceProvider;

/**
 * Registers block-related services and boots them.
 */
final class BlockServiceProvider extends ServiceProvider implements Bootable
{
	/**
	 * Boots the block service provider.
	 */
	public function boot(): void
	{
		$this->container->get(BlockRegistrar::class)->boot();
		$this->container->get(RenderPlayButton::class)->boot();
		$this->container->get(RenderPlaylist::class)->boot();
		$this->container->get(RenderPlaylistTrack::class)->boot();
	}
}
