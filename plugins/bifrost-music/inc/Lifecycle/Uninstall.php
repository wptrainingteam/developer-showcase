<?php

/**
 * Plugin uninstall handler.
 *
 * @author    Bifrost
 * @copyright Copyright (c) 2026, WordPress
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/wptrainingteam/developer-showcase
 */

declare(strict_types=1);

namespace Bifrost\Music\Lifecycle;

use Bifrost\Music\Support\Capabilities;

/**
 * Runs when the plugin is uninstalled via register_uninstall_hook().
 */
final class Uninstall
{
	public static function run(): void
	{
		if (! defined('WP_UNINSTALL_PLUGIN')) {
			wp_die(sprintf(
				__('%s should only be called when uninstalling the plugin.', 'bifrost-music'),
				'<code>' . __METHOD__ . '</code>'
			));
		}

		if (! $role = get_role('administrator')) {
			return;
		}

		foreach (Capabilities::all() as $cap) {
			$role->remove_cap($cap);
		}
	}
}
