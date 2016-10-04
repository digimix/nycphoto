<?php
/*
Template Name: About
*/
?>

<?php get_template_part('templates/page', 'header'); ?>

<div class="container">
	<div style="max-width: 800px;margin: 5% auto;">
	<h3 class="text-center italic">Meet Camera 1's New York City Photography Team</h3>
	<?php get_template_part('templates/content', 'page'); ?>
	</div>


	<ul class="team">
	<?php
	$post_type = 'team';
	$args = array( 'posts_per_page' => -1, 'post_type' => $post_type, 'post_status' => 'publish', 'order' => 'ASC',);

	$myposts = get_posts( $args );
	foreach ( $myposts as $post ) : setup_postdata( $post ); ?>
		<li class="clearfix">
			<a href="#<?php echo $post->post_name;?>" class="open-popup-link">
				<figure>
					<?php the_post_thumbnail('medium', array('class' => '')); ?>
					<figcaption>
						<h4 class="strong m0"><small class="hidden">NYC Photographer &mdash;</small> <?php the_title(); ?></h4>
					</figcaption>
				</figure>
			</a>

			<div id="<?php echo $post->post_name;?>" class="white-popup mfp-hide">
				<h4 class="strong"><?php the_title(); ?> <small class="hidden">NYC Photographer</small></h4>
				<?php the_content(); ?>
				<a class="mail-btn" href="mailto:<?= get_post_meta(get_the_id(), '_mix_team_email', true); ?>"><i class="fa fa-envelope"></i> <?= get_post_meta(get_the_id(), '_mix_team_email', true); ?></a>

			</div>
		</li>
	<?php endforeach;
	wp_reset_postdata();?>

	</ul>
</div>