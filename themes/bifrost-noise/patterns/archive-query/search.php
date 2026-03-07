<?php

/**
 * Title: Search Query
 * Slug: bifrost-noise/archive-query-search
 * Inserter: no
 */

declare(strict_types=1);

# Prevent direct access.
defined('ABSPATH') || exit;

?>
<!-- wp:group {"metadata":{"patternName":"bifrost-noise/archive-query-search","name":"Search Query"},"style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"}}},"layout":{"type":"constrained","contentSize":"80rem"}} -->
<div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)"><!-- wp:query {"queryId":0,"query":{"perPage":12,"pages":0,"offset":0,"postType":"music_album","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":true,"parents":[],"format":[]},"metadata":{"name":"Posts Query"}} -->
	<div class="wp-block-query"><!-- wp:post-template {"align":"full","style":{"spacing":{"blockGap":"var:preset|spacing|70"}},"layout":{"type":"grid","columnCount":4}} -->
		<!-- wp:group {"tagName":"article","metadata":{"name":"Post"},"style":{"spacing":{"blockGap":"var:preset|spacing|40"}},"layout":{"type":"default"}} -->
		<article class="wp-block-group"><!-- wp:group {"style":{"css":"position: relative;","spacing":{"blockGap":"var:preset|spacing|0"}},"layout":{"type":"default"}} -->
			<div class="wp-block-group has-custom-css"><!-- wp:post-featured-image {"isLink":true,"aspectRatio":"1","className":"is-style-default"} /-->

				<!-- wp:group {"style":{"css":"position: absolute !important;\ntop: var(\u002d\u002dwp\u002d\u002dpreset\u002d\u002dspacing\u002d\u002d40);\nleft: var(\u002d\u002dwp\u002d\u002dpreset\u002d\u002dspacing\u002d\u002d40);\nz-index: 1;\nmargin: 0;","elements":{"link":{"color":{"text":"var:preset|color|foreground-on-accent"}}},"spacing":{"padding":{"top":"var:preset|spacing|10","bottom":"var:preset|spacing|10","left":"var:preset|spacing|20","right":"var:preset|spacing|20"},"blockGap":"var:preset|spacing|10"}},"backgroundColor":"black","textColor":"foreground-on-accent","fontSize":"3-xs","fontFamily":"mono","layout":{"type":"flex","flexWrap":"nowrap"}} -->
				<div class="wp-block-group has-custom-css has-foreground-on-accent-color has-black-background-color has-text-color has-background has-link-color has-mono-font-family has-3-xs-font-size" style="padding-top:var(--wp--preset--spacing--10);padding-right:var(--wp--preset--spacing--20);padding-bottom:var(--wp--preset--spacing--10);padding-left:var(--wp--preset--spacing--20)"><!-- wp:outermost/icon-block {"iconName":"wordpress-page","iconColor":"foreground-on-accent","iconColorValue":"#ffffff","width":"1.38em","metadata":{"bindings":{"icon":{"source":"bifrost-music/post-type","args":{"field":"icon"}}}}} -->
					<div class="wp-block-outermost-icon-block"><div class="icon-container has-icon-color has-foreground-on-accent-color" style="color:#ffffff;width:1.38em;transform:rotate(0deg) scaleX(1) scaleY(1)"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true"><path d="M15.5 7.5h-7V9h7V7.5Zm-7 3.5h7v1.5h-7V11Zm7 3.5h-7V16h7v-1.5Z"></path><path d="M17 4H7a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2ZM7 5.5h10a.5.5 0 0 1 .5.5v12a.5.5 0 0 1-.5.5H7a.5.5 0 0 1-.5-.5V6a.5.5 0 0 1 .5-.5Z"></path></svg></div></div>
					<!-- /wp:outermost/icon-block -->

					<!-- wp:paragraph {"metadata":{"bindings":{"content":{"source":"bifrost-music/post-type","args":{"field":"label"}}}}} -->
					<p>Post Type</p>
					<!-- /wp:paragraph --></div>
				<!-- /wp:group --></div>
			<!-- /wp:group -->

			<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|10"}},"layout":{"type":"constrained"}} -->
			<div class="wp-block-group"><!-- wp:post-title {"isLink":true,"className":"is-style-post-title-tertiary"} /-->

				<!-- wp:post-excerpt {"showMoreOnNewLine":false,"excerptLength":12} /--></div>
			<!-- /wp:group --></article>
		<!-- /wp:group -->
		<!-- /wp:post-template -->

		<!-- wp:query-pagination {"paginationArrow":"arrow","layout":{"type":"flex"}} -->
		<!-- wp:query-pagination-previous /-->

		<!-- wp:query-pagination-numbers /-->

		<!-- wp:query-pagination-next /-->
		<!-- /wp:query-pagination --></div>
	<!-- /wp:query --></div>
<!-- /wp:group -->
