<?php

/*
Plugin Name: Image Widget Deluxe
Plugin URI: https://rommel.dk/
Description: A simple image widget that uses the native WordPress media manager to add widgets with and image and allowing you to change the display order of the fields via drag'n drop.
Author: Rommel
Version: 1.0.6
Author URI: https://rommel.dk/
*/

// No direct file access.
if ( ! defined( 'ABSPATH' ) ) {
	die( "You can't access this file directly." );
}

/**
 * Load a plugin's translated strings.
 *
 */
add_action( 'plugins_loaded', 'rommeled_image_widget_translations' );
function rommeled_image_widget_translations() {
	load_plugin_textdomain( 'image-widget', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}

/**
 * Retrieve all image sizes.
 *
 */
function get_image_sizes( $size = '' ) {

	global $_wp_additional_image_sizes;

	$sizes = array();
	$get_intermediate_image_sizes = get_intermediate_image_sizes();

	// Create the full array with sizes and crop info.
	foreach( $get_intermediate_image_sizes as $_size ) {

		if ( in_array( $_size, array( 'thumbnail', 'medium', 'large' ) ) ) {

			$sizes[ $_size ]['width'] = get_option( $_size . '_size_w' );
			$sizes[ $_size ]['height'] = get_option( $_size . '_size_h' );
			$sizes[ $_size ]['crop'] = (bool) get_option( $_size . '_crop' );

		} elseif ( isset( $_wp_additional_image_sizes[ $_size ] ) ) {

			$sizes[ $_size ] = array(
				'width' => $_wp_additional_image_sizes[ $_size ]['width'],
				'height' => $_wp_additional_image_sizes[ $_size ]['height'],
				'crop' =>  $_wp_additional_image_sizes[ $_size ]['crop']
			);
		}
	}

	// Get only 1 size if found.
	if ( $size ) {

		if( isset( $sizes[ $size ] ) ) {

			return $sizes[ $size ];
		} else {

			return false;
		}
	}

	// Adding the full image size as it won't be stored anywhere.
	$sizes[ 'full' ] = array(
		'width'     => '',
		'height'    => '',
		'crop'      =>  false
	);

	return $sizes;
}


/**
 * Widget Scripts for the backend.
 *
 */
add_action( 'customize_controls_enqueue_scripts', 'rommeled_image_widget_scripts', 999 ); // Enqueue at the customizer.
function rommeled_image_widget_scripts(){

	wp_enqueue_media();
	wp_enqueue_script( 'jquery-ui-sortable' );
	wp_enqueue_style( 'image-widget-sortable', plugins_url( 'css/image-widget-backend.css', __FILE__ ), '' , true );

	$args = array(
		'frame_title' => esc_html__( 'Select an Image', 'image-widget' ),
		'button_title' => esc_html__( 'Use this Image', 'image-widget' ),
	);

	wp_enqueue_script( 'widget-image-js', plugins_url( 'js/media.js', __FILE__ ), array( 'jquery', 'media-upload', 'media-views' ), '' , true );
	wp_localize_script( 'widget-image-js', 'RommeledImageWidget', $args );
}

/**
 * Create our Image Widget.
 */

class rommeled_Image_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'rommeled_Image', // Base ID
			__( 'Image widget Deluxe', 'image-widget' ), // Name
			array(
				'description' => esc_html__( 'A widget that displays an image with title, description and a button.', 'image-widget' ),
			)
		);

		// Enqueue the JS and styles for the backend.
		add_action( 'admin_enqueue_scripts', 'rommeled_image_widget_scripts', 99 );  // Enqueue at admin area.
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {

		// Enqueue the front-end stylesheet.
		wp_enqueue_style( 'image-widget-frontend', plugins_url( 'css/image-widget-frontend.css', __FILE__ ), '' , true );

		$sort = ! empty( $instance['sort'] ) ? esc_attr($instance['sort']) : '';
		$image = ! empty( $instance['image'] ) ? esc_attr($instance['image']) : '';
		$title = ! empty( $instance['title'] ) ? esc_attr($instance['title']) : '';
		$inner_title = ! empty( $instance['inner-title'] ) ? esc_attr($instance['inner-title']) : '';
		$text = ! empty( $instance['text'] ) ? $instance['text'] : '';
		$url = ! empty( $instance['url'] ) ? esc_attr($instance['url']) : '';
		$url_target = ! empty( $instance['url_target'] ) ? esc_attr($instance['url_target']) : '';
		$button = ! empty( $instance['button'] ) ? esc_attr($instance['button']) : '';
		$size = ! empty( $instance['size'] ) ? esc_attr($instance['size']) : '';
		$style = ! empty( $instance['style'] ) ? esc_attr($instance['style']) : '';
		$widget_id = ! empty( $args['widget_id'] ) ? esc_attr($args['widget_id']) : '';
		$title_visibility = ! empty( $instance['title-visibility'] ) ? esc_attr($instance['title-visibility']) : '';

		// Add out custom class.
		$args['class'] = ! empty( $instance['class_custom'] ) ? $args['class'] . ' ' . esc_attr($instance['class_custom']) : $args['class'];


		// Begin the widget.
		echo $args['before_widget'];

		// Find the order of our widget fields.
		if ( ! empty( $sort ) ) {
			$fields = explode(',',$sort);
		} else {
			$fields = array('no-sort');
		}

		echo '<span class="rommeled_widget_image_inner '.$args['class'].'">';

		// Url Target.
		if ( ! empty($url_target) ) {
			$attr_target = 'target="' . $url_target .'" ';
		} else {
			$attr_target = '';
		}

		// Get the title.
		if ( ! empty( $title ) && $title_visibility == 'on' ) {

			echo $args['before_title'];
			echo apply_filters( 'widget_title', $instance['title'] );
			echo $args['after_title'];
		}

		foreach ( $fields as $field ) {

			// Inner Title.
			if ( $field == $widget_id . '-inner-title' && ! empty( $inner_title ) || $field == 'no-sort' && ! empty( $inner_title ) ) :

				echo '<h3 class="rommeled_widget_image-field rommeled_widget_image-inner-title">' . $inner_title . '</h3>';

			endif;

			// The image.
			if ( $field == $widget_id . '-image' && ! empty( $image ) || $field == 'no-sort' && ! empty( $image ) ) :

				// Grab the image and make an array with url and id.
				$image = explode('?id=', $image);

				echo '<p class="rommeled_widget_image-field rommeled_widget_image-image">';

				// Begin the link.
				if ( ! empty( $url ) ) {
					echo '<a ' . $attr_target . ' href="' . $url . '">';
				}

				// Get the image alt tag.
				$alt = get_post_meta( $image[1], '_wp_attachment_image_alt', true );
				if ( count( $alt ) ) {
					$alt_text = $alt;
				} else {
					$alt_text = '';
				}

				// Get the image.
				echo wp_get_attachment_image( $image[1], $size, false, array('class'=>$style,'alt'=>$alt_text) );

				// End the link.
				if ( ! empty( $url ) ) {
					echo '</a>';
				}

				echo '</p>';

			endif;

			// Text.
			if ( $field == $widget_id . '-text' && ! empty( $text ) || $field === 'no-sort' && ! empty( $text ) ) :

				echo '<p class="rommeled_widget_image-field rommeled_widget_image-text">' . $text . '</p>';

			endif;

			// Button.
			if ( $field == $widget_id . '-button' && ! empty( $url ) && ! empty( $button ) || $field === 'no-sort' && ! empty( $url ) && ! empty( $button ) ) :

				if ( empty($url_target) ) {
					$link = "window.location.href='" . $url . "'";
				} else {
					$link = "window.location.href='" . $url . "','_blank'";
				}

				echo '<p class="rommeled_widget_image-field rommeled_widget_image-button"><button class="button btn" onclick="' . $link . '">' . $button . '</button></p>';

			endif;
		}

		echo '</span>';

		// End the widget.
		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {

		$sort = ! empty( $instance['sort'] ) ? esc_attr($instance['sort']) : '';
		$image = ! empty( $instance['image'] ) ? esc_attr($instance['image']) : '';
		$title = ! empty( $instance['title'] ) ? esc_attr($instance['title']) : '';
		$inner_title = ! empty( $instance['inner-title'] ) ? esc_attr($instance['inner-title']) : '';
		$text = ! empty( $instance['text'] ) ? $instance['text'] : '';
		$url = ! empty( $instance['url'] ) ? esc_attr($instance['url']) : '';
		$url_target = ! empty( $instance['url_target'] ) ? esc_attr($instance['url_target']) : '';
		$button = ! empty( $instance['button'] ) ? esc_attr($instance['button']) : '';
		$size = ! empty( $instance['size'] ) ? esc_attr($instance['size']) : '';
		$style = ! empty( $instance['style'] ) ? esc_attr($instance['style']) : '';
		$title_visibility = ! empty( $instance['title-visibility'] ) ? esc_attr($instance['title-visibility']) : '';
		$class_custom = ! empty( $instance['class_custom'] ) ? esc_attr($instance['class_custom']) : '';

		// Make the order array.
		if ( ! empty( $sort ) ) {
			$fields = explode(',',$sort);
		} else {
			$fields = array(
				'no-order'
			);
		}

		// Hide the image.
		if ( $image != '' ) {
			$imageoptions = 'style="display:block;"';
		} else {
			$imageoptions = 'style="display:none;"';
		}
		?>
		<p id="<?php echo $this->id . '-title'; ?>">
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Widget Title', 'image-widget' ); ?>:</label>
			<small><?php _e( 'Give the widget a title (If you need one)', 'image-widget' ); ?>.</small>
		</p>

		<p id="<?php echo $this->id . '-title-visibility'; ?>">
			<label for="<?php echo $this->get_field_id( 'title-visibility' ); ?>"><input <?php checked('on', esc_attr( $title_visibility ), true ); ?> id="<?php echo $this->get_field_id( 'title-visibility' ); ?>" name="<?php echo $this->get_field_name( 'title-visibility' ); ?>" type="checkbox"> <?php _e( 'Show on front-end', 'image-widget' ); ?></label>
		</p>

		<div class="widget-image-sortable">

			<?php foreach ( $fields as $field ) { ?>

				<?php if ( $field == $this->id . '-inner-title' || $field === 'no-order' ) : ?>

					<p id="<?php echo $this->id . '-inner-title'; ?>">
						<label for="<?php echo $this->get_field_id( 'inner-title' ); ?>"><?php _e( 'Title', 'image-widget' ); ?>:</label>
						<input class="widefat" id="<?php echo $this->get_field_id( 'inner-title' ); ?>" name="<?php echo $this->get_field_name( 'inner-title' ); ?>" type="text" value="<?php echo esc_attr( $inner_title ); ?>">
						<small><?php _e( 'Add a title that will be displayed inside the widget', 'image-widget' ); ?>.</small>
					</p>

				<?php endif; ?>

				<?php if ( $field == $this->id . '-image' || $field === 'no-order' ) : ?>
					<p id="<?php echo $this->id . '-image'; ?>">
						<label for="select-image"><?php _e( 'Image', 'image-widget' ); ?>:</label>
						<button class="widefat button widget-control-save widget-image-select" name="select-image"><?php _e( 'Select image', 'image-widget' ); ?></button>
						<input class="widefat" id="<?php echo $this->get_field_id( 'image' ); ?>" name="<?php echo $this->get_field_name( 'image' ); ?>" type="hidden" value="<?php echo esc_attr( $image ); ?>">

						<?php

						if ( ! empty( $image ) ) {
							echo '<img class="imagePreview" src="' . esc_attr( $image ) . '">';
							$imageRemoveStyle = 'style="display:block;"';

						} else {
							echo '<img ' . $imageoptions . ' class="imagePreview" src="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs%3D">';
							$imageRemoveStyle = 'style="display:none;"';
						}

						?>
						<a <?php echo $imageRemoveStyle; ?> href="#" class="imageRemove">⊗</a>
					</p>

				<?php endif; ?>

				<?php if ( $field == $this->id . '-text' || $field === 'no-order' ) : ?>

					<p id="<?php echo $this->id . '-text'; ?>">
						<label for="<?php echo $this->get_field_id( 'text' ); ?>"><?php _e( 'Text', 'image-widget' ); ?>:</label>
						<textarea rows="5" class="widefat" id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name( 'text' ); ?>"><?php echo format_to_edit( $text ); ?></textarea>
						<small><?php _e( 'Add or edit a description for the widget', 'image-widget' ); ?>.</small>
					</p>

				<?php endif; ?>
				<?php if ( $field == $this->id . '-button' || $field === 'no-order' ) : ?>

					<p id="<?php echo $this->id . '-button'; ?>">
						<label for="<?php echo $this->get_field_id( 'button' ); ?>"><?php _e( 'Button', 'image-widget' ); ?>:</label>
						<input class="widefat" id="<?php echo $this->get_field_id( 'button' ); ?>" name="<?php echo $this->get_field_name( 'button' ); ?>" type="text" value="<?php echo esc_attr( $button ); ?>">
						<small><?php _e( 'Add a text that will be displayed in the button', 'image-widget' ); ?>.</small>
					</p>

				<?php endif; ?>
			<?php } ?>
		</div>

		<input class="widefat image-widget-sort-order" id="<?php echo $this->get_field_id( 'sort' ); ?>" name="<?php echo $this->get_field_name( 'sort' ); ?>" type="hidden" value="<?php echo esc_attr( $sort ); ?>">

		<p>
			<label for="<?php echo $this->get_field_id( 'url' ); ?>"><?php _e( 'Link', 'image-widget' ); ?>:</label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'url' ); ?>" name="<?php echo $this->get_field_name( 'url' ); ?>" type="text" value="<?php echo esc_attr( $url ); ?>">
			<small><?php _e( 'Add an url that the widget should refer to (Button and Image)', 'image-widget' ); ?>.</small>
		</p>

		<div class="non-sortable" <?php echo $imageoptions; ?>>
			<h4><?php _e('Widget Options', 'image-widget' ); ?></h4>

			<label for="<?php echo $this->get_field_id( 'url_target' ); ?>"><?php _e( 'Link target', 'image-widget' ); ?>:
				<select class='widefat' id="<?php echo $this->get_field_id( 'url_target' ); ?>" name="<?php echo $this->get_field_name( 'url_target' ); ?>">

					<?php

					$targets = array(
						'' => esc_html__( 'Same window', 'image-widget' ),
						'_blank' => esc_html__( 'New window', 'image-widget' ),
					);

					foreach ( $targets as $target => $target_type ) : ?>

						<option value="<?php echo $target; ?>" <?php selected( $target, $url_target, true ); ?>><?php echo $target_type; ?></option>

					<?php endforeach; ?>

				</select>
				<small><?php _e( 'Select a style for the image', 'image-widget' ); ?>.</small>
			</label>

			<label for="<?php echo $this->get_field_id( 'style' ); ?>"><?php _e( 'Image style', 'image-widget' ); ?>:
				<select class='widefat' id="<?php echo $this->get_field_id( 'style' ); ?>" name="<?php echo $this->get_field_name( 'style' ); ?>">

					<?php

					$img_styles = array(
						'img-square' => esc_html__( 'Square', 'image-widget' ),
						'img-round' => esc_html__( 'Round', 'image-widget' ),
					);

					foreach ( $img_styles as $img_style => $img_style_name ) : ?>

						<option value="<?php echo $img_style; ?>" <?php selected( $img_style, $style, true ); ?>><?php echo $img_style_name; ?></option>

					<?php endforeach; ?>

				</select>
				<small><?php _e( 'Select a style for the image', 'image-widget' ); ?>.</small>
			</label>

			<label for="<?php echo $this->get_field_id( 'size' ); ?>"><?php _e( 'Image size', 'image-widget' ); ?>:
				<select class='widefat' id="<?php echo $this->get_field_id( 'size' ); ?>" name="<?php echo $this->get_field_name( 'size' ); ?>">

					<?php

					$img_sizes = get_image_sizes();

					foreach ( $img_sizes as $img_size => $image ) : ?>

						<option value="<?php echo $img_size; ?>" <?php selected( $size, $img_size, true ); ?>><?php echo $img_size; ?></option>

					<?php endforeach; ?>

				</select>
				<small><?php _e( 'Select an image size', 'image-widget' ); ?>.</small>
			</label>

			<label for="<?php echo $this->get_field_id( 'class_custom' ); ?>"><?php _e( 'Class(es)', 'image-widget' ); ?>:
				<input class="widefat" id="<?php echo $this->get_field_id( 'class_custom' ); ?>" name="<?php echo $this->get_field_name( 'class_custom' ); ?>" type="text" value="<?php echo esc_attr( $class_custom ); ?>">
				<small><?php _e( 'Add your custom classes if you have any. E.g. mycustom-class cta-custom', 'image-widget' ); ?>.</small>
			</label>
		</div>
	<?php
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {

		$instance = array();
		$instance['sort'] = ( ! empty( $new_instance['sort'] ) ) ? strip_tags( $new_instance['sort'] ) : '';
		$instance['image'] = ( ! empty( $new_instance['image'] ) ) ? strip_tags( $new_instance['image'] ) : '';
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['inner-title'] = ( ! empty( $new_instance['inner-title'] ) ) ? strip_tags( $new_instance['inner-title'] ) : '';
		$instance['text'] = ( ! empty( $new_instance['text'] ) ) ? strip_tags( $new_instance['text'] ) : '';
		$instance['button'] = ( ! empty( $new_instance['button'] ) ) ? strip_tags( $new_instance['button'] ) : '';
		$instance['url'] = ( ! empty( $new_instance['url'] ) ) ? strip_tags( $new_instance['url'] ) : '';
		$instance['url_target'] = ( ! empty( $new_instance['url_target'] ) ) ? strip_tags( $new_instance['url_target'] ) : '';
		$instance['size'] = ( ! empty( $new_instance['size'] ) ) ? strip_tags( $new_instance['size'] ) : '';
		$instance['style'] = ( ! empty( $new_instance['style'] ) ) ? strip_tags( $new_instance['style'] ) : '';
		$instance['title-visibility'] = ( ! empty( $new_instance['title-visibility'] ) ) ? strip_tags( $new_instance['title-visibility'] ) : '';
		$instance['class_custom'] = ( ! empty( $new_instance['class_custom'] ) ) ? strip_tags( $new_instance['class_custom'] ) : '';

		return $instance;
	}
}

/**
 * Add our widget.
 *
 */
add_action( 'widgets_init', function(){
	register_widget( 'rommeled_Image_Widget' );
});
