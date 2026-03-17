<?php

/**
 * Stylesheet loader.
 *
 * @author    Bifrost
 * @copyright Copyright (c) 2026, WordPress
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/wptrainingteam/developer-showcase
 */

declare(strict_types=1);

namespace Bifrost\Noise\Block\Stylesheet;

use Bifrost\Noise\Contracts\Bootable;

/**
 * Handles registering and enqueueing block stylesheets.
 *
 * This service automatically discovers and enqueues block-specific stylesheets
 * using WordPress's block style API. Stylesheets are only loaded when their
 * associated blocks are actually used on a page, improving performance.
 */
final class StylesheetLoader implements Bootable
{
	/**
	 * Handle prefix used for registering block styles.
	 */
	private const HANDLE_PREFIX = 'bifrost-noise-block';

	/**
	 * Sets up the stylesheet service.
	 */
	public function __construct(private readonly StylesheetIterator $discovery)
	{}

	/**
	 * @inheritDoc
	 */
	public function boot(): void
	{
		add_action('init', $this->enqueue(...), 999999);
	}

	/**
	 * Enqueues block-specific styles for conditional loading.
	 *
	 * Iterates through discovered stylesheets and enqueues those that have
	 * accompanying asset files. This ensures styles are only loaded when
	 * their associated blocks are present on a page.
	 */
	private function enqueue(): void
	{
		foreach ($this->discovery as $stylesheet) {
			$this->enqueueStylesheet($stylesheet);
		}
	}

	/**
	 * Enqueues an individual block stylesheet with WordPress.
	 *
	 * Registers the stylesheet using WordPress's block style API, which
	 * handles conditional loading. The style handle is generated from the
	 * block's namespace and slug, and dependencies/version are read from
	 * the stylesheet's asset file.
	 */
	private function enqueueStylesheet(Stylesheet $stylesheet): void
	{
		$namespace = $stylesheet->getNamespace();
		$slug      = $stylesheet->getSlug();

		wp_enqueue_block_style($stylesheet->getBlockName(), [
			'handle' => self::HANDLE_PREFIX . "-{$namespace}-{$slug}",
			'src'    => $stylesheet->getFileUrl(),
			'path'   => $stylesheet->getFilePath(),
			'deps'   => $stylesheet->getDependencies(),
			'ver'    => $stylesheet->getVersion()
		]);
	}
}
