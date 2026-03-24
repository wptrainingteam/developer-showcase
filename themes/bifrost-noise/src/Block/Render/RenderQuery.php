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
use Bifrost\Framework\Contracts\Bootable;

/**
 * Filters rendered output for the `core/query` block.
 */
final class RenderQuery implements Bootable
{
	/**
	 * Variation namespace for querying an artist's albums.
	 */
	private const NAMESPACE_ARTIST_ALBUMS = 'bifrost-noise/query-artist-albums';

	/**
	 * Variation namespace for querying a post's album by metadata.
	 */
	private const NAMESPACE_POST_ALBUM = 'bifrost-noise/query-post-album';

	/**
	 * Variation namespace for querying a post's artist by metadata.
	 */
	private const NAMESPACE_POST_ARTIST   = 'bifrost-noise/query-post-artist';

	/**
	 * The hook to use when filtering query vars.
	 */
	private const HOOK = 'query_loop_block_query_vars';

	/**
	 * @inheritDoc
	 */
	public function boot(): void
	{
		add_filter('pre_render_block', $this->preRender(...), 999, 2);
		add_filter('render_block_core/query', $this->postRender(...), 10, 2);
	}

	/**
	 * Hooks into the pre-rendering cycle for the Query block and determines
	 * whether it has a specific namespace. If that namespace matches, we
	 * add a filter on `query_loop_block_query_vars` to modify the query.
	 */
	private function preRender(string|null $pre_render, array $parsed_block): string|null
	{
		$callback = $this->resolveCallback($parsed_block);

		if ($callback !== null) {
			add_filter(self::HOOK, $callback);
		}

		return $pre_render;
	}

	/**
	 * Hooks into the post-rendering cycle for the Query block and removes
	 * any `query_loop_block_query_vars` filter that was added during pre-render,
	 * preventing it from bleeding into subsequent Query blocks on the page.
	 */
	private function postRender(string $content, array $parsed_block): string
	{
		$callback = $this->resolveCallback($parsed_block);

		if ($callback !== null) {
			remove_filter(self::HOOK, $callback);
		}

		return $content;
	}

	/**
	 * Resolves the appropriate query vars callback for a given parsed block,
	 * based on its namespace attribute. Returns null if no match is found.
	 */
	private function resolveCallback(array $parsed_block): callable|null
	{
		$namespace = $parsed_block['attrs']['namespace'] ?? null;

		return match ($namespace) {
			self::NAMESPACE_ARTIST_ALBUMS => fn(array $query) => $this->artistAlbumsQueryVars($query),
			self::NAMESPACE_POST_ALBUM    => fn(array $query) => $this->postAlbumQueryVars($query),
			self::NAMESPACE_POST_ARTIST   => fn(array $query) => $this->postArtistQueryVars($query),
			default                       => null
		};
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
	private function postAlbumQueryVars(array $query): array
	{
		$postId  = get_the_ID();
		$albumId = $postId ? get_post_meta($postId, Definitions::POST_META_ALBUM, true) : null;

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
	private function postArtistQueryVars(array $query): array
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
