<?php
chdir(dirname(__FILE__));
include "../lib/exploitPatch.php";
include "../lib/connection.php";
$ep = new exploitPatch;

$gameVersion = $ep->remove($_POST['gameVersion']);
$binaryVersion = $ep->remove($_POST['binaryVersion']);
$levelID = $ep->remove($_POST['levelID']);
$gdw = $ep->remove($_POST['gdw']);

$post = ["gameVersion" => $gameVersion, "binaryVersion" => $binaryVersion, "gdw" => $gdw, "levelID" => $levelID, "secret" => $_POST['secret'] ];

$url = $host."/downloadGJLevel22.php";

$curl = curl_init ($url);
curl_setopt ($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt ($curl, CURLOPT_POSTFIELDS, $post);
$result = curl_exec($curl);
$resultexp = explode (":", $result);
if (!empty ($result)){
	//file_put_contents ("../../data/levels/". $levelID, $resultexp[7]);
	if ($isDB == 2){
	$query = $db->dbremote_query ("INSERT INTO data (data, IDs) VALUES ('". $levelString."',". $levelID.")", false);
	$level = $db->dbremote_query ("SELECT * FROM data WHERE IDs = $levelID", false);
	}
	if (!empty($resultexp[7])){
	echo $result;
	} else {
		if (!empty($levelID)){
			if (file_exists("../../data/levels/".$levelID)){
		$levelString = file_get_contents ($levelID);
		} else {
			if ($isDB == 1){
		$query = $db->prepare ("SELECT * FROM data WHERE IDs = :levelID, type = 1");
		$query->execute([":levelID" => $levelID]);
		$row = $query->fetch();
		$levelString = $row["dataString"];
		} elseif ($isDB == 2){
			$query = $db->dbremote_query ("SELECT * FROM data WHERE IDs = $levelID, type = 1", false);
			$levelString = json_decode ($query)[0]->dataString;
	}
		$str = str_replace(":4::5:", ":4:".$levelString.":5:", $result);
		echo $str;
		/*echo "1:".$levelID.":2:".$row['levelName'].":3:".$row['levelDesc'].":4:".$levelString.":5:". $row['levelVersion'].":6:".$row['userID'].":8:10:9:".$row['starDifficulty'].":10:".$row["downloads"].":11:1:12:".$row["audioTrack"].":13:".$row["gameVersion"].":14:".$row["likes"].":17:".$row["starDemon"].":43:".$row["starDemonDiff"].":25:".$row["starAuto"].":18:".$row["starStars"].":19:".$row["starFeatured"].":42:".$row["starEpic"].":45:".$row["objects"].":15:".$row["levelLength"].":30:".$row["original"].":31:1:28:".$uploadDate. ":29:".$updateDate. ":35:".$row["songID"].":36:".$row["extraString"].":37:".$row["coins"].":38:".$row["starCoins"].":39:".$row["requestedStars"].":46:1:47:2:48:1:40:".$row["isLDM"].":27:".$row['password'];
		echo $row["userID"].",".$row["starStars"].",".$row["starDemon"].",".$row["levelID"].",".$row["starCoins"].",".$row["starFeatured"].",".$pass.",".$feaID;*/
		}
	} else {
			echo "-1";
			}
		}
	} elseif (empty ($host)){
		$server = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		exit ("<b>Error</b>: You just not setup at ".dirname($server)."/config/host.php");
		} else {
		echo "<b>Error</b>: You are currently <b style='color:red'>OFFLINE</b>!";
		}