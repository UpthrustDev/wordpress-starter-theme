<?php
/**
 * Variable product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/variable.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.5
 */

defined( 'ABSPATH' ) || exit;

global $product;

$attribute_keys  = array_keys( $attributes );
$variations_json = wp_json_encode( $available_variations );
$variations_attr = function_exists( 'wc_esc_json' ) ? wc_esc_json( $variations_json ) : _wp_specialchars( $variations_json, ENT_QUOTES, 'UTF-8', true );

do_action( 'woocommerce_before_add_to_cart_form' ); ?>

<form class="variations_form cart" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data' data-product_id="<?php echo absint( $product->get_id() ); ?>" data-product_variations="<?php echo $variations_attr; // WPCS: XSS ok. ?>">
	<div id="react-product"></div>
	<?php do_action( 'woocommerce_before_variations_form' ); ?>

	<?php if ( empty( $available_variations ) && false !== $available_variations ) : ?>
		<p class="stock out-of-stock"><?php esc_html_e( 'This product is currently out of stock and unavailable.', 'woocommerce' ); ?></p>
	<?php else : ?>
		<table class="variations" cellspacing="0">
			<tbody>
				<?php foreach ( $attributes as $attribute_name => $options ) : ?>
					<?php
						if($attribute_name === 'pa_flavors') {

							$product_id = $product->get_id();
	
							$product_flavors = wc_get_product($product_id);
							//pr($product_flavors);

							if (!empty ($product_flavors)) {
								$terms_flavors = get_terms( array(
									'taxonomy' => 'pa_flavors',
									'hide_empty' => 'false',
								));
							}

							$data = array();

					?>

						<div class="b-flavors">
							<div class="b-flavors__list">
								<?php
									foreach ( $terms_flavors as $key => $val ) {
										$term_shade_1 = get_field('color_shade_1', $val->taxonomy . '_' . $val->term_id);
										$term_shade_2 = get_field('color_shade_2', $val->taxonomy . '_' . $val->term_id);
										$term_shade_3 = get_field('color_shade_3', $val->taxonomy . '_' . $val->term_id);
										$bottle = get_field('bottle', $val->taxonomy . '_' . $val->term_id);
										$subline = get_field('subline', $val->taxonomy . '_' . $val->term_id);

										$data[] = array(
											'color_1' => $term_shade_1,
											'color_2' => $term_shade_2,
											'color_3' => $term_shade_3,
											'title' => $val->name,
											'bottle' => $bottle,
											'subline' => $subline
										);

								?>
									<div class="b-flavors__item">
										<div class="b-flavor <?php echo ($val->slug === $product->default_attributes['pa_flavors']) ? 'b-flavor_active' : '' ?>" data-target="<?php echo $val->taxonomy; ?>" data-value="<?php echo $val->slug; ?>">
											<div class="b-flavor__point" id="<?php echo $val->term_id; ?>" style="background: linear-gradient(to bottom, <?php echo $term_shade_1; ?> 0%, <?php echo $term_shade_1; ?> 33.333%, <?php echo $term_shade_2; ?> 33.333%, <?php echo $term_shade_2; ?> 66.666%, <?php echo $term_shade_3; ?> 66.666%, <?php echo $term_shade_3; ?> 100%);"></div>
											<div class="b-flavor__label"><?php echo $val->name; ?></div>
										</div>
									</div>
								<?php
									}
								?>
							</div>
						</div>

					<?php
						}
					?>

					<?php
						if($attribute_name === 'pa_quantity') {
					?>
						<div class="b-quantity quantity-dropdown">
							<div class="quantity-dropdown__button">&nbsp;</div>
							<ul class="quantity-dropdown__list">
								<?php foreach($available_variations as $variation) { ?>
									<li data-target="pa_quantity" data-flavor="<?php echo $variation['attributes']['attribute_pa_flavors']; ?>" data-value="<?php echo $variation['attributes']['attribute_pa_quantity']; ?>"><?php echo $variation['attributes']['attribute_pa_quantity']; ?></li>
								<?php } ?>
							</ul>
						</div>
					<?php
						}
					?>

					<tr class="b-attribute b-attribute_<?php echo esc_attr( sanitize_title( $attribute_name ) ); ?>">
						<td class="label"><label for="<?php echo esc_attr( sanitize_title( $attribute_name ) ); ?>"><?php echo wc_attribute_label( $attribute_name ); // WPCS: XSS ok. ?></label></td>
						<td class="value">
							<?php
								wc_dropdown_variation_attribute_options( array(
									'options'   => $options,
									'attribute' => $attribute_name,
									'product'   => $product,
								) );
								echo end( $attribute_keys ) === $attribute_name ? wp_kses_post( apply_filters( 'woocommerce_reset_variations_link', '<a class="reset_variations" href="#">' . esc_html__( 'Clear', 'woocommerce' ) . '</a>' ) ) : '';
							?>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>

		<div class="single_variation_wrap">
			<?php
				/**
				 * Hook: woocommerce_before_single_variation.
				 */
				do_action( 'woocommerce_before_single_variation' );

				/**
				 * Hook: woocommerce_single_variation. Used to output the cart button and placeholder for variation data.
				 *
				 * @since 2.4.0
				 * @hooked woocommerce_single_variation - 10 Empty div for variation data.
				 * @hooked woocommerce_single_variation_add_to_cart_button - 20 Qty and cart button.
				 */
				do_action( 'woocommerce_single_variation' );

				/**
				 * Hook: woocommerce_after_single_variation.
				 */
				do_action( 'woocommerce_after_single_variation' );
			?>
		</div>
	<?php endif; ?>

	<?php do_action( 'woocommerce_after_variations_form' ); ?>
</form>

<?php
do_action( 'woocommerce_after_add_to_cart_form' );
