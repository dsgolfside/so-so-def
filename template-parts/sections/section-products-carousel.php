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

<section class="section products-carousel" data-aos="fade-up">
  <div class="container">
    <div class="section__inner">
      <header class="section__header" data-aos="fade-up">
        <h2 class="section__header-heading"><?php esc_html_e( 'Shop', 'so-so-def' ); ?></h2>
        <div class="section__header-link">
          <a class="link" href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>">
            <span><?php esc_html_e( 'Shop All', 'so-so-def' ); ?></span>
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
      'posts_per_page' => 9
    ]);

    if ( $products->have_posts() ) :
    ?>
      <div class="swiper-container products-swiper">
        <div class="swiper-wrapper">
          <?php while ( $products->have_posts() ) : $products->the_post(); ?>
            <?php 
            global $product;
            $product = wc_get_product( get_the_ID() );
            if ( ! $product ) continue;
            ?>
            <div class="swiper-slide">
              <div class="product-card" data-aos="fade-up">
                <div class="product-card__image">
                  <a href="<?php the_permalink(); ?>">
                    <?php if ( has_post_thumbnail() ) : ?>
                      <?php the_post_thumbnail( 'woocommerce_thumbnail', ['class' => 'product-card__img'] ); ?>
                    <?php else : ?>
                      <img src="<?php echo esc_url( wc_placeholder_img_src( 'woocommerce_thumbnail' ) ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" class="product-card__img">
                    <?php endif; ?>
                  </a>
                </div>
                <div class="product-card__content">
                  <h3 class="product-card__title">
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                  </h3>
                  <div class="product-card__price">
                    <?php echo $product->get_price_html(); ?>
                  </div>
                  <div class="product-card__action">
                    <?php
                    echo apply_filters(
                      'woocommerce_loop_add_to_cart_link',
                      sprintf(
                        '<a href="%s" data-quantity="%s" class="%s" %s>%s</a>',
                        esc_url( $product->add_to_cart_url() ),
                        esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ),
                        esc_attr( isset( $args['class'] ) ? $args['class'] : 'button product_type_' . $product->get_type() ),
                        isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '',
                        esc_html( $product->add_to_cart_text() )
                      ),
                      $product,
                      $args ?? []
                    );
                    ?>
                  </div>
                </div>
              </div>
            </div>
          <?php endwhile; ?>
        </div>

        <!-- Swiper controls -->
        <div class="swiper-button-prev products-prev"></div>
        <div class="swiper-button-next products-next"></div>
        <div class="swiper-pagination products-pagination"></div>
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