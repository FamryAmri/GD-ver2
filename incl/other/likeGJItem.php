<?php
chdir (dirname (__FILE__));
include dirname (__FILE__)."/../lib/connection.php";
$url = $host."/likeGJItem211.php";
$type = $_POST['type']; $secret = $_POST['secret'];
$array = ["type" => $type, "secret" => $secret];
$function = array ( CURLOPT_URL => $url, CURLOPT_RETURNTRANSFER => true, CURLOPT_POSTFIELDS => $array);
$ch = curl_init();
curl_setopt_array ($ch, $function);
echo curl_exec ($ch);