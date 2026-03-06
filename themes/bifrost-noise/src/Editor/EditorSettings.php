<?php

/**
 * Editor settings.
 *
 * @author    Bifrost
 * @copyright Copyright (c) 2026, WordPress
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/wptrainingteam/developer-showcase
 */

declare(strict_types=1);

namespace Bifrost\Noise\Editor;

use Bifrost\Noise\Contracts\Bootable;

/**
 * Filters block editor settings.
 */
final class EditorSettings implements Bootable
{
	/**
	 * @inheritDoc
	 */
	public function boot(): void
	{
		add_filter('block_editor_settings_all', $this->settings(...));
	}

	/**
	 * Customizes the block editor settings to enable/disable specific
	 * features that we do/don't need.
	 */
	private function settings(array $settings): array
	{
		$settings['disableContentOnlyForUnsyncedPatterns'] = true;
		$settings['fontLibraryEnabled'] = false;

		return $settings;
	}
}
