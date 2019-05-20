<?php
/**
 * The default template for a 404-error page.
 *
 * @subpackage Master
 * @since Master 1.0
 */
get_header(); ?>


<section class="section">
	<div class="notfound">
		<div class="notfound__line"></div>
		<div class="notfound__line notfound__line_image lazy" data-src="<?php the_field('image_404', 'option'); ?>" data-text-top="<?php the_field('top_text_404', 'option'); ?>" data-text-bottom="<?php the_field('bottom_text_404', 'option'); ?>"></div>
		<?php if (get_field('button_text_404', 'option')) : ?>
			<div class="notfound__line">
				<a href="<?php the_field('button_url_404', 'option'); ?>" class="button button-primary"><?php the_field('button_text_404', 'option'); ?></a>			
			</div>
		<?php endif; ?>	
	</div>
</section>

<?php get_footer(); ?>
