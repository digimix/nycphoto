<?php use Roots\Sage\Extras; ?>
<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class(); ?>>
    <header class="page-header">
      <h1 class="entry-title"><?php the_title(); ?></h1>
      <?php //get_template_part('templates/entry-meta'); ?>
      <h3 class="subtitle m0">NYC Photographer</h3>
    </header>
    <div class="entry-content">
	    <figure class="alignleft" style="width: 200px;">
	    <?php the_post_thumbnail('medium', ['class'=>'img-responsive']); ?>
	    </figure>
	    <?php // the_post_thumbnail('large', array('class'=>'blog-thumb img-responsive')); ?>
      <?php the_content(); ?>
    </div>
    <footer>

	    <section style="clear:both;">
		    <hr>
		    <h3 class="headline text-center" style="margin-top: 40px;margin-bottom: 20px;">Recent Work</h3>
			<ul class="cols" style="list-style: none;margin: 0;padding: 0;">
		<?php
		$tag = $post->post_name;

		$args = array( 'posts_per_page' => 8, 'tag' => $tag, );

		$myposts = get_posts( $args );
		foreach ( $myposts as $post ) : setup_postdata( $post ); ?>
			<li>
				<a href="<?php the_permalink(); ?>">
					<figure style="position: relative;border:2px solid white;">
					<?php the_post_thumbnail('thumbnail', ['class'=>'img-responsive']); ?>
						<figcaption style="padding: 8px 5px;background:rgba(255, 255, 255, 0.82);bottom:0;width: 100%;line-height: 1.2;">
							<?php the_title(); ?>
						</figcaption>
					</figure>

				</a>
			</li>
		<?php endforeach;
		wp_reset_postdata();?>

		</ul>
	    </section>
	    <nav class="page-nav next-prev">
		    <ul class="inline">
				<li rel="previous"><?php previous_post_link( '<strong>%link</strong>', 'Previous Photographer' ); ?></li>
				<li rel="next" ><?php next_post_link( '<strong>%link</strong>', 'Next Photographer' ); ?></li>
		    </ul>
	    </nav>
      <?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>
    </footer>
    <?php // comments_template('/templates/comments.php'); ?>
  </article>
<?php endwhile; ?>
