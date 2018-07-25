<?php
header("content-type:text/html;charset=utf-8");
require_once('set.php');

$main_str   = 'pages';
$table_name = Proj_Name.'_'.$main_str;	
$obj_image  = new files();	

$category = format_data($_REQUEST['category'], 'int');

if($_POST['action']=='save') {
	$lang        = $_SESSION[Login_System_User]['lang'];
	$Fullkey     = format_data($_POST['Fullkey'], 'int');
	$category    = format_data($_POST['category'], 'int');
	$title       = format_data($_POST['title'], 'text');
	$file1       = format_data($_POST['file1'], 'text');
	$file2       = format_data($_POST['file2'], 'text');
	$video_title = format_data($_POST['video_title'], 'text');
	$video_title2= format_data($_POST['video_title2'], 'text');
	$youtube     = format_data($_POST['youtube'], 'text');
	$youtube2    = format_data($_POST['youtube2'], 'text');
	$other_video = format_data($_POST['other_video'], 'content');
	$other_video2= format_data($_POST['other_video2'], 'content');
	$content     = format_data($_POST['content'], 'content');
	$content2    = format_data($_POST['content2'], 'content');
	$sort        = format_data($_POST['sort'], 'text');
	
	if(!$Fullkey)
		$query = "insert into $table_name(lang, category, title, file1, file2, video_title, video_title2, youtube, youtube2, other_video, other_video2, content, content2, sort, pub, create_time, edit_time) values('".$lang."', '".$category."', '".$title."', '".$file1."', '".$file2."', '".$video_title."', '".$video_title2."', '".$youtube."', '".$youtube2."', '".$other_video."', '".$other_video2."', '".$content."', '".$content2."', '".$sort."', 1, now(), now())";
	elseif($Fullkey)
		$query = "update $table_name set title='".$title."', file1='".$file1."', file2='".$file2."', video_title='".$video_title."', video_title2='".$video_title2."', youtube='".$youtube."', youtube2='".$youtube2."', other_video='".$other_video."', other_video2='".$other_video2."', content='".$content."', content2='".$content2."', sort='".$sort."', edit_time=now() where Fullkey='".$Fullkey."'";
	$obj_pages->run_mysql($query);
	
	if($obj_pages->result) {
		js_a_l('儲存成功', $main_str.'_handle.php?category='.$category.'&Fullkey='.$Fullkey);exit;
	}else {
		js_a_l('儲存失敗，請重新輸入並檢查', 'back');exit;
	}
}elseif ($_GET['Fullkey']) {
	$Fullkey = format_data($_GET['Fullkey'], 'int');
	$query   = "select * from $table_name where Fullkey='".$Fullkey."'";
	$pages   = $obj_pages->run_mysql_out($query);
}
if($category==1) {
	$file_num = 2;
	$_width  = 400;
	$_height = 252;
	$_width_s  = 400*0.5;
	$_height_s = 252*0.5;
}elseif($category==2 && $pages['Fullkey']==3){
	$file_num = 1;
	$_width  = 400;
	$_height = 252;
	$_width_s  = 400*0.5;
	$_height_s = 252*0.5;
}else {
	$file_num = 0;	
}
//category title
$cate_title = '';
if($category!=0) {		
	$tmp_prev = $category;
	do{
		$query = "select Fullkey, name, prev, lv from ".$table_name."_category where Fullkey='".$tmp_prev."'";
		$pc = $obj_cate1->run_mysql_out($query);
		$cate_title = "<a href=".$main_str."_category.php?prev=".$pc['prev']."><li class='left'>".$pc['name']."</li></a>".$cate_title;
		$tmp_prev = $pc['prev'];
	}while($pc['prev']!=0);
}
?><!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title><?=Html_Title?>後台管理系統</title>
<?php include("include_head.php"); ?>
<script src="../ckeditor/ckeditor.js"></script>
<script src="../ckeditor/adapters/jquery.js"></script>
<script type="text/javascript" src="../jqwidgets/jqxvalidator.js"></script>  
<!-- uploadify -->
<script type="text/javascript" src="../uploadify/jquery.uploadify-3.1.min.js"></script>
<link rel="stylesheet" type="text/css" href="../uploadify/uploadify.css" />
<script type="text/javascript">
$(document).ready(function () {
	<?php if($category==1 || ($category==2&&$pages['Fullkey']==7)){ ?>
	$( '#content' ).ckeditor();
	<?php }elseif($category==2){ ?>
	$( '#content2' ).ckeditor();
	<?php } ?>
	//upload file
	<?php 
	for($i=1; $i<=$file_num; $i++) { 
		$obj_image->uploadify_js('file'.$i.'_upload', 'file'.$i, 'show_file'.$i, array("action", "main_str", "category", "Fullkey", "file_o", "key", "_width_s", "_height_s"), array("upload_pages", $main_str, $category, $pages["Fullkey"], "", $i, $_width_s, $_height_s));
	} 
	?>
	var theme = '<?=jqxStyle?>';
	
	$('#sendButton').bind('click', function () {
		$('#<?=$main_str?>_form').jqxValidator('validate');
		
	});
	$('#<?=$main_str?>_form').bind('validationSuccess', function (event) { 
		$('#<?=$main_str?>_form').submit();
	});
	$('.text-input').addClass('jqx-input');
	$('.text-input').addClass('jqx-rc-all');
	if (theme.length > 0) {
		$('.text-input').addClass('jqx-input-' + theme);
		$('.text-input').addClass('jqx-widget-content-' + theme);
		$('.text-input').addClass('jqx-rc-all-' + theme);
	}
	// initialize validator.
	$('#<?=$main_str?>_form').jqxValidator({
		rules: [
		{ input: '#title', message: '請輸入標題', action: 'keyup, blur', rule: 'required' }], 
		theme: theme
	});
});
</script>
</head>
<body>
<?php include("include_top.php"); ?>
<div class="admin-panel">
  <?php include("include_menu.php"); ?><!--slidebar end-->
   <div class="main set_page_h page_shadow">
   <ul class="topbar">
      <a href="index.php"><li class="left">首頁</li></a><?=$cate_title?>
      <li class="title"><?=$page_title?></li>
      <li class="right"><?php include('include_welcome.php'); ?></li>
   </ul>
   <div class="mainContent">
   	 <div id="data_content">
   		<form method="post" id="<?=$main_str?>_form" action="<?=$_SERVER['PHP_SELF']?>">
            <input type="hidden" name="action" value="save" />
            <input type="hidden" name="Fullkey" value="<?=$pages['Fullkey']?>" />
            <input type="hidden" name="category" value="<?=$category?>" />
            <table class="<?=$main_str?>-table">
            	<?php for($i=1; $i<=$file_num; $i++) { ?>
                <?php if($i%2==1){echo '<tr>';} ?>
                    <td height="60">上傳圖片<?=$i?>：</td>
                    <td align="left"><?php $obj_image->show_pic1($main_str.'/'.$pages['file'.$i], $_width_s, $_height_s, $pages['title'], 'show_file'.$i) ?> <input type="button" class="delButton" value="刪除檔案" onClick="$('#show_file<?=$i?>').attr('src', '../images/space.png');$('#file<?=$i?>').val('')" /><br /><input type="text" name="file<?=$i?>" id="file<?=$i?>" value="<?=$pages['file'.$i]?>" class="frome" style="width:200px" readonly /><br /><input type="file" name="file<?=$i?>_upload" id="file<?=$i?>_upload" />(建議圖片尺寸: <?=$_width.'*'.$_height?>，檔案大小5mb)</td>
                <?php if($i%2==0){echo '</tr>';} ?>
                <?php } ?>
                <tr>
                    <td width="120" height="60">標　　題：</td>
                    <td colspan="3" align="left"><input type="text" name="title" id="title" value="<?=$pages['title']?>" class="frome" style="width:400px" /></td>
                </tr>
                <?php if($category==1 || ($category==2&&$pages['Fullkey']==7)){ ?>
                <tr>
                    <td height="60">內　　容：</td>
                    <td colspan="3"><textarea id="content" name="content" rows="10"><?=stripslashes($pages['content'])?></textarea></td>
                </tr>
                <?php }elseif($category==2 && $pages['Fullkey']!=7){ ?>
                <tr>
                    <td height="60">右側說明文：</td>
                    <td colspan="3"><textarea id="content" name="content" rows="10" style="width:400px"><?=stripslashes($pages['content'])?></textarea></td>
                </tr>
                <tr>
                    <td height="60">中間說明文：</td>
                    <td colspan="3"><textarea id="content2" name="content2" rows="10"><?=stripslashes($pages['content2'])?></textarea></td>
                </tr>                
                <?php } ?>
                <?php if($pages['Fullkey']==5){ ?>
                <tr>
                    <td height="60">影片標題：</td>
                    <td colspan="3"><input type="text" name="video_title" id="video_title" value="<?=$pages['video_title']?>" class="frome" style="width:400px" /></td>
                </tr>
                <tr>
                    <td height="60">Youtube：</td>
                    <td colspan="3"><input type="text" name="youtube" id="youtube" value="<?=$pages['youtube']?>" class="frome" style="width:400px" />(請輸入影片分享短連結)</td>
                </tr>
                <tr>
                    <td height="60">其他影片:</td>
                  <td align="left" colspan="4">影片尺寸：width="400" height="224"<br><textarea name="other_video" id="other_video" class="frome" style="width:100%; height:150px"><?=stripslashes($pages['other_video'])?></textarea>(請自行調整影片iframe崁入語法)</td>
                </tr>
                <tr>
                    <td height="60">影片標題2：</td>
                    <td colspan="3"><input type="text" name="video_title2" id="video_title2" value="<?=$pages['video_title2']?>" class="frome" style="width:400px" /></td>
                </tr>
                <tr>
                    <td height="60">Youtube2：</td>
                    <td colspan="3"><input type="text" name="youtube2" id="youtube2" value="<?=$pages['youtube2']?>" class="frome" style="width:400px" />(請輸入影片分享短連結)</td>
                </tr>
                <tr>
                    <td height="60">其他影片2:</td>
                  <td align="left" colspan="4">影片尺寸：width="400" height="224"<br>
                  <textarea name="other_video2" id="other_video2" class="frome" style="width:100%; height:150px"><?=stripslashes($pages['other_video2'])?></textarea>(請自行調整影片iframe崁入語法)</td>
                </tr>
                <?php } ?>
                <?php if($pages['Fullkey']==4){ ?>
                <tr>
                    <td height="60">Youtube：</td>
                    <td colspan="3"><input type="text" name="youtube" id="youtube" value="<?=$pages['youtube']?>" class="frome" style="width:400px" />(請輸入影片分享短連結)</td>
                </tr>
                <?php } ?>
                <tr>
                    <td colspan="2" style="text-align: center;"><button type="button" id="sendButton" class="editbtn enter" title="儲存" >儲 存</button></td>
                </tr>
            </table>
            </form>
     </div><!--content end-->
   </div><!--mainContent end-->
   <?php include("include_footer.php"); ?>
  </div><!--main end-->
</div><!--admin-panel end-->

</body>
</html>