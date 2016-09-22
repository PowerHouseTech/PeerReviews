/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
	

    // Site title and description.
    wp.customize( 'blogname', function( value ) {
        value.bind( function( to ) {
            $( '.site-branding .site-title' ).text( to );
        } );
    } );
    wp.customize( 'blogdescription', function( value ) {
        value.bind( function( to ) {
            $( '.site-branding .site-description' ).text( to );
        } );
    } );

    wp.customize("fotography_webpage_layout", function(value) {
        value.bind(function(to) {
            if( to == 'boxed' && $('body').hasClass('fullwidth-layout') ) {
                $('body').removeClass('fullwidth-layout');
                $('body').addClass('boxed-layout');
            } else {
                $('body').removeClass('boxed-layout');
                $('body').addClass('fullwidth-layout');
            }
        } );
    }); 

    // Slider Section
    wp.customize("fotography_homepage_slider_setting_option", function(value) {
        value.bind(function(to) {
            if( to == 'enable') {
               $(".fg-banner-slider").css("display", "block");
            } else {
                $(".fg-banner-slider").css("display", "none");
            }
        } );
    });

    wp.customize("fotography_homepage_slider_show_controls", function(value) {
        value.bind(function(to) {
            if( to == 'yes') {
               $(".slides-pagination").css("display", "block");
            } else {
                $(".slides-pagination").css("display", "none");
            }
        } );
    });
  
    wp.customize("fotography_homepage_slider_show_caption", function(value) {
        value.bind(function(to) {
            if( to == 'yes') {
               $(".caption").css("display", "block");
            } else {
                $(".caption").css("display", "none");
            }
        } );
    });   
	
    //Counder Secction Customizer	

     wp.customize("fotography_homepage_about_count_option", function(value) {
        value.bind(function(to) {
            if( to == 'enable') {
               $(".counter-section").css("display", "block");
            } else {
                $(".counter-section").css("display", "none");
            }
        } );
    });

    // One
	wp.customize("fotography_homepage_about_counter_one", function(value) {
        value.bind(function(to) {
            $(".about-counter > .counter-one").text(to);
        } );
    });

	 wp.customize("fotography_homepage_about_title_one", function(value) {
        value.bind(function(to) {
            $(".about-counter > .title-one").text(to);
        } );
    });

    wp.customize( 'fotography_homepage_about_icon_one', function( value )  {
        value.bind( function( to )  {          
           $( '.icon-one' ).find( 'i' ).attr( 'class', 'fa fa-2x '+ to );
        } );
    } );

    // Two
	wp.customize("fotography_homepage_about_counter_two", function(value) {
        value.bind(function(to) {
            $(".about-counter > .counter-two").text(to);
        } );
    });

	wp.customize("fotography_homepage_about_title_two", function(value) {
        value.bind(function(to) {
            $(".about-counter > .title-two").text(to);
        } );
    });

    wp.customize( 'fotography_homepage_about_icon_two', function( value )  {
        value.bind( function( to )  {
           $( '.icon-two' ).find( 'i' ).attr( 'class', 'fa fa-2x '+ to );
        } );
    } );  

    // Three
    wp.customize("fotography_homepage_about_counter_three", function(value) {
        value.bind(function(to) {
            $(".about-counter > .counter-three").text(to);
        } );
    });

    wp.customize("fotography_homepage_about_title_three", function(value) {
        value.bind(function(to) {
            $(".about-counter > .title-three").text(to);
        } );
    });

    wp.customize( 'fotography_homepage_about_icon_three', function( value )  {
        value.bind( function( to )  {
           $( '.icon-three' ).find( 'i' ).attr( 'class', 'fa fa-2x '+ to );
        } );
    } );
   
    // Four
    wp.customize("fotography_homepage_about_counter_four", function(value) {
        value.bind(function(to) {
            $(".about-counter > .counter-four").text(to);
        } );
    });

    wp.customize("fotography_homepage_about_title_four", function(value) {
        value.bind(function(to) {
            $(".about-counter > .title-four").text(to);
        } );
    });   

    wp.customize( 'fotography_homepage_about_icon_four', function( value )  {
        value.bind( function( to )  {
           $( '.icon-four' ).find( 'i' ).attr( 'class', 'fa fa-2x '+ to );
        } );
    } );

    // About Section

    wp.customize("fotography_homepage_about_option", function(value) {
        value.bind(function(to) {
            if( to == 'enable') {
               $(".fg_aboutus").css("display", "block");
            } else {
                $(".fg_aboutus").css("display", "none");
            }
        } );
    }); 

    // Gallery Section

    wp.customize("fotography_homepage_gallery_main_title", function(value) {
        value.bind(function( to ) {
            $( ".fg_gallery_section > .section-title" ).text( to );
        } );
    });


    //Our Services Secction Customizer 

    wp.customize("fotography_homepage_our_service_option", function(value) {
        value.bind(function(to) {
            if( to == 'enable') {
               $(".fg_service_section").css("display", "block");
            } else {
                $(".fg_service_section").css("display", "none");
            }
        } );
    }); 

    wp.customize("fotography_homepage_our_service_title", function(value) {
        value.bind(function(to) {
            $( ".fg_service_section > .section-title" ).text( to );
        } );
    });

    // Blogs Section

    wp.customize("fotography_homepage_blogs_option", function(value) {
        value.bind(function(to) {
            if( to == 'enable') {
               $(".fg-blog-section").css("display", "block");
            } else {
                $(".fg-blog-section").css("display", "none");
            }
        } );
    });

    wp.customize("fotography_homepage_blogs_title", function(value) {
        value.bind(function(to) {
            $( ".fg-blog-section .section-title" ).text( to );
        } );
    });

    // Call To Action Section

    wp.customize("fotography_homepage_call_action_option", function(value) {
        value.bind(function(to) {
            if( to == 'enable') {
               $(".home_caltoaction").css("display", "block");
            } else {
                $(".home_caltoaction").css("display", "none");
            }
        } );
    });

    wp.customize("fotography_homepage_call_action_title", function(value) {
        value.bind(function(to) {
            $( ".home_caltoaction .section-title" ).text( to );
        } );
    });

    wp.customize("fotography_homepage_call_action_sub_title", function(value) {
        value.bind(function(to) {
            $( ".home_caltoaction .call-to-action-subtitle" ).text( to );
        } );
    });

    wp.customize("fotography_homepage_call_action_button_name", function(value) {
        value.bind(function(to) {
            $( ".call-to-action-button > a" ).text( to );
        } );
    });   

    
    // Quick Contact Section

    wp.customize("fotography_homepage_quick_contact_info", function(value) {
        value.bind(function(to) {
            if( to == 'enable') {
               $(".quick_contact_section").css("display", "block");
            } else {
                $(".quick_contact_section").css("display", "none");
            }
        } );
    });
    
    wp.customize("fotography_homepage_quick_email", function(value) {
        value.bind(function(to) {
            $(".email-address").text(to);
        } );
    });

    wp.customize( 'fotography_homepage_quick_email_icon', function( value )  {
        value.bind( function( to )  {
           $( '.email-icon' ).find( 'i' ).attr( 'class', 'fa fa-2x '+ to );
        } );
    } );

    wp.customize("fotography_homepage_quick_twitter", function(value) {
        value.bind(function(to) {
            $(".twitter-address").text(to);
        } );
    });  
    
    wp.customize( 'fotography_homepage_quick_twitter_icon', function( value )  {
        value.bind( function( to )  {
           $( '.twitter-icon' ).find( 'i' ).attr( 'class', 'fa fa-2x '+ to );
        } );
    } );

    wp.customize("fotography_homepage_quick_phone", function(value) {
        value.bind(function(to) {
            $(".phone-number").text(to);
        } );
    });

    wp.customize( 'fotography_homepage_quick_phone_icon', function( value )  {
        value.bind( function( to )  {
           $( '.phone-icon' ).find( 'i' ).attr( 'class', 'fa fa-2x '+ to );
        } );
    } );  
  
    
     wp.customize("fotography_homepage_page_layout", function(value) {
        value.bind(function(to) {
            if( to == 'default') {
               $("#customize-control-fotography_homepage_gallery_button").css("display", "block");
            } else
            {
               $("#customize-control-fotography_homepage_gallery_button").css("display", "none"); 
            }
        } );
    });

    // Copyright Section

    wp.customize("fotography_copyright", function(value) {
        value.bind(function(to) {
            $(".copyright span").text(to);
        } );
    });


	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {        
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute',
                    'display' : 'none'
				} );
			} else {
				$( '.site-title, .site-description' ).css( {
					'clip': 'auto',
					'color': to,
					'position': 'relative',
                    'display' : 'block'
				} );
			}
		} );
	} );

} )( jQuery );
