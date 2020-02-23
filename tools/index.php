<?php 
include dirname (__FILE__)."/../config/host.php";
function listdir($dir){
	$dirstring = "";
	$files = scandir($dir);
	foreach($files as $file) {
		if(pathinfo($file, PATHINFO_EXTENSION) == "php" AND $file != "index.php"){
			$dirstring .= "<li><a href='$dir/$file'>$file</a></li>";
		}
	}
	return $dirstring;
}
?>
<a href="http://<?php echo $host;?>/dashboard">Check out the dashboard beta here</a>
<h1>Account management tools:</h1><ul><li>
<a href='http://<?php echo $host;?>/account/changePassword.php'>changePassword.php</a></li>
<li><a href='http://<?php echo $host;?>/account/changePasswordNoSave.php'>changePasswordNoSave.php</a></li>
<li><a href='http://<?php echo $host;?>/account/changeUsername.php'>changeUsername.php</a></li>
</ul><h1>Upload related tools:</h1><ul><li><a href='http://<?php echo $host;?>/tools/leaderboardsBan.php'>leaderboardsBan.php</a></li>
<li><a href='http://<?php echo $host;?>/tools/leaderboardsUnban.php'>leaderboardsUnban.php</a></li><li><a href='http://<?php echo $host;?>/tools/levelReupload.php'>levelReupload.php</a></li>
<li><a href='http://<?php echo $host;?>/tools/levelToGD.php'>levelToGD.php</a></li>
<li><a href='http://<?php echo $host;?>/tools/linkAcc.php'>linkAcc.php</a></li>
<li><a href='http://<?php echo $host;?>/tools/packCreate.php'>packCreate.php</a></li>
<li><a href='http://<?php echo $host;?>/tools/revertLikes.php'>revertLikes.php</a></li>
<li><a href='http://<?php echo $host;?>/tools/saveDecode.php'>saveDecode.php</a></li>
<li><a href='http://<?php echo $host;?>/tools/songAdd.php'>songAdd.php</a></li></ul>
<h1>New Tools </h1><ul>
<?php
echo listdir ("tools"). "</ul>";
?>
<h1>The cron job (fixing CPs, autoban, etc.)</h1>
<ul><li><a href='http://<?php echo $host;?>/cron/cron.php'>cron.php</a></li>
</ul><h1>Stats related tools</h1><ul>
<li><a href='http://<?php echo $host;?>/tools/stats/dailyTable.php'>dailyTable.php</a></li>
<li><a href='http://<?php echo $host;?>/tools/stats/modActions.php'>modActions.php</a></li>
<li><a href='http://<?php echo $host;?>/tools/stats/noLogIn.php'>noLogIn.php</a></li>
<li><a href='http://<?php echo $host;?>/tools/stats/packTable.php'>packTable.php</a></li>
<li><a href='http://<?php echo $host;?>/tools/stats/reportList.php'>reportList.php</a></li>
<li><a href='http://<?php echo $host;?>/tools/stats/songList.php'>songList.php</a></li>
<li><a href='http://<?php echo $host;?>/tools/stats/stats.php'>stats.php</a></li>
<li><a href='http://<?php echo $host;?>/tools/stats/top24h.php'>top24h.php</a></li>
<li><a href='http://<?php echo $host;?>/tools/stats/unlisted.php'>unlisted.php</a></li>
<li><a href='http://<?php echo $host;?>/tools/stats/vipList.php'>vipList.php</a></li>