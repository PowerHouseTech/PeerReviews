<?php
/**
 * FotoGraphy functions and definitions
 *
 * @package FotoGraphy
 */

/**
 * Enqueue scripts Admin Section.
 */
if ( ! function_exists( 'fotography_admin_script' ) ) :
    function fotography_admin_script() {
        wp_enqueue_script('fotography-script', get_template_directory_uri() . '/inc/js/custom.js', array('jquery'),'20151217',true);
        wp_enqueue_style('fotography-custom-style', get_template_directory_uri() . '/inc/css/custom.css');
    }
    add_action('admin_enqueue_scripts', 'fotography_admin_script');
endif;


/**
 * Enqueue scripts Customize Controls Section.
**/
if ( ! function_exists( 'fotography_customize_controls_enqueue_scripts' ) ) :
    function fotography_customize_controls_enqueue_scripts() {
        wp_enqueue_script('fotography-customize-custom', get_template_directory_uri() . '/inc/js/customize_custom.js', array( 'jquery'),'20151217',true);
    }
add_action('customize_controls_enqueue_scripts', 'fotography_customize_controls_enqueue_scripts');
endif;


/* ---------------------Website layout--------------------------------- */

if ( ! function_exists( 'fotography_website_layout_class' ) ) :
function fotography_website_layout_class($classes) {
    $website_layout = get_theme_mod('fotography_webpage_layout','fullwidth');
    if ($website_layout == 'boxed') {

        $classes[] = 'boxed-layout';
    } else {
        $classes[] = 'fullwidth-layout';
    }
   // return $classes;
    $noslider = get_theme_mod('fotography_homepage_slider_setting_option');
    if($noslider == 'disable'){
        $classes[] = 'no-slider';
    }
    return $classes;
}
add_filter('body_class', 'fotography_website_layout_class');
endif;

/* ---------------------Bx Slider Settings Section--------------------------------- */
if ( ! function_exists( 'fotography_bxslider_setting' ) ) :
function fotography_bxslider_setting() {
    $fotography_controls = (get_theme_mod('fotography_homepage_slider_show_controls','yes')=='yes') ? 'true' : 'false';
    $fotography_caption = (get_theme_mod('fotography_homepage_slider_show_caption','yes')=='yes') ? 'true' : 'false';    
?>
    <script type="text/javascript">
        jQuery(document).ready(function ($) {
            $('#slides').bxSlider({
                pager: <?php echo esc_attr($fotography_controls); ?>,
                captions: <?php echo esc_attr($fotography_caption); ?>,
                mode:'fade',
                auto:true,
                controls: false,
                adaptiveHeight : true
            });
        });
    </script>
    <?php
}
add_filter('wp_footer', 'fotography_bxslider_setting');
endif;

/* * *************************Word Count Limit****************************************** */
if ( ! function_exists( 'custom_excerpt_more' ) ) :
    function custom_excerpt_more( $more ) {
    	return '...';
    }
    add_filter( 'excerpt_more', 'custom_excerpt_more' );
endif;
if ( ! function_exists( 'fotography_word_count' ) ) :
    function fotography_word_count($string, $limit) {
        
        $striped_content = strip_tags($string);
        $striped_content = strip_shortcodes($striped_content);

        $words = explode(' ', $striped_content);
        return implode(' ', array_slice($words, 0, $limit));
    }
endif;

if ( ! function_exists( 'fotography_letter_count' ) ) :
    function fotography_letter_count($content, $limit) {
        $striped_content = strip_tags($content);
        $striped_content = strip_shortcodes($striped_content);
        $limit_content = mb_substr($striped_content, 0, $limit);
        if ($limit_content < $content) {
            $limit_content .= "...";
        }
        return $limit_content;
    }
endif;

/* -----------------------Add Grid In Post Class---------------------------------- */
if ( ! function_exists( 'fotography_grid_class' ) ) :
    function fotography_grid_class($classes) {
        $blog_grid = esc_attr(get_theme_mod('fotography_blog_grid_archive_section'));
        $blog_layout = esc_attr(get_theme_mod('fotography_blog_page_archive_section'));
        if ($blog_layout == 'gridview') {
            if ($blog_grid == '1') {
                $classes[] = 'one';
            } elseif ($blog_grid == '2') {
                $classes[] = 'two';
            } elseif ($blog_grid == '3') {
                $classes[] = 'three';
            } else {
                $classes[] = 'four';
            }
        }
        return $classes;
    }
