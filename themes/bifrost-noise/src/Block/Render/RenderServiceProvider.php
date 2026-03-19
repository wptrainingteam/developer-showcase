<?php

/**
 * Block render service provider.
 *
 * @author    Bifrost
 * @copyright Copyright (c) 2026, WordPress
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/wptrainingteam/developer-showcase
 */

declare(strict_types=1);

namespace Bifrost\Noise\Block\Render;

use Bifrost\Framework\Contracts\Bootable;
use Bifrost\Framework\Core\ServiceProvider;

final class RenderServiceProvider extends ServiceProvider implements Bootable
{
	/**
	 * Classes that hook into specific block's rendering process.
	 */
	private const RENDERERS = [
		RenderCover::class,
		RenderIcon::class,
		RenderPlaylistTrack::class,
		RenderQuery::class
	];

	/**
	 * @inheritDoc
	 */
	public function boot(): void
	{
		foreach (self::RENDERERS as $renderer) {
			$this->container->get($renderer)->boot();
		}
	}
}
