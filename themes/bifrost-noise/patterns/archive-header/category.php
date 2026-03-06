<?php

/**
 * Title: Category Archive Header
 * Slug: bifrost-noise/archive-header-category
 * Inserter: no
 */

declare(strict_types=1);

# Prevent direct access.
defined('ABSPATH') || exit;

$image = get_theme_file_uri('public/media/images/archive/category.webp');

?>
<!-- wp:cover {"url":"<?= esc_url($image) ?>","id":99,"hasParallax":true,"dimRatio":80,"overlayColor":"black","isUserOverlayColor":true,"sizeSlug":"full","metadata":{"bindings":{"url":{"source":"bifrost-music/term","args":{"field":"image"}}}},"style":{"spacing":{"padding":{"right":"var:preset|spacing|0","left":"var:preset|spacing|0"}}},"layout":{"type":"constrained","contentSize":"80rem"}} -->
<div class="wp-block-cover has-parallax" style="padding-right:var(--wp--preset--spacing--0);padding-left:var(--wp--preset--spacing--0)"><div class="wp-block-cover__image-background wp-image-99 size-full has-parallax" style="background-position:50% 50%;background-image:url(<?= esc_url($image) ?>)"></div><span aria-hidden="true" class="wp-block-cover__background has-black-background-color has-background-dim-80 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|40"}},"layout":{"type":"constrained","justifyContent":"left"}} -->
		<div class="wp-block-group"><!-- wp:group {"className":"is-style-meta","style":{"elements":{"link":{"color":{"text":"var:preset|color|foreground-on-accent"}}},"spacing":{"blockGap":"var:preset|spacing|40"}},"textColor":"foreground-on-accent","fontSize":"2-xs","layout":{"type":"flex","flexWrap":"nowrap"}} -->
			<div class="wp-block-group is-style-meta has-foreground-on-accent-color has-text-color has-link-color has-2-xs-font-size"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|10"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
				<div class="wp-block-group"><!-- wp:outermost/icon-block {"iconName":"","iconColor":"foreground-on-accent","iconColorValue":"#ffffff","width":"1.38em"} -->
					<div class="wp-block-outermost-icon-block"><div class="icon-container has-icon-color has-foreground-on-accent-color" style="color:#ffffff;width:1.38em;transform:rotate(0deg) scaleX(1) scaleY(1)"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368"><path d="M240-320h320v-80H240v80Zm0-160h480v-80H240v80Zm-80 320q-33 0-56.5-23.5T80-240v-480q0-33 23.5-56.5T160-800h240l80 80h320q33 0 56.5 23.5T880-640v400q0 33-23.5 56.5T800-160H160Zm0-80h640v-400H447l-80-80H160v480Zm0 0v-480 480Z"></path></svg></div></div>
					<!-- /wp:outermost/icon-block -->

					<!-- wp:paragraph -->
					<p>Category</p>
					<!-- /wp:paragraph --></div>
				<!-- /wp:group -->

				<!-- wp:paragraph -->
				<p>//</p>
				<!-- /wp:paragraph -->

				<!-- wp:paragraph {"metadata":{"bindings":{"content":{"source":"bifrost-music/term","args":{"field":"count"}}}}} -->
				<p>0</p>
				<!-- /wp:paragraph --></div>
			<!-- /wp:group -->

			<!-- wp:query-title {"type":"archive","showPrefix":false} /-->

			<!-- wp:term-description /--></div>
		<!-- /wp:group --></div></div>
<!-- /wp:cover -->
