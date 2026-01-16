<?php

/**
 * Title: Header: Default
 * Slug: developer-showcase-noise/header-default
 * Description:
 * Categories: header
 * Keywords: header
 * Block Types: core/template-part/header
 * Viewport Width: 1376
 */

declare(strict_types=1);

# Prevent direct access.
defined('ABSPATH') || exit;

?>
<!-- wp:group {
	"metadata":{"name":"<?= esc_attr__('Site Header', 'developer-showcase-noise') ?>"},
	"align":"full",
	"className": "is-style-site-header",
	"style":{"spacing":{"blockGap":"0"}},
	"layout":{"type":"constrained"}
} -->
<div class="wp-block-group alignfull is-style-site-header">
	<!-- wp:group {
		"metadata":{"name":"<?= esc_attr__('Header Content', 'developer-showcase-noise') ?>"},
		"align":"full",
		"style":{
			"spacing":{
				"padding":{
					"top":"var:preset|spacing|70",
					"right":"var:preset|spacing|70",
					"bottom":"var:preset|spacing|70",
					"left":"var:preset|spacing|70"
				}
			}
		},
		"layout":{"type":"flex","justifyContent":"space-between"}
	} -->
	<div class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--70);padding-right:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70);padding-left:var(--wp--preset--spacing--70)">

		<!-- wp:group {
			"metadata":{"name":"<?= esc_attr__('Branding', 'developer-showcase-noise') ?>"},
			"style":{
				"spacing":{"blockGap":"var:preset|spacing|30"},
				"layout":{"selfStretch":"fill","flexSize":null}
			},
			"layout":{"type":"flex","flexWrap":"nowrap"}
		} -->
		<div class="wp-block-group">
			<!-- wp:site-logo /-->
			<!-- wp:site-title /-->
		</div>
		<!-- /wp:group -->

		<!-- wp:navigation {
			"templateLock":false,
			"lock":{"move":false,"remove":false,"edit":true},
			"icon":"menu",
			"layout":{
				"type":"flex",
				"setCascadingProperties":true,
				"justifyContent":"right"
			}
		} /-->
	</div>
	<!-- /wp:group -->

</div>
<!-- /wp:group -->
