<?php
/**
 * Register the Widget
 */
add_action('widgets_init', create_function('', 'register_widget("fotography_call_to_action");'));

class fotography_call_to_action extends WP_Widget {

    /**
     * Constructor
     * */
    public function __construct() {
        $widget_ops = array(
            'classname' => 'fg_call_to_action',
            'description' => 'A widget that shows call to action.'
        );
        parent::__construct('pu_media_upload', 'FG : Call To Action', $widget_ops);

        add_action('admin_enqueue_scripts', array($this, 'upload_scripts'));
    }

    /**
     * Upload the Javascripts for the media uploader
     */
    public function upload_scripts() {
        wp_enqueue_script('media-upload');
        wp_enqueue_script('thickbox');
        wp_enqueue_script('upload_media_widget', get_template_directory_uri() . '/inc/js/media-uploader.js', array('jquery'));
        wp_enqueue_style('thickbox');
    }

    /*     * ********************** Outputs the HTML for this widget *************************** */

    public function widget($args, $instance) {
        extract($args);
        $title = !empty($instance['title']) ? $instance['title'] : 'Need a Photographer ?';
        $button_text = !empty($instance['button_text']) ? $instance['button_text'] : 'HIRE ME';
        $button_text_url = !empty($instance['button_text_url']) ? $instance['button_text_url'] : '';
        $image = isset($instance['image']) ? $instance['image'] : "";
        
        echo $before_widget;
        ?>
        <div class="call-to-action" style="background-image:url('<?php echo esc_url($image); ?>'); background-size: cover;"/>   
        <div class="home_caltoaction_overlay">
            <div class="call-to-action-title">
                <?php echo esc_attr($title); ?>
            </div>
            <div class="clll-to-action-button">
                <a href="<?php echo esc_url($button_text_url); ?>"><?php echo esc_attr($button_text); ?></a>
            </div>
        </div>
        </div>
        <?php
        echo $after_widget;
    }
    
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = sanitize_text_field($new_instance['title']);
        $instance['button_text'] = sanitize_text_field($new_instance['button_text']);
        $instance['image'] = esc_url_raw($new_instance['image']);
        $instance['button_text_url'] = esc_url_raw($new_instance['button_text_url']);
        return $instance;
    }

    /**
     * Displays the form for this widget on the Widgets page of the WP Admin area.
     *
     * */
    public function form($instance) {
        $title = '';
        if (isset($instance['title'])) {
            $title = $instance['title'];
        }

        $image = '';
        if (isset($instance['image'])) {
            $image = $instance['image'];
        }

        $button_text = 'HIRE ME';
        if (isset($instance['button_text'])) {
            $button_text = $instance['button_text'];
        }

        $button_text_url = '';
        if (isset($instance['button_text_url'])) {
            $button_text_url = $instance['button_text_url'];
        }
        ?>    

        <p>
            <label for="<?php echo $this->get_field_name('image'); ?>"><?php _e('Uplaod Call To Action Cover Image :', 'fotography'); ?></label>
            <input name="<?php echo $this->get_field_name('image'); ?>" id="<?php echo $this->get_field_id('image'); ?>" class="widefat1" type="text" size="19"  value="<?php echo esc_url($image); ?>" />
            <input class="upload_image_button" type="button" value="Upload Image" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_name('title'); ?>"><?php _e('Call To Action Title :', 'fotography'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_name('button_text'); ?>"><?php _e('Call To Action Button Text :', 'fotography'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('button_text'); ?>" name="<?php echo $this->get_field_name('button_text'); ?>" type="text" value="<?php echo esc_attr($button_text); ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_name('button_text_url'); ?>"><?php _e('Call To Action Button Link :', 'fotography'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('button_text_url'); ?>" name="<?php echo $this->get_field_name('button_text_url'); ?>" type="text" value="<?php echo esc_url($button_text_url); ?>" />
        </p>


        <?php
    }

}
?>