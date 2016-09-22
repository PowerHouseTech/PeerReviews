<?php
/**
 * Template Name: Team Template
 *
 * @package FotoGraphy
 */
get_header();
$category_id = get_post_meta($post->ID, 'team_dropdown', TRUE);
?>

<?php do_action('fotography_title'); ?>

<div class="foto-container">

    <div id="primary" class="content-area">  
        <div class="team-block-wrap clearfix">
            <?php
            $args = array('posts_per_page' => -1,
             'cat' => $category_id
            );
            $count = 0;
            $query = new WP_Query($args);
            if ($query->have_posts()): while ($query->have_posts()) : $query->the_post();
                if( $count == 3) {
                    $fg_last = 'fg-last';
                    $count = 0;
                }else{
                    $fg_last='';
                }
            ?>
            <div class="team-block <?php echo esc_attr( $fg_last ); ?>">

                <div class="team-image">
                    <?php
                    if (has_post_thumbnail()) :
                        $image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'fotography-our-services', true);
                    ?>
                        <a href="<?php the_permalink() ?>"><img src="<?php echo $image[0]; ?>" alt="<?php the_title(); ?>"></a>
                    <?php endif; ?>
                </div>
                    
    			<h6><a href="<?php the_permalink() ?>"><i class="fa fa-user"></i><?php the_title(); ?></a></h6>

                <div class="team-excerpt">            
                    <?php echo fotography_word_count(get_the_content(), 35)."..."; ?>
                </div>                                                                                                                      
            </div>

            <?php
            $count ++;
            endwhile;
            endif;
            wp_reset_query();
            ?>
        </div>
    </div>
    <?php get_sidebar(); ?>
</div>
<?php get_footer(); 