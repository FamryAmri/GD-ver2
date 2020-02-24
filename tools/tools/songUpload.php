<?php
	include "../../incl/lib/connection.php";
	$status = "Idle";
	$file_name = "-";
	$file_type = "-";
	$size = "0.00";
	$rename = "-";
    $adsid = "-";
$host = $_SERVER['HTTP_HOST']. $_SERVER['REQUEST_URI'];
   if(isset($_FILES['file'])){
      $file_name = $_FILES['file']['name'];
      $file_size = $_FILES['file']['size'];
      $file_tmp = $_FILES['file']['tmp_name'];
      $file_type = $_FILES['file']['type'];
      $tmp= explode ('.', $file_name);
      $file_ext=strtolower(end($tmp));
      $file_realname = str_replace (".mp3", "", basename($file_name));
      $size = round($file_size / 1024 / 1024, 2);
      //upload to database table in "data"
      if($file_type =="audio/mp3") {
      	if ($isDB == 1){
      	$query = $db->prepare ("SELECT * FROM songs ORDER BY ID DESC");
      $before = $query->fetchColumn();
      $before = $before + 1;
      } elseif ($isDB == 2){
      	$query = $db->dbremote_query ("SELECT * FROM songs ORDER BY ID DESC");
      $before = $db->dbremote_fetch ($query)->ID;
      $before = $before + 1; 
      }
      $download3 = "http://".$host."/songs.php?ID=$before.mp3";
         $data = file_get_contents ($file_tmp);
         $data = gzencode ($data);
         $data = base64_encode ($data);
         if ($isDB == 1){
         $query = $db->prepare("INSERT INTO songs (name, authorID, authorName, size, download) VALUES (:name, '9', :author, :size, :download)");
		 $query->execute([':name' => $file_realname, ':download' => $download, ':author' => 'Reupload', ':size' => $size]);
		 $ID = $db->lastInsertId();
		 $download = "http://".$host."/songs.php?ID=$ID.mp3";
         $query = $db->prepare ("INSERT INTO data ( dataString, IDs, type ) VALUES ( :data, :ID, :type)");
         $query->execute([":dataString" => $data, ":IDs" => $ID, ":type" => 3]);
         $query = $db->prepare ("UPDATE songs SET download = :download WHERE ID = :ID");
         $query->execute ([":download" => $download, ":ID" => $ID]);
         } elseif ($isDB == 2){
         	$ID = $db->dbremote_query ("INSERT INTO `songs` (`name`, `authorID`, `authorName`,`size`, `download`) VALUES ('$file_realname', '9', 'Reupload', $size, '$download')", true);
	         $query = $db->dbremote_query ("INSERT INTO `data` ( `dataString`, `IDs`, `type` ) VALUES ( '". $data."', $ID, 3)", false);
			 $download = "http://".$host."/songs.php?ID=$ID.mp3";
			 $query = $db->dbremote_query ("UPDATE `songs` SET download = '".$download."' WHERE ID = $ID", false);
		}
         echo "Song Uploaded <b>ID</b>: ". $ID;
      }else{
         echo "file is <b><font size='4'>not accepted</font></b> in <b><font size='4'>". $file_type."</font></b>";
      } 
   } else {
   	echo "Upload music must be in <b><font size='5'>MP3 ONLY</font></b>. For <b><font size='5'>LINK</font></b> <a href='http://". $host."/tools/songAdd.php'>CLICK HERE</a>";
   }
?><hr>
      <form action ="" method = "POST" id="uploadMusic" enctype = "multipart/form-data">
         <input type = "file" name = "file" />
         <input type = "submit" value="Upload" onclick="upload()"><p id="msg"></p>
         <script>
         	function upload (){
         	document.getElementId ("msg").innerHTML("<img src='https://cdn.lowgif.com/small/ff8280aafe27319d-ajax-loading-gif-transparent-background-2-gif-images.gif'></img>Uploading...");
         }
        </script>
