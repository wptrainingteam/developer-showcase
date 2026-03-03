<?php

/**
 * Title: Post Byline (Short)
 * Slug: bifrost-noise/post-byline-short
 * Inserter: no
 */

declare(strict_types=1);

# Prevent direct access.
defined('ABSPATH') || exit;

?>
<!-- wp:group {
	"metadata":{
		"name":"<?= esc_attr__('Post Byline', 'bifrost-noise') ?>"
	},
	"style":{
		"spacing":{
			"blockGap":"var:preset|spacing|40"
		}
	},
	"layout":{
		"type":"flex",
		"flexWrap":"wrap"
	},
	"className": "is-style-meta"
} -->
<div class="wp-block-group is-style-meta">

	<!-- wp:post-author-name {"isLink":true} /-->

	<!-- wp:paragraph {
		"metadata":{
			"name":"<?= esc_attr__('Separator', 'bifrost-noise') ?>"
		}
	} -->
	<p><?=
		// Translators: Metadata separator.
		esc_html__('//', 'bifrost-noise')
	?></p>
	<!-- /wp:paragraph -->

	<!-- wp:post-date /-->

</div>
<!-- /wp:group -->
