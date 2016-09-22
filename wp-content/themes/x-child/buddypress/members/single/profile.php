<?php

/**
 * BuddyPress - Users Profile
 *
 * @package BuddyPress
 * @subpackage bp-legacy
 */

?>

<div class="outer_container">
<div class="banner"></div>  <!-- orange banner across the top under main heading/nav -->

<div class="my_info">  <!-- container for all elements overlapping and below the orange banner -->


	<div class="my_overview">  <!-- ====== container for MY OVERVIEW box ====== -->
		<p style="text-align: center">My Overview Placeholder</p>
	</div>  <!-- .my_overview -->


	<div class="tabbed_box">  <!-- outer container grouping tabs and main content container -->

		<nav class="tabs">
			<ul>
				<li class="info_tab active"><p>Bio</p></li>
				<li class="info_tab"><p>My Stories</p></li>
				<li class="info_tab"><p>My Spikes</p></li>
				<li class="info_tab"><p>Photos</p></li>
			</ul>
		</nav>

		<div class="content_box">  <!-- outer container for all content boxes -->


			<section class="section_content bio active">  <!-- content box for the Bio section -->

				<div class="section_inner_container">  <!-- inner container added to all sections, leftmost info container in this case -->

					<div class="x-item-list-tabs-subnav item-list-tabs no-ajax" id="subnav" role="navigation">  <!-- beginning of code originally in this profile.php file; nothing changed -->
						<ul>
							<?php bp_get_options_nav(); ?>
						</ul>
					</div><!-- .item-list-tabs -->
					<?php do_action( 'bp_before_profile_content' ); ?>
					<div class="profile" role="main">
						<?php switch ( bp_current_action() ) :

							// Edit
							case 'edit'   :
								bp_get_template_part( 'members/single/profile/edit' );
								break;

							// Change Avatar
							case 'change-avatar' :
								bp_get_template_part( 'members/single/profile/change-avatar' );
								break;

							// Compose
							case 'public' :

								// Display XProfile
								if ( bp_is_active( 'xprofile' ) )
									bp_get_template_part( 'members/single/profile/profile-loop' );

								// Display WordPress profile (fallback)
								else
									bp_get_template_part( 'members/single/profile/profile-wp' );

								break;

							// Any other
							default :
								bp_get_template_part( 'members/single/plugins' );
								break;
						endswitch; ?>
					</div><!-- .profile -->
					<?php do_action( 'bp_after_profile_content' ); ?>  <!-- end of code originally in this profile.php file; nothing changed -->

				</div>  <!-- section_inner_container -->

				<div class="other"></div>  <!-- rightmost info container for Bio section; jQuery adds contents to this div -->
			</section>  <!-- bio -->


			<section class="section_content my_stories">  <!-- ====== container for MY STORIES box ====== -->

				<div class="section_inner_container">  <!-- inner container added to all sections, edit at will -->

				</div>  <!-- section_inner_container -->
			</section>  <!-- my_stories -->


			<section class="section_content my_spikes">  <!-- ====== container for MY SPIKES box ====== -->

				<div class="section_inner_container">  <!-- inner container added to all sections, edit at will -->
					<h4>My Spikes</h4>
				</div>  <!-- section_inner_container -->
			</section>  <!-- my_spikes -->


			<section class="section_content photos">  <!-- ====== container for PHOTOS box ====== -->

				<div class="section_inner_container">  <!-- inner container added to all sections, edit at will -->
					<h4>Photos</h4>
				</div>  <!-- section_inner_container -->
			</section>  <!-- photos -->
		</div>  <!-- content_box -->
	</div>  <!-- tabbed_box -->
</div>  <!-- my_info -->
</div>
