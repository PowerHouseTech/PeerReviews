<?php

// =============================================================================
// FUNCTIONS.PHP
// -----------------------------------------------------------------------------
// Theme functions for X.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Set Paths
//   02. Require Files
// =============================================================================

// Set Paths
// =============================================================================

$func_path = 'framework/functions';
$glob_path = 'framework/functions/global';
$admn_path = 'framework/functions/global/admin';
$eque_path = 'framework/functions/global/enqueue';
$plgn_path = 'framework/functions/global/plugins';



// Require Files
// =============================================================================


//
// Debugging, conditionals, helpers, and stack data.
//

require_once( $glob_path . '/debug.php' );
require_once( $glob_path . '/conditionals.php' );
require_once( $glob_path . '/helper.php' );
require_once( $glob_path . '/stack-data.php' );
require_once( $glob_path . '/tco-setup.php' );


//
// Admin.
//

require_once( $admn_path . '/thumbnails/setup.php' );
require_once( $admn_path . '/setup.php' );
require_once( $admn_path . '/migration.php' );
require_once( $admn_path . '/meta/setup.php' );
require_once( $admn_path . '/sidebars.php' );
require_once( $admn_path . '/widgets.php' );
require_once( $admn_path . '/custom-post-types.php' );
require_once( $admn_path . '/customizer/setup.php' );
require_once( $admn_path . '/addons/setup.php' );


//
// Enqueue styles and scripts.
//

require_once( $eque_path . '/styles.php' );
require_once( $eque_path . '/scripts.php' );


//
// Global functions.
//

require_once( $glob_path . '/meta.php' );
require_once( $glob_path . '/featured.php' );
require_once( $glob_path . '/pagination.php' );
require_once( $glob_path . '/navbar.php' );
require_once( $glob_path . '/breadcrumbs.php' );
require_once( $glob_path . '/classes.php' );
require_once( $glob_path . '/portfolio.php' );
require_once( $glob_path . '/social.php' );
require_once( $glob_path . '/content.php' );
require_once( $glob_path . '/remove.php' );


//
// Stack specific functions.
//

require_once( $func_path . '/integrity.php' );
require_once( $func_path . '/renew.php' );
require_once( $func_path . '/icon.php' );
require_once( $func_path . '/ethos.php' );


//
// Integrated plugins.
//

require_once( $plgn_path . '/cornerstone.php' );

if ( X_BBPRESS_IS_ACTIVE ) {
  require_once( $plgn_path . '/bbpress.php' );
}

if ( X_BUDDYPRESS_IS_ACTIVE ) {
  require_once( $plgn_path . '/buddypress.php' );
}

if ( X_CONVERTPLUG_IS_ACTIVE ) {
  require_once( $plgn_path . '/convertplug.php' );
}

if ( X_ENVIRA_GALLERY_IS_ACTIVE ) {
  require_once( $plgn_path . '/envira-gallery.php' );
}

if ( X_ESSENTIAL_GRID_IS_ACTIVE ) {
  require_once( $plgn_path . '/essential-grid.php' );
}

if ( X_LAYERSLIDER_IS_ACTIVE ) {
  require_once( $plgn_path . '/layerslider.php' );
}

if ( X_REVOLUTION_SLIDER_IS_ACTIVE ) {
  require_once( $plgn_path . '/revolution-slider.php' );
}

if ( X_SOLILOQUY_IS_ACTIVE ) {
  require_once( $plgn_path . '/soliloquy.php' );
}

if ( X_VISUAL_COMOPSER_IS_ACTIVE ) {
  require_once( $plgn_path . '/visual-composer.php' );
}

if ( X_WOOCOMMERCE_IS_ACTIVE ) {
  require_once( $plgn_path . '/woocommerce.php' );
}

if ( X_WPML_IS_ACTIVE ) {
  require_once( $plgn_path . '/wpml.php' );
}

// function bpdev_custom_fb_login_button( $btn_label = '' ){
//         echo bpdev_custom_get_fb_login_button( $btn_label );
// }

// function  bpdev_custom_get_fb_login_button( $btn_label = '' ){

//         $fb = BPDevFacebook::get_instance();
//         //if user is already logged in, do not show the button
//         if( $fb->get_current_user_id() || is_user_logged_in() || !bp_get_signup_allowed() )
//                 return;


//         $helper = BPDevFBUserSettings::get_instance();

//          $permissions = $helper->get_permissions();
//             //pass a label for chaning the login text
//          return "<div class='fb-login-button' data-scope='".$permissions."'><a href='#'>".$label."</a></div>";//so incase the custom text is given

// }

// Add Shortcode for LOGOUT LINK
function logout_link() {
  return "<a href='" . wp_logout_url( home_url() ) . "' class='logout_link'>LOG OUT</a>";
}
add_shortcode( 'logout_link', 'logout_link' );


// Private Message Link
function bpfr_pm_to_author() {  

  $author = get_the_author();

  echo '<a href="'.wp_nonce_url( bp_loggedin_user_domain() . bp_get_messages_slug() . '/compose/?r=' . get_the_author() ) .' title="Private Message"">Message</a>';
} 

// Reverse order of comments from oldest to newest
 add_filter( 'comments_array', 'array_reverse' );

 //Fix Footer Responsive issues
 add_action('wp_footer', 'embed_footer_CSS');

function embed_footer_CSS () { ?><style>

@media (max-width : 979px) {

      #rommeled_image-6 {
         display: none !important;
      }

      #rommeled_image-5,
      .x-colophon-content {
          width: 100%;
          text-align: center;
      }

      .x-colophon.bottom .x-nav {
      float: none !important;
      }
}

</style><?php }