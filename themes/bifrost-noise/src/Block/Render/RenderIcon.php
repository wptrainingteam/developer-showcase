<?php

/**
 * Icon block renderer.
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
 * Filters rendered output for the `outermost/icon-block` block.
 */
final class RenderIcon implements Bootable
{
	/**
	 * @inheritDoc
	 */
	public function boot(): void
	{
		add_filter('render_block_outermost/icon-block', $this->render(...), 10, 3);
	}

	private function render(string $block_content, array $block, WP_Block $block_instance): string {
		$bindings = $block['attrs']['metadata']['bindings'] ?? [];

		if (empty($bindings['icon']['source']) || $bindings['icon']['source'] !== 'bifrost-music/post-type') {
			return $block_content;
		}

		$source = get_block_bindings_source($bindings['icon']['source']);

		if (! $source) {
			return $block_content;
		}

		$svg = $source->get_value($bindings['icon']['args'] ?? [], $block_instance, 'icon');

		if (! $svg) {
			return $block_content;
		}

		$start = strpos($block_content, '<svg');

		if ($start === false) {
			return $block_content;
		}

		$end = strpos($block_content, '</svg>', $start) + strlen('</svg>');
		$before = substr($block_content, 0, $start);
		$after = substr($block_content, $end);

		return $before . $svg . $after;
	}
}
