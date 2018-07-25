<?php
header("content-type:text/html;charset=utf-8");
require_once('set.php');

$page_id = 1;
$query = "select * from $table_name_pages where Fullkey='$page_id'";
$pages1= $obj_pages->run_mysql_out($query);
$page_id = 2;
$query = "select * from $table_name_pages where Fullkey='$page_id'";
$pages2= $obj_pages->run_mysql_out($query);
//news category list
$query = "select Fullkey, name from ".$table_name_news."_category where Fullkey=1";
$cate1 = $obj_cate->run_mysql_out($query);
$query = "select Fullkey, name, content from ".$table_name_news."_category where Fullkey=2";
$cate2 = $obj_cate->run_mysql_out($query);
$query = "select Fullkey, name from ".$table_name_news."_category where Fullkey=3";
$cate3 = $obj_cate->run_mysql_out($query);
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
<link rel="stylesheet" href="css/top_menu_about.css">

<title><?=Html_Title?></title>
<link rel="icon" type="image/png" href="favicon.png" />
<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
<link rel="apple-touch-icon" href="favicon_m.png"/>

<style type="text/css">
<!--
body {
	background: url(images/e_bg.jpg) repeat-x top left #eb5360;
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

<div id="wrapper_center_05">

    <?php include('include_top.php');?>

	<!----------- 內容 開始 ------------------>
  	<div class="about">
    <div class="about_02">
        <div class="ce_title14"><a name="Our Team" id="Our Team"></a><?=stripslashes($pages1['title'])?></div>

    	<div class="about_1">
            <div class="about_L"><?=stripslashes($pages1['content'])?></div>
            <div class="about_R">
                <div class="about_R1"><?php if($pages1['file1']){ ?><img src="pages/<?=$pages1['file1']?>" width="400" /><?php } ?></div>
                <div class="about_R2"><?php if($pages1['file2']){ ?><img src="pages/<?=$pages1['file2']?>" width="400" /><?php } ?></div>
            </div>
        </div>

		<div class="ce_title14"><a name="Adoption Process" id="Adoption Process"></a><?=stripslashes($pages2['title'])?></div>

        <?=stripslashes($pages2['content'])?>
        <div class="top" style="margin:20px 0px 20px 0;">
        	<a href="#top"><img src="images/top_05.png" width="28" height="28" /></a>
        </div>
        <div class="about_L2">
            <div class="ce_title14-"><a name="Volunteer" id="Volunteer"></a><?=stripslashes($cate1['name'])?></div>
            <?php
			$query = "select title, content from $table_name_news where category='".$cate1['Fullkey']."' and pub=1 order by news_date desc limit 0, 2";
			$obj_news->run_mysql_list($query);
			for($i=0; $i<$obj_news->obj_all; $i++) {
				$news = mysql_fetch_array($obj_news->result);
				if($news) {
				?>
            <div class="ce_title13"><?=stripslashes($news['title'])?></div>
            <div class="m1"><?=stripslashes($news['content'])?></div>
                <?php
				}
			}
			?>
        	<div class="ce_title14-2" style="margin-top:30px;"><a name="Partners" id="Partners"></a><?=stripslashes($cate2['name'])?></div>
            <div class="m1"><?=stripslashes($cate2['content'])?></div>
            <?php
			$query = "select title, file1, content from $table_name_news where category='".$cate2['Fullkey']."' and pub=1 order by news_date desc limit 0, 3";
			$obj_news->run_mysql_list($query);
			for($i=0; $i<$obj_news->obj_all; $i++) {
				$news = mysql_fetch_array($obj_news->result);
				if($news) {
				?>
            <div class="about_LRs">
                <div class="about_Ls"><?php if($news['file1']){ ?><img src="news/<?=$news['file1']?>" width="146" height="75" /><?php } ?></div>
                <div class="about_Rs">
                    <div class="ce_title13-"><?=stripslashes($news['title'])?></div>
                    <div class="m2"><?=stripslashes($news['content'])?></div>
                </div>
            </div>
                <?php
				}
			}
			?>
    	</div>

        <div class="about_R">
       		<div class="about_R1"><?php if($pages2['file1']){ ?><img src="pages/<?=$pages2['file1']?>" width="400"/><?php } ?></div>
          	<div class="about_R2"><?php if($pages2['file2']){ ?><img src="pages/<?=$pages2['file2']?>" width="400"/><?php } ?></div>
            <div class="top" style="margin:30px 0px 40px 0;">
        		<a href="#top"><img src="images/top_05.png" width="28" height="28" /></a>
        	</div>
        </div>

        <div style="width:100%; float:left">
            <div class="about_L2">
            <div class="ce_title14-2" style="margin-top:30px;"><a name="FAQ" id="FAQ"></a><?=stripslashes($cate3['name'])?></div>
				<?php
                $query = "select title, content from $table_name_news where category='".$cate3['Fullkey']."' and pub=1 order by news_date desc";
                $obj_news->run_mysql_list($query);
                for($i=0; $i<$obj_news->obj_all; $i++) {
                    $news = mysql_fetch_array($obj_news->result);
                    if($news) {
                    ?>
                <div class="ce_title14-3">Q.</div>
                <div class="m1"><?=stripslashes($news['title'])?></div> <br />
                <div class="ce_title14-4">A.</div>
                <div class="m1"><?=nl2br($news['content'])?></div>
                    <?php
                    }
                }
                ?>
        	</div>
        </div>

        <div class="top" style="margin:60px 0px 40px 0;">
            <a href="#top"><img src="images/top_05.png" width="28" height="28" /></a>
        </div>

        <div style="width:100%; height:565px; float:left"></div>

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
