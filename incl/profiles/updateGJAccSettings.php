<?php
chdir(dirname(__FILE__));
include dirname(__FILE__)."/../lib/connection.php";

$ms = $_POST['mS'];
$frS = $_POST['frS'];
$cS = $_POST['cS'];
$gjp = $_POST['gjp'];
$ID = $_POST['accountID'];
$YT = $_POST['yt'];
$twitter = $_POST['twitter'];
$twitch = $_POST['twitch'];
$secret = $_POST['secret'];

$array = [
"gjp" => $gjp,
"accountID" => $ID,
"secret" => $secret,
"twitter" => $twitter,
"twitch" => $twitch,
"yt" => $YT,
"cS" => $cS,
"frS" => $frS,
"mS" => $mS];

$url = $host."/updateGJAccSettings20.php";

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $array);
$response = curl_exec($ch);
if (!empty ($response)){
	echo $response;
	} elseif (empty ($host)){
		$server = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		exit ("<b>Error</b>: You just not setup at ".dirname($server)."/config/host.php");
		} else {
		echo "<b>Error</b>: You are currently <b style='color:red'>OFFLINE</b>!";
		}