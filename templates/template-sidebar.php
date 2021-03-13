<?php
/**
 * The template for displaying page with sidebar.
 *
 * Template name: С сайдбаром
 *
 * @package imicra
 */

get_header();

get_template_part( 'template-parts/header/header', 'page' );
?>

	<main id="primary" class="site-main">
		<div class="container-fluid site-wrapper">
			<div class="row">
				<div class="col-md-8 order-2">

					<?php
					while ( have_posts() ) :
						the_post();

						get_template_part( 'template-parts/content', 'page' );

						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;

					endwhile; // End of the loop.
					?>

				</div><!-- .col -->
				<div class="col-md-4 order-1">

					<?php
					get_sidebar();
					?>

				</div><!-- .col -->
			</div><!-- .row -->
		</div><!-- .container-fluid -->
	</main><!-- #main -->

<?php
get_footer();