<?php
chdir (dirname(__FILE__));
include dirname(__FILE__)."/../lib/connection.php";
$url = $host."/getGJFriendRequests20.php";
$getSent = $_POST['getSent']; $accountID = $_POST['accountID']; $page = $_POST['page'];
$gjp = $_POST['gjp']; $secret = $_POST['secret'];
$array = ["getSent" => $getSent, "accountID" => $accountID, "page" => $page, "gjp" => $gjp, "secret" => $secret];
$function = array ( CURLOPT_URL => $url, CURLOPT_RETURNTRANSFER => true, CURLOPT_POSTFIELDS => $array);
$ch = curl_init();
curl_setopt_array ($ch, $function);
echo curl_exec($ch);