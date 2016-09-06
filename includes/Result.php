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

		add_action( 'query_vars', [ $this, 'add_point_query_var' ] );
		add_filter( 'the_content', [ $this, 'the_content' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_scripts' ] );
		//add_filter( 'jetpack_images_get_images', [ $this, 'jetpack_images_get_images' ], 10, 3 );
		add_filter( 'get_post_metadata', [ $this, 'get_post_metadata'], 10, 4 );

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

	public function get_post_metadata( $metadata, $post_id, $meta_key, $single ) {

		if ( is_admin() ) {
			return $metadata;
		}

		$post = get_post( $post_id );
		if ( 'quiz' != get_post_type( $post ) ) {
			return $metadata;
		}

		if( $meta_key == '_thumbnail_id' ) {
			$filtered = array_filter( $this->get_images( $post_id ), function ( $image ) {
				return ( $image['threshold'] <= $this->get_point() );
			} );

			if( !empty( $filtered ) ) {
				$result = end( $filtered );
				return $result['image_id'];
			}
		}
		return $metadata;
	}

	/**
	 * @param $post_id
	 * @param bool $html
	 *
	 * @return array|string
	 */
	private function get_result_image( $post_id , $html = true, $size = 'full' ) {
		$filtered = array_filter( $this->get_images( $post_id ), function ( $image ) {
			return ( $image['threshold'] <= $this->get_point() );
		} );

		$result = end( $filtered );
		if ( $result ) {
			if( $html ) {
				return wp_get_attachment_image( $result['image_id'], $size );
			}
			else {
				return wp_get_attachment_image_src(  $result['image_id'], $size );
			}
		}

		return '';

	}

	/**
	 * @param array $media Array of images that would be good for a specific post.
	 * @param int $post_id Post ID.
	 * @param array $args Array of options to get images.
	 *
	 * @return array
	 */
	public function jetpack_images_get_images( $media, $post_id, $args = [] ) {

		$post = get_post( $post_id );

		if ( 'quiz' != get_post_type( $post ) ) {
			return $media;
		}

		$result_image = $this->get_result_image( $post_id , false );

		$media = array(
			'type'       => 'image',
			'from'       => 'thumbnail',
			'src'        => $result_image[0],
			'src_width'  => $result_image[1],
			'src_height' => $result_image[2],
			'href'       => get_permalink($result_image[0])
		);

		return array($media);
	}

	private function get_app_page_link() {
		$embedid = get_query_var( 'embedid', 0 );

		return $link = get_permalink( intval( $embedid ) );
	}


	public function enqueue_scripts() {
		wp_enqueue_script( 'twitter-wjs', 'https://platform.twitter.com/widgets.js', false );
		wp_enqueue_script( 'facebook-jssdk', '//connect.facebook.net/ja_JP/sdk.js#xfbml=1&version=v2.7', false );
	}

	public function the_content( $html ) {
		$post = get_post();
		if ( 'quiz' != get_post_type( $post ) ) {
			return $html;
		}

		$question_link = '';
		if ( $href = $this->get_app_page_link() ) {
			$question_link = sprintf( '<p><a href="%s" class="btn" style="display: block">チャレンジ！</a></p>', $href );
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

		$facebook = '<div class="fb-share-button" data-href="' . $this->get_share_link() . '" data-layout="button" data-size="small" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse">シェア</a></div>';

		$twitter = sprintf(
			'<a href="https://twitter.com/share" class="twitter-share-button" data-text="%s" data-url="%s">Tweet</a>',
			'タイトル',
			$this->get_share_link()
		);

		return $twitter . $facebook;
	}
}