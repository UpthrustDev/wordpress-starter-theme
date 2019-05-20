<?php
/* ----------------------------------------
  ACTIVATE WOOCOMMERCE
---------------------------------------- */
function goodmorning_add_woocommerce_support() {
  add_theme_support('woocommerce');
}
add_action('after_setup_theme', 'goodmorning_add_woocommerce_support');

/* ----------------------------------------
  REMOVE DEFAULT CSS STYLES
---------------------------------------- */
function jk_dequeue_styles($enqueue_styles) {
  unset($enqueue_styles['woocommerce-general']);	// Remove the gloss
  unset($enqueue_styles['woocommerce-layout']);		// Remove the layout
  unset($enqueue_styles['woocommerce-smallscreen']);	// Remove the smallscreen optimisation
  return $enqueue_styles;
}
add_filter('woocommerce_enqueue_styles', 'jk_dequeue_styles');

/* ----------------------------------------
  REMOVE STYLES/SCRIPTS ON NO WOOCOMMERCE PAGES
---------------------------------------- */
function crunchify_disable_woocommerce_loading_css_js() {

  if (function_exists('is_woocommerce')) {

    if (!is_woocommerce() && !is_cart() && !is_checkout()) {

      wp_dequeue_style('woocommerce-layout');
      wp_dequeue_style('woocommerce-general');
      wp_dequeue_style('woocommerce-smallscreen');

      wp_dequeue_script('wc-cart-fragments');
      wp_dequeue_script('woocommerce');
      wp_dequeue_script('wc-add-to-cart');

      wp_deregister_script('js-cookie');
      wp_dequeue_script('js-cookie');

    }
  }
}
add_action('wp_enqueue_scripts', 'crunchify_disable_woocommerce_loading_css_js');

/* ----------------------------------------
	REMOVE BREADCRUMBS
---------------------------------------- */
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);


/* ----------------------------------------
	REMOVE RELATED PRODUCTS
---------------------------------------- */
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);


/* ----------------------------------------
	REMOVE SHORT DESCRIPTION
---------------------------------------- */
function remove_short_description() {
  remove_meta_box('postexcerpt', 'product', 'normal');
}
add_action('add_meta_boxes', 'remove_short_description', 999);


/* ----------------------------------------
	REMOVE 'CHOOSE AN OPTION' FROM PRODUCT VARIATIONS DROPDOWNS
---------------------------------------- */
add_filter('woocommerce_dropdown_variation_attribute_options_html', 'filter_dropdown_option_html', 12, 2);
function filter_dropdown_option_html($html, $args) {
  $show_option_none_text = $args['show_option_none'] ? $args['show_option_none'] : __('Choose an option', 'woocommerce');
  $show_option_none_html = '<option value="">'.esc_html($show_option_none_text). '</option>';

  $html = str_replace($show_option_none_html, '', $html);

  return $html;
}


// /* ----------------------------------------
// 	REMOVE INFO FROM SINGLE PRODUCT PAGE
// ---------------------------------------- */
// remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
// remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
// remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
// remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15);
// remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
// remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );


/* ----------------------------------------
	REMOVE 'CART IS EMPTY' MESSAGE
---------------------------------------- */
remove_action('woocommerce_cart_is_empty', 'wc_empty_cart_message', 10);


/* ----------------------------------------
	SHOW DESCRIPTION
---------------------------------------- */
add_action( 'woocommerce_single_product_summary', 'the_content', 10 );


/* ----------------------------------------
	ORDER PAY FORM CUSTOM PLACE FOR NOTICES
---------------------------------------- */
remove_action( 'before_woocommerce_pay', 'woocommerce_output_all_notices', 10 );

function form_pay_hook() {
	do_action('form_pay_hook');
}
add_action('form_pay_hook', 'woocommerce_output_all_notices', 10);


/* ----------------------------------------
	SINGLE PRODUCT CUSTOM SECTIONS
---------------------------------------- */
if ( ! is_admin() ) {
	get_template_part('woocommerce/single-product-sections');
}

