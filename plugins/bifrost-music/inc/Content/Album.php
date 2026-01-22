<?php

/**
 * Post type service.
 *
 * @author    Bifrost
 * @copyright Copyright (c) 2026
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/wptrainingteam/developer-showcase
 */

declare(strict_types=1);

namespace Bifrost\Music\Content;

use WP_Post;
use Bifrost\Music\Contracts\Bootable;
use Bifrost\Music\Support\Definitions;

final class Album implements Bootable
{
	/**
	 * {@inheritdoc}
	 */
	public function boot(): void
	{
		// Register post types.
		add_action('init', $this->register(...));

		// Filter the "enter title here" text.
		add_filter('enter_title_here', $this->enterTitleHere(...), 10, 2);

		// Filter the bulk and post updated messages.
		add_filter('bulk_post_updated_messages', $this->bulkPostUpdatedMessages(...), 5, 2);
		add_filter('post_updated_messages', $this->postUpdatedMessages(...), 5);
	}

	/**
	 * Registers the post type.
	 */
	private function register(): void
	{
		register_post_type(Definitions::POST_TYPE_ALBUM, [
			'description'         => '',
			'public'              => true,
			'publicly_queryable'  => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'exclude_from_search' => false,
			'show_in_rest'        => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 22,
			'menu_icon'           => 'dashicons-playlist-audio',
			'can_export'          => true,
			'delete_with_user'    => false,
			'hierarchical'        => false,
			'has_archive'         => 'albums',
			'query_var'           => Definitions::POST_TYPE_ALBUM,
			'capability_type'     => Definitions::POST_TYPE_ALBUM,
			'map_meta_cap'        => true,

			// Post type capabilities.
			'capabilities' => [
				// meta caps (don't assign these to roles)
				'edit_post'              => 'edit_music_album',
				'read_post'              => 'read_music_album',
				'delete_post'            => 'delete_music_album',

				// primitive/meta caps
				'create_posts'           => 'create_music_albums',

				// primitive caps used outside of map_meta_cap()
				'edit_posts'             => 'edit_music_albums',
				'edit_others_posts'      => 'edit_others_music_albums',
				'publish_posts'          => 'publish_music_albums',
				'read_private_posts'     => 'read_private_music_albums',

				// primitive caps used inside of map_meta_cap()
				'read'                   => 'read',
				'delete_posts'           => 'delete_music_albums',
				'delete_private_posts'   => 'delete_private_music_albums',
				'delete_published_posts' => 'delete_published_music_albums',
				'delete_others_posts'    => 'delete_others_music_albums',
				'edit_private_posts'     => 'edit_private_music_albums',
				'edit_published_posts'   => 'edit_published_music_albums'
			],

			// Post type labels
			'labels' => [
				'name'                  => __('Albums',                   'bifrost-music'),
				'singular_name'         => __('Album',                    'bifrost-music'),
				'menu_name'             => __('Albums',                   'bifrost-music'),
				'name_admin_bar'        => __('Album',                    'bifrost-music'),
				'add_new'               => __('New Album',                'bifrost-music'),
				'add_new_item'          => __('Add New Album',            'bifrost-music'),
				'edit_item'             => __('Edit Album',               'bifrost-music'),
				'new_item'              => __('New Album',                'bifrost-music'),
				'view_item'             => __('View Album',               'bifrost-music'),
				'view_items'            => __('View Albums',              'bifrost-music'),
				'search_items'          => __('Search Albums',            'bifrost-music'),
				'not_found'             => __('No albums found',          'bifrost-music'),
				'not_found_in_trash'    => __('No albums found in trash', 'bifrost-music'),
				'all_items'             => __('Albums',                   'bifrost-music'),
				'featured_image'        => __('Album Image',              'bifrost-music'),
				'set_featured_image'    => __('Set album image',          'bifrost-music'),
				'remove_featured_image' => __('Remove album image',       'bifrost-music'),
				'use_featured_image'    => __('Use as album image',       'bifrost-music'),
				'insert_into_item'      => __('Insert into album',        'bifrost-music'),
				'uploaded_to_this_item' => __('Uploaded to this album',   'bifrost-music'),
				'filter_items_list'     => __('Filter albums list',       'bifrost-music'),
				'items_list_navigation' => __('Albums list navigation',   'bifrost-music'),
				'items_list'            => __('Albums list',              'bifrost-music'),
				'archives'              => __('Albums',                   'bifrost-music')
			],

			// The rewrite handles the URL structure.
			'rewrite' => [
				'slug'       => 'albums',
				'with_front' => false,
				'pages'      => true,
				'feeds'      => true,
				'ep_mask'    => EP_PERMALINK,
			],

			// What features the post type supports.
			'supports' => [
				'title',
				'editor',
				'excerpt',
				'author',
				'custom-fields',
				'thumbnail'
			]
		]);
	}

