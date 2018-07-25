<?php
header("content-type:text/html;charset=utf-8");
require_once('set.php');
require_once(Root_Includes_Path.'class_jqx.php');

$main_str   = 'video';
$table_name = Proj_Name.'_'.$main_str;	
$obj_jqx    = new jqx();
$obj_image  = new files();	

$category = format_data($_REQUEST['category'], 'int');
$file_num = 0;
$_width  = 146;
$_height = 75;
$_width_s  = 146;
$_height_s = 75;

if($_POST['action']=='save') {
	$lang        = $_SESSION[Login_System_User]['lang'];
	$Fullkey     = format_data($_POST['Fullkey'], 'int');
	$category    = format_data($_POST['category'], 'int');
	$news_date   = format_data($_POST['news_date'], 'text');
	$title       = format_data($_POST['title'], 'text');
	$youtube     = format_data($_POST['youtube'], 'text');
	$other_video = format_data($_POST['other_video'], 'content');
	$file1       = format_data($_POST['file1'], 'text');
	$content     = format_data($_POST['content'], 'content');
	$sort        = format_data($_POST['sort'], 'int');
	
	if(!$Fullkey)
		$query = "insert into $table_name(lang, category, news_date, title, youtube, other_video, file1, content, sort, pub, create_time, edit_time) values('".$lang."', '".$category."', '".$news_date."', '".$title."', '".$youtube."', '".$other_video."', '".$file1."', '".$content."', '".$sort."', '1', now(), now())";
	elseif($Fullkey)
		$query = "update $table_name set news_date='".$news_date."', title='".$title."', youtube='".$youtube."', other_video='".$other_video."', file1='".$file1."', content='".$content."', sort='".$sort."', edit_time=now() where Fullkey='".$Fullkey."'";
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

$query = "select Fullkey, name, prev, lv from ".$table_name."_category where Fullkey='".$category."'";
$pc = $obj_cate1->run_mysql_out($query);
$cate_title = "<a href=".$main_str.".php?category=".$pc['Fullkey']."><li class='left'>".$pc['name']."</li></a>".$cate_title;
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
	$( '#content' ).ckeditor();
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
      <a href="index.php"><li class="left">首頁</li></a><a href="video.php?category=<?=$category?>"><?=$cate_title?></a>
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
                    <td width="120" height="60">影片日期：</td>
                    <td align="left"><div id="news_date" style="width:400px"></div></td>
                </tr>
                <tr>
                    <td height="60">標　　題：</td>
                    <td align="left"><input type="text" name="title" id="title" value="<?=$news['title']?>" class="frome" style="width:400px" /></td>
                </tr>
                <tr>
                    <td height="60">Youtube：</td>
                    <td align="left"><input type="text" name="youtube" id="youtube" value="<?=$news['youtube']?>" class="frome" style="width:400px" />(請輸入影片分享短連結)</td>
                </tr>
                <tr>
                    <td height="60">其他影片:</td>
                  <td align="left" colspan="4"><textarea name="other_video" id="other_video" class="frome" style="width:100%; height:150px"><?=stripslashes($news['other_video'])?></textarea>(請自行調整影片iframe崁入語法)</td>
                </tr>
                <tr>
                    <td height="60">排　　序：</td>
                    <td align="left"><input type="text" name="sort" id="sort" value="<?=($news['sort'])?$news['sort']:0?>" class="frome" style="width:400px" /> (數字越大排序越前面)</td>
                </tr>
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