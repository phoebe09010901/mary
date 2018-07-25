<?php
header("content-type:text/html;charset=utf-8");
require_once('set.php');
require_once(Root_Includes_Path.'class_sendmail.php');

$obj_image = new files();
$obj_mail  = new sendmail();
$dog_id    = format_data($_GET['dog_id'], 'int');
$file_num  = 1;
$_width    = 800;
$_height   = 600;

if($_POST['action']=='save') {
	$dog_id = format_data($_POST['dog_id'], 'int');
	$key_c  = format_data($_POST['key_c'], 'text');
	$key_c_c= format_data($_POST['key_c_c'], 'text');
    //check check_code
	if(strtoupper($key_c) != strtoupper($key_c_c)) {
		js_a_l('Verification code error.', 'back');exit;
	}
	$apply1_num = 15;
	$apply2_num = 54;
	$apply3_num = 10;
	$apply4_num = 21;
	$apply5_num = 34;
	$apply6_num = 10;
	$apply7_num = 2;
	$apply8_num = 24;
	$apply9_num = 12;
	for($i=1; $i<=182; $i++) {
		$_POST['ans'.$i] = format_data($_POST['ans'.$i], 'text');
	}
	//apply1
	$query = "insert into ".$table_name_dogs."_apply1(dog_id";
	for($i=1; $i<=$apply1_num; $i++) {
		$query .= ", ans".$i."";
	}
	$query .= ", pub, create_time) values('$dog_id'";
	for($i=1; $i<=15; $i++) {
		$query .= ", '".$_POST['ans'.$i]."'";
	}
	$query .= ", 1, now())";//echo $query.'<br>';
	$obj_dogs->run_mysql($query);
	$apply_id = mysql_insert_id();
	//apply2
	$query = "insert into ".$table_name_dogs."_apply2(apply_id";
	for($i=1; $i<=$apply2_num; $i++) {
		$query .= ", ans".$i."";
	}
	$query .= ", pub, create_time) values('$apply_id'";
	for($i=16; $i<=63; $i++) {
		$query .= ", '".$_POST['ans'.$i]."'";
	}
	for($i=170; $i<=172; $i++) {
		$query .= ", '".$_POST['ans'.$i]."'";
	}
	for($i=179; $i<=181; $i++) {
		$query .= ", '".$_POST['ans'.$i]."'";
	}
	$query .= ", 1, now())";//echo $query.'<br>';
	$obj_dogs->run_mysql($query);
	//apply3
	$query = "insert into ".$table_name_dogs."_apply3(apply_id";
	for($i=1; $i<=$apply3_num; $i++) {
		$query .= ", ans".$i."";
	}
	$query .= ", pub, create_time) values('$apply_id'";
	for($i=64; $i<=73; $i++) {
		$query .= ", '".$_POST['ans'.$i]."'";
	}
	$query .= ", 1, now())";//echo $query.'<br>';
	$obj_dogs->run_mysql($query);
	//apply4
	$query = "insert into ".$table_name_dogs."_apply4(apply_id";
	for($i=1; $i<=$apply4_num; $i++) {
		$query .= ", ans".$i."";
	}
	$query .= ", pub, create_time) values('$apply_id'";
	for($i=74; $i<=89; $i++) {
		$query .= ", '".$_POST['ans'.$i]."'";
	}
	for($i=174; $i<=178; $i++) {
		$query .= ", '".$_POST['ans'.$i]."'";
	}
	$query .= ", 1, now())";//echo $query.'<br>';
	$obj_dogs->run_mysql($query);
	//apply5
	$query = "insert into ".$table_name_dogs."_apply5(apply_id";
	for($i=1; $i<=$apply5_num; $i++) {
		$query .= ", ans".$i."";
	}
	$query .= ", pub, create_time) values('$apply_id'";
	for($i=90; $i<=121; $i++) {
		$query .= ", '".$_POST['ans'.$i]."'";
	}
	for($i=173; $i<=173; $i++) {
		$query .= ", '".$_POST['ans'.$i]."'";
	}
	for($i=182; $i<=182; $i++) {
		$query .= ", '".$_POST['ans'.$i]."'";
	}
	$query .= ", 1, now())";//echo $query.'<br>';
	$obj_dogs->run_mysql($query);
	//apply6
	$query = "insert into ".$table_name_dogs."_apply6(apply_id";
	for($i=1; $i<=$apply6_num; $i++) {
		$query .= ", ans".$i."";
	}
	$query .= ", pub, create_time) values('$apply_id'";
	for($i=122; $i<=131; $i++) {
		$query .= ", '".$_POST['ans'.$i]."'";
	}
	$query .= ", 1, now())";//echo $query.'<br>';
	$obj_dogs->run_mysql($query);
	//apply7
	$query = "insert into ".$table_name_dogs."_apply7(apply_id";
	for($i=1; $i<=$apply7_num; $i++) {
		$query .= ", ans".$i."";
	}
	$query .= ", pub, create_time) values('$apply_id'";
	for($i=132; $i<=133; $i++) {
		$query .= ", '".$_POST['ans'.$i]."'";
	}
	$query .= ", 1, now())";//echo $query.'<br>';
	$obj_dogs->run_mysql($query);
	//apply8
	$query = "insert into ".$table_name_dogs."_apply8(apply_id";
	for($i=1; $i<=$apply8_num; $i++) {
		$query .= ", ans".$i."";
	}
	$query .= ", pub, create_time) values('$apply_id'";
	for($i=134; $i<=157; $i++) {
		$query .= ", '".$_POST['ans'.$i]."'";
	}
	$query .= ", 1, now())";//echo $query.'<br>';
	$obj_dogs->run_mysql($query);
	//apply9
	$query = "insert into ".$table_name_dogs."_apply9(apply_id";
	for($i=1; $i<=$apply9_num; $i++) {
		$query .= ", ans".$i."";
	}
	$query .= ", pub, create_time) values('$apply_id'";
	for($i=158; $i<=169; $i++) {
		$query .= ", '".$_POST['ans'.$i]."'";
	}
	$query .= ", 1, now())";//echo $query.'<br>';
	$obj_dogs->run_mysql($query);
	//儲存照片
	//開啟相簿資料夾
	if(!is_dir(Root_Path.'doggie/'.$dog_id.'/'.$apply_id)) {
		$obj_image->add_dir(Root_Path.'doggie/'.$dog_id.'/'.$apply_id);
	}
	$array_files = glob('doggie/'.$dog_id.'/*');

	if(count($array_files)>0) {
		foreach($array_files as $key => $value) {
			$file_name = basename($value);
			if(is_file('doggie/'.$dog_id.'/'.$file_name)) {
				$obj_image->copy_file('doggie/'.$dog_id.'/'.$file_name, 'doggie/'.$dog_id.'/'.$apply_id.'/'.$file_name);
				$obj_image->del_file('doggie/'.$dog_id.'/'.$file_name);
			}
		}
	}
	//send mail
	$obj_mail->apply($apply_id);

	js_a_l('We have received your information will contact you as soon as possible, thank you.', 'back');exit;
}
//dogs
$query = "select * from $table_name_dogs where Fullkey='$dog_id'";
$dogs = $obj_dogs->run_mysql_out($query);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<meta name="viewport" content="width=device-width, initial-scale=1">

<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<!--
<link href="fonts.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="css/all.css">
<link rel="stylesheet" href="css/top_menu.css">
-->
<script type="text/javascript" src="scripts/jquery-1.10.2.min.js"></script>
<!-- uploadify -->
<script type="text/javascript" src="uploadify/jquery.uploadify-3.1.min.js"></script>
<link rel="stylesheet" type="text/css" href="uploadify/uploadify.css" />
<script type="text/javascript">
function real_save() {
	check = 0;
	df = document.apply_form;
	if(!df.getelementbyname("ans16").value) {
		alert("Please enter First Name.");
        df.getelementbyname("ans16").focus();
		check++;
		return false;
	//}else if(!df.getelementbyname("ans17").value) {
		//alert("Please enter Middle Name.");
		//check++;
		//return false;
	}else if(!df.getelementbyname("ans18").value) {
		alert("Please enter Last Name.");
        df.getelementbyname("ans18").focus();
		check++;
		return false;
	}else if(!df.getelementbyname("ans19").value) {
		alert("Please enter Email.");
        df.getelementbyname("ans19").focus();
		check++;
		return false;
	//}else if(!df.getelementbyname("ans26").value && !df.getelementbyname("ans27").value && !df.getelementbyname("ans28").value) {
		//alert("Please enter Home Tel.");
		//check++;
		//return false;
	}else if(!df.getelementbyname("ans29").value && !df.getelementbyname("ans30").value && !df.getelementbyname("ans31").value) {
		alert("Please enter Cell Tel.");
        df.getelementbyname("ans29").focus();
		check++;
		return false;
	}else if(!df.getelementbyname("#key_c").value) {
		alert("Please enter Verification Code.");
        df.getelementbyname("#key_c").focus();
		check++;
		return false;
	}
	if(check==0) {
		df.submit();
		//return true;
	}
}
$( document ).ajaxStart(function() {
	$( "#photos_list" ).html( '<div id="loading_img" style="text-align:center; height:300px; margin-top:150px;"><img src="../images/lightbox/loading.gif" border="0"></div>' );
});
$( document ).ajaxStop(function() {
	$( "#loading_img" ).hide();
});
function show_list() {
	$("#photos_list").html('');
	var ajaxurl = 'doggie_data.php?action=photos_list&dog_id=<?=$dog_id?>';
	$.ajax({
		url: ajaxurl,
		dataType: 'json',
		success: function(request) {
			$.each(request, function(key, photo_data) {
				$.each(photo_data, function(key, data)	{
					var div_str = '<div id="show_photo_block_'+key+'" class="show_photo" onmouseover="mouseover_show_btn(\''+key+'\')" onmouseout="mouseover_hidden_btn(\''+key+'\')"><div class="photo_block"><div id="photo_del_'+key+'" class="del_btn" onclick="delete_photo(\''+key+'\', \''+data['file1']+'\')"><img src="images/close.png" border="0"></div><img src="doggie/<?=$dog_id?>/'+data['file1']+'" width="'+data['width']+'" height="'+data['height']+'" alt="'+data['title']+'" id="photo_file1_'+key+'"></div></div>';//alert(div_str);
					$("#photos_list").html($("#photos_list").html()+div_str);
				})
			})
		}
	});
}
function mouseover_show_btn(photo_id) {
	$("#photo_del_"+photo_id).show();
}
function mouseover_hidden_btn(photo_id) {
	$("#photo_del_"+photo_id).hide();
}
function delete_photo(photo_id, file1) {
	if(confirm("確定要刪除 ("+file1+") 此張相片??")) {
		var ajaxurl = 'doggie_data.php?action=delete_photo&dog_id=<?=$dog_id?>&file1='+file1;
		$.ajax({
			url: ajaxurl,
			dataType: 'html',
			success: function(request) {
				$("#show_photo_block_"+photo_id).hide("slow");
				show_list();
			}
		});
	}
}
$(document).ready(function () {
	var theme = '<?=jqxStyle?>';
	//upload file
	$("#file1_upload").uploadify({
            "swf"      : "uploadify/uploadify.swf",
            "uploader" : "ajax_uploadify.php",
			formData   : { "action": "upload_photo", "main_str": "dogs", "dog_id": "<?=$dog_id?>"},
			"onUploadSuccess" : function(file, data, response) {
				data = data.split("|");
				if(data[0]=="success") {
					show_list();
				}else {
					alert(data[0]);
				}
			},
			"onUploadError" : function(file, errorCode, errorMsg, errorString) {
				alert("檔案 " + file.name + " 上傳失敗: " + errorString);
			}
    	});
	show_list();
});
</script>
<style type="text/css">
.upload_photo {
	padding: 10px;
	text-align:left;
}
.show_photo {
	position: relative;
	float:left;
	width:190px;
	height:280px;
	margin: 15px 0 0 15px;
	text-align:center;
}
.show_photo input{
	margin: 5px 2px 0 2px;
}
.photo_block {
	width:100%;
	height:180px;
	text-align:center;
	border: #FFF solid 2px;
}
.photo_block:hover {
	border: #f5794d dashed 2px;
}
.photo_title_text1 {
	width: 170px;
	color: #CCC;
}
.photo_title_text2 {
	width: 170px;
	color: #000;
}
.photo_sort_text1 {
	width: 170px;
	color: #CCC;
}
.photo_sort_text2 {
	width: 170px;
	color: #000;
}
.del_btn {
	position:absolute;
	top: 0;right:0;
	text-align:right;
	width:16px;
	margin: 5px;
	display:none;
	cursor:pointer;
}
</style>

<style>
@font-face
{
	/*font-family: a;*/
	font-family: "Museo Sans 500";
	src: url('http://adoptadoggie.org/font/MuseoSans.eot');
	src: url('http://adoptadoggie.org/font/MuseoSans.eot?#iefix') format('embedded-opentype'),
	url('http://adoptadoggie.org/font/MuseoSans.svg#Museo Sans 500') format('svg'),
	url('http://adoptadoggie.org/font/MuseoSans.woff') format('woff'),
	url('http://adoptadoggie.org/font/MuseoSans.ttf') format('truetype');
	font-weight: normal;
	font-style: normal;
}
@font-face
{
	/*font-family: b;*/
	font-family: "Museo Sans 500 Italic";
	src: url('http://adoptadoggie.org/font/MuseoSans_500_Italic.eot');
	src: url('http://adoptadoggie.org/font/MuseoSans_500_Italic.eot?#iefix') format('embedded-opentype'),
	url('http://adoptadoggie.org/font/MuseoSans_500_Italic.svg#Museo Sans 500') format('svg'),
	url('http://adoptadoggie.org/font/MuseoSans_500_Italic.woff') format('woff'),
	url('http://adoptadoggie.org/font/MuseoSans_500_Italic.ttf') format('truetype');
	font-weight: normal;
	font-style: normal;
}
@font-face
{
	/*font-family: c;*/
	font-family: "Myriad Pro bold";
	src: url('http://adoptadoggie.org/font/myriadprobold.eot');
	src: url('http://adoptadoggie.org/font/myriadprobold.eot?#iefix') format('embedded-opentype'),
	url('http://adoptadoggie.org/font/myriadprobold.svg#Myriad Pro') format('svg'),
	url('http://adoptadoggie.org/font/myriadprobold.woff') format('woff'),
	url('http://adoptadoggie.org/font/myriadprobold.ttf') format('truetype');
	font-weight: normal;
	font-style: normal;
}
@font-face
{
	/*font-family: j;*/
	font-family: "Myriad Pro";
	src: url('http://adoptadoggie.org/font/MyriadPro-Regular.eot');
	src: url('http://adoptadoggie.org/font/MyriadPro-Regular.eot?#iefix') format('embedded-opentype'),
	url('http://adoptadoggie.org/font/MyriadPro-Regular.svg#Myriad Pro') format('svg'),
	url('http://adoptadoggie.org/font/MyriadPro-Regular.woff') format('woff'),
	url('http://adoptadoggie.org/font/MyriadPro-Regular.ttf') format('truetype');
	font-weight: normal;
	font-style: normal;
}
@font-face
{
	/*font-family: m;*/
	font-family: "HelveticaNeue-Bold";
	src: url('http://adoptadoggie.org/font/HelveticaNeue-Bold.eot');
	src: url('http://adoptadoggie.org/font/HelveticaNeue-Bold.eot?#iefix') format('embedded-opentype'),
	url('http://adoptadoggie.org/font/HelveticaNeue-Bold.svg#HelveticaNeue') format('svg'),
	url('http://adoptadoggie.org/font/HelveticaNeue-Bold.woff') format('woff'),
	url('http://adoptadoggie.org/font/HelveticaNeue-Bold.ttf') format('truetype');
	font-weight: normal;
	font-style: normal;
}
@font-face
{
	font-family: "Helvetica Neue";
	src: url('http://adoptadoggie.org/font/hlzc.eot');
	src: url('http://adoptadoggie.org/font/hlzc.eot?#iefix') format('embedded-opentype'),
	url('http://adoptadoggie.org/font/hlzc.svg#Helvetica Neue') format('svg'),
	url('http://adoptadoggie.org/font/hlzc.woff') format('woff'),
	url('http://adoptadoggie.org/font/hlzc.ttf') format('truetype');
	font-weight: normal;
	font-style: normal;
}


@charset "utf-8";
/* CSS Document */
* {
	/*box-sizing:border-box;
	-webkit-box-sizing:border-box;
	-moz-box-sizing:border-box;
	-ms-box-sizing:border-box;
	解除padding跟width的關係*/
    text-decoration: none;
}
/*背景滿版*/
html{
	width:100%; /*背景滿版*/
	height:100%; /*背景滿版*/
}

body{
	margin:0;
	padding:0;
	width:100%; /*背景滿版*/
	height:100%; /*背景滿版*/
}
ul li
{
list-style-type:none;
}
img{
border:0;
}

