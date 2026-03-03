<?php

/**
 * Title: Post Archive Query
 * Slug: bifrost-noise/archive-query-post
 * Inserter: no
 */

declare(strict_types=1);

# Prevent direct access.
defined('ABSPATH') || exit;

?>
<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"}}},"layout":{"type":"constrained","contentSize":"80rem"}} -->
<div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)"><!-- wp:query {"queryId":0,"query":{"perPage":12,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":true},"metadata":{"name":"Posts Query"}} -->
	<div class="wp-block-query"><!-- wp:post-template {"align":"full","style":{"spacing":{"blockGap":"var:preset|spacing|70"}},"layout":{"type":"grid","columnCount":3}} -->
		<!-- wp:group {"tagName":"article","metadata":{"name":"Post: Excerpt","patternName":"bifrost-noise/post-excerpt"},"style":{"spacing":{"blockGap":"var:preset|spacing|40"}},"layout":{"type":"default"}} -->
		<article class="wp-block-group"><!-- wp:post-featured-image {"isLink":true,"aspectRatio":"16/9"} /-->

			<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|10"}},"layout":{"type":"constrained"}} -->
			<div class="wp-block-group"><!-- wp:group {"tagName":"header","metadata":{"name":"Post Header"},"layout":{"type":"default"}} -->
				<header class="wp-block-group"><!-- wp:post-title {"isLink":true,"className":"is-style-post-title-secondary"} /--></header>
				<!-- /wp:group -->

				<!-- wp:post-excerpt {"showMoreOnNewLine":false,"excerptLength":12} /--></div>
			<!-- /wp:group -->

			<!-- wp:group {"tagName":"footer","metadata":{"name":"Post Footer"},"layout":{"type":"default"}} -->
			<footer class="wp-block-group"><!-- wp:group {"metadata":{"name":"Post Byline (Short)","patternName":"bifrost-noise/post-byline-short"},"className":"is-style-meta","style":{"spacing":{"blockGap":"var:preset|spacing|40"}},"layout":{"type":"flex","flexWrap":"wrap"}} -->
				<div class="wp-block-group is-style-meta"><!-- wp:post-author-name {"isLink":true} /-->

					<!-- wp:paragraph {"metadata":{"name":"Separator"}} -->
					<p>//</p>
					<!-- /wp:paragraph -->

					<!-- wp:post-date {"metadata":{"bindings":{"datetime":{"source":"core/post-data","args":{"field":"date"}}}}} /--></div>
				<!-- /wp:group --></footer>
			<!-- /wp:group --></article>
		<!-- /wp:group -->
		<!-- /wp:post-template -->

		<!-- wp:query-pagination {"paginationArrow":"arrow","layout":{"type":"flex"}} -->
		<!-- wp:query-pagination-previous /-->

		<!-- wp:query-pagination-numbers /-->

		<!-- wp:query-pagination-next /-->
		<!-- /wp:query-pagination --></div>
	<!-- /wp:query --></div>
<!-- /wp:group -->
