import { registerBlockVariation } from '@wordpress/blocks';
import { __ } from '@wordpress/i18n';

registerBlockVariation('core/query', {
	name: 'bifrost-noise/query-artist-albums',
	title: __('Artist Albums', 'bifrost-noise'),
	description: __('Displays albums of the current artist.', 'bifrost-noise'),
	isActive: ['namespace'],
	icon: 'album',
	attributes: {
		namespace: 'bifrost-noise/query-artist-albums',
		query: {
			postType: 'music_album',
			perPage: 8
		},
	},
	scope: ['inserter', 'transform'],
	innerBlocks: [
		[
			'core/post-template',
			{},
			[
				['core/post-title'],
				['core/post-featured-image'],
				['core/post-excerpt'],
			],
		],
		['core/query-pagination'],
		['core/query-no-results'],
	],
});
