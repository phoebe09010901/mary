<?php
header("content-type:text/html;charset=utf-8");
require_once('set.php');
require_once(Root_Includes_Path.'function_page.php');

$main_str   = 'video';
$table_name = Proj_Name.'_'.$main_str;	

$page_num = 10; //設定每頁顯示數目
$page_go  = (!$_GET['page_go'])?1:format_data($_GET['page_go'], 'int');
$category   = format_data($_GET['category'], 'int');
$search_row = format_data($_GET['search_row'], 'text');
$keywords   = format_data($_GET['keywords'], 'text');
$my_query_string = "&category=".$category."&search_row=".$search_row."&keywords=".$keywords;
$array_search    = array('news_date'=>'發佈日期', 'title'=>'標　　題');

if($_GET['action']=='delete') {
	$Fullkey  = format_data($_GET['Fullkey'], 'int');
	$query  = "delete from $table_name where Fullkey='".$Fullkey."'";
	$obj_news->run_mysql($query);
	if($obj_news->result) {
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
			$obj_news->run_mysql($query);
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
			$obj_news->run_mysql($query);
		}
	}
	js_a_l('修改完成', 'back');exit;
}

//data list
if($category)
	$where_str = "and category=".$category;
if($search_row) {
	$where_str .= " and ".$search_row." like '%".$keywords."%'";	
}
$query = "select Fullkey, news_date, title, youtube, other_video, sort, hit_counts, pub, create_time, edit_time from $table_name where lang='".$_SESSION[Login_System_User]['lang']."' $where_str order by news_date desc";
$obj_news->count_page($query, $page_go, $page_num);
//category title
$cate_title = '';
if($category!=0) {		
	$tmp_prev = $category;
	do{
		$query = "select Fullkey, name, prev, lv from ".$table_name."_category where Fullkey='".$tmp_prev."'";
		$pc = $obj_cate1->run_mysql_out($query);
		$cate_title = "<a href=".$main_str."_category.php?prev=".$pc['prev']."><li class='left'>".$pc['name']."</li></a>".$cate_title;
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
          <?php change_page_jyc_s($page_go, $obj_news->page_all, $page_num, $obj_news->obj_all, $my_query_string); ?>
        </div>
   		<div class="template_black">
        <form method="post" action="<?=$_SERVER['PHP_SELF']?>" name="list_form" id="list_form">
        <input type="hidden" name="action" id="action" value="">
          <table width="100%"  cellspacing="2" cellpadding="0" border="0">
              <tr>
                <th align="center" style="width:62px"><button type="button" class="newone" onClick="real_add()">p新增</button></th>
                <th align="center" bgcolor="#e6e7e3" style="width:35px">上架</th>
                <th align="center" bgcolor="#e6e7e3">Url</th>
                <th align="center" bgcolor="#e6e7e3">Title</th>
                <th align="center" bgcolor="#e6e7e3">Sort Numbers</th>
                <th align="center" bgcolor="#e6e7e3" style="width:180px">Data Set-up Time</th>
                <th align="center" bgcolor="#e6e7e3" style="width:180px">Recently Update</th>
              </tr>
              <?php
              for ($i=0; $i<$page_num; $i++){
                $news = mysql_fetch_array($obj_news->result);
                if ($news) {
					$news['create_time'] = explode(" ", $news['create_time']);
					$news['create_time'] = $news['create_time'][0].'<br><span class="txtgray">'.$news['create_time'][1].'</span>';
					$news['edit_time']   = explode(" ", $news['edit_time']);
					$news['edit_time']   = $news['edit_time'][0].'<br><span class="txtgray">'.$news['edit_time'][1].'</span>';
                ?>
              <tr>
                <td align="center"><button type="button" class="editbtn edit_w25" title="編輯" onClick="real_edit(<?=$news['Fullkey']?>)">r</button> <button type="button" class="editbtn edit_w25" title="刪除" onClick="real_del(<?=$news['Fullkey']?>, '<?=$news['title']?>')">s</button></td>
                <td align="center"><input type="checkbox" name="data_pub" id="data_pub<?=$i?>" value="1" <?php if($news['pub']==1){echo 'checked';} ?> onClick="change_power(<?=$news['Fullkey']?>, 'pub', this.checked)" /></td>
                <td align="center"><?php if($news['youtube']){ ?><a href="<?=$news['youtube']?>" target="_blank"><?=$news['youtube']?></a><?php }elseif($news['other_video']){ echo '其他平台影片'; } ?></td>
                <td align="center"><?=$news['title']?></td>
                <td align="center"><input type="text" name="data_sort_<?=$i?>" id="data_sort_<?=$i?>" value="<?=$news['sort']?>" style="width:50px;" onKeyDown="change_sort('<?=$news['Fullkey']?>', 'sort', this.value, event)"></td>
                <td align="center"><?=$news['create_time']?></td>
                <td align="center"><?=$news['edit_time']?></td>
              </tr>
                <?php
                }
              }
              ?>
        </table>
        </form>
      </div>
    </div><!--content end-->
    <?php change_page_jyc($page_go, $obj_news->page_all, $page_num, $obj_news->obj_all, $my_query_string); ?>
   </div><!--mainContent end-->
   <?php include("include_footer.php"); ?>
  </div><!--main end-->
</div><!--admin-panel end-->
</body>
</html>