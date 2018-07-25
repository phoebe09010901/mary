<?php
$DB_Host = "localhost";
$DB_Login = "adoptado_cloud";
$DB_Password = "0911556220";
$DB_Name = "adoptado_marydog3";

$DB = mysql_connect($DB_Host,$DB_Login,$DB_Password);
mysql_select_db($DB_Name);
$sqldefault="SET NAMES utf8;";
mysql_query($sqldefault);
$sqldefault="SET CHARACTER_SET_CLIENT=utf8;";
mysql_query($sqldefault);
$sqldefault="SET CHARACTER_SET_RESULTS=utf8;";
mysql_query($sqldefault);
?>
