<?php
include "config/host.php";
$hostexp = explode ("/", $host);
if ($hostexp[0] == "boomlings.com" OR $hostexp[0] == "www.boomlings.com"){
$url = $host."/getAccountURL.php";
	$secret = "Wmfd2893gb7";
	$array = ["accountID" => $_POST['accountID'], "type" => 2, "secret" => $secret];
	$ch = curl_init ($url);
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt ($ch, CURLOPT_POSTFIELDS, $array);
	$response = curl_exec($ch);
	echo $response;
} else {
	$geturl = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
echo dirname($geturl);
	}