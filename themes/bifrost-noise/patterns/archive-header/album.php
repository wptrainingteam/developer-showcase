<?php

/**
 * Title: Album Archive Header
 * Slug: bifrost-noise/archive-header-album
 * Inserter: no
 */

declare(strict_types=1);

# Prevent direct access.
defined('ABSPATH') || exit;

$image = get_theme_file_uri('public/media/images/archive/album.webp');

?>
<!-- wp:cover {"url":"<?= esc_url($image) ?>","id":93,"hasParallax":true,"dimRatio":80,"overlayColor":"black","isUserOverlayColor":true,"sizeSlug":"large","style":{"spacing":{"padding":{"right":"var:preset|spacing|0","left":"var:preset|spacing|0"}}},"layout":{"type":"constrained","contentSize":"80rem"}} -->
<div class="wp-block-cover has-parallax" style="padding-right:var(--wp--preset--spacing--0);padding-left:var(--wp--preset--spacing--0)"><div class="wp-block-cover__image-background wp-image-93 size-large has-parallax" style="background-position:50% 50%;background-image:url(<?= esc_url($image) ?>)"></div><span aria-hidden="true" class="wp-block-cover__background has-black-background-color has-background-dim-80 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|40"}},"layout":{"type":"constrained","justifyContent":"left"}} -->
		<div class="wp-block-group"><!-- wp:group {"className":"is-style-meta","style":{"elements":{"link":{"color":{"text":"var:preset|color|foreground-on-accent"}}},"spacing":{"blockGap":"var:preset|spacing|40"}},"textColor":"foreground-on-accent","fontSize":"2-xs","layout":{"type":"flex","flexWrap":"nowrap"}} -->
			<div class="wp-block-group is-style-meta has-foreground-on-accent-color has-text-color has-link-color has-2-xs-font-size"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|10"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
				<div class="wp-block-group"><!-- wp:outermost/icon-block {"iconName":"","width":"1.38em"} -->
					<div class="wp-block-outermost-icon-block"><div class="icon-container" style="width:1.38em;transform:rotate(0deg) scaleX(1) scaleY(1)"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-width="1.5"><path d="M2.384 13.793c-.447-3.164-.67-4.745.278-5.77C3.61 7 5.298 7 8.672 7h6.656c3.374 0 5.062 0 6.01 1.024s.724 2.605.278 5.769l-.422 3c-.35 2.48-.525 3.721-1.422 4.464s-2.22.743-4.867.743h-5.81c-2.646 0-3.97 0-4.867-.743s-1.072-1.983-1.422-4.464z"></path><path stroke-linecap="round" stroke-linejoin="round" d="M12 17a1.5 1.5 0 1 1-3 0a1.5 1.5 0 0 1 3 0m0 0v-6.5c0 1.657 1.895 3 3 3"></path><path d="M19.562 7a2.132 2.132 0 0 0-2.1-2.5H6.538a2.132 2.132 0 0 0-2.1 2.5M17.5 4.5c.028-.26.043-.389.043-.496a2 2 0 0 0-1.787-1.993C15.65 2 15.52 2 15.26 2H8.74c-.26 0-.391 0-.497.011a2 2 0 0 0-1.787 1.993c0 .107.014.237.043.496"></path></g></svg></div></div>
					<!-- /wp:outermost/icon-block -->

					<!-- wp:paragraph -->
					<p>Full Catalog</p>
					<!-- /wp:paragraph --></div>
				<!-- /wp:group -->

				<!-- wp:paragraph -->
				<p>//</p>
				<!-- /wp:paragraph -->

				<!-- wp:paragraph {"metadata":{"bindings":{"content":{"source":"bifrost-music/post-type","args":{"postType":"music_album","field":"count"}}}}} -->
				<p>0</p>
				<!-- /wp:paragraph --></div>
			<!-- /wp:group -->

			<!-- wp:query-title {"type":"archive","showPrefix":false,"align":"wide"} /-->

			<!-- wp:paragraph {"fontSize":"sm","fontFamily":"tertiary"} -->
			<p class="has-tertiary-font-family has-sm-font-size">Dive into the archives. From foundational EP releases to expansive double LPs, explore the complete sonic artifacts of our underground collection.</p>
			<!-- /wp:paragraph --></div>
		<!-- /wp:group --></div></div>
<!-- /wp:cover -->
