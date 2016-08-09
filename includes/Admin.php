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
			'title'        => __( 'Repeating Field Group', 'four-choice-quiz' ),
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
				// 'closed'     => true, // true to have the groups closed by default
			),
			'attributes'  => array(
				'data-FCQ-input' => 'question',
			),
		) );


		$cmb2_box->add_group_field( $box_id, array(
			'name'       => __( 'Question', 'four-choice-quiz' ),
			'id'         => 'question',
			'type'       => 'text',
		) );

		$cmb2_box->add_group_field( $box_id, array(
			'name'       => __( 'Choices', 'four-choice-quiz' ),
			'id'         => 'choices',
			'type'       => 'text',
			'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
			'attributes'  => array(
				'data-FCQ-input' => 'choices',
			),
		) );

		$cmb2_box->add_group_field( $box_id, array(
			'name'       => __( 'Answer No', 'four-choice-quiz' ),
			'id'         => 'answer',
			'type'       => 'text',
		) );


		$cmb2_box->add_group_field( $box_id, array(
			'name'        => __( 'Comment', 'cmb2' ),
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




