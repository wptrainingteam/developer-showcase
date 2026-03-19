<?php

/**
 * Theme functions file, which is autoloaded by WordPress. This file is used to
 * load any other necessary PHP files and bootstrap the theme.
 *
 * @author    Bifrost
 * @copyright Copyright (c) 2026, WordPress
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/wptrainingteam/developer-showcase
 */

declare(strict_types=1);

namespace Bifrost\Noise;

# Prevent direct access.
defined('ABSPATH') || exit;

# Load the autoloader.
if (! class_exists(Theme::class) && is_file(__DIR__ . '/vendor/autoload.php')) {
	require_once __DIR__ . '/vendor/autoload.php';
}

# Register the theme's service providers with the framework application.
add_action('bifrost/framework/register/theme', [Theme::class, 'register']);
