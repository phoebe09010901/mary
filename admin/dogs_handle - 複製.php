<?php
header("content-type:text/html;charset=utf-8");
require_once('set.php');
require_once(Root_Includes_Path.'class_category.php');

$main_str   = 'dogs';
$table_name = Proj_Name.'_'.$main_str;	
$obj_image  = new files();		
$sdogss     = new show_data_select();	

$category = format_data($_REQUEST['category'], 'int');
$file_num = 3;
$_width  = 335;
$_height = 377;
$_width_s  = 335*0.5;
$_height_s = 377*0.5;

if($_POST['action']=='save') {
	$search_type = format_data($_POST['search_type'], 'text');
	$lang     = $_SESSION[Login_System_User]['lang'];
	$Fullkey  = format_data($_POST['Fullkey'], 'int');
	$category = format_data($_POST['category'], 'int');
	$name     = format_data($_POST['name'], 'text');
	$file1    = format_data($_POST['file1'], 'text');
	$file2    = format_data($_POST['file2'], 'text');
	$file3    = format_data($_POST['file3'], 'text');
	$youtube1 = format_data($_POST['youtube1'], 'text');
	$youtube2 = format_data($_POST['youtube2'], 'text');
	$youtube3 = format_data($_POST['youtube3'], 'text');
	$youtube4 = format_data($_POST['youtube4'], 'text');
	$youtube5 = format_data($_POST['youtube5'], 'text');
	$youtube6 = format_data($_POST['youtube6'], 'text');
	$youtube7 = format_data($_POST['youtube7'], 'text');
	$youtube8 = format_data($_POST['youtube8'], 'text');
    
	$youSeq1 = format_data($_POST['youSeq1'], 'int');
	$youSeq2 = format_data($_POST['youSeq2'], 'int');
	$youSeq3 = format_data($_POST['youSeq3'], 'int');
	$youSeq4 = format_data($_POST['youSeq4'], 'int');
	$youSeq5 = format_data($_POST['youSeq5'], 'int');
	$youSeq6 = format_data($_POST['youSeq6'], 'int');
	$youSeq7 = format_data($_POST['youSeq7'], 'int');
	$youSeq8 = format_data($_POST['youSeq8'], 'int');
    
	$sex      = format_data($_POST['sex'], 'text');
	$breed    = format_data($_POST['breed'], 'text');
	$color    = format_data($_POST['color'], 'text');
	$neuter   = format_data($_POST['neuter'], 'text');
	$microchip= format_data($_POST['microchip'], 'text');
	$rescuer  = format_data($_POST['rescuer'], 'text');
	$years    = format_data($_POST['years'], 'int');
	$month    = format_data($_POST['month'], 'int');
	$weight   = format_data($_POST['weight'], 'int');
	$content  = format_data($_POST['content'], 'content');
	$content2 = format_data($_POST['content2'], 'content');
	$remark   = format_data($_POST['remark'], 'text');
	$handler  = format_data($_POST['handler'], 'text');
	$sort     = format_data($_POST['sort'], 'int');
	$verify   = format_data($_POST['verify'], 'int');
	$adopter  = format_data($_POST['adopter'], 'text');
	//agreement
	$adopted     = format_data($_POST['adopted'], 'text');
	$adopte_info = format_data($_POST['adopte_info'], 'text');
	
	if(!$Fullkey)
		$query = "insert into ".$table_name."(lang, category, file1, file2, file3, youtube1, youtube2, youtube3, youtube4, youtube5, youtube6, youtube7, youtube8, name, sex, breed, color, neuter, microchip, rescuer, years, month, weight, content, content2, remark, handler, sort, verify, adopter, pub, hit_counts, create_time, edit_time) values('".$lang."', '".$category."', '".$file1."', '".$file2."', '".$file3."', '".$youtube1."', '".$youtube2."', '".$youtube3."', '".$youtube4."', '".$youtube5."', '".$youtube6."', '".$youtube7."', '".$youtube8."', '".$name."', '".$sex."', '".$breed."', '".$color."', '".$neuter."', '".$microchip."', '".$rescuer."', '".$years."', '".$month."', '".$weight."', '".$content."', '".$content2."', '".$remark."', '".$handler."', '".$sort."', '".$verify."', '".$adopter."', 1, 0, now(), now())";
	elseif($Fullkey)
		$query = "update ".$table_name." set category='".$category."', file1='".$file1."', file2='".$file2."', file3='".$file3."', youtube1='".$youtube1."', youtube2='".$youtube2."', youtube3='".$youtube3."', youtube4='".$youtube4."', youtube5='".$youtube5."', youtube6='".$youtube6."', youtube7='".$youtube7."', youtube8='".$youtube8."', name='".$name."', sex='".$sex."', breed='".$breed."', color='".$color."', neuter='".$neuter."', microchip='".$microchip."', rescuer='".$rescuer."', years='".$years."', month='".$month."', weight='".$weight."', content='".$content."', content2='".$content2."', handler='".$handler."', sort='".$sort."', verify='".$verify."', adopter='".$adopter."', edit_time=now() where Fullkey='".$Fullkey."'";
	$obj_dogs->run_mysql($query);
	
	if(!$Fullkey) {
		$dog_id = mysql_insert_id();
		$query = "insert into ".$table_name."_form1(dog_id, create_time, edit_time) values('$dog_id', now(), now())";
		$obj_dogs->run_mysql($query);
		$query = "insert into ".$table_name."_form2(dog_id, create_time, edit_time) values('$dog_id', now(), now())";
		$obj_dogs->run_mysql($query);
        $Fullkey = $dog_id;
	}
	
	if($obj_dogs->result) {
		js_a_l("儲存成功", $main_str."_handle.php?Fullkey=".$Fullkey);exit;
	}else {
		js_a_l("儲存失敗，請重新輸入並檢查", "back");exit;
	}
}elseif ($_GET['Fullkey']) {
	$Fullkey = format_data($_GET['Fullkey'], 'int');
	$query   = "select * from ".$table_name." where Fullkey='".$Fullkey."'";
	$dogs    = $obj_dogs->run_mysql_out($query);
	
	$query = "select * from ".$table_name_dogs."_agreement where dog_id='".$dogs['Fullkey']."' and adopted=1";
	$agree = $obj_dogs->run_mysql_out($query);
}elseif (!$_GET['Fullkey']) {
	$dogs['content'] = '<table align="center" border="0" cellpadding="0" cellspacing="0"
height="191" width="95%">
<tbody>
<tr>
<td class="pro_main_s">
<div style="margin-bottom: 10px;">
Please read our <a class="b1_2" href="about.php#Adoption
%20Process">Adoption Process</a><br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a class="b1_2" href="http://
adoptadoggie.org/policies.pdf" target="_blank">Adoption
Policies</a><br />
The adoption donation is US$399 (inclusive of one complimentary group training session valued at $90).
&nbsp; All&nbsp;doggies are spayed &amp; neutered, up
to date&nbsp;with their vaccinations, microchip&nbsp;and
dewormed.
</div>
</td>
</tr>
<tr>
<td bgcolor="#ffffff" height="1"><img alt="" src="/
userfiles/marydog/admin/images/white.png" style="width: 1px;
height: 1px;" /></td>
</tr>
<tr>
<td class="pro_main_g" height="70" valign="top">
<div style="margin-top: 10px;">
If you are interested in giving&nbsp;Jay a forever home,<br /
>
1. Please click&nbsp;&#39;APPLY&#39; button and fill
out an application.<br />
2. Once your application is approved,
please&nbsp;send us&nbsp;the&nbsp;<span style="line-height:
20.79px;">&#39;Agreement&#39;.</span>
</div>
</td>
</tr>
</tbody>
</table>';	
	$dogs['content2'] = '<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody>
<tr>
<td bgcolor="#999999" height="1"><img alt="" src="/
userfiles/marydog/admin/images/white.png" style="width: 1px;
height: 1px;" /></td>
</tr>
<tr>
<td align="left" class="pro_main_g4"><br />
Notes:<br />
&nbsp;</td>
</tr>
<tr>
<td bgcolor="#999999" height="1"><img alt="" src="/
userfiles/marydog/admin/images/white.png" style="width: 1px;
height: 1px;" /></td>
</tr>
<tr>
<td align="left" class="pro_main_g2"><br />
Notes:<br />
&nbsp;</td>
</tr>
<tr>
<td bgcolor="#999999" height="1"><img alt="" src="/
userfiles/marydog/admin/images/white.png" style="width: 1px;
height: 1px;" /></td>
</tr>
<tr>
<td>
<p>Notes:</p>
<p class="re_main">&nbsp;</p>
</td>
</tr>
</tbody>
</table>';
}
?><!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title><?=Html_Title?>後台管理系統</title>
<?php include("include_head.php"); ?>
<script src="../ckeditor/ckeditor.js"></script>
<script src="../ckeditor/adapters/jquery.js"></script>
<script type="text/javascript" src="../jqwidgets/jqxvalidator.js"></script> 
<!-- uploadify -->
<script type="text/javascript" src="../uploadify/jquery.uploadify-3.1.min.js"></script>
<link rel="stylesheet" type="text/css" href="../uploadify/uploadify.css" />
<script type="text/javascript">
$(document).ready(function () {
	$( '#content' ).ckeditor();
	$( '#content2' ).ckeditor();
	//upload file
	<?php 
	for($i=1; $i<=$file_num; $i++) { 
		$obj_image->uploadify_js('file'.$i.'_upload', 'file'.$i, 'show_file'.$i, array("action", "main_str", "category", "Fullkey", "file_o", "key", "_width_s", "_height_s"), array("upload_dogs", $main_str, $category, $dogs["Fullkey"], "", $i, $_width, $_height));
	} 
	?>
	var theme = '<?=jqxStyle?>';
	
	$('#sendButton').bind('click', function () {
		$('#<?=$main_str?>_form').jqxValidator('validate');
		
	});
	$('#<?=$main_str?>_form').bind('validationSuccess', function (event) { 
		$('#<?=$main_str?>_form').submit();
	});
	$('.text-input').addClass('jqx-input');
	$('.text-input').addClass('jqx-rc-all');
	if (theme.length > 0) {
		$('.text-input').addClass('jqx-input-' + theme);
		$('.text-input').addClass('jqx-widget-content-' + theme);
		$('.text-input').addClass('jqx-rc-all-' + theme);
	}
	// initialize validator.
	$('#<?=$main_str?>_form').jqxValidator({
		rules: [
		{ input: '#name', message: '請輸入狗狗姓名', action: 'keyup, blur', rule: 'required' },
		{ input: '#file1', message: '請選擇圖片', action: 'keyup, blur', rule: 'required' }], 
		theme: theme
	});
});
</script>
</head>
<body>
<?php include("include_top.php"); ?>
<div class="admin-panel">
  <?php include("include_menu.php"); ?><!--slidebar end-->
   <div class="main set_page_h page_shadow">
   <ul class="topbar">
      <a href="index.php"><li class="left">首頁</li></a><?=$cate_title?>
      <a href="dogs.php"><li class="left"><?=$page_title?></li></a>
      <li class="title"><?=($dogs['name'])?$dogs['name']:'Add a dog'?></li>
      <li class="right"><?php include('include_welcome.php'); ?></li>
   </ul>
   <div class="mainContent">
   	 <div id="data_content">
        <div class="template_black">
   		<form method="post" id="<?=$main_str?>_form" action="<?=$_SERVER['PHP_SELF']?>">
            <input type="hidden" name="action" value="save" />
            <input type="hidden" name="Fullkey" value="<?=$dogs['Fullkey']?>" />
            <input type="hidden" name="category" value="1" />
            <input type="hidden" name="search_type" value="<?=$_GET['search_type']?>" />
            <table class="<?=$main_str?>-table">
              <tbody>                                
                <tr>
                    <td colspan="4" height="30" style="background-color: #FF9900; color: white;">照片管理</td>
                </tr>
            	<?php for($i=1; $i<=$file_num; $i++) { ?>
                <?php if($i%2==1){echo '<tr>';} ?>
                    <td height="60">上傳圖片<?=$i?>：</td>
                    <td align="left"><?php $obj_image->show_pic2($main_str.'/'.$dogs['file'.$i], $_width_s, $_height_s, $dogs['name'], 'show_file'.$i) ?> <input type="button" class="delButton" value="刪除檔案" onClick="$('#show_file<?=$i?>').attr('src', '../images/space.png');$('#file<?=$i?>').val('')" /><br /><input type="text" name="file<?=$i?>" id="file<?=$i?>" value="<?=$dogs['file'.$i]?>" class="frome" style="width:200px" readonly /><br /><input type="file" name="file<?=$i?>_upload" id="file<?=$i?>_upload" />(建議圖片尺寸: <?=$_width.'*'.$_height?>，檔案大小3mb)</td>
                <?php if($i%2==0){echo '</tr>';} ?>
                <?php } ?>
                <tr>
                    <td colspan="4" height="30" style="background-color: #FF9900; color: white;">Youtube管理</td>
                </tr>
                <tr>
                    <td width="120" height="60">Youtube1：</td>
                    <td align="left"><input type="text" name="youtube1" id="youtube1" value="<?=$dogs['youtube1']?>" class="frome" style="width:250px" /></td>
                    <td height="60">Youtube2：</td>
                    <td align="left"><input type="text" name="youtube2" id="youtube2" value="<?=$dogs['youtube2']?>" class="frome" style="width:250px" /></td>
                </tr>
                <tr>
                    <td width="120" height="60">Youtube3：</td>
                    <td align="left"><input type="text" name="youtube3" id="youtube3" value="<?=$dogs['youtube3']?>" class="frome" style="width:250px" /></td>
                    <td height="60">Youtube4：</td>
                    <td align="left"><input type="text" name="youtube4" id="youtube4" value="<?=$dogs['youtube4']?>" class="frome" style="width:250px" /></td>
                </tr>
                <tr>
                    <td width="120" height="60">Youtube5：</td>
                    <td align="left"><input type="text" name="youtube5" id="youtube5" value="<?=$dogs['youtube5']?>" class="frome" style="width:250px" /></td>
                    <td height="60">Youtube6：</td>
                    <td align="left"><input type="text" name="youtube6" id="youtube6" value="<?=$dogs['youtube6']?>" class="frome" style="width:250px" /></td>
                </tr>
                <tr>
                    <td width="120" height="60">Youtube7：</td>
                    <td align="left"><input type="text" name="youtube7" id="youtube7" value="<?=$dogs['youtube7']?>" class="frome" style="width:250px" /></td>
                    <td height="60">Youtube8：</td>
                    <td align="left"><input type="text" name="youtube8" id="youtube8" value="<?=$dogs['youtube8']?>" class="frome" style="width:250px" /></td>
                </tr>
                <tr>
                    <td colspan="4" height="30" style="background-color: #FF9900; color: white;">Dog's Information</td>
                </tr>
                <tr>
                    <td width="120" height="60">Name：</td>
                    <td align="left"><input type="text" name="name" id="name" value="<?=$dogs['name']?>" class="frome" style="width:250px" /></td>
                    <td height="60">排　　序：</td>
                    <td align="left"><input type="text" name="sort" id="sort" value="<?=($dogs['sort'])?$dogs['sort']:0?>" class="frome" style="width:250px" /> (數字越大排序越前面)</td>
                </tr>
                <tr>
                    <td width="120" height="60">SEX：</td>
                    <td align="left"><input type="radio" name="sex" id="sex1" value="Male" <?php if($dogs['sex']=='Male'){echo 'checked';} ?>>Male　<input type="radio" name="sex" id="sex2" value="Female" <?php if($dogs['sex']=='Female'||!$dogs['sex']){echo 'checked';} ?>>Female</td>
                    <td width="120" height="60">BREED：</td>
                    <td align="left"><input type="text" name="breed" id="breed" value="<?=$dogs['breed']?>" class="frome" style="width:250px" /></td>
                </tr>
                <tr>
                    <td width="120" height="60">COLOR：</td>
                    <td align="left"><input type="text" name="color" id="color" value="<?=$dogs['color']?>" class="frome" style="width:250px" /></td>
                    <td width="120" height="60">SPAY OR NEUTER：</td>
                    <td align="left"><input type="radio" name="neuter" id="neuter1" value="1" <?php if($dogs['neuter']==1){echo 'checked';} ?>>Neutered　<input type="radio" name="neuter" id="neuter2" value="2" <?php if($dogs['neuter']=='2'||!$dogs['neuter']){echo 'checked';} ?>>Spayed</td>
                </tr>
                <tr>
                    <td width="120" height="60">AGE：</td>
                    <td align="left"><input type="text" name="years" id="years" value="<?=$dogs['years']?>" style="width:70px" /> years(s)　<input type="text" name="month" id="month" value="<?=$dogs['month']?>" style="width:70px" /> month(s)</td>
                    <td height="60">WEIGHT：</td>
                    <td align="left"><input type="text" name="weight" id="weight" value="<?=$dogs['weight']?>" style="width:70px" /> lbs</td>
                </tr>
                <tr>
                    <td height="60">MICROCHIP #：</td>
                    <td align="left"><input type="text" name="microchip" id="microchip" value="<?=($dogs['microchip'])?$dogs['microchip']:0?>" class="frome" style="width:250px" /></td>
                    <td height="60">RESCUER：</td>
                    <td align="left"><input type="text" name="rescuer" id="rescuer" value="<?=$dogs['rescuer']?>" class="frome" style="width:250px" /></td>
                </tr>
                <tr>
                    <td height="60">Handler：</td>
                    <td align="left"><input type="text" name="handler" id="handler" value="<?=$dogs['handler']?>" class="frome" style="width:250px" /></td>
                    <td height="60">&nbsp;</td>
                    <td align="left">&nbsp;</td>
                </tr>
                <tr>
                    <td height="60">Adopte Info：</td>
                    <td align="left" colspan="4"><input type="checkbox" name="adopted" id="adopted" value="1" <?php if($agree['adopted']==1){echo 'checked';} ?> disabled>Adopted　<input type="text" name="adopter" id="adopter" value="<?=($dogs['adopter'])?$dogs['adopter']:$_SESSION[Login_System_User]['id']?>" class="frome" style="width:250px"> <a href="dogs_agreement_preview.php?agreement_id=<?=$agree['Fullkey']?>" target="_blank">Agreement Link</a><br /><textarea name="adopte_info" id="adopte_info" class="frome" style="width:100%; height:75px" readonly><?=$agree['adopte_info']?></textarea></td>
                </tr>
                <tr>
                    <td height="60">說明文一：</td>
                    <td align="left" colspan="4"><textarea id="content" name="content" rows="10"><?=stripslashes($dogs['content'])?></textarea></td>
                </tr>
                <tr>
                    <td height="60">說明文二：</td>
                    <td align="left" colspan="4"><textarea id="content2" name="content2" rows="10"><?=stripslashes($dogs['content2'])?></textarea></td>
                </tr>
                <tr>
                    <td colspan="4" style="text-align: center;"><button type="button" id="sendButton" class="editbtn enter" title="儲存" >儲 存</button>
                    <?php if($dogs['Fullkey']){ ?>
                    <button type="button" class="editbtn enter" title="表單1" onclick="location.href='dogs_form1.php?dog_id=<?=$dogs['Fullkey']?>'" >表單1</button>
                    <button type="button" class="editbtn enter" title="表單2" onclick="location.href='dogs_form2.php?dog_id=<?=$dogs['Fullkey']?>'" >表單2</button>
                    <?php } ?></td>
                </tr>
              </tbody>
            </table>
            </form>
        </div>
     </div><!--content end-->
   </div><!--mainContent end-->
   <?php include("include_footer.php"); ?>
  </div><!--main end-->
</div><!--admin-panel end-->
</body>
</html>