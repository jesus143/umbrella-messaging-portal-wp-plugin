<?php 
  $tickets = Ump\UmpFd::fetchTickets('email', $_SESSION['ump_current_user_email'] );

  // print "<pre>"; 
  //     print_r($tickets); 
  // print "</pre>";  

  $_SESSION['tickets'] = ump_separate_to_tabs($tickets);


?>

<h2>Freshdesk Message Portal</h2>

  <ul class="nav nav-tabs"> 
    <li class="active">
    <!-- <a data-toggle="tab" href="#home">Home</a></li> -->
    <li  class="active" ><a data-toggle="tab" href="#menu1"> <span class='badge'>1</span> Business Growth Executive</a></li>
    <li><a data-toggle="tab" href="#menu2"> <span class='badge'>2</span> Umbrella Messages</a></li>
    <li><a data-toggle="tab" href="#menu3"> <span class='badge'>4</span> Umbrella Partners</a></li>
  </ul>   
 
  <div class="tab-content"> 
    <div id="menu1" class="tab-pane fade in  active">
      <br> 
        <?php $_SESSION['ticketsContent'] = $_SESSION['tickets']['umbrella_growth_executive']; ?>
        <!-- notification content -->
        <?php require "message-notification-content.php"; ?>
        <!-- nav pagination -->
        <?php //require "message-notification-content-pagination.php"; ?>
    </div>


    <div id="menu2" class="tab-pane fade">

        <br>
        <?php
            $_SESSION['ticketsContent'] = $_SESSION['tickets']['umbrella_messages'];
        ?>
        <!-- notification content -->
        <?php require "message-notification-content.php"; ?>
        <!-- nav pagination -->
        <?php //require "message-notification-content-pagination.php"; ?>



    </div>

 
    <div id="menu3" class="tab-pane fade">
        <br>
        <h3>Menu 2</h3>
        <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
    </div>


    
  </div>
 