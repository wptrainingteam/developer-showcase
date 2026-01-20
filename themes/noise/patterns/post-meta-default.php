<?php

/**
 * Title: Post Meta
 * Slug: bifrost-noise/post-meta-default
 */

declare(strict_types=1);

# Prevent direct access.
defined('ABSPATH') || exit;

?>
<!-- wp:group {
	"tagName":"footer",
	"metadata":{
		"name":"<?= esc_attr__('Post Footer', 'bifrost-noise') ?>"
	},
	"style":{
		"spacing":{
			"blockGap":"0"
		}
	},
	"layout":{
		"type":"default"
	},
	"className":"is-style-meta"
} -->
<footer class="wp-block-group is-style-meta">
	<!-- wp:post-terms {"term":"category","className":"is-style-icon"} /-->
	<!-- wp:post-terms {"term":"post_tag","className":"is-style-icon"} /-->
</footer>
<!-- /wp:group -->
