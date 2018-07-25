<?php
header("content-type:text/html;charset=utf-8");
require_once('set.php');

$page_id = 4;
$query = "select * from $table_name_pages where Fullkey='$page_id'";
$pages = $obj_pages->run_mysql_out($query);
if($pages['youtube']) {
	$youtube = explode("//", $pages['youtube']);
	$youtube = explode("/", $youtube[count($youtube)-1]);
	$youtube_id = $youtube[count($youtube)-1];
}
//banner
$query = "select * from $table_name_banner where category=5 and pub=1 order by sort desc";
$obj_banner->run_mysql_list($query);
//video
$query = "select Fullkey, title, youtube, other_video from $table_name_video where category=3 and pub=1 order by sort desc limit 0, 9";
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

<title><?=Html_Title?></title>
<link rel="icon" type="image/png" href="favicon.png" />
<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
<link rel="apple-touch-icon" href="favicon_m.png"/>

<style type="text/css">
<!--
body {
	background: url(images/d_bg.jpg) repeat-x top left #8156c2;
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

<div id="wrapper_center_04">

    <?php include('include_top.php');?>

	<!----------- 內容 開始 ------------------>
  	<div class="training">
    	<span class="ce_title8"><?=stripslashes($pages['title'])?></span>

    	<div class="training_1">
          	<div class="training_1_1">
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
          	<div class="training_1_2">
            	<span class="ce_title9"><?=stripslashes($pages['content'])?></span>
          	</div>
          	<div class="training_1_3">
            	<span class="ce_title5"><img src="images/training_01.png" width="150" height="164" /></span>
          	</div>
    	</div>

        <div class="training_2_1"><?=stripslashes($pages['content2'])?></div>


        <div class="training_2_2" style="margin-top: 30px;">
      		<!--<span class="re_main2">Video of our international rescue.</span>-->
    	</div>

    	<div class="training_2_2">
       		<iframe width="398" height="224" src="//www.youtube.com/embed/<?=$youtube_id?>" frameborder="0" allowfullscreen></iframe>
    	</div>

        <div class="ce_title10">Training Videos</div>
            <?php
			for($i=0; $i<$obj_video->obj_all; $i++) {
				$video = mysql_fetch_array($obj_video->result);
				if($i%3==0){ ?><div class="training_4"><div class="big_title"></div><?php }
				if($video){
					$youtube_id = '';
					if($video['youtube']) {
						$youtube = explode("//", $video['youtube']);
						$youtube = explode("/", $youtube[count($youtube)-1]);
						$youtube_id = $youtube[count($youtube)-1];
					}
				?>
            <div class="movie_block">
            	<?php
				if($youtube_id) {
					?><iframe width="223" height="125" src="//www.youtube.com/embed/<?=$youtube_id?>" frameborder="0" allowfullscreen></iframe><?php
				}elseif($video['other_video']) {
					echo stripslashes($video['other_video']);
				}
				?>
                <div style="width:100%; height:10px;"></div>
                <?=stripslashes($video['title'])?>
            </div>
                <?php
				}
				if($i%3==2){ ?></div><?php }
			}
			?>
            </div>
            <div class="top" style="margin:20px 30px 40px 0;">
        		<a href="#top"><img src="images/top_04.png" width="28" height="28" /></a>
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
