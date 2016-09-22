<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package FotoGraphy
 */
get_header();
?>

<header class="page-header">
    <h1 class="page-title"><?php single_cat_title( '', true ); ?></h1>
    <?php fotography_pro_breadcrumbs(); ?>
</header>

<?php
$blog_layout = esc_attr(get_theme_mod('fotography_blog_page_archive_section','mediumthumbslistview'));
// Category Page for Gallery Section
$checked_cat = get_theme_mod('cstmzr_categories');
$cat_id = explode(',', $checked_cat);
$catid = get_the_category();
$current_id = $catid[0]->cat_ID;
if (in_array($current_id, $cat_id)) {
?>
<div class="foto-container">
    <div class="fg-sortable-grid">
        <?php
        while (have_posts()) : the_post(); ?>

        <?php
            get_template_part('template-parts/content', 'gallery');
        ?>

        <?php endwhile; ?>        
    </div>
    <?php
       if (function_exists("pagination")) {
            pagination();
        }
    ?>
</div>
<?php
}

// Category Blogs Section
else { ?>
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
<?php } ?>
<?php get_footer();