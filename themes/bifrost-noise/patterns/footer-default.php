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
<!-- wp:group {"metadata":{"name":"Footer Container"},"className":"is-style-site-footer","style":{"spacing":{"padding":{"top":"var:preset|spacing|100","bottom":"var:preset|spacing|70"}}},"layout":{"type":"constrained","contentSize":"80rem"}} -->
<div class="wp-block-group is-style-site-footer" style="padding-top:var(--wp--preset--spacing--100);padding-bottom:var(--wp--preset--spacing--70)"><!-- wp:columns -->
	<div class="wp-block-columns"><!-- wp:column {"width":"40%"} -->
		<div class="wp-block-column" style="flex-basis:40%"><!-- wp:group {"metadata":{"name":"Footer Content"},"align":"wide","style":{"spacing":{"blockGap":"0"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"left"}} -->
			<div class="wp-block-group alignwide"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|10"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
				<div class="wp-block-group"><!-- wp:site-logo {"width":24} /-->

					<!-- wp:site-title {"level":0,"isLink":false,"className":"is-style-text-normalize"} /--></div>
				<!-- /wp:group -->

				<!-- wp:site-tagline /--></div>
			<!-- /wp:group --></div>
		<!-- /wp:column -->

		<!-- wp:column {"width":"30%","style":{"spacing":{"blockGap":"var:preset|spacing|20"}}} -->
		<div class="wp-block-column" style="flex-basis:30%"><!-- wp:heading {"level":3} -->
			<h3 class="wp-block-heading">Discover</h3>
			<!-- /wp:heading -->

			<!-- wp:list {"className":"is-style-none"} -->
			<ul class="wp-block-list is-style-none"><!-- wp:list-item -->
				<li><a href="#">New_Arrivals</a></li>
				<!-- /wp:list-item -->

				<!-- wp:list-item -->
				<li><a href="#">Staff_Picks</a></li>
				<!-- /wp:list-item -->

				<!-- wp:list-item -->
				<li><a href="#">Playlists</a></li>
				<!-- /wp:list-item -->

				<!-- wp:list-item -->
				<li><a href="http://3">Genres</a></li>
				<!-- /wp:list-item --></ul>
			<!-- /wp:list --></div>
		<!-- /wp:column -->

		<!-- wp:column {"width":"30%","style":{"spacing":{"blockGap":"var:preset|spacing|20"}}} -->
		<div class="wp-block-column" style="flex-basis:30%"><!-- wp:heading {"level":3} -->
			<h3 class="wp-block-heading">Community</h3>
			<!-- /wp:heading -->

			<!-- wp:list {"className":"is-style-none"} -->
			<ul class="wp-block-list is-style-none"><!-- wp:list-item -->
				<li><a href="#">Artists</a></li>
				<!-- /wp:list-item -->

				<!-- wp:list-item -->
				<li><a href="#">Submit_Music</a></li>
				<!-- /wp:list-item -->

				<!-- wp:list-item -->
				<li><a href="#">Events</a></li>
				<!-- /wp:list-item -->

				<!-- wp:list-item -->
				<li><a href="http://3">Merch</a></li>
				<!-- /wp:list-item --></ul>
			<!-- /wp:list --></div>
		<!-- /wp:column --></div>
	<!-- /wp:columns -->

	<!-- wp:separator -->
	<hr class="wp-block-separator has-alpha-channel-opacity"/>
	<!-- /wp:separator -->

	<!-- wp:group {"layout":{"type":"grid","columnCount":2}} -->
	<div class="wp-block-group"><!-- wp:paragraph -->
		<p>A Bifrost project.</p>
		<!-- /wp:paragraph -->

		<!-- wp:social-links {"showLabels":true,"size":"has-normal-icon-size","className":"is-style-social-links-text-only","layout":{"type":"flex","justifyContent":"right"}} -->
		<ul class="wp-block-social-links has-normal-icon-size has-visible-labels is-style-social-links-text-only"><!-- wp:social-link {"url":"https://wordpress.org","service":"wordpress"} /-->

			<!-- wp:social-link {"url":"https://github.com","service":"github"} /-->

			<!-- wp:social-link {"url":"https://twitter.com","service":"twitter"} /-->

			<!-- wp:social-link {"url":"https://twitch.tv","service":"twitch"} /--></ul>
		<!-- /wp:social-links --></div>
	<!-- /wp:group --></div>
<!-- /wp:group -->
