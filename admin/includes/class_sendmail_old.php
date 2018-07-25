<?php
class sendmail {
	var $table_name_member;
	var $table_name_prod;
	var $table_name_order;
	var $obj_member;
	var $obj_dogs;
	var $obj_apply;
	var $obj_prod;
	var $obj_order;
	var $obj_order_d;
	var $sendmail;
	
	function sendmail() {	
		$this->table_name_member  = Proj_Name.'_member';
		$this->table_name_dogs    = Proj_Name.'_dogs';
		$this->table_name_order   = Proj_Name.'_orderlist';
		$this->table_name_prod    = Proj_Name.'_products';
		$this->obj_member         = new mysql_page();
		$this->obj_dogs           = new mysql_page();
		$this->obj_apply          = new mysql_page();
		$this->obj_prod           = new mysql_page();
		$this->obj_order          = new mysql_page();
		$this->obj_order_d        = new mysql_page();
		$this->sendmail           = new PHPMailer();	//phpmailer 設定	
		$this->sendmail->IsSMTP();
		$this->sendmail->CharSet  = "utf-8";	//設定信件字元編碼	
		$this->sendmail->Encoding = "base64";	//設定信件編碼，大部分郵件工具都支援此編碼方式	
		$this->sendmail->SMTPAuth = true;							//設定為安全驗證方式
		$this->sendmail->Host     = SMTP_Host;	//指定SMTP的服務器位址
		$this->sendmail->Port     = SMTP_Port;							//設定SMTP服務的POST
		$this->sendmail->Username = SMTP_Username;	//SMTP的帳號
		$this->sendmail->Password = SMTP_Password;					//SMTP的密碼
		$this->sendmail->IsHTML(true);	//設置郵件格式為HTML
	}
	//聯絡我們
	function contact_mail($name, $phone, $email, $content) {
		//phpmailer init
		$this->sendmail->From = $email;
		$this->sendmail->FromName = $name;
		$this->sendmail->AddReplyTo($email, $name);
		$this->sendmail->Subject = Html_Title.' 聯絡我們';
		$this->sendmail->AddAddress(Company_Email);
		
		$this->sendmail->Body = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
		<html>
		<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>'.Html_Title.' 聯絡我們</title>
		</head>
		
		<body>
		<table align="center" cellpadding=2 cellspacing=0 border=0 width="800">
			<tr><td>
			<table width=0 border=0 cellspacing=0 cellpadding=2>
			<tr>
				<td align="left"><p>姓名: '.$name.'</p><p>聯絡電話: '.$phone.'</p><p>E-mail: '.$email.'</p><p>訊息內容: '.$content.'</p></td>
			</tr>
			</table></td>
		  </tr>
		</table>
		</body></html>';
		
		//echo $this->sendmail->Body;exit;
		if(!$this->sendmail->Send()) {	 
			echo "錯誤!信件無法送出<br>";		 
			echo "Mailer 錯誤訊息>>>> " . $this->sendmail->ErrorInfo;	 
			exit;
		} 	
	}
	//agreement
	function agreement($agreement_id) {
		$query = "select * from ".$this->table_name_dogs."_agreement where Fullkey='$agreement_id'";
		$agree = $this->obj_dogs->run_mysql_out($query);
		//dogs
		$query = "select * from ".$this->table_name_dogs." where Fullkey='".$agree['dog_id']."'";
		$dogs  = $this->obj_dogs->run_mysql_out($query);
		
		$this->sendmail->Body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
<style>
@font-face
{
	/*font-family: a;*/
	font-family: "Museo Sans 500";
	src: url("http://adoptadoggie.org/font/MuseoSans.eot");
	src: url("http://adoptadoggie.org/font/MuseoSans.eot?#iefix") format("embedded-opentype"),
	url("http://adoptadoggie.org/font/MuseoSans.svg#Museo Sans 500") format("svg"),
	url("http://adoptadoggie.org/font/MuseoSans.woff") format("woff"),
	url("http://adoptadoggie.org/font/MuseoSans.ttf") format("truetype");
	font-weight: normal;
	font-style: normal;				
}
@font-face
{
	/*font-family: b;*/
	font-family: "Museo Sans 500 Italic";
	src: url("http://adoptadoggie.org/font/MuseoSans_500_Italic.eot");
	src: url("http://adoptadoggie.org/font/MuseoSans_500_Italic.eot?#iefix") format("embedded-opentype"),
	url("http://adoptadoggie.org/font/MuseoSans_500_Italic.svg#Museo Sans 500") format("svg"),
	url("http://adoptadoggie.org/font/MuseoSans_500_Italic.woff") format("woff"),
	url("http://adoptadoggie.org/font/MuseoSans_500_Italic.ttf") format("truetype");
	font-weight: normal;
	font-style: normal;
}
@font-face
{
	/*font-family: c;*/
	font-family: "Myriad Pro bold";
	src: url("http://adoptadoggie.org/font/myriadprobold.eot");
	src: url("http://adoptadoggie.org/font/myriadprobold.eot?#iefix") format("embedded-opentype"),
	url("http://adoptadoggie.org/font/myriadprobold.svg#Myriad Pro") format("svg"),
	url("http://adoptadoggie.org/font/myriadprobold.woff") format("woff"),
	url("http://adoptadoggie.org/font/myriadprobold.ttf") format("truetype");
	font-weight: normal;
	font-style: normal;
}
@font-face
{
	/*font-family: j;*/
	font-family: "Myriad Pro";
	src: url("http://adoptadoggie.org/font/MyriadPro-Regular.eot");
	src: url("http://adoptadoggie.org/font/MyriadPro-Regular.eot?#iefix") format("embedded-opentype"),
	url("http://adoptadoggie.org/font/MyriadPro-Regular.svg#Myriad Pro") format("svg"),
	url("http://adoptadoggie.org/font/MyriadPro-Regular.woff") format("woff"),
	url("http://adoptadoggie.org/font/MyriadPro-Regular.ttf") format("truetype");
	font-weight: normal;
	font-style: normal;
}
@font-face
{
	/*font-family: m;*/
	font-family: "HelveticaNeue-Bold";
	src: url("http://adoptadoggie.org/font/HelveticaNeue-Bold.eot");
	src: url("http://adoptadoggie.org/font/HelveticaNeue-Bold.eot?#iefix") format("embedded-opentype"),
	url("http://adoptadoggie.org/font/HelveticaNeue-Bold.svg#HelveticaNeue") format("svg"),
	url("http://adoptadoggie.org/font/HelveticaNeue-Bold.woff") format("woff"),
	url("http://adoptadoggie.org/font/HelveticaNeue-Bold.ttf") format("truetype");
	font-weight: normal;
	font-style: normal;
}
@font-face
{
	font-family: "Helvetica Neue";
	src: url("http://adoptadoggie.org/font/hlzc.eot");
	src: url("http://adoptadoggie.org/font/hlzc.eot?#iefix") format("embedded-opentype"),
	url("http://adoptadoggie.org/font/hlzc.svg#Helvetica Neue") format("svg"),
	url("http://adoptadoggie.org/font/hlzc.woff") format("woff"),
	url("http://adoptadoggie.org/font/hlzc.ttf") format("truetype");
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
/* IE9 SVG, needs conditional override of "filter" to "none" */
background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgdmlld0JveD0iMCAwIDEgMSIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+CiAgPGxpbmVhckdyYWRpZW50IGlkPSJncmFkLXVjZ2ctZ2VuZXJhdGVkIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgeDE9IjAlIiB5MT0iMCUiIHgyPSIwJSIgeTI9IjEwMCUiPgogICAgPHN0b3Agb2Zmc2V0PSIwJSIgc3RvcC1jb2xvcj0iIzAwMDAwMCIgc3RvcC1vcGFjaXR5PSIwLjE5Ii8+CiAgICA8c3RvcCBvZmZzZXQ9IjkyJSIgc3RvcC1jb2xvcj0iIzAwMDAwMCIgc3RvcC1vcGFjaXR5PSIwIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjEwMCUiIHN0b3AtY29sb3I9IiMwMDAwMDAiIHN0b3Atb3BhY2l0eT0iMCIvPgogIDwvbGluZWFyR3JhZGllbnQ+CiAgPHJlY3QgeD0iMCIgeT0iMCIgd2lkdGg9IjEiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+);
background: -moz-linear-gradient(top,  rgba(0,0,0,0.19) 0%, rgba(0,0,0,0) 92%, rgba(0,0,0,0) 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(0,0,0,0.19)), color-stop(92%,rgba(0,0,0,0)), color-stop(100%,rgba(0,0,0,0))); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top,  rgba(0,0,0,0.19) 0%,rgba(0,0,0,0) 92%,rgba(0,0,0,0) 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top,  rgba(0,0,0,0.19) 0%,rgba(0,0,0,0) 92%,rgba(0,0,0,0) 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top,  rgba(0,0,0,0.19) 0%,rgba(0,0,0,0) 92%,rgba(0,0,0,0) 100%); /* IE10+ */
background: linear-gradient(to bottom,  rgba(0,0,0,0.19) 0%,rgba(0,0,0,0) 92%,rgba(0,0,0,0) 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr="#30000000", endColorstr="#00000000",GradientType=0 ); /* IE6-8 */

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
	font-family: "Helvetica Neue";
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
						#messagebody div.rcmBody label.css-label {
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
						#messagebody div.rcmBody label.css-label2 {
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
						#messagebody div.rcmBody label.css-label2 {
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
	<p align="left">Agreement ID: '.$agreement_id.'</p>
      <form method="post" action="" name="agreement_form" id="agreement_form">
      <input type="hidden" name="action" value="save" />
      <input type="hidden" name="dog_id" value="'.$dog_id.'" />
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
  	              <td><table width="0" border="0" cellspacing="0" cellpadding="0">
  	                <tr>
  	                  <td><span class="ce_title17">Adoption Agreement for
  	                    
  	                  </span><input class="text_line2" type="text" value="'.stripslashes($dogs['name']).'" /></td>
	                  </tr>
  	                <tr>
  	                  <td><table width="0" border="0" cellspacing="0" cellpadding="0">
  	                    <tr>
  	                      <td><img src="'.Host_Name.'dogs/'.$dogs['file1'].'" width="190" /></td>
  	                      <td width="10">&nbsp;</td>
  	                      <td><table width="0" border="0" cellpadding="3" cellspacing="0">
  	                        <tr>
  	                          <td align="right" valign="top"><span class="re_main4">Gender :</span></td>
  	                          <td valign="top"><span class="re_main4">
  	                            <input class="textbox_box3" type="text" value="'.stripslashes($dogs['sex']).'" />
  	                          </span></td>
	                          </tr>
  	                        <tr>
  	                          <td align="right" valign="top"><span class="re_main4">Age :</span></td>
  	                          <td valign="top"><span class="re_main4">
  	                            <input class="textbox_box3" type="text" value="'.(($dogs['years']>0)?stripslashes($dogs['years']).' year(s)':'').''.(($dogs['month'])?' '.$dogs['month'].' month(s)':'').'" />
  	                          </span></td>
	                          </tr>
  	                        <tr>
  	                          <td align="right" valign="top"><span class="re_main4">Breed :</span></td>
  	                          <td valign="top"><span class="re_main4">
  	                            <input class="textbox_box3"type="text" value="'.stripslashes($dogs['breed']).'" />
  	                          </span></td>
	                          </tr>
  	                        <tr>
  	                          <td align="right" valign="top"><span class="re_main4">Color :</span></td>
  	                          <td valign="top"><span class="re_main4">
  	                            <input class="textbox_box3"type="text" value="'.stripslashes($dogs['color']).'" />
  	                          </span></td>
	                          </tr>
  	                        <tr>
  	                          <td colspan="2" align="left" valign="top"><table width="0" border="0" cellspacing="0" cellpadding="0">
  	                            <tr>
  	                                <td><span class="re_main4">Reproduction</span><span class="re_main4"> :</span></td>
  	                                <td><input name="radiog_dark15" type="radio" id="radio3" '.(($dogs['neuter']==2)?'checked':'').' />
  	                                      <label for="radio3" class="css-label radGroup2"><span class="checkbox re_main4">Spayed</span></label></td>
  	                                <td><input name="radiog_dark15" type="radio" id="radio4" '.(($dogs['neuter']==1)?'checked':'').' />
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
  	              <td><span class="re_main4">This Agreement made on
  	                <input class="textbox_box2"type="text" name="text1" value="'.$agree['text1'].'" />
/
<input class="textbox_box2"type="text" name="text2" value="'.$agree['text2'].'" />
  	                /
  	                <input class="textbox_box2"type="text" name="text3" value="'.$agree['text3'].'" />
by Adopt a Doggie (“Adopt a Doggie” or “AAD”) and is being entered into by 
Adopt a Doggie and its representative(s)
<!--<input class="textbox_box" type="text" name="text4" value="'.$agree['text4'].'" />-->
(collectively hereinafter referred to as "Rescuer"), and  
                                                        <input class="textbox_box" type="text" name="text5" value="'.$agree['text5'].'" />
                    (hereinafter referred to as "Adopter"). The Adopter hereby acknowledges, understands and promises that 
by ﬁnalizing the adoption, he, she or they release and will not hold the Rescuer, Adopt a Doggie, or its agents and representatives 
responsible or liable, for any and all claims, damages, costs, expenses, loss of services, actions and causes of action belonging to the 
Adopter, from the date of this Agreement and agrees to waive all future potential claims or causes of action on account of the adoption 
of the animal to be adopted, described below  (hereinafter referred to as “Rescue Dog”):
                    <br /><strong style="color:#F00">ADOPTER’S INITIALS：</strong><input class="text_line" type="text" name="p_name_01" style="width:60%" /><br /><br />
                    The Adopter hereby declares that no representations about the nature of the Rescue Dog, or any representations regarding the nature and extent of legal liability, or financial responsibility have induced the Adopter to enter into this Agreement.<br />
<br />
Adopt a Doggie and Adopter acknowledge the adoption fee/donation in the amount of $399 (with a refund of $50 upon completion of first dog training class at Cooperhaus K9 training in San Jose, CA) aids the reimbursement of expenses incurred during the rescue process, and is non-refundable except for as described herein.
</span><br /><br />
</td>
                </tr>
  	            <tr>
  	              <td><span class="re_main5">PURPOSE AND INTENT OF AGREEMENT：</span><br />
                  <span class="re_main4">The purpose and intent of this Agreement is to provide loving and caring permanent homes for rescued dogs from near and far.  All of 
