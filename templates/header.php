<?php use Roots\Sage\Nav\NavWalker; ?>

<header class="banner navbar navbar-default navbar-static-top" role="banner">
	<div class="">
		<div class="navbar-header">
			<ul class="fa-ul pull-right hidden-xs">
				<li><i class="fa-li fa fa-map-marker"></i> 62 West 45th Street, New York, NY 10036</li>
				<li><i class="fa-li fa fa-phone"></i><span>Tel:</span> 212-827-0500</li>
			</ul>

			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only"><?= __('Toggle navigation', 'sage'); ?></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>

			<a title="<?php bloginfo('name'); ?>" class="navbar-brand" href="<?= esc_url(home_url('/')); ?>">
				<?php echo file_get_contents('app/themes/nycphoto/assets/logo.svg'); ?>
			</a>

			<nav class="collapse navbar-collapse" role="navigation">
				<?php
				if (has_nav_menu('primary_navigation')) :
				wp_nav_menu(['theme_location' => 'primary_navigation', 'walker' => new NavWalker(), 'menu_class' => 'nav navbar-nav']);
				endif;
				?>
			</nav>
		</div>
	</div>
</header>
