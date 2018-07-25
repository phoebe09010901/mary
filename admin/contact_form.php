<?php
header("content-type:text/html;charset=utf-8");
require_once('set.php');
require_once(Root_Includes_Path.'function_page.php');

$main_str   = 'contact_form';
$table_name = Proj_Name.'_'.$main_str;	

$page_num = 10; //設定每頁顯示數目
$page_go  = (!$_GET['page_go'])?1:format_data($_GET['page_go'], 'int');
$search_row = format_data($_GET['search_row'], 'text');
$keywords   = format_data($_GET['keywords'], 'text');
$my_query_string = "&search_row=".$search_row."&keywords=".$keywords;
$array_search    = array('name'=>'發問者', 'phone'=>'連絡電話', 'email'=>'E-mail');

if($_GET['action']=='delete') {
	$Fullkey  = format_data($_GET['Fullkey'], 'int');
	$query  = "delete from $table_name where Fullkey='".$Fullkey."'";
	$obj_cont->run_mysql($query);
	if($obj_cont->result) {
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
			$obj_cont->run_mysql($query);
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
			$obj_cont->run_mysql($query);
		}
	}
	js_a_l('修改完成', 'back');exit;
}

//data list
if($search_row) {
	$where_str = "where ".$search_row." like '%".$keywords."%'";	
}
$query = "select Fullkey, name, phone, email, state, create_time from $table_name $where_str order by create_time desc";	
$obj_cont->count_page($query, $page_go, $page_num);
?><!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title><?=Html_Title?>後台管理系統</title>
<?php include("include_head.php"); ?>
<script type="text/javascript">
$(document).ready(function () {
	var theme = '<?=jqxStyle?>';
	// create jqxWindow.
    $("#cont_window").jqxWindow({ resizable: false, autoOpen: false, width: 500, height: 300, theme: theme });
});
function real_cont(cont_id, name) {
	if(cont_id) {
		$("#cont_window").jqxWindow('open');
		$("#cont_title").html('留言者: '+name);
		$("#cont_id").val(cont_id);
		var ajaxurl = "<?=$main_str?>_data.php?action=get_content&cont_id="+cont_id;
		$.ajax({
			url: ajaxurl,
			dataType: 'json',
			success: function(request) {
				$.each(request, function(k, v){
					$.each(v, function(k1, v1){
						if(v1.content)
							$("#<?=$main_str?>_content").html(v1.content);
					})			
				})
			}
		});
	}
}
</script>
</head>
<body>
<div id="cont_window">
	<div><span id="cont_title">留言資料</span></div>
    <div style="overflow: auto;">
        <div id="<?=$main_str?>_content"></div>
	</div>
</div>
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
          <?php change_page_jyc_s($page_go, $obj_cont->page_all, $page_num, $obj_cont->obj_all, $my_query_string); ?>
        </div>
   		<div class="template_black">
        <form method="post" action="<?=$_SERVER['PHP_SELF']?>" name="list_form" id="list_form">
        <input type="hidden" name="action" id="action" value="">
          <table width="100%"  cellspacing="2" cellpadding="0" border="0">
              <tr>
                <th align="center" bgcolor="#e6e7e3" style="width:60px">&nbsp;</th>
                <th align="center" bgcolor="#e6e7e3" style="width:35px">Process</th>
                <th align="center" bgcolor="#e6e7e3" style="width:125px">Name</th>
                <th align="center" bgcolor="#e6e7e3">Phone Number4</th>
                <th align="center" bgcolor="#e6e7e3">E-mail</th>
                <th align="center" bgcolor="#e6e7e3" style="width:180px">Data Set-up Time</th>
              </tr>
              <?php
              for ($i=0; $i<$page_num; $i++){
                $cont = mysql_fetch_array($obj_cont->result);
                if ($cont) {
					$cont['create_time'] = explode(" ", $cont['create_time']);
					$cont['create_time'] = $cont['create_time'][0].'<br><span class="txtgray">'.$cont['create_time'][1].'</span>';
                ?>
              <tr>
                <td align="center"><button type="button" class="editbtn edit_w25" title="刪除" onClick="real_del(<?=$cont['Fullkey']?>, '<?=$cont['name']?>')">s</button><button type="button" class="editbtn edit_w65" title="查看" onClick="real_cont(<?=$cont['Fullkey']?>, '<?=$cont['name']?>')">查看</button></td>
                <td align="center"><input type="checkbox" name="data_pub" id="data_pub<?=$i?>" value="1" <?php if($cont['state']==1){echo 'checked';} ?> onClick="change_power(<?=$cont['Fullkey']?>, 'state', this.checked)" /></td>
                <td align="center"><?=$cont['name']?></td>
                <td align="center"><?=$cont['phone']?></td>
                <td align="center"><a href="mailto:<?=$cont['email']?>"><?=$cont['email']?></a></td>
                <td align="center"><?=$cont['create_time']?></td>
              </tr>
                <?php
                }
              }
              ?>
        </table>
        </form>
      </div>
    </div><!--content end-->
    <?php change_page_jyc($page_go, $obj_cont->page_all, $page_num, $obj_cont->obj_all, $my_query_string); ?>
   </div><!--mainContent end-->
   <?php include("include_footer.php"); ?>
  </div><!--main end-->
</div><!--admin-panel end-->
</body>
</html>