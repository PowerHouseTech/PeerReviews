<?php
/**
 * @package FotoGraphy
 */

global $post;
$layouts = esc_attr(get_post_meta($post->ID, 'fotography_gallery_layouts', true));
?>

    <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>
        <div class="fg-gallery-images">
        <?php
        if (!empty($layouts) && $layouts == 'classic') {
            global $post;
            $galleries = get_post_galleries($post, false);
            if (!empty($galleries)) {
                $galleries = $galleries[0]['ids'];
                $single_gallery = explode(',', $galleries);
                ?>
                <div id="classic-gallery-wrap">
                    <div class="classic-gallery clearfix" data-pswp-uid="1">
                        <?php
                        foreach ($single_gallery as $gallery) {
                            $image = wp_get_attachment_image_src($gallery, 'fotography-grid-small', true);
                            $image_full = wp_get_attachment_image_src($gallery, 'full', true);
                            ?>
                            <a href="<?php echo esc_url($image_full[0]); ?>" data-size="1600x1068" data-med="<?php echo esc_url($image_full[0]); ?>" data-med-size="1024x683">
                            <i class="fa fa-search-plus"></i>
                            <img src="<?php echo esc_url($image[0]); ?>" />
                            </a>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
            <?php
        } else if (!empty($layouts) && $layouts == 'folio') {
            global $post;
            $galleries = get_post_galleries($post, false);
            if (!empty($galleries)) {
                $galleries = $galleries[0]['ids'];
                $single_gallery = explode(',', $galleries);
                ?>
                <div class="folio-gallery">
                    <ul id="light-gallery" class="clearfix fg-light-box">
                        <?php
                            foreach ($single_gallery as $gallery) {
                                $image = wp_get_attachment_image_src($gallery, 'fotography-grid-small', true);
                                $image_full = wp_get_attachment_image_src($gallery, 'full', true);
                                ?>		
                                <li data-src="<?php echo esc_url($image_full[0]); ?>">
                                        <i class="fa fa-search-plus"></i>
                                        <img src="<?php echo esc_url($image[0]); ?>" />
                                </li>        
                                <?php
                                }
                            }
                        ?>
                    </ul>
                </div>
            <?php
        } else {
            ?>
            <div id="fg-sly-gallery">
                <?php
                global $post;
                $galleries = get_post_galleries($post, false);
                if (!empty($galleries)) {
                    $galleries = $galleries[0]['ids'];
                    $single_gallery = explode(',', $galleries);
                    ?>
                    <div class="frame">
                        <ul class="slidee">
                            <?php
                            $i = mt_rand(0, 9999);
                            foreach ($single_gallery as $gallery) {
                                $image = wp_get_attachment_image_src($gallery, 'fotography-sly', true);
                                $image_full = wp_get_attachment_image_src($gallery, 'full', true);
                                ?>		
                                <li>
                                    <img data-width="<?php echo $image[1]; ?>" data-height="<?php echo $image[2]; ?>" src="<?php echo esc_url($image[0]); ?>" />
                                    <div class="img-popup">
                                        <a href="<?php echo esc_url($image_full[0]); ?>" rel="prettyPhoto[<?php echo $i; ?>]"><i class="fa fa-search-plus"></i></a>
                                    </div>				       		
                                </li>		       

                                <?php
                            }
                        }
                        ?>
                    </ul>
                    
                </div>
                <div class="scrollbar">
                    <div class="handle">
                    </div>
                </div>

                <div class="controls">		
                    <button class="prev"><i class="fa fa-long-arrow-left"></i></button>
                    <button class="next"><i class="fa fa-long-arrow-right"></i></button>
                </div>
            </div>
            <div id="repos" class="repos" data-display="motio,espy,imagesloaded,fpsmeter"></div>
        <?php } ?>
        </div>

        <div class="fg-gallery-detail">
            <header class="entry-header">
                <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
             
                <div class="entry-meta">
                    <span><i class="fa fa-folder-open"></i> <?php the_category(', ') ?></span> 
                </div><!-- .entry-meta -->
            </header><!-- .entry-header -->

            <div class="entry-content">
                <?php
                   ob_start();
                   the_content();
                   $postOutput = preg_replace('/<img[^>]+./','', ob_get_contents());
                   ob_end_clean();
                   echo $postOutput;
                ?>
            </div><!-- .entry-content -->
        </div>
    </article><!-- #post-## -->