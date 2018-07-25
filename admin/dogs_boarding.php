<?php
header("content-type:text/html;charset=utf-8");
require_once("set.php");
require_once(Root_Includes_Path.'function_page.php');
require_once(Root_Includes_Path.'class_jqx.php');

$main_str   = 'dogs';
$table_name = Proj_Name.'_'.$main_str;	
$obj_agree  = new mysql_page();	
$obj_image  = new files();		
$obj_jqx    = new jqx();

$page_num = 50; //設定每頁顯示數目
$page_go  = (!$_GET['page_go'])?1:format_data($_GET['page_go'], 'int');
$category   = 1;
$search_row = format_data($_GET['search_row'], 'text');
$keywords   = format_data($_GET['keywords'], 'text');
$search_type= (!$_GET['search_type'])?'boarding0':format_data($_GET['search_type'], 'text');
$my_query_string = "&search_row=".$search_row."&keywords=".$keywords."&search_type=".$search_type."&search_type2=".$search_type2."&category=".$category;
$array_search    = array('name'=>'Dog\'s Name');
$_width_s  = 100;
$_height_s = 100;

if($_GET['action']=='delete') {
	$Fullkey  = format_data($_GET['Fullkey'], 'int');
	//刪除圖片
	$query = "select file1 from $table_name where Fullkey='".$Fullkey."'";
	$dogs  = $obj_dogs->run_mysql_out($query);
	if($dogs['file1']) {
		$obj_image->del_file('../'.$main_str.'/'.$dogs['file1']);
	}
	$query  = "delete from $table_name where Fullkey='".$Fullkey."'";
	$obj_dogs->run_mysql($query);
	if($obj_dogs->result) {
		js_a_l("刪除成功", "back");exit;
	}else {
		js_a_l("刪除失敗，請重新再試一次", "back");exit;
	}
}elseif($_POST['action']=='del_all') {
	if(count($_POST['IDlist'])>0) {
		foreach($_POST['IDlist'] as $value)	{
			$value = format_data($value, 'int');
			$query = "delete from ".$table_name."1 where Fullkey='$value'";
			$obj_dogs->run_mysql($query);
		}
	}
	js_a_l('刪除成功', 'back');exit;
}elseif($_POST['action']=='boarding_all') {	//批次修改狀態
	$my_query_string = format_data($_POST['my_query_string'], 'text');
	if(count($_POST['IDlist'])>0) {
		foreach($_POST['IDlist'] as $value)	{
			$value = format_data($value, 'int');
			$query = "update ".$table_name." set boarding=1 where Fullkey='$value'";
			$obj_dogs->run_mysql($query);
		}
	}
	js_a_l('修改完成', 'dogs_boarding.php?1=1'.$my_query_string);exit;
}elseif($_POST['action']=='unboarding_all') {	//批次修改狀態
	$my_query_string = format_data($_POST['my_query_string'], 'text');
	if(count($_POST['IDlist'])>0) {
		foreach($_POST['IDlist'] as $value)	{
			$value = format_data($value, 'int');
			$query = "update ".$table_name." set boarding=0 where Fullkey='$value'";
			$obj_dogs->run_mysql($query);
		}
	}
	js_a_l('修改完成', 'dogs_boarding.php?1=1'.$my_query_string);exit;
}elseif($_POST['action']=='save_system') {
	$from_date = format_data($_POST['from_date'], 'text');
	$to_date   = format_data($_POST['to_date'], 'text');
	$query = "update $table_name_sys set from_date='$from_date', to_date='$to_date'";	
	$obj_system->run_mysql($query);
	js_a_l("儲存成功", "back");exit;
}

//data list
if($category)
	$where_str = "and category=".$category;
