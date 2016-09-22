<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package FotoGraphy
 */

$post_sidebar = esc_attr(get_post_meta($post->ID, 'fotography_page_layouts', true));

if(!$post_sidebar){
	$post_sidebar = 'rightsidebar';
}

if ( $post_sidebar ==  'nosidebar' ) {
	return;
}


if( $post_sidebar == 'rightsidebar' && is_active_sidebar('fotography-right-sidebar')){
	?>
		<div id="secondary" class="widget-area">
			<?php dynamic_sidebar( 'fotography-right-sidebar' ); ?>
		</div><!-- #secondary -->
	<?php
}

if( $post_sidebar == 'leftsidebar' && is_active_sidebar('fotography-left-sidebar')){
	?>
		<div id="secondary" class="widget-area">
			<?php dynamic_sidebar( 'fotography-left-sidebar' ); ?>
		</div><!-- #secondary -->
	<?php
}