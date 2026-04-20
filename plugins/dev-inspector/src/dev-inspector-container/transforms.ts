/**
 * WordPress dependencies
 */
import { type BlockTransforms, createBlock } from '@wordpress/blocks';

const transforms: BlockTransforms = {
	from: [
		{
			type: 'block',
			blocks: [ 'core/group' ],
			transform: ( attributes: object, innerBlocks: object[] ) => {
				return createBlock(
					'developer-showcase/dev-inspector-container',
					attributes,
					innerBlocks
				);
			},
		},
	],
	to: [
		{
			type: 'block',
			blocks: [ 'core/group' ],
			transform: ( attributes: object, innerBlocks: object[] ) => {
				return createBlock( 'core/group', attributes, innerBlocks );
			},
		},
	],
};

export default transforms;
