<?php
class files {	
	var $size = array();
	//**********************************************
	//	檔案處理相關 function
	//**********************************************
	//file rename by time
	function file_rename1($file_name, $id) {
		$file_name = strtolower($file_name);
		$filename  = explode(".",$file_name);
		$temp      = $id."_".date("U");
		$filename  = $temp.'.'.$filename[count($filename)-1];
		return $filename;
	}
	//mkdir
	function add_dir($dir_path) {
		mkdir($dir_path, 0777);	
	}
	//delete dir
	function del_dir($dir_path) {
		rmdir($dir_path);	
	}
	//upload file
	function uploaded_file($tmp_name, $uppath){
		if(is_uploaded_file($tmp_name)){		
			if(!move_uploaded_file($tmp_name, $uppath)){
				js_a_l("上傳失敗，請檢查資料夾權限", "back");	
				exit;
			}	
		}
	}
	//copy file
	function copy_file($source, $new) {
		if(!copy($source, $new)) {
			js_a_l("複製失敗，請檢查資料夾權限", "back");	
			exit;
		}
	}
	//delete file
	function del_file($file_name) {
		if(file_exists($file_name)) {
			unlink($file_name);
		}
	}
	//uploadify
	function uploadify_js($uploadifyID, $picID, $showpicID, $formData_name, $formData_value) {
		echo '$("#'.$uploadifyID.'").uploadify({
            "swf"      : "../uploadify/uploadify.swf",
            "uploader" : "ajax_uploadify.php",
			formData   : { ';
		if(count($formData_name)>0) {
			foreach($formData_name as $key => $value) {
				if($value!="file_o")
					echo '"'.$value.'": "'.$formData_value[$key].'"';
				else
					echo '"'.$value.'": $("#'.$picID.'").val()';
				if($key<count($formData_name)-1)
					echo ", ";
			}
		}
		echo '},
			"onUploadSuccess" : function(file, data, response) {
				data = data.split("|");
				if(data[0]=="success") {';
		if($formData_value[0]!='upload_photo'&&$formData_value[0]!='upload_dogs_photo') {
			echo '	$("#'.$picID.'").val(data[1]);
					$("#'.$showpicID.'").attr("src", "../'.$formData_value[1].'/"+data[1]);
					$("#'.$showpicID.'").attr("width", data[2]);
					$("#'.$showpicID.'").attr("height", data[3]);';
		}else {
			echo 'show_list();';
		}
		echo '		}else {
					alert(data[0]);	
				}
			},
			"onUploadError" : function(file, errorCode, errorMsg, errorString) {
				alert("檔案 " + file.name + " 上傳失敗: " + errorString);
			}
    	});	 ';
	}
	//show_pic(path, pic_name, pic_width, pic_height, pic_alt) 固定大小
	function show_pic1($pic, $_width, $_height, $alt, $pic_id) {
		$check_pic = explode("/", $pic);
		if(file_exists(Root_Path.$path.$pic) && $check_pic[count($check_pic)-1]!='') {
			
			$this->size[0] = $_width;
			$this->size[1] = $_height;
		}else {
			$pic = 'images/space.png';
				
			$this->size[0] = $_width;
			$this->size[1] = $_height;
		}
		
		echo '<img id="'.$pic_id.'" src="'.Host_Name.$pic.'" width="'.$this->size[0].'" height="'.$this->size[1].'" alt="'.$alt.'" title="'.$alt.'" border="0">';
	}
	//show_pic(pic_name, pic_width, pic_height, pic_alt) 變換大小
	function show_pic2($pic, $_width, $_height, $alt, $pic_id) {
		$check_pic = explode("/", $pic);
		if(file_exists(Root_Path.$pic) && $check_pic[count($check_pic)-1]!='') {
			$this->size = getimagesize(Root_Path.$pic);
			
			if($_width > 0) {
				if ($this->size[0] > $_width) {
					$this->size[1] = $this->size[1] * $_width / $this->size[0];
					$this->size[0] = $_width;
				}	
			}
			if($_height > 0) {
				if ($this->size[1] > $_height) {
					$this->size[0] = $this->size[0] * $_height / $this->size[1];
					$this->size[1] = $_height;
				}
			}
			if($_width>0 && $_height>0) {
				$_width_str  = 'width="'.$this->size[0].'"';
				$_height_str = 'height="'.$this->size[1].'"';
			}elseif($_width>0 && $_height==0) {
				$_width_str  = 'width="'.$this->size[0].'"';
				$_height_str = '';
			}elseif($_width==0 && $_height>0) {
				$_width_str  = '';
				$_height_str = 'height="'.$this->size[1].'"';
			}
		}else {
			$pic = 'images/space.png';
				
			$this->size[0] = $_width;
			$this->size[1] = $_height;
		}
		
		echo '<img id="'.$pic_id.'" src="'.Host_Name.$pic.'" '.$_width_str.' '.$_height_str.' alt="'.$alt.'" title="'.$alt.'" border="0">';
	}
	//依比例縮小後之圖片長寬
	function show_pic2_show_number($pic, $_width, $_height) {
		if($pic!='') {
			$this->size = getimagesize($pic);
				
			if ($this->size[0] > $_width) {
				$this->size[1] = $this->size[1] * $_width / $this->size[0];
				$this->size[0] = $_width;
			}	
			if ($this->size[1] > $_height) {
				$this->size[0] = $this->size[0] * $_height / $this->size[1];
				$this->size[1] = $_height;
			}
		}else {				
			$this->size[0] = $_width;
			$this->size[1] = $_height;
		}
		
		return $this->size;
	}
	//resize function
	function resize_pic($path, $new_path, $filename, $tmp_name, $hope_width, $hope_height) {
		if($tmp_name=='jpg'||$tmp_name=='JPG') {
			$this->jpg_resize($path, $new_path, $filename, $tmp_name, $hope_width, $hope_height);
		}
		elseif($tmp_name=='png'||$tmp_name=='PNG') {
			$this->png_resize($path, $new_path, $filename, $tmp_name, $hope_width, $hope_height);
		}
		elseif($tmp_name=='gif'||$tmp_name=='GIF') {
			$this->gif_resize($path, $new_path, $filename, $tmp_name, $hope_width, $hope_height);
		}
	}
	function jpg_resize($path,$new_path,$filename,$tmp_name,$hope_width,$hope_height) {
		$src = imagecreatefromjpeg($path.$filename.".".$tmp_name);
		
		// get the source image's widht and hight
		$src_w = imagesx($src);
		$src_h = imagesy($src);
		
		// assign thumbnail's widht and hight
		$thumb_w = $src_w;
		$thumb_h = $src_h;
		
		if($thumb_w > $hope_width) {
			$thumb_h = $thumb_h * $hope_width / $thumb_w;
			$thumb_w = $hope_width; 
		}
		if($thumb_h > $hope_height) {
			$thumb_w = $thumb_w * $hope_height / $thumb_h;
			$thumb_h = $hope_height;
		}
		
		$thumb = imagecreatetruecolor($thumb_w, $thumb_h);
		imagecopyresampled($thumb, $src, 0, 0, 0, 0, $thumb_w, $thumb_h, $src_w, $src_h);
		imagejpeg($thumb, $new_path.$filename.".".$tmp_name);
	}
	function png_resize($path,$new_path,$filename,$tmp_name,$hope_width,$hope_height) {
		$src = imagecreatefrompng($path.$filename.".".$tmp_name);
		
		// get the source image's widht and hight
		$src_w = imagesx($src);
		$src_h = imagesy($src);
		
		// assign thumbnail's widht and hight
		$thumb_w = $src_w;
		$thumb_h = $src_h;
		
		if($thumb_w > $hope_width) {
			$thumb_h = $thumb_h * $hope_width / $thumb_w;
			$thumb_w = $hope_width; 
		}
		if($thumb_h > $hope_height) {
			$thumb_w = $thumb_w * $hope_height / $thumb_h;
			$thumb_h = $hope_height;
		}
		
		$thumb = imagecreatetruecolor($thumb_w, $thumb_h);
		imagecopyresampled($thumb, $src, 0, 0, 0, 0, $thumb_w, $thumb_h, $src_w, $src_h);
		imagepng($thumb, $new_path.$filename.".".$tmp_name);
	}
	function gif_resize($path,$new_path,$filename,$tmp_name,$hope_width,$hope_height) {
		$src = imagecreatefromgif($path.$filename.".".$tmp_name);
		
		// get the source image's widht and hight
		$src_w = imagesx($src);
		$src_h = imagesy($src);
		
		// assign thumbnail's widht and hight
		$thumb_w = $src_w;
		$thumb_h = $src_h;
		
		if($thumb_w > $hope_width) {
			$thumb_h = $thumb_h * $hope_width / $thumb_w;
			$thumb_w = $hope_width; 
		}
		if($thumb_h > $hope_height) {
			$thumb_w = $thumb_w * $hope_height / $thumb_h;
			$thumb_h = $hope_height;
		}
		
		$thumb = imagecreatetruecolor($thumb_w, $thumb_h);
		imagecopyresampled($thumb, $src, 0, 0, 0, 0, $thumb_w, $thumb_h, $src_w, $src_h);
		imagegif($thumb, $new_path.$filename.".".$tmp_name);
	}	
}
?>