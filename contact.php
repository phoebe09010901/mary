<?php
header("content-type:text/html;charset=utf-8");
require_once('set.php');
require_once(Root_Includes_Path.'class_sendmail.php');

$obj_mail = new sendmail();

if($_POST['action']=='save') {
	$name    = format_data($_POST['name'], 'text');
	$phone   = format_data($_POST['phone'], 'text');
	$email   = format_data($_POST['email'], 'text');
	$content = format_data($_POST['content'], 'text');
	$key_c   = format_data($_POST['key_c'], 'text');

	$url_to = 'contact.php?name='.$name.'&phone='.$phone.'&email='.$email.'&content='.$content;
	//check check_code
	if(strtoupper($key_c) != $_SESSION['s_checksum']) {
		js_a_l('Check code error.', $url_to);exit;
	}
	$query = "insert into $table_name_cont(name, phone, email, content, state, create_time) values('$name', '$phone', '$email', '$content', 0, now())";
	$obj_cont->run_mysql($query);

	//send mail
	$obj_mail->contact_mail($name, $phone, $email, $content);

	js_a_l('We have received your information will contact you as soon as possible, thank you.', 'contact.php');exit;
}

$page_id = 3;
$query = "select * from $table_name_pages where Fullkey='$page_id'";
$pages = $obj_pages->run_mysql_out($query);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<meta name=”viewport” content=”width=device-width,initial-scale=1.0”>

<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<link href="fonts.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="css/all.css">
<link rel="stylesheet" href="css/top_menu.css">

<title><?=Html_Title?></title>
<link rel="icon" type="image/png" href="favicon.png" />
<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
<link rel="apple-touch-icon" href="favicon_m.png"/>

<style type="text/css">
<!--
body {
	background: url(images/f_bg.jpg) repeat-x top left #c2cb56;
}
-->
.topbtn_allmenu ul {
	list-style-type: none;
	display: block;
	margin: 0 auto;
}
.topbtn_allmenu ul li {
	display: block;
	float: left;
	position: relative;
}


.topbtn_allmenu ul ul {
	position: absolute;
	top:21px;
	left:-4px;
	width: 281px;
	height: 128px;
	padding: 0;
	display: none;
}
</style>
<script type="text/javascript" src="scripts/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="js/js_common.js"></script>
<script type="text/javascript">
function real_save() {
	if(!$("#name").val()) {
		alert('Please enter Name.');
	}else if(!$("#phone").val()) {
		alert('Please enter Phone number.');
	}else if(!$("#email").val()) {
		alert('Please enter E-mail.');
	}else if(!validateEmail($("#email").val())) {
		alert('E-mail format error.');
	}else if(!$("#key_c").val()) {
		alert('Please enter Check code.');
	}else {
		$('#content_form').submit();
	}
}
</script>
</head>

<body>

<div id="wrapper_center_06">

    <?php include('include_top.php');?>

	<!----------- 內容 開始 ------------------>
  	<div class="contact">
    	<span class="ce_title11">Contact</span>

        <div class="contact_1">
          <div class="contact_1_1">
            <img src="pages/<?=$pages['file1']?>" width="543" height="380" />
          </div>
          <div class="contact_1_2">
            <span class="ce_title12"><?=stripslashes($pages['content'])?></span>
          </div>
   	  </div>

      <div class="contact_2_1"><?=stripslashes($pages['content2'])?></div>

        <div class="contact_2_1_b">
        	<form action="<?=$_SERVER['PHP_SELF']?>" name="content_form" id="content_form" method="post">
            <input type="hidden" name="action" value="save" />
            <table width="0" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><table width="0" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td height="40" align="left" valign="middle"><table width="0" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="50" class="m3">Name</td>
                        <td><input type="text" class="f1" name="name" id="name" value="<?=$_GET['name']?>" /></td>
                      </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td height="40" align="left" valign="middle"><table width="0" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="50" class="m3">Email</td>
                        <td><input type="text" class="f1" name="email" id="email" value="<?=$_GET['email']?>" /></td>
                      </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td height="40" align="left" valign="middle"><table width="0" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="50" class="m3">Phone</td>
                        <td><input type="text" class="f1" name="phone" id="phone" value="<?=$_GET['phone']?>" /></td>
                      </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td height="0" align="left" valign="middle"><table width="0" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="50" height="30" class="m3">Comment</td>
                      </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td align="left" valign="top"><textarea rows="10" class="f2" name="content" id="content"><?=$_GET['content']?></textarea></td>
                  </tr>
                  <tr>
                    <td height="40" align="left" valign="middle"><table width="0" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="80" class="m3">
                          <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td height="50" class="m3">Check Code</td>
                            </tr>
                        </table></td>
                        <td valign="middle"><table width="250" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td height="40" class="m3"><input type="text" class="f1" name="key_c" id="key_c" value="" /></td>
                          </tr>
                        </table>
                        </td>
                        <td width="10" valign="middle">&nbsp;</td>
                        <td valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td height="40" class="m3"><img src="tools/chucksum.php" width="100" height="30"></td>
                          </tr>
                        </table></td>
                      </tr>
                    </table></td>
                  </tr>
                </table></td>
                <td valign="bottom"><table width="0" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="100" height="35" align="center" valign="top"><div class="b3"><a href="#" onclick="real_save()">Send</a></div></td>
                  </tr>
                </table></td>
              </tr>
            </table>
			</form>
   	</div>
	</div>
	<!----------- 內容 結束 ------------------>

</div>

<!-- 光箱 開始 -->
<script type="text/javascript" src="js/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="js/jquery.fancybox.js?v=2.1.5"></script>
<link rel="stylesheet" type="text/css" href="css/jquery.fancybox.css?v=2.1.5" media="screen" />
<script type="text/javascript">
	$(document).ready(function() {
		$('.fancybox').fancybox();
	});
</script>
<!-- 光箱 結束 -->

<!-- 上方menu 開始 -->
<script>
$(function(){
	$("#MENU > ul > li").hover(function(){
		var N = this.id.substr(4);
		$("#SUB"+N).stop(true,true).slideDown();
	},function(){
		var N = this.id.substr(4);
		$("#SUB"+N).stop(true,true).slideUp();
	});
});
</script>
<!-- 上方menu 結束 -->

</body>
</html>
<?php include("include_bottom.php"); ?>
