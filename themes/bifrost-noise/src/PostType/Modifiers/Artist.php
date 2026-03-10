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
	/**
	 * References a synced pattern in the database for the Albums tab
	 * content. Until WordPress supports synced theme patterns, we need to
	 * store these on the site itself.
	 */
	private const PATTERN_ID_ARTIST_ALBUMS = 269;

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
						['core/block', ['ref' => self::PATTERN_ID_ARTIST_ALBUMS], []]
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
