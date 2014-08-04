<div class="container">
  <div class="row">
    <div class="col-md-3 sidebar text-center" role="navigation">
      <nav class="language-selector">
        <ul><?php pll_the_languages(); ?></ul>
      </nav>

      <h2 class="main-logo">
        <a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>
      </h2>

      <?php
        if (has_nav_menu('primary_navigation')) :
          wp_nav_menu(array('theme_location' => 'primary_navigation', 'menu_class' => 'main-menu text-left nav nav-stacked'));
        endif;
      ?>

      <ul class="social nav nav-stacked">
        <li><a href="https://vimeo.com/user18229685"><i class="fa fa-vimeo-square"></i></a></li>
        <li><a href="https://www.facebook.com/pages/Ato1lab-ltda/602578619858541"><i class="fa fa-facebook-square"></i></a></li>
      </ul>

      <?php
        if (has_nav_menu('works_navigation')) :
          ?>
        <p class="text-left"><h3>WORKS</h3></p>
        <?php
          wp_nav_menu(array('theme_location' => 'works_navigation', 'menu_class' => 'works nav nav-stacked text-left'));
        endif;
      ?>
    </div>
