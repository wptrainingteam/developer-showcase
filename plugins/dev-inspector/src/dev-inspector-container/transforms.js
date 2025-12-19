/**
 * WordPress dependencies
 */
import { createBlock } from '@wordpress/blocks';

const transforms = {
	from: [
		{
			type: 'block',
			blocks: [ 'core/group' ],
			transform: ( attributes, innerBlocks ) => {
				return createBlock(
					'developer-showcase/dev-inspector-container',
					attributes,
					innerBlocks
				);
			},
		},
	],
};

export default transforms;
