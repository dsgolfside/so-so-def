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
    register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'so-so-def' ),
        'footer'  => __( 'Footer Menu', 'so-so-def' ),
    ) );
}

/**
 * Hide WordPress admin bar on frontend
 */
function ssd_hide_admin_bar() {
    if ( ! current_user_can( 'administrator' ) ) {
        show_admin_bar( false );
    }
    // Hide for everyone on frontend to see full header design
    show_admin_bar( false );
}
add_action( 'after_setup_theme', 'ssd_theme_setup' );
add_action( 'after_setup_theme', 'ssd_hide_admin_bar' );

/**
 * Register the "Homepage Slides" meta box on Pages
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
 * Register the "Page Hero Slides" meta box on Pages
 */
function ssd_add_page_hero_slides_metabox() {
    add_meta_box(
        'ssd-page-hero-slides',
        __( 'Page Hero Slides', 'so-so-def' ),
        'ssd_page_hero_slides_metabox_callback',
        'page',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'ssd_add_page_hero_slides_metabox' );

/**
 * Register the "Post Hero Slides" meta box on Posts
 */
function ssd_add_post_hero_slides_metabox() {
    add_meta_box(
        'ssd-post-hero-slides',
        __( 'Post Hero Slides', 'so-so-def' ),
        'ssd_page_hero_slides_metabox_callback', // Use same callback as pages
        'post',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'ssd_add_post_hero_slides_metabox' );

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
 * Render the Page Hero Slides meta box fields
 */
function ssd_page_hero_slides_metabox_callback( $post ) {
    wp_nonce_field( 'ssd_page_hero_slides_nonce', 'ssd_page_hero_slides_nonce_field' );
    
    echo '<p><strong>Note:</strong> If you add slides below, your featured image becomes a fallback. If no slides are added, your featured image will show with the page title.</p>';
    
    for ( $i = 1; $i <= 5; $i++ ) {
        $slide_type = get_post_meta( $post->ID, "slide_{$i}_type", true );
        $slide_title = get_post_meta( $post->ID, "slide_{$i}_title", true );
        $slide_subtitle = get_post_meta( $post->ID, "slide_{$i}_subtitle", true );
        $slide_image = get_post_meta( $post->ID, "slide_{$i}_image", true );
        $slide_youtube = get_post_meta( $post->ID, "slide_{$i}_youtube", true );
        
        // Social media fields
        $slide_instagram = get_post_meta( $post->ID, "slide_{$i}_instagram", true );
        $slide_spotify = get_post_meta( $post->ID, "slide_{$i}_spotify", true );
        $slide_youtube_social = get_post_meta( $post->ID, "slide_{$i}_youtube_social", true );
        $slide_twitter = get_post_meta( $post->ID, "slide_{$i}_twitter", true );
        $slide_tiktok = get_post_meta( $post->ID, "slide_{$i}_tiktok", true );
        $slide_soundcloud = get_post_meta( $post->ID, "slide_{$i}_soundcloud", true );
        $slide_apple_music = get_post_meta( $post->ID, "slide_{$i}_apple_music", true );
        $slide_website = get_post_meta( $post->ID, "slide_{$i}_website", true );
        ?>
        <div style="border: 1px solid #ddd; padding: 15px; margin: 10px 0; background: #f9f9f9;">
            <h4><?php printf( __( 'Additional Slide %d', 'so-so-def' ), $i ); ?></h4>
            
            <p>
                <label>
                    <?php _e( 'Slide Type', 'so-so-def' ); ?><br>
                    <select name="slide_<?php echo $i; ?>_type" style="width: 200px;">
                        <option value=""><?php _e( 'Select slide type...', 'so-so-def' ); ?></option>
                        <option value="image" <?php selected( $slide_type, 'image' ); ?>><?php _e( 'Image Slide', 'so-so-def' ); ?></option>
                        <option value="youtube" <?php selected( $slide_type, 'youtube' ); ?>><?php _e( 'YouTube Video', 'so-so-def' ); ?></option>
                        <option value="artist" <?php selected( $slide_type, 'artist' ); ?>><?php _e( 'Artist (with social icons)', 'so-so-def' ); ?></option>
                    </select>
                </label>
            </p>
            
            <p>
                <label>
                    <?php _e( 'Slide Title', 'so-so-def' ); ?><br>
                    <input type="text" name="slide_<?php echo $i; ?>_title" value="<?php echo esc_attr( $slide_title ); ?>" style="width: 100%;" />
                </label>
            </p>
            
            <p>
                <label>
                    <?php _e( 'Slide Subtitle', 'so-so-def' ); ?><br>
                    <input type="text" name="slide_<?php echo $i; ?>_subtitle" value="<?php echo esc_attr( $slide_subtitle ); ?>" style="width: 100%;" />
                </label>
            </p>
            
            <div class="slide-type-fields">
                <!-- Image/Artist Image Field -->
                <p class="image-field artist-field" style="display: <?php echo in_array( $slide_type, ['image', 'artist'] ) ? 'block' : 'none'; ?>;">
                    <label>
                        <?php _e( 'Background Image URL', 'so-so-def' ); ?><br>
                        <input type="text" name="slide_<?php echo $i; ?>_image" value="<?php echo esc_attr( $slide_image ); ?>" style="width: 80%;" />
                        <button type="button" class="button upload_slide_image" data-target="slide_<?php echo $i; ?>_image">
                            <?php _e( 'Upload', 'so-so-def' ); ?>
                        </button>
                    </label>
                </p>
                
                <!-- YouTube Field -->
                <p class="youtube-field" style="display: <?php echo ( $slide_type == 'youtube' ) ? 'block' : 'none'; ?>;">
                    <label>
                        <?php _e( 'YouTube URL', 'so-so-def' ); ?><br>
                        <input type="url" name="slide_<?php echo $i; ?>_youtube" value="<?php echo esc_attr( $slide_youtube ); ?>" style="width: 100%;" />
                        <small>Any YouTube URL format works: https://youtu.be/VIDEO_ID or https://www.youtube.com/watch?v=VIDEO_ID</small>
                    </label>
                </p>
                
                <!-- Social Media Fields (for Artist type) -->
                <div class="social-fields" style="display: <?php echo ( $slide_type == 'artist' ) ? 'block' : 'none'; ?>;">
                    <h5><?php _e( 'Social Media Links (optional)', 'so-so-def' ); ?></h5>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px;">
                        <label>
                            Instagram<br>
                            <input type="url" name="slide_<?php echo $i; ?>_instagram" value="<?php echo esc_attr( $slide_instagram ); ?>" style="width: 100%;" />
                        </label>
                        <label>
                            Spotify<br>
                            <input type="url" name="slide_<?php echo $i; ?>_spotify" value="<?php echo esc_attr( $slide_spotify ); ?>" style="width: 100%;" />
                        </label>
                        <label>
                            YouTube<br>
                            <input type="url" name="slide_<?php echo $i; ?>_youtube_social" value="<?php echo esc_attr( $slide_youtube_social ); ?>" style="width: 100%;" />
                        </label>
                        <label>
                            Twitter<br>
                            <input type="url" name="slide_<?php echo $i; ?>_twitter" value="<?php echo esc_attr( $slide_twitter ); ?>" style="width: 100%;" />
                        </label>
                        <label>
                            TikTok<br>
                            <input type="url" name="slide_<?php echo $i; ?>_tiktok" value="<?php echo esc_attr( $slide_tiktok ); ?>" style="width: 100%;" />
                        </label>
                        <label>
                            SoundCloud<br>
                            <input type="url" name="slide_<?php echo $i; ?>_soundcloud" value="<?php echo esc_attr( $slide_soundcloud ); ?>" style="width: 100%;" />
                        </label>
                        <label>
                            Apple Music<br>
                            <input type="url" name="slide_<?php echo $i; ?>_apple_music" value="<?php echo esc_attr( $slide_apple_music ); ?>" style="width: 100%;" />
                        </label>
                        <label>
                            Website<br>
                            <input type="url" name="slide_<?php echo $i; ?>_website" value="<?php echo esc_attr( $slide_website ); ?>" style="width: 100%;" />
                        </label>
                    </div>
                </div>
            </div>
        </div>
        
        
        <?php
    }
    ?>
    
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Handle all slide type dropdowns
        document.querySelectorAll('select[name^="slide_"]').forEach(function(select) {
            if (select.name.includes('_type')) {
                const slideContainer = select.closest('div[style*="border"]'); // The slide container div
                
                function toggleFields() {
                    const selectedType = select.value;
                    
                    // Hide all type-specific fields
                    slideContainer.querySelectorAll('.image-field, .youtube-field, .artist-field, .social-fields').forEach(field => {
                        field.style.display = 'none';
                    });
                    
                    // Show relevant fields based on selection
                    if (selectedType === 'image') {
                        const imageField = slideContainer.querySelector('.image-field');
                        if (imageField) imageField.style.display = 'block';
                    } else if (selectedType === 'youtube') {
                        const youtubeField = slideContainer.querySelector('.youtube-field');
                        if (youtubeField) youtubeField.style.display = 'block';
                    } else if (selectedType === 'artist') {
                        const artistField = slideContainer.querySelector('.artist-field');
                        const socialFields = slideContainer.querySelector('.social-fields');
                        if (artistField) artistField.style.display = 'block';
                        if (socialFields) socialFields.style.display = 'block';
                    }
                }
                
                // Set initial state
                toggleFields();
                
                // Handle changes
                select.addEventListener('change', toggleFields);
            }
        });
    });
    </script>
    
    <?php
}

