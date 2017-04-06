<?php 

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
        <div style="border: 1px solid #e7e6e6;padding: 20px;background-color: #fafafa;border-radius: 5px;width: 100%;">


            <!-- <form method="post" action="<?php print get_site_url(); ?>/umbrella-messaging-portal/?section=message-details&ticketId=<?php print $ticketId; ?>&replyId=<?php print $replyId; ?>&tab=<?php print $tab; ?>" enctype="multipart/form-data"> -->


    <form method="post" action="<?php print get_site_url(); ?>/message-sent" enctype="multipart/form-data">




               <input type="hidden" name="umpReplySubject" value="[#<?php print $ticketId; ?>] Re: Ticket Received - <?php print $ticketSubject; ?>" />





              <textarea name="umpReplyMessage" style="height: 200px;"> 
              </textarea> 
                <br> 
                <input type="file" multiple name="file[]"  /> 
                <br>
                <input name="umpReplyTicketSubmit" type="submit" value="Reply"  class="ump-reply-ticket-submit" />  
               
            </form>
        </div>  
    </body>
    </html>  
</div>
<!--<div><h3> Please refresh the page after submit a ticket reply. </h3></div>-->