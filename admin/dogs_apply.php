<?php
header("content-type:text/html;charset=utf-8");
require_once("set.php");
require_once(Root_Includes_Path.'function_page.php');

$main_str   = 'dogs_apply';
$table_name = Proj_Name.'_'.$main_str;	
$obj_apply  = new mysql_page();		
$obj_image  = new files();		

$page_num = 50; //設定每頁顯示數目
$page_go  = (!$_GET['page_go'])?1:format_data($_GET['page_go'], 'int');
$search_row = format_data($_GET['search_row'], 'text');
$keywords   = format_data($_GET['keywords'], 'text');
$search_type= (!$_GET['search_type'])?'all':format_data($_GET['search_type'], 'text');
$dog_id     = format_data($_GET['dog_id'], 'int');
$my_query_string = "&search_row=".$search_row."&keywords=".$keywords."&dog_id=".$dog_id."&search_type=".$search_type;
$array_search    = array('name'=>'Dog\'s Name', 'rescuer'=>'Rescuer', 'ans1'=>'First Name', 'ans3'=>'Last Name', 'Fullkey'=>'Apply ID', 'ans4'=>'E-mail');
$_width_s  = 100;
$_height_s = 100;

if($_GET['action']=='delete') {
	$Fullkey  = format_data($_GET['Fullkey'], 'int');
	
	$query  = "delete from ".$table_name."1 where Fullkey='".$Fullkey."'";
	$obj_dogs->run_mysql($query);
	$query  = "delete from ".$table_name."2 where apply_id='".$Fullkey."'";
	$obj_dogs->run_mysql($query);
	$query  = "delete from ".$table_name."3 where apply_id='".$Fullkey."'";
	$obj_dogs->run_mysql($query);
	$query  = "delete from ".$table_name."4 where apply_id='".$Fullkey."'";
	$obj_dogs->run_mysql($query);
	$query  = "delete from ".$table_name."5 where apply_id='".$Fullkey."'";
	$obj_dogs->run_mysql($query);
	$query  = "delete from ".$table_name."6 where apply_id='".$Fullkey."'";
	$obj_dogs->run_mysql($query);
	$query  = "delete from ".$table_name."7 where apply_id='".$Fullkey."'";
	$obj_dogs->run_mysql($query);
	$query  = "delete from ".$table_name."8 where apply_id='".$Fullkey."'";
	$obj_dogs->run_mysql($query);
	$query  = "delete from ".$table_name."9 where apply_id='".$Fullkey."'";
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
			$query = "delete from ".$table_name."1 where Fullkey='".$value."'";
			$obj_dogs->run_mysql($query);
			$query = "delete from ".$table_name."2 where apply_id='".$value."'";
			$obj_dogs->run_mysql($query);
			$query = "delete from ".$table_name."3 where apply_id='".$value."'";
			$obj_dogs->run_mysql($query);
			$query = "delete from ".$table_name."4 where apply_id='".$value."'";
			$obj_dogs->run_mysql($query);
			$query = "delete from ".$table_name."5 where apply_id='".$value."'";
			$obj_dogs->run_mysql($query);
			$query = "delete from ".$table_name."6 where apply_id='".$value."'";
			$obj_dogs->run_mysql($query);
			$query = "delete from ".$table_name."7 where apply_id='".$value."'";
			$obj_dogs->run_mysql($query);
			$query = "delete from ".$table_name."8 where apply_id='".$value."'";
			$obj_dogs->run_mysql($query);
			$query = "delete from ".$table_name."9 where apply_id='".$value."'";
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
	$where_str .= "and da2.".$search_row." like '%".$keywords."%'";	
}elseif($search_row=='rescuer') {
	$where_str .= "and d.".$search_row." like '%".$keywords."%'";	
}elseif($search_row=='name') {
	$where_str .= "and (d.".$search_row." like '%".$keywords."%' or da1.ans16  like '%".$keywords."%')";	
}
if($search_type=='state0') {
	$where_str .= " and da1.state=0";	
}elseif($search_type=='state1') {
	$where_str .= " and da1.state=1";	
}
$query = "select d.name, d.file1, d.rescuer, da1.Fullkey, da1.dog_id4, da1.remark, da1.state, da1.output, da1.create_time, da2.ans1, da2.ans2, da2.ans3, da2.ans4, da2.ans5, da2.ans7, da2.ans8, da2.ans9, da2.ans11, da2.ans12, da2.ans13, da2.ans14, da2.ans15, da2.ans16, da2.ans17, da2.ans18, da2.ans19 from $table_name_dogs d, ".$table_name."1 da1, ".$table_name."2 da2 where d.Fullkey=da1.dog_id and da1.Fullkey=da2.apply_id $where_str order by da1.create_time desc";	
$obj_apply->count_page($query, $page_go, $page_num);
?><!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title><?=Html_Title?>後台管理系統</title>
<?php include("include_head.php"); ?>
<script type="text/javascript">
function keydown_text(data_id, update_row, e) {
	//if(e.keyCode==13) {
		var ajaxurl = '<?=$main_str?>_data.php?action=update_remark&data_id='+data_id+'&update_row='+update_row+'&update_text='+encodeURIComponent($("#remark_"+data_id).val());alert(ajaxurl);
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
          <!--<input type="button" value="Output to Excel" onClick="location.href='<?=$main_str?>_excel.php'">-->
		  <input type="button" class="batchButton2" value="批次刪除" onClick="$('#action').val('del_all');$('#list_form').submit();">
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
                <!--<th align="center" bgcolor="#e6e7e3" style="width:35px">Airport</th>-->
                <th align="center" style="width:62px">Apply ID</th>
                <th align="center" bgcolor="#e6e7e3" style="width:120px">Photo</th>
                <th align="center" bgcolor="#e6e7e3">Dog's Name</th>
                <th align="center" bgcolor="#e6e7e3">Rescuer</th>
                <th align="center" bgcolor="#e6e7e3">Name</th>
                <th align="center" bgcolor="#e6e7e3">Age</th>
                <th align="center" bgcolor="#e6e7e3">E-mail/Address</th>
                <th align="center" bgcolor="#e6e7e3">Phone Number</th>
                <th align="center" bgcolor="#e6e7e3">Comments</th>
                <th align="center" bgcolor="#e6e7e3" style="width:100px">Data Set-up Time</th>
              </tr>
              <?php
              for ($i=0; $i<$page_num; $i++){
                $apply = mysql_fetch_array($obj_apply->result);
                if ($apply) {
					$apply['create_time'] = explode(" ", $apply['create_time']);
					$apply['create_time'] = $apply['create_time'][0].'<br><span class="txtgray">'.$apply['create_time'][1].'</span>';
					if($apply['dog_id4']!=0) {
						$query = "select file1, name from $table_name_dogs where Fullkey='".$apply['dog_id4']."'";
						$dog   = $obj_dogs->run_mysql_out($query);
						$apply['name']  = $dog['name'];
						$apply['file1'] = $dog['file1'];
					}
                ?>
              <tr>
			    <td align="center"><input type="checkbox" name="IDlist[]" value="<?=$apply['Fullkey']?>"></td>
                <td align="center" valign="middle"><button type="button" class="editbtn edit_w25" title="刪除" onClick="real_del(<?=$apply['Fullkey']?>, '<?=$apply['ans1'].' '.$apply['ans2'].' '.$apply['ans3']?>')">s</button></td>
                <td align="center"><a href="dogs_apply_preview.php?apply_id=<?=$apply['Fullkey']?>" target="_blank">Preview</a></td>
                <td align="center"><input type="checkbox" name="data_state" id="data_state<?=$i?>" value="1" <?php if($apply['state']==1){echo 'checked';} ?> onClick="change_power(<?=$apply['Fullkey']?>, 'state', this.checked)" /></td>
                <!--<td align="center"><input type="checkbox" name="data_output" id="data_output<?=$i?>" value="1" <?php if($apply['output']==1){echo 'checked';} ?> onClick="change_power(<?=$apply['Fullkey']?>, 'output', this.checked)" /></td>-->
                <td align="center"><?=$apply['Fullkey']?></td>
                <td align="center"><?php $obj_image->show_pic2($main_str_dogs.'/'.$apply['file1'], $_width_s, $_height_s, $apply['name'], 'show_file'.$i) ?></td>
                <td align="center"><?=$apply['name']?></td>
                <td align="center"><?=$apply['rescuer']?></td>
                <td align="center"><?=$apply['ans1'].' '.$apply['ans2'].' '.$apply['ans3']?></td>
                <td align="center"><?=$apply['ans5']?></td>
                <td align="center"><?=$apply['ans4'].'<br>'.$apply['ans7'].' '.$apply['ans8'].' '.$apply['ans9']?></td>
                <td align="center"><?='Home Tel: ('.$apply['ans11'].')'.$apply['ans12'].'-'.$apply['ans13'].'<br>Cell Tel: ('.$apply['ans14'].')'.$apply['ans15'].'-'.$apply['ans16'].'<br>Work Tel: ('.$apply['ans17'].')'.$apply['ans18'].'-'.$apply['ans19']?></td>
                <td align="center"><textarea name="remark_<?=$apply['Fullkey']?>" id="remark_<?=$apply['Fullkey']?>" onChange="javascript:keydown_text('<?=$apply['Fullkey']?>', 'remark')"><?=$apply['remark']?></textarea></td>
                <td align="center"><?=$apply['create_time']?></td>
              </tr>
                <?php
                }
              }
              ?>
        </table>
        </form>
      </div>
    </div><!--content end-->
    <?php change_page_jyc($page_go, $obj_apply->page_all, $page_num, $obj_apply->obj_all, $my_query_string); ?>
   </div><!--mainContent end-->
  <?php include("include_footer.php"); ?>
  </div><!--main end-->
</div><!--admin-panel end-->
</body>
</html>