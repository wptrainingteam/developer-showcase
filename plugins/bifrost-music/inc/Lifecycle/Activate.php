<?php

/**
 * Plugin activation handler.
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
 * Runs when the plugin is activated via register_activation_hook().
 */
final class Activate
{
	public static function run(): void
	{
		if (! $role = get_role('administrator')) {
			return;
		}

		foreach (Capabilities::all() as $cap) {
			$role->add_cap($cap);
		}
	}
}
