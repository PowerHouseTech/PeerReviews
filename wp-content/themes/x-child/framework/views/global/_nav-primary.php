<?php

// =============================================================================
// VIEWS/GLOBAL/_NAV-PRIMARY.PHP
// -----------------------------------------------------------------------------
// Outputs the primary nav.
// =============================================================================

?>

<nav class="x-nav-wrap desktop" role="navigation">
  <?php x_output_primary_navigation(); ?>
  <div class=login-nav>
  <?php if (!is_user_logged_in()) { ?>
  	<?php AnythingPopup('[ANYTHING-POPUP:1]'); }?>
  </div>
</nav>
<?php echo do_shortcode( '[responsive_menu]' ); ?>