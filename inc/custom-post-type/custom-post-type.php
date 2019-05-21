<?php

	// CPT NAME HERE
	add_action( 'init', 'cpt_CPTNAMEHERE_init' );

	function cpt_CPTNAMEHERE_init() {

		$labels = array(
			'name'               => _x( 'CPTNAMEHERE', 'THEMENAME' ),
			'singular_name'      => _x( 'CPTNAMEHERE', 'THEMENAME' ),
			'menu_name'          => _x( 'CPTNAMEHERE', 'THEMENAME' ),
			'name_admin_bar'     => _x( 'CPTNAMEHERE', 'THEMENAME' ),
			'add_new'            => _x( 'New CPTNAMEHERE', 'THEMENAME' ),
			'add_new_item'       => __( 'Add new CPTNAMEHERE', 'THEMENAME' ),
			'new_item'           => __( 'New CPTNAMEHERE', 'THEMENAME' ),
			'edit_item'          => __( 'Edit CPTNAMEHERE', 'THEMENAME' ),
			'view_item'          => __( 'View CPTNAMEHERE', 'THEMENAME' ),
			'all_items'          => __( 'All CPTNAMEHERE', 'THEMENAME' ),
			'search_items'       => __( 'Search CPTNAMEHERE', 'THEMENAME' ),
			'parent_item_colon'  => __( '', 'THEMENAME' ),
			'not_found'          => __( '', 'THEMENAME' ),
			'not_found_in_trash' => __( '', 'THEMENAME' )
		);

		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'menu_icon'			 		 => '', // Menu icon -> https://developer.wordpress.org/resource/dashicons/
			'query_var'          => true,
			'rewrite'            => array( 'slug' => '' ), // change permalink slug (optional, recommended)(WPML translateable)
			'capability_type'    => 'post',
			'has_archive'        => false,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array( 'title', 'thumbnail' ), // More options possible
			'show_in_rest'			 => true // Gutenberg & REST API activation
		);

		//register_post_type( 'cpt_CPTNAMEHERE', $args );

	}

?>
