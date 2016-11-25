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

if(!empty($_POST['umpReplyMessage'])) {
    print "<div class='alert alert-success'> successfully posted response! </div>";
}
 
ump_ticket_notification_visited($ticketId, $_GET['tab']);


?>
<div >
    <a href="?section=message-notification">
        <input type="button" class="btn btn-primary" value="back" >
    </a>
    <br><br>

    <div class="panel panel-default">
        <div class="panel-heading"><h4> <?php print $ticketSubject; ?> </h4> </div>
        <div class="panel-body"> <p> <?php print $ticketDescription; ?>  </p>  </div>
        <span style="color:grey"> &nbsp; <em> <?php print $ticketCreatedAt;  ?> </em> </span> |
        <span style="color:grey"> &nbsp; <em> <?php print ump_get_ticket_status($ticketStatus);  ?> </em> </span> |
        <span style="color:grey"> &nbsp; <em> <?php print ump_get_ticket_priority($ticketPriority);  ?> </em> </span> |
        <span style="color:grey"> &nbsp; <em> <?php print ump_get_ticket_source($ticketSource); ?> </em> </span> |
    </div>

    <div class="row">
        <div class="col-md-12">
            <h2 class="page-header">Comments</h2>
            <section class="comment-list">
                <?php  for ($i=0; $i < count($ticketReplies) ; $i++):

                        $support_email = $ticketReplies[$i]['support_email'];
                        $from_email    = $ticketReplies[$i]['from_email'];
                        $body          = $ticketReplies[$i]['body'];
                        $to_emails     = $ticketReplies[$i]['to_emails'];
                        $created_at    = $ticketReplies[$i]['created_at'];

                        // used default to send reply
                        if(!empty($support_email)) {
                            $umpTo = $support_email;
                        }
                    ?>

                    <?php  if(in_array($_SESSION['ump_current_user_email'],  $to_emails) == true) {   ?>
                        <!-- first reply -->
                        <article class="row">
                        <div class="col-md-2 col-sm-2 hidden-xs">
                            <figure class="thumbnail">
                                <img style=" width:100px;" class="img-responsive" src="http://www.keita-gaming.com/assets/profile/default-avatar-c5d8ec086224cb6fc4e395f4ba3018c2.jpg" />
                                <figcaption class="text-center"><?php  print $from_email; ?></figcaption>
                            </figure>
                        </div>
                        <div class="col-md-10 col-sm-10">
                            <div class="panel panel-default arrow left">
                                <div class="panel-body">
                                    <header class="text-left">
                                        <div class="comment-user"><i class="fa fa-user"></i> <p> <em>replied to: <?php foreach ( $to_emails  as $email) { print $email . ',';  } ?> </p> </div>
                                        <time class="comment-date" datetime="16-12-2014 01:05"><i class="fa fa-clock-o"></i> <?php print  $created_at; ?> </time>
                                    </header>
                                    <div class="comment-post">
                                        <p>
                                            <?php  print $body; ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>
                    <?php }  else {   ?>
                        <!-- second reply  -->
                        <article class="row">
                        <div class="col-md-10 col-sm-10">
                            <div class="panel panel-default arrow right">
                                <div class="panel-body">
                                    <header class="text-right">
                                        <div class="comment-user"><i class="fa fa-user"></i></p> <em>replied to: <?php foreach ( $to_emails  as $email) { print $email . ',';  } ?></p></div>
                                        <time class="comment-date" datetime="16-12-2014 01:05"><i class="fa fa-clock-o"></i><?php print  $created_at; ?></time>
                                    </header>
                                    <div class="comment-post">
                                        <p>
                                        <p> <?php  print $body; ?>
                                        </p>
                                    </div>
<!--                                    <p  class="text-right"><a href="#" class="btn btn-default btn-sm"><i class="fa fa-reply"></i> reply</a></p>-->
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-2 hidden-xs">
                            <figure class="thumbnail">
                                <img style="width:100px;" class="img-responsive" src="http://www.keita-gaming.com/assets/profile/default-avatar-c5d8ec086224cb6fc4e395f4ba3018c2.jpg" />
                                <figcaption class="text-center"><?php  print $_SESSION['ump_current_user_email']; ?></figcaption>
                            </figure>
                        </div>
                    </article>
                    <?php } ?>
                <?php endfor; ?>
            </section>
        </div>
    </div>
    <div class="panel-footer">
        <div class="row">
            <div class="col-md-12">
                <?php require ("message-details-comment-box.php"); ?>
            </div>
        </div>
    </div>
</div>
<style>
    /*font Awesome http://fontawesome.io*/
    @import url(//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css);
    /*Comment List styles*/
    .comment-list .row {
        margin-bottom: 0px;
    }
    .comment-list .panel .panel-heading {
        padding: 4px 15px;
        position: absolute;
        border:none;
        /*Panel-heading border radius*/
        border-top-right-radius:0px;
        top: 1px;
    }
    .comment-list .panel .panel-heading.right {
        border-right-width: 0px;
        /*Panel-heading border radius*/
        border-top-left-radius:0px;
        right: 16px;
    }
    .comment-list .panel .panel-heading .panel-body {
        padding-top: 6px;
    }
    .comment-list figcaption {
        /*For wrapping text in thumbnail*/
        word-wrap: break-word;
    }
    /* Portrait tablets and medium desktops */
    @media (min-width: 768px) {
        .comment-list .arrow:after, .comment-list .arrow:before {
            content: "";
            position: absolute;
            width: 0;
            height: 0;
            border-style: solid;
            border-color: transparent;
        }
        .comment-list .panel.arrow.left:after, .comment-list .panel.arrow.left:before {
            border-left: 0;
        }
        /*****Left Arrow*****/
        /*Outline effect style*/
        .comment-list .panel.arrow.left:before {
            left: 0px;
            top: 30px;
            /*Use boarder color of panel*/
            border-right-color: inherit;
            border-width: 16px;
        }
        /*Background color effect*/
        .comment-list .panel.arrow.left:after {
            left: 1px;
            top: 31px;
            /*Change for different outline color*/
            border-right-color: #FFFFFF;
            border-width: 15px;
        }
        /*****Right Arrow*****/
        /*Outline effect style*/
        .comment-list .panel.arrow.right:before {
            right: -16px;
            top: 30px;
            /*Use boarder color of panel*/
            border-left-color: inherit;
            border-width: 16px;
        }
        /*Background color effect*/
        .comment-list .panel.arrow.right:after {
            right: -14px;
            top: 31px;
            /*Change for different outline color*/
            border-left-color: #FFFFFF;
            border-width: 15px;
        }
    }
    .comment-list .comment-post {
        margin-top: 6px;
    }
</style>