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
			default  => null
		};
	}

	/**
	 * Returns a term's published post count.
	 */
	private function renderCount(array $args): ?string
	{
		$term = isset($args['term'], $args['taxonomy'])
			? get_term_by('slug', $args['term'], $args['taxonomy'])
			: get_queried_object();

		if (! $term instanceof WP_Term) {
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
			'<strong>' . number_format_i18n($total) . '</strong>',
			$total === 1 ? $postTypeObject->labels->singular_name : $postTypeObject->labels->name
		);
	}
}
