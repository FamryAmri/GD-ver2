<?php
class GJPCheck2 {
public function  passConvert($t, $pwdh){
	require_once "XORCipher.php";
	$xor = new XORCipher;
	$gjpdecode = str_replace("_","/",$t);
	$gjpdecode = str_replace("-","+",$gjpdecode);
	$gjpdecode = base64_decode($gjpdecode);
	$gjpdecode = $xor->cipher($gjpdecode,37526);
	if (password_verify ($gjpdecode, $pwdh)){
		return "1";
		} else {
			return "0";
			}
		}
	}
?>
