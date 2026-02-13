<?php

/**
 * Title: Artist Content
 * Slug: bifrost-noise/content-music-artist
 */

declare(strict_types=1);

# Prevent direct access.
defined('ABSPATH') || exit;

?>
<!-- wp:group {"tagName":"main","metadata":{"name":"Artist Content","patternName":"bifrost-noise/content-music-artist"},"className":"is-style-site-content","style":{"spacing":{"blockGap":"0"}},"layout":{"type":"default"}} -->
<main class="wp-block-group is-style-site-content"><!-- wp:cover {"useFeaturedImage":true,"dimRatio":50,"overlayColor":"black","isUserOverlayColor":true,"minHeight":75,"minHeightUnit":"vh","contentPosition":"center center","isDark":false,"style":{"spacing":{"blockGap":"var:preset|spacing|40","padding":{"right":"var:preset|spacing|0","left":"var:preset|spacing|0"}},"elements":{"link":{"color":{"text":"var:preset|color|foreground-on-accent"}}}},"textColor":"foreground-on-accent","layout":{"type":"constrained","contentSize":"80rem"}} -->
	<div class="wp-block-cover is-light has-foreground-on-accent-color has-text-color has-link-color" style="padding-right:var(--wp--preset--spacing--0);padding-left:var(--wp--preset--spacing--0);min-height:75vh"><span aria-hidden="true" class="wp-block-cover__background has-black-background-color has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|40"}},"layout":{"type":"constrained","justifyContent":"left"}} -->
			<div class="wp-block-group"><!-- wp:group {"tagName":"header","metadata":{"name":"Post Header"},"style":{"spacing":{"blockGap":"var:preset|spacing|40"}},"layout":{"type":"default"}} -->
				<header class="wp-block-group"><!-- wp:post-title {"level":1,"align":"wide","className":"is-style-text-headline is-style-default"} /--></header>
				<!-- /wp:group -->

				<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|40"}},"layout":{"type":"default"}} -->
				<div class="wp-block-group"><!-- wp:post-excerpt {"showMoreOnNewLine":false,"excerptLength":25,"className":"is-style-post-excerpt-featured","style":{"elements":{"link":{"color":{"text":"var:preset|color|foreground-on-accent"}}}},"textColor":"foreground-on-accent"} /-->

					<!-- wp:buttons -->
					<div class="wp-block-buttons"><!-- wp:button -->
						<div class="wp-block-button"><a class="wp-block-button__link wp-element-button">Latest Release →</a></div>
						<!-- /wp:button --></div>
					<!-- /wp:buttons --></div>
				<!-- /wp:group --></div>
			<!-- /wp:group --></div></div>
	<!-- /wp:cover -->

	<!-- wp:group {"tagName":"header","style":{"spacing":{"blockGap":"var:preset|spacing|0"}},"layout":{"type":"default"}} -->
	<header class="wp-block-group"><!-- wp:group {"metadata":{"name":"Section: Tabs"},"className":"is-style-default","style":{"spacing":{"padding":{"bottom":"var:preset|spacing|80"}}},"layout":{"type":"default"}} -->
		<div class="wp-block-group is-style-default" style="padding-bottom:var(--wp--preset--spacing--80)"><!-- wp:tabs {"style":{"spacing":{"blockGap":"var:preset|spacing|80"}}} -->
			<div class="wp-block-tabs"><!-- wp:tabs-menu {"lock":{"remove":true},"style":{"spacing":{"blockGap":"var:preset|spacing|0"}}} -->
				<div role="tablist" class="wp-block-tabs-menu"><!-- wp:tabs-menu-item {"style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40"}}}} -->
					<a class="wp-block-tabs-menu-item wp-block-tabs-menu-item__template" style="padding-top:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40)" hidden><span class="screen-reader-text">Tab menu item</span></a>
					<!-- /wp:tabs-menu-item --></div>
				<!-- /wp:tabs-menu -->

				<!-- wp:tab-panels {"lock":{"remove":true}} -->
				<div class="wp-block-tab-panels"><!-- wp:tab {"label":"Albums","style":{"spacing":{"padding":{"top":"var:preset|spacing|0","bottom":"var:preset|spacing|0"}}},"layout":{"type":"constrained","contentSize":"80rem"},"anchor":"albums"} -->
					<section id="albums" class="wp-block-tab" style="padding-top:var(--wp--preset--spacing--0);padding-bottom:var(--wp--preset--spacing--0)"><!-- wp:query {"queryId":0,"query":{"postType":"music_album","perPage":8},"namespace":"bifrost-noise/query-artist-albums","metadata":{"name":"Posts Query"}} -->
						<div class="wp-block-query"><!-- wp:post-template {"align":"full","style":{"spacing":{"blockGap":"var:preset|spacing|70"}},"layout":{"type":"grid","columnCount":4}} -->
							<!-- wp:group {"tagName":"article","metadata":{"name":"Post"},"style":{"spacing":{"blockGap":"var:preset|spacing|40"}},"layout":{"type":"default"}} -->
							<article class="wp-block-group"><!-- wp:post-featured-image {"isLink":true,"aspectRatio":"1"} /-->

								<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|10"}},"layout":{"type":"constrained"}} -->
								<div class="wp-block-group"><!-- wp:post-title {"isLink":true,"className":"is-style-post-title-secondary"} /-->

									<!-- wp:group {"metadata":{"name":"Post Byline"},"className":"is-style-meta","style":{"spacing":{"blockGap":"var:preset|spacing|40"}},"layout":{"type":"flex","flexWrap":"wrap"}} -->
									<div class="wp-block-group is-style-meta"><!-- wp:paragraph -->
										<p>YEAR</p>
										<!-- /wp:paragraph --></div>
									<!-- /wp:group --></div>
								<!-- /wp:group --></article>
							<!-- /wp:group -->
							<!-- /wp:post-template --></div>
						<!-- /wp:query --></section>
					<!-- /wp:tab -->

					<!-- wp:tab {"label":"About","layout":{"type":"constrained","contentSize":"80rem","wideSize":"80rem","justifyContent":"center"},"anchor":"about"} -->
					<section id="about" class="wp-block-tab"><!-- wp:post-content {"className":"is-style-prose","style":{"layout":{"selfStretch":"fixed","flexSize":"40rem"}},"layout":{"type":"default"}} /--></section>
					<!-- /wp:tab -->

					<!-- wp:tab {"label":"Merch","layout":{"type":"constrained","contentSize":"80rem"},"anchor":"merch"} -->
					<section id="merch" class="wp-block-tab"><!-- wp:paragraph {"placeholder":"Type / to choose a block"} -->
						<p>Merch coming in 2026.</p>
						<!-- /wp:paragraph --></section>
					<!-- /wp:tab --></div>
				<!-- /wp:tab-panels --></div>
			<!-- /wp:tabs --></div>
		<!-- /wp:group --></header>
	<!-- /wp:group --></main>
<!-- /wp:group -->
