<?php
/**
 * Plugin Name: AI Album Finder
 * Plugin URI: https://github.com/wptrainingteam/developer-showcase/
 * Description: An AI chatbot that helps users discover music albums based on their preferences. Uses the WordPress AI SDK and Abilities API to surface album recommendations from your music collection.
 * Requires at least: 6.8
 * Requires PHP: 8.0
 * Version: 1.0.0
 * Author: WordPress Training Team
 * License: GPLv2 or later
 * License URI: https://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * Text Domain: ai-album-finder
 *
 * @package ai-album-finder
 */

// This loader file should remain compatible with PHP 5.2.

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'AI_ALBUM_FINDER_VERSION', '1.0.0' );
define( 'AI_ALBUM_FINDER_MINIMUM_PHP', '8.0' );
define( 'AI_ALBUM_FINDER_MINIMUM_WP', '6.8' );
define( 'AI_ALBUM_FINDER_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'AI_ALBUM_FINDER_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

/**
 * Checks basic requirements and loads the plugin.
 *
 * @since 1.0.0
 */
function ai_album_finder_load() {
	static $loaded = false;

	// Check for supported PHP version.
	if (
		version_compare( phpversion(), AI_ALBUM_FINDER_MINIMUM_PHP, '<' )
		|| version_compare( get_bloginfo( 'version' ), AI_ALBUM_FINDER_MINIMUM_WP, '<' )
	) {
		add_action( 'admin_notices', 'ai_album_finder_display_version_requirements_notice' );
		return;
	}

	// Register the autoloader.
	if ( ! ai_album_finder_register_autoloader() ) {
		add_action( 'admin_notices', 'ai_album_finder_display_composer_autoload_notice' );
		return;
	}

	// Prevent loading the plugin twice.
	if ( $loaded ) {
		return;
	}
	$loaded = true;

	// Load the plugin.
	$class_name = 'AI_Album_Finder\Plugin_Main';
	$instance   = new $class_name( __FILE__ );
	$instance->add_hooks();
}

/**
 * Registers the plugin autoloader.
 *
 * @since 1.0.0
 *
 * @return bool True on success, false on failure.
 */
function ai_album_finder_register_autoloader() {
	static $registered = null;

	// Prevent multiple executions.
	if ( null !== $registered ) {
		return $registered;
	}

	// Check for the built autoloader class map as that needs to be used for a production build.
	$autoload_file             = plugin_dir_path( __FILE__ ) . 'includes/vendor/composer/autoload_classmap.php';
	$third_party_autoload_file = plugin_dir_path( __FILE__ ) . 'third-party/vendor/composer/autoload_classmap.php';
	if ( file_exists( $autoload_file ) && file_exists( $third_party_autoload_file ) ) {
		require_once plugin_dir_path( __FILE__ ) . 'includes/Plugin_Autoloader.php';

		$class_name = 'AI_Album_Finder\Plugin_Autoloader';

		$instance = new $class_name( 'AI_Album_Finder', $autoload_file );
		spl_autoload_register( array( $instance, 'autoload' ), true, true );

		$third_party_instance = new $class_name( 'AI_Album_Finder_Dependencies', $third_party_autoload_file );
		spl_autoload_register( array( $third_party_instance, 'autoload' ), true, true );

		// Manually load the WordPress Abilities API.
		$abilities_file = plugin_dir_path( __FILE__ ) . 'third-party/wordpress/abilities-api/includes/bootstrap.php';
		if ( file_exists( $abilities_file ) ) {
			require_once $abilities_file;
		}

		$registered = true;
		return true;
	}

	// Otherwise, the autoloader is missing.
	$registered = false;
	return false;
}

/**
 * Displays admin notice about unmet PHP version requirement.
 *
 * @since 1.0.0
 */
function ai_album_finder_display_version_requirements_notice() {
	echo '<div class="notice notice-error"><p>';
	echo esc_html(
		sprintf(
			/* translators: 1: required PHP version, 2: required WP version, 3: current PHP version, 4: current WP version */
			__( 'AI Album Finder requires at least PHP version %1$s and WordPress version %2$s. Your site is currently using PHP %3$s and WordPress %4$s.', 'ai-album-finder' ),
			AI_ALBUM_FINDER_MINIMUM_PHP,
			AI_ALBUM_FINDER_MINIMUM_WP,
			phpversion(),
			get_bloginfo( 'version' )
		)
	);
	echo '</p></div>';
}

/**
 * Displays admin notice about missing Composer autoload files.
 *
 * @since 1.0.0
 */
function ai_album_finder_display_composer_autoload_notice() {
	echo '<div class="notice notice-error"><p>';
	printf(
		/* translators: %s: composer install command */
		esc_html__( 'Your installation of AI Album Finder is incomplete. Please run %s.', 'ai-album-finder' ),
		'<code>composer install</code>'
	);
	echo '</p></div>';
}

ai_album_finder_load();
