<?php
/**
 * FotoGraphy functions and definitions
 *
 * @package FotoGraphy
 */
 
add_action('add_meta_boxes', 'fotography_layout_box');  
function fotography_layout_box()
{   
    add_meta_box(
                 'fotography_gallery_single_page', // $id
                 __( 'Gallery Page Layout', 'fotography' ), // $title
                 'fotography_gallery_page_callback', // $callback
                 'post', // $page
                 'normal', // $context
                 'high'); // $priority

    add_meta_box(
                 'fotography_settings', // $id
                 __( 'Post Sidebar Layout', 'fotography' ), // $title
                 'fotography_page_settings_callback', // $callback
                 'post', // $page
                 'normal', // $context
                 'high'); // $priority

    add_meta_box(
                 'fotography_settings', // $id
                 __( 'Post Sidebar Layout', 'fotography' ), // $title
                 'fotography_page_settings_callback', // $callback
                 'page', // $page
                 'normal', // $context
                 'high'); // $priority

    
    add_meta_box(
                 'fotography_team_categories_settings', // $id
                 __( 'Select Our Team Category', 'fotography' ), // $title
                 'fotography_team_categories_settings_callback', // $callback
                 'page', // $page
                 'side', // $context
                 'low'); // $priority

    add_meta_box(
                 'fotography_testimonial_categories_settings', // $id
                 __( 'Select Testimonial Category', 'fotography' ), // $title
                 'fotography_testimonial_categories_settings_callback', // $callback
                 'page', // $page
                 'side', // $context
                 'low'); // $priority
    
}


// Page Layout Meta Box Functionality

$fotography_page_layouts = array(
       
        'leftsidebar' => array(
                        'value'     => 'leftsidebar',
                        'label'     => __( 'Left Sidebar', 'fotography' ),
                        'thumbnail' => get_template_directory_uri() . '/images/left-sidebar.png',
                    ), 
        'nosidebar' => array(
                        'value' => 'nosidebar',
                        'label' => __( 'No sidebar(Default)', 'fotography' ),
                        'thumbnail' => get_template_directory_uri() . '/images/no-sidebar.png',
                    ),
       
        'rightsidebar' => array(
                        'value'     => 'rightsidebar',
                        'label'     => __( 'Right Sidebar', 'fotography' ),
                        'thumbnail' => get_template_directory_uri() . '/images/right-sidebar.png',
                    ) 
    );

/*---------Function for Page layout meta box----------------------------*/
function fotography_page_settings_callback()
{
    global $post, $fotography_page_layouts ;
    wp_nonce_field( basename( __FILE__ ), 'fotography_settings_nonce' );
?>
    <table class="form-table">
        <tr>
        <td>
        <?php
            $i = 0;  
           foreach ($fotography_page_layouts as $field) {  
           $fotography_page_metalayouts = get_post_meta( $post->ID, 'fotography_page_layouts', true ); 
         ?>            
            <div class="radio-image-wrapper slidercat" id="slider-<?php echo $i; ?>" style="float:left; margin-right:30px;">
            <label class="description">
                <span><img src="<?php echo esc_url( $field['thumbnail'] ); ?>" alt="" /></span></br>
            <input type="radio" name="fotography_page_layouts" value="<?php echo $field['value']; ?>" <?php checked( $field['value'], 
                        $fotography_page_metalayouts ); 
                        if(empty($fotography_page_metalayouts) && 
                            $field['value']=='leftsidebar')
                        { 
                            echo "checked='checked'"; 
                        } ?>/>
                &nbsp;<?php echo $field['label']; ?>
            </label>
            </div>
            <?php 
            $i++;
                } // end foreach 
            ?>
        </td>
        </tr>            
    </table>
<?php
}
/**
 * save the custom metabox data
 * @hooked to save_page hook
 */
/*-------------------Save function for Page Setting-------------------------*/

