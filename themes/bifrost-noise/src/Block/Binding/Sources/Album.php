<?php

/**
 * Album data binding class.
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
 * Handles registering the `bifrost-music/album` block bindings source and
 * rendering its output based on the given arguments.
 */
final class Album extends BindingSource
{
	protected const NAME = 'bifrost-music/album';

	/**
	 * Stores the post ID.
	 */
	private int $postId = 0;

	/**
	 * @inheritDoc
	 */
	public function getLabel(): string
	{
		return __('Album Data', 'bifrost-noise');
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
		$this->postId = $block->context['postId'] ?? get_the_ID();

		return match ($args['key'] ?? null) {
			'artist' => $this->renderArtist($args),
			default  => null
		};
	}

	/**
	 * Returns a post's reading time.
	 */
	private function renderArtist(array $args): ?string
	{
		if (
			! has_post_parent($this->postId)
			|| ! $parent = get_post_parent($this->postId)
		) {
			return null;
		}

		return sprintf(
			'<a href="%s">%s</a>',
			get_permalink($parent->ID),
			get_the_title($parent->ID)
		);
	}
}
