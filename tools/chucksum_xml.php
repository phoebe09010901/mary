<?php
// ABOUT
// =======================================================
// imageCheck_zz 影象數字確認器 ver:0.1
// made by zenon blue,December 2006
// http://www.bluezz.com.tw/mybook/content.php?id=458
// service@bluezz.com.tw
// Copyright 2006 by bluezz
// =======================================================
header("Content-Type: text/xml");
session_start();
$result=0;
//將字串換成大寫
$checksum=strtoupper($_REQUEST["checksum"]);
$s_checksum=$_SESSION['s_checksum'];
if( strLen($s_checksum) < 1 ){
	$result=2;	//沒有session
}elseif( $checksum ==  $s_checksum){
	$result=1;	//認證碼正確
}else{
	$result=0;	//認證碼錯誤
}
if(strlen($s_checksum) < 1 ||  strlen($checksum) < 1)
	$result=0;
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
?>

<root><?=  $result ?></root>