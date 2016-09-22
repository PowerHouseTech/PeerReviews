<?php
/**
 * The header for our theme.
 *
 * @package FotoGraphy
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>> 
    <header id="masthead" class="site-header">
           
        <div class="foto-container clearfix">
            <div class="header-logo">
                <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                    <?php if (get_header_image()) : ?>
                        <div class="logo-image">
                            <img src="<?php header_image(); ?>" alt="<?php bloginfo('name'); ?>">
                        </div>
                    <?php endif; ?>
                    <div class="site-branding">
                        <h1 class="site-title">
                            <?php bloginfo('name'); ?>
                        </h1>
                        <p class="site-description"><?php bloginfo('description'); ?></p>
                    </div><!-- .site-branding -->                                
                </a>                            
                <?php //endif; ?>
            </div>


            <div class="fg-toggle-nav"><span></span></div>
            <nav id="site-navigation" class="main-navigation clearfix">
                <?php wp_nav_menu(array('theme_location' => 'primary', 'menu_id' => 'primary-menu', 'container' => false, 'menu_class'=>'clearfix')); ?>
            </nav><!-- #site-navigation -->  
        </div>

    </header><!-- #masthead -->   

    <div id="page" class="hfeed site <?php if (!(is_home() || is_front_page())) { echo $class = 'inner'; } ?>">
        <?php
            if (is_front_page() && !is_home()) :
                fotography_main_slider();
            endif;
        ?>
        <div id="content" class="site-content">