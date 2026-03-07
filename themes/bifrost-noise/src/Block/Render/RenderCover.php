<?php

/**
 * Cover block renderer.
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
use WP_HTML_Tag_Processor;

/**
 * Filters rendered output for the `core/cover` block.
 */
final class RenderCover implements Bootable
{
	/**
	 * @inheritDoc
	 */
	public function boot(): void
	{
		add_filter('render_block_core/cover', $this->render(...), 10, 3);
	}

	private function render(string $block_content, array $block, WP_Block $block_instance): string {
		$bindings = $block['attrs']['metadata']['bindings'] ?? [];

		if (empty($bindings['url']['source']) || $bindings['url']['source'] !== 'bifrost-music/term') {
			return $block_content;
		}

		$source = get_block_bindings_source($bindings['url']['source']);

		if (! $source) {
			return $block_content;
		}

		$url = $source->get_value($bindings['url']['args'] ?? [], $block_instance, 'url');

		if (! $url) {
			return $block_content;
		}

		$processor = new WP_HTML_Tag_Processor($block_content);

		while ($processor->next_tag([ 'class_name' => 'wp-block-cover__image-background' ])) {
			$style = $processor->get_attribute('style');
			$style = preg_replace(
				'/background-image:url\([^)]*\)/',
				'background-image:url(' . esc_url($url) . ')',
				$style
			);
			$processor->set_attribute('style', $style);
		}

		return $processor->get_updated_html();
	}
}
