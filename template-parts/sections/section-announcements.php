<?php
/**
 * template-parts/section-announcements.php
 *
 * Displays the Announcements section on the homepage.
 */
?>
<section class="section text-and-image text-and-image--twenty-five-seventy-five" data-aos="fade-up">
  <div class="container">
    <div class="section__inner">
      <header class="section__header">
        <h2 class="section__header-heading"><?php esc_html_e( 'Announcements', 'so-so-def' ); ?></h2>
        <div class="section__header-link">
          <a class="link" href="<?php echo esc_url( get_post_type_archive_link( 'post' ) ); ?>">
            <span><?php esc_html_e( 'Read All', 'so-so-def' ); ?></span>
            <svg aria-hidden="true" focusable="false" class="link__icon" viewBox="0 0 11 8">
              <line fill="none" stroke="#000" stroke-width="0.5" stroke-linecap="round" x1="1" x2="10" y1="3.5" y2="3.5"/>
              <polyline fill="none" stroke="#000" stroke-width="0.5" stroke-linecap="round" points="7,0 10,3.5 7,7"/>
            </svg>
          </a>
        </div>
      </header>

      <div class="section__main section__main--full-bleed-small">
        <?php
        // Query latest 3 posts from "news" category
        $announcements = new WP_Query([
          'posts_per_page' => 3,
          'category_name'  => 'news',
        ]);
        if ( $announcements->have_posts() ) :
        ?>
          <div class="announcements-grid">
            <div class="announcements-wrapper">
              <?php while ( $announcements->have_posts() ) : $announcements->the_post(); ?>
                <div class="announcement-item text-and-image__item">
                  <div class="text-and-image__item-inner">
                    <div class="media-container media-container--cover">
                      <?php if ( has_post_thumbnail() ) {
                        the_post_thumbnail( 'large' );
                      } ?>
                    </div>
                    <div class="text-and-image__content">
                      <div class="eyebrow"><?php esc_html_e( 'New Updates!', 'so-so-def' ); ?></div>
                      <h3 class="text-and-image__heading"><?php the_title(); ?></h3>
                      <div class="link-list">
                        <a class="link" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Learn More', 'so-so-def' ); ?></a>
                      </div>
                    </div>
                  </div>
                </div>
              <?php endwhile; wp_reset_postdata(); ?>
            </div>
          </div>
        <?php endif; ?>
      </div><!-- .section__main -->
    </div><!-- .section__inner -->
  </div><!-- .container -->
</section>