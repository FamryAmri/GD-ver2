<?php
//My own Plugins ( Famry )
class dbremote {
	private $host;
	private $server;
	private $users;
	private $pass;
	private $dbname;
	private $prepare;
	private $pluginURL;
public function dbremote_connect($hst, $svr, $usr, $pss, $dbn){
	$this->server = $svr;
	$this->host = $hst;
	$this->users = $usr;
	$this->pass = $pss;
	$this->dbname = $dbn;
}
public function getInfoConnection (){
	$array = ["servername" => $this->server, "username" => $this->users, "dbname" => $this->dbname, "host" => $this->host];
	return json_encode ($array);
	}
public function getURLPlugin (){
	$url = "http://". $this->host."/plugins/database.php";
	return $url;
	}
public function dbremote_connect_status(){
	$url = "http://". $this->host."/plugins/database.php";
	$post = ["server" => $this->server, "users" => $this->users, "pass" => $this->pass, "dbname" => $this->dbname];
	$ch = curl_init ($url);
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt ($ch, CURLOPT_POSTFIELDS, $post);
	return curl_exec ($ch);
}
public function dbremote_query ($qry, $S = null){
	switch ($S){
		case true:
		$stat = "1";
		$get = "?debug=1";
		break;
		case false:
		$stat = "0";
		$get = "";
		break;
		default:
		$stat = "0";
		$get = "";
		break;
	}
	$url = "http://".$this->host."/plugins/database.php". $get;
	if (strpos ($qry, "SELECT")!==false){
		$post = ["query" => $qry, "server" => $this->server, "users" => $this->users, "pass" => $this->pass, "dbname" => $this->dbname, "fetch" => 1];
		} else {
			$post = ["query" => $qry, "server" => $this->server, "users" => $this->users, "pass" => $this->pass, "dbname" => $this->dbname];
			}
	$ch = curl_init ($url);
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt ($ch, CURLOPT_POSTFIELDS, $post);
	return curl_exec ($ch);
	}
public function dbremote_fetch ($m){
	$json = json_decode ($m)[0];
	return $json;
	}
public function dbremote_prepare ($o){
	$m = $o;
	return $m;
	}
public function dbremote_execute($qry, $arr, $stat = null){
	switch($stat){
		case true:
		$get = "?debug=1";
		break;
		case false:
		$get = "";
		break;
		default:
		$get = "";
		break;
	}
	$arr = json_encode ($arr);
	$url = "http://".$this->host."/plugins/database.php". $get;
	$post = ["server" => $this->server, "users" => $this->users, "pass" => $this->pass, "dbname" => $this->dbname, "execute" => $arr, "prepare" => $qry];
	$ch = curl_init ($url);
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt ($ch, CURLOPT_POSTFIELDS, $post);
	return curl_exec ($ch);
	}
public function crt_gdps_data(){
	$sql = "CREATE TABLE IF NOT EXISTS `data` (
	`ID` int(11) AUTO_INCREMENT PRIMARY KEY,
	`dataString` longtext NOT NULL,
	`levelID` int(11) NOT NULL,
	`type` int(11) NOT NULL 
	) ENGINE=InnoDB DEFAULT CHARSET=utf8";
	return $sql;
	}
public function audioData ($m){
	$post = ["server" => $this->server, "users" => $this->users, "pass" => $this->pass, "dbname" => $this->dbname, "audio" => $m];
	$ch = curl_init ($this->getURLPlugin());
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt ($ch, CURLOPT_POSTFIELDS, $post);
	return curl_exec ($ch);
	}
}
