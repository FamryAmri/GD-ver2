<?php
chdir(dirname(__FILE__));
include dirname(__FILE__)."/../lib/connection.php";
include "../lib/exploitPatch.php";
function genSolo4($lvlsmultistring){
return sha1($lvlsmultistring . "pC26fpYaQCtg");
}
$ep = new exploitPatch();
//Chest Rewards
$orbs1= 1000;
$dias1 = 100;
$shard1 = 1;
$keys1 = 2;
$orbs2 = 5000;
$dias2 = 500;
$shard2 = 2;
$keys2 = 2;

//Posting
$udid = $ep->remove($_POST['udid']);
$rew = $ep->remove($_POST['rewardType']);
$accountID = $ep->remove($_POST['accountID']);
$chk = $ep->remove($_POST['chk']);
$gjp = $ep->remove($_POST['gjp']);

	$array = ["udid" => $udid, "accountID" => $accountID, "gjp" => $gjp, "rewardType" => $rew, "chk" => $chk, "secret" => "Wmfd2893gb7"];
	$url = "http://".$host."/getGJRewards.php";
	$ch = curl_init ($url);
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt ($ch, CURLOPT_POSTFIELDS, $array);
	$response = curl_exec ($ch);
	if (!empty ($response)){
	echo $response;
	} elseif (empty ($host)){
		$server = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		exit ("<b>Error</b>: You just not setup at ".dirname($server)."/config/host.php");
		} else {
		echo "<b>Error</b>: You are currently <b style='color:red'>OFFLINE</b>!";
		}