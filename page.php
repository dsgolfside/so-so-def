<?php
/**
 * The template for displaying all pages
 */

get_header(); ?>

<main id="primary" class="site-main">
	<?php while ( have_posts() ) : ?>
		<?php the_post(); ?>
		
				<!-- Page Hero Section -->
		<section class="page-hero">
			<!-- Breadcrumb Navigation -->
			<div class="page-breadcrumb">
				<nav class="breadcrumb-nav" aria-label="Breadcrumb">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a>
					<span class="breadcrumb-separator">›</span>
					<span class="breadcrumb-current"><?php the_title(); ?></span>
				</nav>
			</div>
			
			<div class="page-hero__content">
				<div class="page-hero__image">
					<?php if ( has_post_thumbnail() ) : ?>
						<?php the_post_thumbnail( 'full', array( 'class' => 'page-hero__featured-image' ) ); ?>
					<?php else : ?>
						<div class="page-hero__placeholder">
							<img src="<?php echo get_template_directory_uri(); ?>/assets/images/GENERAL-scaled.jpg" alt="Default background" class="page-hero__featured-image" />
						</div>
					<?php endif; ?>
				</div>
				<div class="page-hero__text">
					<div class="page-hero__text-content">
						<h1 class="page-hero__title"><?php the_title(); ?></h1>
					</div>
				</div>
			</div>
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
