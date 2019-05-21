<?php
function wp_dequeue_gutenberg_styles() {
	wp_dequeue_style( 'wp-block-library' );
	wp_dequeue_style( 'wp-block-library-theme' );
}
add_action( 'wp_print_styles', 'wp_dequeue_gutenberg_styles', 100 );
?>
