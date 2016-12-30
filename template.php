<?php
ob_start();
use Ump\UmpFd;   
  
function ump_messaging_dashboard_func($atts, $content = null) {     
    


?>
    <style type="text/css" media="screen">
      #page-content h2 {
        display:none;
      }
    </style>
<?php
  if($_GET['section']=='message-details') {
     ump_assets(); 
    require('views/details.php');
  } else {
    ump_assets();      
    require('views/notification.php');
  }
?>
<?php  
}  
function ump_assets() { 

$site_url = 'http://localhost/practice/wordpress';
$site_url = site_url();


  ?>
 
<script type="text/javascript" src="<?php print $site_url ; ?>/wp-content/plugins/umbrella-messaging-portal/assets/src/3.1.1-jquery.min.js"></script>
<script type="text/javascript" src="<?php print $site_url ; ?>/wp-content/plugins/umbrella-messaging-portal/assets/src/3.3.7-js-bootstrap.min.js"></script>
 <link rel="stylesheet" href="<?php print $site_url ; ?>/wp-content/plugins/umbrella-messaging-portal/assets/src/3.3.7-bootstrap.min.css"> 

  <script src="<?php print $site_url ; ?>/wp-content/plugins/umbrella-messaging-portal/assets/js/custom_jquery.js" type="text/javascript"></script>  
  <link rel="stylesheet" href="<?php print $site_url; ?>/wp-content/plugins/umbrella-messaging-portal/assets/css/custom_style.css" />
 
  <style type="text/css" media="screen">
        .unread {
            background: #f1f1f1;
            color:white;
        }     
        .read {
            background: #ffffff;
            color:black;
        } 
    </style> 
  <?php 
} 
 
 
 /**
  * Install database table for this plugin
  */
global $ump_db_version;
$ump_db_version = '1.0'; 
function ump_install_table() {


    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

    //
    global $wpdb;
    global $jal_db_version; 
    $table_name = 'wp_ump_notification_reading'; 
    $charset_collate = $wpdb->get_charset_collate();  
  
    $sql = "CREATE TABLE $table_name   (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        user_id bigint(20) NOT NULL,
        ticket_id varchar(30) NOT NULL,
        reply_id varchar(30) NOT NULL,
        status varchar(25) NOT NULL DEFAULT 'unread',
        created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY  (id)
    ) $charset_collate;"; 

    dbDelta( $sql ); 


//    //
//
//    $table_name = 'wp_ump_agent';
//    $charset_collate = $wpdb->get_charset_collate();
//
//    $sql = "CREATE TABLE $table_name   (
//        id mediumint(9) NOT NULL AUTO_INCREMENT,
//        user_id bigint(20) NOT NULL,
//        key_meta varchar(30) NOT NULL,
//        value_meta varchar(30) NOT NULL,
//        created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
//        PRIMARY KEY  (id)
//    ) $charset_collate;";
//
//    dbDelta( $sql );
//
//










    add_option( 'ump_db_version', $ump_db_version );








}


function ump_admin_menu() {  
    add_menu_page('Umbrella Messaging Portal', 'Umbrella Messaging Portal', 'manage_options', "umbrella-messaging-portal", 'ump_admin_view'); 
}   

