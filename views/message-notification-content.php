<?php  $tickets = $_SESSION['ticketsContent'];  ?>
<div class="bs-example" data-example-id="list-group-custom-content">
    <div class="list-group"> 
        <?php for ($i=0; $i <count($tickets) ; $i++) : ?>

            <?php
                $notificationStatus = 'unread';//(rand(0,1) == 1) ? 'read' : 'unread';
                $ticketId     = $tickets[$i]['id'];
                $description  = $tickets[$i]['description'];
                $subject      = $tickets[$i]['subject'];


                $latestReply  = Ump\UmpFd::getLatestReply(Ump\UmpFd::getUserTicketReplies($ticketId));

                $lastPersonCommented = 'Jesus Erwin Suarez';


                //                $support_email      = $latestReply[$i]['support_email'];
                //                $from_email         = $latestReply[$i]['from_email'];
                //                $reply_person_name  = ump_get_replied_user_name($latestReply);
                //                $body               = $latestReply[$i]['body'];
                //                $to_emails          = $latestReply[$i]['to_emails'];
                //                $created_at         = $latestReply[$i]['created_at'];

                //                            print "<pre>";
                //                    print_r( $latestReply  );
                //                print "</pre>";
                //                exit;



                //            print "<pre>";


                //            print_r($latestReply);


                //            print "<br> reply id " . ump_get_reply_id($latestReply);
                //            print "<br> ticket if " . $ticketId;
                //            print "<br> current user loggedin " .get_current_user_id() ;
                //            print "<br> status = ".ump_process_and_get_notification_status(get_current_user_id(), $ticketId, ump_get_reply_id($latestReply));
                //            print "</pre>";





             if(ump_is_read($latestReply, get_current_user_id(), $ticketId, ump_get_reply_id($latestReply)) == true) {
                // print "read";
                 $notificationStatus = 'read';
             }

            ?>
            <div>
                <a href="?section=message-details&ticketId=<?php print $tickets[$i]['id']; ?>&replyId=<?php print ump_get_reply_id($latestReply); ?>" class="list-group-item <?php print $notificationStatus; ?> ">

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
            </div>

        <?php   endfor; ?>
    </div>
</div>