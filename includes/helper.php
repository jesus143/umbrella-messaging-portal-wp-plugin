<?php 
// create helper function for page getter  
function ump_get_current_page(){
	$http_host = explode('/',$_SERVER['REQUEST_URI']);   
	return $http_host[4];
} 
function ump_get_start_start() {
	//
	return 0;
} 
function ump_get_end_limit() {
	// 
	return 5;
}
function ump_separate_to_tabs($tickes) { 
	
	$results['umbrella_partners'] = array();
	$results['umbrella_messages'] = array();
	$results['umbrella_growth_executive'] = array();

	for ($i=0; $i <count($tickes) ; $i++) {  
		if($tickes[$i]['custom_fields']['catergory'] == 'Business Growth Executive' || $tickes[$i]['custom_fields']['catergory'] == '') {
			$results['umbrella_growth_executive'][] = $tickes[$i];
		} else {
			$results['umbrella_messages'][] = $tickes[$i];
		}
	} 
	return $results;
}
function ump_post_reply() {
	// if(ump_is_agent()) {
	// 	if (isset($_POST['body']) and isset($_POST['ticketId'])) {
	// 		$body = $_POST['body'];
	// 		$ticketId = $_POST['ticketId'];
	// 		return Ump\UmpFd::replyTicket($ticketId, array('body' => $body));
	// 	}
	// } else {
	$to = $_POST['umpTo'];
	$subject = $_POST['subject'];
	$body = $_POST['body'];
	$headers = array('Content-Type: text/html; charset=UTF-8');
	$headers = 'From: Jesus Erwin Suarez <' . $_SESSION['ump_current_user_email'] . '>' . "\r\n";

	print "<br> message email ---> to: $to <Br> subject: $subject <Br>body: $body <Br>header: $headers <Br> current loggedin email: " . $_SESSION['ump_current_user_email'];

  

	if(wp_mail( $to, $subject, $body, $headers )){

		return true;
	} else {
		return false;
	}
	// }
}
function ump_is_agent() {
	return Ump\UmpFd::getAgentInfoByEmail($_SESSION['ump_current_user_email']);
}
function ump_get_ticket_status($status) {

	$statusArray = array(
		2 => 'Open',
		3 => 'Pending',
		4 => 'Resolved',
		5 => 'Closed'
	);
	return $statusArray[$status];
}
function ump_get_ticket_priority($priority){
	$priorityArray = array(
		1=>'Low',
		2=>'Medium',
		3=>'High',
		4=>'Urgent'
	);

	return $priorityArray[$priority];
}
function ump_get_ticket_source($source){
	$sourceArray = array(
		1=>'Email',
		2=>'Portal',
		3=>'Phone',
		7=>'Chat',
		8=>'Mobihelp',
		9=>'Feedback Widget',
		10=>'Outbound Email'
	);
	return $sourceArray[$source];
}
function ump_get_reply_user_name($response) {
	if(count($response) > 0) {
		if ($response['from_email'] != null) {
			return $response['from_email'];
		} else if ($response['support_email'] != null) {
			return $response['support_email'];
		} else {
			return $_SESSION['ump_current_user_email'];
		}
	} else {
		return false;
	}

}
function ump_get_reply_body($response) {
	return $response['body'];
}
function ump_get_reply_id($response){
	return $response['id'];
}
function ump_is_replied($response) {
	if(ump_get_reply_user_name($response) != $_SESSION['ump_current_user_email']) {
		return true;
	} else {
		return false;
	}
}
function ump_is_clicked() {
	//
}
function ump_is_read($response, $user_id, $ticket_id, $reply_id) {

     if(count($response) < 1) {
            // check if new reply
            return true;

     } else if(ump_is_replied($response)) {

        if(ump_process_and_get_notification_status($user_id, $ticket_id, $reply_id) == 'read') {
            return true;
        } else {
            return false;
        }


	} else {
		return true;

	}
}
// database
function ump_process_and_get_notification_status($user_id, $ticket_id, $reply_id)
{
	$umpNotificationReading = new Ump\UmpNotificationReading();
	return $umpNotificationReading->processNotificationData($user_id, $ticket_id, $reply_id);
}
function ump_process_update_status_to_read($user_id, $ticket_id, $reply_id)
{
	$umpNotificationReading = new Ump\UmpNotificationReading();
	return $umpNotificationReading->updateStatusToRead($user_id, $ticket_id, $reply_id);
}
function ump_console_js($string) {
	?>
		<script type="text/javascript">
			var str = '<?php print $string; ?>'; 
			console.log(str); 
		</script>
	<?php 
}
function ump_get_email_message_receiver() {
    if($_SESSION['ump_support_user_email']  == wp_get_current_user()->user_email) {
        return $_SESSION['ump_current_user_email'];
    } else {
        return $_SESSION['ump_support_user_email'];
    }
} 

function ump_get_total_notification_unread($tickets) { 
	$total_unread = 0; 
	// start the filter and sort
	for ($i=0; $i <count($tickets) ; $i++) :    
	    $ticketId            		= $tickets[$i]['id']; 
	    $latestReply         		= $tickets[$i]['latestReply'];   
	    $is_read 				    = $tickets[$i]['is_read'];  
	    print "<br> is read " . $is_read; 
	    if($is_read == 'no') {
	    	$total_unread++;
	    }   
	endfor;     
    return  $total_unread;
}


