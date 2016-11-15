<?php   
require ('config.php'); 
 
// $_SESSION['counter_test']++;
 
// get all tickets online by specific user
$_SESSION['ump_tickets_with_latest_reply_fresh'] = ump_retrieve_freshdesk_data(100);  

// get all tickets 
$_SESSION['ump_tickets_with_latest_reply'] = ump_generate_freshdesk_data($_SESSION['ump_tickets_with_latest_reply_fresh']); 

print "<pre>"; 
print_r($_SESSION['ump_tickets_with_latest_reply']);
print "</pre>";    
