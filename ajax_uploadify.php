<?php
header("content-type:text/html;charset=utf-8");
require_once('set.php');

$obj_image   = new files();		

if($_POST['action']=='upload_photo') {
	$file_maxsize = 10;	//單位mb
	$_width       = 800;
	$_height      = 600;
	$main_str     = $_POST['main_str'];
	$dog_id       = $_POST['dog_id'];
	$my_session_id= $_POST['my_session_id'];
	//開啟相簿資料夾
	if(!is_dir(Root_Path.'doggie/'.$dog_id)) {
		$obj_image->add_dir(Root_Path.'doggie/'.$dog_id);
	}	
	//開啟session資料夾
	if(!is_dir(Root_Path.'doggie/'.$my_session_id)) {
		$obj_image->add_dir(Root_Path.'doggie/'.$my_session_id);
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
		//insert data
		$file_name = $dog_id.'_'.date("U").'.'.strtolower($tmp_filename[count($tmp_filename)-1]);
		$obj_image->uploaded_file($_FILES['Filedata']['tmp_name'], 'doggie/'.$my_session_id.'/'.$file_name);
		sleep(1);
		//調整圖片大小
		$file_name_r = explode('.', $file_name);
		$obj_image->resize_pic('doggie/'.$my_session_id.'/', 'doggie/'.$my_session_id.'/', $file_name_r[0], $file_name_r[1], $_width, $_height);
		
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