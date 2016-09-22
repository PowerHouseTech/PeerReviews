<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Workfree
 */
?>

	</div><!-- #content -->
	
	<div id="custom-footer" class="group">
	
        <!-- 1/3 -->
        <div class="four-columns">
            <?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('footer-left-widget') ) ?>
        </div>
        <!-- /End 1/3 -->
        <!-- 2/3 -->
        <div class="four-columns">
            <?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('footer-center-widget') ) ?>
        </div>
        <!-- /End 2/3 -->
        <!-- 3/3 -->
        <div class="four-columns">
            <?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('footer-right-widget') ) ?>
        </div>
        <!-- /End 3/3 -->
    </div>

	
	<footer id="colophon" class="site-footer" role="contentinfo">	
		<div class="site-info">
			<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'workfree' ) ); ?>"><?php printf( __( 'Proudly powered by %s', 'workfree' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php printf( __( 'Theme: %1$s by %2$s.', 'workfree' ), 'Workfree', 'IP Singh' ); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
