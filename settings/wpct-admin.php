<?php
/**
 * All Admin settings for WordPress Call Tracking
 *
 * This file is used by wp-call-tracking.php to create the admin settings and pages.
 *
 * @package WPCT
 * @since 1.0
 *
 */

//Include Admin Styles
add_action( 'admin_enqueue_scripts', 'wpct_scripts' );	

function wpct_scripts() {
	wp_enqueue_style( 'admin-styles', WPCT_DIR . '/interface/wpct-styles.css' );
}

//Add Menu Pages
add_action('admin_menu', 'wpct_menu_page');
function wpct_menu_page() {	
  //Adds Calls Main Menu Page
  add_menu_page('WPCT Settings', 'Calls', 'manage_options', 'wpct', '', WPCT_DIR . '/interface/images/phone-icon.png');
  //Reporting
  add_submenu_page( 'wpct', 'Dashboard', 'Dashoard', 'manage_options', 'wpct', 'wpct_dashboard');
  //Numbers
  add_submenu_page( 'wpct', 'Numbers', 'Phone Numbers', 'manage_options', 'wpct-numbers', 'wpct_numbers_page');
  //Import/Export
  add_submenu_page( 'wpct', 'Import/Export', 'Import/Export', 'manage_options', 'wpct-import-export', 'wpct_io_page');
  //Settings
  add_submenu_page( 'wpct', 'Settings page title', 'Settings', 'manage_options', 'wpct-settings', 'wpct_settings_page');
  //Help
  add_submenu_page( 'wpct', 'Help', 'Help', 'manage_options', 'wpct-help', 'wpct_help_page');
  
}

function wpct_dashboard(){
	
	GLOBAL $AccountSid, $AuthToken;
	
	echo '<div class="wrap"><h2>Dashboard</h2></div>';

	$client = new Services_Twilio($AccountSid, $AuthToken);
	 
	// Loop over the list of calls and echo a property for each one
	foreach ($client->account->calls as $call) {
	    //https://www.twilio.com/docs/api/rest/call#list-get
	    
	    //date
	    echo $call->date_created . '<br  />';
		//date
	    echo $call->from. '<br  />';
	    //date
	    echo $call->status . '<br  />';
	    //date
	    echo $call->duration . '<br  />';
	    //date
	    echo $call->direction . '<br  />';
	    //date
	    echo $call->caller_name . '<br  />';
	    
	    //call recording
	    
	}//foreach

}//wpct_dashboard

function wpct_numbers_page(){
    echo '<div class="wrap">
            <h2>Manage Numbers</h2>
        </div>';
}

function wpct_help_page(){
                echo '<div class="wrap">
                <h2>Help</h2>
                </div>';
}

function wpct_io_page(){
                echo '<div class="wrap">
                <h2>Import/Export</h2>
                </div>';
}

// class wpctSettings(){

// }//wpctSettings

function wpct_settings_page(){
	
	if(!empty($_REQUEST['twilio_sid']) && !empty($_REQUEST['twilio_token']))
		{
			$twilio_sid = $_REQUEST['twilio_sid'];
			$twilio_token = $_REQUEST['twilio_token'];

			update_option("twilio_sid", $twilio_sid );
			update_option("twilio_token", $twilio_token );
		}

		$twilio_sid_option = get_option("twilio_sid");
		$twilio_token_option = get_option("twilio_token");

	echo '<div class="wrap">
		<h2>Settings</h2>';
?>      
	<form name="frm_rss" action="<?=get_option("siteurl")?>/wp-admin/admin.php?page=twilio"   method="post" enctype="multipart/form-data">
	<label for="twilio_sid">SID</label>
	<input type="text" name="twilio_sid" id="sid" size="65" value="<?php echo $twilio_sid_option?>"/>
	
	<label for="twilio_sid">Token</label>
	<input type="text" name="twilio_token" id="token" size="65" value="<?=$twilio_token_option?>"/>
	<input type="submit" value="SAVE" name="twilio_submit" />  
	</form>

<?php echo '</div>'; }