/**
 * Save the Page Hero Slides meta box data
 */
function ssd_save_page_hero_slides_meta( $post_id ) {
    if ( ! isset( $_POST['ssd_page_hero_slides_nonce_field'] ) ||
         ! wp_verify_nonce( $_POST['ssd_page_hero_slides_nonce_field'], 'ssd_page_hero_slides_nonce' ) ) {
        return;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! in_array( get_post_type( $post_id ), ['page', 'post'] ) ) return;

    $fields = [
        'type', 'title', 'subtitle', 'image', 'youtube', 'youtube_social',
        'instagram', 'spotify', 'twitter', 'tiktok', 
        'soundcloud', 'apple_music', 'website'
    ];

    for ( $i = 1; $i <= 5; $i++ ) {
        foreach ( $fields as $field ) {
            $field_name = "slide_{$i}_{$field}";
            if ( isset( $_POST[$field_name] ) ) {

                if ( in_array( $field, ['youtube', 'youtube_social', 'instagram', 'spotify', 'twitter', 'tiktok', 'soundcloud', 'apple_music', 'website', 'image'] ) ) {
                    update_post_meta( $post_id, $field_name, esc_url_raw( $_POST[$field_name] ) );
                } else {
                    update_post_meta( $post_id, $field_name, sanitize_text_field( $_POST[$field_name] ) );
                }
            }
        }
    }
}
add_action( 'save_post', 'ssd_save_page_hero_slides_meta' );

