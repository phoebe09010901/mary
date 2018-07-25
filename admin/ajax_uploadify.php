<?php
header("content-type:text/html;charset=utf-8");
require_once('../set.php');

$obj_image   = new files();		

if($_POST['action']=='upload_banner') {
	$file_maxsize = 5;	//單位mb
	$main_str     = $_POST['main_str'];
	$Fullkey      = $_POST['Fullkey'];
	$file_o       = $_POST['file_o'];
	$key          = $_POST['key'];
	$category     = $_POST['category'];
	switch($category) {
		case 1:
			$_width  = 1226;
			$_height = 697;
			break;
		case 2:
		case 3:
		case 4:
		case 5:
		case 6:
			$_width  = 800;
			$_height = 600;
			break;
	}
	if (!empty($_FILES)) {		
		//檢查上傳檔案
		if(round($_FILES['Filedata']['size']/1024/1024, 2) > $file_maxsize) {
			echo '上傳之檔案大小不可超過 '.$file_maxsize.' MB';exit;
		}
		$tmp_filename = explode('.',$_FILES['Filedata']['name']);
		if(array_search(strtolower($tmp_filename[count($tmp_filename)-1]), $allow_pic)===false) {
			echo '上傳檔案格式錯誤';exit;
		}
		if ($file_o != '' && file_exists('../'.$main_str.'/'.$_POST['file_o'])) {
			$obj_image->del_file('../'.$main_str.'/'.$file_o);
		}
		$file_name = date("U").'.'.strtolower($tmp_filename[count($tmp_filename)-1]);
		$obj_image->uploaded_file($_FILES['Filedata']['tmp_name'], '../'.$main_str.'/'.$file_name);
		//調整圖片大小
		$file_name_r = explode('.', $file_name);
		//$obj_image->resize_pic('../'.$main_str.'/', '../'.$main_str.'/', $file_name_r[0], $file_name_r[1], $_width, $_height);
		//update data
		if($Fullkey) {
			$query = "update ".Proj_Name."_".$main_str." set file".$key."='$file_name' where Fullkey='$Fullkey'";
			$obj_file->run_mysql($query);
		}
		//縮小後尺寸
		$obj_image->show_pic2_show_number($pic, $_width_s, $_height_s);
		
		echo 'success|'.$file_name.'|'.$obj_image->size[0].'|'.$obj_image->size[1];
	}
	exit;
}elseif($_POST['action']=='upload_pages') {
	$file_maxsize = 5;	//單位mb
	$main_str     = $_POST['main_str'];
	$Fullkey      = $_POST['Fullkey'];
	$file_o       = $_POST['file_o'];
	$key          = $_POST['key'];
	$category     = $_POST['category'];
	$_width  = 800;
	$_height = 600;
	
	if (!empty($_FILES)) {		
		//檢查上傳檔案
		if(round($_FILES['Filedata']['size']/1024/1024, 2) > $file_maxsize) {
			echo '上傳之檔案大小不可超過 '.$file_maxsize.' MB';exit;
		}
		$tmp_filename = explode('.',$_FILES['Filedata']['name']);
		if(array_search(strtolower($tmp_filename[count($tmp_filename)-1]), $allow_pic)===false) {
			echo '上傳檔案格式錯誤';exit;
		}
		if ($file_o != '' && file_exists('../'.$main_str.'/'.$_POST['file_o'])) {
			$obj_image->del_file('../'.$main_str.'/'.$file_o);
		}
		$file_name = date("U").'.'.strtolower($tmp_filename[count($tmp_filename)-1]);
		$obj_image->uploaded_file($_FILES['Filedata']['tmp_name'], '../'.$main_str.'/'.$file_name);
		//調整圖片大小
		$file_name_r = explode('.', $file_name);
		//$obj_image->resize_pic('../'.$main_str.'/', '../'.$main_str.'/', $file_name_r[0], $file_name_r[1], $_width, $_height);
		//update data
		if($Fullkey) {
			$query = "update ".Proj_Name."_".$main_str." set file".$key."='$file_name' where Fullkey='$Fullkey'";
			$obj_file->run_mysql($query);
		}
		//縮小後尺寸
		$obj_image->show_pic2_show_number($pic, $_width_s, $_height_s);
		
		echo 'success|'.$file_name.'|'.$obj_image->size[0].'|'.$obj_image->size[1];
	}
	exit;
}elseif($_POST['action']=='upload_news') {
	$file_maxsize = 5;	//單位mb
	$main_str     = $_POST['main_str'];
	$Fullkey      = $_POST['Fullkey'];
	$file_o       = $_POST['file_o'];
	$key          = $_POST['key'];
	$category     = $_POST['category'];
	$_width  = 800;
	$_height = 600;
	
	if (!empty($_FILES)) {		
		//檢查上傳檔案
		if(round($_FILES['Filedata']['size']/1024/1024, 2) > $file_maxsize) {
			echo '上傳之檔案大小不可超過 '.$file_maxsize.' MB';exit;
		}
		$tmp_filename = explode('.',$_FILES['Filedata']['name']);
		if(array_search(strtolower($tmp_filename[count($tmp_filename)-1]), $allow_pic)===false) {
			echo '上傳檔案格式錯誤';exit;
		}
		if ($file_o != '' && file_exists('../'.$main_str.'/'.$_POST['file_o'])) {
			$obj_image->del_file('../'.$main_str.'/'.$file_o);
		}
		$file_name = date("U").'.'.strtolower($tmp_filename[count($tmp_filename)-1]);
		$obj_image->uploaded_file($_FILES['Filedata']['tmp_name'], '../'.$main_str.'/'.$file_name);
		//調整圖片大小
		$file_name_r = explode('.', $file_name);
		//$obj_image->resize_pic('../'.$main_str.'/', '../'.$main_str.'/', $file_name_r[0], $file_name_r[1], $_width, $_height);
		//update data
		if($Fullkey) {
			$query = "update ".Proj_Name."_".$main_str." set file".$key."='$file_name' where Fullkey='$Fullkey'";
			$obj_file->run_mysql($query);
		}
		//縮小後尺寸
		$obj_image->show_pic2_show_number($pic, $_width_s, $_height_s);
		
		echo 'success|'.$file_name.'|'.$obj_image->size[0].'|'.$obj_image->size[1];
	}
	exit;
}elseif($_POST['action']=='upload_photo') {
	$file_maxsize = 10;	//單位mb
	$_width       = 1200;
	$_height      = 900;
	$main_str     = $_POST['main_str'];
	$album_id     = $_POST['album_id'];
	if (!empty($_FILES)) {		
		//檢查上傳檔案
		if(round($_FILES['Filedata']['size']/1024/1024, 2) > $file_maxsize) {
			echo '上傳之檔案大小不可超過 '.$file_maxsize.' MB';exit;
		}
		$tmp_filename = explode('.',$_FILES['Filedata']['name']);
		if(array_search(strtolower($tmp_filename[count($tmp_filename)-1]), $allow_pic)===false) {
			echo '上傳檔案格式錯誤';exit;
		}
		//insert data
		$query  = "LOCK TABLES ".Proj_Name."_".$main_str."_photos WRITE;";
		$obj_file->run_mysql($query);
		$file_name = $_FILES['Filedata']['name'];
		$obj_image->uploaded_file($_FILES['Filedata']['tmp_name'], '../'.$main_str.'_photos/'.$album_id.'/'.$file_name);
		$query = "insert into ".Proj_Name."_".$main_str."_photos(album_id, file1, title, sort, pub, create_time) values('$album_id', '$file_name', '$file_name', 0, 1, now())";
		$obj_file->run_mysql($query);
		$query  = "UNLOCK TABLES;";
		$obj_file->run_mysql($query);
		//調整圖片大小
		$file_name_r = explode('.', $file_name);
		//$obj_image->resize_pic('../'.$main_str.'_photos/'.$album_id.'/', '../'.$main_str.'_photos/'.$album_id.'/', $file_name_r[0], $file_name_r[1], $_width, $_height);
		
		echo 'success|'.$file_name;
	}
	exit;
}elseif($_POST['action']=='upload_dogs_photo') {
	$file_maxsize = 10;	//單位mb
	$_width       = 1200;
	$_height      = 900;
	$main_str     = $_POST['main_str'];
	$dog_id       = $_POST['dog_id'];
	if (!empty($_FILES)) {		
		//檢查上傳檔案
		if(round($_FILES['Filedata']['size']/1024/1024, 2) > $file_maxsize) {
			echo '上傳之檔案大小不可超過 '.$file_maxsize.' MB';exit;
		}
		$tmp_filename = explode('.',$_FILES['Filedata']['name']);
		if(array_search(strtolower($tmp_filename[count($tmp_filename)-1]), $allow_pic)===false) {
			echo '上傳檔案格式錯誤';exit;
		}
		//insert data
		$query  = "LOCK TABLES ".Proj_Name."_".$main_str."_photos WRITE;";
		$obj_file->run_mysql($query);
		$file_name = $_FILES['Filedata']['name'];
		$obj_image->uploaded_file($_FILES['Filedata']['tmp_name'], '../'.$main_str.'_photos/'.$dog_id.'/'.$file_name);
		$query = "insert into ".Proj_Name."_".$main_str."_photos(dog_id, file1, title, sort, pub, create_time) values('$dog_id', '$file_name', '$file_name', 0, 1, now())";
		$obj_file->run_mysql($query);
		$query  = "UNLOCK TABLES;";
		$obj_file->run_mysql($query);
		//調整圖片大小
		$file_name_r = explode('.', $file_name);
		//$obj_image->resize_pic('../'.$main_str.'_photos/'.$dog_id.'/', '../'.$main_str.'_photos/'.$dog_id.'/', $file_name_r[0], $file_name_r[1], $_width, $_height);
		
		echo 'success|'.$file_name;
	}
	exit;
}elseif($_POST['action']=='upload_prod_file') {
	$file_maxsize = 3;	//單位mb
	$_width       = 800;
	$_height      = 600;
	$main_str     = $_POST['main_str'];
	$Fullkey      = $_POST['Fullkey'];
	$file_o       = $_POST['file_o'];
	$key          = $_POST['key'];
	$_width_s     = $_POST['_width_s'];
	$_height_s    = $_POST['_height_s'];
	if (!empty($_FILES)) {		
		//檢查上傳檔案
		if(round($_FILES['Filedata']['size']/1024/1024, 2) > $file_maxsize) {
			echo '上傳之檔案大小不可超過 '.$file_maxsize.' MB';exit;
		}
		$tmp_filename = explode('.',$_FILES['Filedata']['name']);
		if(array_search(strtolower($tmp_filename[count($tmp_filename)-1]), $allow_pic)===false) {
			echo '上傳檔案格式錯誤';exit;
		}
		if ($file_o != '' && file_exists('../'.$main_str.'/'.$_POST['file_o'])) {
			$obj_image->del_file('../'.$main_str.'/'.$file_o);
		}
		if ($file_o != '' && file_exists('../'.$main_str.'/thumb/'.$_POST['file_o'])) {
			$obj_image->del_file('../'.$main_str.'/thumb/'.$file_o);
		}
		$file_name = date("U").'.'.strtolower($tmp_filename[count($tmp_filename)-1]);
		$obj_image->uploaded_file($_FILES['Filedata']['tmp_name'], '../'.$main_str.'/'.$file_name);
		//調整圖片大小
		$file_name_r = explode('.', $file_name);
		$obj_image->resize_pic('../'.$main_str.'/', '../'.$main_str.'/thumb/', $file_name_r[0], $file_name_r[1], $_width_s, $_height_s);
		//update data
		if($Fullkey) {
			$query = "update ".Proj_Name."_".$main_str." set file".$key."='$file_name' where Fullkey='$Fullkey'";
			$obj_file->run_mysql($query);
		}
		//縮小後尺寸
		$obj_image->show_pic2_show_number($pic, $_width_s, $_height_s);
		
		echo 'success|'.$file_name.'|'.$obj_image->size[0].'|'.$obj_image->size[1];
	}
	exit;
}elseif($_POST['action']=='upload_dogs') {
	$file_maxsize = 3;	//單位mb
	$_width       = 800;
	$_height      = 600;
	$main_str     = $_POST['main_str'];
	$Fullkey      = $_POST['Fullkey'];
	$file_o       = $_POST['file_o'];
	$key          = $_POST['key'];
	$_width_s     = $_POST['_width_s'];
	$_height_s    = $_POST['_height_s'];
	if (!empty($_FILES)) {		
		//檢查上傳檔案
		if(round($_FILES['Filedata']['size']/1024/1024, 2) > $file_maxsize) {
			echo '上傳之檔案大小不可超過 '.$file_maxsize.' MB';exit;
		}
		$tmp_filename = explode('.',$_FILES['Filedata']['name']);
		if(array_search(strtolower($tmp_filename[count($tmp_filename)-1]), $allow_pic)===false) {
			echo '上傳檔案格式錯誤';exit;
		}
		if ($file_o != '' && file_exists('../'.$main_str.'/'.$_POST['file_o'])) {
			$obj_image->del_file('../'.$main_str.'/'.$file_o);
		}
		$file_name = date("U").'.'.strtolower($tmp_filename[count($tmp_filename)-1]);
		$obj_image->uploaded_file($_FILES['Filedata']['tmp_name'], '../'.$main_str.'/'.$file_name);
		//調整圖片大小
		$file_name_r = explode('.', $file_name);
		$obj_image->resize_pic('../'.$main_str.'/', '../'.$main_str.'/', $file_name_r[0], $file_name_r[1], $_width_s, $_height_s);
		//update data
		if($Fullkey) {
			$query = "update ".Proj_Name."_".$main_str." set file".$key."='$file_name' where Fullkey='$Fullkey'";
			$obj_file->run_mysql($query);
		}
		//縮小後尺寸
		$obj_image->show_pic2_show_number($pic, $_width_s, $_height_s);
		
		echo 'success|'.$file_name.'|'.$obj_image->size[0].'|'.$obj_image->size[1];
	}
	exit;
}elseif($_POST['action']=='upload_download') {
	$file_maxsize = 10;	//單位mb
	$main_str     = $_POST['main_str'];
	$Fullkey      = $_POST['Fullkey'];
	$file1_o      = $_POST['file1_o'];
	$key          = $_POST['key'];
	
	if (!empty($_FILES)) {		
		//檢查上傳檔案
		if(round($_FILES['Filedata']['size']/1024/1024, 2) > $file_maxsize) {
			echo '上傳之檔案大小不可超過 '.$file_maxsize.' MB';exit;
		}
		$tmp_filename = explode('.',$_FILES['Filedata']['name']);
		if(array_search(strtolower($tmp_filename[count($tmp_filename)-1]), $allow_file)===false) {
			echo '上傳檔案格式錯誤';exit;
		}
		if ($file1_o != '' && file_exists('../'.$main_str.'/'.$_POST['file1_o'])) {
			$obj_image->del_file('../'.$main_str.'/'.$file1_o);
		}
		$file_name = date("U").'.'.strtolower($tmp_filename[count($tmp_filename)-1]);
		$obj_image->uploaded_file($_FILES['Filedata']['tmp_name'], '../'.$main_str.'/'.$file_name);
		//update data
		if($Fullkey) {
			$query = "update ".Proj_Name."_".$main_str." set file".$key."='$file_name' where Fullkey='$Fullkey'";
			$obj_file->run_mysql($query);
		}
		
		echo 'success|'.$file_name;
	}
	exit;
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