add_filter('post_class', 'fotography_grid_class');
endif;

/* -----------------------Dynamic styles on header---------------------------------- */
if ( ! function_exists( 'fotography_header_sectin' ) ) :
    function fotography_header_sectin() {
        $favicon = get_theme_mod('fotography_favicon_setting_upload');
        if (!empty($favicon)):
            echo "<link type='image/png' rel='icon' href='" . esc_url($favicon) . "'/>\n";
        endif;
    }
    add_action('wp_head', 'fotography_header_sectin');
endif;
/**
 * Implement the custom metabox feature
 */
require get_template_directory() . '/inc/custom-metabox.php';

/**
 * Load Options Plugin Activation
 */
require get_template_directory() . '/inc/fotography-plugin-activation.php';

/**
 * Load Customizer Themes Options
 */
require get_template_directory() . '/inc/fotography-customizer.php';

/**
 * Load Widget Area
 */
require get_template_directory() . '/inc/fotography-widgets.php';

/* -------------------------Customizer Control for Category------------------------------ */

if (class_exists('WP_Customize_Control')) {
    class WP_Category_Checkboxes_Control extends WP_Customize_Control {
        public $type = 'category-checkboxes';
        public function render_content() {
            echo '<script src="' . get_template_directory_uri() . '/js/theme-customizer.js"></script>';
            echo '<span class="customize-control-title">' . esc_html($this->label) . '</span>';
            foreach (get_categories() as $category) {
                echo '<label><input type="checkbox" name="category-' . $category->term_id . '" id="category-' . $category->term_id . '" class="cstmzr-category-checkbox"> ' . $category->cat_name . '</label><br>';
            }
            ?>
            <input type="hidden" id="<?php echo $this->id; ?>" class="cstmzr-hidden-categories" <?php $this->link(); ?> value="<?php echo sanitize_text_field($this->value()); ?>">
            <?php
        }
    }
}

/**************************** Main Banner Slider ************************************** */
if ( ! function_exists( 'fotography_main_slider' ) ) :
function fotography_main_slider() {
    ?>
    <!-- Slider Section Start here -->
    <?php if (esc_attr(get_theme_mod('fotography_homepage_slider_setting_option','disable')) == 'enable') { ?>
        <div class="fg-banner-slider">
            <div id="slides">
                <?php 
                    $fotography_slider = get_theme_mod('fotography_homepage_advance_slider');
                    if(!empty($fotography_slider)){
                        $fotography_pro_sliders = json_decode($fotography_slider);
                        foreach ($fotography_pro_sliders as $slider) {

                        $website_layout = get_theme_mod('fotography_webpage_layout','fullwidth');
    
                ?>
                    <div class="single-slide">

                        <img src="<?php echo esc_url($slider->image_url); ?>"/>
                        <?php if (esc_attr(get_theme_mod('fotography_homepage_slider_show_caption','yes')) == 'yes') { ?>
                            <div class="caption">
                                <div class="title fadeInDown animated"><?php echo esc_attr($slider->title);?></div>
                                <div class="desc fadeInUp animated">
                                    <?php echo $slider->text; ?>
                                    <?php if(!empty($slider->link) && !empty($slider->subtitle)) { ?>
                                        <div class="caption-link">
                                        <a href="<?php echo esc_url($slider->link); ?>">
                                            <?php echo esc_attr($slider->subtitle); ?>
                                        </a>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                <?php } } ?>
            </div>
        </div>       
    <?php
    }
}
endif;
/**************************** Our Services Area Function *********************** */
if ( ! function_exists( 'fotography_our_services' ) ) :
function fotography_our_services() {
    $services_one = esc_attr(get_theme_mod('fotography_homepage_services_page_one'));
    $services_two = esc_attr(get_theme_mod('fotography_homepage_services_page_two'));
    $services_three = esc_attr(get_theme_mod('fotography_homepage_services_page_three'));
    $title = esc_attr(get_theme_mod('fotography_homepage_our_service_title','Our Services'));
    ?>

    <div class="section-title">
        <?php echo $title; ?>   
    </div>

    <div class="service-box-wrap clearfix">
    <?php
    $query = new WP_Query('page_id=' . $services_one);
    while ($query->have_posts()) : $query->the_post();
        $image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'fotography-our-services', true);
        ?>
        <div class="service-box">
            <a href="<?php echo esc_url(the_permalink()); ?>" class="clearfix">
                <div class="service-image">
                    <img src="<?php echo esc_url($image[0]); ?>"/>
                </div>
                <div class="service-hover red">
                    <div class="post-title"><span class="table_cell"><?php the_title(); ?></span></div>
                </div>
            </a>
        </div>
        <?php
    endwhile;
    wp_reset_query();

    $query = new WP_Query('page_id=' . $services_two);
    while ($query->have_posts()) : $query->the_post();
        $image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'fotography-our-services', true);
        ?>
        <div class="service-box">
            <a href="<?php echo esc_url(the_permalink()); ?>" class="clearfix">
                <div class="service-image">
                    <img src="<?php echo esc_url($image[0]); ?>"/>
                </div>
                <div class="service-hover blue">
                    <div class="post-title"><span class="table_cell"><?php the_title(); ?></span></div>            
                </div>
            </a>
        </div>
        <?php
    endwhile;
    wp_reset_query();

    $query = new WP_Query('page_id=' . $services_three);
    while ($query->have_posts()) : $query->the_post();
        $image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'fotography-our-services', true);
        ?>
        <div class="service-box">
            <a href="<?php echo esc_url(the_permalink()); ?>" class="clearfix">
                <div class="service-image">
                    <img src="<?php echo esc_attr($image[0]); ?>"/>
                </div>
                <div class="service-hover green">
                    <div class="post-title">
                        <span class="table_cell"><?php the_title(); ?></span>
                    </div>
                </div>
            </a>

        </div>
        </div>
        <?php
    endwhile;
    wp_reset_query();
}
endif;

