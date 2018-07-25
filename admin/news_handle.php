<?php
header("content-type:text/html;charset=utf-8");
require_once('set.php');
require_once(Root_Includes_Path.'class_jqx.php');

$main_str   = 'news';
$table_name = Proj_Name.'_'.$main_str;	
$obj_jqx    = new jqx();
$obj_image  = new files();	

$category = format_data($_REQUEST['category'], 'int');
$file_num = 1;
$_width  = 146;
$_height = 75;
$_width_s  = 146;
$_height_s = 75;

if($_POST['action']=='save') {
	$lang      = $_SESSION[Login_System_User]['lang'];
	$Fullkey   = format_data($_POST['Fullkey'], 'int');
	$category  = format_data($_POST['category'], 'int');
	$news_date = format_data($_POST['news_date'], 'text');
	$title     = format_data($_POST['title'], 'text');
	$file1     = format_data($_POST['file1'], 'text');
	$content   = format_data($_POST['content'], 'content');
	
	if(!$Fullkey)
		$query = "insert into $table_name(lang, category, news_date, title, file1, content, pub, create_time, edit_time) values('".$lang."', '".$category."', '".$news_date."', '".$title."', '".$file1."', '".$content."', '1', now(), now())";
	elseif($Fullkey)
		$query = "update $table_name set news_date='".$news_date."', title='".$title."', file1='".$file1."', content='".$content."', edit_time=now() where Fullkey='".$Fullkey."'";
	$obj_news->run_mysql($query);
	
	if($obj_news->result) {
		js_a_l('儲存成功', $main_str.'.php?category='.$category);exit;
	}else {
		js_a_l('儲存失敗，請重新輸入並檢查', 'back');exit;
	}
}elseif ($_GET['Fullkey']) {
	$Fullkey = format_data($_GET['Fullkey'], 'int');
	$query   = "select * from $table_name where Fullkey='".$Fullkey."'";
	$news    = $obj_news->run_mysql_out($query);
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
<script type="text/javascript" src="../jqwidgets/jqxcalendar.js"></script> 
<script type="text/javascript" src="../jqwidgets/jqxdatetimeinput.js"></script>
<!-- uploadify -->
<script type="text/javascript" src="../uploadify/jquery.uploadify-3.1.min.js"></script>
<link rel="stylesheet" type="text/css" href="../uploadify/uploadify.css" />
<script type="text/javascript">
$(document).ready(function () {
	<?php if($category==1||$category==2) { ?>
	$( '#content' ).ckeditor();
	<?php } ?>
	//upload file
	<?php 
	for($i=1; $i<=$file_num; $i++) { 
		$obj_image->uploadify_js('file'.$i.'_upload', 'file'.$i, 'show_file'.$i, array("action", "main_str", "category", "Fullkey", "file_o", "key", "_width_s", "_height_s"), array("upload_news", $main_str, $category, $news["Fullkey"], "", $i, $_width_s, $_height_s));
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
	<?php $obj_jqx->datepicker('news_date', $news['news_date']); ?>
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
            <input type="hidden" name="Fullkey" value="<?=$news['Fullkey']?>" />
            <input type="hidden" name="category" value="<?=$category?>" />
            <table class="<?=$main_str?>-table">
                <tr>
                    <td width="120" height="60">文章日期：</td>
                    <td align="left"><div id="news_date" style="width:400px"></div></td>
                </tr>
                <?php
				if($category==1) {
				?>
                <tr>
                    <td height="60">標　　題：</td>
                    <td align="left"><input type="text" name="title" id="title" value="<?=$news['title']?>" class="frome" style="width:400px" /></td>
                </tr>
                <tr>
                    <td height="60">內　　容：</td>
                    <td><textarea id="content" name="content" rows="10"><?=stripslashes($news['content'])?></textarea></td>
                </tr>
                <?php
				}elseif($category==2) {
				?>
            	<?php for($i=1; $i<=$file_num; $i++) { ?>
                <?php if($i%2==1){echo '<tr>';} ?>
                    <td height="60">上傳圖片<?=$i?>：</td>
                    <td align="left"><?php $obj_image->show_pic1($main_str.'/'.$news['file'.$i], $_width_s, $_height_s, $news['title'], 'show_file'.$i) ?> <input type="button" class="delButton" value="刪除檔案" onClick="$('#show_file<?=$i?>').attr('src', '../images/space.png');$('#file<?=$i?>').val('')" /><br /><input type="text" name="file<?=$i?>" id="file<?=$i?>" value="<?=$news['file'.$i]?>" class="frome" style="width:200px" readonly="readonly" /><br /><input type="file" name="file<?=$i?>_upload" id="file<?=$i?>_upload" />(建議圖片尺寸: <?=$_width.'*'.$_height?>，檔案大小5mb)</td>
                <?php if($i%2==0){echo '</tr>';} ?>
                <?php } ?>	
                <tr>
                    <td height="60">標　　題：</td>
                    <td align="left"><input type="text" name="title" id="title" value="<?=$news['title']?>" class="frome" style="width:400px" /></td>
                </tr>
                <tr>
                    <td height="60">內　　容：</td>
                    <td><textarea id="content" name="content" rows="10"><?=stripslashes($news['content'])?></textarea></td>
                </tr>
                <?php
				}elseif($category==3) {
				?>
                <tr>
                    <td height="60">Q：</td>
                    <td align="left"><textarea id="title" name="title" rows="10" style="width:400px"><?=stripslashes($news['title'])?></textarea></td>
                </tr>
                <tr>
                    <td height="60">A：</td>
                    <td><textarea id="content" name="content" rows="10" style="width:400px"><?=stripslashes($news['content'])?></textarea></td>
                </tr>
                <?php
				}
				?>
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