<?php

/**
 * Title: Index Content
 * Slug: bifrost-noise/content-index
 */

declare(strict_types=1);

# Prevent direct access.
defined('ABSPATH') || exit;

?>
<!-- wp:group {"tagName":"main","metadata":{"name":"Index Content","patternName":"bifrost-noise/content-index"},"className":"is-style-site-content","style":{"spacing":{"blockGap":"var:preset|spacing|0"}},"layout":{"type":"default"}} -->
<main class="wp-block-group is-style-site-content"><!-- wp:cover {"url":"http://localhost:8884/wp-content/uploads/2026/02/journal-hero.webp","id":87,"hasParallax":true,"dimRatio":80,"overlayColor":"black","isUserOverlayColor":true,"sizeSlug":"full","style":{"color":{"duotone":"var:preset|duotone|grayscale"},"spacing":{"padding":{"right":"var:preset|spacing|0","left":"var:preset|spacing|0"}}},"layout":{"type":"constrained","contentSize":"80rem"}} -->
	<div class="wp-block-cover has-parallax" style="padding-right:var(--wp--preset--spacing--0);padding-left:var(--wp--preset--spacing--0)"><div class="wp-block-cover__image-background wp-image-87 size-full has-parallax" style="background-position:50% 50%;background-image:url(http://localhost:8884/wp-content/uploads/2026/02/journal-hero.webp)"></div><span aria-hidden="true" class="wp-block-cover__background has-black-background-color has-background-dim-80 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|40"}},"layout":{"type":"constrained","justifyContent":"left"}} -->
			<div class="wp-block-group"><!-- wp:group {"className":"is-style-meta","style":{"elements":{"link":{"color":{"text":"var:preset|color|foreground-on-accent"}}},"spacing":{"blockGap":"var:preset|spacing|40"}},"textColor":"foreground-on-accent","fontSize":"2-xs","layout":{"type":"flex","flexWrap":"nowrap"}} -->
				<div class="wp-block-group is-style-meta has-foreground-on-accent-color has-text-color has-link-color has-2-xs-font-size"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|10"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
					<div class="wp-block-group"><!-- wp:outermost/icon-block {"iconName":"wordpress-pencil","iconColor":"foreground-on-accent","iconColorValue":"#ffffff","width":"1.38em"} -->
						<div class="wp-block-outermost-icon-block"><div class="icon-container has-icon-color has-foreground-on-accent-color" style="color:#ffffff;width:1.38em;transform:rotate(0deg) scaleX(1) scaleY(1)"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true"><path d="m19 7-3-3-8.5 8.5-1 4 4-1L19 7Zm-7 11.5H5V20h7v-1.5Z"></path></svg></div></div>
						<!-- /wp:outermost/icon-block -->

						<!-- wp:paragraph -->
						<p>Full Catalog</p>
						<!-- /wp:paragraph --></div>
					<!-- /wp:group -->

					<!-- wp:paragraph -->
					<p>//</p>
					<!-- /wp:paragraph -->

					<!-- wp:paragraph -->
					<p>435 Articles</p>
					<!-- /wp:paragraph --></div>
				<!-- /wp:group -->

				<!-- wp:heading {"level":1,"className":"is-style-default"} -->
				<h1 class="wp-block-heading is-style-default">The Journal</h1>
				<!-- /wp:heading -->

				<!-- wp:paragraph {"fontSize":"sm","fontFamily":"tertiary"} -->
				<p class="has-tertiary-font-family has-sm-font-size">Explore our curated archive of editorials, artist spotlights, and sonic deep dives. This is where the underground stays documented and the volume stays up.</p>
				<!-- /wp:paragraph --></div>
			<!-- /wp:group --></div></div>
	<!-- /wp:cover -->

	<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"}}},"layout":{"type":"constrained","contentSize":"80rem"}} -->
	<div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)"><!-- wp:query {"queryId":0,"query":{"perPage":12,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":true},"metadata":{"name":"Posts Query"}} -->
		<div class="wp-block-query"><!-- wp:post-template {"align":"full","style":{"spacing":{"blockGap":"var:preset|spacing|70"}},"layout":{"type":"grid","columnCount":3}} -->
			<!-- wp:group {"tagName":"article","metadata":{"name":"Post: Excerpt","patternName":"bifrost-noise/post-excerpt"},"style":{"spacing":{"blockGap":"var:preset|spacing|40"}},"layout":{"type":"default"}} -->
			<article class="wp-block-group"><!-- wp:post-featured-image {"aspectRatio":"16/9"} /-->

				<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|10"}},"layout":{"type":"constrained"}} -->
				<div class="wp-block-group"><!-- wp:group {"tagName":"header","metadata":{"name":"Post Header"},"layout":{"type":"default"}} -->
					<header class="wp-block-group"><!-- wp:post-title {"isLink":true,"className":"is-style-post-title-secondary"} /--></header>
					<!-- /wp:group -->

					<!-- wp:post-excerpt {"showMoreOnNewLine":false,"excerptLength":12} /--></div>
				<!-- /wp:group -->

				<!-- wp:group {"tagName":"footer","metadata":{"name":"Post Footer"},"layout":{"type":"default"}} -->
				<footer class="wp-block-group"><!-- wp:group {"metadata":{"name":"Post Byline (Short)","patternName":"bifrost-noise/post-byline-short"},"className":"is-style-meta","style":{"spacing":{"blockGap":"var:preset|spacing|40"}},"layout":{"type":"flex","flexWrap":"wrap"}} -->
					<div class="wp-block-group is-style-meta"><!-- wp:post-author-name {"isLink":true} /-->

						<!-- wp:paragraph {"metadata":{"name":"Separator"}} -->
						<p>//</p>
						<!-- /wp:paragraph -->

						<!-- wp:post-date {"metadata":{"bindings":{"datetime":{"source":"core/post-data","args":{"field":"date"}}}}} /--></div>
					<!-- /wp:group --></footer>
				<!-- /wp:group --></article>
			<!-- /wp:group -->
			<!-- /wp:post-template -->

			<!-- wp:query-pagination {"paginationArrow":"arrow","layout":{"type":"flex"}} -->
			<!-- wp:query-pagination-previous /-->

			<!-- wp:query-pagination-numbers /-->

			<!-- wp:query-pagination-next /-->
			<!-- /wp:query-pagination --></div>
		<!-- /wp:query --></div>
	<!-- /wp:group --></main>
<!-- /wp:group -->
