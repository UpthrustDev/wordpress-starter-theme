<?php
/**
 * Empty cart page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-empty.php.
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

?>

<div class="p-cart">
  <div class="p-cart__notice">
    
    <?php
      /*
      * @hooked wc_empty_cart_message - 10
      */
      do_action('woocommerce_cart_is_empty');
    ?>

  </div>
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

        <div class="p-cart__empty">
          <div class="b-empty">
            <div class="b-empty__icon">
              <img src="<?php echo get_template_directory_uri(); ?>/src/img/icons/icon-arrow-down.svg" alt="">
            </div>

            <?php if( get_field('bag_empty_page_title', 'option') ): ?>
              <h3 class="b-empty__title"><?php the_field('bag_empty_page_title', 'option'); ?></h3>
            <?php endif; ?>

            <?php if( get_field('bag_empty_page_text', 'option') ): ?>
              <div class="b-empty__text"><?php the_field('bag_empty_page_text', 'option'); ?></div>
            <?php endif; ?>
            
            <?php if( get_field('bag_empty_page_button_url', 'option') ): ?>
            <div class="b-empty__control">
              <a href="<?php the_field('bag_empty_page_button_url', 'option'); ?>" class="button button--primary"><?php the_field('bag_empty_page_button_text', 'option'); ?></a>
            </div>
            <?php endif; ?>
          </div>
        </div>

      </div>
    </div>

  </div>
</div>