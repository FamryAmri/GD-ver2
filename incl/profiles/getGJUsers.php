<?php
chdir(dirname(__FILE__));
include dirname(__FILE__)."/../lib/connection.php";
$url = $host."/getGJUsers20.php";

$str = $_POST['str'];
$page = $_POST['page'];
$secret = $_POST['secret'];

$array = [
"str" => $str,
"page" => $page,
"secret" => $secret];
$ch = curl_init($url);
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt ($ch, CURLOPT_POSTFIELDS, $array);
$response = curl_exec($ch);
if (!empty ($response)){
	echo $response;
	} elseif (empty ($host)){
		$server = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		exit ("<b>Error</b>: You just not setup at ".dirname($server)."/config/host.php");
		} else {
		echo "<b>Error</b>: You are currently <b style='color:red'>OFFLINE</b>!";
		}
