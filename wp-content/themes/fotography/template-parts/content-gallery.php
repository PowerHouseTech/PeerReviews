<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package FotoGraphy
 */

    if( has_post_thumbnail() ) : ?>
    <?php
        
        $image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'fotography-grid-large');
        $img_src_full = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
    ?>
        <div class="fb-gallery  element-item">           
                <div class="fg-grid-img">
                    <img src="<?php echo esc_url($image[0]); ?>" alt="<?php the_title(); ?>">
                </div>
                
                <div class="fg-grid-hover"> 
                    <h6>
                        <a href="<?php the_permalink(); ?>">
                            <?php the_title(); ?>
                        </a>                                                            
                    </h6>

                    <div class="gallery-open-link">
                        <a href="<?php echo esc_url($img_src_full[0]); ?>" rel="gallryLight"><i class="fa fa-eye"></i></a>
                        <a href="<?php the_permalink(); ?>"><i class="fa fa-link"></i></a>
                    </div>

                    <div class="fg-masonary-gallery-cat">
                        <?php the_category(', '); ?>
                    </div>

                </div>
        </div> 
    <?php
    endif; 