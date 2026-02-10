<?php

/**
 * Title: Artist Archive Content
 * Slug: bifrost-noise/content-archive-music-artist
 */

declare(strict_types=1);

# Prevent direct access.
defined('ABSPATH') || exit;

?>
<!-- wp:group {"tagName":"main","metadata":{"name":"Artist Archive Content","patternName":"bifrost-noise/content-archive-music-artist"},"className":"is-style-site-content","style":{"spacing":{"blockGap":"var:preset|spacing|0"}},"layout":{"type":"constrained","contentSize":"80rem"}} -->
<main class="wp-block-group is-style-site-content"><!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"}}},"layout":{"type":"default"}} -->
	<div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)"><!-- wp:query-title {"type":"archive","showPrefix":false} /--></div>
	<!-- /wp:group -->

	<!-- wp:query {"queryId":0,"query":{"perPage":12,"pages":0,"offset":0,"postType":"music_album","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":true,"parents":[],"format":[]},"metadata":{"name":"Posts Query"},"align":"full","layout":{"type":"default"}} -->
	<div class="wp-block-query alignfull"><!-- wp:post-template {"align":"full","style":{"spacing":{"blockGap":"var:preset|spacing|0"}},"layout":{"type":"grid","columnCount":2}} -->
		<!-- wp:cover {"useFeaturedImage":true,"dimRatio":50,"overlayColor":"black","isUserOverlayColor":true,"minHeight":100,"minHeightUnit":"vh","contentPosition":"bottom left","style":{"spacing":{"blockGap":"var:preset|spacing|40","padding":{"right":"var:preset|spacing|0","left":"var:preset|spacing|0"}},"elements":{"link":{"color":{"text":"var:preset|color|foreground-on-accent"}}}},"textColor":"foreground-on-accent","layout":{"type":"constrained","contentSize":"80rem"}} -->
		<div class="wp-block-cover has-custom-content-position is-position-bottom-left has-foreground-on-accent-color has-text-color has-link-color" style="padding-right:var(--wp--preset--spacing--0);padding-left:var(--wp--preset--spacing--0);min-height:100vh"><span aria-hidden="true" class="wp-block-cover__background has-black-background-color has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|40","padding":{"right":"var:preset|spacing|70","left":"var:preset|spacing|70","top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"}},"color":{"background":"#0000004f"}},"layout":{"type":"constrained","justifyContent":"left"}} -->
				<div class="wp-block-group has-background" style="background-color:#0000004f;padding-top:var(--wp--preset--spacing--70);padding-right:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70);padding-left:var(--wp--preset--spacing--70)"><!-- wp:group {"tagName":"header","metadata":{"name":"Post Header"},"style":{"spacing":{"blockGap":"var:preset|spacing|40"}},"layout":{"type":"default"}} -->
					<header class="wp-block-group"><!-- wp:post-title {"align":"wide","className":"is-style-text-headline is-style-default"} /--></header>
					<!-- /wp:group -->

					<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|40"}},"layout":{"type":"default"}} -->
					<div class="wp-block-group"><!-- wp:post-excerpt {"showMoreOnNewLine":false,"excerptLength":25,"className":"is-style-post-excerpt-featured","style":{"elements":{"link":{"color":{"text":"var:preset|color|foreground-on-accent"}}}},"textColor":"foreground-on-accent"} /-->

						<!-- wp:read-more {"content":"View_Profile →"} /--></div>
					<!-- /wp:group --></div>
				<!-- /wp:group --></div></div>
		<!-- /wp:cover -->
		<!-- /wp:post-template -->

		<!-- wp:query-pagination {"paginationArrow":"arrow","layout":{"type":"flex"}} -->
		<!-- wp:query-pagination-previous /-->

		<!-- wp:query-pagination-numbers /-->

		<!-- wp:query-pagination-next /-->
		<!-- /wp:query-pagination --></div>
	<!-- /wp:query --></main>
<!-- /wp:group -->
