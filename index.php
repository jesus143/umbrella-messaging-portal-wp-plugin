<?php 
error_reporting(1);
/*
Plugin Name: Umbrella Messaging portal
Plugin URI:
Description:  This plugin will work with realtime notification  and messages with freshdesk and with the help of IMAP
Author: Jesus Erwin Suarez
Version: 1
Author URI: http://webuildyoursite.servebeer.com/
*/
 
 
if ( ! defined( 'ABSPATH' ) ) exit;
 
// load files
require_once( ABSPATH . 'wp-includes/user.php' );
require_once( ABSPATH . 'wp-includes/pluggable.php' ); 
require_once( ABSPATH . 'wp-includes/link-template.php' ); 
require_once( ABSPATH . 'wp-includes/formatting.php' );
require_once( ABSPATH . 'wp-includes/link-template.php' );
require_once( ABSPATH . 'wp-includes/wp-db.php' );




if ( is_user_logged_in() ) {

    require_once('includes/wpdb_queries.class.php');
    require_once('includes/class-ump-notification-db.php');
    require_once('includes/class-ump-fd.php');
    require_once('Model/UmpNotificationReading.php');
    require_once('includes/helper.php');
    require_once('Model/Ump_User_Fd.php');
    require_once('Controller/Ump_Ticket_Controller.php');


    $_SESSION['ump_current_user_name'] = wp_get_current_user()->display_name;
    $_SESSION['ump_current_user_email'] = wp_get_current_user()->user_email;
    $_SESSION['ump_support_user_email'] = 'support@umbrellasupport.freshdesk.com';
    $_SESSION['ump_support_user_name'] = 'Umbrella Business Support Ltd'; 
    $_SESSION['ump_total_ticket_per_page'] =10;
    $_SESSION['ump_agent_profile_pic_url_src'] = get_option ( 'ump_agent_profile_pic_url_src' );
    $_SESSION['ump_customer_profile_pic_url_src'] =   get_avatar_url( wp_get_current_user()->user_email );
    // $_SESSION['ump_tickets_with_latest_reply'] = array();
    // Load plugin libraries

    /**
     * Returns the main instance of WordPress_Plugin_Template to prevent the need to use globals.
     *
     * @since  1.0.0
     * @return object WordPress_Plugin_Template
     */
    add_shortcode("ump_messaging_dashboard", "ump_messaging_dashboard_func");
    add_shortcode("ump_comment_details_embedded", "ump_comment_details_embedded_func");
    add_shortcode("ump_comment_details_embedded_debugging", "ump_comment_details_embedded_debugging_func");
    add_shortcode("ump_comment_details_ticket_post_reply", "ump_comment_details_ticket_post_reply_func");
    add_shortcode("ump_comment_message_settings", "ump_comment_message_settings_func");


    /**
     * install database table for this plugin
     */
    register_activation_hook(__FILE__, 'ump_install_table');


    /**
     * Admin menu
     */
    add_action("admin_menu", "ump_admin_menu");
    // print "<br><br><br>";
    //  print site_url();
    require "template.php";


//    print "<br><br>";
//    Umbrella Business Support Ltd <support@umbrellasupport.freshdesk.com>
//    $to = 'Umbrella Business Support Ltd <support@umbrellasupport.freshdesk.com>';
//    $subject = '[#114] Re: Ticket Received - ticket test reply via email now';
//    $body = 'The email body content 5 <a href="https://help.umbrellasupport.co.uk/helpdesk/tickets/114" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=en&amp;q=https://help.umbrellasupport.co.uk/helpdesk/tickets/114&amp;source=gmail&amp;ust=1480433511082000&amp;usg=AFQjCNHQo5eRuanMITEGQf3pgR6-aouVbw">https://help.umbrellasupport.<wbr>co.uk/helpdesk/tickets/114</a>';
//    $headers = array('Content-Type: text/html; charset=UTF-8','From: Jesus Erwin Suarez1 <mrjesuserwinsuarez@gmail.com');
//
//    if(wp_mail( $to, $subject, $body, $headers )) {
//      print "email successfully sent 1";
//    } else {
//        print "email failed to sent 1";
//    }

//ticket test reply via email now #114 #124
//ticket test reply via email now #114
}

