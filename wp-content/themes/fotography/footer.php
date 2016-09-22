<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package FotoGraphy
 */
?>
</div><!-- #content -->

<footer id="colophon" class="site-footer">
    <?php
        $post_format = get_post_format();
        if($post_format == 'image' && is_single() ){
        }else{
    ?>
    <?php if(is_active_sidebar('fotography_footer_one') || is_active_sidebar('fotography_footer_two') || is_active_sidebar('fotography_footer_three') || is_active_sidebar('fotography_footer_four')) { ?>
            <div class="top-footer">
                <div class="foto-container">
                    <div class="footer-wrap clearfix">
                        <div class="footer-block">
                        <?php dynamic_sidebar('fotography_footer_one'); ?>
                        </div>

                        <div class="footer-block">
                        <?php dynamic_sidebar('fotography_footer_two'); ?>
                        </div>

                        <div class="footer-block">
                        <?php dynamic_sidebar('fotography_footer_three'); ?>
                        </div>

                        <div class="footer-block">
                        <?php dynamic_sidebar('fotography_footer_four'); ?>
                        </div>
                    </div>
                </div>
            </div>
    <?php } } ?>
    
    <div class="site-info">
        <div class="foto-container">

            <?php  if ( is_active_sidebar( 'fotography-social-icon' ) ) : ?>
                <div class="footer-social-media">
                    <?php dynamic_sidebar('fotography-social-icon'); ?>                   
                </div>
            <?php endif; ?>


            <div class="copyright">
               <?php 
                    $copyright = get_theme_mod('fotography_copyright');
                    echo '<span>';
                    if(!empty($copyright)) :
                        echo $copyright;
                    else:
                      printf(__('&copy; %1$s %2$s', 'fotography'), get_the_time("Y"), get_bloginfo('name'));
                    endif;
                  ?></span> - <?php  
                      printf( __( 'WordPress Theme : %1$s by %2$s', 'fotography' ), '<a href="'.esc_url('https://wordpress.org').'">FotoGraphy Lite</a>', '<a href="'.esc_url('https://accesspressthemes.com' ).'">AccessPress Themes</a>'  );                  
                  ?>
            </div>
        </div>
    </div><!-- .site-info -->
</footer><!-- #colophon -->

<!-- Go To Top Button here -->
<a href="#" id="back-to-top" title="Back to top">&uarr;</a>

<?php 
    global $post;
    $layouts = esc_attr(get_post_meta($post->ID, 'fotography_gallery_layouts', true));
    if( $layouts == 'classic' && is_single() ) : 
?>
<!-- photoswipe gallery popup div section -->
 <div id="gallery" class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="pswp__bg"></div>
    <div class="pswp__scroll-wrap">

      <div class="pswp__container">
        <div class="pswp__item"></div>
        <div class="pswp__item"></div>
        <div class="pswp__item"></div>
      </div>

      <div class="pswp__ui pswp__ui--hidden">

        <div class="pswp__top-bar">

            <div class="pswp__counter"></div>

            <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>

            <button class="pswp__button pswp__button--share" title="Share"></button>

            <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>

            <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>

            <div class="pswp__preloader">
                <div class="pswp__preloader__icn">
                  <div class="pswp__preloader__cut">
                    <div class="pswp__preloader__donut"></div>
                  </div>
                </div>
            </div>
        </div>

        <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
            <div class="pswp__share-tooltip">
            </div>
        </div>

        <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)"></button>
        <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)"></button>
        <div class="pswp__caption">
          <div class="pswp__caption__center">
          </div>
        </div>
      </div>
    </div>
</div>
<?php endif; ?>
</div><!-- #page -->
<?php wp_footer(); ?>
</body>
</html>