#wrapper {
	width: 1279px;
    margin-top: 0;
	margin-right: auto;
	margin-bottom: 0;
	margin-left: auto;
}
#wrapper_center {
	width: 1024px;
	height:100%;
	margin:0 auto;
	background: url(http://adoptadoggie.org/images/top_bg.png) no-repeat top right;
}
#wrapper_center_03 {
	width: 1024px;
	height:100%;
	margin:0 auto;
	background: url(http://adoptadoggie.org/images/top_bg_03.png) no-repeat top right;
}
#wrapper_center_04 {
	width: 1024px;
	height:100%;
	margin:0 auto;
	background: url(http://adoptadoggie.org/images/top_bg_04.png) no-repeat top right;
}
#wrapper_center_05 {
	width: 1024px;
	height:100%;
	margin:0 auto;
	background: url(http://adoptadoggie.org/images/top_bg_05.png) no-repeat top right;
}
#wrapper_center_06 {
	width: 1024px;
	height:100%;
	margin:0 auto;
	background: url(http://adoptadoggie.org/images/top_bg_06.png) no-repeat top right;
}
#wrapper_center_07 {
	width: 1024px;
	height:100%;
	margin:0 auto;
	background: url(http://adoptadoggie.org/images/top_bg_07.png) no-repeat top right;
}
  .textbox_box {
	font-family: Arial, Helvetica, sans-serif;
	background: rgba(255, 255, 255, 0.44);
	color: #333;
	border: 1px solid #C2CB56;
	padding: 4px 8px 4px 4px !important;
	line-height: 1;
	width: 275px;
	height: 10px;
  }
 .textbox_box:hover {
    border: 1px solid #FF00FF;
    box-shadow: inset 0px 1px 2px rgba(0,0,0,0.3);
    -moz-box-shadow: inset 0px 1px 2px rgba(0,0,0,0.3);
    -webkit-box-shadow: inset 0px 1px 2px rgba(0,0,0,0.3);
  }
 .textbox_box:focus {
    border: 1px solid #4d90fe;
    outline: none;
    box-shadow: inset 0px 1px 2px rgba(0,0,0,0.3);
    -moz-box-shadow: inset 0px 1px 2px rgba(0,0,0,0.3);
    -webkit-box-shadow: inset 0px 1px 2px rgba(0,0,0,0.3);
    background: rgb(255, 255, 255); }


  .textbox_box2 {
	font-family: Arial, Helvetica, sans-serif;
	background: rgba(255, 255, 255, 0.44);
	color: #333;
	border: 1px solid #C2CB56;
	padding: 4px 8px 4px 4px !important;
	line-height: 1;
	width: 40px;
	height: 10px;
  }
 .textbox_box2:hover {
    border: 1px solid #FF00FF;
    box-shadow: inset 0px 1px 2px rgba(0,0,0,0.3);
    -moz-box-shadow: inset 0px 1px 2px rgba(0,0,0,0.3);
    -webkit-box-shadow: inset 0px 1px 2px rgba(0,0,0,0.3);
  }
 .textbox_box2:focus {
    border: 1px solid #4d90fe;
    outline: none;
    box-shadow: inset 0px 1px 2px rgba(0,0,0,0.3);
    -moz-box-shadow: inset 0px 1px 2px rgba(0,0,0,0.3);
    -webkit-box-shadow: inset 0px 1px 2px rgba(0,0,0,0.3);
    background: rgb(255, 255, 255); }

 .textbox_box3 {
	font-family: Arial, Helvetica, sans-serif;
	background: rgba(255, 255, 255, 0.44);
	color: #333;
	border: 1px solid #C2CB56;
	padding: 4px 8px 4px 4px !important;
	line-height: 1;
	width: 80px;
	height: 10px;
  }
 .textbox_box3:hover {
    border: 1px solid #FF00FF;
    box-shadow: inset 0px 1px 2px rgba(0,0,0,0.3);
    -moz-box-shadow: inset 0px 1px 2px rgba(0,0,0,0.3);
    -webkit-box-shadow: inset 0px 1px 2px rgba(0,0,0,0.3);
  }
 .textbox_box3:focus {
    border: 1px solid #4d90fe;
    outline: none;
    box-shadow: inset 0px 1px 2px rgba(0,0,0,0.3);
    -moz-box-shadow: inset 0px 1px 2px rgba(0,0,0,0.3);
    -webkit-box-shadow: inset 0px 1px 2px rgba(0,0,0,0.3);
    background: rgb(255, 255, 255); }


 .textbox_box4 {
	font-family: Arial, Helvetica, sans-serif;
	background: rgba(255, 255, 255, 0.44);
	color: #333;
	border: 1px solid #C2CB56;
	padding: 4px 8px 4px 4px !important;
	line-height: 1;
	width: 400px;
	height: 60px;
  }
 .textbox_box4:hover {
    border: 1px solid #FF00FF;
    box-shadow: inset 0px 1px 2px rgba(0,0,0,0.3);
    -moz-box-shadow: inset 0px 1px 2px rgba(0,0,0,0.3);
    -webkit-box-shadow: inset 0px 1px 2px rgba(0,0,0,0.3);
  }
 .textbox_box4:focus {
    border: 1px solid #4d90fe;
    outline: none;
    box-shadow: inset 0px 1px 2px rgba(0,0,0,0.3);
    -moz-box-shadow: inset 0px 1px 2px rgba(0,0,0,0.3);
    -webkit-box-shadow: inset 0px 1px 2px rgba(0,0,0,0.3);
    background: rgb(255, 255, 255); }

 .textbox_box5 {
	font-family: Arial, Helvetica, sans-serif;
	background: rgba(255, 255, 255, 0.44);
	color: #333;
	border: 1px solid #C2CB56;
	padding: 4px 8px 4px 4px !important;
	line-height: 1;
	width: 400px;
	height: 10px;
  }
 .textbox_box5:hover {
    border: 1px solid #FF00FF;
    box-shadow: inset 0px 1px 2px rgba(0,0,0,0.3);
    -moz-box-shadow: inset 0px 1px 2px rgba(0,0,0,0.3);
    -webkit-box-shadow: inset 0px 1px 2px rgba(0,0,0,0.3);
  }
 .textbox_box5:focus {
    border: 1px solid #4d90fe;
    outline: none;
    box-shadow: inset 0px 1px 2px rgba(0,0,0,0.3);
    -moz-box-shadow: inset 0px 1px 2px rgba(0,0,0,0.3);
    -webkit-box-shadow: inset 0px 1px 2px rgba(0,0,0,0.3);
    background: rgb(255, 255, 255); }

.text_line{/*nico*/
	height: 13px;
	width: 275px;
	background-color: transparent;
	border-style: solid;
	border-width: 0px 0px 1px 0px;
	border-color: #A4AC35;
	outline: 0;
  }
.text_line2{/*nico*/
	height: 18px;
	width: 150px;
	background-color: transparent;
	border-style: solid;
	border-width: 0px 0px 1px 0px;
	border-color: #A4AC35;
	outline: 0;
  }

