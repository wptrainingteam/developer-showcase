<?php

/**
 * Editor assets service.
 *
 * @author    Bifrost
 * @copyright Copyright (c) 2026, WordPress
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/wptrainingteam/developer-showcase
 */

declare(strict_types=1);

namespace Bifrost\Music\Editor;

use Bifrost\Music\Contracts\Bootable;
use const Bifrost\Music\PLUGIN_DIR;
use const Bifrost\Music\PLUGIN_FILE;

/**
 * Loads editor assets.
 */
final class EditorAssets implements Bootable
{
	/**
	 * @inheritDoc
	 */
	public function boot(): void
	{
		add_action('enqueue_block_editor_assets', $this->enqueue(...));
	}

	/**
	 * Loads editor assets.
	 */
	private function enqueue(): void
	{
		$script_asset = include PLUGIN_DIR . '/build/editor.asset.php';

		wp_enqueue_script(
			'bifrost-music-editor',
			plugin_dir_url(PLUGIN_FILE) . 'build/editor.js',
			$script_asset['dependencies'],
			$script_asset['version'],
			true
		);

		// Set translations for editor scripts.
		// @link https://developer.wordpress.org/reference/functions/wp_set_script_translations/
		wp_set_script_translations('bifrost-music-editor', 'bifrost-music');
	}
}
