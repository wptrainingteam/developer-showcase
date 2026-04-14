<?php

/**
 * Interactive router.
 *
 * Enables client-side navigation so the persistent audio player
 * survives page transitions.
 *
 * @author    Bifrost
 * @copyright Copyright (c) 2026
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/wptrainingteam/developer-showcase
 */

declare(strict_types=1);

namespace Bifrost\Player\Router;

use Bifrost\Framework\Contracts\Bootable;
use WP_HTML_Tag_Processor;

/**
 * Hooks into the render pipeline to:
 *
 * 1. Add router regions on <main>, header, and footer so the router
 *    updates all three during client-side navigation (keeps block
 *    style variation class suffixes in sync with swapped CSS).
 * 2. Inject data-wp-on--click / data-wp-on--mouseenter on every
 *    <a> tag inside router-region blocks, following the documented
 *    pattern from @wordpress/interactivity-router.
 */
final class InteractiveRouter implements Bootable
{
	/**
	 * Script modules that must be marked for client-side navigation.
	 *
	 * The Gutenberg plugin's `gutenberg_define_interactivity_modules_support()`
	 * requires `build/modules/index.php` (an auto-generated registry) to mark
	 * block-library modules for client navigation. That file is missing from
	 * the current Gutenberg build, so no block-library module gets the
	 * `data-wp-router-options` attribute and the Interactivity Router never
	 * loads them during CSR.
	 *
	 * We work around this by explicitly marking the modules we depend on.
	 *
	 * @see https://github.com/WordPress/gutenberg/blob/trunk/lib/client-assets.php
	 */
	private const CLIENT_NAV_MODULES = array(
		'@wordpress/block-library/tabs/view',
	);

	/**
	 * Registers the WordPress hooks.
	 */
	public function boot(): void
	{
		add_filter('render_block', $this->injectRouterRegions(...), 10, 2);
		add_action('wp_enqueue_scripts', $this->enqueueRouterModule(...));
		add_action('wp_enqueue_scripts', $this->markModulesForClientNav(...));
	}

	/**
	 * Dispatches to the appropriate injector based on block type.
	 */
	private function injectRouterRegions(string $blockContent, array $block): string
	{
		$blockName = $block['blockName'] ?? '';

		if ( $blockName === 'core/group' ) {
			$tagName = $block['attrs']['tagName'] ?? '';

			if ( $tagName === 'main' ) {
				return $this->addRegionAndLinks($blockContent, 'main', 'main');
			}

			return $blockContent;
		}

		if ( $blockName === 'core/template-part' ) {
			$slug = $block['attrs']['slug'] ?? '';

			if ( $slug === 'header' || $slug === 'footer' ) {
				return $this->addRegionAndLinks($blockContent, null, $slug);
			}
		}

		return $blockContent;
	}

	/**
	 * Adds a router region to the wrapper element and injects
	 * navigation directives on every <a> tag inside the block.
	 *
	 * @param string      $blockContent Rendered block HTML.
	 * @param string|null $htmlTag      HTML tag to target for the region (null = first tag).
	 * @param string      $regionSlug   Unique slug for the router region ID.
	 */
	private function addRegionAndLinks(string $blockContent, ?string $htmlTag, string $regionSlug): string
	{
		$tags = new WP_HTML_Tag_Processor($blockContent);

		// Set router region on the wrapper element.
		$found = $htmlTag ? $tags->next_tag($htmlTag) : $tags->next_tag();

		if ( ! $found ) {
			return $blockContent;
		}

		$tags->set_attribute('data-wp-interactive', 'bifrost-player');
		$tags->set_attribute('data-wp-router-region', 'bifrost-player/' . $regionSlug);

		// Inject navigation directives on every <a> tag.
		while ( $tags->next_tag('a') ) {
			if ( $tags->get_attribute('data-wp-on--click') ) {
				continue; // Don't override existing click handlers.
			}

			$tags->set_attribute('data-wp-on--click', 'bifrost-player::actions.navigate');
			$tags->set_attribute('data-wp-on--mouseenter', 'bifrost-player::actions.prefetch');
		}

		return $tags->get_updated_html();
	}

	/**
	 * Enqueues the audio-player view script module early so that its
	 * dynamic dependency on @wordpress/interactivity-router is
	 * processed before the import map is printed.
	 */
	private function enqueueRouterModule(): void
	{
		wp_enqueue_script_module('bifrost-player-audio-player-view-script-module');
	}

	/**
	 * Marks interactive block-library script modules for client-side
	 * navigation so the router loads them on the destination page.
	 */
	private function markModulesForClientNav(): void
	{
		if ( ! method_exists('WP_Interactivity_API', 'add_client_navigation_support_to_script_module') ) {
			return;
		}

		foreach ( self::CLIENT_NAV_MODULES as $module_id ) {
			wp_interactivity()->add_client_navigation_support_to_script_module($module_id);
		}
	}
}
