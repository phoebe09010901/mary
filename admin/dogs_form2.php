<?php
header("content-type:text/html;charset=utf-8");
require_once('set.php');
require_once(Root_Includes_Path.'class_jqx.php');

$main_str   = 'dogs';
$table_name = Proj_Name.'_'.$main_str;	
$obj_jqx    = new jqx();

$dog_id = format_data($_REQUEST['dog_id'], 'int');
if(!$dog_id) {
	js_a_l("請選擇一隻小狗", "dogs.php?search_type=pub1&category=1");exit;	
}

if($_POST['action']=='save') {
	$Fullkey = format_data($_POST['Fullkey'], 'int');
	$dog_id  = format_data($_POST['dog_id'], 'int');
	$q1      = format_data($_POST['q1'], 'text');
	$q2      = format_data($_POST['q2'], 'text');
	$q3      = format_data($_POST['q3'], 'text');
	$q4      = format_data($_POST['q4'], 'text');
	$q5      = format_data($_POST['q5'], 'int');
	$q6      = format_data($_POST['q6'], 'text');
	$q7      = format_data($_POST['q7'], 'int');
	$q8      = format_data($_POST['q8'], 'text');
	$q9      = format_data($_POST['q9'], 'text');
	$q10     = format_data($_POST['q10'], 'int');
	$q11     = format_data($_POST['q11'], 'text');
	$q12     = format_data($_POST['q12'], 'text');
	$q13     = format_data($_POST['q13'], 'text');
	$q14     = format_data($_POST['q14'], 'text');
	$remark  = format_data($_POST['remark'], 'text');
	if($_POST['q1Null']==1){ $q1 = ''; }
	if($_POST['q2Null']==1){ $q2 = ''; }
	if($_POST['q3Null']==1){ $q3 = ''; }
	if($_POST['q4Null']==1){ $q4 = ''; }
	if($_POST['q6Null']==1){ $q6 = ''; }
	if($_POST['q8Null']==1){ $q8 = ''; }
	if($_POST['q9Null']==1){ $q9 = ''; }
	if($_POST['q12Null']==1){ $q12 = ''; }
	if($_POST['q13Null']==1){ $q13 = ''; }
	if($_POST['q14Null']==1){ $q14 = ''; }
	
	if(!$Fullkey)
		$query = "insert into ".$table_name."_form2(dog_id, q1, q2, q3, q4, q5, q6, q7, q8, q9, q10, q11, q12, q13, q14, remark, create_time, edit_time) values('".$dog_id."', '".$q1."', '".$q2."', '".$q3."', '".$q4."', '".$q5."', '".$q6."', '".$q7."', '".$q8."', '".$q9."', '".$q10."', '".$q11."', '".$q12."', '".$q13."', '".$q14."', '".$remark."', now(), now())";
	elseif($Fullkey)
		$query = "update ".$table_name."_form2 set dog_id='".$dog_id."', q1='".$q1."', q2='".$q2."', q3='".$q3."', q4='".$q4."', q5='".$q5."', q6='".$q6."', q7='".$q7."', q8='".$q8."', q9='".$q9."', q10='".$q10."', q11='".$q11."', q12='".$q12."', q13='".$q13."', q14='".$q14."', remark='".$remark."', edit_time=now() where Fullkey='".$Fullkey."'";
	$obj_dogs->run_mysql($query);
	
	if($obj_dogs->result) {
		js_a_l("儲存成功", $main_str."_form2.php?dog_id=".$dog_id);exit;
	}else {
		js_a_l("儲存失敗，請重新輸入並檢查", "back");exit;
	}
}elseif ($dog_id) {
	$query   = "select * from ".$table_name." where Fullkey='".$dog_id."'";
	$dogs    = $obj_dogs->run_mysql_out($query);
	$query   = "select * from ".$table_name."_form2 where dog_id='".$dog_id."'";
	$form    = $obj_dogs->run_mysql_out($query);
}
?><!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title><?=Html_Title?>後台管理系統</title>
<?php include("include_head.php"); ?>
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
	<?php $obj_jqx->datepicker('q1', ($form['q1'])?$form['q1']:date("Y-m-01")); ?>
	<?php $obj_jqx->datepicker('q2', ($form['q2'])?$form['q2']:date("Y-m-01")); ?>
	<?php $obj_jqx->datepicker('q3', ($form['q3'])?$form['q3']:date("Y-m-01")); ?>
	<?php $obj_jqx->datepicker('q4', $form['q4']); ?>
	<?php $obj_jqx->datepicker('q6', $form['q6']); ?>
	<?php $obj_jqx->datepicker('q8', $form['q8']); ?>
	<?php $obj_jqx->datepicker('q9', $form['q9']); ?>
	<?php $obj_jqx->datepicker('q12', $form['q12']); ?>
	<?php $obj_jqx->datepicker('q13', $form['q13']); ?>
	<?php $obj_jqx->datepicker('q14', $form['q14']); ?>
	// initialize validator.
	$('#<?=$main_str?>_form').jqxValidator({
		rules: [], 
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
      <a href="dogs.php"><li class="left">Dog&apos;s List</li></a>
      <a href="dogs_handle.php?Fullkey=<?=$dogs['Fullkey']?>"><li class="left"><?=$dogs['name']?></li></a>
      <li class="title">Medical</li>
      <li class="right"><?php include('include_welcome.php'); ?></li>
   </ul>
   <div class="mainContent">
   	 <div id="data_content">
        <div class="template_black">
   		<form method="post" id="<?=$main_str?>_form" action="<?=$_SERVER['PHP_SELF']?>">
            <input type="hidden" name="action" value="save" />
            <input type="hidden" name="Fullkey" value="<?=$form['Fullkey']?>" />
            <input type="hidden" name="dog_id" value="<?=$dogs['Fullkey']?>" />
            <table class="<?=$main_str?>-table">
              <tbody>  
                <tr>
                    <td width="150" height="60" bgcolor="#F6F6F6">Vaccination date1:</td>
                  	<td align="left"><div id="q1" style="width:400px"></div><br><input type="checkbox" name="q1Null" id="q1Null" value="1" <?php if(!$form['q1']){echo 'checked';} ?>>尚無記錄</td>
                    <td height="60" bgcolor="#F6F6F6">Giardia Test Result:</td>
                  	<td align="left"><input type="radio" name="q10" id="q10_1" value="1" <?php if(!isset($form['q10']) || $form['q10']==1){echo 'checked';} ?>>Negative　<input type="radio" name="q10" id="q10_2" value="2" <?php if($form['q10']==2){echo 'checked';} ?>>Positive</td>
                </tr>
                <tr>
                  <td height="60" bgcolor="#F6F6F6">Vaccination date2:</td>
                  <td align="left"><div id="q2" style="width:400px"></div><br><input type="checkbox" name="q2Null" id="q2Null" value="1" <?php if(!$form['q2']){echo 'checked';} ?>>尚無記錄</td>
                  <td width="120" height="60" bgcolor="#F6F6F6">How long has it been on medication if tested<br />positive for Giardia:</td>
                  <td align="left"><input type="text" name="q11" id="q11" value="<?=$form['q11']?>" style="width:250px;"></td>
                </tr>
                <tr>
                    <td width="150" height="60" bgcolor="#F6F6F6">Vaccination date3:</td>
                  	<td align="left"><div id="q3" style="width:400px"></div><br><input type="checkbox" name="q3Null" id="q3Null" value="1" <?php if(!$form['q3']){echo 'checked';} ?>>尚無記錄</td>
                    <td height="60" bgcolor="#F6F6F6">Deworming Date:</td>
                  	<td align="left"><div id="q12" style="width:400px"></div><br><input type="checkbox" name="q12Null" id="q12Null" value="1" <?php if(!$form['q12']){echo 'checked';} ?>>尚無記錄</td>
                </tr>
                <tr>
                  <td height="60" bgcolor="#F6F6F6">Rabies vaccination date:</td>
                  <td align="left"><div id="q4" style="width:400px"></div><br><input type="checkbox" name="q4Null" id="q4Null" value="1" <?php if(!$form['q4']){echo 'checked';} ?>>尚無記錄</td>
                  <td width="120" height="60" bgcolor="#F6F6F6">Heartworm Preventative:</td>
                  <td align="left"><div id="q13" style="width:400px"></div><br><input type="checkbox" name="q13Null" id="q13Null" value="1" <?php if(!$form['q13']){echo 'checked';} ?>>尚無記錄</td>
                </tr>
                <tr>
                    <td width="150" height="60" bgcolor="#F6F6F6">Idexx 4-1 Kit Test Result:</td>
                  	<td align="left"><input type="radio" name="q5" id="q5_1" value="1" <?php if(!isset($form['q5']) || $form['q5']==1){echo 'checked';} ?>>Negative　<input type="radio" name="q5" id="q5_2" value="2" <?php if($form['q5']==2){echo 'checked';} ?>>Positive</td>
                    <td height="60" bgcolor="#F6F6F6">Frontline Date:</td>
                  	<td align="left"><div id="q14" style="width:400px"></div><br><input type="checkbox" name="q14Null" id="q14Null" value="1" <?php if(!$form['q14']){echo 'checked';} ?>>尚無記錄</td>
                </tr>
                <tr>
                  <td height="60" bgcolor="#F6F6F6">Date:</td>
                  <td align="left"><div id="q6" style="width:400px"></div><br><input type="checkbox" name="q6Null" id="q6Null" value="1" <?php if(!$form['q6']){echo 'checked';} ?>>尚無記錄</td>
                  <td height="60" bgcolor="#F6F6F6">&nbsp;</td>
                  <td align="left">&nbsp;</td>
                </tr>
                <tr>
                    <td width="150" height="60" bgcolor="#F6F6F6">Heartworm Result:</td>
                  <td align="left"><input type="radio" name="q7" id="q7_1" value="1" <?php if(!isset($form['q7']) || $form['q7']==1){echo 'checked';} ?>>Negative　<input type="radio" name="q7" id="q7_2" value="2" <?php if($form['q7']==2){echo 'checked';} ?>>Positive</td>
                    <td height="60" bgcolor="#F6F6F6">&nbsp;</td>
                  <td align="left">&nbsp;</td>
                </tr>
                <tr>
                  <td height="60" bgcolor="#F6F6F6">Date:</td>
                  <td align="left"><div id="q8" style="width:400px"></div><br><input type="checkbox" name="q8Null" id="q8Null" value="1" <?php if(!$form['q8']){echo 'checked';} ?>>尚無記錄</td>
                  <td height="60" bgcolor="#F6F6F6">&nbsp;</td>
                  <td align="left">&nbsp;</td>
                </tr>
                <tr>
                    <td width="150" height="60" bgcolor="#F6F6F6">Treatment Date:</td>
                    <td align="left"><div id="q9" style="width:400px"></div><br><input type="checkbox" name="q9Null" id="q9Null" value="1" <?php if(!$form['q9']){echo 'checked';} ?>>尚無記錄</td>
                    <td height="60" bgcolor="#F6F6F6">&nbsp;</td>
                  <td align="left">&nbsp;</td>
                </tr>
                <tr>
                    <td height="60" bgcolor="#F6F6F6">Note:</td>
                  <td align="left" colspan="4"><textarea name="remark" id="remark" class="frome" style="width:100%; height:75px"><?=$form['remark']?></textarea></td>
                </tr>
                <tr>
                    <td colspan="4" style="text-align: center;">
                    <button type="button" id="sendButton" class="editbtn enter" title="儲存" >儲 存</button>&nbsp;&nbsp;
                    <button class="editbtn enter" onclick="location.href='dogs_form1.php?dog_id=<?php echo $_GET['dog_id'];?>'" type="button">前往表單1</button>
                    </td>
                </tr>
              </tbody>
            </table>
            </form>
        </div>
     </div><!--content end-->
   </div><!--mainContent end-->
   <?php include("include_footer.php"); ?>
  </div><!--main end-->
</div><!--admin-panel end-->
</body>
</html>