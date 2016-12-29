<?php 
 session_start(); 
$ticketsSortedUnread = $_SESSION['ump_tickets_with_latest_reply']; 
print "<pre>";
	print_r( $_SESSION['ump_tickets_with_latest_reply'] );
print "</pre>"; 
 
$ticketSortedLatest = ump_get_strtotime_of_tickets(); 
// $ticketDatesFinal = []; 
// sort to latest ticket 
// print "total result" . ; 
	

print "<pre>";  
print "<br>before sort"; 
print_r( $ticketSortedLatest ); 
print "</pre>";
 
// sort the ticket via results of latest activity descending order
$finalTicketSortedWithLatestActivity = []; 
foreach ($ticketSortedLatest as $key => $ticketDateIndex) { 
	$finalTicketSortedWithLatestActivity[]  = $ticketsSortedUnread[$ticketDateIndex['index']]; 
}
 
print "<pre>"; 
print "<h3> Final Output</h3>"; 
print_r($finalTicketSortedWithLatestActivity); 
print "</pre>";


function ump_get_strtotime_of_tickets() { 
	$tickets = $_SESSION['ump_tickets_with_latest_reply'];  
	 // print "alright" . strtotime('2012-01-25') ;  
	 // get latest created ticket date or created ticket reply date with id 
	print "<pre>"; 
	$ticketDates = []; 
	$counter=0;
	foreach ($tickets as $index => $ticket) {  


		// print " <br> created at ticket " . $ticket['create_at']; 
		// print " <br> crated at reply " . $ticket['latestReply']['create_at']; 
		$latest_date = ''; 
		$created_ticket_date = '';// $ticket['created_at']; 
		$created_ticket_reply_date = ''; // (!empty($ticket['latestReply']['created_at'])) ? $ticket['latestReply']['created_at'] : null;   
		
		if(!empty($ticket['latestReply']['created_at']) || !empty($ticket['created_at'])) {		

			if(!empty($ticket['latestReply']['created_at'])) {
				$created_ticket_reply_date = ump_clean_date_time_freshdesk($ticket['latestReply']['created_at']); 
			} 
			$created_ticket_date = ump_clean_date_time_freshdesk($ticket['created_at']);   
		 	if($created_ticket_reply_date != null) {
		 		if($created_ticket_date > $created_ticket_reply_date)  {
		 			$latest_date = $created_ticket_date;   
		 		} else {
		 			$latest_date = $created_ticket_reply_date; 
		 		}
			} else {
				$latest_date = $created_ticket_date;   
			} 
			$ticketDates[$counter]['created_at'] = $latest_date; 
			// $ticketDates[$counter]['strtotime'] = strtotime($latest_date); 
			$ticketDates[$counter]['index'] = $index;  
			$counter++;
		}  
	}
	// get   
	// print_r($ticketDates);
	 // print_r($_SESSION['ump_tickets_with_latest_reply']);
	print "</pre>";  
	usort($ticketDates, function($a, $b) {
	    return $a['created_at'] < $b['created_at'];
	});
	return $ticketDates;
}
 
function ump_clean_date_time_freshdesk($dateTimeDirty) {
	$dateTimeDirty = str_replace('T', ' ', $dateTimeDirty); 
	$dateTimeClean = str_replace('Z', ' ', $dateTimeDirty); 
	return $dateTimeClean; 
}