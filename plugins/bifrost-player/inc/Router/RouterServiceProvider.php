<?php

/**
 * Router service provider.
 *
 * @author    Bifrost
 * @copyright Copyright (c) 2026
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/wptrainingteam/developer-showcase
 */

declare(strict_types=1);

namespace Bifrost\Player\Router;

use Bifrost\Player\Contracts\Bootable;
use Bifrost\Player\Core\ServiceProvider;

/**
 * Boots the interactive router for client-side navigation.
 */
final class RouterServiceProvider extends ServiceProvider implements Bootable
{
	/**
	 * Boots the router service provider.
	 */
	public function boot(): void
	{
		$this->container->get(InteractiveRouter::class)->boot();
	}
}
