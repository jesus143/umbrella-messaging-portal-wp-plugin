<!DOCTYPE html>
<html>
<head>
  <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'textarea' });</script>
</head>
<body>

 <form method="post" action="<?php print get_site_url(); ?>/umbrella-messaging-portal/?section=message-details&ticketId=30">
 
  <label>To:</label><input type="email" name="umpTo" placeholder="adress@domain.com,adress@domain.com" style="width:100%" /><br><br>
  <label>Cc:</label><input type="email" name="umpCc" placeholder="adress@domain.com,adress@domain.com" style="width:100%" /><br><br>
  <label>Bcc:</label><input type="email" name="umpBcc" placeholder="adress@domain.com,adress@domain.com" style="width:100%" /><br><br>
  <textarea name="umpReplyMessage" style="height: 200px;">
  Easy (and free!) <b>You </b> should check out our premium features. This has
  to be customized because we need the feature like FD<BR><br><BR><BR><BR>
  </textarea>
  <br> 
  <div class="pull-left" ><input type="file" name="ump_repy_attachment" /> </div>
  <div class="pull-right"><button class="btn btn-warning btn-sm" id="btn-chat">Send</button> 
    <select style="padding: 6px;border-radius: 5px;" name="ump_send_and_set_as">
      <option>Send and set as pending</option>
      <option>Send and set as resolved</option>
      <option>Send and set as closed</option>
      <option>Send and set as waiting on customer</option>
      <option>Send and set as waiting on third party</option>
    </select> 
  </div>
</form>
<br>
</body>
</html>