<?php
	get_header();
?>
<div class="single-article">

	<div class="single-article__title">
    <h1><?php the_title(); ?></h1>
  </div>

  <div class="single-article__content">
    <?php the_content(); ?>
  </div>

	<div class="single-article__pagination">
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
