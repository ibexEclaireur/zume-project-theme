<!-- By default, this menu will use off-canvas for small
	 and a topbar for medium-up -->

<div class="top-bar" id="top-bar-menu">
	<div class="top-bar-left float-left">
		<ul class="menu">
			<li><a href="<?php if (is_user_logged_in()) { echo '/dashboard'; } else { echo home_url(); } ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/zume-logo-white.png" /></a></li>
		</ul>
	</div>
	<div class="top-bar-right float-right show-for-large">
		<?php joints_top_nav(); ?>
	</div>
	<div class="top-bar-right float-right show-for-small hide-for-large ">
		<ul class="menu float-right">
			<!-- <li><button class="menu-icon" type="button" data-toggle="off-canvas"></button></li> -->
			<li><a data-toggle="off-canvas"><?php _e( 'Menu', 'jointswp' ); ?></a></li>
		</ul>
	</div>
</div>