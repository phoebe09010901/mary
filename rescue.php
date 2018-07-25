<?php
header("content-type:text/html;charset=utf-8");
require_once('set.php');

$page_id = 5;
$query = "select * from $table_name_pages where Fullkey='$page_id'";
$pages = $obj_pages->run_mysql_out($query);
if($pages['youtube']) {
	$youtube = explode("//", $pages['youtube']);
	$youtube = explode("/", $youtube[count($youtube)-1]);
	$youtube_id = $youtube[count($youtube)-1];
}
if($pages['youtube2']) {
	$youtube = explode("//", $pages['youtube2']);
	$youtube = explode("/", $youtube[count($youtube)-1]);
	$youtube_id2 = $youtube[count($youtube)-1];
}
//banner
$query = "select * from $table_name_banner where category=4 and pub=1 order by sort desc";
$obj_banner->run_mysql_list($query);
//video
$query = "select Fullkey, title, youtube, other_video from $table_name_video where category=2 and pub=1 order by sort desc limit 0, 9";
$obj_video->run_mysql_list($query);
while($obj_video->obj_all%3!=0)
	$obj_video->obj_all++;
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

<!-- 輪播 開始 -->
<link rel="stylesheet" type="text/css" href="css/content_banner.css" />
<script src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/slideshow.js"></script>
<script type="text/javascript">
//<![CDATA[
	$(function() {
	Slideshow.initialize('#slideshow', [
	<?php
	for($i=0; $i<$obj_banner->obj_all; $i++) {
		$banner = mysql_fetch_array($obj_banner->result);
		if($banner) {
		?>
	{
		image: "banner/<?=$banner['file1']?>",
		desc: "",
		title: "<?=stripslashes($banner['title'])?>",
		url: "<?=$banner['url_to']?>",
		id: ""
	}
		<?php
		}
		if($i<$obj_banner->obj_all-1)
			echo ',';
	}
	mysql_data_seek($obj_banner->result, 0);
	?>
	]);

	});
//]]>
</script>
<!-- 輪播 結束 -->

</head>

<body>

