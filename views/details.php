
<?php
session_start();   

// Tickets

$_SESSION['ticketsContent'] = $_SESSION['tickets']['umbrella_growth_executive'];  

$replyId = (!empty($_GET['replyId'])) ? $_GET['replyId'] : 0;

ump_process_update_status_to_read(get_current_user_id(), $_GET['ticketId'], $replyId); 

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
$ticketSubjectC     =  '#' . $ticketId . ' ' . $ticketSubject;
$dateTimeCreatedAt  = ump_convert_date_time_human_readable(ump_get_date_time_formatted($ticket['created_at']));  
$timeCreated        = ump_convert_time_human_readable($dateTimeCreatedAt);
$message            = $ticket['message'];
$user_id            = $ticket['requester_id'];

          
                             

$profilePicSrc = ump_getAgentProfilePic($user_id);
$replyName = ump_getAgentFullName($user_id);


//
//print "<pre>";
//print_r($ticket);
//print "</pre>";
// print "<pre>";  
//     print "ticket<br>";
//     print_r($ticket); 
//     print "reply ticket <br>";
//     print_r($ticketReplies);  
// print "</pre>";  
// get attachments
//  
// if(!empty($_POST['umpReplyMessage'])) {
//     print "<div class='alert alert-success'> successfully posted response! </div>";
// }  
if($message == 'You have exceeded the limit of requests per hour') { 
    // print "message";
    print "<center><span style='color:red; font-size:10px;'>Warning :" . $message . "</span></center>"; 
    // exit; 
} 
ump_ticket_notification_visited($ticketId, $_GET['tab']); 
?>  
    <link rel="stylesheet" href="<?php print site_url(); ?>/wp-content/plugins/umbrella-messaging-portal/designer/reply-design.css">
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet"> 
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>  
      <link rel="stylesheet" href="<?php print $site_url; ?>/wp-content/plugins/umbrella-messaging-portal/assets/css/custom_style.css" /> 
      <br><br>
      <div class="row row-container"> 
        <div class="col-md-12 ump-reply-message-container"    >
       
            <section class="comment-list">     
                <ticket> 
                  <div style="margin-left: 20px;" > 

                     <a href="?section=message-notification">
                        <button class="btn btn-default"  class="ump-reply-ticket-submit"> Back </button> <br><br>
                    </a>
                    <h3 class="ump-ticket-subject"> <?php print $ticketSubjectC; ?></h3> <br>
                    <div class="row row-container"> 
                        <div class="col-md-1 col-sm-2 hidden-xs"> 
                          <div  class="thumbnail ump-thumbnail"    > 
                            <img class="img-responsive ump-img-responseive"   src="<?php print $profilePicSrc; ?>" style="height:69px">  
                          </div>
                        </div>  
                        <div class="col-md-10 col-sm-12 message-boxes-container" > 
                          <!-- <div class="arrow-up"> </div>  -->
                          <div class="panel panel-default " >
                            <div class="panel-body">
                              
                              <header class="text-left">
                                <div class="comment-user"><i class="fa fa-user"></i> <?php print $replyName; ?></div>
                                <time class="comment-date" datetime="16-12-2014 01:05"><i class="fa fa-clock-o"></i> 
                                <?php print $dateTimeCreatedAt; ?><br> 
                                 <center><?php print '' . $timeCreated; ?></center><br> 
                                </time> 

                              </header>

                              <div class="comment-post" style="clear:both">
                                    <?php print html_entity_decode ($ticketDescription); ?>
                              </div> 

                            </div>
                          </div>
                        </div>
                    </div>   
                  </div>  
                </ticket>   
                <replies> 
                    <div style="margin-left:20px" >
                    <h3> Comments </h3>  
                    </div>
                    <hr> 
                    <br>
                    <div style="width:-3%">
                      <?php  for ($i=0; $i < count($ticketReplies) ; $i++):
                            //                            print "<pre>"
                            //                                print_r($ticketReplies[$i]);
                            //                            print "</pre>";
                              $support_email = $ticketReplies[$i]['support_email'];
                              $from_email    = $ticketReplies[$i]['from_email'];
                              $body          = $ticketReplies[$i]['body'];
                              $to_emails     = $ticketReplies[$i]['to_emails'];
                              $created_at    = $ticketReplies[$i]['created_at'];
                              $user_id       = $ticketReplies[$i]['user_id']; 

                              $dateTimeCreatedAt  = ump_convert_date_time_human_readable(ump_get_date_time_formatted($ticketReplies[$i]['created_at']));   
                              $timeCreated = ump_convert_time_human_readable($ticketReplies[$i]['created_at']);  
                              $attachments   = $ticketReplies[$i]['attachments'];
                              $attachmentsTotal = count($attachments);   
                              // print " date created " . $ticketReplies[$i]['created_at'];  
                              // used default to send reply
                              if(!empty($support_email)) {
                                  $umpTo = $support_email;
                              }
   
                              // if(in_array($_SESSION['ump_current_user_email'],  $to_emails) == true) {
                              // $replyName = $from_email;
                              // $profilePicSrc = $_SESSION['ump_agent_profile_pic_url_src'];
                              // } else {
                              // $replyName = $ticketOwnerName;
                              // $profilePicSrc = $_SESSION['ump_customer_profile_pic_url_src'];
                              // } 
    
                              // print "<pre>";
                              //   print_r($ticketReplies[$i]);
                              // print "</pre>"; 
                            
                              $isAgent = isAgent($user_id); 
                              $profilePicSrc = ump_getAgentProfilePic($user_id);  
                              $replyName = ump_getAgentFullName($user_id); 
                            

                            $profile_pic_style = '';     
                            $arrow_up_style  = ''; 
                            $pull_right = ''; 
                            $margin_left = ''; 

                            if($isAgent  == true) { 
                              $profile_pic_style = "    margin-left: -14px;";
                              $arrow_up_style    = 'margin-left:90% !important'; 
                              $pull_right = 'pull-right';  
                              $row_style ="  margin-left: 34px;";

   
                            }  

                              ?> 
                           <div class="row row-container " style="<?php print $row_style; ?>"> 
                              
                              <?php if($isAgent != true): ?>
                        
                                <div class="col-md-1 col-sm-2 hidden-xs"> 
                                  <div class="thumbnail ump-thumbnail"     > 
                                    <img class="img-responsive ump-img-responseive" title="<?php print $user_id; ?>" src="<?php print $profilePicSrc; ?>" style="height:69px;"  > 
                                  </div>
                                </div> 
                              <?php endif; ?>
   
                              <div class="col-md-10 col-sm-12 message-boxes-container <?php print $margin_left; ?>"  >
                                <!-- <div class="arrow-up" style="<?php echo $arrow_up_style;  ?>"></div> -->
                                <div class="panel panel-default" >
                                  <div class="panel-body"> 
                                  <!-- Add attachment icon if exist -->
                                 
                                    <header class="text-left">
                                      <div class="comment-user"><i class="fa fa-user"></i> <?php print $replyName; ?> </div>
                                      <time class="comment-date" datetime="16-12-2014 01:05"><i class="fa fa-clock-o"></i>
                                      <?php print ' ' . $dateTimeCreatedAt; ?><br>
                                      <center><?php print '' . $timeCreated; ?></center><br> 
                                      </time> 
                                    </header>
                                    <div class="comment-post" style="clear:both">
                                          <?php print html_entity_decode ($body); ?>
                                    </div> 

                                      <div class="pull-right"  >  
                                      <?php  
                                          if( $attachmentsTotal  > 0) { 
                                              for($j=0; $j<$attachmentsTotal; $j++):
                                                  $fileUrl = $attachments[$j]['attachment_url'];
                                                  $fileName = $attachments[$j]['name'];
                                                   print "<a target='_blank' href='$fileUrl' title='$fileName'>
                                                  <i class='fa fa-paperclip paper-clip' aria-hidden='true'></i>
                                                  </a>";      
                                              endfor; 
                                          } 
                                      ?>  
                                  </div> 
                                  </div>
                                </div>
                              </div> 

                               <?php if($isAgent == true): ?> 
                                <div class="col-md-1 col-sm-2 hidden-xs " style="<?php print  $profile_pic_style; ?>"> 
                                  <div class="thumbnail ump-thumbnail"  > 
                                    <img class="img-responsive ump-img-responseive" title="<?php print $user_id; ?>" src="<?php print $profilePicSrc; ?>" style="height:69px;"  > 
                                  </div>
                                </div> 
                              <?php endif; ?> 
                           </div>   
                      <?php endfor; ?> 
                    </div>


                </replies>    
                <reply>  
                    <?php require ("message-details-comment-box.php"); ?> 
                </reply>  
            </section>   
        </div>  
    </div> 