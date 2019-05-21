<?php
// ENQUEUE SCRIPTS
if ( ! function_exists( 'mint_scripts ' ) ) {
	function mint_enqueue_scripts() {
		if ( ! is_admin() ) {

			$jtime = filemtime( get_template_directory() . '/dist/app.bundle.js' );
			$jtime2 = filemtime( get_template_directory() . '/dist/vendor.bundle.js' );

			wp_deregister_script( 'jquery' );

			wp_register_script( 'app', get_template_directory_uri() . "/dist/app.bundle.js", false, $jtime, true );
			wp_register_script( 'vendor', get_template_directory_uri() . "/dist/vendor.bundle.js", false, $jtime2, true );

			wp_enqueue_script( 'app' );
			wp_enqueue_script( 'vendor' );

		}
	}
}
add_action('wp_enqueue_scripts', 'mint_enqueue_scripts');

if ( ! function_exists( 'wp_deregister_scripts' ) ) {
	function wp_deregister_scripts() {
		wp_deregister_script( 'wp-embed' );
	}
}
add_action( 'wp_footer', 'wp_deregister_scripts' );
?>
