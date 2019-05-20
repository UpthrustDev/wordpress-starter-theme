<?php
get_header();
$categories = get_the_category();
$all_news = get_field('all_news_link', 'option');
?>
<div class="single-article">
  <div class="single-article__back back-container container">
    <a href="<?php echo get_term_link( $all_news ); ?>"><svg height="13" viewBox="0 0 8 13" width="8" xmlns="http://www.w3.org/2000/svg"><path d="m.137 1.227 1.227-1.227 6.364 6.364-6.364 6.364-1.227-1.228 5.136-5.137z" fill="#fff" fill-rule="evenodd"/></svg><?php the_field('all_news_label', 'option'); ?></a>
  </div>
  <div class="single-article__header">
    <?php if ( ! empty( $categories ) ) { ?>
    <div class="label label--blue mb-10"><?php echo $categories[0]->name; ?></div>
    <?php } ?>
    <h1 class="mb-20"><?php the_title(); ?></h1>
    <div class="date"><?php the_time('d/m/Y'); ?></div>
  </div>
  <?php if (has_post_thumbnail() ) { ?>
  <div class="single-article__thumb">
    <?php the_post_thumbnail(); ?>
  </div>
  <?php } ?>
  <div class="single-article__content content-blocks">
    <?php the_content(); ?>
  </div>
	<div class="single-article__pagination article-pagination container u-flex u-flex-wrap">
		<?php
	  global $post;
	  $prevPost = get_previous_post(true);
	  $nextPost = get_next_post(true);
		?>
		<div class="article-pagination__prev">
			<?php if( is_object($prevPost) ): ?>
			<div class="article-pagination__label text-label mb-20">Previous Article</div>
			<?php previous_post_link( '%link', '%title', true ); ?>
			<?php endif; ?>
		</div>
		<div class="article-pagination__next">
		  <?php if( is_object($nextPost) ): ?>
	  	<div class="article-pagination__label text-label mb-20">Next Article</div>
	  	<?php next_post_link( '%link', '%title', true ); ?>
		  <?php endif; ?>
		</div>
	</div>
</div>

<?php get_footer(); ?>
