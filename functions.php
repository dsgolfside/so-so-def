<?php
/**
 * Enqueue theme assets and initialize AOS, Swiper & AWS IVS Player
 */
function ssd_enqueue_assets() {
    // Base Underscores style.css (reset + base styles)
    wp_enqueue_style(
        'so-so-def-style',
        get_stylesheet_uri()
    );

    // Main CSS (grid, typography, colors)
    wp_enqueue_style(
        'so-so-def-main',
        get_template_directory_uri() . '/assets/css/main.css',
        ['so-so-def-style'],
        filemtime( get_template_directory() . '/assets/css/main.css' )
    );

    // AOS animation library
    wp_enqueue_script(
        'aos',
        'https://unpkg.com/aos@2.3.1/dist/aos.js',
        [],
        null,
        true
    );
    wp_enqueue_style(
        'aos-css',
        'https://unpkg.com/aos@2.3.1/dist/aos.css'
    );

    // Swiper slider
    wp_enqueue_style(
        'swiper-css',
        'https://unpkg.com/swiper/swiper-bundle.min.css',
        [],
        null
    );
    wp_enqueue_script(
        'swiper-js',
        'https://unpkg.com/swiper/swiper-bundle.min.js',
        [],
        null,
        true
    );

    // AWS IVS player SDK
    wp_enqueue_script(
        'ivs-player',
        'https://player.live-video.net/1.18.0/amazon-ivs-player.min.js',
        [],
        null,
        true
    );

    // Front-end JS
    wp_enqueue_script(
        'so-so-def-scripts',
        get_template_directory_uri() . '/assets/js/scripts.js',
        ['jquery'],
        filemtime( get_template_directory() . '/assets/js/scripts.js' ),
        true
    );
}
add_action( 'wp_enqueue_scripts', 'ssd_enqueue_assets' );


/**
 * Theme setup: title tag, thumbnails, menu, and custom logo
 */
function ssd_theme_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
    ) );
    register_nav_menu( 'primary', __( 'Primary Menu', 'so-so-def' ) );
}
add_action( 'after_setup_theme', 'ssd_theme_setup' );

/**
 * Register the “Homepage Slides” meta box on Pages
 */
