<?php

/**
 * Title: Single Post Header
 * Slug: bifrost-noise/single-header-post
 * Inserter: no
 */

declare(strict_types=1);

# Prevent direct access.
defined('ABSPATH') || exit;

?>
<!-- wp:group {"tagName":"header","metadata":{"name":"Post Header"},"style":{"spacing":{"blockGap":"var:preset|spacing|70"}},"layout":{"type":"constrained"}} -->
<header class="wp-block-group">

	<!-- wp:post-title {"level":1,"align":"wide","className":"is-style-text-headline"} /-->

	<!-- wp:group {"metadata":{"name":"Post Byline"},"align":"wide","className":"is-style-meta","style":{"spacing":{"blockGap":"var:preset|spacing|40"}},"layout":{"type":"flex","flexWrap":"wrap"}} -->
	<div class="wp-block-group alignwide is-style-meta">

		<!-- wp:group {"metadata":{"name":"Post Author"},"style":{"spacing":{"blockGap":"var:preset|spacing|10"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
		<div class="wp-block-group">
			<!-- wp:avatar {"size":32} /-->
			<!-- wp:post-author-name {"isLink":true} /-->
		</div>
		<!-- /wp:group -->

		<!-- wp:paragraph {"metadata":{"name":"Separator"}} -->
		<p>//</p>
		<!-- /wp:paragraph -->

		<!-- wp:post-date {"metadata":{"bindings":{"datetime":{"source":"core/post-data","args":{"field":"date"}}}}} /-->

		<!-- wp:paragraph {"metadata":{"name":"Separator"}} -->
		<p>//</p>
		<!-- /wp:paragraph -->

		<!-- wp:post-time-to-read {"displayAsRange":false} /-->
	</div>
	<!-- /wp:group -->

	<!-- wp:post-featured-image {"aspectRatio":"2/1","align":"wide"} /-->
</header>
<!-- /wp:group -->
