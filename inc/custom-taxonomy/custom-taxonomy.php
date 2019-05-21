<?php

	// TAX NAME HERE
	add_action( 'init', 'tax_TAXNAMEHERE_init', 0 );

	function tax_TAXNAMEHERE_init() {

		$labels = array(
			'name'              => _x( 'TAXNAMEHERE', 'THEMENAME' ),
			'singular_name'     => _x( 'TAXNAMEHERE', 'THEMENAME' ),
			'search_items'      => __( 'Search TAXNAMEHERE', 'THEMENAME' ),
			'all_items'         => __( 'All TAXNAMEHERE', 'THEMENAME' ),
			'parent_item'       => __( 'Parent TAXNAMEHERE', 'THEMENAME' ),
			'parent_item_colon' => __( 'Parent TAXNAMEHERE:', 'THEMENAME' ),
			'edit_item'         => __( 'Edit TAXNAMEHERE', 'THEMENAME' ),
			'update_item'       => __( 'Update TAXNAMEHERE', 'THEMENAME' ),
			'add_new_item'      => __( 'Add New TAXNAMEHERE', 'THEMENAME' ),
			'new_item_name'     => __( 'New TAXNAMEHERE Name', 'THEMENAME' ),
			'menu_name'         => __( 'TAXNAMEHERE', 'THEMENAME' ),
		);

		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => '' ), // change permalink slug (optional, recommended)(WPML translateable)
		);

		//register_taxonomy( 'tax_TAXNAMEHERE', array( 'cpt_CPTNAMEHERE' ), $args );

	}

?>
