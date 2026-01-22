<?php
/**
 * Chatbot Assets Handler
 *
 * Handles enqueuing of chatbot scripts and styles
 *
 * @package ai-album-finder
 */

namespace Developer_Showcase\AI_Album_Finder;

class Chatbot_Assets {

	/**
	 * Plugin directory path.
	 *
	 * @var string
	 */
	private string $plugin_dir;

	/**
	 * Plugin URL.
	 *
	 * @var string
	 */
	private string $plugin_url;

	/**
	 * Constructor.
	 *
	 * @param string $plugin_dir Plugin directory path.
	 * @param string $plugin_url Plugin URL.
	 */
	public function __construct( string $plugin_dir, string $plugin_url ) {
		$this->plugin_dir = $plugin_dir;
		$this->plugin_url = $plugin_url;
	}

	/**
	 * Add hooks.
	 */
	public function add_hooks(): void {
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_assets' ) );
		add_action( 'wp_footer', array( $this, 'render_chatbot_container' ) );
	}

	/**
	 * Enqueue chatbot assets.
	 */
	public function enqueue_assets(): void {
		wp_enqueue_script( 'wp-ai-client' );

		$asset_file = $this->plugin_dir . '/build/index.asset.php';

		if ( ! file_exists( $asset_file ) ) {
			return;
		}

		$asset = require $asset_file;

		// Enqueue the main chatbot script.
		wp_enqueue_script(
			'ai-album-finder-chatbot',
			$this->plugin_url . '/build/index.js',
			$asset['dependencies'],
			$asset['version'],
			true
		);

		// Enqueue the chatbot styles.
		wp_enqueue_style(
			'ai-album-finder-chatbot',
			$this->plugin_url . '/build/style-index.css',
			array( 'wp-components' ),
			$asset['version']
		);

		// Set up translations.
		wp_set_script_translations(
			'ai-album-finder-chatbot',
			'ai-album-finder',
			$this->plugin_dir . '/languages'
		);
	}

	/**
	 * Render the chatbot container in the footer.
	 */
	public function render_chatbot_container(): void {
		echo '<div id="ai-album-finder-chatbot"></div>';
	}
}
