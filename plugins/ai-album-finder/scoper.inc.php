<?php
/**
 * PHP-Scoper configuration.
 *
 * @package ai-album-finder
 */

declare( strict_types=1 );

use Isolated\Symfony\Component\Finder\Finder;

return [
	'prefix'                     => 'AI_Album_Finder_Dependencies',
	'finders'                    => [
		Finder::create()
			->files()
			->ignoreVCS( true )
			->notName( '/LICENSE|.*\\.md|.*\\.dist|Makefile|composer\\.json|composer\\.lock/' )
			->exclude(
				[
					'doc',
					'test',
					'test_old',
					'tests',
					'Tests',
					'vendor-bin',
					'wordpress',
				]
			)
			->in( 'vendor' ),
		Finder::create()->append(
			[
				'composer.json',
			]
		),
	],
	'exclude-namespaces'         => [],
	'exclude-classes'            => [],
	'exclude-functions'          => [],
	'exclude-constants'          => [],
	'patchers'                   => [],
	'expose-global-constants'    => true,
	'expose-global-classes'      => true,
	'expose-global-functions'    => true,
	'expose-namespaces'          => [],
	'expose-classes'             => [],
	'expose-functions'           => [],
	'expose-constants'           => [],
];
