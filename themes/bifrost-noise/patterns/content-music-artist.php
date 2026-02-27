<?php

/**
 * Title: Artist Content
 * Slug: bifrost-noise/content-music-artist
 */

declare(strict_types=1);

# Prevent direct access.
defined('ABSPATH') || exit;

?>
<!-- wp:group {"tagName":"main","metadata":{"name":"Artist Content","patternName":"bifrost-noise/content-music-artist"},"className":"is-style-site-content","style":{"spacing":{"blockGap":"0"}},"layout":{"type":"default"}} -->
<main class="wp-block-group is-style-site-content"><!-- wp:cover {"useFeaturedImage":true,"dimRatio":50,"overlayColor":"black","isUserOverlayColor":true,"minHeight":75,"minHeightUnit":"vh","contentPosition":"center center","isDark":false,"style":{"spacing":{"blockGap":"var:preset|spacing|40","padding":{"right":"var:preset|spacing|0","left":"var:preset|spacing|0"}},"elements":{"link":{"color":{"text":"var:preset|color|foreground-on-accent"}}}},"textColor":"foreground-on-accent","layout":{"type":"constrained","contentSize":"80rem"}} -->
	<div class="wp-block-cover is-light has-foreground-on-accent-color has-text-color has-link-color" style="padding-right:var(--wp--preset--spacing--0);padding-left:var(--wp--preset--spacing--0);min-height:75vh"><span aria-hidden="true" class="wp-block-cover__background has-black-background-color has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|40"}},"layout":{"type":"constrained","justifyContent":"left"}} -->
			<div class="wp-block-group"><!-- wp:group {"tagName":"header","metadata":{"name":"Post Header"},"style":{"spacing":{"blockGap":"var:preset|spacing|40"}},"layout":{"type":"default"}} -->
				<header class="wp-block-group"><!-- wp:post-title {"level":1,"align":"wide","className":"is-style-text-headline is-style-default"} /--></header>
				<!-- /wp:group -->

				<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|40"}},"layout":{"type":"default"}} -->
				<div class="wp-block-group"><!-- wp:post-excerpt {"showMoreOnNewLine":false,"excerptLength":25,"className":"is-style-post-excerpt-featured","style":{"elements":{"link":{"color":{"text":"var:preset|color|foreground-on-accent"}}}},"textColor":"foreground-on-accent"} /-->

					<!-- wp:buttons -->
					<div class="wp-block-buttons"><!-- wp:button -->
						<div class="wp-block-button"><a class="wp-block-button__link wp-element-button">Latest Release →</a></div>
						<!-- /wp:button --></div>
					<!-- /wp:buttons --></div>
				<!-- /wp:group --></div>
			<!-- /wp:group --></div></div>
	<!-- /wp:cover -->

	<!-- wp:post-content {"align":"full","layout":{"type":"constrained"}} /--></main>
<!-- /wp:group -->
