<?php

/**
 * Term data binding class.
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
use WP_Term;

/**
 * Handles registering the `bifrost-music/term` block bindings source and
 * rendering its output based on the given arguments.
 */
final class Term extends BindingSource
{
	protected const NAME = 'bifrost-music/term';

	private const DEFAULT_IMAGES = [
		'category'    => 'public/media/images/archive/category.webp',
		'music_genre' => 'public/media/images/archive/genre.webp',
		'post_tag'    => 'public/media/images/archive/tag.webp'
	];

	/**
	 * @inheritDoc
	 */
	public function getLabel(): string
	{
		return __('Term Data', 'bifrost-noise');
	}

	/**
	 * @inheritDoc
	 */
	public function callback(array $args, WP_Block $block, string $name): ?string
	{
		return match ($args['field'] ?? null) {
			'count' => $this->renderCount($args),
			'image' => $this->renderImage($args),
			default  => null
		};
	}

	/**
	 * Helper function for getting the term object.
	 */
	private function getTerm(array $args): ?WP_Term
	{
		$term = isset($args['term'], $args['taxonomy'])
			? get_term_by('slug', $args['term'], $args['taxonomy'])
			: get_queried_object();

		return $term instanceof WP_Term ? $term : null;
	}

	/**
	 * Returns a term's published post count.
	 */
	private function renderCount(array $args): ?string
	{
		if (! $term = $this->getTerm($args)) {
			return null;
		}

		$postType = get_post_type_object(get_taxonomy($term->taxonomy)->object_type[0]);

		if (! $postType) {
			return null;
		}

		$total = $term->count;

		return sprintf(
			// Translators: 1: Number of posts, 2: Post type label (singular or plural)
			esc_html(_n('%1$s %2$s', '%1$s %2$s', $total, 'bifrost-noise')),
			number_format_i18n($total),
			$total === 1 ? $postType->labels->singular_name : $postType->labels->name
		);
	}

	/**
	 * Returns a term's featured image URL. This integrates with the WP Term
	 * Images plugin and relies on the `image` meta key to find an image.
	 *
	 * @link https://wordpress.org/plugins/wp-term-images/
	 */
	private function renderImage(array $args): ?string
	{
		if (! $term = $this->getTerm($args)) {
			return null;
		}

		if ($imageId = get_term_meta($term->term_id, 'image', true)) {
			return esc_url(wp_get_attachment_image_url($imageId, 'full'));
		}

		if (isset(self::DEFAULT_IMAGES[$term->taxonomy])) {
			return esc_url(get_theme_file_uri(self::DEFAULT_IMAGES[$term->taxonomy]));
		}

		return null;
	}
}
