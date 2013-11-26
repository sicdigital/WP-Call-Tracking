<?php
/* 
Plugin Name: WP Call Tracking
Plugin URI: http://www.sicdigital.com
Description: WP Call Tracking is the most advanced plugin available for  tracking phone calls genereated through your website. 
Author: Michael Chaocn
Version: 1.0 
Author URI: http://www.mikechacon.com
*/  

//Set Plugin Paths
define('WPCT_DIR', plugin_dir_url(__FILE__) );	
define( 'WPCT_PATH', plugin_dir_path(__FILE__) );

// set your AccountSid and AuthToken from www.twilio.com/user/account
$AccountSid = "AC9ca3f5e6b5058706c8dbecb07a25964d";
$AuthToken = "1733429de4c33df71c083ab9c5e088fa";

//Include Twilio
require(WPCT_PATH . '/library/twilio/Services/Twilio.php');
require(WPCT_PATH . '/settings/wpct-admin.php');

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