function ump_get_ticket_total_by_unread($tickets) {  

	$total_unread = 0;

	// start the filter and sort
	for ($i=0; $i <count($tickets) ; $i++) :    
	    $ticketId            		= $tickets[$i]['id']; 
	    $latestReply         		= Ump\UmpFd::getLatestReply(Ump\UmpFd::getUserTicketReplies($ticketId)); 
	    $tickets[$i]['latestReply'] =  $latestReply;   

	    // detect if message is read, opened or unread
	    if(ump_is_read($latestReply, get_current_user_id(), $ticketId, ump_get_reply_id($latestReply)) == false) {  
	    	$total_unread++;
	    }    

	endfor;     
    return  $total_unread;
}
function ump_get_ticket_replies($ticketId) { 
	return Ump\UmpFd::getUserTicketReplies($ticketId);
}
function ump_sort_ticket_by_unread_notification($tickets) {  

	$notifications = []; 

	// start the filter and sort
	for ($i=0; $i <count($tickets) ; $i++) :   

		$notificationStatus  		= 'unread';
	    $ticketId            		= $tickets[$i]['id'];
	    $description         		= $tickets[$i]['description'];
	    $subject             		= $tickets[$i]['subject'];
	    $latestReply         		= Ump\UmpFd::getLatestReply(ump_get_ticket_replies($ticketId));
	    $lastPersonCommented 	    = $_SESSION['ump_current_user_name'];  
	    $tickets[$i]['latestReply'] =  $latestReply;  

	    // detect if message is read, opened or unread
	    if(ump_is_read($latestReply, get_current_user_id(), $ticketId, ump_get_reply_id($latestReply)) == true) { 
	    	// get all the ticket not opened and replied by the support
	    	$tickets[$i]['is_read'] = 'yes';
			$notifications_read[] = $tickets[$i]; 
	    } else {
	    	// get all the ticket that is already replied by ticket requester and or replied by support and viewed by the ticket requester
	    	$tickets[$i]['is_read'] = 'no';
	    	$notifications_unread[] = $tickets[$i]; 
	    }   
	endfor;   
	$notifications = array_merge($notifications_unread, $notifications_read); 
	 return $notifications; 
}  
/**
*  page 1 
*  limit 5 
* in page 1 = 0,5
* in page 2 = 5,9
* in page 3 = 10,4
*/  
function ump_get_notification_by_page($tickets, $limit=5, $page=1) {    
 
	  
	  	// set page query 
	  	$notifications = [];
		$page = $page - 1;   
		$counter = $page * $limit;    

		// start the filter
		for ($i=0; $i <$limit ; $i++) {   
			if(!empty($tickets[$counter])) { 
				$notifications[] = $tickets[$counter];
				$counter++;	
			}
		} 

		// return the filter results
		return $notifications; 
}

function ump_count_total_tickets_for_pagination($tickets, $limit=5) {  

	// count total tickets
	$totalTickets = count($tickets);  

	// start the filter
	$page=0;
 	for ($i=0; $i <$totalTickets ; $i++) {  
 		if($i % $limit == 0) {
 			$page++;
 		}
 	}
	 
	// return the total pages
	return $page;
}

function ump_get_total_unread_notification_tickets($tickets) {
	//   
}
 

function ump_retrieve_freshdesk_data($limit=10) {
	return Ump\UmpFd::fetchTickets('email', $_SESSION['ump_current_user_email'], $limit); 
}

function ump_generate_freshdesk_data($tickets) {  
 	$ticketsWithLatestComments = ump_sort_ticket_by_unread_notification($tickets);  
 	return $ticketsWithLatestComments;
}

function ump_pre_print_r($data) {
	print "<pre>"; 
	print_r($data);
	print "</pre>";  
	exit;  
}

/**
 * Set upen ticket
 * @param  [type] $ticketId [description]
 * @return [type]           [description]
 */
function ump_ticket_notification_visited($ticketId, $tab) {  
 
	

	 

	$tickets = $_SESSION['ump_tickets_with_latest_reply']; 
	$counter=0;
	foreach ($tickets as $ticket) {
		if($ticket['id'] == $ticketId){
			
	 		if($_SESSION['ump_tickets_with_latest_reply'][$counter]['is_read'] == 'no') { 
				// decrement notification 
				if($tab == 'bge') {
					$_SESSION['ump_tickets_with_latest_reply']['total_notification']['bge']--;
				} else if ($tab == 'um') {
					$_SESSION['ump_tickets_with_latest_reply']['total_notification']['um']--;
				} else if ($tab == 'up') {
					$_SESSION['ump_tickets_with_latest_reply']['total_notification']['up']--;
				}	
				$_SESSION['ump_tickets_with_latest_reply'][$counter]['is_read'] = 'yes'; 
			} 
		}
		$counter++;
	}  
}
function ump_get_site_full_url() {
	$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	return $actual_link;
} 
// function ump_is_localhost() {  
//     $whitelist = array( '127.0.0.1', '::1' );
//     if( in_array( $_SERVER['REMOTE_ADDR'], $whitelist) ) { 
//         return true;
//     } 
// }