<?php
chdir (dirname(__FILE__));
include dirname(__FILE__)."/../lib/connection.php";
$url = $host."/readGJFriendRequest20.php";
$accountID = $_POST['accountID']; $gjp = $_POST['gjp']; $reqID = $_POST['requestID'];
$secret = $_POST['secret'];
$array = ["accountID" => $accountID, "gjp" => $gjp, "requestID" => $reqID, "secret" => $secret];
$function = array ( CURLOPT_URL => $url, CURLOPT_RETURNTRANSFER => true, CURLOPT_POSTFIELDS => $array);
$ch = curl_init();
curl_setopt_array ($ch, $function);
echo curl_exec($ch);