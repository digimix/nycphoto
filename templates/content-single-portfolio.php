<?php use Roots\Sage\Extras; ?>
<?php while (have_posts()) : the_post();
$title = get_post(get_post_thumbnail_id())->post_title; //The Title
$caption = get_post(get_post_thumbnail_id())->post_excerpt; //The Caption
$description = get_post(get_post_thumbnail_id())->post_content; // The Description
?>

  <article <?php post_class(); ?>>
    <header class="page-header">
      <h1 class="entry-title" style="max-width: 50%;margin: auto;font-size: 2em;"><?php the_title(); ?></h1>
		<?php if ( function_exists('yoast_breadcrumb') ) {
		yoast_breadcrumb('<p id="breadcrumbs" style="display:none;" class="m0">','</p>');
		} ?>
    </header>

    <div class="entry-content">
	    <div class="row">
		    <div class="col-sm-8">
				<figure style="margin-bottom: 30px;position:relative;">
					<?php the_post_thumbnail('large', array('class'=>'blog-thumb img-responsive')); ?>
			        <div style="bottom:0;background-image:linear-gradient(45deg,#F8C482,#E4572E);width: 100%;height: 6px;display: block;"></div>

					<figcaption class="italic" style="bottom: 6px;background: rgba(255, 255, 255, 0.80);padding: 10px;">
						<?php
						if ($title !=='') {
							echo  $title . '<br/>';
						}
						get_template_part('templates/entry-meta');
						?>
					</figcaption>
				</figure>

		    </div>
		    <div class="col-sm-4">
			    <p>Photo by <a title="NYC Photographers" href="<?php echo get_home_url();?>">Camera 1</a></p>
			    <?php if ($caption !=='') {echo wpautop( $caption ); } elseif ($description !=='') {echo wpautop($description);} else {} ?>

			    <ul class="fa fa-ul">
    			    <?php echo get_the_term_list( $post->ID, 'services', '<li><i class="fa-li fa fa-check-circle orange-bold"></i>', ', Photographers</li><li>', ' Photographers</li>' ); ?>
				    <li><i class="fa-li fa fa-check-circle orange-bold"></i>Expert Photographers in NYC </li>
				    <li><i class="fa-li fa fa-check-circle orange-bold"></i>Expert <a href="http://nycphoto.com/about/">Photographers in NYC</a> </li>
			    </ul>
				<?php the_content(); ?>
		    </div>
	    </div>
    </div>
    <footer>
	    <nav class="page-nav next-prev" >
		    <ul class="inline">
				<li rel="previous"><?php previous_post_link( '<strong>%link</strong>', 'Previous post' ); ?></li>
				<li rel="next" ><?php next_post_link( '<strong>%link</strong>', 'Next post' ); ?></li>
		    </ul>
	    </nav>
      <?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>
    </footer>
    <?php // comments_template('/templates/comments.php'); ?>
  </article>
<?php endwhile; ?>
