<?php
chdir (dirname (__FILE__));
include dirname(__FILE__)."/../lib/connection.php";
$url = $host."/getGJGauntlets21.php";
$secret = "Wmfd2893gb7";
$array = ["secret" => $secret];
$function = array (
CURLOPT_URL => $url,
CURLOPT_RETURNTRANSFER => true,
CURLOPT_POSTFIELDS => $array);
$ch = curl_init();
curl_setopt_array ($ch, $function);
echo curl_exec ($ch);
//echo str_replace("27732941", "58838600", curl_exec($ch));
//echo "1:1:3:27732941,28200611,27483789,28225110,27448202|1:2:3:20635816,28151870,25969464,24302376,27399722|1:3:3:28179535,29094196,29071134,26317634,12107595|1:4:3:26949498,26095850,27973097,27694897,26070995|1:5:3:18533341,28794068,28127292,4243988,28677296|1:6:3:28255647,27929950,16437345,28270854,29394058|1:7:3:25886024,4259126,26897899,7485599,19862531|1:8:3:18025697,23189196,27786218,27728679,25706351#74aeff3cb009cbde1d7235e1c7e74b47d793eb82";
