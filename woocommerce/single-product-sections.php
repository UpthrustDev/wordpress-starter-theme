<?php
/* Template  for single product ACF sections */

function product_custom_sections() {
	global $post;

	//$post_id = $post->get_id();

	//pr($product, $post_id);
?>

<section class="b-about-video">

	<div class="container">

    <div class="row align-items-center">
      <div class="col-12 col-md-4 offset-md-1">
        <?php if(get_field('about_title')): ?>
  	  	  <h2 class="b-about-video__title block-title"><?php the_field('about_title'); ?></h2>
        <?php endif; ?>
        <?php if(get_field('about_text')): ?>
          <p class="b-about-video__text block-text"><?php the_field('about_text'); ?></p>
        <?php endif; ?>
      </div>
      <div class="col-12 col-md-7">
        <div class="b-about-video__wrapper">
          <?php
            $short_video = get_field('video_short_group');

            if ($short_video['video_short_webm'] != '' || $short_video['video_short_ogg'] != '' || $short_video['video_short_mp4'] != '') { ?>
              <div class="b-about-video__short play-in-view">
                <video class="b-about-video__short-video" poster="<?php echo $short_video['video_short_poster']['url']; ?>" muted loop>
                  <?php if ($short_video['video_short_webm'] != '') : ?>
                    <source src="<?php echo $short_video['video_short_webm']; ?>" type="video/webm">
                  <?php endif;
                  if ($short_video['video_short_ogg'] != '') : ?>
                    <source src="<?php echo $short_video['video_short_ogg']; ?>" type="video/ogg">
                  <?php endif;
                  if ($short_video['video_short_mp4'] != '') : ?>
                    <source src="<?php echo $short_video['video_short_mp4']; ?>" type="video/mp4">
                  <?php endif; ?>
                </video>
                <?php if(get_field('video_long_id')): ?>
                  <div data-popup-video="popup-video" class="b-about-video__short-play js-popup-video-trigger">
                    <div class="b-about-video__short-play-icon"></div>
                    <div class="b-about-video__short-play-label"><?php the_field('video_button_text'); ?></div>
                  </div>
                <?php endif; ?>
              </div>
              <?php } else { ?>
                <?php if ($short_video['video_short_poster'] != '') {
                  $short_video_poster = $short_video['video_short_poster'];
                  $short_video_image_url    = $short_video_poster['url'];
                  $short_video_image_alt    = $short_video_poster['alt'];
                  $short_video_image_type   = $short_video_poster['mime_type'];
                  $short_video_image_large  = $short_video_poster['sizes'][ 'img-large' ];
                  $short_video_image_medium = $short_video_poster['sizes'][ 'img-medium' ];
                  $short_video_image_small  = $short_video_poster['sizes'][ 'img-small' ];
                  ?>
                  <div class="b-about-video__image">
                  <picture>
                    <source type="<?php echo $short_video_image_type ?>" media="(min-width: 1000px)" data-srcset="<?php echo $short_video_image_large	; ?>">
                    <source type="<?php echo $$short_video_image_type ?>" media="(min-width: 480px)" data-srcset="<?php echo $short_video_image_medium; ?>">
                    <img src=data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw== class="lazy" data-src="<?php echo $short_video_image_small; ?>" alt="<?php echo $short_video_image_alt; ?>">
                  </picture>
                  </div>
                <?php } ?>
              <?php } ?>

          <?php if(get_field('video_long_id')): ?>
            <div data-popup-video-id="popup-video" class="popup popup--video">
              <button class="popup__close js-popup-video-close button button--close" data-popup-video-id="popup-video">close</button>
              <div class="popup__inner">
                <div class="popup__video">
                  <div class="video-holder">
                    <div class="js-video-vimeo" data-id="<?php the_field('video_long_id'); ?>"></div>
                  </div>
                </div>
              </div>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>

</section>

<?php if(have_rows('blocks')): ?>
  <div class="b-squares">
  <?php
      $title_image = get_field('title_image');
      if( !empty($title_image) ): ?>
	      <img class="b-squares__title" src="<?php echo $title_image['url']; ?>" alt="<?php echo $title_image['alt']; ?>">
    <?php endif; ?>
    <?php while( have_rows('blocks') ): the_row(); ?>
    <div class="b-squares__item">
      <div class="b-square">
        <div class="b-square__inner b-square__inner_center">
          <div class="b-card b-card_center">
            <?php if(get_sub_field('icon')): ?>
              <div class="b-card__icon">
                <img src="<?php the_sub_field('icon'); ?>" alt="<?php the_sub_field('title'); ?>">
              </div>
            <?php endif; ?>
            <div class="b-card__title"><?php the_sub_field('title'); ?></div>
            <div class="b-card__content">
              <p class="b-card__text"><?php the_sub_field('text'); ?></p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php endwhile; ?>
  </div>
<?php endif; ?>

<section id="ingredients" class="b-ingredients">

	<?php
		$title_image = get_field('ingredients_title');
		if ( ! empty($title_image) ):
	?>
	<img class="b-ingredients__title" src="<?php echo $title_image['url']; ?>" alt="<?php echo $title_image['alt']; ?>">
	<?php endif; ?>

  <div class="container">

		<?php
    global $product;
    $product_id = $product->get_id();
    $product_flavors = wc_get_product($product_id);

    if ( ! empty ($product_flavors) ) {
      $terms = get_terms( array(
        'taxonomy' => 'pa_flavors',
        'hide_empty' => 'false',
      ));
    }

    $data = array();

    foreach ( $terms as $key => $term ) :
      $bottle = get_field('bottle', $term->taxonomy . '_' . $term->term_id);
      $subline = get_field('subline', $term->taxonomy . '_' . $term->term_id);
      $numbers = get_field('numbers', $term->taxonomy . '_' . $term->term_id);
      $ingredients_cards = get_field('flavor_ingredients_cards', $term->taxonomy . '_' . $term->term_id);
      $icons = get_field('icons', $term->taxonomy . '_' . $term->term_id);
      $ingredients = get_field('ingredients', $term->taxonomy . '_' . $term->term_id);
      $note = get_field('accordion_note', $term->taxonomy . '_' . $term->term_id);

      $data[] = array(
        'title' => $term->name,
        'slug' => $term->slug,
        'icons' => $icons,
        'ingredients_cards' => $ingredients_cards,
        'ingredients' => $ingredients,
        'note' => $note
      );
    endforeach;
  	?>

	  <div class="b-ingredients__tabs js-tabs">
	  	<?php
	    $i = 0;
	    foreach ($data as $key) : ?>
	    <div class="b-ingredients__tab tab<?php if ($i == 0) { ?> is-active<?php } ?>" data-tab-id="<?php echo $key['slug']; ?>"><?php echo $key['title']; ?></div>
	    <?php $i++;
	    endforeach; ?>
	  </div> <!-- row b-ingredients__tabs -->

			<div class="b-ingredients__info">
			<?php
			$j = 0;
			foreach ($data as $key) : ?>
			<div class="b-ingredients__info-item js-pane<?php if ( $j == 0 ) { ?> is-active<?php } ?>" data-pane-id="<?php echo $key['slug']; ?>">
			<?php
			$j++;

				if ($key['ingredients_cards']) : ?>
				<div class="row b-ingredients__grid">
				<?php foreach ($key['ingredients_cards'] as $card) : ?>
					<div class="col-12 col-md-6 col-lg-4">
						<div class="b-ingredients__item">
						<?php
							$card_image = $card['ingredient_card_image'];

							if( ! empty($card_image) ):
								$card_image_url = $card_image['url'];
								$card_image_alt = $card_image['alt'];
								$card_image_type = $card_image['mime_type'];
								$card_image_large = $card_image['sizes'][ 'img-large' ];
								$card_image_medium = $card_image['sizes'][ 'img-medium' ];
								$card_image_small = $card_image['sizes'][ 'img-small' ]; ?>
								<div class="u-holder">
									<picture class="b-ingredients__item-picture u-full">
										<source type="<?php echo $card_image_type ?>" media="(min-width: 1000px)" data-srcset="<?php echo $card_image_large	; ?>">
										<source type="<?php echo $card_image_type ?>" media="(min-width: 480px)" data-srcset="<?php echo $card_image_medium; ?>">
										<img src=data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw== class="lazy u-full u-object-fit" data-src="<?php echo $card_image_small; ?>" alt="<?php echo $card_image_alt; ?>">
									</picture>
								</div>
							<?php endif; ?>

							<?php if( $card['ingredient_card_title'] ): ?>
								<h5 class="b-ingredients__item-title"><?php echo $card['ingredient_card_title']; ?></h5>
							<?php endif; ?>

							<?php if( $card['ingredient_card_description'] ): ?>
								<p class="b-ingredients__item-description"><?php echo $card['ingredient_card_description']; ?></p>
							<?php endif; ?>
						</div> <!-- end b-ingredients__item -->
					</div> <!-- end col-12 col-md-6 col-lg-4 -->
				<?php endforeach; ?>
				</div> <!-- row b-ingredients__grid -->
				<?php endif; ?>

				<div class="row align-items-center">
					<div class="col-12 col-md-5">
						<?php if( get_field('ingredients_icons_title') ): ?>
						<h4 class="b-ingredients__icons-title"><?php the_field('ingredients_icons_title'); ?></h4>
						<?php endif; ?>
						<div class="b-ingredients__icons">
						<?php if ($key['icons']) :
						foreach ($key['icons'] as $icon) :
							echo '
								<div class="b-ingredients__icon">
									<div class="b-ingredients__icon-circle">
										<img class="b-ingredients__icon-image" src="' . $icon['icon']['url'] . '" alt="' . $icon['icon']['name'] . '" />
									</div>
									<div class="b-ingredients__icon-title">' . $icon['image_title'] . '</div>
								</div>';
						endforeach;
						endif;
						?>
						</div> <!-- b-ingredients__icons -->
					</div> <!-- col-12 col-md-5 -->
					<div class="col-12 col-md-7">
						<?php if ($key['ingredients']) : ?>
						<div class="ingredients-accordion">
							<?php
							$k = 0;
							foreach ($key['ingredients'] as $ingredient) : ?>
							<div class="ingredients-accordion__item <?php if ( $k == 0 ) { ?>ingredients-accordion__item_active<?php } ?>">
							<?php $k++; ?>
							<div class="ingredients-accordion__tab"><?php echo $ingredient['tab_name']; ?></div>
							<div class="ingredients-accordion__content">
								<?php
									$table = $ingredient['table'];
									$table_text = $ingredient['flavor_ingredients_text'];

									if ( ! empty ( $table_text ) ) {
										echo $table_text;
									} else {
										if ( ! empty ( $table ) ) {
											echo '<table class="ingredients-accordion__table" border="0">';
											if ( ! empty( $table['caption'] ) ) {
												echo '<caption>' . $table['caption'] . '</caption>';
											}
											if ( ! empty( $table['header'] ) ) {
											echo '<thead>';
												echo '<tr>';
													foreach ( $table['header'] as $th ) {
														echo '<th>';
														echo $th['c'];
														echo '</th>';
													}
												echo '</tr>';
											echo '</thead>';
											}
											echo '<tbody>';
											foreach ( $table['body'] as $tr ) {
												echo '<tr>';
													foreach ( $tr as $td ) {
														echo '<td>';
														echo $td['c'];
														echo '</td>';
													}
												echo '</tr>';
											}
											echo '</tbody>';
											echo '</table>';
										}
									}
								?>
								</div> <!-- end ingredients-accordion__content -->
							</div> <!-- end ingredients-accordion__item  -->
							<?php endforeach; ?>
						</div> <!-- end ingredients-accordion -->
						<div class="ingredients-accordion__note"><?php echo $key['note']; ?></div> <!-- end ingredients-accordion__note -->
						<?php endif; ?>
					</div> <!-- end col-12 col-md-7 -->
				</div> <!-- end row align-items-center -->
			</div> <!-- end b-ingredients__info-item -->
			<?php endforeach; ?>

    </div> <!-- end b-ingredients__info -->

  </div> <!-- end container -->

</section> <!-- end b-ingredients -->


<?php if (get_field('reviews_banner')): ?>
<section class="section section_image section_image_large">
	<div class="lazy u-full u-cover u-cover--center" data-src="<?php the_field('reviews_banner'); ?>"></div>
</section>
<?php endif; ?>
<section class="b-reviews">
  <div class="container">
    <?php
      $reviews_title = get_field('reviews_title');
      if (!empty($reviews_title)) : ?>
	      <img class="b-reviews__title" src="<?php echo $reviews_title['url']; ?>" alt="<?php echo $reviews_title['alt']; ?>" />
    <?php endif; ?>

    <div class="b-reviews__trustbox"></div>
  </div>
</section>


<?php if(get_field('faq_banner')): ?>
<section class="section section_image section_image_large">
	<div class="lazy u-full u-cover u-cover--center" data-src="<?php the_field('faq_banner'); ?>"></div>
</section>
<?php endif; ?>

<section class="section">
    <div class="b-faqs">
    <?php $faq_title = get_field('faq_title');
      if( !empty($faq_title) ): ?>
	      <img class="b-faqs__title" src="<?php echo $faq_title['url']; ?>" alt="<?php echo $faq_title['alt']; ?>" />
    <?php endif; ?>
      <div class="b-faqs__list">

  <?php
    if( have_rows('faqs') ):

      while ( have_rows('faqs') ) : the_row();

				$post_object = get_sub_field('faq');

        if( $post_object ):
          $post = $post_object;
          setup_postdata( $post );
        ?>

        <div class="b-faqs__item">
          <div class="container">
            <div class="row">
              <div class="col-md-10 offset-md-1">
                <div class="b-faqs__head"><?php the_title(); ?></div>
                <div class="b-faqs__content"><?php the_field('answer'); ?></div>
              </div>
            </div>
          </div>
        </div>
        <?php wp_reset_postdata();  ?>
        <?php endif;

      endwhile;
      endif;
	?>
	<?php if (get_field('faq_button_link')): ?>
    <div class="b-faqs__more b-faqs__more_right">
      <div class="container">
		    <a class="b-faqs__link" href="<?php the_field('faq_button_link'); ?>"><?php the_field('faq_button_text'); ?></a>
      </div>
    </div>
	<?php endif; ?>

  </section>

	<section class="section section_large">
  <div class="b-mission js-in-view">
    <div class="container">
      <div class="row align-items-center">
				<div class="col-md-6 col-lg-6">
          <div class="b-mission__image">
            <?php
              $mission_image = get_field('mission_image');
              if ( !empty( $mission_image ) ) {
                $mission_image_url = $mission_image['url'];
                $mission_image_alt = $mission_image['alt'];
                $mission_image_type = $mission_image['mime_type'];
                $mission_image_large = $mission_image['sizes'][ 'img-large' ];
                $mission_image_medium = $mission_image['sizes'][ 'img-medium' ];
                $mission_image_small = $mission_image['sizes'][ 'img-small' ];
            ?>
            <picture class="u-full">
              <source type="<?php echo $mission_image_type ?>" media="(min-width: 1000px)" data-srcset="<?php echo $mission_image_large	; ?>">
              <source type="<?php echo $mission_image_type ?>" media="(min-width: 480px)"  data-srcset="<?php echo $mission_image_medium; ?>">
              <img src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" class="lazy u-object-fit u-full" data-src="<?php echo $mission_image_small; ?>" alt="<?php echo $mission_image_alt; ?>">
            </picture>
            <?php } ?>
          </div>
        </div>
        <div class="col-md-6 col-lg-5 offset-lg-1">
          <h2 class="b-mission__heading block-title"><?php the_field('mission_title'); ?></h2>
          <p class="b-mission__text block-text"><?php the_field('mission_text'); ?></p>
          <div class="b-mission__control">
            <a class="button button--primary" href="<?php the_field('mission_button_link'); ?>"><?php the_field('mission_button_text'); ?></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="section section_large subscribe">
  <div class="container">
    <div class="row">
      <div class="col">
        <h2 class="subscribe__title block-title"><?php the_field('subscribe_title'); ?></h2>
        <div class="subscribe__intro block-text">
          <p><?php the_field('subscribe_description'); ?></p>
        </div>
        <div class="b-subscribe">
          <div class="row justify-content-center align-items-center">
            <div class="col-12 col-md-5">
              <h4 class="b-subscribe__description"><?php the_field('subscribe_details'); ?></h4>
            </div>
            <div class="col-12 col-md-5">
              <form class="b-subscribe__form" action="#">
                <!--[if lte IE 8]>
                <script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/v2-legacy.js"></script>
                <![endif]-->
                <script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/v2.js"></script>
                <script>
                  hbspt.forms.create({
                    portalId: "5712553",
                    formId: "012da1da-aaab-493f-9b11-3c45f1b00ea9"
                  });
                </script>
              </form>
            </div>
          </div>
          <?php
            $top_bottle = get_field('top_bottle');
            if( !empty($top_bottle) ): ?>
	            <img class="b-subscribe__bottle b-subscribe__bottle_top" src="<?php echo $top_bottle['url']; ?>" alt="<?php echo $top_bottle['alt']; ?>" />
          <?php endif;
            $bottom_bottle = get_field('bottom_bottle');
            if( !empty($bottom_bottle) ): ?>
              <img class="b-subscribe__bottle b-subscribe__bottle_bottom" src="<?php echo $bottom_bottle['url']; ?>" alt="<?php echo $bottom_bottle['alt']; ?>" />
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</section>

<?php if(get_field('bottom_banner')): ?>
<section class="section section_image lazy" data-src="<?php the_field('bottom_banner'); ?>"></section>
<?php endif; ?>


<?php }

add_action('woocommerce_after_single_product', 'product_custom_sections', 10);
