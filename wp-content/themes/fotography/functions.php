<?php
/**
 * FotoGraphy functions and definitions
 *
 * @package FotoGraphy
 */

if ( ! function_exists( 'fotography_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function fotography_setup() {

	if ( ! isset( $content_width ) ) $content_width = 900;
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on FotoGraphy, use a find and replace
	 * to change 'fotography' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'fotography', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'woocommerce' );
	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'fotography-thumb-view', 260, 260, true); 
	add_image_size( 'fotography-thumb-view-withslider', 290, 290, true); 
	add_image_size( 'fotography-thumb-view-blog', 210, 210, true); 
	add_image_size( 'fotography-bxslider', 930, 350, true); 
	//grid image cropt
	add_image_size( 'fotography-grid-small', 400, 400, true);
	add_image_size( 'fotography-grid-medium', 600, 300, true);
	add_image_size( 'fotography-grid-large', 600, 600, true);
	// Our Services 
	add_image_size( 'fotography-our-services', 640, 440, true);
	add_image_size( 'fotography-homeblog', 365, 260, true);
	//
	add_image_size( 'fotography-sly', 1280, 720, true);
	add_image_size( 'fotography-about-section', 675, 650, true);
	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'fotography' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'image'
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'fotography_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // fotography_setup
add_action( 'after_setup_theme', 'fotography_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
if ( ! function_exists( 'fotography_content_width' ) ) :
	function fotography_content_width() {
		$GLOBALS['content_width'] = apply_filters( 'fotography_content_width', 640 );
	}
	add_action( 'after_setup_theme', 'fotography_content_width', 0 );
endif;
/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
if ( ! function_exists( 'fotography_widgets_init' ) ) :
function fotography_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Left Sidebar Widget Area', 'fotography' ),
		'id'            => 'fotography-left-sidebar',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title"><span>',
		'after_title'   => '</span></h4>',
	) );

    register_sidebar( array(
		'name'          => __( 'Right Sidebar Widget Area', 'fotography' ),
		'id'            => 'fotography-right-sidebar',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title"><span>',
		'after_title'   => '</span></h4>',
	) );	

	register_sidebar( array(
		'name'          => __( 'HomePage Instagram Widget Area', 'fotography' ),
		'id'            => 'fotography-home-instagram',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<div class="section-title">',
		'after_title'   => '</div>',
	) );

	register_sidebar( array(
		'name'          => __( 'Gallery Widget Area', 'fotography' ),
		'id'            => 'fotography-gallery-sidebar',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title"><span>',
		'after_title'   => '</span></h4>',
	) );

    register_sidebar( array(
		'name'          => __( 'Footer Widget Area One', 'fotography' ),
		'id'            => 'fotography_footer_one',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title"><span>',
		'after_title'   => '</span></h4>',
	) );
    register_sidebar( array(
		'name'          => __( 'Footer Widget Area Two', 'fotography' ),
		'id'            => 'fotography_footer_two',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title"><span>',
		'after_title'   => '</span></h4>',
	) );
    register_sidebar( array(
		'name'          => __( 'Footer Widget Area Three', 'fotography' ),
		'id'            => 'fotography_footer_three',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title"><span>',
		'after_title'   => '</span></h4>',
	) );
    register_sidebar( array(
		'name'          => __( 'Footer Widget Area Four', 'fotography' ),
		'id'            => 'fotography_footer_four',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title"><span>',
		'after_title'   => '</span></h4>',
	) );

	register_sidebar( array(
		'name'          => __( 'Social Icon Widget Area Four', 'fotography' ),
		'id'            => 'fotography-social-icon',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="%2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title"><span>',
		'after_title'   => '</span></h4>',
	) );
    
}
add_action( 'widgets_init', 'fotography_widgets_init' );
endif;
/**
 * Enqueue scripts and styles.
 */
