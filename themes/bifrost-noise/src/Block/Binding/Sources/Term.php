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
use WP_Query;
use WP_Term;

/**
 * Handles registering the `bifrost-music/term` block bindings source and rendering its
 * output based on the given arguments.
 */
final class Term extends BindingSource
{
	protected const NAME = 'bifrost-music/term';

	private const DEFAULT_IMAGES = [
		'category'                  => 'category.png',
		'category-artist-spotlight' => 'category-artist-spotlight.png',
		'category-editorial'        => 'category-editorial.png',
		'category-reviews'          => 'category-reviews.png',
		'genre'                     => 'genre.png',
		'genre-dream-pop'           => 'genre-dream-pop.png',
		'genre-hip-hop'             => 'genre-hip-hop.png',
		'genre-neo-shoegaze'        => 'genre-neo-shoegaze.png',
		'genre-outlaw-country'      => 'genre-outlaw-country.png',
		'genre-punk'                => 'genre-punk.png',
		'genre-synth-pop'           => 'genre-synth-pop.png',
		'tag'                       => 'tag.png'
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

		$postTypeObject = get_post_type_object(get_taxonomy($term->taxonomy)->object_type[0]);

		if (! $postTypeObject) {
			return null;
		}

		$total = $term->count;

		return sprintf(
			// Translators: 1: Number of posts, 2: Post type label (singular or plural)
			esc_html(_n('%1$s %2$s', '%1$s %2$s', $total, 'bifrost-noise')),
			number_format_i18n($total),
			$total === 1 ? $postTypeObject->labels->singular_name : $postTypeObject->labels->name
		);
	}

	/**
	 * Returns a term's featured image URL.
	 */
	private function renderImage(array $args): ?string
	{
		if (! $term = $this->getTerm($args)) {
			return null;
		}

		$tax = str_replace(['post_', 'music_'], '', $term->taxonomy);

		if ($imageId = get_term_meta($term->term_id, 'featured_image', true)) {
			return esc_url(wp_get_attachment_image_url($imageId, 'full'));
		}

		foreach (["{$tax}-{$term->slug}", $tax] as $key) {
			if (isset(self::DEFAULT_IMAGES[$key])) {
				return esc_url(get_theme_file_uri('public/media/images/archive/' . self::DEFAULT_IMAGES[$key]));
			}
		}

		return null;
	}
}
