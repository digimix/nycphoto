<?php
/*
Template Name: Home
*/
?>

<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/page', 'header'); ?>
  <?php // get_template_part('templates/content', 'page'); ?>
<?php endwhile; ?>

<div class="gallery gallery-home">
	<?php
	$file_list_meta_key = '_mix_front_file_list';
	$id = get_the_id();
	$include_string = Roots\Sage\Extras\cmb2_output_file_id_list($id, $file_list_meta_key, 'thumbnail' );
	// echo $string_2;

	$args = array( 'posts_per_page' => -1, 'include' => $include_string, 'post_type' => 'attachment', 'post_mime_type' => 'image', 'services' => 'event-photography' );

	$myposts = get_posts( $args );
	foreach ( $myposts as $post ) : setup_postdata( $post );
		$image_attributes = wp_get_attachment_image_src( $attachment_id, 'large' );
		if( $image_attributes ) {
		?>

	<!-- 		<a class="gallery-slide" title="<?php the_title(); ?>" href="<?= $image_attributes[0]; ?>"> -->
		<figure>
				<?= wp_get_attachment_image( get_the_ID(), 'large' ); ?>
				<figcaption><p><?= get_the_title($post->post_parent );?></p></figcaption>
		</figure>
	<!-- 		</a> -->
	<!-- 		<div class="hidden"><?php $parent_id = $post->post_parent; echo '<br/>'. get_permalink($parent_id);echo '<br/>'. get_the_title($parent_id ); ?></div> -->


		<?php } ?>
	<?php endforeach;
	wp_reset_postdata();?>
</div>

<div class="container">
	<ul class="feat-services">
	<?php

	$args = array( 'posts_per_page' => -1, 'post_type' => 'services', 'include'=>'1850,1849,1848', 'orderby' => 'title', 'order' => 'ASC' );

	$myposts = get_posts( $args );
	foreach ( $myposts as $post ) : setup_postdata( $post );
		$files = get_post_meta(get_the_id(),'_mix_gallery_file_list', 1); ?>
		<li>
			<a href="<?php the_permalink(); ?>">
				<?php //the_post_thumbnail(array('300','300')); ?>
				<figure>
					<img class="img-responsive" src="<?= wp_get_attachment_image_src( key($files), 'large' )[0];?>">
					<figcaption>
						View Portfolio <i class="arrrows">m</i>
					</figcaption>
				</figure>
				<h4><?php the_title(); ?></h4>
			</a>
			<?php the_excerpt(); ?>
			<!-- <img class="img-responsive" src="<?= reset($files); ?>"> -->
		</li>
	<?php endforeach;
	wp_reset_postdata();?>

	</ul>
</div>