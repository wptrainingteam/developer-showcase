<?php
/**
 * Server rendering for the persistent audio player block.
 *
 * @package bifrost-player
 */

declare(strict_types=1);

wp_interactivity_state('bifrost-player', [
	'currentTrackUrl'    => '',
	'currentTrackTitle'  => '',
	'currentTrackArtist' => '',
	'currentTrackImage'  => '',
	'isAudioPlaying'     => false,
]);

$wrapper_attributes = get_block_wrapper_attributes([
	'class' => 'bifrost-audio-player',
]);
?>

<div
	<?php echo $wrapper_attributes; ?>
	data-wp-interactive="bifrost-player"
	data-wp-bind--hidden="!state.isPlayerVisible"
	data-wp-watch="callbacks.syncPlayback"
	hidden
>
	<div class="bifrost-audio-player__inner">
		<div class="bifrost-audio-player__artwork">
			<img
				data-wp-bind--src="state.currentTrackImage"
				alt=""
				width="48"
				height="48"
			/>
		</div>

		<div class="bifrost-audio-player__info">
			<span
				class="bifrost-audio-player__title"
				data-wp-text="state.currentTrackTitle"
			></span>
			<span
				class="bifrost-audio-player__artist"
				data-wp-text="state.currentTrackArtist"
			></span>
		</div>

		<div class="bifrost-audio-player__controls">
			<button
				class="bifrost-audio-player__play-pause"
				data-wp-on--click="actions.togglePlay"
				data-wp-text="state.playPauseLabel"
				aria-label="<?php esc_attr_e('Toggle playback', 'bifrost-player'); ?>"
			></button>

			<button
				class="bifrost-audio-player__close"
				data-wp-on--click="actions.closePlayer"
				aria-label="<?php esc_attr_e('Close player', 'bifrost-player'); ?>"
			>
				<?php esc_html_e('✕', 'bifrost-player'); ?>
			</button>
		</div>
	</div>

	<audio
		class="bifrost-audio-player__audio"
		data-wp-bind--src="state.currentTrackUrl"
		data-wp-on--ended="actions.onTrackEnded"
		preload="metadata"
	></audio>
</div>
