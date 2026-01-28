/**
 * WordPress dependencies
 */
import { store } from '@wordpress/interactivity';

type ToggleDevInspectorServerState = {
	state: {
		enabled: boolean;
		drawerIsOpen: boolean;
	};
};

const toggleDevInspectorStore = {
	state: {
		item1: '',
		item2: '',
	},

	actions: {
		toggleDevInspector() {
			state.enabled = ! state.enabled;
			state.drawerIsOpen = ! state.drawerIsOpen;
		},
	},
	callbacks: {},
};

type ToggleDevInspectorStore = ToggleDevInspectorServerState &
	typeof toggleDevInspectorStore;

const { state } = store< ToggleDevInspectorStore >(
	'dev-inspector',
	toggleDevInspectorStore
);
