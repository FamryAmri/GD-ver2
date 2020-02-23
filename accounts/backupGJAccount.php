<?php
chdir(dirname(__FILE__));
set_time_limit(0);
ini_set ("memory_limit","128M");
ini_set ("post_max_size","50M");
ini_set ("upload_max_filesize","50M");
include "../incl/lib/exploitPatch.php";
include "../incl/lib/connection.php";
$ep = new exploitPatch;
$hostexp = explode ("/", $host);
if ($hostexp[0] == "boomlings.com" OR $hostexp[0] == "www.boomlings.com"){
$url = $host."/accounts/backupGJAccountNew.php";
} elseif ($hostexp[0] == "famryamri-g.7m.pl" OR $hostexp[0] == "www.famryamri-g.7m.pl"){
	$url = $host."/allafdps/accounts/backupGJAccountNew.php";
	} else {
		$url = $host."/database/accounts/backupGJAccountNew.php";
		}

$userName = $ep->remove($_POST['userName']);
$password = $ep->remove($_POST['password']);
$gameVersion = $_POST['gameVersion'];
$binaryVersion = $_POST['binaryVersion'];
$gdw = $_POST['gdw'];
$saveData =$ep->remove($_POST['saveData']);
if ($saveAccount == 0 OR $saveAccount == "Off"){
$array = [
"userName" => $userName,
"password" => $password,
"gdw" => $gdw,
"gameVersion" => $gameVersion,
"binaryVersion" => $binaryVersion,
"saveData" => $saveData,
"secret" => "Wmfd2893gb7"];
$ch = curl_init ($url);
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt ($ch, CURLOPT_POSTFIELDS, $array);
$response = curl_exec($ch);
echo $response;
} else {
	if ($isDB == 1){
		$password_hash_get = $db->prepare ("SELECT * FROM account WHERE userName = :userName");
		$password_hash_get->execute([":userName" => $userName]);
		$password_hash = $password_hash_get->fetch()["password"];
		} elseif ($isDB == 2){
$password_hash = $db->dbremote_query ("SELECT * FROM accounts WHERE userName = '". $userName."'", false);
$password_hash = json_decode ($password_hash)[0]->password;
} else {
	echo "-2";
	}
if (password_verify ($password, $password_hash)){
	$chknum = "1";
	}
if (!empty ($chknum) OR $chknum == "1") {
	$saveDataArr = explode(";",$saveData);
	$saveData = str_replace("-","+",$saveDataArr[0]);
	$saveData = str_replace("_","/",$saveData);
	$saveData = base64_decode($saveData);
	$saveData = gzdecode($saveData);
	$orbs = explode("</s><k>14</k><s>",$saveData)[1];
	$orbs = explode("</s>",$orbs)[0];
	$lvls = explode("<k>GS_value</k>",$saveData)[1];
	$lvls = explode("</s><k>4</k><s>",$lvls)[1];
	$lvls = explode("</s>",$lvls)[0];
	$protected_key_encoded = "";
		$saveData = str_replace("<k>GJA_002</k><s>".$password."</s>", "<k>GJA_002</k><s>not the actual password</s>", $saveData);
		//file_put_contents($userName, $saveData);
		$saveData = gzencode($saveData);
		$saveData = base64_encode($saveData);
		$saveData = str_replace("+","-",$saveData);
		$saveData = str_replace("/","_",$saveData);
		$saveData = $saveData . ";" . $saveDataArr[1];
	/*}else if($cloudSaveEncryption == 1){
		$saveData = $ep->remove($_POST["saveData"]);
		//$protected_key = KeyProtectedByPassword::createRandomPasswordProtectedKey($password);
		//$protected_key_encoded = $protected_key->saveToAsciiSafeString();
		//$user_key = $protected_key->unlockKey($password);
		//$saveData = Crypto::encrypt($saveData, $user_key);
	}*/
	//$query = $db->prepare("UPDATE `accounts` SET `saveData` = :saveData WHERE userName = :userName");
	//$query->execute([':saveData' => $saveData, ':userName' => $userName]);
	if ($isDB == 1){
	$query = $db->prepare("SELECT accountID FROM accounts WHERE userName = :userName");
	$query->execute([':userName' => $userName]);
	$accountID = $query->fetch()["accountID"];
	} elseif ($isDB == 2){
			$query = $db->dbremote_query ("SELECT accountID FROM accounts WHERE userName = '". $userName."'", false);
			$accountID = json_decode ($query)[0]->accountID;
	} 
	file_put_contents("../data/accounts/$accountID", $saveData);
	//file_put_contents("../data/accounts/keys/$accountID",$protected_key_encoded);
	if ($isDB == 1){
	$query = $db->prepare("SELECT extID FROM users WHERE userName = :userName LIMIT 1");
	$query->execute([':userName' => $userName]);
	$result = $query->fetchAll();
	$result = $result[0];
	$extID = $result["extID"];
	$query = $db->prepare("UPDATE `users` SET `orbs` = :orbs, `completedLvls` = :lvls WHERE extID = :extID");
	$query->execute([':orbs' => $orbs, ':extID' => $extID, ':lvls' => $lvls]);
	} elseif ($isDB == 2){
		$query = $db->dbremote_query ("SELECT * FROM account WHERE userName = '". $userName."'", false);
		$row = json_decode ($query)[0];
		$extID = $query->accountID;
		$query2 = $db->dbremote_query ("UPDATE users SET orbs = ". $orbs.", completedLvls = ". $lvls." WHERE extID = ". $extID, true);
	}
		echo "1";
	} else {
			echo "-1";
	}
}