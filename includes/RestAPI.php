<?php

namespace Torounit\FCQ;


class RestAPI {


	public function __construct() {
		add_action( 'rest_api_init', [ $this, 'rest_api_alter' ] );
	}


	public function rest_api_alter() {
		register_rest_field( 'quiz', 'fcq', [
				'get_callback'    => [ $this, 'get_callback' ],
				'update_callback' => null,
				'schema'          => null,
			]
		);
	}

	/**
	 * @param array $data 現在の投稿の詳細データ
	 * @param string $field フィールド名
	 * @param \WP_REST_Request $request 現在のリクエスト
	 * @param string $type
	 *
	 * @return array
	 */
	public function get_callback( $data, $field, $request, $type ) {
		return [
			'questions' => $this->get_questions( $data, $field, $request, $type ),
			'images'    => $this->get_images( $data, $field, $request, $type ),
		];
	}

	/**
	 * @param array $data 現在の投稿の詳細データ
	 * @param string $field フィールド名
	 * @param \WP_REST_Request $request 現在のリクエスト
	 * @param string $type
	 *
	 * @return array
	 */
	public function get_questions( $data, $field, $request, $type ) {
		$questions = get_post_meta( $data['id'], 'FCQ_question', true );

		return array_map( [ $this, 'modify_question_data' ], $questions, array_keys( $questions) );

	}

	/**
	 * @param array $question
	 * @return array
	 */
	public function modify_question_data( $question, $id ) {
		$question['options'] = [
			$question['option1'],
			$question['option2'],
			$question['option3'],
			$question['option4'],
		];

		unset( $question['option1'] );
		unset( $question['option2'] );
		unset( $question['option3'] );
		unset( $question['option4'] );
		$question['id'] = $id;
		$question['answer'] = intval( $question['answer'] );

		return $question;
	}

	public function get_images( $data, $field, $request, $type ) {
		$images = get_post_meta( $data['id'], 'FCQ_images', true );
		$images = array_map( [ $this, 'modify_image_data' ], $images );
		usort( $images, function( $a, $b ) {
			if( $a['threshold'] == $b['threshold'] ) {
				return 0;
			}
			return ( $a['threshold'] < $b['threshold'] ) ? -1 : 1;
		} );
		return $images;
	}

	public function modify_image_data( $image ) {
		$image['threshold'] = intval( $image['threshold'] );
		return $image;
	}
}