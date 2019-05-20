<?php $mode = get_field('mode', 'option'); ?>
<!doctype html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta htta-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri(); ?>/src/img/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri(); ?>/src/img/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri(); ?>/src/img/favicons/favicon-16x16.png">
    <link rel="manifest" href="<?php echo get_template_directory_uri(); ?>/src/img/favicons/site.webmanifest">
    <link rel="mask-icon" href="<?php echo get_template_directory_uri(); ?>/src/img/favicons/safari-pinned-tab.svg" color="#FFF279">
    <meta name="msapplication-TileColor" content="#FFF279">
    <meta name="theme-color" content="#FFF279">
    <meta name="msapplication-navbutton-color" content="white">
    <meta name="apple-mobile-web-app-status-bar-style" content="white">
		<?php if ( $mode == 'production' ) { ?>
		<?php the_field('header_google_tag_manager_script', 'option'); ?>
		<?php } ?>
		<script src="https://unpkg.com/babel-standalone@6/babel.min.js"></script>
    <?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
		<?php if ( $mode == 'production' ) { ?>
			<?php the_field('header_google_tag_manager_noscript', 'option'); ?>
		<?php } ?>
    <?php get_template_part('components/menu'); ?>
		<header class="b-header app__header">
			<div class="b-header__inner">
				<div class="b-header__part">
					<button class="button-menu js-menu-button">
						<div class="button-menu__inner">
							<div class="button-menu__icon">
								<svg width="20px" height="10px" viewBox="0 0 20 10" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g fill="#000000"><g><path d="M4.792,0 L0,0 C0,5.625 4.436,10 9.981,10 C15.565,10 20,5.625 20,0 L15.208,0 C15.208,2.915 12.872,5.38 9.981,5.38 C7.13,5.379 4.792,2.915 4.792,0 Z"></path></g></g></g></svg>
							</div>
							<div class="button-menu__label u-hide-mobile">menu</div>
						</div>
					</button>
				</div>
				
				<div class="b-header__logo">
					<?php get_template_part('components/logo'); ?>
				</div>

				<div class="b-header__part">
					<div class="b-header__item h-desktop">
						<?php get_template_part('components/language'); ?>
					</div>
					<?php
						$productlink = "";
						if ( get_post_type( get_the_ID() ) == "product" ) {
							$productlink = "?redirect_to=".get_permalink();
						} else {
							$productlink = "?redirect_to=".get_permalink( get_option('woocommerce_myaccount_page_id') );
						}
					?>
					<?php if ( is_user_logged_in() ) { ?>
					<div class="b-header__item">
						<a class="b-header__link b-header__link_account" href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id')).$productlink; ?>" title="<?php echo the_field('label_my_account', 'option'); ?>"></a>
					</div>
					<?php } else { ?>
					<div class="b-header__item u-hide-mobile">
						<a class="b-header__link b-header__link_account" href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id')).$productlink; ?>" title="<?php echo the_field('label_my_account', 'option'); ?>"></a>
					</div>
					<?php } ?>
					<div class="b-header__item">
							<div class="b-header__link b-header__link_bag js-bag-button"><?php echo WC()->cart->get_cart_contents_count(); ?></div>
							<?php get_template_part('components/bag'); ?>
					</div>
				</div>
			</div>
		</header>

    <div id="app" class="app">
      <main class="b-main app__main">
