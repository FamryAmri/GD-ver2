<?php
chdir (dirname (__FILE__));
include "../lib/connection.php";
include dirname (__FILE__)."/../lib/connection.php";
$url = $host."/getGJLevelScores211.php";

$gjp = $_POST['gjp'];
$accountID = $_POST['accountID'];
$levelID = $_POST['levelID'];
$percent = $_POST['percent'];
$s1 = $_POST['s1'];
$s2 = $_POST['s9'];
$secret = $_POST['secret'];
$type = $_POST['type'];

$array =  ["gjp" => $gjp, "accountID" => $accountID, "levelID" => $levelID, "percent" => $percent, "s1" => $s1,
"s9" => $s9, "secret" => $secret, "type" => $type];

$function = array (
CURLOPT_RETURNTRANSFER => true,
CURLOPT_POSTFIELDS => $array);
$ch = curl_init ($url);
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