the provisions of the Agreement are construed and intended to: (1) provide for the care of the Rescue Dog for the span of the Rescue 
Dog’s natural life, (2) to provide families with loving dogs, and (3) to aid in the plague of homeless and street dogs that are vulnerable 
to the elements and other dangers, resulting in a shorter lifespan.  The provisions herein are intended to ensure that the Rescue Dog 
remains healthy and cared for, and to provide for consequences and options in the event a Rescue Dog is unable to stay with the 
Adopter for the remainder of the Rescue Dog’s natural life.  The Adopter and other people who adopt from Adopt a Doggie are a huge 
reason dogs such as Rescue Dog can have a healthy and happy natural life and hopefully, bring exponential happiness to Adopter as 
well.</span>  	             </td>
                </tr>
  	            <tr>
  	              <td align="center"><span class="re_main5_r">The Adopter Hereby Acknowledges the Following Provisions: (Please initial next to each provision)</span></td>
                </tr>
  	            <tr>
  	              <td><span class="re_main5">FEE:</span><br />
                      <span class="re_main4">The adoption fee does not represent a sale price, but a promise to voluntarily make a donation that aids Rescuer for any and all medical, boarding, travel, rescue, or other related expenses, or any additional expenses incurred by the Rescuer in care of the Rescue Dog to ensure the Rescue Dog is ready for adoption.  This fee is non-refundable except as described herein or otherwise mutually agreed to in writing by Adopt a Doggie and Adopter.  Included in the adoption fee/donation includes a rebate of $50 to be refunded upon completion if first training at Cooperhaus K9 training in San Jose, CA.
                      <br /><strong style="color:#F00">ADOPTER’S INITIALS：</strong><input class="text_line" type="text" name="p_name_01" style="width:60%" /><br /><br />
                      </span>
                      </td>
                </tr>
				<tr>
  	              <td><span class="re_main5">REBATE OFFER：</span><br />
                    <span class="re_main4">Included in the adoption fee/donation discussed above is an offer for a $50 rebate which can be accepted upon completion of one group or private training session with Adopt a Doggie’s preferred trainer, Cooperhaus K9 in San Jose, CA.  Upon completion of the first training and verification by Cooperhaus K9, AAD will refund $50 to Adopter via check by mail or credit card refund (at AAD’s election of method) within 4-6 weeks of completion of the training session. Adopter must notify AAD of any address changes. 
                    <br /><strong style="color:#F00">ADOPTER’S INITIALS：</strong><input class="text_line" type="text" name="p_name_01" style="width:60%" /><br /><br />
                    </span>
					</td>
                </tr>
  	            <tr>
  	              <td><span class="re_main5">SPAY / NEUTER AGREEMENT：</span><br />
                    <span class="re_main4">This is an Agreement of MANDATORY Spay/Neuter in the event the Rescue Dog has not already had a successful spay or neuter operation. <strong>In most instances, the Rescue Dog, if age appropriate, will come to Adopter with the spayed or neutered operation already performed.</strong>This Agreement is only intended for a Rescue Dog where such operation has not already been successfully performed.  Adopt a Doggie believes in responsible adoption practices and will not allow dogs that have no proof of a successful spay or neuter operation to be adopted through Adopt a Doggie to help control the pet population in North America.  By this Agreement, the Adopter hereby agrees to have a gender-appropriate spay or neuter operation performed on the Rescue Dog through an appointment scheduled by the Rescuer and/or Adopt a Doggie.  Adopter agrees to provide written verification of the Rescue Dog’s successful spay/neuter operation by the Adopt a Doggie selected veterinarian to the Rescuer or Adopt a Doggie within fourteen (14) days of the scheduled appointment. It is the responsibility of the Adopter, not the veterinarian; to ensure Adopt a Doggie is provided with and has received the written verification. In the event Adopter breaches the Spay/Neuter Agreement, the Adopter agrees to return the Rescue Dog to Adopt a Doggie, including providing transportation, and understands the adoption fee will not be refunded.
<br /><strong style="color:#F00">ADOPTER’S INITIALS：</strong><input class="text_line" type="text" name="p_name_01" style="width:60%" /><br /><br />
</span>
					</td>
                </tr>
  	            <tr>
  	              <td><span class="re_main5">COLLARS AND TAGS：</span><br />
                    <span class="re_main4">The Adopter understands and agrees that the Rescue Dog will always have a leash, proper-ﬁtting collar and proper Identiﬁcation tag 
that identiﬁes Adopter and other owners at all times the Rescue Dog is outdoors, at events or publics gatherings, without exception.
<br /><strong style="color:#F00">ADOPTER’S INITIALS：</strong><input class="text_line" type="text" name="p_name_01" style="width:60%" /><br /><br />
</span></td>
                </tr>
                <tr>
  	              <td><span class="re_main5">INITIAL LEASH AGREEMENT：</span><br />
                    <span class="re_main4">The Adopter understands and agrees that the Rescue Dog must be kept on a leash at all times, 24 hours a day for the first fourteen (14) days Rescue Dog resides in your home, including but not limited to at all times indoors and outdoors.  The Leash Agreement ensures Rescue Dog’s successful initial bonding and safety with its new owners.  
<br /><strong style="color:#F00">ADOPTER’S INITIALS：</strong><input class="text_line" type="text" name="p_name_01" style="width:60%" /><br /><br />
</span></td>
                </tr>
  	            <tr>
  	              <td><span class="re_main5">AGREEMENT NOT TO TRANSFER OWNERSHIP：</span><br />
                    <span class="re_main4">Adopt a Doggie makes considerable effort to ensure that each home that Adopt a Doggie approved for an adoption meets certain standards.  The Adopter agrees that the Rescue Dog shall not be sold, gifted, or adopted to anyone else, nor shall there be any transfer of ownership to any firm, corporation, or organization such as another rescue group, research facility or shelter without AAD’s express written consent. The Adopter further agrees to not otherwise abandon the Rescue Dog.  If in the unlikely event the Adopter no longer is able to retain ownership and care for the Rescue Dog, the Adopter agrees to immediately contact Adopt a Doggie and/or the Rescuer.  Adopt a Doggie and/or Rescuer will take appropriate and reasonable steps to assist the Adopter if a concern arises with the Rescue Dog and his or her ability to permanently stay with Adopter.  Adopter agrees to foster Rescue Dog until AAD or Rescuer is able to place Rescue Dog in another home and to continue to be responsible for Rescue Dog’s well-being until a new adoption is finalized.  If AAD and/or Rescuer determine that formal training is required before Rescue Dog can be permanently placed in a new forever home, Adopter agrees to be responsible for those charges and agrees to work with AAD and/or Rescuer to find Rescue Dog a new forever home, including making Rescue Dog available for meet and greets with new prospective adopters.  The Adopter hereby understands and agrees that a violation of the Agreement Not to Transfer Ownership may result in the Adopter being responsible for any and all related court costs, attorney fees or any other costs reasonably incurred by Adopt a Doggie and/or Rescuer in order to regain possession and care for the Rescue Dog, including any costs associated with finding Rescue Dog a new permanent home.  
                    <br /><strong style="color:#F00">ADOPTER’S INITIALS：</strong><input class="text_line" type="text" name="p_name_01" style="width:60%" /><br /><br />
                    </span></td>
                </tr>
  	            <tr>
  	              <td><span class="re_main5">ENVIRONMENT：</span><br />
                    <span class="re_main4">The Rescue Dog shall be kept indoors or in an Adopt a Doggie-approved fenced backyard (as described herein).  Adopter specifically agrees that the Rescue Dog shall reside in the Adopt a Doggie-approved home, and live as a family member and companion only. Adopt a Doggie does not recommend keeping the Rescue Dog outdoors while no one is at the Adopter’s home, or at any other time left alone outdoors while the Adopter is not at home. If the Adopter chooses to ignore this provision, the Adopter does for extended periods of time and does so at his or her own risk and accepts the responsibility if the Rescue Dog runs away, escapes, or is otherwise lost or injured.  Adopt a Doggie recommends and expects the Rescue Dog may be confined to a room such as a bedroom, or any other room of adequate size with access to food and water, if necessary and appropriate, and is protected from the elements of weather. The Adopter agrees not to expose the Rescue Dog to harmful objects, poisons, other living creatures, or situations that may endanger the Rescue Dog’s life or well-being. The Rescue Dog should be crated for no longer than eight (8) hours in a twenty-four (24) hours period. The crate must be large enough for Rescue Dog to lie comfortably on its side. Adopt a Doggie believes that an outside shelter, such as a doghouse, is not acceptable as residence, but may be used only when needed in extreme heat, cold, or rain when the Rescue Dog is allowed in an Adopt a Doggie-approved fenced backyard for short periods of time and only when the Adopter is at home.
                    <br /><strong style="color:#F00">ADOPTER’S INITIALS：</strong><input class="text_line" type="text" name="p_name_01" style="width:60%" /><br /><br />
                    </span></td>
                </tr>
  	            <tr>
  	              <td><span class="re_main5">HEALTH PROGRAM：</span><br />
                    <span class="re_main4">The Rescue Dog, regardless of the age at the time of adoption, shall: (1) remain on heartworm preventative indefinitely throughout the entire lifespan of the Rescue Dog, and (2) have yearly booster shots of DA2PP and Bordatella, with all costs to be the responsibility of the Adopter.  Rescuer reserves the right to verify with the Adopter’s veterinarian that the heartworm preventative has been purchased, that the Rescue Dog has a yearly blood test for this purpose and that Rescue Dog’s yearly vaccinations are current. In addition, the Adopter agrees to provide the Rescue Dog with any other medications or rabies vaccine or other vaccine(s) that are required by law where the Adopter resides.  When Adopter adopts a Rescue Dog that is considered a puppy, the Rescue Dog shall begin heartworm preventative at four (4) months of age when receiving the rabies shot as required by law. The Adopter agrees that within four (4) weeks of adopting Rescue Dog, Rescue Dog will be seen by a veterinarian of Adopter’s choosing and cost, to begin the heartworm preventative program and a recommended fecal test performed to ensure the Rescue Dog is free of parasites. Rescuer reserves the right to contact Adopter’s veterinarian at any time to verify that all the basic health requirements have been performed.  Adopt a Doggie strongly recommends Adopter consider pet insurance when adopting Rescue Dog.
                    <br /><strong style="color:#F00">ADOPTER’S INITIALS：</strong><input class="text_line" type="text" name="p_name_01" style="width:60%" /><br /><br />
                    </span></td>
                </tr>
  	            <tr>
  	              <td><span class="re_main5">IMPORTANT NOTICE -- TEMPERAMENT：</span><br />
                    <span class="re_main4">Adopt a Doggie and Rescuer have made reasonable efforts to verify that the Rescue Dog is of good health and temperament, however, Rescuer and/or AAD make no explicit or implicit guarantees in reference to the health and/or temperament of the Rescue Dog. The Rescue Dog is adopted "as is" and the Adopter assumes all responsibility for treatment of any and all existing conditions, or any other conditions of physical or temperament changes that may occur. Rescuer will provide Rescue Dog with basic vaccines and spay/neuter operation of the adopted dogs prior to adoption, if the age and current health of the Rescue Dog permits. While the Rescuer makes every effort to place only healthy animals, the Rescuer cannot guarantee the health of any animal, and is not held responsible for any medical expenses incurred by the Adopter after adoption. The Adopter understands and is aware of all behavioral or temperament of Rescue Dog as described by the Rescuer or the Adopt a Doggie website. The Adopter agrees to continue to work with the Rescue Dog.  Adopt a Doggie and/or Rescuer will attempt to work with Adopter if a concern arises with the Rescue Dog’s health and/or temperament, but in no way assumes any responsibility by making these additional efforts.
                    <br /><strong style="color:#F00">ADOPTER’S INITIALS：</strong><input class="text_line" type="text" name="p_name_01" style="width:60%" /><br /><br />
                    </span></td>
                </tr>
  	            <tr>
  	              <td><span class="re_main5">REMEDY FOR NON--COMPLIANCE：</span><br />
                    <span class="re_main4">The Adopter specifically understands and agrees that Rescuer and/or Adopt a Doggie shall retain superior title in the Rescue Dog, limited to and for the express purpose of assuring the Rescue Dog’s well-being, and may only exercise its superior claim in the event it reasonably appears to the Rescuer or Adopt a Doggie that the proper and humane care, as specified in the above adoption provisions, are not being honored. In such very rare cases, the Rescue Dog may be confiscated from the Adopter by the Rescuer and/or Adopt a Doggie. The Adopter further agrees that if there is any breach or default of the terms of this Agreement, including if the Rescue Dog must be redeemed through a claim and delivery service, the Adopter is liable for all court costs and fees, attorneys’ fees or other related expenses to redeem the Rescue Dog.
                    <br /><strong style="color:#F00">ADOPTER’S INITIALS：</strong><input class="text_line" type="text" name="p_name_01" style="width:60%" /><br /><br />
                    </span></td>
                </tr>
  	            <tr>
  	              <td><span class="re_main5">COSMETIC SURGERY：</span><br />
                    <span class="re_main4"> The Adopter specifically agrees that unless directed by a licensed veterinarian for reasons related to the health and welfare of the Rescue Dog, cosmetic surgery will not be performed on the Rescue Dog under any circumstances, including, but not limited to, tail docking or ear cropping.
                    <br /><strong style="color:#F00">ADOPTER’S INITIALS：</strong><input class="text_line" type="text" name="p_name_01" style="width:60%" /><br /><br />
                    </span></td>
                </tr>
  	            <tr>
  	              <td><span class="re_main5">TRANSPORTATION：</span><br />
                    <span class="re_main4">The Adopter agrees that the Rescue Dog will not ride in the back of a pickup truck under any circumstances, including those such as in a cage/kennel, or tied. The Rescue Dog shall not remain in any vehicle in extreme heat, with windows down, or unattended for any amount of time.
                    <br /><strong style="color:#F00">ADOPTER’S INITIALS：</strong><input class="text_line" type="text" name="p_name_01" style="width:60%" /><br /><br />
                    </span></td>
                </tr>
  	            <tr>
  	              <td><span class="re_main5">ADEQUATE FENCING：</span><br />
                    <span class="re_main4">
                    The Adopter specifically agrees that the definition of an adequate fence is a fence that completely encloses a yard. An adequate fence is one that prevents the dog within to go out of the area by jumping, digging, or exiting through gates not properly secured. The fence will prevent any other animal from entering the property where the Rescue Dog resides, and will be secure enough to prevent intruders or small children from easily gaining entry. The adequate fence does not include a split rail, electric, or invisible fence and AAD prohibits these types of devices.  
                    <br /><strong style="color:#F00">ADOPTER’S INITIALS：</strong><input class="text_line" type="text" name="p_name_01" style="width:60%" /><br /><br />
                    </span></td>
                </tr>
  	            <tr>
  	              <td><span class="re_main5">RESCUER’S RESERVATION OF RIGHTS：</span><br />
                    <span class="re_main4">Rescuer reserves the right to follow up on the adoption of the Rescue Dog by Adopter and to inspect the Rescue Dog and where the animal is kept, for the sole purpose of determining compliance with the terms of the Agreement, by making one or more personal visits to the premises of the Adopter at any time during the entire lifespan of the Rescue Dog. If the terms and conditions of this Agreement are not upheld by the Adopter, and/or any misrepresentations have been made by the Adopter, the Rescuer reserves the right to terminate this Agreement.  The Adopter agrees to allow a representative of Rescuer or Adopt a Doggie to reclaim the Rescue Dog without notice or refund. The Adopter further agrees to pay liquidated damages, in the amount of $1,000.00 if the Adopter fails to comply with the Agreement terms, and/or willingly surrenders the Rescue Dog at the time the Rescuer receives notices of a breaching incident. Rescuer’s reservation of rights also includes the right to not adopt a dog into an area or environment that may endanger the life of the dog, which includes relocating with the dog after the adoption agreement without written notification to AAD. If the Rescue Dog becomes lost, stolen, seriously injured, and/or permanently disfigured, or for any reason the dog dies, the Rescuer must be notified within five (5) business days. Notification of Rescuer is to include all veterinarian, animal control, legal, and other paperwork.
                    <br /><strong style="color:#F00">ADOPTER’S INITIALS：</strong><input class="text_line" type="text" name="p_name_01" style="width:60%" /><br /><br />
                    </span></td>
                </tr>
  	            <tr>
  	              <td><span class="re_main5">CHANGE OF ADDRESS AND NOTIFICATION：</span><br />
                    <span class="re_main4">The Adopter agrees to notify Adopt a Doggie no less than ten (10) business days prior to change of address, or change of environment that may affect the Rescue Dog, and no more than five (5) business days after any incident involving animal control and/or complaints arising from said ownership of the Rescue Dog.
                    <br /><strong style="color:#F00">ADOPTER’S INITIALS：</strong><input class="text_line" type="text" name="p_name_01" style="width:60%" /><br /><br />
                    </span></td>
                </tr>
  	            <tr>
  	              <td><span class="re_main5">COSTS OF ENFORCEMENT：</span><br />
                    <span class="re_main4">
                    In the unlikely event it becomes necessary for Rescuer or Adopt a Doggie to take action to recover the Rescue Dog, or otherwise enforce the provisions of the Agreement, the undersigned Adopter(s) will be responsible for all court costs, all attorney fees representing, either the Adopter, Rescuer and/or Adopt a Doggie and any other related expenses.  
                    <br /><strong style="color:#F00">ADOPTER’S INITIALS：</strong><input class="text_line" type="text" name="p_name_01" style="width:60%" /><br /><br />
                    </span></td>
                </tr>
  	            <tr>
  	              <td><span class="re_main5">RIGHT OF OWNERSHIP：</span><br />
                    <span class="re_main4">The Rescue Dog, adopted from Adopt a Doggie, is the "sole property" of Adopt a Doggie at the time of adoption, and has been surrendered as such by private owners or animal facilities that have signed a statement agreeing that the above mentioned dog is not owned property of any other person, firm or organization. Rescuer shall not be held liable, charged, or chargeable for any misrepresentations unknown to Rescuer or Adopt a Doggie.
                    <br /><strong style="color:#F00">ADOPTER’S INITIALS：</strong><input class="text_line" type="text" name="p_name_01" style="width:60%" /><br /><br />
                    </span></td>
                </tr>
  	            <tr>
  	              <td><span class="re_main5">ADOPTER’S REASONABLE EFFORTS：</span><br />
                    <span class="re_main4">The Adopter specifically understands and agrees that there may be an adjustment period for both the Rescue Dog and the Adopter (and his/her/their family) when the Rescue Dog is placed in Adopter’s home.  The Adopter agrees to work with the Rescuer and/or Adopt a Doggie and make reasonable efforts and have reasonable patience to allow the Rescue Dog and Adopter to become comfortable.  Within thirty (30) days of the date the Rescue Dog is placed in Adopter’s home, Adopter may return Rescue Dog to Rescuer or Adopt a Doggie, provided that (1) Adopter has notified Rescuer or Adopt a Doggie of any concerns that may prevent Rescue Dog from permanently remaining in Adopter’s home within fifteen (15) days of the date of adoption; and (2) Adopter agrees to work with Rescuer, Adopt a Doggie and any Rescuer- or Adopt a Doggie-approved trainers or other support staff in an effort to resolve or lessen to the point of willingness to continue working to alleviate any of Adopter’s concerns, including but not limited to visits to Adopter’s home, or Adopter agreeing to transport Rescue Dog to one or more training sessions or other events intended  to alleviate Adopter’s concerns with Rescue Dog.   Under some circumstances, Rescuer and Adopter may agree in writing to extend the thirty (30) day period.
                    <br /><strong style="color:#F00">ADOPTER’S INITIALS：</strong><input class="text_line" type="text" name="p_name_01" style="width:60%" /><br /><br />
                    </span></td>
                </tr>
  	            <tr>
  	              <td><span class="re_main5">BINDING ON FUTURE PARTIES：</span><br />
                    <span class="re_main4">The Agreement shall be binding upon heirs, successors, assigns, and transferees of Adopter in the event the Rescue Dog is legally transferred to such person(s).
                    <br /><strong style="color:#F00">ADOPTER’S INITIALS：</strong><input class="text_line" type="text" name="p_name_01" style="width:60%" /><br /><br />
                    </span></td>
                </tr>
  	            <tr>
  	              <td><span class="re_main5">INVALID PROVISIONS：</span><br />
                    <span class="re_main4">If, after the date the Agreement is entered into, any provision of this Agreement is held to be illegal, invalid or unenforceable under present or future laws effective during the term of this Agreement, such provision shall be fully severable.  In the alternative, there shall be added a provision as similar in terms to such illegal, invalid or unenforceable provision as may be possible and be legal, valid and enforceable.
                    <br /><strong style="color:#F00">ADOPTER’S INITIALS：</strong><input class="text_line" type="text" name="p_name_01" style="width:60%" /><br /><br />
                    </span></td>
                </tr>
  	            <tr>
  	              <td><span class="re_main5">CALIFORNIA LAW GUIDES AGREEMENT：</span><br />
                    <span class="re_main4">This Agreement shall be construed and interpreted in accordance with the laws of the State of California, without regard to conflict of law provisions.
                    <br /><strong style="color:#F00">ADOPTER’S INITIALS：</strong><input class="text_line" type="text" name="p_name_01" style="width:60%" /><br /><br />
                    </span></td>
                </tr>
  	            <tr>
  	              <td><span class="re_main5">AGREEMENT OVERVIEW：</span><br />
                    <span class="re_main4">The undersigned Adopter hereby has read and acknowledges receipt of the above described animal and therefore agrees to all of the following terms:</span></td>
                </tr>
  	            <tr>
  	              <td><table width="0" border="0" cellspacing="0" cellpadding="0">
  	                  <tr>
  	                    <td valign="top"><span class="re_main4">1.</span></td>
  	                    <td valign="top"><span class="re_main4">The Rescue Dog will not be allowed oﬀ leash except within adequate fencing. Upon the dog’s arrival, if the Rescue Dog is lost, 
