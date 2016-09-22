<?php
/**
 * Template part for displaying single posts.
 *
 * @package FotoGraphy
 */
?>
<?php
$post_id = get_the_ID();
$post_format = get_post_format($post_id);
$post_sidebar = esc_attr(get_post_meta($post->ID, 'fotography_page_layouts', true));
$blog_author = esc_attr(get_theme_mod('fotography_blog_author_archive_section','yes'));
$blog_postdate = esc_attr(get_theme_mod('fotography_blog_postdate_archive_section','yes'));
$blog_meta_cat = esc_attr(get_theme_mod('fotography_blog_metacategory_archive_section','yes'));
?>

<?php if ($post_format == 'image') : ?>
    <div class="image-gallery-format clearfix">
        <?php get_template_part('template-parts/gallery', 'single'); ?>
    </div>

<?php else : ?>
                               
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>  
        <div class="entry-meta">                              
            <?php if ($blog_author == 'yes') : ?>
                <span><i class="fa fa-user"></i> <?php the_author(); ?></span>
            <?php endif; ?>
            <?php if ($blog_postdate == 'yes') : ?>
                <span><i class="fa fa-clock-o"></i><?php the_time(get_option('date_format')); ?></span>
            <?php endif; ?> 
            <?php if ($blog_meta_cat == 'yes') : ?>
                <span><i class="fa fa-folder-open"></i> <?php the_category(','); ?></span>
            <?php endif; ?>               
        </div>

        <div class="entry-content">         
            <?php
                the_content();
                wp_link_pages(array(
                    'before' => '<div class="page-links">' . esc_html__('Pages:', 'fotography'),
                    'after' => '</div>',
                ));
            ?>
            <?php
            // If comments are open or we have at least one comment, load up the comment template.
            if (comments_open() || get_comments_number()) :
                comments_template();
            endif;
            ?>
        </div><!-- .entry-content --> 
    </article><!-- #post-## -->
<?php endif; ?>

