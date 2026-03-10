<?php

/**
 * Post content service.
 *
 * @author    Bifrost
 * @copyright Copyright (c) 2026
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/wptrainingteam/developer-showcase
 */

declare(strict_types=1);

namespace Bifrost\Music\Content;

use Bifrost\Music\Contracts\Bootable;
use Bifrost\Music\Support\Definitions;

final class Post implements Bootable
{
	/**
	 * {@inheritDoc}
	 */
	public function boot(): void
	{
		add_action('init', $this->register(...), 9);
	}

	/**
	 * Registers post metadata.
	 */
	private function register(): void
	{
		register_post_meta('post', Definitions::POST_META_ARTIST, [
			'show_in_rest'  => true,
			'single'        => true,
			'type'          => 'integer',
			'default'       => 0,
			'description'   => __('The associated artist post ID.', 'bifrost-music'),
			'auth_callback' => fn() => current_user_can('edit_posts'),
		]);

		register_post_meta('post', Definitions::POST_META_ALBUM, [
			'show_in_rest'  => true,
			'single'        => true,
			'type'          => 'integer',
			'default'       => 0,
			'description'   => __('The associated album post ID.', 'bifrost-music'),
			'auth_callback' => fn() => current_user_can('edit_posts'),
		]);
	}
}
