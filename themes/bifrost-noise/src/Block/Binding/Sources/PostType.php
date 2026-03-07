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
use WP_Post_Type;
use WP_Query;
use WP_Term;

/**
 * Handles registering the `bifrost-music/post-type` block bindings source and rendering its
 * output based on the given arguments.
 */
final class PostType extends BindingSource
{
	protected const NAME = 'bifrost-music/post-type';

	private const ICONS = [
		'music_album' => '<svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-width="1.5"><path d="M2.384 13.793c-.447-3.164-.67-4.745.278-5.77C3.61 7 5.298 7 8.672 7h6.656c3.374 0 5.062 0 6.01 1.024s.724 2.605.278 5.769l-.422 3c-.35 2.48-.525 3.721-1.422 4.464s-2.22.743-4.867.743h-5.81c-2.646 0-3.97 0-4.867-.743s-1.072-1.983-1.422-4.464z"></path><path stroke-linecap="round" stroke-linejoin="round" d="M12 17a1.5 1.5 0 1 1-3 0a1.5 1.5 0 0 1 3 0m0 0v-6.5c0 1.657 1.895 3 3 3"></path><path d="M19.562 7a2.132 2.132 0 0 0-2.1-2.5H6.538a2.132 2.132 0 0 0-2.1 2.5M17.5 4.5c.028-.26.043-.389.043-.496a2 2 0 0 0-1.787-1.993C15.65 2 15.52 2 15.26 2H8.74c-.26 0-.391 0-.497.011a2 2 0 0 0-1.787 1.993c0 .107.014.237.043.496"></path></g></svg>',
		'music_artist' => '<svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="9" cy="6" r="4"></circle><path stroke-linecap="round" d="M15 9a3 3 0 1 0 0-6"></path><ellipse cx="9" cy="17" rx="7" ry="4"></ellipse><path stroke-linecap="round" d="M18 14c1.754.385 3 1.359 3 2.5c0 1.03-1.014 1.923-2.5 2.37"></path></g></svg>',
		'page'         => '<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368"><path d="M320-440h320v-80H320v80Zm0 120h320v-80H320v80Zm0 120h200v-80H320v80ZM240-80q-33 0-56.5-23.5T160-160v-640q0-33 23.5-56.5T240-880h320l240 240v480q0 33-23.5 56.5T720-80H240Zm280-520v-200H240v640h480v-440H520ZM240-800v200-200 640-640Z"/></svg>',
		'post'         => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true"><path d="m19 7-3-3-8.5 8.5-1 4 4-1L19 7Zm-7 11.5H5V20h7v-1.5Z"></path></svg>'
	];

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
	public function usesContext(): array
	{
		return ['postId'];
	}

	/**
	 * @inheritDoc
	 */
	public function callback(array $args, WP_Block $block, string $name): ?string
	{
		return match ($args['field'] ?? null) {
			'count'  => $this->renderCount($args, $block),
			'icon'   => $this->renderIcon($args, $block),
			'label'  => $this->renderLabel($args, $block),
			default  => null
		};
	}

	private function getType(array $args, WP_Block $block): ?WP_Post_Type
	{
		$postId = $block->context['postId'] ?? get_the_ID();

		return get_post_type_object($args['postType'] ?? get_post_type());
	}

	/**
	 * Returns a post type's published post count.
	 */
	private function renderCount(array $args, WP_Block $block): ?string
	{
		if (! $postTypeObject = $this->getType($args, $block)) {
			return null;
		}

		$count = wp_count_posts($postTypeObject->name);
		$total = (int)$count->publish;

		return sprintf(
			// Translators: 1: Number of posts, 2: Post type label (singular or plural)
			esc_html(_n('%1$s %2$s', '%1$s %2$s', $total, 'bifrost-noise')),
			number_format_i18n($total),
			$total === 1 ? $postTypeObject->labels->singular_name : $postTypeObject->labels->name
		);
	}

	/**
	 * Returns the post type label.
	 */
	private function renderLabel(array $args, WP_Block $block): ?string
	{
		if (! $postTypeObject = $this->getType($args, $block)) {
			return null;
		}

		$labelType = $args['label'] ?? 'singular_name';

		return $postTypeObject->labels->$labelType ?? null;
	}

	/**
	 * Returns the post type label.
	 */
	private function renderIcon(array $args, WP_Block $block): ?string
	{
		if (! $postTypeObject = $this->getType($args, $block)) {
			return null;
		}

		return self::ICONS[$postTypeObject->name] ?? self::ICONS['page'];
	}
}
