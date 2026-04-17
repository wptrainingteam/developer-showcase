<?php
/**
 * Plugin Name: AI Album Finder
 * Description: A WordPress plugin that uses AI to help users find music albums based on their preferences.
 * Version: 1.0.0
 * Author: The WordPress Contributors
 * License: GPL-2.0-or-later
 *
 * @package ai-album-finder
 */

define( "PLUGIN_DIR", plugin_dir_path( __FILE__ ) );
define( "PLUGIN_URL", plugins_url( '', __FILE__ ) );

use Developer_Showcase\AI_Album_Finder\Plugin_Main;
use Developer_Showcase\AI_Album_Finder\Chatbot_Assets;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
	require_once dirname( __FILE__ ) . '/vendor/autoload.php';
}

function devshow_ai_album_finder_load(){
// Load the plugin.
	$plugin_main   = new Plugin_Main();
	$plugin_main->add_hooks();

	$chatbot_assets = new Chatbot_Assets( PLUGIN_DIR, PLUGIN_URL );
	$chatbot_assets->add_hooks();

}

devshow_ai_album_finder_load();
