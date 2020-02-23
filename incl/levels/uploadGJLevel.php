<?php
chdir(dirname (__FILE__));
include "../lib/XORCipher.php";
$xor = new XORCipher;
include "../lib/exploitPatch.php";
$ep = new exploitPatch;
include "../lib/connection.php";
$mainLib = new mainLib;
$url = $host."/uploadGJLevel21.php";

if ($saveLevel == 0 OR $saveLevel == "Off"){
//Game Info
$gameVersion = $_POST['gameVersion'];
$binaryVersion = $_POST['binaryVersion'];
//Creator Level
$userName = $_POST['userName'];
$accountID = $_POST['accountID'];
$udid = $_POST['udid'];
$gjp = $_POST['gjp']; //:v is private for code such as ( password )
//levelInfo
$levelID = $_POST['levelID'];
$levelName = $_POST['levelName'];
$levelDesc = $_POST['levelDesc'];
$levelVersion = $_POST['levelVersion'];
$levelLength = $_POST['levelLength'];
//Audio Track like Stereo Madness
$audioTrack = $_POST['audioTrack'];
//Req Diff
$auto = $_POST['auto'];
$requestedStars = $_POST['requestedStars'];
//Level Info
$coins = $_POST['coins']; //Max 3 coins
$password = $_POST['password'];
$original = $_POST['original'];
$twoPlayer = $_POST['twoPlayer'];
$songID = $_POST['songID'];
$objects = $_POST['objects'];
$levelInfo = $_POST['levelInfo'];
$ldm = $_POST['ldm'];
$unlist = $_POST['unlisted'];
//level data
$levelString = $_POST['levelString'];
$extraString = $_POST['extraString'];
//API Code or Secret Code to access for game
$secret = $_POST['secret'];

//:v long
$array = [ "gameVersion" => $gameVersion, "binaryVersion" => $binaryVersion, "userName" => $userName, "accountID" => $accountID, "udid" => $udid, "gjp" => $gjp, "levelID" => $levelID, "levelName" => $levelName,
"levelDesc" => $levelDesc, "levelVersion" => $levelVersion, "levelLength" => $levelLength, "audioTrack" => $audioTrack, "auto" => $auto, "requestedStars" => $requestedStars,
"coins" => $coins, "password" => $password, "original" => $original, "twoPlayer" => $twoPlayer, "songID" => $songID, "objects" => $objects, "levelInfo" => $levelInfo, "ldm" => $ldm,
"unlisted" => $unlist, "levelString" => $levelString, "extraString" => $extraString, "secret" => $secret];

$function = array (CURLOPT_URL => $url, CURLOPT_RETURNTRANSFER => true, CURLOPT_POSTFIELDS => $array);
$ch = curl_init();
curl_setopt_array ($ch, $function);
$response = curl_exec ($ch);
if (!empty ($response)){
	echo $response;
	} elseif (empty ($host)){
		$server = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		exit ("<b>Error</b>: You just not setup at ".dirname($server)."/config/host.php");
		} else {
		echo "<b>Error</b>: You are currently <b style='color:red'>OFFLINE</b>!";
		}
	} else {
$gjp = $ep->remove($_POST["gjp"]);
$gameVersion = $ep->remove($_POST["gameVersion"]);
if(!empty($_POST["binaryVersion"])){
	$binaryVersion = $ep->remove($_POST["binaryVersion"]);	
}else{
	$binaryVersion = 0;
}
$userName = $ep->remove($_POST["userName"]);
$userName = $ep->charclean($userName);
$levelID = $ep->remove($_POST["levelID"]);
$levelName = $ep->remove($_POST["levelName"]);
$levelName = $ep->charclean($levelName);
$levelDesc = $ep->remove($_POST["levelDesc"]);
if($gameVersion < 20){
	$levelDesc = base64_encode($levelDesc);
}
$levelVersion = $ep->remove($_POST["levelVersion"]);
$levelLength = $ep->remove($_POST["levelLength"]);
$audioTrack = $ep->remove($_POST["audioTrack"]);
if(!empty($_POST["auto"])){
	$auto = $ep->remove($_POST["auto"]);
}else{
	$auto = 0;
}
if(isset($_POST["password"])){
	$password = $ep->remove($_POST["password"]);
}else{
	$password = 1;
	if($gameVersion > 17){
		$password = 0;
	}
}
if(!empty($_POST["original"])){
	$original = $ep->remove($_POST["original"]);
}else{
	$original = 0;
}
if(!empty($_POST["twoPlayer"])){
	$twoPlayer = $ep->remove($_POST["twoPlayer"]);
}else{
	$twoPlayer = 0;
}
if(!empty($_POST["songID"])){
	$songID = $ep->remove($_POST["songID"]);
}else{
	$songID = 0;
}
if(!empty($_POST["objects"])){
	$objects = $ep->remove($_POST["objects"]);
}else{
	$objects = 0;
}
if(!empty($_POST["coins"])){
	$coins = $ep->remove($_POST["coins"]);
}else{
	$coins = 0;
}
if(!empty($_POST["requestedStars"])){
	$requestedStars = $ep->remove($_POST["requestedStars"]);
}else{
	$requestedStars = 0;
}
if(!empty($_POST["extraString"])){
	$extraString = $ep->remove($_POST["extraString"]);
}else{
	$extraString = "29_29_29_40_29_29_29_29_29_29_29_29_29_29_29_29";
}
$levelString = $ep->remove($_POST["levelString"]);
if(!empty($_POST["levelInfo"])){
	$levelInfo = $ep->remove($_POST["levelInfo"]);
}else{
	$levelInfo = 0;
}
$secret = $ep->remove($_POST["secret"]);
if(!empty($_POST["unlisted"])){
	$unlisted = $ep->remove($_POST["unlisted"]);
}else{
	$unlisted = 0;
}
if(!empty($_POST["ldm"])){
	$ldm = $ep->remove($_POST["ldm"]);
}else{
	$ldm = 0;
}
$accountID = "";
if(!empty($_POST["udid"])){
	$id = $ep->remove($_POST["udid"]);
	if(is_numeric($id)){
		exit("-1");
	}
}
if(!empty($_POST["accountID"]) AND $_POST["accountID"]!="0"){
	$id = $ep->remove($_POST["accountID"]);
	$gjpdecode = str_replace("_","/",$gjp);
	$gjpdecode = str_replace("-","+",$gjpdecode);
	$gjpdecode = base64_decode($gjpdecode);
	$gjpdecode = $xor->cipher($gjpdecode,37526);
	if ($isDB == 1){
		$query = $db->prepare ("SELECT password FROM accounts WHERE userName = :userName");
		$query->execute([":userName" => $userName]);
		$pwd = $query->fetchColumn();
		} elseif ($isDB == 2){
		$query = $db->dbremote_prepare ("SELECT password FROM accounts WHERE userName LIKE '$userName'");
		$query = $db->dbremote_query($query, false);
		$pwd = json_decode($query)[0]->password;
		}
	if (password_verify ($gjpdecode, $pwd)){
		$gjpresult = "1";
		} else {
			$gjpresult = "0";
			}
	if($gjpresult != 1){
		exit("-1");
	}
}
if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
	$hostname = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
	$hostname = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
	$hostname = $_SERVER['REMOTE_ADDR'];
}
if(is_numeric($id)){
			$register = 1;
		}else{
			$register = 0;
		}
		if ($isDB == 1){
		$query = $db->prepare("SELECT userID FROM users WHERE extID = :id");
		$query->execute([':id' => $id]);
		$rowCount = $query->rowCount();
		$usrID = $query->fetchColumn();
		} elseif ($isDB == 2){
			$rowCount = $db->dbremote_query ("SELECT `userID` FROM `users` WHERE extID = '".$id."'", true);
			$usrID = $db->dbremote_query ("SELECT `userID` FROM `users` WHERE extID = '".$id."'", false);
			$usrID = json_decode ($usrID)[0]->userID;
			}
		if (!empty ($usrID)) {
			$userID = $usrID;
		} else {
			if ($isDB == 1){
			$query = $db->prepare("INSERT INTO users (isRegistered, extID, userName, lastPlayed)
			VALUES (:register, :id, :userName, :uploadDate)");
			$query->execute([':id' => $id, ':register' => $register, ':userName' => $userName, ':uploadDate' => time()]);
			$userID = $db->lastInsertId();
			} elseif ($isDB == 2){
				$userID = $db->dbremote_query ("INSERT INTO users (isRegistered, extID, userName, lastPlayed) VALUES ( ". $register.",". $id.", '". $userName."',".time().")", false);
		}
	}
$uploadDate = time();

if ($isDB == 1){
		$query = $db->prepare("SELECT count(*) FROM levels WHERE uploadDate > :time AND (userID = :userID OR hostname = :ip)");
		$query->execute([':time' => $uploadDate - 60, ':userID' => $userID, ':ip' => $hostname]);
		$fetchColumn = $query->fetchColumn();
	} elseif ($isDB == 2){
		$query = $db->dbremote_prepare ("SELECT count(*) FROM levels WHERE uploadDate > '". $uploadDate."' AND (userID = '". $userID."' OR hostname = '". $hostname."')");
		$query = $db->dbremote_query ($query, false);
		$query = str_replace ("count(*)", "fetchColumn", $query);
		$query = json_decode ($query)[0];
		$fetchColumn = $query->fetchColumn;
		}
if($fetchColumn > 0){
	exit("-1");
}


if($levelString != "" AND $levelName != ""){
	if ($isDB == 1){
	$querye=$db->prepare("SELECT levelID FROM levels WHERE levelName = :levelName AND userID = :userID");
	$querye->execute([':levelName' => $levelName, ':userID' => $userID]);
	$levelID = $querye->fetchColumn();
	$lvls = $querye->rowCount();
	} elseif ($isDB == 2){
	$query_prepare = $db->dbremote_prepare ("SELECT levelID FROM levels WHERE levelName = '". $levelName."' AND userID = '". $userID."'");
	$querye = $db->dbremote_query ($query_prepare, false);
	$levelID = json_decode ($querye)[0]->levelID;
	$rowCount = $db->dbremote_query ($query_prepare, true);
	$lvls = $rowCount;
	}
	if(!empty ($levelID)){
		if ($isDB == 1){
		$query = $db->prepare("UPDATE levels SET levelName=:levelName, gameVersion=:gameVersion,  binaryVersion=:binaryVersion, userName=:userName, levelDesc=:levelDesc, levelVersion=:levelVersion, levelLength=:levelLength, audioTrack=:audioTrack, auto=:auto, password=:password, original=:original, twoPlayer=:twoPlayer, songID=:songID, objects=:objects, coins=:coins, requestedStars=:requestedStars, extraString=:extraString, levelString=:levelString, levelInfo=:levelInfo, secret=:secret, updateDate=:uploadDate, userID=:userID, unlisted=:unlisted, hostname=:hostname, isLDM=:ldm WHERE levelName=:levelName AND extID=:id");	
		$query->execute([':levelName' => $levelName, ':gameVersion' => $gameVersion, ':binaryVersion' => $binaryVersion, ':userName' => $userName, ':levelDesc' => $levelDesc, ':levelVersion' => $levelVersion, ':levelLength' => $levelLength, ':audioTrack' => $audioTrack, ':auto' => $auto, ':password' => $password, ':original' => $original, ':twoPlayer' => $twoPlayer, ':songID' => $songID, ':objects' => $objects, ':coins' => $coins, ':requestedStars' => $requestedStars, ':extraString' => $extraString, ':levelString' => $levelString, ':levelInfo' => $levelInfo, ':secret' => $secret, ':levelName' => $levelName, ':id' => $id, ':uploadDate' => $uploadDate, 'userID' => $userID, ':unlisted' => $unlisted, ':hostname' => $hostname, ':ldm' => $ldm]);
		$query = $db->prepare("UPDATE data SET dataString = :levelString WHERE IDs = :levelID AND type = :type");
		$query->execute ([":levelString" => $levelString, ":levelID" => $levelID, ":type" => 1]);
		} elseif ($isDB == 2){
			$query = $db->dbremote_query ("UPDATE levels SET levelName = '". $levelName."', gameVersion = $gameVersion, binaryVersion = $binaryVersion, userName = '". $userName."', levelDesc = '". $levelDesc."', levelVersion = $levelVersion, levelLength = $levelLength, audioTrack = $audioTrack, auto = $auto, password = $password, original = $original, twoPlayer = $twoPlayer, songID = $songID, objects = $objects, coins = $coins, requestedStars = $requestedStars, extraString = '". $extraString."', levelString = '". $levelString."', levelInfo = '". $levelInfo."', secret = '". $secret."', updateDate = '". $uploadDate."', userID = $userID, unlisted = $unlisted, hostname = '". $hostname."', isLDM = $ldm WHERE levelName = '". $levelName."' AND extID = '". $id."'");
			$query = $db->dbremote_query ("UPDATE data SET dataString = '". $levelString."' WHERE lDs = $levelID AND type = 1");
		}
	}else{
		if ($isDB == 1){
		$query = $db->prepare("INSERT INTO levels (levelName, gameVersion, binaryVersion, userName, levelDesc, levelVersion, levelLength, audioTrack, auto, password, original, twoPlayer, songID, objects, coins, requestedStars, extraString, levelString, levelInfo, secret, uploadDate, userID, extID, updateDate, unlisted, hostname, isLDM)
		VALUES (:levelName, :gameVersion, :binaryVersion, :userName, :levelDesc, :levelVersion, :levelLength, :audioTrack, :auto, :password, :original, :twoPlayer, :songID, :objects, :coins, :requestedStars, :extraString, :levelString, :levelInfo, :secret, :uploadDate, :userID, :id, :uploadDate, :unlisted, :hostname, :ldm)");
		$query->execute([':levelName' => $levelName, ':gameVersion' => $gameVersion, ':binaryVersion' => $binaryVersion, ':userName' => $userName, ':levelDesc' => $levelDesc, ':levelVersion' => $levelVersion, ':levelLength' => $levelLength, ':audioTrack' => $audioTrack, ':auto' => $auto, ':password' => $password, ':original' => $original, ':twoPlayer' => $twoPlayer, ':songID' => $songID, ':objects' => $objects, ':coins' => $coins, ':requestedStars' => $requestedStars, ':extraString' => $extraString, ':levelString' => "", ':levelInfo' => $levelInfo, ':secret' => $secret, ':uploadDate' => $uploadDate, ':userID' => $userID, ':id' => $id, ':unlisted' => $unlisted, ':hostname' => $hostname, ':ldm' => $ldm]);
		$levelID = $db->lastInsertId();
		$query = $db->prepare ("INSERT INTO data (dataString, IDs, type) VALUES ( :levelString, :levelID, :type)");
		$query->execute ([":levelString" => $levelString, ":levelID" => $levelID, ":type" => 1]);
		} elseif ($isDB == 2){
		$queryD = $db->dbremote_prepare("INSERT INTO `levels` (`levelName`, `gameVersion`, `binaryVersion`, `userName`, `levelDesc`, `levelVersion`, `levelLength`, `audioTrack`,`auto`, `password`, `original`, `twoPlayer`, `songID`, `objects`, `coins`, `requestedStars`, `extraString`, `levelString`, `levelInfo`, `secret`, `uploadDate`, `userID`, `extID`, `updateDate`, `unlisted`, `hostname`, `isLDM`)
		VALUES ('". $levelName."', $gameVersion, $binaryVersion, '". $userName."','". $levelDesc."', $levelVersion, $levelLength, $audioTrack, $auto, $password, $original, $twoPlayer, $songID, $objects, $coins, $requestedStars, '".$extraString."', '".$levelString."', '".$levelInfo."', '". $secret."', '".$uploadDate."', $userID, '". $id."', '".$uploadDate."', $unlisted, '". $hostname."', $ldm);");
		$levelID = $db->dbremote_query($queryD, false);
		$query = $db->dbremote_query("INSERT INTO data (dataString, IDs, type) VALUES ('$levelString', $levelID, 1)", false);
	}
}
		echo $levelID;
		if (!empty ($levelID)){
			$states = $levelID;
			} else {
				$states = "*";
				}
			file_put_contents ("levelID", $states);
	echo $levelID;
}else{
	echo -1;
}
			}