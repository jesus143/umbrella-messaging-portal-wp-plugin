<?php
error_reporting(1);
/*
Plugin Name: Umbrella Messaging portal
Plugin URI:
Description:  This plugin integrate with Freshdesck and OP 
Author: Jesus Erwin Suarez
Version: 1
Author URI: http://webuildyoursite.servebeer.com/
*/


/**
 * generate barcode
 */  
 // add_shortcode("mifoaf_page_index", "mifoaf_page_index_func");  

 // require "functions.php"; 
/*
 * Plugin Name: Messaging Integration for OP and FD
 * Version: 1.0
 * Plugin URI: http://www.hughlashbrooke.com/
 * Description: This plugin integrate with Freshdesck and OP 
 * Author: Jesus Erwin Suarez
 * Author URI: http://webuildyoursite.servebeer.com/
 * Requires at least: 4.0
 * Tested up to: 4.0
 *
 * Text Domain: wordpress-plugin-template
 * Domain Path: /lang/
 *
 * @package WordPress
 * @author Hugh Lashbrooke
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;



//$_SESSION['ump_current_user_email'] = 'enquiries@umbrellasupport.co.uk';

// Load plugin class files

require_once( ABSPATH . 'wp-includes/user.php' );
require_once( ABSPATH . 'wp-includes/pluggable.php' ); 
require_once( 'includes/wpdb_queries.class.php');
require_once( 'includes/class-ump-notification-db.php' );
require_once( 'includes/class-ump-fd.php' );
require_once( 'Model/UmpNotificationReading.php');
require_once( 'includes/helper.php' );
require_once( 'Model/Ump_User_Fd.php');
require_once( 'Controller/Ump_Ticket_Controller.php');




$_SESSION['ump_current_user_name']  = wp_get_current_user()->display_name;
$_SESSION['ump_current_user_email'] = wp_get_current_user()->user_email;
$_SESSION['ump_support_user_email'] = 'enquiries@umbrellasupport.co.uk';
$_SESSION['ump_total_ticket_per_page'] = 5;
// $_SESSION['ump_tickets_with_latest_reply'] = array(); 
 
// Load plugin libraries
 

/**
 * Returns the main instance of WordPress_Plugin_Template to prevent the need to use globals.
 *
 * @since  1.0.0
 * @return object WordPress_Plugin_Template
 */
add_shortcode("ump_messaging_dashboard", "ump_messaging_dashboard_func");  


 /**
  * install database table for this plugin
  */
register_activation_hook( __FILE__, 'ump_install_table');


/**
 * Admin menu
 */
add_action("admin_menu", "ump_admin_menu"); 

 
require "template.php";