function fotography_scripts() {
	 /*****************************
	 * Use google fonts          **
	 ******************************/
	$query_args = array( 
	    'family' => 'Lato:300,400,700|Bad+Script|Open+Sans+Condensed:300,700'
	);
	wp_enqueue_style( 'fotography-google-fonts', add_query_arg( $query_args, "//fonts.googleapis.com/css" ) );
	
   	//Main Slider
	wp_enqueue_style('fotography-jquery-bxslider',get_template_directory_uri() . '/css/jquery.bxslider.css', true );
	wp_enqueue_style('fotography-animate',get_template_directory_uri() . '/css/animate.css', true );
    wp_enqueue_style('fotography-prettyPhoto',get_template_directory_uri() . '/single/css/prettyPhoto.css');
    wp_enqueue_style('fotography-font-awesome',get_template_directory_uri() . '/css/font-awesome.css',true );
	wp_enqueue_style( 'fotography-style', get_stylesheet_uri() );

	wp_enqueue_script('fotography-isotope-pkgd',get_template_directory_uri() . '/js/isotope.pkgd.js', array('jquery'), '2.2.0', true );
	wp_enqueue_script('fotography-jquery-bxslidermin',get_template_directory_uri() . '/js/jquery.bxslider.js', array('jquery'), '1.3', true );
	wp_enqueue_script( 'fotography-jquery-prettyPhoto', get_template_directory_uri() . '/single/js/jquery.prettyPhoto.js', array('jquery'), '20150705', true);
    wp_enqueue_script( 'fotography-counterup', get_template_directory_uri() . '/js/counterup.js', array('jquery'), '20150706', true);
    wp_enqueue_script( 'fotography-waypoints', get_template_directory_uri() . '/js/waypoints.min.js', array('jquery'), '20150706', true);
    wp_enqueue_script( 'fotography-imagesloaded', get_template_directory_uri() . '/js/imagesloaded.js', array('jquery'), '20150706', true);
    wp_enqueue_script('fotography-custom', get_template_directory_uri() . '/js/custom.js', array('jquery'), '', true );
   
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
    
    $post_format = get_post_format();
if(is_single() && $post_format == 'image')
    {
    // Folio View Script & Css
	wp_enqueue_style('fotography-lightGallerycss',get_template_directory_uri() . '/single/css/lightGallery.css');
    
    // SLY Gallery
	global $post;
	$layouts = esc_attr(get_post_meta( $post->ID, 'fotography_gallery_layouts', true ));
 	if( $layouts == 'sly' && is_single()) {
		wp_enqueue_script( 'fotography-sly-min', get_template_directory_uri() . '/single/js/sly.js', array('jquery'), '20150703', true);	
	}
	wp_enqueue_script( 'fotography-jquery.easing', get_template_directory_uri() . '/single/js/jquery.easing.1.3.js', array('jquery'), '20150703', true);
    // photoswipe
	wp_enqueue_style('fotography-photoswipe-css',get_template_directory_uri() . '/single/css/photoswipe.css');
	wp_enqueue_style('fotography-default-skin-css',get_template_directory_uri() . '/single/css/default-skin/default-skin.css');
	
	wp_enqueue_script( 'fotography-lightGallery-js', get_template_directory_uri() . '/single/js/lightGallery.js', array('jquery'));
    // Photoswipe
	wp_enqueue_script( 'fotography-photoswipe-js', get_template_directory_uri() . '/single/js/photoswipe.js', array('jquery'), '20150731', true);
	wp_enqueue_script( 'fotography-photoswipe-ui-default-min-js', get_template_directory_uri() . '/single/js/photoswipe-ui-default.min.js', array('jquery'), '20150731', true);
	wp_enqueue_script( 'fotography-single-custom-js', get_template_directory_uri() . '/single/js/custom.js');
}

}
add_action( 'wp_enqueue_scripts', 'fotography_scripts' );


