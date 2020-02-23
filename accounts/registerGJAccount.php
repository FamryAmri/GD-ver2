<?php
include "../incl/lib/connection.php";
$url = $host."/accounts/registerGJAccount.php";
$ch = curl_init ($url);
$post = ["secret" => $_POST['secret'], "userName" => $_POST['userName'], "password" => $_POST['password'], "email" => $_POST['email']];
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
echo curl_exec ($ch);
