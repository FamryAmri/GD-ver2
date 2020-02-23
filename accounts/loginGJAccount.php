<?php
include "../incl/lib/exploitPatch.php";
include "../incl/lib/connection.php";
$ep = new exploitPatch();
$url = $host."/accounts/loginGJAccount.php";
$udid = $ep->remove($_POST['udid']);
$userName = $ep->remove($_POST['userName']);
$password = $ep->remove($_POST['password']);

$sid = mt_rand(111111111,999999999) . mt_rand(11111111,99999999);
$array = [
"udid" => $udid,
"userName" => $userName,
"password" => $password,
"secret" => "Wmfv3899gc9",
"sID" => $sid];
//Logining
if (!empty($userName)){
	$ch = curl_init ($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $array);
	$response = curl_exec($ch);
	//file_put_contents ("res.txt", $response);
	//Response
	if ($response == "-1"){ //Fail Login
		echo "-1";
		} else {
			echo $response;
			}
		} else {
			echo "-1";
			}