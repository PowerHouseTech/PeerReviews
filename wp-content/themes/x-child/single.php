<?php

// =============================================================================
// SINGLE.PHP
// -----------------------------------------------------------------------------
// Handles output of individual posts.
//
// Content is output based on which Stack has been selected in the Customizer.
// To view and/or edit the markup of your Stack's posts, first go to "views"
// inside the "framework" subdirectory. Once inside, find your Stack's folder
// and look for a file called "wp-single.php," where you'll be able to find the
// appropriate output.
// =============================================================================

?>

<?php x_get_view( x_get_stack(), 'wp', 'single' ); ?>
<div id="author_pic">
<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" rel="author">
<?php echo get_avatar( get_the_author_meta('ID'), 60); ?></a>
</div>