<?php      
print "<pre>";
print "<br> array <br>";
$array =  array('test'=>'1', '2', '3', '4'=> array('1','2','3'=> array('1' => 'amazing twinnsss'))); 
print_r($array);

print "<br> serialize<br>";
$array = serialize($array);   
print_r($array);

print "<br> un serialize<br>";

$array = unserialize($array);   
print_r($array);


print "<br> un serialize print string =<br>"; 
$array = unserialize('a:4:{s:4:"test";s:1:"1";i:0;s:1:"2";i:1;s:1:"3";i:4;a:3:{i:0;s:1:"1";i:1;s:1:"2";i:3;a:1:{i:1;s:16:"amazing twinnsss";}}}'); 
print_r($array);