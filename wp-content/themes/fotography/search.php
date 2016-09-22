<?php
/**
 * The template for displaying search results pages.
 *
 * @package FotoGraphy
 */

get_header(); ?>
<div class="container">

	<header class="page-header">
		<h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'fotography' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
		<?php fotography_pro_breadcrumbs(); ?>
	</header><!-- .page-header -->

	<div class="foto-container">    
    	<div id="primary" class="content-area">

			<?php if ( have_posts() ) : ?>
				<div class="fg-blog-post">
				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php
						/**
						 * Run the loop for the search to output the results.
						 * If you want to overload this in a child theme then include a file
						 * called content-search.php and that will be used instead.
						 */
						get_template_part( 'template-parts/content', 'search' );
					?>

				<?php endwhile; ?>
				</div>

				<?php the_posts_navigation(); ?>

			<?php else : ?>

				<?php get_template_part( 'template-parts/content', 'none' ); ?>

			<?php endif; ?>

		</div><!-- #div -->
	
		 <?php get_sidebar('archive'); ?>

	</div><!-- #primary -->
</div>
<?php get_footer();