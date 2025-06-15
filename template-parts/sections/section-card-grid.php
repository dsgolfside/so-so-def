<?php
// Card Grid Section
?>
<section class="card-grid section">
  <div class="section__inner">
    <header class="section__header">
      <h2 class="section__header-heading"><?php esc_html_e('About', 'so-so-def'); ?></h2>
    </header>
    <div class="card-grid__list">
      <?php
      for ( $i = 1; $i <= 3; $i++ ) {
        $title   = get_post_meta( get_the_ID(), "ssd_card{$i}_title",    true );
        $subtext = get_post_meta( get_the_ID(), "ssd_card{$i}_subtext",  true );
        $img     = get_post_meta( get_the_ID(), "ssd_card{$i}_image",    true );
        $link    = get_post_meta( get_the_ID(), "ssd_card{$i}_link_url", true );

        if ( ! $title && ! $img ) {
          continue;
        }
      ?>
        <div class="card-grid__item">
          <div class="card">
            <?php if ( $img ): ?>
              <div class="card__image">
                <img src="<?php echo esc_url( $img ); ?>" alt="">
              </div>
            <?php endif; ?>

            <div class="card__content">
              <?php if ( $title ): ?>
                <h3 class="card__heading"><?php echo esc_html( $title ); ?></h3>
              <?php endif; ?>
              <?php if ( $subtext ): ?>
                <p class="card__text"><?php echo esc_html( $subtext ); ?></p>
              <?php endif; ?>
              <?php if ( $link ): ?>
                <a class="link" href="<?php echo esc_url( $link ); ?>">
                  <?php esc_html_e('Learn More', 'so-so-def'); ?>
                </a>
              <?php endif; ?>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
  </div>
</section>
