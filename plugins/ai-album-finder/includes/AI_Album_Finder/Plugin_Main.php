<?php

namespace Developer_Showcase\AI_Album_Finder;

use WordPress\AI_Client\AI_Client;

class Plugin_Main {
	public function __construct() {
		// Plugin initialization code goes here.
	}

	public function add_hooks() {
		add_action( 'init', array( $this, 'init' ) );
	}

	public function init(): void {
		if ( class_exists( 'WordPress\AI_Client\AI_Client' ) ) {
			AI_Client::init();
		}
	}
}
