<?php
/**
 * @package Workfree
 */
?>


<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="content-post">
	<header class="entry-header">

		
		<?php if ( has_post_thumbnail() ) {
the_post_thumbnail();
} else { ?>
<img src="<?php echo esc_url( get_template_directory_uri()); ?>/assets/images/placeholder.png" />
<?php } ?>
		
		<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>

	<?php if ( 'post' == get_post_type() ) : ?>

		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
	</div><!-- .entry-content -->

	</div><!-- .home-post -->
</article><!-- #post-## -->