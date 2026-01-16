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
					"blockGap":"var:preset|spacing|40"
				}
			},
			"layout":{"type":"constrained"}
		} -->
		<header class="wp-block-group">
			<!-- wp:post-title {"level":1,"className":"is-style-text-headline"} /-->
			<!-- wp:pattern {"slug":"developer-showcase-noise/post-byline-default"} /-->
		</header>
		<!-- /wp:group -->

		<!-- wp:post-content {
			"layout":{"type":"constrained"},
			"className":"is-style-prose"
		} /-->

		<!-- wp:pattern {"slug":"developer-showcase-noise/post-meta-default"} /-->

	</article>
	<!-- /wp:group -->

	<!-- wp:template-part {"slug":"comments"} /-->

</main>
<!-- /wp:group -->
