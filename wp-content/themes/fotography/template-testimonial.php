<?php
/**
 * Template Name: Testimonial Page
 *
 * @package FotoGraphy
 */
get_header();
$category_id = get_post_meta($post->ID, 'testimonial_dropdown', TRUE);
?>
<?php do_action('fotography_title'); ?>

<div class="foto-container">
    <div id="primary" class="content-area">
    <div class="testimonail-block-wrap">
    <?php
         $args = array(
             'posts_per_page' => '-1',
             'cat' => $category_id
         );

         $query = new WP_Query($args);
         if ($query->have_posts()): while ($query->have_posts()) : $query->the_post();
                 ?>
            <div class="testimonial-block">
                <a href="<?php the_permalink(); ?>" class="clearfix"> 
                    <div class="testimonial-excerpt">
                        <span><?php echo fotography_word_count(get_the_content(), 75); ?></span>
                    </div>

                    <div class="testimonial-image">
                        <?php
                        if (has_post_thumbnail()) :
                            $image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'fotography-thumb-view-blog', true);
                        ?>
                            <img src="<?php echo esc_url($image[0]); ?>" alt="<?php the_title(); ?>">
                        <?php endif; ?>                                                          
                    </div>

                    <div class="testimonial-name"><?php the_title(); ?></div>
                </a>              
            </div>
            <?php
            endwhile;
        endif;
        wp_reset_query(); ?>
        </div>
    </div>
<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
