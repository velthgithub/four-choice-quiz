<?php
/**
 * Created by PhpStorm.
 * User: torounit
 * Date: 2016/08/17
 * Time: 6:14
 */

namespace Torounit\FCQ;


class Result {

	use Fields;

	/**
	 * ResultView constructor.
	 */
	public function __construct() {

		add_action( 'query_vars',  [ $this, 'add_point_query_var'] );
		add_filter( 'the_content', [ $this, 'the_content'] );
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_scripts'] );
	}

	public function add_point_query_var( $vars ) {
		$vars[] = 'point';
		$vars[] = 'embedid';
		return $vars;
	}

	private function get_point() {
		$point = get_query_var( 'point', 0 );
		return intval( $point );
	}

	/**
	 * @param $post_id
	 *
	 * @return array
	 */
	private function get_result_image( $post_id ) {
		$filtered = array_filter(  $this->get_images( $post_id ), function( $image ) {
			return ( $image['threshold'] <= $this->get_point() );
		});

		$result = end( $filtered );
		if( $result ) {
			return wp_get_attachment_image( $result['image_id'], 'full' );
		}

		return '';

	}

	private function get_app_page_link( ) {
		$embedid = get_query_var( 'embedid', 0 );
		return $link = get_permalink( intval( $embedid ) );
	}


	public function enqueue_scripts() {
		wp_enqueue_script( 'twitter-wjs', 'https://platform.twitter.com/widgets.js', false );
		wp_enqueue_script( 'facebook-jssdk', '//connect.facebook.net/ja_JP/sdk.js#xfbml=1&version=v2.7', false );
	}

	public function the_content( $html ) {
		$post = get_post();
		if( 'quiz' != get_post_type( $post ) ) {
			return $html;
		}

		$question_link = '';
		if( $href = $this->get_app_page_link() ) {
			$question_link = sprintf('<p><a href="%s" class="btn" style="display: block">チャレンジ！</a></p>', $href);
		}

		return sprintf(
			'
			<div class="result-image">%s</div>
			<p class="share-comment">結果をみんなに知らせて盛り上がりましょう。SNSボタンをクリック！</p>
			<div class="share-buttons">%s</div>
			%s,
			',
			$this->get_result_image( get_the_ID() ),
			$this->get_share_buttons(),
			$question_link
		);
	}

	private function get_share_link() {
		return get_permalink();
	}

	private function get_share_buttons() {

		$line = sprintf(
			'<a href="http://line.me/R/msg/text/?%s%%0D%%0A%s"><img src="https://media.line.me/img/button/ja/82x20.png" width="82" height="20" alt="LINEで送る">',
			'タイトル',
			$this->get_share_link()
		);

		$facebook = '<div class="fb-share-button" data-href="'.$this->get_share_link().'" data-layout="button" data-size="small" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse">シェア</a></div>';

		$twitter = sprintf(
			'<a href="https://twitter.com/share" class="twitter-share-button" data-text="%s" data-url="%s">Tweet</a>',
			'タイトル',
			$this->get_share_link()
		);

		return $twitter . $facebook;
	}
}