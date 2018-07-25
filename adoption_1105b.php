<?php
header("content-type:text/html;charset=utf-8");
require_once('set.php');
require_once(Root_Includes_Path.'class_sendmail.php');

$obj_mail = new sendmail();
$dog_id   = format_data($_GET['dog_id'], 'int');
$apply_id = format_data($_GET['apply_id'], 'int');

if($_POST['action']=='save') {
	$dog_id   = format_data($_POST['dog_id'], 'int');
	$apply_id = format_data($_POST['apply_id'], 'int');
	$text1    = format_data($_POST['text1'], 'text');
	$text2    = format_data($_POST['text2'], 'text');
	$text3    = format_data($_POST['text3'], 'text');
	$text4    = format_data($_POST['text4'], 'text');
	$text5    = format_data($_POST['text5'], 'text');
	$ans1     = format_data($_POST['ans1'], 'text');
	$ans2     = format_data($_POST['ans2'], 'text');
	$ans3     = format_data($_POST['ans3'], 'text');
	$ans4     = format_data($_POST['ans4'], 'text');
	$ans5     = format_data($_POST['ans5'], 'text');
	$ans6     = format_data($_POST['ans6'], 'text');
	$ans7     = format_data($_POST['ans7'], 'text');
	$ans8     = format_data($_POST['ans8'], 'text');
	$ans9     = format_data($_POST['ans9'], 'text');
	$ans10    = format_data($_POST['ans10'], 'text');
	$ans11    = format_data($_POST['ans11'], 'text');
	$ans12    = format_data($_POST['ans12'], 'text');
	$ans13    = format_data($_POST['ans13'], 'text');
	$ans14    = format_data($_POST['ans14'], 'text');
	$ans15    = format_data($_POST['ans15'], 'text');
	$ans16    = format_data($_POST['ans16'], 'text');
	$ans17    = format_data($_POST['ans17'], 'text');
	$ans18    = format_data($_POST['ans18'], 'text');
	$ans19    = format_data($_POST['ans19'], 'text');
	$ans20    = format_data($_POST['ans20'], 'text');
	$key_c    = format_data($_POST['key_c'], 'text');
	$key_c_c  = format_data($_POST['key_c_c'], 'text');
    //check check_code
	if(strtoupper($key_c) != strtoupper($key_c_c)) {
		js_a_l('Verification code error.', 'back');exit;
	}

	$query = "insert into ".$table_name_dogs."_agreement(dog_id, apply_id, text1, text2, text3, text4, text5, ans1, ans2, ans3, ans4, ans5, ans6, ans7, ans8, ans9, ans10, ans11, ans12, ans13, ans14, ans15, ans16, ans17, ans18, ans19, ans20, pub, create_time) values('$dog_id', '$apply_id', '$text1', '$text2', '$text3', '$text4', '$text5', '$ans1', '$ans2', '$ans3', '$ans4', '$ans5', '$ans6', '$ans7', '$ans8', '$ans9', '$ans10', '$ans11', '$ans12', '$ans13', '$ans14', '$ans15', '$ans16', '$ans17', '$ans18', '$ans19', '$ans20', 1, now())";
	$obj_dogs->run_mysql($query);
	$agreement_id = mysql_insert_id();
	//send mail
	$obj_mail->agreement($agreement_id);

	js_a_l('We have received your information will contact you as soon as possible, thank you.', 'back');exit;
}

//dogs
$query = "select * from $table_name_dogs where Fullkey='$dog_id'";
$dogs = $obj_dogs->run_mysql_out($query);
//application
$query = "select * from ".$table_name_dogs."_apply2 where apply_id='".$apply_id."'";
$apply2 = $obj_dogs->run_mysql_out($query);
$query = "select * from ".$table_name_dogs."_apply8 where apply_id='".$apply_id."'";
$apply8 = $obj_dogs->run_mysql_out($query);

