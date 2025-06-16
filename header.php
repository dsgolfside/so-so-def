<!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<header class="site-header">
  <div class="site-header__container">
    <div class="site-header__logo">
      <?php if ( has_custom_logo() ) : ?>
        <?php the_custom_logo(); ?>
      <?php else : ?>
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
          <?php bloginfo( 'name' ); ?>
        </a>
      <?php endif; ?>
    </div>
    
    <!-- Desktop Navigation -->
    <nav class="site-navigation desktop-nav" role="navigation">
      <?php
        wp_nav_menu( [
          'theme_location' => 'primary',
          'container'      => false,
          'items_wrap'     => '<ul class="primary-menu">%3$s</ul>',
          'menu_class'     => '',
        ] );
      ?>
    </nav>
    
    <!-- Mobile Menu Toggle -->
    <button class="mobile-menu-toggle" aria-label="Toggle mobile menu">
      <span></span>
      <span></span>
      <span></span>
    </button>
  </div>
  
  <!-- Mobile Navigation Overlay -->
  <div class="mobile-nav-overlay">
    <nav class="mobile-navigation" role="navigation">
      <?php
        wp_nav_menu( [
          'theme_location' => 'primary',
          'container'      => false,
          'items_wrap'     => '<ul class="mobile-menu">%3$s</ul>',
          'menu_class'     => '',
        ] );
      ?>
    </nav>
  </div>
</header>
