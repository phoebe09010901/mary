<?php
header("content-type:text/html;charset=utf-8");
require_once('set.php');

//Banner I
$query = "select * from $table_name_banner where Fullkey=5";
$banner1_1 = $obj_banner->run_mysql_out($query);
$query = "select * from $table_name_banner where Fullkey=6";
$banner1_2 = $obj_banner->run_mysql_out($query);
$query = "select * from $table_name_banner where Fullkey=7";
$banner1_3 = $obj_banner->run_mysql_out($query);
//Banner II
$query = "select * from $table_name_banner where Fullkey=8";
$banner2_1 = $obj_banner->run_mysql_out($query);
$query = "select * from $table_name_banner where Fullkey=9";
$banner2_2 = $obj_banner->run_mysql_out($query);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<meta name="viewport" content="width=device-width, initial-scale=1">

<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<link href="fonts.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="css/all_index.css">
<link rel="stylesheet" href="css/top_menu_index.css">

<title><?=Html_Title?></title>

<style type="text/css">
<!--
body {
	background:#efefef;
}

/* --電腦版型------------------------------------- */
#wrapper {
	width: 100%; 	
    margin-top: 0;
	margin-right: auto;
	margin-bottom: 0;
	margin-left: auto;
}

.center_btn_Rindex{/*phoebe*/
	height: 40px;
	width: 690px;
	float: left;
	margin-left:10px;
	}
.center_btn_L{
	height: 161px;
	width: 149px;
	float: left;
	margin-right: 70px;
	margin-left: 20px;
	}
	
#banner_01 { display: block;}
.bzBanner{width:1200px; min-width:1024px; height:650px; overflow:hidden; position: relative; margin:0 auto; }
.flick-title {
	font-family: "Helvetica Neue";
	text-align: left;
	font-size: 127px;
	line-height:100px;
}
.flick-title2 {
	font-family: "Helvetica Neue";
	text-align: left;
	color: #d5e044;
	font-size: 127px;
	line-height:100px;
}

#banner_02 { display: none;}

.big_box {
	position: absolute; width: 100%; z-index: 8000; top: 700px;
}
.index_box{
	width: 963px;
	margin:0 auto;
}
.index_4box{
	width: 963px;
	margin:0 auto;
	float:left;
	}
.index_3box{
	width: 963px;
	background-image: url(images/in_b01.png);
	background-repeat: no-repeat;
	height: 368px;
	margin:0 auto;
	float:left;
	}

/*
.index_4box{
	position: absolute;
	width: 963px;
	padding-right: 154px;
	padding-left: 160px;
	z-index: 8888;
	top: 770px;
	}
.index_3box{
	position: absolute;
	width: 963px;
	z-index: 8888;
	top: 1035px;
	background-image: url(images/in_b01.png);
	background-repeat: no-repeat;
	height: 368px;
	margin-right: 154px;
	margin-left: 160px;
	}	
*/
/* --手機版型------------------------------------- */

@media screen and ( max-width:1024px) {
#wrapper {
	width: 1023px;
	margin:0 auto;
}

.center_btn_Rindex{/*phoebe*/
	height: 40px;
	width: 650px;
	float: left;
	margin-top: 114px;
	padding-top:15px;
	padding-left:40px;
	}
.center_btn_L{
	height: 161px;
	width: 149px;
	float: left;
	margin-right: 70px;
	margin-left: 20px;
	margin-top:0px;
	}
		
#banner_01 { display: none;}
#banner_02 { display: block;}
.bzBanner2{width:99%; min-width:1024px; height:650px; overflow:hidden; position: relative; float:left;}
.flick-title {
	font-family: "Helvetica Neue";
	text-align: left;
	font-size: 100px;
	line-height:85px;
}
.flick-title2 {
	font-family: "Helvetica Neue";
	text-align: left;
	color: #d5e044;
	font-size: 100px;
	line-height:85px;
}

.big_box {
	position: absolute; width: 100%; min-width:1023px; z-index: 8888; top: 630px;
}
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

</head>

<body>

<div style="width:100%; height:161px;">
<?php include('include_top.php');?>
</div>


<!-- 上方menu 開始 -->
<script type="text/javascript" src="js/jquery-1.11.0.min.js"></script> 
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
