<?php
// ENQUEUE STYLES
if ( ! function_exists( 'mint_enqueue_style' ) ) {
	function mint_enqueue_style() {

		$cssFileLastUpdated = filemtime( get_stylesheet_directory() . '/dist/app.bundle.css' );

		wp_register_style( 'style', get_stylesheet_directory_uri() . '/dist/app.bundle.css', false, $cssFileLastUpdated, false );

		wp_enqueue_style( 'style' );

	}
}
add_action( 'wp_enqueue_scripts', 'mint_enqueue_style' );
?>