/**************************** Our Home Blogs Area Function *********************** */
if ( ! function_exists( 'fotography_homeblogs' ) ) :
    function fotography_homeblogs() {
        $category_slug = esc_attr(get_theme_mod('fotography_homepage_blog_cat','uncategorized'));
        $title = esc_attr(get_theme_mod('fotography_homepage_blogs_title','Blog Posts'));
    ?>      

            <div class="section-title">
                <?php echo $title; ?>   
            </div>
              
            <div class="fg-latest-post clearfix">
                <?php                         
                  $args = array( 
                    'posts_per_page' => 3,
                    'category_name' => $category_slug
                  );
                  $query = new WP_Query($args);
                  if ($query->have_posts()): while ($query->have_posts()) : $query->the_post();
                ?>
                  <div class="post-item">
                        <div class="fg-post-img-wrap">
                            <a href="<?php the_permalink(); ?>">                      
                                <?php
                                    if ( has_post_thumbnail() ) {
                                      $image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'fotography-homeblog', true);            
                                       echo '<img class="blog-image" src="' . $image[0]. '" />'; 
                                  }
                                ?>
                            </a>
                            <div class="fg-post-date-comment clearfix">
                                <div class="fg-post-date">
                                    <i class="fa fa-calendar-o"></i>
                                    <span><?php the_time('d') ?></span>
                                    <span><?php the_time('M'); ?></span>
                                </div>

                                <div class="fg-comment">
                                <i class="fa fa-comment-o"></i>
                                <?php comments_popup_link('No Comments', '1 Comment', '% Comments'); ?>
                                </div>
                            </div>
                        </div>
                        

                        <div class="fg-post-content">
                            <h6><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
                            <div class="fg-item-excerpt">
                            <?php echo fotography_word_count(get_the_excerpt(), 25)."..."; ?>
                            </div>
                            

                            <a class="bttn" href="<?php the_permalink(); ?>"><?php _e( 'Read More', 'fotography' ) ?></a>
                        </div>               
                  </div>
                <?php endwhile; endif;  wp_reset_query(); ?>
            </div>
    <?php
    }
endif;

