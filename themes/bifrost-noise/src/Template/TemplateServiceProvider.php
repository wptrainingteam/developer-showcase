<?php

/**
 * Template service provider.
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2023-2025, Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/x3p0-dev/bifrost-noise
 */

declare(strict_types=1);

namespace Bifrost\Noise\Template;

use Bifrost\Framework\Contracts\Bootable;
use Bifrost\Framework\Core\ServiceProvider;

final class TemplateServiceProvider extends ServiceProvider implements Bootable
{
	/**
	 * @inheritDoc
	 */
	public function boot(): void
	{
		$this->container->get(Hierarchy\Single::class)->boot();
	}
}
