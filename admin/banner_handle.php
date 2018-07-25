<?php
header("content-type:text/html;charset=utf-8");
require_once('set.php');

$main_str   = 'banner';
$table_name = Proj_Name.'_'.$main_str;	
$obj_image  = new files();	

$category = ($_GET['category'])?format_data($_GET['category'], 'int'):1;

$file_num = 1;
switch($category) {
	case 1:
		$cate_str = '首頁 Banner';
		$_width  = 1226;
		$_height = 697;
		$_width_s  = 1226*0.2;
		$_height_s = 697*0.2;
		break;
	case 2:
		$cate_str = 'Banner I';
		$_width  = 209;
		$_height = 107;
		$_width_s  = 209;
		$_height_s = 107;
		break;
	case 3:
		$cate_str = 'Banner II';
		$_width  = 288;
		$_height = 203;
		$_width_s  = 288*0.75;
		$_height_s = 185*0.75;
		break;
	case 4:
		$cate_str = 'Rescue Banner';
		$_width  = 543;
		$_height = 380;
		$_width_s  = 543*0.5;
		$_height_s = 380*0.5;
		break;
	case 5:
		$cate_str = 'Train Banner';
		$_width  = 543;
		$_height = 380;
		$_width_s  = 543*0.5;
		$_height_s = 380*0.5;
		break;
	case 6:
		$cate_str = 'Donate Banner';
		$_width  = 543;
		$_height = 380;
		$_width_s  = 543*0.5;
		$_height_s = 380*0.5;
		break;
}
if($_POST['action']=='save') {
	$lang     = $_SESSION[Login_System_User]['lang'];
	$Fullkey  = format_data($_POST['Fullkey'], 'int');
	$category = format_data($_POST['category'], 'text');
	$title    = format_data($_POST['title'], 'text');
	$content  = format_data($_POST['content'], 'text');
	$file1    = format_data($_POST['file1'], 'text');
	$style    = format_data($_POST['style'], 'text');
	$url_to   = format_data($_POST['url_to'], 'text');
	$sort     = format_data($_POST['sort'], 'int');
	
	if(!$Fullkey)
		$query = "insert into $table_name(lang, category, title, content, file1, style, url_to, sort, hit_counts, pub, create_time, edit_time) values('".$lang."', '".$category."', '".$title."', '".$content."', '".$file1."', '".$style."', '".$url_to."', '".$sort."', 0, 1, now(), now())";
	elseif($Fullkey)
		$query = "update $table_name set title='".$title."', content='".$content."', file1='".$file1."', style='".$style."', url_to='".$url_to."', sort='".$sort."', edit_time=now() where Fullkey='".$Fullkey."'";
	$obj_banner->run_mysql($query);
	
	if($obj_banner->result) {
		js_a_l('儲存成功', $main_str.'.php?category='.$category);exit;
	}else {
		js_a_l('儲存失敗，請重新輸入並檢查', 'back');exit;
	}
}elseif ($_GET['Fullkey']) {
	$Fullkey = format_data($_GET['Fullkey'], 'int');
	$query   = "select * from $table_name where Fullkey='".$Fullkey."'";
	$banner  = $obj_banner->run_mysql_out($query);
}
?><!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title><?=Html_Title?>後台管理系統</title>
<?php include("include_head.php"); ?>
<script type="text/javascript" src="../jqwidgets/jqxvalidator.js"></script> 
<!-- uploadify -->
<script type="text/javascript" src="../uploadify/jquery.uploadify-3.1.min.js"></script>
<link rel="stylesheet" type="text/css" href="../uploadify/uploadify.css" />
<script type="text/javascript">
$(document).ready(function () {
	//upload file
	<?php 
	for($i=1; $i<=$file_num; $i++) { 
		$obj_image->uploadify_js('file'.$i.'_upload', 'file'.$i, 'show_file'.$i, array("action", "main_str", "category", "Fullkey", "file_o", "key", "_width_s", "_height_s"), array("upload_banner", $main_str, $category, $banner["Fullkey"], "", $i, $_width_s, $_height_s));
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
		{ input: '#title', message: '請輸入標題', action: 'keyup, blur', rule: 'required' },
		{ input: '#file1', message: '請選擇圖片', action: 'keyup, blur', rule: 'required' },
		{ input: '#url_to', message: '請輸入連結網址，如沒有連結網址請輸入"#"', action: 'keyup, blur', rule: 'required' }], 
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
      <li class="left"><a href="banner.php?category=<?=$category?>"><?=$cate_str?></a></li>
      <li class="title"><?=$page_title?></li>
      <li class="right"><?php include('include_welcome.php'); ?></li>
   </ul>
   <div class="mainContent">
   	 <div id="data_content">
   		<form method="post" id="<?=$main_str?>_form" action="<?=$_SERVER['PHP_SELF']?>">
            <input type="hidden" name="action" value="save" />
            <input type="hidden" name="Fullkey" value="<?=$banner['Fullkey']?>" />
            <input type="hidden" name="category" value="<?=$category?>" />
            <table class="<?=$main_str?>-table">
                <tr>
                    <td width="120" height="60">標　　題：</td>
                    <td align="left"><input type="text" name="title" id="title" value="<?=$banner['title']?>" class="frome" style="width:400px" />(如需換行請用|符號)　<br><?php if($category==1){ ?><input type="radio" name="style" id="style1" value="1" <?php if($banner['style']==1){echo 'checked';} ?>>(Center)大字：白｜小字：白　<input type="radio" name="style" id="style2" value="2" <?php if($banner['style']==2){echo 'checked';} ?>>(Left)大字：綠｜小字：白　<input type="radio" name="style" id="style3" value="3" <?php if($banner['style']==3){echo 'checked';} ?>>(Left)大字：白｜小字：白<?php }else{ ?><input type="hidden" name="style" value="1"><?php }?></td>
                </tr>
                <?php if($category!=2 && $category!=3) { ?>
                <tr>
                    <td width="120" height="60">內文敘述：</td>
                    <td align="left"><input type="text" name="content" id="content" value="<?=$banner['content']?>" class="frome" style="width:400px" /></td>
                </tr>
                <?php }else{ ?>
                <tr>
                    <td width="120" height="60">內文敘述：</td>
                    <td align="left"><textarea name="content" id="content" class="frome" style="width:400px"><?=$banner['content']?></textarea></td>
                </tr>
                <?php } ?>
            	<?php for($i=1; $i<=$file_num; $i++) { ?>
                <?php if($i%2==1){echo '<tr>';} ?>
                    <td height="60">上傳圖片<?=$i?>：</td>
                    <td align="left"><?php $obj_image->show_pic1($main_str.'/'.$banner['file'.$i], $_width_s, $_height_s, $banner['title'], 'show_file'.$i) ?> <input type="button" class="delButton" value="刪除檔案" onClick="$('#show_file<?=$i?>').attr('src', '../images/space.png');$('#file<?=$i?>').val('')" /><br /><input type="text" name="file<?=$i?>" id="file<?=$i?>" value="<?=$banner['file'.$i]?>" class="frome" style="width:200px" readonly /><br /><input type="file" name="file<?=$i?>_upload" id="file<?=$i?>_upload" />(建議圖片尺寸: <?=$_width.'*'.$_height?>，檔案大小5mb)</td>
                <?php if($i%2==0){echo '</tr>';} ?>
                <?php } ?>
                <tr>
                    <td height="60">連結網址：</td>
                    <td align="left"><input type="text" name="url_to" id="url_to" value="<?=$banner['url_to']?>" class="frome" style="width:400px" />(如沒有連結網址請輸入"#")</td>
                </tr>
                <tr>
                    <td height="60">排序數字：</td>
                    <td align="left"><input type="text" name="sort" id="sort" value="<?=($banner['sort'])?$banner['sort']:0?>" class="frome" style="width:400px" /> (數字越大排序越前面)</td>
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