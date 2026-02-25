<?php

/**
 * Title: Page Content
 * Slug: bifrost-noise/content-page
 */

declare(strict_types=1);

# Prevent direct access.
defined('ABSPATH') || exit;

?>
<!-- wp:group {"tagName":"main","metadata":{"name":"Page Content","patternName":"bifrost-noise/content-page"},"className":"is-style-site-content","style":{"spacing":{"blockGap":"0"}},"layout":{"type":"default"}} -->
<main class="wp-block-group is-style-site-content"><!-- wp:group {"tagName":"article","metadata":{"name":"Post"},"style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"}}},"layout":{"type":"constrained"}} -->
	<article class="wp-block-group" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)"><!-- wp:group {"tagName":"header","metadata":{"name":"Post Header"},"align":"wide","style":{"spacing":{"blockGap":"var:preset|spacing|70"}},"layout":{"type":"default"}} -->
		<header class="wp-block-group alignwide"><!-- wp:post-title {"level":1,"align":"wide","className":"is-style-text-headline"} /-->

			<!-- wp:post-featured-image {"aspectRatio":"2/1"} /--></header>
		<!-- /wp:group -->

		<!-- wp:group {"align":"wide","layout":{"type":"constrained","justifyContent":"center","contentSize":"80rem"}} -->
		<div class="wp-block-group alignwide"><!-- wp:post-content {"layout":{"type":"constrained","justifyContent":"left"}} /--></div>
		<!-- /wp:group --></article>
	<!-- /wp:group --></main>
<!-- /wp:group -->
