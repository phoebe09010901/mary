<?php
header("content-type:text/html;charset=utf-8");
require_once('set.php');
require_once(Root_Includes_Path.'function_page.php');

$main_str   = 'album';
$table_name = Proj_Name.'_'.$main_str;	
$obj_image  = new files();	

$page_num = 10; //設定每頁顯示數目
$page_go  = (!$_GET['page_go'])?1:format_data($_GET['page_go'], 'int');
$search_row = format_data($_GET['search_row'], 'text');
$keywords   = format_data($_GET['keywords'], 'text');
$category   = format_data($_GET['category'], 'int');
$my_query_string = "&search_row=".$search_row."&keywords=".$keywords."&category=".$category;
$array_search    = array('title'=>'相簿名稱');
switch($category) {
	case 1:
		$cate_title = 'Adoption Photos';
		break;
	case 2:
		$cate_title = 'Monthly Meet Up Photos';
		break;
	case 3:
		$cate_title = 'Adopted Dogs Photos';
		break;
	case 4:
		$cate_title = 'Airport Pickup';
		break;
}

if($_GET['action']=='delete') {
	$Fullkey  = format_data($_GET['Fullkey'], 'int');
	$query  = "delete from $table_name where Fullkey='".$Fullkey."'";
	$obj_album->run_mysql($query);
	//delete photos
	$query = "select file1 from ".$table_name."_photos where album_id='".$Fullkey."'";
	$obj_photo->run_mysql_list($query);
	for($i=0; $i<$obj_photo->obj_all; $i++) {
		$photo = mysql_fetch_array($obj_photo->result);	
		if($photo){ 
			if(is_file(Root_Path.$main_str.'_photos/'.$Fullkey.'/'.$photo['file1'])) {
				//echo Root_Path.$main_str.'_photos/'.$Fullkey.'/'.$photo['file1'].'<br>';
				$obj_image->del_file(Root_Path.$main_str.'_photos/'.$Fullkey.'/'.$photo['file1']); 
			}
		}
	}
	$query = "delete from ".$table_name."_photos where album_id='".$Fullkey."'";	
	$obj_photo->run_mysql($query);
	//刪除資料夾
	if(is_dir(Root_Path.$main_str.'_photos/'.$Fullkey))
		$obj_image->del_dir(Root_Path.$main_str.'_photos/'.$Fullkey);
	if($obj_album->result) {
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
			$obj_album->run_mysql($query);
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
			$obj_album->run_mysql($query);
		}
	}
	js_a_l('修改完成', 'back');exit;
}

//data list
if($search_row) {
	$where_str = "and ".$search_row." like '%".$keywords."%'";	
}
$query = "select Fullkey, album_date, title, pub, create_time, edit_time from $table_name where lang='".$_SESSION[Login_System_User]['lang']."' and category='$category' $where_str order by album_date desc, Fullkey desc";	
$obj_album->count_page($query, $page_go, $page_num);
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
      <a href="index.php"><li class="left">首頁</li></a><li class="left"><?=$cate_title?></li>
      <li class="title"><?=$page_title?></li>
      <li class="right"><?php include('include_welcome.php'); ?></li>
   </ul>
   <div class="mainContent">
   	 <div id="data_content">
        <div class="toolbar">
          <?php include("include_search.php"); ?>
          <?php change_page_jyc_s($page_go, $obj_album->page_all, $page_num, $obj_album->obj_all, $my_query_string); ?>
        </div>
   		<div class="template_black">
        <form method="post" action="<?=$_SERVER['PHP_SELF']?>" name="list_form" id="list_form">
        <input type="hidden" name="action" id="action" value="">
          <table width="100%"  cellspacing="0" cellpadding="0" border="0">
              <tr>
                <th align="center" style="width:62px"><button type="button" class="newone" onClick="real_add()">p新增</button></th>
                <th align="center" bgcolor="#e6e7e3" style="width:35px">上架</th>
                <th align="center" bgcolor="#e6e7e3">Date</th>
                <th align="center" bgcolor="#e6e7e3">Title</th>
                <th align="center" bgcolor="#e6e7e3" style="width:180px">Data Set-up Time</th>
                <th align="center" bgcolor="#e6e7e3" style="width:180px">Recently Update</th>
              </tr>
              <?php
              for ($i=0; $i<$page_num; $i++){
                $album = mysql_fetch_array($obj_album->result);
                if ($album) {
					$album['create_time'] = explode(" ", $album['create_time']);
					$album['create_time'] = $album['create_time'][0].'<br><span class="txtgray">'.$album['create_time'][1].'</span>';
					$album['edit_time']   = explode(" ", $album['edit_time']);
					$album['edit_time']   = $album['edit_time'][0].'<br><span class="txtgray">'.$album['edit_time'][1].'</span>';
                ?>
              <tr>
                <td align="center"><button type="button" class="editbtn edit_w25" title="編輯" onClick="real_edit(<?=$album['Fullkey']?>)">r</button> <button type="button" class="editbtn edit_w25" title="刪除" onClick="real_del(<?=$album['Fullkey']?>, '<?=$album['title']?>')">s</button>
                <button type="button" class="editbtn edit_w65" title="管理" onClick="location.href='album_photos.php?album_id=<?=$album['Fullkey']?>'">管理</button></td>
                <td align="center"><input type="checkbox" name="data_pub" id="data_pub<?=$i?>" value="1" <?php if($album['pub']==1){echo 'checked';} ?> onClick="change_power(<?=$album['Fullkey']?>, 'pub', this.checked)" /></td>
                <td align="center"><?=$album['album_date']?></td>
                <td align="center"><?=$album['title']?></td>
                <td align="center"><?=$album['create_time']?></td>
                <td align="center"><?=$album['edit_time']?></td>
              </tr>
                <?php
                }
              }
              ?>
        </table>
        </form>
      </div>
    </div><!--content end-->
    <?php change_page_jyc($page_go, $obj_album->page_all, $page_num, $obj_album->obj_all, $my_query_string); ?>
   </div><!--mainContent end-->
   <?php include("include_footer.php"); ?>
  </div><!--main end-->
</div><!--admin-panel end-->
</body>
</html>