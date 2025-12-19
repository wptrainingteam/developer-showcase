/**
 * WordPress dependencies
 */
import { registerBlockType } from '@wordpress/blocks';
import {
	useBlockProps,
	useInnerBlocksProps,
	InnerBlocks,
} from '@wordpress/block-editor';
/**
 * Internal dependencies
 */
import './style.scss';
import Edit from './edit';
import metadata from './block.json';
import icon from '../icons.';
import transforms from './transforms';

/**
 * Every block starts by registering a new block type definition.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-registration/
 */
registerBlockType( metadata.name, {
	/**
	 * @see ../icons.js
	 */
	icon,

	/**
	 * @see ./edit.js
	 */
	edit: Edit,

	/**
	 * @see ./transforms.js
	 */
	transforms,

	save: () => <InnerBlocks.Content />,
} );
