<?php
header("content-type:application/json;charset=utf-8");
require_once('set.php');

$obj_images = new files();

$data = array();
$_width  = 170;
$_height = 170;

if($_GET['action']=='photos_list') {
	$dog_id = format_data($_GET['dog_id'], 'int');

	$array_files = glob('doggie/'.$my_session_id.'/*');

	if(count($array_files)>0) {
		foreach($array_files as $key => $value) {
			$file_name = basename($value);
			if(is_file('doggie/'.$my_session_id.'/'.$file_name)) {
				$obj_images->show_pic2_show_number('doggie/'.$my_session_id.'/'.$file_name, $_width, $_height);
				$row['file1']    = $file_name;
				$row['width']    = $obj_images->size[0];
				$row['height']   = $obj_images->size[1];
				array_push($data, $row);
			}
		}
	}
	echo "{\"data\":" .json_encode($data). "}";exit;
}elseif($_GET['action']=='photos_list2') {
	$dog_id   = format_data($_GET['dog_id'], 'int');
	$apply_id = format_data($_GET['apply_id'], 'int');

	$array_files = glob('doggie/'.$dog_id.'/'.$apply_id.'/*');

	if(count($array_files)>0) {
		foreach($array_files as $key => $value) {
			$file_name = basename($value);
			$obj_images->show_pic2_show_number('doggie/'.$dog_id.'/'.$apply_id.'/'.$file_name, $_width, $_height);
			$row['file1']    = $file_name;
			$row['width']    = $obj_images->size[0];
			$row['height']   = $obj_images->size[1];
			array_push($data, $row);
		}
	}
	echo "{\"data\":" .json_encode($data). "}";exit;
}elseif($_GET['action']=='delete_photo') {
	$dog_id = format_data($_GET['dog_id'], 'int');
	$file1  = format_data($_GET['file1'], 'text');
	$obj_images->del_file(Root_Path.'doggie/'.$my_session_id.'/'.$file1);
	echo 'succeed';exit;
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
<?php include("include_bottom.php"); ?>
