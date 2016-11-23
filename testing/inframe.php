<!DOCTYPE html>
<html>
<head>
	<title> This is to get an iframe and append a css </title>  
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<<style type="text/css" media="screen">
		.p-content 
		{
			border:1px solid red;
		}
		
	</style>

	<script>
		$(document).ready(function(){ 
			$('#IFrame').ready(function() { 
 
 			 	setTimeout(function() { 
				    var $head = $('#IFrame').contents().find("head");                
				    $head.append($("<link/>", 
				        { rel: "stylesheet", href: 'http://localhost/practice/wordpress/testing/style.css', type: "text/css" }
				    ));           
				    $('#IFrame').contents().find('p').css('border','1px solid red'); 
				}, 1000); 
			})
			console.log("loaded...");  
		});
	</script>  


	<<style type="text/css" media="screen">
			#IFrame html body div p {
				color:red !important;
			}
	</style>
</head>
<body> 
	<iframe scrolling="no" style="width:60%;height:407px;"  id='IFrame' src="https://www.example.com/"> </iframe>
</body>
</html>