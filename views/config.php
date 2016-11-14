<?php 
    session_start();    
    // Turn off error reporting
    error_reporting(0); 
    // Report runtime errors
    error_reporting(E_ERROR | E_WARNING | E_PARSE); 
    // Report all errors
    error_reporting(E_ALL); 
    // Same as error_reporting(E_ALL);
    ini_set("error_reporting", E_ALL); 
    // Report all errors except E_NOTICE
    error_reporting(E_ALL & ~E_NOTICE); 
    require 'E:/xampp/htdocs/practice/wordpress/wp-load.php';  
    // print ABSPATH;
    // require 'E:/xampp/htdocs/practice/wordpress/wp-content/plugins/umbrella-messaging-portal/index.php';
    // require 'E:/xampp/htdocs/practice/wordpress/wp-content/plugins/umbrella-messaging-portal/includes/class-ump-fd.php'; 
    // print "tes";  