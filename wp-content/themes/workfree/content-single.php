<?php
/**
 * @package Workfree
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class = "custom-single-post">
	<div class="single-post-image">
	<?php the_post_thumbnail(); ?>
	</div>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<div class="entry-meta">
			<?php workfree_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'workfree' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php workfree_entry_footer(); ?>
	</footer><!-- .entry-footer -->
	</div><!-- .single-post -->
</article><!-- #post-## -->
