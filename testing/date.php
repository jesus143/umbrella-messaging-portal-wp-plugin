<?php 



$date  = '2016-11-18T12:00:45Z';  
$date = str_replace('Z', '', $date); 
$date = explode('T', $date); 
$d = $date[0];
$t = $date[1];

print "date $d time $t";
