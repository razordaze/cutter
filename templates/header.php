<?php 
  if (is_admin_bar_showing()) {echo "<div style='height: 0px'>&nbsp;</div>";}
?>
<header class="header-container" role="banner">
  <div class="wrap clearfix">
    <?php 
    // fontello filters applied in lib/extras
      if (has_nav_menu('social_links')) :
        wp_nav_menu(['theme_location' => 'social_links', 'menu_class' => 'nav']);
      endif;
      ?>
    <a href="<?= esc_url(home_url('/')); ?>" class="brand"><h1>&nbsp;</h1></a>
    <?php if (get_page_by_title( 'Contact Us' )) : ?>
        <div class='contact'><a href="<?php echo esc_url( get_permalink( get_page_by_title( 'Contact Us' ) ) ); ?>"><span>Contact Us</span></a></div>
    <?php endif; ?>
    <nav role="navigation">
      <?php
      if (has_nav_menu('primary_navigation')) :
        wp_nav_menu(['theme_location' => 'primary_navigation','menu_class' => 'nav', 'container_id' => 'top-nav-primary']);
      endif;
      ?>
    </nav>
  </div>  
  <div class="drawer closed">
  </div>
</header>