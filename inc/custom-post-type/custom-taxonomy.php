<?php

	add_action( 'init', 'cpt_faq_cats', 0 );

	function cpt_faq_cats() {

		$labels = array(
			'name'              => _x( 'Categories', 'goodmorning' ),
			'singular_name'     => _x( 'Category', 'goodmorning' ),
			'search_items'      => __( 'Search Categories', 'goodmorning' ),
			'all_items'         => __( 'All Categories', 'goodmorning' ),
			'parent_item'       => __( 'Parent Category', 'goodmorning' ),
			'parent_item_colon' => __( 'Parent Category:', 'goodmorning' ),
			'edit_item'         => __( 'Edit Category', 'goodmorning' ),
			'update_item'       => __( 'Update Category', 'goodmorning' ),
			'add_new_item'      => __( 'Add New Category', 'goodmorning' ),
			'new_item_name'     => __( 'New Category Name', 'goodmorning' ),
			'menu_name'         => __( 'Categories', 'goodmorning' ),
		);

		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			//'rewrite'           => array( 'slug' => '' ),
		);

		register_taxonomy( 'cpt_cats', array( 'cpt_faq' ), $args );
	}

?>


