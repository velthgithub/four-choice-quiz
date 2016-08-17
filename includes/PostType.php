<?php

namespace Torounit\FCQ;

class PostType {


	/**
	 * PostType constructor.
	 */
	public function __construct() {
		add_action( 'init', [ $this, 'register_post_type'] );

	}

	public function register_post_type() {

		$labels = array(
			'name'               => _x( 'Quizzes', 'post type general name', 'four-choice-quiz' ),
			'singular_name'      => _x( 'Quiz', 'post type singular name', 'four-choice-quiz' ),
			'menu_name'          => _x( 'Quizzes', 'admin menu', 'four-choice-quiz' ),
			'name_admin_bar'     => _x( 'Quiz', 'add new on admin bar', 'four-choice-quiz' ),
			'add_new'            => _x( 'Add New', 'book', 'four-choice-quiz' ),
			'add_new_item'       => __( 'Add New Quiz', 'four-choice-quiz' ),
			'new_item'           => __( 'New Quiz', 'four-choice-quiz' ),
			'edit_item'          => __( 'Edit Quiz', 'four-choice-quiz' ),
			'view_item'          => __( 'View Quiz', 'four-choice-quiz' ),
			'all_items'          => __( 'All Quizzes', 'four-choice-quiz' ),
			'search_items'       => __( 'Search Quizzes', 'four-choice-quiz' ),
			'parent_item_colon'  => __( 'Parent Quizzes:', 'four-choice-quiz' ),
			'not_found'          => __( 'No quizzes found.', 'four-choice-quiz' ),
			'not_found_in_trash' => __( 'No quizzes found in Trash.', 'four-choice-quiz' )
		);

		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => false,
			'rewrite'            => false,
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'custom-fields' ),
			'show_in_rest'       => true,
		);

		register_post_type( 'quiz', $args );

	}
}