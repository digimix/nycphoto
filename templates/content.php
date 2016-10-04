<article <?php post_class(); ?>>
	<header>
	<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		<?php
		if ( 'gallery' == get_post_format() ) {
			$gallery = do_shortcode(get_post_meta( $post->ID, '_ca_gallery_wysiwyg', true ));
			echo $gallery;
		} else {
			if ( has_post_thumbnail() ) { ?>
				<a title="NYC Photographers - <?php the_title(); ?>" href="<?php the_permalink(); ?>">
					<figure class="caption-bottom" style="margin-bottom:15px;">
						<?php the_post_thumbnail('blog-thumb', array('class' => 'blog-thumb img-responsive'));?>
						<figcaption class="text-center">
							<i class="fa fa-arrows-alt"></i> View Gallery <i class="arrrows">m</i>
						</figcaption>
					</figure>
				</a>
			<?php }
		} ?>
	</header>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div>
	<?php get_template_part('templates/entry-meta'); ?>
</article>