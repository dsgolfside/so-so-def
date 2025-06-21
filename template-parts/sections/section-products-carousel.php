<?php
/**
 * template-parts/section-products-carousel.php
 *
 * Displays a WooCommerce products carousel section.
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Check if WooCommerce is active
if ( ! class_exists( 'WooCommerce' ) ) {
    return;
}
?>

<section
  class="section products-carousel"
  data-aos="fade-up"
  data-aos-once="true"
  data-aos-offset="200"
>
  <div class="container">
    <div class="section__inner">

      <header class="section__header">
        <h2 class="section__header-heading">
          <?php esc_html_e( 'SHOP', 'so-so-def' ); ?>
        </h2>
        <div class="section__header-link">
          <a class="link" href="https://shop.kt8merch.com/collections/so-so-def" target="_blank" rel="noopener noreferrer">
            <span><?php esc_html_e( 'SHOP ALL', 'so-so-def' ); ?></span>
            <svg aria-hidden="true" focusable="false" class="link__icon" viewBox="0 0 11 8">
              <line fill="none" stroke="currentColor" stroke-width="0.5" x1="1" x2="10" y1="3.5" y2="3.5"></line>
              <polyline fill="none" stroke="currentColor" stroke-width="0.5" points="7,0 10,3.5 7,7"></polyline>
            </svg>
          </a>
        </div>
      </header>

      <div class="section__main section__main--full-bleed-small">
    <?php
    // Query products using simple WooCommerce query
    $products = new WP_Query([
      'post_type'      => 'product',
      'post_status'    => 'publish',
      'posts_per_page' => 8
    ]);

    if ( $products->have_posts() ) :
    ?>
      <div class="swiper-container products-swiper featured-slider">
        <div class="swiper-wrapper">
          <?php while ( $products->have_posts() ) : $products->the_post(); ?>
            <?php 
            global $product;
            $product = wc_get_product( get_the_ID() );
            if ( ! $product ) continue;
            
            // Get external URL - check if product has custom external URL field
            $external_url = get_post_meta( get_the_ID(), '_external_shop_url', true );
            if ( empty( $external_url ) ) {
                // Fallback to main shop collection if no specific URL is set
                $external_url = 'https://shop.kt8merch.com/collections/so-so-def';
            }
            ?>
            <div class="swiper-slide">
              <div class="product-card featured-product" data-aos="fade-up">
                <div class="product-card__image">
                  <a href="<?php echo esc_url( $external_url ); ?>" target="_blank" rel="noopener noreferrer">
                    <?php if ( has_post_thumbnail() ) : ?>
                      <?php the_post_thumbnail( 'woocommerce_thumbnail', ['class' => 'product-card__img'] ); ?>
                    <?php else : ?>
                      <img src="<?php echo esc_url( wc_placeholder_img_src( 'woocommerce_thumbnail' ) ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" class="product-card__img">
                    <?php endif; ?>
                  </a>
                </div>
                <div class="product-card__content">
                  <h3 class="product-card__title">
                    <a href="<?php echo esc_url( $external_url ); ?>" target="_blank" rel="noopener noreferrer"><?php the_title(); ?></a>
                  </h3>
                  <div class="product-card__price">
                    <?php echo $product->get_price_html(); ?>
                  </div>
                </div>
              </div>
            </div>
          <?php endwhile; ?>
        </div>

        <!-- Swiper controls -->
        <div class="swiper-button-prev products-prev">
          <svg width="12" height="12" viewBox="0 0 12 12" fill="none">
            <path d="M7.5 9L4.5 6L7.5 3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </div>
        <div class="swiper-button-next products-next">
          <svg width="12" height="12" viewBox="0 0 12 12" fill="none">
            <path d="M4.5 3L7.5 6L4.5 9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </div>
      </div>
      
    <?php else : ?>
      <div class="no-products">
        <p><?php esc_html_e( 'No products found.', 'so-so-def' ); ?></p>
      </div>
    <?php endif; ?>
    
    <?php wp_reset_postdata(); ?>
    </div><!-- .section__main -->
    </div><!-- .section__inner -->
  </div><!-- .container -->
</section> 