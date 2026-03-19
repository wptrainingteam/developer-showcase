/**
 * WordPress dependencies.
 */
import {
	store,
	getContext,
	getElement,
	withSyncEvent,
} from '@wordpress/interactivity';

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
		playTrack() {
			const ctx = getContext();

			state.currentTrackUrl = ctx.trackUrl || '';
			state.currentTrackTitle = ctx.trackTitle || '';
			state.currentTrackArtist = ctx.trackArtist || '';
			state.currentTrackImage = ctx.trackImage || '';
			state.isAudioPlaying = true;
		},
		togglePlay() {
			state.isAudioPlaying = ! state.isAudioPlaying;
		},
		closePlayer() {
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
		syncPlayback() {
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
	},
} );
