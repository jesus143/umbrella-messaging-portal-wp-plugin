<?php   
require ('config.php'); 
$_SESSION['ump_tickets_with_latest_reply'] = ump_generate_freshdesk_data(10); 
print "<pre>"; 
print_r($_SESSION['ump_tickets_with_latest_reply']);
print "</pre>";    
