<!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<header class="site-header">
  <div class="container">
    <div class="site-header__inner">
      <div class="site-header__logo">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
          <?php bloginfo( 'name' ); ?>
        </a>
      </div>
      <nav class="site-navigation" role="navigation">
        <?php
          wp_nav_menu( [
            'theme_location' => 'primary',
            'container'      => false,
            'items_wrap'     => '<ul class="primary-menu">%3$s</ul>',
            'menu_class'     => '',
          ] );
        ?>
      </nav>
    </div><!-- .site-header__inner -->
  </div><!-- .container -->
</header>
