/**
 * WordPress dependencies.
 */
import {
	store,
	getContext,
	getElement,
	withSyncEvent,
} from '@wordpress/interactivity';

/**
 * External dependencies.
 */
import WaveformPlayer from '@arraypress/waveform-player';

/**
 * Module-level reference to the WaveformPlayer instance in the
 * persistent bottom bar.
 */
let playerInstance = null;

/**
 * Tracks the currently loaded URL to avoid re-loading the same
 * track (e.g. when syncWaveform re-fires after navigation).
 */
let currentLoadedUrl = '';

/**
 * Guards against re-entrant first-time init while waiting for
 * the next animation frame.
 */
let initPending = false;

/**
 * Options passed to every WaveformPlayer instance.
 * All colors are explicit so the player never reads computed styles
 * (which can change when the router swaps stylesheets).
 */
const WAVEFORM_OPTIONS = {
	height: 40,
	waveformStyle: 'bars',
	showTime: true,
	singlePlay: false,
	enableMediaSession: false,
	backgroundColor: 'transparent',
	waveformColor: 'rgba(255,255,255,0.3)',
	progressColor: 'rgba(255,255,255,0.7)',
	buttonColor: 'rgba(255,255,255,0.8)',
	textColor: 'rgba(255,255,255,0.8)',
	textSecondaryColor: 'rgba(255,255,255,0.5)',
};

function initWaveform( container, url, autoplay ) {
	if ( ! url ) {
		return;
	}

	// Same track — skip.
	if ( playerInstance && currentLoadedUrl === url ) {
		return;
	}

	// Different track on existing instance — load it.
	if ( playerInstance ) {
		currentLoadedUrl = url;
		playerInstance.loadTrack( url ).catch( () => {} );
		return;
	}

	if ( initPending ) {
		return;
	}

	// Defer to next frame so the container has dimensions
	// (hidden attribute is removed in the same reactive cycle).
	initPending = true;
	currentLoadedUrl = url;

	requestAnimationFrame( () => {
		initPending = false;

		// Create a plain div — no data-waveform-player attribute
		// so the library's auto-init won't find it after navigation.
		const div = document.createElement( 'div' );
		container.appendChild( div );

		playerInstance = new WaveformPlayer( div, {
			...WAVEFORM_OPTIONS,
			url,
			autoplay,
		} );

		div.addEventListener( 'waveformplayer:play', () => {
			state.isAudioPlaying = true;
		} );
		div.addEventListener( 'waveformplayer:pause', () => {
			state.isAudioPlaying = false;
		} );
		div.addEventListener( 'waveformplayer:ended', () => {
			state.isAudioPlaying = false;
		} );
	} );
}

const { state } = store( 'bifrost-player', {
	state: {
		get isPlayerVisible() {
			return state.currentTrackUrl !== '';
		},
		get playPauseLabel() {
			return state.isAudioPlaying ? '⏸' : '▶';
		},
	},
	actions: {
		/**
		 * Plays a track from a play-button or playlist-track context.
		 */
		playTrack() {
			const ctx = getContext();

			state.currentTrackUrl = ctx.trackUrl || '';
			state.currentTrackTitle = ctx.trackTitle || '';
			state.currentTrackArtist = ctx.trackArtist || '';
			state.currentTrackImage = ctx.trackImage || '';
			state.isAudioPlaying = true;
		},

		togglePlay() {
			if ( playerInstance ) {
				playerInstance.togglePlay();
				return;
			}
			state.isAudioPlaying = ! state.isAudioPlaying;
		},

		closePlayer() {
			if ( playerInstance ) {
				playerInstance.pause();
			}
			currentLoadedUrl = '';
			state.isAudioPlaying = false;
			state.currentTrackUrl = '';
		},

		onTrackEnded() {
			state.isAudioPlaying = false;
		},

		/**
		 * Intercepts a link click and navigates via the Interactivity
		 * Router instead of a full page reload. Placed directly on
		 * <a> tags by InteractiveRouter::addRegionAndLinks().
		 */
		navigate: withSyncEvent( function* ( e ) {
			e.preventDefault();
			const href = getElement().ref.href;
			const { actions } = yield import(
				'@wordpress/interactivity-router'
			);
			yield actions.navigate( href );
		} ),

		/**
		 * Prefetches a link on hover for faster client-side navigation.
		 */
		*prefetch() {
			const { actions } = yield import(
				'@wordpress/interactivity-router'
			);
			yield actions.prefetch( getElement().ref.href );
		},
	},
	callbacks: {
		/**
		 * Syncs the fallback <audio> element. Skips when the
		 * waveform player is handling (or about to handle) playback.
		 */
		syncPlayback() {
			// WaveformPlayer is active or pending init — it owns audio.
			if ( playerInstance || initPending ) {
				return;
			}

			const { ref } = getElement();
			const audio = ref?.querySelector( 'audio' );

			if ( ! audio ) {
				return;
			}

			if ( audio.src && state.isAudioPlaying && audio.paused ) {
				audio.play().catch( () => {} );
			} else if ( ! state.isAudioPlaying && ! audio.paused ) {
				audio.pause();
			}
		},

		/**
		 * Watches track state and initializes/loads the waveform player.
		 */
		syncWaveform() {
			const { ref } = getElement();

			if ( ! ref || ! state.currentTrackUrl ) {
				return;
			}

			initWaveform(
				ref,
				state.currentTrackUrl,
				state.isAudioPlaying
			);
		},
	},
} );
