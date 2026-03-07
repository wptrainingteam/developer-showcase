<?php

/**
 * Title: Artist Archive Header
 * Slug: bifrost-noise/archive-header-artist
 * Inserter: no
 */

declare(strict_types=1);

# Prevent direct access.
defined('ABSPATH') || exit;

$image = get_theme_file_uri('public/media/images/archive/artist.webp');

?>
<!-- wp:cover {"url":"<?= esc_url($image) ?>","id":92,"hasParallax":true,"dimRatio":80,"overlayColor":"black","isUserOverlayColor":true,"sizeSlug":"large","style":{"spacing":{"padding":{"right":"var:preset|spacing|0","left":"var:preset|spacing|0"}}},"layout":{"type":"constrained","contentSize":"80rem"}} -->
<div class="wp-block-cover has-parallax" style="padding-right:var(--wp--preset--spacing--0);padding-left:var(--wp--preset--spacing--0)"><div class="wp-block-cover__image-background wp-image-92 size-large has-parallax" style="background-position:50% 50%;background-image:url(<?= esc_url($image) ?>)"></div><span aria-hidden="true" class="wp-block-cover__background has-black-background-color has-background-dim-80 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|40"}},"layout":{"type":"constrained","justifyContent":"left"}} -->
		<div class="wp-block-group"><!-- wp:group {"className":"is-style-meta","style":{"elements":{"link":{"color":{"text":"var:preset|color|foreground-on-accent"}}},"spacing":{"blockGap":"var:preset|spacing|40"}},"textColor":"foreground-on-accent","fontSize":"2-xs","layout":{"type":"flex","flexWrap":"nowrap"}} -->
			<div class="wp-block-group is-style-meta has-foreground-on-accent-color has-text-color has-link-color has-2-xs-font-size"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|10"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
				<div class="wp-block-group"><!-- wp:outermost/icon-block {"iconName":"","width":"1.38em"} -->
					<div class="wp-block-outermost-icon-block"><div class="icon-container" style="width:1.38em;transform:rotate(0deg) scaleX(1) scaleY(1)"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="9" cy="6" r="4"></circle><path stroke-linecap="round" d="M15 9a3 3 0 1 0 0-6"></path><ellipse cx="9" cy="17" rx="7" ry="4"></ellipse><path stroke-linecap="round" d="M18 14c1.754.385 3 1.359 3 2.5c0 1.03-1.014 1.923-2.5 2.37"></path></g></svg></div></div>
					<!-- /wp:outermost/icon-block -->

					<!-- wp:paragraph -->
					<p>Global Directory</p>
					<!-- /wp:paragraph --></div>
				<!-- /wp:group -->

				<!-- wp:paragraph -->
				<p>//</p>
				<!-- /wp:paragraph -->

				<!-- wp:paragraph {"metadata":{"bindings":{"content":{"source":"bifrost-music/post-type","args":{"postType":"music_artist","field":"count"}}}}} -->
				<p>0</p>
				<!-- /wp:paragraph --></div>
			<!-- /wp:group -->

			<!-- wp:query-title {"type":"archive","showPrefix":false,"align":"wide"} /-->

			<!-- wp:paragraph {"fontSize":"sm","fontFamily":"tertiary"} -->
			<p class="has-tertiary-font-family has-sm-font-size">Explore the vanguard of sonic exploration. From brutalist techno to ethereal darkwave, discover the creators shaping the future of underground sound.</p>
			<!-- /wp:paragraph --></div>
		<!-- /wp:group --></div></div>
<!-- /wp:cover -->
