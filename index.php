<?php get_template_part('templates/page', 'header'); ?>
<div class="container">
<?php if (!have_posts()) : ?>
  <div class="alert alert-warning">
    <?php _e('Sorry, no results were found.', 'sage'); ?>
  </div>
  <?php get_search_form(); ?>
<?php endif; ?>

<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/content', get_post_type() != 'post' ? get_post_type() : get_post_format()); ?>
<?php endwhile; ?>
	<div class="text-center" style="margin-bottom:40px;">
	<?php the_posts_pagination( array(
        'prev_text'          => __( '<i class="arrrows">M</i> Previous ', 'cm' ),
        'next_text'          => __( 'Next <i class="arrrows">m</i>', 'cm' ),
        'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'cm' ) . ' </span>',
    ) );
 ?>
	</div>
</div>