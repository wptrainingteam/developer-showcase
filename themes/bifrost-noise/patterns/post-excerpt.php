<?php

/**
 * Title: Post: Excerpt
 * Slug: bifrost-noise/post-excerpt
 * Inserter: no
 */

declare(strict_types=1);

# Prevent direct access.
defined('ABSPATH') || exit;

?>
<!-- wp:group {
	"tagName":"article",
	"metadata":{"name":"<?= esc_attr__('Post', 'bifrost-noise') ?>"},
	"style":{
		"spacing":{
			"blockGap":"var:preset|spacing|40"
		}
	},
	"layout":{"type":"default"}
} -->
<article class="wp-block-group">

	<!-- wp:post-featured-image {"aspectRatio":"16/9"} /-->

	<!-- wp:group {
		"style":{
			"spacing":{
				"blockGap":"var:preset|spacing|10"
			}
		},
		"layout":{"type":"constrained"}
	} -->
	<div class="wp-block-group">

		<!-- wp:group {
			"tagName":"header",
			"metadata":{"name":"<?= esc_attr__('Post Header', 'bifrost-noise') ?>"},
			"layout":{"type":"default"}
		} -->
		<header class="wp-block-group">
			<!-- wp:post-title {"isLink":true,"className":"is-style-post-title-secondary"} /-->
		</header>
		<!-- /wp:group -->

		<!-- wp:post-excerpt {
			"showMoreOnNewLine":false,
			"excerptLength":12
		} /-->

	</div>
	<!-- /wp:group -->

	<!-- wp:group {
		"tagName":"footer",
		"metadata":{"name":"<?= esc_attr__('Post Footer', 'bifrost-noise') ?>"},
		"layout":{"type":"default"}
	} -->
	<footer class="wp-block-group">
		<!-- wp:pattern {"slug":"bifrost-noise/post-byline-short"} /-->
	</footer>
	<!-- /wp:group -->

</article>
<!-- /wp:group -->
