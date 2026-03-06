<?php

/**
 * Title: Post Archive (Blog Home) Header
 * Slug: bifrost-noise/archive-header-post
 * Inserter: no
 */

declare(strict_types=1);

# Prevent direct access.
defined('ABSPATH') || exit;

$image = get_theme_file_uri('public/media/images/archive/post.webp');

?>
<!-- wp:cover {"url":"<?= esc_url($image) ?>","id":94,"hasParallax":true,"dimRatio":80,"overlayColor":"black","isUserOverlayColor":true,"sizeSlug":"full","style":{"spacing":{"padding":{"right":"var:preset|spacing|0","left":"var:preset|spacing|0"}}},"layout":{"type":"constrained","contentSize":"80rem"}} -->
<div class="wp-block-cover has-parallax" style="padding-right:var(--wp--preset--spacing--0);padding-left:var(--wp--preset--spacing--0)"><div class="wp-block-cover__image-background wp-image-94 size-full has-parallax" style="background-position:50% 50%;background-image:url(<?= esc_url($image) ?>)"></div><span aria-hidden="true" class="wp-block-cover__background has-black-background-color has-background-dim-80 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|40"}},"layout":{"type":"constrained","justifyContent":"left"}} -->
		<div class="wp-block-group"><!-- wp:group {"className":"is-style-meta","style":{"elements":{"link":{"color":{"text":"var:preset|color|foreground-on-accent"}}},"spacing":{"blockGap":"var:preset|spacing|40"}},"textColor":"foreground-on-accent","fontSize":"2-xs","layout":{"type":"flex","flexWrap":"nowrap"}} -->
			<div class="wp-block-group is-style-meta has-foreground-on-accent-color has-text-color has-link-color has-2-xs-font-size"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|10"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
				<div class="wp-block-group"><!-- wp:outermost/icon-block {"iconName":"wordpress-pencil","iconColor":"foreground-on-accent","iconColorValue":"#ffffff","width":"1.38em"} -->
					<div class="wp-block-outermost-icon-block"><div class="icon-container has-icon-color has-foreground-on-accent-color" style="color:#ffffff;width:1.38em;transform:rotate(0deg) scaleX(1) scaleY(1)"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true"><path d="m19 7-3-3-8.5 8.5-1 4 4-1L19 7Zm-7 11.5H5V20h7v-1.5Z"></path></svg></div></div>
					<!-- /wp:outermost/icon-block -->

					<!-- wp:paragraph -->
					<p>Archive</p>
					<!-- /wp:paragraph --></div>
				<!-- /wp:group -->

				<!-- wp:paragraph -->
				<p>//</p>
				<!-- /wp:paragraph -->

				<!-- wp:paragraph {"metadata":{"bindings":{"content":{"source":"bifrost-music/post-type","args":{"postType":"post","field":"count"}}}}} -->
				<p>0</p>
				<!-- /wp:paragraph --></div>
			<!-- /wp:group -->

			<!-- wp:heading {"level":1} -->
			<h1 class="wp-block-heading">The Journal</h1>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"fontSize":"sm","fontFamily":"tertiary"} -->
			<p class="has-tertiary-font-family has-sm-font-size">Explore our curated archive of editorials, artist spotlights, and sonic deep dives. This is where the underground stays documented and the volume stays up.</p>
			<!-- /wp:paragraph --></div>
		<!-- /wp:group --></div></div>
<!-- /wp:cover -->
