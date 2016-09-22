<?php
/**
 * The template for displaying all pages.
 *
 * @package FotoGraphy
 */
get_header();

do_action('fotography_title'); 
?>

<div class="foto-container clearfix">
        <div id="primary" class="content-area">
        
        <?php while (have_posts()) : the_post(); ?>

            <?php get_template_part('template-parts/content', 'page'); ?>                    

        <?php endwhile; // End of the loop. ?>

        </div>    

        <?php get_sidebar(); ?>       
</div>
<?php get_footer(); 