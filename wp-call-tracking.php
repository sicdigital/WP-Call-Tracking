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
