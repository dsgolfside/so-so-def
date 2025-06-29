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
          ?>
          
          <!-- Video container with device-specific loading -->
          <div id="video-container" data-mobile="<?php echo $is_mobile ? '1' : '0'; ?>">
            <?php if ( $is_mobile ) : ?>
              <!-- Mobile version - 1080x1080 square format -->
              <?php echo do_shortcode( '[jj_aws_ivs_recording bucket="sosodefstreaming" key="ivs/v1/627627708382/m9QeULOT1S2b/2025/6/29/21/59/y4LXym77jyp4/media/hls/master.m3u8" aspect_ratio="1/1" autoplay="true" loop="true" muted="true" controls="false"]' ); ?>
            <?php else : ?>
              <!-- Desktop version - 1920x1080 widescreen format -->
              <?php echo do_shortcode( '[jj_aws_ivs_recording bucket="sosodefstreaming" key="ivs/v1/627627708382/m9QeULOT1S2b/2025/6/29/21/53/2o3KP59k9NJg/media/hls/master.m3u8" aspect_ratio="16/9" autoplay="true" loop="true" muted="true" controls="false"]' ); ?>
            <?php endif; ?>
          </div>
          
          <!-- JavaScript fallback for cache mismatches -->
          <script>
          (function() {
            // Check if cached version matches current device
            function isMobileDevice() {
              const urlParams = new URLSearchParams(window.location.search);
              if (urlParams.get('mobile') === '1') return true;
              if (urlParams.get('mobile') === '0') return false;
              
              const isMobileScreen = window.innerWidth <= 768;
              const isMobileUA = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
              return isMobileScreen || isMobileUA;
            }
            
            const container = document.getElementById('video-container');
            const serverDetectedMobile = container.getAttribute('data-mobile') === '1';
            const clientDetectedMobile = isMobileDevice();
            
            // If server and client detection don't match, reload page with correct parameter
            if (serverDetectedMobile !== clientDetectedMobile) {
              const url = new URL(window.location);
              url.searchParams.set('mobile', clientDetectedMobile ? '1' : '0');
              window.location.replace(url.toString());
            }
          })();
          </script>
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