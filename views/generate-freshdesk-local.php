<?php   
require ('config.php'); 


// get all tickets online by specific user
$_SESSION['ump_tickets_with_latest_reply_fresh'] = ump_retrieve_freshdesk_data(100);  
 
// get all tickets 
$_SESSION['ump_tickets_with_latest_reply'] = ump_generate_freshdesk_data($_SESSION['ump_tickets_with_latest_reply_fresh']); 

// Get all the tickets with latest reply
$tickets = ump_separate_to_tabs($_SESSION['ump_tickets_with_latest_reply']);   
 
// calculate total notification for "BUSINESS GROWTH EXECUTIVE"
$_SESSION['ump_tickets_with_latest_reply']['total_notification']['bge'] = ump_get_total_notification_unread($tickets['umbrella_growth_executive']); 
// ump_pre_print_r($tickets); 
// calculate total notification for "UMBRELL MESSAGES" 
$_SESSION['ump_tickets_with_latest_reply']['total_notification']['um']   = ump_get_total_notification_unread($tickets['umbrella_messages']);   

// calculate total notification for "UMBRELLA PARTNER"
$_SESSION['ump_tickets_with_latest_reply']['total_notification']['up']   = ump_get_total_notification_unread($tickets['umbrella_partners']); 
 
// get pagination for BET
$_SESSION['ump_tickets_with_latest_reply']['total_pagination']['bge'] = ump_count_total_tickets_for_pagination($tickets['umbrella_growth_executive'], $_SESSION['ump_total_ticket_per_page']); 
// get pagination for UM
$_SESSION['ump_tickets_with_latest_reply']['total_pagination']['um'] = ump_count_total_tickets_for_pagination($tickets['umbrella_messages'], $_SESSION['ump_total_ticket_per_page']); 
// get pagination for UP
$_SESSION['ump_tickets_with_latest_reply']['total_pagination']['up'] = ump_count_total_tickets_for_pagination($tickets['umbrella_partners'], $_SESSION['ump_total_ticket_per_page']);  

// print "<pre>"; 
// 	print_r($_SESSION['ump_tickets_with_latest_reply']);  
// print "</pre>"; 
  

$_SESSION['ump_tickets_with_latest_reply_fresh']['loading_session_status'] = 'loaded-session'; 


ump_pre_print_r($_SESSION['ump_tickets_with_latest_reply']); 