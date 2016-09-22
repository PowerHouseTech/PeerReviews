<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package FotoGraphy
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function fotography_body_classes( $classes ) {
    
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

    if(is_singular(array('post','page'))){
        global $post;
        $post_sidebar = get_post_meta($post->ID, 'fotography_page_layouts', true);
        if(!$post_sidebar){
            $post_sidebar = 'rightsidebar';
        }
        $classes[] = $post_sidebar;
    }

    if( is_archive() || is_home() || is_search() ){
        $post_sidebar = get_theme_mod( 'fotography_archive_page_layout','rightsidebar' );
        if(!$post_sidebar){
            $post_sidebar = 'rightsidebar';
        }
        $classes[] = $post_sidebar;
    }

    if (esc_attr(get_theme_mod('fotography_homepage_slider_setting_option','disable')) == 'disable') {
        $classes[] = 'fg-noslider';
    }
	return $classes;
}
add_filter( 'body_class', 'fotography_body_classes' );

if ( version_compare( $GLOBALS['wp_version'], '4.1', '<' ) ) :
	/**
	 * Filters wp_title to print a neat <title> tag based on what is being viewed.
	 *
	 * @param string $title Default title text for current view.
	 * @param string $sep Optional separator.
	 * @return string The filtered title.
	 */
	function fotography_wp_title( $title, $sep ) {
		if ( is_feed() ) {
			return $title;
		}

		global $page, $paged;

		// Add the blog name.
		$title .= get_bloginfo( 'name', 'display' );

		// Add the blog description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) ) {
			$title .= " $sep $site_description";
		}

		// Add a page number if necessary.
		if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
			$title .= " $sep " . sprintf( esc_html__( 'Page %s', 'fotography' ), max( $paged, $page ) );
		}

		return $title;
	}
	add_filter( 'wp_title', 'fotography_wp_title', 10, 2 );

	/**
	 * Title shim for sites older than WordPress 4.1.
	 *
	 * @link https://make.wordpress.org/core/2014/10/29/title-tags-in-4-1/
	 * @todo Remove this function when WordPress 4.3 is released.
	 */
	function fotography_render_title() {
		?>
		<title><?php wp_title( '|', true, 'right' ); ?></title>
		<?php
	}
	add_action( 'wp_head', 'fotography_render_title' );
