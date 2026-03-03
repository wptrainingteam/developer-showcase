<?php

/**
 * Post Type data binding class.
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
 * Handles registering the `bifrost-music/post-type` block bindings source and rendering its
 * output based on the given arguments.
 */
final class PostType extends BindingSource
{
	protected const NAME = 'bifrost-music/post-type';

	/**
	 * @inheritDoc
	 */
	public function getLabel(): string
	{
		return __('Post Type Data', 'bifrost-noise');
	}

	/**
	 * @inheritDoc
	 */
	public function callback(array $args, WP_Block $block, string $name): ?string
	{
		return match ($args['field'] ?? null) {
			'count' => $this->renderCount($args),
			default  => null
		};
	}

	/**
	 * Returns a post type's published post count.
	 */
	private function renderCount(array $args): ?string
	{
		$postType = $args['postType'] ?? 'post';
		$postTypeObject = get_post_type_object($postType);

		if ($postTypeObject === null) {
			return null;
		}

		$count = wp_count_posts($postType);
		$total = (int)$count->publish;

		return sprintf(
			// Translators: 1: Number of posts, 2: Post type label (singular or plural)
			esc_html(_n('%1$s %2$s', '%1$s %2$s', $total, 'bifrost-noise')),
			number_format_i18n($total),
			$total === 1 ? $postTypeObject->labels->singular_name : $postTypeObject->labels->name
		);
	}
}
