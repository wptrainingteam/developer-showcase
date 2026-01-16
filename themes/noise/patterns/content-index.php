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
	"layout":{"type":"constrained"}
} -->
<main class="wp-block-group is-style-site-content">
	<!-- wp:template-part {"slug":"loop","align":"full"} /-->
</main>
<!-- /wp:group -->
