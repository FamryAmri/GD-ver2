<?php
chdir (dirname(__FILE__));
include dirname(__FILE__)."/../lib/connection.php";
$url = $host."/acceptGJFriendRequest20.php";
$gjp = $_POST['gjp']; $accountID = $_POST['accountID'];
$reqID = $_POST['requestID']; $secret = $_POST['secret'];
$array = ["gjp" => $gjp, "requestID" => $reqID, "accountID" => $accountID, "secret" => $secret];
$function = array ( CURLOPT_URL => $url, CURLOPT_RETURNTRANSFER => true, CURLOPT_POSTFIELDS => $array);
$ch = curl_init();
curl_setopt_array ($ch, $function);
echo curl_exec($ch);