<?php
/* 
Plugin Name: WP Call Tracking
Plugin URI: http://www.sicdigital.com
Description: WP Call Tracking is the most advanced plugin available for  tracking phone calls genereated through your website. 
Author: Michael Chaocn
Version: 1.0 
Author URI: http://www.mikechacon.com


Version: 1.0 

This is all about getting this plugin to be functional, no user interface.
Focus is on functionality of core aspects listed below.

1. The ability to collect and Store Calls
2. Store Meta data of calls (Recordings, Date, Status, CallerID, )
3. Sorting Calls based on Date/Time

*/  

//Set Plugin Paths
define('WPCT_DIR', plugin_dir_url(__FILE__) );
define( 'WPCT_PATH', plugin_dir_path(__FILE__) );

//Include Twilio
require(WPCT_PATH . '/library/twilio/Services/Twilio.php');

// set your AccountSid and AuthToken from www.twilio.com/user/account
$AccountSid = "ACXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX";
$AuthToken = "YYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYY";

function wpct_scripts() {
	wp_enqueue_style( 'admin-styles', WPCT_DIR . '/interface/wpct-styles.css' );
}

add_action( 'admin_enqueue_scripts', 'wpct_scripts' );	

add_action('admin_menu', 'wpct_menu_page');

function wpct_menu_page() {
	
  add_menu_page('WPCT Settings', 'Calls', 'manage_options', 'wpct', 'wpct_dashboard', WPCT_DIR . '/interface/images/phone-icon.png');
  add_submenu_page( 'wpct', 'Numbers', 'Numbers', 'manage_options', 'wpct-numbers', 'wpct_numbers_page');
  add_submenu_page( 'wpct', 'Settings page title', 'Settings', 'manage_options', 'wpct-settings', 'wpct_settings_page');
}

function wpct_dashboard(){
                echo '<div class="wrap"><div id="icon-options-general" class="icon32"><br></div>
                <h2>Settings</h2></div>';
}

function wpct_numbers_page(){
                echo '<div class="wrap"><div id="icon-options-general" class="icon32"><br></div>
                <h2>FAQ</h2></div>';
}
function wpct_settings_page(){
	
	if(!empty($_REQUEST['twilio_sid']) && !empty($_REQUEST['twilio_token']))
		{
			$twilio_sid = $_REQUEST['twilio_sid'];
			$twilio_token = $_REQUEST['twilio_token'];

			update_option("twilio_sid", $twilio_sid );
			update_option("twilio_token", $twilio_token );
		}

$twilio_sid_option=get_option("twilio_sid");
$twilio_token_option=get_option("twilio_token");

?>      
	<form name="frm_rss" action="<?=get_option("siteurl")?>/wp-admin/admin.php?page=twilio"   method="post" enctype="multipart/form-data">
	<label for="twilio_sid">SID</label>
	<input type="text" name="twilio_sid" id="sid" size="65" value="<?=$twilio_sid_option?>"/>
	
	<label for="twilio_sid">Token</label>
	<input type="text" name="twilio_token" id="token" size="65" value="<?=$twilio_token_option?>"/>
	<input type="submit" value="SAVE" name="twilio_submit" />  
	</form>

<?php }

function wpct_post_types() {
  $labels = array(
    'name' => 'Calls',
    'singular_name' => 'Call',
    'add_new' => 'Add New Call',
    'add_new_item' => 'Add New Call',
    'edit_item' => 'Edit Call',
    'new_item' => 'New Call',
    'all_items' => 'All Calls',
    'view_item' => 'View Call',
    'search_items' => 'Search Calls',
    'not_found' =>  'No Calls found',
    'not_found_in_trash' => 'No Calls found in Trash', 
    'parent_item_colon' => '',
    'menu_name' => 'Calls'
  );

  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => false,
    'show_ui' => false, 
    'show_in_menu' => 'wpct-calls', 
    'query_var' => true,
    'rewrite' => array( 'slug' => 'Call' ),
    'capability_type' => 'post',
    'has_archive' => true, 
    'hierarchical' => false,
    'menu_position' => null,
    'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
  ); 

  register_post_type( 'Call', $args );
}
add_action( 'init', 'wpct_post_types' );

?>