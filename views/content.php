<?php    
    require ('config.php');   
    $_SESSION['tickets'] = ump_separate_to_tabs($_SESSION['ump_tickets_with_latest_reply']);  
    $tab = $_GET['tab'];  
    $page = $_GET['page'];  
    if($tab == 'Business Growth Executed') {  
        $tabAbbr='bge';
        $tickets = $_SESSION['tickets']['umbrella_growth_executive'];       
    } else if ($tab == 'Umbrella Messages') {
        $tabAbbr='um';
        $tickets = $_SESSION['tickets']['umbrella_messages']; 
    }else if($tab == 'Umbrella Portners') {    
        $tabAbbr='up';
        print "<h1>Comming soon..</h1>";
        exit;
    }  
    $tickets = ump_get_notification_by_page($tickets, $_SESSION['ump_total_ticket_per_page'],  $page);  
?>
<div class="bs-example" data-example-id="list-group-custom-content">
    <div class="list-group"> 
        <?php   
        print "<span style='display:none'>" . $_SESSION['ump_tickets_with_latest_reply_fresh']['loading_session_status'] . '</span>';
        print "<div style='display:none'><totalTickets>" . count($tickets) . "<totalTickets></div>";  
        for ($i=0; $i <count($tickets) ; $i++) : 
                $notificationStatus  = 'unread';
                $ticketId            = $tickets[$i]['id'];
                $description         = $tickets[$i]['description'];
                $subject             = $tickets[$i]['subject']; 
                $lastPersonCommented = $_SESSION['ump_current_user_name'];
                $latestReply         = $tickets[$i]['latestReply'];
                $notificationStatus  = ($tickets[$i]['is_read'] == 'yes') ? 'read' : 'unread';  
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