/**
 * Register a "Card Grid" meta box on Pages
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
 * Register "Latest Section" meta box on Pages
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

/**
 * Add proper referrer policy to fix console warnings
 */
function ssd_add_referrer_policy() {
    echo '<meta name="referrer" content="strict-origin-when-cross-origin">' . "\n";
}
add_action( 'wp_head', 'ssd_add_referrer_policy', 1 );

/**
 * Also set the HTTP header for extra security
 */
function ssd_send_referrer_policy_header() {
    if ( ! headers_sent() ) {
        header( 'Referrer-Policy: strict-origin-when-cross-origin' );
    }
}
add_action( 'send_headers', 'ssd_send_referrer_policy_header' );

/* this stuff below is to hide certain things from non -admins in the wordpress admin */

// this hides nags in admin from everyone but admins
add_action('admin_head', function() {
  if (!current_user_can('administrator')) {
    echo '<style>
      .notice,
      .update-nag,
      .updated,
      .error,
      .is-dismissible {
        display: none !important;
      }
    </style>';
  }
});

//this should redirect away from the profile page especially useful since it defaults to here if you disable the dashboard with adminimize
add_action('admin_init', function() {
  if (current_user_can('author') && !current_user_can('administrator')) {
    $request = $_SERVER['REQUEST_URI'];
    if (strpos($request, 'profile.php') !== false || rtrim($request, '/') === '/wp-admin') {
      wp_redirect(admin_url('edit.php'));
      exit;
    }
  }
});

//remove profile menu for non admins
add_action('admin_menu', function() {
  if (!current_user_can('administrator')) {
    remove_menu_page('profile.php');
  }
});

