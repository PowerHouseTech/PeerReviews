<?php
/**
 * Template part for displaying posts.
 *
 * @package FotoGraphy
 */
$blog_layout = esc_attr(get_theme_mod('fotography_blog_page_archive_section','mediumthumbslistview'));
if( has_post_thumbnail() ) {
if(!empty($blog_layout) && $blog_layout == 'mediumthumbslistview'){
  $image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'fotography-grid-large', true); 
}else{
    $image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'fotography-bxslider', true);
}
}else{
    $image[0] = '';
}
$blog_author = esc_attr(get_theme_mod('fotography_blog_author_archive_section','yes'));
$blog_postdate = esc_attr(get_theme_mod('fotography_blog_postdate_archive_section','yes'));
$blog_meta_cat = esc_attr(get_theme_mod('fotography_blog_metacategory_archive_section','yes'));
$limit = esc_attr(get_theme_mod('fotography_blog_description_archive_section',50));
?>

<div class="fg-blog clearfix">     
<div class="fg-gallery-list-thumb" style="background-image: url(<?php echo esc_url($image[0]); ?>) ">                  
</div>      

<div class="fg-gallery-list-detail">
    <h5>
        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>                                                      
    </h5>                  
    <div class="entry-meta">                              
        <?php if ($blog_author == 'yes') : ?>
            <span><i class="fa fa-user"></i> <?php the_author(); ?></span>
        <?php endif; ?>
        <?php if ($blog_postdate == 'yes') : ?>
            <span><i class="fa fa-clock-o"></i><?php the_time(get_option('date_format')); ?></span>
        <?php endif; ?> 
        <?php if ($blog_meta_cat == 'yes') : ?>
            <span><i class="fa fa-folder-open"></i> <?php the_category(','); ?></span>
        <?php endif; ?>               
    </div>

    <div class="fg-gallery-list-excerpt">
        <?php echo fotography_word_count(get_the_excerpt(), esc_attr($limit)); ?>
        <div class="bttn-wrap">
        <a class="bttn" href="<?php the_permalink(); ?>"><?php _e('Read More','fotography'); ?></a></div>
    </div>   
</div> 
</div>