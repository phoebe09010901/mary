<?php
header("content-type:text/html;charset=utf-8");
require_once('set.php');
require_once(Root_Includes_Path.'function_page.php');

$main_str   = 'banner';
$table_name = Proj_Name.'_'.$main_str;
$obj_image  = new files();		

$page_num = 5; //設定每頁顯示數目
$page_go  = (!$_GET['page_go'])?1:format_data($_GET['page_go'], 'int');
$category = ($_GET['category'])?$_GET['category']:1;
$search_row = format_data($_GET['search_row'], 'text');
$keywords   = format_data($_GET['keywords'], 'text');
$my_query_string = "&search_row=".$search_row."&keywords=".$keywords."&category=".$category;
$array_search    = array('title'=>'Banner標題');

switch($category) {
	case 1:
		$cate_str = '首頁 Banner';
		$_width  = 1226;
		$_height = 697;
		$_width_s  = 1226*0.2;
		$_height_s = 697*0.2;
		break;
	case 2:
		$cate_str = 'Banner I';
		$_width  = 209;
		$_height = 107;
		$_width_s  = 209;
		$_height_s = 107;
		break;
	case 3:
		$cate_str = 'Banner II';
		$_width  = 288;
		$_height = 185;
		$_width_s  = 288*0.75;
		$_height_s = 185*0.75;
		break;
	case 4:
		$cate_str = 'Rescue Banner';
		$_width  = 543;
		$_height = 380;
		$_width_s  = 543*0.3;
		$_height_s = 380*0.3;
		break;
	case 5:
		$cate_str = 'Train Banner';
		$_width  = 543;
		$_height = 380;
		$_width_s  = 543*0.3;
		$_height_s = 380*0.3;
		break;
	case 6:
		$cate_str = 'Donate Banner';
		$_width  = 543;
		$_height = 380;
		$_width_s  = 543*0.3;
		$_height_s = 380*0.3;
		break;
}

if($_GET['action']=='delete') {
	$Fullkey  = format_data($_GET['Fullkey'], 'int');
	//刪除圖片
	$query = "select file1 from $table_name where Fullkey='".$Fullkey."'";
	$banner= $obj_banner->run_mysql_out($query);
	if($banner['file1'])
		$obj_image->del_file('../'.$main_str.'/'.$banner['file1']);
	$query  = "delete from $table_name where Fullkey='".$Fullkey."'";
	$obj_banner->run_mysql($query);
	if($obj_banner->result) {
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
			$obj_banner->run_mysql($query);
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
			$obj_banner->run_mysql($query);
		}
	}
	js_a_l('修改完成', 'back');exit;
}

//data list
if($search_row) {
	$where_str = "and ".$search_row." like '%".$keywords."%'";	
}
$query = "select Fullkey, file1, title, url_to, sort, pub, create_time, edit_time from $table_name where lang='".$_SESSION[Login_System_User]['lang']."' and category=$category $where_str order by sort desc";	
$obj_banner->count_page($query, $page_go, $page_num);
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
      <a href="index.php"><li class="left">首頁</li></a>
      <li class="left"><?=$cate_str?></li>
      <li class="title"><?=$page_title?></li>
      <li class="right"><?php include('include_welcome.php'); ?></li>
   </ul>
   <div class="mainContent">
   	 <div id="data_content">
        <div class="toolbar">
          <?php include("include_search.php"); ?>
          <?php change_page_jyc_s($page_go, $obj_banner->page_all, $page_num, $obj_banner->obj_all, $my_query_string); ?>
        </div>
   		<div class="template_black">
        <form method="post" action="<?=$_SERVER['PHP_SELF']?>" name="list_form" id="list_form">
        <input type="hidden" name="action" id="action" value="">
          <table width="100%"  cellspacing="0" cellpadding="0" border="0">
              <tr>
                <th align="center" style="width:62px"><?php if(($category==1||$category==4||$category==5||$category==6)&&$obj_banner->obj_all<5){ ?><button type="button" class="newone" onClick="real_add()">p新增</button><?php } ?></th>
                <th align="center" bgcolor="#e6e7e3" style="width:35px">上架</th>
                <th align="center" bgcolor="#e6e7e3">Banner</th>
                <th align="center" bgcolor="#e6e7e3">Sort Numbers</th>
                <th align="center" bgcolor="#e6e7e3" style="width:180px">Data Set-up Time</th>
                <th align="center" bgcolor="#e6e7e3" style="width:180px">Recently Update</th>
              </tr>
              <?php
              for ($i=0; $i<$page_num; $i++){
                $banner = mysql_fetch_array($obj_banner->result);
                if ($banner) {
					$banner['create_time'] = explode(" ", $banner['create_time']);
					$banner['create_time'] = $banner['create_time'][0].'<br><span class="txtgray">'.$banner['create_time'][1].'</span>';
					$banner['edit_time']   = explode(" ", $banner['edit_time']);
					$banner['edit_time']   = $banner['edit_time'][0].'<br><span class="txtgray">'.$banner['edit_time'][1].'</span>';
                ?>
              <tr>
                <td align="center"><button type="button" class="editbtn edit_w25" title="編輯" onClick="real_edit(<?=$banner['Fullkey']?>)">r</button> <button type="button" class="editbtn edit_w25" title="刪除" onClick="real_del(<?=$banner['Fullkey']?>, '<?=$banner['title']?>')">s</button></td>
                <td align="center"><input type="checkbox" name="data_pub" id="data_pub<?=$i?>" value="1" <?php if($banner['pub']==1){echo 'checked';} ?> onClick="change_power(<?=$banner['Fullkey']?>, 'pub', this.checked)" /></td>
                <td align="center"><a href="<?=($banner["url_to"])?$banner["url_to"]:'#'?>" target="_blank"><?php $obj_image->show_pic1($main_str.'/'.$banner['file1'], $_width_s, $_height_s, $banner['title'], 'show_file'.$i) ?></a></td>
                <td align="center"><input type="text" name="data_sort_<?=$i?>" id="data_sort_<?=$i?>" value="<?=$banner['sort']?>" style="width:50px;" onKeyDown="change_sort('<?=$banner['Fullkey']?>', 'sort', this.value, event)"></td>
                <td align="center"><?=$banner['create_time']?></td>
                <td align="center"><?=$banner['edit_time']?></td>
              </tr>
                <?php
                }
              }
              ?>
        </table>
        </form>
      </div>
    </div><!--content end-->
      <?php change_page_jyc($page_go, $obj_banner->page_all, $page_num, $obj_banner->obj_all, $my_query_string); ?>
   </div><!--mainContent end-->
   <?php include("include_footer.php"); ?>
  </div><!--main end-->
</div><!--admin-panel end-->
</body>
</html>