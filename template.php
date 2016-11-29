<?php 	

use Ump\UmpFd;   
  
function ump_messaging_dashboard_func($atts, $content = null) {     
   ump_assets();      
?>
    <style type="text/css" media="screen">
      #page-content h2 {
        display:none;
      }
    </style>
<?php
  if($_GET['section']=='message-details') {
    require('views/details.php');
  } else {
    require('views/notification.php');
  }
?>
<?php  
}  
function ump_assets() { 

$site_url = 'http://localhost/practice/wordpress';
$site_url = site_url();


  ?>


  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 
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

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql ); 
    
    add_option( 'ump_db_version', $ump_db_version );
}


function ump_admin_menu() {  
    add_menu_page('Umbrella Messaging Portal', 'Umbrella Messaging Portal', 'manage_options', "umbrella-messaging-portal", 'ump_admin_view'); 
}   

function ump_admin_view () {
    ?>
    

        <h1> 
            Shortcode: ump_messaging_dashboard_func
         </h1>

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