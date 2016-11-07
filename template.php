<?php 	

use Ump\Ump_Fd;  
 




function ump_messaging_dashboard_func($atts, $content = null) {     
   ump_assets();  
?>
<div class="container">  
    <?php  
 
    print "<pre>";
    print_r($_FILE);
    print_r($_POST);
    // print_r($_SERVER['QUERY_STRING']);
    // print "<br>";
    // print_r($_SERVER['REQUEST_URI']);
    // print "<br>";
    // print_r($_SERVER);
    // print "<br>"; 
    // print 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];   
    $currentPage = ump_get_current_page();
    $limitStart  = ump_get_start_start(); 
    $limitEnd    = ump_get_end_limit(); 
    print "<br>current page " . $currentPage; 
    print "<br>limit start " . $limitStart;
    print "<br>limit end " . $limitEnd;
    print "</pre>"; 
    if($_GET['section']=='message-notification') {
        require('views/message-notification.php'); 
    } else if($_GET['section']=='message-details') { 
        require('views/message-details.php');
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