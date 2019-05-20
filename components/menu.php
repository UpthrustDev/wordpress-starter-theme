<div class="b-menu">
  <div class="b-menu__inner">
    <div class="b-menu__main">
			<div class="b-menu__close">
				<div class="button-close js-menu-button">
					<svg viewBox="0 0 14 14" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
						<g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
								<g id="Artboard" transform="translate(-5.000000, -5.000000)" fill="#000000">
										<g id="icon-close">
												<polygon transform="translate(12.000000, 12.000000) rotate(45.000000) translate(-12.000000, -12.000000) " points="11 11 11 4 13 4 13 11 20 11 20 13 13 13 13 20 11 20 11 13 4 13 4 11"></polygon>
										</g>
								</g>
						</g>
					</svg>
				</div>
			</div>
      <div class="b-menu__content">

        <div class="b-header__part b-menu__account">
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
					<div class="b-header__item">
						<a class="b-header__link b-header__link_account" href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id')).$productlink; ?>" title="<?php echo the_field('label_my_account', 'option'); ?>"></a>
					</div>
					<?php } ?>
        </div>

        <nav class="b-menu__nav">
          <?php
            wp_nav_menu(array(
            'theme_location' => 'header',
            'container' => false,
            'depth' => 2,
            'menu_class' => 'b-menu__list',
            'items_wrap' => '<ul class="%2$s">%3$s</ul>',
            'walker' => new mint_walker()
            ));
          ?>
        </nav>

        <div class="b-menu__subnav">
          <?php
            wp_nav_menu(array(
            'theme_location' => 'subheader',
            'container' => false,
            'depth' => 1,
            'menu_class' => 'b-menu__subnav-list',
            'items_wrap' => '<ul class="%2$s">%3$s</ul>',
            'walker' => new mint_walker()
            ));
          ?>
        </div>

        <div class="b-menu__social">
          <div class="b-social">
            <?php
              wp_nav_menu( array(
                'theme_location' => 'footer_3',
                'container' => false,
                'depth' => 0,
                'menu_class' => 'b-social__list',
                'items_wrap' => '<ul class="%2$s">%3$s</ul>',
                'walker' => new mint_walker(),
                'fallback_cb' => false
              ));
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
