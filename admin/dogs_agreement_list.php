<?php
header("content-type:text/html;charset=utf-8");
require_once('set.php');

$obj_image = new files();	
$_width_s  = 100;
$_height_s = 100;	
$list_date = From_Date;
$list_date = explode("-", $list_date);
$list_date = date("F d, Y", mktime(0, 0, 0, $list_date[1], $list_date[2], $list_date[0]));

//list data
$query = "select Fullkey, name, file1 from ".$table_name_dogs." where output=1 order by Fullkey desc";	
$obj_dogs->run_mysql_list($query);
?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Mary's Dog</title>
<style type="text/css">
*{
	font-family: "Arial Unicode MS";
	text-decoration: none;
	}
.adoption {
	width: 960px;
	background-color: #FFF;
	overflow: auto;
	margin-top: 0px;
	margin-right: auto;
	margin-bottom: 0px;
	margin-left: auto;
}
.adoption_title1 {
	width: 940px;
	font-size: 15px;
	color: #333;
	font-weight: bolder;
	margin: 10px;
	line-height: 35px;
}
.add_list{
	width: 460px;
	margin-right: 10px;
	margin-left: 10px;
	margin-bottom: 20px;
	}
.title_1{
	width: 460px;
	display: block;
	font-size: 15px;
	font-weight: bolder;
	color: #000;
	}	
.main_1{
	width: 460px;
	display: block;
	font-size: 14px;
	font-weight: lighter;
	color: #333;
	line-height: 25px;
	}	
.main_1 a{
	font-size: 14px;
	font-weight: lighter;
	color: #06C;
	}	
</style>
</head>

<body>
    <div class="adoption">
    
    <div class="adoption_title1"><img src="../images/1121_logo.jpg" width="383" ></div>
   	  <div class="adoption_title1"><?=$list_date?></div>
      	<?php
		for($i=0; $i<$obj_dogs->obj_all; $i++) {
			$dogs = mysql_fetch_array($obj_dogs->result);	
			if($dogs) {
				$query = "select Fullkey, text1, text2, text3, text4, text5, ans5, ans6, ans7, ans8, ans9, ans10 from ".$table_name_dogs."_agreement where dog_id='".$dogs['Fullkey']."' and output=1 order by Fullkey asc";	
				$obj_menu1->run_mysql_list($query);
				if($obj_menu1->obj_all==0)
					$obj_menu1->obj_all = 1;
				for($j=0; $j<$obj_menu1->obj_all; $j++) {
					$agree = mysql_fetch_array($obj_menu1->result);
			?>
        <div class="add_list">
        	<?php $obj_image->show_pic2($main_str_dogs.'/'.$dogs['file1'], $_width_s, $_height_s, $dogs['name'], 'show_file'.$i) ?>
            	<span class="title_1">Dog Name:  　<?=stripslashes($dogs['name'])?></span>
				<span class="main_1">Adopter:  　<?=stripslashes($agree['text5'])?></span>
                <span class="main_1">Cell:  　<?=stripslashes($agree['ans8'])?></span>
                <span class="main_1">Home:  　<?=stripslashes($agree['ans9'])?></span>
                <span class="main_1">Email: 　 <a href="mailto:<?=stripslashes($agree['ans7'])?>"><?=stripslashes($agree['ans7'])?></a></span>
                <span class="main_1">Address:  <?=stripslashes($agree['ans5']).', '.stripslashes($agree['ans6'])?></span>
        </div>    
            <?php	
				}
			}
		}
		?>
</div>
</body>
</html>
