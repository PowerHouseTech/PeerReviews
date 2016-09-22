<?php
/**
 * Workfree functions and definitions
 *
 * @package Workfree
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'workfree_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function workfree_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Workfree, use a find and replace
	 * to change 'workfree' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'workfree', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

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
	
	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'workfree' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'workfree_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // workfree_setup
add_action( 'after_setup_theme', 'workfree_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function workfree_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'workfree' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'workfree_widgets_init' );


/* REGISTER WIDGETS ------------------------------------------------------------*/

if (function_exists('register_sidebar')) {
    register_sidebar(array(
        'name' => __( 'Footer Left', 'workfree' ),
        'id'   => 'footer-left-widget',
        'description'   => '',
        'before_widget' => '<div id="%1$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2>',
        'after_title'   => '</h2>'
    ));

    register_sidebar(array(
        'name' => __( 'Footer Center', 'workfree' ),
        'id'   => 'footer-center-widget',
        'description'   => '',
        'before_widget' => '<div id="%1$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2>',
        'after_title'   => '</h2>'
    ));
    
    register_sidebar(array(
        'name' => __( 'Footer Right', 'workfree' ), 
        'id'   => 'footer-right-widget',
        'description'   => '',
        'before_widget' => '<div id="%1$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2>',
        'after_title'   => '</h2>'
    ));


}

/* Pagination */

function workfree_pagination($pages = '', $range = 2)
{  
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
         echo "<div class='pagination'>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo;</a>";
         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a>";

         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<span class='current'>".$i."</span>":"<a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a>";
             }
         }

         if ($paged < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a>";  
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>&raquo;</a>";
         echo "</div>\n";
     }
}


/**
 * Enqueue scripts and styles.
 */
function workfree_scripts() {
	wp_enqueue_style( 'workfree-style', get_stylesheet_uri());
	
	wp_enqueue_style('workfree-style-custom',get_template_directory_uri(). '/custom.css');

	wp_enqueue_script( 'workfree-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'workfree-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );
	
	

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'workfree_scripts' );

	$args = array(
	'flex-width'    => true,
	'width'         => 980,
	'flex-height'    => true,
	'height'        => 200,
	'default-image' => get_template_directory_uri() . '/assets/images/default-header1.jpg',
);
add_theme_support( 'custom-header', $args );

register_default_headers( array(
    'default-image' => array(
    'url'   => get_template_directory_uri() . '/assets/images/default-header1.jpg',

    'thumbnail_url' => get_template_directory_uri() . '/assets/images/default-header1.jpg',


)));

/**
 * Implement the Custom Header feature.
 */
 
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
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';



