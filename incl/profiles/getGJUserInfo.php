<?php
chdir(dirname(__FILE__));
include dirname (__FILE__)."/../lib/connection.php";
include "../lib/exploitPatch.php";
$ep = new exploitPatch();

$url = $host."/getGJUserInfo20.php";
$GJP = $ep->remove($_POST['gjp']);
$target = $ep->number($_POST['targetAccountID']);
$extID = $ep->number($_POST['accountID']);
$array = [
"targetAccountID" => $target,
"accountID" => $extID,
"gjp" => $GJP,
"secret" => "Wmfd2893gb7"];

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
?>