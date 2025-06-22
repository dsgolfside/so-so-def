<!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://use.typekit.net/qob5kjv.css">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<header class="site-header">
  <div class="site-header__container">
    <div class="site-header__logo">
      <?php if ( has_custom_logo() ) : ?>
        <!-- Default logo for light header -->
        <div class="logo-default">
          <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/so-so-def-logo.png" alt="<?php bloginfo( 'name' ); ?>" />
          </a>
        </div>
        <!-- White logo for dark/scrolled header -->
        <div class="logo-white">
          <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/so-so-def-logo-white.png" alt="<?php bloginfo( 'name' ); ?>" />
          </a>
        </div>
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
    
    <!-- Header Social Icon (Desktop Only) -->
    <div class="header-social-icon">
      <a href="https://www.instagram.com/sosodefuniversity" aria-label="Instagram" class="header-instagram-icon" target="_blank" rel="noopener">
        <svg viewBox="0 0 24 24">
          <rect x="2" y="2" width="20" height="20" rx="5" ry="5"/>
          <path d="m16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/>
          <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/>
        </svg>
      </a>
    </div>
    
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
