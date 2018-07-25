<?php
header("content-type:text/html;charset=utf-8");
require_once('set.php');
require_once(Root_Includes_Path.'function_page.php');

$main_str   = 'dogs';
$table_name = Proj_Name.'_'.$main_str;
$obj_image  = new files();	
$file_num   = 1;
$_width     = 1200;
$_height    = 900;

if ($_GET['dog_id']) {
	$dog_id = format_data($_GET['dog_id'], 'int');
	$query  = "select Fullkey, name from $table_name where Fullkey='".$dog_id."'";
	$dogs   = $obj_dogs->run_mysql_out($query);
	
	//開啟相簿資料夾
	if(!is_dir(Root_Path.$main_str.'_photos/'.$dogs['Fullkey'])) {
		$obj_image->add_dir(Root_Path.$main_str.'_photos/'.$dogs['Fullkey']);
	}
}else {
	js_a_l('', 'dogs.php');exit;	
}
?><!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title><?=Html_Title?>後台管理系統</title>
<?php include("include_head.php"); ?>
<!-- uploadify -->
<script type="text/javascript" src="../uploadify/jquery.uploadify-3.1.min.js"></script>
<link rel="stylesheet" type="text/css" href="../uploadify/uploadify.css" />
<script type="text/javascript">
/*$( document ).ajaxStart(function() {
	$( "#photos_list" ).html( '<div id="loading_img" style="text-align:center; height:300px; margin-top:150px;"><img src="../images/lightbox/loading.gif" border="0"></div>' );
});
$( document ).ajaxStop(function() {
	$( "#loading_img" ).hide();
});*/
function show_list() {
	$("#photos_list").html('');
	var ajaxurl = '<?=$main_str?>_data.php?action=photos_list&dog_id=<?=$dogs['Fullkey']?>';
	$.ajax({
		url: ajaxurl,
		dataType: 'json',
		success: function(request) {
			$.each(request, function(key, photo_data) {
				$.each(photo_data, function(key, data)	{
					if(data['title']=='輸入標題後按下Enter')
						title_class_str = 'photo_title_text1';
					else
						title_class_str = 'photo_title_text2';
					if(data['sort']=='數字越大排序越前面')
						sort_class_str = 'photo_sort_text1';
					else
						sort_class_str = 'photo_sort_text2';
						
					var div_str = '<div id="show_photo_block_'+data['photo_id']+'" class="show_photo" onmouseover="mouseover_show_btn(\''+data['photo_id']+'\')" onmouseout="mouseover_hidden_btn(\''+data['photo_id']+'\')"><div class="photo_block"><div id="photo_del_'+data['photo_id']+'" class="del_btn" onclick="delete_photo(\''+data['photo_id']+'\', \''+data['file1']+'\', \''+data['title']+'\')"><img src="../images/close.png" border="0"></div><img src="../<?=$main_str?>_photos/<?=$dog_id?>/'+data['file1']+'" width="'+data['width']+'" height="'+data['height']+'" alt="'+data['title']+'" id="photo_file1_'+data['photo_id']+'"></div><input type="text" name="photo_title_'+data['photo_id']+'" id="photo_title_'+data['photo_id']+'" value="'+data['title']+'" class="'+title_class_str+'" onclick="javascript:update_text(\''+data['photo_id']+'\', \'title\')" onkeydown="javascript:keydown_text(\''+data['photo_id']+'\', \'title\', event)" onblur="javascript:reload_text(\''+data['photo_id']+'\', \'title\', \''+data['title']+'\')"><input type="text" name="photo_sort_'+data['photo_id']+'" id="photo_sort_'+data['photo_id']+'" value="'+data['sort']+'" class="'+sort_class_str+'" onclick="javascript:update_text(\''+data['photo_id']+'\', \'sort\')" onkeydown="javascript:keydown_text(\''+data['photo_id']+'\', \'sort\', event)" onblur="javascript:reload_text(\''+data['photo_id']+'\', \'sort\', \''+data['sort']+'\')"></div>';//alert(div_str);
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
function update_text(photo_id, update_row) {
	if(update_row=='title')
		default_value = '輸入標題後按下Enter';
	else if(update_row=='sort')
		default_value = '數字越大排序越前面';
	if($("#photo_"+update_row+"_"+photo_id).val()==default_value) {
		$("#photo_"+update_row+"_"+photo_id).val('');
	}
	$("#photo_"+update_row+"_"+photo_id).css("color", "#000");
}
function keydown_text(photo_id, update_row, e) {
	if(e.keyCode==13) {
		var ajaxurl = '<?=$main_str?>_data.php?action=update_photo&dog_id=<?=$dogs['Fullkey']?>&photo_id='+photo_id+'&update_row='+update_row+'&update_text='+encodeURIComponent($("#photo_"+update_row+"_"+photo_id).val());
		$.ajax({
			url: ajaxurl,
			dataType: 'html',
			success: function(request) {
				show_list();
			}
		});
	}
}
function reload_text(photo_id, update_row, o_text) {
	if(update_row=='title')
		default_value = '輸入標題後按下Enter';
	else if(update_row=='sort')
		default_value = '數字越大排序越前面';
	if($("#photo_"+update_row+"_"+photo_id).val()=='') {
		$("#photo_"+update_row+"_"+photo_id).val(default_value);
	}else {
		$("#photo_"+update_row+"_"+photo_id).val(o_text);	
	}
	$("#photo_"+update_row+"_"+photo_id).css("color", "#CCC");
}
function delete_photo(photo_id, file1, title) {
	if(title=='輸入標題後按下Enter')
		title = '';
	if(confirm("確定要刪除 "+title+"("+file1+") 此張相片??")) {
		var ajaxurl = '<?=$main_str?>_data.php?action=delete_photo&dog_id=<?=$dog_id?>&photo_id='+photo_id+'&file1='+file1;
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
	<?php 
	for($i=1; $i<=$file_num; $i++) { 
		$obj_image->uploadify_js('file'.$i.'_upload', 'file'.$i, 'show_file'.$i, array("action", "main_str", "dog_id"), array("upload_dogs_photo", $main_str, $dogs['Fullkey']));
	} 
	?>
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
</head>
<body>
<?php include("include_top.php"); ?>
<div class="admin-panel">
  <?php include("include_menu.php"); ?><!--slidebar end-->
   <div class="main set_page_h page_shadow">
   <ul class="topbar">
      <a href="index.php"><li class="left">首頁</li></a>
      <a href="dogs.php"><li class="left"><?=stripslashes($dogs['name'])?></li></a>
      <li class="title"><?=$page_title?></li>
      <li class="right"><?php include('include_welcome.php'); ?></li>
   </ul>
   <div class="mainContent">
   	 <div id="data_content">
   		<div class="template_black">
            <?php for($i=1; $i<=$file_num; $i++) { ?>
            <div class="upload_photo"><input type="file" name="file<?=$i?>_upload" id="file<?=$i?>_upload" />(選擇照片上傳，建議圖片尺寸: <?=$_width.'*'.$_height?>，檔案大小限制5mb)</div>
            <?php } ?>
            <div id="photos_list" style="width:100%; padding-top:5px"></div>
      </div><!--template_black end-->
    </div><!--content end-->
   </div><!--mainContent end-->
   <?php include("include_footer.php"); ?>
  </div><!--main end-->
</div><!--admin-panel end-->
</body>
</html>