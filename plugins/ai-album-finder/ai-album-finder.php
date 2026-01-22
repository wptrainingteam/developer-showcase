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

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
	require_once dirname( __FILE__ ) . '/vendor/autoload.php';
}

function devshow_ai_album_finder_load(){
// Load the plugin.
	if ( class_exists( 'AI_Album_Finder\Plugin_Main' ) ) {
		return;
	}
	$plugin_instance   = new Developer_Showcase\AI_Album_Finder\Plugin_Main();
	$plugin_instance->add_hooks();

}

devshow_ai_album_finder_load();
