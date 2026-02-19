<?php

/**
 * Frontend Assets class.
 *
 * @author    Bifrost
 * @copyright Copyright (c) 2026, WordPress
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/wptrainingteam/developer-showcase
 */

declare(strict_types=1);

namespace Bifrost\Noise\Frontend;

use Bifrost\Noise\Contracts\Bootable;

/**
 * Handles frontend asset loading and configuration.
 */
final class FrontendAssets implements Bootable
{
	/**
	 * Inline CSS limit.
	 *
	 * @todo Type hint with PHP 8.3+ requirement.
	 */
	protected const INLINE_CSS_LIMIT = 50000;

	/**
	 * @inheritDoc
	 */
	public function boot(): void
	{
		add_action('wp_enqueue_scripts', $this->enqueue(...));
		add_filter('styles_inline_size_limit', $this->inlineStylesLimit(...));

		// Disable the emoji script.
		remove_action('wp_head', 'print_emoji_detection_script', 7);
	}

	/**
	 * Enqueue scripts/styles for the front end.
	 */
	private function enqueue(): void
	{
		$screen_style = include get_parent_theme_file_path('public/css/screen.asset.php');

		$script_asset = include get_parent_theme_file_path('public/js/cursor.asset.php');

		wp_enqueue_script(
			'bifrost-noise-cursor',
			get_parent_theme_file_uri('public/js/cursor.js'),
			$script_asset['dependencies'],
			$script_asset['version'],
			true
		);

		// Loads the primary stylesheet.
		wp_enqueue_style(
			'bifrost-noise-style',
			get_parent_theme_file_uri('public/css/screen.css'),
			$screen_style['dependencies'],
			$screen_style['version']
		);

		// Add path data so the stylesheet can potentially be inlined.
		wp_style_add_data(
			'bifrost-noise-style',
			'path',
			get_parent_theme_file_path('public/css/screen.css')
		);
	}

	/**
	 * Custom inline CSS size limit.
	 */
	private function inlineStylesLimit(int $total_inline_limit): int
	{
		return max(self::INLINE_CSS_LIMIT, $total_inline_limit);
	}
}
