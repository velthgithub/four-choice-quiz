<?php

namespace Torounit\FCQ;

class Admin {


	/**
	 * Admin constructor.
	 */
	public function __construct() {
		add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_scripts'] );
	}


	public function enqueue_scripts() {

//		wp_enqueue_script(
//			'FCQ-admin',
//			plugins_url( 'assets/scripts/admin.js', FCQ_FILE ),
//			array( 'jquery')
//
//		);
	}

}




