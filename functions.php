<?php

/**
 * If you are installing Timber as a Composer dependency in your theme, you'll need this block
 * to load your dependencies and initialize Timber. If you are using Timber via the WordPress.org
 * plug-in, you can safely delete this block.
 */
$composer_autoload = __DIR__ . '/vendor/autoload.php';
if ( file_exists($composer_autoload) ) {
	require_once( $composer_autoload );
	$timber = new Timber\Timber();
}

/**
 * This ensures that Timber is loaded and available as a PHP class.
 * If not, it gives an error message to help direct developers on where to activate
 */
if ( ! class_exists( 'Timber' ) ) {
	add_action( 'admin_notices', function() {
		echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="' . esc_url( admin_url( 'plugins.php#timber' ) ) . '">' . esc_url( admin_url( 'plugins.php' ) ) . '</a></p></div>';
	});
	add_filter('template_include', function( $template ) {
		return get_stylesheet_directory() . '/static/no-timber.html';
	});
	return;
}

/**
 * By default, Timber does NOT autoescape values. Want to enable Twig's autoescape?
 * No prob! Just set this value to true
 */
Timber::$autoescape = false;

/**
 * We're going to configure our theme inside of a subclass of Timber\Site
 * You can move this to its own file and include here via php's include("MySite.php")
 */
class themeSite extends Timber\Site {

	public function __construct() {

		add_action( 'after_setup_theme', array( $this, 'theme_supports' ) );
		add_filter( 'timber/context', array( $this, 'add_to_context' ) );
		add_action( 'init', array( $this, 'register_post_types' ) );
		add_action( 'init', array( $this, 'register_taxonomies' ) );
		parent::__construct();

	}

	public function theme_supports() {

		add_theme_support('post-thumbnails');
		add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );
		add_theme_support( 'title-tag' );

		add_image_size( 'img-small', 600 ); // small size
		add_image_size( 'img-medium', 1000 ); // medium size
		add_image_size( 'img-large', 1200 ); // large size
		add_image_size( 'img-xlarge', 1600 ); // xlarge size
		add_image_size( 'img-xxlarge', 2000 ); // xxlarge size

		register_nav_menus( array(
			'main' => 'Main',
			'footer' => 'Footer'
		));

		add_post_type_support( 'post', 'page-attributes' );
		add_filter( 'widget_text', 'do_shortcode' );

	}

	public function register_post_types() {

		$labels = array(
			'name'               => _x( '', 'theme' ),
			'singular_name'      => _x( '', 'theme' ),
			'menu_name'          => _x( '', 'theme' ),
			'name_admin_bar'     => _x( '', 'theme' ),
			'add_new'            => _x( '', 'theme' ),
			'add_new_item'       => __( '', 'theme' ),
			'new_item'           => __( '', 'theme' ),
			'edit_item'          => __( '', 'theme' ),
			'view_item'          => __( '', 'theme' ),
			'all_items'          => __( '', 'theme' ),
			'search_items'       => __( '', 'theme' ),
			'parent_item_colon'  => __( '', 'theme' ),
			'not_found'          => __( '', 'theme' ),
			'not_found_in_trash' => __( '', 'theme' )
		);
		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'menu_icon'			 		 => 'dashicons-portfolio', // Menu icon -> https://developer.wordpress.org/resource/dashicons/
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'project' ),
			'capability_type'    => 'post',
			'has_archive'        => false,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array( 'title', 'thumbnail', 'editor' ),
			'show_in_rest'			 => true // Gutenberg & REST API activation
		);
		//register_post_type( 'CPT_NAME', $args );

	}

	public function register_taxonomies() {

		$labels = array(
			'name'              => _x( '', 'theme' ),
			'singular_name'     => _x( '', 'theme' ),
			'search_items'      => __( '', 'theme' ),
			'all_items'         => __( '', 'theme' ),
			'parent_item'       => __( '', 'theme' ),
			'parent_item_colon' => __( '', 'theme' ),
			'edit_item'         => __( '', 'theme' ),
			'update_item'       => __( '', 'theme' ),
			'add_new_item'      => __( '', 'theme' ),
			'new_item_name'     => __( '', 'theme' ),
			'menu_name'         => __( '', 'theme' ),
		);

		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'project-category' ),
		);

		//register_taxonomy( 'TAX_NAME', array( 'CPNAME' ), $args );

	}

	public function add_to_context( $context ) {

		$context['stuff'] = 'This is a test value'; // add me anywhere in a twig template to show me: {{ stuff }}
		$context['options'] = get_fields('option'); // get all ACF option fields -> example: "{{ options.analytics }}", you can use them globaly on every page
		return $context;

	}

}

new themeSite();

// GLOBAL FUNCTIONS
get_template_part('inc/enqueue-style'); // LOAD STYLES
get_template_part('inc/enqueue-scripts'); // LOAD SCRIPTS
//get_template_part('inc/walker-nav'); // WALKER NAV

// THEME FUNCTIONS
get_template_part('inc/body-class'); // BODY CLASSES
get_template_part('inc/image'); // IMAGE UPLOAD QUALITY ALWAYS 100%
get_template_part('inc/dashboard'); // DASHBOARD WIDGETS
get_template_part('inc/excerpt'); // CUSTOM EXCERPTS
get_template_part('inc/archive-title'); // ARCHIVE TITLE
get_template_part('inc/admin'); // ADMIN
get_template_part('inc/login'); // LOGIN
get_template_part('inc/gutenberg'); // GUTENBERG
get_template_part('inc/acf-options-page'); // ACF OPTIONS PAGE "Website"
