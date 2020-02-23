<?php
chdir (dirname(__FILE__));
include dirname(__FILE__)."/../lib/connection.php";
$url = $host."/deleteGJFriendRequests20.php";
$gjp = $_POST['gjp']; $accountID = $_POST['accountID']; $targetAccountID = $_POST['targetAccountID'];
$isSender = $_POST['isSender']; $secret = $_POST['secret'];
$array = ["gjp" => $gjp, "accountID" => $accountID, "targetAccountID" => $targetAccountID, "isSender" => $isSender, "secret" => $secret];
$function = array ( CURLOPT_URL => $url, CURLOPT_RETURNTRANSFER => true, CURLOPT_POSTFIELDS => $array);
$ch = curl_init();
curl_setopt_array ($ch, $function);
echo curl_exec($ch);