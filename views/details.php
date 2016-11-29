<?php
session_start(); 
$_SESSION['ticketsContent'] = $_SESSION['tickets']['umbrella_growth_executive']; 
ump_process_update_status_to_read(get_current_user_id(), $_GET['ticketId'], $_GET['replyId']); 
$ticketId           = $_GET['ticketId'];
$ticketReplies      =  Ump\UmpFd::getUserTicketReplies( $_GET['ticketId'] );
$ticket             =  Ump\UmpFd::getSpecificTicket(  $_GET['ticketId'] );
$currentUserEmail   =  $_SESSION['ump_current_user_email'];
$ticketDescription  =  strip_tags($ticket['description']);
$ticketSubject      =  $ticket['subject'];
$ticketCreatedAt    =  $ticket['created_at'];
$ticketStatus       =  $ticket['status'];
$ticketPriority     =  $ticket['priority'];
$ticketSource       =  $ticket['source'];
$ticketId           =  $_GET['ticketId'];
$ticketOwnerName    =  $_SESSION['ump_current_user_name'];
$ticketSubjectC     = '#' . $ticketId . ' ' . $ticketSubject;
$dateTimeCreatedAt  = ump_convert_date_time_human_readable(ump_get_date_time_formatted($ticket['created_at']));  
// get attachments
// 





if(!empty($_POST['umpReplyMessage'])) {
    print "<div class='alert alert-success'> successfully posted response! </div>";
} 
ump_ticket_notification_visited($ticketId, $_GET['tab']); 
?>  
    <link rel="stylesheet" href="<?php print site_url(); ?>/wp-content/plugins/umbrella-messaging-portal/designer/reply-design.css">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet"> 
    <script type="text/javascript" src="//code.jquery.com/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script> 
     


    <br><br>
      <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <a href="?section=message-notification">
                <button class="btn btn-default"> Back </button> <br><br>
            </a>
            <section class="comment-list">     
                <ticket>
                    <div class="row"> 
                        <div class="col-md-2">  
                        </div>
                        <div class="col-md-8"> 
                          <h4 class="ump-ticket-subject"> <?php print $ticketSubjectC; ?></h4> 
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col-md-2 col-sm-2 hidden-xs"> 
                          <div class="thumbnail"> 
                            <img class="img-responsive" src="http://www.keita-gaming.com/assets/profile/default-avatar-c5d8ec086224cb6fc4e395f4ba3018c2.jpg"> 
                          </div>
                        </div> 
                        <div class="col-md-10 col-sm-10">
                          <div class="panel panel-default arrow left" >
                            <div class="panel-body">
                              <header class="text-left">
                                <div class="comment-user"><i class="fa fa-user"></i> <?php print $ticketOwnerName; ?></div>
                                <time class="comment-date" datetime="16-12-2014 01:05"><i class="fa fa-clock-o"></i> <?php print $dateTimeCreatedAt; ?></time> 
                              </header>
                              <div class="comment-post" style="clear:both">
                                    <?php print $ticketDescription; ?>
                              </div> 
                            </div>
                          </div>
                        </div>
                    </div>    
                </ticket>   
                <replies> 
                    <h3> Comments </h3>  
                    <hr> 
                
              
                    <?php  for ($i=0; $i < count($ticketReplies) ; $i++): 
                            $support_email = $ticketReplies[$i]['support_email'];
                            $from_email    = $ticketReplies[$i]['from_email'];
                            $body          = $ticketReplies[$i]['body'];
                            $to_emails     = $ticketReplies[$i]['to_emails'];
                            $created_at    = $ticketReplies[$i]['created_at'];
                            
                            $dateTimeCreatedAt  = ump_convert_date_time_human_readable(ump_get_date_time_formatted($ticketReplies[$i]['created_at']));  

                            $attachments   = $ticketReplies[$i]['attachments'];
                            $attachmentsTotal = count($attachments);  



                            // used default to send reply
                            if(!empty($support_email)) {
                                $umpTo = $support_email;
                            }  
                            if(in_array($_SESSION['ump_current_user_email'],  $to_emails) == true) {    
                                $replyName = $from_email;
                                $profilePicSrc = $_SESSION['ump_agent_profile_pic_url_src'];
                            } else { 
                                $replyName = $ticketOwnerName;
                                $profilePicSrc = $_SESSION['ump_customer_profile_pic_url_src'];
                            } 
                            ?>
                        <div class="row"> 
                           
                            <div class="col-md-2 col-sm-2 hidden-xs"> 
                              <div class="thumbnail"> 
                                <img class="img-responsive" src="<?php print $profilePicSrc; ?>">
                              </div>
                            </div> 
                            <div class="col-md-10 col-sm-10">
                              <div class="panel panel-default arrow left" >
                                <div class="panel-body">

                                <!-- Add attachment icon if exist -->
                                 <div class="pull-right">  
                                    <?php  
                                        if( $attachmentsTotal  > 0) { 
                                            for($j=0; $j<$attachmentsTotal; $j++):
                                                $fileUrl = $attachments[$j]['attachment_url'];
                                                $fileName = $attachments[$j]['name'];
                                                 print "<a target='_blank' href='$fileUrl' title='$fileName'><span class='glyphicon glyphicon-paperclip'>
                                                </span></a>";      
                                            endfor; 
                                        } 
                                    ?>  
                                </div>

                                  <header class="text-left">
                                    <div class="comment-user"><i class="fa fa-user"></i> <?php print $replyName; ?> </div>
                                    <time class="comment-date" datetime="16-12-2014 01:05"><i class="fa fa-clock-o"></i><?php print ' ' . $dateTimeCreatedAt; ?></time>
                                   
                                  </header>
                                  <div class="comment-post" style="clear:both">
                                        <?php print strip_tags($body); ?>
                                  </div> 
                                </div>
                              </div>
                            </div>



                        </div>   
                    <?php endfor; ?> 
                </replies>    
                <reply>  
                    <?php require ("message-details-comment-box.php"); ?> 
                </reply>  
            </section>   
        </div> 
        <div class="col-md-2"></div>
    </div> 