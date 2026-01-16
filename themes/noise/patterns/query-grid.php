<?php

/**
 * Title: Post Grid
 * Slug: developer-showcase-noise/query-grid
 * Description: Displays a grid of posts.
 * Categories: posts
 * Keywords: query, loop, grid, posts, box
 * Block Types: core/query
 * Viewport Width: 1376
 */

declare(strict_types=1);

# Prevent direct access.
defined('ABSPATH') || exit;

?>
<!-- wp:group {
	"align":"full",
	"style":{
		"spacing":{
			"padding":{
				"top":"var:preset|spacing|70",
				"bottom":"var:preset|spacing|70",
				"left":"var:preset|spacing|70",
				"right":"var:preset|spacing|70"
			}
		}
	},
	"layout":{"type":"default"}
} -->
<div class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--70);padding-right:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70);padding-left:var(--wp--preset--spacing--70)">

	<!-- wp:query {
		"metadata":{"name":"<?= esc_attr__('Posts Query', 'developer-showcase-noise') ?>"},
		"queryId":0,
		"query":{
			"perPage":6,
			"pages":0,
			"offset":0,
			"postType":"post",
			"order":"desc",
			"orderBy":"date",
			"author":"",
			"search":"",
			"exclude":[],
			"sticky":"",
			"inherit":true
		}
	} -->
	<div class="wp-block-query">

		<!-- wp:post-template {
			"style":{"spacing":{"blockGap":"var:preset|spacing|70"}},
			"align":"full",
			"layout":{"type":"grid","columnCount":3}
		} -->

			<!-- wp:pattern {"slug":"developer-showcase-noise/post-excerpt"} /-->

		<!-- /wp:post-template -->

		<!-- wp:query-pagination {
			"paginationArrow":"arrow",
			"layout":{"type":"flex"}
		} -->
			<!-- wp:query-pagination-previous /-->
			<!-- wp:query-pagination-numbers /-->
			<!-- wp:query-pagination-next /-->
		<!-- /wp:query-pagination -->

	</div>
	<!-- /wp:query -->

</div>
<!-- /wp:group -->
