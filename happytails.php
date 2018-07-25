<?php
header("content-type:text/html;charset=utf-8");
require_once('set.php');

$obj_images = new files();
$_width     = 170;
$_height    = 120;
//video
$query = "select Fullkey, title, youtube, other_video from $table_name_video where category=1 and pub=1 order by sort desc, Fullkey desc limit 0, 9";
$obj_menu1->run_mysql_list($query);
//album1
$query = "select Fullkey, title from $table_name_album where category=1 and pub=1 order by album_date desc, Fullkey desc limit 0, 1";
$album1= $obj_menu2->run_mysql_out($query);
//album2
$query = "select Fullkey, title from $table_name_album where category=2 and pub=1 order by album_date desc, Fullkey desc limit 0, 8";
$obj_menu3->run_mysql_list($query);
//album3
$query = "select Fullkey, title from $table_name_album where category=4 and pub=1 order by album_date desc, Fullkey desc limit 0, 8";
$obj_menu4->run_mysql_list($query);
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

<!-- 展開 開始 -->
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
<style type="text/css">
#NAV{
	display: none;
}
ul, li {

	list-style: none;
}
#qaContent {
}
#qaContent ul.accordionPart {
}
#qaContent ul.accordionPart li {
	padding-bottom: 12px;
	margin-top: 12px;
}
#qaContent ul.accordionPart li .qa_title {
	color: #fff;
	cursor: pointer;
	text-align:right;
	padding-right:26px;
}
#qaContent ul.accordionPart li .qa_title2 {
	color: #fff;
	cursor: pointer;
	text-align:right;
	padding-right:26px;
}
#qaContent ul.accordionPart li .qa_title_on {
	text-decoration: underline;
}
#qaContent ul.accordionPart li .qa_content {
	margin: 6px 8px 0;
	color: #666;
	float:left;
}
</style>
<script type="text/javascript">
	$(function(){
		// 幫 div.qa_title 加上 hover 及 click 事件
		// 同時把兄弟元素 div.qa_content 隱藏起來
		$('#qaContent ul.accordionPart li div.qa_title').hover(function(){
			$(this).addClass('qa_title_on');
		}, function(){
			$(this).removeClass('qa_title_on');
		}).click(function(){
			// 當點到標題時，若答案是隱藏時則顯示它；反之則隱藏
			$(this).next('div.qa_content').slideToggle();
		}).siblings('div.qa_content').hide();

		// 全部展開
		$('#qaContent .qa_showall').click(function(){
			$('#qaContent ul.accordionPart li div.qa_content').slideDown();
			return false;
		});

		// 全部隱藏
		$('#qaContent .qa_hideall').click(function(){
			$('#qaContent ul.accordionPart li div.qa_content').slideUp();
			return false;
		});
	});
</script>
<!-- 展開 結束 -->

</head>

<body>

