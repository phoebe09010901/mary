<?php
header("content-type:text/html;charset=utf-8");
require_once("set.php");
require_once(Root_Includes_Path.'function_page.php');
require_once(Root_Includes_Path.'class_jqx.php');

$main_str   = 'dogs_agreement';
$table_name = Proj_Name.'_'.$main_str;	
$obj_image  = new files();	
$obj_jqx    = new jqx();	

$page_num = 50; //設定每頁顯示數目
$page_go  = (!$_GET['page_go'])?1:format_data($_GET['page_go'], 'int');
$search_row = format_data($_GET['search_row'], 'text');
$keywords   = format_data($_GET['keywords'], 'text');
$search_type= (!$_GET['search_type'])?'state0':format_data($_GET['search_type'], 'text');
$dog_id     = format_data($_GET['dog_id'], 'int');
$my_query_string = "&search_row=".$search_row."&keywords=".$keywords."&dog_id=".$dog_id;
$array_search    = array('Fullkey'=>'Agreement ID', 'name'=>'Dog\'s Name', 'rescuer'=>'Rescuer', 'text5'=>'Adopter', 'ans7'=>'E-mail');

if($_GET['action']=='delete') {
	$Fullkey  = format_data($_GET['Fullkey'], 'int');
	
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
			$query = "delete from ".$table_name." where Fullkey='$value'";
			$obj_dogs->run_mysql($query);
		}
	}
	js_a_l('刪除成功', 'back');exit;
}elseif($_GET['action']=='change_data') {	//批次修改狀態
	$ids = explode(",", $_GET['ids']);
	if(count($ids)>0) {
		foreach($ids as $value)	{
			$value = format_data($value, 'int');
			$row_name = format_data($_GET['row_name'], 'text');
			$row_value = format_data($_GET['row_value'], 'text');
			$query = "update $table_name set ".$row_name."='".$row_value."' where Fullkey='$value'";
			$obj_dogs->run_mysql($query);
		}
	}
	js_a_l('修改完成', 'back');exit;
}

//data list
if($dog_id) {
	$where_str .= "and d.Fullkey='".$dog_id."'";	
}
if($search_row && $search_row!='name' && $search_row!='rescuer') {
	$where_str = "and da.".$search_row." like '%".$keywords."%'";	
}elseif($search_row=='name' || $search_row=='rescuer') {
	$where_str = "and d.".$search_row." like '%".$keywords."%'";	
}
if($search_type=='state0') {
	$where_str .= " and da.state=0";	
}elseif($search_type=='state1') {
	$where_str .= " and da.state=1";	
}
$query = "select d.name, d.rescuer, da.Fullkey, da.text1, da.text2, da.text3, da.text4, da.text5, da.ans7, da.remark, da.state, da.adopted, da.output, da.create_time from $table_name_dogs d, $table_name da where d.Fullkey=da.dog_id $where_str order by da.create_time desc";	
$obj_dogs->count_page($query, $page_go, $page_num);
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
	//if(e.keyCode==13) {
		var ajaxurl = '<?=$main_str?>_data.php?action=update_remark&data_id='+data_id+'&update_row='+update_row+'&update_text='+encodeURIComponent($("#remark_"+data_id).val());
		$.ajax({
			url: ajaxurl,
			dataType: 'html',
			success: function(request) {
				location.reload();
			}
		});
	//}
}
$(document).ready(function () {
	var theme = '<?=jqxStyle?>';
	<?php $obj_jqx->datepicker('list_date', date("Y-m-d")); ?>
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
		  <input type="button" class="batchButton2" value="批次刪除" onClick="$('#action').val('del_all');$('#list_form').submit();">
          <!--<input type="button" value="Output to Excel" onClick="location.href='<?=$main_str?>_excel.php?dog_id=<?=$dog_id?>'">-->
        </div>
   		<div class="template_black">
        <form method="post" action="<?=$_SERVER['PHP_SELF']?>" name="list_form" id="list_form">
        <input type="hidden" name="action" id="action" value="">
          <table width="100%"  cellspacing="0" cellpadding="0" border="0">
              <tr>
                <th align="center" style="width:32px"><input type="checkbox" name="SelectAll" id="SelectAll" value="1" onclick="real_select_all(this.checked)" /></th>
                <th align="center" style="width:62px">&nbsp;</th>
                <th align="center" bgcolor="#e6e7e3" style="width:35px">&nbsp;</th>
                <th align="center" bgcolor="#e6e7e3" style="width:35px">Process</th>
                <th align="center" bgcolor="#e6e7e3" style="width:35px">Adopted</th>
                <!--<th align="center" bgcolor="#e6e7e3" style="width:35px">Airport</th>-->
                <th align="center" style="width:62px">Agreement ID</th>
                <th align="center" bgcolor="#e6e7e3">Dog's Name</th>
                <th align="center" bgcolor="#e6e7e3">Rescuer</th>
                <th align="center" bgcolor="#e6e7e3">Agreement Date</th>
                <th align="center" bgcolor="#e6e7e3">Adopted</th>
                <th align="center" bgcolor="#e6e7e3">Comments</th>
                <th align="center" bgcolor="#e6e7e3" style="width:100px">Data Set-up Time</th>
              </tr>
              <?php
              for ($i=0; $i<$page_num; $i++){
                $dogs = mysql_fetch_array($obj_dogs->result);
                if ($dogs) {
					$dogs['create_time'] = explode(" ", $dogs['create_time']);
					$dogs['create_time'] = $dogs['create_time'][0].'<br><span class="txtgray">'.$dogs['create_time'][1].'</span>';
                ?>
              <tr>
			    <td align="center"><input type="checkbox" name="IDlist[]" value="<?=$dogs['Fullkey']?>"></td>
                <td align="center" valign="middle"><button type="button" class="editbtn edit_w25" title="刪除" onClick="real_del(<?=$dogs['Fullkey']?>, '<?=$dogs['name']?>')">s</button></td>
                <td align="center"><a href="dogs_agreement_preview.php?agreement_id=<?=$dogs['Fullkey']?>" target="_blank">Preview</a></td>
                <td align="center"><input type="checkbox" name="data_state" id="data_state<?=$i?>" value="1" <?php if($dogs['state']==1){echo 'checked';} ?> onClick="change_power(<?=$dogs['Fullkey']?>, 'state', this.checked)" /></td>
                <td align="center"><input type="checkbox" name="data_adopted" id="data_adopted<?=$i?>" value="1" <?php if($dogs['adopted']==1){echo 'checked';} ?> onClick="change_power(<?=$dogs['Fullkey']?>, 'adopted', this.checked)" /></td>
                <!--<td align="center"><input type="checkbox" name="data_output" id="data_output<?=$i?>" value="1" <?php if($dogs['output']==1){echo 'checked';} ?> onClick="change_power(<?=$dogs['Fullkey']?>, 'output', this.checked)" /></td>-->
                <td align="center"><?=$dogs['Fullkey']?></td>
                <td align="center"><?=$dogs['name']?></td>
                <td align="center"><?=$dogs['rescuer']?></td>
                <td align="center"><?=$dogs['text1'].'-'.$dogs['text2'].'-'.$dogs['text3']?></td>
                <td align="center"><?=$dogs['text5'].'<br>'.$dogs['ans7']?></td>
                <td align="center"><textarea name="remark_<?=$dogs['Fullkey']?>" id="remark_<?=$dogs['Fullkey']?>" onChange="javascript:keydown_text('<?=$dogs['Fullkey']?>', 'remark')"><?=$dogs['remark']?></textarea></td>
                <td align="center"><?=$dogs['create_time']?></td>
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