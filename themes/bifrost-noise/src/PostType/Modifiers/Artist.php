<?php

/**
 * Artist post type modifier.
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2023-2025, Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/x3p0-dev/bifrost-noise
 */

declare(strict_types=1);

namespace Bifrost\Noise\PostType\Modifiers;

use Bifrost\Noise\PostType\PostTypeModifier;

final class Artist implements PostTypeModifier
{
	public function modify(array $args): array
	{
		$args['template'] = $this->getTemplate();

		return $args;
	}

	private function getTemplate(): array
	{
		return [
			['core/tabs', [
				'lock'      => ['move' => false, 'remove' => false],
				'align'     => 'full',
				'className' => 'is-style-tabs-artist',
			], [
				['core/tabs-menu', [
					'lock'  => ['remove' => true],
					'style' => ['spacing' => ['blockGap' => 'var:preset|spacing|0']],
				], [
					['core/tabs-menu-item', [], []],
				]],
				['core/tab-panel', [
					'lock' => ['remove' => true],
				], [
					['core/tab', [
						'label'  => 'Albums',
						'lock'   => ['move' => true, 'remove' => true],
						'layout' => ['type' => 'constrained', 'contentSize' => '80rem'],
						'anchor' => 'albums',
					], [
						['core/group', [
							'layout' => ['type' => 'constrained'],
						], [
							['core/query', [
								'queryId'   => 0,
								'query'     => ['postType' => 'music_album', 'perPage' => 32, 'offset' => 0],
								'namespace' => 'bifrost-noise/query-artist-albums',
								'metadata'  => ['name' => 'Posts Query'],
								'align'     => 'full',
							], [
								['core/post-template', [
									'align'  => 'full',
									'style'  => ['spacing' => ['blockGap' => 'var:preset|spacing|70']],
									'layout' => ['type' => 'grid', 'columnCount' => 4],
								], [
									['core/group', [
										'tagName'  => 'article',
										'metadata' => ['name' => 'Post'],
										'style'    => ['spacing' => ['blockGap' => 'var:preset|spacing|40']],
										'layout'   => ['type' => 'default'],
									], [
										['core/post-featured-image', ['isLink' => true, 'aspectRatio' => '1'], []],
										['core/group', [
											'style'  => ['spacing' => ['blockGap' => 'var:preset|spacing|10']],
											'layout' => ['type' => 'constrained'],
										], [
											['core/post-title', ['isLink' => true, 'className' => 'is-style-post-title-secondary'], []],
											['core/group', [
												'metadata'  => ['name' => 'Post Byline'],
												'className' => 'is-style-meta',
												'style'     => ['spacing' => ['blockGap' => 'var:preset|spacing|40']],
												'layout'    => ['type' => 'flex', 'flexWrap' => 'wrap'],
											], [
												['core/post-date', ['format' => 'Y'], []],
											]],
										]],
									]],
								]],
							]],
						]],
					]],
					['core/tab', [
						'label'  => 'Biography',
						'lock'   => ['move' => true, 'remove' => true],
						'layout' => ['type' => 'constrained', 'contentSize' => '80rem', 'justifyContent' => 'center'],
						'anchor' => 'biography',
					], [
						['core/group', [
							'layout' => ['type' => 'constrained', 'justifyContent' => 'left'],
						], [
							['core/paragraph', [], []],
						]],
					]],
					['core/tab', [
						'label'  => 'Gallery',
						'lock'   => ['move' => true, 'remove' => true],
						'layout' => ['type' => 'constrained', 'contentSize' => '80rem', 'wideSize' => '80rem'],
						'anchor' => 'gallery',
					], [
						['core/gallery', ['linkTo' => 'lightbox'], []],
					]]
				]]
			]]
		];
	}
}
