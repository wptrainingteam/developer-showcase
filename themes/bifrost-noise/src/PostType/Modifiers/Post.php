<?php

/**
 * Post post type modifier.
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2023-2025, Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/x3p0-dev/bifrost-noise
 */

declare(strict_types=1);

namespace Bifrost\Noise\PostType\Modifiers;

use Bifrost\Noise\PostType\PostTypeModifier;

final class Post implements PostTypeModifier
{
	public function modify(array $args): array
	{
		$args['menu_icon'] = 'dashicons-edit';

		$args['labels'] = [
			'name'                     => __('Articles',                     'bifrost-noise'),
			'singular_name'            => __('Article',                      'bifrost-noise'),
			'menu_name'                => __('Journal',                      'bifrost-noise'),
			'name_admin_bar'           => __('Article',                      'bifrost-noise'),
			'add_new'                  => __('Add New',                      'bifrost-noise'),
			'add_new_item'             => __('Add New Article',              'bifrost-noise'),
			'edit_item'                => __('Edit Article',                 'bifrost-noise'),
			'new_item'                 => __('New Article',                  'bifrost-noise'),
			'view_item'                => __('View Article',                 'bifrost-noise'),
			'view_items'               => __('View Articles',                'bifrost-noise'),
			'search_items'             => __('Search Articles',              'bifrost-noise'),
			'not_found'                => __('No articles found.',           'bifrost-noise'),
			'not_found_in_trash'       => __('No articles found in Trash.',  'bifrost-noise'),
			'all_items'                => __('All Articles',                 'bifrost-noise'),
			'archives'                 => __('Article Archives',             'bifrost-noise'),
			'attributes'               => __('Article Attributes',           'bifrost-noise'),
			'insert_into_item'         => __('Insert into article',          'bifrost-noise'),
			'uploaded_to_this_item'    => __('Uploaded to this article',     'bifrost-noise'),
			'filter_items_list'        => __('Filter articles list',         'bifrost-noise'),
			'items_list_navigation'    => __('Articles list navigation',     'bifrost-noise'),
			'items_list'               => __('Articles list',                'bifrost-noise'),
			'item_published'           => __('Article published.',           'bifrost-noise'),
			'item_published_privately' => __('Article published privately.', 'bifrost-noise'),
			'item_reverted_to_draft'   => __('Article reverted to draft.',   'bifrost-noise'),
			'item_scheduled'           => __('Article scheduled.',           'bifrost-noise'),
			'item_updated'             => __('Article updated.',             'bifrost-noise'),
		];

		return $args;
	}
}