.center_T {
	width: 980px;
	margin: 0 auto;
}
.center_R3{/*phoebe*/
	float: right;
	width: 54px;
	height:350px;
	background-image: url(http://adoptadoggie.org/images/r_bg2.png);
	background-repeat: no-repeat;
}
.center_R4{/*phoebe*/
	float: right;
	width: 54px;
	height:350px;
	background-image: url(http://adoptadoggie.org/images/r_bg4.png);
	background-repeat: no-repeat;
}
.center_R5{/*phoebe*/
	float: right;
	width: 54px;
	height:350px;
	background-image: url(http://adoptadoggie.org/images/r_bg5.png);
	background-repeat: no-repeat;
}
.center_R6{/*phoebe*/
	float: right;
	width: 54px;
	height:350px;
	background-image: url(http://adoptadoggie.org/images/r_bg6.png);
	background-repeat: no-repeat;
}
.top{
	float: right;
	width: 27px;
	height:27px;
	}
.top4{/*phoebe*/
	float: left;
	width: 960px;
	text-align: right;
	}

/*---------------------------Adoption---------------------------------*/
.adoption{
	width: 960px;
	background-color: #FFF;
	margin:0 auto;
	overflow:auto;/*解決子元素float而父元素高度無法自動撐高的問題*/
	}
.adoption_1{
	float: left;
	width: 980px;
	height: 224px;
	background: url(http://adoptadoggie.org/images/adoption_1.png) no-repeat top 0px left 6px;
	}
.adoption_1_1{
	float: left;
	width: 900px;
	margin-top: 20px;
	margin-left: 40px;
	}
.adoption_1_2{/*phoebe*/
	float: left;
	width: 390px;
	height:110px;
	margin-top: 20px;
	margin-left: 47px;
	}
.adoption_1_3{/*phoebe*/
	float: right;
	width: 355px;
	height: 60px;
	border-bottom: #FFF 1px solid;
	margin:18px 50px 0 20px;
	}
.adoption_1_4{/*phoebe*/
	float: right;
	width: 355px;
	margin: 5px 50px 0 20px;
	height: 50px;
	}
.adoption_2{
	float: left;
	width: 980px;
	}
.adoption_2_all{
	float: left;
	width: 196px;
	height: 351px;
	background-image: url(http://adoptadoggie.org/images/0a_06.png);
	}
.adoption_2_1{
	float: left;
	width: 190px;
	height: 214px;
	margin: 3px;
	overflow: hidden;
	}
.adoption_2_2{
	float: left;
	width: 170px;
	height: 121px;
	margin-top: 10px;
	margin-right: 5px;
	margin-left: 15px;
	}
.adoption_2_3{
	float: left;
	height: 25px;
	display: block;
	margin-top: 20px;
	margin-left: 35px;
	}
.btn_APPLY {
 margin: 10px 0 0 0;
 float: right;
 height: 21px;
 width: 138px;
}

.btn_APPLY_02 {
/* IE9 SVG, needs conditional override of 'filter' to 'none' */
background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgdmlld0JveD0iMCAwIDEgMSIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+CiAgPGxpbmVhckdyYWRpZW50IGlkPSJncmFkLXVjZ2ctZ2VuZXJhdGVkIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgeDE9IjAlIiB5MT0iMCUiIHgyPSIwJSIgeTI9IjEwMCUiPgogICAgPHN0b3Agb2Zmc2V0PSIwJSIgc3RvcC1jb2xvcj0iIzAwMDAwMCIgc3RvcC1vcGFjaXR5PSIwLjE5Ii8+CiAgICA8c3RvcCBvZmZzZXQ9IjkyJSIgc3RvcC1jb2xvcj0iIzAwMDAwMCIgc3RvcC1vcGFjaXR5PSIwIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjEwMCUiIHN0b3AtY29sb3I9IiMwMDAwMDAiIHN0b3Atb3BhY2l0eT0iMCIvPgogIDwvbGluZWFyR3JhZGllbnQ+CiAgPHJlY3QgeD0iMCIgeT0iMCIgd2lkdGg9IjEiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+);
background: -moz-linear-gradient(top,  rgba(0,0,0,0.19) 0%, rgba(0,0,0,0) 92%, rgba(0,0,0,0) 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(0,0,0,0.19)), color-stop(92%,rgba(0,0,0,0)), color-stop(100%,rgba(0,0,0,0))); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top,  rgba(0,0,0,0.19) 0%,rgba(0,0,0,0) 92%,rgba(0,0,0,0) 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top,  rgba(0,0,0,0.19) 0%,rgba(0,0,0,0) 92%,rgba(0,0,0,0) 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top,  rgba(0,0,0,0.19) 0%,rgba(0,0,0,0) 92%,rgba(0,0,0,0) 100%); /* IE10+ */
background: linear-gradient(to bottom,  rgba(0,0,0,0.19) 0%,rgba(0,0,0,0) 92%,rgba(0,0,0,0) 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#30000000', endColorstr='#00000000',GradientType=0 ); /* IE6-8 */

	-webkit-border-radius: 3px;   /*元角*/
	-moz-border-radius: 3px;
	-ms-border-radius: 3px;
	border-radius: 3px;
	width:135px;
	height:9px;
	float:right;
}


/*---------------------- happy phoebe--------------------------------------*/
.big_title {
		float: left;
		width:165px;
		height:164px;
		font-family: "Myriad Pro bold";
		color:#FFF;
		font-size:28px;
		text-align:left;
		margin-right:20px;
		padding-top:25px;
		padding-left:18px;
		line-height:25px;
	}
.photo_block {
		float: left;
		width:170px;
		height:152px;
		margin: 16px 10px 7px 0;
		font-size:12px;
		line-height:40px;
		color:#FFF;
		font-family: "Museo Sans 500";
		overflow: hidden;
	}
.photo_block_2 {
		float: left;
		width:170px;
		height:122px;
		margin: 16px 10px 7px 0;
		font-size:12px;
		line-height:40px;
		color:#FFF;
		font-family: "Museo Sans 500";
		overflow: hidden;
	}
.happy{
	width: 960px;
	background-color: #FFF;
	margin:0 auto;
	overflow:auto;/*解決子元素float而父元素高度無法自動撐高的問題*/
	padding: 20px 0 0 20px;
	}
.happy_1{
	float: left;
	width: 940px;
	/*height: 189px;*/
	-webkit-border-radius: 5px;   /*元角*/
	-moz-border-radius: 5px;
	-ms-border-radius: 5px;
	border-radius: 5px;
	background-color: #b8cc39;
	margin-top: 20px;
	background-image: url(http://adoptadoggie.org/images/ha_b1.png);
	background-repeat: no-repeat;
	background-position: bottom left;
	margin-bottom:20px;
	}
	.happy_1 .movie_block {
		float: left;
		width:223px;
		margin: 18px 20px 13px 0px;
		font-size:12px;
		color:#FFF;
		font-family: "Museo Sans 500";
	}
.happy_2{
	float: left;
	width: 940px;
	-webkit-border-radius: 5px;   /*元角*/
	-moz-border-radius: 5px;
	-ms-border-radius: 5px;
	border-radius: 5px;
	background-color: #98C509;
	margin-top: 20px;
	background-image: url(http://adoptadoggie.org/images/ha_b2.png);
	background-repeat: no-repeat;
	background-position:bottom left;
	margin-bottom:20px;
	}
.happy_2_2 {
	float: left;
	width: 923px;
	-webkit-border-radius: 5px;   /*元角*/
	-moz-border-radius: 5px;
	-ms-border-radius: 5px;
	border-radius: 5px;
	background-color: #98C509;
	margin-top: 20px;
	background-image: url(http://adoptadoggie.org/images/ha_b2.png);
	background-repeat: no-repeat;
	background-position:bottom left;
	padding-bottom:10px;
	padding-right:16px;
	}
.happy_3{
	float: left;
	width: 940px;
	-webkit-border-radius: 5px;   /*元角*/
	-moz-border-radius: 5px;
	-ms-border-radius: 5px;
	border-radius: 5px;
	background-color: #81B227;
	margin-top: 20px;
	background-image: url(http://adoptadoggie.org/images/ha_b3.png);
	background-repeat: no-repeat;
	background-position:bottom left;
	}
.happy_3_2{
	float: left;
	width: 923px;
	-webkit-border-radius: 5px;   /*元角*/
	-moz-border-radius: 5px;
	-ms-border-radius: 5px;
	border-radius: 5px;
	background-color: #81B227;
	margin-top: 20px;
	background-image: url(http://adoptadoggie.org/images/ha_b3.png);
	background-repeat: no-repeat;
	background-position:bottom left;
	padding-bottom:10px;
	padding-right:16px;
	}
.happy_4{
	width: 960px;
	background-color: #FFF;
	margin:0 auto;
	overflow:auto;/*解決子元素float而父元素高度無法自動撐高的問題*/
	padding: 20px 0 0 20px;
	}
.happy_5{
	width: 960px;
	height:150px;
	margin:0 auto;
	overflow:auto;/*解決子元素float而父元素高度無法自動撐高的問題*/
	background:url(http://adoptadoggie.org/images/happybg.jpg) no-repeat top -2px left 0px #FFF;
	padding: 0 0 0 20px;
	}

/*---------------------- rescue phoebe --------------------------------------*/
.rescue{
	width: 1004px;
	margin:0 auto;
	overflow:auto;/*解決子元素float而父元素高度無法自動撐高的問題*/
	padding: 20px 0 0 20px;
	background:url(http://adoptadoggie.org/images/rescue_bg.png) no-repeat top 0px left 22px;
	}
.rescue_02{
	width: 940px;
	overflow:auto;/*解決子元素float而父元素高度無法自動撐高的問題*/
	margin-left:22px;
	}
.rescue_1{
	float: left;
	width: 940px;
	height: 380px;
	-webkit-border-radius: 15px;   /*元角*/
	border-radius: 15px;
	background-color: #336bb3;
	display: block;
	margin-top: 20px;
	}
.rescue_1_1{
	float: left;
	width: 540px;
	height: 380px;
	}
.rescue_1_2{
	float: left;
	width: 360px;
	height: 250px;
	padding: 20px;
	}
.rescue_1_3{

	}

.rescue_1_3 a {
	float: right;
	width: 200px;
	height: 32px;
	text-align: right;
	background-image: url(http://adoptadoggie.org/images/re_icon1.png);
	background-repeat: no-repeat;
	background-position: left 60px top 0px;
	margin-top:5px;
	padding-top: 5px;
	padding-right: 25px;
	padding-bottom: 5px;
	padding-left: 20px;
	}
.rescue_1_3 a:hover {
	float: right;
	width: 200px;
	height: 32px;
	text-align: right;
	background-image: url(http://adoptadoggie.org/images/re_icon12.png);
	background-repeat: no-repeat;
	background-position: left 60px top 0px;
	margin-top:5px;
	padding-top: 5px;
	padding-right: 25px;
	padding-bottom: 5px;
	padding-left: 20px;
	}
.rescue_1_4{

	}
.rescue_1_4 a {
	float: right;
	width: 200px;
	height: 32px;
	text-align: right;
	background-image: url(http://adoptadoggie.org/images/re_icon2.png);
	background-repeat: no-repeat;
	background-position: left 60px top 0px;
	padding-top: 5px;
	padding-right: 25px;
	padding-bottom: 5px;
	padding-left: 20px;
	}
.rescue_1_4 a:hover {
	float: right;
	width: 200px;
	height: 32px;
	text-align: right;
	background-image: url(http://adoptadoggie.org/images/re_icon22.png);
	background-repeat: no-repeat;
	background-position: left 60px top 0px;
	padding-top: 5px;
	padding-right: 25px;
	padding-bottom: 5px;
	padding-left: 20px;
	}
.rescue_2{
	float: left;
	width: 940px;
	height: 380px;
	display: block;
	margin-top: 20px;
	}
.rescue_2_1{
	float: left;
	width: 500px;
	height:938px;
	display: block;
	margin-top: 30px;
	margin-left: 20px;
	margin-bottom:50px;
	}
.rescue_2_2{
	float: right;
	width: 400px;
	display: block;
	}
.rescue_2_3{
	width: 600px;
	height: 532px;
	position: absolute;
	background-image: url(http://adoptadoggie.org/images/re_p1.png);
	display: block;
	z-index: 998;
	margin-left: 500px;
	margin-top: 1050px;
	}
.rescue_3{/*phoebe*/
	float: left;
	margin-left:20px;
	}
.rescue_3_1{
	float: left;
	}
.rescue_3_1_all{/*phoebe*/
	float: left;
	width: 278px;
	height: 180px;
	margin: 10px 5px 10px 13px;
	}
.rescue_3_1_1{
	float: left;
	width: 278px;
	height: 170px;
	}
.rescue_3_1_2{/*phoebe*/
	float: left;
	width: 278px;
	height: 30px;
	padding-top: 0px;
	font-family: "Myriad Pro";
	font-size: 12px;
	color: #FFF;
	}
.rescue_3_2{
	float: left;
	}
.rescue_3_2_all{
	float: left;
	width: 203px;
	height: 152px;
	margin: 10px 5px 10px 13px;
	background-color: #9dcde4;
	overflow: hidden;
	}

/*---------------------- training phoebe--------------------------------------*/
.training{
	width: 960px;
	background-color: #FFF;
	margin:0 auto;
	overflow:auto;/*解決子元素float而父元素高度無法自動撐高的問題*/
	padding: 20px 0 0 20px;
	background:url(http://adoptadoggie.org/images/trainingbg.png) no-repeat top left #FFF;
	}
.training_1{
	float: left;
	width: 940px;
	height: 380px;
	-webkit-border-radius: 15px;   /*元角*/
	border-radius: 15px;
	background-color: #6C4090;
	display: block;
	margin-top: 20px;
	}
.training_1_1{
	float: left;
	width: 540px;
	height: 380px;
	}
.training_1_2{
	float: left;
	width: 355px;
	height: 173px;
	padding: 20px;
	}
.training_1_3{
	float: right;
	width: 190px;
	height: 20px;
	text-align: right;
	background-repeat: no-repeat;
	margin-right: 15px;
	}
.training_1_4{
	float: right;
	width: 190px;
	height: 20px;
	padding: 20px;
	text-align: right;
	background-image: url(http://adoptadoggie.org/images/re_icon2.png);
	background-repeat: no-repeat;
	margin-left: 150px;
	}
.training_2{
	float: left;
	width: 940px;
	height: 380px;
	display: block;
	margin-top: 20px;
	}
.training_2_1{
	float: left;
	width: 500px;
	height:440px;
	display: block;
	margin-top: 30px;
	margin-left: 20px;
	}
.training_2_2{
	float: right;
	width: 400px;
	display: block;
	margin-right: 20px;
	}
.training_2_3{
	width: 600px;
	height: 532px;
	position: absolute;
	background-image: url(http://adoptadoggie.org/images/re_p1.png);
	display: block;
	z-index: 998;
	margin-left: 500px;
	margin-top: 1050px;
	}
.training_3{
	position: absolute;
	z-index: 1000;
	float: left;
	width: 940px;
	margin-top: 1520px;
	margin-left: 20px;
	}
.training_3_1{
	float: left;
	width: 940px;
	margin-top: 20px;
	}
.training_3_1_all{
	float: left;
	width: 278px;
	height: 230px;
	margin: 10px;
	}
.training_3_1_1{
	float: left;
	width: 278px;
	height: 170px;
	}
.training_3_1_2{
	float: left;
	width: 278px;
	height: 50px;
	padding-top: 40px;
	font-family: "Myriad Pro";
	font-size: 12px;
	color: #FFF;
	}
.training_3_2{
	float: left;
	width: 940px;
	}
.training_3_2_all{
	float: left;
	width: 203px;
	height: 152px;
	margin: 10px;
	background-color: #9dcde4;
	}
.training_4 {
	float: left;
	width: 940px;
	/*height: 189px;*/
	-webkit-border-radius: 5px;   /*元角*/
	-moz-border-radius: 5px;
	-ms-border-radius: 5px;
	border-radius: 5px;
	background-color: #A09ED5;
	background-image: url(http://adoptadoggie.org/images/training_b1.png);
	background-repeat: no-repeat;
	background-position: bottom left;
	margin-bottom:20px;
	}
	.training_4 .movie_block {
		float: left;
		width:223px;
		height:152px;
		margin: 22px 20px 10px 0;
		font-size:12px;
		line-height:21px;
		color:#FFF;
		font-family: "Museo Sans 500";
	}


/*----------------------About--------------------------------------*/
.about{
	width: 982px;
	margin:0 auto;
	overflow:auto;/*解決子元素float而父元素高度無法自動撐高的問題*/
	padding: 20px 0 0 42px;
	background:url(http://adoptadoggie.org/images/about_bg.png) no-repeat bottom 0px right 0px;
	}
.about_02{
	width: 940px;
	margin-left:0px;
	}
.about_1{
	float: left;
	width: 940px;
	background-color: #FFF;
	}
.about_2{
	float: left;
	width: 940px;
	height: 480px;
	background-color: #EFEFEF;
	-webkit-border-radius: 5px;   /*元角*/
	-moz-border-radius: 5px;
	-ms-border-radius: 5px;
	border-radius: 5px;
	}
.about_2_1{
	float: left;
	width: 940px;
	height: 220px;
	background-image: url(http://adoptadoggie.org/images/about_2_1.png);
	background-position:top -20px left 0px;
	display: block;
	background-repeat: no-repeat;
	}
.about_2_2_1{
	font-family: "Museo Sans 500";
	float: left;
	font-size: 13px;
	color: #3975b0;
	width: 192px;
	margin-right: 93px;
	margin-left: 15px;
	}
.about_2_2_2{
	font-family: "Museo Sans 500";
	float: left;
	font-size: 13px;
	color: #3975b0;
	width: 341px;
	margin-right: 69px;
	}
.about_2_2_3{
	font-family: "Museo Sans 500";
	float: left;
	font-size: 13px;
	color: #3975b0;
	width: 213px;


	}
.about_2_3_1{
	font-family: "Museo Sans 500";
	float: left;
	font-size: 13px;
	color: #3975b0;
	width: 175px;
	margin-right: 69px;
	margin-left: 196px;
	margin-top: 30px;

	}
.about_2_3_2{
	font-family: "Museo Sans 500";
	float: left;
	font-size: 13px;
	color: #3975b0;
	width: 192px;
	margin-left: 125px;
	margin-top: 30px;

	}
.about_L{
	float: left;
	width: 517px;
	font-family: "Myriad Pro";
	font-size: 14px;
	line-height: 21px;
	color: #282626;
	}
.about_L2{
	float: left;
	width: 517px;
	font-family: "Myriad Pro";
	font-size: 14px;
	line-height: 21px;
	color: #282626;
	}
.about_LRs{
	float: left;
	width: 497px;
	height: 100px;
	margin-bottom: 20px;
	}
.about_R{
	float: right;
	width: 400px;
	height:auto;
	}
.about_R1{
	float: right;
	width: 400px;
	height: 252px;
	background-color: #E2E2E3;
	overflow: hidden;
	}
.about_R2{
	float: right;
	width: 400px;
	height: 252px;
	background-color: #E2E2E3;
	margin-top: 15px;
	overflow: hidden;
	}
.about_R3{
	float: right;
	width: 400px;
	margin-top: 5px;
	text-align: right;
	}
.about_Ls{
	float: left;
	width: 146px;
	height: 75px;
	background-color: #E2E2E3;
	margin-top: 30px;
	margin-right: 20px;
	overflow: hidden;
	}
.about_Rs{
	float: right;
	width: 330px;
	height: 75px;
	margin-top: 30px;
	}
.about1_bg{/*phoebe*/
	background-image: url(http://adoptadoggie.org/images/abo1.png);
	height: 561px;
	width: 597px;
	margin-top: 1800px;
	position: absolute;
	z-index: 1001;
	margin-left: 450px;
	}
/*---------------------- contact phoebe --------------------------------------*/
.contact{
	width: 960px;
	margin:0 auto;
	overflow:auto;/*解決子元素float而父元素高度無法自動撐高的問題*/
	background:url(http://adoptadoggie.org/images/contactbg.png) no-repeat bottom left #FFF;
	height: 1000px;
	padding-left:20px;
	padding-top:20px;
	}
.contact_1{
	float: left;
	width: 940px;
	height: 380px;
	-webkit-border-radius: 15px;   /*元角*/
	border-radius: 15px;
	background-color: #F55000;
	display: block;
	margin-top: 20px;
	}
.contact_1_1{
	float: left;
	width: 540px;
	height: 380px;
	}
.contact_1_2{
	float: left;
	width: 355px;
	height: 200px;
	padding: 20px;
	}
.contact_1_3{
	float: right;
	width: 190px;
	height: 20px;
	padding: 20px;
	text-align: right;
	background-image: url(http://adoptadoggie.org/images/re_icon1.png);
	background-repeat: no-repeat;
	margin-left: 150px;
	}
.contact_1_4{
	float: right;
	width: 190px;
	height: 20px;
	padding: 20px;
	text-align: right;
	background-image: url(http://adoptadoggie.org/images/re_icon2.png);
	background-repeat: no-repeat;
	margin-left: 150px;
	}
.contact_2{
	float: left;
	width: 940px;
	height: 380px;
	display: block;
	margin-top: 20px;
	}
.contact_2_1{
	float: left;
	width: 500px;
	display: block;
	margin-top: 20px;
	margin-left: 20px;
	}
.contact_2_1_b{
	float: left;
	width: 800px;
	display: block;
	margin-top: 20px;
	margin-left: 20px;
	}
.contact_2_2{
	float: right;
	width: 400px;
	display: block;
	margin-top: 20px;
	}
.contact_2_3{
	width: 600px;
	height: 532px;
	position: absolute;
	background-image: url(http://adoptadoggie.org/images/re_p1.png);
	display: block;
	z-index: 998;
	margin-left: 500px;
	margin-top: 1050px;
	}
.contact_3{
	position: absolute;
	z-index: 1000;
	float: left;
	width: 940px;
	margin-top: 1520px;
	margin-left: 20px;
	}
.contact_3_1{
	float: left;
	width: 940px;
	margin-top: 20px;
	}
.contact_3_1_all{/*phoebe*/
	float: left;
	width: 278px;
	height: 180px;
	margin: 10px;
	}
.contact_3_1_1{
	float: left;
	width: 278px;
	height: 170px;
	}
.contact_3_1_2{/*phoebe*/
	float: left;
	width: 278px;
	height: 30px;
	padding-top: 0px;
	font-family: "Myriad Pro";
	font-size: 12px;
	color: #FFF;
	}
.contact_3_2{
	float: left;
	width: 940px;
	}
.contact_3_2_all{
	float: left;
	width: 203px;
	height: 152px;
	margin: 10px;
	background-color: #9dcde4;
	}


/*---------------------- donate--------------------------------------*/
.donate{
	width: 982px;
	height:1536px;
	margin:0 auto;
	overflow:auto;/*解決子元素float而父元素高度無法自動撐高的問題*/
	padding: 20px 0 0 42px;
	background:url(http://adoptadoggie.org/images/donate_bg.png) no-repeat bottom right;
	}
.donate_bg{
	background-image: url(http://adoptadoggie.org/images/donate_bg.png);
	display: block;
	height: 330px;
	width: 725px;
	margin-top: 1171px;
	margin-left: 310px;
	position: absolute;
	z-index: 1010;

	}
.donate_1{
	float: left;
	width: 940px;
	height: 380px;
	-webkit-border-radius: 15px;   /*元角*/
	border-radius: 15px;
	background-color: #ff8f1b;
	display: block;
	margin-top: 20px;
	}
.donate_1_1{
	float: left;
	width: 540px;
	height: 380px;
	}
.donate_1_2{
	float: left;
	width: 355px;
	height: 170px;
	padding: 20px;
	}
.donate_1_3{
	float: right;
	width: 190px;
	height: 20px;
	text-align: right;
	background-repeat: no-repeat;
	margin-right: 15px;
	}
.donate_1_4{
	float: right;
	width: 190px;
	height: 20px;
	padding: 20px;
	text-align: right;
	background-image: url(http://adoptadoggie.org/images/re_icon2.png);
	background-repeat: no-repeat;
	margin-left: 150px;
	}
.donate_2{
	float: left;
	width: 940px;
	height: 380px;
	display: block;
	margin-top: 20px;
	}
.donate_2_1{
	float: left;
	width: 500px;
	display: block;
	margin-top: 20px;
	margin-left: 20px;
	}
.donate_2_1_1{
	width: 100%;
	display: block;
	margin-top: 20px;
	border-bottom:1px #FF8F1B solid;
	color:#FF8F1B;
	font-family: "Museo Sans 500";
	font-weight: bolder;
	font-size:30px;
	letter-spacing:-1px;
	}
.donate_3_1{
	float: left;
	width: 400px;
	display: block;
	margin-top: 20px;
	margin-left:20px;
	}
.donate_3_1_1{
	width: 100%;
	display: block;
	margin-top: 92px;
	border-bottom:1px #FF8F1B solid;
	color:#FF8F1B;
	font-family: "Museo Sans 500";
	font-weight: bolder;
	font-size:30px;
	letter-spacing:-1px;
	}


/*--------------------其他文字開始-----------------------*/
.t1{/*phoebe*/
	font-size: 14px;
	color: #333333;
	text-align: justify;
	line-height: 21px;
	font-family: "Museo Sans 500";
	font-weight: bold;
	}
.t2{
	font-size: 17px;
	color: #00aba6;
	text-align: justify;
	line-height: 35px;
	font-family: "Museo Sans 500";
	font-weight: bolder;
	}
.m1{
	font-family: "Myriad Pro";
	font-size: 13px;
	line-height: 21px;
	color: #282626;
	}
.m1 a {
	font-family: "Myriad Pro";
	font-size: 13px;
	line-height: 21px;
	color: #44A6D0;
	}
.m2{
	font-family: "Myriad Pro";
	font-size: 13px;
	line-height: 15px;
	color: #282626;
	}
.m3{
	font-family: "Myriad Pro";
	font-size: 15px;
	line-height: 20px;
	color: #282626;
	}
.f1{
	height: 20px;
	width: 250px;
	border: 1px solid #ec5700;
	}
.f2{
	width: 500px;
	border: 1px solid #ec5700;
	}
.f3{
	height: 20px;
	width: 50px;
	border: 1px solid #ec5700;
	}
.b1 {/*phoebe*/
	font-size: 16px;
	color: #e95372;
	text-align: justify;
	font-family: "Museo Sans 500";
	font-weight: bolder;
	text-decoration:none;
	}
.b2 {/*phoebe*/
	font-size: 16px;
	color: #3891b5;
	text-align: justify;
	font-family: "Museo Sans 500";
	font-weight: bolder;
	text-decoration:none;
	}
.b1_2 {/*phoebe*/
	font-size: 16px;
	color: #00A43C;
	text-align: justify;
	font-family: "Museo Sans 500";
	font-weight: bolder;
	text-decoration:none;
	}
.b1_2 a {/*phoebe*/
	font-size: 16px;
	color: #E84693;
	text-align: justify;
	font-family: "Museo Sans 500";
	font-weight: bolder;
	text-decoration:none;
	}
.b1_2 a:hover {/*phoebe*/
	font-size: 16px;
	color: #E84693;
	text-align: justify;
	font-family: "Museo Sans 500";
	font-weight: bolder;
	text-decoration:none;
	}
.b1 a{/*phoebe*/
	font-size: 16px;
	color: #e95372;
	text-align: justify;
	font-family: "Museo Sans 500";
	font-weight: bolder;
	text-decoration:none;
	}
.b2 a{/*phoebe*/
	font-size: 16px;
	color: #3891b5;
	text-align: justify;
	font-family: "Museo Sans 500";
	font-weight: bolder;
	text-decoration:none;
	}
.b3 a{
	font-size: 16px;
	color: #FFFFFF;
	text-align: center;
	font-family: "Museo Sans 500";
	background-color: #ff682c;
	height: 25px;
	width: 80px;
	display: block;
	-webkit-border-radius: 5px;
	-mos-border-radius: 5px;
	-ms-border-radius: 5px;
	border-radius: 5px;
	line-height: 25px;
	text-decoration: none;
	}
.b3 a:hover{
	font-size: 16px;
	color: #FFFFFF;
	text-align: center;
	font-family: "Museo Sans 500";
	background-color: #3995d9;
	height: 25px;
	width: 80px;
	display: block;
	-webkit-border-radius: 5px;
	-mos-border-radius: 5px;
	-ms-border-radius: 5px;
	border-radius: 5px;
	line-height: 25px;
	text-decoration: none;
	}
.t1_ws{
	font-size: 12px;
	color: #FFFFFF;
	text-align: justify;
	line-height: 16px;
	font-family: "Museo Sans 500";
	font-weight: lighter;
}
.pro_title{
	font-size: 19px;
	font-weight: bolder;
	color: #13A4A0;
	line-height: 30px;
	font-family: "Myriad Pro";
}

.pro_title_2{
 font-size: 25px;
 font-weight: bolder;
 color: #13A4A0;
 line-height: 30px;
 font-family: "Myriad Pro";
}

.pro_main{
	font-size: 14px;
	color: #333333;
	text-align: justify;
	line-height: 20px;
	font-family: "Myriad Pro";
}
.pro_main_02 {
	font-size: 14px;
	color: #333333;
	text-align: justify;
	line-height: 32px;
	font-family: "Myriad Pro";
}
.pro_main_g {
	font-size: 14px;
	color: #138099;
	font-weight: bold;
	font-family: "Myriad Pro";
	text-decoration:none;
	text-align:left;
	line-height:21px;
}
.pro_main_g a{
	font-size: 14px;
	color: #138099;
	font-weight: bold;
	font-family: "Myriad Pro";
	text-decoration:none;
	text-align:left;
}
.pro_main_g a:hover{
	font-size: 14px;
	color: #FF682C;
	font-weight: bold;
	font-family: "Myriad Pro";
	text-align:left;
}
.pro_main_g2{
	font-size: 14px;
	color: #317939;
	font-weight: bold;
	font-family: "Myriad Pro";
	line-height: 21px;
}
.pro_main_g3{
	font-size: 14px;
	color: #1a9c3c;
	font-weight: bold;
	font-family: "Myriad Pro";
}
.pro_main_s{/*phoebe*/
	font-size: 13px;
	color: #333333;
	font-family: "Myriad Pro";
	text-align:left;
	line-height: 21px;
}
.pro_main_s a:hover{/*phoebe*/
	color: #E84693;
	text-decoration:none;
}
.pro_main_s2{/*phoebe*/
	font-size: 13px;
	color: #333333;
	font-family: "Myriad Pro";
	text-align: center;
	line-height: 21px;
}
.re_main{/*phoebe*/
	font-size: 14px;
	color: #333333;
	text-align: justify;
	line-height: 21px;
	font-family: "Myriad Pro";
}
.re_main_b{/*phoebe*/
	font-size: 14px;
	color: #333333;
	text-align: justify;
	line-height: 21px;
	font-family: "Myriad Pro";
}
.re_main_b a{/*phoebe*/
	font-size: 14px;
	color: #8BBB26;
	text-align: justify;
	line-height: 22px;
	font-family: "Myriad Pro";
	text-decoration:none;
}
.re_main2{
	font-size: 14px;
	color: #333333;
	line-height: 32px;
	font-family: "Myriad Pro";
}
.re_main3{
	font-size: 12px;
	color: #333333;
	line-height: 20px;
	font-style: italic;
	font-family: "Myriad Pro";
}
.re_main4{
	font-family: "Myriad Pro";
	font-size: 12px;
	color: #333333;
	line-height: 25px;
}
.re_main4_btn a{/*nico*/
	font-family: "Myriad Pro";
	font-weight: bolder;
	font-size: 14px;
	color: #FFF;
	background-color: #A7CA01;
	padding: 7px 20px 2px;
	text-decoration: none;
	-webkit-border-radius: 2px;   /*元角*/
	-moz-border-radius: 2px;
	-ms-border-radius: 2px;
	border-radius: 2px;
}
.re_main4_btn a:hover{/*nico*/
	font-family: "Myriad Pro";
	font-weight: bolder;
	font-size: 14px;
	color: #d5e044;
	background-color: #e84693;
	padding: 7px 20px 2px 20px;
	-webkit-border-radius: 2px;   /*元角*/
	-moz-border-radius: 2px;
	-ms-border-radius: 2px;
	border-radius: 2px;
}
.re_main5{/*nico*/
	font-size: 14px;
	color: #447db4;
	text-align: justify;
	line-height: 21px;
	font-family: "Myriad Pro";
}
.re_main6_btn a{/*nico*/
	font-family: "Myriad Pro";
	font-weight: bolder;
	font-size: 14px;
	color: #d5e044;
	background-color: #e84693;
	padding: 7px 20px 2px;
	text-decoration: none;
	-webkit-border-radius: 2px;   /*元角*/
	-moz-border-radius: 2px;
	-ms-border-radius: 2px;
	border-radius: 2px;
}
.re_main6_btn a:hover{/*nico*/
	font-family: "Myriad Pro";
	font-weight: bolder;
	font-size: 14px;
	color: #FFF;
	background-color: #A7CA01;
	padding: 7px 20px 2px 20px;
	-webkit-border-radius: 2px;   /*元角*/
	-moz-border-radius: 2px;
	-ms-border-radius: 2px;
	border-radius: 2px;
}
.re_main5_r{/*nico*/
	font-size: 14px;
	color: #b45e62;
	text-align: justify;
	line-height: 21px;
	font-family: "Myriad Pro";
}
.re_main2 a{
	font-size: 14px;
	color: #86b32d;
	line-height: 20px;
	font-weight: bold;
	text-decoration: none;
	font-family: "Myriad Pro";
}
.center1{
	font-family: "Myriad Pro";
	font-size: 13px;
	font-weight: lighter;
	color: #3e3a39;
	}
.center2{
	font-family: "Myriad Pro";
	font-size: 13px;
	font-weight: lighter;
	color: #e74689;
	font-style: italic;
	}
.in_title1{
	font-family: "Helvetica Neue";
	font-size: 22px;
	font-weight: 400;
	color: #FFFFFF;
	line-height: 35px;
	background-image: url(http://adoptadoggie.org/images/in_1.png);
	background-repeat: no-repeat;
	padding-left: 30px;
	}
.in_title2{
	font-family: "Helvetica Neue";
	font-size: 22px;
	font-weight: 400;
	color: #FFFFFF;
	line-height: 35px;
	background-image: url(http://adoptadoggie.org/images/in_2.png);
	background-repeat: no-repeat;
	padding-left: 30px;
	}
.in_title3{
	font-family: "Helvetica Neue";
	font-size: 22px;
	font-weight: 400;
	color: #FFFFFF;
	line-height: 35px;
	background-image: url(http://adoptadoggie.org/images/in_3.png);
	background-repeat: no-repeat;
	padding-left: 30px;
	}
.in_title4{
	font-family: "Helvetica Neue";
	font-size: 22px;
	font-weight: 400;
	color: #FFFFFF;
	line-height: 35px;
	background-image: url(http://adoptadoggie.org/images/in_4.png);
	background-repeat: no-repeat;
	padding-left: 30px;
	}
.in_title5{
	font-family: "Helvetica Neue";
	font-size: 22px;
	font-weight: 400;
	color: #A0C11C;
	line-height: 35px;
	}
.ce_title1{
	font-family: "Helvetica Neue";
	font-size: 26px;
	font-weight: 400;
	color: #e84693;
	line-height: 35px;
	}
.ce_title2{
	font-family: "Helvetica Neue";
	font-size: 30px;
	font-weight: 400;
	color: #39b568;
	line-height: 35px;
	padding-left: 26px;
	padding-bottom: 40px;
	}
.ce_title3{
	font-family: "Helvetica Neue";
	font-size: 30px;
	font-weight: 400;
	color: #2f6399;
	line-height: 35px;
	padding-left: 26px;
	padding-bottom: 40px;
	}
.ce_title4{
	font-family: "Helvetica Neue";
	font-size: 20px;
	color: #a2d4ff;
	line-height: 25px;
	}
.ce_title5{
	font-family: "Helvetica Neue";
	font-size: 20px;
	font-weight: 400;
	color: #ff427e;
	line-height: 25px;
	}
.ce_title5 a {/*phoebe*/
	font-family: "Helvetica Neue";
	font-size: 20px;
	font-weight: 400;
	color: #ff427e;
	line-height: 20px;
	text-decoration:none;
	}
.ce_title5 a:hover {/*phoebe*/
	font-family: "Helvetica Neue";
	font-size: 20px;
	font-weight: 400;
	color: #A2D4FF;
	line-height: 20px;
	text-decoration:none;
	}
.ce_title6{
	font-family: "Helvetica Neue";
	font-size: 30px;
	font-weight: 400;
	color: #ff427e;
	line-height: 25px;
	}
.ce_title6-{
	font-family: "Helvetica Neue";
	font-size: 25px;
	font-weight: 400;
	color: #ff427e;
	line-height: 35px;
	}
.ce_title7{
	font-family: "Helvetica Neue";
	font-size: 30px;
	font-weight: 400;
	color: #0081c8;
	line-height: 25px;
	z-index: 500;
	position: absolute;
	margin-left:20px;
	}

.ce_title14{
	font-family: "Helvetica Neue";
	font-size: 30px;
	font-weight: 400;
	color: #E6535F;
	line-height: 35px;
	padding-left: 26px;
	padding-bottom: 20px;
	}
.ce_title14-{
	font-family: "Helvetica Neue";
	font-size: 30px;
	font-weight: 400;
	color: #E6535F;
	line-height: 25px;
	padding-bottom: 20px;
	margin-top:66px;
	}
.ce_title14-2{
	font-family: "Helvetica Neue";
	font-size: 30px;
	font-weight: 400;
	color: #E6535F;
	line-height: 25px;
	padding-bottom: 20px;
	padding-top: 20px;
	}
.ce_title14-3{
	font-family: "Helvetica Neue";
	font-size: 20px;
	font-weight: 400;
	color: #FF7979;
	line-height: 25px;
	padding-bottom: 5px;
	}
.ce_title14-4{
	font-family: "Helvetica Neue";
	font-size: 20px;
	font-weight: 400;
	color: #44A6D0;
	line-height: 25px;
	padding-bottom: 5px;
	}
.ce_title13{
	font-family: "Helvetica Neue";
	font-size: 26px;
	font-weight: 400;
	color: #44A6D0;
	line-height: 25px;
	padding-top: 20px;
	padding-bottom: 5px;
	}
.ce_title13-{
	font-family: "Helvetica Neue";
	font-size: 20px;
	font-weight: 400;
	color: #44A6D0;
	line-height: 25px;
	padding-bottom: 5px;
	}
.ce_title8{/*training phoebe*/
	font-family: "Helvetica Neue";
	font-size: 30px;
	font-weight: 400;
	color: #8156C2;
	line-height: 35px;
	padding-left: 26px;
	padding-bottom: 40px;
	}
.ce_title9{/*training phoebe*/
	font-family: "Helvetica Neue";
	font-size: 20px;
	font-weight: 400;
	color: #CABFF0;
	line-height: 25px;
	}
.ce_title10{/*training phoebe*/
	color: #8156C2;
	font-family: 'Helvetica Neue';
	font-size: 30px;
	width:200px;
	}
.ce_title11{/*phoebe*/
	font-family: "Helvetica Neue";
	font-size: 30px;
	font-weight: 400;
	color: #FF611B;
	line-height: 35px;
	padding-left: 26px;
	padding-bottom: 40px;
	}
.ce_title12{/*phoebe*/
	font-family: "Helvetica Neue";
	font-size: 20px;
	font-weight: 400;
	color: #fff;
	line-height: 25px;
	}
.ce_title15{
	font-family: "Helvetica Neue";
	font-size: 30px;
	font-weight: 400;
	color: #ff8900;
	line-height: 35px;
	padding-left: 26px;
	padding-bottom: 40px;;
	}
.ce_title16{
	font-family: "Helvetica Neue";
	font-size: 30px;
	font-weight: 400;
	color: #d5e044;
	line-height: 35px;
	padding-left: 0px;
	padding-bottom: 40px;
	}
.ce_title17{
	font-family: "Helvetica Neue";
	font-size: 25px;
	font-weight: 400;
	color: #d5e044;
	line-height: 35px;
	padding-left: 0px;
	padding-bottom: 40px;
	}
.in_btn a{/*phoebe*/
	font-family: "Myriad Pro";
	font-size: 10px;
	color: #FFFFFF;
	background-color: #a7ca01;
	-webkit-border-radius: 5px;   /*元角*/
	padding-top: 5px;
	padding-right: 13px;
	padding-bottom: 5px;
	padding-left: 13px;
	font-weight: bolder;
	text-decoration:none;
	}
.in_btn a:hover{
	font-family: "Myriad Pro";
	font-size: 10px;
	color: #d5e044;
	background-color: #e84693;
	-webkit-border-radius: 5px;   /*元角*/
	padding-top: 5px;
	padding-right: 13px;
	padding-bottom: 5px;
	padding-left: 13px;
	font-weight: bolder;
	}
.in_btn2 a{
	font-family: "Myriad Pro";
	font-size: 12px;
	color: #A7CA01;
	font-weight: bolder;
	}
.in_btn2 a:hover{
	font-family: "Myriad Pro";
	font-size: 12px;
	color: #E6535F;
	font-weight: bolder;
	}

.in_btn3 a{/*phoebe*/
	font-family: "Myriad Pro";
	font-weight: bolder;
	font-size: 14px;
	color: #FFFFFF;
	background-color: #a7ca01;
	padding: 7px 20px 2px 20px;
	text-decoration:none;
	-webkit-border-radius: 2px;   /*元角*/
	-moz-border-radius: 2px;
	-ms-border-radius: 2px;
	border-radius: 2px;
	}
.in_btn3 a:hover{
	font-family: "Myriad Pro";
	font-weight: bolder;
	font-size: 14px;
	color: #d5e044;
	background-color: #e84693;
	padding: 7px 20px 2px 20px;
	-webkit-border-radius: 2px;   /*元角*/
	-moz-border-radius: 2px;
	-ms-border-radius: 2px;
	border-radius: 2px;
	}
.in_btn4 a{/*phoebe*/
 font-family: "Myriad Pro";
 font-weight: bolder;
 font-size: 16px;
 color: #000;
 background-color: #a7ca01;
 padding: 10px 45px 4px 45px;
 text-decoration:none;
 -webkit-border-radius: 3px;   /*元角*/
 -moz-border-radius: 3px;
 -ms-border-radius: 3px;
 border-radius: 3px;
 }
.in_btn4 a:hover{
	font-family: "Myriad Pro";
	font-weight: bolder;
	font-size: 16px;
	color: #d5e044;
	background-color: #e84693;
	padding: 10px 45px 3px 45px;
	-webkit-border-radius: 3px;   /*元角*/
	-moz-border-radius: 3px;
	-ms-border-radius: 3px;
	border-radius: 3px;
	}
.in_btn5 a{/*phoebe*/
	font-family: "Myriad Pro";
	font-weight: bolder;
	font-size: 13px;
	color: #000;
	background-color: #a7ca01;
	text-decoration: none;
	-webkit-border-radius: 3px;   /*元角*/
	-moz-border-radius: 3px;
	-ms-border-radius: 3px;
	border-radius: 3px;
	padding-top: 9px;
	padding-right: 6px;
	padding-bottom: 7px;
	padding-left: 9px;
	line-height: 15px;
 }
.in_btn5 a:hover{
 font-family: "Myriad Pro";
 font-weight: bolder;
 font-size: 13px;
 color: #d5e044;
 background-color: #e84693;
 -webkit-border-radius: 3px;   /*元角*/
 -moz-border-radius: 3px;
 -ms-border-radius: 3px;
 border-radius: 3px;
 padding-top: 9px;
 padding-right: 6px;
 padding-bottom: 7px;
 padding-left: 9px;
 }

.in_btn_app1 a{/*nico*/
	font-family: "Myriad Pro";
	font-weight: bolder;
	font-size: 17px;
	color: #000;
	text-decoration: none;
	background-image: url(http://adoptadoggie.org/images/btn_app_bg.jpg);
	height: 39px;
	width: 145px;
	display: block;
	margin-top: 5px;
	line-height: 35px;
	text-align: center;
 }
.in_btn_app1 a:hover{/*nico*/
 font-family: "Myriad Pro";
 font-weight: bolder;
 font-size: 17px;
 color: #d5e044;
 background-image: url(http://adoptadoggie.org/images/btn_app_bg2.jpg);
 }

.in_btn_app2 a{/*nico*/
	font-family: "Myriad Pro";
	font-weight: bolder;
	font-size: 13px;
	color: #000;
	text-decoration: none;
	background-image: url(http://adoptadoggie.org/images/btn_app_bg3.jpg);
	height: 39px;
	width: 145px;
	display: block;
	margin-bottom: 8px;
	margin-top: 5px;
	line-height: 35px;
	text-align: center;
 }
.in_btn_app2 a:hover{/*nico*/
 font-family: "Myriad Pro";
 font-weight: bolder;
 font-size: 13px;
 color: #d5e044;
 background-image: url(http://adoptadoggie.org/images/btn_app_bg2.jpg);
 }


/*--------------------其他文字結束-----------------------*/


/*-----------------------------變色核取方塊-----------------------------*/
input[type=radio].css-checkbox {
							display:none;
						}

						input[type=radio].css-checkbox + label.css-label {
							padding-left:20px;
							height:15px;
							display:inline-block;
							line-height:15px;
							background-repeat:no-repeat;
							background-position: 0 0;
							font-size:10px;
							vertical-align:middle;
							cursor:pointer;

						}

						input[type=radio].css-checkbox:checked + label.css-label {
							background-position: 0 -15px;
						}
						label.css-label {
							background-image:url(http://adoptadoggie.org/images/oo.png);
							-webkit-touch-callout: none;
							-webkit-user-select: none;
							-khtml-user-select: none;
							-moz-user-select: none;
							-ms-user-select: none;
							user-select: none;
						}



						input[type=radio].css-checkbox + label.css-label2 {
							padding-left:20px;
							height:15px;
							display:inline-block;
							line-height:15px;
							background-repeat:no-repeat;
							background-position: 0 0;
							font-size:10px;
							vertical-align:middle;
							cursor:pointer;

						}

						input[type=radio].css-checkbox:checked + label.css-label2 {
							background-position: 0 -15px;
						}
						label.css-label2 {
							background-image:url(http://adoptadoggie.org/images/oo2.png);
							-webkit-touch-callout: none;
							-webkit-user-select: none;
							-khtml-user-select: none;
							-moz-user-select: none;
							-ms-user-select: none;
							user-select: none;
						}



						input[type=radio].css-checkbox + label.css-label3 {
							padding-left:20px;
							height:15px;
							display:inline-block;
							line-height:15px;
							background-repeat:no-repeat;
							background-position: 0 0;
							font-size:10px;
							vertical-align:middle;
							cursor:pointer;

						}

						input[type=radio].css-checkbox:checked + label.css-label3 {
							background-position: 0 -15px;
						}
						label.css-label3 {
							background-image:url(http://adoptadoggie.org/images/oo3.png);
							-webkit-touch-callout: none;
							-webkit-user-select: none;
							-khtml-user-select: none;
							-moz-user-select: none;
							-ms-user-select: none;
							user-select: none;
						}

.checkbox{
 font-family: "Myriad Pro";
 font-size: 12px;
 color: #333333;
 line-height: 14px;
}

@charset "UTF-8";
/* CSS Document */
/*----------------------上面選單內頁--------------------------------------*/
.center_btn1{
	width: 980px;
	background:#666;
	}
.fb{
	float: right;
	width:26px;
	height:26px;
	margin: 10px 10px 0 0;
	}

.center_btn2{
	height: 161px;
	width: 980px;
	float: left;
	background-image: url(http://adoptadoggie.org/images/center_btn2.png);
	}
.center_btn3{
	height: 161px;
	width: 980px;
	float: left;
	background-image: url(http://adoptadoggie.org/images/center_btn3.png);
	}
.center_btn4{/*phoebe*/
	height: 161px;
	width: 980px;
	float: left;
	background-image: url(http://adoptadoggie.org/images/center_btn4.png);
	}
.center_btn6{/*phoebe*/
	height: 161px;
	width: 980px;
	float: left;
	background-image: url(http://adoptadoggie.org/images/center_btn6.png);
	}
.center_btn_L{
	height: 161px;
	width: 149px;
	float: left;
	margin-right: 80px;
	margin-left: 20px;
	}
.center_btn_R{/*phoebe*/
	height: 40px;
	width: 730px;
	float: left;
	margin-top: 78px;
	}
.center_btn_R2{/*phoebe*/
	height: 40px;
	width: 730px;
	float: left;
	margin-top: 79px;
	}
.center_btn_Rindex{/*phoebe*/
	height: 40px;
	width: 730px;
	float: left;
	margin-top: 78px;
	}
.center_btn_RL{/*phoebe*/
	height: 161px;
	width: 2px;
	background:#FF9;
	}
.topbtn_allmenu{

	}
.megamenu{

	}
.megamenu li{
	margin-right: 5px;

	}
.top_btn_s_menu{/*phoebe*/
	position: absolute;
	background-color: #e6535f;
	height: 128px;
	width: 281px;
	float: left;
	z-index: 998;
	margin-left: 5px;
	padding-left:3px;
	-webkit-border-radius: 5px;   /*元角*/
	-moz-border-radius: 5px;
	-ms-border-radius: 5px;
	border-radius: 5px;
	}
.top_btn_s_menu_btn{/*phoebe*/
	width: 150px;
	float: left;
	padding-top: 10px;
	padding-bottom:10px;
	}
.top_btn_s_menu_pic{/*phoebe*/
	width: 110px;
	float: right;
	margin: 15px 10px 10px 10px;
	}
.nav-hr{

	}
.subnav-item{

	}
.subnav-content{

	}
.col1 column{

	}


/*-------------------- 上面選單文字 phoebe -----------------------*/
.top_btn_01{
	font-family: "Museo Sans 500";
	font-size: 15px;
	font-weight: 500;
	color: #3e3a39;
	}

.top_btn_01 a{
	font-family: "Museo Sans 500";
	font-size: 15px;
	font-weight: 500;
	color: #3e3a39;
	padding: 3px 10px;
	text-decoration:none;
	}

.top_btn_01 a:hover{
	font-family: "Museo Sans 500";
	font-size: 15px;
	font-weight: 500;
	color: #FFFFFF;
	-webkit-border-radius: 5px;   /*元角*/
	-moz-border-radius: 5px;
	-ms-border-radius: 5px;
	border-radius: 5px;
	background-color: #9AC700;
	padding: 3px 10px;
	}
.top_btn_02{
	font-family: "Museo Sans 500";
	font-size: 15px;
	font-weight: 500;
	color: #3e3a39;
	}

.top_btn_02 a{
	font-family: "Museo Sans 500";
	font-size: 15px;
	font-weight: 500;
	color: #3e3a39;
	padding: 3px 10px;
	text-decoration:none;
	}

.top_btn_02 a:hover{
	font-family: "Museo Sans 500";
	font-size: 15px;
	font-weight: 500;
	color: #FFFFFF;
	-webkit-border-radius: 5px;   /*元角*/
	-moz-border-radius: 5px;
	-ms-border-radius: 5px;
	border-radius: 5px;
	background-color: #39B568;
	padding: 3px 10px;
	}
.center_btn7{
	height: 161px;
	width: 980px;
	float: left;
	background-image: url(http://adoptadoggie.org/images/center_btn7.png);
	}
.top_btn_03{
	font-family: "Museo Sans 500";
	font-size: 15px;
	font-weight: 500;
	color: #3e3a39;
	}

.top_btn_03 a{
	font-family: "Museo Sans 500";
	font-size: 15px;
	font-weight: 500;
	color: #3e3a39;
	padding: 3px 10px;
	text-decoration:none;
	}

.top_btn_03 a:hover{
	font-family: "Museo Sans 500";
	font-size: 15px;
	font-weight: 500;
	color: #FFFFFF;
	-webkit-border-radius: 5px;   /*元角*/
	-moz-border-radius: 5px;
	-ms-border-radius: 5px;
	border-radius: 5px;
	background-color: #336BB3;
	padding: 3px 10px;
	}
.top_btn_04{
	font-family: "Museo Sans 500";
	font-size: 15px;
	font-weight: 500;
	color: #3e3a39;
	}

.top_btn_04 a{
	font-family: "Museo Sans 500";
	font-size: 15px;
	font-weight: 500;
	color: #3e3a39;
	padding: 3px 10px;
	text-decoration:none;
	}

.top_btn_04 a:hover{
	font-family: "Museo Sans 500";
	font-size: 15px;
	font-weight: 500;
	color: #FFFFFF;
	-webkit-border-radius: 5px;   /*元角*/
	-moz-border-radius: 5px;
	-ms-border-radius: 5px;
	border-radius: 5px;
	background-color: #8156C2;
	padding: 3px 10px;
	}
.top_btn_05{
	font-family: "Museo Sans 500";
	font-size: 15px;
	font-weight: 500;
	color: #3e3a39;
	}

.top_btn_05 a{
	font-family: "Museo Sans 500";
	font-size: 15px;
	font-weight: 500;
	color: #3e3a39;
	padding: 3px 10px;
	text-decoration:none;
	}

.top_btn_05 a:hover{
	font-family: "Museo Sans 500";
	font-size: 15px;
	font-weight: 500;
	color: #FFFFFF;
	-webkit-border-radius: 5px;   /*元角*/
	-moz-border-radius: 5px;
	-ms-border-radius: 5px;
	border-radius: 5px;
	background-color: #E6535F;
	padding: 3px 10px;
	}
.top_btn_06{
	font-family: "Museo Sans 500";
	font-size: 15px;
	font-weight: 500;
	color: #3e3a39;
	}

.top_btn_06 a{
	font-family: "Museo Sans 500";
	font-size: 15px;
	font-weight: 500;
	color: #3e3a39;
	padding: 3px 10px;
	text-decoration:none;
	}

.top_btn_06 a:hover{
	font-family: "Museo Sans 500";
	font-size: 15px;
	font-weight: 500;
	color: #FFFFFF;
	-webkit-border-radius: 5px;   /*元角*/
	-moz-border-radius: 5px;
	-ms-border-radius: 5px;
	border-radius: 5px;
	background-color: #FF611B;
	padding: 3px 10px;
	}
.top_btn_07{
	font-family: "Museo Sans 500";
	font-size: 15px;
	font-weight: 500;
	color: #3e3a39;
	}

.top_btn_07 a{
	font-family: "Museo Sans 500";
	font-size: 15px;
	font-weight: 500;
	color: #3e3a39;
	padding: 3px 10px;
	text-decoration:none;
	}

.top_btn_07 a:hover{
	font-family: "Museo Sans 500";
	font-size: 15px;
	font-weight: 500;
	color: #FFFFFF;
	-webkit-border-radius: 5px;   /*元角*/
	-moz-border-radius: 5px;
	-ms-border-radius: 5px;
	border-radius: 5px;
	background-color: #FF8F1B;
	padding: 3px 10px;
	}
.top_btn_08{
	font-family: "Museo Sans 500";
	font-size: 15px;
	font-weight: 500;
	/*color: #3e3a39;*/
	color:#CCC;
	}

.top_btn_08 a{
	font-family: "Museo Sans 500";
	font-size: 15px;
	font-weight: 500;
	/*color: #3e3a39;*/
	color:#CCC;
	padding: 3px 10px;
	text-decoration:none;
	}

.top_btn_08 a:hover{
	font-family: "Museo Sans 500";
	font-size: 15px;
	font-weight: 500;
	/*color: #FFFFFF;*/
	color:#CCC;
	/*
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	-ms-border-radius: 5px;
	border-radius: 5px;
	background-color: #F36;
	*/
	padding: 3px 10px;
	}

.a_select {/*phoebe*/
	font-family: "Museo Sans 500";
	font-size: 15px;
	font-weight: 500;
	color: #FFFFFF;
	-webkit-border-radius: 5px;   /*元角*/
	-moz-border-radius: 5px;
	-ms-border-radius: 5px;
	border-radius: 5px;
	background-color: #9AC700;
	padding: 3px 10px;
	}
.a_select a {/*phoebe*/
	color: #FFFFFF;
	text-decoration:none;
	}
.b_select {
	font-family: "Museo Sans 500";
	font-size: 15px;
	font-weight: 500;
	color: #FFFFFF;
	-webkit-border-radius: 5px;   /*元角*/
	-moz-border-radius: 5px;
	-ms-border-radius: 5px;
	border-radius: 5px;
	background-color: #39b568;
	padding: 3px 10px;
	}
.b_select a {/*phoebe*/
	color: #FFFFFF;
	text-decoration:none;
	}
.c_select {
	font-family: "Museo Sans 500";
	font-size: 15px;
	font-weight: 500;
	color: #FFFFFF;
	-webkit-border-radius: 5px;   /*元角*/
	-moz-border-radius: 5px;
	-ms-border-radius: 5px;
	border-radius: 5px;
	background-color: #336bb3;
	padding: 3px 10px;
	}
.c_select a {/*phoebe*/
	color: #FFFFFF;
	text-decoration:none;
	}
.d_select {/*phoebe*/
	font-family: "Museo Sans 500";
	font-size: 15px;
	font-weight: 500;
	color: #FFFFFF;
	-webkit-border-radius: 5px;   /*元角*/
	-moz-border-radius: 5px;
	-ms-border-radius: 5px;
	border-radius: 5px;
	background-color: #8156C2;
	padding: 3px 10px;
	}
.d_select a {/*phoebe*/
	color: #FFFFFF;
	text-decoration:none;
	}
.e_select {
	font-family: "Museo Sans 500";
	font-size: 15px;
	font-weight: 500;
	color: #FFFFFF;
	-webkit-border-radius: 5px;   /*元角*/
	border-radius: 5px;
	background-color: #EA535F;
	padding: 3px 10px;
	text-decoration:none;
	}
.e_select a {/*phoebe*/
	color: #FFFFFF;
	text-decoration:none;
	}
.f_select {/*phoebe*/
	font-family: "Museo Sans 500";
	font-size: 15px;
	font-weight: 500;
	color: #FFFFFF;
	-webkit-border-radius: 5px;   /*元角*/
	-moz-border-radius: 5px;
	-ms-border-radius: 5px;
	border-radius: 5px;
	background-color: #FF611B;
	padding: 3px 10px;
	}
.f_select a {/*phoebe*/
	color: #FFFFFF;
	text-decoration:none;
	}
.g_select {
	font-family: "Museo Sans 500";
	font-size: 15px;
	font-weight: 500;
	color: #FFFFFF;
	-webkit-border-radius: 5px;   /*元角*/
	-moz-border-radius: 5px;
	-ms-border-radius: 5px;
	border-radius: 5px;
	background-color: #ff8f1b;
	padding: 3px 10px;
	}
.g_select a {/*phoebe*/
	color: #FFFFFF;
	text-decoration:none;
	}
.top_btns a {/*phoebe*/
	font-family: "Museo Sans 500";
	font-size: 14px;
	color: #FFFFFF;
	padding: 10px;
	line-height: 20px;
	text-decoration:none;
	}

.top_btns a:hover{
	font-family: "Museo Sans 500";
	font-size: 14px;
	color: #CCD74A;
	padding: 10px;
	line-height: 20px;
	}
label.css-label1 {							background-image:url(http://adoptadoggie.org/images/oo.png);
							-webkit-touch-callout: none;
							-webkit-user-select: none;
							-khtml-user-select: none;
							-moz-user-select: none;
							-ms-user-select: none;
							user-select: none;
}
label.css-label4 {							background-image:url(http://adoptadoggie.org/images/oo.png);
							-webkit-touch-callout: none;
							-webkit-user-select: none;
							-khtml-user-select: none;
							-moz-user-select: none;
							-ms-user-select: none;
							user-select: none;
}
label.css-label5 {							background-image:url(http://adoptadoggie.org/images/oo.png);
							-webkit-touch-callout: none;
							-webkit-user-select: none;
							-khtml-user-select: none;
							-moz-user-select: none;
							-ms-user-select: none;
							user-select: none;
}
label.css-label6 {							background-image:url(http://adoptadoggie.org/images/oo.png);
							-webkit-touch-callout: none;
							-webkit-user-select: none;
							-khtml-user-select: none;
							-moz-user-select: none;
							-ms-user-select: none;
							user-select: none;
}
</style>

<title>Application</title>

</head>

<body>

<!----------- 內容 開始 ------------------>
<div class="adoption" style="padding: 20px 0 0 20px;">
<form method="post" action="" name="apply_form" id="apply_form">
<input type="hidden" name="action" value="save" />
<input type="hidden" name="dog_id" value="<?=$dog_id?>" />
<input type="hidden" name="content" value="" />
<table width="0" border="0" cellspacing="0" cellpadding="0">
	<tr>
    	<td>
        	<table width="0" border="0" cellspacing="0" cellpadding="0">
            	<tr>
                	<td>
                        <span class="ce_title17">ADOPTION APPLICATION</span><br />
                    	<span class="re_main5">ADOPT A DOGGIE is a 501(c)(3) non-proﬁt organization.  Our mission is to help rescued dogs in need and ﬁnd them <br />loving and forever homes in North America.  The information requested in this application is intended to ensure <br />that every owner and home we approve for adoption is a suitable and safe environment for the dog and be a <br />forever home.  Thank you for your interest in our doggies!</span>
                    </td>
                </tr>
                <tr>
                	<td>
                    	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                        	<tr>
                            	<td>&nbsp;</td>
                            </tr>
                            <tr>
                            	<td>
                                	<table width="95%" border="0" cellspacing="0" cellpadding="3">
                                    	<tr>
                                        	<td colspan="3"><span class="re_main5">Name of Available Dog:</span></td>
                                        </tr>
                                        <tr>
                                        	<td width="75"><span class="re_main4">(1st Choice)</span></td>
                                            <td><input class="text_line" type="text" name="ans1" value="<?=stripslashes($dogs['name'])?>" style="width:100%" /></td>
                                        </tr>
                                        <tr>
                                        	<td><span class="re_main4">(2nd Choice)</span></td>
                                            <td><input class="text_line" type="text" name="ans2" style="width:100%" /></td>
                                        </tr>
                                        <tr>
                                        	<td><span class="re_main4">(3rd Choice)</span></td>
                                            <td><input class="text_line" type="text" name="ans3" style="width:100%" /></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                            	<td>&nbsp;</td>
                            </tr>
                            <tr>
                            	<td height="1" bgcolor="#C2CB56"></td>
                            </tr>
                        </table>
					</td>
                </tr>
                <tr>
                	<td>
                    	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                        	<tr>
                            	<td>&nbsp;</td>
                            </tr>
                            <tr>
                            	<td>
                                	<table width="100%" border="0" cellspacing="0" cellpadding="3">
                                    	<tr>
                                        	<td colspan="2"><span class="re_main5">Reason(s) You Are Adopting: (check all that apply)</span></td>
                                        </tr>
                                        <tr>
                                        	<td width="20" colspan="2"><input type="checkbox" class="css-checkbox" id="radio01" name="ans4" value="As a Companion" /><label for="radio01"><span class="checkbox re_main4">As a Companion</span></label></td>
                                        </tr>
                                        <tr>
                                        	<td colspan="2"><input type="checkbox" class="css-checkbox" id="radio02" name="ans5" value="As a Playmate for Other Pets" /><label for="radio02"><span class="checkbox">As a Playmate for Other Pets</span></label></td>
                                        </tr>
                                        <tr>
                                        	<td colspan="2"><input type="checkbox" class="css-checkbox" id="radio03" name="ans6" value="For Another Family Member" /><label for="radio03"><span class="checkbox">For Another Family Member</span></label></td>
                                        </tr>
                                        <tr>
                                        	<td colspan="2"><input type="checkbox" class="css-checkbox" id="radio04" name="ans7" value="As a Gift" /><label for="radio04"><span class="checkbox">As a Gift</span></label></td>
                                        </tr>
                                        <tr>
                                        	<td colspan="2"><input type="checkbox" class="css-checkbox" id="radio05" name="ans8" value="As a Guard Dog" /><label for="radio05"><span class="checkbox">As a Guard Dog</span></label></td>
                                        </tr>
                                        <tr>
                                        	<td colspan="2">
                                            	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td>
                                                        <input type="checkbox" class="css-checkbox" id="radio06" name="ans9" value="Others" /><label for="radio06"><span class="checkbox">Others </span></label>
                                                        </td>
                                                        <td>
                                                        <textarea name="ans10" class="textbox_box4 re_main4" style="width:609px;"></textarea>
                                                        <!--<input class="text_line" type="text" name="ans10" style="width:609px;" />-->
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                        	<td>
                                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td>
                                                        <input type="checkbox" class="css-checkbox" id="radio07" name="ans11" value="Comments" /><label for="radio07"><span class="checkbox">Comments </span></label>
                                                        </td>
                                                        <td>
                                                        <textarea name="ans12" class="textbox_box4 re_main4" style="width:588px;"></textarea>
                                                        <!--<input class="text_line" type="text" name="ans12" style="width:588px;" />-->
                                                        </td>
                                                    </tr>
                                                </table>
                                            <td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                            	<td>&nbsp;</td>
                            </tr>
                            <tr>
                            	<td height="1" bgcolor="#C2CB56"></td>
                            </tr>
                        </table>
					</td>
				</tr>
	            <tr>
                	<td>
                    	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                        	<tr>
                            	<td>&nbsp;</td>
                            </tr>
                            <tr>
                            	<td>
                                	<table width="100%" border="0" cellspacing="0" cellpadding="3">
                                    	<tr>
                                        	<td colspan="2"><span class="re_main5">What traits are you looking for in your new dog?</span></td>
                                        </tr>
                                        <tr>
                                        	<td><span class="re_main4">Temperament </span><input class="text_line" type="text" name="ans13" style="width:592px;" /></td>
                                        </tr>
                                        <tr>
                                        	<td><span class="re_main4">Age </span><input class="text_line" type="text" name="ans14" style="width:643px;" /></td>
                                        </tr>
                                        <tr>
                                        	<td><span class="re_main4">Look/Color/Gender </span><input class="text_line" type="text" name="ans15" style="width:567px;" /></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                            	<td>&nbsp;</td>
                            </tr>
                            <tr>
                            	<td height="1" bgcolor="#C2CB56"></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                	<td>
                    	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                        	<tr>
                            	<td>&nbsp;</td>
                            </tr>
                            <tr>
                            	<td>
                                	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    	<tr>
                                        	<td><span class="ce_title17">APPLICANT’S INFORMATION</span></td>
                                        </tr>
                                        <tr>
                                        	<td>
                                            	<table width="0" border="0" cellspacing="0" cellpadding="3">
                                                	<tr>
                                                    	<td align="right" valign="top"><span class="re_main4"> First Name </span></td>
                                                        <td valign="top"><input class="textbox_box" type="text" name="ans16" id="ans16" /><input class="textbox_box" type="hidden" name="ans17" id="ans17" value="0"/></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4"> Last Name </span></td>
                                                        <td valign="top"><input class="textbox_box" type="text" name="ans18" id="ans18" /></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4"> Email </span></td>
                                                        <td valign="top"><input class="textbox_box" type="text" name="ans19" id="ans19" /></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4"> Age </span></td>
                                                        <td valign="top"><input class="textbox_box2" type="text" name="ans20" /></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4"> Occupation </span></td>
                                                        <td valign="top"><input class="textbox_box" type="text" name="ans21" /></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4"> Home Address</span></td>
                                                        <td valign="top"><input class="textbox_box" type="text" name="ans22" /></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4"> City </span></td>
                                                        <td valign="top"><input class="textbox_box" type="text" name="ans23" /></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4"> State</span></td>
                                                        <td valign="top"><input class="textbox_box" type="text" name="ans24" /></td>
                                                    </tr>
                                                    <tr>
                                                      <td align="right" valign="top"><span class="re_main4">Zip Code</span></td>
                                                      <td valign="top"><input class="textbox_box3" type="text" name="ans25" /></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4"> Home Tel </span></td>
                                                        <td valign="top"><span class="re_main4">(<input class="textbox_box2" type="text" name="ans26" id="ans26" />)<input class="textbox_box2" type="text" name="ans27" id="ans27" /> - <input class="textbox_box2" type="text" name="ans28" id="ans28" /></span></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4"> Cell Tel </span></td>
                                                        <td valign="top"><span class="re_main4">(<input class="textbox_box2" type="text" name="ans29" id="ans29" />)<input class="textbox_box2" type="text" name="ans30" id="ans30" /> - <input class="textbox_box2" type="text" name="ans31" id="ans31" /></span></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4"> Work Tel </span></td>
                                                        <td valign="top"><span class="re_main4">(<input class="textbox_box2" type="text" name="ans32" />)<input class="textbox_box2" type="text" name="ans33" /> - <input class="textbox_box2" type="text" name="ans34" /></span></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4"> When is a good time to call?</span></td>
                                                        <td valign="top"><input class="textbox_box" type="text" name="ans35" /></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4"> Time at Address </span></td>
                                                        <td valign="top"><span class="re_main4"><input class="textbox_box2" type="text" name="ans36" />month(s)<input class="textbox_box2" type="text" name="ans37" />year(s)</span></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4"> Housing Type </span></td>
                                                        <td valign="top"><table width="0" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                    	<td>
                                                        	<table width="0" border="0" cellspacing="0" cellpadding="0">
                                                            	<tr>
                                                                	<td height="25"><input name="ans38" type="radio" class="css-checkbox" id="radio08" value="House" /><label for="radio08" class="css-label radGroup2"><span class="checkbox re_main4">House</span></label></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input name="ans38" type="radio" class="css-checkbox" id="radio09" value="Condo" /><label for="radio09" class="css-label radGroup2"><span class="checkbox re_main4">Condo</span></label></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input name="ans38" type="radio" class="css-checkbox" id="radio10" value="Apartment" /><label for="radio10" class="css-label radGroup2"><span class="checkbox re_main4">Apartment</span></label></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input name="ans38" type="radio" class="css-checkbox" id="radio11" value="Mobile Home" /><label for="radio11" class="css-label radGroup2"><span class="checkbox re_main4">Mobile Home</span></label></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input name="ans38" type="radio" class="css-checkbox" id="radio12" value="Military Housing" /><label for="radio12" class="css-label radGroup2"><span class="checkbox re_main4">Military Housing</span></label></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                    	<td>
                                                        	<table width="0" border="0" cellspacing="0" cellpadding="0">
                                                            	<tr>
                                                                	<td height="25"><input name="ans38" type="radio" class="css-checkbox" id="radio13" value="Other" /><label for="radio13" class="css-label radGroup2"><span class="checkbox re_main4">Other </span><input class="textbox_box" type="text" name="ans39" /></label></td>
                                                                    <td width="10"></td>
                                                                    <td>&nbsp;</td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                        	<td align="right" valign="top"><span class="re_main4"> Housing </span></td>
                                            <td valign="top">
                                            	<table width="0" border="0" cellspacing="0" cellpadding="0">
                                                	<tr>
                                                    	<td valign="middle">
                                                        	<table border="0" cellpadding="0" cellspacing="0">
                                                            	<tr>
                                                                	<td height="25"><input name="ans40" type="radio" class="css-checkbox" id="radio14" value="Own" /><label for="radio14" class="css-label radGroup2"><span class="checkbox re_main4">Own</span></label></td>
                                                                    <td>&nbsp;</td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                        <td valign="middle">&nbsp;</td>
                                                        <td valign="middle"><input name="ans40" type="radio" class="css-checkbox" id="radio15" value="Rent" /><label for="radio15" class="css-label radGroup2"><span class="checkbox re_main4">Rent</span></label></td>
                                                        <td valign="middle">&nbsp;</td>
                                                        <td valign="middle"><input name="ans40" type="radio" class="css-checkbox" id="radio16" value="Other" /><label for="radio16" class="css-label radGroup2"><span class="checkbox re_main4">Other </span><input class="textbox_box" type="text" name="ans41" /></label></td>
                                                        <td width="10">&nbsp;</td>
                                                        <td width="10">&nbsp;</td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                        	<td align="right" valign="top"><span class="re_main4"> Landlord Name</span></td>
                                            <td valign="top"><input class="textbox_box5" type="text" name="ans42" /></td>
                                        </tr>
                                        <tr>
                                        	<td align="right" valign="top"><span class="re_main4"> Landlord Tel</span></td>
                                            <td valign="top"><span class="re_main4">(<input class="textbox_box2" type="text" name="ans43" />)<input class="textbox_box2" type="text" name="ans44" /> - <input class="textbox_box2" type="text" name="ans45" /></span></td>
                                        </tr>
                                        <tr>
                                        	<td align="right" valign="top"><span class="re_main4"> Conﬁrm Landlord Allows Dogs</span></td>
                                            <td valign="top">
                                            	<table width="0" border="0" cellspacing="0" cellpadding="0">
                                                	<tr>
                                                    	<td height="25"><input name="ans46" type="radio" class="css-checkbox" id="radio17" value="Yes" /><label for="radio17" class="css-label radGroup2"><span class="checkbox re_main4">Yes</span></label></td>
                                                        <td>&nbsp;</td>
                                                        <td><input name="ans46" type="radio" class="css-checkbox" id="radio18" value="No" /> <label for="radio18" class="css-label radGroup2"><span class="checkbox re_main4">No</span></label></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                        	<td align="right" valign="top"><span class="re_main4"> Other Members of the Household </span></td>
                                            <td valign="top">
                                            	<table width="0" border="0" cellspacing="0" cellpadding="0">
                                        			<tr>
                                                    	<td height="25"><input name="ans47" type="checkbox" class="css-checkbox" id="radio19" value="Spouse/Domestic Partner" /><label for="radio19"><span class="checkbox re_main4">Spouse/Domestic Partner</span></label></td>
                                                    </tr>
                                                    <tr>
                                                    	<td height="25"><input name="ans179" type="checkbox" class="css-checkbox" id="radio20" value="Child(ren)" /><label for="radio20"><span class="checkbox re_main4">Child(ren)</span></label><span class="checkbox re_main4"> (#<input class="textbox_box2" type="text" name="ans48" /> /Age <input class="textbox_box2" type="text" name="ans49" />)</span></td>
                                                    </tr>
                                                    <tr>
                                                    	<td height="25"><input name="ans180" type="checkbox" class="css-checkbox" id="radio21" value="Roommate(s)" /><label for="radio21"><span class="checkbox re_main4">Roommate(s)</span></label><span class="checkbox re_main4"> (# <input class="textbox_box2" type="text" name="ans50" />)</span></td>
                                                    </tr>
                                                    <tr>
                                                    	<td height="25"><input name="ans181" type="checkbox" class="css-checkbox" id="radio22" value="Other Relative(s)" /><label for="radio22"><span class="checkbox re_main4">Other Relative(s)</span></label><span class="checkbox re_main4">(# <input class="textbox_box2" type="text" name="ans51" />)</span></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                        	<td align="right" valign="top"><span class="re_main4">Child(ren)’s Experience with Dogs</span></td>
                                            <td valign="top">
                                            	<table width="0" border="0" cellspacing="0" cellpadding="0">
                                        			<tr>
                                        				<td height="25"><input name="ans52" type="radio" class="css-checkbox" id="radio23" value="Yes" /><label for="radio23" class="css-label radGroup2"><span class="checkbox re_main4">Yes</span></label></td>
                                                        <td>&nbsp;</td>
                                                        <td><input name="ans52" type="radio" class="css-checkbox" id="radio24" value="No" /><label for="radio24" class="css-label radGroup2"><span class="checkbox re_main4">No</span></label></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="right" valign="top"><span class="re_main4"> Child(ren) taught be respective to dogs?</span></td>
                                            <td valign="top">
                                                <table width="0" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td height="25"><input name="ans53" type="radio" class="css-checkbox" id="radio25" value="Yes" /><label for="radio25" class="css-label radGroup2"><span class="checkbox re_main4">Yes</span></label></td>
                                                        <td>&nbsp;</td>
                                                        <td><input name="ans53" type="radio" class="css-checkbox" id="radio26" value="No" /><label for="radio26" class="css-label radGroup2"><span class="checkbox re_main4">No</span></label></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="right" valign="top"><span class="re_main4">All members of household aware of and <br />agree to the adoption of a dog </span></td>
                                            <td valign="top">
                                                <table width="0" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td height="25"><input name="ans54" type="radio" class="css-checkbox" id="radio27" value="Yes" /><label for="radio27" class="css-label radGroup2"><span class="checkbox re_main4">Yes</span></label></td>
                                                        <td>&nbsp;</td>
                                                        <td><input name="ans54" type="radio" class="css-checkbox" id="radio28" value="No" /><label for="radio28" class="css-label radGroup2"><span class="checkbox re_main4">No</span></label></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="right" valign="top"><span class="re_main4"> Do you or any members of your household <br />have any health conditions that may affect<br />your ability to permanently care for the dog </span></td>
                                            <td valign="top">
                                                <table width="0" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td height="25"><input name="ans55" type="radio" class="css-checkbox" id="radio29" value="Yes" /><label for="radio29" class="css-label radGroup2"><span class="checkbox re_main4">Yes</span></label></td>
                                                    </tr>
                                                    <tr>
                                                        <td height="100" valign="top"><input name="ans55" type="radio" class="css-checkbox" id="radio30" value="No" /><label for="radio30" class="css-label radGroup2"><span class="checkbox re_main4">No</span><br /><textarea name="ans56" class="textbox_box4 re_main4"></textarea></label></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="237" align="right" valign="top"><span class="re_main4"> If you decide to move in the future, <br />plans for dog: </span></td>
                                            <td valign="top"><textarea class="textbox_box4 re_main4" name="ans57"></textarea></td>
                                        </tr>
                                        <tr>
                                          <td align="right" valign="top"><span class="re_main4"> Do you have any plans to move<br>in the next 6 months? </span></td>
                                          <td valign="top"><table width="0" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                              <td height="25"><input name="ans170" type="radio" class="css-checkbox" id="radio" value="Yes" />
                                                <label for="radio" class="css-label radGroup2"><span class="checkbox re_main4">Yes</span></label></td>
                                              <td>&nbsp;</td>
                                              <td><input name="ans170" type="radio" class="css-checkbox" id="radio2" value="No" />
                                                <label for="radio2" class="css-label radGroup2"><span class="checkbox re_main4">No</span></label></td>
                                            </tr>
                                          </table></td>
                                        </tr>
                                        <tr>
                                          <td align="right" valign="top"><span class="re_main4">Do you have any plans to take<br>any extended trips/vacations<br>in the next 3 months?</span></td>
                                          <td valign="top"><table width="0" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                              <td height="25"><input name="ans171" type="radio" class="css-checkbox" id="radio3" value="Yes" />
                                                <label for="radio3" class="css-label radGroup2"><span class="checkbox re_main4">Yes</span></label></td>
                                              <td>&nbsp;</td>
                                              <td><input name="ans171" type="radio" class="css-checkbox" id="radio4" value="No" />
                                                <label for="radio4" class="css-label radGroup2"><span class="checkbox re_main4">No</span></label></td>
                                            </tr>
                                          </table></td>
                                        </tr>
                                        <tr>
                                          <td align="right" valign="top"><span class="re_main4">If yes, explain where, how long,<br>and where the dog will be during that time:</span></td>
                                          <td valign="top"><textarea class="textbox_box4 re_main4" name="ans172"></textarea></td>
                                        </tr>
                                              </table>
                                			</td>
                            			</tr>
                         			</table>
                     			</td>
                 			</tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td height="1" bgcolor="#C2CB56"></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                	<td>
                    	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                        	<tr>
                            	<td>&nbsp;</td>
                            </tr>
                            <tr>
                            	<td>
                                	<table width="0" border="0" cellspacing="0" cellpadding="3">
                                    	<tr>
                                        	<td><span class="re_main5">Emergency Contact: (if we need to reach someone else about the dog (pre or post adoption): </span></td>
                                        </tr>
                                        <tr>
                                        	<td>
                                            	<table width="0" border="0" cellpadding="3" cellspacing="0">
                                                	<tr>
                                                    	<td width="237" align="right" valign="top"><span class="re_main4">Contact Name</span></td>
                                                        <td valign="top"><input class="textbox_box" type="text" name="ans58" /></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Tel</span></td>
                                                        <td valign="top"><input class="textbox_box" type="text" name="ans59" /></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Home Address</span></td>
                                                        <td valign="top"><input class="textbox_box" type="text" name="ans60" /></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">City</span></td>
                                                        <td valign="top"><input class="textbox_box" type="text" name="ans61" /></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">State</span></td>
                                                        <td valign="top"><input class="textbox_box" type="text" name="ans62" /></td>
                                                    </tr>
                                                    <tr>
                                                      <td align="right" valign="top"><span class="re_main4">Zip Code</span></td>
                                                      <td valign="top"><input class="textbox_box3" type="text" name="ans63" /></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td height="1" bgcolor="#C2CB56"></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                	<td>
                    	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                        	<tr>
                            	<td>&nbsp;</td>
                            </tr>
                            <tr>
                            	<td>
                                	<table width="0" border="0" cellspacing="0" cellpadding="3">
                                    	<tr>
                                        	<td><span class="ce_title17">CAREGIVER(S) FOR THE DOG</span></td>
                                        </tr>
                                        <tr>
                                        	<td>
                                            	<table width="0" border="0" cellpadding="3" cellspacing="0">
                                                	<tr>
                                                    	<td width="237" align="right" valign="top"><span class="re_main4">Who will be the primary care taker</span></td>
                                                        <td valign="top">&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Name</span></td>
                                                        <td valign="top"><input class="textbox_box" type="text" name="ans64" /></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Age</span></td>
                                                        <td valign="top"><input class="textbox_box" type="text" name="ans65" /></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Veterinarian Name</span></td>
                                                        <td valign="top"><input class="textbox_box" type="text" name="ans66" /></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Vet Tel</span></td>
                                                        <td valign="top"><span class="re_main4">(<input class="textbox_box2" type="text" name="ans67" />)<input class="textbox_box2" type="text" name="ans68" /> - <input class="textbox_box2" type="text" name="ans69" /></span></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Veterinarian Address</span></td>
                                                        <td valign="top"><input class="textbox_box" type="text" name="ans70" /></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">City</span></td>
                                                        <td valign="top"><input class="textbox_box" type="text" name="ans71" /></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">State</span></td>
                                                        <td valign="top"><input class="textbox_box" type="text" name="ans72" /></td>
                                                    </tr>
                                                    <tr>
                                                      <td align="right" valign="top"><span class="re_main4">Zip Code</span></td>
                                                      <td valign="top"><input class="textbox_box3" type="text" name="ans73" /></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                            	<td>&nbsp;</td>
                            </tr>
                            <tr>
                            	<td height="1" bgcolor="#C2CB56"></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                	<td>
                    	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                        	<tr>
                            	<td>&nbsp;</td>
                            </tr>
                            <tr>
                            	<td>
                                	<table width="0" border="0" cellspacing="0" cellpadding="3">
                                    	<tr>
                                        	<td><span class="ce_title17">DOG’S HOME ENVIRONMENT</span></td>
                                        </tr>
                                        <tr>
                                        	<td>
                                            	<table width="0" border="0" cellpadding="3" cellspacing="0">
                                                	<tr>
                                                    	<td width="237" align="right" valign="top"><span class="re_main4">Where will the dog be normally kept</span></td>
                                                        <td valign="top">
                                                        	<table width="0" border="0" cellspacing="0" cellpadding="0">
                                                            	<tr>
                                                                	<td height="25"><input name="ans74" type="radio" class="css-checkbox" id="radio31" value="Indoors" /><label for="radio31" class="css-label radGroup2"><span class="checkbox re_main4">Indoors</span></label></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input name="ans74" type="radio" class="css-checkbox" id="radio32" value="Outdoors" /><label for="radio32" class="css-label radGroup2"><span class="checkbox re_main4">Outdoors</span></label></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input name="ans74" type="radio" class="css-checkbox" id="radio33" value="Both" /><label for="radio33" class="css-label radGroup2"><span class="checkbox re_main4">Both</span></label></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input name="ans74" type="radio" class="css-checkbox" id="radio34" value="Other" /><label for="radio34" class="css-label radGroup2"><span class="checkbox re_main4">Other </span><input class="textbox_box3" type="text" name="ans75" /></label></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Time(s) of Day/Night</span></td>
                                                        <td valign="top">
                                                        	<table width="0" border="0" cellspacing="0" cellpadding="0">
                                                            	<tr>
                                                                	<td height="25"><input name="ans76" type="radio" class="css-checkbox" id="radio35" value="Indoors" /><label for="radio35" class="css-label radGroup2"><span class="checkbox re_main4">Indoors </span><input class="textbox_box3" type="text" name="ans77" /></label></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input name="ans76" type="radio" class="css-checkbox" id="radio36" value="Outdoor" /><label for="radio36" class="css-label radGroup2"><span class="checkbox re_main4">Outdoor </span><input class="textbox_box3" type="text" name="ans78" /></label></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Number of days dog will be left alone</span></td>
                                                        <td valign="top">
                                                        	<table width="0" border="0" cellspacing="0" cellpadding="0">
                                                            	<tr>
                                                                	<td height="25"><input name="ans79" type="radio" class="css-checkbox" id="radio37" value="Weekdays" /><label for="radio37" class="css-label radGroup2"><span class="checkbox re_main4">Weekdays </span><input class="textbox_box3" type="text" name="ans80" /></label></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input name="ans79" type="radio" class="css-checkbox" id="radio38" value="Weekends" /><label for="radio38" class="css-label radGroup2"><span class="checkbox re_main4">Weekends </span><input class="textbox_box3" type="text" name="ans81" /></label></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Outdoors: Yard</span></td>
                                                        <td valign="top">
                                                        	<table width="0" border="0" cellspacing="0" cellpadding="0">
                                                            	<tr>
                                                                	<td height="25"><input name="ans82" type="radio" class="css-checkbox" id="radio39" value="Yes" /><label for="radio39" class="css-label radGroup2"><span class="checkbox re_main4">Yes</span></label></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input name="ans82" type="radio" class="css-checkbox" id="radio40" value="No" /><label for="radio40" class="css-label radGroup2"><span class="checkbox re_main4">No</span></label></td>
                                                                    <td width="20">&nbsp;</td>
                                                                    <td><span class="re_main4"> Fenced In </span></td>
                                                                    <td width="10">&nbsp;</td>
                                                                    <td><input name="ans83" type="radio" class="css-checkbox" id="radio41" value="Yes" /><label for="radio41" class="css-label radGroup2"><span class="checkbox re_main4">Yes</span></label></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input name="ans83" type="radio" class="css-checkbox" id="radio42" value="No" /><label for="radio42" class="css-label radGroup2"><span class="checkbox re_main4">No</span></label></td>
                                                                    <td width="20">&nbsp;</td>
                                                                    <td><span class="re_main4">Height of fence </span><input class="textbox_box2" type="text" name="ans84" /><span class="re_main4"> feet</span></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Any possibility of the dog escaping the yard</span></td>
                                                        <td valign="top">
                                                        	<table width="0" border="0" cellspacing="0" cellpadding="0">
                                                            	<tr>
                                                                	<td height="25"><input name="ans85" type="radio" class="css-checkbox" id="radio43" value="No" /><label for="radio43" class="css-label radGroup2"><span class="checkbox re_main4">No</span></label></td>
                                                                </tr>
                                                                <tr>
                                                                	<td height="100" valign="top"><input name="ans85" type="radio" class="css-checkbox" id="radio44" value="Yes" /><label for="radio44" class="css-label radGroup2"><span class="checkbox re_main4">Yes  (explain)</span><br /><textarea class="textbox_box4" name="ans86"></textarea></label></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Indoors: Location(s) Dog will be kept/allowed<br />while indoors (check all that apply)</span></td>
                                                        <td valign="top">
                                                        	<table width="0" border="0" cellspacing="0" cellpadding="0">
                                                            	<tr>
                                                                	<td height="25">
                                                                    <input name="ans87" type="checkbox" class="css-checkbox" id="radio45" value="Living Room" /><label for="radio45"><span class="checkbox re_main4">Living Room</span></label>
                                                                    </td>
                                                                    <td width="30">&nbsp;</td>
                                                                    <td><input name="ans174" type="checkbox" class="css-checkbox" id="radio46" value="Garage" /><label for="radio46"><span class="checkbox re_main4">Garage</span></label></td>
                                                                </tr>
                                                                <tr>
                                                                	<td height="25"><input name="ans175" type="checkbox" class="css-checkbox" id="radio47" value="Kitchen" /><label for="radio47"><span class="checkbox re_main4">Kitchen</span></label></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input name="ans176" type="checkbox" class="css-checkbox" id="radio48" value="Anywhere indoors" /> <label for="radio48"><span class="checkbox re_main4">Anywhere indoors</span></label></td>
                                                                </tr>
                                                                <tr>
                                                                	<td height="25"><input name="ans177" type="checkbox" class="css-checkbox" id="radio49" value="Bedroom(s)" /><label for="radio49"><span class="checkbox re_main4">Bedroom(s)</span></label></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input name="ans178" type="checkbox" class="css-checkbox" id="radio50" value="Other" /><label for="radio50"><span class="checkbox re_main4">Other </span></label><input class="textbox_box" type="text" name="ans88" /></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Types of outdoor activities/exercises<br />plan to do with the dog</span></td>
                                                        <td valign="top"><span class="re_main4"><textarea class="textbox_box4" name="ans89"></textarea></span></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                            	<td>&nbsp;</td>
                            </tr>
                            <tr>
                            	<td height="1" bgcolor="#C2CB56"></td>
                            </tr>
                        </table>
					</td>
	            </tr>
	            <tr>
                	<td>
                    	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                        	<tr>
                            	<td>&nbsp;</td>
                            </tr>
                            <tr>
                            	<td>
                                	<table width="0" border="0" cellspacing="0" cellpadding="3">
                                    	<tr>
                                        	<td><span class="ce_title17">OTHER PETS IN SAME HOUSEHOLD (CURRENT/PAST)</span></td>
                                        </tr>
                                        <tr>
                                        	<td>
                                            	<table width="0" border="0" cellpadding="3" cellspacing="0">
                                                	<tr>
                                                    	<td width="237" align="right" valign="top"><span class="re_main4">1st Pet Name</span></td>
                                                        <td valign="top"><input class="textbox_box5" type="text" name="ans90" /></td>
                                                    </tr>
                                                	<tr>
                                                	  <td align="right" valign="top">&nbsp;</td>
                                                	  <td valign="top"><table width="0" border="0" cellspacing="0" cellpadding="0">
                                                	    <tr>
                                                	      <td height="25"><input name="ans173" type="radio" class="css-checkbox" id="radio5" value="CURRENT" />
                                                	        <label for="radio5" class="css-label radGroup2"><span class="checkbox re_main4">CURRENT</span></label></td>
                                                	      <td>&nbsp;</td>
                                                	      <td><input name="ans173" type="radio" class="css-checkbox" id="radio6" value="PAST" />
                                                	        <label for="radio6" class="css-label radGroup2"><span class="checkbox re_main4">PAST</span></label></td>
                                              	      </tr>
                                              	    </table></td>
                                              	  </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Type of pet: (dog, cat, bird, etc.)</span></td>
                                                        <td valign="top"><input class="textbox_box5" type="text" name="ans91" /></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Breed</span></td>
                                                        <td valign="top"><input class="textbox_box5" type="text" name="ans92" /></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Gender</span></td>
                                                        <td valign="top">
                                                        	<table width="0" border="0" cellspacing="0" cellpadding="0">
                                                            	<tr>
                                                                	<td height="25"><input name="ans93" type="radio" class="css-checkbox" id="radio51" value="Male" /><label for="radio51" class="css-label radGroup2"><span class="checkbox re_main4">Male</span></label></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input name="ans93" type="radio" class="css-checkbox" id="radio52" value="Female" /><label for="radio52" class="css-label radGroup2"><span class="checkbox re_main4">Female</span></label></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Age</span></td>
                                                        <td valign="top">
                                                        	<table width="0" border="0" cellspacing="0" cellpadding="0">
                                                            	<tr>
                                                                	<td height="25"><input class="textbox_box2" type="text" name="ans94" /></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><span class="re_main4"> months </span></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input class="textbox_box2" type="text" name="ans95" /></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><span class="re_main4"> years </span></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Spayed/Neutered</span></td>
                                                        <td valign="top">
                                                        	<table width="0" border="0" cellspacing="0" cellpadding="0">
                                                            	<tr>
                                                                	<td height="25"><input name="ans96" type="radio" class="css-checkbox" id="radio53" value="Yes" /><label for="radio53" class="css-label radGroup2"><span class="checkbox re_main4">Yes</span></label></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input name="ans96" type="radio" class="css-checkbox" id="radio54" value="No" /><label for="radio54" class="css-label radGroup2"><span class="checkbox re_main4">No</span></label></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Length of time owned 1st pet</span></td>
                                                        <td valign="top">
                                                        	<table width="0" border="0" cellspacing="0" cellpadding="0">
                                                            	<tr>
                                                                	<td height="25"><input class="textbox_box2" type="text" name="ans97" /></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><span class="re_main4"> months </span></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input class="textbox_box2" type="text" name="ans98" /></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><span class="re_main4"> years </span></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Lives</span></td>
                                                        <td valign="top">
                                                        	<table width="0" border="0" cellspacing="0" cellpadding="0">
                                                            	<tr>
                                                                	<td height="25" valign="middle"><input name="ans99" type="radio" class="css-checkbox" id="radio55" value="Indoor" /><label for="radio55" class="css-label radGroup2"><span class="checkbox re_main4">Indoor</span></label></td>
                                                                    <td valign="middle">&nbsp;</td>
                                                                    <td valign="middle"><input name="ans99" type="radio" class="css-checkbox" id="radio56" value="Outdoor" /><label for="radio56" class="css-label radGroup2"><span class="checkbox re_main4">Outdoor</span></label></td>
                                                                    <td valign="middle">&nbsp;</td>
                                                                    <td valign="middle"><input name="ans99" type="radio" class="css-checkbox" id="radio57" value="Both" /><label for="radio57" class="css-label radGroup2"><span class="checkbox re_main4">Both</span></label></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Gets along with dogs</span></td>
                                                        <td valign="top">
                                                        	<table width="0" border="0" cellspacing="0" cellpadding="0">
                                                            	<tr>
                                                                	<td height="25"><input name="ans100" type="radio" class="css-checkbox" id="radio58" value="Yes" /><label for="radio58" class="css-label radGroup2"><span class="checkbox re_main4">Yes</span></label></td>
                                                                </tr>
                                                                <tr>
                                                                	<td height="100" valign="top"><input name="ans100" type="radio" class="css-checkbox" id="radio59" value="No" /><label for="radio59" class="css-label radGroup2"><span class="checkbox re_main4">No (explain)</span><br /><textarea class="textbox_box4" name="ans101"></textarea></label></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">2nd Pet Name</span></td>
                                                        <td valign="top"><input class="textbox_box5" type="text" name="ans102" /></td>
                                                    </tr>
                                                    <tr>
                                                      <td align="right" valign="top">&nbsp;</td>
                                                      <td valign="top"><table width="0" border="0" cellspacing="0" cellpadding="0">
                                                        <tr>
                                                          <td height="25"><input name="ans182" type="radio" class="css-checkbox" id="radio7" value="CURRENT" />
                                                            <label for="radio7" class="css-label radGroup2"><span class="checkbox re_main4">CURRENT</span></label></td>
                                                          <td>&nbsp;</td>
                                                          <td><input name="ans182" type="radio" class="css-checkbox" id="radio8" value="PAST" />
                                                            <label for="radio8" class="css-label radGroup2"><span class="checkbox re_main4">PAST</span></label></td>
                                                        </tr>
                                                      </table></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Type of pet: (dog, cat, bird, etc.)</span></td>
                                                        <td valign="top"><input class="textbox_box5" type="text" name="ans103" /></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Breed</span></td>
                                                        <td valign="top"><input class="textbox_box5" type="text" name="ans104" /></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Gender</span></td>
                                                        <td valign="top">
                                                        	<table width="0" border="0" cellspacing="0" cellpadding="0">
                                                            	<tr>
                                                                	<td height="25"><input name="ans105" type="radio" class="css-checkbox" id="radio60" value="Male" /><label for="radio60" class="css-label radGroup2"><span class="checkbox re_main4">Male</span></label></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input name="ans105" type="radio" class="css-checkbox" id="radio61" value="Female" /><label for="radio61" class="css-label radGroup2"><span class="checkbox re_main4">Female</span></label></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Age</span></td>
                                                        <td valign="top">
                                                        	<table width="0" border="0" cellspacing="0" cellpadding="0">
                                                            	<tr>
                                                                	<td height="25"><input class="textbox_box2" type="text" name="ans106" /></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><span class="re_main4"> months </span></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input class="textbox_box2" type="text" name="ans107" /></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><span class="re_main4"> years </span></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Spayed/Neutered</span></td>
                                                        <td valign="top">
                                                        	<table width="0" border="0" cellspacing="0" cellpadding="0">
                                                            	<tr>
                                                                	<td height="25"><input name="ans108" type="radio" class="css-checkbox" id="radio62" value="Yes" /><label for="radio62" class="css-label radGroup2"><span class="checkbox re_main4">Yes</span></label></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input name="ans108" type="radio" class="css-checkbox" id="radio63" value="No" /><label for="radio63" class="css-label radGroup2"><span class="checkbox re_main4">No</span></label></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Length of time owned 2nd pet</span></td>
                                                        <td valign="top">
                                                        	<table width="0" border="0" cellspacing="0" cellpadding="0">
                                                            	<tr>
                                                                	<td height="25"><input class="textbox_box2" type="text" name="ans109" /></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><span class="re_main4"> months </span></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input class="textbox_box2" type="text" name="ans110" /></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><span class="re_main4"> years </span></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Lives</span></td>
                                                        <td valign="top">
                                                        	<table width="0" border="0" cellspacing="0" cellpadding="0">
                                                            	<tr>
                                                                	<td height="25"><input name="ans111" type="radio" class="css-checkbox" id="radio64" value="Indoor" /><label for="radio64" class="css-label radGroup2"><span class="checkbox re_main4">Indoor</span></label></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input name="ans111" type="radio" class="css-checkbox" id="radio65" value="Outdoor" /><label for="radio65" class="css-label radGroup2"><span class="checkbox re_main4">Outdoor</span></label></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input name="ans111" type="radio" class="css-checkbox" id="radio66" value="Both" /><label for="radio66" class="css-label radGroup2"><span class="checkbox re_main4">Both</span></label></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Gets along with dogs</span></td>
                                                        <td valign="top">
                                                        	<table width="0" border="0" cellspacing="0" cellpadding="0">
                                                            	<tr>
                                                                	<td height="25"><input name="ans112" type="radio" class="css-checkbox" id="radio67" value="Yes" /><label for="radio67" class="css-label radGroup2"><span class="checkbox re_main4">Yes</span></label></td>
                                                                </tr>
                                                                <tr>
                                                                	<td height="100" valign="top"><input name="ans112" type="radio" class="css-checkbox" id="radio68" value="No" /><label for="radio68" class="css-label radGroup2"><span class="checkbox re_main4">No (explain) </span><br /><textarea class="textbox_box4" name="ans113"></textarea></label></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Have you ever lost or had to give up a pet before</span></td>
                                                        <td valign="top">
                                                        	<table width="0" border="0" cellspacing="0" cellpadding="0">
                                                            	<tr>
                                                                	<td height="25"><input name="ans114" type="radio" class="css-checkbox" id="radio69" value="Yes" /><label for="radio69" class="css-label radGroup2"><span class="checkbox re_main4">Yes</span></label></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input name="ans114" type="radio" class="css-checkbox" id="radio70" value="No" /><label for="radio70" class="css-label radGroup2"><span class="checkbox re_main4">No</span></label></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">If yes, what happened: (check as many as apply)</span></td>
                                                        <td valign="top">
                                                        	<table width="0" border="0" cellspacing="0" cellpadding="2">
                                                            	<tr>
                                                                	<td height="25"><input name="ans115" type="radio" class="css-checkbox" id="radio71" value="Surrendered/Abandoned" /><label for="radio71" class="css-label radGroup2"><span class="checkbox re_main4">Surrendered/Abandoned</span></label></td>
                                                                </tr>
                                                                <tr>
                                                                	<td height="25"><input name="ans115" type="radio" class="css-checkbox" id="radio72" value="Gave Away" /><label for="radio72" class="css-label radGroup2"><span class="checkbox re_main4">Gave Away</span></label></td>
                                                                </tr>
                                                                <tr>
                                                                	<td height="25"><input name="ans115" type="radio" class="css-checkbox" id="radio73" value="Lost/Ran Away" /><label for="radio73" class="css-label radGroup2"><span class="checkbox re_main4">Lost/Ran Away</span></label></td>
                                                                </tr>
                                                                <tr>
                                                                	<td height="25"><input name="ans115" type="radio" class="css-checkbox" id="radio74" value="Euthanized" /><label for="radio74" class="css-label radGroup2"><span class="checkbox re_main4">Euthanized</span></label></td>
                                                                </tr>
                                                                <tr>
                                                                	<td height="25"><input name="ans115" type="radio" class="css-checkbox" id="radio75" value="Sold" /><label for="radio75" class="css-label radGroup2"><span class="checkbox re_main4">Sold</span></label></td>
                                                                </tr>
                                                                <tr>
                                                                	<td height="25"><input name="ans115" type="radio" class="css-checkbox" id="radio76" value="Other" /><label for="radio76" class="css-label radGroup2"><span class="checkbox re_main4">Other </span><input class="textbox_box" type="text" name="ans116" /></label></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Please provide details of the above incident(s)<br />including type of pet, age, reason(s), and<br />date occurred</span></td>
                                                        <td valign="top"><span class="re_main4"><textarea class="textbox_box4" name="ans117"></textarea></span></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Prior experience with a shelter/rescue<br />group before</span></td>
                                                        <td valign="top">
                                                        	<table width="0" border="0" cellspacing="0" cellpadding="0">
                                                            	<tr>
                                                                	<td height="25"><input name="ans118" type="radio" class="css-checkbox" id="radio77" value="No" /><label for="radio77" class="css-label radGroup2"><span class="checkbox re_main4">No</span></label></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input name="ans118" type="radio" class="css-checkbox" id="radio78" value="Yes" /><label for="radio78" class="css-label radGroup2"><span class="checkbox re_main4">Yes (who) </span><input class="textbox_box" type="text" name="ans119" /></label></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">What you liked about it</span></td>
                                                        <td valign="top"><input class="textbox_box5" type="text" name="ans120" /></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">What you did not like about it</span></td>
                                                        <td valign="top"><input class="textbox_box5" type="text" name="ans121" /></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                            	<td>&nbsp;</td>
                            </tr>
                            <tr>
                            	<td height="1" bgcolor="#C2CB56"></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                	<td>
                    	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                        	<tr>
                            	<td>&nbsp;</td>
                            </tr>
                            <tr>
                            	<td>
                                	<table width="0" border="0" cellspacing="0" cellpadding="3">
                                    	<tr>
                                        	<td><span class="ce_title17">TRAINING</span></td>
                                        </tr>
                                        <tr>
                                        	<td>
                                            	<table width="0" border="0" cellpadding="3" cellspacing="0">
                                                	<tr>
                                                    	<td width="237" align="right" valign="top"><span class="re_main4">Experience level:<br />(1=no experience, 5=lots of experience <br />very comfortablewith all types of dogs)</span></td>
                                                        <td valign="top">
                                                        	<table width="0" border="0" cellspacing="0" cellpadding="0">
                                                            	<tr>
                                                                	<td height="25"><input name="ans122" type="radio" class="css-checkbox" id="radio79" value="1" /><label for="radio79" class="css-label radGroup2"><span class="checkbox re_main4">1</span></label></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input name="ans122" type="radio" class="css-checkbox" id="radio80" value="2" /><label for="radio80" class="css-label radGroup2"><span class="checkbox re_main4">2</span></label></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input name="ans122" type="radio" class="css-checkbox" id="radio81" value="3" /><label for="radio81" class="css-label radGroup2"><span class="checkbox re_main4">3</span></label></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input name="ans122" type="radio" class="css-checkbox" id="radio82" value="4" /><label for="radio82" class="css-label radGroup2"><span class="checkbox re_main4">4</span></label></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input name="ans122" type="radio" class="css-checkbox" id="radio83" value="5" /><label for="radio83" class="css-label radGroup2"><span class="checkbox re_main4">5</span></label></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Have you or the primarycaregiver ever<br />attended any dog training classes</span></td>
                                                        <td valign="top">
                                                        	<table width="0" border="0" cellspacing="0" cellpadding="0">
                                                            	<tr>
                                                                	<td height="25"><input name="ans123" type="radio" class="css-checkbox" id="radio84" value="Yes" /><label for="radio84" class="css-label radGroup2"><span class="checkbox re_main4">Yes</span></label></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input name="ans123" type="radio" class="css-checkbox" id="radio85" value="No" /><label for="radio85" class="css-label radGroup2"><span class="checkbox re_main4">No</span></label></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">If you have attended training classes, details</span></td>
                                                        <td valign="top">
                                                        	<table width="0" border="0" cellspacing="0" cellpadding="0">
                                                            	<tr>
                                                                	<td align="left"><span class="re_main4">What Type</span></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input class="textbox_box" type="text" name="ans124" /></td>
                                                                </tr>
                                                                <tr>
                                                                	<td align="left"><span class="re_main4">When</span></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input class="textbox_box" type="text" name="ans125" /></td>
                                                                </tr>
                                                                <tr>
                                                                	<td align="left"><span class="re_main4">Where</span></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input class="textbox_box" type="text" name="ans126" /></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Will you consider training if needed</span></td>
                                                        <td valign="top">
                                                        	<table width="0" border="0" cellspacing="0" cellpadding="0">
                                                            	<tr>
                                                                	<td height="30"><input name="ans127" type="radio" class="css-checkbox" id="radio86" value="Yes" /><label for="radio86" class="css-label radGroup2"><span class="checkbox re_main4">Yes</span></label></td>
                                                                </tr>
                                                                <tr>
                                                                	<td height="100" valign="top"><input name="ans127" type="radio" class="css-checkbox" id="radio87" value="No" /><label for="radio87" class="css-label radGroup2"><span class="checkbox re_main4">No (explain) </span><br /><textarea class="textbox_box4" name="ans128"></textarea></label></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top" class="re_main4">Are you aware that not all rescue dogs are<br />completely house trained and<br />accidents may occur?</td>
                                                        <td valign="top">
                                                        	<table width="0" border="0" cellspacing="0" cellpadding="0">
                                                            	<tr>
                                                                	<td height="25"><input name="ans129" type="radio" class="css-checkbox" id="radio88" value="Yes" /><label for="radio88" class="css-label radGroup2"><span class="checkbox re_main4">Yes</span></label></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input name="ans129" type="radio" class="css-checkbox" id="radio89" value="No" /><label for="radio89" class="css-label radGroup2"><span class="checkbox re_main4">No</span></label></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4"> Would the dog not being fully housetrained <br />aﬀect your ability to provide <br />a permanent home</span></td>
                                                        <td valign="top">
                                                        	<table width="0" border="0" cellspacing="0" cellpadding="0">
                                                            	<tr>
                                                                	<td height="25"><input name="ans130" type="radio" class="css-checkbox" id="radio90" value="Yes" /><label for="radio90" class="css-label radGroup2"><span class="checkbox re_main4">Yes</span></label></td>
                                                                </tr>
                                                                <tr>
                                                                	<td height="100" valign="top"><input name="ans130" type="radio" class="css-checkbox" id="radio91" value="No" /><label for="radio91" class="css-label radGroup2"><span class="checkbox re_main4">No (explain)</span><br /><textarea class="textbox_box4" name="ans131"></textarea></label></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                            	<td>&nbsp;</td>
                            </tr>
                            <tr>
                            	<td height="1" bgcolor="#C2CB56"></td>
                            </tr>
                        </table>
                    </td>
                </tr>
	            <tr>
	            	<td>
                    	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                        	<tr>
                            	<td>&nbsp;</td>
                            </tr>
                            <tr>
                            	<td>
                                	<table width="0" border="0" cellspacing="0" cellpadding="3">
                                    	<tr>
                                        	<td><span class="ce_title17">HOME INSPECTION/PHOTOGRAPHS</span></td>
                                        </tr>
                                        <tr>
                                        	<td>
                                            	<table width="0" border="0" cellpadding="3" cellspacing="0">
                                                	<tr>
                                                    	<td width="237" align="right" valign="top"><span class="re_main4">Please upload up to six of your home environment photos so that we can do a  preliminary home visit online. Photos of your family & pets, front house, living room, bedroom, kitchen area, garage,and yard are what we are looking for in order to determine if the home is safe for your new dog.</span></td>
                                                        <td valign="top">
														<?php for($i=1; $i<=$file_num; $i++) { ?>
                                                        <div class="upload_photo"><input type="file" name="file<?=$i?>_upload" id="file<?=$i?>_upload" />(Allow size: <?=$_width.'*'.$_height?>，Max file size:5mb)</div>
                                                        <?php } ?><br /><div id="photos_list" style="width:100%; padding-top:5px"></div></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Agree that a representative from<br>Adopt a Doggie<br />may schedule a visit to your homeupon request<br />to verify it is a suitable place for the dog,<br />which may include photographs</span></td>
                                                        <td valign="top">
                                                        	<table width="0" border="0" cellspacing="0" cellpadding="0">
                                                            	<tr>
                                                                	<td align="left" height="25"><input name="ans132" type="radio" class="css-checkbox" id="radio92" value="Yes" /><label for="radio92" class="css-label radGroup2"><span class="checkbox re_main4">Yes</span></label></td>
                                                                </tr>
                                                                <tr>
                                                                	<td align="left" height="100" valign="top"><input name="ans132" type="radio" class="css-checkbox" id="radio93" value="No" /><label for="radio93" class="css-label radGroup2"><span class="checkbox re_main4">No (explain) </span><br /><textarea class="textbox_box4" name="ans133"></textarea></label></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                            	<td>&nbsp;</td>
                            </tr>
                            <tr>
                            	<td height="1" bgcolor="#C2CB56"></td>
                            </tr>
                        </table>
                    </td>
	            </tr>
	            <tr>
	            	<td>
                    	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                        	<tr>
                            	<td>&nbsp;</td>
                            </tr>
                            <tr>
                            	<td>
                                	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    	<tr>
                                        	<td><span class="ce_title17">REFERENCES</span></td>
                                        </tr>
                                        <tr>
                                        	<td>
                                            	<table width="100%" border="0" cellspacing="0" cellpadding="3">
                                                	<tr>
                                                    	<td align="right" valign="top"><span class="re_main4"> Please provide the name and contact<br />information for two references that we may<br />contact who have knowledge of your ability<br />to care for a dog and can attest your<br />home is suitable for a dog </span></td>
                                                        <td valign="top">&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4"> Reference #1 Name </span></td>
                                                        <td valign="top"><input class="textbox_box" type="text" name="ans134" /></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4"> Relationship to this reference </span></td>
                                                        <td valign="top"><input class="textbox_box" type="text" name="ans135" /></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4"> Tel </span></td>
                                                        <td valign="top"><span class="re_main4">(<input class="textbox_box2" type="text" name="ans136" />)<input class="textbox_box2" type="text" name="ans137" /> - <input class="textbox_box2" type="text" name="ans138" /></span></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4"> Email </span></td>
                                                        <td valign="top"><input class="textbox_box" type="text" name="ans139" /></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4"> Home Address</span></td>
                                                        <td valign="top"><input class="textbox_box" type="text" name="ans140" /></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4"> City </span></td>
                                                        <td valign="top"><input class="textbox_box" type="text" name="ans141" /></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4"> State</span></td>
                                                        <td valign="top"><input class="textbox_box" type="text" name="ans142" /></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4"> Zip Code </span></td>
                                                        <td valign="top"><input class="textbox_box3" type="text" name="ans143" /></td>
                                                    </tr>
                                                    <tr>
                                                    	<td height="20" align="right" valign="top">&nbsp;</td>
                                                        <td valign="top">&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4"> Reference #2 Name</span></td>
                                                        <td valign="top"><input class="textbox_box" type="text" name="ans144" /></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4"> Relationship to this reference</span></td>
                                                        <td valign="top"><input class="textbox_box" type="text" name="ans145" /></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4"> Tel</span></td>
                                                        <td valign="top"><span class="re_main4">(<input class="textbox_box2" type="text" name="ans146" />)<input class="textbox_box2" type="text" name="ans147" /> - <input class="textbox_box2" type="text" name="ans148" /></span></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4"> Email </span></td>
                                                        <td valign="top"><input class="textbox_box5" type="text" name="ans149" /></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4"> Home Address</span></td>
                                                        <td valign="top"><input class="textbox_box5" type="text" name="ans150" /></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4"> City </span></td>
                                                        <td valign="top"><input class="textbox_box" type="text" name="ans151" /></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4"> State</span></td>
                                                        <td valign="top"><input class="textbox_box" type="text" name="ans152" /></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4"> Zip Code </span></td>
                                                        <td valign="top"><input class="textbox_box3" type="text" name="ans153" /><input name="ans154" type="hidden" class="css-checkbox" id="radio94" value="Yes" /><input name="ans154" type="hidden" class="css-checkbox" id="radio95" value="No" /></td>
                                                    </tr>
                                                    <tr>
                                                    	<td height="20" align="right" valign="top">&nbsp;</td>
                                                        <td valign="top">&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                    	<td width="237" align="right" valign="top"><span class="re_main4"> By signing this Adoption Application, you<br />attest that all of the information provided within is accurate and truthful to the best of your knowledge</span></td>
                                                        <td valign="top">
                                                        	<table width="100%" border="0" cellspacing="0" cellpadding="3">
                                                                        	<tr>
                                                                            	<td height="25"><span class="re_main4">Name</span></td>
                                                                                <td><input class="text_line" type="text" name="ans155" style="width:380px;" /></td>
                                                                            </tr>
                                                                        </table>
                                                            <table width="100%" border="0" cellspacing="0" cellpadding="3">
                                                                        	<tr>
                                                                            	<td height="25"><span class="re_main4">Signature</span></td>
                                                                                <td><input class="text_line" type="text" name="ans156" style="width:360px;" /></td>
                                                                            </tr>
                                                                        </table>
                                                            <table width="100%" border="0" cellspacing="0" cellpadding="3">
                                                                        	<tr>
                                                                            	<td><span class="re_main4">Date</span></td>
                                                                                <td><input class="text_line" type="text" name="ans157" style="width:387px;" /></td>
                                                                            </tr>
                                                                        </table>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                            	<td>&nbsp;</td>
                            </tr>
                            <tr>
                            	<td height="1" bgcolor="#C2CB56"></td>
                            </tr>
                        </table>
                    </td>
	            </tr>
	            <tr>
	            	<td>
                    	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                        	<tr>
                            	<td>&nbsp;</td>
                            </tr>
                            <tr>
                            	<td>
                                	<table width="0" border="0" cellspacing="0" cellpadding="3">
                                    	<tr>
                                        	<td><span class="ce_title17">OPTIONAL INFORMATION</span></td>
                                        </tr>
                                        <tr>
                                        	<td>
                                            	<table width="0" border="0" cellpadding="3" cellspacing="0">
                                                	<tr>
                                                    	<td width="237" align="right" valign="top"><span class="re_main4">How did you hear about Adopt a Doggie</span></td>
                                                        <td valign="top">
                                                        	<table width="0" border="0" cellspacing="0" cellpadding="2">
                                                            	<tr>
                                                                	<td>
                                                                    	<table width="0" border="0" cellspacing="0" cellpadding="0">
                                                                        	<tr>
                                                                            	<td><input name="ans158" type="checkbox" class="css-checkbox" id="radio96" value="Google" /><label for="radio96"><span class="checkbox re_main4">Google</span></label></td>
                                                                                <td>&nbsp;</td>
                                                                                <td><input name="ans159" type="checkbox" class="css-checkbox" id="radio97" value="Petﬁnder" /><label for="radio97"><span class="checkbox re_main4">Petﬁnder</span></label></td>
                                                                                <td>&nbsp;</td>
                                                                                <td><input name="ans160" type="checkbox" class="css-checkbox" id="radio98" value="Yelp" /><label for="radio98"><span class="checkbox re_main4">Yelp</span></label></td>
                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                	<td>
                                                                    	<table width="0" border="0" cellspacing="0" cellpadding="0">
                                                                        	<tr>
                                                                            	<td><input name="ans161" type="checkbox" class="css-checkbox" id="radio99" value="Yahoo" /><label for="radio99"><span class="checkbox re_main4">Yahoo</span></label></td>
                                                                                <td>&nbsp;</td>
                                                                                <td><input name="ans162" type="checkbox" class="css-checkbox" id="radio100" value="Facebook" /><label for="radio100"><span class="checkbox re_main4">Facebook</span></label></td>
                                                                                <td>&nbsp;</td>
                                                                                <td><input name="ans163" type="checkbox" class="css-checkbox" id="radio101" value="Word of Mouth" /><label for="radio101"><span class="checkbox re_main4">Word of Mouth</span></label></td>
                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                	<td><input name="ans164" type="checkbox" class="css-checkbox" id="radio102" value="Owner of a Adopt a Doggie dog" /><label for="radio102"><span class="checkbox re_main4">Owner of a Adopt a Doggie dog</span></label></td>
                                                                </tr>
                                                                <tr>
                                                                	<td><input name="ans165" type="checkbox" class="css-checkbox" id="radio103" value="Other" /><label for="radio103"><span class="checkbox re_main4">Other</span></label></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Would you like to be invited to the<br />
                                               	      Adopt a Doggie<br>Bay Area Dog Owners Facebook Page?</span></td>
                                                        <td valign="top">
                                                        	<table width="0" border="0" cellspacing="0" cellpadding="0">
                                                            	<tr>
                                                                	<td height="25"><input name="ans166" type="radio" class="css-checkbox" id="radio104" value="Yes" /><label for="radio104" class="css-label radGroup2"><span class="checkbox re_main4">Yes</span></label></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input name="ans166" type="radio" class="css-checkbox" id="radio105" value="No" /><label for="radio105" class="css-label radGroup2"><span class="checkbox re_main4">No</span></label></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Would you like to be included on the<br />Adopt a Doggie<br />email list?</span></td>
                                                        <td valign="top">
                                                        	<table width="0" border="0" cellspacing="0" cellpadding="0">
                                                            	<tr>
                                                                	<td height="25"><input name="ans167" type="radio" class="css-checkbox" id="radio106" value="Yes" /><label for="radio106" class="css-label radGroup2"><span class="checkbox re_main4">Yes</span></label></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input name="ans167" type="radio" class="css-checkbox" id="radio107" value="No" /><label for="radio107" class="css-label radGroup2"><span class="checkbox re_main4">No</span></label></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">May we share your contact information with<br />your dog’s rescuer after the adoption is ﬁnalized?</span></td>
                                                        <td valign="top">
                                                        	<table width="0" border="0" cellspacing="0" cellpadding="0">
                                                            	<tr>
                                                                	<td height="25"><input name="ans168" type="radio" class="css-checkbox" id="radio108" value="Yes" /><label for="radio108" class="css-label radGroup2"><span class="checkbox re_main4">Yes</span></label></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input name="ans168" type="radio" class="css-checkbox" id="radio109" value="No" /><label for="radio109" class="css-label radGroup2"><span class="checkbox re_main4">No</span></label></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Additional comments or questions</span></td>
                                                        <td valign="top"><textarea class="textbox_box4" name="ans169"></textarea></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Verification Code</span></td>
                                                        <td valign="top"><img src="tools/chucksum.php" alt="Change another verification code" id="rand-img" width="120" height="30" name="chucksumImg" border="1" style="cursor:hand" >
                                                        <input name="key_c" type="text" class="css-checkbox" id="key_c" value="" /><input name="key_c_c" type="hidden" id="key_c_c" value="<?=$_SESSION['s_checksum']?>" /></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                            	<td height="150" align="center" valign="middle"><!--<span class="re_main4_btn"><a href="#" onClick="javascript:print();">Print</a></span> --><span class="re_main4_btn"><a href="javascript:real_save()" style="cursor:pointer">Send</a></span><!--&nbsp;&nbsp;<span class="re_main4_btn"><a href="?save=1">Save to Html</a></span><br><br><br>How to save the PDF file：<span class="re_main6_btn"><a href="download/savetopdf_PC.pdf" target="new" style="width: 200px;">PC</a></span>&nbsp;、&nbsp;<span class="re_main6_btn"><a href="download/savetopdf_MAC.pdf" target="new" style="width: 200px;">MAC</a></span>--></td>
                            </tr>
                            <tr>
                            	<td height="1" bgcolor="#C2CB56"></td>
                            </tr>
                        </table>
                    </td>
	            </tr>
	            <tr>
	            	<td>
                    	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                        	<tr>
                            	<td width="500"><span class="re_main5">Thank you for your interest in Adopt a Doggie and our rescued dogs! Our staff will review your application and let you know once it has been approved. We may contact you if there are any additional questions or concerns. Welcome to the Adopt a Doggie family!</span></td>
                            </tr>
                            <tr>
                            	<td>&nbsp;</td>
                            </tr>
                        </table>
                    </td>
	            </tr>
	        </table>
		</td>
		<td width="20">&nbsp;</td>
        <td valign="top">
        	<table width="0" border="0" cellspacing="0" cellpadding="0">
            	<tr>
                	<td width="168" height="223" bgcolor="#D5E044">&nbsp;</td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</form>
</div>
<!----------- 內容 結束 ------------------>

</body>
</html>
<?php include("include_bottom.php"); ?>
