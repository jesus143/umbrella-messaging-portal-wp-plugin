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
 * add short code a page
 * [ump_messaging_dashboard]
 */



if ( ! defined( 'ABSPATH' ) ) exit;
 
// load files
require_once( ABSPATH . 'wp-includes/user.php' );
require_once( ABSPATH . 'wp-includes/pluggable.php' ); 
require_once( ABSPATH . 'wp-includes/link-template.php' ); 
require_once( ABSPATH . 'wp-includes/formatting.php' );


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
    $_SESSION['ump_total_ticket_per_page'] =10;
    $_SESSION['ump_agent_profile_pic_url_src'] = 'https://s3.amazonaws.com/cdn.freshdesk.com/data/helpdesk/attachments/production/19001090412/medium/Tough%20Mudder%20Headshot.jpg?X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=AKIAJ2JSYZ7O3I4JO6DA%2F20161125%2Fus-east-1%2Fs3%2Faws4_request&X-Amz-Date=20161125T121520Z&X-Amz-Expires=604800&X-Amz-Signature=69fb6a5322ddfb8ad7b72acde88b1c785957a61d924e8d86de116317b06dbcee&X-Amz-SignedHeaders=Host';
    $_SESSION['ump_customer_profile_pic_url_src'] = 'http://www.keita-gaming.com/assets/profile/default-avatar-c5d8ec086224cb6fc4e395f4ba3018c2.jpg';
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

