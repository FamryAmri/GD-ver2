<?php
chdir(dirname(__FILE__));
include dirname(__FILE__)."/../lib/connection.php";

$accountID = $_POST['accountID'];
$type = $_POST['type'];
$secret = $_POST['secret'];

$array = [
"accountID" => $accountID,
"type" => $type,
"secret" => $secret];

$url = $host."/getGJCreators19.php";
$functions = array (
CURLOPT_RETURNTRANSFER => true,
CURLOPT_POSTFIELDS => $array);

$ch = curl_init($url);
curl_setopt_array ($ch, $functions);
$response = curl_exec($ch);
if (!empty ($response)){
	echo $response;
	} elseif (empty ($host)){
		$server = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		exit ("<b>Error</b>: You just not setup at ".dirname($server)."/config/host.php");
		} else {
		echo "<b>Error</b>: You are currently <b style='color:red'>OFFLINE</b>!";
		}