<?php

// =============================================================================
// VIEWS/GLOBAL/_COMMENTS-TEMPLATE.PHP
// -----------------------------------------------------------------------------
// Comments output for pages, posts, and portfolio items.
// =============================================================================

$stack           = x_get_stack();
$container_begin = ( $stack == 'icon' ) ? '<div class="x-container max width">' : '';
$container_end   = ( $stack == 'icon' ) ? '</div>' : '';

?>

<?php if ( comments_open() ) : ?>
  <?php echo $container_begin; ?>
  	<div id="user_pic" class="user_pic">
    <?php if ( is_user_logged_in() ):

   echo get_avatar(wp_get_current_user(), 60); 
  
   endif; ?>
</div>
    <?php comments_template( '', true ); ?>
  <?php echo $container_end; ?>
<?php endif; ?>