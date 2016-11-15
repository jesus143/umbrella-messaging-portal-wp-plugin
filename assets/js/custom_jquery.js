/**
 * Reminder we need to set the query to api 1 time every 5 mins    
 * You should be update the freshdesk status every 5 mins
 */  

obj = new Object(); 
if (location.hostname === "localhost" || location.hostname === "127.0.0.1") {
	obj.site_plugin_url = 'http://localhost/practice/wordpress/wp-content/plugins/umbrella-messaging-portal';  
    //alert("It's a local server!");
} else {
	obj.site_plugin_url = 'http://testing.umbrellasupport.co.uk/wp-content/plugins/umbrella-messaging-portal';  
}






(function ( $ ) { 
	$.fn.loadNotificationPagination = function( tab_footer_content, tab_name) {
  		var loadUrl = obj.site_plugin_url + '/assets/img/icon/box.gif'; 
	 	$( tab_footer_content ).html("<img class='ump-footer-loader' src='"  + loadUrl +"' />");
		$.get( obj.site_plugin_url + "/views/pagination.php", { tab: tab_name } ) 
		.done(function( data ) {
		    console.log( "Data Loaded: " + data );
		    $( tab_footer_content ).html(data);
		});    
  	} 
 	setTimeout(function(){  
 		$.fn.loadNotificationPagination('#ump-footer-bge', 'Business Growth Executed');
	  	$.fn.loadNotificationPagination('#ump-footer-um', 'Umbrella Messages');
	  	$.fn.loadNotificationPagination('#ump-footer-up', 'Umbrella Portners'); 
	}, 2000);  

}( jQuery ));
/**
 * Get content of each tab
 * @param  {[type]} ){ console.log("contact jquery loaded!..."); $.fn.functionName [description]
 * @return {[type]}     [description]
 */
(function ( $ ) { 

	// console.log("contact jquery loaded!...");      

	$.fn.loadContent = function(content, tab, page){
  		var loadUrl = obj.site_plugin_url + '/assets/img/icon/box.gif'; 
	 	$( content ).html("<img src='"  + loadUrl +"' />");
		$.get( obj.site_plugin_url + "/views/content.php", { tab:tab, page:page } ) 
		.done(function( data ) {    
			 // console.log(data); 
			 var totalNoti = data.split('<totalTickets>')[1]; 
			 var isLoaded = data.split('<loaded>')[1];  
			 console.log(" total noti " + totalNoti + " loaded " + isLoaded);
			 // If total notification result is 
			 if( totalNoti < 1 &&  isLoaded == 'yes') {
			 	 // $.fn.startCheckTotalNotifications();
			 	 // $.fn.loadContent(); 
			 	 console.log("session data is loaded but you don't have ticket to display"); 
			 }  else if (totalNoti < 1 && isLoaded == '') {
			 	// reload again if the session is failed to load
			 	console.log(" session data is not loaded, then load again"); 
			 	$.fn.startCheckTotalNotifications();
			  	$.fn.loadContent(); 
			 } else {
			 	console.log(" ticket are successfully loaded");
			 }
			 // console.log("total tickets index none " + TotalMessage); 
			 // console.log("total tickets index 0 " +TotalMessage[0]); 
			 // console.log("total tickets index 1 " +TotalMessage[1]);  
			 // if empty then call back again notification and content
			 // $.fn.startCheckTotalNotifications()
			 // $.fn.loadContent 
		    // console.log( "Data Loaded: " + data );
		    $( content ).html(data);
		});    
  	}  

  	// load tab
	 setTimeout(function(){  
 		$.fn.loadContent( '#ump-content-bge', 'Business Growth Executed', 1);  
	}, 2000);
  	 
	// menu click in bussiness growth executive
	$('#ump-menu-bge').on('click', function(){
		$.fn.loadContent( '#ump-content-bge', 'Business Growth Executed', 1); 
	});

	//menu click in bussiness growth executive
	$('#ump-menu-um').on('click', function(){
		$.fn.loadContent( '#ump-content-um', 'Umbrella Messages', 1); 
	}); 

	// menu click in bussiness growth executive
	$('#ump-menu-up').on('click', function(){
		$.fn.loadContent( '#ump-content-up', 'Umbrella Portners', 1); 
	});  
  
	// generate the total unread notifications and check notification every 5 mins 
	// query total notifications now
	$.fn.loadTotalUnreadNotifications = function(content, loader, tab){
  		var loadUrl = obj.site_plugin_url + '/assets/img/icon/box.gif'; 
	 	// $( loader ).html("<img style='height:40px' src='"  + loadUrl +"' />");
		$.get( obj.site_plugin_url + "/views/calculate-notifications.php", { tab:tab } ) 
		.done(function( data ) {
			console.log("loadTotalUnreadNotifications() loaded");
		    // console.log( "Data Loaded: " + data ); 
		    $( content ).html(data);
		    // $( loader ).html('');
		});    
  	}   
 	
 	// start checking and getting the total notifications
  	$.fn.startCheckTotalNotifications = function() { 
	  	// load notification in bge
		setTimeout(function(){  
			$.fn.loadTotalUnreadNotifications('#ump-menu-badge-bge', '#ump-menu-loader-bge', 'Business Growth Executed');
		}, 2000);

		// load notification in um
		setTimeout(function(){  
			$.fn.loadTotalUnreadNotifications('#ump-menu-badge-um', '#ump-menu-loader-um', 'Umbrella Messages');
		}, 2000);

		// load notification in up
		setTimeout(function(){  
			$.fn.loadTotalUnreadNotifications('#ump-menu-badge-up', '#ump-menu-loader-up', 'Umbrella Portners'); 
		}, 2000);
	} 

	// initlized and auto load notifications when page is loaded
	$.fn.startCheckTotalNotifications();

	//check notifications and update in realtime every 30 seconds
	setInterval(function(){ 
		$.fn.startCheckTotalNotifications();
	 }, 60000);  
  
	// load freshdesk data in every 5mins 
	setTimeout(function(){  
		console.log("loading data from freshdesk..");
		$.fn.loadFreshdeskData(); 
	}, 10000);
	// $.fn.loadFreshdeskData(); 
 
 	//http://localhost/practice/wordpress/wp-content/plugins/umbrella-messaging-portal/
	$.fn.loadFreshdeskData = function(){  
		$.get( obj.site_plugin_url + "/views/generate-freshdesk-local.php" ) 
		.done(function( data ) {  
			console.log("finish generating freshdesk data"); 
			console.log( data );
		});     
		// console.log("finish generating freshdesk data"); 
  	}     
	setInterval(function(){
		$.fn.loadFreshdeskData(); 
	}, 300000)
}( jQuery ));
  
function umpLoadContent(content_id, tab, page, div_id) {   
 	// query page content
	var loadUrl = obj.site_plugin_url + '/assets/img/icon/box.gif'; 
 	$( content_id ).html("<img src='"  + loadUrl +"' />");
	$.get( obj.site_plugin_url + "/views/content.php", { tab: tab, page:page } ) 
	.done(function( data ) {
	    console.log( "Data Loaded: " + data );
	    $( content_id ).html(data);
	});      
	// set page button to selected
	for (var i = 0; i <100; i++) {
		$(div_id+'-'+i).attr('class','');
	}
	$(div_id+'-'+page).attr('class','active');
}