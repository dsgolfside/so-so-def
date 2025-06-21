<?php
/**
 * The template for displaying all pages
 */

get_header(); ?>

<main id="primary" class="site-main">
	<?php while ( have_posts() ) : ?>
		<?php the_post(); ?>
		
		<!-- Page Hero Swiper -->
		<section class="hero page-hero-swiper swiper-container" data-aos="fade">
			<div class="swiper-wrapper">
				
				<!-- Default slide with featured image or fallback -->
				<div class="swiper-slide">
					<div class="slide-content">
						<?php if ( has_post_thumbnail() ) : ?>
							<!-- Featured Image Background -->
							<div class="slide-background">
								<?php the_post_thumbnail( 'full', array( 'class' => 'slide-bg-image' ) ); ?>
							</div>
						<?php else : ?>
							<!-- Fallback Background -->
							<div class="slide-background">
								<img src="<?php echo get_template_directory_uri(); ?>/assets/images/GENERAL-scaled.jpg" alt="Default background" class="slide-bg-image" />
							</div>
						<?php endif; ?>
						
						<!-- Slide Overlay Content -->
						<div class="slide-overlay">
							<div class="slide-text-content">
								<h1 class="slide-title"><?php the_title(); ?></h1>
								<?php if ( get_the_excerpt() ) : ?>
									<p class="slide-subtitle"><?php the_excerpt(); ?></p>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
				
				<!-- Additional slides can be added here via ACF or custom fields -->
				<?php
				// Example: If you have ACF fields for additional slides
				if ( function_exists('get_field') ) {
					$additional_slides = get_field('hero_slides');
					if ( $additional_slides ) {
						foreach ( $additional_slides as $slide ) {
							?>
							<div class="swiper-slide">
								<div class="slide-content">
									<?php if ( $slide['slide_type'] == 'youtube' && $slide['youtube_url'] ) : ?>
										<!-- YouTube Video Slide -->
										<div class="slide-youtube">
											<iframe src="<?php echo esc_url( $slide['youtube_url'] ); ?>?autoplay=1&mute=1&loop=1&controls=0&showinfo=0&rel=0&iv_load_policy=3&modestbranding=1" 
													frameborder="0" 
													allow="autoplay; encrypted-media" 
													allowfullscreen></iframe>
										</div>
									<?php elseif ( $slide['background_image'] ) : ?>
										<!-- Image Slide -->
										<div class="slide-background">
											<img src="<?php echo esc_url( $slide['background_image']['url'] ); ?>" alt="<?php echo esc_attr( $slide['background_image']['alt'] ); ?>" class="slide-bg-image" />
										</div>
									<?php endif; ?>
									
									<!-- Slide Overlay Content -->
									<div class="slide-overlay">
										<div class="slide-text-content">
											<?php if ( $slide['title'] ) : ?>
												<h2 class="slide-title"><?php echo esc_html( $slide['title'] ); ?></h2>
											<?php endif; ?>
											<?php if ( $slide['subtitle'] ) : ?>
												<p class="slide-subtitle"><?php echo esc_html( $slide['subtitle'] ); ?></p>
											<?php endif; ?>
											
											<!-- Social Icons (for artist pages) -->
											<?php if ( $slide['social_icons'] ) : ?>
												<div class="slide-social-icons">
													<?php foreach ( $slide['social_icons'] as $icon ) : ?>
														<a href="<?php echo esc_url( $icon['url'] ); ?>" target="_blank" rel="noopener" class="social-icon">
															<i class="<?php echo esc_attr( $icon['icon_class'] ); ?>"></i>
														</a>
													<?php endforeach; ?>
												</div>
											<?php endif; ?>
										</div>
									</div>
								</div>
							</div>
							<?php
						}
					}
				}
				?>
				
			</div>

			<!-- Swiper controls (only show if more than 1 slide) -->
			<?php 
			$total_slides = 1; // Default slide
			if ( function_exists('get_field') ) {
				$additional_slides = get_field('hero_slides');
				if ( $additional_slides ) {
					$total_slides += count( $additional_slides );
				}
			}
			if ( $total_slides > 1 ) : ?>
				<div class="swiper-button-prev"></div>
				<div class="swiper-button-next"></div>
				<div class="swiper-pagination"></div>
			<?php endif; ?>
		</section>

		<!-- Page Content -->
		<section class="page-content">
			<div class="page-content__container">
				<div class="page-content__wrapper">
					<?php the_content(); ?>
					
					<?php
					wp_link_pages(
						array(
							'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'so-so-def' ),
							'after'  => '</div>',
						)
					);
					?>
				</div>
			</div>
		</section>

		<?php
		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) :
			comments_template();
		endif;
		?>

	<?php endwhile; ?>
</main>

<?php
get_footer();
