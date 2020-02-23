<?php
//error_reporting(0);
include dirname(__FILE__)."/../../config/config.php";
include "mainLib.php";
@header('Content-Type: text/html; charset=utf-8');
if ($isDB == 1){
try {
    $db = new PDO("mysql:host=$server;dbname=$dbname", $users, $pass, array(
    PDO::ATTR_PERSISTENT => true
));
    // set the PDO error mode to exception
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query = $db->query("CREATE TABLE IF NOT EXISTS `data` ( `ID` int(11) AUTO_INCREMENT PRIMARY KEY, `dataString` longtext NOT NULL, `levelID` int(11) NOT NULL, `type` int(11) NOT NULL ) ENGINE=InnoDB DEFAULT CHARSET=utf8");
    }
catch(PDOException $e)
    {
    	exit ("Error to connect database");
    }
} else {
    if ($isDB == 2){
    	$db = new dbremote;
			$db->dbremote_connect($host, $server, $users, $pass, $dbname);
			$err = $db->dbremote_connect_status();
			$query = $db->crt_gdps_data();
			$query = $db->dbremote_query ($query, false);
			if (!empty ($err)){
				exit ("<b>Fatal </b>". $err);
				}
    } 
}
?>