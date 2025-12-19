/**
 * WordPress dependencies
 */
import { store } from '@wordpress/interactivity';

const { state } = store( 'dev-inspector', {
	state: {},

	actions: {
		toggleDevInspector() {
			state.enabled = ! state.enabled;
		},
	},
	callbacks: {},
} );
