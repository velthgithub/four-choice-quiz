<?php

namespace Torounit\FCQ;

class View {


	/**
	 * Admin constructor.
	 */
	public function __construct() {
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_scripts'] );
		add_shortcode( 'four-choice-quiz', [ $this, 'render_shortcode' ] );

	}


	public function enqueue_scripts() {
		wp_enqueue_style( 'wcq', plugins_url( 'style.css', FCQ_FILE ), [], '1.0.0' );
		wp_enqueue_script(
			'fcq',
			plugins_url( 'bundle.js', FCQ_FILE ),
			[ 'jquery', 'underscore' ],
			'1.0.0',
			true
		);
	}

	public function render_shortcode( $attr ) {
		$param = shortcode_atts( array(
			'id' => 0,
		),$attr, 'four-choice-quiz' );

		return sprintf('<div class="four-choice-quiz" data-id="%d"></div>', $param['id'] );
	}



}




