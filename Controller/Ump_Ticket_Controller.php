<?php

	if (isset($_POST['body']) and isset($_POST['ticketId'])) {
	    print "<br><br><br><br>";
	    // process reply from agent or a customer
	    if(ump_post_reply() === true) { 
	    	print "Successfully replied a ticket";
	        // ump_console_js("<div class='alert alert-success'> Successfully replied a ticket </div>") ;
	    } else {
	    	print "Failed to reply a ticket";
	      // ump_console_js("<div class='alert alert-danger'>Failed to reply a ticket</div>") ;
	    } 
	}
    //

