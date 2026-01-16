<?php

/**
 * Title: Post Byline
 * Slug: developer-showcase-noise/post-byline-default
 */

declare(strict_types=1);

# Prevent direct access.
defined('ABSPATH') || exit;

?>
<!-- wp:group {
	"metadata":{
		"name":"<?= esc_attr__('Post Byline', 'developer-showcase-noise') ?>"
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

	<!-- wp:group {
		"metadata":{
			"name":"<?= esc_attr__('Post Author', 'developer-showcase-noise') ?>"
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
		<!-- wp:paragraph {
			"metadata":{
				"name":"<?= esc_attr__('Prefix', 'developer-showcase-noise') ?>"
			}
		} -->
		<p><?= esc_html__('By', 'developer-showcase-noise') ?></p>
		<!-- /wp:paragraph -->

		<!-- wp:post-author-name {"isLink":true} /-->
	</div>
	<!-- /wp:group -->

	<!-- wp:paragraph {
		"metadata":{
			"name":"<?= esc_attr__('Separator', 'developer-showcase-noise') ?>"
		}
	} -->
	<p><?=
		// Translators: Metadata separator.
		esc_html__('&middot;', 'developer-showcase-noise')
	?></p>
	<!-- /wp:paragraph -->

	<!-- wp:post-date /-->

</div>
<!-- /wp:group -->