<div id="wrapper_center_03">

    <?php include('include_top.php');?>

	<!----------- 內容 開始 ------------------>
  	<div class="rescue">
    <div class="rescue_02">
    	<span class="ce_title3"><?=stripslashes($pages['title'])?></span>

        <div class="rescue_1">
          	<div class="rescue_1_1">
            	<div id="slideshow">
                <div class="container">
					<?php
                    for($i=0; $i<$obj_banner->obj_all; $i++) {
                        $banner = mysql_fetch_array($obj_banner->result);
                        if($banner) {
                        ?>
                        <div class="slide" id="slide-<?=$i?>" style="background-image: url(banner/<?=$banner['file1']?>); display: <?=($i==0)?'block':'none'?>;"></div>
                        <?php
                        }
                    }
                    ?>
                </div>
                </div>
          	</div>
          	<div class="rescue_1_2">
            	<span class="ce_title4"><?=stripslashes($pages['content'])?></span>
          	</div>
          	<div class="rescue_1_3">
            	<span class="ce_title5"><a href="#Videos">Rescue Videos</a></span>
          	</div>
          	<div class="rescue_1_4">
            	<span class="ce_title5"><a href="#Photos">Rescue Photos</a></span>
          	</div>
   	  	</div>

        <div class="rescue_2_1"><?=stripslashes($pages['content2'])?></div>
        <?php if($pages['video_title'] && ($youtube_id||$pages['other_video']) && $pages['video_title2'] && ($youtube_id2||$pages['other_video2'])) { ?>
        <div class="rescue_2_2" style="margin-top:20px;">
      		<span class="re_main2"><?=stripslashes($pages['video_title'])?></span>
    	</div>
    	<div class="rescue_2_2">
			<?php
            if($youtube_id) {
            	?><iframe width="398" height="224" src="//www.youtube.com/embed/<?=$youtube_id?>" frameborder="0" allowfullscreen></iframe><?php
            }elseif($pages['other_video']) {
            	echo stripslashes($pages['other_video']);
            }
            ?>
    	</div>
   	  	<div class="rescue_2_2">
         	<span class="re_main2"><?=stripslashes($pages['video_title2'])?></span>
    	</div>
    	<div class="rescue_2_2">
			<?php
            if($youtube_id2) {
            	?><iframe width="398" height="224" src="//www.youtube.com/embed/<?=$youtube_id2?>" frameborder="0" allowfullscreen></iframe><?php
            }elseif($pages['other_video2']) {
            	echo stripslashes($pages['other_video2']);
            }
            ?>
    	</div>
        <?php } ?>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td>
            <div class="rescue_3"><!--頁簽-->
            <div class="rescue_3_1">
              <div class="ce_title7"><a name="Videos" id="Videos"></a>Rescue Videos</div>
           	  <div id="TabbedPanels1" class="TabbedPanels">
                      <ul class="TabbedPanelsTabGroup">
                    	<?php
						for($year=date("Y")-2; $year<=date("Y"); $year++) {
							?><li class="TabbedPanelsTab <?php if($year==date("Y")){echo 'TabbedPanelsTabSelected';} ?>" tabindex="0"><?=$year?></li><?php
						}
						?>
                      </ul>
                <div class="TabbedPanelsContentGroup">
                    <?php
					for($year=date("Y")-2; $year<=date("Y"); $year++) {
						$query = "select Fullkey, title, youtube from $table_name_video where category=2 and pub=1 and news_date like '".$year."-%' order by news_date desc limit 0, 9";
						$obj_video->run_mysql_list($query);
						?><div class="TabbedPanelsContent"><?php

						for($i=0; $i<$obj_video->obj_all; $i++) {
							$video = mysql_fetch_array($obj_video->result);
							if($video) {
								$youtube_id = '';
								if($video['youtube']) {
									$youtube = explode("//", $video['youtube']);
									$youtube = explode("/", $youtube[count($youtube)-1]);
									$youtube_id = $youtube[count($youtube)-1];
								}
								?>
                    <div class="rescue_3_1_all">
                        <div class="rescue_3_1_1">
						<?php
                        if($youtube_id) {
                       		?><iframe width="276" height="155" src="//www.youtube.com/embed/<?=$youtube_id?>" frameborder="0" allowfullscreen></iframe><?php
                        }elseif($video['other_video']) {
                        	echo stripslashes($video['other_video']);
                        }
                        ?>
                        </div>
                        <div class="rescue_3_1_2"><?=$video['title']?></div>
                    </div><?php
							}
						}

						?></div><?php
					}
					?>
                </div>
              </div>
        </div><!--頁簽-->
            <div class="top" style="margin:30px 20px 0px 0;">
                <a href="#top"><img src="images/top_03.png" width="28" height="28" /></a>
            </div>
            </td>
          </tr>
          <tr>
            <td>
            <div class="rescue_3"><!--頁簽-->
            <div class="rescue_3_2">
            <div class="ce_title7"><a name="Photos" id="Photos"></a>Adopted Dogs</div>
              <div id="TabbedPanels2" class="TabbedPanels">
                    <ul class="TabbedPanelsTabGroup">
                    	<?php
						for($year=date("Y")-2; $year<=date("Y"); $year++) {
							?><li class="TabbedPanelsTab <?php if($year==date("Y")){echo 'TabbedPanelsTabSelected';} ?>" tabindex="0"><?=$year?></li><?php
						}
						?>
                      </ul>
                    <div class="TabbedPanelsContentGroup">
                    	<?php
						for($year=date("Y")-2; $year<=date("Y"); $year++) {
							$query = "select Fullkey, title from $table_name_album where category=3 and pub=1 and album_date like '".$year."-%' order by album_date desc limit 0, 1";
							$album = $obj_album->run_mysql_out($query);
							?><div class="TabbedPanelsContent"><?php
							//photos
							$query = "select title, file1 from ".$table_name_album."_photos where album_id='".$album['Fullkey']."' order by sort desc, Fullkey asc limit 0, 8";
							$obj_photo->run_mysql_list($query);
							for($i=0; $i<$obj_photo->obj_all; $i++) {
								$photo = mysql_fetch_array($obj_photo->result);
								if($photo) {
									?><div class="rescue_3_2_all2"><div style="width: 203px;height: 152px; overflow:hidden; margin-bottom:10px;"><a class="example-image-link" href="<?='album_photos/'.$album['Fullkey'].'/'.$photo['file1']?>" data-lightbox="example-set" data-title="<?=$photo['title']?>"><img src="<?='album_photos/'.$album['Fullkey'].'/'.$photo['file1']?>" width="203" border="0" /></a></div><?=$photo['title']?></div><?php
								}
							}

							?><div style="width:100%; float:right; text-align:right; color:#FFF;">
                                <a href="rescue_2.php?album_id=<?=$album['Fullkey']?>" style="color:#FFF">more</a>&nbsp;&nbsp;&nbsp;&nbsp;
                            </div></div><?php
						}
						?>
                    </div>
                </div>
          	</div>
        </div><!--頁簽-->
            <div class="top" style="margin:30px 20px 40px 0;">
                <a href="#top"><img src="images/top_03.png" width="28" height="28" /></a>
            </div>
            </td>
          </tr>
        </table>

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

<!-- 光箱特效 -->
<script src="js/lightbox.js"></script>

<!-- 頁籤 -->
<script type="text/javascript">
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1", {defaultTab:2});
var TabbedPanels2 = new Spry.Widget.TabbedPanels("TabbedPanels2", {defaultTab:2});
</script>

</body>
</html>
<?php include("include_bottom.php"); ?>
