<?php

/**
 * Album post type modifier.
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2023-2025, Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/x3p0-dev/bifrost-noise
 */

declare(strict_types=1);

namespace Bifrost\Noise\PostType\Modifiers;

use Bifrost\Noise\PostType\PostTypeModifier;

final class Album implements PostTypeModifier
{
	public function modify(array $args): array
	{
		$args['template'] = $this->getTemplate();

		return $args;
	}

	private function getTemplate(): array
	{
		return [
			['core/paragraph', [
				'placeholder' => __('Add album description...', 'bifrost-noise'),
			], []],
			['core/playlist', [], []],
		];
	}
}
