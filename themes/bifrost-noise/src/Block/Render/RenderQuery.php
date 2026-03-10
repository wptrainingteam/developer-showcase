<?php

/**
 * Query block render service.
 *
 * @author    Bifrost
 * @copyright Copyright (c) 2026, WordPress
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/wptrainingteam/developer-showcase
 */

declare(strict_types=1);

namespace Bifrost\Noise\Block\Render;

use Bifrost\Music\Support\Definitions;
use Bifrost\Noise\Contracts\Bootable;

/**
 * Filters rendered output for the `core/query` block.
 */
final class RenderQuery implements Bootable
{
	private const NAMESPACE_ARTIST_ALBUMS = 'bifrost-noise/query-artist-albums';
	private const NAMESPACE_POST_ALBUM   = 'bifrost-noise/query-post-album';
	private const NAMESPACE_POST_ARTIST   = 'bifrost-noise/query-post-artist';

	/**
	 * @inheritDoc
	 */
	public function boot(): void
	{
		add_filter('pre_render_block', $this->preRender(...), 999, 2);
	}

	/**
	 * Hooks into the pre-rending cycle for the Query block and determines
	 * whether it has a specific namespace. If that namespace matches, we
	 * run a filter on `query_loop_block_query_vars` to change the query.
	 */
	private function preRender(string|null $pre_render, array $parsed_block): string|null
	{
		$namespace = $parsed_block['attrs']['namespace'] ?? null;
		$hook      = 'query_loop_block_query_vars';

		match ($namespace) {
			self::NAMESPACE_ARTIST_ALBUMS => add_filter($hook, $this->artistAlbumsQueryVars(...)),
			self::NAMESPACE_POST_ALBUM    => add_filter($hook, $this->postAlbumQuery(...)),
			self::NAMESPACE_POST_ARTIST   => add_filter($hook, $this->postArtistQuery(...)),
			default                       => null
		};

		return $pre_render;
	}

	/**
	 * Queries albums based on the current artist ID. An album's parent post
	 * is stored as an artist post ID.
	 */
	private function artistAlbumsQueryVars(array $query): array
	{
		$postId = get_the_ID();

		if ($postId && get_post_type($postId) === Definitions::POST_TYPE_ARTIST) {
			$query['post_parent'] = $postId;
		}

		return $query;
	}

	/**
	 * Queries an album associated with the current blog post, which is
	 * stored under the `music_album` meta key.
	 */
	private function postAlbumQuery(array $query): array
	{
		$postId   = get_the_ID();
		$albumId  = $postId ? get_post_meta($postId, Definitions::POST_META_ALBUM, true) : null;

		if ($albumId) {
			$query['post_type'] = Definitions::POST_TYPE_ALBUM;
			$query['post__in']  = [absint($albumId)];
		}

		return $query;
	}

	/**
	 * Queries an artist associated with the current blog post, which is
	 * stored under the `music_artist` meta key.
	 */
	private function postArtistQuery(array $query): array
	{
		$postId   = get_the_ID();
		$artistId = $postId ? get_post_meta($postId, Definitions::POST_META_ARTIST, true) : null;

		if ($artistId) {
			$query['post_type'] = Definitions::POST_TYPE_ARTIST;
			$query['post__in']  = [absint($artistId)];
		}

		return $query;
	}
}
