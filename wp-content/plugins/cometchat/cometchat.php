<?php
/*
Plugin Name: CometChat
Plugin URI: http://www.cometchat.com
Description: Enable chat on your site in minutes and increase user activity exponentially!
Author: CometChat
Author URI: http://www.cometchat.com
*/
if(!defined('ABSPATH')) {
		exit;
}
require_once(ABSPATH.'wp-admin/includes/plugin.php');
global $cc_key;
add_action('admin_menu', 'add_menu_item');
$myApi = get_option('cc-api-key');
if(!empty($myApi)) {
	$cc_key = fnDecrypt($myApi);
	if(is_numeric($cc_key)) {
		add_action('wp_head', 'cc_addbar');
		add_action('init','userDetails');
		if(function_exists('bp_is_active')) {
			add_action('wp_logout','cometchat_addFriend');
			add_action('friends_friendship_accepted','cometchat_addFriend');
			add_action('friends_friendship_deleted','cometchat_addFriend');
		}
	}
}

function cc_addbar() {
	global $cc_key;
	global $cc_base;
	if(!empty($cc_base)) {
		echo "<script  type='text/javascript'>
			var cc_base = {$cc_base};
			</script>
		";
	}
	echo "<link type='text/css' href='//fast.cometondemand.net/".$cc_key."x".substr(md5($cc_key),0,5).".css' rel='stylesheet' charset='utf-8' />
		<script type='text/javascript' src='//fast.cometondemand.net/".$cc_key."x".substr(md5($cc_key),0,5).".js' charset='utf-8'></script>";
}
function userDetails() {
	global $cc_base;
	global $current_user;
	global $role,$user_info;
	$link = $avatar = $user_id = $user_name = $userRole = $friends = '';
	if(is_user_logged_in()) {
		$user_id = $current_user->ID;
		$user_name = $current_user->user_login;
		if(function_exists('bp_get_loggedin_user_avatar')) {
			$avatar = bp_get_loggedin_user_avatar('html=false');
		}else {
			$avatar = get_avatar_url($user_id);
		}
		if(function_exists('bp_loggedin_user_domain')) {
			$link = bp_loggedin_user_domain();
		}else {
			$link = get_edit_user_link($user_id);
		}
		$user_info = array("id"=>$user_id,"n"=>$user_name,"a"=>$avatar,"l"=>$link);
		$cc_base = json_encode($user_info);
	}
}
function cometchat_addFriend() {
	global $cc_key;
	global $current_user;
	$user_id = $current_user->ID;
	if(function_exists('friends_get_friend_user_ids')) {
		$friends = friends_get_friend_user_ids($user_id);
		$friends_data = array("id"=>$user_id,"f"=>$friends);
		$friends_ids = json_encode($friends_data);
		$request_url  = 'http://'.$cc_key.'.cometondemand.net/cometchat_update.php';
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $request_url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, 'userinfo='.$friends_ids);
		$response = curl_exec($curl);
		$curl_error = curl_error($curl);
		curl_close($curl);
	}
}
function add_menu_item() {
    add_menu_page( 'CometChat', 'CometChat', 'manage_options', 'function', 'global_custom_options', plugins_url( 'cometchat/icon.png' ), '2.24' );
}
function global_custom_options()
{
?>
    <div class="wrap">
        <h2>CometChat Configuration</h2>
        <p><?php _e('You are one step away from having CometChat on your site! Please enter CometChat API Key and click "Save" to proceed.'); ?>
        </p>
        <form method="POST">
         	<table class="form-table">
         		<tr valign="top">
	        	<th scope="row"><?php _e('CometChat API Key:'); ?></th>
	            	<td><input type="text" name="cc-api-key" size="35" value="<?php echo get_option('cc-api-key'); ?>" /></td>
	            </tr>
	        </table></br>
	        <input type="submit" class = "button button-primary button-large" name="api-submit" value="Save" />
		</form>
	</div>
<?php
}
function fnDecrypt($cc_apikey) {
   $x="\x62a\x73\x656\x34\x5fd\x65c\157\144\x65";
	return rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5(hash("SHA256", $x('Y2hhdA=='), true)), $x(rawurldecode($cc_apikey)), MCRYPT_MODE_CBC, md5(md5(hash("SHA256", $x('Y2hhdA=='), true)))), "\0");
}
if(isset($_POST['api-submit'])) {
	update_option('cc-api-key',$_POST['cc-api-key']);
}
register_uninstall_hook( __FILE__, 'delete_cc_key' );
function delete_cc_key() {
	$cc_api_key = get_option('cc-api-key');
	if(!empty($cc_api_key)){
		delete_option('cc-api-key');
	}
}