add_filter( 'woocommerce_package_rates', 'my_hide_shipping_when_free_is_available' );
function my_hide_shipping_when_free_is_available( $rates ) {
  $free = array();
  foreach( $rates as $rate_id => $rate ) {
    if( 'free_shipping' === $rate->method_id ) {
      $free[ $rate_id ] = $rate;
      break;
    }
  }
  return ! empty( $free ) ? $free : $rates;
}
/* ----------------------------------------
	REMOVE LOGIN FORM ON CHECKOUT AND MOVE IT TO CUSTOM PLACE
---------------------------------------- */
remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_login_form', 10 );
add_action('woocommerce_checkout_before_customer_details', 'woocommerce_checkout_login_form');
/* ----------------------------------------
	ADD ORDERS TO ACCOUNT DASHBOARD
---------------------------------------- */
add_action( 'woocommerce_account_dashboard', 'ec_customer_orders' );
function ec_customer_orders() {
	$current_page = empty( $current_page ) ? 1 : absint( $current_page );
	$customer_orders = wc_get_orders( apply_filters( 'woocommerce_my_account_my_orders_query', array( 'customer' => get_current_user_id(), 'page' => $current_page, 'paginate' => true ) ) );

	wc_get_template(
		'myaccount/orders.php',
		array(
			'current_page' => absint( $current_page ),
			'customer_orders' => $customer_orders,
			'has_orders' => 0 < $customer_orders->total,
		)
	);
}
/* ----------------------------------------
	ADD CUSTOM SKU NUMBERS FIELD TO PRODUCT VARIATIONS
---------------------------------------- */

function gdm_add_variation_fields( $loop, $variation_data, $variation ) {

  echo '<div class="variation-custom-fields">';

  woocommerce_wp_text_input(
    array(
      'id' => '_sku_numbers[' . $variation->ID . ']',
      'label' => __( 'SKU numbers', 'woocommerce' ),
      'placeholder' => 'SKU numbers',
      'desc_tip'    => true,
      'wrapper_class' => 'form-row form-row-first',
      'description' => __( 'Enter SKU numbers here.', 'woocommerce' ),
      'value'	=> get_post_meta($variation->ID, '_sku_numbers', true)
    )
  );

  echo "</div>";

}
add_action( 'woocommerce_product_after_variable_attributes', 'gdm_add_variation_fields', 10, 3 );

function save_variation_fields( $post_id ) {

	$sku_numbers = $_POST['_sku_numbers'][ $post_id ];

	if ( ! empty( $sku_numbers ) ) {
		update_post_meta( $post_id, '_sku_numbers', esc_attr( $sku_numbers ) );
	}

}
add_action( 'woocommerce_save_product_variation', 'save_variation_fields', 10, 2 );

/* ----------------------------------------
	UPDATE/ADD SKU NUMBERS AFTER STATUS COMPLETE
---------------------------------------- */

function gdm_payment_complete( $order_id ) {

	$order = new WC_Order( $order_id );
	$items = $order->get_items();

	foreach ($items as $item_id => $item_data) {

		$product = $item_data->get_product();
		$variation_id = $product->get_variation_id();
		$product_variation = new WC_Product_Variation( $variation_id );
		$product_sku_numbers = get_post_meta( $variation_id, '_sku_numbers', true );

		//error_log( $product_sku_numbers );

		if ( wc_get_order_item_meta( $item_id, 'sku_numbers' ) ) {
			wc_update_order_item_meta( $item_id, 'sku_numbers', $product_sku_numbers );
		} else {
			wc_add_order_item_meta( $item_id, 'sku_numbers', $product_sku_numbers );
		}

	}

}
add_action( 'woocommerce_order_status_completed', 'gdm_payment_complete' );

/* ----------------------------------------
	REMOVE SKU NUMBERS WHEN STATUS IS NOT COMPLETE
---------------------------------------- */

// function my_line_item_metadata( $item_id, $item, $order_id ) {
//
// 	$order = new WC_Order( $order_id );
// 	$items = $order->get_items();
// 	$order_status = $order->get_status();
//
// 	if ( ! 'completed' == $order_status ) {
// 		wc_delete_order_item_meta( $item_id, 'sku_numbers' );
// 	}
//
// }
// add_action( 'woocommerce_new_order_item', 'my_line_item_metadata', 10, 3 );

/* ----------------------------------------
	ADD SKU NUMBERS TO ORDER "line_items"
---------------------------------------- */
function my_add_metadata_on_line_item( $response, $post, $request ) {

    $order_data = $response->get_data();

    foreach ( $order_data['line_items'] as $key => $item ) {
        $order_data['line_items'][ $key ]['sku_numbers'] = wc_get_order_item_meta( $item['id'], 'sku_numbers', true );
    }

    $response->data = $order_data;

    return $response;
}
add_filter( 'woocommerce_rest_prepare_shop_order', 'my_add_metadata_on_line_item', 10, 3 );


/**
 * Function adds a BCC header to emails that match our array
 *
 * @param string $headers The default headers being used
 * @param string $object  The email type/object that is being processed
 */

function add_bcc_to_certain_emails( $headers, $object ) {

	$add_bcc_to = array(
		'customer_completed_order'
	);

	if ( in_array( $object, $add_bcc_to ) ) {

		$headers = array(
			$headers, 'Bcc: Reviews <4f8290da07@invite.trustpilot.com>' ."\r\n",
		);

	}

	return $headers;

}
add_filter( 'woocommerce_email_headers', 'add_bcc_to_certain_emails', 10, 2 );
