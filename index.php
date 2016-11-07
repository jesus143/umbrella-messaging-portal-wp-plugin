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

// Load plugin class files
require_once( 'includes/class-ump-notification-db.php' );
require_once( 'includes/class-ump-fd.php' );
require_once( 'includes/helper.php' );

// Load plugin libraries
 

/**
 * Returns the main instance of WordPress_Plugin_Template to prevent the need to use globals.
 *
 * @since  1.0.0
 * @return object WordPress_Plugin_Template
 */
add_shortcode("ump_messaging_dashboard", "ump_messaging_dashboard_func");  

require "template.php";