Adopter will be responsible for all search and rescue costs.  AAD does not assume any responsibility if it assists with the search and 
rescue.</span></td>
                      </tr>
                      <tr>
  	                    <td valign="top"><span class="re_main4">2.</span></td>
  	                    <td valign="top"><span class="re_main4">The Rescue Dog will remain on a leash </span><span class="re_main4" style="text-decoration:underline;">at all times</span> <span class="re_main4">for the first fourteen (14) days of ownership for bonding and safety purposes.</span></td>
                      </tr>
  	                  <tr>
  	                    <td valign="top"><span class="re_main4">3.</span></td>
  	                    <td valign="top"><span class="re_main4">The Rescue Dog will not be chained to a doghouse, or chained outside to any type of object or outbuilding. </span></td>
                      </tr>
  	                  <tr>
  	                    <td valign="top"><span class="re_main4">4.</span></td>
  	                    <td valign="top"><span class="re_main4">The Rescue Dog will wear a properly-fitting collar or harness with an ID tag at all times outside of Adopter’s home or secured property. </span></td>
                      </tr>
  	                  <tr>
  	                    <td valign="top"><span class="re_main4">5.</span></td>
  	                    <td valign="top"><span class="re_main4">Shelter from weather must be provided for the Rescue Dog at any time that the Rescue Dog is outside, if the weather is extreme heat, extreme cold, or any other weather condition that may endanger the health of the Rescue Dog. The Rescue Dog is not to remain solely in a crate while indoors, only while Adopter is not at home, if at all, and not for more than eight (8) hours a day.</span></td>
                      </tr>
  	                  <tr>
  	                    <td valign="top"><span class="re_main4">6.</span></td>
  	                    <td valign="top"><span class="re_main4">The Rescue Dog should not to be left with small children at any time when unattended by an adult. </span></td>
                      </tr>
  	                  <tr>
  	                    <td valign="top"><span class="re_main4">7.</span></td>
  	                    <td valign="top"><span class="re_main4">The Adopter must keep the Rescuer and/or Adopt a Doggie informed with the name of Rescue Dog\'s veterinarian. </span></td>
                      </tr>
  	                  <tr>
  	                    <td valign="top"><span class="re_main4">8.</span></td>
  	                    <td valign="top"><span class="re_main4">The Rescue Dog must remain on heartworm preventative year round and receive annual shots and other proper veterinary care. </span></td>
                      </tr>
  	                  <tr>
  	                    <td valign="top"><span class="re_main4">9.</span></td>
  	                    <td valign="top"><span class="re_main4">The Rescue Dog is to have adequate food, water, and shelter at all times. </span></td>
                      </tr>
  	                  <tr>
  	                    <td valign="top"><span class="re_main4">10.</span></td>
  	                    <td valign="top"><span class="re_main4">The Adopter shall not cause physical abuse to Rescue Dog or treat Rescue Dog in an inhumane manner. </span></td>
                      </tr>
                      <tr>
  	                    <td valign="top"><span class="re_main4">11.</span></td>
  	                    <td valign="top"><span class="re_main4">Adopt a Doggie makes no guarantees about the Rescue Dog\'s temperament, behavior and/or health aside from what is provided to the Adopter prior to finalization of adoption and/or contained on Adopt A Doggie’s website.</span></td>
                      </tr>
  	                  <tr>
  	                    <td valign="top"><span class="re_main4">12.</span></td>
  	                    <td valign="top"><span class="re_main4">All fees are non-refundable except as otherwise described in this Agreement.</span></td>
                      </tr>
  	                  <tr>
  	                    <td valign="top"><span class="re_main4">13.</span></td>
  	                    <td valign="top"><span class="re_main4">Adopter understands the requirements to obtain $50 refund of the adoption fee/donation. </span></td>
                      </tr>
  	                  <tr>
  	                    <td valign="top"><span class="re_main4">14.</span></td>
  	                    <td valign="top"><span class="re_main4">The Adopter must notify the Rescuer no less than ten (10) business days prior to change of address or location.</span></td>
                      </tr>
                  </table></td>
                </tr>
  	            <tr>
  	              <td><span class="re_main_b">By Adopter placing his or her initials here, he or she understands and agrees to all of the terms of the</span> <span class="re_main5">AGREEMENT.</span>
                  <span class="re_main4">
                  <br /><strong style="color:#F00">OVERVIEW：</strong><input class="text_line" type="text" name="p_name_01" style="width:60%" /><br /><br />
                  </span>
                  </td>
                </tr>
                <tr>
  	              <td><span class="re_main_b"><strong>By Adopter signing his or her signature below, he or she agrees to abide by all of the terms of the Adoption Agreement even if he or she does not initial next to all of the boxes where initials are requested throughout the Agreement.</strong></span>
                  </td>
                </tr>
  	            <tr>
  	              <td><table width="0" border="0" cellspacing="0" cellpadding="0">
  	                <tr>
  	                  <td><img src="'.Host_Name.'dogs/'.$dogs['file1'].'" width="137"/></td>
  	                  <td width="10">&nbsp;</td>
  	                  <td><table width="0" border="0" cellpadding="3" cellspacing="0">
  	                    <tr>
  	                      <td align="right" valign="top"><span class="re_main4">Gender :</span></td>
  	                      <td valign="top"><span class="re_main4">
  	                        <input class="textbox_box3" type="text" value="'.stripslashes($dogs['sex']).'" />
	                        </span></td>
	                      </tr>
  	                    <tr>
  	                      <td align="right" valign="top"><span class="re_main4">Age :</span></td>
  	                      <td valign="top"><span class="re_main4">
  	                        <input class="textbox_box3" type="text" value="'.(($dogs['years']>0)?stripslashes($dogs['years']).' year(s)':'').(($dogs['month'])?' '.$dogs['month'].' month':'').'" />
	                        </span></td>
	                      </tr>
  	                    <tr>
  	                      <td align="right" valign="top"><span class="re_main4">Breed :</span></td>
  	                      <td valign="top"><span class="re_main4">
  	                        <input class="textbox_box3" type="text" value="'.stripslashes($dogs['breed']).'"/>
	                        </span></td>
	                      </tr>
  	                    <!--<tr>
  	                      <td align="right" valign="top"><span class="re_main4">Color :</span></td>
  	                      <td valign="top"><span class="re_main4">
  	                        <input class="textbox_box3" type="text" value="帶入狗狗資料"/>
	                        </span></td>
	                      </tr>-->
  	                    <tr>
  	                      <td colspan="2" align="left" valign="top"><table width="0" border="0" cellspacing="0" cellpadding="0">
  	                        <tr>
  	                          <td><span class="re_main4">Reproduction</span><span class="re_main4"> :</span></td>
  	                          <td><input name="radiog_dark16" type="radio" class="css-checkbox" id="radio" '.(($dogs['neuter']==2)?'checked':'').' />
  	                                <label for="radio" class="css-label radGroup2"><span class="checkbox re_main4">Spayed</span></label></td>
  	                          <td><input name="radiog_dark16" type="radio" class="css-checkbox" id="radio2" '.(($dogs['neuter']==1)?'checked':'').' />
  	                                <label for="radio2" class="css-label radGroup2"><span class="checkbox re_main4">Neutered</span></label></td>
	                          </tr>
	                        </table></td>
	                      </tr>
	                    </table></td>
	                  </tr>
                  </table></td>
                </tr>
  	            <tr>
  	              <td><table width="0" border="0" cellpadding="3" cellspacing="0">
  	                <tr>
  	                  <td align="right" valign="top"><span class="re_main4">Printed Name of Adopter :</span></td>
  	                  <td valign="top"><span class="re_main4">
  	                    <input class="textbox_box" type="text" name="ans2" value="'.$agree['ans2'].'" />
  	                  </span></td>
	                  </tr>
  	                <tr>
  	                  <td align="right" valign="top"><span class="re_main4">Signature of Adopter :</span></td>
  	                  <td valign="top"><span class="re_main4">
  	                    <input class="textbox_box" type="text" name="ans3" value="'.$agree['ans3'].'" />
  	                  </span></td>
	                  </tr>
  	                <tr>
  	                  <td align="right" valign="top"><span class="re_main4">Date Signed :</span></td>
  	                  <td valign="top"><span class="re_main4">
  	                    <input class="textbox_box" type="text" name="ans4" value="'.$agree['ans4'].'" />
  	                  </span></td>
	                  </tr>
  	                <tr>
  	                  <td align="right" valign="top"><span class="re_main4">Address :</span></td>
  	                  <td valign="top"><span class="re_main4">
  	                    <input class="textbox_box" type="text" name="ans5" value="'.$agree['ans5'].'" />
  	                  </span></td>
	                  </tr>
  	                <tr>
  	                  <td align="right" valign="top"><span class="re_main4">City, State, Zip :</span></td>
  	                  <td valign="top"><span class="re_main4">
  	                    <input class="textbox_box" type="text" name="ans6" value="'.$agree['ans6'].'" />
  	                  </span></td>
	                  </tr>
  	                <tr>
  	                  <td align="right" valign="top"><span class="re_main4">Email :</span></td>
  	                  <td valign="top"><span class="re_main4">
  	                    <input class="textbox_box" type="text" name="ans7" value="'.$agree['ans7'].'" />
  	                  </span></td>
	                  </tr>
  	                <tr>
  	                  <td align="right" valign="top"><span class="re_main4">Cell :</span></td>
  	                  <td valign="top"><span class="re_main4">
  	                    <input class="textbox_box" type="text" name="ans8" value="'.$agree['ans8'].'" />
  	                  </span></td>
	                  </tr>
  	                <tr>
  	                  <td align="right" valign="top"><span class="re_main4">Home :</span></td>
  	                  <td valign="top"><span class="re_main4">
  	                    <input class="textbox_box" type="text" name="ans9" value="'.$agree['ans9'].'" />
  	                  </span></td>
	                  </tr>
  	                <tr>
  	                  <td align="right" valign="top"><span class="re_main4">Work :</span></td>
  	                  <td valign="top"><span class="re_main4">
  	                    <input class="textbox_box" type="text" name="ans10" value="'.$agree['ans10'].'" />
  	                  </span></td>
	                  </tr>
                  </table></td>
                </tr>
  	            <tr>
  	              <td>&nbsp;</td>
                </tr>
  	            <!--<tr>
  	              <td><span class="re_main_b"><strong>Adopter may list anyone else, including family members, that will be Additional Parties to, and bound by the Agreement:</strong></span></td>
	              </tr>
  	            <tr>
  	              <td><table width="0" border="0" cellpadding="3" cellspacing="0">
  	                <tr>
  	                  <td align="right" valign="top"><span class="re_main4">Signature Block of Adopter :</span></td>
  	                  <td valign="top"><span class="re_main4">
  	                    <input class="textbox_box" type="text" name="ans11" value="'.$agree['ans11'].'" />
	                    </span></td>
	                  </tr>
  	                <tr>
  	                  <td align="right" valign="top"><span class="re_main4">Printed Name of Adopter :</span></td>
  	                  <td valign="top"><span class="re_main4">
  	                    <input class="textbox_box" type="text" name="ans12" value="'.$agree['ans12'].'" />
	                    </span></td>
	                  </tr>
  	                <tr>
  	                  <td align="right" valign="top"><span class="re_main4">Signature of Adopter :</span></td>
  	                  <td valign="top"><span class="re_main4">
  	                    <input class="textbox_box" type="text" name="ans13" value="'.$agree['ans13'].'" />
	                    </span></td>
	                  </tr>
  	                <tr>
  	                  <td align="right" valign="top"><span class="re_main4">Date Signed :</span></td>
  	                  <td valign="top"><span class="re_main4">
  	                    <input class="textbox_box" type="text" name="ans14" value="'.$agree['ans14'].'" />
	                    </span></td>
	                  </tr>
  	                <tr>
  	                  <td align="right" valign="top"><span class="re_main4">Address :</span></td>
  	                  <td valign="top"><span class="re_main4">
  	                    <input class="textbox_box" type="text" name="ans15" value="'.$agree['ans15'].'" />
	                    </span></td>
	                  </tr>
  	                <tr>
  	                  <td align="right" valign="top"><span class="re_main4">City, State, Zip :</span></td>
  	                  <td valign="top"><span class="re_main4">
  	                    <input class="textbox_box" type="text" name="ans16" value="'.$agree['ans16'].'" />
	                    </span></td>
	                  </tr>
  	                <tr>
  	                  <td align="right" valign="top"><span class="re_main4">Email :</span></td>
  	                  <td valign="top"><span class="re_main4">
  	                    <input class="textbox_box" type="text" name="ans17" value="'.$agree['ans17'].'" />
	                    </span></td>
	                  </tr>
  	                <tr>
  	                  <td align="right" valign="top"><span class="re_main4">Cell :</span></td>
  	                  <td valign="top"><span class="re_main4">
  	                    <input class="textbox_box" type="text" name="ans18" value="'.$agree['ans18'].'" />
	                    </span></td>
	                  </tr>
  	                <tr>
  	                  <td align="right" valign="top"><span class="re_main4">Home :</span></td>
  	                  <td valign="top"><span class="re_main4">
  	                    <input class="textbox_box" type="text" name="ans19" value="'.$agree['ans19'].'" />
	                    </span></td>
	                  </tr>
  	                <tr>
  	                  <td align="right" valign="top"><span class="re_main4">Work :</span></td>
  	                  <td valign="top"><span class="re_main4">
  	                    <input class="textbox_box" type="text" name="ans20" value="'.$agree['ans20'].'" />
	                    </span></td>
	                  </tr>
                  </table></td>
	              </tr>-->
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
</html>';		
		//echo $this->sendmail->Body;exit;
		//phpmailer init
		if($agree['ans7'] && $agree['ans2']) {
			$this->sendmail->From = Company_Email;
			$this->sendmail->FromName = Company_Name;
			$this->sendmail->AddReplyTo(Company_Email, Company_Name);
			$this->sendmail->Subject = Html_Title.' Agreement';
			$this->sendmail->AddAddress($agree['ans7'], $agree['ans2']);
			if(!$this->sendmail->Send()) {	 
				echo "錯誤!信件無法送出<br>";		 
				echo "Mailer 錯誤訊息>>>> " . $this->sendmail->ErrorInfo;	 
			} 	
			//echo $this->sendmail->Host.'/'.Company_Email.'/'.Company_Name.'/'.$agree['ans7'].'/'.$agree['ans2'];
			$this->sendmail->Subject = 'Adopt a Doggie Agreement Received';
			$this->sendmail->ClearAddresses();
			$this->sendmail->AddAddress('adoption@adoptadoggie.org', Company_Name);
			if(!$this->sendmail->Send()) {	 
				echo "錯誤!Admin信件無法送出<br>";		 
				echo "Mailer 錯誤訊息>>>> " . $this->sendmail->ErrorInfo;	 
			} 
			//echo $this->sendmail->From.'/'.$this->sendmail->FromName.'/'.$this->sendmail->Subject.'/'.$agree['ans7'].'/'.$agree['ans2'];	
		}
	}
	//apply
	function apply($apply_id) {	
		$obj_images = new files();
		$_width     = 170;
		$_height    = 170;	
		//apply1
		$query = "select * from ".$this->table_name_dogs."_apply1 where Fullkey='$apply_id'";	
		$apply1 = $this->obj_dogs->run_mysql_out($query);
		$query = "select * from ".$this->table_name_dogs."_apply2 where apply_id='".$apply1['Fullkey']."'";
		$apply2 = $this->obj_dogs->run_mysql_out($query);
		$query = "select * from ".$this->table_name_dogs."_apply3 where apply_id='".$apply1['Fullkey']."'";
		$apply3 = $this->obj_dogs->run_mysql_out($query);
		$query = "select * from ".$this->table_name_dogs."_apply4 where apply_id='".$apply1['Fullkey']."'";
		$apply4 = $this->obj_dogs->run_mysql_out($query);
		$query = "select * from ".$this->table_name_dogs."_apply5 where apply_id='".$apply1['Fullkey']."'";
		$apply5 = $this->obj_dogs->run_mysql_out($query);
		$query = "select * from ".$this->table_name_dogs."_apply6 where apply_id='".$apply1['Fullkey']."'";
		$apply6 = $this->obj_dogs->run_mysql_out($query);
		$query = "select * from ".$this->table_name_dogs."_apply7 where apply_id='".$apply1['Fullkey']."'";
		$apply7 = $this->obj_dogs->run_mysql_out($query);
		$query = "select * from ".$this->table_name_dogs."_apply8 where apply_id='".$apply1['Fullkey']."'";
		$apply8 = $this->obj_dogs->run_mysql_out($query);
		$query = "select * from ".$this->table_name_dogs."_apply9 where apply_id='".$apply1['Fullkey']."'";
		$apply9 = $this->obj_dogs->run_mysql_out($query);
		
		$photo_list = '<div id="photos_list" style="width:100%; padding-top:5px">';
		$images_path= 'doggie/'.$apply1['dog_id'].'/'.$apply_id.'/';
		$array_files = glob($images_path.'*');
		if(count($array_files)>0) {
			foreach($array_files as $key => $value) {
				$file_name = basename($value);
				if(is_file($images_path.$file_name)) {
					$obj_images->show_pic2_show_number($images_path.$file_name, $_width, $_height);
					$photo_list .= '<div class="show_photo"><div class="photo_block"><img src="'.Host_Name.$images_path.$file_name.'" width="'.$obj_images->size[0].'" height="'.$obj_images->size[1].'"></div></div>';
				}
			}
		}
		$photo_list .= '</div>';
		
		$this->sendmail->Body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
	src: url("http://adoptadoggie.org/font/MuseoSans.eot");
	src: url("http://adoptadoggie.org/font/MuseoSans.eot?#iefix") format("embedded-opentype"),
	url("http://adoptadoggie.org/font/MuseoSans.svg#Museo Sans 500") format("svg"),
	url("http://adoptadoggie.org/font/MuseoSans.woff") format("woff"),
	url("http://adoptadoggie.org/font/MuseoSans.ttf") format("truetype");
	font-weight: normal;
	font-style: normal;				
}
@font-face
{
	/*font-family: b;*/
	font-family: "Museo Sans 500 Italic";
	src: url("http://adoptadoggie.org/font/MuseoSans_500_Italic.eot");
	src: url("http://adoptadoggie.org/font/MuseoSans_500_Italic.eot?#iefix") format("embedded-opentype"),
	url("http://adoptadoggie.org/font/MuseoSans_500_Italic.svg#Museo Sans 500") format("svg"),
	url("http://adoptadoggie.org/font/MuseoSans_500_Italic.woff") format("woff"),
	url("http://adoptadoggie.org/font/MuseoSans_500_Italic.ttf") format("truetype");
	font-weight: normal;
	font-style: normal;
}
@font-face
{
	/*font-family: c;*/
	font-family: "Myriad Pro bold";
	src: url("http://adoptadoggie.org/font/myriadprobold.eot");
	src: url("http://adoptadoggie.org/font/myriadprobold.eot?#iefix") format("embedded-opentype"),
	url("http://adoptadoggie.org/font/myriadprobold.svg#Myriad Pro") format("svg"),
	url("http://adoptadoggie.org/font/myriadprobold.woff") format("woff"),
	url("http://adoptadoggie.org/font/myriadprobold.ttf") format("truetype");
	font-weight: normal;
	font-style: normal;
}
@font-face
{
	/*font-family: j;*/
	font-family: "Myriad Pro";
	src: url("http://adoptadoggie.org/font/MyriadPro-Regular.eot");
	src: url("http://adoptadoggie.org/font/MyriadPro-Regular.eot?#iefix") format("embedded-opentype"),
	url("http://adoptadoggie.org/font/MyriadPro-Regular.svg#Myriad Pro") format("svg"),
	url("http://adoptadoggie.org/font/MyriadPro-Regular.woff") format("woff"),
	url("http://adoptadoggie.org/font/MyriadPro-Regular.ttf") format("truetype");
	font-weight: normal;
	font-style: normal;
}
@font-face
{
	/*font-family: m;*/
	font-family: "HelveticaNeue-Bold";
	src: url("http://adoptadoggie.org/font/HelveticaNeue-Bold.eot");
	src: url("http://adoptadoggie.org/font/HelveticaNeue-Bold.eot?#iefix") format("embedded-opentype"),
	url("http://adoptadoggie.org/font/HelveticaNeue-Bold.svg#HelveticaNeue") format("svg"),
	url("http://adoptadoggie.org/font/HelveticaNeue-Bold.woff") format("woff"),
	url("http://adoptadoggie.org/font/HelveticaNeue-Bold.ttf") format("truetype");
	font-weight: normal;
	font-style: normal;
}
@font-face
{
	font-family: "Helvetica Neue";
	src: url("http://adoptadoggie.org/font/hlzc.eot");
	src: url("http://adoptadoggie.org/font/hlzc.eot?#iefix") format("embedded-opentype"),
	url("http://adoptadoggie.org/font/hlzc.svg#Helvetica Neue") format("svg"),
	url("http://adoptadoggie.org/font/hlzc.woff") format("woff"),
	url("http://adoptadoggie.org/font/hlzc.ttf") format("truetype");
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
	height: 18px;
	width: 150px;
	background-color: transparent;
	border-style: solid;
	border-width: 0px 0px 1px 0px;
	border-color: #A4AC35;
	outline: 0;
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
/* IE9 SVG, needs conditional override of "filter" to "none" */
background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgdmlld0JveD0iMCAwIDEgMSIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+CiAgPGxpbmVhckdyYWRpZW50IGlkPSJncmFkLXVjZ2ctZ2VuZXJhdGVkIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgeDE9IjAlIiB5MT0iMCUiIHgyPSIwJSIgeTI9IjEwMCUiPgogICAgPHN0b3Agb2Zmc2V0PSIwJSIgc3RvcC1jb2xvcj0iIzAwMDAwMCIgc3RvcC1vcGFjaXR5PSIwLjE5Ii8+CiAgICA8c3RvcCBvZmZzZXQ9IjkyJSIgc3RvcC1jb2xvcj0iIzAwMDAwMCIgc3RvcC1vcGFjaXR5PSIwIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjEwMCUiIHN0b3AtY29sb3I9IiMwMDAwMDAiIHN0b3Atb3BhY2l0eT0iMCIvPgogIDwvbGluZWFyR3JhZGllbnQ+CiAgPHJlY3QgeD0iMCIgeT0iMCIgd2lkdGg9IjEiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+);
background: -moz-linear-gradient(top,  rgba(0,0,0,0.19) 0%, rgba(0,0,0,0) 92%, rgba(0,0,0,0) 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(0,0,0,0.19)), color-stop(92%,rgba(0,0,0,0)), color-stop(100%,rgba(0,0,0,0))); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top,  rgba(0,0,0,0.19) 0%,rgba(0,0,0,0) 92%,rgba(0,0,0,0) 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top,  rgba(0,0,0,0.19) 0%,rgba(0,0,0,0) 92%,rgba(0,0,0,0) 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top,  rgba(0,0,0,0.19) 0%,rgba(0,0,0,0) 92%,rgba(0,0,0,0) 100%); /* IE10+ */
background: linear-gradient(to bottom,  rgba(0,0,0,0.19) 0%,rgba(0,0,0,0) 92%,rgba(0,0,0,0) 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr="#30000000", endColorstr="#00000000",GradientType=0 ); /* IE6-8 */

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
.re_main5_r{/*nico*/
	font-size: 14px;
	color: #b45e62;
	text-align: justify;
	line-height: 21px;
	font-family: "Myriad Pro";	
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
	font-family: "Helvetica Neue";
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
						#messagebody div.rcmBody label.css-label {
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
						#messagebody div.rcmBody label.css-label2 {
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
						#messagebody div.rcmBody label.css-label3 {
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
label.css-label4 {							background-image:url(http://adoptadoggie.org/images/oo.png);
							-webkit-touch-callout: none;
							-webkit-user-select: none;
							-khtml-user-select: none;
							-moz-user-select: none;
							-ms-user-select: none;
							user-select: none;
}
label.css-label5 {							background-image:url(http://adoptadoggie.org/images/oo.png);
							-webkit-touch-callout: none;
							-webkit-user-select: none;
							-khtml-user-select: none;
							-moz-user-select: none;
							-ms-user-select: none;
							user-select: none;
}
label.css-label6 {							background-image:url(http://adoptadoggie.org/images/oo.png);
							-webkit-touch-callout: none;
							-webkit-user-select: none;
							-khtml-user-select: none;
							-moz-user-select: none;
							-ms-user-select: none;
							user-select: none;
}
</style>

<title>Application</title>

</head>

<body>

<!----------- 內容 開始 ------------------>
<div class="adoption" style="padding: 20px 0 0 20px;">
<p align="left">Apply ID: '.$apply_id.'</p>
<form method="post" action="" name="apply_form" id="apply_form">
<input type="hidden" name="action" value="save" />
<input type="hidden" name="dog_id" value="<?=$dog_id?>" />
<input type="hidden" name="content" value="" />
<table width="0" border="0" cellspacing="0" cellpadding="0">
	<tr>
    	<td>
        	<table width="0" border="0" cellspacing="0" cellpadding="0">
            	<tr>
                	<td>
                    	<span class="ce_title17">ADOPTION APPLICATION</span><br />
                    	<span class="re_main5">ADOPT A DOGGIE is a pending 501c non-proﬁt organization.  Our mission is to help rescued dogs in need and ﬁnd them <br />loving and forever homes in North America.  The information requested in this application is intended to ensure <br />that every owner and home we approve for adoption is a suitable and safe environment for the dog and be a <br />forever home.  Thank you for your interest in our doggies!</span>
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
                                        	<td width="75"><span class="re_main4">(1st Choice)</span></td>
                                            <td><input class="text_line" type="text" name="ans1" value="'.$apply1['ans1'].'" style="width:100%" /></td>
                                        </tr>
                                        <tr>
                                        	<td><span class="re_main4">(2nd Choice)</span></td>
                                            <td><input class="text_line" type="text" name="ans2" value="'.$apply1['ans2'].'" style="width:100%" /></td>
                                        </tr>
                                        <tr>
                                        	<td><span class="re_main4">(3rd Choice)</span></td>
                                            <td><input class="text_line" type="text" name="ans3" value="'.$apply1['ans3'].'" style="width:100%" /></td>
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
                                        	<td width="20"><input type="checkbox" class="css-checkbox" id="radio01" name="ans4" value="As a Companion" '.(($apply1['ans4'])?'checked':'').' /><label for="radio01"><span class="checkbox re_main4">As a Companion</span></label></td>
                                        </tr>
                                        <tr>
                                        	<td><input type="checkbox" class="css-checkbox" id="radio02" name="ans5" value="As a Playmate for Other Pets" '.(($apply1['ans5'])?'checked':'').' /><label for="radio02"><span class="checkbox">As a Playmate for Other Pets</span></label></td>
                                        </tr>
                                        <tr>
                                        	<td><input type="checkbox" class="css-checkbox" id="radio03" name="ans6" value="For Another Family Member" '.(($apply1['ans6'])?'checked':'').' /><label for="radio03"><span class="checkbox">For Another Family Member</span></label></td>
                                        </tr>
                                        <tr>
                                        	<td><input type="checkbox" class="css-checkbox" id="radio04" name="ans7" value="As a Gift" '.(($apply1['ans7'])?'checked':'').' /><label for="radio04"><span class="checkbox">As a Gift</span></label></td>
                                        </tr>
                                        <tr>
                                        	<td><input type="checkbox" class="css-checkbox" id="radio05" name="ans8" value="As a Guard Dog" '.(($apply1['ans8'])?'checked':'').' /><label for="radio05"><span class="checkbox">As a Guard Dog</span></label></td>
                                        </tr>
										<tr>
                                        	<td>
												<table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td>
                                                        <input type="checkbox" class="css-checkbox" id="radio06" name="ans9" value="Others" '.(($apply1['ans9'])?'checked':'').' /><label for="radio06"><span class="checkbox">Others </span></label>
                                                        </td>
                                                        <td>
                                                        <textarea name="ans10" class="textbox_box4 re_main4" style="width:609px;">'.$apply1['ans10'].'</textarea>
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
                                                        <input type="checkbox" class="css-checkbox" id="radio07" name="ans11" value="Comments" '.(($apply1['ans11'])?'checked':'').' /><label for="radio07"><span class="checkbox">Comments </span></label>
                                                        </td>
                                                        <td>
                                                        <textarea name="ans12" class="textbox_box4 re_main4" style="width:588px;">'.$apply1['ans12'].'</textarea>
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
                                        	<td><span class="re_main4">Temperament </span><input class="text_line" type="text" name="ans13" value="'.$apply1['ans13'].'" style="width:592px;" /></td>
                                        </tr>
                                        <tr>
                                        	<td><span class="re_main4">Age </span><input class="text_line" type="text" name="ans14" value="'.$apply1['ans14'].'" style="width:643px;" /></td>
                                        </tr>
                                        <tr>
                                        	<td><span class="re_main4">Look/Color/Gender </span><input class="text_line" type="text" name="ans15" value="'.$apply1['ans15'].'" style="width:567px;" /></td>
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
                                                        <td valign="top"><input class="textbox_box" type="text" name="ans16" value="'.$apply2['ans1'].'" /><input class="textbox_box" type="hidden" name="ans17" id="ans17" value="0"/></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4"> Last Name </span></td>
                                                        <td valign="top"><input class="textbox_box" type="text" name="ans18" value="'.$apply2['ans3'].'" /></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4"> Email </span></td>
                                                        <td valign="top"><input class="textbox_box" type="text" name="ans19" value="'.$apply2['ans4'].'" /></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4"> Age </span></td>
                                                        <td valign="top"><input class="textbox_box2" type="text" name="ans20" value="'.$apply2['ans5'].'" /></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4"> Occupation </span></td>
                                                        <td valign="top"><input class="textbox_box" type="text" name="ans21" value="'.$apply2['ans6'].'" /></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4"> Home Address</span></td>
                                                        <td valign="top"><input class="textbox_box" type="text" name="ans22" value="'.$apply2['ans7'].'" /></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4"> City </span></td>
                                                        <td valign="top"><input class="textbox_box" type="text" name="ans23" value="'.$apply2['ans8'].'" /></td>
                                                    </tr>
													<tr>
                                                    	<td align="right" valign="top"><span class="re_main4"> State</span></td>
                                                        <td valign="top"><input class="textbox_box" type="text" name="ans24" value="'.$apply2['ans9'].'" /></td>
                                                    </tr>
                                                    <tr>
                                                      <td align="right" valign="top"><span class="re_main4">Zip Code</span></td>
                                                      <td valign="top"><input class="textbox_box3" type="text" name="ans25" value="'.$apply2['ans10'].'" /></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4"> Home Tel </span></td>
                                                        <td valign="top"><span class="re_main4">(<input class="textbox_box2" type="text" name="ans26" value="'.$apply2['ans11'].'" />)<input class="textbox_box2" type="text" name="ans27" value="'.$apply2['ans12'].'" /> - <input class="textbox_box2" type="text" name="ans28" value="'.$apply2['ans13'].'" /></span></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4"> Cell Tel </span></td>
                                                        <td valign="top"><span class="re_main4">(<input class="textbox_box2" type="text" name="ans29" value="'.$apply2['ans14'].'" />)<input class="textbox_box2" type="text" name="ans30" value="'.$apply2['ans15'].'" /> - <input class="textbox_box2" type="text" name="ans31" value="'.$apply2['ans16'].'" /></span></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4"> Work Tel </span></td>
                                                        <td valign="top"><span class="re_main4">(<input class="textbox_box2" type="text" name="ans32" value="'.$apply2['ans17'].'" />)<input class="textbox_box2" type="text" name="ans33" value="'.$apply2['ans18'].'" /> - <input class="textbox_box2" type="text" name="ans34" value="'.$apply2['ans19'].'" /></span></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4"> When is a good time to call?</span></td>
                                                        <td valign="top"><input class="textbox_box3" type="text" name="ans35" value="'.$apply2['ans20'].'" /></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4"> Time at Address </span></td>
                                                        <td valign="top"><span class="re_main4"><input class="textbox_box2" type="text" name="ans36" value="'.$apply2['ans21'].'" />month(s)<input class="textbox_box2" type="text" name="ans37" value="'.$apply2['ans22'].'" />year(s)</span></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4"> Housing Type </span></td>
                                                        <td valign="top"><table width="0" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                    	<td>
                                                        	<table width="0" border="0" cellspacing="0" cellpadding="0">
                                                            	<tr>
                                                                	<td height="25"><input name="ans38" type="radio" class="css-checkbox" id="radio08" value="House" '.(($apply2['ans23']=='House')?'checked':'').' /><label for="radio08" class="css-label radGroup2"><span class="checkbox re_main4">House</span></label></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input name="ans38" type="radio" class="css-checkbox" id="radio09" value="Condo" '.(($apply2['ans23']=='Condo')?'checked':'').' /><label for="radio09" class="css-label radGroup2"><span class="checkbox re_main4">Condo</span></label></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input name="ans38" type="radio" class="css-checkbox" id="radio10" value="Apartment" '.(($apply2['ans23']=='Apartment')?'checked':'').' /><label for="radio10" class="css-label radGroup2"><span class="checkbox re_main4">Apartment</span></label></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input name="ans38" type="radio" class="css-checkbox" id="radio11" value="Mobile Home" '.(($apply2['ans23']=='Mobile Home')?'checked':'').' /><label for="radio11" class="css-label radGroup2"><span class="checkbox re_main4">Mobile Home</span></label></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input name="ans38" type="radio" class="css-checkbox" id="radio12" value="Military Housing" '.(($apply2['ans23']=='Military Housing')?'checked':'').' /><label for="radio12" class="css-label radGroup2"><span class="checkbox re_main4">Military Housing</span></label></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                    	<td>
                                                        	<table width="0" border="0" cellspacing="0" cellpadding="0">
                                                            	<tr>
                                                                	<td height="25"><input name="ans38" type="radio" class="css-checkbox" id="radio13" value="Other" '.(($apply2['ans23']=='Other')?'checked':'').' /><label for="radio13" class="css-label radGroup2"><span class="checkbox re_main4">Other</span><input class="textbox_box" type="text" name="ans39" value="'.$apply2['ans24'].'" /></label></td>
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
                                                                	<td height="25"><input name="ans40" type="radio" class="css-checkbox" id="radio14" value="Own" '.(($apply2['ans25']=='Own')?'checked':'').' /><label for="radio14" class="css-label radGroup2"><span class="checkbox re_main4">Own</span></label></td>
                                                                    <td>&nbsp;</td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                        <td valign="middle">&nbsp;</td>
                                                        <td valign="middle"><input name="ans40" type="radio" class="css-checkbox" id="radio15" value="Rent" '.(($apply2['ans25']=='Rent')?'checked':'').' /><label for="radio15" class="css-label radGroup2"><span class="checkbox re_main4">Rent</span></label></td>
                                                        <td valign="middle">&nbsp;</td>
                                                        <td valign="middle"><input name="ans40" type="radio" class="css-checkbox" id="radio16" value="Other" '.(($apply2['ans25']=='Other')?'checked':'').' /><label for="radio16" class="css-label radGroup2"><span class="checkbox re_main4">Other </span><input class="textbox_box" type="text" name="ans41" value="'.$apply2['ans26'].'" /></label></td>
                                                        <td width="10">&nbsp;</td>
                                                        <td width="10">&nbsp;</td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                        	<td align="right" valign="top"><span class="re_main4"> Landlord Name</span></td>
                                            <td valign="top"><input class="textbox_box5" type="text" name="ans42" value="'.$apply2['ans27'].'" /></td>
                                        </tr>
                                        <tr>
                                        	<td align="right" valign="top"><span class="re_main4"> Landlord Tel</span></td>
                                            <td valign="top"><span class="re_main4">(<input class="textbox_box2" type="text" name="ans43" value="'.$apply2['ans28'].'" />)<input class="textbox_box2" type="text" name="ans44" value="'.$apply2['ans29'].'" /> - <input class="textbox_box2" type="text" name="ans45" value="'.$apply2['ans30'].'" /></span></td>
                                        </tr>
                                        <tr>
                                        	<td align="right" valign="top"><span class="re_main4"> Conﬁrm Landlord Allows Dogs</span></td>
                                            <td valign="top">
                                            	<table width="0" border="0" cellspacing="0" cellpadding="0">
                                                	<tr>
                                                    	<td height="25"><input name="ans46" type="radio" class="css-checkbox" id="radio17" value="Yes" '.(($apply2['ans31']=='Yes')?'checked':'').' /><label for="radio17" class="css-label radGroup2"><span class="checkbox re_main4">Yes</span></label></td>
                                                        <td>&nbsp;</td>
                                                        <td><input name="ans46" type="radio" class="css-checkbox" id="radio18" value="No" '.(($apply2['ans31']=='No')?'checked':'').' /> <label for="radio18" class="css-label radGroup2"><span class="checkbox re_main4">No</span></label></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                        	<td align="right" valign="top"><span class="re_main4"> Other Members of the Household </span></td>
                                            <td valign="top">
                                            	<table width="0" border="0" cellspacing="0" cellpadding="0">
                                        			<tr>
                                                    	<td height="25"><input name="ans47" type="checkbox" class="css-checkbox" id="radio19" value="Spouse/Domestic Partner" '.(($apply2['ans32']=='Spouse/Domestic Partner')?'checked':'').' /><label for="radio19" class="css-label radGroup2"><span class="checkbox re_main4">Spouse/Domestic Partner</span></label></td>
                                                    </tr>
                                                    <tr>
                                                    	<td height="25"><input name="ans179" type="checkbox" class="css-checkbox" id="radio20" value="Child(ren)" '.(($apply2['ans52']=='Child(ren)')?'checked':'').' /><label for="radio20" class="css-label radGroup2"><span class="checkbox re_main4">Child(ren) (#<input class="textbox_box2" type="text" name="ans48" value="'.$apply2['ans33'].'" /> /Age <input class="textbox_box2" type="text" name="ans49" value="'.$apply2['ans34'].'" />)</span></label></td>
                                                    </tr>
                                                    <tr>
                                                    	<td height="25"><input name="ans180" type="checkbox" class="css-checkbox" id="radio21" value="Roommate(s)" '.(($apply2['ans53']=='Roommate(s)')?'checked':'').' /><label for="radio21" class="css-label radGroup2"><span class="checkbox re_main4">Roommate(s) (# <input class="textbox_box2" type="text" name="ans50" value="'.$apply2['ans35'].'" />)</span></label></td>
                                                    </tr>
                                                    <tr>
                                                    	<td height="25"><input name="ans181" type="checkbox" class="css-checkbox" id="radio22" value="Other Relative(s)" '.(($apply2['ans54']=='Other Relative(s)')?'checked':'').' /><label for="radio22" class="css-label radGroup2"><span class="checkbox re_main4">Other Relative(s)(# <input class="textbox_box2" type="text" name="ans51" value="'.$apply2['ans36'].'" />)</span></label></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                        	<td align="right" valign="top"><span class="re_main4">Child(ren)’s Experience with Dogs</span></td>
                                            <td valign="top">
                                            	<table width="0" border="0" cellspacing="0" cellpadding="0">
                                        			<tr>
                                        				<td height="25"><input name="ans52" type="radio" class="css-checkbox" id="radio23" value="Yes" '.(($apply2['ans37']=='Yes')?'checked':'').' /><label for="radio23" class="css-label radGroup2"><span class="checkbox re_main4">Yes</span></label></td>
                                                        <td>&nbsp;</td>
                                                        <td><input name="ans52" type="radio" class="css-checkbox" id="radio24" value="No" '.(($apply2['ans37']=='No')?'checked':'').' /><label for="radio24" class="css-label radGroup2"><span class="checkbox re_main4">No</span></label></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="right" valign="top"><span class="re_main4"> Child(ren) taught be respective to dogs?</span></td>
                                            <td valign="top">
                                                <table width="0" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td height="25"><input name="ans53" type="radio" class="css-checkbox" id="radio25" value="Yes" '.(($apply2['ans38']=='Yes')?'checked':'').' /><label for="radio25" class="css-label radGroup2"><span class="checkbox re_main4">Yes</span></label></td>
                                                        <td>&nbsp;</td>
                                                        <td><input name="ans53" type="radio" class="css-checkbox" id="radio26" value="No" '.(($apply2['ans38']=='No')?'checked':'').' /><label for="radio26" class="css-label radGroup2"><span class="checkbox re_main4">No</span></label></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="right" valign="top"><span class="re_main4">All members of household aware of and <br />agree to the adoption of a dog </span></td>
                                            <td valign="top">
                                                <table width="0" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td height="25"><input name="ans54" type="radio" class="css-checkbox" id="radio27" value="Yes" '.(($apply2['ans39']=='Yes')?'checked':'').' /><label for="radio27" class="css-label radGroup2"><span class="checkbox re_main4">Yes</span></label></td>
                                                        <td>&nbsp;</td>
                                                        <td><input name="ans54" type="radio" class="css-checkbox" id="radio28" value="No" '.(($apply2['ans39']=='No')?'checked':'').' /><label for="radio28" class="css-label radGroup2"><span class="checkbox re_main4">No</span></label></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="right" valign="top"><span class="re_main4"> Do you or any members of your household <br />have any health conditions that may affect<br />your ability to permanently care for the dog </span></td>
                                            <td valign="top">
                                                <table width="0" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td height="25"><input name="ans55" type="radio" class="css-checkbox" id="radio29" value="Yes" '.(($apply2['ans40']=='Yes')?'checked':'').' /><label for="radio29" class="css-label radGroup2"><span class="checkbox re_main4">Yes</span></label></td>
                                                    </tr>
                                                    <tr>
                                                        <td height="100" valign="top"><input name="ans55" type="radio" class="css-checkbox" id="radio30" value="No" '.(($apply2['ans40']=='No')?'checked':'').' /><label for="radio30" class="css-label radGroup2"><span class="checkbox re_main4">No</span><br /><textarea name="ans56" class="textbox_box4 re_main4">'.stripslashes($apply2['ans41']).'</textarea></label></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="237" align="right" valign="top"><span class="re_main4"> If you decide to move in the future, <br />plans for dog: </span></td>
                                            <td valign="top"><textarea class="textbox_box4 re_main4" name="ans57">'.stripslashes($apply2['ans42']).'</textarea></td>
                                        </tr>
                                        <tr>
                                          <td align="right" valign="top"><span class="re_main4"> Do you have any plans to move<br>in the next 6 months? </span></td>
                                          <td valign="top"><table width="0" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                              <td height="25"><input name="ans170" type="radio" class="css-checkbox" id="radio" value="Yes" '.(($apply2['ans49']=='Yes')?'checked':'').' />
                                                <label for="radio" class="css-label radGroup2"><span class="checkbox re_main4">Yes</span></label></td>
                                              <td>&nbsp;</td>
                                              <td><input name="ans170" type="radio" class="css-checkbox" id="radio2" value="No" '.(($apply2['ans49']=='No')?'checked':'').' />
                                                <label for="radio2" class="css-label radGroup2"><span class="checkbox re_main4">No</span></label></td>
                                            </tr>
                                          </table></td>
                                        </tr>
                                        <tr>
                                          <td align="right" valign="top"><span class="re_main4">Do you have any plans to take<br>any extended trips/vacations<br>in the next 3 months?</span></td>
                                          <td valign="top"><table width="0" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                              <td height="25"><input name="ans171" type="radio" class="css-checkbox" id="radio3" value="Yes" '.(($apply2['ans50']=='Yes')?'checked':'').' />
                                                <label for="radio3" class="css-label radGroup2"><span class="checkbox re_main4">Yes</span></label></td>
                                              <td>&nbsp;</td>
                                              <td><input name="ans171" type="radio" class="css-checkbox" id="radio4" value="No" '.(($apply2['ans50']=='No')?'checked':'').' />
                                                <label for="radio4" class="css-label radGroup2"><span class="checkbox re_main4">No</span></label></td>
                                            </tr>
                                          </table></td>
                                        </tr>
                                        <tr>
                                          <td align="right" valign="top"><span class="re_main4">If yes, explain where, how long,<br>and where the dog will be during that time:</span></td>
                                          <td valign="top"><textarea class="textbox_box4 re_main4" name="ans172">'.stripslashes($apply2['ans51']).'</textarea></td>
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
                                                        <td valign="top"><input class="textbox_box" type="text" name="ans58" value="'.$apply2['ans43'].'" /></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Tel</span></td>
                                                        <td valign="top"><input class="textbox_box" type="text" name="ans59" value="'.$apply2['ans44'].'" /></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Home Address</span></td>
                                                        <td valign="top"><input class="textbox_box" type="text" name="ans60" value="'.$apply2['ans45'].'" /></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">City</span></td>
                                                        <td valign="top"><input class="textbox_box" type="text" name="ans61" value="'.$apply2['ans46'].'" /></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">State</span></td>
                                                        <td valign="top"><input class="textbox_box" type="text" name="ans62" value="'.$apply2['ans47'].'" /></td>
                                                    </tr>
                                                    <tr>
                                                      <td align="right" valign="top"><span class="re_main4">Zip Code</span></td>
                                                      <td valign="top"><input class="textbox_box3" type="text" name="ans63" value="'.$apply2['ans48'].'" /></td>
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
                                                        <td valign="top"><input class="textbox_box" type="text" name="ans64" value="'.$apply3['ans1'].'" /></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Age</span></td>
                                                        <td valign="top"><input class="textbox_box" type="text" name="ans65" value="'.$apply3['ans2'].'" /></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Veterinarian Name</span></td>
                                                        <td valign="top"><input class="textbox_box" type="text" name="ans66" value="'.$apply3['ans3'].'" /></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Vet Tel</span></td>
                                                        <td valign="top"><span class="re_main4">(<input class="textbox_box2" type="text" name="ans67" value="'.$apply3['ans4'].'" />)<input class="textbox_box2" type="text" name="ans68" value="'.$apply3['ans5'].'" /> - <input class="textbox_box2" type="text" name="ans69" value="'.$apply3['ans6'].'" /></span></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Veterinarian Address</span></td>
                                                        <td valign="top"><input class="textbox_box" type="text" name="ans70" value="'.$apply3['ans7'].'" /></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">City</span></td>
                                                        <td valign="top"><input class="textbox_box" type="text" name="ans71" value="'.$apply3['ans8'].'" /></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">State</span></td>
                                                        <td valign="top"><input class="textbox_box" type="text" name="ans72" value="'.$apply3['ans9'].'" /></td>
                                                    </tr>
                                                    <tr>
                                                      <td align="right" valign="top"><span class="re_main4">Zip Code</span></td>
                                                      <td valign="top"><input class="textbox_box3" type="text" name="ans73" value="'.$apply3['ans10'].'" /></td>
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
                                                                	<td height="25"><input name="ans74" type="radio" class="css-checkbox" id="radio31" value="Indoors" '.(($apply4['ans1']=='Indoors')?'checked':'').' /><label for="radio31" class="css-label radGroup2"><span class="checkbox re_main4">Indoors</span></label></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input name="ans74" type="radio" class="css-checkbox" id="radio32" value="Outdoors" '.(($apply4['ans1']=='Outdoors')?'checked':'').' /><label for="radio32" class="css-label radGroup2"><span class="checkbox re_main4">Outdoors</span></label></td>
                                                                    <td>&nbsp;</td>

                                                                    <td><input name="ans74" type="radio" class="css-checkbox" id="radio33" value="Both" '.(($apply4['ans1']=='Both')?'checked':'').' /><label for="radio33" class="css-label radGroup2"><span class="checkbox re_main4">Both</span></label></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input name="ans74" type="radio" class="css-checkbox" id="radio34" value="Other" '.(($apply4['ans1']=='Other')?'checked':'').' /><label for="radio34" class="css-label radGroup2"><span class="checkbox re_main4">Other </span><input class="textbox_box3" type="text" name="ans75" value="'.$apply4['ans2'].'" /></label></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Time(s) of Day/Night</span></td>
                                                        <td valign="top">
                                                        	<table width="0" border="0" cellspacing="0" cellpadding="0">
                                                            	<tr>
                                                                	<td height="25"><input name="ans76" type="radio" class="css-checkbox" id="radio35" value="Indoors" '.(($apply4['ans3']=='Indoors')?'checked':'').' /><label for="radio35" class="css-label radGroup2"><span class="checkbox re_main4">Indoors </span><input class="textbox_box3" type="text" name="ans77" value="'.$apply4['ans4'].'" /></label></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input name="ans76" type="radio" class="css-checkbox" id="radio36" value="Outdoor" '.(($apply4['ans3']=='Outdoor')?'checked':'').' /><label for="radio36" class="css-label radGroup2"><span class="checkbox re_main4">Outdoor </span><input class="textbox_box3" type="text" name="ans78" value="'.$apply4['ans5'].'" /></label></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Number of days dog will be left alone</span></td>
                                                        <td valign="top">
                                                        	<table width="0" border="0" cellspacing="0" cellpadding="0">
                                                            	<tr>
                                                                	<td height="25"><input name="ans79" type="radio" class="css-checkbox" id="radio37" value="Weekdays" '.(($apply4['ans6']=='Weekdays')?'checked':'').' /><label for="radio37" class="css-label radGroup2"><span class="checkbox re_main4">Weekdays </span><input class="textbox_box3" type="text" name="ans80" value="'.$apply4['ans7'].'" /></label></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input name="ans79" type="radio" class="css-checkbox" id="radio38" value="Weekends" '.(($apply4['ans6']=='Weekends')?'checked':'').' /><label for="radio38" class="css-label radGroup2"><span class="checkbox re_main4">Weekends </span><input class="textbox_box3" type="text" name="ans81" value="'.$apply4['ans8'].'" /></label></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Outdoors: Yard</span></td>
                                                        <td valign="top">
                                                        	<table width="0" border="0" cellspacing="0" cellpadding="0">
                                                            	<tr>
                                                                	<td height="25"><input name="ans82" type="radio" class="css-checkbox" id="radio39" value="Yes" '.(($apply4['ans9']=='Yes')?'checked':'').' /><label for="radio39" class="css-label radGroup2"><span class="checkbox re_main4">Yes</span></label></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input name="ans82" type="radio" class="css-checkbox" id="radio40" value="No" '.(($apply4['ans9']=='No')?'checked':'').' /><label for="radio40" class="css-label radGroup2"><span class="checkbox re_main4">No</span></label></td>
                                                                    <td width="20">&nbsp;</td>
                                                                    <td><span class="re_main4"> Fenced In </span></td>
                                                                    <td width="10">&nbsp;</td>
                                                                    <td><input name="ans83" type="radio" class="css-checkbox" id="radio41" value="Yes" '.(($apply4['ans10']=='Yes')?'checked':'').' /><label for="radio41" class="css-label radGroup2"><span class="checkbox re_main4">Yes</span></label></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input name="ans83" type="radio" class="css-checkbox" id="radio42" value="No" '.(($apply4['ans10']=='No')?'checked':'').' /><label for="radio42" class="css-label radGroup2"><span class="checkbox re_main4">No</span></label></td>
                                                                    <td width="20">&nbsp;</td>
                                                                    <td><span class="re_main4">Height of fence </span><input class="textbox_box2" type="text" name="ans84" value="'.$apply4['ans11'].'" /><span class="re_main4"> feet</span></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Any possibility of the dog escaping the yard</span></td>
                                                        <td valign="top">
                                                        	<table width="0" border="0" cellspacing="0" cellpadding="0">
                                                            	<tr>
                                                                	<td height="25"><input name="ans85" type="radio" class="css-checkbox" id="radio43" value="No" '.(($apply4['ans12']=='No')?'checked':'').' /><label for="radio43" class="css-label radGroup2"><span class="checkbox re_main4">No</span></label></td>
                                                                </tr>
                                                                <tr>
                                                                	<td height="100" valign="top"><input name="ans85" type="radio" class="css-checkbox" id="radio44" value="Yes" '.(($apply4['ans12']=='No')?'checked':'').' /><label for="radio44" class="css-label radGroup2"><span class="checkbox re_main4">Yes  (explain)</span><br /><textarea class="textbox_box4" name="ans86">'.stripslashes($apply4['ans13']).'</textarea></label></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Indoors: Location(s) Dog will be kept/allowed<br />while indoors (check all that apply)</span></td>
                                                        <td valign="top">
                                                        	<table width="0" border="0" cellspacing="0" cellpadding="0">
																
                                                            	<tr>
                                                                	<td height="25"><input name="ans87" type="checkbox" class="css-checkbox" id="radio45" value="Living Room" '.(($apply4['ans14']=='Living Room')?'checked':'').' /><label for="radio45" class="css-label radGroup2"><span class="checkbox re_main4">Living Room</span></label></td>
                                                                    <td width="30">&nbsp;</td>
                                                                    <td><input name="ans87" type="checkbox" class="css-checkbox" id="radio46" value="Garage" '.(($apply4['ans17']=='Garage')?'checked':'').' /><label for="radio46" class="css-label radGroup2"><span class="checkbox re_main4">Garage</span></label></td>
                                                                </tr>
                                                                <tr>
                                                                	<td height="25"><input name="ans87" type="checkbox" class="css-checkbox" id="radio47" value="Kitchen" '.(($apply4['ans18']=='Kitchen')?'checked':'').' /><label for="radio47" class="css-label radGroup2"><span class="checkbox re_main4">Kitchen</span></label></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input name="ans87" type="checkbox" class="css-checkbox" id="radio48" value="Anywhere indoors" '.(($apply4['ans19']=='Anywhere indoors')?'checked':'').' /> <label for="radio48" class="css-label radGroup2"><span class="checkbox re_main4">Anywhere indoors</span></label></td>
                                                                </tr>
                                                                <tr>
                                                                	<td height="25"><input name="ans87" type="checkbox" class="css-checkbox" id="radio49" value="Bedroom(s)" '.(($apply4['ans20']=='Bedroom(s)')?'checked':'').' /><label for="radio49" class="css-label radGroup2"><span class="checkbox re_main4">Bedroom(s)</span></label></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input name="ans87" type="checkbox" class="css-checkbox" id="radio50" value="Other" '.(($apply4['ans21']=='Other')?'checked':'').' /><label for="radio50" class="css-label radGroup2"><span class="checkbox re_main4">Other </span><input class="textbox_box" type="text" name="ans88" value="'.$apply4['ans15'].'" /></label></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Types of outdoor activities/exercises<br />plan to do with the dog</span></td>
                                                        <td valign="top"><span class="re_main4"><textarea class="textbox_box4" name="ans89">'.stripslashes($apply4['ans16']).'</textarea></span></td>
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
                                                        <td valign="top"><input class="textbox_box5" type="text" name="ans90" value="'.$apply5['ans1'].'" /></td>
                                                    </tr>
													<tr>
                                                	  <td align="right" valign="top">&nbsp;</td>
                                                	  <td valign="top"><table width="0" border="0" cellspacing="0" cellpadding="0">
                                                	    <tr>
                                                	      <td height="25"><input name="ans173" type="radio" class="css-checkbox" id="radio5" value="CURRENT" '.(($apply5['ans33']=='CURRENT')?'checked':'').' />
                                                	        <label for="radio5" class="css-label radGroup2"><span class="checkbox re_main4">CURRENT</span></label></td>
                                                	      <td>&nbsp;</td>
                                                	      <td><input name="ans173" type="radio" class="css-checkbox" id="radio6" value="PAST" '.(($apply5['ans33']=='PAST')?'checked':'').' />
                                                	        <label for="radio6" class="css-label radGroup2"><span class="checkbox re_main4">PAST</span></label></td>
														</tr>
													  </table></td>
                                              	    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Type of pet: (dog, cat, bird, etc.)</span></td>
                                                        <td valign="top"><input class="textbox_box5" type="text" name="ans91" value="'.$apply5['ans2'].'" /></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Breed</span></td>
                                                        <td valign="top"><input class="textbox_box5" type="text" name="ans92" value="'.$apply5['ans3'].'" /></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Gender</span></td>
                                                        <td valign="top">
                                                        	<table width="0" border="0" cellspacing="0" cellpadding="0">
                                                            	<tr>
                                                                	<td height="25"><input name="ans93" type="radio" class="css-checkbox" id="radio51" value="Male" '.(($apply5['ans4']=='Male')?'checked':'').' /><label for="radio51" class="css-label radGroup2"><span class="checkbox re_main4">Male</span></label></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input name="ans93" type="radio" class="css-checkbox" id="radio52" value="Female" '.(($apply5['ans4']=='Female')?'checked':'').' /><label for="radio52" class="css-label radGroup2"><span class="checkbox re_main4">Female</span></label></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Age</span></td>
                                                        <td valign="top">
                                                        	<table width="0" border="0" cellspacing="0" cellpadding="0">
                                                            	<tr>
                                                                	<td height="25"><input class="textbox_box2" type="text" name="ans94" value="'.$apply5['ans5'].'" /></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><span class="re_main4"> months </span></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input class="textbox_box2" type="text" name="ans95" value="'.$apply5['ans6'].'" /></td>
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
                                                                	<td height="25"><input name="ans96" type="radio" class="css-checkbox" id="radio53" value="Yes" '.(($apply5['ans7']=='Yes')?'checked':'').' /><label for="radio53" class="css-label radGroup2"><span class="checkbox re_main4">Yes</span></label></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input name="ans96" type="radio" class="css-checkbox" id="radio54" value="No" '.(($apply5['ans7']=='No')?'checked':'').' /><label for="radio54" class="css-label radGroup2"><span class="checkbox re_main4">No</span></label></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Length of time owned 1st pet</span></td>
                                                        <td valign="top">
                                                        	<table width="0" border="0" cellspacing="0" cellpadding="0">
                                                            	<tr>
                                                                	<td height="25"><input class="textbox_box2" type="text" name="ans97" value="'.$apply5['ans8'].'" /></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><span class="re_main4"> months </span></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input class="textbox_box2" type="text" name="ans98" value="'.$apply5['ans9'].'" /></td>
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
                                                                	<td height="25" valign="middle"><input name="ans99" type="radio" class="css-checkbox" id="radio55" value="Indoor" '.(($apply5['ans10']=='Indoor')?'checked':'').' /><label for="radio55" class="css-label radGroup2"><span class="checkbox re_main4">Indoor</span></label></td>
                                                                    <td valign="middle">&nbsp;</td>
                                                                    <td valign="middle"><input name="ans99" type="radio" class="css-checkbox" id="radio56" value="Outdoor" '.(($apply5['ans10']=='Outdoor')?'checked':'').' /><label for="radio56" class="css-label radGroup2"><span class="checkbox re_main4">Outdoor</span></label></td>
                                                                    <td valign="middle">&nbsp;</td>
                                                                    <td valign="middle"><input name="ans99" type="radio" class="css-checkbox" id="radio57" value="Both" '.(($apply5['ans10']=='Both')?'checked':'').' /><label for="radio57" class="css-label radGroup2"><span class="checkbox re_main4">Both</span></label></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Gets along with dogs</span></td>
                                                        <td valign="top">
                                                        	<table width="0" border="0" cellspacing="0" cellpadding="0">
                                                            	<tr>
                                                                	<td height="25"><input name="ans100" type="radio" class="css-checkbox" id="radio58" value="Yes" '.(($apply5['ans11']=='Yes')?'checked':'').' /><label for="radio58" class="css-label radGroup2"><span class="checkbox re_main4">Yes</span></label></td>
                                                                </tr>
                                                                <tr>
                                                                	<td height="100" valign="top"><input name="ans100" type="radio" class="css-checkbox" id="radio59" value="No" '.(($apply5['ans11']=='No')?'checked':'').' /><label for="radio59" class="css-label radGroup2"><span class="checkbox re_main4">No (explain)</span><br /><textarea class="textbox_box4" name="ans101">'.stripslashes($apply5['ans12']).'</textarea></label></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">2nd Pet Name</span></td>
                                                        <td valign="top"><input class="textbox_box5" type="text" name="ans102" value="'.$apply5['ans13'].'" /></td>
                                                    </tr>
													<tr>
                                                	  <td align="right" valign="top">&nbsp;</td>
                                                	  <td valign="top"><table width="0" border="0" cellspacing="0" cellpadding="0">
                                                	    <tr>
                                                	      <td height="25"><input name="ans182" type="radio" class="css-checkbox" id="radio5" value="CURRENT" '.(($apply5['ans34']=='CURRENT')?'checked':'').' />
                                                	        <label for="radio5" class="css-label radGroup2"><span class="checkbox re_main4">CURRENT</span></label></td>
                                                	      <td>&nbsp;</td>
                                                	      <td><input name="ans182" type="radio" class="css-checkbox" id="radio6" value="PAST" '.(($apply5['ans34']=='PAST')?'checked':'').' />
                                                	        <label for="radio6" class="css-label radGroup2"><span class="checkbox re_main4">PAST</span></label></td>
														</tr>
													  </table></td>
                                              	    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Type of pet: (dog, cat, bird, etc.)</span></td>
                                                        <td valign="top"><input class="textbox_box5" type="text" name="ans103" value="'.$apply5['ans14'].'" /></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Breed</span></td>
                                                        <td valign="top"><input class="textbox_box5" type="text" name="ans104" value="'.$apply5['ans15'].'" /></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Gender</span></td>
                                                        <td valign="top">
                                                        	<table width="0" border="0" cellspacing="0" cellpadding="0">
                                                            	<tr>
                                                                	<td height="25"><input name="ans105" type="radio" class="css-checkbox" id="radio60" value="Male" '.(($apply5['ans16']=='Male')?'checked':'').' /><label for="radio60" class="css-label radGroup2"><span class="checkbox re_main4">Male</span></label></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input name="ans105" type="radio" class="css-checkbox" id="radio61" value="Female" '.(($apply5['ans16']=='Female')?'checked':'').' /><label for="radio61" class="css-label radGroup2"><span class="checkbox re_main4">Female</span></label></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Age</span></td>
                                                        <td valign="top">
                                                        	<table width="0" border="0" cellspacing="0" cellpadding="0">
                                                            	<tr>
                                                                	<td height="25"><input class="textbox_box2" type="text" name="ans106" value="'.$apply5['ans17'].'" /></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><span class="re_main4"> months </span></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input class="textbox_box2" type="text" name="ans107" value="'.$apply5['ans18'].'" /></td>
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
                                                                	<td height="25"><input name="ans108" type="radio" class="css-checkbox" id="radio62" value="Yes" '.(($apply5['ans19']=='Yes')?'checked':'').' /><label for="radio62" class="css-label radGroup2"><span class="checkbox re_main4">Yes</span></label></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input name="ans108" type="radio" class="css-checkbox" id="radio63" value="No" '.(($apply5['ans19']=='No')?'checked':'').' /><label for="radio63" class="css-label radGroup2"><span class="checkbox re_main4">No</span></label></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Length of time owned 2nd pet</span></td>
                                                        <td valign="top">
                                                        	<table width="0" border="0" cellspacing="0" cellpadding="0">
                                                            	<tr>
                                                                	<td height="25"><input class="textbox_box2" type="text" name="ans109" value="'.$apply5['ans20'].'" /></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><span class="re_main4"> months </span></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input class="textbox_box2" type="text" name="ans110" value="'.$apply5['ans21'].'" /></td>
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
                                                                	<td height="25"><input name="ans111" type="radio" class="css-checkbox" id="radio64" value="Indoor" '.(($apply5['ans22']=='Indoor')?'checked':'').' /><label for="radio64" class="css-label radGroup2"><span class="checkbox re_main4">Indoor</span></label></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input name="ans111" type="radio" class="css-checkbox" id="radio65" value="Outdoor" '.(($apply5['ans22']=='Outdoor')?'checked':'').' /><label for="radio65" class="css-label radGroup2"><span class="checkbox re_main4">Outdoor</span></label></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input name="ans111" type="radio" class="css-checkbox" id="radio66" value="Both" '.(($apply5['ans22']=='Both')?'checked':'').' /><label for="radio66" class="css-label radGroup2"><span class="checkbox re_main4">Both</span></label></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Gets along with dogs</span></td>
                                                        <td valign="top">
                                                        	<table width="0" border="0" cellspacing="0" cellpadding="0">
                                                            	<tr>
                                                                	<td height="25"><input name="ans112" type="radio" class="css-checkbox" id="radio67" value="Yes" '.(($apply5['ans23']=='Yes')?'checked':'').' /><label for="radio67" class="css-label radGroup2"><span class="checkbox re_main4">Yes</span></label></td>
                                                                </tr>
                                                                <tr>
                                                                	<td height="100" valign="top"><input name="ans112" type="radio" class="css-checkbox" id="radio68" value="No" '.(($apply5['ans23']=='No')?'checked':'').' /><label for="radio68" class="css-label radGroup2"><span class="checkbox re_main4">No (explain) </span><br /><textarea class="textbox_box4" name="ans113">'.stripslashes($apply5['ans24']).'</textarea></label></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Have you ever lost or had to give up a pet before</span></td>
                                                        <td valign="top">
                                                        	<table width="0" border="0" cellspacing="0" cellpadding="0">
                                                            	<tr>
                                                                	<td height="25"><input name="ans114" type="radio" class="css-checkbox" id="radio69" value="Yes" '.(($apply5['ans25']=='Yes')?'checked':'').' /><label for="radio69" class="css-label radGroup2"><span class="checkbox re_main4">Yes</span></label></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input name="ans114" type="radio" class="css-checkbox" id="radio70" value="No" '.(($apply5['ans25']=='No')?'checked':'').' /><label for="radio70" class="css-label radGroup2"><span class="checkbox re_main4">No</span></label></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">If yes, what happened: (check as many as apply)</span></td>
                                                        <td valign="top">
                                                        	<table width="0" border="0" cellspacing="0" cellpadding="2">
                                                            	<tr>
                                                                	<td height="25"><input name="ans115" type="radio" class="css-checkbox" id="radio71" value="Surrendered/Abandoned" '.(($apply5['ans26']=='Surrendered/Abandoned')?'checked':'').' /><label for="radio71" class="css-label radGroup2"><span class="checkbox re_main4">Surrendered/Abandoned</span></label></td>
                                                                </tr>
                                                                <tr>
                                                                	<td height="25"><input name="ans115" type="radio" class="css-checkbox" id="radio72" value="Gave Away" '.(($apply5['ans26']=='Gave Away')?'checked':'').' /><label for="radio72" class="css-label radGroup2"><span class="checkbox re_main4">Gave Away</span></label></td>
                                                                </tr>
                                                                <tr>
                                                                	<td height="25"><input name="ans115" type="radio" class="css-checkbox" id="radio73" value="Lost/Ran Away" '.(($apply5['ans26']=='Lost/Ran Away')?'checked':'').' /><label for="radio73" class="css-label radGroup2"><span class="checkbox re_main4">Lost/Ran Away</span></label></td>
                                                                </tr>
                                                                <tr>
                                                                	<td height="25"><input name="ans115" type="radio" class="css-checkbox" id="radio74" value="Euthanized" '.(($apply5['ans26']=='Euthanized')?'checked':'').' /><label for="radio74" class="css-label radGroup2"><span class="checkbox re_main4">Euthanized</span></label></td>
                                                                </tr>
                                                                <tr>
                                                                	<td height="25"><input name="ans115" type="radio" class="css-checkbox" id="radio75" value="Sold" '.(($apply5['ans26']=='Sold')?'checked':'').' /><label for="radio75" class="css-label radGroup2"><span class="checkbox re_main4">Sold</span></label></td>
                                                                </tr>
                                                                <tr>
                                                                	<td height="25"><input name="ans115" type="radio" class="css-checkbox" id="radio76" value="Other" '.(($apply5['ans26']=='Other')?'checked':'').' /><label for="radio76" class="css-label radGroup2"><span class="checkbox re_main4">Other </span><input class="textbox_box3" type="text" name="ans116" value="'.$apply5['ans27'].'" /></label></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Please provide details of the above incident(s)<br />including type of pet, age, reason(s), and<br />date occurred</span></td>
                                                        <td valign="top"><span class="re_main4"><textarea class="textbox_box4" name="ans117">'.stripslashes($apply5['ans28']).'</textarea></span></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Prior experience with a shelter/rescue<br />group before</span></td>
                                                        <td valign="top">
                                                        	<table width="0" border="0" cellspacing="0" cellpadding="0">
                                                            	<tr>
                                                                	<td height="25"><input name="ans118" type="radio" class="css-checkbox" id="radio77" value="No" '.(($apply5['ans29']=='No')?'checked':'').' /><label for="radio77" class="css-label radGroup2"><span class="checkbox re_main4">No</span></label></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input name="ans118" type="radio" class="css-checkbox" id="radio78" value="Yes" '.(($apply5['ans29']=='Yes')?'checked':'').' /><label for="radio78" class="css-label radGroup2"><span class="checkbox re_main4">Yes (who) </span><input class="textbox_box3" type="text" name="ans119" value="'.$apply5['ans30'].'" /></label></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">What you liked about it</span></td>
                                                        <td valign="top"><input class="textbox_box5" type="text" name="ans120" value="'.$apply5['ans31'].'" /></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">What you did not like about it</span></td>
                                                        <td valign="top"><input class="textbox_box5" type="text" name="ans121" value="'.$apply5['ans32'].'" /></td>
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
                                                                	<td height="25"><input name="ans122" type="radio" class="css-checkbox" id="radio79" value="1" '.(($apply6['ans1']=='1')?'checked':'').' /><label for="radio79" class="css-label radGroup2"><span class="checkbox re_main4">1</span></label></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input name="ans122" type="radio" class="css-checkbox" id="radio80" value="2" '.(($apply6['ans1']=='2')?'checked':'').' /><label for="radio80" class="css-label radGroup2"><span class="checkbox re_main4">2</span></label></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input name="ans122" type="radio" class="css-checkbox" id="radio81" value="3" '.(($apply6['ans1']=='3')?'checked':'').' /><label for="radio81" class="css-label radGroup2"><span class="checkbox re_main4">3</span></label></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input name="ans122" type="radio" class="css-checkbox" id="radio82" value="4" '.(($apply6['ans1']=='4')?'checked':'').' /><label for="radio82" class="css-label radGroup2"><span class="checkbox re_main4">4</span></label></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input name="ans122" type="radio" class="css-checkbox" id="radio83" value="5" '.(($apply6['ans1']=='5')?'checked':'').' /><label for="radio83" class="css-label radGroup2"><span class="checkbox re_main4">5</span></label></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Have you or the primarycaregiver ever<br />attended any dog training classes</span></td>
                                                        <td valign="top">
                                                        	<table width="0" border="0" cellspacing="0" cellpadding="0">
                                                            	<tr>
                                                                	<td height="25"><input name="ans123" type="radio" class="css-checkbox" id="radio84" value="Yes" '.(($apply6['ans2']=='Yes')?'checked':'').' /><label for="radio84" class="css-label radGroup2"><span class="checkbox re_main4">Yes</span></label></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input name="ans123" type="radio" class="css-checkbox" id="radio85" value="No" '.(($apply6['ans2']=='No')?'checked':'').' /><label for="radio85" class="css-label radGroup2"><span class="checkbox re_main4">No</span></label></td>
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
                                                                    <td><input class="textbox_box3" type="text" name="ans124" value="'.$apply6['ans3'].'" /></td>
                                                                </tr>
                                                                <tr>
                                                                	<td align="left"><span class="re_main4">When</span></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input class="textbox_box3" type="text" name="ans125" value="'.$apply6['ans4'].'" /></td>
                                                                </tr>
                                                                <tr>
                                                                	<td align="left"><span class="re_main4">Where</span></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input class="textbox_box3" type="text" name="ans126" value="'.$apply6['ans5'].'" /></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Will you consider training if needed</span></td>
                                                        <td valign="top">
                                                        	<table width="0" border="0" cellspacing="0" cellpadding="0">
                                                            	<tr>
                                                                	<td height="30"><input name="ans127" type="radio" class="css-checkbox" id="radio86" value="Yes" '.(($apply6['ans6']=='Yes')?'checked':'').' /><label for="radio86" class="css-label radGroup2"><span class="checkbox re_main4">Yes</span></label></td>
                                                                </tr>
                                                                <tr>
                                                                	<td height="100" valign="top"><input name="ans127" type="radio" class="css-checkbox" id="radio87" value="No" '.(($apply6['ans6']=='No')?'checked':'').' /><label for="radio87" class="css-label radGroup2"><span class="checkbox re_main4">No (explain) </span><br /><textarea class="textbox_box4" name="ans128">'.stripslashes($apply6['ans7']).'</textarea></label></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top" class="re_main4">Are you aware that not all rescue dogs are<br />completely house trained and<br />accidents may occur?</td>
                                                        <td valign="top">
                                                        	<table width="0" border="0" cellspacing="0" cellpadding="0">
                                                            	<tr>
                                                                	<td height="25"><input name="ans129" type="radio" class="css-checkbox" id="radio88" value="Yes" '.(($apply6['ans8']=='Yes')?'checked':'').' /><label for="radio88" class="css-label radGroup2"><span class="checkbox re_main4">Yes</span></label></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input name="ans129" type="radio" class="css-checkbox" id="radio89" value="No" '.(($apply6['ans8']=='No')?'checked':'').' /><label for="radio89" class="css-label radGroup2"><span class="checkbox re_main4">No</span></label></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4"> Would the dog not being fully housetrained <br />aﬀect your ability to provide <br />a permanent home</span></td>
                                                        <td valign="top">
                                                        	<table width="0" border="0" cellspacing="0" cellpadding="0">
                                                            	<tr>
                                                                	<td height="25"><input name="ans130" type="radio" class="css-checkbox" id="radio90" value="Yes" '.(($apply6['ans9']=='Yes')?'checked':'').' /><label for="radio90" class="css-label radGroup2"><span class="checkbox re_main4">Yes</span></label></td>
                                                                </tr>
                                                                <tr>
                                                                	<td height="100" valign="top"><input name="ans130" type="radio" class="css-checkbox" id="radio91" value="No" '.(($apply6['ans9']=='No')?'checked':'').' /><label for="radio91" class="css-label radGroup2"><span class="checkbox re_main4">No (explain)</span><br /><textarea class="textbox_box4" name="ans131">'.stripslashes($apply6['ans10']).'</textarea></label></td>
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
                                                        <td valign="top">'.$photo_list.'</td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Agree that a representative from Adopt a Doggie<br />may schedule a visit to your homeupon request<br />to verify it is a suitable place for the dog,<br />which may include photographs</span></td>
                                                        <td valign="top">
                                                        	<table width="0" border="0" cellspacing="0" cellpadding="0">
                                                            	<tr>
                                                                	<td align="left" height="25"><input name="ans132" type="radio" class="css-checkbox" id="radio92" value="Yes" '.(($apply7['ans1']=='Yes')?'checked':'').' /><label for="radio92" class="css-label radGroup2"><span class="checkbox re_main4">Yes</span></label></td>
                                                                </tr>
                                                                <tr>
                                                                	<td align="left" height="100" valign="top"><input name="ans132" type="radio" class="css-checkbox" id="radio93" value="No" '.(($apply7['ans1']=='No')?'checked':'').' /><label for="radio93" class="css-label radGroup2"><span class="checkbox re_main4">No (explain) </span><br /><textarea class="textbox_box4" name="ans133">'.stripslashes($apply7['ans2']).'</textarea></label></td>
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
                                                        <td valign="top"><input class="textbox_box3" type="text" name="ans134" value="'.$apply8['ans1'].'" /></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4"> Relationship to this reference </span></td>
                                                        <td valign="top"><input class="textbox_box3" type="text" name="ans135" value="'.$apply8['ans2'].'" /></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4"> Tel </span></td>
                                                        <td valign="top"><span class="re_main4">(<input class="textbox_box2" type="text" name="ans136" value="'.$apply8['ans3'].'" />)<input class="textbox_box2" type="text" name="ans137" value="'.$apply8['ans4'].'" /> - <input class="textbox_box2" type="text" name="ans138" value="'.$apply8['ans5'].'" /></span></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4"> Email </span></td>
                                                        <td valign="top"><input class="textbox_box" type="text" name="ans139" value="'.$apply8['ans6'].'" /></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4"> Home Address</span></td>
                                                        <td valign="top"><input class="textbox_box" type="text" name="ans140" value="'.$apply8['ans7'].'" /></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4"> City </span></td>
                                                        <td valign="top"><input class="textbox_box" type="text" name="ans141" value="'.$apply8['ans8'].'" /></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4"> State</span></td>
                                                        <td valign="top"><input class="textbox_box" type="text" name="ans142" value="'.$apply8['ans9'].'" /></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4"> Zip Code </span></td>
                                                        <td valign="top"><input class="textbox_box3" type="text" name="ans143" value="'.$apply8['ans10'].'" /></td>
                                                    </tr>
                                                    <tr>
                                                    	<td height="20" align="right" valign="top">&nbsp;</td>
                                                        <td valign="top">&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4"> Reference #2 Name</span></td>
                                                        <td valign="top"><input class="textbox_box" type="text" name="ans144" value="'.$apply8['ans11'].'" /></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4"> Relationship to this reference</span></td>
                                                        <td valign="top"><input class="textbox_box" type="text" name="ans145" value="'.$apply8['ans12'].'" /></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4"> Tel</span></td>
                                                        <td valign="top"><span class="re_main4">(<input class="textbox_box2" type="text" name="ans146" value="'.$apply8['ans13'].'" />)<input class="textbox_box2" type="text" name="ans147" value="'.$apply8['ans14'].'" /> - <input class="textbox_box2" type="text" name="ans148" value="'.$apply8['ans15'].'" /></span></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4"> Email </span></td>
                                                        <td valign="top"><input class="textbox_box5" type="text" name="ans149" value="'.$apply8['ans16'].'" /></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4"> Home Address</span></td>
                                                        <td valign="top"><input class="textbox_box5" type="text" name="ans150" value="'.$apply8['ans17'].'" /></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4"> City </span></td>
                                                        <td valign="top"><input class="textbox_box" type="text" name="ans151" value="'.$apply8['ans18'].'" /></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4"> State</span></td>
                                                        <td valign="top"><input class="textbox_box" type="text" name="ans152" value="'.$apply8['ans19'].'" /></td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4"> Zip Code </span></td>
                                                        <td valign="top"><input class="textbox_box3" type="text" name="ans153" value="'.$apply8['ans20'].'" /></td>
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
                                                                	<td height="25"><input name="ans154" type="radio" class="css-checkbox" id="radio94" value="Yes" '.(($apply8['ans21']=='Yes')?'checked':'').' /><label for="radio94" class="css-label radGroup2"><span class="checkbox re_main4">Yes</span></label></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input name="ans154" type="radio" class="css-checkbox" id="radio95" value="No" '.(($apply8['ans21']=='No')?'checked':'').' /><label for="radio95" class="css-label radGroup2"><span class="checkbox re_main4">No</span></label></td>
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
                                                                                <td><input class="text_line" type="text" name="ans155" value="'.$apply8['ans22'].'" style="width:380px;" /></td>
                                                                            </tr>
                                                                        </table>
                                                            <table width="0" border="0" cellspacing="0" cellpadding="3">
                                                                        	<tr>
                                                                            	<td height="25"><span class="re_main4">Signature</span></td>
                                                                                <td><input class="text_line" type="text" name="ans156" value="'.$apply8['ans23'].'" style="width:360px;" /></td>
                                                                            </tr>
                                                                        </table>
                                                            <table width="0" border="0" cellspacing="0" cellpadding="3">
                                                                        	<tr>
                                                                            	<td><span class="re_main4">Date</span></td>
                                                                                <td><input class="text_line" type="text" name="ans157" value="'.$apply8['ans24'].'" style="width:387px;" /></td>

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
                                                                            	<td><input name="ans158" type="checkbox" class="css-checkbox" id="radio96" value="Google" '.(($apply9['ans1']=='Google')?'checked':'').' /><label for="radio96"><span class="checkbox re_main4">Google</span></label></td>
                                                                                <td>&nbsp;</td>
                                                                                <td><input name="ans159" type="checkbox" class="css-checkbox" id="radio97" value="Petﬁnder" '.(($apply9['ans2']=='Petﬁnder')?'checked':'').' /><label for="radio97"><span class="checkbox re_main4">Petﬁnder</span></label></td>
                                                                                <td>&nbsp;</td>
                                                                                <td><input name="ans160" type="checkbox" class="css-checkbox" id="radio98" value="Yelp" '.(($apply9['ans3']=='Yelp')?'checked':'').' /><label for="radio98"><span class="checkbox re_main4">Yelp</span></label></td>
                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                	<td>
                                                                    	<table width="0" border="0" cellspacing="0" cellpadding="0">
                                                                        	<tr>
                                                                            	<td><input name="ans161" type="checkbox" class="css-checkbox" id="radio99" value="Yahoo" '.(($apply9['ans4']=='Yahoo')?'checked':'').' /><label for="radio99"><span class="checkbox re_main4">Yahoo</span></label></td>
                                                                                <td>&nbsp;</td>
                                                                                <td><input name="ans162" type="checkbox" class="css-checkbox" id="radio100" value="Facebook" '.(($apply9['ans5']=='Facebook')?'checked':'').' /><label for="radio100"><span class="checkbox re_main4">Facebook</span></label></td>
                                                                                <td>&nbsp;</td>
                                                                                <td><input name="ans163" type="checkbox" class="css-checkbox" id="radio101" value="Word of Mouth" '.(($apply9['ans6']=='Word of Mouth')?'checked':'').' /><label for="radio101"><span class="checkbox re_main4">Word of Mouth</span></label></td>
                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                	<td><input name="ans164" type="checkbox" class="css-checkbox" id="radio102" value="Owner of a Adopt a Doggie dog" '.(($apply9['ans7']=='Owner of a Adopt a Doggie dog')?'checked':'').' /><label for="radio102"><span class="checkbox re_main4">Owner of a Adopt a Doggie dog</span></label></td>
                                                                </tr>
                                                                <tr>
                                                                	<td><input name="ans165" type="checkbox" class="css-checkbox" id="radio103" value="Other" '.(($apply9['ans8']=='Other')?'checked':'').' /><label for="radio103"><span class="checkbox re_main4">Other</span></label></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Would you like to be invited to the Adopt a<br />Doggie Bay Area Dog Owners Facebook Page?</span></td>
                                                        <td valign="top">
                                                        	<table width="0" border="0" cellspacing="0" cellpadding="0">
                                                            	<tr>
                                                                	<td height="25"><input name="ans166" type="radio" class="css-checkbox" id="radio104" value="Yes" '.(($apply9['ans9']=='Yes')?'checked':'').' /><label for="radio104" class="css-label radGroup2"><span class="checkbox re_main4">Yes</span></label></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input name="ans166" type="radio" class="css-checkbox" id="radio105" value="No" '.(($apply9['ans9']=='No')?'checked':'').' /><label for="radio105" class="css-label radGroup2"><span class="checkbox re_main4">No</span></label></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Would you like to be included on the Adopt a<br />Doggie email list?</span></td>
                                                        <td valign="top">
                                                        	<table width="0" border="0" cellspacing="0" cellpadding="0">
                                                            	<tr>
                                                                	<td height="25"><input name="ans167" type="radio" class="css-checkbox" id="radio106" value="Yes" '.(($apply9['ans10']=='Yes')?'checked':'').' /><label for="radio106" class="css-label radGroup2"><span class="checkbox re_main4">Yes</span></label></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input name="ans167" type="radio" class="css-checkbox" id="radio107" value="No" '.(($apply9['ans10']=='No')?'checked':'').' /><label for="radio107" class="css-label radGroup2"><span class="checkbox re_main4">No</span></label></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">May we share your contact information with<br />your dog’s rescuer after the adoption is ﬁnalized?</span></td>
                                                        <td valign="top">
                                                        	<table width="0" border="0" cellspacing="0" cellpadding="0">
                                                            	<tr>
                                                                	<td height="25"><input name="ans168" type="radio" class="css-checkbox" id="radio108" value="Yes" '.(($apply9['ans11']=='Yes')?'checked':'').' /><label for="radio108" class="css-label radGroup2"><span class="checkbox re_main4">Yes</span></label></td>
                                                                    <td>&nbsp;</td>
                                                                    <td><input name="ans168" type="radio" class="css-checkbox" id="radio109" value="No" '.(($apply9['ans11']=='No')?'checked':'').' /><label for="radio109" class="css-label radGroup2"><span class="checkbox re_main4">No</span></label></td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                    	<td align="right" valign="top"><span class="re_main4">Additional comments or questions</span></td>
                                                        <td valign="top"><textarea class="textbox_box4" name="ans169">'.stripslashes($apply9['ans12']).'</textarea></td>
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
                            	<td width="500"><span class="re_main5">Thank you for your interest in Adopt a Doggie and our rescued dogs! Our sta will review your application and let you know once it has been approved. We may contact you if there are any additional questions or concerns. Welcome to the Adopt a Doggie family!</td>
                            </tr>
                            <tr>
                            	<td>&nbsp;</td>
                            </tr>
                        </table>
                    </td>
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
</form>
</div>
<!----------- 內容 結束 ------------------> 

</body>
</html>';
		//echo $this->sendmail->Body;exit;
		//phpmailer init
		if($apply2['ans4'] && $apply2['ans1']) {
			$this->sendmail->From = Company_Email;
			$this->sendmail->FromName = Company_Name;
			$this->sendmail->AddReplyTo(Company_Email, Company_Name);
			$this->sendmail->Subject = Html_Title.' Apply';
			$this->sendmail->AddAddress($apply2['ans4'], $apply2['ans1']);
			//echo $this->sendmail->From.'/'.$this->sendmail->FromName.'/'.$this->sendmail->Subject.'/'.$apply2['ans4'].'/'.$apply2['ans1'].'<br>';	
			if(!$this->sendmail->Send()) {	 
				echo "錯誤!信件無法送出<br>";		 
				echo "Mailer 錯誤訊息>>>> " . $this->sendmail->ErrorInfo;	 
			} 	
			$this->sendmail->Subject = 'Adopt a Doggie Application Received';
			$this->sendmail->ClearAddresses();
			$this->sendmail->AddAddress('adoption@adoptadoggie.org', Company_Name);
			//echo $this->sendmail->From.'/'.$this->sendmail->FromName.'/'.$this->sendmail->Subject.'<br>';	
			if(!$this->sendmail->Send()) {	 
				echo "錯誤!Admin信件無法送出<br>";		 
				echo "Mailer 錯誤訊息>>>> " . $this->sendmail->ErrorInfo;	 
			} 	
		}
	}
}
?>