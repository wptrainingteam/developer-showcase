<?php
/**
 * Server rendering for the play button block.
 *
 * Resolves track data from block attributes or from the current post's
 * first audio attachment. Gets artist from parent album and album art
 * from the featured image.
 *
 * Renders using the standard wp-block-button markup so it inherits
 * theme button styles when used inside a core/buttons container.
 *
 * @package bifrost-player
 */

declare( strict_types=1 );

use Bifrost\Music\Support\Definitions;

$track_url    = $attributes['trackUrl'] ?? '';
$track_title  = $attributes['trackTitle'] ?? '';
$track_artist = $attributes['trackArtist'] ?? '';
$track_image  = $attributes['trackImage'] ?? '';
$label        = $attributes['label'] ?? __( 'Listen Now', 'bifrost-player' );
$width        = (int) ( $attributes['width'] ?? 0 );
$class_name   = $attributes['className'] ?? '';

// If no explicit track URL, try to resolve from the current post's first audio attachment.
if ( empty( $track_url ) ) {
	$post_id = get_the_ID();

	if ( $post_id ) {
		$attachments = get_children(
			array(
				'post_parent'    => $post_id,
				'post_type'      => 'attachment',
				'post_mime_type' => 'audio',
				'posts_per_page' => 1,
				'orderby'        => 'menu_order',
				'order'          => 'ASC',
			)
		);

		if ( ! empty( $attachments ) ) {
			$attachment = reset( $attachments );
			$track_url  = wp_get_attachment_url( $attachment->ID );

			if ( empty( $track_title ) ) {
				$track_title = $attachment->post_title ?: get_the_title( $post_id );
			}
		}
	}

	// Resolve artist from parent album.
	if ( empty( $track_artist ) && $post_id ) {
		$post = get_post( $post_id );

		if (
			$post instanceof WP_Post
			&& class_exists( Definitions::class )
			&& $post->post_type === Definitions::POST_TYPE_ALBUM
			&& ! empty( $post->post_parent )
		) {
			$artist = get_post( $post->post_parent );

			if ( $artist instanceof WP_Post ) {
				$track_artist = $artist->post_title;
			}
		}
	}

	// Resolve album art from featured image.
	if ( empty( $track_image ) && $post_id ) {
		$thumbnail_id = get_post_thumbnail_id( $post_id );

		if ( $thumbnail_id ) {
			$track_image = wp_get_attachment_image_url( $thumbnail_id, 'medium' ) ?: '';
		}
	}
}

// Don't render if there's no track to play.
if ( empty( $track_url ) ) {
	return;
}

$context = array(
	'trackUrl'    => $track_url,
	'trackTitle'  => $track_title,
	'trackArtist' => $track_artist,
	'trackImage'  => $track_image,
);

// Build wrapper classes to match core/button markup.
$wrapper_classes = array( 'wp-block-button' );

if ( $width > 0 ) {
	$wrapper_classes[] = 'has-custom-width';
	$wrapper_classes[] = 'wp-block-button__width-' . $width;
}

if ( ! empty( $class_name ) ) {
	$wrapper_classes[] = $class_name;
}
?>

<div
	class="<?php echo esc_attr( implode( ' ', $wrapper_classes ) ); ?>"
	data-wp-interactive="bifrost-player"
	<?php echo wp_interactivity_data_wp_context( $context ); ?>
>
	<button
		class="wp-block-button__link wp-element-button"
		data-wp-on--click="actions.playTrack"
	>
		<?php echo esc_html( $label ); ?>
	</button>
</div>
