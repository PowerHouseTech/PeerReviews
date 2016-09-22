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
 * @package FotoGraphy
 */

get_header(); 
$blog_layout = esc_attr(get_theme_mod('fotography_blog_page_archive_section','mediumthumbslistview'));
?>

<?php 
    if ( is_home() && ! is_front_page() ) : ?>
        <header class="page-header">
            <h1 class="page-title"><?php single_post_title(); ?></h1>
            <?php fotography_pro_breadcrumbs(); ?>
        </header>
    <?php  endif; ?>

<div class="foto-container">
    
    <div id="primary" class="content-area">
        
        <?php if (have_posts()) : ?>
            <div class="<?php echo esc_attr( $blog_layout ); ?> fg-blog-post">
            <?php /* Start the Loop */ ?>
            <?php while (have_posts()) : the_post(); ?>

                <?php
                    get_template_part('template-parts/content');
                ?>

            <?php endwhile; ?>
            </div>
            <?php
                if (function_exists("pagination")) {
                    pagination();
                }
            ?>
        <?php else : ?>

            <?php get_template_part('template-parts/content', 'none'); ?>

        <?php endif; ?>
    </div><!-- #primary -->

    <?php get_sidebar('archive'); ?>
    
</div>
<?php get_footer(); 