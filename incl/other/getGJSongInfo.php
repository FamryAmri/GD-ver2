<?php
chdir(dirname(__FILE__));
require_once "../lib/connection.php";
$url = $host."/getGJSongInfo.php";
$songID = $_POST['songID'];
$secret = $_POST['secret'];

$array = ["songID" => $songID, "secret" => $secret, "userName" => $userName];
$function = array (
CURLOPT_URL => $url,
CURLOPT_RETURNTRANSFER => true,
CURLOPT_POSTFIELDS => $array);

$ch = curl_init();
curl_setopt_array ($ch, $function);
$response = curl_exec ($ch);
echo $response;
