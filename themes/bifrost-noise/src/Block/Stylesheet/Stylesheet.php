<?php

/**
 * Block stylesheet.
 *
 * @author    Bifrost
 * @copyright Copyright (c) 2026, WordPress
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-later
 * @link      https://github.com/wptrainingteam/developer-showcase
 */

declare(strict_types=1);

namespace Bifrost\Noise\Block\Stylesheet;

use SplFileInfo;

/**
 * Represents a discovered block stylesheet with its metadata.
 *
 * Value object that encapsulates information about a block-specific stylesheet
 * file, including its namespace, slug, and filesystem paths. Provides convenient
 * accessors for retrieving block identifiers and locating associated CSS and
 * asset files within the theme directory structure.
 */
final class Stylesheet
{
	/**
	 * The block namespace (typically the directory name).
	 */
	private readonly string $namespace;

	/**
	 * The block slug (filename without .css extension).
	 */
	private readonly string $slug;

	/**
	 * The relative path to the stylesheet within the theme.
	 */
	private readonly string $path;

	/**
	 * The data returned from the associated `*.asset.php` file generated
	 * from WP scripts.
	 */
	private array $assetData = [];

	/**
	 * Creates a new stylesheet instance from a discovered CSS file.
	 *
	 * Extracts the namespace from the parent directory name and the slug
	 * from the filename, then constructs the relative path for locating
	 * the stylesheet and its assets within the theme.
	 */
	public function __construct(SplFileInfo $file, string $path)
	{
		$this->namespace = $file->getPathInfo()->getBasename();
		$this->slug = $file->getBasename('.css');
		$this->path = "{$path}/{$this->namespace}/{$this->slug}";
	}

	/**
	 * Returns the block namespace.
	 */
	public function getNamespace(): string
	{
		return $this->namespace;
	}

	/**
	 * Returns the block slug.
	 */
	public function getSlug(): string
	{
		return $this->slug;
	}

	/**
	 * Returns the full block name in namespace/slug format.
	 */
	public function getBlockName(): string
	{
		return "{$this->namespace}/{$this->slug}";
	}

	/**
	 * Returns the relative path to the stylesheet.
	 */
	public function getPath(): string
	{
		return $this->path;
	}

	/**
	 * Returns the absolute filesystem path to the CSS file.
	 */
	public function getFilePath(): string
	{
		return get_parent_theme_file_path("{$this->path}.css");
	}

	/**
	 * Returns the public URL to the CSS file.
	 */
	public function getFileUrl(): string
	{
		return get_parent_theme_file_uri("{$this->path}.css");
	}

	/**
	 * Checks if an asset metadata file exists for this stylesheet.
	 *
	 * Asset files (.asset.php) typically contain dependency and version
	 * information for enqueueing scripts/styles.
	 */
	public function hasAssetFile(): bool
	{
		return file_exists(get_parent_theme_file_path("{$this->path}.asset.php"));
	}

	/**
	 * Loads and returns the asset metadata.
	 */
	public function getAssetData(): array
	{
		if ([] !== $this->assetData) {
			return $this->assetData;
		}

		$this->assetData = $this->hasAssetFile()
			? include get_parent_theme_file_path("{$this->path}.asset.php")
			: [
				'dependencies' => [],
				'version'      => wp_get_theme()->get('Version')
			];

		return $this->assetData;
	}

	/**
	 * Returns the stylesheet dependencies.
	 */
	public function getDependencies(): array
	{
		$data = $this->getAssetData();
		return $data['dependencies'] ?? [];
	}

	/**
	 * Returns the stylesheet version.
	 */
	public function getVersion(): string
	{
		$data = $this->getAssetData();
		return $data['version'] ?? '';
	}
}
