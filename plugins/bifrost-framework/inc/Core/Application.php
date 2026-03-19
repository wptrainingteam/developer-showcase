<?php

/**
 * Abstract application class.
 *
 * @author    Bifrost
 * @copyright Copyright (c) 2026, WordPress
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/wptrainingteam/developer-showcase
 */

declare(strict_types=1);

namespace Bifrost\Framework\Core;

use InvalidArgumentException;
use Bifrost\Framework\Container\Container;
use Bifrost\Framework\Contracts\Bootable;

/**
 * Application class that handles bootstrapping the framework.
 */
class Application implements Bootable
{
	/**
	 * An array of service provider classnames to automatically register if
	 * defined in a subclass.
	 *
	 * @var  array<string> Service provider classnames.
	 * @todo Type hint with PHP 8.3+ requirement.
	 */
	protected const PROVIDERS = [];

	/**
	 * Stores an array of the registered service providers.
	 */
	private array $serviceProviders = [];

	/**
	 * Tracks which providers have already been booted to support multiple
	 * boot phases (e.g., plugins_loaded and after_setup_theme).
	 */
	private array $bootedProviders = [];

	/**
	 * Sets up the initial object state.
	 */
	public function __construct(protected readonly Container $container)
	{
		// Register default bindings and service providers.
		$this->registerDefaultBindings();
		$this->registerDefaultProviders();
	}

	/**
	 * Registers default container bindings.
	 */
	protected function registerDefaultBindings(): void
	{
		$this->container->instance(Container::class, $this->container);
	}

	/**
	 * Registers the default service providers.
	 */
	protected function registerDefaultProviders(): void
	{
		foreach (static::PROVIDERS as $provider) {
			$this->register($provider);
		}
	}

	/**
	 * Get the container instance.
	 */
	public function container(): Container
	{
		return $this->container;
	}

	/**
	 * Register a service provider with the application.
	 */
	public function register(ServiceProvider|string $provider): void
	{
		if (is_string($provider)) {
			if (! is_subclass_of($provider, ServiceProvider::class)) {
				throw new InvalidArgumentException(sprintf(
					'Provider must be a %s class',
					ServiceProvider::class
				));
			}

			$provider = new $provider($this->container);
		}

		$provider->register();
		$this->serviceProviders[] = $provider;
	}

	/**
	 * Boots all service providers that implement the `Bootable` interface.
	 * Providers that have already been booted are skipped, making it safe to
	 * call multiple times across different load phases.
	 */
	public function boot(): void
	{
		foreach ($this->serviceProviders as $provider) {
			if ($provider instanceof Bootable && ! in_array($provider, $this->bootedProviders, true)) {
				$provider->boot();
				$this->bootedProviders[] = $provider;
			}
		}
	}
}