function fotography_save_page_settings( $post_id ) { 
    global $fotography_page_layouts, $post; 
    // Verify the nonce before proceeding.
    if ( !isset( $_POST[ 'fotography_settings_nonce' ] ) || !wp_verify_nonce( $_POST[ 'fotography_settings_nonce' ], basename( __FILE__ ) ) )
        return;

    // Stop WP from clearing custom fields on autosave
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE)  
        return;
        
    if ('page' == $_POST['post_type']) {  
        if (!current_user_can( 'edit_page', $post_id ) )  
            return $post_id;  
    } elseif (!current_user_can( 'edit_post', $post_id ) ) {  
            return $post_id;  
    }
    
    foreach ($fotography_page_layouts as $field) {  
        //Execute this saving function
        $old = get_post_meta( $post_id, 'fotography_page_layouts', true); 
        $new = sanitize_text_field($_POST['fotography_page_layouts']);
        if ($new && $new != $old) {  
            update_post_meta($post_id, 'fotography_page_layouts', $new);  
        } elseif ('' == $new && $old) {  
            delete_post_meta($post_id,'fotography_page_layouts', $old);  
        } 
     } // end foreach    
}
add_action('save_post', 'fotography_save_page_settings');


/**
 * Gallery Layout Metabox 
**/
$fotography_gallery_layouts = array(
       
        'sly' => array(
                        'value'     => 'sly',
                        'label'     => __( 'Sly Layout(Default)', 'fotography' ),
                        'thumbnail' => get_template_directory_uri() . '/images/sly.png',
                    ), 
        'classic' => array(
                        'value' => 'classic',
                        'label' => __( 'Classic Layout', 'fotography' ),
                        'thumbnail' => get_template_directory_uri() . '/images/classical.png',
                    ),
       
        'folio' => array(
                        'value'     => 'folio',
                        'label'     => __( 'Folio Layout', 'fotography' ),
                        'thumbnail' => get_template_directory_uri() . '/images/folio.png',
                    ) 
    );
function fotography_gallery_page_callback()
{
    global $post, $fotography_gallery_layouts ;
    wp_nonce_field( basename( __FILE__ ), 'fotography_settings_gallery_nonce' );
?>
    <table class="form-table">
        <tr>
        <td>
        <?php
            $i = 0;  
           foreach ($fotography_gallery_layouts as $field) {  
           $fotography_gallery_metalayouts = get_post_meta( $post->ID, 'fotography_gallery_layouts', true ); 
         ?>            
            <div class="radio-image-wrapper slidercat" id="slider-<?php echo $i; ?>" style="float:left; margin-right:30px;">
            <label class="description">
                <span><img src="<?php echo esc_url( $field['thumbnail'] ); ?>" alt="" /></span></br>
            <input type="radio" name="fotography_gallery_layouts" value="<?php echo $field['value']; ?>" <?php checked( $field['value'], 
                        $fotography_gallery_metalayouts ); 
                        if(empty($fotography_gallery_metalayouts) && 
                            $field['value']=='sly')
                        { 
                            echo "checked='checked'"; 
                        } ?>/>
                &nbsp;<?php echo $field['label']; ?>
            </label>
            </div>
            <?php 
            $i++;
                } // end foreach 
            ?>
        </td>
        </tr>            
    </table>
<?php
}

/*-------------------Save function for Gallery Setting-------------------------*/

function fotography_save_gallery_settings( $post_id ) { 
    global $fotography_gallery_layouts, $post; 
    // Verify the nonce before proceeding.
    if ( !isset( $_POST[ 'fotography_settings_gallery_nonce' ] ) || !wp_verify_nonce( $_POST[ 'fotography_settings_gallery_nonce' ], basename( __FILE__ ) ) )
        return;

    // Stop WP from clearing custom fields on autosave
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE)  
        return;
        
    if ('page' == $_POST['post_type']) {  
        if (!current_user_can( 'edit_page', $post_id ) )  
            return $post_id;  
    } elseif (!current_user_can( 'edit_post', $post_id ) ) {  
            return $post_id;  
    }
    
    foreach ($fotography_gallery_layouts as $field) {  
        //Execute this saving function
        $old = get_post_meta( $post_id, 'fotography_gallery_layouts', true); 
        $new = sanitize_text_field($_POST['fotography_gallery_layouts']);
        if ($new && $new != $old) {  
            update_post_meta($post_id, 'fotography_gallery_layouts', $new);  
        } elseif ('' == $new && $old) {  
            delete_post_meta($post_id,'fotography_gallery_layouts', $old);  
        } 
     } // end foreach    
}
add_action('save_post', 'fotography_save_gallery_settings');




