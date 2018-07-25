<?php
header("content-type:application/json;charset=utf-8");
require_once('set.php');

$main_str   = 'admin';
$table_name = Proj_Name.'_'.$main_str;	

$data = array();

if($_GET['action']=='delete') {	//delete
	$data_id = format_data($_GET['data_id'], 'int');
	$query = "delete from $table_name where Fullkey='".$data_id."'";	
	$obj_admin->run_mysql($query);
	if($obj_admin->result) {
		echo 'succeed';	
	}else {
		echo 'error';	
	}exit;
}elseif($_GET['action']=='update_row') {	//update
	$data_id   = format_data($_GET['data_id'], 'int');
	$row_name  = format_data($_GET['row_name'], 'text');
	$row_value = format_data($_GET['row_value'], 'text');
	$query = "update $table_name set ".$row_name."='".$row_value."' where Fullkey='$data_id'";
	$obj_admin->run_mysql($query);
	if($obj_admin->result) {
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