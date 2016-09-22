<?php
/**
 * @package Workfree
 */
?>


<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="home-post">
	<header class="entry-header">

		
		<?php if ( has_post_thumbnail() ) { ?>

		<a href = "<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
		<?php } else { ?>
		<a href = "<?php the_permalink(); ?>"><img src="<?php echo get_template_directory_uri()."/assets/images/placeholder.png";?>"></a>
		<?php } ?>
		
		<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>

	<?php if ( 'post' == get_post_type() ) : ?>

		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
	</div><!-- .entry-content -->

	</div><!-- .home-post -->
</article><!-- #post-## -->