<?php
include "./incl/lib/connection.php";
if (!empty($_GET['ID'])){
	if(strpos ($_GET['ID'], ".mp3")!==false){
		$ID = $_GET['ID'];
		$ID = str_replace (".mp3", "", $ID);
		if($isDB == 1){
	$query = $db->prepare ("SELECT dataString FROM data WHERE IDs = :ID AND type = 3");
	$query->execute ([":ID" => $ID]);
	$data = $query->fetchColumn();
		} elseif ($isDB == 2){
	$data = file_get_contents ($db->getURLPlugin()."?ID=". $ID);
		}
		header ("content-type: audio/mpeg");
		//echo gzdecode (base64_decode($data));
		echo $data;
	} else {
		echo "Not Found";
		}
	}
