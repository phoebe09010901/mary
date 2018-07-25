<?php
header("content-type:text/html;charset=utf-8");
require_once('set.php');

$main_str   = 'admin';
$table_name = Proj_Name.'_'.$main_str;	

if($_POST['action']=='save') {
	$Fullkey          = format_data($_POST['Fullkey'], 'int');
	$id               = format_data($_POST['id'], 'text');
	$password_confirm = format_data($_POST['password_confirm'], 'text');
	$password         = format_data($_POST['password'], 'text');
	$password_check   = format_data($_POST['password_check'], 'text');
	$name             = format_data($_POST['name'], 'text');
	$lv               = format_data($_POST['lv'], 'text');
	$password_confirm = md5($password_confirm);
	
	if(!$_POST['Fullkey'])
		$url_to = $main_str.'_handle.php?id='.$id.'&name='.$name.'&lv='.$lv.'';
	else
		$url_to = 'back';
	//檢查帳號是否重複
	if(!$_POST['Fullkey']) {
		$query  = "select id from $table_name where id='".$id."'";
		$obj_admin->run_mysql_list($query);
		if($obj_admin->obj_all!=0) {
			js_a_l('資料錯誤: 此帳號已經被註冊過了', $url_to);exit;
		}
	}
	//檢查密碼是否輸入正確
	if($_POST['Fullkey']) {
		$query = "select Fullkey from $table_name where id='".$id."' and password='".$password_confirm."'";
		$obj_admin->run_mysql_list($query);
		if($obj_admin->obj_all==0) {
			js_a_l('密碼錯誤，請重新檢查密碼', $url_to);exit;
		}
	}
	//檢查 id 是否為英文、數字結合，且開頭為英文字母
	if(!ereg ("^([a-zA-z]){1}([0-9a-zA-z]){2,}$", $id)){
		js_a_l('資料錯誤: 帳號只能由英文、數字組合，且開頭需為英文字母', $url_to);exit;
	}
	//檢查 Password 是否為英文、數字結合
	if($password && !ereg ("^([0-9a-zA-z]){1,}$", $password)) {
		js_a_l('資料錯誤: 密碼只能由英文、數字組合', $url_to);exit;
	}
	//檢查是否密碼不同
	if($password != $password_check) {
		js_a_l('資料錯誤: 請重新檢查密碼', $url_to);exit;
	}
	//檢查是否有資料遺漏
	if(!$id||!$name) {
		js_a_l('資料錯誤:請重新檢查是否有欄位遺漏', $url_to);exit;
	}
	//修改密碼
	if($id) {
		if($password) {
			$password = md5($password);
			$update_str .= " password='".$password."',";	
		}
		if($lv) {
			$update_str .= " lv='".$lv."',";	
		}
	}else {
		$password         = md5($password);
		$password_check   = md5($password_check);			
	}
	
	if(!$Fullkey)
		$query = "insert into $table_name(id, password, name, lv, create_time, edit_time, pub) values('".$id."', '".$password."', '".$name."', '".$lv."', now(), now(), 1)";
	elseif($Fullkey)
		$query = "update $table_name set $update_str name='".$name."', edit_time=now() where Fullkey='".$Fullkey."'";
	$obj_admin->run_mysql($query);
	
	if($obj_admin->result) {
		if($_SESSION[Login_System_User]['id']==$id)
			$_SESSION[Login_System_User]['name'] = $name;
		js_a_l('儲存成功', $main_str.'.php');exit;
	}else {
		js_a_l('儲存失敗，請重新輸入並檢查', 'back');exit;
	}
}elseif ($_SESSION[Login_System_User]['lv']=='admin' && $_GET['Fullkey']) {
	$Fullkey = format_data($_GET['Fullkey'], 'int');
	$query   = "select * from $table_name where Fullkey='".$Fullkey."'";
	$admin   = $obj_admin->run_mysql_out($query);
}elseif ($_SESSION[Login_System_User]['lv']=='web' && $_SESSION[Login_System_User]['id']) {
	$query = "select * from $table_name where id='".$_SESSION[Login_System_User]['id']."'";
	$admin = $obj_admin->run_mysql_out($query);
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
		rules: [
		<?php if(!$admin['id']) { ?>
		{ input: '#id', message: '請輸入帳號', action: 'keyup, blur', rule: 'required' },
		{ input: '#id', message: '帳號長度最少4個字元，最多12個字元', action: 'keyup, blur', rule: 'length=4,12' },
		{ input: '#name', message: '請輸入姓名', action: 'keyup, blur', rule: 'required' },
		{ input: '#password', message: '請輸入密碼', action: 'keyup, blur', rule: 'required' },
		{ input: '#password', message: '密碼長度最少4個字元，最多12個字元', action: 'keyup, blur', rule: 'length=4,12' },
		{ input: '#password_check', message: '請輸入確認密碼', action: 'keyup, blur', rule: 'required' },
		{ input: '#password_check', message: '請重新確認密碼', action: 'keyup, blur', rule: function(input, commit) {
				if($("#password").val() != $("#password_check").val()) {
					return false;	
				}else {
					return true;	
				}
			}
		}
		<?php }else { ?>
		{ input: '#password_confirm', message: '請輸入確認身分密碼', action: 'keyup, blur', rule: 'required' },
		{ input: '#password', message: '密碼長度最少4個字元，最多12個字元', action: 'keyup, blur', rule: function(input, commit) {
				if($("#password").val() && ($("#password").val().length<4 || 12<$("#password").val().length)) {
					return false;	
				}else {
					return true;	
				}
			}
		},
		{ input: '#password_check', message: '請重新確認密碼', action: 'keyup, blur', rule: function(input, commit) {
				if($("#password").val() != $("#password_check").val()) {
					return false;	
				}else {
					return true;	
				}
			}
		}
		<?php } ?>]
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
      <li class="title"><?=$page_title?></li>
      <li class="right"><?php include('include_welcome.php'); ?></li>
   </ul>
   <div class="mainContent">
   	 <div id="data_content">
   		<form method="post" id="<?=$main_str?>_form" action="<?=$_SERVER['PHP_SELF']?>">
            <input type="hidden" name="action" value="save" />
            <input type="hidden" name="Fullkey" value="<?=$admin['Fullkey']?>" />
            <table class="<?=$main_str?>-table">
                <tr>
                    <td width="120" height="60">會員帳號：</td>
                    <td align="left"><?php if(!$admin['id']){ ?><input type="text" name="id" id="id" value="<?=$_GET['id']?>" class="frome" style="width:250px"><?php }else{ ?><?=$admin['id']?><input type="hidden" name="id" value="<?=$admin['id']?>"><?php } ?><br />(帳號長度最少4個字元，最多12個字元)</td>
                </tr>
                <tr>
                    <td>姓　　名：</td>
                    <td align="left"><input type="text" name="name" id="name" value="<?=$admin['name']?>" class="frome" style="width:250px"></td>
                </tr>
                <?php if($admin['id']) { ?>
                <tr>
                    <td height="60">請輸入原密碼：</td>
                    <td align="left"><input type="password" name="password_confirm" id="password_confirm" value="" class="frome" style="width:250px" /> (請輸入密碼確認身份)</td>
                </tr>
                <?php } ?>
                <tr>
                    <td><?=($admin['id'])?'更改密碼':'輸入密碼'?>：</td>
                    <td align="left"><input type="password" name="password" id="password" value="" class="frome" style="width:250px" /> (密碼長度最少4個字元，最多12個字元)</td>
                </tr>
                <tr>
                    <td>確認密碼：</td>
                    <td align="left"><input type="password" name="password_check" id="password_check" value="" class="frome" style="width:250px" /></td>
                </tr>
                <?php if($_SESSION[Login_System_User]['lv']=='admin') { ?>
                <tr>
                    <td height="60">會員等級：</td>
                    <td align="left"><?php
					foreach($array_admin as $key => $value) {
						?><input type="radio" name="lv" value="<?=$key?>" <?php if($admin['lv']==$key){echo 'checked';} ?> /><?=$value?>　<?php	
					}
					?></td>
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