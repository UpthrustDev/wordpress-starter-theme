<?php
/**
 * My Account page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-account.php.
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

/**
 * My Account navigation.
 *
 * @since 2.6.0
 */

 ?>

<div class="p-account">
  <section class="section">
    <?php $hero_image = get_field('account_banner', 'option');
        if( !empty($hero_image) ): ?>
      <div class="p-account__hero lazy" data-src="<?php echo $hero_image['url']; ?>"></div>
    <?php endif; ?>
  </section>


  <div class="p-account__inner">

    <aside class="p-account__sidebar">
      <div class="p-account__content">
        <div class="p-account__head">
          <div class="p-account__title"><?php _e('Your account', 'woocommerce'); ?></div>
          <div class="p-account__subtitle">
            <?php
              printf(
                __( 'From your account dashboard you can view your <a href="%1$s">recent orders</a>, manage your <a href="%2$s">shipping and billing addresses</a>, and <a href="%3$s">edit your password and account details</a>.', 'woocommerce' ),
                esc_url( wc_get_endpoint_url( 'orders' ) ),
                esc_url( wc_get_endpoint_url( 'edit-address' ) ),
                esc_url( wc_get_endpoint_url( 'edit-account' ) )
              );
            ?>
          </div>
        </div>

        <?php do_action( 'woocommerce_account_navigation' ); ?>
      </div>
    </aside>

    <main class="p-account__main">
      <div class="p-account__content">
        <?php do_action( 'woocommerce_account_content' ); ?>
      </div>
    </main>

  </div>

</div>
