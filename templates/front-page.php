<?php
/**
 * The template for displaying Contacts page.
 *
 * Template name: Главная страница
 *
 * @package imicra
 */

// CMB2
$prefix = '_imicra_';
$section = get_post_meta( get_the_ID(), $prefix . 'cmb_check', true );

get_header();
?>

	<main id="primary" class="site-main">

		<?php
		if ( $section ) :
			get_template_part( 'template-parts/frontpage/section', 'default' );
		endif;
		?>

	</main><!-- #main -->

<?php
get_footer();
