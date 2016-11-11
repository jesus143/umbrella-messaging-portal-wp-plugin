<?php 	

use Ump\UmpFd;   
 




function ump_messaging_dashboard_func($atts, $content = null) {     
   ump_assets();  
?>
<div class="container">  
 <?php




// if(!empty(ump_is_agent())) {
//     print "agent";
// } else {
//     print "not agent";
// }

// exit;

    // $fd = new UmpFd('umbrella2016', 'enquiries@umbrellasupport.co.uk');
//     print "<pre>";
    // print_r($_FILE);
//     print_r($_POST);
    // print_r($_SERVER['QUERY_STRING']);
    // print "<br>";
    // print_r($_SERVER['REQUEST_URI']);
    // print "<br>";
    // print_r($_SERVER);
    // print "<br>"; 
    // print 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];   
    // $currentPage = ump_get_current_page();
    // $limitStart  = ump_get_start_start(); 
    // $limitEnd    = ump_get_end_limit();   
    // print "<h4> get ticket posts </h4>"; 
    // $tickets = UmpFd::fetchTickets('email', 'mrjesuserwinsuarez@gmail.com');  
    // print_r($tickets);  
    // print "<h4> get ticket reply</h4>"; 
    // $ticketReplies = UmpFd::getUserTicketReplies(7);  
    // print_r($ticketReplies);  
    // print "<br>current page " . $currentPage; 
    // print "<br>limit start " . $limitStart;
    // print "<br>limit end " . $limitEnd;
    // UmpFd::replyTicket(15, array('body'=>'ok.. '));
//     print "</pre>";
    // UmpFd::replyTicket(7, array('body' => 'This is a sample reply api')); 
    if($_GET['section']=='message-notification') {
        require('views/notification.php');
        // print "end";
    } else if($_GET['section']=='message-details') { 
        // print 'start';
        require('views/details.php');
         // print 'amainzg';
    }  
?> 
    
    


</div> 
<?php  
}  
function ump_assets() { ?> 
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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