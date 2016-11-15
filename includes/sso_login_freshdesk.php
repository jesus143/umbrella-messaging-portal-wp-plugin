<?php
define('FRESHDESK_SHARED_SECRET','kik6ZsxS1Zpc8VnTaX7');
define('FRESHDESK_BASE_URL','http://umbrellasupport.freshdesk.com/');	//With Trailing slashes
// https://umbrellasupport.freshdesk.com/helpdesk
function getSSOUrl($strName, $strEmail) {
	$timestamp = time();
	$to_be_hashed = $strName . FRESHDESK_SHARED_SECRET . $strEmail . $timestamp;
	$hash = hash_hmac('md5', $to_be_hashed, FRESHDESK_SHARED_SECRET);
	return FRESHDESK_BASE_URL."login/sso/?name=".urlencode($strName)."&email=".urlencode($strEmail)."&timestamp=".$timestamp."&hash=".$hash;
}

header("Location: ".getSSOUrl("User's Name","username@thecompany.com"));