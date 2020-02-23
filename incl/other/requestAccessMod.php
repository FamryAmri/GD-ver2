<?php
chdir (dirname (__FILE__));
include dirname (__FILE__)."/../lib/connection.php";
$url = $host."/requestUserAccess.php";
$gjp = $_POST['gjp'];
$accountID = $_POST['accountID'];
$secret = $_POST['secret'];
$array = ["accountID" => $accountID, "secret" => $secret, "gjp" => $gjp];
$function = array ( CURLOPT_URL => $url, CURLOPT_RETURNTRANSFER => true, CURLOPT_POSTFIELDS => $array);
$ch = curl_init();
curl_setopt_array ($ch, $function);
echo curl_exec ($ch);