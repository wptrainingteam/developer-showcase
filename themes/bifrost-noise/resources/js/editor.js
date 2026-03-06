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

const postTypeIcons = [
	{
		name: 'music_album',
		title: __('Album', 'bifrost-noise'),
		icon: <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-width="1.5"><path d="M2.384 13.793c-.447-3.164-.67-4.745.278-5.77C3.61 7 5.298 7 8.672 7h6.656c3.374 0 5.062 0 6.01 1.024s.724 2.605.278 5.769l-.422 3c-.35 2.48-.525 3.721-1.422 4.464s-2.22.743-4.867.743h-5.81c-2.646 0-3.97 0-4.867-.743s-1.072-1.983-1.422-4.464z"></path><path stroke-linecap="round" stroke-linejoin="round" d="M12 17a1.5 1.5 0 1 1-3 0a1.5 1.5 0 0 1 3 0m0 0v-6.5c0 1.657 1.895 3 3 3"></path><path d="M19.562 7a2.132 2.132 0 0 0-2.1-2.5H6.538a2.132 2.132 0 0 0-2.1 2.5M17.5 4.5c.028-.26.043-.389.043-.496a2 2 0 0 0-1.787-1.993C15.65 2 15.52 2 15.26 2H8.74c-.26 0-.391 0-.497.011a2 2 0 0 0-1.787 1.993c0 .107.014.237.043.496"></path></g></svg>
	},
	{
		name: 'music_artist',
		title: __('Artist', 'bifrost-noise'),
		icon: <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="9" cy="6" r="4"></circle><path stroke-linecap="round" d="M15 9a3 3 0 1 0 0-6"></path><ellipse cx="9" cy="17" rx="7" ry="4"></ellipse><path stroke-linecap="round" d="M18 14c1.754.385 3 1.359 3 2.5c0 1.03-1.014 1.923-2.5 2.37"></path></g></svg>
	},
	{
		name: 'post',
		title: __('Post', 'bifrost-noise'),
		icon: <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true"><path d="m19 7-3-3-8.5 8.5-1 4 4-1L19 7Zm-7 11.5H5V20h7v-1.5Z"></path></svg>
	},
	{
		name: 'page',
		title: __('Page', 'bifrost-noise'),
		icon: <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368"><path d="M320-440h320v-80H320v80Zm0 120h320v-80H320v80Zm0 120h200v-80H320v80ZM240-80q-33 0-56.5-23.5T160-160v-640q0-33 23.5-56.5T240-880h320l240 240v480q0 33-23.5 56.5T720-80H240Zm280-520v-200H240v640h480v-440H520ZM240-800v200-200 640-640Z"/></svg>
	},
];
