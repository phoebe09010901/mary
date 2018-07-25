<?php
header("content-type:application/json;charset=utf-8");
require_once('set.php');

$main_str   = 'banner';
$table_name = Proj_Name.'_'.$main_str;	
$obj_images = new files();		

$data = array();
$category = $_GET['category'];
switch($category) {
	case 1:
		$_width  = 600;
		$_height = 75;
		break;
	case 2:
		$_width  = 100;
		$_height = 100;
		break;
}

if($_GET['action']=='delete') {	//delete
	$data_id = format_data($_GET['data_id'], 'int');
	$query = "delete from $table_name where Fullkey='".$data_id."'";	
	$obj_banner->run_mysql($query);
	if($obj_banner->result) {
		echo 'succeed';	
	}else {
		echo 'error';	
	}exit;
}elseif($_GET['action']=='update_row') {	//update
	$data_id   = format_data($_GET['data_id'], 'int');
	$row_name  = format_data($_GET['row_name'], 'text');
	$row_value = format_data($_GET['row_value'], 'text');
	$query = "update $table_name set ".$row_name."='".$row_value."' where Fullkey='$data_id'";
	$obj_banner->run_mysql($query);
	if($obj_banner->result) {
		echo 'succeed';	
	}else {
		echo 'error';	
	}exit;
}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>無標題文件</title>
</head>

<body>
</body>
</html>