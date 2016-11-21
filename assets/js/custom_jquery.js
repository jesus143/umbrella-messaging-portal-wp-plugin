/**
 * Reminder we need to set the query to api 1 time every 5 mins    
 * You should be update the freshdesk status every 5 mins
 */  
 
// console.log("host")
obj = new Object(); 
if (location.hostname === "localhost" || location.hostname === "127.0.0.1") {
	obj.site_plugin_url = 'http://localhost/practice/wordpress/wp-content/plugins/umbrella-messaging-portal';  
    // alert("It's a local server!");
} else {
	obj.site_plugin_url = 'http://testing.umbrellasupport.co.uk/wp-content/plugins/umbrella-messaging-portal';  
}

 

(function ( $ ) { 


	// load pagination
 	setTimeout(function(){   
	 	startCheckingPagination() 
 		startCheckingContent() 	
		startCheckTotalNotifications();
	}, 2000);  
    

   // load pagination
   function loadNotificationPagination( tab_footer_content, tab_name) {
	   	console.log( "1. Start loading " + tab_name + " pagination..... ");
  		var loadUrl = obj.site_plugin_url + '/assets/img/icon/box.gif'; 
	 	$( tab_footer_content ).html("<img class='ump-footer-loader' src='"  + loadUrl +"' />");
		$.get( obj.site_plugin_url + "/views/pagination.php", { tab: tab_name } ) 
		.done(function( data ) {
		 	console.log( "1.1 Finished pagination " + tab_name + "loaded " );
		    $( tab_footer_content ).html(data);
		});    
	} 

	// load content
 	function loadContent(content, tab, page){

		console.log("2. Starting loading content for " + tab + " ...."); 

  		var loadUrl = obj.site_plugin_url + '/assets/img/icon/box.gif'; 
	 	$( content ).html("<img src='"  + loadUrl +"' />");
		$.get( obj.site_plugin_url + "/views/content.php", { tab:tab, page:page } ) 
		.done(function( data ) {    

			
			 var totalNoti1 = data.split('<totalTickets>'); 
 
			 // console.log(data);

			var isLoaded = data.search("loaded-session");
			  // console.log(" 0 "  + totalNoti1[0] + " 1 = "+  totalNoti1[1] + " 2 = " + totalNoti1[2]);
			var  totalNoti = totalNoti1[1];

			 // var isLoaded = data.split('<loadedstatus>')[1];  
			 console.log("2.1 Total content result = " + totalNoti + " and is session is loaded? =" + isLoaded);
			 // If total notification result is 
			 if( totalNoti < 1 &&  isLoaded >= 0) {

			 	 // startCheckTotalNotifications();
			 	 // $.fn.loadContent(); 
			 	 console.log("2.2 session data is loaded but you don't have ticket to display"); 
			 }  else if (totalNoti < 1 && isLoaded < 0) {
			 	console.log("2.3 session data is not yet loaded, then load again.. content, pagination and notification..");  

			 	// reload again if the session is failed to load
			 	
		  		// load pagination   
	 			// load notification in bge  
				// load notification in um 
				// load notification in up 
		 		// load content   
	 			startCheckingPagination() 
		 		startCheckingContent() 	
				startCheckTotalNotifications();
			 } else {
			 	console.log("2.4 Ticket are successfully loaded, display content, notification and pagination now..");
			 }
			 // console.log("total tickets index none " + TotalMessage); 
			 // console.log("total tickets index 0 " +TotalMessage[0]); 
			 // console.log("total tickets index 1 " +TotalMessage[1]);  
			 // if empty then call back again notification and content
			 // startCheckTotalNotifications()
			 // $.fn.loadContent 
		    // console.log( "Data Loaded: " + data );
		    console.log("2.5 Finished loading content for " + tab + " ...." ); 
		    $( content ).html(data);
		});    
  	}    

 	// start checking and getting the total notifications
    function startCheckTotalNotifications() {  
		loadTotalUnreadNotifications('#ump-menu-badge-bge', '#ump-menu-loader-bge', 'Business Growth Executed'); 
		loadTotalUnreadNotifications('#ump-menu-badge-um', '#ump-menu-loader-um', 'Umbrella Messages');  
		loadTotalUnreadNotifications('#ump-menu-badge-up', '#ump-menu-loader-up', 'Umbrella Portners');  
	} 	 

	function startCheckingContent() {
		loadContent( '#ump-content-bge', 'Business Growth Executed', 1);   
		loadContent( '#ump-content-um', 'Umbrella Messages', 1); 
		loadContent( '#ump-content-up', 'Umbrella Portners', 1); 
	}

	function startCheckingPagination() {
		loadNotificationPagination('#ump-footer-bge', 'Business Growth Executed');
		loadNotificationPagination('#ump-footer-um', 'Umbrella Messages');
		loadNotificationPagination('#ump-footer-up', 'Umbrella Portners'); 
	}

	// generate the total unread notifications and check notification every 5 mins 
	// query total notifications now
	function loadTotalUnreadNotifications(content, loader, tab){
		console.log('3. Starting to load unread ' + tab +  ' notifications ')
  		var loadUrl = obj.site_plugin_url + '/assets/img/icon/box.gif'; 
	 	// $( loader ).html("<img style='height:40px' src='"  + loadUrl +"' />");
		$.get( obj.site_plugin_url + "/views/calculate-notifications.php", { tab:tab } ) 
		.done(function( data ) {
			console.log('3.1 Finished to load unread ' + tab +  ' notifications ')
			// console.loadTotalUnreadNotifications() loaded");
		    // console.log( "Data Loaded: " + data );  
		    $( content ).html(data);
		    // $( loader ).html('');
		});    
  	}   

	//http://localhost/practice/wordpress/wp-content/plugins/umbrella-messaging-portal/
	function loadFreshdeskData () {  
		console.log("4.1 Start loading all freshdesk data..");
		// console.log("loading data from freshdesk");
		$.get( obj.site_plugin_url + "/views/generate-freshdesk-local.php" ) 
		.done(function( data ) {   
			console.log("4.2 Finished fresh-desk data loaded and refresh content, unread notification and pagination..");
		   	startCheckingPagination() 
	 		startCheckingContent() 	
			startCheckTotalNotifications();
		});     
		 
  	}     
  
	// menu click in bussiness growth executive
	$('#ump-menu-bge').on('click', function(){
		loadContent( '#ump-content-bge', 'Business Growth Executed', 1); 
	}); 
	//menu click in bussiness growth executive
	$('#ump-menu-um').on('click', function(){
		loadContent( '#ump-content-um', 'Umbrella Messages', 1); 
	});  
	// menu click in bussiness growth executive
	$('#ump-menu-up').on('click', function(){
		loadContent( '#ump-content-up', 'Umbrella Portners', 1); 
	});   
 
	// load freshdesk data in every 5mins 
	setTimeout(function(){  
		console.log("4. start getting freshdesk data....");
		 loadFreshdeskData(); 
	}, 10000); 
	setInterval(function(){
		 loadFreshdeskData(); 
	}, 300000)
}( jQuery ));
  
function umpLoadContent(content_id, tab, page, div_id) {   
 	// query page content
	var loadUrl = obj.site_plugin_url + '/assets/img/icon/box.gif'; 
 	$( content_id ).html("<img src='"  + loadUrl +"' />");
	$.get( obj.site_plugin_url + "/views/content.php", { tab: tab, page:page } ) 
	.done(function( data ) {

	    console.log( " new tab content for " + content_id  +  " is loaded ... " );
	    $( content_id ).html(data);
	});      
	// set page button to selected
	for (var i = 0; i <100; i++) {
		$(div_id+'-'+i).attr('class','');
	}
	$(div_id+'-'+page).attr('class','active');
}