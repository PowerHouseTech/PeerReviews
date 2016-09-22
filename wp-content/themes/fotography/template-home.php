<?php
/**
 * Template Name: Home Page
 *
 * @package FotoGraphy
 */
get_header();
?>
<?php
$home_layout = esc_attr(get_theme_mod('fotography_homepage_page_layout','default'));
$post_cat = esc_attr(get_theme_mod('cstmzr_categories'));
$category_all = __('All', 'fotography');
$call_action = esc_attr(get_theme_mod('fotography_homepage_call_action_option'));
$portfolio = esc_attr(get_theme_mod('fotography_homepage_our_portfolio_option'));
?>
<div id="inner-content" class="clearfix">
    <div id="main">

        <?php
             $count_section = get_theme_mod('fotography_homepage_about_count_option','enable');
            if(!empty($count_section) && $count_section == 'enable') {
        ?>
            <section class="counter-section">
                <div class="foto-container">
                    <?php fotography_counter(); ?>
                </div>
            </section>
        <?php } ?>

        <?php if (esc_attr(get_theme_mod('fotography_homepage_about_option','enable')) == 'enable') { ?>
            <section class="fg_aboutus">
                <div class="foto-container clearfix">
                    <?php fotography_aboutus(); ?>
                </div>
            </section>
        <?php } ?>

        <section class="fg_gallery_section">
            <div class="section-title">
                <?php echo esc_attr(get_theme_mod('fotography_homepage_gallery_main_title')); ?>   
            </div>

            <div id="fg_gallery_wrap">
                
                <?php if (esc_attr(get_theme_mod('fotography_homepage_page_layout','default')) == 'default') { ?>

                    <div id="fg-masonary-gallery" data-col="6">
                        <?php
                            $post_category = explode(',', $post_cat);
                            $args = array('post_type' => 'post', 'posts_per_page' => 15,'orderby' => 'rand',
                                'tax_query' => array(
                                    array(
                                        'taxonomy' => 'category',
                                        'field' => 'id',
                                        'terms' => $post_category
                                    )
                                )
                            );

                            $i = 0;
                            $query = new WP_Query($args);

                            if ($query->have_posts()): 
                                while($query->have_posts()):
                                    $query->the_post();
                                    $i++;
                                    if( has_post_thumbnail() ) : ?>
                                    <?php
                                        $mas_class = "";
                                        if( $i == 3 || $i == 10 || $i == 13 ) {
                                            $mas_class = 'wide';
                                        }
                                        
                                        $image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'fotography-grid-large');
                                        $img_src_full = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
                                    ?>
                                        <div class="item <?php echo esc_attr($mas_class); ?>">           

                                                <div class="fg-grid-hover">                                     
                                                    <h6>
                                                        <a href="<?php the_permalink(); ?>">
                                                            <?php the_title(); ?>
                                                        </a>                                                            
                                                    </h6>

                                                    <div class="gallery-open-link">
                                                        <a href="<?php echo esc_url($img_src_full[0]); ?>" rel="gallryLight"><i class="fa fa-eye"></i></a>
                                                        <a href="<?php the_permalink(); ?>"><i class="fa fa-link"></i></a>
                                                    </div>

                                                    <div class="fg-masonary-gallery-cat">
                                                        <?php the_category(', '); ?>
                                                    </div>

                                                </div>

                                                <div class="fg-masonary-featimg" style="background-image:url(<?php echo esc_url($image[0]); ?>);"></div>

                                        </div> 
                                    <?php
                                    endif;
                                endwhile;
                            endif; ?>
                    </div>   
                <?php } ?>


                <?php if (get_theme_mod('fotography_homepage_page_layout') == 'thumbnail_view' || get_theme_mod('fotography_homepage_page_layout') == 'thumbnail_with_slider') { ?>
                    <div class="fg-sortable-gallery">
                        
                        <?php 
                        if (get_theme_mod('fotography_homepage_page_layout') == 'thumbnail_view') { ?>
                        <header class="sort-table">
                            <?php
                            $categories = explode(',', $post_cat);
                            if (!empty($categories) && !is_wp_error($categories)):

                                echo "<ul class='button-group filters-button-group'>";
                                if (!empty($category_all)) {
                                    echo '<li class="button is-checked" data-filter="*">' . __('All', 'fotography') . '</li>';
                                }
                                foreach ($categories as $category) :
                                    $cat_detail = get_category($category);
                                    echo '<li class="button" data-filter=.' . $cat_detail->slug . '>' . $cat_detail->name . '</li>';
                                endforeach;
                                echo "</ul>";
                            endif;
                            wp_reset_query();
                            ?>
                        </header>
                        <?php } ?>

                        <div id="fg-grid-gallery-view">          
                            <?php
                            $post_category = explode(',', $post_cat);
                            $args = array('post_type' => 'post', 'posts_per_page' => -1,
                                'tax_query' => array(
                                    array(
                                        'taxonomy' => 'category',
                                        'field' => 'id',
                                        'terms' => $post_category
                                    )
                                )
                            );
                            $query = new WP_Query($args);
                            if ($query->have_posts()): while ($query->have_posts()) : $query->the_post();
                            
                                $img_src_full = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full', true);
                                    
                                    $term_lists = wp_get_post_terms($post->ID, 'category', array("fields" => "all"));
                                    $term_slugs = array();
                                    foreach ($term_lists as $term_list) {
                                        $term_slugs[] = $term_list->slug;
                                    }
                                    $term_slugs = join(' ', $term_slugs);
                                    ?>               
                                    <div class="element-item <?php echo esc_attr($term_slugs); ?>">
                                        <?php             
                                            $image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'fotography-grid-large', true);
                                        ?>                               
                                        <div class="fg-gallery-hover">
                                            <div class="gallery-img">
                                                <img src="<?php echo esc_url($image[0]); ?>" alt="<?php the_title(); ?>">
                                            </div>

                                            <div class="fg-grid-hover">                                     
                                                <h6>
                                                    <a href="<?php the_permalink(); ?>">
                                                        <?php the_title(); ?>
                                                    </a>                                                            
                                                </h6>

                                                <div class="gallery-open-link">
                                                    <a href="<?php echo esc_url($img_src_full[0]); ?>" rel="gallryLight"><i class="fa fa-eye"></i></a>
                                                    <a href="<?php the_permalink(); ?>"><i class="fa fa-link"></i></a>
                                                </div>

                                                <div class="fg-masonary-gallery-cat">
                                                    <?php the_category(', '); ?>
                                                </div>

                                            </div>

                                            
                                        </div>
                                    </div>
                                    <?php
                                endwhile;
                            endif;
                            wp_reset_query();
                            ?>
                        </div>                
                    </div>
                <?php } ?>


            </div>
        </section>

        <?php if (esc_attr(get_theme_mod('fotography_homepage_our_service_option','enable')) == 'enable') { ?>
            <section class="fg_service_section">
                <?php fotography_our_services(); ?>
            </section>
        <?php } ?>

        <?php if (esc_attr(get_theme_mod('fotography_homepage_blogs_option','enable')) == 'enable') { ?>
            <section class="fg-blog-section">
                <div class="foto-container">
                    <?php fotography_homeblogs(); ?>
                </div>
            </section>
        <?php } ?>

        <?php if (esc_attr(get_theme_mod('fotography_homepage_call_action_option','enable')) == 'enable') : ?>            
            <section class="home_caltoaction">
                <?php fotography_call_to_action() ?>
            </section>
        <?php endif; ?>
        
        <?php if (is_active_sidebar('fotography-home-instagram')) : ?>
            <section class="fg-home-instagram">
                <?php dynamic_sidebar('fotography-home-instagram'); ?>
            </section>
        <?php endif; ?>       

        <?php if (esc_attr(get_theme_mod('fotography_homepage_quick_contact_info','enable')) == 'enable') : ?>
            <section class="quick_contact_section">
                <div class="foto-container clearfix">
                    <?php fotography_quick_contact(); ?>
                </div>
            </section>
        <?php endif; ?>

<?php get_footer();