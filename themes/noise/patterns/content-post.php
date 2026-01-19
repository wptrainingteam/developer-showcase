<?php

/**
 * Title: Post Content
 * Slug: developer-showcase-noise/content-post
 */

declare(strict_types=1);

# Prevent direct access.
defined('ABSPATH') || exit;

?>
<!-- wp:group {
	"tagName":"main",
	"metadata":{"name":"<?= esc_attr__('Content', 'developer-showcase-noise') ?>"},
	"style":{
		"spacing":{
			"blockGap":"0"
		}
	},
	"className":"is-style-site-content",
	"layout":{"type":"default"}
} -->
<main class="wp-block-group is-style-site-content">

	<!-- wp:group {
		"tagName":"article",
		"metadata":{"name":"<?= esc_attr__('Post', 'developer-showcase-noise') ?>"},
		"style":{
			"spacing":{
				"padding":{
					"top":"var:preset|spacing|70",
					"bottom":"var:preset|spacing|70"
				}
			}
		},
		"layout":{"type":"default"}
	} -->
	<article class="wp-block-group" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)">

		<!-- wp:group {
			"tagName":"header",
			"metadata":{"name":"<?= esc_attr__('Post Header', 'developer-showcase-noise') ?>"},
			"style":{
				"spacing":{
					"blockGap":"var:preset|spacing|70"
				}
			},
			"layout":{"type":"constrained"}
		} -->
		<header class="wp-block-group">
			<!-- wp:post-title {"level":1,"align":"wide","className":"is-style-text-headline"} /-->
			<!-- wp:pattern {"slug":"developer-showcase-noise/post-byline-default"} /-->
			<!-- wp:post-featured-image {"aspectRatio":"2/1","align":"wide"} /-->
		</header>
		<!-- /wp:group -->

		<!-- wp:group {"layout":{"type":"constrained"}} -->
		<div class="wp-block-group"><!-- wp:columns {"align":"wide"} -->

			<!-- wp:columns {"verticalAlignment":"top","align":"wide","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|100"}}}} -->
			<div class="wp-block-columns alignwide are-vertically-aligned-top"><!-- wp:column {"verticalAlignment":"top","width":"40rem","layout":{"type":"constrained","justifyContent":"left"}} -->
				<div class="wp-block-column is-vertically-aligned-top" style="flex-basis:40rem">
					<!-- wp:post-content {"className":"is-style-prose","style":{"layout":{"selfStretch":"fixed","flexSize":"40rem"}},"layout":{"type":"constrained"}} /-->
					<!-- wp:pattern {"slug":"developer-showcase-noise/post-meta-default"} /-->
				</div>
				<!-- /wp:column -->

				<!-- wp:column {"verticalAlignment":"top","width":"18.34rem","layout":{"type":"constrained","justifyContent":"right"}} -->
				<div class="wp-block-column is-vertically-aligned-top" style="flex-basis:18.34rem"><!-- wp:group {"style":{"layout":{"selfStretch":"fit","flexSize":null}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"stretch"}} -->
					<div class="wp-block-group"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|40"}},"layout":{"type":"flex","orientation":"vertical"}} -->
						<div class="wp-block-group"><!-- wp:heading {"level":3} -->
							<h3 class="wp-block-heading">Trending Now</h3>
							<!-- /wp:heading -->

							<!-- wp:latest-posts {"postsToShow":3} /--></div>
						<!-- /wp:group -->

						<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|40"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"stretch"}} -->
						<div class="wp-block-group"><!-- wp:paragraph {"style":{"typography":{"textAlign":"center"}}} -->
							<p class="has-text-align-center">Join 12K Subscribers</p>
							<!-- /wp:paragraph -->

							<!-- wp:buttons -->
							<div class="wp-block-buttons"><!-- wp:button {"width":100} -->
								<div class="wp-block-button has-custom-width wp-block-button__width-100"><a class="wp-block-button__link wp-element-button">Subscribe</a></div>
								<!-- /wp:button --></div>
							<!-- /wp:buttons --></div>
						<!-- /wp:group --></div>
					<!-- /wp:group --></div>
				<!-- /wp:column --></div>
			<!-- /wp:columns -->

		</div>
		<!-- /wp:group -->

	</article>
	<!-- /wp:group -->

	<!-- wp:template-part {"slug":"comments"} /-->

</main>
<!-- /wp:group -->