function ssd_add_homepage_slides_metabox() {
    add_meta_box(
        'ssd-homepage-slides',
        __( 'Homepage Slides', 'so-so-def' ),
        'ssd_homepage_slides_metabox_callback',
        'page',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'ssd_add_homepage_slides_metabox' );

/**
 * Render the meta box fields (3 slides)
 */
function ssd_homepage_slides_metabox_callback( $post ) {
    wp_nonce_field( 'ssd_homepage_slides_nonce', 'ssd_homepage_slides_nonce_field' );

    for ( $i = 1; $i <= 3; $i++ ) {
        $img     = get_post_meta( $post->ID, "ssd_slide{$i}_image_url", true );
        $heading = get_post_meta( $post->ID, "ssd_slide{$i}_heading",   true );
        $link    = get_post_meta( $post->ID, "ssd_slide{$i}_link",      true );
        ?>
        <h4><?php printf( __( 'Slide %d', 'so-so-def' ), $i ); ?></h4>
        <p>
          <label>
            <?php _e( 'Background Image URL', 'so-so-def' ); ?><br>
            <input type="text"
                   id="ssd_slide<?php echo $i; ?>_image_url"
                   name="ssd_slide<?php echo $i; ?>_image_url"
                   value="<?php echo esc_attr( $img ); ?>"
                   style="width:80%;" />
            <button class="button upload_slide_image"
                    data-target="ssd_slide<?php echo $i; ?>_image_url">
              <?php _e( 'Upload', 'so-so-def' ); ?>
            </button>
          </label>
        </p>
        <p>
          <label>
            <?php _e( 'Heading', 'so-so-def' ); ?><br>
            <input type="text"
                   name="ssd_slide<?php echo $i; ?>_heading"
                   value="<?php echo esc_attr( $heading ); ?>"
                   style="width:100%;" />
          </label>
        </p>
        <p>
          <label>
            <?php _e( 'Link URL (optional)', 'so-so-def' ); ?><br>
            <input type="text"
                   name="ssd_slide<?php echo $i; ?>_link"
                   value="<?php echo esc_attr( $link ); ?>"
                   style="width:100%;" />
          </label>
        </p>
        <hr>
        <?php
    }
}

/**
 * Save the meta box data for Homepage Slides
 */
function ssd_save_homepage_slides_meta( $post_id ) {
    if ( ! isset( $_POST['ssd_homepage_slides_nonce_field'] ) ||
         ! wp_verify_nonce( $_POST['ssd_homepage_slides_nonce_field'], 'ssd_homepage_slides_nonce' ) ) {
        return;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( get_post_type( $post_id ) !== 'page' ) return;

    for ( $i = 1; $i <= 3; $i++ ) {
        if ( isset( $_POST["ssd_slide{$i}_image_url"] ) ) {
            update_post_meta( $post_id,
                "ssd_slide{$i}_image_url",
                esc_url_raw( $_POST["ssd_slide{$i}_image_url"] )
            );
        }
        if ( isset( $_POST["ssd_slide{$i}_heading"] ) ) {
            update_post_meta( $post_id,
                "ssd_slide{$i}_heading",
                sanitize_text_field( $_POST["ssd_slide{$i}_heading"] )
            );
        }
        if ( isset( $_POST["ssd_slide{$i}_link"] ) ) {
            update_post_meta( $post_id,
                "ssd_slide{$i}_link",
                esc_url_raw( $_POST["ssd_slide{$i}_link"] )
            );
        }
    }
}
add_action( 'save_post', 'ssd_save_homepage_slides_meta' );

/**
 * Register a “Card Grid” meta box on Pages
 */
function ssd_add_card_grid_metabox() {
    add_meta_box(
        'ssd-card-grid',
        __( 'Card Grid Items', 'so-so-def' ),
        'ssd_card_grid_metabox_callback',
        'page',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'ssd_add_card_grid_metabox' );

/**
 * Render the Card Grid meta box (3 cards)
 */
function ssd_card_grid_metabox_callback( $post ) {
    wp_nonce_field( 'ssd_card_grid_nonce', 'ssd_card_grid_nonce_field' );

    for ( $i = 1; $i <= 3; $i++ ) {
        $title    = get_post_meta( $post->ID, "ssd_card{$i}_title",    true );
        $subtext  = get_post_meta( $post->ID, "ssd_card{$i}_subtext",  true );
        $img      = get_post_meta( $post->ID, "ssd_card{$i}_image",    true );
        $link     = get_post_meta( $post->ID, "ssd_card{$i}_link_url", true );
        ?>
        <h4><?php printf( __( 'Card %d', 'so-so-def' ), $i ); ?></h4>
        <p>
          <label>
            <?php _e( 'Title', 'so-so-def' ); ?><br>
            <input type="text"
                   name="ssd_card<?php echo $i; ?>_title"
                   value="<?php echo esc_attr( $title ); ?>"
                   style="width:100%;" />
          </label>
        </p>
        <p>
          <label>
            <?php _e( 'Subtext', 'so-so-def' ); ?><br>
            <input type="text"
                   name="ssd_card<?php echo $i; ?>_subtext"
                   value="<?php echo esc_attr( $subtext ); ?>"
                   style="width:100%;" />
          </label>
        </p>
        <p>
          <label>
            <?php _e( 'Image URL', 'so-so-def' ); ?><br>
            <input type="text"
                   id="ssd_card<?php echo $i; ?>_image"
                   name="ssd_card<?php echo $i; ?>_image"
                   value="<?php echo esc_attr( $img ); ?>"
                   style="width:80%;" />
            <button class="button upload_slide_image" data-target="ssd_card<?php echo $i; ?>_image">
              <?php _e( 'Upload', 'so-so-def' ); ?>
            </button>
          </label>
        </p>
        <p>
          <label>
            <?php _e( 'Link URL', 'so-so-def' ); ?><br>
            <input type="text"
                   name="ssd_card<?php echo $i; ?>_link_url"
                   value="<?php echo esc_attr( $link ); ?>"
                   style="width:100%;" />
          </label>
        </p>
        <hr>
        <?php
    }
}

/**
 * Save the Card Grid meta data
 */
function ssd_save_card_grid_meta( $post_id ) {
    if ( ! isset( $_POST['ssd_card_grid_nonce_field'] ) ||
         ! wp_verify_nonce( $_POST['ssd_card_grid_nonce_field'], 'ssd_card_grid_nonce' ) ) {
        return;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( get_post_type( $post_id ) !== 'page' ) return;

    for ( $i = 1; $i <= 3; $i++ ) {
        update_post_meta( $post_id,
            "ssd_card{$i}_title",
            sanitize_text_field( $_POST["ssd_card{$i}_title"] ?? '' )
        );
        update_post_meta( $post_id,
            "ssd_card{$i}_subtext",
            sanitize_text_field( $_POST["ssd_card{$i}_subtext"] ?? '' )
        );
        update_post_meta( $post_id,
            "ssd_card{$i}_image",
            esc_url_raw( $_POST["ssd_card{$i}_image"] ?? '' )
        );
        update_post_meta( $post_id,
            "ssd_card{$i}_link_url",
            esc_url_raw( $_POST["ssd_card{$i}_link_url"] ?? '' )
        );
    }
}
add_action( 'save_post', 'ssd_save_card_grid_meta' );

/**
 * Register “Latest Section” meta box on Pages
 */
function ssd_add_latest_section_metabox() {
    add_meta_box(
        'ssd-latest-section',
        __( 'Latest Section', 'so-so-def' ),
        'ssd_latest_section_metabox_callback',
        'page',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'ssd_add_latest_section_metabox' );

/**
 * Render the Latest Section meta box
 */
function ssd_latest_section_metabox_callback( $post ) {
    wp_nonce_field( 'ssd_latest_section_nonce', 'ssd_latest_section_nonce_field' );

    // Two cards
    for ( $i = 1; $i <= 2; $i++ ) {
        $title = get_post_meta( $post->ID, "ssd_latest_card{$i}_title", true );
        $img   = get_post_meta( $post->ID, "ssd_latest_card{$i}_image", true );
        $link  = get_post_meta( $post->ID, "ssd_latest_card{$i}_link", true );
        ?>
        <h4><?php printf( __( 'Card %d', 'so-so-def' ), $i ); ?></h4>
        <p>
          <label><?php _e( 'Title', 'so-so-def' ); ?><br>
            <input type="text"
                   name="ssd_latest_card<?php echo $i; ?>_title"
                   value="<?php echo esc_attr( $title ); ?>"
                   style="width:100%;" />
          </label>
        </p>
        <p>
          <label><?php _e( 'Image URL', 'so-so-def' ); ?><br>
            <input type="text"
                   id="ssd_latest_card<?php echo $i; ?>_image"
                   name="ssd_latest_card<?php echo $i; ?>_image"
                   value="<?php echo esc_attr( $img ); ?>"
                   style="width:80%;" />
            <button class="button upload_slide_image"
                    data-target="ssd_latest_card<?php echo $i; ?>_image">
              <?php _e( 'Upload', 'so-so-def' ); ?>
            </button>
          </label>
        </p>
        <p>
          <label><?php _e( 'Link URL', 'so-so-def' ); ?><br>
            <input type="text"
                   name="ssd_latest_card<?php echo $i; ?>_link"
                   value="<?php echo esc_attr( $link ); ?>"
                   style="width:100%;" />
          </label>
        </p>
        <hr>
        <?php
    }

    // Song embed
    $embed = get_post_meta( $post->ID, 'ssd_latest_song_embed', true );
    ?>
    <h4><?php _e( 'Song of the Week Embed', 'so-so-def' ); ?></h4>
    <p>
      <textarea name="ssd_latest_song_embed"
                style="width:100%;height:100px;"><?php echo esc_textarea( $embed ); ?></textarea><br>
      <small><?php _e( 'Paste your Spotify or Apple Music embed HTML here', 'so-so-def' ); ?></small>
    </p>
    <hr>
    <?php

    // Featured Event
    $ev_heading = get_post_meta( $post->ID, 'ssd_latest_event_heading', true );
    $ev_link    = get_post_meta( $post->ID, 'ssd_latest_event_link',    true );
    $ev_img     = get_post_meta( $post->ID, 'ssd_latest_event_image',   true );
    ?>
    <h4><?php _e( 'Featured Event', 'so-so-def' ); ?></h4>
    <p>
      <label><?php _e( 'Heading', 'so-so-def' ); ?><br>
        <input type="text"
               name="ssd_latest_event_heading"
               value="<?php echo esc_attr( $ev_heading ); ?>"
               style="width:100%;" />
      </label>
    </p>
    <p>
      <label><?php _e( 'Link URL', 'so-so-def' ); ?><br>
        <input type="text"
               name="ssd_latest_event_link"
               value="<?php echo esc_attr( $ev_link ); ?>"
               style="width:100%;" />
      </label>
    </p>
    <p>
      <label><?php _e( 'Background Image URL', 'so-so-def' ); ?><br>
        <input type="text"
               id="ssd_latest_event_image"
               name="ssd_latest_event_image"
               value="<?php echo esc_attr( $ev_img ); ?>"
               style="width:80%;" />
        <button class="button upload_slide_image"
                data-target="ssd_latest_event_image">
          <?php _e( 'Upload', 'so-so-def' ); ?>
        </button>
      </label>
    </p>
    <hr>
    <?php

    // Featured Post Teaser
    $t_img     = get_post_meta( $post->ID, 'ssd_latest_teaser_image',   true );
    $t_head    = get_post_meta( $post->ID, 'ssd_latest_teaser_heading', true );
    $t_link    = get_post_meta( $post->ID, 'ssd_latest_teaser_link',    true );
    ?>
    <h4><?php _e( 'Featured Post Teaser', 'so-so-def' ); ?></h4>
    <p>
      <label><?php _e( 'Image URL', 'so-so-def' ); ?><br>
        <input type="text"
               id="ssd_latest_teaser_image"
               name="ssd_latest_teaser_image"
               value="<?php echo esc_attr( $t_img ); ?>"
               style="width:80%;" />
        <button class="button upload_slide_image"
                data-target="ssd_latest_teaser_image">
          <?php _e( 'Upload', 'so-so-def' ); ?>
        </button>
      </label>
    </p>
    <p>
      <label><?php _e( 'Heading', 'so-so-def' ); ?><br>
        <input type="text"
               name="ssd_latest_teaser_heading"
               value="<?php echo esc_attr( $t_head ); ?>"
               style="width:100%;" />
      </label>
    </p>
    <p>
      <label><?php _e( 'Link URL', 'so-so-def' ); ?><br>
        <input type="text"
               name="ssd_latest_teaser_link"
               value="<?php echo esc_attr( $t_link ); ?>"
               style="width:100%;" />
      </label>
    </p>
    <hr>
    <?php

    // Social feed embed
    $social = get_post_meta( $post->ID, 'ssd_latest_social_embed', true );
    ?>
    <h4><?php _e( 'Social Feed Embed (optional)', 'so-so-def' ); ?></h4>
    <p>
      <textarea name="ssd_latest_social_embed"
                style="width:100%;height:100px;"><?php echo esc_textarea( $social ); ?></textarea><br>
      <small><?php _e( 'Paste your social widget code here', 'so-so-def' ); ?></small>
    </p>
    <?php
}

/**
 * Save Latest Section data
 */
function ssd_save_latest_section_meta( $post_id ) {
    if ( ! isset( $_POST['ssd_latest_section_nonce_field'] ) ||
         ! wp_verify_nonce( $_POST['ssd_latest_section_nonce_field'], 'ssd_latest_section_nonce' ) ) {
        return;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( get_post_type( $post_id ) !== 'page' ) return;

    // Two cards
    for ( $i = 1; $i <= 2; $i++ ) {
        update_post_meta( $post_id, "ssd_latest_card{$i}_title",
            sanitize_text_field( $_POST["ssd_latest_card{$i}_title"] ?? '' ) );
        update_post_meta( $post_id, "ssd_latest_card{$i}_image",
            esc_url_raw( $_POST["ssd_latest_card{$i}_image"] ?? '' ) );
        update_post_meta( $post_id, "ssd_latest_card{$i}_link",
            esc_url_raw( $_POST["ssd_latest_card{$i}_link"] ?? '' ) );
    }

    // Song embed
    update_post_meta( $post_id, 'ssd_latest_song_embed',
        wp_kses_post( $_POST['ssd_latest_song_embed'] ?? '' ) );

    // Featured Event
    update_post_meta( $post_id, 'ssd_latest_event_heading',
        sanitize_text_field( $_POST['ssd_latest_event_heading'] ?? '' ) );
    update_post_meta( $post_id, 'ssd_latest_event_link',
        esc_url_raw( $_POST['ssd_latest_event_link'] ?? '' ) );
    update_post_meta( $post_id, 'ssd_latest_event_image',
        esc_url_raw( $_POST['ssd_latest_event_image'] ?? '' ) );

    // Featured Post Teaser
    update_post_meta( $post_id, 'ssd_latest_teaser_image',
        esc_url_raw( $_POST['ssd_latest_teaser_image'] ?? '' ) );
    update_post_meta( $post_id, 'ssd_latest_teaser_heading',
        sanitize_text_field( $_POST['ssd_latest_teaser_heading'] ?? '' ) );
    update_post_meta( $post_id, 'ssd_latest_teaser_link',
        esc_url_raw( $_POST['ssd_latest_teaser_link'] ?? '' ) );

    // Social embed
    update_post_meta( $post_id, 'ssd_latest_social_embed',
        wp_kses_post( $_POST['ssd_latest_social_embed'] ?? '' ) );
}
add_action( 'save_post', 'ssd_save_latest_section_meta' );

/**
 * Enqueue the media uploader and admin script for image upload buttons
 */
function ssd_enqueue_admin_media_scripts( $hook ) {
    if ( $hook !== 'post.php' && $hook !== 'post-new.php' ) {
        return;
    }
    wp_enqueue_media();
    wp_enqueue_script(
        'ssd-admin-js',
        get_template_directory_uri() . '/assets/js/admin.js',
        [ 'jquery' ],
        '1.0',
        true
    );
}
add_action( 'admin_enqueue_scripts', 'ssd_enqueue_admin_media_scripts' );
