<?php

/**
 * Block bindings source registrar.
 *
 * @author    Bifrost
 * @copyright Copyright (c) 2026, WordPress
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/wptrainingteam/developer-showcase
 */

declare(strict_types=1);

namespace Bifrost\Noise\Block\Binding;

use TypeError;
use Bifrost\Noise\Contracts\Bootable;

/**
 * Registers custom binding sources via the WordPress Block Bindings API.
 */
final class BindingSourceRegistrar implements Bootable
{
	/**
	 * Sets up the initial object state.
	 */
	public function __construct(private readonly array $sources)
	{}

	/**
	 * @inheritDoc
	 */
	public function boot(): void {
		add_action('init', $this->register(...));
	}

	/**
	 * Register custom block bindings sources.
	 */
	public function register(): void
	{
		foreach ($this->sources as $source) {
			if (is_string($source)) {
				$source = new $source;
			}

			if (! $source instanceof BindingSource) {
				throw new TypeError(esc_html(sprintf(
					// Translators: %s is a PHP class name.
					__('Only %s classes can be registered', 'bifrost-noise'),
					BindingSource::class
				)));
			}

			register_block_bindings_source($source->getName(), [
				'label'              => $source->getLabel(),
				'get_value_callback' => $source->callback(...),
				'uses_context'       => $source->usesContext()
			]);
		}
	}
}
