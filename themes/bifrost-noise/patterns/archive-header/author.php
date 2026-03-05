<?php

/**
 * Title: Author Archive Header
 * Slug: bifrost-noise/archive-header-author
 * Inserter: no
 */

declare(strict_types=1);

# Prevent direct access.
defined('ABSPATH') || exit;

$image = get_theme_file_uri('public/media/images/archive/author.png');

?>
<!-- wp:cover {"url":"<?= esc_url($image) ?>","id":99,"hasParallax":true,"dimRatio":80,"overlayColor":"black","isUserOverlayColor":true,"sizeSlug":"full","metadata":{"bindings":{"url":{"source":"bifrost-music/term","args":{"field":"image"}}}},"style":{"spacing":{"padding":{"right":"var:preset|spacing|0","left":"var:preset|spacing|0"}}},"layout":{"type":"constrained","contentSize":"80rem"}} -->
<div class="wp-block-cover has-parallax" style="padding-right:var(--wp--preset--spacing--0);padding-left:var(--wp--preset--spacing--0)"><div class="wp-block-cover__image-background wp-image-99 size-full has-parallax" style="background-position:50% 50%;background-image:url(<?= esc_url($image) ?>)"></div><span aria-hidden="true" class="wp-block-cover__background has-black-background-color has-background-dim-80 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|40"}},"layout":{"type":"constrained","justifyContent":"left"}} -->
		<div class="wp-block-group"><!-- wp:group {"className":"is-style-meta","style":{"elements":{"link":{"color":{"text":"var:preset|color|foreground-on-accent"}}},"spacing":{"blockGap":"var:preset|spacing|40"}},"textColor":"foreground-on-accent","fontSize":"2-xs","layout":{"type":"flex","flexWrap":"nowrap"}} -->
			<div class="wp-block-group is-style-meta has-foreground-on-accent-color has-text-color has-link-color has-2-xs-font-size"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|10"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
				<div class="wp-block-group">
					<!-- wp:avatar {"size":24} /-->

					<!-- wp:paragraph -->
					<p>Writer</p>
					<!-- /wp:paragraph --></div>
				<!-- /wp:group -->

				<!-- wp:paragraph -->
				<p>//</p>
				<!-- /wp:paragraph -->

				<!-- wp:paragraph {"metadata":{"bindings":{"content":{"source":"bifrost-music/user","args":{"field":"count"}}}}} -->
				<p>0</p>
				<!-- /wp:paragraph --></div>
			<!-- /wp:group -->

			<!-- wp:query-title {"type":"archive","showPrefix":false} /-->

			<!-- wp:post-author-biography /--></div>
		<!-- /wp:group --></div></div>
<!-- /wp:cover -->
