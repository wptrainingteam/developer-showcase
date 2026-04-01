<?php

/**
 * Search data binding class.
 *
 * @author    Bifrost
 * @copyright Copyright (c) 2026, WordPress
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/wptrainingteam/developer-showcase
 */

declare(strict_types=1);

namespace Bifrost\Noise\Block\Binding\Sources;

use WP_Block;
use Bifrost\Noise\Block\Binding\BindingSource;
use WP_Query;
use WP_Term;

/**
 * Handles registering the `bifrost-music/query` block bindings source and
 * rendering its output based on the given arguments.
 */
final class Query extends BindingSource
{
	protected const NAME = 'bifrost-music/query';

	/**
	 * @inheritDoc
	 */
	public function getLabel(): string
	{
		return __('Query Data', 'bifrost-noise');
	}

	/**
	 * @inheritDoc
	 */
	public function callback(array $args, WP_Block $block, string $name): ?string
	{
		return match ($args['field'] ?? null) {
			'count' => $this->renderCount(),
			default  => null
		};
	}

	/**
	 * Returns the search results count.
	 */
	private function renderCount(): ?string
	{
		$total = absint($GLOBALS['wp_query']->found_posts);

		return sprintf(
			// Translators: 1: Number of found posts for a query.
			esc_html(_n('%1$s Result', '%1$s Results', $total, 'bifrost-noise')),
			number_format_i18n($total)
		);
	}
}
