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
    <link rel="mask-icon" href="<?php echo get_template_directory_uri(); ?>/src/img/favicons/safari-pinned-tab.svg" color="">
    <meta name="msapplication-TileColor" content="">
    <meta name="theme-color" content="">
    <meta name="msapplication-navbutton-color" content="">
    <meta name="apple-mobile-web-app-status-bar-style" content="">
		<?php if ( $mode == 'production' ) { ?>
		<?php the_field('analytics', 'option'); ?>
		<?php } ?>
    <?php wp_head(); ?>
	</head>

	<body <?php body_class(); ?>>

		<header class="l-header">

		</header>

    <div id="app" class="app">
      <main class="app-container">
