/**
 * Reminder we need to set the query to api 1 time every 5 mins    
 * You should be update the freshdesk status every 5 mins
 */  

obj = new Object(); 
obj.site_plugin_url = 'http://localhost/practice/wordpress/wp-content/plugins/umbrella-messaging-portal';  
$(document).ready(function(){   

	$.fn.loadNotificationPagination = function( tab_footer_content, tab_name) {
  		var loadUrl = obj.site_plugin_url + '/assets/img/icon/box.gif'; 
	 	$( tab_footer_content ).html("<img class='ump-footer-loader' src='"  + loadUrl +"' />");
		$.get( obj.site_plugin_url + "/views/pagination.php", { tab: tab_name } ) 
		.done(function( data ) {
		    console.log( "Data Loaded: " + data );
		    $( tab_footer_content ).html(data);
		});    
  	} 

  	$.fn.loadNotificationPagination('#ump-footer-bge', 'Business Growth Executed');
  	$.fn.loadNotificationPagination('#ump-footer-um', 'Umbrella Messages');
  	$.fn.loadNotificationPagination('#ump-footer-up', 'Umbrella Portners'); 
})
/**
 * Get content of each tab
 * @param  {[type]} ){ console.log("contact jquery loaded!..."); $.fn.functionName [description]
 * @return {[type]}     [description]
 */
$(document).ready(function(){    
	console.log("contact jquery loaded!...");       
	$.fn.loadContent = function(content, tab, page){
  		var loadUrl = obj.site_plugin_url + '/assets/img/icon/box.gif'; 
	 	$( content ).html("<img src='"  + loadUrl +"' />");
		$.get( obj.site_plugin_url + "/views/content.php", { tab:tab, page:page } ) 
		.done(function( data ) {
		    console.log( "Data Loaded: " + data );
		    $( content 	 ).html(data);
		});    
  	} 

  	// load tab
	 setTimeout(function(){  
 		$.fn.loadContent( '#ump-content-bge', 'Business Growth Executed', 1);  
	}, 1000);
  	

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
});




// generate the total unread notifications and check notification every 5 mins
$(function(){

	// query total notifications now
	$.fn.loadTotalUnreadNotifications = function(content, loader, tab){
  		var loadUrl = obj.site_plugin_url + '/assets/img/icon/box.gif'; 
	 	// $( loader ).html("<img style='height:40px' src='"  + loadUrl +"' />");
		$.get( obj.site_plugin_url + "/views/calculate-notifications.php", { tab:tab } ) 
		.done(function( data ) {
		    console.log( "Data Loaded: " + data ); 
		    $( content ).html(data);
		    // $( loader ).html('');
		});    
  	}   
 	
 	// start checking and getting the total notifications
  	$.fn.startCheckTotalNotifications = function() { 
	  	// load notification in bge
		setTimeout(function(){  
			$.fn.loadTotalUnreadNotifications('#ump-menu-badge-bge', '#ump-menu-loader-bge', 'Business Growth Executed');
		}, 1000);

		// load notification in um
		setTimeout(function(){  
			$.fn.loadTotalUnreadNotifications('#ump-menu-badge-um', '#ump-menu-loader-um', 'Umbrella Messages');
		}, 2000);

		// load notification in up
		setTimeout(function(){  
			$.fn.loadTotalUnreadNotifications('#ump-menu-badge-up', '#ump-menu-loader-up', 'Umbrella Portners'); 
		}, 3000);
	} 

	// initlized and auto load notifications when page is loaded
	$.fn.startCheckTotalNotifications();

	// check notifications and update in realtime every 30 seconds
	// setInterval(function(){ 
	// 	$.fn.startCheckTotalNotifications();
	//  }, 300000);  
});
 

function umpLoadContent(content_id, tab, page, div_id) {   
 	// query page content
	var loadUrl = obj.site_plugin_url + '/assets/img/icon/box.gif'; 
 	$( content_id ).html("<img src='"  + loadUrl +"' />");
	$.get( obj.site_plugin_url + "/views/content.php", { tab: tab, page:page } ) 
	.done(function( data ) {
	    console.log( "Data Loaded: " + data );
	    $( content_id 	 ).html(data);
	});     

	// set page button to selected
	for (var i = 0; i <100; i++) {
		$(div_id+'-'+i).attr('class','');
	}
	$(div_id+'-'+page).attr('class','active');
}

