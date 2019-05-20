<?php
  global $woocommerce;
?>

<div class="b-bag js-bag">
  <div class="b-bag__inner">

    <?php if ( sizeof( $woocommerce->cart->get_cart() ) > 0 ) {

      $woocommerce->cart->cart_contents = array_reverse($woocommerce->cart->cart_contents);
    ?>

      <div class="b-bag__list">
        <?php foreach ( $woocommerce->cart->get_cart() as $cart_item_key => $values ) {

          $_product = $values['data'];
          $image_id = $_product->get_image_id();

          if ( $_product->exists() && $values['quantity'] > 0 ) {
            $product_quantity = esc_attr( $values['quantity'] );
            $product_price = (( get_option('woocommerce_display_cart_prices_excluding_tax') == 'yes' ) ? $_product->get_price_excluding_tax() : $_product->get_price()) * $product_quantity;
        ?>
          <div class="b-bag__item">
            <div class="b-bag__item-data">
              <div class="b-bag__item-thumb">
                <a href="<?php echo esc_url( get_permalink( apply_filters('woocommerce_in_cart_product_id', $values['product_id'] ) ) ); ?>">
                  <?php
                    $image_thumb = wp_get_attachment_image_src($image_id, 'medium')[0];
                    $alt_text = get_post_meta($image_id, '_wp_attachment_image_alt', true);
                  ?>
                  <img src="<?php echo $image_thumb; ?>" alt="<?php echo $alt_text; ?>">
                </a>
              </div>

              <div class="b-bag__item-info">
                <div class="b-bag__item-title"><?php echo $_product->get_title(); ?></div>
                <div class="b-bag__item-meta"><?php echo $_product->get_attribute('pa_flavors'); ?> - <?php echo $_product->get_attribute('pa_quantity'); ?></div>
              </div>
            </div>

            <div class="b-bag__item-price">
              <?php echo apply_filters('woocommerce_cart_item_price_html', wc_price( $product_price ), $values, $cart_item_key ); ?>
            </div>

          </div>
        <?php } ?>
        <?php } ?>

        <!-- <div class="b-bag__item b-bag__item_small">
          <div class="b-bag__item-col">Delivery</div>
          <div class="b-bag__item-col">Free Delivery</div>
        </div> -->

        <div class="b-bag__item b-bag__item_small">
          <div class="b-bag__item-col"><?php _e( 'Total', 'woocommerce' ); ?></div>
          <div class="b-bag__item-col"><?php echo $woocommerce->cart->get_cart_total(); ?></div>
        </div>

      </div>

      <div class="b-bag__controls">
        <a class="b-bag__control b-bag__control_bag" href="<?php echo wc_get_cart_url(); ?>"><span><?php the_field('bag_button_title', 'option'); ?></span></a>
        <a class="b-bag__control b-bag__control_checkout" href="<?php echo wc_get_checkout_url(); ?>"><span><?php the_field('checkout_button_title', 'option'); ?></span></a>
      </div>

    <?php } else { ?>
    <div class="b-bag__empty"><?php the_field('bag_empty_title', 'option'); ?></div>
    <?php } ?>

  </div>
</div>