function ump_admin_view () {
    ?>
    <?php// add_option( 'myhack_extraction_length', 'asdasdas'); ?>

    <?php  
      if(isset($_POST['ump_submit_support_profile_pic'])) { 
        print "<span style='color:green'>Successfully updated.</span>"; 
        update_option( 'ump_agent_profile_pic_url_src', $_POST['ump_agent_profile_pic_url_src']);  
      } 
    ?> 
      <br> <br> 
        <div style="border:1px solid red;width:70%;padding: 20px;background-color: white;border: 1px solid #cacaca;">
          <label> Freshdesk Admin Profile Picture Full Link</label><br><br>
          <form  method="post"  action="<?php print $_SERVER['PHP_SELF'] . '?page=umbrella-messaging-portal'; ?>" method="get" accept-charset="utf-8">  
            <input style="width:100%" name="ump_agent_profile_pic_url_src" type="text" value="<?php print get_option ( 'ump_agent_profile_pic_url_src' ); ?>" />
            <br> 
            <input type="submit" name="ump_submit_support_profile_pic" />
          </form>
        </div>

        <br>  

        <div style="border:1px solid red;width:70%;padding: 20px;background-color: white;border: 1px solid #cacaca;">
          <label> Shorcodes: post/page </label><br><br>
            <br><br>
          <b>[ump_messaging_dashboard]</b><br>
            <small>Where you can see all the messages</small>
            <br><br>
          <b>[ump_sso_messaging_authentication]</b><br>
            <small>Authomatic login to fd when user visited to portal fd messages</small>

            <br><br>
          <b>[ump_comment_message_settings]</b> <br>
            <small>This is the settings of the agent</small>

        </div>

         <br>
         <div style="border:1px solid red;width:70%;padding: 20px;background-color: white;border: 1px solid #cacaca;word-wrap: break-word;">  
          <label><b>Contact registration via url ping, use this example bellow </b></label>
          <br><br>
            <label>Update contact by email</label>

            <br><br> 
            <b>
              <em>
                http://testing.umbrellasupport.co.uk/fd-contact-registration/?fullName=jellyandicecream&email=jellyandicecream@umbrellapartner.co.uk&phone=222-3831&mobile=+639069262984&partnerId=12332@umbrellapartner.co.uk&partnerWebsite=http://www.google.com&companyName=YourCompany&accountManager=yourManager&otherEmail=123223@gmail.com&action=update
              </em>
            </b>

            <br><br>

            <label>Insert new contact</label>
            <br><br>
            <b>
              <em>
                http://testing.umbrellasupport.co.uk/fd-contact-registration/?fullName=jellyandicecream&email=jellyandicecream@umbrellapartner.co.uk&phone=222-3831&mobile=+639069262984&partnerId=12332@umbrellapartner.co.uk&partnerWebsite=http://www.google.com&companyName=YourCompany&accountManager=yourManager&otherEmail=123223@gmail.com
              </em>
            </b>
        </div>
        
        <br><br><br>
        <div style="font-size:5">
            <hr>
            <em>
              When moving this plugin to other url, need to chage url in custom_jquery.js and realtime-notification.js files.
            </em>
        </div>











    <?php 
}

/**
 * Not in used
 */
function ump_comment_details_embedded_func() {
    ?>  
    <div class="ump-embedded-ticket-details"> 
      <iframe scrolling="no" style="width:100%;height:393px;"  id='frame' src="https://umbrellasupport.freshdesk.com/support/tickets/33#reply-to-ticket"></iframe>
    </div> 
    <?php 
}

function ump_comment_details_embedded_debugging_func() {
 
  require_once('includes/helper.php');
  require_once ('includes/wpdb_queries.class.php');

   ump_is_read(null, 1, 2, 0); 
}

function ump_comment_details_ticket_post_reply_func() { ?>
<style>
    #page-content h2 {
        display:none;
    }
