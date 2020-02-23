<?php
chdir(dirname(__FILE__));
include dirname(__FILE__)."/../lib/connection.php";
$url = $host."/getGJMapPacks21.php";
$secret = $_POST['secret'];
$page = $_POST['page'];
$array = ["secret" => $secret, "page" => $page];
$function = array (
CURLOPT_URL => $url,
CURLOPT_RETURNTRANSFER => true,
CURLOPT_POSTFIELDS => $array);
$ch = curl_init();
curl_setopt_array ($ch, $function);
echo curl_exec($ch);