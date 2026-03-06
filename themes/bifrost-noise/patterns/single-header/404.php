<?php

/**
 * Title: 404 Header
 * Slug: bifrost-noise/single-header-404
 * Inserter: no
 */

declare(strict_types=1);

# Prevent direct access.
defined('ABSPATH') || exit;

$image = get_theme_file_uri('public/media/images/error-404.webp');

?>
<!-- wp:cover {"url":"<?= esc_url($image) ?>","id":180,"hasParallax":true,"dimRatio":70,"overlayColor":"black","isUserOverlayColor":true,"focalPoint":{"x":0,"y":0.5},"minHeight":100,"minHeightUnit":"vh","sizeSlug":"full","metadata":{"name":"404 Header","patternName":"bifrost-noise/single-header-404"},"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|110","bottom":"var:preset|spacing|110","left":"var:preset|spacing|70","right":"var:preset|spacing|70"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-cover alignfull has-parallax" style="padding-top:var(--wp--preset--spacing--110);padding-right:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--110);padding-left:var(--wp--preset--spacing--70);min-height:100vh"><div class="wp-block-cover__image-background wp-image-180 size-full has-parallax" style="background-position:0% 50%;background-image:url(<?= esc_url($image) ?>)"></div><span aria-hidden="true" class="wp-block-cover__background has-black-background-color has-background-dim-70 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:group {"align":"full","style":{"spacing":{"padding":{"right":"var:preset|spacing|70","left":"var:preset|spacing|70"}}},"layout":{"type":"constrained"}} -->
		<div class="wp-block-group alignfull" style="padding-right:var(--wp--preset--spacing--70);padding-left:var(--wp--preset--spacing--70)"><!-- wp:heading {"level":1,"className":"is-style-default","style":{"typography":{"textAlign":"center"}},"fontSize":"7-xl"} -->
			<h1 class="wp-block-heading has-text-align-center is-style-default has-7-xl-font-size">Don't Panic!</h1>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"className":"has-mono-font-family","style":{"typography":{"textAlign":"center"}}} -->
			<p class="has-text-align-center has-mono-font-family">It looks like you stumbled upon a page that doesn't exist. Perhaps you were looking for a particular <a href="/albums">album</a> or <a href="/artists">artist</a>. If not, why not try rolling the dice with a search?</p>
			<!-- /wp:paragraph -->

			<!-- wp:search {"label":"Search","showLabel":false,"placeholder":"Type something here...","width":75,"widthUnit":"%","buttonText":"Search","buttonPosition":"button-inside","align":"center"} /--></div>
		<!-- /wp:group --></div></div>
<!-- /wp:cover -->
