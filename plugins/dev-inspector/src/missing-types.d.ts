declare module '@wordpress/blocks' {
	export type BlockTransform = {
		type: string;
		blocks: string[];
		transform: ( attributes: object, innerBlocks: object[] ) => void;
	};
	export type BlockTransforms = {
		from: BlockTransform[];
		to: BlockTransform[];
	};

	export interface BlockParams< T = object > {
		attributes: T;
		setAttributes: ( params: Partial< T > ) => void;
		isSelected: boolean;
	}

	type BlockAttributes = {
		[ key: string ]: string;
	};

	export type RegisterBlockParams = {
		icon: string | ( () => React.JSX.Element );
		edit: ( params: BlockParams< BlockAttributes > ) => React.JSX.Element;
		save: () => null | React.JSX.Element | unknown;
		transforms: BlockTransforms;
	};
	export function registerBlockType(
		name: string,
		params: Partial< RegisterBlockParams >
	): void;

	export function createBlock(
		blockName: string,
		attributes: object,
		innerBlocks?: object[]
	): void;
}

declare module '@wordpress/block-editor';
