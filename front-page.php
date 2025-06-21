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
            echo do_shortcode( '[jj_aws_ivs_recording bucket="sosodefstreaming" key="ivs/v1/627627708382/m9QeULOT1S2b/2025/6/19/21/49/eAqzFZva07R3/media/hls/master.m3u8" aspect_ratio="1/1" autoplay="true" loop="true" controls="false"]' );
          } else {
            // Desktop version - 1920x1080 widescreen format
            echo do_shortcode( '[jj_aws_ivs_recording bucket="sosodefstreaming" key="ivs/v1/627627708382/m9QeULOT1S2b/2025/6/21/0/27/n806kqN85Ah4/media/hls/master.m3u8" aspect_ratio="16/9" autoplay="true" loop="true" controls="false"]' );
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