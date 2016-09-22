<?php
if ( ! class_exists( 'WP_Customize_Control' ) ) return NULL;

class Fotography_Pro_General_Repeater extends WP_Customize_Control {
    private $options = array();

    public function __construct( $manager, $id, $args = array() ) {
        parent::__construct( $manager, $id, $args );
        $this->options = $args;
    }

    public function render_content() {

        $this_default = json_decode($this->setting->default);
        $values = $this->value();
        $json = json_decode($values);
        if(!is_array($json)) $json = array($values);
        $it = 0;
        $options = $this->options;
        if(!empty($options['image_control'])){
            $image_control = $options['image_control'];
        } else {
            $image_control = false;
        }
        if(!empty($options['icon_control'])){
            $icon_control = $options['icon_control'];
            $icons_array = array( 'No Icon','icon-social-blogger','icon-social-blogger-circle','icon-social-blogger-square');
        } else {
         $icon_control = false;
     }
     if(!empty($options['title_control'])){
        $title_control = $options['title_control'];
    } else {
        $title_control = false;
    }                           
    if(!empty($options['text_control'])){
        $text_control = $options['text_control'];
    } else {
        $text_control = false;
    }
    if(!empty($options['link_control'])){
        $link_control = $options['link_control'];
    } else {
        $link_control = false;
    }
    if(!empty($options['subtitle_control'])){
        $subtitle_control = $options['subtitle_control'];
    } else {
        $subtitle_control = false;
    } 
    ?>

    <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
    <div class="accesspress_store_general_control_repeater accesspress_store_general_control_droppable">
        <?php if(empty($json)) { ?>
        <div class="accesspress_store_general_control_repeater_container">
            <div class="parallax-customize-control-title"><?php esc_html_e('Fotography','fotography')?></div>
            <div class="parallax-box-content-hidden">
                <?php
                if($image_control == true && $icon_control == true){ ?>
                <span class="customize-control-title"><?php esc_html_e('Image type','fotography');?></span>
                <select class="accesspress_store_image_choice">
                    <option value="accesspress_icon" selected><?php esc_html_e('Icon','fotography'); ?></option>
                    <option value="accesspress_image"><?php esc_html_e('Image','fotography'); ?></option>
                    <option value="accesspress_none"><?php esc_html_e('None','fotography'); ?></option>
                </select>

                <p class="accesspress_store_image_control" style="display:none">
                    <span class="customize-control-title"><?php esc_html_e('Image','fotography')?></span>
                    <input type="text" class="widefat custom_media_url">
                    <input type="button" class="button button-primary custom_media_button_accesspress_store" value="<?php esc_html_e('Upload Image','fotography'); ?>" />
                </p>

                <div class="accesspress_store_general_control_icon">
                    <span class="customize-control-title"><?php esc_html_e('Icon','fotography');?></span>
                    <select class="accesspress_store_icon_control">
                        <?php
                        foreach($icons_array as $contact_icon) {
                            echo '<option value="'.esc_attr($contact_icon).'">'.esc_attr($contact_icon).'</option>';
                        }
                        ?>
                    </select>
                </div>
                <?php
            } else {
                if($image_control ==true){	?>
                <span class="customize-control-title"><?php esc_html_e('Image','fotography')?></span>
                <p class="accesspress_store_image_control">
                    <input type="text" class="widefat custom_media_url">
                    <input type="button" class="button button-primary custom_media_button_accesspress_store" value="<?php esc_html_e('Upload Image','fotography'); ?>" />
                </p>
                <?php
            }

            if($icon_control ==true){
                ?>
                <span class="customize-control-title"><?php esc_html_e('Icon','fotography')?></span>
                <select name="<?php echo esc_attr($this->id); ?>" class="accesspress_store_icon_control">
                    <?php
                    foreach($icons_array as $contact_icon) {
                        echo '<option value="'.esc_attr($contact_icon).'">'.esc_attr($contact_icon).'</option>';
                    }
                    ?>
                </select>
                <?php   }
            }

            if($title_control==true){
                ?>
                <span class="customize-control-title"><?php esc_html_e('Title','fotography')?></span>
                <input type="text" class="accesspress_store_title_control" placeholder="<?php esc_html_e('Title','fotography'); ?>"/>
                <?php
            }

            if($text_control==true){?>
            <span class="customize-control-title"><?php esc_html_e('Text','fotography')?></span>
            <textarea class="accesspress_store_text_control" placeholder="<?php esc_html_e('Text','fotography'); ?>"></textarea>
            <?php }

            if($link_control==true){ ?>
            <span class="customize-control-title"><?php esc_html_e('Link','fotography')?></span>
            <input type="text" class="accesspress_store_link_control" placeholder="<?php esc_html_e('Link','fotography'); ?>"/>
            <?php }

            if($subtitle_control==true){
                ?>
                <span class="customize-control-title"><?php esc_html_e('Button Text','fotography')?></span>
                <input type="text" class="accesspress_store_subtitle_control" placeholder="<?php esc_html_e('Button Text','fotography'); ?>"/>
                <?php
            }
            ?>
            <input type="hidden" class="accesspress_store_box_id">
            <button type="button" class="accesspress_store_general_control_remove_field button" style="display:none;"><?php esc_html_e('Delete field','fotography'); ?></button>
        </div>
    </div>
    <?php } else {
        if ( !empty($this_default) && empty($json)) {
            foreach($this_default as $icon){
    ?>
        <div class="accesspress_store_general_control_repeater_container accesspress_store_draggable">
            <div class="parallax-customize-control-title"><?php esc_html_e('Fotography','fotography')?></div>
            <div class="parallax-box-content-hidden">
                <?php  if($image_control == true && $icon_control == true){ ?>
                    <span class="customize-control-title"><?php esc_html_e('Image type','fotography');?></span>
                    <select class="accesspress_store_image_choice">
                        <option value="accesspress_icon" <?php selected($icon->choice,'accesspress_icon');?>><?php esc_html_e('Icon','fotography');?></option>
                        <option value="accesspress_image" <?php selected($icon->choice,'accesspress_image');?>><?php esc_html_e('Image','fotography');?></option>
                        <option value="accesspress_none" <?php selected($icon->choice,'accesspress_none');?>><?php esc_html_e('None','fotography');?></option>
                    </select>

                    <p class="accesspress_store_image_control"  <?php if(!empty($icon->choice) && $icon->choice!='accesspress_image'){ echo 'style="display:none"';}?>>
                        <span class="customize-control-title"><?php esc_html_e('Image','fotography');?></span>
                        <input type="text" class="widefat custom_media_url" value="<?php if(!empty($icon->image_url)) {echo esc_attr($icon->image_url);} ?>">
                        <input type="button" class="button button-primary custom_media_button_accesspress_store" value="<?php esc_html_e('Upload Image','fotography'); ?>" />
                    </p>

                    <div class="accesspress_store_general_control_icon" <?php  if(!empty($icon->choice) && $icon->choice!='accesspress_icon'){ echo 'style="display:none"';}?>>
                        <span class="customize-control-title"><?php esc_html_e('Icon','fotography');?></span>
                        <select name="<?php echo esc_attr($this->id); ?>" class="accesspress_store_icon_control">
                            <?php
                                foreach($icons_array as $contact_icon) {
                                    echo '<option value="'.esc_attr($contact_icon).'" '.selected($icon->icon_value,$contact_icon).'">'.esc_attr($contact_icon).'</option>';
                                }
                            ?>
                        </select>
                    </div>
                <?php  } else { ?>
                <?php	if($image_control==true){ ?>
                    <span class="customize-control-title"><?php esc_html_e('Image','fotography')?></span>
                    <p class="accesspress_store_image_control">
                        <input type="text" class="widefat custom_media_url" value="<?php if(!empty($icon->image_url)) {echo esc_attr($icon->image_url);} ?>">
                        <input type="button" class="button button-primary custom_media_button_accesspress_store" value="<?php esc_html_e('Upload Image','fotography'); ?>" />
                    </p>
                <?php	}  if($icon_control==true){ ?>
                    <span class="customize-control-title"><?php esc_html_e('Icon','fotography')?></span>
                    <select name="<?php echo esc_attr($this->id); ?>" class="accesspress_store_icon_control">
                        <?php
                            foreach($icons_array as $contact_icon) {
                                echo '<option value="'.esc_attr($contact_icon).'" '.selected($icon->icon_value,$contact_icon).'">'.esc_attr($contact_icon).'</option>';
                            }
                        ?>
                    </select>
                <?php  } }
                    if($title_control==true){
                        ?>
                        <span class="customize-control-title"><?php esc_html_e('Title','fotography')?></span>
                        <input type="text" value="<?php if(!empty($icon->title)) echo esc_attr($icon->title); ?>" class="accesspress_store_title_control" placeholder="<?php esc_html_e('Title','fotography'); ?>"/>
                        <?php
                    }

                    if($text_control==true){ ?>
                        <span class="customize-control-title"><?php esc_html_e('Text','fotography')?></span>
                        <textarea placeholder="<?php esc_html_e('Text','fotography'); ?>" class="accesspress_store_text_control"><?php if(!empty($icon->text)) {echo esc_attr($icon->text);} ?></textarea>
                    <?php	}
                    if($link_control){ ?>
                        <span class="customize-control-title"><?php esc_html_e('Link','fotography')?></span>
                        <input type="text" value="<?php if(!empty($icon->link)) echo esc_url($icon->link); ?>" class="accesspress_store_link_control" placeholder="<?php esc_html_e('Link','fotography'); ?>"/>
                    <?php	}  if($subtitle_control==true){ ?>
                        <span class="customize-control-title"><?php esc_html_e('Button Text','fotography')?></span>
                        <input type="text" value="<?php if(!empty($icon->subtitle)) echo esc_attr($icon->subtitle); ?>" class="accesspress_store_subtitle_control" placeholder="<?php esc_html_e('Button Text','fotography'); ?>"/>
                        <?php  } ?>
                        <input type="hidden" class="accesspress_store_box_id" value="<?php if(!empty($icon->id)) echo esc_attr($icon->id); ?>">
                        <button type="button" class="accesspress_store_general_control_remove_field button" <?php if ($it == 0) echo 'style="display:none;"'; ?>><?php esc_html_e('Delete field','fotography'); ?></button>
            </div>
        </div>

    <?php
        $it++; }  } else {
        foreach($json as $icon){
    ?>
    <div class="accesspress_store_general_control_repeater_container accesspress_store_draggable">
        <div class="parallax-customize-control-title"><?php esc_html_e('Advance Slider','fotography')?></div>
        <div class="parallax-box-content-hidden">
                <?php if($image_control == true && $icon_control == true){ ?>
                    <span class="customize-control-title"><?php esc_html_e('Image type','fotography');?></span>
                    <select class="accesspress_store_image_choice">
                        <option value="accesspress_icon" <?php selected($icon->choice,'accesspress_icon');?>><?php esc_html_e('Icon','fotography');?></option>
                        <option value="accesspress_image" <?php selected($icon->choice,'accesspress_image');?>><?php esc_html_e('Image','fotography');?></option>
                        <option value="accesspress_none" <?php selected($icon->choice,'accesspress_none');?>><?php esc_html_e('None','fotography');?></option>
                    </select>

                    <p class="accesspress_store_image_control" <?php if(!empty($icon->choice) && $icon->choice!='accesspress_image'){ echo 'style="display:none"';}?>>
                        <span class="customize-control-title"><?php esc_html_e('Image','fotography');?></span>
                        <input type="text" class="widefat custom_media_url" value="<?php if(!empty($icon->image_url)) {echo esc_attr($icon->image_url);} ?>">
                        <input type="button" class="button button-primary custom_media_button_accesspress_store" value="<?php esc_html_e('Upload Image','fotography'); ?>" />
                    </p>

                    <div class="accesspress_store_general_control_icon" <?php  if(!empty($icon->choice) && $icon->choice!='accesspress_icon'){ echo 'style="display:none"';}?>>
                        <span class="customize-control-title"><?php esc_html_e('Icon','fotography');?></span>
                        <select name="<?php echo esc_attr($this->id); ?>" class="accesspress_store_icon_control">
                            <?php
                                foreach($icons_array as $contact_icon) {
                                    echo '<option value="'.esc_attr($contact_icon).'" '.selected($icon->icon_value,$contact_icon).'">'.esc_attr($contact_icon).'</option>';
                                }
                            ?>
                        </select>
                    </div>
                <?php } else { ?>
                    <?php if($image_control == true){ ?>
                    <span class="customize-control-title"><?php esc_html_e('Image','fotography')?></span>
                    <p class="accesspress_store_image_control">
                        <input type="text" class="widefat custom_media_url" value="<?php if(!empty($icon->image_url)) {echo esc_attr($icon->image_url);} ?>">
                        <input type="button" class="button button-primary custom_media_button_accesspress_store" value="<?php esc_html_e('Upload Image','fotography'); ?>" />
                    </p>
                <?php } if($icon_control==true){ ?>
                    <span class="customize-control-title"><?php esc_html_e('Icon','fotography')?></span>
                    <select name="<?php echo esc_attr($this->id); ?>" class="accesspress_store_icon_control">
                        <?php
                            foreach($icons_array as $contact_icon) {
                                echo '<option value="'.esc_attr($contact_icon).'" '.selected($icon->icon_value,$contact_icon).'">'.esc_attr($contact_icon).'</option>';
                            }
                        ?>
                    </select>
                <?php } }  if($title_control==true){ ?>
                <span class="customize-control-title"><?php esc_html_e('Title','fotography')?></span>
                <input type="text" value="<?php if(!empty($icon->title)) echo esc_attr($icon->title); ?>" class="accesspress_store_title_control" placeholder="<?php esc_html_e('Title','fotography'); ?>"/>
                <?php } if($text_control==true ){?>
                <span class="customize-control-title"><?php esc_html_e('Text','fotography')?></span>
                <textarea class="accesspress_store_text_control" placeholder="<?php esc_html_e('Text','fotography'); ?>"><?php if(!empty($icon->text)) {echo esc_attr($icon->text);} ?></textarea>
                <?php }  if($link_control){ ?>
                <span class="customize-control-title"><?php esc_html_e('Link','fotography')?></span>
                <input type="text" value="<?php if(!empty($icon->link)) echo esc_url($icon->link); ?>" class="accesspress_store_link_control" placeholder="<?php esc_html_e('Link','fotography'); ?>"/>
                <?php } if($subtitle_control==true){  ?>
                    <span class="customize-control-title"><?php esc_html_e('Button Text','fotography')?></span>
                    <input type="text" value="<?php if(!empty($icon->subtitle)) echo esc_attr($icon->subtitle); ?>" class="accesspress_store_subtitle_control" placeholder="<?php esc_html_e('Button Text','fotography'); ?>"/>
                    <?php   }   ?>
                <input type="hidden" class="accesspress_store_box_id" value="<?php if(!empty($icon->id)) echo esc_attr($icon->id); ?>">
                <button type="button" class="accesspress_store_general_control_remove_field button" <?php if ($it == 0) echo 'style="display:none;"'; ?>><?php esc_html_e('Delete field','fotography'); ?></button>
        </div>
    </div>
    <?php $it++; } } } if ( !empty($this_default) && empty($json)) { ?>
    <input type="hidden" id="accesspress_store_<?php echo $options['section']; ?>_repeater_colector" <?php $this->link(); ?> class="accesspress_store_repeater_colector" value="<?php  echo esc_textarea( json_encode($this_default )); ?>" />
    <?php } else {	?>
    <input type="hidden" id="accesspress_store_<?php echo $options['section']; ?>_repeater_colector" <?php $this->link(); ?> class="accesspress_store_repeater_colector" value="<?php echo esc_textarea( $this->value() ); ?>" />
    <?php } ?>
</div>
<button type="button"   class="button add_field accesspress_store_general_control_new_field"><?php esc_html_e('Add new field','fotography'); ?></button>
<?php } }