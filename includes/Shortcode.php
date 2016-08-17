<?php

namespace Torounit\FCQ;

class Shortcode {


	/**
	 * Admin constructor.
	 */
	public function __construct() {
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_scripts'] );
		add_filter( 'the_content', [ $this, 'run_shortcode_before_wpautop' ] , 9 );
	}

	function run_shortcode_before_wpautop( $content ) {

		global $shortcode_tags;

		// 登録されているショートコードを退避して空に
		$orig_shortcode_tags = $shortcode_tags;
		remove_all_shortcodes();

		// wpautop関数実行前に処理したショートコードをここで追加
		add_shortcode( 'four-choice-quiz', [ $this, 'render_shortcode' ] );


		$content = do_shortcode( $content );

		// 退避したショートコードを元に戻す
		$shortcode_tags = $orig_shortcode_tags;


		return $content;
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

		$post = get_post($param['id']);
		$content = $post->post_content;
		return sprintf('<div class="four-choice-quiz"><p class="four-choice-quiz__description">%s</p><div class="four-choice-quiz-app" data-id="%d" data-currentid="%s"></div></div>',
			$content,
			$param['id'],
			get_the_ID()
		);
	}



}




