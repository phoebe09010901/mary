<?php
header("content-type:text/html;charset=utf-8");
require_once('set.php');

$obj_dogs4    = new mysql_page();
$apply_id     = format_data($_GET['apply_id'], 'int');
$adoptedog    = format_data($_GET['adoptedog'], 'text');
$dog_id4      = format_data($_GET['dog_id4'], 'int');
$sample_style = ($_GET['sample_style'])?$_GET['sample_style']:1;
$list_date = Form_Date;
$list_date = explode("-", $list_date);
$list_date = date("F d, Y", mktime(0, 0, 0, $list_date[1], $list_date[2], $list_date[0]));

if($_POST['action']=='save') {
	$apply_id      = format_data($_POST['apply_id'], 'int');
	$dog_id        = format_data($_POST['dog_id'], 'int');
	$dog_id4       = format_data($_POST['dog_id4'], 'int');
	$ans16         = format_data($_POST['dog_name4'], 'text');
	$mail_from     = 'adoption@adoptadoggie.org';
	$mail_fromName = 'Adoption - Adopt a Doggie';
	$mail_to       = format_data($_POST['mail_to'], 'text');
	$mail_toName   = format_data($_POST['mail_toName'], 'text');
	$mail_subject  = format_data($_POST['mail_subject'], 'text');
	$mail_content  = format_data($_POST['mail_content'], 'content');

	//update dog_id4
	$query = "update ".$table_name_dogs."_apply1 set dog_id4='$dog_id4', ans16='$ans16' where Fullkey='$apply_id'";
	$obj_dogs->run_mysql($query);
	//search agreement ID
	$query = "select Fullkey from ".$table_name_dogs."_agreement where dog_id='$dog_id' and ans7='$mail_to'";
	$agree = $obj_dogs->run_mysql_out($query);
	//$agree_link = '<p align="center"><a href="'.Host_Name.'dogs_agreement_preview.php?agreement_id='.$agree['Fullkey'].'" target="_blank">Your Agreement</a></p>';

	//phpmailer init
	$mail->From = Company_Email;
	$mail->FromName = $mail_fromName;
	$mail->AddReplyTo(Company_Email, $mail_fromName);
	$mail->Subject = $mail_subject;
	$mail->IsSMTP();
	$mail->CharSet  = "utf-8";	//設定信件字元編碼
	$mail->Encoding = "base64";	//設定信件編碼，大部分郵件工具都支援此編碼方式
	$mail->SMTPAuth = true;							//設定為安全驗證方式
	$mail->Host     = "mail.adoptadoggie.org";	//指定SMTP的服務器位址
	$mail->Port     = 25;							//設定SMTP服務的POST
	$mail->Username = "contact@adoptadoggie.org";	//SMTP的帳號
	$mail->Password = "contact@tw100";					//SMTP的密碼
	$mail->IsHTML(true);	//設置郵件格式為HTML
	//$mail->AddAddress($mail_to, $mail_toName);
	$mail_to = explode(",", $mail_to);
	if(count($mail_to)>0) {
		foreach($mail_to as $value)	{
			$mail->AddAddress($value, $mail_toName);
		}
	}

	$mail->Body = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
	<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>'.$mail_subject.'</title>
	</head>

	<body>'.stripslashes($mail_content).$agree_link.'</body></html>';

	//echo $mail->Body;exit;
	//echo $mail->Host.'/'.Company_Email.'/'.$mail_fromName.'/'.$mail_to.'/'.$mail_toName;
	if(!$mail->Send()) {
		echo "錯誤!信件無法送出<br>";
		echo "Mailer 錯誤訊息>>>> " . $mail->ErrorInfo;
	} else {
		$query = "update ".$table_name_dogs."_apply1 set state=1 where Fullkey='$apply_id'";
		$obj_dogs->run_mysql($query);
		js_a_l("信件已發送", "back");
	}
	exit;
}

//apply1
$query = "select * from ".$table_name_dogs."_apply1 where Fullkey='$apply_id'";
$apply1 = $obj_dogs->run_mysql_out($query);
$query = "select * from ".$table_name_dogs."_apply2 where apply_id='".$apply1['Fullkey']."'";
$apply2 = $obj_dogs->run_mysql_out($query);
$query = "select * from ".$table_name_dogs."_apply3 where apply_id='".$apply1['Fullkey']."'";
$apply3 = $obj_dogs->run_mysql_out($query);
$query = "select * from ".$table_name_dogs."_apply4 where apply_id='".$apply1['Fullkey']."'";
$apply4 = $obj_dogs->run_mysql_out($query);
$query = "select * from ".$table_name_dogs."_apply5 where apply_id='".$apply1['Fullkey']."'";
$apply5 = $obj_dogs->run_mysql_out($query);
$query = "select * from ".$table_name_dogs."_apply6 where apply_id='".$apply1['Fullkey']."'";
$apply6 = $obj_dogs->run_mysql_out($query);
$query = "select * from ".$table_name_dogs."_apply7 where apply_id='".$apply1['Fullkey']."'";
$apply7 = $obj_dogs->run_mysql_out($query);
$query = "select * from ".$table_name_dogs."_apply8 where apply_id='".$apply1['Fullkey']."'";
$apply8 = $obj_dogs->run_mysql_out($query);
$query = "select * from ".$table_name_dogs."_apply9 where apply_id='".$apply1['Fullkey']."'";
$apply9 = $obj_dogs->run_mysql_out($query);
$query = "select * from ".$table_name_dogs." where Fullkey='".$apply1['dog_id']."'";
$dogs  = $obj_dogs->run_mysql_out($query);
//檢查挑選之狗兒是否已被認養
$agree_dog_id = 0;
$query = "select da.adopted from $table_name_dogs d, ".$table_name_dogs."_agreement da where d.Fullkey=da.dog_id and d.Fullkey='".$apply1['dog_id']."'";
$adopted1 = $obj_dogs->run_mysql_out($query);
if($adopted1['adopted']==1) {
	$name_style1 = 'red';
}elseif((!$adopted1['adopted'] || $adopted1['adopted']==0) && $agree_dog_id==0) {
	$name_style1   = 'black';
	$agree_dog_id = $apply1['dog_id'];
	$agree_dog_id2= $agree_dog_id;
}
$query = "select da.adopted from $table_name_dogs d, ".$table_name_dogs."_agreement da where d.Fullkey=da.dog_id and d.Fullkey='".$apply1['dog_id2']."'";
$adopted2 = $obj_dogs->run_mysql_out($query);
if($adopted2['adopted']==1) {
	$name_style2 = 'red';
}elseif((!$adopted2['adopted'] || $adopted2['adopted']==0) && $agree_dog_id==0) {
	$name_style2   = 'black';
	$agree_dog_id = $apply1['dog_id2'];
	$agree_dog_id2= $agree_dog_id;
}
$query = "select da.adopted from $table_name_dogs d, ".$table_name_dogs."_agreement da where d.Fullkey=da.dog_id and d.Fullkey='".$apply1['dog_id3']."'";
$adopted3 = $obj_dogs->run_mysql_out($query);
if($adopted3['adopted']==1) {
	$name_style3 = 'red';
}elseif((!$adopted3['adopted'] || $adopted3['adopted']==0) && $agree_dog_id==0) {
	$name_style3   = 'black';
	$agree_dog_id = $apply1['dog_id3'];
	$agree_dog_id2= $agree_dog_id;
}
if($apply1['dog_id4']) {
	$agree_dog_id = $apply1['dog_id4'];
}
if($dog_id4) {
	$agree_dog_id = $dog_id4;
}

//4th 狗兒名單
//$query = "select Fullkey, name from $table_name_dogs where Fullkey<>'".$apply1['dog_id']."' and Fullkey<>'".$apply1['dog_id2']."' and Fullkey<>'".$apply1['dog_id3']."' and Fullkey not in (select dog_id from ".$table_name_dogs."_agreement where adopted=1) order by name asc";
$query = "select Fullkey, name from $table_name_dogs where Fullkey not in (select dog_id from ".$table_name_dogs."_agreement where adopted=1) order by name asc";
$obj_dogs4->run_mysql_list($query);

//預設信件內容
$query  = "select * from $table_name_sys where lang='".$_SESSION[Login_System_User]['lang']."'";
$system = $obj_system->run_mysql_out($query);
switch($sample_style) {
	case 1:
		$mail_content = $system['mail_sample1'];
		break;
	case 2:
		$mail_content = $system['mail_sample2'];
		break;
	case 3:
		$mail_content = $system['mail_sample3'];
		break;
	case 4:
		$mail_content = $system['mail_sample4'];
		break;
	case 5:
		$mail_content = $system['mail_sample5'];
		break;
}
if(!$adoptedog)
	$adoptedog = $dogs['name'];
$mail_content = str_replace('_ans1_', $apply2['ans1'], $mail_content);
$mail_content = str_replace('_dogs_name_', $adoptedog, $mail_content);
$mail_content = str_replace('_list_date_', date("Y-m-d"), $mail_content);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<meta name="viewport" content="width=device-width, initial-scale=1">

<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<!--
<link href="fonts.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="css/all.css">
<link rel="stylesheet" href="css/top_menu.css">
-->
<script type="text/javascript" src="../scripts/jquery-1.10.2.min.js"></script>
<script type="text/javascript">
$( document ).ajaxStart(function() {
	$( "#photos_list" ).html( '<div id="loading_img" style="text-align:center; height:300px; margin-top:150px;"><img src="../images/lightbox/loading.gif" border="0"></div>' );
});
$( document ).ajaxStop(function() {
	$( "#loading_img" ).hide();
});
function mouseover_show_btn(photo_id) {
	$("#photo_del_"+photo_id).show();
}
function mouseover_hidden_btn(photo_id) {
	$("#photo_del_"+photo_id).hide();
}
function show_list() {
	$("#photos_list").html('');
	var ajaxurl = '../doggie_data.php?action=photos_list2&dog_id=<?=$apply1['dog_id']?>&apply_id=<?=$apply1['Fullkey']?>';
	$.ajax({
		url: ajaxurl,
		dataType: 'json',
		success: function(request) {
			$.each(request, function(key, photo_data) {
				$.each(photo_data, function(key, data)	{
					var div_str = '<div id="show_photo_block_'+key+'" class="show_photo"><div class="photo_block"><img src="../doggie/<?=$apply1['dog_id']?>/<?=$apply1['Fullkey']?>/'+data['file1']+'" width="'+data['width']+'" height="'+data['height']+'" alt="'+data['title']+'" id="photo_file1_'+key+'"></div></div>';//alert(div_str);
					$("#photos_list").html($("#photos_list").html()+div_str);
				})
			})
		}
	});
}
function choice_4th_dog(dog_id, dog_name) {
	if(dog_id!=0) {
		$("#dog_id4").val(dog_id);
		$("#dog_name4").val(dog_name);
		$("#agreement_link").html('http://adoptadoggie.org/adoption_1105b.php?dog_id='+dog_id+'&apply_id=<?=$apply_id?>');
		$("#mail4 option").each(function() {
			$(this).val($(this).val()+"&dog_id4="+dog_id);
		});
	}else {
		$("#dog_id4").val(dog_id);
		$("#dog_name4").val('');
		$("#agreement_link").html('http://adoptadoggie.org/adoption_1105b.php?dog_id=<?=$agree_dog_id2?>&apply_id=<?=$apply_id?>');
	}
}
$(document).ready(function () {
	var theme = '<?=jqxStyle?>';

	show_list();
	<?php if($agree_dog_id==0){ ?>alert("Please choice a dog for <?=$apply2['ans1'].' '.$apply2['ans3']?>.");<?php } ?>
	$("#ans16").change(function(){
		dog_id   = $("#ans16").val();
		dog_name = $("#ans16 option:selected").text();
		choice_4th_dog(dog_id, dog_name);
	});
});
</script>
<style type="text/css">
.upload_photo {
	padding: 10px;
	text-align:left;
}
.show_photo {
	position: relative;
	float:left;
	width:190px;
	height:280px;
	margin: 15px 0 0 15px;
	text-align:center;
}
.show_photo input{
	margin: 5px 2px 0 2px;
}
.photo_block {
	width:100%;
	height:180px;
	text-align:center;
	border: #FFF solid 2px;
}
.photo_block:hover {
	border: #f5794d dashed 2px;
}
.photo_title_text1 {
	width: 170px;
	color: #CCC;
}
.photo_title_text2 {
	width: 170px;
	color: #000;
}
.photo_sort_text1 {
	width: 170px;
	color: #CCC;
}
.photo_sort_text2 {
	width: 170px;
	color: #000;
}
.del_btn {
	position:absolute;
	top: 0;right:0;
	text-align:right;
	width:16px;
	margin: 5px;
	display:none;
	cursor:pointer;
}
</style>
<style>
@font-face
{
	/*font-family: a;*/
	font-family: "Museo Sans 500";
	src: url('http://adoptadoggie.org/font/MuseoSans.eot');
	src: url('http://adoptadoggie.org/font/MuseoSans.eot?#iefix') format('embedded-opentype'),
	url('http://adoptadoggie.org/font/MuseoSans.svg#Museo Sans 500') format('svg'),
	url('http://adoptadoggie.org/font/MuseoSans.woff') format('woff'),
	url('http://adoptadoggie.org/font/MuseoSans.ttf') format('truetype');
	font-weight: normal;
	font-style: normal;
}
@font-face
{
	/*font-family: b;*/
	font-family: "Museo Sans 500 Italic";
	src: url('http://adoptadoggie.org/font/MuseoSans_500_Italic.eot');
	src: url('http://adoptadoggie.org/font/MuseoSans_500_Italic.eot?#iefix') format('embedded-opentype'),
	url('http://adoptadoggie.org/font/MuseoSans_500_Italic.svg#Museo Sans 500') format('svg'),
	url('http://adoptadoggie.org/font/MuseoSans_500_Italic.woff') format('woff'),
	url('http://adoptadoggie.org/font/MuseoSans_500_Italic.ttf') format('truetype');
	font-weight: normal;
	font-style: normal;
}
@font-face
{
	/*font-family: c;*/
	font-family: "Myriad Pro bold";
	src: url('http://adoptadoggie.org/font/myriadprobold.eot');
	src: url('http://adoptadoggie.org/font/myriadprobold.eot?#iefix') format('embedded-opentype'),
	url('http://adoptadoggie.org/font/myriadprobold.svg#Myriad Pro') format('svg'),
	url('http://adoptadoggie.org/font/myriadprobold.woff') format('woff'),
	url('http://adoptadoggie.org/font/myriadprobold.ttf') format('truetype');
	font-weight: normal;
	font-style: normal;
}
@font-face
{
	/*font-family: j;*/
	font-family: "Myriad Pro";
	src: url('http://adoptadoggie.org/font/MyriadPro-Regular.eot');
	src: url('http://adoptadoggie.org/font/MyriadPro-Regular.eot?#iefix') format('embedded-opentype'),
	url('http://adoptadoggie.org/font/MyriadPro-Regular.svg#Myriad Pro') format('svg'),
	url('http://adoptadoggie.org/font/MyriadPro-Regular.woff') format('woff'),
	url('http://adoptadoggie.org/font/MyriadPro-Regular.ttf') format('truetype');
	font-weight: normal;
	font-style: normal;
}
@font-face
{
	/*font-family: m;*/
	font-family: "HelveticaNeue-Bold";
	src: url('http://adoptadoggie.org/font/HelveticaNeue-Bold.eot');
	src: url('http://adoptadoggie.org/font/HelveticaNeue-Bold.eot?#iefix') format('embedded-opentype'),
	url('http://adoptadoggie.org/font/HelveticaNeue-Bold.svg#HelveticaNeue') format('svg'),
	url('http://adoptadoggie.org/font/HelveticaNeue-Bold.woff') format('woff'),
	url('http://adoptadoggie.org/font/HelveticaNeue-Bold.ttf') format('truetype');
	font-weight: normal;
	font-style: normal;
}
@font-face
{
	font-family: "Helvetica Neue";
	src: url('http://adoptadoggie.org/font/hlzc.eot');
	src: url('http://adoptadoggie.org/font/hlzc.eot?#iefix') format('embedded-opentype'),
	url('http://adoptadoggie.org/font/hlzc.svg#Helvetica Neue') format('svg'),
	url('http://adoptadoggie.org/font/hlzc.woff') format('woff'),
	url('http://adoptadoggie.org/font/hlzc.ttf') format('truetype');
	font-weight: normal;
	font-style: normal;
}


@charset "utf-8";
/* CSS Document */
* {
	/*box-sizing:border-box;
	-webkit-box-sizing:border-box;
	-moz-box-sizing:border-box;
	-ms-box-sizing:border-box;
	解除padding跟width的關係*/
    text-decoration: none;
}
/*背景滿版*/
html{
	width:100%; /*背景滿版*/
	height:100%; /*背景滿版*/
}

body{
	margin:0;
	padding:0;
	width:100%; /*背景滿版*/
	height:100%; /*背景滿版*/
}
ul li
{
list-style-type:none;
}
img{
border:0;
}

#wrapper {
	width: 1279px;
    margin-top: 0;
	margin-right: auto;
	margin-bottom: 0;
	margin-left: auto;
}
#wrapper_center {
	width: 1024px;
	height:100%;
	margin:0 auto;
	background: url(http://adoptadoggie.org/images/top_bg.png) no-repeat top right;
}
#wrapper_center_03 {
	width: 1024px;
	height:100%;
	margin:0 auto;
	background: url(http://adoptadoggie.org/images/top_bg_03.png) no-repeat top right;
}
#wrapper_center_04 {
	width: 1024px;
	height:100%;
	margin:0 auto;
	background: url(http://adoptadoggie.org/images/top_bg_04.png) no-repeat top right;
}
#wrapper_center_05 {
	width: 1024px;
	height:100%;
	margin:0 auto;
	background: url(http://adoptadoggie.org/images/top_bg_05.png) no-repeat top right;
}
#wrapper_center_06 {
	width: 1024px;
	height:100%;
	margin:0 auto;
	background: url(http://adoptadoggie.org/images/top_bg_06.png) no-repeat top right;
}
#wrapper_center_07 {
	width: 1024px;
	height:100%;
	margin:0 auto;
	background: url(http://adoptadoggie.org/images/top_bg_07.png) no-repeat top right;
}
  .textbox_box {
	font-family: Arial, Helvetica, sans-serif;
	background: rgba(255, 255, 255, 0.44);
	color: #333;
	border: 1px solid #C2CB56;
	padding: 4px 8px 4px 4px !important;
	line-height: 1;
	width: 275px;
	height: 10px;
  }
 .textbox_box:hover {
    border: 1px solid #FF00FF;
    box-shadow: inset 0px 1px 2px rgba(0,0,0,0.3);
    -moz-box-shadow: inset 0px 1px 2px rgba(0,0,0,0.3);
    -webkit-box-shadow: inset 0px 1px 2px rgba(0,0,0,0.3);
  }
 .textbox_box:focus {
    border: 1px solid #4d90fe;
    outline: none;
    box-shadow: inset 0px 1px 2px rgba(0,0,0,0.3);
    -moz-box-shadow: inset 0px 1px 2px rgba(0,0,0,0.3);
    -webkit-box-shadow: inset 0px 1px 2px rgba(0,0,0,0.3);
    background: rgb(255, 255, 255); }


  .textbox_box2 {
	font-family: Arial, Helvetica, sans-serif;
	background: rgba(255, 255, 255, 0.44);
	color: #333;
	border: 1px solid #C2CB56;
	padding: 4px 8px 4px 4px !important;
	line-height: 1;
	width: 40px;
	height: 10px;
  }
 .textbox_box2:hover {
    border: 1px solid #FF00FF;
    box-shadow: inset 0px 1px 2px rgba(0,0,0,0.3);
    -moz-box-shadow: inset 0px 1px 2px rgba(0,0,0,0.3);
    -webkit-box-shadow: inset 0px 1px 2px rgba(0,0,0,0.3);
  }
 .textbox_box2:focus {
    border: 1px solid #4d90fe;
    outline: none;
    box-shadow: inset 0px 1px 2px rgba(0,0,0,0.3);
    -moz-box-shadow: inset 0px 1px 2px rgba(0,0,0,0.3);
    -webkit-box-shadow: inset 0px 1px 2px rgba(0,0,0,0.3);
    background: rgb(255, 255, 255); }

 .textbox_box3 {
	font-family: Arial, Helvetica, sans-serif;
	background: rgba(255, 255, 255, 0.44);
	color: #333;
	border: 1px solid #C2CB56;
	padding: 4px 8px 4px 4px !important;
	line-height: 1;
	width: 80px;
	height: 10px;
  }
 .textbox_box3:hover {
    border: 1px solid #FF00FF;
    box-shadow: inset 0px 1px 2px rgba(0,0,0,0.3);
    -moz-box-shadow: inset 0px 1px 2px rgba(0,0,0,0.3);
    -webkit-box-shadow: inset 0px 1px 2px rgba(0,0,0,0.3);
  }
 .textbox_box3:focus {
    border: 1px solid #4d90fe;
    outline: none;
    box-shadow: inset 0px 1px 2px rgba(0,0,0,0.3);
    -moz-box-shadow: inset 0px 1px 2px rgba(0,0,0,0.3);
    -webkit-box-shadow: inset 0px 1px 2px rgba(0,0,0,0.3);
    background: rgb(255, 255, 255); }


 .textbox_box4 {
	font-family: Arial, Helvetica, sans-serif;
	background: rgba(255, 255, 255, 0.44);
	color: #333;
	border: 1px solid #C2CB56;
	padding: 4px 8px 4px 4px !important;
	line-height: 1;
	width: 400px;
	height: 60px;
  }
 .textbox_box4:hover {
    border: 1px solid #FF00FF;
    box-shadow: inset 0px 1px 2px rgba(0,0,0,0.3);
    -moz-box-shadow: inset 0px 1px 2px rgba(0,0,0,0.3);
    -webkit-box-shadow: inset 0px 1px 2px rgba(0,0,0,0.3);
  }
 .textbox_box4:focus {
    border: 1px solid #4d90fe;
    outline: none;
    box-shadow: inset 0px 1px 2px rgba(0,0,0,0.3);
    -moz-box-shadow: inset 0px 1px 2px rgba(0,0,0,0.3);
    -webkit-box-shadow: inset 0px 1px 2px rgba(0,0,0,0.3);
    background: rgb(255, 255, 255); }

 .textbox_box5 {
	font-family: Arial, Helvetica, sans-serif;
	background: rgba(255, 255, 255, 0.44);
	color: #333;
	border: 1px solid #C2CB56;
	padding: 4px 8px 4px 4px !important;
	line-height: 1;
	width: 400px;
	height: 10px;
  }
 .textbox_box5:hover {
    border: 1px solid #FF00FF;
    box-shadow: inset 0px 1px 2px rgba(0,0,0,0.3);
    -moz-box-shadow: inset 0px 1px 2px rgba(0,0,0,0.3);
    -webkit-box-shadow: inset 0px 1px 2px rgba(0,0,0,0.3);
  }
 .textbox_box5:focus {
    border: 1px solid #4d90fe;
    outline: none;
    box-shadow: inset 0px 1px 2px rgba(0,0,0,0.3);
    -moz-box-shadow: inset 0px 1px 2px rgba(0,0,0,0.3);
    -webkit-box-shadow: inset 0px 1px 2px rgba(0,0,0,0.3);
    background: rgb(255, 255, 255); }

