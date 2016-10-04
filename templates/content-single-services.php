<?php use Roots\Sage\Extras;
$thumb_id = get_post_thumbnail_id();
$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'thumbnail-size', true);
$thumb_url = $thumb_url_array[0];
$file_list_meta_key = '_mix_gallery_file_list';
$photographer = get_the_title(); $photographer = preg_replace('/\bPhotography\b/', 'Photographer', $photographer);


//background-image: linear-gradient(180deg,rgba(242,239,239,.9),rgba(242,239,239,.75));
while (have_posts()) : the_post(); ?>
	<article <?php post_class(); ?>>
		<header class="bg-banner banner-ratio" style="background-image: url(<?= $thumb_url; ?>);">
			<div class="content text-center">
				<div class="is-table">
					<div class="table-cell center-container">
					<h1 class="entry-title"><?php the_title(); ?></h1>
					</div>
				</div>
			</div>
		</header>
		<section>
			<h4 class="gallery-header"><i class="fa fa-thumb-tack"></i> Browse the latest photos from our NYC <?= $photographer; ?>s</h4>
		<?php Extras\cmb2_output_file_list( '_mix_gallery_file_list', 'large' ); ?>
		</section>

<!--
		<header class="bg-header" >
			<div class="content" style="background-image: url(<?= $thumb_url; ?>);">
				<h1 class="entry-title"><?php the_title(); ?></h1>
								<?php if ( function_exists('yoast_breadcrumb') ) {
				yoast_breadcrumb('<p id="breadcrumbs" class="m0">','</p>');
				} ?>

			</div>
		</header>
-->
		<div class="entry-content">
			<?php the_content(); ?>
<!--
			<div class="entry-share text-center" style="font-size:30px;color:#666;">
				share:
				<ul class="inline m0" style="padding:0;">
					<li>
						<a target="_blank" href="https://twitter.com/intent/tweet?text=<?= rawurlencode(get_the_title());?>&url=<?php echo get_permalink(); ?>">
							<i class="fa fa-twitter"></i>
						</a>
					</li>
					<li>
						<a href="http://www.facebook.com/sharer.php?u=<?php echo get_permalink(); ?>" target="_blank">
							<i class="fa fa-facebook"></i>
						</a>
					</li>
					<li>
						<a href="https://plus.google.com/share?url=<?php echo get_permalink(); ?>" target="_blank">
							<i class="fa fa-google-plus"></i>
						</a>
					</li>
				</ul>
			</div>
-->

		</div>

		<footer>
			<?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>
		</footer>
		<?php comments_template('/templates/comments.php'); ?>
	</article>
<?php endwhile; ?>


<section class="cols cta">
	<div>
		<i class="fa fa-fw fa-2x fa-weixin"></i>
		<h3 class="">Still have some questions? </h3> <a href="">Visit our quick FAQs <i class="arrrows"> m </i></a>
	</div>

	<div>

		<i class="fa fa-fw fa-2x fa-camera"></i>
		<h3 class="">Meet our NYC <?= $photographer; ?>s </h3> <a href="">About Us <i class="arrrows"> m </i></a>
	</div>
</section>

<div class="container" style="padding-top:4.75rem;padding-bottom:4.75rem;">
	<h3 class="headline text-center">Additional Portfolios</h3>
	<ul class="feat-services">
	<?php

	$args = array( 'posts_per_page' => -1, 'post_type' => 'services', 'exclude'=>get_the_id(), 'orderby' => 'title', 'order' => 'ASC' );

	$myposts = get_posts( $args );
	foreach ( $myposts as $post ) : setup_postdata( $post );
		$files = get_post_meta(get_the_id(),'_mix_gallery_file_list', 1);
		$thefirstimgid = key($files);
		$featimg = htmlspecialchars(Extras\cv_resize($thefirstimgid, 364, 245, true));
		$featimgbakk = wp_get_attachment_image_src( key($files), array('364','242',true) )[0];
		?>
		<li>
			<a href="<?php the_permalink(); ?>">
				<?php //the_post_thumbnail(array('300','300')); ?>
				<figure>
					<img class="img-responsive" src="<?= $featimg;?>">
					<figcaption>
						View Portfolio <i class="arrrows">m</i>
					</figcaption>
				</figure>
				<h4><?php the_title(); ?></h4>
			</a>
			<?php // the_excerpt(); ?>
			<!-- <img class="img-responsive" src="<?= reset($files); ?>"> -->
		</li>
	<?php endforeach;
	wp_reset_postdata();?>

	</ul>
</div>