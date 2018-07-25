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

<meta name=”viewport” content=”width=device-width,initial-scale=1.0”>

<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<link href="fonts.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="css/all_index.css">
<link rel="stylesheet" href="css/top_menu_index.css">

<title><?=Html_Title?></title>
<link rel="icon" type="image/png" href="favicon.png" />
<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
<link rel="apple-touch-icon" href="favicon_m.png"/>

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
	width: 730px;
	float: left;
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
	position: absolute; width: 100%; min-width:1024px; z-index: 8000; top: 700px;
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


<div style="width:1024px; height:161px; margin:0 auto;">
<?php include('include_top.php');?>
</div>

<div id="WRAPPER" style="clear:both;">
<?php  if(!$_GET["screenX"]) {  ?>
<script>
location = location.href+"?screenX="+screen.width+"&screenY="+screen.height;
</script>
<?php exit;  }  $screenX = $_GET["screenX"];?>

<?php if($screenX >= 1025){ ?>
	<?php include('tp_in_banner_bigger.php');?>
<?php }elseif($screenX <= 1024){ ?>
    <?php include('tp_in_banner.php');?>
<?php }else{ ?>
    none
<?php } ?>

</div>


<div class="big_box">
<div style="width:1024px; height:635px; margin:0 auto;">
<div class="index_box">

	<div class="index_4box">
    	<div class="index_4box_all">
        	<div class="index_4box_1"><span class="in_title1"><?=stripslashes($banner1_1['title'])?></span></div>
            <div class="index_4box_2"><img src="banner/<?=$banner1_1['file1']?>" width="209"/></div>
            <div class="index_4box_3"><span class="center1"><?=stripslashes($banner1_1['content'])?></span></div>
            <div class="index_4box_4"><span class="in_btn" style="margin-top:5px; letter-spacing:1px;"><a href="<?=$banner1_1['url_to']?>">ADOPT NOW</a></span></div>
        </div>
        <div class="index_4box_all">
        	<div class="index_4box_1"><span class="in_title2"><?=stripslashes($banner1_2['title'])?></span></div>
            <div class="index_4box_2"><img src="banner/<?=$banner1_2['file1']?>" width="209"/></div>
            <div class="index_4box_3"><span class="center1"><?=stripslashes($banner1_2['content'])?></span></div>
            <div class="index_4box_4"><span class="in_btn" style="margin-top:5px; letter-spacing:1px;"><a href="<?=$banner1_2['url_to']?>">OUR BIG FAMILY</a></span></div>
        </div>
        <div class="index_4box_all_3">
        	<div class="index_4box_1"><span class="in_title3">DONATE</span></div>
            <div class="index_4box_3_1"><img src="images/in_4_3.jpg" width="88" height="180" /></div>
            <div class="index_4box_3_2">
            	<table width="0" border="0" cellspacing="0" cellpadding="0">
                	<tr>
                    	<td width="45" height="22">
                        	<table width="0" border="0" cellspacing="0" cellpadding="0">
                              	<tr>
                                	<td><input type="radio" name="radio" id="radio" value="radio" /></td>
                                	<td class="re_main4">25</td>
                              	</tr>
                          	</table>
                        </td>
                        <td>
                        	<table width="0" border="0" cellspacing="0" cellpadding="0">
                              	<tr>
                                	<td><input type="radio" name="radio" id="radio2" value="radio" /></td>
                                	<td class="re_main4">50</td>
                              	</tr>
                            </table>
                        </td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                    	<td height="22"><table width="0" border="0" cellspacing="0" cellpadding="0">
                    	  <tr>
                    	    <td><input type="radio" name="radio" id="radio3" value="radio" /></td>
                    	    <td class="re_main4">100</td>
                  	    </tr>
                  	  </table></td>
                        <td><table width="0" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td><input type="radio" name="radio" id="radio5" value="radio" /></td>
                            <td class="re_main4">250</td>
                          </tr>
                        </table></td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                    	<td colspan="3">
                        	<table width="0" border="0" cellspacing="0" cellpadding="0">
                              	<tr>
                                	<td width="45" height="22"><table width="0" border="0" cellspacing="0" cellpadding="0">
                                	  <tr>
                                	    <td><input type="radio" name="radio" id="radio7" value="radio" /></td>
                                	    <td class="re_main4">500</td>
                              	    </tr>
                              	  </table></td>
                                    <td><table width="0" border="0" cellspacing="0" cellpadding="0">
                                      <tr>
                                        <td><input type="radio" name="radio" id="radio6" value="radio" /></td>
                                        <td class="re_main4">1000</td>
                                      </tr>
                                    </table></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                      <td height="22" colspan="3"><table width="0" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td><input type="radio" name="radio" id="radio8" value="radio" /></td>
                          <td width="35" class="re_main4">Other </td>
                          <td class="re_main4"><label for="textfield"></label>
                          <input name="textfield" type="text" id="textfield" size="5" /></td>
                        </tr>
                      </table></td>
                    </tr>
                </table>
            </div>
            <div class="index_4box_3_3">
            	<table width="0" border="0" cellspacing="0" cellpadding="0">
                	<tr>
                    	<td valign="top"><input type="checkbox" name="checkbox" id="checkbox" /></td>
                        <td valign="top" class="center2">Make this monthly a gift</td>
                    </tr>
                </table>
            </div>
            <div class="index_4box_3_4"><span class="in_btn" style="letter-spacing:1px;"><a href="#">DONATE NOW</a></span></div>
        </div>
        <div class="index_4box_all_4">
        	<div class="index_4box_1"><span class="in_title4"><a href="http://www.facebook.com/groups/832002083479685" target="new"><?=stripslashes($banner1_3['title'])?></a></span></div>
            <div class="index_4box_2"><img src="banner/<?=$banner1_3['file1']?>" width="209"/></div>
            <div class="index_4box_3"><span class="center1"><?=stripslashes($banner1_3['content'])?></span></div>
            <div class="index_4box_4"><span class="in_btn" style="margin-top:5px; letter-spacing:1px;"><a href="<?=$banner1_3['url_to']?>" target="new">STAY CONNECTED</a></span></div>
        </div>
    </div>

    <div class="index_3box">
    	<div class="in_3box_all">
        	<div class="in_3box_1"><span class="in_title5"><?=stripslashes($banner2_1['title'])?></span></div>
        	<div class="in_3box_2"><div style="width:287px; height:203px; overflow:hidden;"><img src="banner/<?=$banner2_1['file1']?>" width="288" /></div></div>
            <div class="in_3box_2"><span class="center1"><?=stripslashes($banner2_1['content'])?></span></div>
            <div class="in_3box_2"><span class="in_btn2"><a href="<?=$banner2_1['url_to']?>" target="new">Read More</a></span></div>
        </div>
        <div class="in_3box_all">
        	<div class="in_3box_1"><span class="in_title5"><?=stripslashes($banner2_2['title'])?></span></div>
            <div class="in_3box_2"><div style="width:287px; height:203px; overflow:hidden;"><img src="banner/<?=$banner2_2['file1']?>" width="288"/></div></div>
            <div class="in_3box_2"><span class="center1"><?=stripslashes($banner2_2['content'])?></span>
            </div>
            <div class="in_3box_2"><span class="in_btn2"><a href="<?=$banner2_2['url_to']?>" target="new">Read More</a></span></div>
        </div>
        <div class="in_3box_all">
        	<div class="in_3box_1"><span class="in_title5">&nbsp;<a href="http://www.facebook.com/pages/Adopt-a-Doggie/312107112299799" target="new">ADOPT A DOGGIE FACEBOOK</a></span></div>
            <!--<div class="in_3box_2"><iframe src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2FFacebookDevelopers&amp;width=288&amp;height=250&amp;colorscheme=light&amp;show_faces=true&amp;header=false&amp;stream=false&amp;show_border=false" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:288px; height:250px;" allowtransparency="false"></iframe></div>-->
            <div id="fb-root"></div>
			<script>(function(d, s, id) {
              var js, fjs = d.getElementsByTagName(s)[0];
              if (d.getElementById(id)) return;
              js = d.createElement(s); js.id = id;
              js.src = "//connect.facebook.net/zh_TW/sdk.js#xfbml=1&appId=1527921104111815&version=v2.0";
              fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));</script>
            <div class="fb-like-box" data-href="https://www.facebook.com/pages/Adopt-a-Doggie/312107112299799" data-colorscheme="light" data-show-faces="true" data-header="false" data-stream="false" data-show-border="false"></div>
        </div>
    </div>

</div>
</div>
</div>

</body>

</html>
<?php include("include_bottom.php"); ?>
