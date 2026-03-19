<?php

/**
 * Container implementation.
 *
 * @author    Bifrost
 * @copyright Copyright (c) 2026
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/wptrainingteam/developer-showcase
 */

declare(strict_types=1);

namespace Bifrost\Player\Container;

use Closure;
use Exception;
use ReflectionClass;
use ReflectionNamedType;
use ReflectionParameter;

/**
 * Implementation of the dependency injection container.
 */
final class ServiceContainer implements Container
{
	/**
	 * Stores registered services.
	 */
	protected array $bindings = [];

	/**
	 * Stores registered instances and resolved singletons.
	 */
	protected array $instances = [];

	/**
	 * @inheritDoc
	 */
	public function transient(string $abstract, mixed $concrete = null): void
	{
		unset($this->instances[$abstract]);

		$this->bindings[$abstract] = [
			'concrete' => $concrete === null ? $abstract : $concrete,
			'shared'   => false
		];
	}

	/**
	 * @inheritDoc
	 */
	public function singleton(string $abstract, mixed $concrete = null): void
	{
		unset($this->instances[$abstract]);

		$this->bindings[$abstract] = [
			'concrete' => $concrete === null ? $abstract : $concrete,
			'shared'   => true
		];
	}

	/**
	 * @inheritDoc
	 */
	public function instance(string $abstract, mixed $instance): void
	{
		$this->instances[$abstract] = $instance;
	}

	/**
	 * @inheritDoc
	 * @throws Exception
	 */
	public function get(string $abstract): mixed
	{
		return $this->resolve($abstract);
	}

	/**
	 * @inheritDoc
	 * @throws Exception
	 */
	public function make(string $abstract, array $parameters = []): object
	{
		return $this->resolve($abstract, $parameters);
	}

	/**
	 * @inheritDoc
	 */
	public function has(string $abstract): bool
	{
		return isset($this->bindings[$abstract]) || isset($this->instances[$abstract]);
	}

	/**
	 * Resolve a service from the container with additional parameters.
	 * @throws Exception
	 */
	private function resolve(string $abstract, array $parameters = []): mixed
	{
		if (isset($this->instances[$abstract]) && $parameters === []) {
			return $this->instances[$abstract];
		}

		$concrete = $this->getConcrete($abstract);

		if (! $this->isBuildable($concrete)) {
			throw new Exception(sprintf(
				'Service %s is not buildable.',
				$abstract
			));
		}

		$service = $this->build($concrete, $parameters);

		if ($this->isShared($abstract) && $parameters === []) {
			$this->instances[$abstract] = $service;
		}

		return $service;
	}

	/**
	 * Check if an abstract is bound as a singleton.
	 */
	private function isShared(string $abstract): bool
	{
		return isset($this->instances[$abstract])
			|| ($this->bindings[$abstract]['shared'] ?? false);
	}

	/**
	 * Determine if the given concrete is buildable.
	 */
	private function isBuildable(mixed $concrete): bool
	{
		return $concrete instanceof Closure
			|| (is_string($concrete) && class_exists($concrete));
	}

	/**
	 * Get the concrete implementation for an abstract.
	 */
	private function getConcrete(string $abstract): mixed
	{
		return ! isset($this->bindings[$abstract])
			? $abstract
			: $this->bindings[$abstract]['concrete'];
	}

	/**
	 * Build an instance of the given concrete.
	 * @throws Exception
	 */
	private function build(Closure|string $concrete, array $parameters = []): object
	{
		if ($concrete instanceof Closure) {
			return $concrete($this, $parameters);
		}

		$reflector = new ReflectionClass($concrete);

		$constructor = $reflector->getConstructor();

		if ($constructor === null) {
			return new $concrete();
		}

		return $reflector->newInstanceArgs($this->resolveDependencies(
			$constructor->getParameters(),
			$parameters
		));
	}

	/**
	 * Resolve constructor dependencies.
	 * @throws Exception
	 */
	private function resolveDependencies(array $params, array $providedParams): array
	{
		$dependencies = [];

		foreach ($params as $param) {
			$name = $param->getName();

			if (array_key_exists($name, $providedParams)) {
				$dependencies[] = $providedParams[$name];
				continue;
			}

			$type = $param->getType();

			if (! $type instanceof ReflectionNamedType || $type->isBuiltin()) {
				$dependencies[] = $this->resolveNonTyped($param);
				continue;
			}

			$className = $type->getName();

			if ($this->has($className)) {
				$dependencies[] = $this->resolve($className);
				continue;
			}

			if (class_exists($className)) {
				$dependencies[] = $this->make($className);
			}
		}

		return $dependencies;
	}

	/**
	 * Resolve a non-typed or built-in typed parameter.
	 * @throws Exception
	 */
	private function resolveNonTyped(ReflectionParameter $param): mixed
	{
		return $param->isDefaultValueAvailable()
			? $param->getDefaultValue()
			: throw new Exception(sprintf(
				'Cannot resolve parameter %s.',
				$param->getName()
			));
	}
}
