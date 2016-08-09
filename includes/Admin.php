<?php

namespace Torounit\FCQ;

class Admin {


	/**
	 * Admin constructor.
	 */
	public function __construct() {
		add_action( 'cmb2_admin_init', [ $this, 'register_repeatable_group_field_metabox'] );
		add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_scripts'] );
	}


	/**
	 * Hook in and add a metabox to demonstrate repeatable grouped fields
	 */
	function register_repeatable_group_field_metabox() {
		$prefix = 'FCQ_group_';

		/**
		 * Repeatable Field Groups
		 */
		$cmb2_box = new_cmb2_box( array(
			'id'           => $prefix . 'metabox',
			'title'        => __( 'Quiz', 'four-choice-quiz' ),
			'object_types' => array( 'quiz', ),
		) );

		// $box_id is the field id string, so in this case: $prefix . 'demo'
		$box_id = $cmb2_box->add_field( array(
			'id'          => $prefix . 'Question',
			'type'        => 'group',
			//'description' => __( 'Generates reusable form entries', 'four-choice-quiz' ),
			'options'     => array(
				'group_title'   => __( 'Question {#}', 'four-choice-quiz' ), // {#} gets replaced by row number
				'add_button'    => __( 'Add Another Question', 'four-choice-quiz' ),
				'remove_button' => __( 'Remove Question', 'four-choice-quiz' ),
				//'sortable'      => true, // beta
			),
		) );


		$cmb2_box->add_group_field( $box_id, array(
			'name'       => __( 'Question', 'four-choice-quiz' ),
			'id'         => 'question',
			'type'       => 'textarea_small',
		) );

		$cmb2_box->add_group_field( $box_id, array(
			'name'       => __( 'Option #1', 'four-choice-quiz' ),
			'id'         => 'option1',
			'type'       => 'text',
		) );

		$cmb2_box->add_group_field( $box_id, array(
			'name'       => __( 'Option #2', 'four-choice-quiz' ),
			'id'         => 'option2',
			'type'       => 'text',
		) );

		$cmb2_box->add_group_field( $box_id, array(
			'name'       => __( 'Option #3', 'four-choice-quiz' ),
			'id'         => 'option3',
			'type'       => 'text',
		) );

		$cmb2_box->add_group_field( $box_id, array(
			'name'       => __( 'Option #4', 'four-choice-quiz' ),
			'id'         => 'option4',
			'type'       => 'text',
		) );

		$cmb2_box->add_group_field( $box_id, array(
			'name'       => __( 'Answer No', 'four-choice-quiz' ),
			'id'         => 'answer',
			'type'       => 'select',
			'default'          => '1',
			'options'          => array(
				'1' => __( '#1',  'four-choice-quiz' ),
				'2' => __( '#2',  'four-choice-quiz' ),
				'3' => __( '#3',  'four-choice-quiz' ),
				'4' => __( '#4',  'four-choice-quiz' ),

			),
		) );


		$cmb2_box->add_group_field( $box_id, array(
			'name'        => __( 'Comment',  'four-choice-quiz' ),
			'description' => __( 'Comment for selected ansswer', 'four-choice-quiz' ),
			'id'          => 'comment',
			'type'        => 'textarea_small',
		) );


	}

	public function enqueue_scripts() {

		wp_enqueue_script(
			'FCQ-admin',
			plugins_url( 'assets/scripts/admin.js', FCQ_FILE ),
			array( 'jquery')

		);
	}

}




