<?php
header("content-type:application/json;charset=utf-8");
require_once('set.php');
require_once(Root_Includes_Path.'function_js2php.php');

$main_str   = 'album';
$table_name = Proj_Name.'_'.$main_str;	
$obj_images = new files();		

$data = array();
$_width  = 170;
$_height = 170;

if($_GET['action']=='delete') {	//delete
	$data_id = format_data($_GET['data_id'], 'int');
	$query = "delete from $table_name where Fullkey='".$data_id."'";	
	$obj_album->run_mysql($query);
	//delete photos
	$query = "select file1 from ".$table_name."_photos where album_id='".$Fullkey."'";
	$obj_photo->run_mysql_list($query);
	for($i=0; $i<$obj_photo->obj_all; $i++) {
		$photo = mysql_fetch_array($obj_photo->result);	
		if($photo){ 
			if(is_file(Root_Path.$main_str.'_photos/'.$Fullkey.'/'.$photo['file1'])) {
				//echo Root_Path.$main_str.'_photos/'.$Fullkey.'/'.$photo['file1'].'<br>';
				$obj_image->del_file(Root_Path.$main_str.'_photos/'.$Fullkey.'/'.$photo['file1']); 
			}
		}
	}
	$query = "delete from ".$table_name."_photos where album_id='".$Fullkey."'";	
	$obj_photo->run_mysql($query);
	//刪除資料夾
	if(is_dir(Root_Path.$main_str.'_photos/'.$Fullkey))
		$obj_image->del_dir(Root_Path.$main_str.'_photos/'.$Fullkey);
	if($obj_album->result) {
		echo 'succeed';	
	}else {
		echo 'error';	
	}exit;
}elseif($_GET['action']=='update_row') {	//update
	$data_id   = format_data($_GET['data_id'], 'int');
	$row_name  = format_data($_GET['row_name'], 'text');
	$row_value = format_data($_GET['row_value'], 'text');
	$query = "update $table_name set ".$row_name."='".$row_value."' where Fullkey='$data_id'";
	$obj_album->run_mysql($query);
	if($obj_album->result) {
		echo 'succeed';	
	}else {
		echo 'error';	
	}exit;
}elseif($_GET['action']=='photos_list') {
	$album_id = format_data($_GET['album_id'], 'int');
	$query = "select Fullkey, file1, title, sort from ".$table_name."_photos where album_id='".$album_id."' order by sort desc, Fullkey asc";	
	$obj_photo->run_mysql_list($query);
	for($i=0; $i<$obj_photo->obj_all; $i++) {
		$photo = mysql_fetch_array($obj_photo->result);	
		if($photo) {
			$obj_images->show_pic2_show_number('../'.$main_str.'_photos/'.$album_id.'/'.$photo['file1'], $_width, $_height);
			$row['photo_id'] = $photo['Fullkey'];
			$row['file1']    = $photo['file1'];
			$row['width']    = $obj_images->size[0];
			$row['height']   = $obj_images->size[1];
			$row['title']    = ($photo['title'])?$photo['title']:'輸入標題後按下Enter';
			$row['sort']     = ($photo['sort'])?$photo['sort']:'數字越大排序越前面';
			array_push($data, $row);
		}
	}
	echo "{\"data\":" .json_encode($data). "}";exit;
}elseif($_GET['action']=='update_photo') {
	$_GET['update_text'] = uniDecode($_GET['update_text']);
	$photo_id    = format_data($_GET['photo_id'], 'int');
	$update_row  = format_data($_GET['update_row'], 'text');
	$update_text = format_data($_GET['update_text'], 'text');
	$query = "update ".$table_name."_photos set ".$update_row."='".$update_text."' where Fullkey='$photo_id'";
	$obj_photo->run_mysql($query);
	if($obj_photo->result) {
		echo 'succeed';	
	}else {
		echo 'error';	
	}exit;
}elseif($_GET['action']=='delete_photo') {
	$photo_id = format_data($_GET['photo_id'], 'int');	
	$file1    = format_data($_GET['file1'], 'text');		
	$obj_images->del_file(Root_Path.$main_str.'_photos/'.$album_id.'/'.$file1);
	//delete
	$query = "delete from ".$table_name."_photos where Fullkey='$photo_id'";
	$obj_photo->run_mysql($query);
	if($obj_photo->result) {
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