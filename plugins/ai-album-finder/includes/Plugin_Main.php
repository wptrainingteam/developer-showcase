<?php
/**
 * Class AI_Album_Finder\Plugin_Main
 *
 * @package ai-album-finder
 */

namespace AI_Album_Finder;

/**
 * Main plugin class.
 *
 * @since 1.0.0
 */
class Plugin_Main {

	/**
	 * Plugin file path.
	 *
	 * @since 1.0.0
	 * @var string
	 */
	private $plugin_file;

	/**
	 * Bot name.
	 *
	 * @since 1.0.0
	 * @var string
	 */
	private $bot_name = 'DigBot';

	/**
	 * Constructor.
	 *
	 * @since 1.0.0
	 *
	 * @param string $plugin_file Plugin file path.
	 */
	public function __construct( string $plugin_file ) {
		$this->plugin_file = $plugin_file;
	}

	/**
	 * Adds plugin hooks.
	 *
	 * @since 1.0.0
	 */
	public function add_hooks(): void {
		// Register settings.
		add_action( 'admin_init', array( $this, 'register_settings' ) );
		add_action( 'admin_menu', array( $this, 'add_settings_page' ) );

		// Initialize AI provider credentials using the wp-ai-client package.
		add_action( 'init', array( $this, 'initialize_ai_providers' ) );

		// Register abilities.
		add_action( 'init', array( $this, 'register_abilities' ) );

		// Enqueue chatbot assets.
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_chatbot_assets' ) );

		// Register REST API endpoints.
		add_action( 'rest_api_init', array( $this, 'register_rest_routes' ) );
	}

	/**
	 * Gets the bot name.
	 *
	 * @since 1.0.0
	 *
	 * @return string Bot name.
	 */
	public function get_bot_name(): string {
		return apply_filters( 'ai_album_finder_bot_name', $this->bot_name );
	}

	/**
	 * Registers plugin settings.
	 *
	 * @since 1.0.0
	 */
	public function register_settings(): void {
		register_setting(
			'ai_album_finder_settings',
			'ai_album_finder_bot_name',
			array(
				'type'              => 'string',
				'sanitize_callback' => 'sanitize_text_field',
				'default'           => 'DigBot',
			)
		);
	}

	/**
	 * Adds settings page to admin menu.
	 *
	 * @since 1.0.0
	 */
	public function add_settings_page(): void {
		add_options_page(
			__( 'AI Album Finder Settings', 'ai-album-finder' ),
			__( 'AI Album Finder', 'ai-album-finder' ),
			'manage_options',
			'ai-album-finder',
			array( $this, 'render_settings_page' )
		);
	}

	/**
	 * Renders settings page.
	 *
	 * @since 1.0.0
	 */
	public function render_settings_page(): void {
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		$bot_name = get_option( 'ai_album_finder_bot_name', 'DigBot' );
		?>
		<div class="wrap">
			<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
			<form action="options.php" method="post">
				<?php settings_fields( 'ai_album_finder_settings' ); ?>
				<table class="form-table">
					<tr>
						<th scope="row">
							<label for="ai_album_finder_bot_name">
								<?php esc_html_e( 'Bot Name', 'ai-album-finder' ); ?>
							</label>
						</th>
						<td>
							<input type="text" 
								   id="ai_album_finder_bot_name" 
								   name="ai_album_finder_bot_name" 
								   value="<?php echo esc_attr( $bot_name ); ?>" 
								   class="regular-text" />
							<p class="description">
								<?php esc_html_e( 'The name of your AI music assistant.', 'ai-album-finder' ); ?>
							</p>
						</td>
					</tr>
				</table>
				<?php submit_button(); ?>
			</form>
			<hr>
			<h2><?php esc_html_e( 'AI Provider Configuration', 'ai-album-finder' ); ?></h2>
			<p>
				<?php
				printf(
					/* translators: %s: link to AI settings page */
					esc_html__( 'To configure AI provider credentials (OpenAI, Google, Anthropic, etc.), please visit the %s.', 'ai-album-finder' ),
					'<a href="' . esc_url( admin_url( 'options-general.php?page=wp-ai-client' ) ) . '">' . esc_html__( 'WP AI Client settings page', 'ai-album-finder' ) . '</a>'
				);
				?>
			</p>
		</div>
		<?php
	}

