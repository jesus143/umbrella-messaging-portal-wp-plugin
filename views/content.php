<?php    
    require ('config.php');  

    // print "this is the total session counter " . $_SESSION['counter_test'];
    // print "<pre>"; 
    // print "session play here..";
    // print_r($_SESSION['ump_tickets_with_latest_reply']); 
    // print "</pre>"; 
    // exit; 
    $_SESSION['tickets'] = ump_separate_to_tabs($_SESSION['ump_tickets_with_latest_reply']);  
    $tab = $_GET['tab'];  
    $page = $_GET['page']; 
    // print "<br>tab $tab page $page urrent user mail "  .$_SESSION['ump_current_user_email'] ;
    // print "tab " .    $tab ; 
    if($tab == 'Business Growth Executed') {  
        $tabAbbr='bge';
        $tickets = $_SESSION['tickets']['umbrella_growth_executive'];      
        // $tickets = ump_sort_ticket_by_unread_notification($tickets);  
    } else if ($tab == 'Umbrella Messages') {
        $tabAbbr='um';
        $tickets = $_SESSION['tickets']['umbrella_messages'];
        // $tickets = ump_sort_ticket_by_unread_notification($tickets);  
    }else if($tab == 'Umbrella Portners') {   
        // $tickets = '';
        $tabAbbr='up';
        print "<h1>Comming soon..</h1>";
        exit;
    }
 // print "<pre>"; 
    // print_r($_SESSION);
    // print_r($_SESSION['tickets']);
    // print_r( $tickets);
    // print "</pre>";

    $tickets = ump_get_notification_by_page($tickets, $_SESSION['ump_total_ticket_per_page'],  $page); 
   // if(count($tickets) < 0) {return 0; }
            // exit;
?>
<div class="bs-example" data-example-id="list-group-custom-content">
    <div class="list-group"> 
        <?php  
        print "<div style='display:none'><loaded>" . $_SESSION['ump_total_ticket_per_page']['loaded'] . "<loaded></div>";
          print "<div style='display:none'><totalTickets>" . count($tickets) . "<totalTickets></div>"; 
        for ($i=0; $i <count($tickets) ; $i++) :

                $notificationStatus  = 'unread';
                $ticketId            = $tickets[$i]['id'];
                $description         = $tickets[$i]['description'];
                $subject             = $tickets[$i]['subject'];
                // $latestReply         = Ump\UmpFd::getLatestReply(Ump\UmpFd::getUserTicketReplies($ticketId));
                $lastPersonCommented = $_SESSION['ump_current_user_name'];
                $latestReply         = $tickets[$i]['latestReply'];
                $notificationStatus  = ($tickets[$i]['is_read'] == 'yes') ? 'read' : 'unread'; 
                // detect if message is read, opened or unread
                // if(ump_is_read($latestReply, get_current_user_id(), $ticketId, ump_get_reply_id($latestReply)) == true) { $notificationStatus = 'read'; } 
            ?>
            <div>
                <notification>
                    <a href="?section=message-details&ticketId=<?php print $tickets[$i]['id']; ?>&replyId=<?php print ump_get_reply_id($latestReply); ?>&tab=<?php print $tabAbbr; ?>" class="list-group-item <?php print $notificationStatus; ?> ">

                        <span style='color:blue'> <?php print $lastPersonCommented; ?> </span> <br><br>

                        <h4 style="padding:0px;margin:0px;padding-bottom: 5px; " class="list-group-item-heading">
                            <?php  print $subject; ?>
                        </h4>

                        <p class="list-group-item-text">
                            <?php print $description; ?>
                        </p>

                        <hr>
                        <b><em> <?php print (ump_get_reply_user_name($latestReply))? "From: " . ump_get_reply_user_name($latestReply) : "No reply recieved yet"; ?></em></b>
                        <p><em> <?php print (ump_get_reply_user_name($latestReply))?  ump_get_reply_body($latestReply) : null; ?></em></p>
                    </a>
                </notification>
            </div>
        <?php endfor; ?>



    </div>
</div>