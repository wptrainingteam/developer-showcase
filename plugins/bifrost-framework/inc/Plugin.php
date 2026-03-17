<?php

/**
 * Framework application class.
 *
 * @author    Bifrost
 * @copyright Copyright (c) 2026, WordPress
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/wptrainingteam/developer-showcase
 */

declare(strict_types=1);

namespace Bifrost\Framework;

use Bifrost\Framework\Core\Application;

/**
 * The primary framework application. Add-on plugins register their service
 * providers via the `bifrost/register` action hook.
 */
final class Plugin extends Application
{
	/**
	 * Defines the framework's namespace, which is used as a hook prefix.
	 */
	protected const NAMESPACE = 'bifrost-framework';
}
