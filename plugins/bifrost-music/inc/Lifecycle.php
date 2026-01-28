<?php

/**
 * Plugin lifecycle helper.
 *
 * @author    Bifrost
 * @copyright Copyright (c) 2026, WordPress
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/wptrainingteam/developer-showcase
 */

declare(strict_types=1);

namespace Bifrost\Music;

/**
 * A static class that handles the various duties during the plugin's lifecycle.
 * This class includes static methods for activating, deactivating, uninstalling,
 * and bootstrapping the plugin.
 */
final class Lifecycle
{
	/**
	 * Initializes the plugin and should be used as a callback on the
	 * `plugins_loaded` action hook.
	 */
	public static function init(): void
	{
		plugin();
	}

	/**
	 * Bootstraps the plugin and should be used as a callback on the
	 * `plugins_loaded` action hook.
	 */
	public static function boot(): void
	{
		plugin()->boot();
	}

	/**
	 * Runs when the plugin is activated and should be called via the
	 * `register_activation_hook()` function.
	 */
	public static function activate(): void
	{
		if ($role = get_role('administrator')) {
			// Taxonomy caps.
			$role->add_cap('manage_music_genres');
			$role->add_cap('edit_music_genres');
			$role->add_cap('delete_music_genres');
			$role->add_cap('assign_music_genres');

			// Album caps.
			$role->add_cap('create_music_albums');
			$role->add_cap('edit_music_albums');
			$role->add_cap('edit_others_music_albums');
			$role->add_cap('publish_music_albums');
			$role->add_cap('read_private_music_albums');
			$role->add_cap('delete_music_albums');
			$role->add_cap('delete_private_music_albums');
			$role->add_cap('delete_published_music_albums');
			$role->add_cap('delete_others_music_albums');
			$role->add_cap('edit_private_music_albums');
			$role->add_cap('edit_published_music_albums');

			// Artist caps.
			$role->add_cap('create_music_artists');
			$role->add_cap('edit_music_artists');
			$role->add_cap('edit_others_music_artists');
			$role->add_cap('publish_music_artists');
			$role->add_cap('read_private_music_artists');
			$role->add_cap('delete_music_artists');
			$role->add_cap('delete_private_music_artists');
			$role->add_cap('delete_published_music_artists');
			$role->add_cap('delete_others_music_artists');
			$role->add_cap('edit_private_music_artists');
			$role->add_cap('edit_published_music_artists');

			// Song caps.
			$role->add_cap('create_music_songs');
			$role->add_cap('edit_music_songs');
			$role->add_cap('edit_others_music_songs');
			$role->add_cap('publish_music_songs');
			$role->add_cap('read_private_music_songs');
			$role->add_cap('delete_music_songs');
			$role->add_cap('delete_private_music_songs');
			$role->add_cap('delete_published_music_songs');
			$role->add_cap('delete_others_music_songs');
			$role->add_cap('edit_private_music_songs');
			$role->add_cap('edit_published_music_songs');
		}
	}

	/**
	 * Runs when the plugin is deactivated and should be called via the
	 * `register_deactivation_hook()` function.
	 */
	public static function deactivate(): void
	{}

	/**
	 * Runs when the plugin is uninstalled and should be called via the
	 * `register_uninstall_hook()` function.
	 */
	public static function uninstall(): void
	{
		if (! defined('WP_UNINSTALL_PLUGIN')) {
			wp_die(sprintf(
				__('%s should only be called when uninstalling the plugin.', 'bifrost-music'),
				'<code>' . __METHOD__ . '</code>'
			));
		}

		// If the administrator role exists, remove added capabilities
		// that the plugin added.
		if ($role = get_role('administrator')) {

			// Genre caps.
			$role->remove_cap('manage_music_genres');
			$role->remove_cap('edit_music_genres');
			$role->remove_cap('delete_music_genres');
			$role->remove_cap('assign_music_genres');

			// Album caps.
			$role->remove_cap('create_music_albums');
			$role->remove_cap('edit_music_albums');
			$role->remove_cap('edit_others_music_albums');
			$role->remove_cap('publish_music_albums');
			$role->remove_cap('read_private_music_albums');
			$role->remove_cap('delete_music_albums');
			$role->remove_cap('delete_private_music_albums');
			$role->remove_cap('delete_published_music_albums');
			$role->remove_cap('delete_others_music_albums');
			$role->remove_cap('edit_private_music_albums');
			$role->remove_cap('edit_published_music_albums');

			// Artist caps.
			$role->remove_cap('create_music_artists');
			$role->remove_cap('edit_music_artists');
			$role->remove_cap('edit_others_music_artists');
			$role->remove_cap('publish_music_artists');
			$role->remove_cap('read_private_music_artists');
			$role->remove_cap('delete_music_artists');
			$role->remove_cap('delete_private_music_artists');
			$role->remove_cap('delete_published_music_artists');
			$role->remove_cap('delete_others_music_artists');
			$role->remove_cap('edit_private_music_artists');
			$role->remove_cap('edit_published_music_artists');

			// Song caps.
			$role->remove_cap('create_music_songs');
			$role->remove_cap('edit_music_songs');
			$role->remove_cap('edit_others_music_songs');
			$role->remove_cap('publish_music_songs');
			$role->remove_cap('read_private_music_songs');
			$role->remove_cap('delete_music_songs');
			$role->remove_cap('delete_private_music_songs');
			$role->remove_cap('delete_published_music_songs');
			$role->remove_cap('delete_others_music_songs');
			$role->remove_cap('edit_private_music_songs');
			$role->remove_cap('edit_published_music_songs');
		}
	}
}
