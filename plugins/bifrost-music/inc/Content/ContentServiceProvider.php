<?php

/**
 * Content service provider.
 *
 * @author    Bifrost
 * @copyright Copyright (c) 2026
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/wptrainingteam/developer-showcase
 */

declare(strict_types=1);

namespace Bifrost\Music\Content;

use Bifrost\Framework\Contracts\Bootable;
use Bifrost\Framework\Core\ServiceProvider;

final class ContentServiceProvider extends ServiceProvider implements Bootable
{
	/**
	 * @inheritDoc
	 */
	public function boot(): void
	{
		$this->container->get(Album::class)->boot();
		$this->container->get(Artist::class)->boot();
		$this->container->get(Genre::class)->boot();
		$this->container->get(Post::class)->boot();
	}
}
