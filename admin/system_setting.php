<?php
header("content-type:text/html;charset=utf-8");
require_once('set.php');
require_once(Root_Includes_Path.'class_jqx.php');

$main_str   = 'system_set';
$table_name = Proj_Name.'_'.$main_str;	
$obj_jqx    = new jqx();

if($_POST['action']=='save') {
	$lang                     = $_SESSION[Login_System_User]['lang'];
	$Fullkey                  = format_data($_POST['Fullkey'], 'int');
	$products_category_lv_num = format_data($_POST['products_category_lv_num'], 'int');
	$jqxStyle                 = format_data($_POST['jqxStyle'], 'int');
	
	$url_to = 'back';
	
	if(!$Fullkey)
		$query = "insert into $table_name(lang, products_category_lv_num, jqxStyle, edit_time) values('".$lang."', '".$products_category_lv_num."', '".$jqxStyle."', now())";
	elseif($Fullkey)
		$query = "update $table_name set products_category_lv_num='".$products_category_lv_num."', jqxStyle='".$jqxStyle."', edit_time=now() where Fullkey='".$Fullkey."'";
	$obj_system->run_mysql($query);
	
	if($obj_system->result) {
		js_a_l('儲存成功', 'system_setting.php');exit;
	}else {
		js_a_l('儲存失敗，請重新輸入並檢查', 'back');exit;
	}
}
//get data
$query  = "select * from $table_name where lang='".$_SESSION[Login_System_User]['lang']."'";
$system = $obj_system->run_mysql_out($query);
?><!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title><?=Html_Title?>後台管理系統</title>
<?php include("include_head.php"); ?>
<script type="text/javascript" src="../jqwidgets/jqxvalidator.js"></script> 
<!-- listbox -->
<script type="text/javascript" src="../jqwidgets/jqxlistbox.js"></script>
<script type="text/javascript" src="../jqwidgets/jqxdata.js"></script>
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
	// initialize validator.
	$('#<?=$main_str?>_form').jqxValidator({
		rules: []
	});
});
</script>
</head>
<body>
<div class="background"><img src="images/bg.jpg"></div>
<div class="controller">
   <a href="#top"><div class="top btn">x</div></a>
   <div class="close btn">y</div>
   <div class="open btn">z</div>
</div>
<div id="top" class="topper"></div>
<div class="admin-panel">
  <?php include("include_menu.php"); ?><!--slidebar end-->
   <div class="main set_page_h page_shadow">
   <ul class="topbar">
      <a href="index.php"><li class="left">首頁</li></a>
      <li class="title"><?=$page_title?></li>
      <li class="right"><?php include('include_welcome.php'); ?></li>
   </ul>
   <div class="mainContent">
   	 <div id="data_content">
     <form method="post" id="<?=$main_str?>_form" action="<?=$_SERVER['PHP_SELF']?>">
            <input type="hidden" name="action" value="save" />
            <input type="hidden" name="Fullkey" value="<?=$system['Fullkey']?>" />
            <table class="<?=$main_str?>-table">
                <tr>
                    <td width="120" height="60">商品類別階層：</td>
                    <td align="left"><input type="text" name="products_category_lv_num" id="products_category_lv_num" value="<?=$system['products_category_lv_num']?>" class="frome" style="width:250px"></td>
                    <td>jqx Style</td>
                    <td align="left"><input type="text" name="jqxStyle" id="jqxStyle" value="<?=$system['jqxStyle']?>" class="frome" style="width:250px"></td>
                </tr>
                <tr>
                    <td colspan="4" style="text-align: center;"><button type="button" id="sendButton" class="editbtn enter" title="儲存" >儲 存</button></td>
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