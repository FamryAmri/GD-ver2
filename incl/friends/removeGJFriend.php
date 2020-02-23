<?php
chdir (dirname(__FILE__));
include dirname (__FILE__)."/../lib/connection.php";
$url = $host."/removeGJFriend20.php";
$accountID = $_POST['accountID']; $gjp = $_POST['gjp'];
$targetAccountID = $_POST['targetAccountID']; $secret = $_POST['secret'];
$array = ["accountID" => $accountID, "gjp" => $gjp, "targetAccountID" => $targetAccountID, "secret" => $secret];
$function = array ( CURLOPT_URL => $url, CURLOPT_RETURNTRANSFER => true, CURLOPT_POSTFIELDS => $array);
$ch = curl_init();
curl_setopt_array ($ch, $function);
echo curl_exec($ch);
