<?php

/**
 * Block bindings service provider.
 *
 * @author    Bifrost
 * @copyright Copyright (c) 2026, WordPress
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/wptrainingteam/developer-showcase
 */

declare(strict_types=1);

namespace Bifrost\Noise\Block\Binding;

use Bifrost\Noise\Contracts\Bootable;
use Bifrost\Noise\Core\ServiceProvider;

final class BindingServiceProvider extends ServiceProvider implements Bootable
{
	/**
	 * Array of block binding source classnames.
	 */
	private const SOURCES = [
		Sources\Album::class
	];

	/**
	 * @inheritDoc
	 */
	public function register(): void
	{
		$this->container->singleton(
			BindingSourceRegistrar::class,
			fn() => new BindingSourceRegistrar(self::SOURCES)
		);
	}

	/**
	 * @inheritDoc
	 */
	public function boot(): void
	{
		$this->container->get(BindingSourceRegistrar::class)->boot();
	}
}
