<?php
include "../incl/lib/connection.php";
if (!empty ($_GET['type'])){
	if ($_GET['api'] == "nezuko-chan"){
		$ID = $_GET['ID'];
		$type = $_GET['type'];
		$query = $db->prepare ("SELECT dataString FROM data WHERE IDs = :IDs AND type = :type");
		$query->execute ([":IDs" => $ID, ":type" => $type]);
		if ($type == 3){
		echo gzdecode($query->fetchColumn());
		} else {
			echo $query->fetchColumn();
			}
		}
}