if($search_row) {
	$where_str .= " and ".$search_row." like '%".$keywords."%'";	
}
if($search_type=='boarding0') {
	$where_str .= " and boarding_state=0";	
}elseif($search_type=='boarding1') {
	$where_str .= " and boarding_state=1";	
}
$query = "select Fullkey, file1, name, sex, years, month, weight, handler, verify, output, boarding, boarding_state, adopter, remark, sort, pub, create_time, edit_time from $table_name where lang='".$_SESSION[Login_System_User]['lang']."' $where_str order by sort desc";	
$obj_dogs->count_page($query, $page_go, $page_num);
//form date
$query = "select from_date, to_date from $table_name_sys";
$system= $obj_system->run_mysql_out($query);
?><!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title><?=Html_Title?>後台管理系統</title>
<?php include("include_head.php"); ?>
<script type="text/javascript" src="../jqwidgets/jqxcalendar.js"></script> 
<script type="text/javascript" src="../jqwidgets/jqxdatetimeinput.js"></script>
<script type="text/javascript">
function keydown_text(data_id, update_row, e) {
	if(e.keyCode==13) {
		var ajaxurl = '<?=$main_str?>_data.php?action=update_remark&data_id='+data_id+'&update_row='+update_row+'&update_text='+encodeURIComponent($("#remark_"+data_id).val());
		$.ajax({
			url: ajaxurl,
			dataType: 'html',
			success: function(request) {
				location.reload();
			}
		});
	}
}
$(document).ready(function () {
	var theme = '<?=jqxStyle?>';
	<?php $obj_jqx->datepicker('from_date', $system['from_date']); ?>
	<?php $obj_jqx->datepicker('to_date', $system['to_date']); ?>
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
      <li class="title"><?=$page_title?></li>
      <li class="right"><?php include('include_welcome.php'); ?></li>
   </ul>
   <div class="mainContent">
   	 <div id="data_content">
        <div class="toolbar">
		  <?php include("include_search.php"); ?>
          <?php change_page_jyc_s($page_go, $obj_dogs->page_all, $page_num, $obj_dogs->obj_all, $my_query_string); ?>　　
		  <input type="button" class="batchButton2" value="Batch Boarding" onClick="$('#action').val('boarding_all');$('#list_form').submit();">　
		  <input type="button" class="batchButton2" value="Batch Unboarding" onClick="$('#action').val('unboarding_all');$('#list_form').submit();">
          <a href="<?=$main_str?>_boardingList_01.php" target="_blank"><input type="button" value="Boarding List"></a>
          <div style="clear:both;">
          </div>
        </div>
   		<div class="template_black">
        <form method="post" action="<?=$_SERVER['PHP_SELF']?>" name="list_form" id="list_form">
        <input type="hidden" name="action" id="action" value="">
        <input type="hidden" name="my_query_string" id="my_query_string" value="<?=$my_query_string?>">
          <table width="100%"  cellspacing="0" cellpadding="0" border="0">
              <tr>
                <th align="center" style="width:32px"><input type="checkbox" name="SelectAll" id="SelectAll" value="1" onclick="real_select_all(this.checked)" /></th>
                <th align="center" bgcolor="#e6e7e3" style="width:35px">Boarding</th>
                <th align="center" bgcolor="#e6e7e3" style="width:35px">Process</th>
                <th align="center" style="width:62px">&nbsp;</th>
                <th align="center" bgcolor="#e6e7e3" style="width:120px">Photo</th>
                <th align="center" bgcolor="#e6e7e3">Dog's Name</th>
                <!--<th align="center" bgcolor="#e6e7e3" style="width:35px">Check</th>-->
                <th align="center" bgcolor="#e6e7e3">Owner</th>
                <th align="center" bgcolor="#e6e7e3">Adopter</th>
                <th align="center" bgcolor="#e6e7e3" style="width:100px">Data Set-up Time</th>
                <th align="center" bgcolor="#e6e7e3" style="width:100px">Recently Update</th>
              </tr>
              <?php
              for ($i=0; $i<$page_num; $i++){
                $dogs = mysql_fetch_array($obj_dogs->result);
                if ($dogs) {
					$dogs['create_time'] = explode(" ", $dogs['create_time']);
					$dogs['create_time'] = $dogs['create_time'][0].'<br><span class="txtgray">'.$dogs['create_time'][1].'</span>';
					$dogs['edit_time']   = explode(" ", $dogs['edit_time']);
					$dogs['edit_time']   = $dogs['edit_time'][0].'<br><span class="txtgray">'.$dogs['edit_time'][1].'</span>';
					//apply
					$query = "select ans2 from ".$table_name."_agreement where dog_id='".$dogs['Fullkey']."' and adopted=1";
					$agree = $obj_agree->run_mysql_out($query);
                ?>
              <tr>
			    <td align="center"><input type="checkbox" name="IDlist[]" value="<?=$dogs['Fullkey']?>"></td>
				<td align="center"><input type="checkbox" name="data_boarding" id="data_boarding<?=$i?>" value="1" <?php if($dogs['boarding']==1){echo 'checked';} ?> onClick="change_power(<?=$dogs['Fullkey']?>, 'boarding', this.checked)" /></td>
                <td align="center"><input type="checkbox" name="data_boarding_state" id="data_boarding_state<?=$i?>" value="1" <?php if($dogs['boarding_state']==1){echo 'checked';} ?> onClick="change_power(<?=$dogs['Fullkey']?>, 'boarding_state', this.checked)" /></td>
                <td align="center" valign="middle"><button type="button" class="editbtn edit_w25" title="編輯" onClick="real_edit(<?=$dogs['Fullkey']?>)">r</button></td>
                <td align="center"><?php $obj_image->show_pic2($main_str.'/'.$dogs['file1'], $_width_s, $_height_s, $dogs['name'], 'show_file'.$i) ?></td>
                <td align="center"><?=$dogs['name']?></td>
                <!--<td align="center"><input type="checkbox" name="data_verify" id="data_verify<?=$i?>" value="1" <?php if($dogs['verify']==1){echo 'checked';} ?> onClick="change_power(<?=$dogs['Fullkey']?>, 'verify', this.checked)" /></td>-->
                <td align="center"><?=$agree['ans2']?></td>
                <td align="center"><?=$dogs['adopter']?></td>
                <td align="center"><?=$dogs['create_time']?></td>
                <td align="center"><?=$dogs['edit_time']?></td>
              </tr>
                <?php
                }
              }
              ?>
        </table>
        </form>
      </div>
    </div><!--content end-->
    <?php change_page_jyc($page_go, $obj_dogs->page_all, $page_num, $obj_dogs->obj_all, $my_query_string); ?>
   </div><!--mainContent end-->
  <?php include("include_footer.php"); ?>
  </div><!--main end-->
</div><!--admin-panel end-->
</body>
</html>