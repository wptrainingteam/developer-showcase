<?php

/**
 * Experimental Gutenberg blocks.
 *
 * @author    Bifrost
 * @copyright Copyright (c) 2026, WordPress
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/wptrainingteam/developer-showcase
 */

declare(strict_types=1);

namespace Bifrost\Noise\Gutenberg;

use Bifrost\Framework\Contracts\Bootable;

/**
 * Handles filtering Gutenberg experiments.
 */
final class GutenbergExperiments implements Bootable
{
	/**
	 * Which gutenberg experimental options to enable/disable.
	 */
	private const OPTIONS = [
		'gutenberg-block-experiments' => 'true'
	];

	/**
	 * @inheritDoc
	 */
	public function boot(): void
	{
		add_filter('option_gutenberg-experiments', $this->experimentalOptions(...), 999999);
	}

	/**
	 * Overwrites Gutenberg experimental options.
	 */
	private function experimentalOptions(mixed $experiments): array
	{
		if (! is_array($experiments)) {
			$experiments = [];
		}

		return array_merge($experiments, self::OPTIONS);
	}
}
