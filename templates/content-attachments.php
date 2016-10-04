<?php
$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' );
$photo_url = $thumb['0'];
?>

<a href="<?= $photo_url; ?>">
	<figure <?php post_class(); ?>>
		<?php the_post_thumbnail('thumbnail',array('class'=>'img-responsive')); ?>
		<figcaption class="aligner">
			<h4><?php the_title(); ?></h4>
			<?php // get_template_part('templates/entry-meta');  the_excerpt();  ?>
		</figcaption>
	</figure>
</a>