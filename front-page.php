<?php
/**
 * Template Name: Front Page
 */
get_header();
?>

<main id="content">

  <!-- Hero Slider (IVS via shortcode) -->
  <section class="hero home-slider swiper-container" data-aos="fade">
    <div class="swiper-wrapper">
      <div class="swiper-slide">
        <div class="slide-content" data-aos="fade-up" data-aos-delay="200">
          <?php
          // Enhanced device detection for better DevTools testing
          $is_mobile = wp_is_mobile() || (isset($_GET['mobile']) && $_GET['mobile'] == '1');
          
          if ( $is_mobile ) {
            // Mobile version - 1080x1080 square format
            echo '<img src="' . esc_url( get_template_directory_uri() . '/assets/images/1080-x-1080-afroman-animation.jpg' ) . '" alt="Afroman Animation" class="hero-image hero-image--mobile" />';
          } else {
            // Desktop version - 1920x1080 widescreen format
            echo '<img src="' . esc_url( get_template_directory_uri() . '/assets/images/1920-x-1080-afroman-animation.jpg' ) . '" alt="Afroman Animation" class="hero-image hero-image--desktop" />';
          }
          ?>
        </div>
      </div>
      <!-- add more slides like this if you want multiple IVS streams -->
      <!--
      <div class="swiper-slide">
        <div class="slide-content" data-aos="fade-up" data-aos-delay="200">
          <?php // echo do_shortcode( '[jj-aws-ivs id="another_stream"]' ); ?>
        </div>
      </div>
      -->
    </div>

    <!-- Swiper controls -->
    <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>
    <div class="swiper-pagination"></div>
  </section>

  <!-- DEBUGGING: Announcements section BREAKS hamburger menu (Swiper conflict) -->
  
  <!-- About Card Grid Section - ENABLED (WORKING) -->
  <?php get_template_part( 'template-parts/sections/section', 'card-grid' ); ?>

  <!-- The Latest Section - ENABLED (WORKING) -->
  <?php get_template_part( 'template-parts/sections/section', 'latest-grid' ); ?>

  <!-- Announcements Section - FIXED (Removed Swiper conflict) -->
  <?php get_template_part( 'template-parts/sections/section', 'announcements' ); ?>

  <!-- Products Carousel Section -->
  <?php get_template_part( 'template-parts/sections/section', 'products-carousel' ); ?>

  <!-- DISABLED SECTIONS -->
  <?php /*
  <!-- Talent Spotlight Section -->
  <?php get_template_part( 'template-parts/sections/section', 'talent-spotlight' ); ?>
  */ ?>

</main>

<?php get_footer(); ?>