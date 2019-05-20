<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout.
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
	echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
	return;
}

?>

<div class="p-checkout">
	<div class="p-checkout__inner">
		<aside class="p-checkout__sidebar">
			<div class="p-checkout__sidebar-inner">
				<h3><?php esc_html_e( 'Your order', 'woocommerce' ); ?></h3>
				<div class="b-cart-items b-cart-items_dark">
					<div class="b-cart-items__list">
						<?php
				do_action( 'woocommerce_review_order_before_cart_contents' );

				foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
					$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );

					if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
						?>

						<div class="b-cart-items__item">
							<div class="b-cart-items__part">

								<div class="b-cart-items__thumb">
									<?php
											$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
												$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image('woocommerce_single'), $cart_item, $cart_item_key );

												if ( ! $product_permalink ) {
													echo $thumbnail; // PHPCS: XSS ok.
												} else {
													printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail ); // PHPCS: XSS ok.
												}
												?>
								</div>

								<div class="b-cart-items__info">
									<div class="b-cart-items__name">
										<?php
													if ( ! $product_permalink ) {
														echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key ) . '&nbsp;' );
													} else {
														echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_title() ), $cart_item, $cart_item_key ) );
													}

													do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );

													// Meta data.
													echo wc_get_formatted_cart_item_data( $cart_item ); // PHPCS: XSS ok.

													// Backorder notification.
													if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
														echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>', $product_id ) );
													}
												?>
									</div>

									<div class="b-cart-items__meta">
										<?php echo $_product->get_attribute('pa_flavors') . ' - ' . $_product->get_attribute('pa_quantity'); ?>
									</div>
								</div>

							</div>
							<div class="b-cart-items__part">

								<div class="b-cart-items__total">
									<?php
												echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
											?>
								</div>

							</div>
						</div>
						<?php
					}
				}

				do_action( 'woocommerce_review_order_after_cart_contents' );
			?>

						<div class="b-cart-items__item b-cart-items__item_amount">
							<div class="b-cart-items_part"><?php _e( 'Subtotal', 'woocommerce' ); ?></div>
							<div class="b-cart-items_part"><?php wc_cart_totals_subtotal_html(); ?></div>
						</div>
					</div>
				</div>
			</div>		
		</aside>
		<div class="p-checkout__content">
			<div class="p-checkout__content-inner">

				<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

				<form name="checkout" method="post" class="checkout woocommerce-checkout"
					action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">

					<?php if ( $checkout->get_checkout_fields() ) : ?>

					<div class="col2-set" id="customer_details">
						<div class="">
							<?php do_action( 'woocommerce_checkout_billing' ); ?>
						</div>

						<div class="">
							<?php do_action( 'woocommerce_checkout_shipping' ); ?>
						</div>
					</div>

					<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

					<?php endif; ?>

					<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

					<div id="order_review" class="woocommerce-checkout-review-order">
						<?php do_action( 'woocommerce_checkout_order_review' ); ?>
					</div>

					<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>

				</form>

				<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
			</div>	
		</div>
	</div>
</div>