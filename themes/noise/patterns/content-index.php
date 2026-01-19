<?php

/**
 * Title: Index Content
 * Slug: developer-showcase-noise/content-index
 */

declare(strict_types=1);

# Prevent direct access.
defined('ABSPATH') || exit;

?>
<!-- wp:group {
	"tagName":"main",
	"metadata":{"name":"<?= esc_attr__('Content', 'developer-showcase-noise') ?>"},
	"className":"is-style-site-content",
	"style":{
		"spacing":{
			"blockGap":"0"
		}
	},
	"layout":{"type":"constrained"}
} -->
<main class="wp-block-group is-style-site-content">

	<!-- wp:group {
		"align":"full",
		"style":{
			"spacing":{
				"padding":{
					"right":"var:preset|spacing|70",
					"left":"var:preset|spacing|70"
				}
			}
		},
		"layout":{"type":"default"}
	} -->
	<div  class="wp-block-group alignfull" style="padding-right:var(--wp--preset--spacing--70);padding-left:var(--wp--preset--spacing--70)">
		<!-- wp:heading {"level":1,"className":"is-style-heading-underline"} -->
		<h1 class="wp-block-heading is-style-heading-underline"><?= esc_html__('The Journal', 'developer-showcase-noise') ?></h1>
		<!-- /wp:heading -->
	</div>
	<!-- /wp:group -->

	<!-- wp:template-part {"slug":"loop","align":"full"} /-->
</main>
<!-- /wp:group -->
