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
use Bifrost\Framework\Contracts\Bootable;
use Bifrost\Music\Support\Definitions;

final class Artist implements Bootable
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
		register_post_type(Definitions::POST_TYPE_ARTIST, [
			'description'         => '',
			'public'              => true,
			'publicly_queryable'  => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'exclude_from_search' => false,
			'show_in_rest'        => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 21,
			'menu_icon'           => 'dashicons-id',
			'can_export'          => true,
			'delete_with_user'    => false,
			'hierarchical'        => false,
			'has_archive'         => 'artists',
			'query_var'           => Definitions::POST_TYPE_ARTIST,
			'capability_type'     => Definitions::POST_TYPE_ARTIST,
			'map_meta_cap'        => true,

			// Post type capabilities.
			'capabilities' => [
				// meta caps (don't assign these to roles)
				'edit_post'              => 'edit_music_artist',
				'read_post'              => 'read_music_artist',
				'delete_post'            => 'delete_music_artist',

				// primitive/meta caps
				'create_posts'           => 'create_music_artists',

				// primitive caps used outside of map_meta_cap()
				'edit_posts'             => 'edit_music_artists',
				'edit_others_posts'      => 'edit_others_music_artists',
				'publish_posts'          => 'publish_music_artists',
				'read_private_posts'     => 'read_private_music_artists',

				// primitive caps used inside of map_meta_cap()
				'read'                   => 'read',
				'delete_posts'           => 'delete_music_artists',
				'delete_private_posts'   => 'delete_private_music_artists',
				'delete_published_posts' => 'delete_published_music_artists',
				'delete_others_posts'    => 'delete_others_music_artists',
				'edit_private_posts'     => 'edit_private_music_artists',
				'edit_published_posts'   => 'edit_published_music_artists'
			],

			// Post type labels
			'labels' => [
				'name'                  => __('Artists',                   'bifrost-music'),
				'singular_name'         => __('Artist',                    'bifrost-music'),
				'menu_name'             => __('Artists',                   'bifrost-music'),
				'name_admin_bar'        => __('Artist',                    'bifrost-music'),
				'add_new'               => __('New Artist',                'bifrost-music'),
				'add_new_item'          => __('Add New Artist',            'bifrost-music'),
				'edit_item'             => __('Edit Artist',               'bifrost-music'),
				'new_item'              => __('New Artist',                'bifrost-music'),
				'view_item'             => __('View Artist',               'bifrost-music'),
				'view_items'            => __('View Artists',              'bifrost-music'),
				'search_items'          => __('Search Artists',            'bifrost-music'),
				'not_found'             => __('No artists found',          'bifrost-music'),
				'not_found_in_trash'    => __('No artists found in trash', 'bifrost-music'),
				'all_items'             => __('Artists',                   'bifrost-music'),
				'featured_image'        => __('Artist Image',              'bifrost-music'),
				'set_featured_image'    => __('Set artist image',          'bifrost-music'),
				'remove_featured_image' => __('Remove artist image',       'bifrost-music'),
				'use_featured_image'    => __('Use as artist image',       'bifrost-music'),
				'insert_into_item'      => __('Insert into artist',        'bifrost-music'),
				'uploaded_to_this_item' => __('Uploaded to this artist',   'bifrost-music'),
				'filter_items_list'     => __('Filter artists list',       'bifrost-music'),
				'items_list_navigation' => __('Artists list navigation',   'bifrost-music'),
				'items_list'            => __('Artists list',              'bifrost-music'),
				'archives'              => __('Artists',                   'bifrost-music')
			],

			// The rewrite handles the URL structure.
			'rewrite' => [
				'slug'       => 'artists',
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
		return Definitions::POST_TYPE_ARTIST === $post->post_type
			? esc_html__('Enter artist title', 'bifrost-music')
			: $title;
	}

	/**
	 * Adds custom bulk post updated messages on the manage artists screen.
	 */
	private function bulkPostUpdatedMessages(array $messages, array $counts): array
	{
		$type = Definitions::POST_TYPE_ARTIST;

		$messages[$type]['updated']   = _n('%s artist updated.',                             '%s artists updated.',                               $counts['updated'],   'bifrost-music');
		$messages[$type]['locked']    = _n('%s artist not updated, somebody is editing it.', '%s artists not updated, somebody is editing them.', $counts['locked'],    'bifrost-music');
		$messages[$type]['deleted']   = _n('%s artist permanently deleted.',                 '%s artists permanently deleted.',                   $counts['deleted'],   'bifrost-music');
		$messages[$type]['trashed']   = _n('%s artist moved to the Trash.',                  '%s artists moved to the trash.',                    $counts['trashed'],   'bifrost-music');
		$messages[$type]['untrashed'] = _n('%s artist restored from the Trash.',             '%s artists restored from the trash.',               $counts['untrashed'], 'bifrost-music');

		return $messages;
	}

	/**
	 * Adds custom post updated messages on the edit post screen.
	 */
	private function postUpdatedMessages(array $messages): array
	{
		global $post, $post_ID;

		$artist_type = Definitions::POST_TYPE_ARTIST;

		if ($artist_type !== $post->post_type) {
			return $messages;
		}

		// Get permalink and preview URLs.
		$permalink   = get_permalink($post_ID);
		$preview_url = get_preview_post_link($post);

		// Translators: Scheduled artist date format. See http://php.net/date
		$scheduled_date = date_i18n(__('M j, Y @ H:i', 'bifrost-music'), strtotime($post->post_date));

		// Set up view links.
		$preview_link   = sprintf(' <a target="_blank" href="%1$s">%2$s</a>', esc_url($preview_url), esc_html__('Preview artist', 'bifrost-music'));
		$scheduled_link = sprintf(' <a target="_blank" href="%1$s">%2$s</a>', esc_url($permalink),   esc_html__('Preview artist', 'bifrost-music'));
		$view_link      = sprintf(' <a href="%1$s">%2$s</a>',                 esc_url($permalink),   esc_html__('View artist',    'bifrost-music'));

		// Post updated messages.
		$messages[$artist_type] = array(
			1 => esc_html__('Artist updated.', 'bifrost-music') . $view_link,
			4 => esc_html__('Artist updated.', 'bifrost-music'),
			// Translators: %s is the date and time of the revision.
			5 => isset($_GET['revision']) ? sprintf(esc_html__('Artist restored to revision from %s.', 'bifrost-music'), wp_post_revision_title((int) $_GET['revision'], false)) : false,
			6 => esc_html__('Artist published.', 'bifrost-music') . $view_link,
			7 => esc_html__('Artist saved.', 'bifrost-music'),
			8 => esc_html__('Artist submitted.', 'bifrost-music') . $preview_link,
			// Translators: %s is the scheduled date for the artist.
			9 => sprintf(esc_html__('Artist scheduled for: %s.', 'bifrost-music'), "<strong>{$scheduled_date}</strong>") . $scheduled_link,
			10 => esc_html__('Artist draft updated.', 'bifrost-music') . $preview_link,
		);

		return $messages;
	}
}
