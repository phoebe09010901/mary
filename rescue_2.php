<?php
header("content-type:text/html;charset=utf-8");
require_once('set.php');
require_once(Root_Includes_Path.'function_page.php');

$album_id = format_data($_GET['album_id'], 'int');
$page_num = 40; //設定每頁顯示數目
$page_go  = (!$_GET['page_go'])?1:format_data($_GET['page_go'], 'int');

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

<title><?=Html_Title?></title>
<link rel="icon" type="image/png" href="favicon.png" />
<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
<link rel="apple-touch-icon" href="favicon_m.png"/>

<style type="text/css">
<!--
body {
	background: url(images/c_bg.jpg) repeat-x top left #3267a9;
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

<!-- 頁籤 -->
<link href="SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
<script src="SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
<!-- 頁籤 -->

<!-- 光箱特效 開始 -->
<link rel="stylesheet" href="css/lightbox.css">
<!-- 光箱特效 結束 -->

</head>

<body>

<div id="wrapper_center_03">

    <?php include('include_top.php');?>

	<!----------- 內容 開始 ------------------>
  	<div class="rescue">
    <div class="rescue_02">

        <div class="rescue_3"><!--頁簽-->
            <div class="rescue_3_2">
            <div class="ce_title7"><a name="Photos" id="Photos"></a>Adopted Dogs</div>
              <div id="TabbedPanels2" class="TabbedPanels">
                    <ul class="TabbedPanelsTabGroup">
                        <li class="TabbedPanelsTab2 TabbedPanelsTabSelected" tabindex="0"><?=stripslashes($album['title'])?></li>
                      </ul>
                    <div class="TabbedPanelsContentGroup">
                        <div class="TabbedPanelsContent">
							<div style="width:940px; height:160px;">
							<?php
                            for($i=0; $i<$page_num; $i++) {
                                $photo = mysql_fetch_array($obj_photo->result);
                                if($i%4==0){ ?><div style="float:left"><?php }
                                if($photo) {
                                ?>
                                    <div class="rescue_3_2_all2">
                                        <div style="width:203px; height:152px; background:#D5E044; color:#000; overflow:hidden; margin-bottom:10px;">
                                        <a class="example-image-link" href="<?='album_photos/'.$album_id.'/'.$photo['file1']?>" data-lightbox="example-set" data-title="<?=$photo['title']?>"><img class="example-image" src="<?='album_photos/'.$album_id.'/'.$photo['file1']?>" width="203" border="0" alt="<?=$photo['title']?>" title="<?=$photo['title']?>"/></a>
                                        </div><?=$photo['title']?>
                                    </div>

                                <?php
                                }
                                if($i%4==3){ ?></div><?php }
                            }
                            ?>
                            <div style="margin-top: 20px;"><?php change_page1($page_num, $page_go, $obj_photo->page_all, $obj_photo->obj_all, array('album_id'), array($album_id)); ?></div>
                            </div>
                        </div>
                    </div>
                </div>
          	</div>
        </div><!--頁簽-->
          	<div style="width:167px; height:38px; float:left; margin-top:30px; margin-left:20px;">
        		<a href="rescue.php"><img src="images/rescue_01.png" alt="" /></a>
        	</div>

            <div class="top" style="margin:30px 20px 40px 0;">
        		<a href="#top"><img src="images/top_03.png" width="28" height="28" /></a>
        	</div>
        </div>
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

<!-- 頁籤 -->
<script type="text/javascript">
var TabbedPanels2 = new Spry.Widget.TabbedPanels("TabbedPanels2", {defaultTab:0});
</script>

<!-- 光箱特效 -->
<script src="js/lightbox.js"></script>

</body>
</html>
<?php include("include_bottom.php"); ?>
