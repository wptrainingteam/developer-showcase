<?php

/**
 * Title: Artist Spotlight Post Sidebar
 * Slug: bifrost-noise/sidebar-post-artist-spotlight
 * Inserter: no
 */

declare(strict_types=1);

# Prevent direct access.
defined('ABSPATH') || exit;

?>
<!-- wp:group {"style":{"layout":{"selfStretch":"fit","flexSize":null}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"stretch"}} -->
<div class="wp-block-group"><!-- wp:group {"className":"is-style-section-3","style":{"spacing":{"blockGap":"var:preset|spacing|0","padding":{"top":"var:preset|spacing|0","bottom":"var:preset|spacing|0","left":"var:preset|spacing|0","right":"var:preset|spacing|0"}}},"layout":{"type":"constrained","justifyContent":"left"}} -->
	<div class="wp-block-group is-style-section-3" style="padding-top:var(--wp--preset--spacing--0);padding-right:var(--wp--preset--spacing--0);padding-bottom:var(--wp--preset--spacing--0);padding-left:var(--wp--preset--spacing--0)"><!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40","right":"var:preset|spacing|40"}}},"layout":{"type":"constrained"}} -->
		<div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><!-- wp:heading {"level":3,"className":"is-style-text-widget-heading"} -->
			<h3 class="wp-block-heading is-style-text-widget-heading">Artist Spotlight</h3>
			<!-- /wp:heading --></div>
		<!-- /wp:group -->

		<!-- wp:query {"queryId":3,"query":{"perPage":1,"pages":0,"offset":0,"postType":"music_artist","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false,"taxQuery":null,"parents":[],"format":[]},"className":"is-style-default","namespace":"bifrost-noise/query-post-artist"} -->
		<div class="wp-block-query is-style-default"><!-- wp:post-template {"style":{"spacing":{"blockGap":"var:preset|spacing|40"}},"layout":{"type":"default"}} -->
			<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"constrained","justifyContent":"left"}} -->
			<div class="wp-block-group"><!-- wp:post-featured-image {"isLink":true} /-->

				<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|50","left":"var:preset|spacing|40","right":"var:preset|spacing|40"},"blockGap":"var:preset|spacing|20"}},"layout":{"type":"default"}} -->
				<div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--40)"><!-- wp:post-title {"level":3,"isLink":true,"className":"is-style-post-title-secondary"} /-->

					<!-- wp:post-excerpt {"moreText":"","showMoreOnNewLine":false} /-->

					<!-- wp:read-more {"content":"Full_Profile →"} /--></div>
				<!-- /wp:group --></div>
			<!-- /wp:group -->
			<!-- /wp:post-template --></div>
		<!-- /wp:query --></div>
	<!-- /wp:group -->

	<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"stretch"}} -->
	<div class="wp-block-group"><!-- wp:paragraph {"className":"is-style-default","style":{"typography":{"textAlign":"center"}},"fontSize":"3-xs","fontFamily":"mono"} -->
		<p class="has-text-align-center is-style-default has-mono-font-family has-3-xs-font-size">Join 12K Subscribers</p>
		<!-- /wp:paragraph -->

		<!-- wp:buttons -->
		<div class="wp-block-buttons"><!-- wp:button {"width":100} -->
			<div class="wp-block-button has-custom-width wp-block-button__width-100"><a class="wp-block-button__link wp-element-button">Subscribe</a></div>
			<!-- /wp:button --></div>
		<!-- /wp:buttons --></div>
	<!-- /wp:group --></div>
<!-- /wp:group -->