$key_c_c = auto_checksum(4);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
<script type="text/javascript" src="scripts/jquery-1.10.2.min.js"></script>
<script language="javascript">
function real_save() {
	check = 0;
	if(!$("#ans1").val()) {
		alert("Please enter Signature Block of Adopter.");
        $("#ans1").focus();
		check++;
	}else if(!$("#ans7").val()) {
		alert("Please enter Email.");
        $("#ans7").focus();
		check++;
	}else if(!$("#ans8").val()) {
		alert("Please enter Cell.");
        $("#ans8").focus();
		check++;
	//}else if(!$("#ans9").val()) {
		//alert("Please enter Home.");
		//check++;
	}else if(!$("#key_c").val()) {
		alert("Please enter Verification Code.");
        $("#key_c").focus();
		check++;
	}
	if(check==0) {
		$("#agreement_form").submit();
	}
}
</script>
<style>
@font-face
{
	/*font-family: a;*/
	font-family: "Museo Sans 500";
	src: url('http://www.ftm.com.tw/demo/mary_02/font/MuseoSans.eot');
	src: url('http://www.ftm.com.tw/demo/mary_02/font/MuseoSans.eot?#iefix') format('embedded-opentype'),
	url('http://www.ftm.com.tw/demo/mary_02/font/MuseoSans.svg#Museo Sans 500') format('svg'),
	url('http://www.ftm.com.tw/demo/mary_02/font/MuseoSans.woff') format('woff'),
	url('http://www.ftm.com.tw/demo/mary_02/font/MuseoSans.ttf') format('truetype');
	font-weight: normal;
	font-style: normal;
}
@font-face
{
	/*font-family: b;*/
	font-family: "Museo Sans 500 Italic";
	src: url('http://www.ftm.com.tw/demo/mary_02/font/MuseoSans_500_Italic.eot');
	src: url('http://www.ftm.com.tw/demo/mary_02/font/MuseoSans_500_Italic.eot?#iefix') format('embedded-opentype'),
	url('http://www.ftm.com.tw/demo/mary_02/font/MuseoSans_500_Italic.svg#Museo Sans 500') format('svg'),
	url('http://www.ftm.com.tw/demo/mary_02/font/MuseoSans_500_Italic.woff') format('woff'),
	url('http://www.ftm.com.tw/demo/mary_02/font/MuseoSans_500_Italic.ttf') format('truetype');
	font-weight: normal;
	font-style: normal;
}
@font-face
{
	/*font-family: c;*/
	font-family: "Myriad Pro bold";
	src: url('http://www.ftm.com.tw/demo/mary_02/font/myriadprobold.eot');
	src: url('http://www.ftm.com.tw/demo/mary_02/font/myriadprobold.eot?#iefix') format('embedded-opentype'),
	url('http://www.ftm.com.tw/demo/mary_02/font/myriadprobold.svg#Myriad Pro') format('svg'),
	url('http://www.ftm.com.tw/demo/mary_02/font/myriadprobold.woff') format('woff'),
	url('http://www.ftm.com.tw/demo/mary_02/font/myriadprobold.ttf') format('truetype');
	font-weight: normal;
	font-style: normal;
}
@font-face
{
	/*font-family: j;*/
	font-family: "Myriad Pro";
	src: url('http://www.ftm.com.tw/demo/mary_02/font/MyriadPro-Regular.eot');
	src: url('http://www.ftm.com.tw/demo/mary_02/font/MyriadPro-Regular.eot?#iefix') format('embedded-opentype'),
	url('http://www.ftm.com.tw/demo/mary_02/font/MyriadPro-Regular.svg#Myriad Pro') format('svg'),
	url('http://www.ftm.com.tw/demo/mary_02/font/MyriadPro-Regular.woff') format('woff'),
	url('http://www.ftm.com.tw/demo/mary_02/font/MyriadPro-Regular.ttf') format('truetype');
	font-weight: normal;
	font-style: normal;
}
@font-face
{
	/*font-family: m;*/
	font-family: "HelveticaNeue-Bold";
	src: url('http://www.ftm.com.tw/demo/mary_02/font/HelveticaNeue-Bold.eot');
	src: url('http://www.ftm.com.tw/demo/mary_02/font/HelveticaNeue-Bold.eot?#iefix') format('embedded-opentype'),
	url('http://www.ftm.com.tw/demo/mary_02/font/HelveticaNeue-Bold.svg#HelveticaNeue') format('svg'),
	url('http://www.ftm.com.tw/demo/mary_02/font/HelveticaNeue-Bold.woff') format('woff'),
	url('http://www.ftm.com.tw/demo/mary_02/font/HelveticaNeue-Bold.ttf') format('truetype');
	font-weight: normal;
	font-style: normal;
}
@font-face
{
	font-family: "Helvetica Neue";
	src: url('http://www.ftm.com.tw/demo/mary_02/font/hlzc.eot');
	src: url('http://www.ftm.com.tw/demo/mary_02/font/hlzc.eot?#iefix') format('embedded-opentype'),
	url('http://www.ftm.com.tw/demo/mary_02/font/hlzc.svg#Helvetica Neue') format('svg'),
	url('http://www.ftm.com.tw/demo/mary_02/font/hlzc.woff') format('woff'),
	url('http://www.ftm.com.tw/demo/mary_02/font/hlzc.ttf') format('truetype');
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
	width: 250px;
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
</style>

<title>Agreement</title>

</head>

<body>

<!----------- 內容 開始 ------------------>
  	<div class="adoption">
      <form method="post" action="" name="agreement_form" id="agreement_form">
      <input type="hidden" name="action" value="save" />
      <input type="hidden" name="dog_id" value="<?=$dog_id?>" />
      <input type="hidden" name="apply_id" value="<?=$apply_id?>" />
      <input type="hidden" name="content" value="" />
  	  <table width="0" border="0" cellspacing="0" cellpadding="0">
  	    <tr>
  	      <td width="50">&nbsp;</td>
  	      <td></p>
  	        <table width="0" border="0" cellspacing="0" cellpadding="0">
  	        <tr>
  	          <td width="720" id="formcontent">
  	            <table width="0" border="0" cellspacing="0" cellpadding="5">
  	            <tr>
  	              <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
  	                <tr>
  	                  <td>
                      <span class="ce_title17">Adoption Agreement for

  	                  </span><input class="text_line2" type="text" value="<?=stripslashes($dogs['name'])?>" readonly /></td>
	                  </tr>
  	                <tr>
  	                  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
  	                    <tr>
  	                      <td width="190"><img src="dogs/<?=$dogs['file1']?>" width="190" /></td>
  	                      <td width="10">&nbsp;</td>
  	                      <td><table width="0" border="0" cellpadding="3" cellspacing="0">
  	                        <tr>
  	                          <td width="78" align="right" valign="top"><span class="re_main4">Gender :</span></td>
  	                          <td valign="top"><span class="re_main4">
  	                            <input class="textbox_box" type="text" value="<?=stripslashes($dogs['sex'])?>" readonly />
  	                          </span></td>
	                          </tr>
  	                        <tr>
  	                          <td align="right" valign="top"><span class="re_main4">Age :</span></td>
  	                          <td valign="top"><span class="re_main4">
  	                            <input class="textbox_box" type="text" value="<?=($dogs['years']>0)?stripslashes($dogs['years']).' year(s)':''?><?=($dogs['month'])?' '.$dogs['month'].' month(s)':''?>" readonly />
  	                          </span></td>
	                          </tr>
  	                        <tr>
  	                          <td align="right" valign="top"><span class="re_main4">Breed :</span></td>
  	                          <td valign="top"><span class="re_main4">
  	                            <input class="textbox_box"type="text" value="<?=stripslashes($dogs['breed'])?>" readonly />
  	                          </span></td>
	                          </tr>
  	                        <tr>
  	                          <td align="right" valign="top"><span class="re_main4">Color :</span></td>
  	                          <td valign="top"><span class="re_main4">
  	                            <input class="textbox_box"type="text" value="<?=stripslashes($dogs['color'])?>" readonly />
  	                          </span></td>
	                          </tr>
  	                        <tr>
  	                          <td colspan="2" align="left" valign="top"><table width="0" border="0" cellspacing="0" cellpadding="0">
  	                            <tr>
  	                                <td><span class="re_main4">Reproduction：</span></td>
  	                                <td>&nbsp;<input name="radiog_dark15" type="radio" class="css-checkbox" id="radio3" <?php if($dogs['neuter']==2){echo 'checked';} ?> />
  	                                      <label for="radio3" class="css-label radGroup2"><span class="checkbox re_main4">Spayed</span>&nbsp;&nbsp;</label></td>
  	                                <td><input name="radiog_dark15" type="radio" class="css-checkbox" id="radio4" <?php if($dogs['neuter']==1){echo 'checked';} ?> />
  	                                      <label for="radio4" class="css-label radGroup2"><span class="checkbox re_main4">Neutered</span></label></td>
	                                </tr>
	                              </table></td>
  	                          </tr>
	                        </table></td>
	                      </tr>
	                    </table></td>
	                  </tr>
  	                <tr>
  	                  <td width="100%">&nbsp;</td>
	                  </tr>
	                </table></td>
                </tr>
  	            <tr>
  	              <td><span class="re_main4">This Adoption Agreement is made on <input class="textbox_box2"type="text" name="text1" value="<?=date("Y")?>" />
/
<input class="textbox_box2"type="text" name="text2" value="<?=date("m")?>" />
  	                /
  	                <input class="textbox_box2"type="text" name="text3" value="<?=date("d")?>" /><input class="textbox_box" type="hidden" name="text4" value="0" />
by Adopt a Doggie (“AAD”), a California 501(c)(3) non-profit corporation and its representative(s) (hereinafter referred to as “Rescuer”) and <input class="textbox_box" type="text" name="text5" value="<?=$apply2['ans1'].' '.$apply2['ans3']?>" readonly />
                    (hereinafter referred to as "Adopter"). <br />
The purpose and intent of this Agreement is to provide loving and caring permanent homes for rescued dogs from near and far. All of the provisions of the Agreement are construed and intended to: (1) provide for the care of the Rescue Dog for the span of the Rescue Dog's natural life, (2) to provide families with loving dogs, and (3) to aid in the plague of homeless and street dogs that are vulnerable to the elements and other dangers, resulting in a shorter lifespan. The provisions herein are intended to ensure that the Rescue Dog remains healthy and cared for, and to provide for consequences and options in the event a Rescue Dog is unable to stay with the Adopter for the remainder of the Rescue Dog's natural life. The Adopter and other people who adopt from Adopt a Doggie are a huge reason dogs such as Rescue Dog can have a healthy and happy natural life and hopefully, bring exponential happiness to Adopter as well.<br />

The Adopter hereby acknowledges the following provisions: (Please initial next to each provision)<br /><br />
</span>
</td>
                </tr>
  	            <tr>
  	              <td><span class="re_main5">ADOPTION DONATION：</span><br />
                  <input class="text_line" type="text" name="p_name_01" style="width:30%" /><span class="re_main4">Adopter understands that the donation of  $399  made today to AAD will become part of its general funds to pay the necessary fees and expenses of animals that it rescues and is not a payment for this Rescue Dog, may be tax deductible, and is non-refundable.  This donation includes one complementary group training class at Cooperhaus K9 training in San Jose (valued at $90). <br /><br />
</span>  	             </td>
                </tr>
  	            <tr>
  	              <td><span class="re_main5">SPAY/NEUTER:</span><br />
                  <input class="text_line" type="text" name="p_name_01" style="width:30%" /><span class="re_main4">In most instances, the Rescue Dog, if age appropriate, will come to the Adopter with the gender appropriate spay or neuter operation already performed. AAD believes in responsible adoption practices and will not allow dogs that have no proof of successful spay or neuter operations to be adopted. By Agreement, the Adopter hereby agrees to have a gender appropriate spay or neuter operation performed on the Rescue Dog, if the Rescue Dog has not already been spayed or neutered, through an appointment scheduled by the Rescuer.  Adopter agrees to provide written verification of the Rescue Dog’s successful spay or neuter operation to the Rescuer within 14 business days of the scheduled appointment.  It is the responsibility of the Adopter, not the veterinarian, to ensure that Rescuer is provided with and has received the written verification of the operation.  In the event that Adopter does not comply with this policy, the Adopter understands and agrees to return the Rescue Dog to the Rescuer and will provide transportation. <br /><br />
                  </span>
                      </td>
                </tr>
  	            <tr>
  	              <td><span class="re_main5">CARE OF THE DOG：</span><br />
                  <input class="text_line" type="text" name="p_name_01" style="width:30%" /><span class="re_main4">Adopter agrees that this Rescue Dog is being adopted as a family member and will be given fresh water, wholesome dog food, adequate outdoor exercise, affection and shelter.  Adopter agrees that the Rescue Dog will not be used as a guard animal, or for any purpose other than as a companion to Adopter and to Adopter’s friends and family.  No alteration of the Rescue Dog’s appearance is permitted (i.e. docking of tails, ears).  Adopter understands that their unenclosed pool or spa may represent a deadly hazard to the Rescue Dog and agrees not to give the Rescue Dog access to the pool or spa until after the Rescue Dog has been trained to safely exit the pool or spa.<br /><br />
</span>
					</td>
                </tr>
  	            <tr>
  	              <td><span class="re_main5">COLLARS AND TAGS：</span><br />
                  <input class="text_line" type="text" name="p_name_01" style="width:30%" /><span class="re_main4">Adopter understands that the Rescue Dog will always have a leash, proper-fitting collar and proper identification tag that identifies Adopter at all times the Rescue Dog is outdoors or at events or public gatherings, without exception.<br /><br />
</span></td>
                </tr>
                <tr>
  	              <td><span class="re_main5">INITIAL LEASH AGREEMENT：</span><br />
                  <input class="text_line" type="text" name="p_name_01" style="width:30%" /><span class="re_main4">Adopter understands and agrees that the Rescue Dog must be kept on a leash at all times, 24 hours a day for the first 14 days that the Rescue Dog resides in your home, including, but not limited to, all times indoors and outdoors.  The Leash Agreement ensures the Rescue Dog’s initial bonding and safety with its new owners. <br /><br />
</span></td>
                </tr>
  	            <tr>
  	              <td><span class="re_main5">AGREEMENT NOT TO TRANSFER OWNERSHIP：</span><br />
                  <input class="text_line" type="text" name="p_name_01" style="width:30%" /><span class="re_main4">Adopter agrees that the Rescue Dog shall not be abandoned, sold, gifted, or adopted to anyone else, nor shall there be any transfer of ownership to any firm, corporation, or organization such as another rescue group, research facility or shelter without Rescuer's express written consent. The Adopter further agrees to not otherwise abandon the Rescue Dog. The Adopter hereby understands and agrees that a violation of this provision may result in the Adopter being responsible for any and all related court costs, attorney fees or any other costs reasonably incurred by Rescuer in order to regain possession and care for the Rescue Dog, including any costs associated with finding Rescue Dog a new permanent home<br /><br />
                    </span></td>
                </tr>
  	            <tr>
  	              <td><span class="re_main5">RETURN POLICY：</span><br />
                  <input class="text_line" type="text" name="p_name_01" style="width:30%" /><span class="re_main4">If, during the lifetime of the Rescue Dog, Adopter determines that adequate care or control of this animal can no longer be provided by Adopter, Adopter agrees to contact Rescuer and describe the changed circumstances. Rescuer reserves the right to, within 30 days after being notified of the changed circumstances, make any determination which in Rescuer’s sole discretion, is in the best interests of the Rescue Dog, including but not limited to rescinding the adoption and taking the Rescue Dog back into its care and control. Importantly, Adopter agrees to give Rescuer time to secure a kennel, and will provide safe and loving care of the Rescue Dog until it is returned. Adopter agrees to safely transport the Rescue Dog to the determined kennel or veterinarian facility, and will return any/all paperwork and supplies provided by Rescuer at the time. Adopter will be responsible for all costs associated with the Rescuer reclaiming the Rescue Dog. <br /><br />
                  </span>
                  <input class="text_line" type="text" name="p_name_01" style="width:30%" /><span class="re_main4">Adopter understands and agrees that if at any time Rescuer becomes aware of neglect, abuse, or failure to provide for the Rescue Dog’s care and control, Rescuer reserves the right to immediately rescind Adopter’s adoption of the Rescue Dog and take the Rescue Dog back into its care and control, without further notice. <br /><br />
                    </span></td>
                </tr>
  	            <tr>
  	              <td><span class="re_main5">ENVIRONMENT：</span><br />
                  <input class="text_line" type="text" name="p_name_01" style="width:30%" /><span class="re_main4">Adopter understands that the Rescue Dog shall be kept indoors or in an AAD-approved fenced backyard (as described herein). Adopter specifically agrees that the Rescue Dog shall reside in the AAD -approved home, and live as a family member and companion only. AAD does not recommend keeping the Rescue Dog outdoors while no one is at the Adopter's home, or at any other time left alone outdoors while the Adopter is not at home. If the Adopter chooses to ignore this provision, the Adopter does so at his or her own risk and accepts the responsibility if the Rescue Dog runs away, escapes, or is otherwise lost or injured. AAD recommends and expects the Rescue Dog may be confined to a room such as a bedroom or any other room of adequate size with access to food and water, if necessary and appropriate, and is protected from the elements of weather. The Adopter agrees not to expose the Rescue Dog to harmful objects, poisons, other living creatures, or situations that may endanger the Rescue Dog's life or well-being. The Rescue Dog should be crated for no longer than 8 hours in a 24 hour period. The crate must be large enough for Rescue Dog to lie comfortably on its side. AAD believes that an outside shelter, such as a doghouse, is not acceptable as a residence, but may be used only when needed in extreme heat, cold, or rain when the Rescue Dog is allowed in an AAD-approved fenced backyard for short periods of time and only when the Adopter is at home.<br /><br />
                    </span></td>
                </tr>
  	            <tr>
  	              <td><span class="re_main5">TEMPERAMENT：</span><br />
                  <input class="text_line" type="text" name="p_name_01" style="width:30%" /><span class="re_main4">Rescuer has made reasonable efforts to verify that the Rescue Dog is of good health and temperament.  However, Rescuer makes no explicit or implicit guarantees in reference to the health and/or temperament of the Rescue Dog.  The Rescue Dog is adopted "as is" and the Adopter assumes all responsibility for treatment of any and all existing conditions, or any other conditions of physical or temperament changes that may occur. Rescuer will provide Rescue Dog with basic vaccines and spay/neuter operation of the adopted dogs prior to adoption, if the age and current health of the Rescue Dog permits. While the Rescuer makes every effort to place only healthy animals, the Rescuer cannot guarantee the health of any animal, and the Rescuer is not held responsible for any medical expenses incurred by the Adopter after adoption. The Adopter understands and is aware of all behavioral or temperament of Rescue Dog as described by the Rescuer or the Adopt a Doggie website. The Adopter agrees to continue to work with the Rescue Dog. Adopt a Doggie and/or Rescuer will attempt to work with Adopter if a concern arises with the Rescue Dog's health and/or temperament, but in no way assumes any responsibility by making these additional efforts.<br /><br />
                    </span></td>
                </tr>
  	            <tr>
  	              <td><span class="re_main5">OBEDIANCE：</span><br />
                  <input class="text_line" type="text" name="p_name_01" style="width:30%" /><span class="re_main4">Adopter agrees and understands that they may need to take Rescue Dog to a beginner’s obedience class to teach basic obedience commands (sit, down, stay, etc.). Separation anxiety is a common issue some rescue dogs experience.  Adopter agrees to work with a trainer to resolve any behavior issues that should occur. <br /><br />
                    </span></td>
                </tr>
  	            <tr>
  	              <td><span class="re_main5">HEALTH PROGRAM：</span><br />
                  <input class="text_line" type="text" name="p_name_01" style="width:30%" /><span class="re_main4">Adopter understands that the Rescue Dog, regardless of the age at the time of adoption, shall: (I) remain on heartworm preventative indefinitely throughout the entire lifespan of the Rescue Dog, and (2) have yearly booster shots of DA2PP and Bordetella, with all costs to be the responsibility of the Adopter. Rescuer reserves the 1ight to verify with the Adopter's veterinarian that the heartworm preventative has been purchased, that the Rescue Dog has a yearly blood test for this purpose and that Rescue Dog's yearly vaccinations are current. In addition, the Adopter agrees to provide the Rescue Dog with any other medications or rabies vaccine or other vaccine(s) that are required by law where the Adopter resides. When Adopter adopts a Rescue Dog that is considered a puppy, the Rescue Dog shall begin heartworm preventative at 4 months of age when receiving the rabies shot as required by law. The Adopter agrees that within 4 weeks of adopting Rescue Dog, Rescue Dog will be seen by a veterinarian of Adopter's choosing and cost, to begin the heartworm preventative program and a recommended fecal test performed to ensure the Rescue Dog is free of parasites. Rescuer reserves the right to contact Adopter's veterinarian at any time to verify that all the basic health requirements have been performed. Adopter agrees to provide the best available care to the Rescue Dog in a timely manner.  Any veterinary problems that may arise, including serious illness requiring emergency care or surgery is Adopter’s responsibility and Adopter is responsible for all related costs. Rescuer strongly recommends Adopter consider pet insurance when adopting the Rescue Dog.<br /><br />
                    </span></td>
                </tr>
  	            <tr>
  	              <td><span class="re_main5">CHANGE OF ADDRESS AND NOTIFICATION：</span><br />
                  <input class="text_line" type="text" name="p_name_01" style="width:30%" /><span class="re_main4">Adopter agrees to notify the Rescuer no less than 10 business days prior to a change of address, or change of environment that will affect the Rescue Dog, and no more than 5 business days after any incident involving animal control and/or complaints arising from said ownership of the Rescue Dog.<br /><br />
                  </span>

                  <input class="text_line" type="text" name="p_name_01" style="width:30%" /><span class="re_main4">Adopter understands that this Rescue Dog is a rescued animal, and that no claims, representations, or warranties are made or implied by Rescuer as to this Rescue Dog’s age, breed, physical or mental characteristics, prior experiences, current or future health, behavior or temperament. <br /><br />
                  </span>

                  <input class="text_line" type="text" name="p_name_01" style="width:30%" /><span class="re_main4">Adopter understands and agrees that, as of the date of this Agreement, Rescuer has no further financial or legal liability as it relates in any way to this Rescue Dog, including but not limited to any damage to person(s) or property, or medical or other expenses.  Adopter agrees to indemnify and release Rescuer and its agents and representatives from any and all claims, damages, costs, expenses, loss of services, actions and causes of action belonging to the Adopter from the date of this Agreement and agrees to waive all future potential claims or causes of action on account of the adoption of the Rescue Dog.<br /><br />
                  </span>

                  <input class="text_line" type="text" name="p_name_01" style="width:30%" /><span class="re_main4">Adopter understands that Adopter may be recorded on film, video or other electronic recording media.  Adopter hereby consents to such recording and to the use by Rescuer of any recorded images or other media records or my name or likeness (the “Recordings”) for any purpose related to the furtherance of the objectives of Rescuer.  Adopter understands that any pictures Adopter sends to Rescuer of the Rescue Dog may be shared online to promote Rescuer.  Adopter understands that Adopter can inform Rescuer if Adopter wants his or her picture removed or if Adopter is not comfortable with being recorded on film, video or other electronic recording media. <br /><br />
                  </span>

                  <input class="text_line" type="text" name="p_name_01" style="width:30%" /><span class="re_main4">Adopter has been allowed sufficient time to consider the terms of this Agreement, and all parties enter into it in good faith and willingly. <br /><br />
                    </span></td>
                </tr>
  	            <tr>
  	              <td>
                  <table width="0" border="0" cellpadding="3" cellspacing="0">
  	                <tr>
  	                  <td align="right" valign="top"><span class="re_main4">Name of Adopter :</span><input class="textbox_box" type="hidden" name="ans1" id="ans1" value="0" /></td>
  	                  <td valign="top"><span class="re_main4">
  	                    <input class="textbox_box" type="text" name="ans2" id="ans2" value="<?=$apply2['ans1'].' '.$apply2['ans3']?>" />
  	                  </span></td>
	                  </tr>
  	                <tr>
  	                  <td align="right" valign="top"><span class="re_main4">Signature of Adopter :</span></td>
  	                  <td valign="top"><span class="re_main4">
  	                    <input class="textbox_box" type="text" name="ans3" id="ans3" value="<?=$apply2['ans1'].' '.$apply2['ans3']?>" />
  	                  </span></td>
	                  </tr>
  	                <tr>
  	                  <td align="right" valign="top"><span class="re_main4">Date Signed :</span></td>
  	                  <td valign="top"><span class="re_main4">
  	                    <input class="textbox_box" type="text" name="ans4" id="ans4" value="<?=date("F d, Y")?>" />
  	                  </span></td>
	                  </tr>
  	                <tr>
  	                  <td align="right" valign="top"><span class="re_main4">Address :</span></td>
  	                  <td valign="top"><span class="re_main4">
  	                    <input class="textbox_box" type="text" name="ans5" id="ans5" value="<?=$apply2['ans7']?>" />
  	                  </span></td>
	                  </tr>
  	                <tr>
  	                  <td align="right" valign="top"><span class="re_main4">City, State, Zip :</span></td>
  	                  <td valign="top"><span class="re_main4">
  	                    <input class="textbox_box" type="text" name="ans6" id="ans6" value="<?=$apply2['ans8'].', '.$apply2['ans9'].', '.$apply2['ans10']?>" />
  	                  </span></td>
	                  </tr>
  	                <tr>
  	                  <td align="right" valign="top"><span class="re_main4">Email :</span></td>
  	                  <td valign="top"><span class="re_main4">
  	                    <input class="textbox_box" type="text" name="ans7" id="ans7" value="<?=$apply2['ans4']?>" />
  	                  </span></td>
	                  </tr>
  	                <tr>
  	                  <td align="right" valign="top"><span class="re_main4">Tel ＃:</span></td>
  	                  <td valign="top"><span class="re_main4">
  	                    <input class="textbox_box" type="text" name="ans8" id="ans8" value="<?='('.$apply2['ans14'].')'.$apply2['ans15'].'-'.$apply2['ans16']?>" />
  	                  </span></td>
	                  </tr>
  	                <tr>
  	                  <td align="right" valign="top">&nbsp;</td>
  	                  <td valign="top">&nbsp;</td>
	                  </tr>
  	                <tr>
  	                  <td align="right" valign="top"><span class="re_main4">Second Name of Adopter :</span><input class="textbox_box" type="hidden" name="ans9" id="ans9" value="0" /></td>
  	                  <td valign="top"><span class="re_main4">
  	                    <input class="textbox_box" type="text" name="ans10" id="ans10" value="" />
  	                  </span></td>
	                  </tr>
  	                <tr>
  	                  <td align="right" valign="top"><span class="re_main4">Signature of Adopter :</span></td>
  	                  <td valign="top"><span class="re_main4">
  	                    <input class="textbox_box" type="text" name="ans11" id="ans11" value="" />
  	                  </span></td>
	                  </tr>
  	                <tr>
  	                  <td align="right" valign="top"><span class="re_main4">Date Signed :</span></td>
  	                  <td valign="top"><span class="re_main4">
  	                    <input class="textbox_box" type="text" name="ans12" id="ans12" value="" />
  	                  </span></td>
	                  </tr>
  	                <tr>
  	                  <td align="right" valign="top"><span class="re_main4">Address :</span></td>
  	                  <td valign="top"><span class="re_main4">
  	                    <input class="textbox_box" type="text" name="ans13" id="ans13" value="" />
  	                  </span></td>
	                  </tr>
  	                <tr>
  	                  <td align="right" valign="top"><span class="re_main4">City, State, Zip :</span></td>
  	                  <td valign="top"><span class="re_main4">
  	                    <input class="textbox_box" type="text" name="ans14" id="ans14" value="" />
  	                  </span></td>
	                  </tr>
  	                <tr>
  	                  <td align="right" valign="top"><span class="re_main4">Email :</span></td>
  	                  <td valign="top"><span class="re_main4">
  	                    <input class="textbox_box" type="text" name="ans15" id="ans15" value="" />
  	                  </span></td>
	                  </tr>
  	                <tr>
  	                  <td align="right" valign="top"><span class="re_main4">Tel ＃:</span></td>
  	                  <td valign="top"><span class="re_main4">
  	                    <input class="textbox_box" type="text" name="ans16" id="ans16" value="" />
  	                  </span></td>
	                  </tr>
                    <tr>
  	                  <td align="right" valign="top"><span class="re_main4">Verification Code:</span></td>
  	                  <td valign="top"><span class="re_main4">
  	                    <img src="tools/chucksum.php?key_c=<?=$key_c_c?>" alt="Change another verification code" id="rand-img" width="120" height="30" name="chucksumImg" border="1" style="cursor:hand" >
                        <input name="key_c" type="text" class="css-checkbox" id="key_c" value="" /><input name="key_c_c" type="hidden" id="key_c_c" value="<?=$key_c_c?>" />
  	                  </span></td>
	                  </tr>
                  </table></td>
                </tr>
  	            <tr>
  	              <td height="150" align="center" valign="middle"><!--<span class="re_main4_btn"><a href="#" onClick="javascript:print();">Print</a></span> --><span class="re_main4_btn"><a onClick="real_save()" style="cursor:pointer">Send</a></span><!--&nbsp;&nbsp;<span class="re_main4_btn"><a href="?save=1">Save to Html</a></span><br><br><br>How to save the PDF file：<span class="re_main6_btn"><a href="download/savetopdf_PC.pdf" target="new" style="width: 200px;">PC</a></span>&nbsp;、&nbsp;<span class="re_main6_btn"><a href="download/savetopdf_MAC.pdf" target="new" style="width: 200px;">MAC</a></span>--></td>
	              </tr>
                <tr>
  	              <td class="re_main_b"><div style="width:100%; height:70px; border-top:#D5E044 1px solid;"><span class="re_main5">Welcome to Adopt a Doggie’s big family!  Please email the signed adoption agreement to <a href="mailto:adoptions@adoptadoggie.org">adoptions@adoptadoggie.org</a>.  Once we received all your paper works, we will send you our welcome package with pick up information.  Thank you for your patience!</span></div></td>
	              </tr>
  	            <tr>
  	              <td>&nbsp;</td>
	              </tr>
  	            </table></td>
  	          <td width="20">&nbsp;</td>
  	          <td valign="top"><table width="0" border="0" cellspacing="0" cellpadding="0">
  	            <tr>
  	              <td width="168" height="223" bgcolor="#D5E044">&nbsp;</td>
                </tr>
	            </table></td>
            </tr>
          </table></td>
        </tr>
      </table>
      </form>
  	</div>
<!----------- 內容 結束 ------------------>

</body>
</html>
<?php include("include_bottom.php"); ?>
