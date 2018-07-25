<?php
header("content-type:text/html;charset=utf-8");
require_once("set.php");

$obj_image = new files();
$list_date = From_Date;
$list_date = explode("-", $list_date);
$list_date = date("F d, Y", mktime(0, 0, 0, $list_date[1], $list_date[2], $list_date[0]));

//list data
$query = "select Fullkey, name, file1 from ".$table_name_dogs." where output=1 and output_state=0 order by name asc";	
$obj_dogs->run_mysql_list($query);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<meta name="viewport" content="width=device-width, initial-scale=1">

<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<link href="../fonts.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="../css/all.css">
<link rel="stylesheet" href="../css/top_menu.css">

<title>Adopt a Doggie</title>



</head>

<body>

	<!----------- 內容 開始 ------------------> 
  	<div class="boardingList_adoption">
	
      	<?php
		for($i=0; $i<$obj_dogs->obj_all; $i++) {
			$dogs = mysql_fetch_array($obj_dogs->result);	
			
			if($i==0) {
				?>
		<!----------- 第一區塊 開始 ------------------> 
        <div style="border:#03C 0px solid; width:980px; height:658px;">
            <div style="width:933px; height:116px; border:#F90 1px solid; padding-left:40px;">
                <div style="float:left; height:116px;"><img src="../images/logo.svg" height="100%" /></div>
                <div style="float:right; width:800px;">
                	<div style="width:100%; text-align:center; margin-top:30px;"><span class="font-family_01 color_02 font-size_57"><?=$list_date?></span></div>
                </div>
            </div>
            <br /><br />
            
            <div style="margin-bottom:30px; height:410px;">
                <!----------- 列表 開始 ------------------>   
                <div class="adoption_2" style="margin-top:5px;">   
				<?php
			}elseif($i%10==5) {
				?>
        <!----------- 第二、三以後的區塊 開始 ------------------> 
        <div style="border:#03C 0px solid; width:980px; height:658px;">
            <div style="margin-bottom:30px; height:410px;">
                <!----------- 列表 開始 ------------------>   
                <div class="adoption_2" style="margin-top:5px;">  
				<?php
			}
			
			if($dogs) {
				$query = "select Fullkey, text1, text2, text3, text4, text5, ans2, ans5, ans6, ans7, ans8, ans9, ans10 from ".$table_name_dogs."_agreement where dog_id='".$dogs['Fullkey']."' and output=1 and adopted=1 order by Fullkey asc";	
				$obj_menu1->run_mysql_list($query);
				if($obj_menu1->obj_all==0)
					$obj_menu1->obj_all = 1;
				for($j=0; $j<$obj_menu1->obj_all; $j++) {
					$agree = mysql_fetch_array($obj_menu1->result);
			?>    
                    <div class="<?=($i%5==0)?'boardingList_adoption_2_all_first':'boardingList_adoption_2_all'?>">
                        <div class="airportList_adoption_2_1">
                            <a href="#"><img id="show_file<?=$i?>" src="<?='../'.$main_str_dogs.'/'.$dogs['file1']?>" width="190"  alt="<?=stripslashes($dogs['name'])?>" title="<?=stripslashes($dogs['name'])?>" border="0"></a>
                        </div> 
                        <div class="boardingList_adoption_2_2">
                            <span class="t3 line-height_25" style="color:#E84693;"><?=stripslashes($dogs['name'])?></span><br />
                            <span class="center1">Owner：<?=stripslashes($agree['ans2'])?><br />Cell：<?=stripslashes($agree['ans8'])?><br />Home：<?=stripslashes($agree['ans9'])?><br /><a href="mailto:<?=stripslashes($agree['ans7'])?>"><?=stripslashes($agree['ans7'])?></a></span>
                        </div>
                    </div>
            <?php	
				}
			}
			
			if($i==4 || ($i==$obj_dogs->obj_all-1 && $i<4)) {
				?>              
                </div>
                <!----------- 列表 結束 ------------------> 
            </div>
        </div>
        <!----------- 第一區塊 結束 ------------------>
				<?php
			}elseif(($i%10==4 && $i>4) || ($i==$obj_dogs->obj_all-1 && $i>4)) {
				?>         
                </div>
                <!----------- 列表 結束 ------------------> 
            </div>
        </div>
        <!----------- 第二、三以後的區塊 結束 ------------------> 
				<?php
			}
		}
		?>    
            
	</div>
	<!----------- 內容 結束 ------------------> 

<!-- 上方menu -->
<script src="../js/minified.js?20140814"></script>

</body>
</html>