</style>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<br><br>
<?php 
      //  Submit reply 
    if($_POST['umpReplyMessage'] != $_SESSION['ump_ticket_reply_previous_posted']) { 
      // upload files to wordpress if exist
      // sending reply to email 
      // posting reply to ticket via email
      $status = ump_process_reply_to_a_ticket();     
      if($status == true) {
        print "<div class='alert alert-success' >
            <img style='height:21px' src='".site_url()."/wp-content/plugins/umbrella-messaging-portal/assets/img/icon/green_round_tick_sign_4246.png' />
            Message Successfully Sent! Please wait while you are re-directed.. <span id='ump_submit_ticket_reply_success'>3</span>
        </div>";   
      } else { 
          print "<div class='alert alert-danger' > 
              <img style='height:21px' src='".site_url()."/wp-content/plugins/umbrella-messaging-portal/assets/img/icon/21px.png' />
              Reply failed to post, please try again and please wait while you are re-directed..  <span id='ump_submit_ticket_reply_failed'>3</span>
          </div>";
      } 
      // execute redirect back to preview url  
      // print "redirecting back to messages.."; 
      ?>
        <script type="text/javascript">    

            var counter=3 

            var timeOut = setInterval(function() {   

              if(counter >= 0) {   


                if(counter == 0){
                  counter = '';
                }
                // show decrement counter in ui
                $('#ump_submit_ticket_reply_success').text(counter);  
                $('#ump_submit_ticket_reply_failed').text(counter);  

              } else {  

                // after 3 seconds, you will be redirected to /messages/ page
                clearTimeout(timeOut);  
                var site_url = '<?php print "site_url()"; ?>'; 
                document.location = site_url + '/messages';   

              }
              counter--; 
            }, 1000);      
        </script> 
      <?php  
    } else { 
      print "<div class='alert alert-warning'>Posting reply failed because this message is same as previews reply post. Please <a href='".site_url()."/messages' >here</a> to messages..</div>";
    }
}


function ump_comment_message_settings_func()
{


  // print "business profile pic " . ump_getBusinessProfilePic(); 

//
//    add_post_meta( 123, 'test', 'nice test',true );
//    $test = get_post_meta( 123, 'test', true );
//    print "test" . $test;




    $current_user = wp_get_current_user();
    if (isset($_POST['message_portal_settings_submit'])) {
        global $wpdb;
        print "<br>insert new data to " . $wpdb->prefix . 'postmeta <br>' . ' id ' . $current_user->ID . ' Post ' . $_POST['agent_full_name'];
        update_user_option( $current_user->ID, 'fd_agent_id', $_POST['message_portal_agent_id'] );
        update_user_option( $current_user->ID, 'fd_agent_profile_pic_url',  $_POST['message_portal_agent_profile_pic_url']);
        update_user_option( $current_user->ID, 'fd_agent_full_name',  $_POST['agent_full_name']);

    }



    // if empty then auto insert new full name attribute for agent
//    if(empty(update_user_option( $current_user->ID, 'fd_agent_full_name', true))){
//        update_user_option( $current_user->ID, 'fd_agent_full_name',  $current_user->display_name);
//    }

    $agent_id = get_user_meta( $current_user->ID, 'wp_fd_agent_id', true);
    $profile_pic_url_settings = get_user_meta( $current_user->ID, 'wp_fd_agent_profile_pic_url', true);
    $agent_full_name = get_user_meta( $current_user->ID, 'wp_fd_agent_full_name', true);


//    print_r($agent_id);

//    print " display name " .  $current_user->display_name;
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <body>
    <div class="container">
        <h2>Agent Message Portal Settings</h2>



        <form action="" method="post">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td style="width:10%;" >Full Name</td>


                        <td>
                            <input type="text" value="<?php print $agent_full_name; ?>" name="agent_full_name" />
                        </td>


                    </tr>
                    <tr>
                        <td>
                            Profile Pic Url
                        </td>
                        <td>
                            <?php if(!empty($agent_id)): ?>

                                <?php  ump_getAgentProfilePic($agent_id); ?>

                            <img src="<?php print ump_getAgentProfilePic($agent_id); ?>" style="height: 100px;"  /><br>
                            <?php else: ?>
                                <b> Please add the freshdesk agent id first</b>
                            <?php endif;  ?>
                            <input type="text" value="<?php print $profile_pic_url_settings; ?>" name="message_portal_agent_profile_pic_url" />

                        </td>
                    </tr>
                    <tr>
                        <td>Freshdesk Agent Id</td>
                        <td>
                            <input type="text" value="<?php print $agent_id; ?>" name="message_portal_agent_id" />
                        </td>
                    </tr>

                </tbody>
            </table>
            <input type="submit" value="Update" name="message_portal_settings_submit" class="btn btn-success" />
        </form>
    </div>
    </body>
    </html>
<?php
}


ob_end_flush();