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
		$count = wp_count_posts($args['postType'] ?? 'post');

		return number_format_i18n((int) $count->publish);
	}
}
