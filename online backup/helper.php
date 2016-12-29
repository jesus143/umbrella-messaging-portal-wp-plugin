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
			return  str_replace('"', '', $response['from_email']);
		} else if ($response['support_email'] != null) {
			return  str_replace('"', '', $response['support_email']);
		} else {
			return  str_replace('"', '', $_SESSION['ump_current_user_email']);
		}
	} else {
		return false;
	}

}
function ump_get_reply_body($response) {  
	$content = strip_tags($response['body']); 
	$string = '';

	if(strlen($content) > 0) {
		$string .= '<br>';
	}
	// line 1
	if(strlen($content) > 50){ 
		$string .= substr($content, 0, 50) . '...'; 
	} else {
		return $content;
	}   

	// line 2
	if(strlen($content) > 70){ 
		$string . "<br>.." . substr($content, 60, 70) . '...'; 
	} 

	return $string; 
 
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

/**
 * ump_is_read($latestReply, get_current_user_id(), $ticketId, ump_get_reply_id($latestReply)) == true) 
 */
function ump_is_read($response, $user_id, $ticket_id, $reply_id) {

	
     if(count($response) < 1) {    
     	$ump_query = new APP\WPDB_QUERIES(); 
	 	$umpNotificationReady  = new Ump\UmpNotificationReading(); 
		$reply_id = 0; 
			// check if ticket is read 
 		$res = $ump_query->wpdb_get_result("SELECT * FROM wp_ump_notification_reading where reply_id = $reply_id and ticket_id = $ticket_id and user_id = $user_id", ARRAY_A);   
			// if has a response then the ticket is read 
 		if(empty($res)) {  
 			// print "notification is unread reply_id = $reply_id and ticket_id = $ticket_id and user_id = $user_id"; 
 			$umpNotificationReady->insertEntry($user_id, $ticket_id, $reply_id); 
 			// execute insert new notification 
 			return false; 
 		}
 		// else no reponse then ticket is no read
 		else {
 			// print "<pre>"; 
 			// 	print_r($res); 
 			// print "</pre>"; 
 			// get status 
 			$status = $res[0]['status']; 
 			if($status == 'read') {
 				// print "return true because its read";
 				return true; 
 			} else {
 				// print "return false because its unread";
 				return false;
 			}
 			// print "notification is read";
 			// return false;
 		} 
 		// $reply_id = 0; 
 		// $ticket_id	= 1; 
 		// $user_id = 1; 

        // this ticket is new reply 
        // check database if its open already 
        // if opened then return true
        // else false
        // return false;  

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
	    // print "<br> is read " . $is_read; 
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
 

function ump_clean_date_time_freshdesk($dateTimeDirty) {
	$dateTimeDirty = str_replace('T', ' ', $dateTimeDirty); 
	$dateTimeClean = str_replace('Z', ' ', $dateTimeDirty); 
	return $dateTimeClean; 
}
function ump_get_sorted_date_and_index_ticket_descending($tickets) {  
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
function ump_sort_ticket_by_latest_activities($ticketsSortedUnread) {  

	// descending activity with date and index
	$ticketSortedLatest = ump_get_sorted_date_and_index_ticket_descending($ticketsSortedUnread);   

	// sort to latest activity
	$finalTicketSortedWithLatestActivity = []; 
	foreach ($ticketSortedLatest as $key => $ticketDateIndex) { 
		$finalTicketSortedWithLatestActivity[]  = $ticketsSortedUnread[$ticketDateIndex['index']]; 
	} 

	return $finalTicketSortedWithLatestActivity;
}
 
function ump_sort_ticket_by_unread_notification($tickets) {  

	$notifications = []; 


	// ump_pre_print_r($tickets);
	// start the filter and sort
	// print count($tickets);
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



	// avoid some error if other array is empty
	if(count($notifications_read) > 0 and count($notifications_unread) > 0) {
		$notifications = array_merge($notifications_unread, $notifications_read); 
	} else if (count($notifications_read) > 0) {
		$notifications = $notifications_read;
	} else {
		$notifications = $notifications_unread;
	} 
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
 
function ump_convert_time_human_readable($dateTime)
{
	return date("g:i a", strtotime($dateTime));
}

function ump_convert_date_time_human_readable($dateTime) {

	return date("D jS M Y", strtotime($dateTime));

}
function ump_get_date_time_formatted($dateTime) 
{
	// $date  = '2016-11-18T12:00:45Z';  
	$date = str_replace('Z', '', $dateTime); 
	$date = explode('T', $date); 
	$d = $date[0];
	$t = $date[1]; 
	// print "date $d time $t"; 
	return $d . ' ' . $t;
}

function getTicketStatusName($status)
{

	switch($status)
	{
		case 2:
			return '<span style="color:green;font-weight: bold;margin-right: 26px;font-size: 16px;">Open</span>';
			break;
		case 3:
			return '<span style="color:orange;font-weight: bold;margin-right: 26px;font-size: 16px;">Pending</span>';
			break;
		case 4:
			return '<span style="color:green;font-weight: bold;margin-right: 26px;font-size: 16px;">Resolved</span>';
			break;
		case 5:
			return '<span style="color:red;font-weight: bold;margin-right: 26px;font-size: 16px;">Closed</span>';
			break;
		default:
			return '';
			break;
	} 
}

function ump_process_reply_to_a_ticket()
{
	if(isset($_POST['umpReplyTicketSubmit']))
	{
		// Upload files to wp storage
		if ( ! function_exists( 'wp_handle_upload' ) ) {
		    require_once( ABSPATH . 'wp-admin/includes/file.php' );
		}
		for($i=0; $i<count($_FILES['file']); $i++) {  
			$uploadedfile['name']     = $_FILES['file']['name'][$i]; 
			$uploadedfile['type']     = $_FILES['file']['type'][$i]; 
			$uploadedfile['tmp_name'] = $_FILES['file']['tmp_name'][$i]; 
			$uploadedfile['error']    = $_FILES['file']['error'][$i]; 
			$uploadedfile['size']     = $_FILES['file']['size'][$i];      
	 		 // print_r($uploadedfile);  
			$upload_overrides = array( 'test_form' => false ); 
			$movefile = wp_handle_upload( $uploadedfile, $upload_overrides ); 
			if ( $movefile && ! isset( $movefile['error'] ) ) {
				// print "<pre>"; 
			    // echo "File is valid, and was successfully uploaded.\n";
			    // var_dump( $movefile );
			    // print "</pre>"; 
			    $attachments[] = $movefile['file']; 
			} else { 
				// print "<pre>"; 
			 //    echo " error = " . $movefile['error'];
			 //    print_r($movefile['error']);
			 //    print "</pre>";
			}
		}
		// end store file to wordpress 
			// print_r($_FILES['ump_repy_attachment']); 
		// print "</pre>";  
		// exit;    
		  // $attachments = array( WP_CONTENT_DIR . '/uploads/2016/11/Desert.jpg' );
		// print "<pre>";  
		// 	print_r($attachments);
		// print "</pre>"; 
		// exit;  
	    $to      = $_SESSION['ump_support_user_name'] . ' <' .  $_SESSION['ump_support_user_email'] . '>';
	    $subject = $_POST['umpReplySubject'];
	    $body    = $_POST['umpReplyMessage'];
	    $headers = array('Content-Type: text/html; charset=UTF-8','From: ' . $_SESSION['ump_current_user_name'] . ' <' .  $_SESSION['ump_current_user_email']  . '>');  

	    $_SESSION['ump_ticket_reply_previous_posted'] = $body; 

	    // print "<br>to $to  <br>subject $subject <br>body $body <br>header $header";
	    if(wp_mail( $to, $subject, $body, $headers, $attachments)) { 

	    	for($i=0; $i<count($attachments); $i++) { 
	    		$filePath = $attachments[$i];
		    	if(file_exists($filePath))
				{ 
					if(unlink( $filePath  )) { 
						// print "<br> successfully deleted " . $filePath; 
					} else {
						// print "<br> failed deleted " . $filePath; 
					}
				}	
			}  


			return true;
	        
	        //sleep to allow load new reply and display it
	    	// sleep(5);  
	    } else {
	    	return false;

	        // print "<span class='alert alert-danger' >Reply failed to post.</span>";
	    }


	} 
}  