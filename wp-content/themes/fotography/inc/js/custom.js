jQuery(document).ready(function($){
	  $( "#page_template" ).on('change',function() {
		var pageTemplate = $('#page_template').val();

		  if(pageTemplate == 'template-team.php'){
		  	$('#fotography_team_categories_settings').show('swing');
		  }
		  else{
		  	$('#fotography_team_categories_settings').hide('swing');
		  }

		  if(pageTemplate == 'template-testimonial.php'){		  	
		  	$('#fotography_testimonial_categories_settings').show('swing');
		  }
		  else{
		  	$('#fotography_testimonial_categories_settings').hide('swing');
		  }

	    }).change();

	    $('#post-formats-select').on('click',function() {
	   		var post_type = $('input[name="post_format"]:checked').val();
			if(post_type == 'image') {
	   			$('#fotography_gallery_single_page').show('swing');
	   		}
	   		else {
	   			$('#fotography_gallery_single_page').hide('swing');	
	   		}   		
	   	})

	   	var post_type = $('input[name="post_format"]:checked').val();
			if(post_type == 'image') {
	   			$('#fotography_gallery_single_page').show('swing');
	   		}
	   		else{
	   			$('#fotography_gallery_single_page').hide();	
	   		}
	  
	$('#customize-control-fotography_blog_page_archive_section').on('change',function(){
       var radioOption = $(this).find('input[type="radio"]:checked').val();
       if(radioOption == 'gridview'){
           $('#customize-control-fotography_blog_grid_archive_section').show('swing');
       } else {
           $('#customize-control-fotography_blog_grid_archive_section').hide('swing');
       }
   }).change();   

   /*Sticky user note  */
      $('#accordion-panel-fotography_basic_settings').prepend(
          '<div class="user_sticky_note">'+
          '<span class="sticky_info_row"><a class="button" href="http://demo.accesspressthemes.com/fotography/" target="_blank">Live Demo</a>'+
          '<span class="sticky_info_row"><a class="button" href="http://doc.accesspressthemes.com/fotography/" target="_blank">Documentation</a></span>'+
          '<span class="sticky_info_row"><a class="button" href="https://accesspressthemes.com/support/forum/themes/free-themes/fotography/" target="_blnak">Support Forum</a></span>'+
          '</div>'
        );  
});