	/**
	 * Initializes AI providers using the wp-ai-client package.
	 *
	 * This method ensures the wp-ai-client default registry and settings are initialized.
	 *
	 * @since 1.0.0
	 */
	public function initialize_ai_providers(): void {
		// The wp-ai-client package automatically registers its settings page
		// and handles provider credentials when the package is loaded.
		// We just need to ensure it's available for use.
		if ( class_exists( 'WordPress\AiClient\AiClient' ) ) {
			// AiClient is available and will handle its own initialization.
			// The settings page will be available at Settings > WP AI Client.
		}
	}

	/**
	 * Registers WordPress Abilities for the chatbot.
	 *
	 * @since 1.0.0
	 */
	public function register_abilities(): void {
		if ( ! function_exists( 'register_ability' ) ) {
			return;
		}

		// Register ability to get albums.
		register_ability(
			'get_albums',
			array(
				'label'       => __( 'Get Albums', 'ai-album-finder' ),
				'description' => __( 'Retrieves albums from the site based on search criteria.', 'ai-album-finder' ),
				'callback'    => array( $this, 'get_albums_ability' ),
				'context'     => array( 'ai-chatbot' ),
				'args'        => array(
					'genre'       => array(
						'type'        => 'string',
						'description' => __( 'Filter albums by genre.', 'ai-album-finder' ),
						'required'    => false,
					),
					'artist_name' => array(
						'type'        => 'string',
						'description' => __( 'Filter albums by artist name.', 'ai-album-finder' ),
						'required'    => false,
					),
					'limit'       => array(
						'type'        => 'integer',
						'description' => __( 'Number of albums to return.', 'ai-album-finder' ),
						'required'    => false,
						'default'     => 5,
					),
				),
			)
		);

		// Register ability to get genres.
		register_ability(
			'get_genres',
			array(
				'label'       => __( 'Get Genres', 'ai-album-finder' ),
				'description' => __( 'Retrieves all available music genres from the site.', 'ai-album-finder' ),
				'callback'    => array( $this, 'get_genres_ability' ),
				'context'     => array( 'ai-chatbot' ),
			)
		);

		// Register ability to get artists.
		register_ability(
			'get_artists',
			array(
				'label'       => __( 'Get Artists', 'ai-album-finder' ),
				'description' => __( 'Retrieves artists from the site.', 'ai-album-finder' ),
				'callback'    => array( $this, 'get_artists_ability' ),
				'context'     => array( 'ai-chatbot' ),
				'args'        => array(
					'search' => array(
						'type'        => 'string',
						'description' => __( 'Search for artists by name.', 'ai-album-finder' ),
						'required'    => false,
					),
					'limit'  => array(
						'type'        => 'integer',
						'description' => __( 'Number of artists to return.', 'ai-album-finder' ),
						'required'    => false,
						'default'     => 10,
					),
				),
			)
		);
	}

	/**
	 * Ability callback to get albums.
	 *
	 * @since 1.0.0
	 *
	 * @param array<string, mixed> $args Arguments.
	 * @return array<string, mixed> Result.
	 */
	public function get_albums_ability( array $args ): array {
		$query_args = array(
			'post_type'      => 'album',
			'posts_per_page' => isset( $args['limit'] ) ? (int) $args['limit'] : 5,
			'post_status'    => 'publish',
		);

		// Add genre filter if provided.
		if ( ! empty( $args['genre'] ) ) {
			$query_args['tax_query'] = array(
				array(
					'taxonomy' => 'genre',
					'field'    => 'name',
					'terms'    => sanitize_text_field( $args['genre'] ),
				),
			);
		}

		// Add artist name filter if provided (search by parent artist title).
		if ( ! empty( $args['artist_name'] ) ) {
			$artist_search = sanitize_text_field( $args['artist_name'] );
			$artists       = get_posts(
				array(
					'post_type'      => 'artist',
					's'              => $artist_search,
					'posts_per_page' => 1,
					'fields'         => 'ids',
				)
			);

			if ( ! empty( $artists ) ) {
				$query_args['post_parent'] = $artists[0];
			}
		}

		$albums = get_posts( $query_args );

		$results = array();
		foreach ( $albums as $album ) {
			$artist_id   = wp_get_post_parent_id( $album->ID );
			$artist_name = $artist_id ? get_the_title( $artist_id ) : '';
			$genres      = wp_get_post_terms( $album->ID, 'genre', array( 'fields' => 'names' ) );

			$results[] = array(
				'id'          => $album->ID,
				'title'       => $album->post_title,
				'artist'      => $artist_name,
				'genres'      => is_array( $genres ) ? $genres : array(),
				'description' => wp_trim_words( $album->post_content, 50 ),
				'permalink'   => get_permalink( $album->ID ),
			);
		}

		return array(
			'success' => true,
			'albums'  => $results,
			'count'   => count( $results ),
		);
	}

