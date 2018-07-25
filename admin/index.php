<?php
header("content-type:text/html;charset=utf-8");
require_once('set.php');

$main_str = 'index';
//admin
$query = "select count(Fullkey) as counts from $table_name_admin where lv='admin'";
$admin1= $obj_admin->run_mysql_out($query);
$query = "select count(Fullkey) as counts from $table_name_admin where lv='web'";
$admin2= $obj_admin->run_mysql_out($query);
//hits
$query = "select count(Fullkey) as counts from $table_name_hit";
$hits1 = $obj_hits->run_mysql_out($query);
$query = "select count(Fullkey) as counts from $table_name_hit where create_time like '".date("Y-m-d")." %'";
$hits2 = $obj_hits->run_mysql_out($query);
//banner
$query = "select count(Fullkey) as counts from $table_name_banner where category=1";
$banner1 = $obj_banner->run_mysql_out($query);
$query = "select count(Fullkey) as counts from $table_name_banner where category=2";
$banner2 = $obj_banner->run_mysql_out($query);
$query = "select count(Fullkey) as counts from $table_name_banner where category=3";
$banner3 = $obj_banner->run_mysql_out($query);
//pages category
$query = "select Fullkey, name from ".$table_name_pages."_category where lang='".$_SESSION[Login_System_User]['lang']."' and prev=0 order by sort desc";
$obj_cate1->run_mysql_list($query);
//news category
$query = "select Fullkey, name from ".$table_name_news."_category where lang='".$_SESSION[Login_System_User]['lang']."' and prev=0 order by sort desc";
$obj_cate2->run_mysql_list($query);
//contact
$query = "select count(Fullkey) as counts from $table_name_cont where state=0";
$cont1 = $obj_cont->run_mysql_out($query);
$query = "select count(Fullkey) as counts from $table_name_cont where state=1";
$cont2 = $obj_cont->run_mysql_out($query);
?><!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title><?=Html_Title?>後台管理系統</title>
<?php include("include_head.php"); ?>
<script type="text/javascript" src="../jqwidgets/jqxdatetimeinput.js"></script>
<script type="text/javascript" src="../jqwidgets/jqxcalendar.js"></script>
<script type="text/javascript">
$(document).ready(function () {
	var theme = '<?=jqxStyle?>';
	// create jqxcalendar.
	$("#show_calendar").jqxCalendar({ width: 250, height: 250, theme: theme, culture:'zh-TW' });
});
</script>
</head>
<body>
<?php include("include_top.php"); ?>
<div class="admin-panel">
  <?php include("include_menu.php"); ?><!--slidebar end-->
   <div class="main set_page_h page_shadow">
   <ul class="topbar">
      <a href="index.php"><li class="title">首頁</li></a>
      <li class="right"><?php include('include_welcome.php'); ?></li>
   </ul>
   <div class="mainContent">
   	 <div id="data_content">     
     <table width="100%" border="0" cellpadding="0" cellspacing="0">
     <tr>
        <td>
        <div class="monitor">
          <h4>系統管理</h4>
             <div style="padding-bottom:20px;">
             此系統使用之後端程式語言為 PHP 5<br>
             搭配資料庫為 MYSQL 網頁編碼為 UTF-8
             </div><!-- end-->
             <div>
             <?=$array_admin['admin']?>：<?=$admin1['counts']?>位<br>
             <?=$array_admin['web']?>：<?=$admin2['counts']?>位<br><br>
             總瀏覽人數：<?=number_format($hits1['counts'])?>人<br>
             今日瀏覽人數：<?=number_format($hits2['counts'])?>人
             </div><!-- end-->
        </div>
        <div class="monitor">
          <h4>刊登管理</h4>
             <div>
             首頁Banner：<?=$banner1['counts']?>則<br>
             Banner I：<?=$banner2['counts']?>則<br>
             Banner II：<?=$banner3['counts']?>則
             </div><!-- end-->
        </div>
        <div class="monitor">
          <h4>留言管理</h4>
             <div>
             連絡我們(未處理)：<?=$cont1['counts']?>則<br>
             連絡我們(已處理)：<?=$cont2['counts']?>則
             </div><!-- end-->
        </div>
        </td>
        <td width="300" align="right" valign="top" class="calendar">
           <div id='show_calendar'></div>
        </td>
     </tr>
     </table>
     </div><!--content end-->
   </div><!--mainContent end-->
   <?php include("include_footer.php"); ?>
  </div><!--main end-->
</div><!--admin-panel end-->
</body>
</html>