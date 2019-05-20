<?php
/**
 * My Account Dashboard
 *
 * Shows the first intro screen on the account dashboard.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/dashboard.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version     2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
<div class="dashboard">

	<p class="dashboard__user block-text u-mb-20"><?php
		/* translators: 1: user display name 2: logout url */
		printf(
			__( 'Hello %1$s (not %1$s? <a href="%2$s">Log out</a>)', 'woocommerce' ),
			'<strong>' . esc_html( $current_user->display_name ) . '</strong>',
			esc_url( wc_logout_url( wc_get_page_permalink( 'myaccount' ) ) )
		);
	?></p>

	<p class="dashboard__intro block-text u-text-max-70"><?php
		printf(
			__( 'From your account dashboard you can view your <a href="%1$s">recent orders</a>, manage your <a href="%2$s">shipping and billing addresses</a>, and <a href="%3$s">edit your password and account details</a>.', 'woocommerce' ),
			esc_url( wc_get_endpoint_url( 'orders' ) ),
			esc_url( wc_get_endpoint_url( 'edit-address' ) ),
			esc_url( wc_get_endpoint_url( 'edit-account' ) )
		);
	?></p>

	<?php
	$customer_id = get_current_user_id();

	if ( ! wc_ship_to_billing_address_only() && wc_shipping_enabled() ) {
		$get_addresses = apply_filters( 'woocommerce_my_account_get_addresses', array(
			'billing' => __( 'Billing address', 'woocommerce' ),
			'shipping' => __( 'Shipping address', 'woocommerce' ),
		), $customer_id );
	} else {
		$get_addresses = apply_filters( 'woocommerce_my_account_get_addresses', array(
			'billing' => __( 'Billing address', 'woocommerce' ),
		), $customer_id );
	}

	$oldcol = 1;
	$col    = 1;
	?>

	<?php if ( ! wc_ship_to_billing_address_only() && wc_shipping_enabled() ) : ?>
	<div class="dashboard__addresses p-account__addresses">
		<?php endif; ?>

		<?php foreach ( $get_addresses as $name => $title ) : ?>

		<div class="p-account__address p-account__address-<?php echo ( ( $col = $col * -1 ) < 0 ) ? 1 : 2; ?>">
			<div class="p-account__address-title"><?php echo $title; ?></div>
			<div class="p-account__address-content">
				<?php
					$address = wc_get_account_formatted_address( $name );
					echo $address ? wp_kses_post( $address ) : esc_html_e( 'You have not set up this type of address yet.', 'woocommerce' );
				?>
			</div>
			<div class="p-account__address-control">
				<a href="<?php echo esc_url( wc_get_endpoint_url( 'edit-address', $name ) ); ?>"
					class="edit"><?php _e( 'Edit', 'woocommerce' ); ?></a>
			</div>
		</div>

		<?php endforeach; ?>

		<?php if ( ! wc_ship_to_billing_address_only() && wc_shipping_enabled() ) : ?>
	</div>
	<?php endif;

	/**
	 * My Account dashboard.
	 *
	 * @since 2.6.0
	 */
	do_action( 'woocommerce_account_dashboard' );

	/**
	 * Deprecated woocommerce_before_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action( 'woocommerce_before_my_account' );

	/**
	 * Deprecated woocommerce_after_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action( 'woocommerce_after_my_account' );

	?>
	</div>

<?php /* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
