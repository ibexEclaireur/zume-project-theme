<?php
// Adjust the breakpoint of the title-bar by adjusting this variable
?>
<div class="title-bar" data-responsive-toggle="top-bar-menu" data-hide-for="<?php echo "medium" ?>">
  <button class="menu-icon" type="button" data-toggle></button>
  <div class="title-bar-title"><?php esc_html_e( 'Menu', 'jointswp' ); ?></div>
</div>

<div class="top-bar" id="top-bar-menu">
    <div class="top-bar-left show-for-<?php echo "medium" ?>">
        <ul class="menu">
            <li><a href="<?php echo esc_attr( home_url() ); ?>"><?php bloginfo( 'name' ); ?></a></li>
        </ul>
    </div>
    <div class="top-bar-right">
        <?php zume_joints_top_nav(); ?>
    </div>
</div>

