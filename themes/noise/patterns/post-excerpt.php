<?php

/**
 * Title: Post: Excerpt
 * Slug: developer-showcase-noise/post-excerpt
 */

declare(strict_types=1);

# Prevent direct access.
defined('ABSPATH') || exit;

?>
<!-- wp:group {
	"tagName":"article",
	"metadata":{"name":"<?= esc_attr__('Post', 'developer-showcase-noise') ?>"},
	"style":{
		"spacing":{
			"blockGap":"var:preset|spacing|40"
		}
	},
	"layout":{"type":"default"}
} -->
<article class="wp-block-group">

	<!-- wp:group {
		"tagName":"header",
		"metadata":{"name":"<?= esc_attr__('Post Header', 'developer-showcase-noise') ?>"},
		"layout":{"type":"default"}
	} -->
	<header class="wp-block-group">
		<!-- wp:post-title {"isLink":true} /-->
	</header>
	<!-- /wp:group -->

	<!-- wp:post-excerpt {
		"moreText":"<?= esc_attr__('Continue reading &rarr;', 'developer-showcase-noise') ?>",
		"showMoreOnNewLine":false,
		"excerptLength":35
	} /-->

	<!-- wp:group {
		"tagName":"footer",
		"metadata":{"name":"<?= esc_attr__('Post Footer', 'developer-showcase-noise') ?>"},
		"layout":{"type":"default"}
	} -->
	<footer class="wp-block-group">
		<!-- wp:pattern {"slug":"developer-showcase-noise/post-byline-short"} /-->
	</footer>
	<!-- /wp:group -->

</article>
<!-- /wp:group -->
