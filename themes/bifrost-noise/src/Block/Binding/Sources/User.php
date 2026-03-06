<?php

/**
 * User data binding class.
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
 * Handles registering the `bifrost-music/user` block bindings source and
 * rendering its output based on the given arguments.
 */
final class User extends BindingSource
{
	protected const NAME = 'bifrost-music/user';

	/**
	 * @inheritDoc
	 */
	public function getLabel(): string
	{
		return __('User Data', 'bifrost-noise');
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
		$userId         = $args['userId'] ?? 0;
		$postType       = $args['postType'] ?? 'post';
		$postTypeObject = get_post_type_object($postType);

		if ($userId === 0) {
			$author = get_query_var('author_name')
				? get_user_by('slug', get_query_var('author_name'))
				: get_userdata(get_query_var('author'));

			$userId = $author->ID ?? 0;
		}

		if ($postTypeObject === null || absint($userId) === 0) {
			return null;
		}

		$total = absint(count_user_posts(absint($userId), $postType));

		$label = $total === 1
			? $postTypeObject->labels->singular_name
			: $postTypeObject->labels->name;

		return sprintf(
			// Translators: 1: Number of posts, 2: Post type label (singular or plural)
			esc_html(_n('%1$s %2$s', '%1$s %2$s', $total, 'bifrost-noise')),
			number_format_i18n($total),
			$label
		);
	}
}
