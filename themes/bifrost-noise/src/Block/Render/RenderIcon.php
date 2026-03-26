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

use Bifrost\Framework\Contracts\Bootable;
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

	/**
	 * Adds block binding support to Nick Diego's Icon Block.
	 *
	 * @link https://github.com/ndiego/icon-block
	 */
	private function render(string $content, array $block, WP_Block $instance): string {
		$bindings = $block['attrs']['metadata']['bindings'] ?? [];

		if (empty($bindings['icon']['source']) || $bindings['icon']['source'] !== 'bifrost-music/post-type') {
			return $content;
		}

		$source = get_block_bindings_source($bindings['icon']['source']);

		if (! $source) {
			return $content;
		}

		$svg = $source->get_value($bindings['icon']['args'] ?? [], $instance, 'icon');

		if (! $svg) {
			return $content;
		}

		$start = strpos($content, '<svg');

		if ($start === false) {
			return $content;
		}

		$end    = strpos($content, '</svg>', $start) + strlen('</svg>');
		$before = substr($content, 0, $start);
		$after  = substr($content, $end);

		return $before . $svg . $after;
	}
}
