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

									$byline = sprintf(
										/* translators: %s: post author. */
										esc_html_x( 'by %s', 'post author', '_s' ),
										'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
									);

									echo '<span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.
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
