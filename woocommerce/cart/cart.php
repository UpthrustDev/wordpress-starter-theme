<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_cart' );

$current_language = apply_filters( 'wpml_current_language', NULL );

?>

<div class="p-cart">
  <div class="p-cart__inner">

    <div class="p-cart__part">

      <?php 
        $bag_image = get_field('bag_image', 'option');
        if( $bag_image ): 
        $bag_image_url = $bag_image['url'];
        $bag_image_alt = $bag_image['alt'];
        ?>
        <picture class="u-full">
          <img src=data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw== class="p-cart__cover lazy u-object-fit u-full" data-src="<?php echo $bag_image_url; ?>" alt="<?php echo $bag_image_alt; ?>">
        </picture>
      <?php endif; ?>
      
      <?php if(get_field('bag_title_image', 'option') ): ?>
        <img src="<?php the_field('bag_title_image', 'option'); ?>" alt="<?php the_title(); ?>" class="p-cart__title">
      <?php endif; ?>
      
    </div>
    <div class="p-cart__part">

      <div class="p-cart__content">

      <div class="p-cart__items">
        <div class="b-cart-items">

          <form class="b-cart-items__list" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
            <?php do_action( 'woocommerce_before_cart_table' ); ?>
            <?php do_action( 'woocommerce_before_cart_contents' ); ?>

            <?php
            foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
              $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
              $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

              if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
                $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
            ?>
              <div class="b-cart-items__item">

                <div class="b-cart-items__part">
                  <div class="b-cart-items__thumb">
                    <?php
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

                  <div class="b-cart-items__remove">
                    <?php
                      // @codingStandardsIgnoreLine
                      echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
                        '<a href="%s" class="button-close button-close_close" aria-label="%s" data-product_id="%s" data-product_sku="%s">
                          <svg viewBox="0 0 14 14" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g id="Artboard" transform="translate(-5.000000, -5.000000)" fill="#000000">
                                    <g id="icon-close">
                                        <polygon transform="translate(12.000000, 12.000000) rotate(45.000000) translate(-12.000000, -12.000000) " points="11 11 11 4 13 4 13 11 20 11 20 13 13 13 13 20 11 20 11 13 4 13 4 11"></polygon>
                                    </g>
                                </g>
                            </g>
                          </svg>
                        </a>',
                        esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
                        __( 'Remove this item', 'woocommerce' ),
                        esc_attr( $product_id ),
                        esc_attr( $_product->get_sku() )
                      ), $cart_item_key );
                    ?>
                  </div>
                </div>
              </div>
            <?php
                }
              }
            ?>
            <?php do_action( 'woocommerce_after_cart_contents' ); ?>
            <?php do_action( 'woocommerce_after_cart_table' ); ?>
          </form>

          </div>
        </div>

        <div class="p-cart__totals">
          <?php
            /**
             * Cart collaterals hook.
             *
             * @hooked woocommerce_cross_sell_display
             * @hooked woocommerce_cart_totals - 10
             */
            do_action( 'woocommerce_cart_collaterals' );
          ?>
        </div>

      </div>

    </div>

  </div>
</div>

<?php do_action( 'woocommerce_after_cart' ); ?>