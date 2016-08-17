<?php

namespace Torounit\FCQ;

class AdminFields {

	/** @var \CMB2 */
	private $cmb2;

	/**
	 * Admin constructor.
	 */
	public function __construct() {
		add_action( 'cmb2_admin_init', [ $this, 'register_meta_box' ] );
	}

	public function register_meta_box() {
		$this->cmb2 = new_cmb2_box( [
			'id'           => 'FCQ_metabox',
			'title'        => __( 'Quiz', 'four-choice-quiz' ),
			'object_types' => [ 'quiz', ],
		] );

		$this->register_questions_fields();
		$this->register_images_fields();
	}

	public function register_questions_fields() {
		$question_box_id = $this->cmb2->add_field( [
			'id'      => 'FCQ_question',
			'type'    => 'group',
			//'description' => __( 'Generates reusable form entries', 'four-choice-quiz' ),
			'options' => [
				'group_title'   => __( 'Question {#}', 'four-choice-quiz' ), // {#} gets replaced by row number
				'add_button'    => __( 'Add Another Question', 'four-choice-quiz' ),
				'remove_button' => __( 'Remove Question', 'four-choice-quiz' ),
				'sortable'      => true, // beta
			],
		] );


		$this->cmb2->add_group_field( $question_box_id, [
			'name' => __( 'Question', 'four-choice-quiz' ),
			'id'   => 'question',
			'type' => 'textarea_small',
		] );

		$this->cmb2->add_group_field( $question_box_id, [
			'name' => __( 'Option #1', 'four-choice-quiz' ),
			'id'   => 'option1',
			'type' => 'text',
		] );

		$this->cmb2->add_group_field( $question_box_id, [
			'name' => __( 'Option #2', 'four-choice-quiz' ),
			'id'   => 'option2',
			'type' => 'text',
		] );

		$this->cmb2->add_group_field( $question_box_id, [
			'name' => __( 'Option #3', 'four-choice-quiz' ),
			'id'   => 'option3',
			'type' => 'text',
		] );

		$this->cmb2->add_group_field( $question_box_id, [
			'name' => __( 'Option #4', 'four-choice-quiz' ),
			'id'   => 'option4',
			'type' => 'text',
		] );

		$this->cmb2->add_group_field( $question_box_id, [
			'name'    => __( 'Answer No', 'four-choice-quiz' ),
			'id'      => 'answer',
			'type'    => 'select',
			'options' => [
				'1' => __( '#1', 'four-choice-quiz' ),
				'2' => __( '#2', 'four-choice-quiz' ),
				'3' => __( '#3', 'four-choice-quiz' ),
				'4' => __( '#4', 'four-choice-quiz' ),
			],
		] );

		$this->cmb2->add_group_field( $question_box_id, [
			'name'        => __( 'Comment', 'four-choice-quiz' ),
			'description' => __( 'Comment for selected answer', 'four-choice-quiz' ),
			'id'          => 'comment',
			'type'        => 'textarea_small',
		] );

	}


	public function register_images_fields() {
		$image_box_id = $this->cmb2->add_field( [
			'id'      => 'FCQ_images',
			'type'    => 'group',
			//'description' => __( 'Generates reusable form entries', 'four-choice-quiz' ),
			'options' => [
				'group_title'   => __( 'Image {#}', 'four-choice-quiz' ), // {#} gets replaced by row number
				'add_button'    => __( 'Add Another Image', 'four-choice-quiz' ),
				'remove_button' => __( 'Remove Image', 'four-choice-quiz' ),
				'sortable'      => true, // beta
			],
		] );

		$this->cmb2->add_group_field( $image_box_id, [
			'name'        => __( 'Threshold', 'four-choice-quiz' ),
			'description' => __( 'Threshold of answers for image. 0 is default image.', 'four-choice-quiz' ),
			'id'          => 'threshold',
			'type'        => 'text_small',
			'default'     => '0',
			'attributes'  => [
				'type'    => 'number',
				'pattern' => '\d*',
				'min'     => '0',
			],
		] );

		$this->cmb2->add_group_field( $image_box_id, [
			'name'    => 'Image',
			//'desc'    => 'Upload an image or enter an URL.',
			'id'      => 'image',
			'type'    => 'file',
			// Optional:
			'options' => [
				'url' => false, // Hide the text input for the url
			],
			'text'    => [
				'add_upload_file_text' => 'Select Image' // Change upload button text. Default: "Add or Upload File"
			],
		] );
	}


}




