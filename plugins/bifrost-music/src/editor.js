import { registerPlugin } from '@wordpress/plugins';
import { PluginDocumentSettingPanel } from '@wordpress/editor';
import { SelectControl, Spinner, __experimentalVStack as VStack } from '@wordpress/components';
import { useSelect, useDispatch } from '@wordpress/data';
import { store as editorStore } from '@wordpress/editor';
import { store as coreStore } from '@wordpress/core-data';
import { __ } from '@wordpress/i18n';
import { useMemo } from '@wordpress/element';

const POST_META_ARTIST = 'music_artist';
const POST_META_ALBUM  = 'music_album';

const AlbumParentSelector = () => {
	const { postType, currentParent } = useSelect((select) => ({
		postType: select(editorStore).getCurrentPostType(),
		currentParent: select(editorStore).getEditedPostAttribute('parent'),
	}), []);

	const { artists, isResolving } = useSelect((select) => {
		if (postType !== 'music_album') {
			return { artists: null, isResolving: false };
		}

		return {
			artists: select(coreStore).getEntityRecords('postType', 'music_artist', {
				per_page: -1,
				orderby: 'title',
				order: 'asc',
				status: 'publish,draft',
			}),
			isResolving: select(coreStore).isResolving('getEntityRecords', [
				'postType',
				'music_artist',
				{ per_page: -1, orderby: 'title', order: 'asc', status: 'publish,draft' },
			]),
		};
	}, [postType]);

	const { editPost } = useDispatch(editorStore);

	const options = useMemo(() => {
		if (!artists) return [];

		return [
			{ label: __('— Select Artist —', 'bifrost-music'), value: 0 },
			...artists.map((artist) => ({
				label: artist.title.rendered,
				value: artist.id,
			})),
		];
	}, [artists]);

	if (postType !== 'music_album') {
		return null;
	}

	if (isResolving) {
		return (
			<PluginDocumentSettingPanel
				name="album-parent-artist"
				title={__('Artist', 'bifrost-music')}
			>
				<Spinner />
			</PluginDocumentSettingPanel>
		);
	}

	return (
		<PluginDocumentSettingPanel
			name="album-parent-artist"
			title={__('Artist', 'bifrost-music')}
		>
			<SelectControl
				__next40pxDefaultSize
				__nextHasNoMarginBottom
				value={currentParent || 0}
				options={options}
				onChange={(value) => editPost({ parent: parseInt(value, 10) })}
			/>
		</PluginDocumentSettingPanel>
	);
};

const PostMusicSelector = () => {
	const postType = useSelect(
		(select) => select(editorStore).getCurrentPostType(),
		[]
	);

	const { meta, isResolvingArtists, isResolvingAlbums, artists, albums } = useSelect((select) => {
		if (postType !== 'post') {
			return { meta: {}, isResolvingArtists: false, isResolvingAlbums: false, artists: null, albums: null };
		}

		const queryArgs = { per_page: -1, orderby: 'title', order: 'asc', status: 'publish,draft' };

		return {
			meta: select(editorStore).getEditedPostAttribute('meta') || {},
			artists: select(coreStore).getEntityRecords('postType', 'music_artist', queryArgs),
			albums:  select(coreStore).getEntityRecords('postType', 'music_album',  queryArgs),
			isResolvingArtists: select(coreStore).isResolving('getEntityRecords', ['postType', 'music_artist', queryArgs]),
			isResolvingAlbums:  select(coreStore).isResolving('getEntityRecords', ['postType', 'music_album',  queryArgs]),
		};
	}, [postType]);

	const { editPost } = useDispatch(editorStore);

	const artistOptions = useMemo(() => {
		if (!artists) return [];
		return [
			{ label: __('— Select Artist —', 'bifrost-music'), value: 0 },
			...artists.map((a) => ({ label: a.title.rendered, value: a.id })),
		];
	}, [artists]);

	const albumOptions = useMemo(() => {
		if (!albums) return [];
		return [
			{ label: __('— Select Album —', 'bifrost-music'), value: 0 },
			...albums.map((a) => ({ label: a.title.rendered, value: a.id })),
		];
	}, [albums]);

	if (postType !== 'post') {
		return null;
	}

	const isResolving = isResolvingArtists || isResolvingAlbums;

	return (
		<PluginDocumentSettingPanel
			name="post-music-association"
			title={__('Music Association', 'bifrost-music')}
		>
			{ isResolving ? (
				<Spinner />
			) : (
				<VStack spacing={4}>
					<SelectControl
						__next40pxDefaultSize
						__nextHasNoMarginBottom
						label={__('Artist', 'bifrost-music')}
						value={meta[POST_META_ARTIST] || 0}
						options={artistOptions}
						onChange={(value) =>
							editPost({ meta: { ...meta, [POST_META_ARTIST]: parseInt(value, 10) } })
						}
					/>
					<SelectControl
						__next40pxDefaultSize
						__nextHasNoMarginBottom
						label={__('Album', 'bifrost-music')}
						value={meta[POST_META_ALBUM] || 0}
						options={albumOptions}
						onChange={(value) =>
							editPost({ meta: { ...meta, [POST_META_ALBUM]: parseInt(value, 10) } })
						}
					/>
				</VStack>
			) }
		</PluginDocumentSettingPanel>
	);
};

registerPlugin('album-parent-selector', {
	render: AlbumParentSelector,
});

registerPlugin('post-music-selector', {
	render: PostMusicSelector,
});
