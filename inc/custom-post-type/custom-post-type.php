<?php

	// PRODUCTS
	add_action( 'init', 'cpt_faq_init' );

	function cpt_faq_init() {

		$labels = array(
			'name'               => _x( 'FAQ', 'goodmorning' ),
			'singular_name'      => _x( 'FAQ', 'goodmorning' ),
			'menu_name'          => _x( 'FAQ', 'goodmorning' ),
			'name_admin_bar'     => _x( 'FAQ', 'goodmorning' ),
			'add_new'            => _x( 'New FAQ', 'goodmorning' ),
			'add_new_item'       => __( 'Add new FAQ', 'goodmorning' ),
			'new_item'           => __( 'New FAQ', 'goodmorning' ),
			'edit_item'          => __( 'Edit FAQ', 'goodmorning' ),
			'view_item'          => __( 'View FAQ', 'goodmorning' ),
			'all_items'          => __( 'All FAQs', 'goodmorning' ),
			'search_items'       => __( 'Search FAQs', 'goodmorning' ),
			'parent_item_colon'  => __( '', 'mint' ),
			'not_found'          => __( '', 'mint' ),
			'not_found_in_trash' => __( '', 'mint' )
		);

		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'menu_icon'			 		 => 'dashicons-testimonial',
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'question-answer' ),
			'capability_type'    => 'post',
			'has_archive'        => false,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array( 'title', 'thumbnail' ),
			'show_in_rest'			 => true
		);

		register_post_type( 'cpt_faq', $args );

	}

?>
