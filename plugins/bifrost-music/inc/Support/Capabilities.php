<?php

/**
 * Plugin capability definitions.
 *
 * @author    Bifrost
 * @copyright Copyright (c) 2026, WordPress
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/wptrainingteam/developer-showcase
 */

declare(strict_types=1);

namespace Bifrost\Music\Support;

use Bifrost\Music\Content\{Album, Artist, Genre};

/**
 * Aggregates the primitive capabilities registered by the plugin.
 */
final class Capabilities
{
	public static function all(): array
	{
		return array_values(array_merge(
			Album::PRIMITIVE_CAPS,
			Artist::PRIMITIVE_CAPS,
			Genre::PRIMITIVE_CAPS
		));
	}
}
