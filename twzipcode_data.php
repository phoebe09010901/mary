<?php
header("content-type:application/json;charset=utf-8");
require_once('set.php');

$data = array();

foreach($twzipcode as $zipcode => $value) {
	if($zipcode==3001 || $zipcode==3002 || $zipcode==3003)
		$show_zipcode = 300;
	else
		$show_zipcode = $zipcode;
	$row['label'] = ($show_zipcode!=0)?$show_zipcode.' '.$value['county'].$value['area']:$value['county'].$value['area'];
	$row['value'] = $zipcode;
	array_push($data, $row);
}

echo "{\"data\":" .json_encode($data). "}";exit;
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>無標題文件</title>
</head>

<body>
</body>
</html>