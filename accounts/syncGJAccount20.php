<?php
chdir(dirname(__FILE__));
include "../incl/lib/exploitPatch.php";
include "../incl/lib/connection.php";
$ep = new exploitPatch;
$hostexp = explode ("/", $host);
if ($hostexp[0] == "boomlings.com" OR $hostexp[0] == "www.boomlings.com"){
$url = $host."/accounts/syncGJAccountNew.php";
} elseif ($hostexp[0] == "famryamri-g.7m.pl" OR $hostexp[0] == "www.famryamri-g.7m.pl"){
	$url = $host."/allafdps/accounts/syncGJAccountNew.php";
	} else {
		$url = $host."/database/accounts/syncGJAccountNew.php";
		}
$username = $ep->remove($_POST['userName']);
$password = $ep->remove($_POST['password']);
$gameVersion = $_POST['gameVersion'];
$binaryVersion = $_POST['binaryVersion'];
$gdw = $_POST['gdw'];

$array = [
"userName" => $username,
"password" => $password,
"gameVersion" => $gameVersion,
"binaryVersion" => $binaryVersion,
"gdw" => $gdw,
"secret" => $_POST['secret']];

$ch = curl_init ($url);
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt ($ch, CURLOPT_POSTFIELDS, $array);
$response = curl_exec($ch);
$curlData = explode (";", $response)[0];

	if ($isDB == 1){
	$query = $db->prepare ("SELECT * FROM accounts WHERE userName = :userName");
	$query->execute([":userName" => $username]);
	$row = $query->fetch();
	$accountID = $row['accountID'];
	if (password_verify ($pass, $row['password'])){
		$chknum = "1";
		} else {
			exit ("-1");
			}
	} else {
		$query = $db->dbremote_query("SELECT * FROM accounts WHERE userName = '". $username."'", false);
		$accountID = json_decode($query)[0]->accountID;
		$password_hash = json_decode($query)[0]->password;
		if (password_verify ($password, $password_hash)){
		$chknum = "1";
		} else {
			exit ("-1");
			}
	}
if ($chknum == "1"){
	if (file_exists ("../data/accounts/". $accountID)){
		$saveData = file_get_contents ("../data/accounts/".$accountID);
		} else {
		$saveData = $curlData;
		}
	}
	echo $saveData.";21;30;a;a";
