<?php

/**
 * Query block render service.
 *
 * @author    Bifrost
 * @copyright Copyright (c) 2026, WordPress
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/wptrainingteam/developer-showcase
 */

declare(strict_types=1);

namespace Bifrost\Noise\Block\Render;

use Bifrost\Noise\Contracts\Bootable;
use WP_Block;

/**
 * Filters rendered output for the `core/query` block.
 */
final class RenderQuery implements Bootable
{
	/**
	 * @inheritDoc
	 */
	public function boot(): void
	{
		add_filter('pre_render_block', $this->preRender(...), 999, 2);
	}

	private function preRender(string|null $pre_render, array $parsed_block): string|null
	{
		// Determine if this is the custom block variation
		if (
			isset($parsed_block['attrs']['namespace']) &&
			'bifrost-noise/query-artist-albums' === $parsed_block['attrs']['namespace']
		) {
			add_filter(
				'query_loop_block_query_vars',
				function (array $query, object $block): array {
					$post_id = get_the_ID();

					if ($post_id && get_post_type($post_id) === 'music_artist') {
						$query['post_parent'] = $post_id;
					}

					return $query;
				},
				10,
				2
			);
		}

		return $pre_render;
	}
}
