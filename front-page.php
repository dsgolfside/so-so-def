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
          // IVS video via your shortcode
          echo do_shortcode( '[jj-aws-ivs]' );
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

  <!-- About Card Grid Section -->
  <?php get_template_part( 'template-parts/sections/section', 'card-grid' ); ?>

  <!-- The Latest Section -->
  <?php get_template_part( 'template-parts/sections/section', 'latest-grid' ); ?>

  <!-- Announcements Section -->
  <?php get_template_part( 'template-parts/sections/section', 'announcements' ); ?>

  <!-- Philanthropy Section -->
  <?php get_template_part( 'template-parts/sections/section', 'philanthropy' ); ?>

  <!-- Talent Spotlight Section -->
  <?php get_template_part( 'template-parts/sections/section', 'talent-spotlight' ); ?>

</main>

<?php get_footer(); ?>