<?php if ( !( is_page_template(array('template-contact.php')) ) ) { ?>
<div class="contact-wrapper">
	<div class="">
		<h3 class="headline text-center">Now Let's Take Some Photos</h3>
		<p class="text-center">Please provide the following information and we'll follow up to schedule a consultation.</p>
		<?= gravity_form('Consultation', false, false, false, '', false); ?>
	</div>
</div>
<?php } ?>

<footer class="content-info <?php if (is_page_template(array('template-contact.php'))) {echo 'page-template-contact'; } ?> " role="contentinfo">
	<div class="container">
	<?php dynamic_sidebar('sidebar-footer'); ?>
	</div>
	<div class="bottom-bar">
		<div class="container">
			<p class="col-xs-12 col-sm-6">
				&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?> <span>| Site by DigiMix <a target="_blank" title="Web Design New York" href="http://digimix.us">Web Design New York</a>.</span>
			</p>
			<?php wp_nav_menu( array('menu' => 'Footer Nav', 'menu_class' => 'nav nav-pills alignright', )); ?>
		</div>
	</div>
</footer>
