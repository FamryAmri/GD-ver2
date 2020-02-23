<?php
chdir (dirname(__FILE__));
include dirname (__FILE__)."/../lib/connection.php";
$url = $host."/uploadFriendRequest20.php";
$accountID = $_POST['accountID']; $to = $_POST['toAccountID'];
$gjp = $_POST['gjp']; $msg = $_POST['comment']; $secret = $_POST['secret'];
$array = ["accountID" => $accountID, "toAccountID" => $to, "gjp" => $gjp, "comment" => $msg, "secret" => $secret];
$function = array (CURLOPT_URL => $url, CURLOPT_RETURNTRANSFER => true, CURLOPT_POSTFIELDS => $array);
$ch = curl_init();
curl_setopt_array($ch, $function);
echo curl_exec($ch);