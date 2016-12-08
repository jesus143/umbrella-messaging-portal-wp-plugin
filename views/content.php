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
        print "<br><br> <b><span>Comming soon..</span></b>";
        exit;
    }  
    $tickets = ump_get_notification_by_page($tickets, $_SESSION['ump_total_ticket_per_page'],  $page);  
?>
 <link href="http://netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet"> 
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
 <!-- <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">  -->
    <!-- <script type="text/javascript" src="//code.jquery.com/jquery-1.10.2.min.js"></script> -->
    <!-- <script type="text/javascript" src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>   -->
  
<div class="bs-example" data-example-id="list-group-custom-content">
    <div class="list-group"> 
        <?php   
        print "<span style='display:none'>" . $_SESSION['ump_tickets_with_latest_reply_fresh']['loading_session_status'] . '</span>';
        print "<div style='display:none'><totalTickets>" . count($tickets) . "<totalTickets></div>";  
        for ($i=0; $i <count($tickets) ; $i++) :

                // print " status number " . $tickets[$i]['status'];
                // print "<pre>";
                // print_r($tickets[$i]);
                // print "</pre>"; 
                // exit; 
                $createdAt           = $tickets[$i]['created_at']; 
                $status              = getTicketStatusName($tickets[$i]['status']);
                $notificationStatus  = 'unread'; 
                $ticketId            = $tickets[$i]['id'];
                $description         = $tickets[$i]['description'];
                $subject             = $tickets[$i]['subject']; 
                $lastPersonCommented = $_SESSION['ump_current_user_name'];
                $latestReply         = $tickets[$i]['latestReply'];
                $notificationStatus  = ($tickets[$i]['is_read'] == 'yes') ? 'read' : 'unread';   
                $replyCreatedAt      = $tickets[$i]['latestReply']['created_at']; 
                $ticketCreatedAt     = $tickets[$i]['created_at'];   
                $attachments         = $tickets[$i]['latestReply']['attachments'];
                $attachmentsTotal    = count($attachments);   
                // print  $replyCreatedAt; 
                ?> 
            
            <!-- start clickable notification -->
            <a style='background-color:white;'  class="list-group-item <?php print $notificationStatus; ?>" href="?section=message-details&ticketId=<?php print $tickets[$i]['id']; ?>&replyId=<?php print ump_get_reply_id($latestReply); ?>&tab=<?php print $tabAbbr; ?>" class="list-group-item <?php print $notificationStatus; ?> ">

            <!-- Status -->
            <span class="pull-right" style="font-size:12px"> 
                 <?php print  $status; ?> 
            </span>
               

                <!-- print paper click if the latest reply has files -->
                <div class="pull-right" style="margin-right: 5px;">
                    <?php  
                        if( $attachmentsTotal  > 0) { 
                            for($j=0; $j<$attachmentsTotal; $j++):
                                $fileUrl = $attachments[$i]['attachment_url'];
                                $fileName = $attachments[$i]['name']; 
                                 print " <span class='glyphicon glyphicon-paperclip'></span> ";      
                            endfor; 
                        } 
                    ?>   
                </div>
                <!-- Set if envelop if open or not -->
                <?php
                    if($notificationStatus == 'read') {
                        $envelopSrc =  site_url() . '/wp-content/plugins/umbrella-messaging-portal/assets/img/icon/open-message.png';
                        $envelopStyle = 'height: 20px;margin-right: 10px;margin-top: 6px;';
                    } else {
                        $envelopSrc = site_url() . '/wp-content/plugins/umbrella-messaging-portal/assets/img/icon/unread-message.png';
                        $envelopStyle = 'height: 15px;margin-right: 10px;margin-top: 7px;';
                    }
                ?>
                 <img style="<?php print $envelopStyle; ?>" class="pull-left" src="<?php print $envelopSrc; ?>" alt="envelop" />
                    <!-- ticket subject -->
                    <?php if($notificationStatus == 'unread') { print '<b>'; } ?> 
                        <div style="margin-top: 5px;" > <span  ><?php print $subject; ?></span> </div>
                    <?php if($notificationStatus == 'unread') { print '</b>'; } ?>


                <!-- replied details -->
                    <div style="padding-left:30px;">
                        <span class="text-muted" style="font-size: 11px;">    
                            <!-- replied info  -->
                            <?php if($notificationStatus == 'unread') { print '<b>'; } ?>
                                <?php print (ump_get_reply_user_name($latestReply))? "From " . strip_tags(ump_get_reply_user_name($latestReply)) : "No reply recieved yet"; ?>
                            <?php if($notificationStatus == 'unread') { print '</b>'; } ?>
                            <!-- Comment reply -->
                       
                            <?php print (ump_get_reply_user_name($latestReply))?  ump_get_reply_body($latestReply)  : null; ?>
                             <br>  
                            <span style="font-size:11px; color:grey">
                                <?php print ump_convert_time_human_readable(ump_get_date_time_formatted($createdAt)); ?>  
                                <?php print ump_convert_date_time_human_readable(ump_get_date_time_formatted($replyCreatedAt)); ?> 
                            </span>
                        </span> 
                    </div>

                    
                <!-- Display replied date --> 

                <div class="pull-right" style="margin-top: -30px;font-size:11px;">
                    <?php print  '<center>' . ump_convert_time_human_readable(ump_get_date_time_formatted($createdAt)) . '</center>'; ?> 
                    <?php print  ump_convert_date_time_human_readable(ump_get_date_time_formatted($createdAt)); ?>
                </div>


                <!-- end clickable link to ticket details -->
            </a>     
            <!-- end for loop -->
        <?php endfor; ?>  
    </div>
</div>