	/**
	 * Custom "enter title here" text.
	 */
	private function enterTitleHere(string $title, WP_Post $post): string
	{
		return Definitions::POST_TYPE_ALBUM === $post->post_type
			? esc_html__('Enter album title', 'bifrost-music')
			: $title;
	}

	/**
	 * Adds custom bulk post updated messages on the manage albums screen.
	 */
	private function bulkPostUpdatedMessages(array $messages, array $counts): array
	{
		$type = Definitions::POST_TYPE_ALBUM;

		$messages[$type]['updated']   = _n('%s album updated.',                             '%s albums updated.',                               $counts['updated'],   'bifrost-music');
		$messages[$type]['locked']    = _n('%s album not updated, somebody is editing it.', '%s albums not updated, somebody is editing them.', $counts['locked'],    'bifrost-music');
		$messages[$type]['deleted']   = _n('%s album permanently deleted.',                 '%s albums permanently deleted.',                   $counts['deleted'],   'bifrost-music');
		$messages[$type]['trashed']   = _n('%s album moved to the Trash.',                  '%s albums moved to the trash.',                    $counts['trashed'],   'bifrost-music');
		$messages[$type]['untrashed'] = _n('%s album restored from the Trash.',             '%s albums restored from the trash.',               $counts['untrashed'], 'bifrost-music');

		return $messages;
	}

	/**
	 * Adds custom post updated messages on the edit post screen.
	 */
	private function postUpdatedMessages(array $messages): array
	{
		global $post, $post_ID;

		$album_type = Definitions::POST_TYPE_ALBUM;

		if ($album_type !== $post->post_type) {
			return $messages;
		}

		// Get permalink and preview URLs.
		$permalink   = get_permalink($post_ID);
		$preview_url = get_preview_post_link($post);

		// Translators: Scheduled album date format. See http://php.net/date
		$scheduled_date = date_i18n(__('M j, Y @ H:i', 'bifrost-music'), strtotime($post->post_date));

		// Set up view links.
		$preview_link   = sprintf(' <a target="_blank" href="%1$s">%2$s</a>', esc_url($preview_url), esc_html__('Preview album', 'bifrost-music'));
		$scheduled_link = sprintf(' <a target="_blank" href="%1$s">%2$s</a>', esc_url($permalink),   esc_html__('Preview album', 'bifrost-music'));
		$view_link      = sprintf(' <a href="%1$s">%2$s</a>',                 esc_url($permalink),   esc_html__('View album',    'bifrost-music'));

		// Post updated messages.
		$messages[$album_type] = array(
			1 => PostType . phpesc_html__('Album updated.', 'bifrost-music') . $view_link,
			4 => esc_html__('Album updated.', 'bifrost-music'),
			// Translators: %s is the date and time of the revision.
			5 => isset($_GET['revision']) ? sprintf(esc_html__('Album restored to revision from %s.', 'bifrost-music'), wp_post_revision_title((int) $_GET['revision'], false)) : false,
			6 => PostType . phpesc_html__('Album published.', 'bifrost-music') . $view_link,
			7 => esc_html__('Album saved.', 'bifrost-music'),
			8 => PostType . phpesc_html__('Album submitted.', 'bifrost-music') . $preview_link,
			// Translators: %s is the scheduled date for the album.
			9 => PostType . phpsprintf(esc_html__('Album scheduled for: %s.', 'bifrost-music'), "<strong>{$scheduled_date}</strong>") . $scheduled_link,
			10 => PostType . phpesc_html__('Album draft updated.', 'bifrost-music') . $preview_link,
		);

		return $messages;
	}
}
