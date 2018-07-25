<?php
header("content-type:text/html;charset=utf-8");
require_once('set.php');
require_once(Root_Includes_Path.'function_page.php');

$main_str   = 'admin';
$table_name = Proj_Name.'_'.$main_str;	

$page_num = 10; //設定每頁顯示數目
$page_go  = (!$_GET['page_go'])?1:format_data($_GET['page_go'], 'int');
$search_row = format_data($_GET['search_row'], 'text');
$keywords   = format_data($_GET['keywords'], 'text');
$my_query_string = "&search_row=".$search_row."&keywords=".$keywords;
$array_search    = array('id'=>'帳　　號', 'name'=>'顯示名稱');

if($_SESSION[Login_System_User]['lv']!='admin') {
	js_a_l('', 'admin_handle.php');exit;	
}
if($_GET['action']=='delete') {
	$Fullkey  = format_data($_GET['Fullkey'], 'int');
	$query  = "delete from $table_name where Fullkey='".$Fullkey."'";
	$obj_admin->run_mysql($query);
	if($obj_admin->result) {
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
			$obj_admin->run_mysql($query);
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
			$obj_admin->run_mysql($query);
		}
	}
	js_a_l('修改完成', 'back');exit;
}

//data list
if($search_row) {
	$where_str = "where ".$search_row." like '%".$keywords."%'";	
}
$query = "select Fullkey, id, name, lv, pub, login_time, edit_time from $table_name $where_str order by id asc";	
$obj_admin->count_page($query, $page_go, $page_num);
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
      <li class="title"><?=$page_title?></li>
      <li class="right"><?php include('include_welcome.php'); ?></li>
   </ul>
   <div class="mainContent">
   	 <div id="data_content">
        <div class="toolbar">
          <?php include("include_search.php"); ?>
          <?php change_page_jyc_s($page_go, $obj_admin->page_all, $page_num, $obj_admin->obj_all, $my_query_string); ?>
        </div>
   		<div class="template_black">
        <form method="post" action="<?=$_SERVER['PHP_SELF']?>" name="list_form" id="list_form">
        <input type="hidden" name="action" id="action" value="">
          <table width="100%"  cellspacing="2" cellpadding="0" border="0">
              <tr>
                <th align="center" bgcolor="#e6e7e3" style="width:60px"><button type="button" class="newone" onClick="real_add()">p新增</button></th>
                <th align="center" bgcolor="#e6e7e3" style="width:35px">權限</th>
                <th align="center" bgcolor="#e6e7e3">Account</th>
                <th align="center" bgcolor="#e6e7e3">Name</th>
                <th align="center" bgcolor="#e6e7e3">Permission Level</th>
                <th align="center" bgcolor="#e6e7e3" style="width:180px">Last Active Time</th>
                <th align="center" bgcolor="#e6e7e3" style="width:180px">Recently Update</th>
              </tr>
              <?php
              for ($i=0; $i<$page_num; $i++){
                $admin = mysql_fetch_array($obj_admin->result);
                if ($admin) {
					$admin['login_time']  = explode(" ", $admin['login_time']);
					$admin['login_time']  = $admin['login_time'][0].'<br><span class="txtgray">'.$admin['login_time'][1].'</span>';
					$admin['edit_time']   = explode(" ", $admin['edit_time']);
					$admin['edit_time']   = $admin['edit_time'][0].'<br><span class="txtgray">'.$admin['edit_time'][1].'</span>';
                ?>
              <tr>
                <td align="center"><button type="button" class="editbtn edit_w25" title="編輯" onClick="real_edit(<?=$admin['Fullkey']?>)">r</button> <button type="button" class="editbtn edit_w25" title="刪除" onClick="real_del(<?=$admin['Fullkey']?>, '<?=$admin['id']?>')">s</button></td>
                <td align="center"><input type="checkbox" name="data_pub" id="data_pub<?=$i?>" value="1" <?php if($admin['pub']==1){echo 'checked';} ?> onClick="change_power(<?=$admin['Fullkey']?>, 'pub', this.checked)" /></td>
                <td align="center"><?=$admin['id']?></td>
                <td align="center"><?=$admin['name']?></td>
                <td align="center"><?=$array_admin[$admin['lv']]?></td>
                <td align="center"><?=$admin['login_time']?></td>
                <td align="center"><?=$admin['edit_time']?></td>
              </tr>
                <?php
                }
              }
              ?>
        </table>
        </form>
      </div>
    </div><!--content end-->
    <?php change_page_jyc($page_go, $obj_admin->page_all, $page_num, $obj_admin->obj_all, $my_query_string); ?>
   </div><!--mainContent end-->
   <?php include("include_footer.php"); ?>
  </div><!--main end-->
</div><!--admin-panel end-->
</body>
</html>