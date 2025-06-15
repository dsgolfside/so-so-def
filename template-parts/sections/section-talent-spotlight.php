<?php
/**
 * template-parts/section-talent-spotlight.php
 *
 * Displays the Talent Spotlight section on the homepage.
 */
?>
<section class="section talent-spotlight" data-aos="fade-up">
  <div class="section__inner">
    <header class="section__header">
      <h2 class="section__header-heading"><?php esc_html_e( 'Talent Spotlight', 'so-so-def' ); ?></h2>
      <div class="section__header-link">
        <a class="link" href="<?php echo esc_url( home_url( '/music/' ) ); ?>">
          <span><?php esc_html_e( 'See All Talent', 'so-so-def' ); ?></span>
          <svg aria-hidden="true" focusable="false" class="link__icon" viewBox="0 0 11 8"><line fill="none" stroke="#000" stroke-width="0.5" stroke-linecap="round" x1="1" x2="10" y1="3.5" y2="3.5"/><polyline fill="none" stroke="#000" stroke-width="0.5" stroke-linecap="round" points="7,0 10,3.5 7,7"/></svg>
        </a>
      </div>
    </header>

    <div class="section__main--full-bleed-small talent-spotlight__main">
      <div class="talent-spotlight__main-inner">
        <div class="talent-spotlight__content" data-aos="fade-up">
          <div class="eyebrow"><?php esc_html_e( 'Featured', 'so-so-def' ); ?></div>
          <h3 class="talent-spotlight__heading heading-1"><?php esc_html_e( 'Megan Thee Stallion', 'so-so-def' ); ?></h3>
          <div class="link-list">
            <a class="link" href="<?php echo esc_url( home_url( '/music/megan-thee-stallion/' ) ); ?>">
              <span><?php esc_html_e( 'Learn More', 'so-so-def' ); ?></span>
              <svg aria-hidden="true" focusable="false" class="link__icon" viewBox="0 0 11 8"><line fill="none" stroke="#000" stroke-width="0.5" stroke-linecap="round" x1="1" x2="10" y1="3.5" y2="3.5"/><polyline fill="none" stroke="#000" stroke-width="0.5" stroke-linecap="round" points="7,0 10,3.5 7,7"/></svg>
            </a>
          </div>
        </div>

        <div class="talent-spotlight__side-block-list" data-aos="fade-up">
          <div class="talent-spotlight__side-block-item">
            <div class="side-block side-block--statistic">
              <div class="eyebrow side-block__eyebrow"><?php esc_html_e( 'Trending Talent', 'so-so-def' ); ?></div>
              <div class="eyebrow heading-1 side-block__number">
                <span data-counting-value="33.5">33.5</span><span><?php esc_html_e( 'Million', 'so-so-def' ); ?></span>
              </div>
              <div class="paragraph paragraph--small side-block__secondary-text"><?php esc_html_e( 'Total Followers', 'so-so-def' ); ?></div>
              <div class="paragraph paragraph--small side-block__tertiary-text"><?php esc_html_e( '@TheeStallion', 'so-so-def' ); ?></div>
            </div>
          </div>

          <div class="talent-spotlight__side-block-item">
            <div class="side-block side-block--text">
              <div class="side-block__link">
                <a class="link" href="<?php echo esc_url( 'https://tidal.com/browse/album/342008492' ); ?>">
                  <span><?php esc_html_e( 'LISTEN NOW', 'so-so-def' ); ?></span>
                  <svg aria-hidden="true" focusable="false" class="link__icon" viewBox="0 0 11 8"><line fill="none" stroke="#000" stroke-width="0.5" stroke-linecap="round" x1="1" x2="10" y1="3.5" y2="3.5"/><polyline fill="none" stroke="#000" stroke-width="0.5" stroke-linecap="round" points="7,0 10,3.5 7,7"/></svg>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="talent-spotlight__background-image media-container">
        <img class="media-container__media" src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/GENERAL-scaled.jpg' ); ?>" alt="">
      </div>
    </div>
  </div>
</section>
