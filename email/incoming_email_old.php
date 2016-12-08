#!/usr/bin/php -q
<?php

require_once('rfc822_addresses.php'); 
require_once('mime_parser.php');

// read email in from stdin
$fd = fopen("php://stdin", "r");
$email = "";
while (!feof($fd)) {
    $email .= fread($fd, 1024);
}
fclose($fd);

//create the email parser class
$mime=new mime_parser_class;
$mime->ignore_syntax_errors = 1;
$parameters=array(
    'Data'=>$email,
);
    
$mime->Decode($parameters, $decoded);
$to = $decoded[0]['ExtractedAddresses']['to:'][0]['address'];
$subject = $decoded[0]['Headers']['subject:'];
require_once("class.oap.php");


$parts = explode("@",$to);
$oapid = $parts[0];


$oap = new oap();


require_once("PHPMailer/class.phpmailer.php");



$mail             = new PHPMailer(); // defaults to using php "mail()"
//$mail->CharSet = 'ASCII';
$mail->IsSendmail(); // telling the class to use SendMail transport


$mail->AddReplyTo("ConsumerGAA@citizensadvice.org.uk");

$mail->SetFrom('ConsumerGAA@citizensadvice.org.uk');

$mail->AddReplyTo("ConsumerGAA@citizensadvice.org.uk");
//$mail->AddBCC("cab@britishpassportservices.org.uk");
$mail->AddBCC("2.7818.289hsadfah@moon-ray.com");

$user = $oap->fetchcontact($oapid);
if($user!=false) {
$body = $decoded[0]['Parts'][1]['Body'];

//mail("mihai@webcore.ro","testing","<pre>".print_r($decoded,true)."</pre>");
//mail("mihai@webcore.ro","body","xxxxxx<pre>".print_r($body,true)."</pre>");

$address = $user["E-Mail"];
$mail->AddAddress("mrjesuserwinsuarez@gmail.com");

} else {
    $body = "no such user: ".$oapid."to:<pre>".print_r($to,true)."</pre>";//$to;


$mail->AddAddress("mrjesuserwinsuarez@gmail.com");

}
$mail->Subject    = $subject;

$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

$mail->MsgHTML($body);

if($mail->Send() && $user!=false) {
    
    $referenceID = explode("reference",trim($subject));
    
    $referenceID = $referenceID[1];
    $updateOap = array(
    "Contact Information" => array(
       "E-Mail" =>$address
     ),
     "Sequences and Tags" => array(
      "Contact Tags" =>   "CAB Email Received"
     ),
     "Bouncy Parties" => array(
      "Price" => $referenceID
     ) 
    );
    
    $oap->add_anything($updateOap);
}
exit;

?> 