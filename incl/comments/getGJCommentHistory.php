<?php
chdir (dirname(__FILE__));
include dirname(__FILE__)."/../lib/connection.php";
include "../lib/exploitPatch.php";
$ep = new exploitPatch;
$url = $host."/getGJCommentHistory.php";

$gameVersion = $_POST['gameVersion'];
$binaryVersion = $_POST['binaryVersion'];
$mode = $_POST['mode'];
$count = $_POST['count'];
$page = $_POST['page'];
$userID = $_POST['userID'];
$levelID = $_POST['levelID'];
$accountID = $_POST['accountID'];
$total = $_POST['total'];
$gjp = $_POST['gjp'];

$array = [
"gameVersion" => $gameVersion,
"binaryVersion" => $binaryVersion,
"mode" => $mode,
"userID" => $userID,
"page" => $page,
"secret" => "Wmfd2893gb7",
"total" => $total];

	$ch = curl_init ($url);
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