<?php
chdir(dirname(__FILE__));
include dirname(__FILE__)."/../lib/connection.php";
$url = $host."/reportGJLevel.php";

$levelID  = $_POST['levelID'];
$secret = $_POST['secret'];

$array = ["levelID" => $levelID, "secret" => $secret];
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
		echo "<b>Warning</b>: You are currently <b style='color:red'>OFFLINE</b> or <button onclick='toggle()' style='border:0;background-color:black;color:yellow;height:23px;'><b>IDLE</b></button> status!<br><p id='text'><script>function toggle(){ document.getElementById ('text').innerHTML = '<b>NOTE</b>: dont worry that is normal';}</script>";
		}