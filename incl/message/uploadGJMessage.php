<?php
chdir(dirname(__FILE__));
include dirname (__FILE__)."/../lib/connection.php";
$url = $host."/uploadGJMessage20.php";
$gjp = $_POST['gjp']; $gameVersion = $_POST['gameVersion']; $binaryVersion = $_POST['binaryVersion'];
$secret = $_POST['secret']; $subject = $_POST['subject']; $from = $_POST['accountID']; $to = $_POST['toAccountID'];
$body = $_POST['body'];
$array = ["gjp" => $gjp, "gameVersion" => $gameVersion, "binaryVersion" => $binaryVersion, "secret" => $secret,
"subject" => $subject, "accountID" => $from, "toAccountID" => $to, "body" => $body];
$function = array (
CURLOPT_URL => $url,
CURLOPT_RETURNTRANSFER => true,
CURLOPT_POSTFIELDS => $array);
$ch = curl_init();
curl_setopt_array ($ch, $function);
$response = curl_exec($ch);
if (!empty ($response)){
	echo $response;
	} elseif (empty ($host)){
		$server = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		exit ("<b>Error</b>: You just not setup at ".dirname($server)."/config/host.php");
		} else {
		echo "<b>Error</b>: You are currently <b style='color:red'>OFFLINE</b>!";
		}
		?>