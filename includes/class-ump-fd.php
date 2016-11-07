<?php  
namespace Ump; 

class Ump_Fd
{    

	function __construct() 
	{ 
		//
	}        

	public static function getUserTicketViaUserEmail($email) 
	{ 
		$curl = curl_init(); 
		curl_setopt_array($curl, array(
		  	CURLOPT_URL => "https://umbrellasupport.freshdesk.com/api/v2/tickets?email=" .$email,
		  	CURLOPT_RETURNTRANSFER => true,
		  	CURLOPT_ENCODING => "",
		  	CURLOPT_MAXREDIRS => 10,
		  	CURLOPT_TIMEOUT => 30,
		  	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  	CURLOPT_CUSTOMREQUEST => "GET",
		  	CURLOPT_POSTFIELDS => "-----011000010111000001101001\r\nContent-Disposition: form-data; name=\"username\"\r\n\r\ntest%40gmail.com\r\n-----011000010111000001101001\r\nContent-Disposition: form-data; name=\"password\"\r\n\r\n123\r\n-----011000010111000001101001\r\nContent-Disposition: form-data; name=\"oauth_consumer_key\"\r\n\r\n\r\n-----011000010111000001101001\r\nContent-Disposition: form-data; name=\"oauth_token\"\r\n\r\n\r\n-----011000010111000001101001\r\nContent-Disposition: form-data; name=\"oauth_signature_method\"\r\n\r\nHMAC-SHA1\r\n-----011000010111000001101001\r\nContent-Disposition: form-data; name=\"oauth_timestamp\"\r\n\r\n1456467588\r\n-----011000010111000001101001\r\nContent-Disposition: form-data; name=\"oauth_nonce\"\r\n\r\nCtXCCA\r\n-----011000010111000001101001\r\nContent-Disposition: form-data; name=\"oauth_version\"\r\n\r\n1.0\r\n-----011000010111000001101001\r\nContent-Disposition: form-data; name=\"oauth_signature\"\r\n\r\nr0qNzqTLgbnoEu1Wlyx+H6hVr9Q=\r\n-----011000010111000001101001--",
		  		CURLOPT_HTTPHEADER => array(
		    	"authorization: Basic ZW5xdWlyaWVzQHVtYnJlbGxhc3VwcG9ydC5jby51azp1bWJyZWxsYTIwMTY=",
		    	"cache-control: no-cache",
		    	"content-type: multipart/form-data; boundary=---011000010111000001101001",
		    	"postman-token: 95229610-ea91-6f37-fd8f-cb2395ec0ea3"
		  	),
		)); 
		$response = curl_exec($curl);
		$err = curl_error($curl); 
		curl_close($curl); 
		if ($err) {
		  	echo "cURL Error #:" . $err;
		} else {
		  	return $response;
		}
	}     

	public static function getUserPersonalInfo($email) 
	{ 
		//
	} 

	public static function replyTicken() 
	{ 
		//
	}  	

	public static function getUserRequestThread() 
	{
		//
	}
}