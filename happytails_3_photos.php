<?php
header("content-type:text/html;charset=utf-8");
require_once('set.php');
require_once(Root_Includes_Path.'function_page.php');

$album_id = format_data($_GET['album_id'], 'int');
$page_num = 40; //設定每頁顯示數目
$page_go  = (!$_GET['page_go'])?1:format_data($_GET['page_go'], 'int');
$obj_images = new files();
$_width     = 170;
$_height    = 120;

//album
$query = "select title from $table_name_album where Fullkey='$album_id'";
$album = $obj_album->run_mysql_out($query);
//photo list
$query = "select * from ".$table_name_album."_photos where album_id='".$album_id."' order by sort desc, Fullkey asc";
$obj_photo->count_page($query, $page_go, $page_num);
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

<!-- 光箱特效 開始 -->
<link rel="stylesheet" href="css/lightbox.css">
<!-- 光箱特效 結束 -->

<title><?=Html_Title?></title>
<link rel="icon" type="image/png" href="favicon.png" />
<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
<link rel="apple-touch-icon" href="favicon_m.png"/>

<style type="text/css">
<!--
body {
	background: url(images/b_bg.jpg) repeat-x top left #7cb737;
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

<div id="wrapper_center">

    <?php include('include_top.php');?>

	<!----------- 內容 開始 ------------------>
  	<div class="happy_4">
    	<span class="ce_title2">Happy Tails</span>

        <div id="qaContent">
            <div class="happy_3_2">
                <div class="big_title">Monthly Meet Up Photos</div>
                <div style="width:100%; height:30px;"></div>
                <div style="width:940px; height:160px;">
                <?php
				for($i=0; $i<$page_num; $i++) {
					$photo = mysql_fetch_array($obj_photo->result);
					if($i%4==0){ ?><div style="float:right ; margin-right:15px; width:720px;"><?php }
					if($photo) {
						$obj_images->show_pic2_show_number('album_photos/'.$album_id.'/'.$photo['file1'], $_width, $_height);
						if($obj_images->size[0] < $_width)
							$img_str = 'width="170"';
						else
							$img_str = 'height="120"';
					?>
                    <div class="photo_block_3">
                        <div style="width:170px; height:120px; background:#D5E044; color:#000; overflow:hidden;">
                            <a class="example-image-link" href="<?='album_photos/'.$album_id.'/'.$photo['file1']?>" data-lightbox="example-set" data-title="<?=$photo['title']?>"><img class="example-image" src="<?='album_photos/'.$album_id.'/'.$photo['file1']?>" <?=$img_str?> border="0" alt="<?=$photo['title']?>" title="<?=$photo['title']?>"/></a>
                        </div><?=$photo['title']?>
                    </div>
                    <?php
					}
					if($i%4==3){ ?></div><?php }
				}
				?>
                </div>
                <div style="float:right ; margin-right:15px; margin-top: 20px; width:720px;"><?php change_page1($page_num, $page_go, $obj_photo->page_all, $obj_photo->obj_all, array('album_id'), array($album_id)); ?></div>
            </div>
        </div>
</div>

<div class="happy_5">
        <div style="width:167px; height:38px; float:left; margin-top:85px;">
        	<a href="happytails.php"><img src="images/happly_2_01.png" alt="" /></a>
        </div>
        <div class="top" style="margin:85px 30px 0 0; float:right;">
        	<a href="#top"><img src="images/top_01.png" width="28" height="28" /></a>
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

<!-- 光箱特效 -->
<script src="js/lightbox.js"></script>

</body>
</html>
<?php include("include_bottom.php"); ?>
