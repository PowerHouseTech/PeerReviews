<?php


//Display message
frontier_post_output_msg();


if ( strlen($fpost_sc_parms['frontier_edit_text_before']) > 1 )
	echo '<div id="frontier_edit_text_before">'.$fpost_sc_parms['frontier_edit_text_before'].'</div>';



//***************************************************************************************
//* Start form
//***************************************************************************************



	echo '<div class="frontier_post_form"> ';
	echo '<form action="'.$frontier_permalink.'" method="post" name="frontier_post" id="frontier_post" enctype="multipart/form-data" >';

	// do not remove this include, as it holds the hidden fields necessary for the logic to work
	include(FRONTIER_POST_DIR."/forms/frontier_post_form_header.php");

	wp_nonce_field( 'frontier_add_edit_post', 'frontier_add_edit_post_'.$thispost->ID );

?>
	<table class="frontier-post-taxonomies"><tbody><tr>
	<td class="frontier_no_border">
	<fieldset id="frontier_post_fieldset_title" class="frontier_post_fieldset">
		<!-- <legend><?php _e("Title", "frontier-post"); ?></legend> -->
		<input class="frontier-formtitle"  placeholder="<?php _e('ENTER YOUR TITLE HERE', 'frontier-post'); ?>" type="text" value="<?php if(!empty($thispost->post_title))echo $thispost->post_title;?>" name="user_post_title" id="fp_title" >
	</fieldset>

	<?php if ( fp_get_option_bool("fps_hide_status") )
		{
		echo '<input type="hidden" id="post_status" name="post_status" value="'.$thispost->post_status.'"  >';
		}
	else
		{
		//echo ' '.__("Status", "frontier-post").': ';
		?>
		<fieldset id="frontier_post_fieldset_status" class="frontier_post_fieldset">
			<legend><?php _e("Status", "frontier-post"); ?></legend>
			<select  class="frontier_post_dropdown chosen-select" id="post_status" name="post_status" >
			<?php foreach($status_list as $key => $value) : ?>
				<option value='<?php echo $key ?>' <?php echo ( $key == $tmp_post_status) ? "selected='selected'" : ' ';?>>
					<?php echo $value; ?>
				</option>
			<?php endforeach; ?>
			</select>

		</fieldset>
	<?php } ?>

	</td></tr>

	<?php
		//****************************************************************************************************
		// Action fires before displaying the editor
		// Do action 		frontier_post_form_standard_top
		// $thispost 		Post object for the post
		// $tmp_task_new  	Equals true if the user is adding a post
		//****************************************************************************************************

		do_action('frontier_post_form_standard_top', $thispost, $tmp_task_new);
	?>

	<tr><td class="frontier_no_border">
	<fieldset class="frontier_post_fieldset">
		<!-- <legend><?php _e("Content", "frontier-post"); ?></legend> -->
		<div id="frontier_editor_field">
		<?php
		wp_editor($thispost->post_content, 'frontier_post_content', frontier_post_wp_editor_args($fpost_sc_parms['frontier_editor_height']));
		?>
		</div>
	</fieldset>
	</td></tr>
	<?php



	//**********************************************************************************
	//* Taxonomies
	//**********************************************************************************

	//$tax_list = array("category", "group", "article-type");
	$tax_list 			= $fpost_sc_parms['frontier_custom_tax'];
	$tax_layout_list 	= fp_get_tax_layout($fpost_sc_parms['frontier_custom_tax'], $fpost_sc_parms['frontier_custom_tax_layout']);


	echo '<tr><td class="frontier_no_border">';

	foreach ( $tax_layout_list as $tmp_tax_name => $tmp_tax_layout)
	{
		if ($tmp_tax_layout != "hide")
			{
			// Cats_selected is set from script, but only for category
			if ($tmp_tax_name != 'category')
				$cats_selected = wp_get_post_terms($thispost->ID, $tmp_tax_name, array("fields" => "ids"));

			echo '<fieldset class="frontier_post_fieldset_tax frontier_post_fieldset_tax_'.$tmp_tax_name.'">';
			// echo '<legend class="frontier_post_legend_tax" >'.fp_get_tax_label($tmp_tax_name).'</legend>';
			frontier_tax_input($thispost->ID, $tmp_tax_name, $tmp_tax_layout, $cats_selected, $fpost_sc_parms, $tax_form_lists[$tmp_tax_name]);
			echo '</fieldset>';
			echo PHP_EOL;
		}
	}

	echo '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.6.2/chosen.min.css"/>';
	echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.6.2/chosen.jquery.min.js"></script>';
	echo '<script>
		jQuery(function() {
		jQuery(".frontier_post_dropdown").chosen();
		});
	</script>';

	if ( current_user_can( 'frontier_post_tags_edit' ) || fp_get_option_bool("fps_show_feat_img") )
	{

		//****************************************************************************************************
		// tags
		//****************************************************************************************************

		if ( current_user_can( 'frontier_post_tags_edit' ) )
			{
			echo '<fieldset class="frontier_post_fieldset_tax frontier_post_fieldset_tax_tag">';
			echo '<legend>'.__("Tags", "frontier-post").'</legend>';
			for ($i=0; $i<$fp_tag_count; $i++)
				{
				$tmp_tag = isset($taglist[$i]) ? fp_tag_transform($taglist[$i]) : "";
				//$tmp_tag = array_key_exists($i, $taglist) ? fp_tag_transform($taglist[$i]) : "";
				echo '<input placeholder="'.__("Enter tag here", "frontier-post").'" type="text" value="'.$tmp_tag.'" name="user_post_tag'.$i.'" id="user_post_tag"><br>';
				}
			echo '</fieldset>';
			}

		//****************************************************************************************************
		// Featured image
		//****************************************************************************************************


		if ( fp_get_option_bool("fps_show_feat_img") )
		{

			//force grid view
			//update_user_option( get_current_user_id(), 'media_library_mode', 'grid' );

			//set iframe size for image upload
			if ( wp_is_mobile() )
				{
				$i_size 	= "&width=240&height=320";
				$i_TBsize 	= "&TB_width=240&TB_height=320";
				}
			else
				{
				$i_size 	= "&width=640&height=400";
				$i_TBsize 	= "&TB_width=640&TB_height=400";
				}

			?>
			<!--<td class="frontier_featured_image">-->

			<fieldset class="frontier_post_fieldset_tax frontier_post_fieldset_tax_featured">
			<!-- <legend><?php _e("Featured image", "frontier-post"); ?></legend> -->
			<?php
			//$FeatImgLinkHTML = '<a title="Select featured Image" href="'.site_url('/wp-admin/media-upload.php').'?post_id='.$post_id.'&amp;type=image&amp;TB_iframe=1'.$i_size.'" id="set-post-thumbnail" class="thickbox">';
			$FeatImgLinkHTML = '<a title="ADD COVER IMAGE" href="'.site_url('/wp-admin/media-upload.php').'?post_id='.$post_id.$i_TBsize.'&amp;tab=library&amp;mode=grid&amp;type=image&amp;TB_iframe=1'.$i_size.'" id="set-post-thumbnail" class="thickbox">';
			//$FeatImgLinkHTML = '<a title="Select featured Image" href="'.site_url('/wp-admin/upload.php').'?post_id='.$post_id.$i_TBsize.'&amp;mode=grid&amp;type=image&amp;TB_iframe=1'.$i_size.'" id="set-post-thumbnail" class="thickbox">';

			if (has_post_thumbnail($post_id)) {
				$FeatImgLinkHTML = $FeatImgLinkHTML.get_the_post_thumbnail($post_id, 'thumbnail').'<br>';

				// //Thumbnail function (please work)
				function make_thumb($src, $desired_width) {

					/* read the source image */
					$source_image = imagecreatefromjpeg($src);
					$width = imagesx($source_image);
					$height = imagesy($source_image);

					/* find the "desired height" of this thumbnail, relative to the desired width  */
					$desired_height = floor($height * ($desired_width / $width));

					/* create a new, "virtual" image */
					$virtual_image = imagecreatetruecolor($desired_width, $desired_height);

					/* copy source image at a resized size */
					imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $width, $height);

					/* create the physical thumbnail image to its destination */
					imagejpeg($virtual_image);
				}
				$thumb = fopen(the_post_thumbnail_url(post-thumbnail), "r");
				echo $thumb;
				$desired_width = 300;
				make_thumb($thumb, $desired_width);

			}

			$FeatImgLinkHTML = $FeatImgLinkHTML.'<br><i class="fa fa-picture-o fa-2x fa-2"></i>&nbsp; ADD COVER IMAGE'.__("", "frontier-post").'</a>';

			// <img class="cover" src="http://dev-wordpress-local.pantheonsite.io/wp-content/uploads/2016/08/ADD-COVER-IMAGE.png"/>

			echo $FeatImgLinkHTML."<br>";
			// echo '<div id="frontier_post_featured_image_txt">'.__("Not updated until post is saved", "frontier-post").'</div>';

			echo '</fieldset>';
			//echo '</td>';
		}
		//echo '</tr></tbody></table>';
	}

	if ( current_user_can( 'frontier_post_exerpt_edit' ) )
			{ ?>
			<fieldset class="frontier_post_fieldset_excerpt">
				<legend style="border:none;"><?php _e("ABOUT THIS STORY", "frontier-post")?></legend>
				<textarea name="user_post_excerpt" id="user_post_excerpt" placeholder="Briefly explain what your story is about and why you wrote it..."><?php if(!empty($thispost->post_excerpt))echo $thispost->post_excerpt;?></textarea><i class="fa fa-pencil"></i>
			</fieldset>

	<?php 	}

		echo '</td></tr>';

		//****************************************************************************************************
		// post moderation
		//****************************************************************************************************

		if ( fp_get_option_bool("fps_use_moderation") && (current_user_can("edit_others_posts") || $current_user->ID == $thispost->post_author))
			{
			echo '<tr><td class="frontier_no_border">';
			echo '<fieldset class="frontier_post_fieldset_moderation">';
			echo '<legend>'.__("Post Moderation", "frontier-post").'</legend>';
			//Allow email to be send to author on comment update
			if (current_user_can("edit_others_posts"))
				echo __("Email author with moderation comments ?", "frontier-post").' '.'<input name="frontier_post_moderation_send_email" id="frontier_post_moderation_send_email" value="true"  type="checkbox"><br>';

			echo '<textarea name="frontier_post_moderation_new_text" id="frontier_post_moderation_new_text" >';
			echo '</textarea>';
			echo __("Previous comments", "frontier-post").':<br>';
			echo '<hr>';
			echo $fp_moderation_comments;

			echo '</fieldset>';


			echo '</td></tr>';

			}
		//****************************************************************************************************
		// Action fires just before the submit buttons
		// Do action 		frontier_post_form_standard
		// $thispost 		Post object for the post
		// $tmp_task_new  	Equals true if the user is adding a post
		//****************************************************************************************************

		do_action('frontier_post_form_standard', $thispost, $tmp_task_new);


		echo '<tr><td class="frontier_no_border">';

	?>



		<fieldset class="frontier_post_fieldset">
		<!-- <legend><?php _e("Actions", "frontier-post"); ?></legend> -->
		<?php

		// echo '<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css"/>';

		if ( fp_get_option_bool("fps_submit_save") )
		{ ?>
			<button class="button" type="submit" name="user_post_submit" 		id="user_post_save" 	value="save">
				<!-- <i class="fa fa-paper-plane"></i> -->
				<?php _e("Save", "frontier-post"); ?>
			</button>
		<?php }

		if ( fp_get_option_bool("fps_submit_savereturn") )
		{ ?>
			<button class="button" type="submit" name="user_post_submit" 	id="user_post_submit" 	value="savereturn"><?php echo $fpost_sc_parms['frontier_return_text']; ?></button>
		<?php }

		if ( fp_get_option_bool("fps_submit_publish") && ($thispost->post_status !== "publish" || $tmp_task_new) && current_user_can("frontier_post_can_publish") )
		{ ?>
			<button class="button" type="submit" name="user_post_submit" 	id="user_post_publish" 	value="publish"><?php _e("Publish", "frontier-post"); ?></button>
		<?php }

		if ( fp_get_option_bool("fps_submit_preview") )
		{ ?>
			<button class="button" type="submit" name="user_post_submit" 	id="user_post_preview" 	value="preview"><?php _e("Save & Preview", "frontier-post"); ?></button>
		<?php }

		if ( fp_get_option_bool("fps_submit_delete")  && current_user_can("frontier_post_can_delete") && !$tmp_task_new )
		{ ?>
			<button class="button frontier-post-form-delete" type="submit" name="user_post_submit" 	id="user_post_delete" 	value="delete"><?php _e("Delete", "frontier-post"); ?></button>
		<?php }

		if ( fp_get_option_bool("fps_submit_cancel") )
		{ ?>
		<input type="reset" value="<?php _e("Cancel", "frontier-post"); ?>"  name="cancel" id="frontier-post-cancel" onclick="location.href='<?php the_permalink();?>'">
		<?php }


		/*
		if ( fp_get_option_bool("fps_submit_delete") && $thispost->post_status !== "publish" && current_user_can("frontier_post_can_delete") && !$tmp_task_new )
			{
			echo "&nbsp;".frontier_post_delete_link($thispost, false, $frontier_permalink, 'frontier-post-form-delete' );
			}
		*/
		// echo '<p class="frontier-post-form-posttype">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;('.__("Post type", "frontier-post").": ".fp_get_posttype_label_singular($thispost->post_type).') </p>';
		?>
		<link rel="stylesheet" href="../font-awesome-4.6.3/css/font-awesome.css"/>
		<div class="paperplane"><i class="fa fa-paper-plane pub"></i></div>
	</fieldset>

	</td></tr></table>
</form>

	</div> <!-- ending div -->
<?php

	// end form file
?>
