<?php  
    // print "notification temporary disabled";
    // exit;
    require ('config.php');     
	
    $tab = $_GET['tab'];     

 




    if($tab == 'Business Growth Executed') {  
    	// $_SESSION['tickets'] = ump_separate_to_tabs($_SESSION['ump_tickets_with_latest_reply']);  
        // $tickets = $_SESSION['tickets']['umbrella_growth_executive'];      
        $total_unread = $_SESSION['ump_tickets_with_latest_reply']['total_notification']['bge'];
        $content_id = '#ump-content-bge'; 
    } else if ($tab == 'Umbrella Messages') {
    	//$_SESSION['tickets'] = ump_separate_to_tabs($_SESSION['ump_tickets_with_latest_reply']);  
         $total_unread = $_SESSION['ump_tickets_with_latest_reply']['total_notification']['um'];
        $tickets = $_SESSION['tickets']['umbrella_messages'];
        $content_id = '#ump-content-um';
        // $tickets = ump_sort_ticket_by_unread_notification($tickets);  
    }else if($tab == 'Umbrella Portners') {   
        // $tickets = '';
        // print "<h1>Pagination Comming soon..</h1>";
        //$tickets = $_SESSION['tickets']['umbrella_partners'];
         $total_unread = $_SESSION['ump_tickets_with_latest_reply']['total_notification']['up'];
        $content_id = '#ump-footer-um';
        exit;
    }  
    // $total_unread = ump_get_ticket_total_by_unread($tickets); 
      
    print "<span class='badge'>$total_unread</span> ";