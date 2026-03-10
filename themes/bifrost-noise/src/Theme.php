<?php

/**
 * Theme application class.
 *
 * @author    Bifrost
 * @copyright Copyright (c) 2026, WordPress
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/wptrainingteam/developer-showcase
 */

declare(strict_types=1);

namespace Bifrost\Noise;

use Bifrost\Noise\Core\Application;

/**
 * The Theme class is an implementation of the Application contract. It's used
 * to register the default service providers, bootstrapping the theme.
 */
final class Theme extends Application
{
	/**
	 * Defines the theme's namespace, which is used as a hook prefix.
	 */
	protected const NAMESPACE = 'bifrost/noise';

	/**
	 * Defines the theme's default service providers.
	 */
	protected const PROVIDERS = [
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
}
