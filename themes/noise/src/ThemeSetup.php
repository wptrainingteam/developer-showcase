<?php

/**
 * Theme setup class.
 *
 * @author    Bifrost
 * @copyright Copyright (c) 2026, WordPress
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/wptrainingteam/developer-showcase
 */

declare(strict_types=1);

namespace DeveloperShowcase\Noise;

use DeveloperShowcase\Noise\Contracts\Bootable;

/**
 * Handles theme setup and feature registration.
 */
final class ThemeSetup implements Bootable
{
	/**
	 * @inheritDoc
	 */
	public function boot(): void
	{
		add_action('after_setup_theme', $this->setup(...));
	}

	/**
	 * Adds theme support for various WordPress features.
	 */
	private function setup(): void
	{
		// Adds support for the View Transitions plugin.
		// @link https://wordpress.org/plugins/view-transitions/
		add_theme_support('view-transitions', [
			'default-animation' => 'fade'
		]);
	}
}
