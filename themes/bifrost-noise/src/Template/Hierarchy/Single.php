<?php

/**
 * Single post template hierarchy.
 *
 * @author    Bifrost
 * @copyright Copyright (c) 2026, WordPress
 * @license   https://www.gnu.org/licenses/gpl-3.0 GPL-3.0-or-later
 * @link      https://github.com/wptrainingteam/developer-showcase
 */

declare(strict_types=1);

namespace Bifrost\Noise\Template\Hierarchy;

use Bifrost\Framework\Contracts\Bootable;
use WP_Post;

/**
 * Replaces the single-post template hierarchy with category-aware candidates.
 */
class Single implements Bootable
{
	/**
	 * @inheritDoc
	 */
	public function boot(): void
	{
		add_filter('single_template_hierarchy', $this->hierarchy(...));
	}

	/**
	 * Replaces the template hierarchy, allowing for category-specific
	 * templates.
	 */
	private function hierarchy(array $templates): array
	{
		$post = get_queried_object();

		if (! $post instanceof WP_Post || 'post' !== $post->post_type) {
			return $templates;
		}

		$categories = get_the_category($post->ID);

		if (empty($categories)) {
			return $templates;
		}

		$hierarchy = [];
		$custom    = get_page_template_slug($post);
		$name      = urldecode($post->post_name);

		// Custom template selected wins out.
		if ($custom && 0 === validate_file($custom)) {
			$hierarchy[] = $custom;
		}

		// Post-specific slug template takes priority over category templates.
		$hierarchy[] = sprintf('single-post-%s', $name);

		// Category-specific templates.
		foreach ($categories as $category) {
			$hierarchy[] = sprintf('single-post-%s', $category->slug);
		}

		// Standard fallbacks.
		$hierarchy[] = 'single-post';
		$hierarchy[] = 'single';
		$hierarchy[] = 'singular';
		$hierarchy[] = 'index';

		return $hierarchy;
	}
}
