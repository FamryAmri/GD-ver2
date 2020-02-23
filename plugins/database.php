<?php
if (empty ($_GET['ID'])){
//Connection Info
$servername = $_POST['server'];
$username = $_POST['users'];
$password = $_POST['pass'];
$dbname = $_POST['dbname'];

//Query and Other
$query = $_POST['query'];
$audio = $_POST['audio'];
$data = $_POST['data'];
$ID = $_POST['ID'];
$debug = $_GET['debug'];

try {
    $db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password, array(
    PDO::ATTR_PERSISTENT => true
));
    // set the PDO error mode to exception
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
catch(PDOException $e)
    {
    $err = "Connection failed: " . $e->getMessage();
    }
    //Make Query Database
    if (!empty($servername)){
	    if (!empty($err)){
			exit ($err);
			} else {
				if (!empty ($data)){
					if (is_numeric($ID)){
						$query = $db->prepare ("SELECT dataString WHERE IDs = :id AND type = :type");
						$query->execute([":id" => $ID, ":type" => $data]);
						header ("content-type: audio/mpeg");
						echo $query->fetchColumn();
					} else {
						exit ("-2");
						}
					}
				if (!empty ($audio)){
					if (is_numeric ($audio)){
						$query = $db->prepare ("SELECT dataString FROM data WHERE IDs = :id AND type = 3");
						$query->execute ([":id" => $audio]);
						header ("content-type: audio/mpeg");
						echo $query->fetchColumn();
					} else {
						exit ("-1");
						}
					}
				if (!empty ($query)){
					$query2 = $db->query ($query);
					if (strpos ($query, "SELECT")!==false){
						$fetch[] = $query2->fetch();
						echo json_encode($fetch);
						}
					if ($debug == 1){
						echo $query2->rowCount();
						}
					if (strpos ($query, "INSERT")!==false){
						echo $db->lastInsertId();
						}
				}
			}
		}
	} else {
		include "../incl/lib/connection.php";
		$query = $db->prepare ("SELECT dataString FROM data WHERE IDs = :ID AND type = '3'");
		$query->execute ([":ID" => $_GET['ID']]);
		echo gzdecode (base64_decode ($query->fetchColumn()));
		}
?>