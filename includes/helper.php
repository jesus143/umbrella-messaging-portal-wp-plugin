<?php 
// create helper function for page getter  
function ump_get_current_page(){
	$http_host = explode('/',$_SERVER['REQUEST_URI']);   
	return $http_host[4];
} 
function ump_get_start_start() {
	//
	return 0;
} 
function ump_get_end_limit() {
	// 
	return 5;
}