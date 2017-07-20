<?php  
namespace Ump; 

class UmpFd
{
	private static $username = 'enquiries@umbrellasupport.co.uk'; 
	private static $password = 'umbrella2016'; 
	private static $yourdomain = 'umbrellasupport';
	private static $api_key = 'kik6ZsxS1Zpc8VnTaX7';
	function __construct($password='umbrella2016', $username='enquiries@umbrellasupport.co.uk', $api_key='kik6ZsxS1Zpc8VnTaX7', $yourdomain='umbrellasupport') 
	{  
		self::$api_key 		= $api_key;
		self::$password 	= $password; 
		self::$yourdomain 	= $yourdomain;
		self::$username 	= $username; 
	}

	/**
	 * @param $filterName
	 * @param $filterVal
	 * @return array|mixed|object|string|void
	 * sample queries:
	 * 1. https://umbrellasupport.freshdesk.com/api/v2/tickets?email=mrjesuserwinsuarez@gmail.com&order_by=created_at&order_type=asc&per_page=1&page=1
	 */
	public static function fetchTickets($filterName, $filterVal,$per_page=20, $page=1)
	{
		// custom_fields.catergory
		// print "username " . self::$username;
		// Return the tickets that are new or opend & assigned to you
		// If you want to fetch all tickets remove the filter query param
		$url = "https://".self::getDomain().".freshdesk.com/api/v2/tickets?$filterName=$filterVal&per_page=$per_page&page=$page";
		// print "url " . $url ;
		$ch = curl_init($url); 

		curl_setopt($ch, CURLOPT_HEADER, true);
		curl_setopt($ch, CURLOPT_USERPWD, self::getUsername().":".self::getPassword());
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$server_output = curl_exec($ch);
		$info = curl_getinfo($ch);
		$header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
		$headers = substr($server_output, 0, $header_size);
		$response = substr($server_output, $header_size);

		if($info['http_code'] == 200) {
		  return json_decode($response, true);
		} else {
		  if($info['http_code'] == 404) {
		    return;
		  } else {
		    return $response;
		  }
		} 
		curl_close($ch); 
	}




	public static function fetchTicketsWithConversation(){

	}
	public static function getSpecificTicket($ticketId) { 
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => "https://umbrellasupport.freshdesk.com/api/v2/tickets/$ticketId",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET", 
		  CURLOPT_HTTPHEADER => array(
		    "authorization: Basic ZW5xdWlyaWVzQHVtYnJlbGxhc3VwcG9ydC5jby51azp1bWJyZWxsYTIwMTY=",
		    "cache-control: no-cache",
		    "content-type: application/json",
		    "postman-token: d65d1f28-e2e2-e7ea-cc1c-e5868cd151e9"
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		  echo "cURL Error #:" . $err;
		} else {
		  // echo $response;
		  // 
		  return json_decode($response, true);
		}
	}

	/**
	 * @param $ticketId
	 * @return mixed|void
	 * [
	{
	"body": "<div dir=\"ltr\" style='font-size: 13px; font-family: \"Helvetica Neue\", Helvetica, Arial, sans-serif;'>\n<div></div>\n<div>\n<div>fsfdfsdfsdf</div>\n<div dir=\"ltr\">\r\n</div>\n</div>\r\n</div>\r\n                \r\n              ",
	"body_text": "fsfdfsdfsdf",
	"id": 19004667189,
	"incoming": false,
	"private": false,
	"user_id": 19001031521,
	"support_email": "support@umbrellasupport.freshdesk.com",
	"source": 0,
	"ticket_id": 152,
	"to_emails": [
	"jellyandicecream@umbrellapartner.co.uk"
	],
	"from_email": "\"Richard Howard\" <support@umbrellasupport.freshdesk.com>",
	"cc_emails": [],
	"bcc_emails": [],
	"created_at": "2016-12-02T18:30:02Z",
	"updated_at": "2016-12-02T18:30:02Z",
	"attachments": []
	}
	]

	 */
	public static function getUserTicketReplies($ticketId) 
	{ 

		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => "https://umbrellasupport.freshdesk.com/api/v2/tickets/".$ticketId."/conversations",
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
		    "postman-token: 4ff9cb7e-6b43-5652-cdf4-22ed53d131dd"
		  ),
		)); 
		$response = curl_exec($curl);
		$err = curl_error($curl); 
		curl_close($curl); 
		if ($err) {
		  // echo "cURL Error #:" . $err;
		  return;
		} else {
		  // echo $response;
		  return json_decode($response, true);
		}
	}
	/**
	 * [replyTicket description]
	 * @param  [type] $ticketId [description]
	 * @param  array  $content  [description]
	 * @return [type]           [description]
	 * // Reply will be added to the ticket with the following id
	 * $ticket_id = 57; 
	 * $replyPayload = array(
	 * 'body' => 'This is a sample reply',
	 * 'attachments[]' =>  curl_file_create("data/x.png")
	 * ); 
	 */
	public static function replyTicket($ticketId, $replyPayload=array()) 
	{

		// $ticket_id = 7;
		$usr = self::getUsername();
		$pwd = self::getPassword();
		$domain = self::getDomain();
		 
		$url = "https://" .self::getDomain(). ".freshdesk.com/api/v2/tickets/$ticketId/reply";

		$ch = curl_init($url);

		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HEADER, true);
		curl_setopt($ch, CURLOPT_USERPWD,  self::getUsername() . ":" . self::getPassword());
		curl_setopt($ch, CURLOPT_POSTFIELDS, $replyPayload);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$server_output = curl_exec($ch);
		$info = curl_getinfo($ch);
		$header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
		$headers = substr($server_output, 0, $header_size);
		$response = substr($server_output, $header_size);

		if($info['http_code'] == 201) {

			return false;
		} else {
		    if($info['http_code'] == 404) {
				return false;
		    } else {
				return true;
		  }
		}

		curl_close($ch);
	}
	public static function getAgentInfoByEmail($email) {

		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://umbrellasupport.freshdesk.com/api/v2/agents?email=" . $email,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_HTTPHEADER => array(
					"authorization: Basic ZW5xdWlyaWVzQHVtYnJlbGxhc3VwcG9ydC5jby51azp1bWJyZWxsYTIwMTY=",
					"cache-control: no-cache",
					"content-type: application/json",
					"postman-token: 10f62e54-b9d1-c084-8d8d-6ff1a88c90ce"
			),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
		if ($err) {
			return false;
			// echo "cURL Error #:" . $err;
		} else {
			$response = json_decode($response, true);
			// print_r($response);
			return (count($response) > 0) ? $response : false;
			// echo $response;
		}
	}
	public static function getLatestReply($response) {

		return $response[count($response)-1];

	}
	private static function getPassword() 
	{ 

		return self::$password; 	 
	}
	private static function getUsername() 
	{

		return self::$username;
	}
	private static function getDomain() 
	{

		return self::$yourdomain;
	}
	private static function getApiKey()
	{

		return self::$api_key;
	}
}