<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package so-so-def
 */

get_header();
?>

<main id="content">

	<?php if ( have_posts() ) : ?>

		<!-- Archive Grid Section - Roc Nation Style -->
		<section class="archive-grid section" data-aos="fade-up">
			<div class="container">
				<div class="archive-grid__inner">
					
					<!-- Archive Title (Simple) -->
					<header class="archive-simple-header">
						<?php
						$archive_title = get_the_archive_title();
						?>
						<h1 class="archive-simple-title"><?php echo wp_kses_post( $archive_title ); ?></h1>
					</header>

					<div class="archive-grid__grid">
						<?php
						$post_count = 0;
						$is_first_post = true;
						while ( have_posts() ) :
							the_post();
							$post_count++;
							$post_categories = get_the_category();
							$category_classes = '';
							if ( $post_categories ) {
								$category_slugs = array_map( function( $cat ) { return $cat->slug; }, $post_categories );
								$category_classes = implode( ' ', $category_slugs );
							}
						?>
							<article 
								class="archive-grid__item <?php echo esc_attr( $category_classes ); ?> <?php echo $is_first_post ? 'archive-grid__item--featured' : ''; ?>"
								data-aos="fade-up"
								data-aos-delay="<?php echo esc_attr( ( $post_count % 6 ) * 50 ); ?>"
							>
								<div class="archive-card <?php echo $is_first_post ? 'archive-card--featured' : ''; ?>">
									<a class="archive-card__anchor" href="<?php the_permalink(); ?>">
										
										<?php if ( has_post_thumbnail() ) : ?>
											<div class="archive-card__image media-container media-container--cover">
												<?php the_post_thumbnail(
													$is_first_post ? 'full' : 'large',
													[ 'class' => 'media-container__media', 'alt' => get_the_title() ]
												); ?>
											</div>
										<?php endif; ?>

										<div class="archive-card__content">
											<?php if ( $post_categories ) : ?>
												<div class="archive-card__category">
													<?php echo esc_html( $post_categories[0]->name ); ?>
												</div>
											<?php endif; ?>

											<h2 class="archive-card__title"><?php the_title(); ?></h2>

											<?php if ( !$is_first_post ) : ?>
												<div class="archive-card__excerpt">
													<?php 
													$excerpt = get_the_excerpt();
													echo wp_trim_words( $excerpt, 20, '...' );
													?>
												</div>
											<?php endif; ?>

											<div class="archive-card__meta">
												<time class="archive-card__date" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
													<?php echo esc_html( get_the_date() ); ?>
												</time>
												<span class="archive-card__learn-more">
													<?php esc_html_e( 'Learn More', 'so-so-def' ); ?>
													<svg aria-hidden="true" class="archive-card__icon" viewBox="0 0 11 8">
														<line stroke="currentColor" stroke-width="0.5" x1="1" x2="10" y1="3.5" y2="3.5"></line>
														<polyline stroke="currentColor" stroke-width="0.5" points="7,0 10,3.5 7,7"></polyline>
													</svg>
												</span>
											</div>
										</div>
									</a>
								</div>
							</article>
						<?php 
							$is_first_post = false;
						endwhile; ?>
					</div>

					<!-- Load More Button -->
					<?php if ( get_next_posts_link() ) : ?>
						<div class="archive-grid__load-more" data-aos="fade-up">
							<button class="load-more-btn">
								<?php esc_html_e( 'Load More', 'so-so-def' ); ?>
							</button>
						</div>
					<?php endif; ?>

				</div>
			</div>
		</section>

	<?php else : ?>

		<section class="no-posts section">
			<div class="container">
				<div class="no-posts__inner" data-aos="fade-up">
					<h2><?php esc_html_e( 'Nothing here', 'so-so-def' ); ?></h2>
					<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try a search?', 'so-so-def' ); ?></p>
					<?php get_search_form(); ?>
				</div>
			</div>
		</section>

	<?php endif; ?>

</main>

<?php get_footer(); ?>
