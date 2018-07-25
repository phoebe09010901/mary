<?php
header("content-type:text/html;charset=utf-8");
require_once('set.php');
require_once(Root_Includes_Path.'class_jqx.php');

$main_str   = 'album';
$table_name = Proj_Name.'_'.$main_str;	
$obj_jqx    = new jqx();
$obj_image  = new files();	
$category   = format_data($_GET['category'], 'int');
switch($category) {
	case 1:
		$cate_title = 'Adoption Photos';
		break;
	case 2:
		$cate_title = 'Monthly Meet Up Photos';
		break;
	case 3:
		$cate_title = 'Adopted Dogs Photos';
		break;
	case 4:
		$cate_title = 'Airport Pickup';
		break;
}

if($_POST['action']=='save') {
	$lang       = $_SESSION[Login_System_User]['lang'];
	$Fullkey    = format_data($_POST['Fullkey'], 'int');
	$category   = format_data($_POST['category'], 'int');
	$album_date = format_data($_POST['album_date'], 'text');
	$title      = format_data($_POST['title'], 'text');
	$content    = format_data($_POST['content'], 'content');
	$video_title1= format_data($_POST['video_title1'], 'text');
	$video_title2= format_data($_POST['video_title2'], 'text');
	$video_title3= format_data($_POST['video_title3'], 'text');
	$youtube1    = format_data($_POST['youtube1'], 'text');
	$youtube2    = format_data($_POST['youtube2'], 'text');
	$youtube3    = format_data($_POST['youtube3'], 'text');
	$other_video1= format_data($_POST['other_video1'], 'content');
	$other_video2= format_data($_POST['other_video2'], 'content');
	$other_video3= format_data($_POST['other_video3'], 'content');
	
	if(!$Fullkey)
		$query = "insert into $table_name(lang, category, album_date, title, content, video_title1, video_title2, video_title3, youtube1, youtube2, youtube3, other_video1, other_video2, other_video3, pub, create_time, edit_time) values('".$lang."', '".$category."', '".$album_date."', '".$title."', '".$content."', '".$video_title1."', '".$video_title2."', '".$video_title3."', '".$youtube1."', '".$youtube2."', '".$youtube3."', '".$other_video1."', '".$other_video2."', '".$other_video3."', '1', now(), now())";
	elseif($Fullkey)
		$query = "update $table_name set album_date='".$album_date."', title='".$title."', content='".$content."', video_title1='".$video_title1."', video_title2='".$video_title2."', video_title3='".$video_title3."', youtube1='".$youtube1."', youtube2='".$youtube2."', youtube3='".$youtube3."', other_video1='".$other_video1."', other_video2='".$other_video2."', other_video3='".$other_video3."', edit_time=now() where Fullkey='".$Fullkey."'";
	$obj_album->run_mysql($query);
	//開啟相簿資料夾
	if(!$Fullkey)
		$Fullkey = mysql_insert_id();
	if(!is_dir(Root_Path.$main_str.'_photos/'.$Fullkey)) {
		$obj_image->add_dir(Root_Path.$main_str.'_photos/'.$Fullkey);
	}
	
	if($obj_album->result) {
		js_a_l('儲存成功', $main_str.'.php?category='.$category);exit;
	}else {
		js_a_l('儲存失敗，請重新輸入並檢查', 'back');exit;
	}
}elseif ($_GET['Fullkey']) {
	$Fullkey = format_data($_GET['Fullkey'], 'int');
	$query   = "select * from $table_name where Fullkey='".$Fullkey."'";
	$album   = $obj_album->run_mysql_out($query);
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
<script type="text/javascript">
$(document).ready(function () {
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
	<?php $obj_jqx->datepicker('album_date', $album['album_date']); ?>
	// initialize validator.
	$('#<?=$main_str?>_form').jqxValidator({
		rules: [
		{ input: '#title', message: '請輸入相簿標題', action: 'keyup, blur', rule: 'required' }], 
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
      <a href="index.php"><li class="left">首頁</li></a>
      <a href="album.php?category=<?=$category?>"><li class="title"><?=$page_title?></li></a>
      <li class="right"><?php include('include_welcome.php'); ?></li>
   </ul>
   <div class="mainContent">
   	 <div id="data_content">
   		<form method="post" id="<?=$main_str?>_form" action="<?=$_SERVER['PHP_SELF']?>">
            <input type="hidden" name="action" value="save" />
            <input type="hidden" name="Fullkey" value="<?=$album['Fullkey']?>" />
            <input type="hidden" name="category" value="<?=$category?>" />
            <table class="<?=$main_str?>-table">
                <tr>
                    <td width="120" height="60">相簿日期：</td>
                    <td align="left"><div id="album_date" style="width:400px"></div></td>
                </tr>
                <tr>
                    <td height="60">標　　題：</td>
                    <td align="left"><input type="text" name="title" id="title" value="<?=$album['title']?>" class="frome" style="width:400px" /></td>
                </tr>
                <?php if($category==4){ ?>
                <tr>
                    <td height="60">影片標題：</td>
                    <td colspan="3"><input type="text" name="video_title1" id="video_title1" value="<?=$album['video_title1']?>" class="frome" style="width:400px" /></td>
                </tr>
                <tr>
                    <td height="60">Youtube：</td>
                    <td colspan="3"><input type="text" name="youtube1" id="youtube1" value="<?=$album['youtube1']?>" class="frome" style="width:400px" />(請輸入影片分享短連結)</td>
                </tr>
                <tr>
                    <td height="60">其他影片:</td>
                  <td align="left" colspan="4">影片尺寸：width="223" height="125"<br><textarea name="other_video1" id="other_video1" class="frome" style="width:100%; height:150px"><?=stripslashes($album['other_video1'])?></textarea>(請自行調整影片iframe崁入語法)</td>
                </tr>
                <tr>
                    <td height="60">影片標題2：</td>
                    <td colspan="3"><input type="text" name="video_title2" id="video_title2" value="<?=$album['video_title2']?>" class="frome" style="width:400px" /></td>
                </tr>
                <tr>
                    <td height="60">Youtube2：</td>
                    <td colspan="3"><input type="text" name="youtube2" id="youtube2" value="<?=$album['youtube2']?>" class="frome" style="width:400px" />(請輸入影片分享短連結)</td>
                </tr>
                <tr>
                    <td height="60">其他影片2:</td>
                  <td align="left" colspan="4">影片尺寸：width="223" height="125"<br>
                  <textarea name="other_video2" id="other_video2" class="frome" style="width:100%; height:150px"><?=stripslashes($album['other_video2'])?></textarea>(請自行調整影片iframe崁入語法)</td>
                </tr>
                <tr>
                    <td height="60">影片標題3：</td>
                    <td colspan="3"><input type="text" name="video_title3" id="video_title3" value="<?=$album['video_title3']?>" class="frome" style="width:400px" /></td>
                </tr>
                <tr>
                    <td height="60">Youtube2：</td>
                    <td colspan="3"><input type="text" name="youtube3" id="youtube3" value="<?=$album['youtube3']?>" class="frome" style="width:400px" />(請輸入影片分享短連結)</td>
                </tr>
                <tr>
                    <td height="60">其他影片3:</td>
                  <td align="left" colspan="4">影片尺寸：width="223" height="125"<br>
                  <textarea name="other_video3" id="other_video3" class="frome" style="width:100%; height:150px"><?=stripslashes($album['other_video3'])?></textarea>(請自行調整影片iframe崁入語法)</td>
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