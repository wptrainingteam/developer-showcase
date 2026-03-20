<?php

/**
 * Taxonomy service.
 *
 * @author    Bifrost
 * @copyright Copyright (c) 2026
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/wptrainingteam/developer-showcase
 */

declare(strict_types=1);

namespace Bifrost\Music\Content;

use Bifrost\Framework\Contracts\Bootable;
use Bifrost\Music\Support\Definitions;

final class Genre implements Bootable
{
	/**
	 * Primitive capabilities assigned to roles.
	 */
	public const PRIMITIVE_CAPS = [
		'manage_terms' => 'manage_music_genres',
		'edit_terms'   => 'edit_music_genres',
		'delete_terms' => 'delete_music_genres',
		'assign_terms' => 'assign_music_genres'
	];

	/**
	 * {@inheritDoc}
	 */
	public function boot(): void
	{
		add_action('init', $this->register(...), 9);

		add_filter('term_updated_messages', $this->termUpdatedMessages(...), 5);
	}

	/**
	 * Registers the taxonomies.
	 */
	private function register(): void
	{
		register_taxonomy(
			Definitions::TAXONOMY_GENRE,
			[ Definitions::POST_TYPE_ALBUM ],
			[
				'public'            => true,
				'show_ui'           => true,
				'show_in_nav_menus' => true,
				'show_in_rest'      => true,
				'show_tagcloud'     => true,
				'show_admin_column' => true,
				'hierarchical'      => false,
				'query_var'         => Definitions::TAXONOMY_GENRE,
				'capabilities'      => self::PRIMITIVE_CAPS,
				'labels' => [
					'name'                  => __('Genres',                 'bifrost-music'),
					'singular_name'         => __('Genre',                  'bifrost-music'),
					'menu_name'             => __('Genres',                 'bifrost-music'),
					'name_admin_bar'        => __('Genre',                  'bifrost-music'),
					'search_items'          => __('Search Genres',          'bifrost-music'),
					'popular_items'         => __('Popular Genres',         'bifrost-music'),
					'all_items'             => __('All Genres',             'bifrost-music'),
					'edit_item'             => __('Edit Genre',             'bifrost-music'),
					'view_item'             => __('View Genre',             'bifrost-music'),
					'update_item'           => __('Update Genre',           'bifrost-music'),
					'add_new_item'          => __('Add New Genre',          'bifrost-music'),
					'new_item_name'         => __('New Genre Name',         'bifrost-music'),
					'not_found'             => __('No genres found.',       'bifrost-music'),
					'no_terms'              => __('No genres',              'bifrost-music'),
					'items_list_navigation' => __('Genres list navigation', 'bifrost-music'),
					'items_list'            => __('Genres list',            'bifrost-music'),

					// Non-hierarchical only.
					'separate_items_with_commas' => __('Separate genres with commas',      'bifrost-music'),
					'add_or_remove_items'        => __('Add or remove genres',             'bifrost-music'),
					'choose_from_most_used'      => __('Choose from the most used genres', 'bifrost-music')
				],

				// The rewrite handles the URL structure.
				'rewrite' => [
					'slug'         => 'genres',
					'with_front'   => false,
					'hierarchical' => false,
					'ep_mask'      => EP_NONE
				]
			]
		);
	}

	/**
	 * Filters the term updated messages in the admin.
	 */
	private function termUpdatedMessages(array $messages): array
	{
		// Add the music genre messages.
		$messages[Definitions::TAXONOMY_GENRE] = [
			0 => '',
			1 => __('Genre added.',       'bifrost-music'),
			2 => __('Genre deleted.',     'bifrost-music'),
			3 => __('Genre updated.',     'bifrost-music'),
			4 => __('Genre not added.',   'bifrost-music'),
			5 => __('Genre not updated.', 'bifrost-music'),
			6 => __('Genres deleted.',    'bifrost-music'),
		];

		return $messages;
	}
}
