<?php
chdir (dirname(__FILE__));
include dirname (__FILE__)."/../lib/connection.php";
include "../lib/exploitPatch.php";
$ep = new exploitPatch();

$url = $host."/getGJAccountComments20.php";
$extID = $ep->remove($_POST['accountID']);
$page = $ep->remove($_POST['page']);
$userID = $ep->remove($_POST['userID']);
$total = $_POST['total'];

$array = ["accountID" => $extID,
"page" => $page,
"userID" => $userID,
"gameVersion" => $ep->remove($_POST['gameVersion']),
"binaryVersion" => $ep->remove($_POST['binaryVersion']),
"secret" => "Wmfd2893gb7",
"total" => $total];

if (!empty ($extID)){
	$ch = curl_init($url);
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER,true);
	curl_setopt ($ch, CURLOPT_POSTFIELDS, $array);
	$response = curl_exec ($ch);
	if ($response == "-1" OR $response == "#0:0:0"){
		echo "#0:0:0";
		} else {
			echo $response;
			}
		} else {
			echo "-1";
			}

		