function fotography_sly_gallery_layout(){
	global $post;
	$layouts = esc_attr(get_post_meta( $post->ID, 'fotography_gallery_layouts', true ));
    $post_format = get_post_format();
 	if( $layouts == 'sly' && is_single() && $post_format == 'image') {
	?>
		<script type="text/javascript">

			jQuery(document).ready(function ($) {
			var $frame = jQuery('#fg-sly-gallery');
    		var $wrap  = $frame.parent();
			var options = {
			    horizontal: 1,
				itemNav: 'centered',
				smart: 1,
				activateOn: 'click',
				activateMiddle: 1,
				mouseDragging: 1,
				touchDragging: 1,
				releaseSwing: 1,
				startAt: 0,
				scrollBar: $wrap.find('.scrollbar'),
				scrollBy: 0,
				speed: 3000,
				elasticBounds: 1,
				easing: 'easeOutExpo',
				dragHandle: 1,
				dynamicHandle: 1,
				clickBar: 1,
				keyboardNavBy: 0,
				prev: $frame.find('.prev'),
				next: $frame.find('.next')
				};

			var frame = new Sly('.frame', options).init();

			jQuery('html body').on('keydown', function(event){

			    if (event.which == 39) {
			      var list = jQuery('.frame ul li.active');
			      var position = jQuery('.frame ul li').index(list);
			      var length = jQuery('.frame ul li').length;
			      var next_position = position + 1;
			      if (next_position < length) {
			        var sel = '.frame ul li:eq('+ next_position +')';
			        jQuery(sel).click();
			      }
			    } else if (event.which == 37) {
			      var list = jQuery('.frame ul li.active');
			      var position = jQuery('.frame ul li').index(list);
			      var prev_position = position - 1;
			      if (prev_position > -1) {
			        var sel = '.frame ul li:eq('+ prev_position +')';
			        jQuery(sel).click();
			      }
			    }
			});

		    function getGalleryHeight(){

			    var headerHeight = jQuery('#masthead').outerHeight();
			    var windowHeight = jQuery(window).height();
			    var footerHeight = jQuery('#colophon').outerHeight();

			    var contentHeight = windowHeight - headerHeight - footerHeight - 137;

			    return contentHeight;
			}


	        function resize_frame(){
		    if(jQuery('.frame').length ){

		        var imagesParentWidth = 0;
		        var imageProportions = 0;

		        jQuery('.frame ul li').each(function(){
		          imagesParentWidth += parseInt(parentHeight*imageProportions, 10);

		          var imageDataHeight = jQuery(this).find('img').data('height');
		          var imageDataWidth = jQuery(this).find('img').data('width');
		          var parentHeight = getGalleryHeight();

		          imageProportions = imageDataWidth/imageDataHeight;

		          imageProportionsWidth = parseInt(parentHeight*imageProportions, 10);


		            jQuery(this).height(parentHeight);
		            jQuery(this).width(imageProportionsWidth);

		            jQuery(this).find('img').height(parentHeight);
		            jQuery(this).find('img').width(imageProportionsWidth);

		         
		        });

		        jQuery('.frame ul').width(imagesParentWidth);

		        frame.reload();
		        }
		}

        jQuery(window).on('resize',function(){
		    jQuery('#fg-sly-gallery .frame').height( getGalleryHeight());
            resize_frame();
        }).resize();
						
		});
		</script>
	<?php
	}
}
add_action('wp_footer','fotography_sly_gallery_layout');

