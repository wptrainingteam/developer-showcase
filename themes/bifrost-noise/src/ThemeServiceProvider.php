<?php

/**
 * Theme service provider.
 *
 * @author    Bifrost
 * @copyright Copyright (c) 2026, WordPress
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/wptrainingteam/developer-showcase
 */

declare(strict_types=1);

namespace Bifrost\Noise;

use Bifrost\Noise\Contracts\Bootable;
use Bifrost\Noise\Core\ServiceProvider;

final class ThemeServiceProvider extends ServiceProvider implements Bootable
{
	/**
	 * @inheritDoc
	 */
	public function boot(): void
	{
		$this->container->get(ThemeSetup::class)->boot();
	}
}
