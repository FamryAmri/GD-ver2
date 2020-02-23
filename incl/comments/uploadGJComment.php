<?php
chdir (dirname (__FILE__));
include dirname (__FILE__)."/../lib/connection.php";
$url = $host."/uploadGJComment21.php";

$gjp = $_POST['gjp'];
$userName = $_POST['userName'];
$comment = $_POST['comment'];
$gameVersion = $_POST['gameVersion'];
$levelID = $_POST['levelID'];
$percent = $_POST['percent'];
$accountID = $_POST['accountID'];
$udid = $_POST['udid'];
$secret = $_POST['secret'];

$array = ["gjp" => $gjp, "userName" => $userName, "comment" => $comment, "gameVersion" => $gameVersion,
"levelID" => $levelID, "percent" => $percent, "accountID" => $accountID, "udid" => $udid, "secret" => $secret];

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
	//file_put_contents ("m.htm", "<b>Result</b>:<br>". $response."<br><br><b>Array</b>:". json_encode ($array));