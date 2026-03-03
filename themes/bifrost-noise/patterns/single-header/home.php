<?php

/**
 * Title: Homepage Header
 * Slug: bifrost-noise/single-header-home
 * Inserter: no
 */

declare(strict_types=1);

# Prevent direct access.
defined('ABSPATH') || exit;

$video = get_theme_file_uri('public/media/videos/spinning.mp4');

?>
<!-- wp:cover {"url":"<?= esc_url($video) ?>","id":83,"dimRatio":70,"overlayColor":"black","isUserOverlayColor":true,"backgroundType":"video","sizeSlug":"full","metadata":{"name":"Section: Hero"},"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|110","bottom":"var:preset|spacing|110","left":"var:preset|spacing|70","right":"var:preset|spacing|70"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-cover alignfull" style="padding-top:var(--wp--preset--spacing--110);padding-right:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--110);padding-left:var(--wp--preset--spacing--70)"><video class="wp-block-cover__video-background intrinsic-ignore" autoplay muted loop playsinline src="<?= esc_url($video) ?>" data-object-fit="cover"></video><span aria-hidden="true" class="wp-block-cover__background has-black-background-color has-background-dim-70 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:group {"align":"full","style":{"spacing":{"padding":{"right":"var:preset|spacing|70","left":"var:preset|spacing|70"}}},"layout":{"type":"constrained"}} -->
		<div class="wp-block-group alignfull" style="padding-right:var(--wp--preset--spacing--70);padding-left:var(--wp--preset--spacing--70)">

			<!-- wp:query {"queryId":71,"query":{"perPage":1,"pages":0,"offset":0,"postType":"music_album","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false,"taxQuery":null,"parents":[],"format":[]},"align":"full"} -->
			<div class="wp-block-query alignfull"><!-- wp:post-template {"layout":{"type":"default"}} -->
				<!-- wp:group {"align":"full","layout":{"type":"constrained"}} -->
				<div class="wp-block-group alignfull"><!-- wp:group {"className":"is-style-text-annotation","style":{"spacing":{"blockGap":"var:preset|spacing|10"}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"center"}} -->
					<div class="wp-block-group is-style-text-annotation"><!-- wp:paragraph -->
						<p>New Release:</p>
						<!-- /wp:paragraph -->

						<!-- wp:post-title {"level":3,"isLink":true} /--></div>
					<!-- /wp:group --></div>
				<!-- /wp:group -->
				<!-- /wp:post-template --></div>
			<!-- /wp:query -->

			<!-- wp:heading {"level":1,"className":"is-style-default","style":{"typography":{"textAlign":"center"}},"fontSize":"7-xl"} -->
			<h1 class="wp-block-heading has-text-align-center is-style-default has-7-xl-font-size">No Future.<br>Analog Soul.</h1>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"className":"has-mono-font-family","style":{"typography":{"textAlign":"center"}}} -->
			<p class="has-text-align-center has-mono-font-family">A digital sanctuary for the underground. We archive, review, and amplify indie artists who refuse to play by the algorithm's rules.</p>
			<!-- /wp:paragraph -->

			<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
			<div class="wp-block-buttons"><!-- wp:button -->
				<div class="wp-block-button"><a class="wp-block-button__link wp-element-button">Listen_Now</a></div>
				<!-- /wp:button -->

				<!-- wp:button {"className":"is-style-outline"} -->
				<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button">Collection_Index</a></div>
				<!-- /wp:button --></div>
			<!-- /wp:buttons --></div>
		<!-- /wp:group --></div></div>
<!-- /wp:cover -->