	/**
	 * Ability callback to get genres.
	 *
	 * @since 1.0.0
	 *
	 * @param array<string, mixed> $args Arguments.
	 * @return array<string, mixed> Result.
	 */
	public function get_genres_ability( array $args ): array {
		$genres = get_terms(
			array(
				'taxonomy'   => 'genre',
				'hide_empty' => true,
			)
		);

		if ( is_wp_error( $genres ) ) {
			return array(
				'success' => false,
				'error'   => $genres->get_error_message(),
			);
		}

		$results = array();
		foreach ( $genres as $genre ) {
			$results[] = array(
				'id'    => $genre->term_id,
				'name'  => $genre->name,
				'count' => $genre->count,
			);
		}

		return array(
			'success' => true,
			'genres'  => $results,
			'count'   => count( $results ),
		);
	}

	/**
	 * Ability callback to get artists.
	 *
	 * @since 1.0.0
	 *
	 * @param array<string, mixed> $args Arguments.
	 * @return array<string, mixed> Result.
	 */
	public function get_artists_ability( array $args ): array {
		$query_args = array(
			'post_type'      => 'artist',
			'posts_per_page' => isset( $args['limit'] ) ? (int) $args['limit'] : 10,
			'post_status'    => 'publish',
		);

		// Add search filter if provided.
		if ( ! empty( $args['search'] ) ) {
			$query_args['s'] = sanitize_text_field( $args['search'] );
		}

		$artists = get_posts( $query_args );

		$results = array();
		foreach ( $artists as $artist ) {
			$album_count = count(
				get_children(
					array(
						'post_parent' => $artist->ID,
						'post_type'   => 'album',
						'post_status' => 'publish',
					)
				)
			);

			$results[] = array(
				'id'          => $artist->ID,
				'name'        => $artist->post_title,
				'description' => wp_trim_words( $artist->post_content, 30 ),
				'album_count' => $album_count,
				'permalink'   => get_permalink( $artist->ID ),
			);
		}

		return array(
			'success' => true,
			'artists' => $results,
			'count'   => count( $results ),
		);
	}

	/**
	 * Enqueues chatbot assets.
	 *
	 * @since 1.0.0
	 */
	public function enqueue_chatbot_assets(): void {
		// Only load on admin pages.
		if ( ! is_admin() ) {
			return;
		}

		// Check if wp-ai-client is configured.
		// The wp-ai-client package handles API credentials, so we just need to check if it's available.
		if ( ! class_exists( 'WordPress\AiClient\AiClient' ) ) {
			return;
		}

		wp_enqueue_style(
			'ai-album-finder-chatbot',
			AI_ALBUM_FINDER_PLUGIN_URL . 'src/chatbot.css',
			array(),
			AI_ALBUM_FINDER_VERSION
		);

		wp_enqueue_script(
			'ai-album-finder-chatbot',
			AI_ALBUM_FINDER_PLUGIN_URL . 'src/chatbot.js',
			array(),
			AI_ALBUM_FINDER_VERSION,
			true
		);

		$bot_name = get_option( 'ai_album_finder_bot_name', 'DigBot' );

		wp_localize_script(
			'ai-album-finder-chatbot',
			'aiAlbumFinderData',
			array(
				'restUrl'   => rest_url( 'ai-album-finder/v1/' ),
				'nonce'     => wp_create_nonce( 'wp_rest' ),
				'botName'   => $bot_name,
				'strings'   => array(
					'chatTitle'       => sprintf(
						/* translators: %s: bot name */
						__( 'Chat with %s', 'ai-album-finder' ),
						$bot_name
					),
					'placeholder'     => __( 'Ask me about music...', 'ai-album-finder' ),
					'send'            => __( 'Send', 'ai-album-finder' ),
					'close'           => __( 'Close', 'ai-album-finder' ),
					'errorMessage'    => __( 'Sorry, I encountered an error. Please try again.', 'ai-album-finder' ),
					'welcomeMessage'  => sprintf(
						/* translators: %s: bot name */
						__( 'Hi! I\'m %s, your AI music assistant. Tell me what kind of music you like, and I\'ll help you discover great albums!', 'ai-album-finder' ),
						$bot_name
					),
				),
			)
		);
	}

