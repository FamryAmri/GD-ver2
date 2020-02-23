<?php
chdir(dirname (__FILE__));
include dirname(__FILE__)."/../lib/connection.php";

$url = $host."/uploadGJAccComment20.php";

$userName = $_POST['userName'];
$gjp = $_POST['gjp'];
$secret = $_POST['secret'];
$comment = $_POST['comment'];
$accountID = $_POST['accountID'];

$array = [
"userName" => $userName,
"gjp" => $gjp,
"secret" => $secret,
"comment" => $comment,
"accountID" => $accountID];

$function = array (
CURLOPT_URL => $url,
CURLOPT_RETURNTRANSFER => true,
CURLOPT_POSTFIELDS => $array);

$ch = curl_init();
curl_setopt_array ($ch, $function);
$response = curl_exec ($ch);
if (!empty ($response)){
	echo $response;
	} elseif (empty ($host)){
		$server = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		exit ("<b>Error</b>: You just not setup at ".dirname($server)."/config/host.php");
		} else {
		echo "<b>Error</b>: You are currently <b style='color:red'>OFFLINE</b>!";
		}