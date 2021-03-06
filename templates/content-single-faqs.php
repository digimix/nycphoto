<?php use Roots\Sage\Extras; ?>
<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class(); ?>>
    <header class="page-header">
      <h1 class="entry-title"><?php the_title(); ?></h1>
      <?php //get_template_part('templates/entry-meta'); ?>
    </header>
    <div class="entry-content">
	    <?php // the_post_thumbnail('large', array('class'=>'blog-thumb img-responsive')); ?>
      <?php the_content(); ?>
    </div>
    <footer>
	    <nav class="page-nav next-prev" >
		    <ul class="inline">
				<li rel="previous"><?php previous_post_link( '<strong>%link</strong>', 'Previous FAQ' ); ?></li>
				<li rel="next" ><?php next_post_link( '<strong>%link</strong>', 'Next FAQ' ); ?></li>
		    </ul>
	    </nav>
      <?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>
    </footer>
    <?php // comments_template('/templates/comments.php'); ?>
  </article>
<?php endwhile; ?>
