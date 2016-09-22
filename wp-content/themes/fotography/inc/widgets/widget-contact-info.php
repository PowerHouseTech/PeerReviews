<?php

/**
 * Contact Info Widget
 *
 * @package FotoGraphy Pro
 */
/**
 * Adds fotography_pro_contact_info widget.
 */
add_action('widgets_init', 'register_contact_info_widget');

function register_contact_info_widget() {
    register_widget('FotoGraphy_contact_info');
}

class FotoGraphy_Contact_Info extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        parent::__construct(
            'FotoGraphy_contact_info', 'FG : Contact Info', array(
            'description' => __('A widget that shows Contact Info', 'fotography')
                )
        );
    }

    /**
     * Helper function that holds widget fields
     * Array is used in update and form functions
     */
    private function widget_fields() {
        $fields = array(
            'contact_info_title' => array(
                'fotography_pro_widgets_name' => 'contact_info_title',
                'fotography_pro_widgets_title' => __('Title', 'fotography'),
                'fotography_pro_widgets_field_type' => 'text',
            ),
            'contact_info_phone' => array(
                'fotography_pro_widgets_name' => 'contact_info_phone',
                'fotography_pro_widgets_title' => __('Phone', 'fotography'),
                'fotography_pro_widgets_field_type' => 'text',
            ),
            'contact_info_email' => array(
                'fotography_pro_widgets_name' => 'contact_info_email',
                'fotography_pro_widgets_title' => __('Email', 'fotography'),
                'fotography_pro_widgets_field_type' => 'text',
            ),            
            'contact_info_address' => array(
                'fotography_pro_widgets_name' => 'contact_info_address',
                'fotography_pro_widgets_title' => __('Contact Address', 'fotography'),
                'fotography_pro_widgets_field_type' => 'textarea',
                'fotography_pro_widgets_row' => '2'
            ),
            'contact_info_time' => array(
                'fotography_pro_widgets_name' => 'contact_info_time',
                'fotography_pro_widgets_title' => __('About Description', 'fotography'),
                'fotography_pro_widgets_field_type' => 'textarea',
                'fotography_pro_widgets_row' => '4'
            ),
        );

        return $fields;
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget($args, $instance) {
        extract($args);

        $contact_info_title = $instance['contact_info_title'];
        $contact_info_phone = $instance['contact_info_phone'];
        $contact_info_email = $instance['contact_info_email'];
        $contact_info_address = $instance['contact_info_address'];
        $contact_info_time = $instance['contact_info_time'];

        echo $before_widget; ?>
        <div class="ap-contact-info">
        <?php
        if (!empty($contact_info_title)): ?>
            <h4 class="widget-title"><?php echo esc_attr($contact_info_title); ?></h4>
        <?php endif; ?>

        <?php
        if (!empty($contact_info_time)): ?>
            <?php echo wpautop($contact_info_time); ?>
        <?php endif; ?>

        <ul>
        <?php
        if (!empty($contact_info_address)): ?>
            <li><i class="fa fa-map-marker"></i><?php echo $contact_info_address; ?></li>
        <?php endif; ?>

        <?php
        if (!empty($contact_info_phone)): ?>
            <li><i class="fa fa-phone"></i><?php echo esc_attr($contact_info_phone); ?></li>
        <?php endif; ?>

        <?php
        if (!empty($contact_info_email)): ?>
            <li><i class="fa fa-envelope"></i><?php echo esc_attr($contact_info_email); ?></li>
        <?php endif; ?>
        

        </ul>
        </div>
        <?php 
        echo $after_widget;
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param	array	$new_instance	Values just sent to be saved.
     * @param	array	$old_instance	Previously saved values from database.
     *
     * @uses	fotography_pro_widgets_updated_field_value()		defined in widget-fields.php
     *
     * @return	array Updated safe values to be saved.
     */
    public function update($new_instance, $old_instance) {
        $instance = $old_instance;

        $widget_fields = $this->widget_fields();

        // Loop through fields
        foreach ($widget_fields as $widget_field) {

            extract($widget_field);

            // Use helper function to get updated field values
            $instance[$fotography_pro_widgets_name] = fotography_pro_widgets_updated_field_value($widget_field, $new_instance[$fotography_pro_widgets_name]);
        }

        return $instance;
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param	array $instance Previously saved values from database.
     *
     * @uses	fotography_pro_widgets_show_widget_field()		defined in widget-fields.php
     */
    public function form($instance) {
        $widget_fields = $this->widget_fields();

        // Loop through fields
        foreach ($widget_fields as $widget_field) {

            // Make array elements available as variables
            extract($widget_field);
            $fotography_pro_widgets_field_value = !empty($instance[$fotography_pro_widgets_name]) ? esc_attr($instance[$fotography_pro_widgets_name]) : '';
            fotography_pro_widgets_show_widget_field($this, $widget_field, $fotography_pro_widgets_field_value);
        }
    }

}
