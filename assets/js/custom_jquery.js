/**
 * Reminder we need to set the query to api 1 time every 5 mins    
 * You should be update the freshdesk status every 5 mins
 */  
 
//// console.log("host")
obj = new Object(); 
obj1 = new Object();
if (location.hostname === "localhost" || location.hostname === "127.0.0.1") {
	obj.site_plugin_url = 'http://localhost/practice/wordpress/wp-content/plugins/umbrella-messaging-portal'; 
	obj1.site_plugin_url_ext = 'http://localhost/practice/wordpress/wp-content/plugins/umbrella-messaging-portal-rte';  
    // alert("It's a local server!");
} else {
	obj.site_plugin_url = 'http://testing.umbrellasupport.co.uk/wp-content/plugins/umbrella-messaging-portal'; 
	obj1.site_plugin_url_ext = 'http://testing.umbrellasupport.co.uk/wp-content/plugins/umbrella-messaging-portal-rte'; 
}

obj.isNotificationEmpty = false;
 
(function ( $ ) { 
 	 
	setInterval(function(){
		$.get( obj.site_plugin_url + "/email/imap_process.php" ) 
		.done(function( data ) { 
				
			// display the response status
			// console.log(data); 

			// check the status if there is new incoming email or new freshdesk data
			var n = data.indexOf("There is new incoming email");  

			// if there is new incoming email from freshdesk 
			// then refresh freshdesk data and reload notification, pagination and content
			if(n >= 0) {    
				// alert("reload refresh data");  
				// reload fresh desk data together with pagination, content and pagination
				loadFreshdeskData(); 

				// reload notifications 
			}    
		});    
	}, 10000); 
 
	// load pagination
 	setTimeout(function(){

    	// get total unread notification
 		var totalUnreadNoti = localStorage.getItem('umpNotificationUnreadTotal');

 		// set total notification in header right after load 
 		umpPutNotificationToUi(totalUnreadNoti);

		// trigger to display it in ui, top header message thing
 		loadTotalUnreadNotificationsGeneral();

 		// checking pagination
	 	startCheckingPagination();

	 	// checking content 
 		startCheckingContent();

 		// checking total notification for tab
		startCheckTotalNotifications(); 

	}, 1000);
	// load freshdesk data in every 5mins
	setTimeout(function(){
		// console.log("4. start getting freshdesk data....");
		loadFreshdeskData();
	}, 10000);
	// setInterval(function(){
	// 	loadFreshdeskData();
	// }, 600000);
    

   // load pagination 
   function loadNotificationPagination( tab_footer_content, tab_name) {
	   	// console.log( "1. Start loading " + tab_name + " pagination..... ");
  		var loadUrl = obj.site_plugin_url + '/assets/img/icon/box.gif'; 
	 	//$( tab_footer_content + "-loading" ).html("<span> please wait... </span>" + "<img class='ump-footer-loader' src='"  + loadUrl +"' />");
		$.get( obj.site_plugin_url + "/views/pagination.php", { tab: tab_name } ) 
		.done(function( data ) {
			//$( tab_footer_content + "-loading" ).html("");
		 	// console.log( "1.1 Finished pagination " + tab_name + "loaded " );
		    $( tab_footer_content ).html(data);
		});    
	} 

	// load content
 	function loadContent(content, tab, page)
	{
		// console.log("2. Starting loading content for " + tab + " ...."+ " content = " + content);
  		var loadUrl = obj.site_plugin_url + '/assets/img/icon/box.gif';

		// only show loading when notification is not empty
		if(obj.isNotificationEmpty == false) {
			$( content + "-loading" ).html("<center> <img class='ump-footer-loader' src='"  + loadUrl +"' />"+"<br><br> <span> Please Wait... </span><br><br></center>"  );
		}

		$.get( obj.site_plugin_url + "/views/content.php", { tab:tab, page:page } ) 
		.done(function( data ) {

			$( content + "-loading" ).html("");
			
			 var totalNoti1 = data.split('<totalTickets>'); 

			 var isLoaded = data.search("loaded-session");
			  // console.log(" 0 "  + totalNoti1[0] + " 1 = "+  totalNoti1[1] + " 2 = " + totalNoti1[2]);
			 var  totalNoti = totalNoti1[1];

			 // var isLoaded = data.split('<loadedstatus>')[1];  
			 // console.log("2.1 Total content result = " + totalNoti + " and is session is loaded? =" + isLoaded);
			 // If total notification result is 
			 if( totalNoti < 1 &&  isLoaded >= 0) {
				 obj.isNotificationEmpty = true;
			 	 // console.log("2.2 session data is loaded but you don't have ticket to display");
				 data = '<div><center><br><br><br><br><h3>no content to load..</h3><br><br></center></div>';
				 //remove pagination
				 //if(content   == '#ump-content-bge') {


 				 // clear pagination
				 if(content == '#ump-content-um') {
					 $('#ump-footer-um').html('');
				 } else if (content == '#ump-content-bge') {
					 $('#ump-footer-bge').html('');
				 } else if (content == '#ump-content-up') {
					 $('#ump-footer-up').html('');
				 }

				 //} else if (content == '#ump-content-um') {
				 //} else {
				 //}
			 }  else if (totalNoti < 1 && isLoaded < 0) {

			 	// console.log("2.3 session data is not yet loaded, then load again.. content, pagination and notification..");
				 setTimeout(function(){
					 startCheckingPagination();
					 startCheckingContent();
					 startCheckTotalNotifications();
				 }, 5000);

			 } else {
			 	// console.log("2.4 Ticket are successfully loaded, display content, notification and pagination now..");
			 }
		    // console.log("2.5 Finished loading content for " + tab + " ...." );
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
		// console.log('3. Starting to load unread ' + tab +  ' notifications ')
  		var loadUrl = obj.site_plugin_url + '/assets/img/icon/box.gif'; 
	 	// $( loader ).html("<img style='height:40px' src='"  + loadUrl +"' />");
		$.get( obj.site_plugin_url + "/views/calculate-notifications.php", { tab:tab } ) 
		.done(function( data ) {
			// console.log('3.1 Finished to load unread ' + tab +  ' notifications ');
		    $( content ).html(data);
		});    
  	}   

	//http://localhost/practice/wordpress/wp-content/plugins/umbrella-messaging-portal/
	function loadFreshdeskData () {
 
		// console.log("4.1 Start loading all freshdesk data..");
		$.get( obj.site_plugin_url + "/views/generate-freshdesk-local.php" )  
		
		.done(function( data ) {   
			// console.log("4.2 Finished fresh-desk data loaded and refresh content, unread notification and pagination..");
		   	startCheckingPagination();
	 		startCheckingContent();
			startCheckTotalNotifications();
			loadTotalUnreadNotificationsGeneral(); 
		});     
		 
  	}     
 
	// get the total notification unread in local server via session
	function loadTotalUnreadNotificationsGeneral() {   
		// console.log("11.1 Start unread notification, general notification");
		$.get( obj1.site_plugin_url_ext + "/views/get-total-notifications.php" ) 
		.done(function( data ) {    

			// set total notification to a session 
 			localStorage.setItem('umpNotificationUnreadTotal', data);

 			// update total notifications in ui
			 umpPutNotificationToUi(data); 

		});     
	}
	function umpPutNotificationToUi(totalUnreadNoti)
	{   
		   // console.log("total notifications " +  totalUnreadNoti);
		if(totalUnreadNoti > 0) { 
			// console.log("10.3 total unread notifications " + data);
			$('#ump-unread-notifications').html("("+totalUnreadNoti+")");
			$('#ump-unread-notifications').css('display','inline');  
		} else { 
			// console.log("10.3 no unread notifications " + data);
			$('#ump-unread-notifications').css('display','none');  
		}     
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

}( jQuery ));
  
function umpLoadContent(content_id, tab, page, div_id) {   
 	// query page content
 	// console.log("pagination clicked loader id " + content_id + "-loading");
	var loadUrl = obj.site_plugin_url + '/assets/img/icon/box.gif';
 // ump-content-bge-loading
 // ump-footer-um-loading
 	// $( content_id + '-loading' ).html("<span> Please Wait... </span>" +  "<img class='ump-footer-loader' src='"  + loadUrl +"' />");
 	$( content_id + "-loading" ).html("<center> <img class='ump-footer-loader' src='"  + loadUrl +"' />"+"<br><br> <span> Please Wait... </span><br><br></center>"  );
 
	$.get( obj.site_plugin_url + "/views/content.php", { tab: tab, page:page } ) 
	.done(function( data ) {
		$( content_id + '-loading' ).html("");
	    // console.log( " new tab content for " + content_id  +  " is loaded ... " );
	    $( content_id ).html(data);
	});      
	// set page button to selected
	for (var i = 0; i <100; i++) {
		$(div_id+'-'+i).attr('class','');
	}
	$(div_id+'-'+page).attr('class','active');
}