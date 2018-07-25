<?php
header("content-type:text/html;charset=utf-8");
require_once('set.php');

$obj_image  = new files();
$_width_s  = 190;
$_height_s = "";
$page_id   = 7;

$query = "select * from ".$table_name_pages." where Fullkey='".$page_id."'";
$pages = $obj_pages->run_mysql_out($query);
//dogs list
$query = "select Fullkey, file1, name, sex, breed, neuter, years, month, weight from ".$table_name_dogs." where pub=1 order by sort desc, Fullkey desc";
$obj_dogs->run_mysql_list($query);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<meta name="viewport" content="width=device-width, initial-scale=1">

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
	background: url(images/a_bg.jpg) repeat-x top left #c2cb56;
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
  	<div class="adoption">
    
		<!-----------BANNER 開始 ------------------> 
   		<div class="adoption_1">
      		<?=stripslashes($pages['content'])?>
        </div>
        
        <!-----------列表------------------>   
    	<div class="adoption_2">  
            <?php
            for($i=0; $i<$obj_dogs->obj_all; $i++) {
                $dogs = mysql_fetch_array($obj_dogs->result);
                if($dogs) {
                    ?>  
        	<div class="adoption_2_all">
                <div class="adoption_2_1">
                	<a href="adoption_1.php?dog_id=<?=$dogs['Fullkey']?>"><?php $obj_image->show_pic2($main_str_dogs.'/'.$dogs['file1'], $_width_s, $_height_s, $dogs['name'], 'show_file'.$i) ?></a>
                </div> 
                <div class="adoption_2_2">
                	<span class="t2" style="color:<?=($dogs['sex']=='Male')?'#13A4A0':'#E84693'?>;"><?=stripslashes($dogs['name'])?></span><br />
                    <span class="center1"><?=stripslashes($dogs['breed'])?><br /> <?=($dogs['neuter']==1)?'Neutered':'Spayed'?> <?=stripslashes($dogs['sex'])?><br /><?=($dogs['years']>0)?stripslashes($dogs['years']).' year(s)':''?><?=($dogs['month'])?' '.$dogs['month'].' month(s)':''?>, <?=$dogs['weight']?> lbs.</span><br />
					<div class="adoption_2_3">
                    	<span class="in_btn3"><a href="adoption_1.php?dog_id=<?=$dogs['Fullkey']?>">PROFILE</a></span>
                    </div>
                </div>
            </div>
                    <?php
                }
            }
            ?>      
      	</div> 
        <div class="top" style="margin:40px 30px 40px 0;">
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

</body>
</html>