/* ==============================CUSTOM CSS================================ */
function fotography_custom_stylesheet(){
	$custom_css = get_theme_mod('fotography_css_section');	
	?>
		<style type="text/css">
			<?php 
				$fg_theme_color = get_theme_mod('fotography_primary_theme_color');
				$ft_rgba_bg_color = hex2rgba($fg_theme_color,0.65);
				$theme_colors = " .site-header, .fg_service hr, .post-item .item-img > a .fg_time, 
				.post-item .item-img .fg_category_count .fg_comment a:hover,
				.call-to-action-title:after,
				#back-to-top:hover, #secondary .widget-title,
				#secondary .widget-title span,
				.pagination span, .pagination a { background: ".$fg_theme_color." }\n";
				
				$theme_colors .= " .counter-five span i.fa, 
					.counter-four span i.fa, .counter-three span i.fa, 
					.counter-two span i.fa, .counter-one span i.fa, .fg_gallery header.default-title, 
					.home_gallery header.default-title, .home_instaghram .widget-title, 
					.fg_service header.services-page-title, .fg-homeblogs .services-page-title,
					.quick_contact.clearfix>div a, .call-to-action-title,
					.clll-to-action-button a, .grid-hover_inner a.home-title-main:hover, 
					.grid-hover_inner .home-category a:hover, .mid-gallery > a:hover, span.outer,
					.grid_details_inner .gallery-meta a:hover, .grid_details_inner .gallery-title a:hover,
					.entry-content a:hover, .pagination .current,
					#secondary.left>aside ul>li:hover a,
					.team-name, .testimonial-name{ 
								color: ".$fg_theme_color.";
				}\n";

				$theme_colors .= ".fg-homeblogs .services-page-title::after,
				.clll-to-action-button a, .caption a,
				.mid-gallery > a::after,
				.pagination span, .pagination a, .fg_testimonial img { border-color: ".$fg_theme_color." }\n";

				$theme_colors .= ".fg-banner-slider .bx-wrapper .bx-pager.bx-default-pager a.active,
				 .fg-banner-slider .bx-wrapper .bx-pager.bx-default-pager a:hover{ 
					box-shadow: 0 0 0 7px ".$fg_theme_color." inset;
				}\n";

				$theme_colors .= ".caption a:hover, .clll-to-action-button a:hover { background: ".$ft_rgba_bg_color." }\n";

				//echo $theme_colors
			?>
			<?php if (!empty($custom_css)) { echo $custom_css; } ?>
		</style>
	<?php 
}
add_action('wp_head','fotography_custom_stylesheet');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Implement Repeater Control
 */
require get_template_directory() . '/inc/class-repeater.php';


/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Implement the custom metabox feature
 */
require get_template_directory() . '/inc/fotography-functions.php';

/******************************* Video Display ***************************************/
function fotography_get_first_embed_media($post_id) {
    $post = get_post($post_id);
    $content = do_shortcode( apply_filters( 'the_content', $post->post_content ) );
    $embeds = get_media_embedded_in_content( $content, $html = false );
    if( !empty($embeds) ) {
        foreach( $embeds as $embed ) {
            if( strpos( $embed, 'video' ) || strpos( $embed, 'youtube' ) || strpos( $embed, 'vimeo' ) ) {
                return $embed;
            }
        }
    } else {
        return false;
    }
}

/******************************* Pagination ***************************************/
function pagination($pages = '', $range = 2){  
     $showitems = ($range * 2)+1;  
      global $paged;
     if(empty($paged)) $paged = 1; 
     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   
 
     if(1 != $pages)
     {
         echo "<div class=\"pagination\"><span>Page ".$paged." of ".$pages."</span>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo; First</a>";
          if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo; Previous</a>";
  
          for ($i=1; $i <= $pages; $i++)
          {
              if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
              {
                  echo ($paged == $i)? "<span class=\"current\">".$i."</span>":"<a href='".get_pagenum_link($i)."' class=\"inactive\">".$i."</a>";
              }
          }
  
          if ($paged < $pages && $showitems < $pages) echo "<a href=\"".get_pagenum_link($paged + 1)."\">Next &rsaquo;</a>";  
          if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>Last &raquo;</a>";
          echo "</div>\n";
      }
 }

 /**
 * @param string $code name of the shortcode
 * @param string $content
 * @return string content with shortcode striped
 */
function fotography_strip_shortcode($code, $content){
    global $shortcode_tags;
    $stack = $shortcode_tags;
    $shortcode_tags = array($code => 1);
    $content = strip_shortcodes($content);
    $shortcode_tags = $stack;
    return $content;
}

/* Convert hexdec color string to rgb(a) string */
 
function hex2rgba($color, $opacity = false) { 
	 $default = 'rgb(0,0,0)'; 
	 //Return default if no color provided
	 if(empty($color))
	          return $default;  
	 //Sanitize $color if "#" is provided 	
        if ($color[0] == '#' ) {
         $color = substr( $color, 1 );
        }
 
        //Check if color has 6 or 3 characters and get values
        if (strlen($color) == 6) {
                $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
        } elseif ( strlen( $color ) == 3 ) {
                $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
        } else {
                return $default;
        }
 
        //Convert hexadec to rgb
        $rgb =  array_map('hexdec', $hex);
 
        //Check if opacity is set(rgba or rgb)
        if($opacity){
         if(abs($opacity) > 1)
         $opacity = 1.0;
         $output = 'rgba('.implode(",",$rgb).','.$opacity.')';
        } else {
         $output = 'rgb('.implode(",",$rgb).')';
        }
 
        //Return rgb(a) color string
        return $output;
}
//add_filter('show_admin_bar', '__return_false');

