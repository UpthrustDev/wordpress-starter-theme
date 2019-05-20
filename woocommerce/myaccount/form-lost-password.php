<?php
/**
 * Lost password form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-lost-password.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.2
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_lost_password_form' );
?>

<div class="p-auth">
  <div class="p-auth__inner">
    <div class="p-auth__part p-auth__part_lost">
      <div class="p-auth__head p-auth__head_large">
        <h2><?php esc_html_e( 'Lost Password', 'woocommerce' ); ?></h2>
      </div>

      <form method="post" class="p-auth__form p-auth__form_lost">

        <div class="p-auth__row">
          <div class="p-auth__lost">
            <?php echo apply_filters( 'woocommerce_lost_password_message', esc_html__( 'Lost your password? Please enter your username or email address. You will receive a link to create a new password via email.', 'woocommerce' ) ); ?>
          </div>
        </div><?php // @codingStandardsIgnoreLine ?>

        <div class="p-auth__row">
          <label for="user_login"><?php esc_html_e( 'Username or email', 'woocommerce' ); ?></label>
          <input class="form__input form__text" type="text" name="user_login" id="user_login" autocomplete="username" />
        </div>

        <div class="clear"></div>

        <?php do_action( 'woocommerce_lostpassword_form' ); ?>

        <div class="p-auth__row h-align-center">
          <input type="hidden" name="wc_reset_password" value="true" />
          <button type="submit" class="button button--primary" value="<?php esc_attr_e( 'Reset password', 'woocommerce' ); ?>"><?php esc_html_e( 'Reset password', 'woocommerce' ); ?></button>
        </div>

        <?php wp_nonce_field( 'lost_password', 'woocommerce-lost-password-nonce' ); ?>

      </form>
    </div>
  </div>
</div>

<section class="section section_image" style="background-image: url('https://images.unsplash.com/photo-1554040979-8e98fabb0bef?ixlib=rb-1.2.1&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=1440&h=600&fit=crop&ixid=eyJhcHBfaWQiOjF9');"></section>

<?php
do_action( 'woocommerce_after_lost_password_form' );