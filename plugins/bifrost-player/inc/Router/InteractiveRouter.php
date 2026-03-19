<?php

/**
 * Interactive router.
 *
 * Injects data-wp-router-region on the <main> element so that the
 * persistent audio player survives client-side navigations.
 *
 * @author    Bifrost
 * @copyright Copyright (c) 2026
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/wptrainingteam/developer-showcase
 */

declare( strict_types=1 );

namespace Bifrost\Player\Router;

use Bifrost\Player\Contracts\Bootable;
use WP_HTML_Tag_Processor;

/**
 * Hooks into the render pipeline to add router region directives on the
 * <main> element (rendered by core/group with tagName "main").
 */
final class InteractiveRouter implements Bootable {

	/**
	 * Registers the WordPress hooks.
	 */
	public function boot(): void {
		add_filter( 'render_block', $this->injectRouterRegion( ... ), 10, 2 );
		add_action( 'wp_enqueue_scripts', $this->enqueueRouterModule( ... ) );
	}

	/**
	 * Injects data-wp-interactive, data-wp-router-region, and navigation
	 * directives on core/group blocks rendered as <main>.
	 */
	private function injectRouterRegion( string $blockContent, array $block ): string {
		if ( ( $block['blockName'] ?? '' ) !== 'core/group' ) {
			return $blockContent;
		}

		$tagName = $block['attrs']['tagName'] ?? '';

		if ( $tagName !== 'main' ) {
			return $blockContent;
		}

		$tags = new WP_HTML_Tag_Processor( $blockContent );

		if ( ! $tags->next_tag( 'main' ) ) {
			return $blockContent;
		}

		$tags->set_attribute( 'data-wp-interactive', 'bifrost-player' );
		$tags->set_attribute( 'data-wp-router-region', 'bifrost-player/main' );

		// Intercept link clicks for client-side navigation.
		$tags->set_attribute( 'data-wp-on--click', 'actions.navigate' );

		// Prefetch links on hover for faster navigation.
		$tags->set_attribute( 'data-wp-on--mouseenter', 'actions.prefetch' );

		return $tags->get_updated_html();
	}

	/**
	 * Enqueues the audio-player view script module early (during
	 * wp_enqueue_scripts) so that its dynamic dependency on
	 * @wordpress/interactivity-router is processed before the
	 * import map is printed.
	 *
	 * Without this, the audio-player block renders in wp_footer
	 * (after the import map), and the browser can't resolve the
	 * bare specifier '@wordpress/interactivity-router'.
	 */
	private function enqueueRouterModule(): void {
		wp_enqueue_script_module( 'bifrost-player-audio-player-view-script-module' );
	}
}
