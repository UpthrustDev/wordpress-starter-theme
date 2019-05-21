<?php
if ( ! function_exists( 'mint_remove_dashboard_widgets' ) ) {
	function mint_remove_dashboard_widgets() {
		$widgets = array(
			'dashboard_incoming_links' => 'normal',
			'dashboard_right_now' => 'normal',
			'dashboard_plugins' => 'normal',
			'dashboard_recent_comments' => 'normal',
			'dashboard_activity' => 'normal',
			'dashboard_quick_press' => 'side',
			'dashboard_primary' => 'side',
			'dashboard_secondary' => 'side',
			'dashboard_recent_drafts' => 'side',
		);
		foreach ($widgets as $id => $context) {
			remove_meta_box($id, 'dashboard', $context);
		}
	}
}
add_action('wp_dashboard_setup', 'mint_remove_dashboard_widgets');
?>
