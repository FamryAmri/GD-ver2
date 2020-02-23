<?php
chdir(dirname(__FILE__));
include dirname(__FILE__)."/../lib/connection.php";

$url = $host."/updateGJUserScore22.php";

$gameVersion = $_POST['gameVersion'];
$binaryVersion = $_POST['binaryVersion'];
$coins = $_POST['coins'];
$userName = $_POST['userName'];
$secret = $_POST['secret'];
$stars = $_POST['stars'];
$demon = $_POST['demons'];
$icon = $_POST['icon'];
$color1 = $_POST['color1'];
$color2 = $_POST['color2'];
$iconType = $_POST['iconType'];
$userCoins = $_POST['userCoins'];
$special = $_POST['special'];
$accIcon = $_POST['accIcon'];
$accShip = $_POST['accShip'];
$accBall = $_POST['accBall'];
$accBird = $_POST['accBird'];
$accDart = $_POST['accDart'];
$accRobot = $_POST['accRobot'];
$accGlow = $_POST['accGlow'];
$accSpider = $_POST['accSpider'];
$accExplosion = $_POST['accExplosion'];
$diamonds = $_POST['diamonds'];
$udid = $_POST['udid'];
$accountID = $_POST['accountID'];
$gjp = $_POST['gjp'];
$seed = $_POST['seed'];
$seed2 = $_POST['seed2'];

$array = [
"gameVersion" => $gameVersion,
"binaryVersion" => $binaryVersion,
"coins" => $coins,
"userName" => $userName,
"secret" => $secret,
"stars" => $stars,
"demons" => $demon,
"icon" => $icon,
"color1" => $color1,
"color2" => $color2,
"iconType" => $iconType,
"userCoins" => $userCoins,
"special" => $special,
"accIcon" => $accIcon,
"accShip" => $accShip,
"accBall" => $accBall,
"accBird" => $accBird,
"accDart" => $accDart,
"accRobot" => $accRobot,
"accGlow" => $accGlow,
"accSpider" => $accSpider,
"accExplosion" => $accExplosion,
"diamonds" => $diamonds,
"udid" => $udid,
"gjp" => $gjp,
"accountID" => $accountID,
"seed" => $seed,
"seed2" => $seed2];

$ch = curl_init($url);
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt ($ch, CURLOPT_POSTFIELDS, $array);
$response = curl_exec($ch);
echo $response;