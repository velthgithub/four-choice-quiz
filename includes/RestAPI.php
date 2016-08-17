<?php

namespace Torounit\FCQ;


class RestAPI {

	use Fields;

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
			'questions' => $this->get_questions( $data['id'] ),
			'images'    => $this->get_images( $data['id'] ),
		];
	}

}