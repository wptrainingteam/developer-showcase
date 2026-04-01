<?php
/**
 * Autoloader.
 *
 * @author    Bifrost
 * @copyright Copyright (c) 2026, WordPress
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/wptrainingteam/developer-showcase
 */

namespace Bifrost\Framework;

class Autoload
{
	/**
	 * Register the autoloader.
	 */
	public static function register(): bool
	{
		return spl_autoload_register([__CLASS__, 'autoload'], true, true);
	}

	/**
	 * Autoloads class if it's in the theme's namespace.
	 */
	public static function autoload(string $class): void
	{
		// Bail if the class is not in our namespace.
		if (! str_starts_with($class, __NAMESPACE__)) {
			return;
		}

		$filename = __DIR__ . sprintf('/%s.php', str_replace(
			[__NAMESPACE__ . '\\', '\\'],
			['', DIRECTORY_SEPARATOR],
			$class
		));

		if (file_exists($filename)) {
			require_once $filename;
		}
	}
}
