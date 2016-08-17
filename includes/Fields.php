<?php
/**
 * Created by PhpStorm.
 * User: torounit
 * Date: 2016/08/17
 * Time: 6:32
 */

namespace Torounit\FCQ;


trait Fields {

	/**
	 * @param int $post_id
	 *
	 * @return array
	 */
	public function get_questions( $post_id ) {
		$questions = get_post_meta( $post_id, 'FCQ_question', true );

		return array_map( [ $this, 'modify_question_data' ], $questions, array_keys( $questions ) );

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

	public function get_images( $post_id ) {
		$images = get_post_meta( $post_id, 'FCQ_images', true );
		$images = array_map( [ $this, 'modify_image_data' ], $images );
		usort( $images, function( $a, $b ) {
			if( $a['threshold'] == $b['threshold'] ) {
				return 0;
			}
			return ( $a['threshold'] < $b['threshold'] ) ? -1 : 1;
		} );
		return array_map( [ $this, 'add_image_id'], $images, array_keys( $images ));
	}

	public function modify_image_data( $image ) {
		$image['threshold'] = intval( $image['threshold'] );
		return $image;
	}

	public function add_image_id( $image , $id ){
		$image['id'] = $id;
		return $image;
	}
}