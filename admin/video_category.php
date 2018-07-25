<?php
header("content-type:text/html;charset=utf-8");
require_once('set.php');
require_once(Root_Includes_Path.'function_page.php');

$main_str   = 'video_category';
$table_name = Proj_Name.'_'.$main_str;	

$page_num = 10; //設定每頁顯示數目
$page_go  = (!$_GET['page_go'])?1:format_data($_GET['page_go'], 'int');
$prev     = (!$_GET['prev'])?0:$_GET['prev'];
$search_row = format_data($_GET['search_row'], 'text');
$keywords   = format_data($_GET['keywords'], 'text');
$my_query_string = "&search_row=".$search_row."&keywords=".$keywords."&prev=".$prev;
$array_search    = array('name'=>'類別名稱');

if($_GET['action']=='delete') {
	$Fullkey  = format_data($_GET['Fullkey'], 'int');
	//檢查其下是否有類別或是資料
	$query = "select Fullkey from ".$table_name_news."_category where prev='".$Fullkey."'";
	$obj_cate->run_mysql_list($query);
	if($obj_cate->obj_all > 0) {
		js_a_l('該類別下尚有次類別，禁止刪除', 'back');exit;	
	}
	$query = "select Fullkey from ".$table_name_news." where category='".$Fullkey."'";
	$obj_prod->run_mysql_list($query);
	if($obj_prod->obj_all > 0) {
		js_a_l('該類別下尚有資料，禁止刪除', 'back');exit;	
	}
	$query  = "delete from $table_name where Fullkey='".$Fullkey."'";
	$obj_cate->run_mysql($query);
	if($obj_cate->result) {
		js_a_l('刪除成功', 'back');exit;
	}else {
		js_a_l('刪除失敗，請重新再試一次', 'back');exit;
	}
}elseif($_GET['action']=='del_all') {
	$ids = explode(",", $_GET['ids']);
	if(count($ids)>0) {
		foreach($ids as $value)	{
			$value = format_data($value, 'int');
			$query = "delete from $table_name where Fullkey='$value'";
			$obj_cate->run_mysql($query);
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
			$obj_cate->run_mysql($query);
		}
	}
	js_a_l('修改完成', 'back');exit;
}

//data list
if($search_row) {
	$where_str = "and ".$search_row." like '%".$keywords."%'";	
}
$query = "select Fullkey, name, lv, sort, pub, create_time, edit_time from $table_name where lang='".$_SESSION[Login_System_User]['lang']."' and prev=$prev $where_str order by sort desc";	
$obj_cate->count_page($query, $page_go, $page_num);
//category title
$cate_title = '';
if($prev!=0) {		
	$tmp_prev = $prev;
	do{
		$query = "select Fullkey, name, prev, lv from $table_name where Fullkey='".$tmp_prev."'";
		$pc = $obj_cate1->run_mysql_out($query);
		$cate_title = "<a href=".$main_str.".php?prev=".$pc['prev']."><li class='left'>".$pc['name']."</li></a>".$cate_title;
		$tmp_prev = $pc['prev'];
	}while($pc['prev']!=0);
}
?><!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title><?=Html_Title?>後台管理系統</title>
<?php include("include_head.php"); ?>
<script type="text/javascript">
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
          <?php change_page_jyc_s($page_go, $obj_cate->page_all, $page_num, $obj_cate->obj_all, $my_query_string); ?>
        </div>
   		<div class="template_black">
        <form method="post" action="<?=$_SERVER['PHP_SELF']?>" name="list_form" id="list_form">
        <input type="hidden" name="action" id="action" value="">
          <table width="100%"  cellspacing="2" cellpadding="0" border="0">
              <tr>
                <th align="center" style="width:62px"><button type="button" class="newone" onClick="real_add()">p新增</button></th>
                <th align="center" bgcolor="#e6e7e3" style="width:35px">上架</th>
                <th align="center" bgcolor="#e6e7e3">Category Name</th>
                <th align="center" bgcolor="#e6e7e3">Title</th>
                <th align="center" bgcolor="#e6e7e3" style="width:180px">Data Set-up Time</th>
                <th align="center" bgcolor="#e6e7e3" style="width:180px">Recently Update</th>
              </tr>
              <?php
              for ($i=0; $i<$page_num; $i++){
                $cate = mysql_fetch_array($obj_cate->result);
                if ($cate) {
					$cate['create_time'] = explode(" ", $cate['create_time']);
					$cate['create_time'] = $cate['create_time'][0].'<br><span class="txtgray">'.$cate['create_time'][1].'</span>';
					$cate['edit_time']   = explode(" ", $cate['edit_time']);
					$cate['edit_time']   = $cate['edit_time'][0].'<br><span class="txtgray">'.$cate['edit_time'][1].'</span>';
                ?>
              <tr>
                <td align="center"><button type="button" class="editbtn edit_w25" title="編輯" onClick="real_edit(<?=$cate['Fullkey']?>)">r</button> <button type="button" class="editbtn edit_w25" title="刪除" onClick="real_del(<?=$cate['Fullkey']?>, '<?=$cate['name']?>')">s</button></td>
                <td align="center"><input type="checkbox" name="data_pub" id="data_pub<?=$i?>" value="1" <?php if($cate['pub']==1){echo 'checked';} ?> onClick="change_power(<?=$cate['Fullkey']?>, 'pub', this.checked)" /></td>
                <td align="center"><a href="<?=($cate['lv']<News_Category_Lv_Num)?'video_category.php?prev='.$cate['Fullkey']:'video.php?category='.$cate['Fullkey']?>"><?=$cate['name']?></a></td>
                <td align="center"><input type="text" name="data_sort_<?=$i?>" id="data_sort_<?=$i?>" value="<?=$cate['sort']?>" style="width:50px;" onKeyDown="change_sort('<?=$cate['Fullkey']?>', 'sort', this.value, event)"></td>
                <td align="center"><?=$cate['create_time']?></td>
                <td align="center"><?=$cate['edit_time']?></td>
              </tr>
                <?php
                }
              }
              ?>
        </table>
        </form>
      </div>
    </div><!--content end-->
    <?php change_page_jyc($page_go, $obj_cate->page_all, $page_num, $obj_cate->obj_all, $my_query_string); ?>
   </div><!--mainContent end-->
   <?php include("include_footer.php"); ?>
  </div><!--main end-->
</div><!--admin-panel end-->
</body>
</html>