/* ------------------------------------------------------------------*/
/* ADD PRETTYPHOTO REL ATTRIBUTE FOR LIGHTBOX */
/* ------------------------------------------------------------------*/
add_filter('wp_get_attachment_link', 'fotography_add_rel_attribute');
function fotography_add_rel_attribute($link) {
	global $post;
	return str_replace('<a href', '<a rel="prettyPhoto[pp_gal]" href', $link);
}


/**
 * Query WooCommerce activation
 * @since  1.0.0
 */

if ( ! function_exists( 'is_woocommerce_activated' ) ) {
	function is_woocommerce_activated() {
		return class_exists( 'woocommerce' ) ? true : false;
	}
}

remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );

/**
 * Woo Commerce Add Content Primary Div Function
**/

remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
if (!function_exists('fotography_woocommerce_output_content_wrapper')) {
    function fotography_woocommerce_output_content_wrapper(){ ?>
        <?php do_action('fotography_woo_title');  ?>
        <div class="foto-container clearfix">
	    	<div id="primary" class="content-area">
    <?php   }
}
add_action( 'woocommerce_before_main_content', 'fotography_woocommerce_output_content_wrapper', 10 );

remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
if (!function_exists('fotography_woocommerce_output_content_wrapper_end')) {
    function fotography_woocommerce_output_content_wrapper_end(){ ?>
            </div><!-- #main -->

            <div id="secondary" class="widget-area">
            	<?php dynamic_sidebar( 'fotography-right-sidebar' ); ?>
            </div>

        </div><!-- #primary -->
    <?php   }
}
add_action( 'woocommerce_after_main_content', 'fotography_woocommerce_output_content_wrapper_end', 10 );

/**
 * Remove WooCommerce Default Sidebar
**/
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10);


remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
function fotography_woocommerce_template_loop_product_thumbnail(){
	echo '<div class="img-holder">';
		woocommerce_template_loop_product_thumbnail();
	echo '</div>';
}
add_action( 'woocommerce_before_shop_loop_item_title', 'fotography_woocommerce_template_loop_product_thumbnail', 10);


/**
 * Woo Commerce Number of row filter Function
**/

add_filter('loop_shop_columns', 'fotography_loop_columns');
if (!function_exists('fotography_loop_columns')) {
    function fotography_loop_columns() {        
        return 3;
    }
}

add_action( 'body_class', 'fotography_woo_body_class');
if (!function_exists('fotography_woo_body_class')) {
    function fotography_woo_body_class( $class ) {
           $class[] = 'columns-'.fotography_loop_columns();
           return $class;
    }
}

/**
 * Woo Commerce Related product
**/

add_filter( 'woocommerce_output_related_products_args', 'storevilla_pro_related_products_args' );
function storevilla_pro_related_products_args( $args ) {
    $args['posts_per_page']     = 3;
    $args['columns']            = 3;
    return $args;
}


/**
 * Woo Commerce Breadcrumbs
**/
add_filter( 'woocommerce_show_page_title' , 'fotography_hide_page_title' );
function fotography_hide_page_title() {
	return false;
}

remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );

/**
 * Woo Commerce Breadcrumbs and title function
**/
 if ( ! function_exists( 'fotography_woocommerce_page_title' ) ) :
    function fotography_woocommerce_page_title(){ ?>
    	<header class="page-header" <?php if(!empty($fgpage_titlebar_bgimage)) { ?> style="background-image:url(<?php echo esc_url($fgpage_titlebar_bgimage); ?>); background-size: cover;"<?php } ?>>
            <div class="foto-container">
                <h1><?php the_title(); ?></h1>
                <?php woocommerce_breadcrumb(); ?>
            </div>
        </header>
    <?php
    }
endif;
add_action('fotography_woo_title','fotography_woocommerce_page_title');



