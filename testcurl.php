<?php 
$url = 'http://pentogram.tw1.su/';
$ch = curl_init(); 
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_TIMEOUT, 10);
$page = curl_exec ($ch);
curl_close($ch); 
echo $page; 
?>
