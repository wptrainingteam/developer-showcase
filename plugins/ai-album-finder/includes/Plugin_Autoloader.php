<?php
/**
 * Class AI_Album_Finder\Plugin_Autoloader
 *
 * @package ai-album-finder
 */

namespace AI_Album_Finder;

/**
 * Plugin autoloader class.
 *
 * @since 1.0.0
 */
class Plugin_Autoloader {

	/**
	 * Namespace prefix.
	 *
	 * @since 1.0.0
	 * @var string
	 */
	private $namespace_prefix;

	/**
	 * Class map.
	 *
	 * @since 1.0.0
	 * @var array<string, string>
	 */
	private $class_map;

	/**
	 * Constructor.
	 *
	 * @since 1.0.0
	 *
	 * @param string $namespace_prefix Namespace prefix.
	 * @param string $class_map_file   Path to the class map file.
	 */
	public function __construct( string $namespace_prefix, string $class_map_file ) {
		$this->namespace_prefix = $namespace_prefix;
		$this->class_map        = require $class_map_file;
	}

	/**
	 * Autoloads a class.
	 *
	 * @since 1.0.0
	 *
	 * @param string $class_name Class name.
	 * @return bool True if the class was loaded, false otherwise.
	 */
	public function autoload( string $class_name ): bool {
		// Check if the class name starts with the namespace prefix.
		if ( strpos( $class_name, $this->namespace_prefix . '\\' ) !== 0 ) {
			return false;
		}

		// Check if the class is in the class map.
		if ( ! isset( $this->class_map[ $class_name ] ) ) {
			return false;
		}

		// Require the class file.
		require_once $this->class_map[ $class_name ];

		return true;
	}
}
