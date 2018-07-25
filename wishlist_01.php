<?php
header("content-type:text/html;charset=utf-8");
require_once('set.php');

$want_dog_id = format_data($_GET['want_dog_id'], 'int');
$tmp_list    = str_replace('|', ',', $_SESSION['wishlist']);
$tmp_list    = substr($tmp_list, 1, strlen($tmp_list)-2);

//list
if($want_dog_id) {
	$query = "select Fullkey, name from $table_name_dogs where Fullkey='".$want_dog_id."' and pub=1 order by name asc";
	$dog   = $obj_dogs->run_mysql_out($query);
}
if(strlen($tmp_list)>2){
	$query = "select * from $table_name_dogs where Fullkey in ($tmp_list) or Fullkey='".$want_dog_id."' and pub=1 order by name asc";
	$obj_dogs->run_mysql_list($query);
}
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

<title>Adopt a Doggie</title>

<script type="text/javascript" src="scripts/jquery-1.10.2.min.js"></script>
<script>
function input_dog_data(position, dog_id, dog_name) {
	check = 0;
	if(position=='first') {
		if($('#second_dog').val()==dog_id || $('#third_dog').val()==dog_id)
			check++;
	}else if(position=='second') {
		if($('#first_dog').val()==dog_id || $('#third_dog').val()==dog_id)
			check++;
	}else if(position=='third') {
		if($('#first_dog').val()==dog_id || $('#second_dog').val()==dog_id)
			check++;
	}
	if(check==0) {
		$('#'+position+'_dog').val(dog_id);
		$('#'+position+'_dog_name').val(dog_name);
	}else {
		alert("Please choice the other dog.");
	}
}
$(function(){
	$('#next_step_btn').click(function(){
		if($('#first_dog').val()) {
			first_dog  = $('#first_dog').val();
			second_dog = $('#second_dog').val();
			third_dog  = $('#third_dog').val();

			location.href = 'adoption_apply_01.php?dog_id1='+first_dog+'&dog_id2='+second_dog+'&dog_id3='+third_dog;
		}
	});
});
</script>

</head>

