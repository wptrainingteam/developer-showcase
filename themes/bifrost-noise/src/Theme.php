<?php

/**
 * Theme lifecycle helper.
 *
 * @author    Bifrost
 * @copyright Copyright (c) 2026, WordPress
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/wptrainingteam/developer-showcase
 */

declare(strict_types=1);

namespace Bifrost\Noise;

use Bifrost\Framework\Core\Application;

/**
 * A static class that handles the various duties during the theme's lifecycle.
 */
final class Theme
{
	/**
	 * Service providers to register with the framework application.
	 *
	 * @var  array<class-string>
	 * @todo Type hint with PHP 8.3+ requirement.
	 */
	private const PROVIDERS = [
		ThemeServiceProvider::class,
		Block\Binding\BindingServiceProvider::class,
		Block\Render\RenderServiceProvider::class,
		Block\Stylesheet\StylesheetServiceProvider::class,
		Editor\EditorServiceProvider::class,
		Frontend\FrontendServiceProvider::class,
		Gutenberg\GutenbergServiceProvider::class,
		PostType\PostTypeServiceProvider::class,
		Template\TemplateServiceProvider::class
	];

	/**
	 * Registers the theme's service providers.
	 */
	public static function register(Application $app): void
	{
		foreach (self::PROVIDERS as $provider) {
			$app->register($provider);
		}
	}
}
