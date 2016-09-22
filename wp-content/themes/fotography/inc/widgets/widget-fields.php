<?php

/**
 * @package Accesspress Pro
 */
function fotography_pro_widgets_show_widget_field($instance = '', $widget_field = '', $athm_field_value = '') {
    // Store Posts in array
    $fotography_pro_postlist[0] = array(
        'value' => 0,
        'label' => '--choose--'
    );
    $arg = array('posts_per_page' => -1);
    $fotography_pro_posts = get_posts($arg);
    foreach ($fotography_pro_posts as $fotography_pro_post) :
        $fotography_pro_postlist[$fotography_pro_post->ID] = array(
            'value' => $fotography_pro_post->ID,
            'label' => $fotography_pro_post->post_title
        );
    endforeach;

    extract($widget_field);

    switch ($fotography_pro_widgets_field_type) {

        // Standard text field
        case 'text' :
            ?>
            <p>
                <label for="<?php echo $instance->get_field_id($fotography_pro_widgets_name); ?>"><?php echo $fotography_pro_widgets_title; ?>:</label>
                <input class="widefat" id="<?php echo $instance->get_field_id($fotography_pro_widgets_name); ?>" name="<?php echo $instance->get_field_name($fotography_pro_widgets_name); ?>" type="text" value="<?php echo esc_attr($athm_field_value) ; ?>" />

                <?php if (isset($fotography_pro_widgets_description)) { ?>
                    <br />
                    <small><?php echo $fotography_pro_widgets_description; ?></small>
                <?php } ?>
            </p>
            <?php
            break;
            
        //title    
        case 'title' :
            ?>
            <p>
                <label for="<?php echo $instance->get_field_id($fotography_pro_widgets_name); ?>"><?php echo $fotography_pro_widgets_title; ?>:</label>
                <input class="widefat" id="<?php echo $instance->get_field_id($fotography_pro_widgets_name); ?>" name="<?php echo $instance->get_field_name($fotography_pro_widgets_name); ?>" type="text" value="<?php echo esc_attr($athm_field_value) ; ?>" />

                <?php if (isset($fotography_pro_widgets_description)) { ?>
                    <br />
                    <small><?php echo $fotography_pro_widgets_description; ?></small>
                <?php } ?>
            </p>
            <?php
            break;

        // Standard url field
        case 'url' :
            ?>
            <p>
                <label for="<?php echo $instance->get_field_id($fotography_pro_widgets_name); ?>"><?php echo $fotography_pro_widgets_title; ?>:</label>
                <input class="widefat" id="<?php echo $instance->get_field_id($fotography_pro_widgets_name); ?>" name="<?php echo $instance->get_field_name($fotography_pro_widgets_name); ?>" type="text" value="<?php echo $athm_field_value; ?>" />

                <?php if (isset($fotography_pro_widgets_description)) { ?>
                    <br />
                    <small><?php echo $fotography_pro_widgets_description; ?></small>
                <?php } ?>
            </p>
            <?php
            break;

        // Textarea field
        case 'textarea' :
            ?>
            <p>
                <label for="<?php echo $instance->get_field_id($fotography_pro_widgets_name); ?>"><?php echo $fotography_pro_widgets_title; ?>:</label>
                <textarea class="widefat" rows="<?php echo $fotography_pro_widgets_row; ?>" id="<?php echo $instance->get_field_id($fotography_pro_widgets_name); ?>" name="<?php echo $instance->get_field_name($fotography_pro_widgets_name); ?>"><?php echo $athm_field_value; ?></textarea>
            </p>
            <?php
            break;       
      

        // Checkbox field
        case 'checkbox' :
            ?>
            <p>
                <input id="<?php echo $instance->get_field_id($fotography_pro_widgets_name); ?>" name="<?php echo $instance->get_field_name($fotography_pro_widgets_name); ?>" type="checkbox" value="1" <?php checked('1', $athm_field_value); ?>/>
                <label for="<?php echo $instance->get_field_id($fotography_pro_widgets_name); ?>"><?php echo $fotography_pro_widgets_title; ?></label>

                <?php if (isset($fotography_pro_widgets_description)) { ?>
                    <br />
                    <small><?php echo $fotography_pro_widgets_description; ?></small>
                <?php } ?>
            </p>
            <?php
            break;

        // Radio fields
        case 'radio' :
            ?>
            <p>
                <?php
                echo $fotography_pro_widgets_title;
                echo '<br />';
                foreach ($fotography_pro_widgets_field_options as $athm_option_name => $athm_option_title) {
                    ?>
                    <input id="<?php echo $instance->get_field_id($athm_option_name); ?>" name="<?php echo $instance->get_field_name($fotography_pro_widgets_name); ?>" type="radio" value="<?php echo $athm_option_name; ?>" <?php checked($athm_option_name, $athm_field_value); ?> />
                    <label for="<?php echo $instance->get_field_id($athm_option_name); ?>"><?php echo $athm_option_title; ?></label>
                    <br />
                <?php } ?>

                <?php if (isset($fotography_pro_widgets_description)) { ?>
                    <small><?php echo $fotography_pro_widgets_description; ?></small>
                <?php } ?>
            </p>
            <?php
            break;

        // Select field
        case 'select' :
            ?>
            <p>
                <label for="<?php echo $instance->get_field_id($fotography_pro_widgets_name); ?>"><?php echo $fotography_pro_widgets_title; ?>:</label>
                <select name="<?php echo $instance->get_field_name($fotography_pro_widgets_name); ?>" id="<?php echo $instance->get_field_id($fotography_pro_widgets_name); ?>" class="widefat">
                    <?php foreach ($fotography_pro_widgets_field_options as $athm_option_name => $athm_option_title) { ?>
                        <option value="<?php echo $athm_option_name; ?>" id="<?php echo $instance->get_field_id($athm_option_name); ?>" <?php selected($athm_option_name, $athm_field_value); ?>><?php echo $athm_option_title; ?></option>
                    <?php } ?>
                </select>

                <?php if (isset($fotography_pro_widgets_description)) { ?>
                    <br />
                    <small><?php echo $fotography_pro_widgets_description; ?></small>
                <?php } ?>
            </p>
            <?php
            break;

        case 'number' :
            ?>
            <p>
                <label for="<?php echo $instance->get_field_id($fotography_pro_widgets_name); ?>"><?php echo $fotography_pro_widgets_title; ?>:</label><br />
                <input name="<?php echo $instance->get_field_name($fotography_pro_widgets_name); ?>" type="number" step="1" min="1" id="<?php echo $instance->get_field_id($fotography_pro_widgets_name); ?>" value="<?php echo $athm_field_value; ?>" class="small-text" />

                <?php if (isset($fotography_pro_widgets_description)) { ?>
                    <br />
                    <small><?php echo $fotography_pro_widgets_description; ?></small>
                <?php } ?>
            </p>
            <?php
            break;

        // Select field
        case 'selectpost' :
            ?>
            <p>
                <label for="<?php echo $instance->get_field_id($fotography_pro_widgets_name); ?>"><?php echo $fotography_pro_widgets_title; ?>:</label>
                <select name="<?php echo $instance->get_field_name($fotography_pro_widgets_name); ?>" id="<?php echo $instance->get_field_id($fotography_pro_widgets_name); ?>" class="widefat">
                    <?php foreach ($fotography_pro_postlist as $fotography_pro_single_post) { ?>
                        <option value="<?php echo $fotography_pro_single_post['value']; ?>" id="<?php echo $instance->get_field_id($fotography_pro_single_post['label']); ?>" <?php selected($fotography_pro_single_post['value'], $athm_field_value); ?>><?php echo $fotography_pro_single_post['label']; ?></option>
                    <?php } ?>
                </select>

                <?php if (isset($fotography_pro_widgets_description)) { ?>
                    <br />
                    <small><?php echo $fotography_pro_widgets_description; ?></small>
                <?php } ?>
            </p>
            <?php
            break;

        case 'upload' :

            $output = '';
            $id = $instance->get_field_id($fotography_pro_widgets_name);
            $class = '';
            $int = '';
            $value = $athm_field_value;
            $name = $instance->get_field_name($fotography_pro_widgets_name);


            if ($value) {
                $class = ' has-file';
            }
            $output .= '<div class="sub-option widget-upload">';
            $output .= '<label for="'.$instance->get_field_id($fotography_pro_widgets_name).'">'.$fotography_pro_widgets_title.'</label><br/>';
            $output .= '<input id="' . $id . '" class="upload' . $class . '" type="text" name="' . $name . '" value="' . $value . '" placeholder="' . __('No file chosen', 'fotography') . '" />' . "\n";
            if (function_exists('wp_enqueue_media')) {
                if (( $value == '')) {
                    $output .= '<input id="upload-' . $id . '" class="upload-button button" type="button" value="' . __('Upload', 'fotography') . '" />' . "\n";
                } else {
                    $output .= '<input id="remove-' . $id . '" class="remove-file button" type="button" value="' . __('Remove', 'fotography') . '" />' . "\n";
                }
            } else {
                $output .= '<p><i>' . __('Upgrade your version of WordPress for full media support.', 'fotography') . '</i></p>';
            }

            $output .= '<div class="screenshot team-thumb" id="' . $id . '-image">' . "\n";

            if ($value != '') {
                $remove = '<a class="remove-image">Remove</a>';
                $attachment_id = accesspress_get_attachment_id_from_url($value);
                $image_array = wp_get_attachment_image_src( $attachment_id, 'medium');
                $image = preg_match('/(^.*\.jpg|jpeg|png|gif|ico*)/i', $value);
                if ($image) {
                    $output .= '<img src="' . $image_array[0] . '" alt="" />' . $remove;
                } else {
                    $parts = explode("/", $value);
                    for ($i = 0; $i < sizeof($parts); ++$i) {
                        $title = $parts[$i];
                    }

                    // No output preview if it's not an image.
                    $output .= '';

                    // Standard generic output if it's not an image.
                    $title = __('View File', 'fotography');
                    $output .= '<div class="no-image"><span class="file_link"><a href="' . $value . '" target="_blank" rel="external">' . $title . '</a></span></div>';
                }
            }
            $output .= '</div></div>' . "\n";
            echo $output;
            break;

            case 'icon' :
             add_thickbox();
            ?>
            <p>
                <label for="<?php echo $instance->get_field_id($fotography_pro_widgets_name); ?>"><?php echo $fotography_pro_widgets_title; ?>:</label><br />
                <span class="icon-receiver"><i class="<?php echo $athm_field_value; ?>"></i></span>
                <input class="hidden-icon-input" name="<?php echo $instance->get_field_name($fotography_pro_widgets_name); ?>" type="hidden" id="<?php echo $instance->get_field_id($fotography_pro_widgets_name); ?>" value="<?php echo $athm_field_value; ?>" />

                <?php if (isset($fotography_pro_widgets_description)) { ?>
                    <br />
                    <small><?php echo $fotography_pro_widgets_description; ?></small>
                <?php } ?>
            </p>
               
            <?php
            break;
    }
}

function fotography_pro_widgets_updated_field_value($widget_field, $new_field_value) {

    extract($widget_field);

    // Allow only integers in number fields
    if ($fotography_pro_widgets_field_type == 'number') {
        return absint($new_field_value);

        // Allow some tags in textareas
    } 
    
    elseif ($fotography_pro_widgets_field_type == 'url') {
        return esc_url_raw($new_field_value);
    }
    elseif ($fotography_pro_widgets_field_type == 'title') {
        return wp_kses_post($new_field_value);
    }
    else {
        return strip_tags($new_field_value);
    }
}