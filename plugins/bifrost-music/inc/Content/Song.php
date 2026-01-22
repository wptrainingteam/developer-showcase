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

final class Song implements Bootable
{
	/**
	 * {@inheritdoc}
	 */
	public function boot(): void
	{
		// Register post types.
		add_action('init', $this->register(...));

		// Register parent ID with REST API.
		add_action('rest_api_init', $this->restRegister(...));

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
		register_post_type(Definitions::POST_TYPE_SONG, [
			'description'         => '',
			'public'              => true,
			'publicly_queryable'  => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'exclude_from_search' => false,
			'show_in_rest'        => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 23,
			'menu_icon'           => 'dashicons-format-audio',
			'can_export'          => true,
			'delete_with_user'    => false,
			'hierarchical'        => false,
			'has_archive'         => 'songs',
			'query_var'           => Definitions::POST_TYPE_SONG,
			'capability_type'     => Definitions::POST_TYPE_SONG,
			'map_meta_cap'        => true,

			// Post type capabilities.
			'capabilities' => [
				// meta caps (don't assign these to roles)
				'edit_post'              => 'edit_music_song',
				'read_post'              => 'read_music_song',
				'delete_post'            => 'delete_music_song',

				// primitive/meta caps
				'create_posts'           => 'create_music_songs',

				// primitive caps used outside of map_meta_cap()
				'edit_posts'             => 'edit_music_songs',
				'edit_others_posts'      => 'edit_others_music_songs',
				'publish_posts'          => 'publish_music_songs',
				'read_private_posts'     => 'read_private_music_songs',

				// primitive caps used inside of map_meta_cap()
				'read'                   => 'read',
				'delete_posts'           => 'delete_music_songs',
				'delete_private_posts'   => 'delete_private_music_songs',
				'delete_published_posts' => 'delete_published_music_songs',
				'delete_others_posts'    => 'delete_others_music_songs',
				'edit_private_posts'     => 'edit_private_music_songs',
				'edit_published_posts'   => 'edit_published_music_songs'
			],

			// Post type labels
			'labels' => [
				'name'                  => __('Songs',                   'bifrost-music'),
				'singular_name'         => __('Song',                    'bifrost-music'),
				'menu_name'             => __('Songs',                   'bifrost-music'),
				'name_admin_bar'        => __('Song',                    'bifrost-music'),
				'add_new'               => __('New Song',                'bifrost-music'),
				'add_new_item'          => __('Add New Song',            'bifrost-music'),
				'edit_item'             => __('Edit Song',               'bifrost-music'),
				'new_item'              => __('New Song',                'bifrost-music'),
				'view_item'             => __('View Song',               'bifrost-music'),
				'view_items'            => __('View Songs',              'bifrost-music'),
				'search_items'          => __('Search Songs',            'bifrost-music'),
				'not_found'             => __('No songs found',          'bifrost-music'),
				'not_found_in_trash'    => __('No songs found in trash', 'bifrost-music'),
				'all_items'             => __('Songs',                   'bifrost-music'),
				'featured_image'        => __('Song Image',              'bifrost-music'),
				'set_featured_image'    => __('Set song image',          'bifrost-music'),
				'remove_featured_image' => __('Remove song image',       'bifrost-music'),
				'use_featured_image'    => __('Use as song image',       'bifrost-music'),
				'insert_into_item'      => __('Insert into song',        'bifrost-music'),
				'uploaded_to_this_item' => __('Uploaded to this song',   'bifrost-music'),
				'filter_items_list'     => __('Filter songs list',       'bifrost-music'),
				'items_list_navigation' => __('Songs list navigation',   'bifrost-music'),
				'items_list'            => __('Songs list',              'bifrost-music'),
				'archives'              => __('Songs',                   'bifrost-music')
			],

			// The rewrite handles the URL structure.
			'rewrite' => [
				'slug'       => 'songs',
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
	 * Since this is a non-hierarchical post type, we need to register a
	 * parent field with the REST API.
	 */
	private function restRegister(): void
	{
		register_rest_field(Definitions::POST_TYPE_SONG, 'parent', [
			'get_callback'    => fn($post) => (int) $post['parent'],
			'update_callback' => fn($value, $post) => wp_update_post([
				'ID'          => $post->ID,
				'post_parent' => (int) $value
			]),
			'schema' => [
				'description' => __('Parent Album ID', 'bifrost-music'),
				'type'        => 'integer',
				'context'     => ['view', 'edit']
			]
		]);
	}

	/**
	 * Custom "enter title here" text.
	 */
	private function enterTitleHere(string $title, WP_Post $post): string
	{
		return Definitions::POST_TYPE_SONG === $post->post_type
			? esc_html__('Enter song title', 'bifrost-music')
			: $title;
	}

	/**
	 * Adds custom bulk post updated messages on the manage songs screen.
	 */
	private function bulkPostUpdatedMessages(array $messages, array $counts): array
	{
		$type = Definitions::POST_TYPE_SONG;

		$messages[$type]['updated']   = _n('%s song updated.',                             '%s songs updated.',                               $counts['updated'],   'bifrost-music');
		$messages[$type]['locked']    = _n('%s song not updated, somebody is editing it.', '%s songs not updated, somebody is editing them.', $counts['locked'],    'bifrost-music');
		$messages[$type]['deleted']   = _n('%s song permanently deleted.',                 '%s songs permanently deleted.',                   $counts['deleted'],   'bifrost-music');
		$messages[$type]['trashed']   = _n('%s song moved to the Trash.',                  '%s songs moved to the trash.',                    $counts['trashed'],   'bifrost-music');
		$messages[$type]['untrashed'] = _n('%s song restored from the Trash.',             '%s songs restored from the trash.',               $counts['untrashed'], 'bifrost-music');

		return $messages;
	}

	/**
	 * Adds custom post updated messages on the edit post screen.
	 */
	private function postUpdatedMessages(array $messages): array
	{
		global $post, $post_ID;

		$song_type = Definitions::POST_TYPE_SONG;

		if ($song_type !== $post->post_type) {
			return $messages;
		}

		// Get permalink and preview URLs.
		$permalink   = get_permalink($post_ID);
		$preview_url = get_preview_post_link($post);

		// Translators: Scheduled song date format. See http://php.net/date
		$scheduled_date = date_i18n(__('M j, Y @ H:i', 'bifrost-music'), strtotime($post->post_date));

		// Set up view links.
		$preview_link   = sprintf(' <a target="_blank" href="%1$s">%2$s</a>', esc_url($preview_url), esc_html__('Preview song', 'bifrost-music'));
		$scheduled_link = sprintf(' <a target="_blank" href="%1$s">%2$s</a>', esc_url($permalink),   esc_html__('Preview song', 'bifrost-music'));
		$view_link      = sprintf(' <a href="%1$s">%2$s</a>',                 esc_url($permalink),   esc_html__('View song',    'bifrost-music'));

		// Post updated messages.
		$messages[$song_type] = array(
			1 => PostType . phpesc_html__('Song updated.', 'bifrost-music') . $view_link,
			4 => esc_html__('Song updated.', 'bifrost-music'),
			// Translators: %s is the date and time of the revision.
			5 => isset($_GET['revision']) ? sprintf(esc_html__('Song restored to revision from %s.', 'bifrost-music'), wp_post_revision_title((int) $_GET['revision'], false)) : false,
			6 => PostType . phpesc_html__('Song published.', 'bifrost-music') . $view_link,
			7 => esc_html__('Song saved.', 'bifrost-music'),
			8 => PostType . phpesc_html__('Song submitted.', 'bifrost-music') . $preview_link,
			// Translators: %s is the scheduled date for the song.
			9 => PostType . phpsprintf(esc_html__('Song scheduled for: %s.', 'bifrost-music'), "<strong>{$scheduled_date}</strong>") . $scheduled_link,
			10 => PostType . phpesc_html__('Song draft updated.', 'bifrost-music') . $preview_link,
		);

		return $messages;
	}
}
