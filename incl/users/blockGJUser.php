<?php
chdir (dirname(__FILE__));
include dirname (__FILE__)."/../lib/connection.php";
$url = $host."/blockGJUser20.php";
$accountID = $_POST['accountID']; $to = $_POST['targetAccountID'];
$gjp = $_POST['gjp']; $secret = $_POST['secret'];
$array = ["accountID" => $accountID, "targetAccountID" => $to, "gjp" => $gjp, "secret" => $secret];
$function = array (CURLOPT_URL => $url, CURLOPT_RETURNTRANSFER => true, CURLOPT_POSTFIELDS => $array);
$ch = curl_init();
curl_setopt_array($ch, $function);
echo curl_exec($ch);