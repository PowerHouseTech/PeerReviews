<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Workfree
 */

get_header(); ?>

	<div id = "site-description">
		<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
	</div><!-- .site-description -->
	
	<div id="primary-index" class="content-area">
		<main id="main" class="site-main-index" role="main">

	<?php if ( have_posts() ) : ?>

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
					get_template_part( 'content','home' );
				?>

			<?php endwhile; ?>

			<?php workfree_pagination(); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>


		</main><!-- #main -->
	</div><!-- #primary -->

<?php // get_sidebar(); ?>
<?php get_footer(); ?>
