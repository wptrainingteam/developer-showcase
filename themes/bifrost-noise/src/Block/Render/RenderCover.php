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

use Bifrost\Framework\Contracts\Bootable;
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

	/**
	 * Adds block binding support to the Cover block so that it uses the
	 * available source for the background image. Kind of a hacky
	 * implementation until Core officially supports it.
	 *
	 * @link https://github.com/WordPress/gutenberg/issues/63763
	 */
	private function render(string $content, array $block, WP_Block $instance): string {
		$bindings = $block['attrs']['metadata']['bindings'] ?? [];

		if (empty($bindings['url']['source']) || $bindings['url']['source'] !== 'bifrost-music/term') {
			return $content;
		}

		$source = get_block_bindings_source($bindings['url']['source']);

		if (! $source) {
			return $content;
		}

		$url = $source->get_value($bindings['url']['args'] ?? [], $instance, 'url');

		if (! $url) {
			return $content;
		}

		$processor = new WP_HTML_Tag_Processor($content);

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
