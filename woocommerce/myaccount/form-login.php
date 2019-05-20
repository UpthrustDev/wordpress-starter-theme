<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
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

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

<?php do_action( 'woocommerce_before_customer_login_form' ); ?>

<?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>

<div class="p-auth" id="customer_login">

<?php 
$banner = get_field('login_register_banner', 'option');
if ( !empty($banner) ) : ?>
  <section class="section section_image" style="background: url(<?php the_field('login_register_banner', 'option'); ?>) 50% / cover no-repeat;"></section>
<?php endif; ?>

  <div class="p-auth__inner">

  <div class="p-auth__part p-auth__part_login">

    <?php endif; ?>

    <div class="p-auth__head">
      <h2><?php esc_html_e( 'Login', 'woocommerce' ); ?></h2>
    </div>

    <form method="post" class="p-auth__form p-auth__form_login">

      <?php do_action( 'woocommerce_login_form_start' ); ?>

      <div class="p-auth__row">
        <label for="username"><?php esc_html_e( 'Username or email address', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
        <input type="text" class="p-auth__input" name="username" id="username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
      </div>

      <div class="p-auth__row">
        <label for="password"><?php esc_html_e( 'Password', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
        <input class="p-auth__input" type="password" name="password" id="password" autocomplete="current-password" />
      </div>

      <?php do_action( 'woocommerce_login_form' ); ?>

      <div class="p-auth__row">
        <div class="row align-items-center justify-content-between">
          <div class="col-xl-6">
            <label>
              <input class="p-auth__checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" />
              <span><?php esc_html_e( 'Remember me', 'woocommerce' ); ?></span>
            </label>
          </div>
          <div class="col-xl-6 h-align-right">
            <?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
            <button type="submit" class="button button--primary" name="login" value="<?php esc_attr_e( 'Log in', 'woocommerce' ); ?>"><?php esc_html_e( 'Log in', 'woocommerce' ); ?></button>
          </div>
        </div>
        
      </div>

      <div class="p-auth__row">
        <a class="p-auth__forgot" href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Lost your password?', 'woocommerce' ); ?></a>
      </div>

      <?php do_action( 'woocommerce_login_form_end' ); ?>

    </form>

    <?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>

  </div>

  <div class="p-auth__part p-auth__part_register">

    <div class="p-auth__head">
      <h2><?php esc_html_e( 'Register', 'woocommerce' ); ?></h2>
    </div>

    <form method="post" class="p-auth__form p-auth__form_register" <?php do_action( 'woocommerce_register_form_tag' ); ?>>

      <?php do_action( 'woocommerce_register_form_start' ); ?>

      <?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>

      <div class="p-auth__row">
        <label for="reg_username"><?php esc_html_e( 'Username', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
        <input type="text" class="p-auth__input" name="username" id="reg_username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
      </div>

      <?php endif; ?>

      <div class="p-auth__row">
        <label for="reg_email"><?php esc_html_e( 'Email address', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
        <input type="email" class="p-auth__input" name="email" id="reg_email" autocomplete="email" value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
      </div>

      <?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>

      <div class="p-auth__row">
        <label for="reg_password"><?php esc_html_e( 'Password', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
        <input type="password" class="p-auth__input" name="password" id="reg_password" autocomplete="new-password" />
      </div>

      <?php endif; ?>

      <div class="p-auth__row">
        <div class="p-auth__privacy">
          <?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
          <?php do_action( 'woocommerce_register_form' ); ?>
        </div>
      </div>

      <div class="p-auth__row h-align-right">
        <button type="submit" class="button button--primary" name="register" value="<?php esc_attr_e( 'Register', 'woocommerce' ); ?>"><?php esc_html_e( 'Register', 'woocommerce' ); ?></button>
      </div>

      <?php do_action( 'woocommerce_register_form_end' ); ?>

    </form>

  </div>

</div>
</div>
<?php endif; ?>

<?php do_action( 'woocommerce_after_customer_login_form' ); ?>