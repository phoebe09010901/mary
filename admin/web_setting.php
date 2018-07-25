<?php
header("content-type:text/html;charset=utf-8");
require_once('set.php');
require_once(Root_Includes_Path.'class_jqx.php');

$main_str   = 'system_set';
$table_name = Proj_Name.'_'.$main_str;	
$obj_jqx    = new jqx();

if($_POST['action']=='save') {
	$lang            = $_SESSION[Login_System_User]['lang'];
	$Fullkey         = format_data($_POST['Fullkey'], 'int');
	$company         = format_data($_POST['company'], 'text');
	$company_boss    = format_data($_POST['company_boss'], 'text');
	$company_email   = format_data($_POST['company_email'], 'text');
	$company_phone   = format_data($_POST['company_phone'], 'text');
	$company_mobile  = format_data($_POST['company_mobile'], 'text');
	$company_fax     = format_data($_POST['company_fax'], 'text');
	$company_zipcode = format_data($_POST['company_zipcode'], 'text');
	$company_county  = format_data($_POST['company_county'], 'text');
	$company_area    = format_data($_POST['company_area'], 'text');
	$company_address = format_data($_POST['company_address'], 'text');
	$html_title      = format_data($_POST['html_title'], 'text');
	$keywords        = format_data($_POST['keywords'], 'text');
	$description     = format_data($_POST['description'], 'text');
	$mail_sample1    = format_data($_POST['mail_sample1'], 'content');
	$mail_sample2    = format_data($_POST['mail_sample2'], 'content');
	$mail_sample3    = format_data($_POST['mail_sample3'], 'content');
	$mail_sample4    = format_data($_POST['mail_sample4'], 'content');
	$mail_sample5    = format_data($_POST['mail_sample5'], 'content');
	
	$url_to = 'back';
	
	if(!$Fullkey)
		$query = "insert into $table_name(lang, company, company_boss, company_email, company_phone, company_mobile, company_fax, company_zipcode, company_county, company_area, company_address, html_title, keywords, description, mail_sample1, mail_sample2, mail_sample3, mail_sample4, mail_sample5, products_category_lv_num, edit_time) values('".$lang."', '".$company."', '".$company_boss."', '".$company_email."', '".$company_phone."', '".$company_mobile."', '".$company_fax."', '".$company_zipcode."', '".$company_county."', '".$company_area."', '".$company_address."', '".$html_title."', '".$keywords."', '".$description."', '".$mail_sample1."', '".$mail_sample2."', '".$mail_sample3."', '".$mail_sample4."', '".$mail_sample5."', '2', now())";
	elseif($Fullkey)
		$query = "update $table_name set company='".$company."', company_boss='".$company_boss."', company_email='".$company_email."', company_phone='".$company_phone."', company_mobile='".$company_mobile."', company_fax='".$company_fax."', company_zipcode='".$company_zipcode."', company_county='".$company_county."', company_area='".$company_area."', company_address='".$company_address."', html_title='".$html_title."', keywords='".$keywords."', description='".$description."', mail_sample1='".$mail_sample1."', mail_sample2='".$mail_sample2."', mail_sample3='".$mail_sample3."', mail_sample4='".$mail_sample4."', mail_sample5='".$mail_sample5."', edit_time=now() where Fullkey='".$Fullkey."'";
	$obj_system->run_mysql($query);
	
	if($obj_system->result) {
		js_a_l('儲存成功', 'web_setting.php');exit;
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
<script src="../ckeditor/ckeditor.js"></script>
<script src="../ckeditor/adapters/jquery.js"></script>
<script type="text/javascript" src="../jqwidgets/jqxvalidator.js"></script> 
<!-- listbox -->
<script type="text/javascript" src="../jqwidgets/jqxlistbox.js"></script>
<script type="text/javascript" src="../jqwidgets/jqxdata.js"></script>
<script type="text/javascript">
$(document).ready(function () {
	$( '#mail_sample1' ).ckeditor();
	$( '#mail_sample2' ).ckeditor();
	$( '#mail_sample3' ).ckeditor();
	$( '#mail_sample4' ).ckeditor();
	$( '#mail_sample5' ).ckeditor();
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
		{ input: '#company_email', message: '請輸入E-mail', action: 'keyup, blur', rule: 'required' },
		{ input: '#html_title', message: '請輸入網站名稱', action: 'keyup, blur', rule: 'required' }]
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
                    <td width="120" height="60">公司名稱：</td>
                    <td align="left"><input type="text" name="company" id="company" value="<?=stripslashes($system['company'])?>" class="frome" style="width:250px"></td>
                    <td width="120">負責人姓名：</td>
                    <td align="left"><input type="text" name="company_boss" id="company_boss" value="<?=$system['company_boss']?>" class="frome" style="width:250px" /></td>
                </tr>
                <tr>
                    <td height="60">E-mail：</td>
                    <td align="left"><input type="text" name="company_email" id="company_email" value="<?=$system['company_email']?>" class="frome" style="width:250px" /><br />(如有兩個以上，請以","分隔)</td>
                    <td>連絡電話：</td>
                    <td align="left"><input type="text" name="company_phone" id="company_phone" value="<?=$system['company_phone']?>" class="frome" style="width:250px" /></td>
                </tr>
                <tr>
                    <td height="60">手機號碼：</td>
                    <td align="left"><input type="text" name="company_mobile" id="company_mobile" value="<?=$system['company_mobile']?>" class="frome" style="width:250px" /></td>
                    <td>傳真號碼：</td>
                    <td align="left"><input type="text" name="company_fax" id="company_fax" value="<?=$system['company_fax']?>" class="frome" style="width:250px" /></td>
                </tr>
                <tr>
                    <td height="60">聯絡地址：</td>
                    <td colspan="3" align="left"><input type="text" name="company_address" id="company_address" value="<?=$system['company_address']?>" class="frome" style="width:400px" /></td>
                </tr>
                <tr>
                    <td height="60">網站名稱：</td>
                    <td align="left"><input type="text" name="html_title" id="html_title" value="<?=stripslashes($system['html_title'])?>" class="frome" style="width:250px" /></td>
                    <td>關鍵字：</td>
                    <td align="left"><input type="text" name="keywords" id="keywords" value="<?=stripslashes($system['keywords'])?>" class="frome" style="width:250px" /><br />(如有兩個以上，請以","分隔)</td>
                </tr>
                <tr>
                    <td height="60">網站敘述：</td>
                    <td colspan="3" align="left"><textarea name="description" id="description" class="frome" style="width:400px; height:75px"><?=stripslashes($system['description'])?></textarea></td>
                </tr>
                <tr>
                    <td height="60">Mail Sample1：</td>
                    <td colspan="3"><textarea id="mail_sample1" name="mail_sample1" rows="10"><?=stripslashes($system['mail_sample1'])?></textarea></td>
                </tr>
                <tr>
                    <td height="60">Mail Sample2：</td>
                    <td colspan="3"><textarea id="mail_sample2" name="mail_sample2" rows="10"><?=stripslashes($system['mail_sample2'])?></textarea></td>
                </tr>
                <tr>
                    <td height="60">Mail Sample3：</td>
                    <td colspan="3"><textarea id="mail_sample3" name="mail_sample3" rows="10"><?=stripslashes($system['mail_sample3'])?></textarea></td>
                </tr>
                <tr>
                    <td height="60">Mail Sample4：</td>
                    <td colspan="3"><textarea id="mail_sample4" name="mail_sample4" rows="10"><?=stripslashes($system['mail_sample4'])?></textarea></td>
                </tr>
                <tr>
                    <td height="60">Mail Sample5：</td>
                    <td colspan="3"><textarea id="mail_sample5" name="mail_sample5" rows="10"><?=stripslashes($system['mail_sample5'])?></textarea></td>
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