<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked wc_print_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}

global $product;

$flavors_terms = get_terms( array(
	'taxonomy' => 'pa_flavors',
	'hide_empty' => 'false',
));

$flavors = array();

foreach($flavors_terms as $key => $val) {
	$flavors[] = array(
		'data' => $val,
		'color_shade_1' => get_field('color_shade_1', $val->taxonomy . '_' . $val->term_id),
		'color_shade_2' => get_field('color_shade_2', $val->taxonomy . '_' . $val->term_id),
		'color_shade_3' => get_field('color_shade_3', $val->taxonomy . '_' . $val->term_id),
		'image' => get_field('bottle', $val->taxonomy . '_' . $val->term_id)
	);
}

$min_amount = null;
$zone = null;

$zones = WC_Shipping_Zones::get_zones();

foreach ( $zones as $z ) {
		if ( $z['zone_name'] == 'België' ) {
				$zone = $z;
		}
}

if ( $zone ) {
		$shipping_methods_nl = $zone['shipping_methods'];
		$free_shipping_method = null;
		$flat_shipping_method = null;
		foreach ( $shipping_methods_nl as $method ) {
			if ( $method->id == 'free_shipping' ) {
				$free_shipping_method = $method;
			}
			if ( $method->id == 'flat_rate' ) {
				$flat_shipping_method = $method;
			}
		}

		if ( $free_shipping_method ) {
			$min_amount = $free_shipping_method->min_amount;
		}

		if ( $flat_shipping_method ) {
			$flat_amount = $flat_shipping_method->cost;
		}
}

// echo pr($product->get_available_variations());

if (!empty(get_field('order_step_1', 'option'))) {
	$order_step_1 = get_field('order_step_1', 'option');
}

if (!empty(get_field('order_step_2', 'option'))) {
	$order_step_2 = get_field('order_step_2', 'option');
}

if (!empty(get_field('free_delivery_label', 'option'))) {
	$free_delivery_label = get_field('free_delivery_label', 'option');
}

if (!empty(get_field('delivery_label', 'option'))) {
	$delivery_label = get_field('delivery_label', 'option');
}

if (!empty(get_field('add_to_bag_button_text', 'option'))) {
	$add_to_bag_button_text = get_field('add_to_bag_button_text', 'option');
}

if (!empty(get_field('tooltip_delivery', 'option'))) {
	$tooltip_delivery = get_field('tooltip_delivery', 'option');
}
?>

<script>
	var product_json = <?php echo $product; ?>;
	var variations_json = <?php echo json_encode($product->get_available_variations()); ?>;
	var flavors_json = <?php echo json_encode($flavors); ?>;
	var min_amount = <?php echo $min_amount ? str_replace(',', '.', $min_amount) : 0 ?>;
	var flat_amount = <?php echo $flat_amount ? str_replace(',', '.', $flat_amount) : 0 ?>;

	var labels = {
		step_1: '<?php echo $order_step_1 ? $order_step_1 : "" ?>',
		step_2: '<?php echo $order_step_2 ? $order_step_2 : "" ?>',
		free_delivery: '<?php echo $free_delivery_label ? $free_delivery_label : "" ?>',
		delivery: '<?php echo $delivery_label ? $delivery_label : "" ?>',
		add_to_bag_button_text: '<?php echo $add_to_bag_button_text ? $add_to_bag_button_text : "" ?>',
		tooltip_delivery: '<?php echo $tooltip_delivery ? $tooltip_delivery : "" ?>'
	}
</script>

<div id="app-product">

</div>


<div id="product-<?php the_ID(); ?>" <?php wc_product_class(); ?>>
<!--
	<div class="b-single-product">
		<div class="b-single-product__col">
			<div class="b-single-product__gallery">
				<?php
					/**
					 * Hook: woocommerce_before_single_product_summary.
					 *
					 * @hooked woocommerce_show_product_sale_flash - 10
					 * @hooked woocommerce_show_product_images - 20
					 */
					do_action( 'woocommerce_before_single_product_summary' );
				?>
			</div>

		</div>

		<div class="b-single-product__col">
			<div class="b-single-product__summary">
				<div class="product-options">
				<?php
					/**
					 * Hook: woocommerce_single_product_summary.
					 *
					 * @hooked woocommerce_template_single_title - 5
					 * @hooked woocommerce_template_single_rating - 10
					 * @hooked woocommerce_template_single_price - 10
					 * @hooked woocommerce_template_single_excerpt - 20
					 * @hooked woocommerce_template_single_add_to_cart - 30
					 * @hooked woocommerce_template_single_meta - 40
					 * @hooked woocommerce_template_single_sharing - 50
					 * @hooked WC_Structured_Data::generate_product_data() - 60
					 */
					do_action( 'woocommerce_single_product_summary' );
				?>
				</div>
			</div>
		</div>

		<?php
			/**
			 * Hook: woocommerce_after_single_product_summary.
			 *
			 * @hooked woocommerce_output_product_data_tabs - 10
			 * @hooked woocommerce_upsell_display - 15
			 * @hooked woocommerce_output_related_products - 20
			 */
			do_action( 'woocommerce_after_single_product_summary' );
		?>
	</div>-->

	<?php do_action( 'woocommerce_after_single_product' ); ?>

</div>