endif;

 /************************************************************
 ** Breadcrumb Settings                                     **
 ************************************************************/
 if ( ! function_exists( 'fotography_pro_breadcrumbs' ) ) :
    function fotography_pro_breadcrumbs() {
        global $post;
        $showOnHome = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
        $delimiter = '>';        
        $home = __('Home', 'fotography'); // text for the 'Home' link
        $showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
        $before = '<span class="current">'; // tag before the current crumb
        $after = '</span>'; // tag after the current crumb
        $homeLink = home_url();
            if (is_home() || is_front_page()) {
                if ($showOnHome == 1)
                    echo '<div id="fotography-breadcrumb"><a href="' . $homeLink . '">' . $home . '</a></div></div>';
            } else {
                echo '<div id="fotography-breadcrumb"><a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . ' ';

            if (is_category()) {
                $thisCat = get_category(get_query_var('cat'), false);
                if ($thisCat->parent != 0)
                    echo get_category_parents($thisCat->parent, TRUE, ' ' . $delimiter . ' ');
                echo $before . __('Archive by category','fotography').' "' . single_cat_title('', false) . '"' . $after;
            } elseif (is_search()) {
                echo $before . __('Search results for','fotography'). '"' . get_search_query() . '"' . $after;
            } elseif (is_day()) {
                echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
                echo '<a href="' . get_month_link(get_the_time('Y'), get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
                echo $before . get_the_time('d') . $after;
            } elseif (is_month()) {
                echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
                echo $before . get_the_time('F') . $after;
            } elseif (is_year()) {
                echo $before . get_the_time('Y') . $after;
            } elseif (is_single() && !is_attachment()) {
                if (get_post_type() != 'post') {
                    $post_type = get_post_type_object(get_post_type());
                    $slug = $post_type->rewrite;
                    echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a>';
                    if ($showCurrent == 1)
                        echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
                } else {
                    $cat = get_the_category();
                    $cat = $cat[0];
                    $cats = get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
                    if ($showCurrent == 0)
                        $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
                    echo $cats;
                    if ($showCurrent == 1)
                        echo $before . get_the_title() . $after;
                }
            } elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {
                $post_type = get_post_type_object(get_post_type());
                echo $before . $post_type->labels->singular_name . $after;
            } elseif (is_attachment()) {
                $parent = get_post($post->post_parent);
                $cat = get_the_category($parent->ID);
                $cat = $cat[0];
                echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
                echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a>';
                if ($showCurrent == 1)
                    echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
            } elseif (is_page() && !$post->post_parent) {
                if ($showCurrent == 1)
                    echo $before . get_the_title() . $after;
            } elseif (is_page() && $post->post_parent) {
                $parent_id = $post->post_parent;
                $breadcrumbs = array();
                while ($parent_id) {
                    $page = get_page($parent_id);
                    $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
                    $parent_id = $page->post_parent;
                }
                $breadcrumbs = array_reverse($breadcrumbs);
                for ($i = 0; $i < count($breadcrumbs); $i++) {
                    echo $breadcrumbs[$i];
                    if ($i != count($breadcrumbs) - 1)
                        echo ' ' . $delimiter . ' ';
                }
                if ($showCurrent == 1)
                    echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
            } elseif (is_tag()) {
                echo $before . __('Posts tagged','fotography').' "' . single_tag_title('', false) . '"' . $after;
            } elseif (is_author()) {
                global $author;
                $userdata = get_userdata($author);
                echo $before . __('Articles posted by ','fotography'). $userdata->display_name . $after;
            } elseif (is_404()) {
                echo $before . 'Error 404' . $after;
            }

            if (get_query_var('paged')) {
                if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author())
                    echo ' (';
                        echo __('Page', 'fotography') . ' ' . get_query_var('paged');
                        if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author())
                            echo ')';
            }

        echo '</div>';
        }
    }
endif;


 if ( ! function_exists( 'fotography_page_title' ) ) :
    function fotography_page_title(){
    ?>
    	<header class="page-header">
            <div class="foto-container">
                <h1><?php the_title(); ?></h1>
                <?php echo fotography_pro_breadcrumbs(); ?>
            </div>
        </header>
    <?php
    }
endif;
add_action('fotography_title','fotography_page_title');

function fotography_remove_div ( $menu ){
    return preg_replace( array( '#^<div[^>]*>#', '#</div>$#' ), '', $menu );
}
add_filter( 'wp_page_menu', 'fotography_remove_div' );

/**
 * Generate custom search form
 *
 * @param string $form Form HTML.
 * @return string Modified form HTML.
 */
function fotography_search_form( $form ) {
    $form = '<form role="search" method="get" id="searchform" class="searchform" action="' . home_url( '/' ) . '" >
    <div>
    <input type="text" value="' . get_search_query() . '" name="s" id="s" />
    <button id="searchsubmit" /><i class="fa fa-search"></i></button>
    </div>
    </form>';
 
    return $form;
}
add_filter( 'get_search_form', 'fotography_search_form' );


if(class_exists( 'WP_Customize_control')) :
class WP_Customize_Radioimage_Control extends WP_Customize_Control {
    public $type = 'radioimage';
    public function render_content() {
        $name = '_customize-radio-' . $this->id;
        ?>
        <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
        <div id="input_<?php echo $this->id; ?>" class="image">
            <?php foreach ( $this->choices as $value => $label ) : ?>                
                    <label for="<?php echo $this->id . $value; ?>">
                        <input class="image-select" type="radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $name ); ?>" id="<?php echo $this->id . $value; ?>" <?php $this->link(); checked( $this->value(), $value ); ?>>
                        <img src="<?php echo esc_html( $label ); ?>"/>
                    </label>
            <?php endforeach; ?>
        </div>
        <?php 
    }
}
endif;