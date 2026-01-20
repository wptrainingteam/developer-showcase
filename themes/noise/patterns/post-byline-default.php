<?php

/**
 * Title: Post Byline
 * Slug: bifrost-noise/post-byline-default
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
	"align":"wide",
	"className": "is-style-meta"
} -->
<div class="wp-block-group is-style-meta alignwide">

	<!-- wp:group {
		"metadata":{
			"name":"<?= esc_attr__('Post Author', 'bifrost-noise') ?>"
		},
		"style":{
			"spacing":{
				"blockGap":"var:preset|spacing|10"
			}
		},
		"layout":{
			"type":"flex",
			"flexWrap":"nowrap"
		}
	} -->
	<div class="wp-block-group">
		<!-- wp:avatar {"size":32} /-->
		<!-- wp:post-author-name {"isLink":true} /-->
	</div>
	<!-- /wp:group -->

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

	<!-- wp:post-time-to-read {"displayAsRange":false} /-->

</div>
<!-- /wp:group -->