<div id="wrapper_center">

    <?php include('include_top.php');?>

	<!----------- 內容 開始 ------------------>
  	<div class="happy">
    	<span class="ce_title2">Happy Tails</span>

        <div id="qaContent">
        	<div class="happy_1">
                <div class="big_title">Testimonials</div>
                <div style="width:100%; height:30px;"></div>
				<div style="width:940px; height:160px;">
					<?php
                    for($i=0; $i<3; $i++) {
                        $video = mysql_fetch_array($obj_menu1->result);
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
                    }
                    ?>
                </div>
                    <ul class="accordionPart">
                        <li>
                            <div class="qa_title"><img src="images/updown.png" width="44" height="11" /></div>
                            <div class="qa_content" style="margin-left:163px;">
                                <?php
                                for($i=0; $i<3; $i++) {
                                    $video = mysql_fetch_array($obj_menu1->result);
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
                                }
                                ?>
                            </div>
                        </li>
                    </ul>

           </div>

            <div class="happy_2">
                <div class="big_title">Adoption Photos</div>
                <div style="width:100%; height:30px;"></div>
                <div style="width:940px; height:160px;">
				<?php
				//photos
				$query = "select title, file1 from ".$table_name_album."_photos where album_id='".$album1['Fullkey']."' order by sort desc, Fullkey asc limit 0, 8";
				$obj_photo->run_mysql_list($query);
				for($i=0; $i<4; $i++) {
					$photo = mysql_fetch_array($obj_photo->result);
					if($photo){
						$obj_images->show_pic2_show_number('album_photos/'.$album1['Fullkey'].'/'.$photo['file1'], $_width, $_height);
						if($obj_images->size[0] < $_width)
							$img_str = 'width="170"';
						else
							$img_str = 'height="120"';
					?>
                <div class="photo_block">
                    <div style="width:170px; height:120px; background:#D5E044; color:#000; overflow:hidden;"><a class="example-image-link" href="<?='album_photos/'.$album1['Fullkey'].'/'.$photo['file1']?>" data-lightbox="example-set" data-title="<?=$photo['title']?>"><img src="<?='album_photos/'.$album1['Fullkey'].'/'.$photo['file1']?>" <?=$img_str?> border="0" /></a></div>
                    <?=stripslashes($photo['title'])?>
                </div>
                    <?php
					}
				}
				?>
                </div>
                <?php if($obj_photo->obj_all>=4){ ?>
                <ul class="accordionPart">
                    <li>
                    	<div class="qa_title2"><a href="happytails_2.php?album_id=<?=$album1['Fullkey']?>"><img src="images/updown.png" width="44" height="11" border="0" /></a></div>
                    </li>
                </ul>
                <?php } ?>
            </div>

            <div class="happy_3">
                <div class="big_title">Monthly Meet Up Photos</div>
                <div style="width:100%; height:30px;"></div>
                <div style="width:940px; height:160px;">
				<?php
				for($i=0; $i<4; $i++) {
					$album = mysql_fetch_array($obj_menu3->result);
					if($album){
						//first photo
						$query = "select file1 from ".$table_name_album."_photos where album_id='".$album['Fullkey']."' order by sort desc, Fullkey asc limit 0, 1";
						$photo = $obj_photo->run_mysql_out($query);
						$obj_images->show_pic2_show_number('album_photos/'.$album['Fullkey'].'/'.$photo['file1'], $_width, $_height);
						if($obj_images->size[0] < $_width)
							$img_str = 'width="170"';
						else
							$img_str = 'height="120"';
					?>
                <div class="photo_block">
                    <div style="width:170px; height:120px; background:#D5E044; color:#000; overflow:hidden;"><a href="happytails_3.php?album_id=<?=$album['Fullkey']?>"><img src="<?='album_photos/'.$album['Fullkey'].'/'.$photo['file1']?>" <?=$img_str?> border="0" /></a></div>
                    <?=stripslashes($album['title'])?>
                </div>
                    <?php
					}
				}
				?>
                </div>
                <?php if($obj_menu3->obj_all>=4){ ?>
                <ul class="accordionPart">
                    <li>
                    	<div class="qa_title2"><a href="happytails_3.php?album_id=<?=$album['Fullkey']?>"><img src="images/updown.png" width="44" height="11" /></a></div>
                    </li>
                </ul>
                <?php } ?>
            </div>

            <div class="happy_6">
                <div class="big_title">Airport Pickup</div>
                <div style="width:100%; height:30px;"></div>
                <div style="width:940px; height:160px;">
				<?php
				for($i=0; $i<4; $i++) {
					$album = mysql_fetch_array($obj_menu4->result);
					if($album){
						//first photo
						$query = "select file1 from ".$table_name_album."_photos where album_id='".$album['Fullkey']."' order by sort desc, Fullkey asc limit 0, 1";
						$photo = $obj_photo->run_mysql_out($query);
						$obj_images->show_pic2_show_number('album_photos/'.$album['Fullkey'].'/'.$photo['file1'], $_width, $_height);
						if($obj_images->size[0] < $_width)
							$img_str = 'width="170"';
						else
							$img_str = 'height="120"';
					?>
                <div class="photo_block">
                    <div style="width:170px; height:120px; background:#D5E044; color:#000; overflow:hidden;"><a href="happytails_4.php?album_id=<?=$album['Fullkey']?>"><img src="<?='album_photos/'.$album['Fullkey'].'/'.$photo['file1']?>" <?=$img_str?> border="0" /></a></div>
                    <?=stripslashes($album['title'])?>
                </div>
                    <?php
					}
				}
				?>
                </div>
                <?php if($obj_menu4->obj_all>=4){ ?>
                <ul class="accordionPart">
                    <li>
                    	<div class="qa_title2"><a href="happytails_4_album.php"><img src="images/updown.png" width="44" height="11" /></a></div>
                    </li>
                </ul>
                <?php } ?>
            </div>
        </div>
	</div>


    <div class="happy_5">
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
