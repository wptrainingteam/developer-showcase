<?php

/**
 * Template part registration.
 *
 * @author    Bifrost
 * @copyright Copyright (c) 2026, WordPress
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/wptrainingteam/developer-showcase
 */

declare(strict_types=1);

namespace Bifrost\Noise\Template;

use Bifrost\Framework\Contracts\Bootable;

/**
 * Registers custom template part areas for the theme.
 */
final class TemplatePart implements Bootable
{
	/**
	 * Registers the WordPress filter hooks.
	 */
	public function boot(): void
	{
		add_filter('default_wp_template_part_areas', $this->areas(...));
	}

	/**
	 * Adds custom template part areas to the default set.
	 */
	private function areas(array $areas): array
	{
		$areas[] = [
			'area'        => 'sidebar',
			'area_tag'    => 'section',
			'label'       => __('Sidebar', 'bifrost-noise'),
			'description' => __('Displays contextual sidebar content alongside the main post.', 'bifrost-noise'),
			'icon'        => 'sidebar'
		];

		return $areas;
	}
}
