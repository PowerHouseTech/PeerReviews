<?php 
// Blog Themes Optins 
function fotography_basic_setting($wp_customize)
{
    // Start Basic Settings Themes Options
    $wp_customize->add_panel('fotography_basic_settings', array(
        'title'         => __('Basic Settings','fotography'),
        'description'   => '',
        'capability'    => 'edit_theme_options',
        'priority'      => 10,
        'theme_supports'=>'',
        ));

    $wp_customize->get_section('title_tagline' )->panel = 'fotography_basic_settings';

    // Web Page Layout
    $wp_customize->add_section('fotography_webpage_layout', array(
        'title'     => __('Webpage Layout','fotography'),
        'description' => '',
        'capability' => 'edit_theme_options',
        'priority' => 12,
        'panel'     => 'fotography_basic_settings',
        ));

    $wp_customize->add_setting( 'fotography_webpage_layout', array(
        'default' => 'fullwidth',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'fotography_radio_sanitize_webpagelayout',
        'transport' => 'postMessage'
      
    ) );
 
    $wp_customize->add_control('fotography_webpage_layout', array(
      'type' => 'radio',
      'label' => __('Choose the layout that you want', 'fotography'),
      'section' => 'fotography_webpage_layout',
      'setting' => 'fotography_webpage_layout',
      'choices' => array(
         'fullwidth' => __('Full Width', 'fotography'),
         'boxed' => __('Boxed', 'fotography')
      )
   ));
  

//Logo Settings
$wp_customize->get_section('header_image')->title = __( 'Logo Settings','fotography' );
$wp_customize->get_section('header_image')->priority = 40;
$wp_customize->get_section('header_image')->panel = 'fotography_basic_settings';

//Color Settings
$wp_customize->get_section('colors')->title = __( 'Themes Colors', 'fotography' );
$wp_customize->get_section('colors')->priority = 50;
$wp_customize->get_section('colors')->panel = 'fotography_basic_settings';

//Background Settings
$wp_customize->get_section('background_image')->title = __( 'Background Image', 'fotography' );
$wp_customize->get_section('background_image')->priority = 60;
$wp_customize->get_section('background_image')->panel = 'fotography_basic_settings'; 

    //Footer Copy Right Text
   $wp_customize->add_section('fotography_footer_copyright', array(
        'priority' => 70,
        'title' => __('Footer Copyright', 'fotography'),
        'panel' => 'fotography_basic_settings'
    ));

    $wp_customize->add_setting('fotography_copyright', array(
        'default' => '',
        'sanitize_callback' => 'fotography_sanitize_text',
        'transport' => 'postMessage'
    ));
    
    $wp_customize->add_control('fotography_copyright',array(
        'type' => 'textarea',
        'label' => __('Copyright', 'fotography'),
        'section' => 'fotography_footer_copyright',
        'setting' => 'fotography_copyright',
    ));

    // Panel HomePage  Settings Themes Options
    $wp_customize->add_panel('fotography_homepage_settings', array(
        'title'         => __('HomePage Settings','fotography'),
        'description'   => '',
        'capability'    => 'edit_theme_options',
        'priority'      => 20,
        'theme_supports'=>'',
    ));

    // HomePage Slider Settings 

    $wp_customize->add_section('fotography_homepage_slider_setting', array(
        'priority' => 10,
        'title' => __('Home Slider Settings', 'fotography')
    ));
    
    $wp_customize->add_setting('fotography_homepage_slider_setting_option', array(
      'default' => 'disable',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'fotography_radio_sanitize_enabledisable',
      'transport' => 'postMessage'
   ));

   $wp_customize->add_control('fotography_homepage_slider_setting_option', array(
      'type' => 'radio',
      'label' => __('Enable Disable Slider', 'fotography'),
      'section' => 'fotography_homepage_slider_setting',
      'setting' => 'fotography_homepage_slider_setting_option',
      'choices' => array(
         'enable' => __('Enable', 'fotography'),
         'disable' => __('Disable', 'fotography'),
      )
   ));
   
   //select category for slider
    $categories = get_categories();
    $cats = array();
    $cats[] = 'Select Category';
    foreach($categories as $category){
        $cats[$category->slug] = $category->name;
    }
 
// Main Slider Section

    $wp_customize->add_setting( 'fotography_homepage_advance_slider', array(
      'sanitize_callback' => 'fotography_sanitize_text',
      'default' => '',
      'transport' => 'postMessage'
    ));

    $wp_customize->add_control( new Fotography_Pro_General_Repeater( $wp_customize, 'fotography_homepage_advance_slider', array(
      'label'   => esc_html__('Main Slider Section','fotography'),
      'section' => 'fotography_homepage_slider_setting',
      'description' => __('Upload Slider Image With Slider Title, Description, Link & Button Text','fotography'),
          'image_control' => true,
          'title_control' => true,               
          'text_control' => true,
          'link_control' => true,
          'subtitle_control' => true
    )));

// End Advance Slider Type 
      
   
   //slider controls
   $wp_customize->add_setting('fotography_homepage_slider_show_controls', array(
      'default' => 'yes',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'fotography_radio_sanitize_yesno',
      //'transport' => 'postMessage'
   ));

   $wp_customize->add_control('fotography_homepage_slider_show_controls', array(
      'type' => 'radio',
      'label' => __('Show Pager', 'fotography'),
      'section' => 'fotography_homepage_slider_setting',
      'setting' => 'fotography_homepage_slider_show_controls',
      'choices' => array(
         'yes' => __('Yes', 'fotography'),
         'no' => __('No', 'fotography'),
      )
   ));
    
    //slider caption
   $wp_customize->add_setting('fotography_homepage_slider_show_caption', array(
      'default' => 'yes',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'fotography_radio_sanitize_yesno',
      'transport' => 'postMessage'
   ));

   $wp_customize->add_control('fotography_homepage_slider_show_caption', array(
      'type' => 'radio',
      'label' => __('Show Caption', 'fotography'),
      'section' => 'fotography_homepage_slider_setting',
      'setting' => 'fotography_homepage_slider_show_caption',
      'choices' => array(
         'yes' => __('Yes', 'fotography'),
         'no' => __('No', 'fotography'),
      )
   ));

    
  
  // HomePage Layout Settings
    $wp_customize->add_section('fotography_homepage_page_layout', array(
        'title'     => __('HomePage Gallery Section','fotography'),
        'description' => '',
        'capability' => 'edit_theme_options',
        'priority' => 30,
        'panel'     => 'fotography_homepage_settings',
        ));

    $wp_customize->add_setting('fotography_homepage_gallery_main_title', array(
        'default' => '',
        'sanitize_callback' => 'fotography_sanitize_text',
        'transport' => 'postMessage'
    ));
    
    $wp_customize->add_control('fotography_homepage_gallery_main_title',array(
        'type' => 'text',
        'label' => __('Gallery Title', 'fotography'),
        'section' => 'fotography_homepage_page_layout',
        'setting' => 'fotography_homepage_gallery_main_title',
    ));

    $wp_customize->add_setting( 'fotography_homepage_page_layout', array(
        'default' => 'default',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'fotography_radio_sanitize_web_page_layout',
    ) );
 
    $wp_customize->add_control('fotography_homepage_page_layout', array(
      'type' => 'radio',
      'label' => __('Choose the HomePage Layout', 'fotography'),
      'section' => 'fotography_homepage_page_layout',
      'setting' => 'fotography_homepage_page_layout',
      'choices' => array(
         'default' => __('Default Layout', 'fotography'),
         'thumbnail_view' => __('Sortable Thumb View', 'fotography'),
         'thumbnail_with_slider' => __('Thumbnail View', 'fotography')
      )
   ));

    // HomePage Post Display Category Settings

    
  
    $wp_customize->add_setting( 'cstmzr_categories' , array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
 
    $wp_customize->add_control(
        new WP_Category_Checkboxes_Control(
            $wp_customize,
            'cstmzr_categories',
            array(
                'label' => __('Select Gallery Category','fotography'),
                'section' => 'fotography_homepage_page_layout',
                'settings' => 'cstmzr_categories'
            )
        )
    );

    //select Page for Our Services
   $pages = get_pages();
   $fg_pages = array();
   $fg_pages[0] = 'Select Page';
    foreach ( $pages as $page ) {
       $fg_pages[$page->ID] = $page->post_title;     
    }   

    $wp_customize->add_section('fotography_homepage_counter_section', array(
        'priority' => 20,
        'title' => __('Counter Section', 'fotography'),
        'panel' => 'fotography_homepage_settings',
    ));

    $wp_customize->add_setting('fotography_homepage_about_count_option', array(
      'default' => 'enable',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'fotography_radio_sanitize_enabledisable',
      'transport' => 'postMessage'
    ));

    $wp_customize->add_control('fotography_homepage_about_count_option', array(
      'type' => 'radio',
      'label' => __('Enable/Disable About Count Section', 'fotography'),
      'section' => 'fotography_homepage_counter_section',
      'setting' => 'fotography_homepage_about_count_option',
      'choices' => array(
         'enable' => __('Enable', 'fotography'),
         'disable' => __('Disable', 'fotography'),
      )
    ));

    $wp_customize->add_setting('fotography_homepage_about_counter_one', array(
        'default' => '',
        'sanitize_callback' => 'fotography_sanitize_text',
        'transport' => 'postMessage'
    ));
    
    $wp_customize->add_control('fotography_homepage_about_counter_one',array(
        'type' => 'text',
        'label' => __('Counter One', 'fotography'),
        'section' => 'fotography_homepage_counter_section',
        'setting' => 'fotography_homepage_about_counter_one',
    ));

    $wp_customize->add_setting('fotography_homepage_about_title_one', array(
        'default' => '',
        'sanitize_callback' => 'fotography_sanitize_text',
        'transport' => 'postMessage'
    ));
    
    $wp_customize->add_control('fotography_homepage_about_title_one',array(
        'type' => 'text',
        'label' => __('Title One', 'fotography'),
        'section' => 'fotography_homepage_counter_section',
        'setting' => 'fotography_homepage_about_title_one',
    ));

    $wp_customize->add_setting('fotography_homepage_about_icon_one', array(
        'default' => 'fa-user-secret',
        'sanitize_callback' => 'fotography_sanitize_text',
        'transport' => 'postMessage'
    ));
    
    $wp_customize->add_control('fotography_homepage_about_icon_one',array(
        'type' => 'text',
        'description' => __( 'Example: <strong>fa-user-secret</strong>. Full list of icons is here <strong>Font Awesome Link</strong>', 'fotography' ),
        'label' => __('Icon One', 'fotography'),
        'section' => 'fotography_homepage_counter_section',
        'setting' => 'fotography_homepage_about_icon_one',
    ));


    $wp_customize->add_setting('fotography_homepage_about_counter_two', array(
        'default' => '',
        'sanitize_callback' => 'fotography_sanitize_text',
        'transport' => 'postMessage'
    ));
    
    $wp_customize->add_control('fotography_homepage_about_counter_two',array(
        'type' => 'text',
        'label' => __('Counter Two', 'fotography'),
        'section' => 'fotography_homepage_counter_section',
        'setting' => 'fotography_homepage_about_counter_two',
    ));

    $wp_customize->add_setting('fotography_homepage_about_title_two', array(
        'default' => '',
        'sanitize_callback' => 'fotography_sanitize_text',
        'transport' => 'postMessage'
    ));
    
    $wp_customize->add_control('fotography_homepage_about_title_two',array(
        'type' => 'text',
        'label' => __('Title Two', 'fotography'),
        'section' => 'fotography_homepage_counter_section',
        'setting' => 'fotography_homepage_about_title_two',
    ));

    $wp_customize->add_setting('fotography_homepage_about_icon_two', array(
        'default' => 'fa-users',
        'sanitize_callback' => 'fotography_sanitize_text',
        'transport' => 'postMessage'
    ));
    
    $wp_customize->add_control('fotography_homepage_about_icon_two',array(
        'type' => 'text',
        'description' => __( 'Example: <strong>fa-users</strong>. Full list of icons is here <strong>Font Awesome Link</strong>', 'fotography' ),
        'label' => __('Icon Two', 'fotography'),
        'section' => 'fotography_homepage_counter_section',
        'setting' => 'fotography_homepage_about_icon_two',
    ));


    $wp_customize->add_setting('fotography_homepage_about_counter_three', array(
        'default' => '',
        'sanitize_callback' => 'fotography_sanitize_text',
        'transport' => 'postMessage'
    ));
    
    $wp_customize->add_control('fotography_homepage_about_counter_three',array(
        'type' => 'text',
        'label' => __('Counter Three', 'fotography'),
        'section' => 'fotography_homepage_counter_section',
        'setting' => 'fotography_homepage_about_counter_three',
    ));

    $wp_customize->add_setting('fotography_homepage_about_title_three', array(
        'default' => '',
        'sanitize_callback' => 'fotography_sanitize_text',
        'transport' => 'postMessage'
    ));
    
    $wp_customize->add_control('fotography_homepage_about_title_three',array(
        'type' => 'text',
        'label' => __('Title Three', 'fotography'),
        'section' => 'fotography_homepage_counter_section',
        'setting' => 'fotography_homepage_about_title_three',
    ));

    $wp_customize->add_setting('fotography_homepage_about_icon_three', array(
        'default' => 'fa-tree',
        'sanitize_callback' => 'fotography_sanitize_text',
        'transport' => 'postMessage'
    ));
    
    $wp_customize->add_control('fotography_homepage_about_icon_three',array(
        'type' => 'text',
        'description' => __( 'Example: <strong>fa-tree</strong>. Full list of icons is here <strong>Font Awesome Link</strong>', 'fotography' ),
        'label' => __('Icon Three', 'fotography'),
        'section' => 'fotography_homepage_counter_section',
        'setting' => 'fotography_homepage_about_icon_three',
    ));

    $wp_customize->add_setting('fotography_homepage_about_counter_four', array(
        'default' => '',
        'sanitize_callback' => 'fotography_sanitize_text',
        'transport' => 'postMessage'
    ));
    
    $wp_customize->add_control('fotography_homepage_about_counter_four',array(
        'type' => 'text',
        'label' => __('Counter Four', 'fotography'),
        'section' => 'fotography_homepage_counter_section',
        'setting' => 'fotography_homepage_about_counter_four',
    ));

    $wp_customize->add_setting('fotography_homepage_about_title_four', array(
        'default' => '',
        'sanitize_callback' => 'fotography_sanitize_text',
        'transport' => 'postMessage'
    ));
    
    $wp_customize->add_control('fotography_homepage_about_title_four',array(
        'type' => 'text',
        'label' => __('Title Four', 'fotography'),
        'section' => 'fotography_homepage_counter_section',
        'setting' => 'fotography_homepage_about_title_four',
    ));

    $wp_customize->add_setting('fotography_homepage_about_icon_four', array(
        'default' => 'fa-laptop',
        'sanitize_callback' => 'fotography_sanitize_text',
        'transport' => 'postMessage'
    ));
    
    $wp_customize->add_control('fotography_homepage_about_icon_four',array(
        'type' => 'text',
        'description' => __( 'Example: <strong>fa-laptop</strong>. Full list of icons is here <strong>Font Awesome Link</strong>', 'fotography' ),
        'label' => __('Icon Four', 'fotography'),
        'section' => 'fotography_homepage_counter_section',
        'setting' => 'fotography_homepage_about_icon_four',
    ));


    // HomePage About Section Settings   
    $wp_customize->add_section('fotography_homepage_about', array(
        'priority' => 21,
        'title' => __('About Section', 'fotography'),
        'panel' => 'fotography_homepage_settings',
    ));
    
    $wp_customize->add_setting('fotography_homepage_about_option', array(
      'default' => 'enable',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'fotography_radio_sanitize_enabledisable',
      'transport' => 'postMessage'
   ));

   $wp_customize->add_control('fotography_homepage_about_option', array(
      'type' => 'radio',
      'label' => __('Enable/Disable About Section', 'fotography'),
      'section' => 'fotography_homepage_about',
      'setting' => 'fotography_homepage_about_option',
      'choices' => array(
         'enable' => __('Enable', 'fotography'),
         'disable' => __('Disable', 'fotography'),
      )
   ));  

  
    $wp_customize->add_setting('fotography_homepage_about_page', array(
        'default'        => '',
        'sanitize_callback' => 'fotography_category',
    ));
    $wp_customize->add_control( 'fotography_homepage_about_page', array(
        'settings' => 'fotography_homepage_about_page',
        'label'   => __('Select Page For About Section','fotography'),
        'section'  => 'fotography_homepage_about',
        'type'    => 'select',
        'choices' => $fg_pages,
    ));

    // HomePage Our Services Settings   
   $wp_customize->add_section('fotography_homepage_our_services', array(
        'priority' => 40,
        'title' => __('Our Services Section', 'fotography'),
        'panel' => 'fotography_homepage_settings',
    ));
    
    $wp_customize->add_setting('fotography_homepage_our_service_option', array(
      'default' => 'enable',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'fotography_radio_sanitize_enabledisable',
      'transport' => 'postMessage'
   ));

   $wp_customize->add_control('fotography_homepage_our_service_option', array(
      'type' => 'radio',
      'label' => __('Enable Disable Services Section', 'fotography'),
      'section' => 'fotography_homepage_our_services',
      'setting' => 'fotography_homepage_our_service_option',
      'choices' => array(
         'enable' => __('Enable', 'fotography'),
         'disable' => __('Disable', 'fotography'),
      )
   ));

   $wp_customize->add_setting('fotography_homepage_our_service_title', array(
        'default' => '',
        'sanitize_callback' => 'fotography_sanitize_text',
        'transport' => 'postMessage'
    ));
    
    $wp_customize->add_control('fotography_homepage_our_service_title',array(
        'type' => 'text',
        'label' => __('Our Services Title', 'fotography'),
        'section' => 'fotography_homepage_our_services',
        'setting' => 'fotography_homepage_our_service_title',
    ));
     
    $wp_customize->add_setting('fotography_homepage_services_page_one', array(
        'default'        => '',
        'sanitize_callback' => 'fotography_category',
    ));
    $wp_customize->add_control( 'fotography_homepage_services_page_one', array(
        'settings' => 'fotography_homepage_services_page_one',
        'label'   => __('Select Page For Services Area One','fotography'),
        'section'  => 'fotography_homepage_our_services',
        'type'    => 'select',
        'choices' => $fg_pages,
    ));

    $wp_customize->add_setting('fotography_homepage_services_page_two', array(
        'default'        => '',
        'sanitize_callback' => 'fotography_category',
    ));
    $wp_customize->add_control( 'fotography_homepage_services_page_two', array(
        'settings' => 'fotography_homepage_services_page_two',
        'label'   => __('Select Page For Services Area Two','fotography'),
        'section'  => 'fotography_homepage_our_services',
        'type'    => 'select',
        'choices' => $fg_pages,
    ));

    $wp_customize->add_setting('fotography_homepage_services_page_three', array(
        'default'        => '',
        'sanitize_callback' => 'fotography_category',
    ));
    $wp_customize->add_control( 'fotography_homepage_services_page_three', array(
        'settings' => 'fotography_homepage_services_page_three',
        'label'   => __('Select Page For Services Area Three','fotography'),
        'section'  => 'fotography_homepage_our_services',
        'type'    => 'select',
        'choices' => $fg_pages,
    ));

    // HomePage Blogs Section
    $wp_customize->add_section('fotography_homepage_blog_section', array(
        'priority' => 40,
        'title' => __('Blogs Section', 'fotography'),
        'panel' => 'fotography_homepage_settings',
    ));
    
    $wp_customize->add_setting('fotography_homepage_blogs_option', array(
      'default' => 'enable',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'fotography_radio_sanitize_enabledisable',
      'transport' => 'postMessage'
   ));

   $wp_customize->add_control('fotography_homepage_blogs_option', array(
      'type' => 'radio',
      'label' => __('Enable Disable Blogs Section', 'fotography'),
      'section' => 'fotography_homepage_blog_section',
      'setting' => 'fotography_homepage_blogs_option',
      'choices' => array(
         'enable' => __('Enable', 'fotography'),
         'disable' => __('Disable', 'fotography'),
      )
   ));

   $wp_customize->add_setting('fotography_homepage_blogs_title', array(
        'default' => '',
        'sanitize_callback' => 'fotography_sanitize_text',
        'transport' => 'postMessage'
    ));
    
    $wp_customize->add_control('fotography_homepage_blogs_title',array(
        'type' => 'text',
        'label' => __('Enter Blogs Title', 'fotography'),
        'section' => 'fotography_homepage_blog_section',
        'setting' => 'fotography_homepage_blogs_title',
    ));

   $wp_customize->add_setting('fotography_homepage_blog_cat', array(
        'default'        => '',
        'sanitize_callback' => 'fotography_category',
    ));
    $wp_customize->add_control( 'fotography_homepage_blog_cat', array(
        'settings' => 'fotography_homepage_blog_cat',
        'label'   => __('Select a Category for Blogs','fotography'),
        'section'  => 'fotography_homepage_blog_section',
        'type'    => 'select',
        'choices' => $cats,
    )); 
    // HomePage Call To Action Settings   
   $wp_customize->add_section('fotography_homepage_call_action', array(
        'priority' => 40,
        'title' => __('Call to Action Section', 'fotography'),
        'panel' => 'fotography_homepage_settings',
    ));
    
    $wp_customize->add_setting('fotography_homepage_call_action_option', array(
      'default' => 'enable',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'fotography_radio_sanitize_enabledisable',
      'transport' => 'postMessage'
   ));

   $wp_customize->add_control('fotography_homepage_call_action_option', array(
      'type' => 'radio',
      'label' => __('Enable/Disable Quick Section', 'fotography'),
      'section' => 'fotography_homepage_call_action',
      'setting' => 'fotography_homepage_call_action_option',
      'choices' => array(
         'enable' => __('Enable', 'fotography'),
         'disable' => __('Disable', 'fotography'),
      )
   ));

   $wp_customize->add_setting('fotography_homepage_call_action_image', array(
        'default' => '',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'esc_url_raw'
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'fotography_homepage_call_action_image', array(
        'label' => __('BackGround Image', 'fotography'),
        'section' => 'fotography_homepage_call_action',
        'setting' => 'fotography_homepage_call_action_image',
        //'description' => __( 'Manage Newsletter & Call To Action Section GoTo Backend Click on Appearance >> Widget and Add Widget in HomePage Left Widget & HomePage Right Widget', 'fotography' ),
    )));

    $wp_customize->add_setting('fotography_homepage_call_action_title', array(
        'default' => '',
        'sanitize_callback' => 'fotography_sanitize_text',
        'transport' => 'postMessage'
    ));
    
    $wp_customize->add_control('fotography_homepage_call_action_title',array(
        'type' => 'text',
        'label' => __('Call To Action Title', 'fotography'),
        'section' => 'fotography_homepage_call_action',
        'setting' => 'fotography_homepage_call_action_title',
    ));

    $wp_customize->add_setting('fotography_homepage_call_action_sub_title', array(
        'default' => '',
        'sanitize_callback' => 'fotography_sanitize_text',
        'transport' => 'postMessage'
    ));
    
    $wp_customize->add_control('fotography_homepage_call_action_sub_title',array(
        'type' => 'textarea',
        'label' => __('Call To Action Sub Title', 'fotography'),
        'section' => 'fotography_homepage_call_action',
        'setting' => 'fotography_homepage_call_action_sub_title',
    ));

    $wp_customize->add_setting('fotography_homepage_call_action_button_link', array(
        'default' => '',
        'sanitize_callback' => 'esc_textarea',
        //'transport' => 'postMessage'
    ));
    
    $wp_customize->add_control('fotography_homepage_call_action_button_link',array(
        'type' => 'text',
        'label' => __('Call To Action Button Link', 'fotography'),
        'section' => 'fotography_homepage_call_action',
        'setting' => 'fotography_homepage_call_action_button_link',
    ));

    $wp_customize->add_setting('fotography_homepage_call_action_button_name', array(
        'default' => '',
        'sanitize_callback' => 'fotography_sanitize_text',
        'transport' => 'postMessage'
    ));
    
    $wp_customize->add_control('fotography_homepage_call_action_button_name',array(
        'type' => 'text',
        'label' => __('Call To Action Button Name', 'fotography'),
        'section' => 'fotography_homepage_call_action',
        'setting' => 'fotography_homepage_call_action_button_name',
    ));
  
     // HomePage Call To Action Settings   
   $wp_customize->add_section('fotography_homepage_quick_contact', array(
        'priority' => 40,
        'title' => __('Quick Contact Info', 'fotography'),
        'panel' => 'fotography_homepage_settings',
    ));
    
    $wp_customize->add_setting('fotography_homepage_quick_contact_info', array(
      'default' => 'enable',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'fotography_radio_sanitize_enabledisable',
      'transport' => 'postMessage'
   ));

   $wp_customize->add_control('fotography_homepage_quick_contact_info', array(
      'type' => 'radio',
      'label' => __('Enable/Disable Call Action Section', 'fotography'),
      'section' => 'fotography_homepage_quick_contact',
      'setting' => 'fotography_homepage_quick_contact_info',
      'choices' => array(
         'enable' => __('Enable', 'fotography'),
         'disable' => __('Disable', 'fotography'),
      )
   ));


    $wp_customize->add_setting('fotography_homepage_quick_email_icon', array(
        'default' => 'fa-envelope',
        'sanitize_callback' => 'fotography_sanitize_text',
        'transport' => 'postMessage'
    ));
    
    $wp_customize->add_control('fotography_homepage_quick_email_icon',array(
        'type' => 'text',
        'description' => __( 'Example: <strong>fa-envelope</strong>. Full list of icons is here <strong>Font Awesome Link</strong>', 'fotography' ),
        'label' => __('Email Icon', 'fotography'),
        'section' => 'fotography_homepage_quick_contact',
        'setting' => 'fotography_homepage_quick_email_icon',
    ));

    $wp_customize->add_setting('fotography_homepage_quick_email', array(
        'default' => '',
        'sanitize_callback' => 'fotography_sanitize_text',
        'transport' => 'postMessage'
    ));
    
    $wp_customize->add_control('fotography_homepage_quick_email',array(
        'type' => 'text',
        'label' => __('Email Address', 'fotography'),
        'section' => 'fotography_homepage_quick_contact',
        'setting' => 'fotography_homepage_quick_email',
    ));


    $wp_customize->add_setting('fotography_homepage_quick_twitter_icon', array(
        'default' => 'fa-twitter',
        'sanitize_callback' => 'fotography_sanitize_text',
        'transport' => 'postMessage'
    ));
    
    $wp_customize->add_control('fotography_homepage_quick_twitter_icon',array(
        'type' => 'text',
        'description' => __( 'Example: <strong>fa-twitter</strong>. Full list of icons is here <strong>Font Awesome Link</strong>', 'fotography' ),
        'label' => __('Twitter Icon', 'fotography'),
        'section' => 'fotography_homepage_quick_contact',
        'setting' => 'fotography_homepage_quick_twitter_icon',
    ));

    $wp_customize->add_setting('fotography_homepage_quick_twitter', array(
        'default' => '',
        'sanitize_callback' => 'fotography_sanitize_text',
        'transport' => 'postMessage'
    ));
    
    $wp_customize->add_control('fotography_homepage_quick_twitter',array(
        'type' => 'text',
        'label' => __('Twitter UserName', 'fotography'),
        'section' => 'fotography_homepage_quick_contact',
        'setting' => 'fotography_homepage_quick_twitter',
    ));


    $wp_customize->add_setting('fotography_homepage_quick_phone_icon', array(
        'default' => 'fa-phone-square',
        'sanitize_callback' => 'fotography_sanitize_text',
        'transport' => 'postMessage'
    ));
    
    $wp_customize->add_control('fotography_homepage_quick_phone_icon',array(
        'type' => 'text',
        'description' => __( 'Example: <strong>fa-phone-square</strong>. Full list of icons is here <strong>Font Awesome Link</strong>', 'fotography' ),
        'label' => __('Phone Icon', 'fotography'),
        'section' => 'fotography_homepage_quick_contact',
        'setting' => 'fotography_homepage_quick_phone_icon',
    ));

    $wp_customize->add_setting('fotography_homepage_quick_phone', array(
        'default' => '',
        'sanitize_callback' => 'fotography_sanitize_text',
        'transport' => 'postMessage'
    ));
    
    $wp_customize->add_control('fotography_homepage_quick_phone',array(
        'type' => 'text',
        'label' => __('Phone Number', 'fotography'),
        'section' => 'fotography_homepage_quick_contact',
        'setting' => 'fotography_homepage_quick_phone',
    ));

   //Archive Gallery Settings section
   
    $wp_customize->add_section('fotography_gallery_archive_section', array(
        'priority' => 21,
        'title' => __('Archive Layout Settings', 'fotography'),
    ));

    $wp_customize->add_setting( 'fotography_archive_page_layout',  array(
		'default'       =>      'rightsidebar',
		'sanitize_callback' => 'fotography_archive_page_layouts'
    ));

    $imagepath =  get_template_directory_uri() . '/images/'; 

    $wp_customize->add_control( new WP_Customize_Radioimage_Control( $wp_customize, 'fotography_archive_page_layout', array(
            'section'       =>   'fotography_gallery_archive_section',
            'label'         =>    __('Archive/Blogs Page Layouts', 'fotography'),
            'type'          =>    'radioimage',
            'choices'       =>  array( 
				'leftsidebar' => $imagepath.'left-sidebar.png',  
				'rightsidebar' => $imagepath.'right-sidebar.png', 
				'nosidebar' => $imagepath.'no-sidebar.png',
            )
    )));
    

// Gallery Page Section

   $wp_customize->add_section('fotography_gallery_section', array(
        'priority' => 20,
        'title' => __('Gallery Page Template Settings', 'fotography'),
  ));

   $wp_customize->add_setting( 'fotography_gallery_page_section', array(
        'default' => 'gridview',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'fotography_radio_sanitize_gallery_web_page_layout',
    ) );
 
    $wp_customize->add_control('fotography_gallery_page_section', array(
      'type' => 'radio',
      'label' => __('Choose the Gallery Page Layout', 'fotography'),
      'section' => 'fotography_gallery_section',
      'setting' => 'fotography_gallery_page_section',
      'choices' => array(
         'gridview' => __('Grid View', 'fotography'),
         'sortable' => __('Sortable Thumb View', 'fotography'),         
         'mediumthumbslistview' => __('Thumbs List View', 'fotography'),
         'largethumbslistview' => __('Large Thumbs List View', 'fotography'),         
      )
   ));


   $wp_customize->add_setting( 'cstmzr_categories_gallery', array(
       'default' => '',
       'sanitize_callback' => 'sanitize_text_field',
   )  );
   
   $wp_customize->add_control(
       new WP_Category_Checkboxes_Control(
           $wp_customize,
           'cstmzr_categories_gallery',
           array(
               'label' => __('Select the Category for Gallery Page','fotography'),
               'section' => 'fotography_gallery_section',
               'settings' => 'cstmzr_categories_gallery'
           )
       )
   );   

    
    $wp_customize->add_setting('fotography_gallery_author_section', array(
      'default' => 'no',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'fotography_radio_sanitize_yesno',
   ));

   $wp_customize->add_control('fotography_gallery_author_section', array(
      'type' => 'radio',
      'label' => __('Author Show/Hide Section', 'fotography'),
      'section' => 'fotography_gallery_section',
      'setting' => 'fotography_gallery_author_section',
      'choices' => array(
         'yes' => __('Yes', 'fotography'),
         'no' => __('No', 'fotography'),
      )
   ));

   $wp_customize->add_setting('fotography_gallery_postdate_section', array(
      'default' => 'no',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'fotography_radio_sanitize_yesno',
   ));

   $wp_customize->add_control('fotography_gallery_postdate_section', array(
      'type' => 'radio',
      'label' => __('PostDate Show/Hide Section', 'fotography'),
      'section' => 'fotography_gallery_section',
      'setting' => 'fotography_gallery_postdate_section',
      'choices' => array(
         'yes' => __('Yes', 'fotography'),
         'no' => __('No', 'fotography'),
      )
   ));

   $wp_customize->add_setting('fotography_gallery_meta_category_section', array(
      'default' => 'yes',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'fotography_radio_sanitize_yesno',
   ));

   $wp_customize->add_control('fotography_gallery_meta_category_section', array(
      'type' => 'radio',
      'label' => __('Category Show/Hide Section', 'fotography'),
      'section' => 'fotography_gallery_section',
      'setting' => 'fotography_gallery_meta_category_section',
      'choices' => array(
         'yes' => __('Yes', 'fotography'),
         'no' => __('No', 'fotography'),
      )
   ));

   $wp_customize->add_setting('fotography_gallelry_desc_section', array(
      'default' => '50',
      'sanitize_callback' => 'fotography_sanitize_number',
   ));

   $wp_customize->add_control('fotography_gallelry_desc_section', array(
      'type' => 'number',
      'label' => __('Description Word Limit', 'fotography'),
      'section' => 'fotography_gallery_section',
      'setting' => 'fotography_gallelry_desc_section',
   )); 
    
   // Blogs Settings section

    $wp_customize->add_section('fotography_blog_archive_section', array(
        'priority' => 20,
        'title' => __('Blogs Page Layout Settings', 'fotography'),
  ));

   $wp_customize->add_setting( 'fotography_blog_page_archive_section', array(
        'default' => 'mediumthumbslistview',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'fotography_radio_sanitize_archive_web_page_layout',
    ) );
 
    $wp_customize->add_control('fotography_blog_page_archive_section', array(
      'type' => 'radio',
      'label' => __('Choose the Blogs Page Layout', 'fotography'),
      'section' => 'fotography_blog_archive_section',
      'setting' => 'fotography_blog_page_archive_section',
      'choices' => array(            
         'mediumthumbslistview' => __('Medium Thumbs List View', 'fotography'),
         'largethumbslistview' => __('Large Thumbs List View', 'fotography')
      )
   ));
   
    $wp_customize->add_setting('fotography_blog_author_archive_section', array(
      'default' => 'yes',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'fotography_radio_sanitize_yesno',
   ));

   $wp_customize->add_control('fotography_blog_author_archive_section', array(
      'type' => 'radio',
      'label' => __('Author Show/Hide Section', 'fotography'),
      'section' => 'fotography_blog_archive_section',
      'setting' => 'fotography_blog_author_archive_section',
      'choices' => array(
         'yes' => __('Yes', 'fotography'),
         'no' => __('No', 'fotography'),
      )
   ));

   $wp_customize->add_setting('fotography_blog_postdate_archive_section', array(
      'default' => 'yes',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'fotography_radio_sanitize_yesno',
   ));

   $wp_customize->add_control('fotography_blog_postdate_archive_section', array(
      'type' => 'radio',
      'label' => __('PostDate Show/Hide Section', 'fotography'),
      'section' => 'fotography_blog_archive_section',
      'setting' => 'fotography_blog_postdate_archive_section',
      'choices' => array(
         'yes' => __('Yes', 'fotography'),
         'no' => __('No', 'fotography'),
      )
   ));

   $wp_customize->add_setting('fotography_blog_metacategory_archive_section', array(
      'default' => 'yes',
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'fotography_radio_sanitize_yesno',
   ));

   $wp_customize->add_control('fotography_blog_metacategory_archive_section', array(
      'type' => 'radio',
      'label' => __('Meta Category Show/Hide Section', 'fotography'),
      'section' => 'fotography_blog_archive_section',
      'setting' => 'fotography_blog_metacategory_archive_section',
      'choices' => array(
         'yes' => __('Yes', 'fotography'),
         'no' => __('No', 'fotography'),
      )
   ));
   

   $wp_customize->add_setting('fotography_blog_description_archive_section', array(
      'default' => '50',
      'sanitize_callback' => 'fotography_sanitize_number',
   ));

   $wp_customize->add_control('fotography_blog_description_archive_section', array(
      'type' => 'number',
      'label' => __('Blog Description Word Limit', 'fotography'),
      'section' => 'fotography_blog_archive_section',
      'setting' => 'fotography_blog_description_archive_section',
   ));
 
 // Custom CSS Settings Section
  $wp_customize->add_section('fotography_css_section', array(
        'priority' => 22,
        'title' => __('Custom CSS Section', 'fotography'),
  ));

   $wp_customize->add_setting( 'fotography_css_section', array(
        'default' => '',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'fotography_sanitize_text_css',
    ) );
 
    $wp_customize->add_control('fotography_css_section', array(
      'type' => 'textarea',
      'label' => __('Custom CSS', 'fotography'),
      'section' => 'fotography_css_section',
      'setting' => 'fotography_css_section',
      'description' => '',
   ));

  /*****************************************
  ** Custom Themes Info                   **
  ******************************************/
      
      $wp_customize->add_section('our_product_info', array(
            'title'           =>  __('Our Products', 'fotography'),
            'priority'        =>  '160',
      ));    
      
      $wp_customize->add_setting('theme_info_more_theme',array(
          'default' => '',
          'sanitize_callback' => 'accesspress_store_sanitize_text',
          ));

      $our_product = '<a target="_blank" href="'.admin_url().'themes.php?page=accesspressstore-themes">'.__('More Free Themes','fotography').'</a> <br />';

      $wp_customize->add_control( new Theme_Info_Product_Custom_Control( $wp_customize ,'theme_info_more_theme',array(
          'label' => __( 'More Free Themes' , 'fotography' ),
          'section' => 'our_product_info',
          'description' => $our_product
      )));

      $wp_customize->add_setting('theme_info_pro_theme',array(
          'default' => '',
          'sanitize_callback' => 'fotography_sanitize_text',
      ));

      $our_product = '<a target="_blank" href="https://accesspressthemes.com/wordpress-themes/">'.__('AccessPress PRO Themes','fotography').'</a> <br />';

      $wp_customize->add_control( new Theme_Info_Product_Custom_Control( $wp_customize ,'theme_info_pro_theme',array(
          'label' => __( 'AccessPress PRO Themes' , 'fotography' ),
          'section' => 'our_product_info',
          'description' => $our_product
          )));


      $wp_customize->add_setting('theme_info_useful_plugins',array(
          'default' => '',
          'sanitize_callback' => 'accesspress_store_sanitize_text',
          ));

      $our_product = '<a target="_blank" href="'.esc_url('https://accesspressthemes.com/plugins/').'">'.__('AccessPress Plugins','fotography').'</a>';  

      $wp_customize->add_control( new Theme_Info_Product_Custom_Control( $wp_customize ,'theme_info_useful_plugins',array(
          'label' => __( 'AccessPress Plugins' , 'fotography' ),
          'section' => 'our_product_info',
          'description' => $our_product
      )));


      $wp_customize->add_section('fotography_theme_product_info', array(
            'title'           =>  __('Theme Info', 'fotography'),
            'priority'        =>  '161',
      ));    
      
      $wp_customize->add_setting('theme_info_pro_features',array(
          'default' => '',
          'sanitize_callback' => 'accesspress_store_sanitize_text',
      ));
     
      $wp_customize->add_control( new Theme_Info_Custom_Control( $wp_customize ,'theme_info_pro_features', array(
          'label' => __( 'Fotography Pro Features' , 'fotography' ),
          'section' => 'fotography_theme_product_info',
      )));
     
// Text
    function fotography_sanitize_text( $input ) {
        return wp_kses_post( force_balance_tags( $input ) );
    }

    function fotography_sanitize_text_css( $input ) {
        return  $input;
    }

// Number
    function fotography_sanitize_number( $input ) {
    $output = intval($input);
      return $output;
  } 

  function fotography_sanitize_number_float( $input ) {
    $output = floatval($input);
      return $output;
  } 

  

// Category   

function fotography_category( $input, $setting ) {
    global $wp_customize;
 
    $control = $wp_customize->get_control( $setting->id );
 
    if ( array_key_exists( $input, $control->choices ) ) {
        return $input;
    } else {
        return $setting->default;
    }
}

// Page Layout
   function fotography_radio_sanitize_webpagelayout($input) {
      $valid_keys = array(
         'fullwidth' => __('Full Width', 'fotography'),
         'boxed' => __('Boxed', 'fotography')
      );
      if ( array_key_exists( $input, $valid_keys ) ) {
         return $input;
      } else {
         return '';
      }
   }

   function fotography_radio_sanitize_our_team($input) {
      $valid_keys = array(
         'gridview' => __('Grid View', 'fotography'),         
         'mediumthumbslistview' => __('List View', 'fotography')
      );
      if ( array_key_exists( $input, $valid_keys ) ) {
         return $input;
      } else {
         return '';
      }
   }

   function fotography_layout_sanitize_our_team($input) {
      $valid_keys = array(
         'gridview' => __('Grid View', 'fotography'),         
         'teslistview' => __('List View', 'fotography')
      );
      if ( array_key_exists( $input, $valid_keys ) ) {
         return $input;
      } else {
         return '';
      }
   }
   
    function fotography_radio_sanitize_numcol_web_page_layout($input) {
      $valid_keys = array(
         '1' => __('1', 'fotography'),         
         '2' => __('2', 'fotography'),
         '3' => __('3', 'fotography'),
         '4' => __('4', 'fotography')
      );
      if ( array_key_exists( $input, $valid_keys ) ) {
         return $input;
      } else {
         return '';
      }
   }

   

   function fotography_radio_sanitize_web_page_layout($input) {
      $valid_keys = array(
         'default' => __('Default Layout', 'fotography'),
         'thumbnail_view' => __('Thumbnail View', 'fotography'),
         'thumbnail_with_slider' => __('Gallery Images With Slider', 'fotography')
      );
      if ( array_key_exists( $input, $valid_keys ) ) {
         return $input;
      } else {
         return '';
      }
   }

   function fotography_radio_sanitize_archive_web_page_layout($input) {
      $valid_keys = array(
         'gridview' => __('Grid View', 'fotography'),
         'largethumbslistview' => __('Large Thumbs List View', 'fotography'),
         'mediumthumbslistview' => __('Medium Thumbs List View', 'fotography')
      );
      if ( array_key_exists( $input, $valid_keys ) ) {
         return $input;
      } else {
         return '';
      }
   }


   	function fotography_archive_page_layouts($input) {
    $imagepath =  get_template_directory_uri() . '/images/';
      $valid_keys = array(
        'leftsidebar' => $imagepath.'left-sidebar.png',  
		'rightsidebar' => $imagepath.'right-sidebar.png', 
        'nosidebar' => $imagepath.'no-sidebar.png',
      );
      if ( array_key_exists( $input, $valid_keys ) ) {
         return $input;
      } else {
         return '';
      }
   }


   function fotography_radio_sanitize_gallery_web_page_layout($input) {
      $valid_keys = array(
         'gridview' => __('Grid View', 'fotography'),
         'sortable' => __('Sortable Thumb View', 'fotography'),         
         'mediumthumbslistview' => __('Thumbs List View', 'fotography'),
         'largethumbslistview' => __('Large Thumbs List View', 'fotography')
      );
      if ( array_key_exists( $input, $valid_keys ) ) {
         return $input;
      } else {
         return '';
      }
   }

   function fotography_radio_mode($input) {
      $valid_keys = array(
         'fade' => __('Fade', 'fotography'),
         'horizontal' => __('Slide Horizontal', 'fotography'),
         'vertical' => __('Slide Vertical', 'fotography') 
      );
      if ( array_key_exists( $input, $valid_keys ) ) {
         return $input;
      } else {
         return '';
      }
   }
   


   function fotography_radio_sanitize_enabledisable($input) {
      $valid_keys = array(
        'enable'=>__('Enable', 'fotography'),
        'disable'=>__('Disable', 'fotography')
      );
      if ( array_key_exists( $input, $valid_keys ) ) {
         return $input;
      } else {
         return '';
      }
   }

   function fotography_radio_sanitize_yesno($input) {
      $valid_keys = array(
        'yes'=>__('Yes', 'fotography'),
        'no'=>__('No', 'fotography')
      );
      if ( array_key_exists( $input, $valid_keys ) ) {
         return $input;
      } else {
         return '';
      }
   }

   // checkbox sanitization
   function fotography_checkbox_sanitize($input) {
      if ( $input == 1 ) {
         return 1;
      } else {
         return '';
      }
   }

}
add_action('customize_register','fotography_basic_setting');
?>
