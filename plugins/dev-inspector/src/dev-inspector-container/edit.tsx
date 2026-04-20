/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import {
	useBlockProps,
	useInnerBlocksProps,
	InspectorControls,
} from '@wordpress/block-editor';

import { PanelBody, TextareaControl } from '@wordpress/components';

/**
 * Internal dependencies
 */
import './editor.scss';
import { BlockParams } from '@wordpress/blocks';

type BlockAttributes = {
	description: string;
	sourceCodeOne: string;
	sourceCodeTwo: string;
	resources: string;
};

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#edit
 *
 * @return {Element} Element to render.
 */
export default function Edit( {
	attributes: { description, sourceCodeOne, sourceCodeTwo, resources },
	setAttributes,
}: BlockParams< BlockAttributes > ): React.JSX.Element {
	return (
		<>
			<div { ...useBlockProps() }>
				<div { ...useInnerBlocksProps() } />
			</div>
			<InspectorControls group="settings">
				<PanelBody
					title={ __(
						'Custom Block Controls',
						'inspector-control-groups'
					) }
				>
					<TextareaControl
						label={ __(
							'Description',
							'inspector-control-groups'
						) }
						value={ description }
						onChange={ ( newDescription ) =>
							setAttributes( { description: newDescription } )
						}
					/>
					<TextareaControl
						label={ __(
							'Source Code',
							'inspector-control-groups'
						) }
						value={ sourceCodeOne }
						onChange={ ( newSourceCodeOne ) =>
							setAttributes( { sourceCodeOne: newSourceCodeOne } )
						}
					/>
					<TextareaControl
						label={ __(
							'Source Code 2',
							'inspector-control-groups'
						) }
						value={ sourceCodeTwo }
						onChange={ ( newSourceCodeTwo ) =>
							setAttributes( { sourceCodeTwo: newSourceCodeTwo } )
						}
					/>
					<TextareaControl
						label={ __( 'References', 'inspector-control-groups' ) }
						value={ resources }
						onChange={ ( newResources ) =>
							setAttributes( { resources: newResources } )
						}
					/>
				</PanelBody>
			</InspectorControls>
		</>
	);
}
