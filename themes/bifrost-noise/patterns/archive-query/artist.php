<?php

/**
 * Title: Artist Archive Query
 * Slug: bifrost-noise/archive-query-artist
 */

declare(strict_types=1);

# Prevent direct access.
defined('ABSPATH') || exit;

?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"}}},"layout":{"type":"constrained","contentSize":"80rem"}} -->
<div class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)"><!-- wp:query {"queryId":0,"query":{"perPage":12,"pages":0,"offset":0,"postType":"music_album","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":true,"parents":[],"format":[]},"metadata":{"name":"Posts Query"},"layout":{"type":"default"}} -->
	<div class="wp-block-query"><!-- wp:post-template {"align":"full","layout":{"type":"grid","columnCount":4}} -->
		<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"constrained"}} -->
		<div class="wp-block-group"><!-- wp:post-featured-image {"isLink":true,"aspectRatio":"1","className":"is-style-post-featured-image-accent"} /-->

			<!-- wp:post-title {"className":"is-style-post-title-secondary"} /--></div>
		<!-- /wp:group -->
		<!-- /wp:post-template -->

		<!-- wp:query-pagination {"paginationArrow":"arrow","layout":{"type":"flex"}} -->
		<!-- wp:query-pagination-previous /-->

		<!-- wp:query-pagination-numbers /-->

		<!-- wp:query-pagination-next /-->
		<!-- /wp:query-pagination --></div>
	<!-- /wp:query --></div>
<!-- /wp:group -->
