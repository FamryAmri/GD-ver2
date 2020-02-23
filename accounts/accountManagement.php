<?php
include "../config/host.php";
if (strpos ($host, "boomlings.com")!==false){
	header ("location: http://www.boomlings.com/database/accounts/accountManagement.php");
	} else {
	header ("location: ../tools");
	}
