<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package _s
 */

get_header();
?>

<main id="primary" class="site-main">
	<?php while ( have_posts() ) : ?>
		<?php the_post(); ?>
		
		<?php
		// Check if there are any additional slides first
		$has_additional_slides = false;
		for ( $i = 1; $i <= 5; $i++ ) {
			$slide_type = get_post_meta( get_the_ID(), "slide_{$i}_type", true );
			if ( $slide_type ) {
				$has_additional_slides = true;
				break;
			}
		}
		
		// Check if user wants to show featured image in header
		$show_featured_image = get_post_meta( get_the_ID(), 'show_featured_image_in_header', true );
		$has_featured_image = $show_featured_image && has_post_thumbnail();
		
		// Only show header section if there are slides OR featured image is enabled
		if ( $has_additional_slides || $has_featured_image ) : ?>
		<!-- Page Hero Swiper -->
		<section class="hero page-hero-swiper swiper-container" data-aos="fade">
			<div class="swiper-wrapper">
				
				<?php
				// Only show default slide if no additional slides exist but featured image is enabled
				if ( !$has_additional_slides && $has_featured_image ) : ?>
					<!-- Featured Image slide -->
					<div class="swiper-slide">
						<div class="slide-content">
							<div class="slide-background">
								<?php the_post_thumbnail( 'full', array( 'class' => 'slide-bg-image' ) ); ?>
							</div>
						</div>
					</div>
				<?php endif; ?>
				
				<!-- Additional slides via WordPress Custom Fields -->
				<?php
				// Check for additional slides (slide_1, slide_2, slide_3, etc.)
				for ( $i = 1; $i <= 5; $i++ ) {
					$slide_type = get_post_meta( get_the_ID(), "slide_{$i}_type", true );
					
					if ( $slide_type ) {
						$slide_title = get_post_meta( get_the_ID(), "slide_{$i}_title", true );
						$slide_subtitle = get_post_meta( get_the_ID(), "slide_{$i}_subtitle", true );
						?>
						<div class="swiper-slide">
							<div class="slide-content">
								
								<?php if ( $slide_type == 'youtube' ) : ?>
									<!-- YouTube Video Slide -->
									<?php $youtube_url = get_post_meta( get_the_ID(), "slide_{$i}_youtube", true ); ?>

									<?php if ( $youtube_url ) : ?>
										<div class="slide-youtube">
											<?php
											// Convert various YouTube URL formats to embed URL and handle playlists
											$video_id = '';
											$playlist_id = '';
											$embed_url = '';
											
											// Extract video ID
											if ( preg_match( '/(?:youtube\.com\/watch\?v=|youtu\.be\/|youtube\.com\/embed\/)([a-zA-Z0-9_-]{11})/', $youtube_url, $matches ) ) {
												$video_id = $matches[1];
												$embed_url = 'https://www.youtube.com/embed/' . $video_id;
											} else {
												// Fallback - use URL as is but ensure it's an embed URL
												$embed_url = str_replace( array( 'youtu.be/', 'youtube.com/watch?v=' ), array( 'youtube.com/embed/', 'youtube.com/embed/' ), $youtube_url );
												$embed_url = preg_replace( '/[&?].*/', '', $embed_url ); // Remove parameters from original URL
											}
											
											// Extract playlist ID if present
											if ( preg_match( '/[?&]list=([a-zA-Z0-9_-]+)/', $youtube_url, $playlist_matches ) ) {
												$playlist_id = $playlist_matches[1];
											}
											?>
											<iframe src="<?php echo esc_url( $embed_url ); ?>?autoplay=1&mute=1&controls=1&showinfo=0&rel=0&iv_load_policy=3&modestbranding=1&fs=1<?php 
												// If we have a playlist, use it and don't loop (let playlist progress naturally)
												if ( $playlist_id ) {
													echo '&list=' . esc_attr( $playlist_id );
												} else if ( $video_id ) {
													// Single video - loop it
													echo '&loop=1&playlist=' . esc_attr( $video_id );
												}
											?>" 
													frameborder="0" 
													allow="autoplay; encrypted-media" 
													allowfullscreen></iframe>
										</div>
																	<?php endif; ?>
								
								<?php elseif ( $slide_type === 'cloudflare' ) : ?>
									<?php
										$cloudflare_url = get_post_meta( get_the_ID(), "slide_{$i}_cloudflare", true );
										if ( $cloudflare_url ) :
											// Try to extract customer code & UID; fallback to raw URL otherwise
											if ( preg_match(
													'#^https://customer-([^.]+)\.cloudflarestream\.com/([^/?]+)/iframe#',
													$cloudflare_url,
													$matches
												) ) {
												$final_url = sprintf(
													'https://customer-%s.cloudflarestream.com/%s/iframe?autoplay=true&muted=true&controls=true&loop=true',
													esc_attr( $matches[1] ),
													esc_attr( $matches[2] )
												);
											} else {
												// If someone pasted the iframe URL with params already, use it
												$final_url = esc_url( $cloudflare_url );
											}
									?>
										<div class="slide-cloudflare">
											<div style="position:relative; width:100%; padding-top:56.25%;">
												<iframe src="<?php echo $final_url; ?>" 
													style="position:absolute; top:0; left:0; width:100%; height:100%; border:none;"
													allow="autoplay; encrypted-media" 
													allowfullscreen></iframe>
											</div>
										</div>
									<?php endif; ?>
								
								<?php elseif ( $slide_type == 'image' ) : ?>
									<!-- Image Slide -->
									<?php $image_url = get_post_meta( get_the_ID(), "slide_{$i}_image", true ); ?>
									<?php if ( $image_url ) : ?>
										<div class="slide-background">
											<img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $slide_title ); ?>" class="slide-bg-image" />
										</div>
									<?php endif; ?>
									
								<?php elseif ( $slide_type == 'artist' ) : ?>
									<!-- Artist Image Slide with Social Icons -->
									<?php $artist_image = get_post_meta( get_the_ID(), "slide_{$i}_image", true ); ?>
									<?php if ( $artist_image ) : ?>
										<div class="slide-background">
											<img src="<?php echo esc_url( $artist_image ); ?>" alt="<?php echo esc_attr( $slide_title ); ?>" class="slide-bg-image" />
										</div>
									<?php endif; ?>
									
								<?php endif; ?>
								
								<!-- Slide Overlay Content (only show if there's title or subtitle) -->
								<?php if ( $slide_title || $slide_subtitle ) : ?>
									<div class="slide-overlay">
										<div class="slide-text-content">
											<?php if ( $slide_title ) : ?>
												<h2 class="slide-title"><?php echo esc_html( $slide_title ); ?></h2>
											<?php endif; ?>
											<?php if ( $slide_subtitle ) : ?>
												<p class="slide-subtitle"><?php echo esc_html( $slide_subtitle ); ?></p>
											<?php endif; ?>
										
										<!-- Social Icons (for artist slides) -->
										<?php if ( $slide_type == 'artist' ) : ?>
											<div class="artist-social-section">
												<div class="social-heading">Follow Artist</div>
												<div class="slide-social-icons">
													<?php 
													$social_links = array(
														'instagram' => array('icon' => 'fab fa-instagram', 'label' => 'Instagram'),
														'tiktok' => array('icon' => 'fab fa-tiktok', 'label' => 'TikTok'),
														'twitter' => array('icon' => 'fab fa-twitter', 'label' => 'Twitter'),
														'website' => array('icon' => 'fas fa-globe', 'label' => 'Website'),
														'spotify' => array('icon' => 'fab fa-spotify', 'label' => 'Spotify'),
														'youtube' => array('icon' => 'fab fa-youtube', 'label' => 'YouTube'),
														'apple_music' => array('icon' => 'fab fa-apple', 'label' => 'Apple Music'),
														'soundcloud' => array('icon' => 'fab fa-soundcloud', 'label' => 'SoundCloud')
													);
													
													foreach ( $social_links as $platform => $data ) {
														$social_url = get_post_meta( get_the_ID(), "slide_{$i}_{$platform}", true );
														if ( $social_url ) : ?>
															<a href="<?php echo esc_url( $social_url ); ?>" target="_blank" rel="noopener" class="social-icon" title="<?php echo esc_attr( $data['label'] ); ?>">
																<i class="<?php echo esc_attr( $data['icon'] ); ?>"></i>
															</a>
														<?php endif;
													}
													?>
												</div>
											</div>
										<?php endif; ?>
									</div>
								</div>
								<?php endif; ?>
							</div>
						</div>
						<?php
					}
				}
				?>
				
			</div>

			<!-- Swiper controls (only show if more than 1 slide) -->
			<?php 
			$total_slides = 0;
			
			// Count featured image slide (only if enabled and no additional slides)
			if ( !$has_additional_slides && $has_featured_image ) {
				$total_slides++;
			}
			
			// Count additional slides
			for ( $i = 1; $i <= 5; $i++ ) {
				$slide_type = get_post_meta( get_the_ID(), "slide_{$i}_type", true );
				if ( $slide_type ) {
					$total_slides++;
				}
			}
			?>
			
			<?php if ( $total_slides > 1 ) : ?>
				<!-- Navigation arrows -->
				<div class="swiper-button-prev"></div>
				<div class="swiper-button-next"></div>
				
				<!-- Pagination dots -->
				<div class="swiper-pagination"></div>
			<?php endif; ?>
		</section>
		<?php endif; // End header section conditional ?>

		<!-- Single Post Content -->
		<section class="page-content">
			<div class="page-content__container">
				<div class="page-content__wrapper">
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<div class="entry-content">
							<header class="entry-header">
								<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
								
								<div class="entry-meta">
									<?php
									$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
									if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
										$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
									}

									$time_string = sprintf(
										$time_string,
										esc_attr( get_the_date( DATE_W3C ) ),
										esc_html( get_the_date() ),
										esc_attr( get_the_modified_date( DATE_W3C ) ),
										esc_html( get_the_modified_date() )
									);

									$posted_on = sprintf(
										/* translators: %s: post date. */
										esc_html_x( 'Posted on %s', 'post date', '_s' ),
										'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
									);

									echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.
									?>
								</div><!-- .entry-meta -->
							</header><!-- .entry-header -->

							<?php the_content(); ?>

							<?php
							wp_link_pages(
								array(
									'before' => '<div class="page-links">' . esc_html__( 'Pages:', '_s' ),
									'after'  => '</div>',
								)
							);
							?>
						</div><!-- .entry-content -->

						<footer class="entry-footer">
							<?php
							$categories_list = get_the_category_list( esc_html__( ', ', '_s' ) );
							if ( $categories_list ) {
								/* translators: 1: list of categories. */
								printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', '_s' ) . '</span>', $categories_list ); // WPCS: XSS OK.
							}

							$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', '_s' ) );
							if ( $tags_list ) {
								/* translators: 1: list of tags. */
								printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', '_s' ) . '</span>', $tags_list ); // WPCS: XSS OK.
							}

							if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
								echo '<span class="comments-link">';
								comments_popup_link(
									sprintf(
										wp_kses(
											/* translators: %s: post title */
											__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', '_s' ),
											array(
												'span' => array(
													'class' => array(),
												),
											)
										),
										wp_kses_post( get_the_title() )
									)
								);
								echo '</span>';
							}

							edit_post_link(
								sprintf(
									wp_kses(
										/* translators: %s: Name of current post. Only visible to screen readers */
										__( 'Edit <span class="screen-reader-text">%s</span>', '_s' ),
										array(
											'span' => array(
												'class' => array(),
											),
										)
									),
									wp_kses_post( get_the_title() )
								),
								'<span class="edit-link">',
								'</span>'
							);
							?>
						</footer><!-- .entry-footer -->
					</article><!-- #post-<?php the_ID(); ?> -->
				</div>
			</div>
		</section>

		<?php
		the_post_navigation(
			array(
				'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', '_s' ) . '</span> <span class="nav-title">%title</span>',
				'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', '_s' ) . '</span> <span class="nav-title">%title</span>',
			)
		);

		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) :
			comments_template();
		endif;
		?>

	<?php endwhile; ?>
</main>

<?php
get_footer();
