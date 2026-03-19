<?php

/**
 * Bootable interface.
 *
 * @author    Bifrost
 * @copyright Copyright (c) 2026
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/wptrainingteam/developer-showcase
 */

declare(strict_types=1);

namespace Bifrost\Player\Contracts;

/**
 * Defines the contract that bootable classes should utilize.
 */
interface Bootable
{
	/**
	 * Boots any necessary code that needs to run.
	 */
	public function boot(): void;
}