.text_line{/*nico*/
	height: 13px;
	width: 275px;
	background-color: transparent;
	border-style: solid;
	border-width: 0px 0px 1px 0px;
	border-color: #A4AC35;
	outline: 0;
  }
.text_line2{/*nico*/
	height: 33px;
	width: 150px;
	background-color: transparent;
	border-style: solid;
	border-width: 0px 0px 1px 0px;
	border-color: #A4AC35;
	outline: 0;
	font-family: "Helvetica Neue";
	font-size: 25px;
	font-weight: 400;
	color: #D5E044;
  }

.center_T {
	width: 980px;
	margin: 0 auto;
}
.center_R3{/*phoebe*/
	float: right;
	width: 54px;
	height:350px;
	background-image: url(http://adoptadoggie.org/images/r_bg2.png);
	background-repeat: no-repeat;
}
.center_R4{/*phoebe*/
	float: right;
	width: 54px;
	height:350px;
	background-image: url(http://adoptadoggie.org/images/r_bg4.png);
	background-repeat: no-repeat;
}
.center_R5{/*phoebe*/
	float: right;
	width: 54px;
	height:350px;
	background-image: url(http://adoptadoggie.org/images/r_bg5.png);
	background-repeat: no-repeat;
}
.center_R6{/*phoebe*/
	float: right;
	width: 54px;
	height:350px;
	background-image: url(http://adoptadoggie.org/images/r_bg6.png);
	background-repeat: no-repeat;
}
.top{
	float: right;
	width: 27px;
	height:27px;
	}
.top4{/*phoebe*/
	float: left;
	width: 960px;
	text-align: right;
	}

/*---------------------------Adoption---------------------------------*/
.adoption{
	width: 960px;
	background-color: #FFF;
	margin:0 auto;
	overflow:auto;/*解決子元素float而父元素高度無法自動撐高的問題*/
	}
.adoption_1{
	float: left;
	width: 980px;
	height: 224px;
	background: url(http://adoptadoggie.org/images/adoption_1.png) no-repeat top 0px left 6px;
	}
.adoption_1_1{
	float: left;
	width: 900px;
	margin-top: 20px;
	margin-left: 40px;
	}
.adoption_1_2{/*phoebe*/
	float: left;
	width: 390px;
	height:110px;
	margin-top: 20px;
	margin-left: 47px;
	}
.adoption_1_3{/*phoebe*/
	float: right;
	width: 355px;
	height: 60px;
	border-bottom: #FFF 1px solid;
	margin:18px 50px 0 20px;
	}
.adoption_1_4{/*phoebe*/
	float: right;
	width: 355px;
	margin: 5px 50px 0 20px;
	height: 50px;
	}
.adoption_2{
	float: left;
	width: 980px;
	}
.adoption_2_all{
	float: left;
	width: 196px;
	height: 351px;
	background-image: url(http://adoptadoggie.org/images/0a_06.png);
	}
.adoption_2_1{
	float: left;
	width: 190px;
	height: 214px;
	margin: 3px;
	overflow: hidden;
	}
.adoption_2_2{
	float: left;
	width: 170px;
	height: 121px;
	margin-top: 10px;
	margin-right: 5px;
	margin-left: 15px;
	}
.adoption_2_3{
	float: left;
	height: 25px;
	display: block;
	margin-top: 20px;
	margin-left: 35px;
	}
.btn_APPLY {
 margin: 10px 0 0 0;
 float: right;
 height: 21px;
 width: 138px;
}

.btn_APPLY_02 {
/* IE9 SVG, needs conditional override of 'filter' to 'none' */
background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgdmlld0JveD0iMCAwIDEgMSIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+CiAgPGxpbmVhckdyYWRpZW50IGlkPSJncmFkLXVjZ2ctZ2VuZXJhdGVkIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgeDE9IjAlIiB5MT0iMCUiIHgyPSIwJSIgeTI9IjEwMCUiPgogICAgPHN0b3Agb2Zmc2V0PSIwJSIgc3RvcC1jb2xvcj0iIzAwMDAwMCIgc3RvcC1vcGFjaXR5PSIwLjE5Ii8+CiAgICA8c3RvcCBvZmZzZXQ9IjkyJSIgc3RvcC1jb2xvcj0iIzAwMDAwMCIgc3RvcC1vcGFjaXR5PSIwIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjEwMCUiIHN0b3AtY29sb3I9IiMwMDAwMDAiIHN0b3Atb3BhY2l0eT0iMCIvPgogIDwvbGluZWFyR3JhZGllbnQ+CiAgPHJlY3QgeD0iMCIgeT0iMCIgd2lkdGg9IjEiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+);
background: -moz-linear-gradient(top,  rgba(0,0,0,0.19) 0%, rgba(0,0,0,0) 92%, rgba(0,0,0,0) 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(0,0,0,0.19)), color-stop(92%,rgba(0,0,0,0)), color-stop(100%,rgba(0,0,0,0))); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top,  rgba(0,0,0,0.19) 0%,rgba(0,0,0,0) 92%,rgba(0,0,0,0) 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top,  rgba(0,0,0,0.19) 0%,rgba(0,0,0,0) 92%,rgba(0,0,0,0) 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top,  rgba(0,0,0,0.19) 0%,rgba(0,0,0,0) 92%,rgba(0,0,0,0) 100%); /* IE10+ */
background: linear-gradient(to bottom,  rgba(0,0,0,0.19) 0%,rgba(0,0,0,0) 92%,rgba(0,0,0,0) 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#30000000', endColorstr='#00000000',GradientType=0 ); /* IE6-8 */

	-webkit-border-radius: 3px;   /*元角*/
	-moz-border-radius: 3px;
	-ms-border-radius: 3px;
	border-radius: 3px;
	width:135px;
	height:9px;
	float:right;
}


/*---------------------- happy phoebe--------------------------------------*/
.big_title {
		float: left;
		width:165px;
		height:164px;
		font-family: "Myriad Pro bold";
		color:#FFF;
		font-size:28px;
		text-align:left;
		margin-right:20px;
		padding-top:25px;
		padding-left:18px;
		line-height:25px;
	}
.photo_block {
		float: left;
		width:170px;
		height:152px;
		margin: 16px 10px 7px 0;
		font-size:12px;
		line-height:40px;
		color:#FFF;
		font-family: "Museo Sans 500";
		overflow: hidden;
	}
.photo_block_2 {
		float: left;
		width:170px;
		height:122px;
		margin: 16px 10px 7px 0;
		font-size:12px;
		line-height:40px;
		color:#FFF;
		font-family: "Museo Sans 500";
		overflow: hidden;
	}
.happy{
	width: 960px;
	background-color: #FFF;
	margin:0 auto;
	overflow:auto;/*解決子元素float而父元素高度無法自動撐高的問題*/
	padding: 20px 0 0 20px;
	}
.happy_1{
	float: left;
	width: 940px;
	/*height: 189px;*/
	-webkit-border-radius: 5px;   /*元角*/
	-moz-border-radius: 5px;
	-ms-border-radius: 5px;
	border-radius: 5px;
	background-color: #b8cc39;
	margin-top: 20px;
	background-image: url(http://adoptadoggie.org/images/ha_b1.png);
	background-repeat: no-repeat;
	background-position: bottom left;
	margin-bottom:20px;
	}
	.happy_1 .movie_block {
		float: left;
		width:223px;
		margin: 18px 20px 13px 0px;
		font-size:12px;
		color:#FFF;
		font-family: "Museo Sans 500";
	}
.happy_2{
	float: left;
	width: 940px;
	-webkit-border-radius: 5px;   /*元角*/
	-moz-border-radius: 5px;
	-ms-border-radius: 5px;
	border-radius: 5px;
	background-color: #98C509;
	margin-top: 20px;
	background-image: url(http://adoptadoggie.org/images/ha_b2.png);
	background-repeat: no-repeat;
	background-position:bottom left;
	margin-bottom:20px;
	}
.happy_2_2 {
	float: left;
	width: 923px;
	-webkit-border-radius: 5px;   /*元角*/
	-moz-border-radius: 5px;
	-ms-border-radius: 5px;
	border-radius: 5px;
	background-color: #98C509;
	margin-top: 20px;
	background-image: url(http://adoptadoggie.org/images/ha_b2.png);
	background-repeat: no-repeat;
	background-position:bottom left;
	padding-bottom:10px;
	padding-right:16px;
	}
.happy_3{
	float: left;
	width: 940px;
	-webkit-border-radius: 5px;   /*元角*/
	-moz-border-radius: 5px;
	-ms-border-radius: 5px;
	border-radius: 5px;
	background-color: #81B227;
	margin-top: 20px;
	background-image: url(http://adoptadoggie.org/images/ha_b3.png);
	background-repeat: no-repeat;
	background-position:bottom left;
	}
.happy_3_2{
	float: left;
	width: 923px;
	-webkit-border-radius: 5px;   /*元角*/
	-moz-border-radius: 5px;
	-ms-border-radius: 5px;
	border-radius: 5px;
	background-color: #81B227;
	margin-top: 20px;
	background-image: url(http://adoptadoggie.org/images/ha_b3.png);
	background-repeat: no-repeat;
	background-position:bottom left;
	padding-bottom:10px;
	padding-right:16px;
	}
.happy_4{
	width: 960px;
	background-color: #FFF;
	margin:0 auto;
	overflow:auto;/*解決子元素float而父元素高度無法自動撐高的問題*/
	padding: 20px 0 0 20px;
	}
.happy_5{
	width: 960px;
	height:150px;
	margin:0 auto;
	overflow:auto;/*解決子元素float而父元素高度無法自動撐高的問題*/
	background:url(http://adoptadoggie.org/images/happybg.jpg) no-repeat top -2px left 0px #FFF;
	padding: 0 0 0 20px;
	}

/*---------------------- rescue phoebe --------------------------------------*/
.rescue{
	width: 1004px;
	margin:0 auto;
	overflow:auto;/*解決子元素float而父元素高度無法自動撐高的問題*/
	padding: 20px 0 0 20px;
	background:url(http://adoptadoggie.org/images/rescue_bg.png) no-repeat top 0px left 22px;
	}
.rescue_02{
	width: 940px;
	overflow:auto;/*解決子元素float而父元素高度無法自動撐高的問題*/
	margin-left:22px;
	}
.rescue_1{
	float: left;
	width: 940px;
	height: 380px;
	-webkit-border-radius: 15px;   /*元角*/
	border-radius: 15px;
	background-color: #336bb3;
	display: block;
	margin-top: 20px;
	}
.rescue_1_1{
	float: left;
	width: 540px;
	height: 380px;
	}
.rescue_1_2{
	float: left;
	width: 360px;
	height: 250px;
	padding: 20px;
	}
.rescue_1_3{

	}

.rescue_1_3 a {
	float: right;
	width: 200px;
	height: 32px;
	text-align: right;
	background-image: url(http://adoptadoggie.org/images/re_icon1.png);
	background-repeat: no-repeat;
	background-position: left 60px top 0px;
	margin-top:5px;
	padding-top: 5px;
	padding-right: 25px;
	padding-bottom: 5px;
	padding-left: 20px;
	}
.rescue_1_3 a:hover {
	float: right;
	width: 200px;
	height: 32px;
	text-align: right;
	background-image: url(http://adoptadoggie.org/images/re_icon12.png);
	background-repeat: no-repeat;
	background-position: left 60px top 0px;
	margin-top:5px;
	padding-top: 5px;
	padding-right: 25px;
	padding-bottom: 5px;
	padding-left: 20px;
	}
.rescue_1_4{

	}
.rescue_1_4 a {
	float: right;
	width: 200px;
	height: 32px;
	text-align: right;
	background-image: url(http://adoptadoggie.org/images/re_icon2.png);
	background-repeat: no-repeat;
	background-position: left 60px top 0px;
	padding-top: 5px;
	padding-right: 25px;
	padding-bottom: 5px;
	padding-left: 20px;
	}
.rescue_1_4 a:hover {
	float: right;
	width: 200px;
	height: 32px;
	text-align: right;
	background-image: url(http://adoptadoggie.org/images/re_icon22.png);
	background-repeat: no-repeat;
	background-position: left 60px top 0px;
	padding-top: 5px;
	padding-right: 25px;
	padding-bottom: 5px;
	padding-left: 20px;
	}
.rescue_2{
	float: left;
	width: 940px;
	height: 380px;
	display: block;
	margin-top: 20px;
	}
.rescue_2_1{
	float: left;
	width: 500px;
	height:938px;
	display: block;
	margin-top: 30px;
	margin-left: 20px;
	margin-bottom:50px;
	}
.rescue_2_2{
	float: right;
	width: 400px;
	display: block;
	}
.rescue_2_3{
	width: 600px;
	height: 532px;
	position: absolute;
	background-image: url(http://adoptadoggie.org/images/re_p1.png);
	display: block;
	z-index: 998;
	margin-left: 500px;
	margin-top: 1050px;
	}
.rescue_3{/*phoebe*/
	float: left;
	margin-left:20px;
	}
.rescue_3_1{
	float: left;
	}
.rescue_3_1_all{/*phoebe*/
	float: left;
	width: 278px;
	height: 180px;
	margin: 10px 5px 10px 13px;
	}
.rescue_3_1_1{
	float: left;
	width: 278px;
	height: 170px;
	}
.rescue_3_1_2{/*phoebe*/
	float: left;
	width: 278px;
	height: 30px;
	padding-top: 0px;
	font-family: "Myriad Pro";
	font-size: 12px;
	color: #FFF;
	}
.rescue_3_2{
	float: left;
	}
.rescue_3_2_all{
	float: left;
	width: 203px;
	height: 152px;
	margin: 10px 5px 10px 13px;
	background-color: #9dcde4;
	overflow: hidden;
	}

/*---------------------- training phoebe--------------------------------------*/
.training{
	width: 960px;
	background-color: #FFF;
	margin:0 auto;
	overflow:auto;/*解決子元素float而父元素高度無法自動撐高的問題*/
	padding: 20px 0 0 20px;
	background:url(http://adoptadoggie.org/images/trainingbg.png) no-repeat top left #FFF;
	}
.training_1{
	float: left;
	width: 940px;
	height: 380px;
	-webkit-border-radius: 15px;   /*元角*/
	border-radius: 15px;
	background-color: #6C4090;
	display: block;
	margin-top: 20px;
	}
.training_1_1{
	float: left;
	width: 540px;
	height: 380px;
	}
.training_1_2{
	float: left;
	width: 355px;
	height: 173px;
	padding: 20px;
	}
.training_1_3{
	float: right;
	width: 190px;
	height: 20px;
	text-align: right;
	background-repeat: no-repeat;
	margin-right: 15px;
	}
.training_1_4{
	float: right;
	width: 190px;
	height: 20px;
	padding: 20px;
	text-align: right;
	background-image: url(http://adoptadoggie.org/images/re_icon2.png);
	background-repeat: no-repeat;
	margin-left: 150px;
	}
.training_2{
	float: left;
	width: 940px;
	height: 380px;
	display: block;
	margin-top: 20px;
	}
.training_2_1{
	float: left;
	width: 500px;
	height:440px;
	display: block;
	margin-top: 30px;
	margin-left: 20px;
	}
.training_2_2{
	float: right;
	width: 400px;
	display: block;
	margin-right: 20px;
	}
.training_2_3{
	width: 600px;
	height: 532px;
	position: absolute;
	background-image: url(http://adoptadoggie.org/images/re_p1.png);
	display: block;
	z-index: 998;
	margin-left: 500px;
	margin-top: 1050px;
	}
.training_3{
	position: absolute;
	z-index: 1000;
	float: left;
	width: 940px;
	margin-top: 1520px;
	margin-left: 20px;
	}
.training_3_1{
	float: left;
	width: 940px;
	margin-top: 20px;
	}
.training_3_1_all{
	float: left;
	width: 278px;
	height: 230px;
	margin: 10px;
	}
.training_3_1_1{
	float: left;
	width: 278px;
	height: 170px;
	}
.training_3_1_2{
	float: left;
	width: 278px;
	height: 50px;
	padding-top: 40px;
	font-family: "Myriad Pro";
	font-size: 12px;
	color: #FFF;
	}
.training_3_2{
	float: left;
	width: 940px;
	}
.training_3_2_all{
	float: left;
	width: 203px;
	height: 152px;
	margin: 10px;
	background-color: #9dcde4;
	}
.training_4 {
	float: left;
	width: 940px;
	/*height: 189px;*/
	-webkit-border-radius: 5px;   /*元角*/
	-moz-border-radius: 5px;
	-ms-border-radius: 5px;
	border-radius: 5px;
	background-color: #A09ED5;
	background-image: url(http://adoptadoggie.org/images/training_b1.png);
	background-repeat: no-repeat;
	background-position: bottom left;
	margin-bottom:20px;
	}
	.training_4 .movie_block {
		float: left;
		width:223px;
		height:152px;
		margin: 22px 20px 10px 0;
		font-size:12px;
		line-height:21px;
		color:#FFF;
		font-family: "Museo Sans 500";
	}


/*----------------------About--------------------------------------*/
.about{
	width: 982px;
	margin:0 auto;
	overflow:auto;/*解決子元素float而父元素高度無法自動撐高的問題*/
	padding: 20px 0 0 42px;
	background:url(http://adoptadoggie.org/images/about_bg.png) no-repeat bottom 0px right 0px;
	}
.about_02{
	width: 940px;
	margin-left:0px;
	}
.about_1{
	float: left;
	width: 940px;
	background-color: #FFF;
	}
.about_2{
	float: left;
	width: 940px;
	height: 480px;
	background-color: #EFEFEF;
	-webkit-border-radius: 5px;   /*元角*/
	-moz-border-radius: 5px;
	-ms-border-radius: 5px;
	border-radius: 5px;
	}
.about_2_1{
	float: left;
	width: 940px;
	height: 220px;
	background-image: url(http://adoptadoggie.org/images/about_2_1.png);
	background-position:top -20px left 0px;
	display: block;
	background-repeat: no-repeat;
	}
.about_2_2_1{
	font-family: "Museo Sans 500";
	float: left;
	font-size: 13px;
	color: #3975b0;
	width: 192px;
	margin-right: 93px;
	margin-left: 15px;
	}
.about_2_2_2{
	font-family: "Museo Sans 500";
	float: left;
	font-size: 13px;
	color: #3975b0;
	width: 341px;
	margin-right: 69px;
	}
.about_2_2_3{
	font-family: "Museo Sans 500";
	float: left;
	font-size: 13px;
	color: #3975b0;
	width: 213px;


	}
.about_2_3_1{
	font-family: "Museo Sans 500";
	float: left;
	font-size: 13px;
	color: #3975b0;
	width: 175px;
	margin-right: 69px;
	margin-left: 196px;
	margin-top: 30px;

	}
.about_2_3_2{
	font-family: "Museo Sans 500";
	float: left;
	font-size: 13px;
	color: #3975b0;
	width: 192px;
	margin-left: 125px;
	margin-top: 30px;

	}
.about_L{
	float: left;
	width: 517px;
	font-family: "Myriad Pro";
	font-size: 14px;
	line-height: 21px;
	color: #282626;
	}
.about_L2{
	float: left;
	width: 517px;
	font-family: "Myriad Pro";
	font-size: 14px;
	line-height: 21px;
	color: #282626;
	}
.about_LRs{
	float: left;
	width: 497px;
	height: 100px;
	margin-bottom: 20px;
	}
.about_R{
	float: right;
	width: 400px;
	height:auto;
	}
.about_R1{
	float: right;
	width: 400px;
	height: 252px;
	background-color: #E2E2E3;
	overflow: hidden;
	}
.about_R2{
	float: right;
	width: 400px;
	height: 252px;
	background-color: #E2E2E3;
	margin-top: 15px;
	overflow: hidden;
	}
.about_R3{
	float: right;
	width: 400px;
	margin-top: 5px;
	text-align: right;
	}
.about_Ls{
	float: left;
	width: 146px;
	height: 75px;
	background-color: #E2E2E3;
	margin-top: 30px;
	margin-right: 20px;
	overflow: hidden;
	}
.about_Rs{
	float: right;
	width: 330px;
	height: 75px;
	margin-top: 30px;
	}
.about1_bg{/*phoebe*/
	background-image: url(http://adoptadoggie.org/images/abo1.png);
	height: 561px;
	width: 597px;
	margin-top: 1800px;
	position: absolute;
	z-index: 1001;
	margin-left: 450px;
	}
/*---------------------- contact phoebe --------------------------------------*/
.contact{
	width: 960px;
	margin:0 auto;
	overflow:auto;/*解決子元素float而父元素高度無法自動撐高的問題*/
	background:url(http://adoptadoggie.org/images/contactbg.png) no-repeat bottom left #FFF;
	height: 1000px;
	padding-left:20px;
	padding-top:20px;
	}
.contact_1{
	float: left;
	width: 940px;
	height: 380px;
	-webkit-border-radius: 15px;   /*元角*/
	border-radius: 15px;
	background-color: #F55000;
	display: block;
	margin-top: 20px;
	}
.contact_1_1{
	float: left;
	width: 540px;
	height: 380px;
	}
.contact_1_2{
	float: left;
	width: 355px;
	height: 200px;
	padding: 20px;
	}
.contact_1_3{
	float: right;
	width: 190px;
	height: 20px;
	padding: 20px;
	text-align: right;
	background-image: url(http://adoptadoggie.org/images/re_icon1.png);
	background-repeat: no-repeat;
	margin-left: 150px;
	}
.contact_1_4{
	float: right;
	width: 190px;
	height: 20px;
	padding: 20px;
	text-align: right;
	background-image: url(http://adoptadoggie.org/images/re_icon2.png);
	background-repeat: no-repeat;
	margin-left: 150px;
	}
.contact_2{
	float: left;
	width: 940px;
	height: 380px;
	display: block;
	margin-top: 20px;
	}
.contact_2_1{
	float: left;
	width: 500px;
	display: block;
	margin-top: 20px;
	margin-left: 20px;
	}
.contact_2_1_b{
	float: left;
	width: 800px;
	display: block;
	margin-top: 20px;
	margin-left: 20px;
	}
.contact_2_2{
	float: right;
	width: 400px;
	display: block;
	margin-top: 20px;
	}
.contact_2_3{
	width: 600px;
	height: 532px;
	position: absolute;
	background-image: url(http://adoptadoggie.org/images/re_p1.png);
	display: block;
	z-index: 998;
	margin-left: 500px;
	margin-top: 1050px;
	}
.contact_3{
	position: absolute;
	z-index: 1000;
	float: left;
	width: 940px;
	margin-top: 1520px;
	margin-left: 20px;
	}
.contact_3_1{
	float: left;
	width: 940px;
	margin-top: 20px;
	}
.contact_3_1_all{/*phoebe*/
	float: left;
	width: 278px;
	height: 180px;
	margin: 10px;
	}
.contact_3_1_1{
	float: left;
	width: 278px;
	height: 170px;
	}
.contact_3_1_2{/*phoebe*/
	float: left;
	width: 278px;
	height: 30px;
	padding-top: 0px;
	font-family: "Myriad Pro";
	font-size: 12px;
	color: #FFF;
	}
.contact_3_2{
	float: left;
	width: 940px;
	}
.contact_3_2_all{
	float: left;
	width: 203px;
	height: 152px;
	margin: 10px;
	background-color: #9dcde4;
	}


/*---------------------- donate--------------------------------------*/
.donate{
	width: 982px;
	height:1536px;
	margin:0 auto;
	overflow:auto;/*解決子元素float而父元素高度無法自動撐高的問題*/
	padding: 20px 0 0 42px;
	background:url(http://adoptadoggie.org/images/donate_bg.png) no-repeat bottom right;
	}
.donate_bg{
	background-image: url(http://adoptadoggie.org/images/donate_bg.png);
	display: block;
	height: 330px;
	width: 725px;
	margin-top: 1171px;
	margin-left: 310px;
	position: absolute;
	z-index: 1010;

	}
.donate_1{
	float: left;
	width: 940px;
	height: 380px;
	-webkit-border-radius: 15px;   /*元角*/
	border-radius: 15px;
	background-color: #ff8f1b;
	display: block;
	margin-top: 20px;
	}
.donate_1_1{
	float: left;
	width: 540px;
	height: 380px;
	}
.donate_1_2{
	float: left;
	width: 355px;
	height: 170px;
	padding: 20px;
	}
.donate_1_3{
	float: right;
	width: 190px;
	height: 20px;
	text-align: right;
	background-repeat: no-repeat;
	margin-right: 15px;
	}
.donate_1_4{
	float: right;
	width: 190px;
	height: 20px;
	padding: 20px;
	text-align: right;
	background-image: url(http://adoptadoggie.org/images/re_icon2.png);
	background-repeat: no-repeat;
	margin-left: 150px;
	}
.donate_2{
	float: left;
	width: 940px;
	height: 380px;
	display: block;
	margin-top: 20px;
	}
.donate_2_1{
	float: left;
	width: 500px;
	display: block;
	margin-top: 20px;
	margin-left: 20px;
	}
.donate_2_1_1{
	width: 100%;
	display: block;
	margin-top: 20px;
	border-bottom:1px #FF8F1B solid;
	color:#FF8F1B;
	font-family: "Museo Sans 500";
	font-weight: bolder;
	font-size:30px;
	letter-spacing:-1px;
	}
.donate_3_1{
	float: left;
	width: 400px;
	display: block;
	margin-top: 20px;
	margin-left:20px;
	}
.donate_3_1_1{
	width: 100%;
	display: block;
	margin-top: 92px;
	border-bottom:1px #FF8F1B solid;
	color:#FF8F1B;
	font-family: "Museo Sans 500";
	font-weight: bolder;
	font-size:30px;
	letter-spacing:-1px;
	}


/*--------------------其他文字開始-----------------------*/
.t1{/*phoebe*/
	font-size: 14px;
	color: #333333;
	text-align: justify;
	line-height: 21px;
	font-family: "Museo Sans 500";
	font-weight: bold;
	}
.t2{
	font-size: 17px;
	color: #00aba6;
	text-align: justify;
	line-height: 35px;
	font-family: "Museo Sans 500";
	font-weight: bolder;
	}
.m1{
	font-family: "Myriad Pro";
	font-size: 13px;
	line-height: 21px;
	color: #282626;
	}
.m1 a {
	font-family: "Myriad Pro";
	font-size: 13px;
	line-height: 21px;
	color: #44A6D0;
	}
.m2{
	font-family: "Myriad Pro";
	font-size: 13px;
	line-height: 15px;
	color: #282626;
	}
.m3{
	font-family: "Myriad Pro";
	font-size: 15px;
	line-height: 20px;
	color: #282626;
	}
.f1{
	height: 20px;
	width: 250px;
	border: 1px solid #ec5700;
	}
.f2{
	width: 500px;
	border: 1px solid #ec5700;
	}
.f3{
	height: 20px;
	width: 50px;
	border: 1px solid #ec5700;
	}
.b1 {/*phoebe*/
	font-size: 16px;
	color: #e95372;
	text-align: justify;
	font-family: "Museo Sans 500";
	font-weight: bolder;
	text-decoration:none;
	}
.b2 {/*phoebe*/
	font-size: 16px;
	color: #3891b5;
	text-align: justify;
	font-family: "Museo Sans 500";
	font-weight: bolder;
	text-decoration:none;
	}
.b1_2 {/*phoebe*/
	font-size: 16px;
	color: #00A43C;
	text-align: justify;
	font-family: "Museo Sans 500";
	font-weight: bolder;
	text-decoration:none;
	}
.b1_2 a {/*phoebe*/
	font-size: 16px;
	color: #E84693;
	text-align: justify;
	font-family: "Museo Sans 500";
	font-weight: bolder;
	text-decoration:none;
	}
.b1_2 a:hover {/*phoebe*/
	font-size: 16px;
	color: #E84693;
	text-align: justify;
	font-family: "Museo Sans 500";
	font-weight: bolder;
	text-decoration:none;
	}
.b1 a{/*phoebe*/
	font-size: 16px;
	color: #e95372;
	text-align: justify;
	font-family: "Museo Sans 500";
	font-weight: bolder;
	text-decoration:none;
	}
.b2 a{/*phoebe*/
	font-size: 16px;
	color: #3891b5;
	text-align: justify;
	font-family: "Museo Sans 500";
	font-weight: bolder;
	text-decoration:none;
	}
.b3 a{
	font-size: 16px;
	color: #FFFFFF;
	text-align: center;
	font-family: "Museo Sans 500";
	background-color: #ff682c;
	height: 25px;
	width: 80px;
	display: block;
	-webkit-border-radius: 5px;
	-mos-border-radius: 5px;
	-ms-border-radius: 5px;
	border-radius: 5px;
	line-height: 25px;
	text-decoration: none;
	}
.b3 a:hover{
	font-size: 16px;
	color: #FFFFFF;
	text-align: center;
	font-family: "Museo Sans 500";
	background-color: #3995d9;
	height: 25px;
	width: 80px;
	display: block;
	-webkit-border-radius: 5px;
	-mos-border-radius: 5px;
	-ms-border-radius: 5px;
	border-radius: 5px;
	line-height: 25px;
	text-decoration: none;
	}
.t1_ws{
	font-size: 12px;
	color: #FFFFFF;
	text-align: justify;
	line-height: 16px;
	font-family: "Museo Sans 500";
	font-weight: lighter;
}
.pro_title{
	font-size: 19px;
	font-weight: bolder;
	color: #13A4A0;
	line-height: 30px;
	font-family: "Myriad Pro";
}

.pro_title_2{
 font-size: 25px;
 font-weight: bolder;
 color: #13A4A0;
 line-height: 30px;
 font-family: "Myriad Pro";
}

.pro_main{
	font-size: 14px;
	color: #333333;
	text-align: justify;
	line-height: 20px;
	font-family: "Myriad Pro";
}
.pro_main_02 {
	font-size: 14px;
	color: #333333;
	text-align: justify;
	line-height: 32px;
	font-family: "Myriad Pro";
}
.pro_main_g {
	font-size: 14px;
	color: #138099;
	font-weight: bold;
	font-family: "Myriad Pro";
	text-decoration:none;
	text-align:left;
	line-height:21px;
}
.pro_main_g a{
	font-size: 14px;
	color: #138099;
	font-weight: bold;
	font-family: "Myriad Pro";
	text-decoration:none;
	text-align:left;
}
.pro_main_g a:hover{
	font-size: 14px;
	color: #FF682C;
	font-weight: bold;
	font-family: "Myriad Pro";
	text-align:left;
}
.pro_main_g2{
	font-size: 14px;
	color: #317939;
	font-weight: bold;
	font-family: "Myriad Pro";
	line-height: 21px;
}
.pro_main_g3{
	font-size: 14px;
	color: #1a9c3c;
	font-weight: bold;
	font-family: "Myriad Pro";
}
.pro_main_s{/*phoebe*/
	font-size: 13px;
	color: #333333;
	font-family: "Myriad Pro";
	text-align:left;
	line-height: 21px;
}
.pro_main_s a:hover{/*phoebe*/
	color: #E84693;
	text-decoration:none;
}
.pro_main_s2{/*phoebe*/
	font-size: 13px;
	color: #333333;
	font-family: "Myriad Pro";
	text-align: center;
	line-height: 21px;
}
.re_main{/*phoebe*/
	font-size: 14px;
	color: #333333;
	text-align: justify;
	line-height: 21px;
	font-family: "Myriad Pro";
}
.re_main_b{/*phoebe*/
	font-size: 14px;
	color: #333333;
	text-align: justify;
	line-height: 21px;
	font-family: "Myriad Pro";
}
.re_main_b a{/*phoebe*/
	font-size: 14px;
	color: #8BBB26;
	text-align: justify;
	line-height: 22px;
	font-family: "Myriad Pro";
	text-decoration:none;
}
.re_main2{
	font-size: 14px;
	color: #333333;
	line-height: 32px;
	font-family: "Myriad Pro";
}
.re_main3{
	font-size: 12px;
	color: #333333;
	line-height: 20px;
	font-style: italic;
	font-family: "Myriad Pro";
}
.re_main4{
	font-family: "Myriad Pro";
	font-size: 12px;
	color: #333333;
	line-height: 25px;
}
.re_main4_btn a{/*nico*/
	font-family: "Myriad Pro";
	font-weight: bolder;
	font-size: 14px;
	color: #FFF;
	background-color: #A7CA01;
	padding: 7px 20px 2px;
	text-decoration: none;
	-webkit-border-radius: 2px;   /*元角*/
	-moz-border-radius: 2px;
	-ms-border-radius: 2px;
	border-radius: 2px;
}
.re_main4_btn a:hover{/*nico*/
	font-family: "Myriad Pro";
	font-weight: bolder;
	font-size: 14px;
	color: #d5e044;
	background-color: #e84693;
	padding: 7px 20px 2px 20px;
	-webkit-border-radius: 2px;   /*元角*/
	-moz-border-radius: 2px;
	-ms-border-radius: 2px;
	border-radius: 2px;
}
.re_main5{/*nico*/
	font-size: 14px;
	color: #447db4;
	text-align: justify;
	line-height: 21px;
	font-family: "Myriad Pro";
}
.re_main5_r{/*nico*/
	font-size: 14px;
	color: #b45e62;
	text-align: justify;
	line-height: 21px;
	font-family: "Myriad Pro";
}
.re_main6_btn a{/*nico*/
	font-family: "Myriad Pro";
	font-weight: bolder;
	font-size: 14px;
	color: #d5e044;
	background-color: #e84693;
	padding: 7px 20px 2px;
	text-decoration: none;
	-webkit-border-radius: 2px;   /*元角*/
	-moz-border-radius: 2px;
	-ms-border-radius: 2px;
	border-radius: 2px;
}
.re_main6_btn a:hover{/*nico*/
	font-family: "Myriad Pro";
	font-weight: bolder;
	font-size: 14px;
	color: #FFF;
	background-color: #A7CA01;
	padding: 7px 20px 2px 20px;
	-webkit-border-radius: 2px;   /*元角*/
	-moz-border-radius: 2px;
	-ms-border-radius: 2px;
	border-radius: 2px;
}
.re_main2 a{
	font-size: 14px;
	color: #86b32d;
	line-height: 20px;
	font-weight: bold;
	text-decoration: none;
	font-family: "Myriad Pro";
}
.center1{
	font-family: "Myriad Pro";
	font-size: 13px;
	font-weight: lighter;
	color: #3e3a39;
	}
.center2{
	font-family: "Myriad Pro";
	font-size: 13px;
	font-weight: lighter;
	color: #e74689;
	font-style: italic;
	}
.in_title1{
	font-family: "Helvetica Neue";
	font-size: 22px;
	font-weight: 400;
	color: #FFFFFF;
	line-height: 35px;
	background-image: url(http://adoptadoggie.org/images/in_1.png);
	background-repeat: no-repeat;
	padding-left: 30px;
	}
.in_title2{
	font-family: "Helvetica Neue";
	font-size: 22px;
	font-weight: 400;
	color: #FFFFFF;
	line-height: 35px;
	background-image: url(http://adoptadoggie.org/images/in_2.png);
	background-repeat: no-repeat;
	padding-left: 30px;
	}
.in_title3{
	font-family: "Helvetica Neue";
	font-size: 22px;
	font-weight: 400;
	color: #FFFFFF;
	line-height: 35px;
	background-image: url(http://adoptadoggie.org/images/in_3.png);
	background-repeat: no-repeat;
	padding-left: 30px;
	}
.in_title4{
	font-family: "Helvetica Neue";
	font-size: 22px;
	font-weight: 400;
	color: #FFFFFF;
	line-height: 35px;
	background-image: url(http://adoptadoggie.org/images/in_4.png);
	background-repeat: no-repeat;
	padding-left: 30px;
	}
.in_title5{
	font-family: "Helvetica Neue";
	font-size: 22px;
	font-weight: 400;
	color: #A0C11C;
	line-height: 35px;
	}
.ce_title1{
	font-family: "Helvetica Neue";
	font-size: 26px;
	font-weight: 400;
	color: #e84693;
	line-height: 35px;
	}
.ce_title2{
	font-family: "Helvetica Neue";
	font-size: 30px;
	font-weight: 400;
	color: #39b568;
	line-height: 35px;
	padding-left: 26px;
	padding-bottom: 40px;
	}
.ce_title3{
	font-family: "Helvetica Neue";
	font-size: 30px;
	font-weight: 400;
	color: #2f6399;
	line-height: 35px;
	padding-left: 26px;
	padding-bottom: 40px;
	}
.ce_title4{
	font-family: "Helvetica Neue";
	font-size: 20px;
	color: #a2d4ff;
	line-height: 25px;
	}
.ce_title5{
	font-family: "Helvetica Neue";
	font-size: 20px;
	font-weight: 400;
	color: #ff427e;
	line-height: 25px;
	}
.ce_title5 a {/*phoebe*/
	font-family: "Helvetica Neue";
	font-size: 20px;
	font-weight: 400;
	color: #ff427e;
	line-height: 20px;
	text-decoration:none;
	}
.ce_title5 a:hover {/*phoebe*/
	font-family: "Helvetica Neue";
	font-size: 20px;
	font-weight: 400;
	color: #A2D4FF;
	line-height: 20px;
	text-decoration:none;
	}
.ce_title6{
	font-family: "Helvetica Neue";
	font-size: 30px;
	font-weight: 400;
	color: #ff427e;
	line-height: 25px;
	}
.ce_title6-{
	font-family: "Helvetica Neue";
	font-size: 25px;
	font-weight: 400;
	color: #ff427e;
	line-height: 35px;
	}
.ce_title7{
	font-family: "Helvetica Neue";
	font-size: 30px;
	font-weight: 400;
	color: #0081c8;
	line-height: 25px;
	z-index: 500;
	position: absolute;
	margin-left:20px;
	}

.ce_title14{
	font-family: "Helvetica Neue";
	font-size: 30px;
	font-weight: 400;
	color: #E6535F;
	line-height: 35px;
	padding-left: 26px;
	padding-bottom: 20px;
	}
.ce_title14-{
	font-family: "Helvetica Neue";
	font-size: 30px;
	font-weight: 400;
	color: #E6535F;
	line-height: 25px;
	padding-bottom: 20px;
	margin-top:66px;
	}
.ce_title14-2{
	font-family: "Helvetica Neue";
	font-size: 30px;
	font-weight: 400;
	color: #E6535F;
	line-height: 25px;
	padding-bottom: 20px;
	padding-top: 20px;
	}
.ce_title14-3{
	font-family: "Helvetica Neue";
	font-size: 20px;
	font-weight: 400;
	color: #FF7979;
	line-height: 25px;
	padding-bottom: 5px;
	}
.ce_title14-4{
	font-family: "Helvetica Neue";
	font-size: 20px;
	font-weight: 400;
	color: #44A6D0;
	line-height: 25px;
	padding-bottom: 5px;
	}
.ce_title13{
	font-family: "Helvetica Neue";
	font-size: 26px;
	font-weight: 400;
	color: #44A6D0;
	line-height: 25px;
	padding-top: 20px;
	padding-bottom: 5px;
	}
.ce_title13-{
	font-family: "Helvetica Neue";
	font-size: 20px;
	font-weight: 400;
	color: #44A6D0;
	line-height: 25px;
	padding-bottom: 5px;
	}
.ce_title8{/*training phoebe*/
	font-family: "Helvetica Neue";
	font-size: 30px;
	font-weight: 400;
	color: #8156C2;
	line-height: 35px;
	padding-left: 26px;
	padding-bottom: 40px;
	}
.ce_title9{/*training phoebe*/
	font-family: "Helvetica Neue";
	font-size: 20px;
	font-weight: 400;
	color: #CABFF0;
	line-height: 25px;
	}
.ce_title10{/*training phoebe*/
	color: #8156C2;
	font-family: 'Helvetica Neue';
	font-size: 30px;
	width:200px;
	}
.ce_title11{/*phoebe*/
	font-family: "Helvetica Neue";
	font-size: 30px;
	font-weight: 400;
	color: #FF611B;
	line-height: 35px;
	padding-left: 26px;
	padding-bottom: 40px;
	}
.ce_title12{/*phoebe*/
	font-family: "Helvetica Neue";
	font-size: 20px;
	font-weight: 400;
	color: #fff;
	line-height: 25px;
	}
.ce_title15{
	font-family: "Helvetica Neue";
	font-size: 30px;
	font-weight: 400;
	color: #ff8900;
	line-height: 35px;
	padding-left: 26px;
	padding-bottom: 40px;;
	}
.ce_title16{
	font-family: "Helvetica Neue";
	font-size: 30px;
	font-weight: 400;
	color: #d5e044;
	line-height: 35px;
	padding-left: 0px;
	padding-bottom: 40px;
	}
.ce_title17{
	font-family: "Helvetica Neue";
	font-size: 25px;
	font-weight: 400;
	color: #d5e044;
	line-height: 35px;
	padding-left: 0px;
	padding-bottom: 40px;
	}
.in_btn a{/*phoebe*/
	font-family: "Myriad Pro";
	font-size: 10px;
	color: #FFFFFF;
	background-color: #a7ca01;
	-webkit-border-radius: 5px;   /*元角*/
	padding-top: 5px;
	padding-right: 13px;
	padding-bottom: 5px;
	padding-left: 13px;
	font-weight: bolder;
	text-decoration:none;
	}
.in_btn a:hover{
	font-family: "Myriad Pro";
	font-size: 10px;
	color: #d5e044;
	background-color: #e84693;
	-webkit-border-radius: 5px;   /*元角*/
	padding-top: 5px;
	padding-right: 13px;
	padding-bottom: 5px;
	padding-left: 13px;
	font-weight: bolder;
	}
.in_btn2 a{
	font-family: "Myriad Pro";
	font-size: 12px;
	color: #A7CA01;
	font-weight: bolder;
	}
.in_btn2 a:hover{
	font-family: "Myriad Pro";
	font-size: 12px;
	color: #E6535F;
	font-weight: bolder;
	}

.in_btn3 a{/*phoebe*/
	font-family: "Myriad Pro";
	font-weight: bolder;
	font-size: 14px;
	color: #FFFFFF;
	background-color: #a7ca01;
	padding: 7px 20px 2px 20px;
	text-decoration:none;
	-webkit-border-radius: 2px;   /*元角*/
	-moz-border-radius: 2px;
	-ms-border-radius: 2px;
	border-radius: 2px;
	}
.in_btn3 a:hover{
	font-family: "Myriad Pro";
	font-weight: bolder;
	font-size: 14px;
	color: #d5e044;
	background-color: #e84693;
	padding: 7px 20px 2px 20px;
	-webkit-border-radius: 2px;   /*元角*/
	-moz-border-radius: 2px;
	-ms-border-radius: 2px;
	border-radius: 2px;
	}
.in_btn4 a{/*phoebe*/
 font-family: "Myriad Pro";
 font-weight: bolder;
 font-size: 16px;
 color: #000;
 background-color: #a7ca01;
 padding: 10px 45px 4px 45px;
 text-decoration:none;
 -webkit-border-radius: 3px;   /*元角*/
 -moz-border-radius: 3px;
 -ms-border-radius: 3px;
 border-radius: 3px;
 }
.in_btn4 a:hover{
	font-family: "Myriad Pro";
	font-weight: bolder;
	font-size: 16px;
	color: #d5e044;
	background-color: #e84693;
	padding: 10px 45px 3px 45px;
	-webkit-border-radius: 3px;   /*元角*/
	-moz-border-radius: 3px;
	-ms-border-radius: 3px;
	border-radius: 3px;
	}
.in_btn5 a{/*phoebe*/
	font-family: "Myriad Pro";
	font-weight: bolder;
	font-size: 13px;
	color: #000;
	background-color: #a7ca01;
	text-decoration: none;
	-webkit-border-radius: 3px;   /*元角*/
	-moz-border-radius: 3px;
	-ms-border-radius: 3px;
	border-radius: 3px;
	padding-top: 9px;
	padding-right: 6px;
	padding-bottom: 7px;
	padding-left: 9px;
	line-height: 15px;
 }
.in_btn5 a:hover{
 font-family: "Myriad Pro";
 font-weight: bolder;
 font-size: 13px;
 color: #d5e044;
 background-color: #e84693;
 -webkit-border-radius: 3px;   /*元角*/
 -moz-border-radius: 3px;
 -ms-border-radius: 3px;
 border-radius: 3px;
 padding-top: 9px;
 padding-right: 6px;
 padding-bottom: 7px;
 padding-left: 9px;
 }

.in_btn_app1 a{/*nico*/
	font-family: "Myriad Pro";
	font-weight: bolder;
	font-size: 17px;
	color: #000;
	text-decoration: none;
	background-image: url(http://adoptadoggie.org/images/btn_app_bg.jpg);
	height: 39px;
	width: 145px;
	display: block;
	margin-top: 5px;
	line-height: 35px;
	text-align: center;
 }
.in_btn_app1 a:hover{/*nico*/
 font-family: "Myriad Pro";
 font-weight: bolder;
 font-size: 17px;
 color: #d5e044;
 background-image: url(http://adoptadoggie.org/images/btn_app_bg2.jpg);
 }

.in_btn_app2 a{/*nico*/
	font-family: "Myriad Pro";
	font-weight: bolder;
	font-size: 13px;
	color: #000;
	text-decoration: none;
	background-image: url(http://adoptadoggie.org/images/btn_app_bg3.jpg);
	height: 39px;
	width: 145px;
	display: block;
	margin-bottom: 8px;
	margin-top: 5px;
	line-height: 35px;
	text-align: center;
 }
.in_btn_app2 a:hover{/*nico*/
 font-family: "Myriad Pro";
 font-weight: bolder;
 font-size: 13px;
 color: #d5e044;
 background-image: url(http://adoptadoggie.org/images/btn_app_bg2.jpg);
 }


/*--------------------其他文字結束-----------------------*/


/*-----------------------------變色核取方塊-----------------------------*/
input[type=radio].css-checkbox {
							display:none;
						}

						input[type=radio].css-checkbox + label.css-label {
							padding-left:20px;
							height:15px;
							display:inline-block;
							line-height:15px;
							background-repeat:no-repeat;
							background-position: 0 0;
							font-size:10px;
							vertical-align:middle;
							cursor:pointer;

						}

						input[type=radio].css-checkbox:checked + label.css-label {
							background-position: 0 -15px;
						}
						label.css-label {
							background-image:url(http://adoptadoggie.org/images/oo.png);
							-webkit-touch-callout: none;
							-webkit-user-select: none;
							-khtml-user-select: none;
							-moz-user-select: none;
							-ms-user-select: none;
							user-select: none;
						}



						input[type=radio].css-checkbox + label.css-label2 {
							padding-left:20px;
							height:15px;
							display:inline-block;
							line-height:15px;
							background-repeat:no-repeat;
							background-position: 0 0;
							font-size:10px;
							vertical-align:middle;
							cursor:pointer;

						}

						input[type=radio].css-checkbox:checked + label.css-label2 {
							background-position: 0 -15px;
						}
						label.css-label2 {
							background-image:url(http://adoptadoggie.org/images/oo2.png);
							-webkit-touch-callout: none;
							-webkit-user-select: none;
							-khtml-user-select: none;
							-moz-user-select: none;
							-ms-user-select: none;
							user-select: none;
						}



						input[type=radio].css-checkbox + label.css-label3 {
							padding-left:20px;
							height:15px;
							display:inline-block;
							line-height:15px;
							background-repeat:no-repeat;
							background-position: 0 0;
							font-size:10px;
							vertical-align:middle;
							cursor:pointer;

						}

						input[type=radio].css-checkbox:checked + label.css-label3 {
							background-position: 0 -15px;
						}
						label.css-label3 {
							background-image:url(http://adoptadoggie.org/images/oo3.png);
							-webkit-touch-callout: none;
							-webkit-user-select: none;
							-khtml-user-select: none;
							-moz-user-select: none;
							-ms-user-select: none;
							user-select: none;
						}

.checkbox{
 font-family: "Myriad Pro";
 font-size: 12px;
 color: #333333;
 line-height: 14px;
}

@charset "UTF-8";
/* CSS Document */
/*----------------------上面選單內頁--------------------------------------*/
.center_btn1{
	width: 980px;
	background:#666;
	}
.fb{
	float: right;
	width:26px;
	height:26px;
	margin: 10px 10px 0 0;
	}

.center_btn2{
	height: 161px;
	width: 980px;
	float: left;
	background-image: url(http://adoptadoggie.org/images/center_btn2.png);
	}
.center_btn3{
	height: 161px;
	width: 980px;
	float: left;
	background-image: url(http://adoptadoggie.org/images/center_btn3.png);
	}
.center_btn4{/*phoebe*/
	height: 161px;
	width: 980px;
	float: left;
	background-image: url(http://adoptadoggie.org/images/center_btn4.png);
	}
.center_btn6{/*phoebe*/
	height: 161px;
	width: 980px;
	float: left;
	background-image: url(http://adoptadoggie.org/images/center_btn6.png);
	}
.center_btn_L{
	height: 161px;
	width: 149px;
	float: left;
	margin-right: 80px;
	margin-left: 20px;
	}
.center_btn_R{/*phoebe*/
	height: 40px;
	width: 730px;
	float: left;
	margin-top: 78px;
	}
.center_btn_R2{/*phoebe*/
	height: 40px;
	width: 730px;
	float: left;
	margin-top: 79px;
	}
.center_btn_Rindex{/*phoebe*/
	height: 40px;
	width: 730px;
	float: left;
	margin-top: 78px;
	}
.center_btn_RL{/*phoebe*/
	height: 161px;
	width: 2px;
	background:#FF9;
	}
.topbtn_allmenu{

	}
.megamenu{

	}
.megamenu li{
	margin-right: 5px;

	}
.top_btn_s_menu{/*phoebe*/
	position: absolute;
	background-color: #e6535f;
	height: 128px;
	width: 281px;
	float: left;
	z-index: 998;
	margin-left: 5px;
	padding-left:3px;
	-webkit-border-radius: 5px;   /*元角*/
	-moz-border-radius: 5px;
	-ms-border-radius: 5px;
	border-radius: 5px;
	}
.top_btn_s_menu_btn{/*phoebe*/
	width: 150px;
	float: left;
	padding-top: 10px;
	padding-bottom:10px;
	}
.top_btn_s_menu_pic{/*phoebe*/
	width: 110px;
	float: right;
	margin: 15px 10px 10px 10px;
	}
.nav-hr{

	}
.subnav-item{

	}
.subnav-content{

	}
.col1 column{

	}


/*-------------------- 上面選單文字 phoebe -----------------------*/
.top_btn_01{
	font-family: "Museo Sans 500";
	font-size: 15px;
	font-weight: 500;
	color: #3e3a39;
	}

.top_btn_01 a{
	font-family: "Museo Sans 500";
	font-size: 15px;
	font-weight: 500;
	color: #3e3a39;
	padding: 3px 10px;
	text-decoration:none;
	}

.top_btn_01 a:hover{
	font-family: "Museo Sans 500";
	font-size: 15px;
	font-weight: 500;
	color: #FFFFFF;
	-webkit-border-radius: 5px;   /*元角*/
	-moz-border-radius: 5px;
	-ms-border-radius: 5px;
	border-radius: 5px;
	background-color: #9AC700;
	padding: 3px 10px;
	}
.top_btn_02{
	font-family: "Museo Sans 500";
	font-size: 15px;
	font-weight: 500;
	color: #3e3a39;
	}

.top_btn_02 a{
	font-family: "Museo Sans 500";
	font-size: 15px;
	font-weight: 500;
	color: #3e3a39;
	padding: 3px 10px;
	text-decoration:none;
	}

.top_btn_02 a:hover{
	font-family: "Museo Sans 500";
	font-size: 15px;
	font-weight: 500;
	color: #FFFFFF;
	-webkit-border-radius: 5px;   /*元角*/
	-moz-border-radius: 5px;
	-ms-border-radius: 5px;
	border-radius: 5px;
	background-color: #39B568;
	padding: 3px 10px;
	}
.center_btn7{
	height: 161px;
	width: 980px;
	float: left;
	background-image: url(http://adoptadoggie.org/images/center_btn7.png);
	}
.top_btn_03{
	font-family: "Museo Sans 500";
	font-size: 15px;
	font-weight: 500;
	color: #3e3a39;
	}

.top_btn_03 a{
	font-family: "Museo Sans 500";
	font-size: 15px;
	font-weight: 500;
	color: #3e3a39;
	padding: 3px 10px;
	text-decoration:none;
	}

.top_btn_03 a:hover{
	font-family: "Museo Sans 500";
	font-size: 15px;
	font-weight: 500;
	color: #FFFFFF;
	-webkit-border-radius: 5px;   /*元角*/
	-moz-border-radius: 5px;
	-ms-border-radius: 5px;
	border-radius: 5px;
	background-color: #336BB3;
	padding: 3px 10px;
	}
.top_btn_04{
	font-family: "Museo Sans 500";
	font-size: 15px;
	font-weight: 500;
	color: #3e3a39;
	}

.top_btn_04 a{
	font-family: "Museo Sans 500";
	font-size: 15px;
	font-weight: 500;
	color: #3e3a39;
	padding: 3px 10px;
	text-decoration:none;
	}

.top_btn_04 a:hover{
	font-family: "Museo Sans 500";
	font-size: 15px;
	font-weight: 500;
	color: #FFFFFF;
	-webkit-border-radius: 5px;   /*元角*/
	-moz-border-radius: 5px;
	-ms-border-radius: 5px;
	border-radius: 5px;
	background-color: #8156C2;
	padding: 3px 10px;
	}
.top_btn_05{
	font-family: "Museo Sans 500";
	font-size: 15px;
	font-weight: 500;
	color: #3e3a39;
	}

.top_btn_05 a{
	font-family: "Museo Sans 500";
	font-size: 15px;
	font-weight: 500;
	color: #3e3a39;
	padding: 3px 10px;
	text-decoration:none;
	}

.top_btn_05 a:hover{
	font-family: "Museo Sans 500";
	font-size: 15px;
	font-weight: 500;
	color: #FFFFFF;
	-webkit-border-radius: 5px;   /*元角*/
	-moz-border-radius: 5px;
	-ms-border-radius: 5px;
	border-radius: 5px;
	background-color: #E6535F;
	padding: 3px 10px;
	}
.top_btn_06{
	font-family: "Museo Sans 500";
	font-size: 15px;
	font-weight: 500;
	color: #3e3a39;
	}

.top_btn_06 a{
	font-family: "Museo Sans 500";
	font-size: 15px;
	font-weight: 500;
	color: #3e3a39;
	padding: 3px 10px;
	text-decoration:none;
	}

.top_btn_06 a:hover{
	font-family: "Museo Sans 500";
	font-size: 15px;
	font-weight: 500;
	color: #FFFFFF;
	-webkit-border-radius: 5px;   /*元角*/
	-moz-border-radius: 5px;
	-ms-border-radius: 5px;
	border-radius: 5px;
	background-color: #FF611B;
	padding: 3px 10px;
	}
.top_btn_07{
	font-family: "Museo Sans 500";
	font-size: 15px;
	font-weight: 500;
	color: #3e3a39;
	}

.top_btn_07 a{
	font-family: "Museo Sans 500";
	font-size: 15px;
	font-weight: 500;
	color: #3e3a39;
	padding: 3px 10px;
	text-decoration:none;
	}

.top_btn_07 a:hover{
	font-family: "Museo Sans 500";
	font-size: 15px;
	font-weight: 500;
	color: #FFFFFF;
	-webkit-border-radius: 5px;   /*元角*/
	-moz-border-radius: 5px;
	-ms-border-radius: 5px;
	border-radius: 5px;
	background-color: #FF8F1B;
	padding: 3px 10px;
	}
.top_btn_08{
	font-family: "Museo Sans 500";
	font-size: 15px;
	font-weight: 500;
	/*color: #3e3a39;*/
	color:#CCC;
	}

.top_btn_08 a{
	font-family: "Museo Sans 500";
	font-size: 15px;
	font-weight: 500;
	/*color: #3e3a39;*/
	color:#CCC;
	padding: 3px 10px;
	text-decoration:none;
	}

.top_btn_08 a:hover{
	font-family: "Museo Sans 500";
	font-size: 15px;
	font-weight: 500;
	/*color: #FFFFFF;*/
	color:#CCC;
	/*
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	-ms-border-radius: 5px;
	border-radius: 5px;
	background-color: #F36;
	*/
	padding: 3px 10px;
	}

.a_select {/*phoebe*/
	font-family: "Museo Sans 500";
	font-size: 15px;
	font-weight: 500;
	color: #FFFFFF;
	-webkit-border-radius: 5px;   /*元角*/
	-moz-border-radius: 5px;
	-ms-border-radius: 5px;
	border-radius: 5px;
	background-color: #9AC700;
	padding: 3px 10px;
	}
.a_select a {/*phoebe*/
	color: #FFFFFF;
	text-decoration:none;
	}
.b_select {
	font-family: "Museo Sans 500";
	font-size: 15px;
	font-weight: 500;
	color: #FFFFFF;
	-webkit-border-radius: 5px;   /*元角*/
	-moz-border-radius: 5px;
	-ms-border-radius: 5px;
	border-radius: 5px;
	background-color: #39b568;
	padding: 3px 10px;
	}
.b_select a {/*phoebe*/
	color: #FFFFFF;
	text-decoration:none;
	}
.c_select {
	font-family: "Museo Sans 500";
	font-size: 15px;
	font-weight: 500;
	color: #FFFFFF;
	-webkit-border-radius: 5px;   /*元角*/
	-moz-border-radius: 5px;
	-ms-border-radius: 5px;
	border-radius: 5px;
	background-color: #336bb3;
	padding: 3px 10px;
	}
.c_select a {/*phoebe*/
	color: #FFFFFF;
	text-decoration:none;
	}
.d_select {/*phoebe*/
	font-family: "Museo Sans 500";
	font-size: 15px;
	font-weight: 500;
	color: #FFFFFF;
	-webkit-border-radius: 5px;   /*元角*/
	-moz-border-radius: 5px;
	-ms-border-radius: 5px;
	border-radius: 5px;
	background-color: #8156C2;
	padding: 3px 10px;
	}
.d_select a {/*phoebe*/
	color: #FFFFFF;
	text-decoration:none;
	}
.e_select {
	font-family: "Museo Sans 500";
	font-size: 15px;
	font-weight: 500;
	color: #FFFFFF;
	-webkit-border-radius: 5px;   /*元角*/
	border-radius: 5px;
	background-color: #EA535F;
	padding: 3px 10px;
	text-decoration:none;
	}
.e_select a {/*phoebe*/
	color: #FFFFFF;
	text-decoration:none;
	}
.f_select {/*phoebe*/
	font-family: "Museo Sans 500";
	font-size: 15px;
	font-weight: 500;
	color: #FFFFFF;
	-webkit-border-radius: 5px;   /*元角*/
	-moz-border-radius: 5px;
	-ms-border-radius: 5px;
	border-radius: 5px;
	background-color: #FF611B;
	padding: 3px 10px;
	}
.f_select a {/*phoebe*/
	color: #FFFFFF;
	text-decoration:none;
	}
.g_select {
	font-family: "Museo Sans 500";
	font-size: 15px;
	font-weight: 500;
	color: #FFFFFF;
	-webkit-border-radius: 5px;   /*元角*/
	-moz-border-radius: 5px;
	-ms-border-radius: 5px;
	border-radius: 5px;
	background-color: #ff8f1b;
	padding: 3px 10px;
	}
.g_select a {/*phoebe*/
	color: #FFFFFF;
	text-decoration:none;
	}
.top_btns a {/*phoebe*/
	font-family: "Museo Sans 500";
	font-size: 14px;
	color: #FFFFFF;
	padding: 10px;
	line-height: 20px;
	text-decoration:none;
	}

.top_btns a:hover{
	font-family: "Museo Sans 500";
	font-size: 14px;
	color: #CCD74A;
	padding: 10px;
	line-height: 20px;
	}
label.css-label1 {							background-image:url(http://adoptadoggie.org/images/oo.png);
							-webkit-touch-callout: none;
							-webkit-user-select: none;
							-khtml-user-select: none;
							-moz-user-select: none;
							-ms-user-select: none;
							user-select: none;
}
</style>

<title>Application</title>
<script type="text/javascript" src="../scripts/jquery-1.10.2.min.js"></script>
<script src="../ckeditor/ckeditor.js"></script>
<script src="../ckeditor/adapters/jquery.js"></script>
<script type="text/javascript">
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}

$(document).ready(function () {
	$( '#mail_content' ).ckeditor();
});
</script>
</head>

<body>

<!----------- 內容 開始 ------------------>
<div class="adoption" style="padding: 20px 0 0 20px;">
<p align="left">Apply ID: <?=$apply_id?></p>
<table width="863" border="0" cellspacing="0" cellpadding="0">
	<tr>
    	<td>
        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
            	<tr>
                	<td>
                    	<span class="ce_title17">ADOPTION APPLICATION</span><br />
                    	<span class="re_main5">ADOPT A DOGGIE is a 501(c)(3) non-proﬁt organization.  Our mission is to help rescued dogs in need and ﬁnd them <br />loving and forever homes in North America.  The information requested in this application is intended to ensure <br />that every owner and home we approve for adoption is a suitable and safe environment for the dog and be a <br />forever home.  Thank you for your interest in our doggies!</span>
                    </td>
                </tr>
                <tr>
                	<td>
                    	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                        	<tr>
                            	<td>&nbsp;</td>
                            </tr>
                            <tr>
                            	<td>
                                	<table width="95%" border="0" cellspacing="0" cellpadding="3">
                                    	<tr>
                                        	<td colspan="3"><span class="re_main5">Name of Available Dog:</span></td>
                                        </tr>
                                        <tr>
                                        	<td width="65"><span class="re_main4">(1st Choice)</span></td>
                                            <td><input class="text_line" type="text" name="ans1" value="<?=$apply1['ans1'].'('.$apply1['dog_id'].')'?>" style="width:100%; color:<?=$name_style1?>"/></td>
                                        </tr>
                                        <tr>
                                        	<td><span class="re_main4">(2nd Choice)</span></td>
                                            <td><input class="text_line" type="text" name="ans2" value="<?=$apply1['ans2'].'('.$apply1['dog_id2'].')'?>" style="width:100%; color:<?=$name_style2?>"/></td>
                                        </tr>
                                        <tr>
                                        	<td><span class="re_main4">(3rd Choice)</span></td>
                                            <td><input class="text_line" type="text" name="ans3" value="<?=$apply1['ans3'].'('.$apply1['dog_id3'].')'?>" style="width:100%; color:<?=$name_style3?>"/></td>
                                        </tr>
                                        <tr>
                                        	<td><span class="re_main4">(4th Choice)</span></td>
                                            <td><select name="ans16" id="ans16"><option value="0">-- 請選擇 --</option><?php
											for($i=0; $i<$obj_dogs4->obj_all; $i++) {
												$dog = mysql_fetch_array($obj_dogs4->result);
												if($dog){ ?><option value="<?=$dog['Fullkey']?>" <?php if($dog['Fullkey']==$apply1['dog_id4']||$dog['Fullkey']==$dog_id4){echo 'selected';} ?>><?=stripslashes($dog['name']).'('.$dog['Fullkey'].')'?></option><?php }
											}
											?></select></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                            	<td>&nbsp;</td>
                            </tr>
                            <tr>
                            	<td height="1" bgcolor="#C2CB56"></td>
                            </tr>
                        </table>
					</td>
                </tr>
                <tr>
                	<td>
                    	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                        	<tr>
                            	<td>&nbsp;</td>
                            </tr>
                            <tr>
                            	<td>
                                	<table width="100%" border="0" cellspacing="0" cellpadding="3">
                                    	<tr>
                                        	<td><span class="re_main5">Reason(s) You Are Adopting: (check all that apply)</span></td>
                                        </tr>
                                        <tr>
                                        	<td width="20"><input type="checkbox" class="css-checkbox" id="radio01" name="ans4" value="As a Companion" <?=(($apply1['ans4'])?'checked':'')?> /><label for="radio01"><span class="checkbox re_main4">As a Companion</span></label></td>
                                        </tr>
                                        <tr>
                                        	<td><input type="checkbox" class="css-checkbox" id="radio02" name="ans5" value="As a Playmate for Other Pets" <?=(($apply1['ans5'])?'checked':'')?> /><label for="radio02"><span class="checkbox">As a Playmate for Other Pets</span></label></td>
                                        </tr>
                                        <tr>
                                        	<td><input type="checkbox" class="css-checkbox" id="radio03" name="ans6" value="For Another Family Member" <?=(($apply1['ans6'])?'checked':'')?> /><label for="radio03"><span class="checkbox">For Another Family Member</span></label></td>
                                        </tr>
                                        <tr>
                                        	<td><input type="checkbox" class="css-checkbox" id="radio04" name="ans7" value="As a Gift" <?=(($apply1['ans7'])?'checked':'')?> /><label for="radio04"><span class="checkbox">As a Gift</span></label></td>
                                        </tr>
                                        <tr>
                                        	<td><input type="checkbox" class="css-checkbox" id="radio05" name="ans8" value="As a Guard Dog" <?=(($apply1['ans8'])?'checked':'')?> /><label for="radio05"><span class="checkbox">As a Guard Dog</span></label>

                                            </td>
                                        </tr>
                                        <tr>
                                        	<td>
                                            	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td>
                                                        <input type="checkbox" class="css-checkbox" id="radio06" name="ans9" value="Others" <?=(($apply1['ans9'])?'checked':'')?> /><label for="radio06"><span class="checkbox">Others </span></label>
                                                        </td>
                                                        <td>
                                                        <textarea name="ans10" class="textbox_box4 re_main4" style="width:609px;"><?=$apply1['ans10']?></textarea>
                                                        <!--<input class="text_line" type="text" name="ans10" style="width:609px;" />-->
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                        	<td>
                                            	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td>
                                                        <input type="checkbox" class="css-checkbox" id="radio07" name="ans11" value="Comments" <?=(($apply1['ans11'])?'checked':'')?> /><label for="radio07"><span class="checkbox">Comments </span></label>
                                                        </td>
                                                        <td>
                                                        <textarea name="ans12" class="textbox_box4 re_main4" style="width:588px;"><?=$apply1['ans12']?></textarea>
                                                        <!--<input class="text_line" type="text" name="ans12" style="width:588px;" />-->
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                            	<td>&nbsp;</td>
                            </tr>
                            <tr>
                            	<td height="1" bgcolor="#C2CB56"></td>
                            </tr>
                        </table>
					</td>
				</tr>
	            <tr>
                	<td>
                    	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                        	<tr>
                            	<td>&nbsp;</td>
                            </tr>
                            <tr>
                            	<td>
                                	<table width="100%" border="0" cellspacing="0" cellpadding="3">
                                    	<tr>
                                        	<td colspan="2"><span class="re_main5">What traits are you looking for in your new dog?</span></td>
                                        </tr>
                                        <tr>
                                        	<td><span class="re_main4">Temperament </span><input class="text_line" type="text" name="ans13" value="<?=$apply1['ans13']?>" style="width:592px;" /></td>
                                        </tr>
                                        <tr>
                                        	<td><span class="re_main4">Age </span><input class="text_line" type="text" name="ans14" value="<?=$apply1['ans14']?>" style="width:643px;" /></td>
                                        </tr>
                                        <tr>
                                        	<td><span class="re_main4">Look/Color/Gender </span><input class="text_line" type="text" name="ans15" value="<?=$apply1['ans15']?>" style="width:567px;" /></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                            	<td>&nbsp;</td>
                            </tr>
                            <tr>
                            	<td height="1" bgcolor="#C2CB56"></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                	<td>
                    	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                        	<tr>
                            	<td>&nbsp;</td>
                            </tr>
                            <tr>
                            	<td>
                                	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    	<tr>
                                        	<td><span class="ce_title17">APPLICANT’S INFORMATION</span></td>
                                        </tr>
                                        <tr>
                                        	<td>
                                            	<table width="0" border="0" cellspacing="0" cellpadding="3">
                                                	<tr>
                                                    	<td align="right" valign="top"><span class="re_main4"> First Name </span></td>
                                                        <td valign="top"><input class="textbox_box" type="text" name="ans16" value="<?=$apply2['ans1']?>" /></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4"> Last Name </span></td>
                                                        <td valign="top"><input class="textbox_box" type="text" name="ans18" value="<?=$apply2['ans3']?>" /></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4"> Email </span></td>
                                                        <td valign="top"><input class="textbox_box" type="text" name="ans19" value="<?=$apply2['ans4']?>" /></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4"> Age </span></td>
                                                        <td valign="top"><input class="textbox_box2" type="text" name="ans20" value="<?=$apply2['ans5']?>" /></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4"> Occupation </span></td>
                                                        <td valign="top"><input class="textbox_box" type="text" name="ans21" value="<?=$apply2['ans6']?>" /></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4"> Home Address</span></td>
                                                        <td valign="top"><input class="textbox_box" type="text" name="ans22" value="<?=$apply2['ans7']?>" /></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4"> City </span></td>
                                                        <td valign="top"><input class="textbox_box" type="text" name="ans23" value="<?=$apply2['ans8']?>" /></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4"> State</span></td>
                                                        <td valign="top"><input class="textbox_box" type="text" name="ans24" value="<?=$apply2['ans9']?>" /></td>
                                                    </tr>
                                                    <tr>
                                                      <td align="right" valign="top"><span class="re_main4">Zip Code</span></td>
                                                      <td valign="top"><input class="textbox_box3" type="text" name="ans25" value="<?=$apply2['ans10']?>" /></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4"> Home Tel </span></td>
                                                        <td valign="top"><span class="re_main4">(<input class="textbox_box2" type="text" name="ans26" value="<?=$apply2['ans11']?>" />)<input class="textbox_box2" type="text" name="ans27" value="<?=$apply2['ans12']?>" /> - <input class="textbox_box2" type="text" name="ans28" value="<?=$apply2['ans13']?>" /></span></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4"> Cell Tel </span></td>
                                                        <td valign="top"><span class="re_main4">(<input class="textbox_box2" type="text" name="ans29" value="<?=$apply2['ans14']?>" />)<input class="textbox_box2" type="text" name="ans30" value="<?=$apply2['ans15']?>" /> - <input class="textbox_box2" type="text" name="ans31" value="<?=$apply2['ans16']?>" /></span></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4"> Work Tel </span></td>
                                                        <td valign="top"><span class="re_main4">(<input class="textbox_box2" type="text" name="ans32" value="<?=$apply2['ans17']?>" />)<input class="textbox_box2" type="text" name="ans33" value="<?=$apply2['ans18']?>" /> - <input class="textbox_box2" type="text" name="ans34" value="<?=$apply2['ans19']?>" /></span></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4"> When is a good time to call?</span></td>
                                                        <td valign="top"><input class="textbox_box" type="text" name="ans35" value="<?=$apply2['ans20']?>" /></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4"> Time at Address </span></td>
                                                        <td valign="top"><span class="re_main4"><input class="textbox_box2" type="text" name="ans36" value="<?=$apply2['ans21']?>" />month(s)<input class="textbox_box2" type="text" name="ans37" value="<?=$apply2['ans22']?>" />year(s)</span></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4"> Housing Type </span></td>
                                                        <td valign="top"><table width="0" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                    	<td>
                                                        	<table width="0" border="0" cellspacing="0" cellpadding="0">
                                                            	<tr>
                                                                	<td height="25"><input name="ans38" type="radio" class="css-checkbox" id="radio08" value="House" <?=(($apply2['ans23']=='House')?'checked':'')?> /><label for="radio08" class="css-label radGroup2"><span class="checkbox re_main4">House</span></label></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input name="ans38" type="radio" class="css-checkbox" id="radio09" value="Condo" <?=(($apply2['ans23']=='Condo')?'checked':'')?> /><label for="radio09" class="css-label radGroup2"><span class="checkbox re_main4">Condo</span></label></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input name="ans38" type="radio" class="css-checkbox" id="radio10" value="Apartment" <?=(($apply2['ans23']=='Apartment')?'checked':'')?> /><label for="radio10" class="css-label radGroup2"><span class="checkbox re_main4">Apartment</span></label></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input name="ans38" type="radio" class="css-checkbox" id="radio11" value="Mobile Home" <?=(($apply2['ans23']=='Mobile Home')?'checked':'')?> /><label for="radio11" class="css-label radGroup2"><span class="checkbox re_main4">Mobile Home</span></label></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input name="ans38" type="radio" class="css-checkbox" id="radio12" value="Military Housing" <?=(($apply2['ans23']=='Military Housing')?'checked':'')?> /><label for="radio12" class="css-label radGroup2"><span class="checkbox re_main4">Military Housing</span></label></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                    	<td>
                                                        	<table width="0" border="0" cellspacing="0" cellpadding="0">
                                                            	<tr>
                                                                	<td height="25"><input name="ans38" type="radio" class="css-checkbox" id="radio13" value="Other" <?=(($apply2['ans23']=='Other')?'checked':'')?> /><label for="radio13" class="css-label radGroup2"><span class="checkbox re_main4">Other</span><input class="textbox_box" type="text" name="ans39" value="<?=$apply2['ans24']?>" /></label></td>
                                                                    <td width="10"></td>
                                                                    <td>&nbsp;</td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                        	<td align="right" valign="top"><span class="re_main4"> Housing </span></td>
                                            <td valign="top">
                                            	<table width="0" border="0" cellspacing="0" cellpadding="0">
                                                	<tr>
                                                    	<td valign="middle">
                                                        	<table border="0" cellpadding="0" cellspacing="0">
                                                            	<tr>
                                                                	<td height="25"><input name="ans40" type="radio" class="css-checkbox" id="radio14" value="Own" <?=(($apply2['ans25']=='Own')?'checked':'')?> /><label for="radio14" class="css-label radGroup2"><span class="checkbox re_main4">Own</span></label></td>
                                                                    <td>&nbsp;</td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                        <td valign="middle">&nbsp;</td>
                                                        <td valign="middle"><input name="ans40" type="radio" class="css-checkbox" id="radio15" value="Rent" <?=(($apply2['ans25']=='Rent')?'checked':'')?> /><label for="radio15" class="css-label radGroup2"><span class="checkbox re_main4">Rent</span></label></td>
                                                        <td valign="middle">&nbsp;</td>
                                                        <td valign="middle"><input name="ans40" type="radio" class="css-checkbox" id="radio16" value="Other" <?=(($apply2['ans25']=='Other')?'checked':'')?> /><label for="radio16" class="css-label radGroup2"><span class="checkbox re_main4">Other </span><input class="textbox_box" type="text" name="ans41" value="<?=$apply2['ans26']?>" /></label></td>
                                                        <td width="10">&nbsp;</td>
                                                        <td width="10">&nbsp;</td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                        	<td align="right" valign="top"><span class="re_main4"> Landlord Name</span></td>
                                            <td valign="top"><input class="textbox_box5" type="text" name="ans42" value="<?=$apply2['ans27']?>" /></td>
                                        </tr>
                                        <tr>
                                        	<td align="right" valign="top"><span class="re_main4"> Landlord Tel</span></td>
                                            <td valign="top"><span class="re_main4">(<input class="textbox_box2" type="text" name="ans43" value="<?=$apply2['ans28']?>" />)<input class="textbox_box2" type="text" name="ans44" value="<?=$apply2['ans29']?>" /> - <input class="textbox_box2" type="text" name="ans45" value="<?=$apply2['ans30']?>" /></span></td>
                                        </tr>
                                        <tr>
                                        	<td align="right" valign="top"><span class="re_main4"> Conﬁrm Landlord Allows Dogs</span></td>
                                            <td valign="top">
                                            	<table width="0" border="0" cellspacing="0" cellpadding="0">
                                                	<tr>
                                                    	<td height="25"><input name="ans46" type="radio" class="css-checkbox" id="radio17" value="Yes" <?=(($apply2['ans31']=='Yes')?'checked':'')?> /><label for="radio17" class="css-label radGroup2"><span class="checkbox re_main4">Yes</span></label></td>
                                                        <td>&nbsp;</td>
                                                        <td><input name="ans46" type="radio" class="css-checkbox" id="radio18" value="No" <?=(($apply2['ans31']=='No')?'checked':'')?> /> <label for="radio18" class="css-label radGroup2"><span class="checkbox re_main4">No</span></label></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                        	<td align="right" valign="top"><span class="re_main4"> Other Members of the Household </span></td>
                                            <td valign="top">
                                            	<table width="0" border="0" cellspacing="0" cellpadding="0">
                                        			<tr>
                                                    	<td height="25"><input name="ans47" type="checkbox" class="css-checkbox" id="radio19" value="Spouse/Domestic Partner" <?=(($apply2['ans32']=='Spouse/Domestic Partner')?'checked':'')?> /><label for="radio19" class="radGroup2"><span class="checkbox re_main4">Spouse/Domestic Partner</span></label></td>
                                                    </tr>
                                                    <tr>
                                                    	<td height="25"><input name="ans179" type="checkbox" class="css-checkbox" id="radio20" value="Child(ren)" <?=(($apply2['ans52']=='Child(ren)')?'checked':'')?> /><label for="radio20" class="radGroup2"><span class="checkbox re_main4">Child(ren) (#<input class="textbox_box2" type="text" name="ans48" value="<?=$apply2['ans33']?>" /> /Age <input class="textbox_box2" type="text" name="ans49" value="<?=$apply2['ans34']?>" />)</span></label></td>
                                                    </tr>
                                                    <tr>
                                                    	<td height="25"><input name="ans180" type="checkbox" class="css-checkbox" id="radio21" value="Roommate(s)" <?=(($apply2['ans53']=='Roommate(s)')?'checked':'')?> /><label for="radio21" class="radGroup2"><span class="checkbox re_main4">Roommate(s) (# <input class="textbox_box2" type="text" name="ans50" value="<?=$apply2['ans35']?>" />)</span></label></td>
                                                    </tr>
                                                    <tr>
                                                    	<td height="25"><input name="ans181" type="checkbox" class="css-checkbox" id="radio22" value="Other Relative(s)" <?=(($apply2['ans54']=='Other Relative(s)')?'checked':'')?> /><label for="radio22" class="radGroup2"><span class="checkbox re_main4">Other Relative(s)(# <input class="textbox_box2" type="text" name="ans51" value="<?=$apply2['ans36']?>" />)</span></label></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                        	<td align="right" valign="top"><span class="re_main4">Child(ren)’s Experience with Dogs</span></td>
                                            <td valign="top">
                                            	<table width="0" border="0" cellspacing="0" cellpadding="0">
                                        			<tr>
                                        				<td height="25"><input name="ans52" type="radio" class="css-checkbox" id="radio23" value="Yes" <?=(($apply2['ans37']=='Yes')?'checked':'')?> /><label for="radio23" class="css-label radGroup2"><span class="checkbox re_main4">Yes</span></label></td>
                                                        <td>&nbsp;</td>
                                                        <td><input name="ans52" type="radio" class="css-checkbox" id="radio24" value="No" <?=(($apply2['ans37']=='No')?'checked':'')?> /><label for="radio24" class="css-label radGroup2"><span class="checkbox re_main4">No</span></label></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="right" valign="top"><span class="re_main4"> Child(ren) taught be respective to dogs?</span></td>
                                            <td valign="top">
                                                <table width="0" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td height="25"><input name="ans53" type="radio" class="css-checkbox" id="radio25" value="Yes" <?=(($apply2['ans38']=='Yes')?'checked':'')?> /><label for="radio25" class="css-label radGroup2"><span class="checkbox re_main4">Yes</span></label></td>
                                                        <td>&nbsp;</td>
                                                        <td><input name="ans53" type="radio" class="css-checkbox" id="radio26" value="No" <?=(($apply2['ans38']=='No')?'checked':'')?> /><label for="radio26" class="css-label radGroup2"><span class="checkbox re_main4">No</span></label></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="right" valign="top"><span class="re_main4">All members of household aware of and <br />agree to the adoption of a dog </span></td>
                                            <td valign="top">
                                                <table width="0" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td height="25"><input name="ans54" type="radio" class="css-checkbox" id="radio27" value="Yes" <?=(($apply2['ans39']=='Yes')?'checked':'')?> /><label for="radio27" class="css-label radGroup2"><span class="checkbox re_main4">Yes</span></label></td>
                                                        <td>&nbsp;</td>
                                                        <td><input name="ans54" type="radio" class="css-checkbox" id="radio28" value="No" <?=(($apply2['ans39']=='No')?'checked':'')?> /><label for="radio28" class="css-label radGroup2"><span class="checkbox re_main4">No</span></label></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="right" valign="top"><span class="re_main4"> Do you or any members of your household <br />have any health conditions that may affect<br />your ability to permanently care for the dog </span></td>
                                            <td valign="top">
                                                <table width="0" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td height="25"><input name="ans55" type="radio" class="css-checkbox" id="radio29" value="Yes" <?=(($apply2['ans40']=='Yes')?'checked':'')?> /><label for="radio29" class="css-label radGroup2"><span class="checkbox re_main4">Yes</span></label></td>
                                                    </tr>
                                                    <tr>
                                                        <td height="100" valign="top"><input name="ans55" type="radio" class="css-checkbox" id="radio30" value="No" <?=(($apply2['ans40']=='No')?'checked':'')?> /><label for="radio30" class="css-label radGroup2"><span class="checkbox re_main4">No</span><br /><textarea name="ans56" class="textbox_box4 re_main4"><?=stripslashes($apply2['ans41'])?></textarea></label></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="237" align="right" valign="top"><span class="re_main4"> If you decide to move in the future, <br />plans for dog: </span></td>
                                            <td valign="top"><textarea class="textbox_box4 re_main4" name="ans57"><?=stripslashes($apply2['ans42'])?></textarea></td>
                                        </tr>
                                        <tr>
                                          <td align="right" valign="top"><span class="re_main4"> Do you have any plans to move<br>in the next 6 months? </span></td>
                                          <td valign="top"><table width="0" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                              <td height="25"><input name="ans170" type="radio" class="css-checkbox" id="radio" value="Yes" <?=(($apply2['ans49']=='Yes')?'checked':'')?> />
                                                <label for="radio" class="css-label radGroup2"><span class="checkbox re_main4">Yes</span></label></td>
                                              <td>&nbsp;</td>
                                              <td><input name="ans170" type="radio" class="css-checkbox" id="radio2" value="No" <?=(($apply2['ans49']=='No')?'checked':'')?> />
                                                <label for="radio2" class="css-label radGroup2"><span class="checkbox re_main4">No</span></label></td>
                                            </tr>
                                          </table></td>
                                        </tr>
                                        <tr>
                                          <td align="right" valign="top"><span class="re_main4">Do you have any plans to take<br>any extended trips/vacations<br>in the next 3 months?</span></td>
                                          <td valign="top"><table width="0" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                              <td height="25"><input name="ans171" type="radio" class="css-checkbox" id="radio3" value="Yes" <?=(($apply2['ans50']=='Yes')?'checked':'')?> />
                                                <label for="radio3" class="css-label radGroup2"><span class="checkbox re_main4">Yes</span></label></td>
                                              <td>&nbsp;</td>
                                              <td><input name="ans171" type="radio" class="css-checkbox" id="radio4" value="No" <?=(($apply2['ans50']=='No')?'checked':'')?> />
                                                <label for="radio4" class="css-label radGroup2"><span class="checkbox re_main4">No</span></label></td>
                                            </tr>
                                          </table></td>
                                        </tr>
                                        <tr>
                                          <td align="right" valign="top"><span class="re_main4">If yes, explain where, how long,<br>and where the dog will be during that time:</span></td>
                                          <td valign="top"><textarea class="textbox_box4 re_main4" name="ans172"><?=stripslashes($apply2['ans51'])?></textarea></td>
                                        </tr>
                                              </table>
                                			</td>
                            			</tr>
                                    </table>
                                			</td>
                            			</tr>
                         			</table>
                     			</td>
                 			</tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td height="1" bgcolor="#C2CB56"></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                	<td>
                    	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                        	<tr>
                            	<td>&nbsp;</td>
                            </tr>
                            <tr>
                            	<td>
                                	<table width="0" border="0" cellspacing="0" cellpadding="3">
                                    	<tr>
                                        	<td><span class="re_main5">Emergency Contact: (if we need to reach someone else about the dog (pre or post adoption): </span></td>
                                        </tr>
                                        <tr>
                                        	<td>
                                            	<table width="0" border="0" cellpadding="3" cellspacing="0">
                                                	<tr>
                                                    	<td width="237" align="right" valign="top"><span class="re_main4">Contact Name</span></td>
                                                        <td valign="top"><input class="textbox_box" type="text" name="ans58" value="<?=$apply2['ans43']?>" /></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Tel</span></td>
                                                        <td valign="top"><input class="textbox_box" type="text" name="ans59" value="<?=$apply2['ans44']?>" /></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Home Address</span></td>
                                                        <td valign="top"><input class="textbox_box" type="text" name="ans60" value="<?=$apply2['ans45']?>" /></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">City</span></td>
                                                        <td valign="top"><input class="textbox_box" type="text" name="ans61" value="<?=$apply2['ans46']?>" /></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">State</span></td>
                                                        <td valign="top"><input class="textbox_box" type="text" name="ans62" value="<?=$apply2['ans47']?>" /></td>
                                                    </tr>
                                                    <tr>
                                                      <td align="right" valign="top"><span class="re_main4">Zip Code</span></td>
                                                      <td valign="top"><input class="textbox_box3" type="text" name="ans63" value="<?=$apply2['ans48']?>" /></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td height="1" bgcolor="#C2CB56"></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                	<td>
                    	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                        	<tr>
                            	<td>&nbsp;</td>
                            </tr>
                            <tr>
                            	<td>
                                	<table width="0" border="0" cellspacing="0" cellpadding="3">
                                    	<tr>
                                        	<td><span class="ce_title17">CAREGIVER(S) FOR THE DOG</span></td>
                                        </tr>
                                        <tr>
                                        	<td>
                                            	<table width="0" border="0" cellpadding="3" cellspacing="0">
                                                	<tr>
                                                    	<td width="237" align="right" valign="top"><span class="re_main4">Who will be the primary care taker</span></td>
                                                        <td valign="top">&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Name</span></td>
                                                        <td valign="top"><input class="textbox_box" type="text" name="ans64" value="<?=$apply3['ans1']?>" /></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Age</span></td>
                                                        <td valign="top"><input class="textbox_box" type="text" name="ans65" value="<?=$apply3['ans2']?>" /></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Veterinarian Name</span></td>
                                                        <td valign="top"><input class="textbox_box" type="text" name="ans66" value="<?=$apply3['ans3']?>" /></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Vet Tel</span></td>
                                                        <td valign="top"><span class="re_main4">(<input class="textbox_box2" type="text" name="ans67" value="<?=$apply3['ans4']?>" />)<input class="textbox_box2" type="text" name="ans68" value="<?=$apply3['ans5']?>" /> - <input class="textbox_box2" type="text" name="ans69" value="<?=$apply3['ans6']?>" /></span></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Veterinarian Address</span></td>
                                                        <td valign="top"><input class="textbox_box" type="text" name="ans70" value="<?=$apply3['ans7']?>" /></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">City</span></td>
                                                        <td valign="top"><input class="textbox_box" type="text" name="ans71" value="<?=$apply3['ans8']?>" /></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">State</span></td>
                                                        <td valign="top"><input class="textbox_box" type="text" name="ans72" value="<?=$apply3['ans9']?>" /></td>
                                                    </tr>
                                                    <tr>
                                                      <td align="right" valign="top"><span class="re_main4">Zip Code</span></td>
                                                      <td valign="top"><input class="textbox_box3" type="text" name="ans73" value="<?=$apply3['ans10']?>" /></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                            	<td>&nbsp;</td>
                            </tr>
                            <tr>
                            	<td height="1" bgcolor="#C2CB56"></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                	<td>
                    	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                        	<tr>
                            	<td>&nbsp;</td>
                            </tr>
                            <tr>
                            	<td>
                                	<table width="0" border="0" cellspacing="0" cellpadding="3">
                                    	<tr>
                                        	<td><span class="ce_title17">DOG’S HOME ENVIRONMENT</span></td>
                                        </tr>
                                        <tr>
                                        	<td>
                                            	<table width="0" border="0" cellpadding="3" cellspacing="0">
                                                	<tr>
                                                    	<td width="237" align="right" valign="top"><span class="re_main4">Where will the dog be normally kept</span></td>
                                                        <td valign="top">
                                                        	<table width="0" border="0" cellspacing="0" cellpadding="0">
                                                            	<tr>
                                                                	<td height="25"><input name="ans74" type="radio" class="css-checkbox" id="radio31" value="Indoors" <?=(($apply4['ans1']=='Indoors')?'checked':'')?> /><label for="radio31" class="css-label radGroup2"><span class="checkbox re_main4">Indoors</span></label></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input name="ans74" type="radio" class="css-checkbox" id="radio32" value="Outdoors" <?=(($apply4['ans1']=='Outdoors')?'checked':'')?> /><label for="radio32" class="css-label radGroup2"><span class="checkbox re_main4">Outdoors</span></label></td>
                                                                    <td>&nbsp;</td>

                                                                    <td><input name="ans74" type="radio" class="css-checkbox" id="radio33" value="Both" <?=(($apply4['ans1']=='Both')?'checked':'')?> /><label for="radio33" class="css-label radGroup2"><span class="checkbox re_main4">Both</span></label></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input name="ans74" type="radio" class="css-checkbox" id="radio34" value="Other" <?=(($apply4['ans1']=='Other')?'checked':'')?> /><label for="radio34" class="css-label radGroup2"><span class="checkbox re_main4">Other </span><input class="textbox_box3" type="text" name="ans75" value="<?=$apply4['ans2']?>" /></label></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Time(s) of Day/Night</span></td>
                                                        <td valign="top">
                                                        	<table width="0" border="0" cellspacing="0" cellpadding="0">
                                                            	<tr>
                                                                	<td height="25"><input name="ans76" type="radio" class="css-checkbox" id="radio35" value="Indoors" <?=(($apply4['ans3']=='Indoors')?'checked':'')?> /><label for="radio35" class="css-label radGroup2"><span class="checkbox re_main4">Indoors </span><input class="textbox_box3" type="text" name="ans77" value="<?=$apply4['ans4']?>" /></label></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input name="ans76" type="radio" class="css-checkbox" id="radio36" value="Outdoor" <?=(($apply4['ans3']=='Outdoor')?'checked':'')?> /><label for="radio36" class="css-label radGroup2"><span class="checkbox re_main4">Outdoor </span><input class="textbox_box3" type="text" name="ans78" value="<?=$apply4['ans5']?>" /></label></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Number of days dog will be left alone</span></td>
                                                        <td valign="top">
                                                        	<table width="0" border="0" cellspacing="0" cellpadding="0">
                                                            	<tr>
                                                                	<td height="25"><input name="ans79" type="radio" class="css-checkbox" id="radio37" value="Weekdays" <?=(($apply4['ans6']=='Weekdays')?'checked':'')?> /><label for="radio37" class="css-label radGroup2"><span class="checkbox re_main4">Weekdays </span><input class="textbox_box3" type="text" name="ans80" value="<?=$apply4['ans7']?>" /></label></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input name="ans79" type="radio" class="css-checkbox" id="radio38" value="Weekends" <?=(($apply4['ans6']=='Weekends')?'checked':'')?> /><label for="radio38" class="css-label radGroup2"><span class="checkbox re_main4">Weekends </span><input class="textbox_box3" type="text" name="ans81" value="<?=$apply4['ans8']?>" /></label></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Outdoors: Yard</span></td>
                                                        <td valign="top">
                                                        	<table width="0" border="0" cellspacing="0" cellpadding="0">
                                                            	<tr>
                                                                	<td height="25"><input name="ans82" type="radio" class="css-checkbox" id="radio39" value="Yes" <?=(($apply4['ans9']=='Yes')?'checked':'')?> /><label for="radio39" class="css-label radGroup2"><span class="checkbox re_main4">Yes</span></label></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input name="ans82" type="radio" class="css-checkbox" id="radio40" value="No" <?=(($apply4['ans9']=='No')?'checked':'')?> /><label for="radio40" class="css-label radGroup2"><span class="checkbox re_main4">No</span></label></td>
                                                                    <td width="20">&nbsp;</td>
                                                                    <td><span class="re_main4"> Fenced In </span></td>
                                                                    <td width="10">&nbsp;</td>
                                                                    <td><input name="ans83" type="radio" class="css-checkbox" id="radio41" value="Yes" <?=(($apply4['ans10']=='Yes')?'checked':'')?> /><label for="radio41" class="css-label radGroup2"><span class="checkbox re_main4">Yes</span></label></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input name="ans83" type="radio" class="css-checkbox" id="radio42" value="No" <?=(($apply4['ans10']=='No')?'checked':'')?> /><label for="radio42" class="css-label radGroup2"><span class="checkbox re_main4">No</span></label></td>
                                                                    <td width="20">&nbsp;</td>
                                                                    <td><span class="re_main4">Height of fence </span><input class="textbox_box2" type="text" name="ans84" value="<?=$apply4['ans11']?>" /><span class="re_main4"> feet</span></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Any possibility of the dog escaping the yard</span></td>
                                                        <td valign="top">
                                                        	<table width="0" border="0" cellspacing="0" cellpadding="0">
                                                            	<tr>
                                                                	<td height="25"><input name="ans85" type="radio" class="css-checkbox" id="radio43" value="No" <?=(($apply4['ans12']=='No')?'checked':'')?> /><label for="radio43" class="css-label radGroup2"><span class="checkbox re_main4">No</span></label></td>
                                                                </tr>
                                                                <tr>
                                                                	<td height="100" valign="top"><input name="ans85" type="radio" class="css-checkbox" id="radio44" value="Yes" <?=(($apply4['ans12']=='No')?'checked':'')?> /><label for="radio44" class="css-label radGroup2"><span class="checkbox re_main4">Yes  (explain)</span><br /><textarea class="textbox_box4" name="ans86"><?=stripslashes($apply4['ans13'])?></textarea></label></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Indoors: Location(s) Dog will be kept/allowed<br />while indoors (check all that apply)</span></td>
                                                        <td valign="top">
                                                        	<table width="0" border="0" cellspacing="0" cellpadding="0">

                                                            	<tr>
                                                                	<td height="25"><input name="ans87" type="checkbox" class="css-checkbox" id="radio45" value="Living Room" <?=(($apply4['ans14']=='Living Room')?'checked':'')?> /><label for="radio45" class="radGroup2"><span class="checkbox re_main4">Living Room</span></label></td>
                                                                    <td width="30">&nbsp;</td>
                                                                    <td><input name="ans87" type="checkbox" class="css-checkbox" id="radio46" value="Garage" <?=(($apply4['ans17']=='Garage')?'checked':'')?> /><label for="radio46" class="radGroup2"><span class="checkbox re_main4">Garage</span></label></td>
                                                                </tr>
                                                                <tr>
                                                                	<td height="25"><input name="ans87" type="checkbox" class="css-checkbox" id="radio47" value="Kitchen" <?=(($apply4['ans18']=='Kitchen')?'checked':'')?> /><label for="radio47" class="radGroup2"><span class="checkbox re_main4">Kitchen</span></label></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input name="ans87" type="checkbox" class="css-checkbox" id="radio48" value="Anywhere indoors" <?=(($apply4['ans19']=='Anywhere indoors')?'checked':'')?> /> <label for="radio48" class="radGroup2"><span class="checkbox re_main4">Anywhere indoors</span></label></td>
                                                                </tr>
                                                                <tr>
                                                                	<td height="25"><input name="ans87" type="checkbox" class="css-checkbox" id="radio49" value="Bedroom(s)" <?=(($apply4['ans20']=='Bedroom(s)')?'checked':'')?> /><label for="radio49" class="radGroup2"><span class="checkbox re_main4">Bedroom(s)</span></label></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input name="ans87" type="checkbox" class="css-checkbox" id="radio50" value="Other" <?=(($apply4['ans21']=='Other')?'checked':'')?> /><label for="radio50" class="radGroup2"><span class="checkbox re_main4">Other </span><input class="textbox_box" type="text" name="ans88" value="<?=$apply4['ans15']?>" /></label></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Types of outdoor activities/exercises<br />plan to do with the dog</span></td>
                                                        <td valign="top"><span class="re_main4"><textarea class="textbox_box4" name="ans89"><?=stripslashes($apply4['ans16'])?></textarea></span></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                            	<td>&nbsp;</td>
                            </tr>
                            <tr>
                            	<td height="1" bgcolor="#C2CB56"></td>
                            </tr>
                        </table>
					</td>
	            </tr>
	            <tr>
                	<td>
                    	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                        	<tr>
                            	<td>&nbsp;</td>
                            </tr>

                            <tr>
                            	<td>
                                	<table width="0" border="0" cellspacing="0" cellpadding="3">
                                    	<tr>
                                        	<td><span class="ce_title17">OTHER PETS IN SAME HOUSEHOLD (CURRENT/PAST)</span></td>
                                        </tr>
                                        <tr>
                                        	<td>
                                            	<table width="0" border="0" cellpadding="3" cellspacing="0">
                                                	<tr>
                                                    	<td width="237" align="right" valign="top"><span class="re_main4">1st Pet Name</span></td>
                                                        <td valign="top"><input class="textbox_box5" type="text" name="ans90" value="<?=$apply5['ans1']?>" /></td>
                                                    </tr>
													<tr>
                                                	  <td align="right" valign="top">&nbsp;</td>
                                                	  <td valign="top"><table width="0" border="0" cellspacing="0" cellpadding="0">
                                                	    <tr>
                                                	      <td height="25"><input name="ans173" type="radio" class="css-checkbox" id="radio5" value="CURRENT" <?=(($apply5['ans33']=='CURRENT')?'checked':'')?> />
                                                	        <label for="radio5" class="css-label radGroup2"><span class="checkbox re_main4">CURRENT</span></label></td>
                                                	      <td>&nbsp;</td>
                                                	      <td><input name="ans173" type="radio" class="css-checkbox" id="radio6" value="PAST" <?=(($apply5['ans33']=='PAST')?'checked':'')?> />
                                                	        <label for="radio6" class="css-label radGroup2"><span class="checkbox re_main4">PAST</span></label></td>
														</tr>
													  </table></td>
                                              	    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Type of pet: (dog, cat, bird, etc.)</span></td>
                                                        <td valign="top"><input class="textbox_box5" type="text" name="ans91" value="<?=$apply5['ans2']?>" /></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Breed</span></td>
                                                        <td valign="top"><input class="textbox_box5" type="text" name="ans92" value="<?=$apply5['ans3']?>" /></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Gender</span></td>
                                                        <td valign="top">
                                                        	<table width="0" border="0" cellspacing="0" cellpadding="0">
                                                            	<tr>
                                                                	<td height="25"><input name="ans93" type="radio" class="css-checkbox" id="radio51" value="Male" <?=(($apply5['ans4']=='Male')?'checked':'')?> /><label for="radio51" class="css-label radGroup2"><span class="checkbox re_main4">Male</span></label></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input name="ans93" type="radio" class="css-checkbox" id="radio52" value="Female" <?=(($apply5['ans4']=='Female')?'checked':'')?> /><label for="radio52" class="css-label radGroup2"><span class="checkbox re_main4">Female</span></label></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Age</span></td>
                                                        <td valign="top">
                                                        	<table width="0" border="0" cellspacing="0" cellpadding="0">
                                                            	<tr>
                                                                	<td height="25"><input class="textbox_box2" type="text" name="ans94" value="<?=$apply5['ans5']?>" /></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><span class="re_main4"> months </span></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input class="textbox_box2" type="text" name="ans95" value="<?=$apply5['ans6']?>" /></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><span class="re_main4"> years </span></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Spayed/Neutered</span></td>
                                                        <td valign="top">
                                                        	<table width="0" border="0" cellspacing="0" cellpadding="0">
                                                            	<tr>
                                                                	<td height="25"><input name="ans96" type="radio" class="css-checkbox" id="radio53" value="Yes" <?=(($apply5['ans7']=='Yes')?'checked':'')?> /><label for="radio53" class="css-label radGroup2"><span class="checkbox re_main4">Yes</span></label></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input name="ans96" type="radio" class="css-checkbox" id="radio54" value="No" <?=(($apply5['ans7']=='No')?'checked':'')?> /><label for="radio54" class="css-label radGroup2"><span class="checkbox re_main4">No</span></label></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Length of time owned 1st pet</span></td>
                                                        <td valign="top">
                                                        	<table width="0" border="0" cellspacing="0" cellpadding="0">
                                                            	<tr>
                                                                	<td height="25"><input class="textbox_box2" type="text" name="ans97" value="<?=$apply5['ans8']?>" /></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><span class="re_main4"> months </span></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input class="textbox_box2" type="text" name="ans98" value="<?=$apply5['ans9']?>" /></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><span class="re_main4"> years </span></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Lives</span></td>
                                                        <td valign="top">
                                                        	<table width="0" border="0" cellspacing="0" cellpadding="0">
                                                            	<tr>
                                                                	<td height="25" valign="middle"><input name="ans99" type="radio" class="css-checkbox" id="radio55" value="Indoor" <?=(($apply5['ans10']=='Indoor')?'checked':'')?> /><label for="radio55" class="css-label radGroup2"><span class="checkbox re_main4">Indoor</span></label></td>
                                                                    <td valign="middle">&nbsp;</td>
                                                                    <td valign="middle"><input name="ans99" type="radio" class="css-checkbox" id="radio56" value="Outdoor" <?=(($apply5['ans10']=='Outdoor')?'checked':'')?> /><label for="radio56" class="css-label radGroup2"><span class="checkbox re_main4">Outdoor</span></label></td>
                                                                    <td valign="middle">&nbsp;</td>
                                                                    <td valign="middle"><input name="ans99" type="radio" class="css-checkbox" id="radio57" value="Both" <?=(($apply5['ans10']=='Both')?'checked':'')?> /><label for="radio57" class="css-label radGroup2"><span class="checkbox re_main4">Both</span></label></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Gets along with dogs</span></td>
                                                        <td valign="top">
                                                        	<table width="0" border="0" cellspacing="0" cellpadding="0">
                                                            	<tr>
                                                                	<td height="25"><input name="ans100" type="radio" class="css-checkbox" id="radio58" value="Yes" <?=(($apply5['ans11']=='Yes')?'checked':'')?> /><label for="radio58" class="css-label radGroup2"><span class="checkbox re_main4">Yes</span></label></td>
                                                                </tr>
                                                                <tr>
                                                                	<td height="100" valign="top"><input name="ans100" type="radio" class="css-checkbox" id="radio59" value="No" <?=(($apply5['ans11']=='No')?'checked':'')?> /><label for="radio59" class="css-label radGroup2"><span class="checkbox re_main4">No (explain)</span><br /><textarea class="textbox_box4" name="ans101"><?=stripslashes($apply5['ans12'])?></textarea></label></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">2nd Pet Name</span></td>
                                                        <td valign="top"><input class="textbox_box5" type="text" name="ans102" value="<?=$apply5['ans13']?>" /></td>
                                                    </tr>
                                                    <tr>
                                                      <td align="right" valign="top">&nbsp;</td>
                                                      <td valign="top"><table width="0" border="0" cellspacing="0" cellpadding="0">
                                                        <tr>
                                                          <td height="25"><input name="ans182" type="radio" class="css-checkbox" id="radio7" value="CURRENT" <?=(($apply5['ans34']=='CURRENT')?'checked':'')?> />
                                                            <label for="radio7" class="css-label radGroup2"><span class="checkbox re_main4">CURRENT</span></label></td>
                                                          <td>&nbsp;</td>
                                                          <td><input name="ans182" type="radio" class="css-checkbox" id="radio8" value="PAST" <?=(($apply5['ans34']=='PAST')?'checked':'')?> />
                                                            <label for="radio8" class="css-label radGroup2"><span class="checkbox re_main4">PAST</span></label></td>
                                                        </tr>
                                                      </table></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Type of pet: (dog, cat, bird, etc.)</span></td>
                                                        <td valign="top"><input class="textbox_box5" type="text" name="ans103" value="<?=$apply5['ans14']?>" /></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Breed</span></td>
                                                        <td valign="top"><input class="textbox_box5" type="text" name="ans104" value="<?=$apply5['ans15']?>" /></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Gender</span></td>
                                                        <td valign="top">
                                                        	<table width="0" border="0" cellspacing="0" cellpadding="0">
                                                            	<tr>
                                                                	<td height="25"><input name="ans105" type="radio" class="css-checkbox" id="radio60" value="Male" <?=(($apply5['ans16']=='Male')?'checked':'')?> /><label for="radio60" class="css-label radGroup2"><span class="checkbox re_main4">Male</span></label></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input name="ans105" type="radio" class="css-checkbox" id="radio61" value="Female" <?=(($apply5['ans16']=='Female')?'checked':'')?> /><label for="radio61" class="css-label radGroup2"><span class="checkbox re_main4">Female</span></label></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Age</span></td>
                                                        <td valign="top">
                                                        	<table width="0" border="0" cellspacing="0" cellpadding="0">
                                                            	<tr>
                                                                	<td height="25"><input class="textbox_box2" type="text" name="ans106" value="<?=$apply5['ans17']?>" /></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><span class="re_main4"> months </span></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input class="textbox_box2" type="text" name="ans107" value="<?=$apply5['ans18']?>" /></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><span class="re_main4"> years </span></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Spayed/Neutered</span></td>
                                                        <td valign="top">
                                                        	<table width="0" border="0" cellspacing="0" cellpadding="0">
                                                            	<tr>
                                                                	<td height="25"><input name="ans108" type="radio" class="css-checkbox" id="radio62" value="Yes" <?=(($apply5['ans19']=='Yes')?'checked':'')?> /><label for="radio62" class="css-label radGroup2"><span class="checkbox re_main4">Yes</span></label></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input name="ans108" type="radio" class="css-checkbox" id="radio63" value="No" <?=(($apply5['ans19']=='No')?'checked':'')?> /><label for="radio63" class="css-label radGroup2"><span class="checkbox re_main4">No</span></label></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Length of time owned 2nd pet</span></td>
                                                        <td valign="top">
                                                        	<table width="0" border="0" cellspacing="0" cellpadding="0">
                                                            	<tr>
                                                                	<td height="25"><input class="textbox_box2" type="text" name="ans109" value="<?=$apply5['ans20']?>" /></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><span class="re_main4"> months </span></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input class="textbox_box2" type="text" name="ans110" value="<?=$apply5['ans21']?>" /></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><span class="re_main4"> years </span></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Lives</span></td>
                                                        <td valign="top">
                                                        	<table width="0" border="0" cellspacing="0" cellpadding="0">
                                                            	<tr>
                                                                	<td height="25"><input name="ans111" type="radio" class="css-checkbox" id="radio64" value="Indoor" <?=(($apply5['ans22']=='Indoor')?'checked':'')?> /><label for="radio64" class="css-label radGroup2"><span class="checkbox re_main4">Indoor</span></label></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input name="ans111" type="radio" class="css-checkbox" id="radio65" value="Outdoor" <?=(($apply5['ans22']=='Outdoor')?'checked':'')?> /><label for="radio65" class="css-label radGroup2"><span class="checkbox re_main4">Outdoor</span></label></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input name="ans111" type="radio" class="css-checkbox" id="radio66" value="Both" <?=(($apply5['ans22']=='Both')?'checked':'')?> /><label for="radio66" class="css-label radGroup2"><span class="checkbox re_main4">Both</span></label></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Gets along with dogs</span></td>
                                                        <td valign="top">
                                                        	<table width="0" border="0" cellspacing="0" cellpadding="0">
                                                            	<tr>
                                                                	<td height="25"><input name="ans112" type="radio" class="css-checkbox" id="radio67" value="Yes" <?=(($apply5['ans23']=='Yes')?'checked':'')?> /><label for="radio67" class="css-label radGroup2"><span class="checkbox re_main4">Yes</span></label></td>
                                                                </tr>
                                                                <tr>
                                                                	<td height="100" valign="top"><input name="ans112" type="radio" class="css-checkbox" id="radio68" value="No" <?=(($apply5['ans23']=='No')?'checked':'')?> /><label for="radio68" class="css-label radGroup2"><span class="checkbox re_main4">No (explain) </span><br /><textarea class="textbox_box4" name="ans113"><?=stripslashes($apply5['ans24'])?></textarea></label></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Have you ever lost or had to give up a pet before</span></td>
                                                        <td valign="top">
                                                        	<table width="0" border="0" cellspacing="0" cellpadding="0">
                                                            	<tr>
                                                                	<td height="25"><input name="ans114" type="radio" class="css-checkbox" id="radio69" value="Yes" <?=(($apply5['ans25']=='Yes')?'checked':'')?> /><label for="radio69" class="css-label radGroup2"><span class="checkbox re_main4">Yes</span></label></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input name="ans114" type="radio" class="css-checkbox" id="radio70" value="No" <?=(($apply5['ans25']=='No')?'checked':'')?> /><label for="radio70" class="css-label radGroup2"><span class="checkbox re_main4">No</span></label></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">If yes, what happened: (check as many as apply)</span></td>
                                                        <td valign="top">
                                                        	<table width="0" border="0" cellspacing="0" cellpadding="2">
                                                            	<tr>
                                                                	<td height="25"><input name="ans115" type="radio" class="css-checkbox" id="radio71" value="Surrendered/Abandoned" <?=(($apply5['ans26']=='Surrendered/Abandoned')?'checked':'')?> /><label for="radio71" class="css-label radGroup2"><span class="checkbox re_main4">Surrendered/Abandoned</span></label></td>
                                                                </tr>
                                                                <tr>
                                                                	<td height="25"><input name="ans115" type="radio" class="css-checkbox" id="radio72" value="Gave Away" <?=(($apply5['ans26']=='Gave Away')?'checked':'')?> /><label for="radio72" class="css-label radGroup2"><span class="checkbox re_main4">Gave Away</span></label></td>
                                                                </tr>
                                                                <tr>
                                                                	<td height="25"><input name="ans115" type="radio" class="css-checkbox" id="radio73" value="Lost/Ran Away" <?=(($apply5['ans26']=='Lost/Ran Away')?'checked':'')?> /><label for="radio73" class="css-label radGroup2"><span class="checkbox re_main4">Lost/Ran Away</span></label></td>
                                                                </tr>
                                                                <tr>
                                                                	<td height="25"><input name="ans115" type="radio" class="css-checkbox" id="radio74" value="Euthanized" <?=(($apply5['ans26']=='Euthanized')?'checked':'')?> /><label for="radio74" class="css-label radGroup2"><span class="checkbox re_main4">Euthanized</span></label></td>
                                                                </tr>
                                                                <tr>
                                                                	<td height="25"><input name="ans115" type="radio" class="css-checkbox" id="radio75" value="Sold" <?=(($apply5['ans26']=='Sold')?'checked':'')?> /><label for="radio75" class="css-label radGroup2"><span class="checkbox re_main4">Sold</span></label></td>
                                                                </tr>
                                                                <tr>
                                                                	<td height="25"><input name="ans115" type="radio" class="css-checkbox" id="radio76" value="Other" <?=(($apply5['ans26']=='Other')?'checked':'')?> /><label for="radio76" class="css-label radGroup2"><span class="checkbox re_main4">Other </span><input class="textbox_box" type="text" name="ans116" value="<?=$apply5['ans27']?>" /></label></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Please provide details of the above incident(s)<br />including type of pet, age, reason(s), and<br />date occurred</span></td>
                                                        <td valign="top"><span class="re_main4"><textarea class="textbox_box4" name="ans117"><?=stripslashes($apply5['ans28'])?></textarea></span></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Prior experience with a shelter/rescue<br />group before</span></td>
                                                        <td valign="top">
                                                        	<table width="0" border="0" cellspacing="0" cellpadding="0">
                                                            	<tr>
                                                                	<td height="25"><input name="ans118" type="radio" class="css-checkbox" id="radio77" value="No" <?=(($apply5['ans29']=='No')?'checked':'')?> /><label for="radio77" class="css-label radGroup2"><span class="checkbox re_main4">No</span></label></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input name="ans118" type="radio" class="css-checkbox" id="radio78" value="Yes" <?=(($apply5['ans29']=='Yes')?'checked':'')?> /><label for="radio78" class="css-label radGroup2"><span class="checkbox re_main4">Yes (who) </span><input class="textbox_box" type="text" name="ans119" value="<?=$apply5['ans30']?>" /></label></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">What you liked about it</span></td>
                                                        <td valign="top"><input class="textbox_box5" type="text" name="ans120" value="<?=$apply5['ans31']?>" /></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">What you did not like about it</span></td>
                                                        <td valign="top"><input class="textbox_box5" type="text" name="ans121" value="<?=$apply5['ans32']?>" /></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                            	<td>&nbsp;</td>
                            </tr>
                            <tr>
                            	<td height="1" bgcolor="#C2CB56"></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                	<td>
                    	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                        	<tr>
                            	<td>&nbsp;</td>
                            </tr>
                            <tr>
                            	<td>
                                	<table width="0" border="0" cellspacing="0" cellpadding="3">
                                    	<tr>
                                        	<td><span class="ce_title17">TRAINING</span></td>
                                        </tr>
                                        <tr>
                                        	<td>
                                            	<table width="0" border="0" cellpadding="3" cellspacing="0">
                                                	<tr>
                                                    	<td width="237" align="right" valign="top"><span class="re_main4">Experience level:<br />(1=no experience, 5=lots of experience <br />very comfortablewith all types of dogs)</span></td>
                                                        <td valign="top">
                                                        	<table width="0" border="0" cellspacing="0" cellpadding="0">
                                                            	<tr>
                                                                	<td height="25"><input name="ans122" type="radio" class="css-checkbox" id="radio79" value="1" <?=(($apply6['ans1']=='1')?'checked':'')?> /><label for="radio79" class="css-label radGroup2"><span class="checkbox re_main4">1</span></label></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input name="ans122" type="radio" class="css-checkbox" id="radio80" value="2" <?=(($apply6['ans1']=='2')?'checked':'')?> /><label for="radio80" class="css-label radGroup2"><span class="checkbox re_main4">2</span></label></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input name="ans122" type="radio" class="css-checkbox" id="radio81" value="3" <?=(($apply6['ans1']=='3')?'checked':'')?> /><label for="radio81" class="css-label radGroup2"><span class="checkbox re_main4">3</span></label></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input name="ans122" type="radio" class="css-checkbox" id="radio82" value="4" <?=(($apply6['ans1']=='4')?'checked':'')?> /><label for="radio82" class="css-label radGroup2"><span class="checkbox re_main4">4</span></label></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input name="ans122" type="radio" class="css-checkbox" id="radio83" value="5" <?=(($apply6['ans1']=='5')?'checked':'')?> /><label for="radio83" class="css-label radGroup2"><span class="checkbox re_main4">5</span></label></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Have you or the primarycaregiver ever<br />attended any dog training classes</span></td>
                                                        <td valign="top">
                                                        	<table width="0" border="0" cellspacing="0" cellpadding="0">
                                                            	<tr>
                                                                	<td height="25"><input name="ans123" type="radio" class="css-checkbox" id="radio84" value="Yes" <?=(($apply6['ans2']=='Yes')?'checked':'')?> /><label for="radio84" class="css-label radGroup2"><span class="checkbox re_main4">Yes</span></label></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input name="ans123" type="radio" class="css-checkbox" id="radio85" value="No" <?=(($apply6['ans2']=='No')?'checked':'')?> /><label for="radio85" class="css-label radGroup2"><span class="checkbox re_main4">No</span></label></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">If you have attended training classes, details</span></td>
                                                        <td valign="top">
                                                        	<table width="0" border="0" cellspacing="0" cellpadding="0">
                                                            	<tr>
                                                                	<td align="left"><span class="re_main4">What Type</span></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input class="textbox_box" type="text" name="ans124" value="<?=$apply6['ans3']?>" /></td>
                                                                </tr>
                                                                <tr>
                                                                	<td align="left"><span class="re_main4">When</span></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input class="textbox_box" type="text" name="ans125" value="<?=$apply6['ans4']?>" /></td>
                                                                </tr>
                                                                <tr>
                                                                	<td align="left"><span class="re_main4">Where</span></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input class="textbox_box" type="text" name="ans126" value="<?=$apply6['ans5']?>" /></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Will you consider training if needed</span></td>
                                                        <td valign="top">
                                                        	<table width="0" border="0" cellspacing="0" cellpadding="0">
                                                            	<tr>
                                                                	<td height="30"><input name="ans127" type="radio" class="css-checkbox" id="radio86" value="Yes" <?=(($apply6['ans6']=='Yes')?'checked':'')?> /><label for="radio86" class="css-label radGroup2"><span class="checkbox re_main4">Yes</span></label></td>
                                                                </tr>
                                                                <tr>
                                                                	<td height="100" valign="top"><input name="ans127" type="radio" class="css-checkbox" id="radio87" value="No" <?=(($apply6['ans6']=='No')?'checked':'')?> /><label for="radio87" class="css-label radGroup2"><span class="checkbox re_main4">No (explain) </span><br /><textarea class="textbox_box4" name="ans128"><?=stripslashes($apply6['ans7'])?></textarea></label></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top" class="re_main4">Are you aware that not all rescue dogs are<br />completely house trained and<br />accidents may occur?</td>
                                                        <td valign="top">
                                                        	<table width="0" border="0" cellspacing="0" cellpadding="0">
                                                            	<tr>
                                                                	<td height="25"><input name="ans129" type="radio" class="css-checkbox" id="radio88" value="Yes" <?=(($apply6['ans8']=='Yes')?'checked':'')?> /><label for="radio88" class="css-label radGroup2"><span class="checkbox re_main4">Yes</span></label></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input name="ans129" type="radio" class="css-checkbox" id="radio89" value="No" <?=(($apply6['ans8']=='No')?'checked':'')?> /><label for="radio89" class="css-label radGroup2"><span class="checkbox re_main4">No</span></label></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4"> Would the dog not being fully housetrained <br />aﬀect your ability to provide <br />a permanent home</span></td>
                                                        <td valign="top">
                                                        	<table width="0" border="0" cellspacing="0" cellpadding="0">
                                                            	<tr>
                                                                	<td height="25"><input name="ans130" type="radio" class="css-checkbox" id="radio90" value="Yes" <?=(($apply6['ans9']=='Yes')?'checked':'')?> /><label for="radio90" class="css-label radGroup2"><span class="checkbox re_main4">Yes</span></label></td>
                                                                </tr>
                                                                <tr>
                                                                	<td height="100" valign="top"><input name="ans130" type="radio" class="css-checkbox" id="radio91" value="No" <?=(($apply6['ans9']=='No')?'checked':'')?> /><label for="radio91" class="css-label radGroup2"><span class="checkbox re_main4">No (explain)</span><br /><textarea class="textbox_box4" name="ans131"><?=stripslashes($apply6['ans10'])?></textarea></label></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                            	<td>&nbsp;</td>
                            </tr>
                            <tr>
                            	<td height="1" bgcolor="#C2CB56"></td>
                            </tr>
                        </table>
                    </td>
                </tr>
	            <tr>
	            	<td>
                    	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                        	<tr>
                            	<td>&nbsp;</td>
                            </tr>
                            <tr>
                            	<td>
                                	<table width="0" border="0" cellspacing="0" cellpadding="3">
                                    	<tr>
                                        	<td><span class="ce_title17">HOME INSPECTION/PHOTOGRAPHS</span></td>
                                        </tr>
                                        <tr>
                                        	<td>
                                            	<table width="0" border="0" cellpadding="3" cellspacing="0">
                                                	<tr>
                                                    	<td width="237" align="right" valign="top"><span class="re_main4">Please upload up to six of your home environment photos so that we can do a  preliminary home visit online. Photos of your family & pets, front house, living room, bedroom, kitchen area, garage,and yard are what we are looking for in order to determine if the home is safe for your new dog.</span></td>
                                                        <td valign="top">
														<div id="photos_list" style="width:100%; padding-top:5px"></div></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Agree that a representative from Adopt a Doggie<br />may schedule a visit to your homeupon request<br />to verify it is a suitable place for the dog,<br />which may include photographs</span></td>
                                                        <td valign="top">
                                                        	<table width="0" border="0" cellspacing="0" cellpadding="0">
                                                            	<tr>
                                                                	<td align="left" height="25"><input name="ans132" type="radio" class="css-checkbox" id="radio92" value="Yes" <?=(($apply7['ans1']=='Yes')?'checked':'')?> /><label for="radio92" class="css-label radGroup2"><span class="checkbox re_main4">Yes</span></label></td>
                                                                </tr>
                                                                <tr>
                                                                	<td align="left" height="100" valign="top"><input name="ans132" type="radio" class="css-checkbox" id="radio93" value="No" <?=(($apply7['ans1']=='No')?'checked':'')?> /><label for="radio93" class="css-label radGroup2"><span class="checkbox re_main4">No (explain) </span><br /><textarea class="textbox_box4" name="ans133"><?=stripslashes($apply7['ans2'])?></textarea></label></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                            	<td>&nbsp;</td>
                            </tr>
                            <tr>
                            	<td height="1" bgcolor="#C2CB56"></td>
                            </tr>
                        </table>
                    </td>
	            </tr>
	            <tr>
	            	<td>
                    	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                        	<tr>
                            	<td>&nbsp;</td>
                            </tr>
                            <tr>
                            	<td>
                                	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    	<tr>
                                        	<td><span class="ce_title17">REFERENCES</span></td>
                                        </tr>
                                        <tr>
                                        	<td>
                                            	<table width="0" border="0" cellspacing="0" cellpadding="3">
                                                	<tr>
                                                    	<td align="right" valign="top"><span class="re_main4"> Please provide the name and contact<br />information for two references that we may<br />contact who have knowledge of your ability<br />to care for a dog and can attest your<br />home is suitable for a dog </span></td>
                                                        <td valign="top">&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4"> Reference #1 Name </span></td>
                                                        <td valign="top"><input class="textbox_box" type="text" name="ans134" value="<?=$apply8['ans1']?>" /></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4"> Relationship to this reference </span></td>
                                                        <td valign="top"><input class="textbox_box" type="text" name="ans135" value="<?=$apply8['ans2']?>" /></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4"> Tel </span></td>
                                                        <td valign="top"><span class="re_main4">(<input class="textbox_box2" type="text" name="ans136" value="<?=$apply8['ans3']?>" />)<input class="textbox_box2" type="text" name="ans137" value="<?=$apply8['ans4']?>" /> - <input class="textbox_box2" type="text" name="ans138" value="<?=$apply8['ans5']?>" /></span></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4"> Email </span></td>
                                                        <td valign="top"><input class="textbox_box" type="text" name="ans139" value="<?=$apply8['ans6']?>" /></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4"> Home Address</span></td>
                                                        <td valign="top"><input class="textbox_box" type="text" name="ans140" value="<?=$apply8['ans7']?>" /></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4"> City </span></td>
                                                        <td valign="top"><input class="textbox_box" type="text" name="ans141" value="<?=$apply8['ans8']?>" /></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4"> State</span></td>
                                                        <td valign="top"><input class="textbox_box" type="text" name="ans142" value="<?=$apply8['ans9']?>" /></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4"> Zip Code </span></td>
                                                        <td valign="top"><input class="textbox_box3" type="text" name="ans143" value="<?=$apply8['ans10']?>" /></td>
                                                    </tr>
                                                    <tr>
                                                    	<td height="20" align="right" valign="top">&nbsp;</td>
                                                        <td valign="top">&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4"> Reference #2 Name</span></td>
                                                        <td valign="top"><input class="textbox_box" type="text" name="ans144" value="<?=$apply8['ans11']?>" /></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4"> Relationship to this reference</span></td>
                                                        <td valign="top"><input class="textbox_box" type="text" name="ans145" value="<?=$apply8['ans12']?>" /></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4"> Tel</span></td>
                                                        <td valign="top"><span class="re_main4">(<input class="textbox_box2" type="text" name="ans146" value="<?=$apply8['ans13']?>" />)<input class="textbox_box2" type="text" name="ans147" value="<?=$apply8['ans14']?>" /> - <input class="textbox_box2" type="text" name="ans148" value="<?=$apply8['ans15']?>" /></span></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4"> Email </span></td>
                                                        <td valign="top"><input class="textbox_box5" type="text" name="ans149" value="<?=$apply8['ans16']?>" /></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4"> Home Address</span></td>
                                                        <td valign="top"><input class="textbox_box5" type="text" name="ans150" value="<?=$apply8['ans17']?>" /></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4"> City </span></td>
                                                        <td valign="top"><input class="textbox_box" type="text" name="ans151" value="<?=$apply8['ans18']?>" /></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4"> State</span></td>
                                                        <td valign="top"><input class="textbox_box" type="text" name="ans152" value="<?=$apply8['ans19']?>" /></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4"> Zip Code </span></td>
                                                        <td valign="top"><input class="textbox_box3" type="text" name="ans153" value="<?=$apply8['ans20']?>" /></td>
                                                    </tr>
                                                    <tr>
                                                    	<td height="20" align="right" valign="top">&nbsp;</td>
                                                        <td valign="top">&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Child(ren)’s Experience with Dogs</span></td>
                                                        <td valign="top">
                                                        	<table width="0" border="0" cellspacing="0" cellpadding="0">
                                                            	<tr>
                                                                	<td height="25"><input name="ans154" type="radio" class="css-checkbox" id="radio94" value="Yes" <?=(($apply8['ans21']=='Yes')?'checked':'')?> /><label for="radio94" class="css-label radGroup2"><span class="checkbox re_main4">Yes</span></label></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input name="ans154" type="radio" class="css-checkbox" id="radio95" value="No" <?=(($apply8['ans21']=='No')?'checked':'')?> /><label for="radio95" class="css-label radGroup2"><span class="checkbox re_main4">No</span></label></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                    	<td width="237" align="right" valign="top"><span class="re_main4"> By signing this Adoption Application, you<br />attest that all of the information provided within is accurate and truthful to the best of your knowledge</span></td>
                                                        <td valign="top">
                                                        	<table width="0" border="0" cellspacing="0" cellpadding="3">
                                                                        	<tr>
                                                                            	<td height="25"><span class="re_main4">Name</span></td>
                                                                                <td><input class="text_line" type="text" name="ans155" value="<?=$apply8['ans22']?>" style="width:380px;" /></td>
                                                                            </tr>
                                                                        </table>
                                                            <table width="0" border="0" cellspacing="0" cellpadding="3">
                                                                        	<tr>
                                                                            	<td height="25"><span class="re_main4">Signature</span></td>
                                                                                <td><input class="text_line" type="text" name="ans156" value="<?=$apply8['ans23']?>" style="width:360px;" /></td>
                                                                            </tr>
                                                                        </table>
                                                            <table width="0" border="0" cellspacing="0" cellpadding="3">
                                                                        	<tr>
                                                                            	<td><span class="re_main4">Date</span></td>
                                                                                <td><input class="text_line" type="text" name="ans157" value="<?=$apply8['ans24']?>" style="width:387px;" /></td>

                                                              </tr>
                                                          </table>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                            	<td>&nbsp;</td>
                            </tr>
                            <tr>
                            	<td height="1" bgcolor="#C2CB56"></td>
                            </tr>
                        </table>
                    </td>
	            </tr>
	            <tr>
	            	<td>
                    	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                        	<tr>
                            	<td>&nbsp;</td>
                            </tr>
                            <tr>
                            	<td>
                                	<table width="0" border="0" cellspacing="0" cellpadding="3">
                                    	<tr>
                                        	<td><span class="ce_title17">OPTIONAL INFORMATION</span></td>
                                        </tr>
                                        <tr>
                                        	<td>
                                            	<table width="0" border="0" cellpadding="3" cellspacing="0">
                                                	<tr>
                                                    	<td width="237" align="right" valign="top"><span class="re_main4">How did you hear about Adopt a Doggie</span></td>
                                                        <td valign="top">
                                                        	<table width="0" border="0" cellspacing="0" cellpadding="2">
                                                            	<tr>
                                                                	<td>
                                                                    	<table width="0" border="0" cellspacing="0" cellpadding="0">
                                                                        	<tr>
                                                                            	<td><input name="ans158" type="checkbox" class="css-checkbox" id="radio96" value="Google" <?=(($apply9['ans1']=='Google')?'checked':'')?> /><label for="radio96"><span class="checkbox re_main4">Google</span></label></td>
                                                                                <td>&nbsp;</td>
                                                                                <td><input name="ans159" type="checkbox" class="css-checkbox" id="radio97" value="Petﬁnder" <?=(($apply9['ans2']=='Petﬁnder')?'checked':'')?> /><label for="radio97"><span class="checkbox re_main4">Petﬁnder</span></label></td>
                                                                                <td>&nbsp;</td>
                                                                                <td><input name="ans160" type="checkbox" class="css-checkbox" id="radio98" value="Yelp" <?=(($apply9['ans3']=='Yelp')?'checked':'')?> /><label for="radio98"><span class="checkbox re_main4">Yelp</span></label></td>
                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                	<td>
                                                                    	<table width="0" border="0" cellspacing="0" cellpadding="0">
                                                                        	<tr>
                                                                            	<td><input name="ans161" type="checkbox" class="css-checkbox" id="radio99" value="Yahoo" <?=(($apply9['ans4']=='Yahoo')?'checked':'')?> /><label for="radio99"><span class="checkbox re_main4">Yahoo</span></label></td>
                                                                                <td>&nbsp;</td>
                                                                                <td><input name="ans162" type="checkbox" class="css-checkbox" id="radio100" value="Facebook" <?=(($apply9['ans5']=='Facebook')?'checked':'')?> /><label for="radio100"><span class="checkbox re_main4">Facebook</span></label></td>
                                                                                <td>&nbsp;</td>
                                                                                <td><input name="ans163" type="checkbox" class="css-checkbox" id="radio101" value="Word of Mouth" <?=(($apply9['ans6']=='Word of Mouth')?'checked':'')?> /><label for="radio101"><span class="checkbox re_main4">Word of Mouth</span></label></td>
                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                	<td><input name="ans164" type="checkbox" class="css-checkbox" id="radio102" value="Owner of a Adopt a Doggie dog" <?=(($apply9['ans7']=='Owner of a Adopt a Doggie dog')?'checked':'')?> /><label for="radio102"><span class="checkbox re_main4">Owner of a Adopt a Doggie dog</span></label></td>
                                                                </tr>
                                                                <tr>
                                                                	<td><input name="ans165" type="checkbox" class="css-checkbox" id="radio103" value="Other" <?=(($apply9['ans8']=='Other')?'checked':'')?> /><label for="radio103"><span class="checkbox re_main4">Other</span></label></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Would you like to be invited to the Adopt a<br />Doggie Bay Area Dog Owners Facebook Page?</span></td>
                                                        <td valign="top">
                                                        	<table width="0" border="0" cellspacing="0" cellpadding="0">
                                                            	<tr>
                                                                	<td height="25"><input name="ans166" type="radio" class="css-checkbox" id="radio104" value="Yes" <?=(($apply9['ans9']=='Yes')?'checked':'')?> /><label for="radio104" class="css-label radGroup2"><span class="checkbox re_main4">Yes</span></label></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input name="ans166" type="radio" class="css-checkbox" id="radio105" value="No" <?=(($apply9['ans9']=='No')?'checked':'')?> /><label for="radio105" class="css-label radGroup2"><span class="checkbox re_main4">No</span></label></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Would you like to be included on the Adopt a<br />Doggie email list?</span></td>
                                                        <td valign="top">
                                                        	<table width="0" border="0" cellspacing="0" cellpadding="0">
                                                            	<tr>
                                                                	<td height="25"><input name="ans167" type="radio" class="css-checkbox" id="radio106" value="Yes" <?=(($apply9['ans10']=='Yes')?'checked':'')?> /><label for="radio106" class="css-label radGroup2"><span class="checkbox re_main4">Yes</span></label></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input name="ans167" type="radio" class="css-checkbox" id="radio107" value="No" <?=(($apply9['ans10']=='No')?'checked':'')?> /><label for="radio107" class="css-label radGroup2"><span class="checkbox re_main4">No</span></label></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">May we share your contact information with<br />your dog’s rescuer after the adoption is ﬁnalized?</span></td>
                                                        <td valign="top">
                                                        	<table width="0" border="0" cellspacing="0" cellpadding="0">
                                                            	<tr>
                                                                	<td height="25"><input name="ans168" type="radio" class="css-checkbox" id="radio108" value="Yes" <?=(($apply9['ans11']=='Yes')?'checked':'')?> /><label for="radio108" class="css-label radGroup2"><span class="checkbox re_main4">Yes</span></label></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input name="ans168" type="radio" class="css-checkbox" id="radio109" value="No" <?=(($apply9['ans11']=='No')?'checked':'')?> /><label for="radio109" class="css-label radGroup2"><span class="checkbox re_main4">No</span></label></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Additional comments or questions</span></td>
                                                        <td valign="top"><textarea class="textbox_box4" name="ans169"><?=stripslashes($apply9['ans12'])?></textarea></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                            	<td height="1" bgcolor="#C2CB56"></td>
                            </tr>
                        </table>
                    </td>
	            </tr>
	            <tr>
	            	<td>
                    	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                        	<tr>
                            	<td width="500"><span class="re_main5">Thank you for your interest in Adopt a Doggie and our rescued dogs! Our staff will review your application and let you know once it has been approved. We may contact you if there are any additional questions or concerns. Welcome to the Adopt a Doggie family!</td>
                            </tr>
                            <tr>
                            	<td>&nbsp;</td>
                            </tr>
                        </table>
                    </td>
	            </tr>
                <form method="post" action="<?=$_SERVER['PHP_SELF']?>" name="apply_form" id="apply_form">
                <input type="hidden" name="action" value="save" />
                <input type="hidden" name="apply_id" value="<?=$apply_id?>" />
                <input type="hidden" name="dog_id" value="<?=$apply1['dog_id']?>" />
                <input type="hidden" name="dog_id4" id="dog_id4" value="<?=$apply1['dog_id4']?>" />
                <input type="hidden" name="dog_name4" id="dog_name4" value="<?=$apply1['ans16']?>" />
                <input type="hidden" name="mail_toName" value="<?=$apply2['ans1'].' '.$apply2['ans3']?>" />
                <tr>
  	              <td height="150" align="left" valign="top"><div class="re_main4">
  	                <p>Process Adoption Application<br />
  	                Admin Initials <input name="mail_fromName" type="text" class="textbox_box" id="mail_fromName" value="<?=$_SESSION[Login_System_User]['id']?>" /></p>
  	                <p>Email Reply Address <input name="mail_to" type="text" class="textbox_box" id="mail_to" value="<?=$apply2['ans4']?>" /><input name="mail3" type="hidden" class="textbox_box4" value="<?=$apply1['remark']?>" /><br />
  	                (如要寄送兩人以上，請在兩個mail中間加上&quot;<span style="color:#F00; font-weight:bold;">,</span>&quot;，例如：AAA@mail.com<span style="color:#F00; font-weight:bold;">,</span>BBB@mail.com)</p>
  	                <!--<p><span style="color:#F00; font-weight:bold">Private Notes <input name="mail2" type="text" class="textbox_box" id="mail2" value="" /></span><br />
                    <span style="color:#F00; font-weight:bold">NEVER shared with applicant </span><br />
                    </p>-->
  	                <p>Set/Change Satus<br />
  	                  <select name="mail4" id="mail4" onChange="MM_jumpMenu('this',this,0)">
  	                    <option value="<?=$_SERVER['PHP_SELF']?>?apply_id=<?=$apply_id?>&sample_style=1" <?php if($sample_style==1){echo 'selected';} ?>>REPLY 1 - ABROAD</option>
  	                    <option value="<?=$_SERVER['PHP_SELF']?>?apply_id=<?=$apply_id?>&sample_style=2" <?php if($sample_style==2){echo 'selected';} ?>>REPLY 2 – LOCAL</option>
  	                    <option value="<?=$_SERVER['PHP_SELF']?>?apply_id=<?=$apply_id?>&sample_style=3" <?php if($sample_style==3){echo 'selected';} ?>>REPLY 3 – PENDING</option>
  	                    <option value="<?=$_SERVER['PHP_SELF']?>?apply_id=<?=$apply_id?>&sample_style=4" <?php if($sample_style==4){echo 'selected';} ?>>REPLY 4 – DENIED</option>
  	                    <option value="<?=$_SERVER['PHP_SELF']?>?apply_id=<?=$apply_id?>&sample_style=5" <?php if($sample_style==5){echo 'selected';} ?>>REPLY 5 – OPEN</option>
	                    </select>
  	                </p>

                    Subject: <input name="mail_subject" type="text" class="textbox_box" id="mail_subject" value="Adopt a Doggie" /><br />
					Agreement Link: <span id="agreement_link">http://adoptadoggie.org/adoption_1105b.php?dog_id=<?=$agree_dog_id?>&apply_id=<?=$apply_id?></span><br />
<textarea class="textbox_box4" name="mail_content" id="mail_content"><?=$mail_content?></textarea></div></td>
	              </tr>
				</form>
  	            <tr>
  	              <td height="150" align="center" valign="middle"><!--<span class="re_main4_btn"><a href="#" onClick="javascript:print();">Print</a></span> --><span class="re_main4_btn"><a onClick="javascript:$('#apply_form').submit();" style="cursor:pointer">Send</a></span><!--&nbsp;&nbsp;<span class="re_main4_btn"><a href="?save=1">Save to Html</a></span><br><br><br>How to save the PDF file：<span class="re_main6_btn"><a href="download/savetopdf_PC.pdf" target="new" style="width: 200px;">PC</a></span>&nbsp;、&nbsp;<span class="re_main6_btn"><a href="download/savetopdf_MAC.pdf" target="new" style="width: 200px;">MAC</a></span>--></td>
	              </tr>
	        </table>
		</td>
  <td width="20">&nbsp;</td>
        <td valign="top">
        	<table width="0" border="0" cellspacing="0" cellpadding="0">
            	<tr>
                	<td width="168" height="223" bgcolor="#D5E044">&nbsp;</td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</div>
<!----------- 內容 結束 ------------------>

</body>
</html>