// hide yoast seo stuff from admin post list for non admins
add_filter('manage_edit-post_columns', function($columns) {
  if (!current_user_can('administrator')) {
    unset($columns['wpseo-score']);              // SEO score
    unset($columns['wpseo-score-readability']);  // Readability
    unset($columns['wpseo-title']);              // SEO title
    unset($columns['wpseo-metadesc']);           // Meta description
    unset($columns['wpseo-focuskw']);            // Focus keyphrase
    unset($columns['wpseo-links']);              // Outgoing internal links ✅
  }
  return $columns;
});
//Restrict Classic Editor to Authors Only (optional)
add_filter('use_block_editor_for_post', function($use_block_editor, $post) {
  // Disable block editor for all non-admins
  return current_user_can('administrator');
}, 10, 2);
//Hide Unnecessary Metaboxes for Authors
add_action('admin_head', function() {
  if (current_user_can('author') && !current_user_can('administrator')) {
    echo '<style>
      #yoast-seo-meta-box,  /* Yoast SEO */
      #astra_settings_meta_box,  /* Astra settings */
      #spectra-page-settings,  /* Spectra settings */
      #postexcerpt,  /* Excerpt box */
      #trackbacksdiv,  /* Trackbacks */
      #postcustom,  /* Custom Fields */
      #slugdiv,     /* Slug */
      #commentstatusdiv,  /* Discussion */
      #commentsdiv { display: none !important; }
    </style>';
  }
});
// remove format box for authors
add_action('admin_menu', function() {
  if (current_user_can('author') && !current_user_can('administrator')) {
    remove_meta_box('formatdiv', 'post', 'side');
  }
});
// hide screen options for non admins
add_action('admin_head', function() {
  if (!current_user_can('administrator')) {
    echo '<style>
      #screen-meta-links {
        display: none !important;
      }
    </style>';
  }
});
// remove categories box for authors
add_action('admin_menu', function() {
  if (!current_user_can('editor')) {
    remove_meta_box('categorydiv', 'post', 'side');
  }
});
// remove tags box from post editing for authors
add_action('admin_menu', function() {
  if (current_user_can('author') && !current_user_can('administrator')) {
    remove_meta_box('tagsdiv-post_tag', 'post', 'side');
  }
});
// hide footer for authors
add_action('admin_head', function() {
  if (current_user_can('author') && !current_user_can('administrator')) {
    echo '<style>#wpfooter { display: none !important; }</style>';
  }
});
function jj_remove_edit_profile_link_for_non_admins($wp_admin_bar) {
  if (!current_user_can('manage_options')) {
    $wp_admin_bar->remove_node('edit-profile');
  }
}
add_action('admin_bar_menu', 'jj_remove_edit_profile_link_for_non_admins', 999);

/**
 * Completely disable comments across the entire site
 */
// Disable support for comments and trackbacks in post types
function disable_comments_post_types_support() {
    $post_types = get_post_types();
    foreach ($post_types as $post_type) {
        if(post_type_supports($post_type, 'comments')) {
            remove_post_type_support($post_type, 'comments');
            remove_post_type_support($post_type, 'trackbacks');
        }
    }
}
add_action('admin_init', 'disable_comments_post_types_support');

// Close comments on the front-end
function disable_comments_status() {
    return false;
}
add_filter('comments_open', 'disable_comments_status', 20, 2);
add_filter('pings_open', 'disable_comments_status', 20, 2);

// Hide existing comments
function disable_comments_hide_existing_comments($comments) {
    $comments = array();
    return $comments;
}
add_filter('comments_array', 'disable_comments_hide_existing_comments', 10, 2);

// Remove comments page in menu
function disable_comments_admin_menu() {
    remove_menu_page('edit-comments.php');
}
add_action('admin_menu', 'disable_comments_admin_menu');

// Redirect any user trying to access comments page
function disable_comments_admin_menu_redirect() {
    global $pagenow;
    if ($pagenow === 'edit-comments.php') {
        wp_redirect(admin_url()); exit;
    }
}
add_action('admin_init', 'disable_comments_admin_menu_redirect');

// Remove comments metabox from dashboard
function disable_comments_dashboard() {
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
}
add_action('admin_init', 'disable_comments_dashboard');

// Remove comments links from admin bar
function disable_comments_admin_bar() {
    if (is_admin_bar_showing()) {
        remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
    }
}
add_action('init', 'disable_comments_admin_bar');
