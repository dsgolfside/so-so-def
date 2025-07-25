<?php
/**
 * Section: The Latest Grid
 */
$args = [
  'post_type'      => 'post',
  'posts_per_page' => 3,
  'category_name'  => 'news', // Only pull from 'news' category
];
$latest_query = new WP_Query( $args );
?>

<section
  class="section latest-grid"
  data-aos="fade-up"
  data-aos-once="true"
  data-aos-offset="200"
>
  <div class="container">
    <div class="section__inner">

      <header class="section__header">
        <h2 class="section__header-heading">
          <?php esc_html_e( 'Latest News', 'so-so-def' ); ?>
        </h2>
        <div class="section__header-link">
          <?php
          // Try to link to 'news' category, fallback to general post archive
          $news_category = get_category_by_slug('news');
          $archive_link = $news_category ? get_category_link($news_category->term_id) : get_post_type_archive_link('post');
          ?>
          <a class="link" href="<?php echo esc_url( $archive_link ); ?>">
            <span><?php esc_html_e( 'View All', 'so-so-def' ); ?></span>
            <svg aria-hidden="true" focusable="false" class="link__icon" viewBox="0 0 11 8">
              <line fill="none" stroke="currentColor" stroke-width="0.5" x1="1" x2="10" y1="3.5" y2="3.5"></line>
              <polyline fill="none" stroke="currentColor" stroke-width="0.5" points="7,0 10,3.5 7,7"></polyline>
            </svg>
          </a>
        </div>
      </header>

      <div class="section__main section__main--full-bleed-small">
        <div class="latest-grid__grid">
          <?php
          if ( $latest_query->have_posts() ) :
            $i = 0;
            while ( $latest_query->have_posts() ) :
              $latest_query->the_post();
              $i++;
          ?>
            <div class="latest-grid__item">
              <div
                class="card"
                data-aos="fade-up"
                data-aos-delay="<?php echo esc_attr( $i * 100 ); ?>"
              >
                <a class="card__anchor" href="<?php the_permalink(); ?>">
                  <div class="card__image media-container media-container--cover media-container--gradient">
                    <?php
                    if ( has_post_thumbnail() ) {
                      the_post_thumbnail(
                        'large',
                        [ 'class' => 'media-container__media', 'alt' => get_the_title() ]
                      );
                    }
                    ?>
                  </div>
                  <div class="card__inner">
                    <h3 class="card__heading"><?php the_title(); ?></h3>
                  </div>
                </a>
              </div>
            </div>
          <?php
            endwhile;
            wp_reset_postdata();
          endif;
          ?>

          <!-- YouTube Video Embed: spans 2 cols on desktop, full width on mobile -->
          <div
            class="latest-grid__embed"
            data-aos="fade-up"
            data-aos-delay="<?php echo esc_attr( (++$i) * 100 ); ?>"
          >
            <div class="video-player">
              <iframe
                style="border-radius:0"
                src="https://www.youtube.com/embed/KP63nbhJcZU"
                width="100%"
                height="315"
                frameborder="0"
                allowfullscreen=""
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                loading="lazy"
              ></iframe>
            </div>
          </div>

        </div><!-- .latest-grid__grid -->
      </div><!-- .section__main -->

    </div><!-- .section__inner -->
  </div><!-- .container -->
</section>