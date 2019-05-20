<?php

function gallery_options() {
  
  global $product;
  $product_id = $product->get_id();

  $product_flavors = wc_get_product($product_id);
  //pr($product_flavors);

  if (!empty ($product_flavors)) {
    $terms = get_terms( array(
      'taxonomy' => 'pa_flavors',
      'hide_empty' => 'false',
    ));
  }

  foreach ( $terms as $key => $term ) {
  
    $term_shade_1 = get_field('color_shade_1', $term->taxonomy . '_' . $term->term_id);
    $term_shade_2 = get_field('color_shade_2', $term->taxonomy . '_' . $term->term_id);
    $term_shade_3 = get_field('color_shade_3', $term->taxonomy . '_' . $term->term_id);
      
    echo '<div id="bg-color-' . $term->slug . '" class="b-single-product__bg b-single-product__bg_' . $term->slug . '" style="opacity: 0; background: linear-gradient(to bottom, ' . $term_shade_1 . ' 0%, ' . $term_shade_1 . ' 33.333%,' . $term_shade_2 . ' 33.333%,' . $term_shade_2 . ' 66.666%, ' . $term_shade_3 . ' 66.666%, ' . $term_shade_3 . ' 100%);"></div>';
  }

  echo '<div class="b-single-product__bottles">';
  foreach ( $terms as $key => $term ) {
    $bottle = get_field('bottle', $term->taxonomy . '_' . $term->term_id);
    echo '<img class="b-single-product__bottle b-single-product__bottle-' . $term->slug .'" src="'. $bottle['url'] .'" />';
  }
  echo '</div>';

}

add_action('woocommerce_before_single_product_summary', 'gallery_options', 30);