<body>

	<!----------- 內容 開始 ------------------>
  	<div class="adoption">

		<!-----------BANNER 開始 ------------------>
   		<div class="wistlist_title" style="width:100%;"><span class="ce_title1">Wish List !</span></div>
        <span class="re_main5">ADOPT A DOGGIE is a 501(c)(3) non-proﬁt organization.  Our mission is to help rescued dogs in need and ﬁnd them loving and forever homes in North America.  The information requested in this application is intended to ensure that every owner and home we approve for adoption is a suitable and safe environment for the dog and be a forever home.  Thank you for your interest in our doggies!</span><br /><br />

        <div style="margin-bottom:30px; height:410px;">
            <span class="re_main5">Name of Available Dog:</span>
            <span class="re_main4">(1st Choice)</span>
            <input class="text_line" type="text" name="first_dog_name" id="first_dog_name" value="<?=$dog["name"]?>" style="width:100%" readonly />
            <!-----------列表------------------>
            <div class="adoption_2" style="margin-top:5px;">
                <?php
				for($i=0; $i<$obj_dogs->obj_all; $i++) {
					$dogs = mysql_fetch_array($obj_dogs->result);
					if($dogs) {
						?>
                <div class="adoption_2_all">
                    <div class="adoption_2_1">
                        <a href="wistlist_01.php"><img id="show_file0" src="<?=$main_str_dogs.'/'.$dogs['file1']?>" width="190"  alt="<?=stripslashes($dogs['name'])?>" title="<?=stripslashes($dogs['name'])?>" border="0"></a>
                    </div>
                  	<div class="adoption_2_2">
                  		<span class="t2" style="color:<?=($dogs['sex']=='Male')?'#13A4A0':'#E84693'?>;"><?=stripslashes($dogs['name'])?></span><br />
                        <span class="center1"><?=stripslashes($dogs['breed'])?><br /> <?=($dogs['neuter']==1)?'Neutered':'Spayed'?> <?=stripslashes($dogs['sex'])?><br /> <?=($dogs['years']>0)?stripslashes($dogs['years']).' year(s)':''?><?=($dogs['month'])?' '.$dogs['month'].' month(s)':''?>, <?=$dogs['weight']?> lbs.</span><br />
                        <div class="adoption_2_3">
                            <span class="in_btn3"><a onclick="input_dog_data('first', <?=$dogs['Fullkey']?>, '<?=stripslashes($dogs['name'])?>')" style="cursor:pointer;">CHOICE</a></span>
                        </div>
                    </div>
                </div>
						<?php
					}
				}
				if($obj_dogs->obj_all>0)
					mysql_data_seek($obj_dogs->result, 0);
				?>
            </div>
        </div>

        <div style="clear: both"></div>

        <div style="margin-bottom:30px; height:410px;">
            <span class="re_main5">Name of Available Dog:</span>
            <span class="re_main4">(2st Choice)</span>
            <input class="text_line" type="text" name="second_dog_name" id="second_dog_name" value="" style="width:100%" readonly />
            <!-----------列表------------------>
            <div class="adoption_2" style="margin-top:5px;">
                <?php
				for($i=0; $i<$obj_dogs->obj_all; $i++) {
					$dogs = mysql_fetch_array($obj_dogs->result);
					if($dogs) {
						?>
                <div class="adoption_2_all">
                    <div class="adoption_2_1">
                        <a href="wistlist_01.php"><img id="show_file0" src="<?=$main_str_dogs.'/'.$dogs['file1']?>" width="190"  alt="<?=stripslashes($dogs['name'])?>" title="<?=stripslashes($dogs['name'])?>" border="0"></a>
                    </div>
                  	<div class="adoption_2_2">
                  		<span class="t2" style="color:<?=($dogs['sex']=='Male')?'#13A4A0':'#E84693'?>;"><?=stripslashes($dogs['name'])?></span><br />
                        <span class="center1"><?=stripslashes($dogs['breed'])?><br /> <?=($dogs['neuter']==1)?'Neutered':'Spayed'?> <?=stripslashes($dogs['sex'])?><br /> <?=($dogs['years']>0)?stripslashes($dogs['years']).' year(s)':''?><?=($dogs['month'])?' '.$dogs['month'].' month(s)':''?>, <?=$dogs['weight']?> lbs.</span><br />
                        <div class="adoption_2_3">
                            <span class="in_btn3"><a onclick="input_dog_data('second', <?=$dogs['Fullkey']?>, '<?=stripslashes($dogs['name'])?>')" style="cursor:pointer;">CHOICE</a></span>
                        </div>
                    </div>
                </div>
						<?php
					}
				}
				if($obj_dogs->obj_all>0)
					mysql_data_seek($obj_dogs->result, 0);
				?>
            </div>
        </div>

        <div style="clear: both"></div>

        <div style="margin-bottom:30px; height:410px;">
            <span class="re_main5">Name of Available Dog:</span>
            <span class="re_main4">(3st Choice)</span>
            <input class="text_line" type="text" name="third_dog_name" id="third_dog_name" value="" style="width:100%" readonly />
            <!-----------列表------------------>
            <div class="adoption_2" style="margin-top:5px;">
                <?php
				for($i=0; $i<$obj_dogs->obj_all; $i++) {
					$dogs = mysql_fetch_array($obj_dogs->result);
					if($dogs) {
						?>
                <div class="adoption_2_all">
                    <div class="adoption_2_1">
                        <a href="wistlist_01.php"><img id="show_file0" src="<?=$main_str_dogs.'/'.$dogs['file1']?>" width="190"  alt="<?=stripslashes($dogs['name'])?>" title="<?=stripslashes($dogs['name'])?>" border="0"></a>
                    </div>
                  	<div class="adoption_2_2">
                  		<span class="t2" style="color:<?=($dogs['sex']=='Male')?'#13A4A0':'#E84693'?>;"><?=stripslashes($dogs['name'])?></span><br />
                        <span class="center1"><?=stripslashes($dogs['breed'])?><br /> <?=($dogs['neuter']==1)?'Neutered':'Spayed'?> <?=stripslashes($dogs['sex'])?><br /> <?=($dogs['years']>0)?stripslashes($dogs['years']).' year(s)':''?><?=($dogs['month'])?' '.$dogs['month'].' month(s)':''?>, <?=$dogs['weight']?> lbs.</span><br />
                        <div class="adoption_2_3">
                            <span class="in_btn3"><a onclick="input_dog_data('third', <?=$dogs['Fullkey']?>, '<?=stripslashes($dogs['name'])?>')" style="cursor:pointer;">CHOICE</a></span>
                        </div>
                    </div>
                </div>
						<?php
					}
				}
				?>
            </div>
        </div>

        <div style="margin-bottom:30px; height:40px; padding: 0 0 0 410px;">
			<input type="hidden" name="first_dog" id="first_dog" value="<?=$dog["Fullkey"]?>">
			<input type="hidden" name="first_dog" id="second_dog" value="">
			<input type="hidden" name="first_dog" id="third_dog" value="">
        	<span class="re_main4_btn"><a style="cursor:pointer" href="#" id="next_step_btn">Next Step</a></span>
        </div>

	</div>
	<!----------- 內容 結束 ------------------>

<!-- 上方menu -->
<script src="js/minified.js?20140814"></script>

</body>
</html>
<?php include("include_bottom.php"); ?>