	/**
	 * Registers REST API routes.
	 *
	 * @since 1.0.0
	 */
	public function register_rest_routes(): void {
		register_rest_route(
			'ai-album-finder/v1',
			'/chat',
			array(
				'methods'             => 'POST',
				'callback'            => array( $this, 'handle_chat_request' ),
				'permission_callback' => function () {
					return current_user_can( 'read' );
				},
				'args'                => array(
					'message' => array(
						'required'          => true,
						'type'              => 'string',
						'sanitize_callback' => 'sanitize_text_field',
					),
					'history' => array(
						'required' => false,
						'type'     => 'array',
						'default'  => array(),
					),
				),
			)
		);
	}

	/**
	 * Handles chat request.
	 *
	 * @since 1.0.0
	 *
	 * @param \WP_REST_Request $request Request object.
	 * @return \WP_REST_Response Response object.
	 */
	public function handle_chat_request( $request ) {
		$message = $request->get_param( 'message' );
		$history = $request->get_param( 'history' );

		// Check if wp-ai-client is available.
		if ( ! class_exists( 'WordPress\AiClient\AiClient' ) ) {
			return new \WP_REST_Response(
				array(
					'success' => false,
					'error'   => __( 'WP AI Client is not available. Please ensure the wordpress/wp-ai-client package is installed.', 'ai-album-finder' ),
				),
				500
			);
		}

		try {
			// This is a placeholder for the actual AI integration.
			// In a real implementation, you would use the WordPress AI SDK here with
			// the configured providers from wp-ai-client.
			$response = $this->get_ai_response( $message, $history );

			return new \WP_REST_Response(
				array(
					'success'  => true,
					'response' => $response,
				),
				200
			);
		} catch ( \Exception $e ) {
			return new \WP_REST_Response(
				array(
					'success' => false,
					'error'   => $e->getMessage(),
				),
				500
			);
		}
	}

	/**
	 * Gets AI response (placeholder implementation for demo purposes).
	 *
	 * @since 1.0.0
	 *
	 * @param string               $message User message.
	 * @param array<string, mixed> $history Chat history.
	 * @return string AI response.
	 */
	private function get_ai_response( string $message, array $history ): string {
		// PLACEHOLDER IMPLEMENTATION: This is a basic demo implementation.
		// In a production version, this should integrate with the WP AI Client SDK
		// to provide actual AI-powered responses using the configured AI service provider.
		// Example integration:
		// $registry = WordPress\AiClient\AiClient::defaultRegistry();
		// $provider = $registry->getProvider( 'openai' ); // or another configured provider
		// $model = $provider->getModel( 'gpt-4' );
		// $response = $model->chat()->create( $messages );
		
		$bot_name = get_option( 'ai_album_finder_bot_name', 'DigBot' );
		
		// Simple keyword-based responses for demonstration.
		$message_lower = strtolower( $message );
		
		if ( strpos( $message_lower, 'rock' ) !== false || strpos( $message_lower, 'metal' ) !== false ) {
			return sprintf(
				/* translators: %s: bot name */
				__( 'Great! I love rock and metal music. Let me find some albums for you. You can explore albums in our collection or tell me more about your specific tastes!', 'ai-album-finder' ),
				$bot_name
			);
		} elseif ( strpos( $message_lower, 'jazz' ) !== false || strpos( $message_lower, 'blues' ) !== false ) {
			return __( 'Excellent choice! Jazz and blues have such rich histories. I can help you discover some classic and contemporary albums in these genres.', 'ai-album-finder' );
		} elseif ( strpos( $message_lower, 'electronic' ) !== false || strpos( $message_lower, 'edm' ) !== false ) {
			return __( 'Electronic music is so diverse! From ambient to techno, there\'s so much to explore. What sub-genres interest you?', 'ai-album-finder' );
		} else {
			return sprintf(
				/* translators: %s: bot name */
				__( 'I\'m %s, and I\'m here to help you discover music! Tell me about your favorite genres, artists, or moods, and I\'ll recommend albums from our collection.', 'ai-album-finder' ),
				$bot_name
			);
		}
	}
}
