import { registerPlugin } from '@wordpress/plugins';
import { PluginDocumentSettingPanel } from '@wordpress/editor';
import { SelectControl, Spinner } from '@wordpress/components';
import { useSelect, useDispatch } from '@wordpress/data';
import { store as editorStore } from '@wordpress/editor';
import { store as coreStore } from '@wordpress/core-data';
import { __ } from '@wordpress/i18n';
import { useMemo } from '@wordpress/element';

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

registerPlugin('album-parent-selector', {
	render: AlbumParentSelector,
});
