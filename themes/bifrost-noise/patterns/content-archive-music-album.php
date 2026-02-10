<?php

/**
 * Title: Album Archive Content
 * Slug: bifrost-noise/content-archive-music-album
 */

declare(strict_types=1);

# Prevent direct access.
defined('ABSPATH') || exit;

?>
<!-- wp:group {"tagName":"main","metadata":{"name":"Album Archive Content","patternName":"bifrost-noise/content-archive-music-album"},"className":"is-style-site-content","style":{"spacing":{"padding":{"top":"var:preset|spacing|90","bottom":"var:preset|spacing|90"}}},"layout":{"type":"constrained","contentSize":"80rem"}} -->
<main class="wp-block-group is-style-site-content" style="padding-top:var(--wp--preset--spacing--90);padding-bottom:var(--wp--preset--spacing--90)"><!-- wp:group {"layout":{"type":"default"}} -->
	<div class="wp-block-group"><!-- wp:query-title {"type":"archive","showPrefix":false} /--></div>
	<!-- /wp:group -->

	<!-- wp:query {"queryId":0,"query":{"perPage":4,"pages":0,"offset":0,"postType":"music_album","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false,"parents":[],"format":[]},"metadata":{"name":"Posts Query"}} -->
	<div class="wp-block-query"><!-- wp:post-template {"align":"full","style":{"spacing":{"blockGap":"var:preset|spacing|70"}},"layout":{"type":"grid","columnCount":4}} -->
		<!-- wp:group {"tagName":"article","metadata":{"name":"Post"},"style":{"spacing":{"blockGap":"var:preset|spacing|40"}},"layout":{"type":"default"}} -->
		<article class="wp-block-group"><!-- wp:post-featured-image {"isLink":true,"aspectRatio":"1"} /-->

			<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|10"}},"layout":{"type":"constrained"}} -->
			<div class="wp-block-group"><!-- wp:group {"metadata":{"name":"Post Byline"},"className":"is-style-meta","style":{"spacing":{"blockGap":"var:preset|spacing|40"}},"layout":{"type":"flex","flexWrap":"wrap"}} -->
				<div class="wp-block-group is-style-meta"><!-- wp:post-terms {"term":"music_genre","className":"is-style-post-terms-badge-outline"} /--></div>
				<!-- /wp:group -->

				<!-- wp:post-title {"isLink":true,"className":"is-style-post-title-secondary"} /-->

				<!-- wp:group {"metadata":{"name":"Post Byline"},"className":"is-style-meta","style":{"spacing":{"blockGap":"var:preset|spacing|40"}},"layout":{"type":"flex","flexWrap":"wrap"}} -->
				<div class="wp-block-group is-style-meta"><!-- wp:paragraph {"metadata":{"bindings":{"content":{"source":"bifrost-music/album","args":{"key":"artist"}}}}} -->
					<p></p>
					<!-- /wp:paragraph --></div>
				<!-- /wp:group --></div>
			<!-- /wp:group --></article>
		<!-- /wp:group -->
		<!-- /wp:post-template -->

		<!-- wp:query-pagination {"paginationArrow":"arrow","layout":{"type":"flex"}} -->
		<!-- wp:query-pagination-previous /-->

		<!-- wp:query-pagination-numbers /-->

		<!-- wp:query-pagination-next /-->
		<!-- /wp:query-pagination --></div>
	<!-- /wp:query --></main>
<!-- /wp:group -->
