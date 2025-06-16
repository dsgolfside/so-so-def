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
          // echo do_shortcode( '[jj-aws-ivs]' );
          echo do_shortcode( '[jj_aws_ivs_recording bucket="sosodefstreaming" key="ivs/v1/627627708382/m9QeULOT1S2b/2025/6/1/19/6/hQbR2qT7rAje/media/hls/master.m3u8" aspect_ratio="1/1" mobile_aspect_ratio="1/1" autoplay="true" loop="true"]' );
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