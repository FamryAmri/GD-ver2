<?php
chdir(dirname(__FILE__));
include dirname(__FILE__)."/../lib/connection.php";

function post ($post){
	$posting = $_POST[$post];
	return $posting;
	}

$type = post ("type");
$gameVersion = post ("gameVersion");
$binaryVersion = post ("binaryVersion");
$diff = post ("diff");
$featured = post ("featured");
$original = post ("original");
$coins = post ("coins");
$epic = post ("epic");
$uncomp = post ("uncompleted");
$comp = post ("onlyCompleted");
$song = post ("song");
$customSong = post ("customSong");
$twopl = post ("twoPlayer");
$star = post ("star");
$noStar = post ("noStar");
$gauntlet = post ("gauntlet");
$len = post ("len");
$str = post ("str");
$page = post ("page");
$secret = post ("secret");

$url = $host."/getGJLevels21.php";
$array = ["gameVersion" => $gameVersion, "binaryVersion" => $binaryVersion, "type" => $type, "page" => $page, "len" => $len, "twoPlayer" => $twoPl, "str" => $str, "star" => $star, "song" => $song, "customSong" => $customSong, "noStar" => $noStar, "gauntlet" => $gauntlet,
"onlyCompleted" => $comp, "uncompleted" => $uncompleted, "epic" => $epic, "coins" => $coins, "featured" => $featured, "original" => $original, "diff" => $diff, "secret" => $secret];

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