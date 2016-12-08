<?php 

namespace App;

 /**
  * This is Imap codes
  * @src https://davidwalsh.name/gmail-php-imap   
  */ 
 
	class UMP_IMAP {
		private $hostname = '{imap.1and1.co.uk:993/imap/ssl}INBOX';
		private $username = '*@umbrellapartner.co.uk';
		private $password = 'umbrella2016';
		private $email = 'anything@umbrellapartner.co.uk'; 
 
		function __construct($email) 
		{ 
			$this->email = $email;
		}

		private function open()
		{
			/* try to connect */
			return imap_open($this->hostname,$this->username,$this->password) or die('Cannot connect to Gmail: ' . imap_last_error());

		}

		private function getInboxType($inbox, $type='ALL') 
		{
			/* grab emails */
			return imap_search($inbox, $type);
		}


		public function getMailTotalEmail()
		{
			$inbox = imap_open($this->hostname,$this->username,$this->password) or die('Cannot connect to Gmail: ' . imap_last_error()); 
			$emails = imap_search($inbox, 'TO "'.$this->email.'"');  
			$this->close($inbox); 
			return count($emails); 


		}
		/** 
		 *  @return all to emails from inbox, limit 300       
		 */ 
		public function getMailInboxEmails()
		{    
			/* begin output var */
			$output = '';
			$content = [];
			$counter = 0; 

			$inbox = imap_open($this->hostname,$this->username,$this->password) or die('Cannot connect to Gmail: ' . imap_last_error());//$this->open(); 
			$emails = imap_search($inbox, 'TO "'.$this->email.'"'); //$this->getInboxType($inbox, 'ALL');

			// print "success";
			// print_r( $emails );



			/* if emails are returned, cycle through each... */
			if($emails) { 

				/* put the newest emails on top */
				rsort($emails);
				 
				/* for every email... */
				foreach($emails as $email_number) { 
					/* get information specific to this email */
					$overview = imap_fetch_overview($inbox,$email_number,0);
					$message  = imap_fetchbody($inbox,$email_number,2);
				    $to       = $overview[0]->to;  
					// print $overview[0]->to . '<br>';   
					// 
					// if($this->email ==  $to) {
						$content['email']['to'][] = $to; 
						$content['email']['from'][] = $overview[0]->from;  
					    $counter++; 
					// }
					// 	$counter1++;
					// } else {
					// 	$counter2++;
					// }
					/* output the email header information */
					// $output.= '<div class="toggler '.($overview[0]->seen ? 'read' : 'unread').'">';
					// $output.= '<span class="subject">'.$overview[0]->subject.'</span> ';
					// $output.= '<span class="from">'.$overview[0]->from.'</span>';
					// $output.= '<span class="from">'.$overview[0]->to.'</span>';
					// $output.= '<span class="date">on '.$overview[0]->date.'</span>';
					// $output.= '</div>'; 
					/* output the email body */
					// $output.= '<div class="body">'.$message.'</div>';
				}  

				$content['email']['total'] = $counter;  
				// echo " my email = " . $counter1;
				// echo " not my current email = " . $counter2;
			}  
			$this->close($inbox); 
 
			return $content; 
		}   

		private function close($inbox)
		{
			/* close the connection */
			imap_close($inbox);
		}
	}
?>