/* * *************************** About Us Section ***************************************** */
if ( ! function_exists( 'fotography_aboutus' ) ) :
function fotography_aboutus() {
    $aboutus = get_option('theme_mods_fotography');
    $about_page = esc_attr(get_theme_mod('fotography_homepage_about_page'));
    $about_desc = intval(get_theme_mod('fotography_homepage_about_desc_limit',25));       
            query_posts('page_id=' . $about_page);
            while (have_posts()) : the_post();                
                if ( has_post_thumbnail() ) {
                    $image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'fotography-about-section', true);
                ?>
                <div class="about-feature-img" style="background-image:url(<?php echo esc_url($image[0]); ?>)">
                </div>
                <?php } ?>
                <div class="about_desc clearfix">
                    <div class="section-title">
                        <?php
                        if (!empty($about_title)) : 
                            echo esc_attr($about_title);
                        endif;
                        ?>
                        <span><?php the_title(); ?></span>
                    </div>

                          
                    <div class="aboutus-subtitle">
                        <?php the_content(); ?>
                    </div>      
                </div>
        <?php 
    endwhile;
    wp_reset_query();
}
endif;


function fotography_counter(){
    $counter_one = esc_attr(get_theme_mod('fotography_homepage_about_counter_one'));
    $title_one = esc_attr(get_theme_mod('fotography_homepage_about_title_one'));
    $icon_one = esc_attr(get_theme_mod('fotography_homepage_about_icon_one'));

    $counter_two = esc_attr(get_theme_mod('fotography_homepage_about_counter_two'));
    $title_two = esc_attr(get_theme_mod('fotography_homepage_about_title_two'));
    $icon_two = esc_attr(get_theme_mod('fotography_homepage_about_icon_two'));

    $counter_three = esc_attr(get_theme_mod('fotography_homepage_about_counter_three'));
    $title_three = esc_attr(get_theme_mod('fotography_homepage_about_title_three'));
    $icon_three = esc_attr(get_theme_mod('fotography_homepage_about_icon_three'));

    $counter_four = esc_attr(get_theme_mod('fotography_homepage_about_counter_four'));
    $title_four = esc_attr(get_theme_mod('fotography_homepage_about_title_four'));
    $icon_four = esc_attr(get_theme_mod('fotography_homepage_about_icon_four'));

    $counter_five = esc_attr(get_theme_mod('fotography_homepage_about_counter_five'));
    $title_five = esc_attr(get_theme_mod('fotography_homepage_about_title_five'));
    $icon_five = esc_attr(get_theme_mod('fotography_homepage_about_icon_five'));       
    ?>
    <div class="about-counter-wrap clearfix">
        <div class="about-counter">
            <div class="counter counter-one">
             <?php
                if (!empty($counter_one)) : echo $counter_one;
                endif;
             ?>
            </div>
            <h6 class="counter-title title-one"><?php
                if (!empty($title_one)) : echo $title_one;
                endif;
                ?>
            </h6>
            <span class="counter-icon icon-one">                                    
                <i class="fa <?php if (!empty($icon_one)){ echo $icon_one; } ?> fa-2x"></i>
            </span>
        </div>

        <div class="about-counter">
            <div class="counter counter-two">
            <?php
                if (!empty($counter_two)) : echo $counter_two;
                endif;
                ?>
            </div>
            
            <h6 class="counter-title title-two">
            <?php
                if (!empty($title_two)) : echo $title_two;
                endif;
                ?>
            </h6>

            <span class="counter-icon icon-two">
            <i class="fa <?php
                if (!empty($icon_two)) : echo $icon_two;
                endif
                ?> fa-2x"></i>
            </span>
        </div>

        <div class="about-counter">

            <div class="counter counter-three"><?php
                if (!empty($counter_three)) : echo $counter_three;
                endif;
                ?>
            </div>

            <h6 class="counter-title title-three"><?php
                if (!empty($title_three)) : echo $title_three;
                endif;
                ?>
            </h6>

            <span class="counter-icon icon-three">
            <i class="fa <?php
                if (!empty($icon_three)) : echo $icon_three;
                endif
                ?> fa-2x"></i>
            </span>
        </div>

        <div class="about-counter">
            <div class="counter counter-four"><?php
                if (!empty($counter_four)) : echo $counter_four;
                endif;
                ?>
            </div>

            <h6 class="counter-title title-four"><?php
                if (!empty($title_four)) : echo $title_four;
                endif;
                ?>
            </h6>

            <span class="counter-icon icon-four"><i class="fa <?php
                if (!empty($icon_four)) : echo $icon_four;
                endif
                ?> fa-2x"></i>
            </span>
        </div>                             
    </div>
<?php
}

