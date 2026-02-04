<?php

/**
 * Title: Album Content
 * Slug: bifrost-noise/content-music-album
 */

declare(strict_types=1);

# Prevent direct access.
defined('ABSPATH') || exit;

?>
<!-- wp:group {"tagName":"main","metadata":{"name":"Album Content","patternName":"bifrost-noise/content-music-album"},"className":"is-style-site-content","style":{"spacing":{"blockGap":"0"}},"layout":{"type":"constrained","contentSize":"80rem"}} -->
<main class="wp-block-group is-style-site-content"><!-- wp:columns {"style":{"spacing":{"padding":{"top":"var:preset|spacing|90","bottom":"var:preset|spacing|90"}}}} -->
	<div class="wp-block-columns" style="padding-top:var(--wp--preset--spacing--90);padding-bottom:var(--wp--preset--spacing--90)"><!-- wp:column {"width":"40%"} -->
		<div class="wp-block-column" style="flex-basis:40%"><!-- wp:post-featured-image {"aspectRatio":"1"} /-->

			<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"space-between"}} -->
			<div class="wp-block-buttons"><!-- wp:button {"width":100} -->
				<div class="wp-block-button has-custom-width wp-block-button__width-100"><a class="wp-block-button__link wp-element-button">Listen Now →</a></div>
				<!-- /wp:button -->

				<!-- wp:button {"width":50,"className":"is-style-outline"} -->
				<div class="wp-block-button has-custom-width wp-block-button__width-50 is-style-outline"><a class="wp-block-button__link wp-element-button">Save</a></div>
				<!-- /wp:button -->

				<!-- wp:button {"width":50,"className":"is-style-outline"} -->
				<div class="wp-block-button has-custom-width wp-block-button__width-50 is-style-outline"><a class="wp-block-button__link wp-element-button">Share</a></div>
				<!-- /wp:button --></div>
			<!-- /wp:buttons -->

			<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|0"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"stretch"}} -->
			<div class="wp-block-group"><!-- wp:group {"fontSize":"xs","fontFamily":"mono","layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between","verticalAlignment":"center"}} -->
				<div class="wp-block-group has-mono-font-family has-xs-font-size"><!-- wp:paragraph -->
					<p>Release Date</p>
					<!-- /wp:paragraph -->

					<!-- wp:paragraph {"fontSize":"2-xs"} -->
					<p class="has-2-xs-font-size">1990</p>
					<!-- /wp:paragraph --></div>
				<!-- /wp:group -->

				<!-- wp:group {"fontSize":"xs","fontFamily":"mono","layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between","verticalAlignment":"center"}} -->
				<div class="wp-block-group has-mono-font-family has-xs-font-size"><!-- wp:paragraph -->
					<p>Label</p>
					<!-- /wp:paragraph -->

					<!-- wp:paragraph {"fontSize":"2-xs"} -->
					<p class="has-2-xs-font-size">Cool Record Company</p>
					<!-- /wp:paragraph --></div>
				<!-- /wp:group -->

				<!-- wp:group {"fontSize":"xs","fontFamily":"mono","layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between","verticalAlignment":"center"}} -->
				<div class="wp-block-group has-mono-font-family has-xs-font-size"><!-- wp:paragraph -->
					<p>Format</p>
					<!-- /wp:paragraph -->

					<!-- wp:paragraph {"fontSize":"2-xs"} -->
					<p class="has-2-xs-font-size">Digital, Vinyl</p>
					<!-- /wp:paragraph --></div>
				<!-- /wp:group -->

				<!-- wp:group {"fontSize":"xs","fontFamily":"mono","layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between","verticalAlignment":"center"}} -->
				<div class="wp-block-group has-mono-font-family has-xs-font-size"><!-- wp:paragraph -->
					<p>Genre</p>
					<!-- /wp:paragraph -->

					<!-- wp:post-terms {"term":"music_genre","fontSize":"2-xs"} /--></div>
				<!-- /wp:group --></div>
			<!-- /wp:group --></div>
		<!-- /wp:column -->

		<!-- wp:column {"width":"40rem"} -->
		<div class="wp-block-column" style="flex-basis:40rem"><!-- wp:group {"tagName":"header","metadata":{"name":"Post Header"},"style":{"spacing":{"blockGap":"var:preset|spacing|0"}},"layout":{"type":"constrained"}} -->
			<header class="wp-block-group"><!-- wp:group {"metadata":{"name":"Post Byline"},"align":"wide","className":"is-style-meta","style":{"spacing":{"blockGap":"var:preset|spacing|40"}},"layout":{"type":"flex","flexWrap":"wrap"}} -->
				<div class="wp-block-group alignwide is-style-meta"><!-- wp:paragraph {"metadata":{"bindings":{"content":{"source":"bifrost-music/album","args":{"key":"artist"}}}}} -->
					<p></p>
					<!-- /wp:paragraph --></div>
				<!-- /wp:group -->

				<!-- wp:post-title {"level":1,"align":"wide","className":"is-style-text-headline"} /--></header>
			<!-- /wp:group -->

			<!-- wp:group {"layout":{"type":"constrained"}} -->
			<div class="wp-block-group"><!-- wp:post-content {"className":"is-style-prose","style":{"layout":{"selfStretch":"fixed","flexSize":"40rem"}},"layout":{"type":"constrained"}} /--></div>
			<!-- /wp:group --></div>
		<!-- /wp:column --></div>
	<!-- /wp:columns --></main>
<!-- /wp:group -->
