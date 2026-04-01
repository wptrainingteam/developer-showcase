<?php

/**
 * Template Part block renderer.
 *
 * @author    Bifrost
 * @copyright Copyright (c) 2026, WordPress
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/wptrainingteam/developer-showcase
 */

declare(strict_types=1);

namespace Bifrost\Noise\Block\Render;

use Bifrost\Framework\Contracts\Bootable;
use WP_Post;

/**
 * Filters the `core/template-part` block data to swap the sidebar template
 * part with a category-specific variant on single posts.
 */
final class RenderTemplatePart implements Bootable
{
	private const BLOCK_NAME   = 'core/template-part';
	private const SIDEBAR_SLUG = 'sidebar-post';

	/**
	 * Registers the WordPress filter hooks.
	 */
	public function boot(): void
	{
		add_filter('render_block_data', $this->renderBlockData(...));
	}

	/**
	 * Replaces the sidebar template part slug with a category-specific
	 * variant when one exists in the theme's parts directory.
	 */
	private function renderBlockData(array $parsedBlock): array
	{
		if (
			($parsedBlock['blockName'] ?? '') !== self::BLOCK_NAME
			|| ($parsedBlock['attrs']['slug'] ?? '') !== self::SIDEBAR_SLUG
			|| ! is_singular('post')
		) {
			return $parsedBlock;
		}

		$post = get_queried_object();

		if (! $post instanceof WP_Post) {
			return $parsedBlock;
		}

		$partsDir = get_block_theme_folders()['wp_template_part'];

		foreach (get_the_category($post->ID) as $category) {
			$slug = self::SIDEBAR_SLUG . '-' . $category->slug;

			if (locate_template("{$partsDir}/{$slug}.html")) {
				$parsedBlock['attrs']['slug'] = $slug;
				return $parsedBlock;
			}
		}

		return $parsedBlock;
	}
}