// Our Team Category Meta Box Functionality 

function fotography_team_categories_settings_callback()
{
    global $post;
    wp_nonce_field( basename( __FILE__ ), 'fotography_team_categories_settings_nonce' );
    $saved_cat = get_post_meta($post->ID,'team_dropdown',true);
?>
    <select name="team_dropdown"> 
    <option value=""><?php echo __('Select Our Team Category', 'fotography'); ?></option> 
    <?php 
        $categories=  get_categories(); 
        $select_options = '';
        foreach ($categories as $category) {
            $option = '<option value="'.$category->cat_ID.'">';
            $option .= $category->cat_name;
            $option .= '</option>';
            $select_options .= $option;
        }
        //set saved data as selected
        $select_options = str_replace('value="'.$saved_cat.'"','value="'.$saved_cat.'" selected="selected"',$select_options);
        echo $select_options;
    ?>
</select>
<?php
}

/*-------------------Save function for Our Team Categories Setting-------------------------*/

function fotography_team_categories_save_page_settings( $post_id ) { 
    global $post; 
    // Verify the nonce before proceeding.
    if ( !isset( $_POST[ 'fotography_team_categories_settings_nonce' ] ) || !wp_verify_nonce( $_POST[ 'fotography_team_categories_settings_nonce' ], basename( __FILE__ ) ) )
        return;
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE)  
        return;
        
    if ('page' == $_POST['post_type']) {  
        if (!current_user_can( 'edit_page', $post_id ) )  
            return $post_id;  
    } elseif (!current_user_can( 'edit_post', $post_id ) ) {  
            return $post_id;  
    }
    $teammember = sanitize_text_field($_POST['team_dropdown']);
    update_post_meta($post_id,'team_dropdown',$teammember);   
}
add_action('save_post', 'fotography_team_categories_save_page_settings');


// Testimonial Category Meta Box Functionality 

function fotography_testimonial_categories_settings_callback()
{
    global $post;
    wp_nonce_field( basename( __FILE__ ), 'fotography_testimonial_categories_settings_nonce' );
    $saved_cat = get_post_meta($post->ID,'testimonial_dropdown',true);
?>
    <select name="testimonial_dropdown"> 
    <option value=""><?php echo __('Select Testimonial Category', 'fotography'); ?></option> 
    <?php 
        $categories=  get_categories(); 
        $select_options = '';
        foreach ($categories as $category) {
            $option = '<option value="'.$category->cat_ID.'">';
            $option .= $category->cat_name;
            $option .= '</option>';
            $select_options .= $option;
        }
        //set saved data as selected
        $select_options = str_replace('value="'.$saved_cat.'"','value="'.$saved_cat.'" selected="selected"',$select_options);
        echo $select_options;
    ?>
</select>
<?php
}

/*-------------------Save function for Testimonial Categories Setting-------------------------*/

function fotography_testimonial_categories_save_page_settings( $post_id ) { 
    global $post; 
    // Verify the nonce before proceeding.
    if ( !isset( $_POST[ 'fotography_testimonial_categories_settings_nonce' ] ) || !wp_verify_nonce( $_POST[ 'fotography_testimonial_categories_settings_nonce' ], basename( __FILE__ ) ) )
        return;
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE)  
        return;
        
    if ('page' == $_POST['post_type']) {  
        if (!current_user_can( 'edit_page', $post_id ) )  
            return $post_id;  
    } elseif (!current_user_can( 'edit_post', $post_id ) ) {  
            return $post_id;  
    }
    $testimonial = sanitize_text_field($_POST['testimonial_dropdown']);
    update_post_meta($post_id,'testimonial_dropdown', $testimonial);   
}
add_action('save_post', 'fotography_testimonial_categories_save_page_settings');