<?php
header("content-type:text/html;charset=utf-8");
require_once('set.php');

$main_str   = 'dogs';
$table_name = Proj_Name.'_'.$main_str;	

$dog_id = format_data($_REQUEST['dog_id'], 'int');
if(!$dog_id) {
	js_a_l("請選擇一隻小狗", "dogs.php?search_type=pub1&category=1");exit;	
}

if($_POST['action']=='save') {
	$Fullkey = format_data($_POST['Fullkey'], 'int');
	$dog_id  = format_data($_POST['dog_id'], 'int');
	$q1      = format_data($_POST['q1'], 'int');
	$q2      = format_data($_POST['q2'], 'int');
	$q3      = format_data($_POST['q3'], 'int');
	$q3_1    = format_data($_POST['q3_1'], 'int');
	$q3_2    = format_data($_POST['q3_2'], 'int');
	$q3_3    = format_data($_POST['q3_3'], 'int');
	$q4      = format_data($_POST['q4'], 'int');
	$q5      = format_data($_POST['q5'], 'int');
	$q6      = format_data($_POST['q6'], 'int');
	$q7      = format_data($_POST['q7'], 'int');
	$q8      = format_data($_POST['q8'], 'int');
	$q9      = format_data($_POST['q9'], 'int');
	$q10     = format_data($_POST['q10'], 'int');
	$q11     = format_data($_POST['q11'], 'int');
	$q11_1   = format_data($_POST['q11_1'], 'int');
	$q11_2   = format_data($_POST['q11_2'], 'int');
	$q11_3   = format_data($_POST['q11_3'], 'int');
	$q12     = format_data($_POST['q12'], 'int');
	$q13     = format_data($_POST['q13'], 'int');
	$q14     = format_data($_POST['q14'], 'int');
	$q15     = format_data($_POST['q15'], 'int');
	$q15_1   = format_data($_POST['q15_1'], 'int');
	$q15_2   = format_data($_POST['q15_2'], 'int');
	$q15_3   = format_data($_POST['q15_3'], 'int');
	$q15_4   = format_data($_POST['q15_4'], 'int');
	$remark  = format_data($_POST['remark'], 'text');
	
	if(!$Fullkey)
		$query = "insert into ".$table_name."_form1(dog_id, q1, q2, q3, q3_1, q3_2, q3_3, q4, q5, q6, q7, q8, q9, q10, q11, q11_1, q11_2, q11_3, q12, q13, q14, q15, q15_1, q15_2, q15_3, q15_4, remark, create_time, edit_time) values('".$dog_id."', '".$q1."', '".$q2."', '".$q3."', '".$q3_1."', '".$q3_2."', '".$q3_3."', '".$q4."', '".$q5."', '".$q6."', '".$q7."', '".$q8."', '".$q9."', '".$q10."', '".$q11."', '".$q11_1."', '".$q11_2."', '".$q11_3."', '".$q12."', '".$q13."', '".$q14."', '".$q15."', '".$q15_1."', '".$q15_2."', '".$q15_3."', '".$q15_4."', '".$remark."', now(), now())";
	elseif($Fullkey)
		$query = "update ".$table_name."_form1 set dog_id='".$dog_id."', q1='".$q1."', q2='".$q2."', q3='".$q3."', q3_1='".$q3_1."', q3_2='".$q3_2."', q3_3='".$q3_3."', q4='".$q4."', q5='".$q5."', q6='".$q6."', q7='".$q7."', q8='".$q8."', q9='".$q9."', q10='".$q10."', q11='".$q11."', q11_1='".$q11_1."', q11_2='".$q11_2."', q11_3='".$q11_3."', q12='".$q12."', q13='".$q13."', q14='".$q14."', q15='".$q15."', q15_1='".$q15_1."', q15_2='".$q15_2."', q15_3='".$q15_3."', q15_4='".$q15_4."', remark='".$remark."', edit_time=now() where Fullkey='".$Fullkey."'";
	$obj_dogs->run_mysql($query);
	
	if($obj_dogs->result) {
		js_a_l("儲存成功", $main_str."_form1.php?dog_id=".$dog_id);exit;
	}else {
		js_a_l("儲存失敗，請重新輸入並檢查", "back");exit;
	}
}elseif ($dog_id) {
	$query   = "select * from ".$table_name." where Fullkey='".$dog_id."'";
	$dogs    = $obj_dogs->run_mysql_out($query);
	$query   = "select * from ".$table_name."_form1 where dog_id='".$dog_id."'";
	$form    = $obj_dogs->run_mysql_out($query);
}
?><!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title><?=Html_Title?>後台管理系統</title>
<?php include("include_head.php"); ?>
<script type="text/javascript" src="../jqwidgets/jqxvalidator.js"></script> 
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
      <li class="title">Dog's Temperament Information</li>
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
                    <td width="150" height="60" bgcolor="#F6F6F6">Energy level:</td>
                  	<td align="left"><input type="radio" name="q1" id="q1_1" value="1" <?php if($form['q1']==1){echo 'checked';} ?>>Low　<input type="radio" name="q1" id="q1_2" value="2" <?php if(!isset($form['q1']) || $form['q1']==2){echo 'checked';} ?>>Medium　<input type="radio" name="q1" id="q1_3" value="3" <?php if($form['q1']==3){echo 'checked';} ?>>High</td>
                    <td height="60" bgcolor="#F6F6F6">Good on leash:</td>
                  	<td align="left"><input type="radio" name="q8" id="q8_1" value="1" <?php if(!isset($form['q8']) || $form['q8']==1){echo 'checked';} ?>>Yes　<input type="radio" name="q8" id="q8_2" value="2" <?php if($form['q8']==2){echo 'checked';} ?>>No</td>
                </tr>
                <tr>
                  <td height="60" bgcolor="#F6F6F6">Ideal home environment:</td>
                  <td align="left"><input type="radio" name="q2" id="q2_1" value="1" <?php if($form['q2']==1){echo 'checked';} ?>>Active　<input type="radio" name="q2" id="q2_2" value="2" <?php if($form['q2']==2){echo 'checked';} ?>>Quiet　<input type="radio" name="q2" id="q2_3" value="3" <?php if(!isset($form['q2']) || $form['q2']==3){echo 'checked';} ?>>Both</td>
                  <td width="120" height="60" bgcolor="#F6F6F6">House-trained:</td>
                  <td align="left"><input type="radio" name="q9" id="q9_1" value="1" <?php if(!isset($form['q9']) || $form['q9']==1){echo 'checked';} ?>>Yes　<input type="radio" name="q9" id="q9_2" value="2" <?php if($form['q9']==2){echo 'checked';} ?>>No</td>
                </tr>
                <tr>
                    <td width="150" height="60" bgcolor="#F6F6F6">Is the dog good with strangers:</td>
                    <td align="left"><input type="checkbox" name="q3_1" id="q3_1" value="1" <?php if(!$form['q3_1'] || !isset($form['q3_1']) || $form['q3_1']==1){echo 'checked';} ?>>Friendly　<input type="checkbox" name="q3_2" id="q3_2" value="1" <?php if($form['q3_2']==1){echo 'checked';} ?>>Shy　<input type="checkbox" name="q3_3" id="q3_3" value="1" <?php if($form['q3_3']==1){echo 'checked';} ?>>Aggressive</td>
                    <td height="60" bgcolor="#F6F6F6">Crate-trained:</td>
                  	<td align="left"><input type="radio" name="q10" id="q10_1" value="1" <?php if(!isset($form['q10']) || $form['q10']==1){echo 'checked';} ?>>Yes　<input type="radio" name="q10" id="q10_2" value="2" <?php if($form['q10']==2){echo 'checked';} ?>>No</td>
                </tr>
                <tr>
                  <td height="60" bgcolor="#F6F6F6">The dog is best with children of<br>what age group:</td>
                  <td align="left"><input type="radio" name="q4" id="q4_1" value="1" <?php if(!isset($form['q4']) || $form['q4']==1){echo 'checked';} ?>>Any ages　<input type="radio" name="q4" id="q4_2" value="2" <?php if($form['q4']==2){echo 'checked';} ?>>under 5 years old　<input type="radio" name="q4" id="q4_3" value="3" <?php if($form['q4']==3){echo 'checked';} ?>>over 5 years old<br><input type="radio" name="q4" id="q4_4" value="4" <?php if($form['q4']==4){echo 'checked';} ?>>over 10 years old　<input type="radio" name="q4" id="q4_5" value="5" <?php if($form['q4']==5){echo 'checked';} ?>>over 15 years old</td>
                  <td width="120" height="60" bgcolor="#F6F6F6">How is the dog with men:</td>
                  <td align="left"><input type="checkbox" name="q11_1" id="q11_1" value="1" <?php if(!$form['q11_1'] || !isset($form['q11_1']) || $form['q11_1']==1){echo 'checked';} ?>>Friendly　<input type="checkbox" name="q11_2" id="q11_2" value="1" <?php if($form['q11_2']==1){echo 'checked';} ?>>Shy　<input type="checkbox" name="q11_3" id="q11_3" value="1" <?php if($form['q11_3']==1){echo 'checked';} ?>>Aggressive</td>
                </tr>
                <tr>
                    <td width="150" height="60" bgcolor="#F6F6F6">Is the dog good with other dogs(Small):</td>
                  	<td align="left"><input type="radio" name="q5" id="q5_1" value="1" <?php if(!isset($form['q5']) || $form['q5']==1){echo 'checked';} ?>>Yes　<input type="radio" name="q5" id="q5_2" value="2" <?php if($form['q5']==2){echo 'checked';} ?>>No</td>
                    <td height="60" bgcolor="#F6F6F6">Food aggression with people:</td>
                  	<td align="left"><input type="radio" name="q12" id="q12_1" value="1" <?php if($form['q12']==1){echo 'checked';} ?>>Yes　<input type="radio" name="q12" id="q12_2" value="2" <?php if(!isset($form['q12']) || $form['q12']==2){echo 'checked';} ?>>No</td>
                </tr>
                <tr>
                  <td height="60" bgcolor="#F6F6F6">Is the dog good with other dogs(Big):</td>
                  <td align="left"><input type="radio" name="q6" id="q6_1" value="1" <?php if(!isset($form['q6']) || $form['q6']==1){echo 'checked';} ?>>Yes　<input type="radio" name="q6" id="q6_2" value="2" <?php if($form['q6']==2){echo 'checked';} ?>>No</td>
                  <td width="120" height="60" bgcolor="#F6F6F6">Food aggression with dogs:</td>
                  <td align="left"><input type="radio" name="q13" id="q13_1" value="1" <?php if($form['q13']==1){echo 'checked';} ?>>Yes　<input type="radio" name="q13" id="q13_2" value="2" <?php if(!isset($form['q13']) || $form['q13']==2){echo 'checked';} ?>>No</td>
                </tr>
                <tr>
                    <td width="150" height="60" bgcolor="#F6F6F6">Is the dog good with cats:</td>
                    <td align="left"><input type="radio" name="q7" id="q7_1" value="1" <?php if(!isset($form['q7']) || $form['q7']==1){echo 'checked';} ?>>Yes　<input type="radio" name="q7" id="q7_2" value="2" <?php if($form['q7']==2){echo 'checked';} ?>>No</td>
                    <td height="60" bgcolor="#F6F6F6">Has the dog ever bitten anyone:</td>
                  	<td align="left"><input type="radio" name="q14" id="q14_1" value="1" <?php if($form['q14']==1){echo 'checked';} ?>>Yes　<input type="radio" name="q14" id="q14_2" value="2" <?php if(!isset($form['q14']) || $form['q14']==2){echo 'checked';} ?>>No</td>
                </tr>
                <tr>
                    <td width="150" height="60" bgcolor="#F6F6F6">Were the dog’s puppies, siblings,<br>canine mother, canine father rescued:</td>
                  <td align="left"><input type="checkbox" name="q15_1" id="q15_1" value="1" <?php if($form['q15_1']==1){echo 'checked';} ?>>Puppies　<input type="checkbox" name="q15_2" id="q15_2" value="1" <?php if($form['q15_2']==1){echo 'checked';} ?>>Siblings　<input type="checkbox" name="q15_3" id="q15_3" value="1" <?php if($form['q15_3']==1){echo 'checked';} ?>>Mother　<input type="checkbox" name="q15_4" id="q15_4" value="1" <?php if($form['q15_4']==1){echo 'checked';} ?>>Father</td>
                    <td height="60">&nbsp;</td>
                    <td align="left">&nbsp;</td>
                </tr>
                <tr>
                    <td height="60" bgcolor="#F6F6F6">Note:</td>
                  <td align="left" colspan="4"><textarea name="remark" id="remark" class="frome" style="width:100%; height:75px"><?=$form['remark']?></textarea></td>
                </tr>
                <tr>
                    <td colspan="4" style="text-align: center;">
                    <button type="button" id="sendButton" class="editbtn enter" title="儲存" >儲 存</button>&nbsp;&nbsp;&nbsp;
                    <button class="editbtn enter" onclick="location.href='dogs_form2.php?dog_id=<?php echo $_GET['dog_id'];?>'" type="button">前往表單2</button>
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