<?php

/**
 * Block stylesheet service provider.
 *
 * @author    Bifrost
 * @copyright Copyright (c) 2026, WordPress
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/wptrainingteam/developer-showcase
 */

declare(strict_types=1);

namespace Bifrost\Noise\Block\Stylesheet;

use Bifrost\Noise\Contracts\Bootable;
use Bifrost\Noise\Core\ServiceProvider;

class StylesheetServiceProvider extends ServiceProvider implements Bootable
{
	private const STYLESHEETS_PATH = 'public/css/blocks';

	/**
	 * @inheritDoc
	 */
	public function register(): void
	{
		$this->container->singleton(
			StylesheetIterator::class,
			fn() => new StylesheetIterator(self::STYLESHEETS_PATH)
		);
	}

	/**
	 * @inheritDoc
	 */
	public function boot(): void
	{
		$this->container->get(StylesheetLoader::class)->boot();
	}
}
