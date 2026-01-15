<?php

/**
 * Title: Footer: Default
 * Slug: bifrost-noise/footer-default
 * Description:
 * Categories: footer
 * Keywords: footer
 * Block Types: core/template-part/footer
 */

declare(strict_types=1);

# Prevent direct access.
defined('ABSPATH') || exit;

?>
<!-- wp:group {
	"metadata":{"name":"<?= esc_attr__('Footer Container', 'bifrost-noise') ?>"},
	"style":{
		"spacing":{
			"padding":{
				"top":"var:preset|spacing|100",
				"bottom":"var:preset|spacing|100",
				"left":"var:preset|spacing|70",
				"right":"var:preset|spacing|70"
			}
		}
	},
	"className":"is-style-site-footer",
	"layout":{"type":"default"}
} -->
<div class="wp-block-group is-style-site-footer" style="padding-top:var(--wp--preset--spacing--100);padding-right:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--100);padding-left:var(--wp--preset--spacing--70)">

	<!-- wp:group {
		"metadata":{"name":"<?= esc_attr__('Footer Content', 'bifrost-noise') ?>"},
		"align":"wide",
		"style":{
			"spacing":{
				"blockGap":"0"
			}
		},
		"layout":{
			"type":"flex",
			"orientation":"vertical",
			"justifyContent":"center"
		}
	} -->
	<div class="wp-block-group alignwide">
		<!-- wp:site-title {
			"level":0,
			"isLink":false,
			"className":"is-style-text-normalize"
		} /-->

		<!-- wp:paragraph -->
		<p><?= esc_html__('Powered by WordPress, crazy ideas, and passion.', 'bifrost-noise') ?></p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:group -->

	<!-- wp:social-links {
		"showLabels":true,
		"size":"has-normal-icon-size",
		"layout":{
			"type":"flex",
			"justifyContent":"center"
		}
	} -->
	<ul class="wp-block-social-links has-normal-icon-size has-visible-labels">
		<!-- wp:social-link {"url":"https://wordpress.org","service":"wordpress"} /-->
		<!-- wp:social-link {"url":"https://github.com","service":"github"} /-->
		<!-- wp:social-link {"url":"https://twitter.com","service":"twitter"} /-->
		<!-- wp:social-link {"url":"https://twitch.tv","service":"twitch"} /-->
	</ul>
	<!-- /wp:social-links -->

</div>
<!-- /wp:group -->
