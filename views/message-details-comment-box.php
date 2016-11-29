


<?php

if(isset($_POST['umpReplyTicketSubmit']))
{
    $to      = 'Umbrella Business Support Ltd <support@umbrellasupport.freshdesk.com>';
    $subject = $_POST['umpReplySubject'];
    $body    = $_POST['umpReplyMessage'];
    $headers = array('Content-Type: text/html; charset=UTF-8','From: Jesus Erwin Suarez1 <mrjesuserwinsuarez@gmail.com');

    if(wp_mail( $to, $subject, $body, $headers )) {
        print "email successfully sent 1";
    } else {
        print "email failed to sent 1";
    }
}



$replyId = $_GET['replyId'];

$ticketId = $_GET['ticketId'];

$tab = $_GET['tab'];

?>


<div class="ump-embedded-ticket-details">



    <!DOCTYPE html>
    <html>
    <head>
        <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
        <script>tinymce.init({ selector:'textarea' });</script>
    </head>
    <body>


    <form method="post" action="<?php print get_site_url(); ?>/umbrella-messaging-portal/?section=message-details&ticketId=<?php print $ticketId; ?>&replyId=<?php print $replyId; ?>&tab=<?php print $tab; ?>">


   <input type="hidden" name="umpReplySubject" value="[#<?php print $ticketId; ?>] Re: Ticket Received - <?php print $ticketSubject; ?>" />
  <textarea name="umpReplyMessage" style="height: 200px;">
      Easy (and free!) <b>You </b> should check out our premium features. This has
      to be customized because we need the feature like FD<BR><br><BR><BR><BR>
  </textarea>
            <!--        <br>-->
            <!--        <div class="pull-left" ><input type="file" name="ump_repy_attachment" /> </div>-->
            <!--        <div class="pull-right"><button class="btn btn-warning btn-sm" id="btn-chat">Send</button>-->
            <!--            <select style="padding: 6px;border-radius: 5px;" name="ump_send_and_set_as">-->
            <!--                <option>Send and set as pending</option>-->
            <!--                <option>Send and set as resolved</option>-->
            <!--                <option>Send and set as closed</option>-->
            <!--                <option>Send and set as waiting on customer</option>-->
            <!--                <option>Send and set as waiting on third party</option>-->
            <!--            </select>-->
            <!--        </div>-->

        <input name="umpReplyTicketSubmit" type="submit" value="Send" />
    </form>
    <br>
    </body>
    </html>

    <?php
        //    wp_editor('test');
    ?>
<!--    <iframe scrolling="no" style="padding-top: 4px;border-radius:10px;width: 100%;height: 398px;border: 1px solid #fafafa;border-top: 1px solid #e3e3e3;border-bottom: 1px solid #e3e3e3;"  id='frame' src="https://umbrellasupport.freshdesk.com/support/tickets/--><?php //print $_GET['ticketId']; ?><!--#reply-to-ticket"></iframe>-->
</div>
<!--<div><h3> Please refresh the page after submit a ticket reply. </h3></div>-->