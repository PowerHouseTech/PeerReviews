<?php

// =============================================================================
// VIEWS/INTEGRITY/WP-SINGLE.PHP
// -----------------------------------------------------------------------------
// Single post output for Integrity.
// =============================================================================

$fullwidth = get_post_meta( get_the_ID(), '_x_post_layout', true );

?>

<?php get_header(); ?>
  
  <div class="x-container max width offset">
   
    <div class="<?php x_main_content_class(); ?>" role="main">

    

      <?php while ( have_posts() ) : the_post(); ?>
        
        <?php x_get_view( 'integrity', 'content', get_post_format() ); ?>

        <!-- Customizations   -->

        <div class="article_views"> <?php if ( function_exists ( 'echo_tptn_post_count' ) ) echo_tptn_post_count(); ?> </div>
        <div class="article_date"> <?php the_date( 'm/d/y' ); ?> </div>

        <div class="author_name"> <?php the_author_meta( display_name ); ?> </div> 

        <div class="start_follow"> 
          <?php
          if ( function_exists( 'bp_follow_add_follow_button' ) ) :
            // This is the logic for the follow button on the article pages.
            // I'm struggling to apply logic for when the logged-in user is also the author.
            // We want the button to allow that author to edit the story (rather than follow oneself).
            // Open for suggestions/input!
              if ( bp_loggedin_user_id() && bp_loggedin_user_id() != get_the_author_meta( 'ID' ) ) {
                  bp_follow_add_follow_button( array(
                      'leader_id'   => get_the_author_meta( 'ID' ),
                      'follower_id' => bp_loggedin_user_id()
                  ) );
              }
          endif;
          ?>
        </div>

        <div class="private_message"> <?php bpfr_pm_to_author(); ?> </div>

        <div class="article_summary"> <?php the_excerpt(); ?> </div>
        <div class="article_categories"> <?php the_category( ', ' ); ?> </div>

        <a class="invite_readers" title="Invite Readers" href="#" onclick="javascript:window.location='mailto:?subject=My Writespike Story&body=Please read my story on the Writespike site: %0D%0A %0D%0A' + window.location;"></a>
        
        <!-- END OF Customizations -->


        <?php x_get_view( 'global', '_comments-template' ); ?>

      <?php endwhile; ?>

    </div>

    <?php if ( $fullwidth != 'on' ) : ?>
      <?php get_sidebar(); ?>
    <?php endif; ?>

  </div>

 

<?php get_footer(); ?>
