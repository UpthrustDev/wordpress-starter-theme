<?php
  $languages = icl_get_languages();
  $current_language = apply_filters( 'wpml_current_language', NULL );
?>

<div class="b-lang js-lang">
  <div class="b-lang__head js-lang-button"><?php echo $current_language; ?></div>
  <div class="b-lang__dropdown">
    <?php
      foreach($languages as $lang) {
    ?>
      <a class="b-lang__item <?php echo $lang['active'] ? 'b-lang__item_active' : '' ?>" href="<?php echo $lang['url'] ?>"><?php echo $lang['tag']; ?></a>
    <?php
      }
    ?>
  </div>
</div>