/* * ******************************** Call To Action Section  ************************************** */
if ( ! function_exists( 'fotography_call_to_action' ) ) :
function fotography_call_to_action() {
        $fg_bg_image = get_theme_mod('fotography_homepage_call_action_image');
        $fg_call_title = get_theme_mod('fotography_homepage_call_action_title','Need A Photographer ?');
        $fg_call_sub_title = get_theme_mod('fotography_homepage_call_action_sub_title');
        $fg_call_button_link = get_theme_mod('fotography_homepage_call_action_button_link');
        $fg_call_button_text = get_theme_mod('fotography_homepage_call_action_button_name','Hire Me');
    ?>
        <div class="call-to-action" <?php if(!empty($fg_bg_image)){ ?> style="background-image:url(<?php echo esc_url( $fg_bg_image ); ?>); background-size: cover; <?php } ?>">   
            <div class="foto-container">
                <div class="section-title"><?php echo esc_attr( $fg_call_title ); ?></div>
                <div class="call-to-action-subtitle"><?php echo esc_attr( $fg_call_sub_title ); ?></div>
                <?php if( !empty($fg_call_button_text) ){ ?>
                    <div class="call-to-action-button">
                        <a class="bttn" href="<?php echo esc_url( $fg_call_button_link ); ?>"><?php echo esc_attr( $fg_call_button_text ); ?></a>
                    </div>
                <?php } ?>
            </div>
        </div>
    <?php
}
endif;


/* * ******************************** Quick Contact Info ************************************** */
if ( ! function_exists( 'fotography_quick_contact' ) ) :
function fotography_quick_contact() {
    $email_icon = get_theme_mod('fotography_homepage_quick_email_icon');
    $email = esc_attr(get_theme_mod('fotography_homepage_quick_email'));
    $twitter_icon = esc_attr(get_theme_mod('fotography_homepage_quick_twitter_icon'));
    $twitter = esc_attr(get_theme_mod('fotography_homepage_quick_twitter'));
    $phone_icon = esc_attr(get_theme_mod('fotography_homepage_quick_phone_icon'));
    $phone = esc_attr(get_theme_mod('fotography_homepage_quick_phone'));
    ?>
    <div class="fg-email">
        <a href="mailto:<?php echo $email; ?>">
            <div class="email-icon">
                <i class="fa <?php echo $email_icon; ?>"></i>
            </div>
            <div class="email-address">
                <?php echo $email; ?>
            </div>
        </a>
    </div>

    <div class="fg-twitter">
        <a href="https://twitter.com/<?php echo $twitter; ?>" target="_blank">
            <div class="twitter-icon">
                <i class="fa <?php echo $twitter_icon; ?>"></i>
            </div>
            <div class="twitter-address">
                <?php if(!empty($twitter)) : ?>
                    @<?php echo $twitter; ?>
                <?php endif; ?>
            </div>
        </a>
    </div>

    <div class="fg-phone">
        <a href="callto:<?php echo $phone; ?>">
            <div class="phone-icon">
                <i class="fa <?php echo $phone_icon; ?> fa-2x"></i>
            </div>
            <div class="phone-number">
                <?php echo $phone; ?>
            </div>
        </a>
    </div>
    <?php
}
endif;


// Our Product detail's
if(class_exists( 'WP_Customize_control')){
    class Theme_Info_Product_Custom_Control extends WP_Customize_Control
    {
        public function render_content()
        {
            ?>
            <label>
                <!-- <h3 class="customize-title"><?php //echo esc_html( $this->label ); ?></h3>
                <br /> -->
                <span class="customize-text_editor_desc button">
                    <?php echo wp_kses_post( $this->description ); ?>
                </span>
            </label>
            <?php
        }
    }
}



if(class_exists( 'WP_Customize_control')){
    class Theme_Info_Custom_Control extends WP_Customize_Control {
        public function render_content(){
            ?>
            <label>
                <h2 class="customize-title"><?php echo esc_html( $this->label ); ?></h2>
                <br />
                <span class="customize-text_editor_desc">
                 
                    <!-- <img src="<?php echo get_template_directory_uri() ?>/inc/images/feature-list-pro.jpg"/> -->
                    <ul class="admin-pro-feature-list">   
                        <li><span><?php _e('Fully built on customizer!','fotography'); ?> </span></li>
                        <li><span><?php _e('Multiple layout','fotography'); ?> </span></li>
                        <li><span><?php _e('Sidebar options','fotography'); ?> </span></li>
                        <li><span><?php _e('Typography Options','fotography'); ?> </span></li>
                        <li><span><?php _e('Multiple Color Scheme','fotography'); ?> </span></li>
                        <li><span><?php _e('Custom Shortcodes','fotography'); ?> </span></li>
                        <li><span><?php _e('Unlimited slider options','fotography'); ?> </span></li>
                        <li><span><?php _e('Photographers, photo bloggers, photo journalists','fotography'); ?> </span></li>
                        <li><span><?php _e('5 Different Gallery Layouts','fotography'); ?> </span></li>
                        <li><span><?php _e('Like Button on Gallery','fotography'); ?> </span></li>
                        <li><span><?php _e('Advanced Gallery Display Options','fotography'); ?> </span></li>
                        <li><span><?php _e('Single Gallery Layout','fotography'); ?> </span></li>
                        <li><span><?php _e('Page/ Post Title Settings','fotography'); ?> </span></li>
                        <li><span><?php _e('Page Post Header Settings','fotography'); ?> </span></li>
                        <li><span><?php _e('Page Settings','fotography'); ?> </span></li>
                        <li><span><?php _e('5 Different Blog Display Layouts','fotography'); ?> </span></li>
                        <li><span><?php _e('Advanced Blog Display Options','fotography'); ?> </span></li>
                        <li><span><?php _e('Team Member Layout','fotography'); ?> </span></li>
                        <li><span><?php _e('Testimonial layout','fotography'); ?> </span></li>
                        <li><span><?php _e('View on light-box','fotography'); ?> </span></li>
                        <li><span><?php _e('Responsive Design','fotography'); ?> </span></li>
                        <li><span><?php _e('Instagram feed Integration','fotography'); ?> </span></li>                        
                        <li><span><?php _e('Cross browser compatible','fotography'); ?> </span></li>
                        <li><span><?php _e('Fully SEO optimized','fotography'); ?> </span></li>
                        <li><span><?php _e('Fast loading','fotography'); ?> </span></li>
                    </ul>
                    <a href="https://accesspressthemes.com/wordpress-themes/fotography-pro/" class="button button-primary buynow" target="_blank"><?php _e('Buy Now','fotography'); ?></a>
                </span>
            </label>
            <?php
        }
    }
}



/**
 * Fotography More Themes
 */

// Add upsell page to the menu.
if ( ! function_exists( 'accesspress_store_add_upsell' ) ) :
    function accesspress_store_add_upsell() {
        add_theme_page(
            __( 'More Themes', 'fotography' ),
            __( 'More Themes', 'fotography' ),
            'administrator',
            'accesspressstore-themes',
            'accesspress_store_display_upsell'
        );
    }
    add_action( 'admin_menu', 'accesspress_store_add_upsell', 11 );
endif;

// Define markup for the upsell page.
if ( ! function_exists( 'accesspress_store_display_upsell' ) ) :
function accesspress_store_display_upsell() {
    // Set template directory uri
    $directory_uri = get_template_directory_uri();
    ?>
    <div class="wrap">
    <h1 style="margin-bottom:20px;">
    <img src="<?php echo get_template_directory_uri(); ?>/images/accesspressthemes.png"/>
    <?php echo sprintf(__( 'More Themes from <a href="%s" target="_blank">AccessPress Themes</a>', 'fotography' ) , esc_url('https://accesspressthemes.com/'))?>
    </h1>

    <div class="theme-browser rendered">
        <div class="themes">
        <?php
        // Set the argument array with author name.
        $args = array(
            'author' => 'access-keys',
        );
        // Set the $request array.
        $request = array(
            'body' => array(
                'action'  => 'query_themes',
                'request' => serialize( (object)$args )
            )
        );
        $themes = accesspressstore_get_themes( $request );
        $active_theme = wp_get_theme()->get( 'Name' );
        $counter = 1;
        // For currently active theme.
        foreach ( $themes->themes as $theme ) {
            if( $active_theme == $theme->name ) {?>

                <div id="<?php echo $theme->slug; ?>" class="theme active">
                    <div class="theme-screenshot">
                        <img src="<?php echo $theme->screenshot_url ?>"/>
                    </div>
                    <h3 class="theme-name" id="accesspress-parallax-name"><strong><?php _e('Active','fotography'); ?></strong>: <?php echo $theme->name; ?></h3>
                    <div class="theme-actions">
                        <a class="button button-secondary activate" target="_blank" href="<?php echo get_site_url(). '/wp-admin/customize.php' ?>"><?php _e('Customize','fotography'); ?></a>
                    </div>
                </div>
            <?php
            $counter++;
            break;
            }
        }

        // For all other themes.
        foreach ( $themes->themes as $theme ) {
            if( $active_theme != $theme->name ) {
                // Set the argument array with author name.
                $args = array(
                    'slug' => $theme->slug,
                );
                // Set the $request array.
                $request = array(
                    'body' => array(
                        'action'  => 'theme_information',
                        'request' => serialize( (object)$args )
                    )
                );
                $theme_details = accesspressstore_get_themes( $request );
            ?>
                <div id="<?php echo $theme->slug; ?>" class="theme">
                    <div class="theme-screenshot">
                        <img src="<?php echo $theme->screenshot_url ?>"/>
                    </div>

                    <h3 class="theme-name"><?php echo $theme->name; ?></h3>

                    <div class="theme-actions">
                        <?php if( wp_get_theme( $theme->slug )->exists() ) { ?>
                            <!-- Show the tick image notifying the theme is already installed. -->
                            <img data-toggle="tooltip" title="<?php _e( 'Already installed', 'fotography' ); ?>" data-placement="bottom" class="theme-exists" src="<?php echo $directory_uri ?>/inc/images/right.png"/>
                            <!-- Activate Button -->
                            <a  class="button button-secondary activate"
                                href="<?php echo wp_nonce_url( admin_url( 'themes.php?action=activate&amp;stylesheet=' . urlencode( $theme->slug ) ), 'switch-theme_' . $theme->slug );?>" ><?php _e('Activate','fotography') ?></a>
                        <?php }else {
                            // Set the install url for the theme.
                            $install_url = add_query_arg( array(
                                    'action' => 'install-theme',
                                    'theme'  => $theme->slug,
                                ), self_admin_url( 'update.php' ) );
                        ?>
                            <!-- Install Button -->
                            <a data-toggle="tooltip" data-placement="bottom" title="<?php echo 'Downloaded ' . number_format( $theme_details->downloaded ) . ' times'; ?>" class="button button-secondary activate" href="<?php echo esc_url( wp_nonce_url( $install_url, 'install-theme_' . $theme->slug ) ); ?>" ><?php _e( 'Install Now', 'fotography' ); ?></a>
                        <?php } ?>

                        <a class="button button-primary load-customize hide-if-no-customize" target="_blank" href="<?php echo $theme->preview_url; ?>"><?php _e( 'Live Preview', 'fotography' ); ?></a>
                    </div>
                </div>
                <?php
            }
        }?>
        </div>
    </div>
    </div>
<?php
}
endif;

// Get all themeisle themes by using API.
if ( ! function_exists( 'accesspressstore_get_themes' ) ) :
function accesspressstore_get_themes( $request ) {

    // Generate a cache key that would hold the response for this request:
    $key = 'accesspressstore_' . md5( serialize( $request ) );

    // Check transient. If it's there - use that, if not re fetch the theme
    if ( false === ( $themes = get_transient( $key ) ) ) {

        // Transient expired/does not exist. Send request to the API.
        $response = wp_remote_post( 'http://api.wordpress.org/themes/info/1.0/', $request );

        // Check for the error.
        if ( !is_wp_error( $response ) ) {

            $themes = unserialize( wp_remote_retrieve_body( $response ) );

            if ( !is_object( $themes ) && !is_array( $themes ) ) {

                // Response body does not contain an object/array
                return new WP_Error( 'theme_api_error', 'An unexpected error has occurred' );
            }

            // Set transient for next time... keep it for 24 hours should be good
            set_transient( $key, $themes, 60 * 60 * 24 );
        }
        else {
            // Error object returned
            return $response;
        }
    }
    return $themes;
}
endif;
// Themes required Plugins Install Section
if ( ! function_exists( 'fotography_root_register_required_plugins' ) ) :
function fotography_root_register_required_plugins() {

    $plugins = array(
        array(
            'name' => 'AccessPress Instagram Feed',
            'slug' => 'accesspress-instagram-feed',
            'required' => false,
        ),
        array(
            'name' => 'AccessPress Twitter Feed',
            'slug' => 'accesspress-twitter-feed',
            'required' => false,
        ),
        array(
            'name' => 'AccessPress Social Icons',
            'slug' => 'accesspress-social-icons',
            'required' => false,
        ),
        array(
            'name' => 'AccessPress Social Share',
            'slug' => 'accesspress-social-share',
            'required' => false,
        ),        
        array(
            'name' => 'Contact Form 7',
            'slug' => 'contact-form-7',
            'required' => false,
        ),
        array(
            'name' => 'Newsletter',
            'slug' => 'newsletter',
            'required' => false,
        )
    );

    $config = array(
        'id' => 'tgmpa', // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '', // Default absolute path to pre-packaged plugins.
        'menu' => 'tgmpa-install-plugins', // Menu slug.
        'parent_slug' => 'themes.php', // Parent menu slug.
        'capability' => 'edit_theme_options', // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
        'has_notices' => true, // Show admin notices or not.
        'dismissable' => true, // If false, a user cannot dismiss the nag message.
        'dismiss_msg' => '', // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => true, // Automatically activate plugins after installation or not.
        'message' => '', // Message to output right before the plugins table.
        'strings' => array(
            'page_title' => __('Install Required Plugins', 'fotography'),
            'menu_title' => __('Install Plugins', 'fotography'),
            'installing' => __('Installing Plugin: %s', 'fotography'), // %s = plugin name.
            'oops' => __('Something went wrong with the plugin API.', 'fotography'),
            'notice_can_install_required' => _n_noop(
                    'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'fotography'
            ), // %1$s = plugin name(s).
            'notice_can_install_recommended' => _n_noop(
                    'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'fotography'
            ), // %1$s = plugin name(s).
            'notice_cannot_install' => _n_noop(
                    'Sorry, but you do not have the correct permissions to install the %1$s plugin.', 'Sorry, but you do not have the correct permissions to install the %1$s plugins.', 'fotography'
            ), // %1$s = plugin name(s).
            'notice_ask_to_update' => _n_noop(
                    'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'fotography'
            ), // %1$s = plugin name(s).
            'notice_ask_to_update_maybe' => _n_noop(
                    'There is an update available for: %1$s.', 'There are updates available for the following plugins: %1$s.', 'fotography'
            ), // %1$s = plugin name(s).
            'notice_cannot_update' => _n_noop(
                    'Sorry, but you do not have the correct permissions to update the %1$s plugin.', 'Sorry, but you do not have the correct permissions to update the %1$s plugins.', 'fotography'
            ), // %1$s = plugin name(s).
            'notice_can_activate_required' => _n_noop(
                    'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'fotography'
            ), // %1$s = plugin name(s).
            'notice_can_activate_recommended' => _n_noop(
                    'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'fotography'
            ), // %1$s = plugin name(s).
            'notice_cannot_activate' => _n_noop(
                    'Sorry, but you do not have the correct permissions to activate the %1$s plugin.', 'Sorry, but you do not have the correct permissions to activate the %1$s plugins.', 'fotography'
            ), // %1$s = plugin name(s).
            'install_link' => _n_noop(
                    'Begin installing plugin', 'Begin installing plugins', 'fotography'
            ),
            'update_link' => _n_noop(
                    'Begin updating plugin', 'Begin updating plugins', 'fotography'
            ),
            'activate_link' => _n_noop(
                    'Begin activating plugin', 'Begin activating plugins', 'fotography'
            ),
            'return' => __('Return to Required Plugins Installer', 'fotography'),
            'plugin_activated' => __('Plugin activated successfully.', 'fotography'),
            'activated_successfully' => __('The following plugin was activated successfully:', 'fotography'),
            'plugin_already_active' => __('No action taken. Plugin %1$s was already active.', 'fotography'), // %1$s = plugin name(s).
            'plugin_needs_higher_version' => __('Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'fotography'), // %1$s = plugin name(s).
            'complete' => __('All plugins installed and activated successfully. %1$s', 'fotography'), // %s = dashboard link.
            'contact_admin' => __('Please contact the administrator of this site for help.', 'fotography'),
            'nag_type' => 'updated', // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
        )
    );
    tgmpa($plugins, $config);
}
add_action('tgmpa_register', 'fotography_root_register_required_plugins');
endif;