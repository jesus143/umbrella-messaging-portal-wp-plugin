<?php
// register session
session_start();

// call file imap main function
require_once ('imap_main_functions.php');  

// call namespace of the class
use App\UMP_IMAP; 

// initialized data
// $email = 'jellyandicecream@umbrellapartner.co.uk';
$email = $_SESSION['ump_current_user_email'];


// initialized email, this is the current authenticated email
// $ump_imap = new UMP_IMAP('jellyandicecream@umbrellapartner.co.uk'); 
$ump_imap = new UMP_IMAP($email);  

// get total email received
$mailTotalEmail = $ump_imap->getMailTotalEmail();  

 // check for new incoming email
 // we can check via total email received comparison to the old and new email 
if($_SESSION['mailTotalEmailPrevRte'] != $mailTotalEmail) {  
	$_SESSION['mailTotalEmailPrevRte'] = $mailTotalEmail; 
	$message = "There is new incoming email for <b>$email</b> and need for freshdesk data refreshed.";    
} else {
	$message = "No new incoming email for <b>$email</b> and no need for freshdesk data refreshed.";   
} 

// print message 
// Js will look for this message and can identify if there is new message or no.
print $message . ' Current total email ' . $mailTotalEmail; 
