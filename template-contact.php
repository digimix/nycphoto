<?php
/**
 * Template Name: Contact
 */
?>

<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/page', 'header'); ?>
  <div class="container">
	  <?php get_template_part('templates/content', 'page'); ?>
  </div>
<?php endwhile; ?>

<div class="contact-wrapper" >
	<div>
		<h3 class="headline text-center">Let's Talk About Your Project</h3>
		<p class="text-center">Please provide the following information and we'll follow up to schedule a consultation.</p>
		<?php echo do_shortcode('[gravityform id="1" title="false" description="false"]'); ?>
	</div>
</div>