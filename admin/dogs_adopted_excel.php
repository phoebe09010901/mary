<?php
header("content-type:text/html;charset=utf-8");
header("Content-type:application/vnd.ms-excel");
header("Content-Disposition:filename=adoptedlist_".$_GET['from_date']."~".$_GET['to_date'].".xls");
require_once("set.php");

$main_str   = 'dogs';
$table_name = Proj_Name.'_'.$main_str;	

$category   = 1;
$search_row = format_data($_GET['search_row'], 'text');
$keywords   = format_data($_GET['keywords'], 'text');
$search_type= (!$_GET['search_type'])?'pub1':format_data($_GET['search_type'], 'text');
$from_date  = $_GET['from_date']?format_data($_GET['from_date'], 'text'):date("Y-01-01");
$to_date    = $_GET['to_date']?format_data($_GET['to_date'], 'text'):date("Y-m-d");

//data list
if($search_row=='name') {
	$where_str .= " and d.name like '%".$keywords."%'";	
}elseif($search_row=='adopter') {
	$where_str .= " and da.ans2 like '%".$keywords."%'";
}
$where_str .= " and ('$from_date'<=da.adopted_date and da.adopted_date<='$to_date')";

/*if($search_type=='pub1') {
	$where_str .= " and d.pub=1";	
}elseif($search_type=='pub0') {
	$where_str .= " and d.pub=0";	
}*/
$query = "select d.Fullkey, d.file1, d.name, d.sex, d.years, d.month, d.weight, d.handler, d.verify, d.print, d.adopter, d.remark, d.sort, d.pub, d.create_time, d.edit_time, da.ans2, da.ans5, da.ans6, da.ans7, da.ans8, da.ans9, da.adopted_date from $table_name d, ".$table_name_dogs."_agreement da where d.lang='".$_SESSION[Login_System_User]['lang']."' and d.Fullkey=da.dog_id and da.adopted=1 $where_str order by d.name asc";
$obj_dogs->run_mysql_list($query);
?><!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title><?=Html_Title?>後台管理系統</title>
</head>
<body>
          <table width="100%"  cellspacing="0" cellpadding="0" border="1">
              <tr>
                <th align="center" bgcolor="#e6e7e3">No.</th>
                <th align="center" bgcolor="#e6e7e3">Airport Date</th>
                <th align="center" bgcolor="#e6e7e3">Dog’s Name</th>
                <th align="center" bgcolor="#e6e7e3">Dog’s New Name</th>
                <th align="center" bgcolor="#e6e7e3">Owner</th>
                <th align="center" bgcolor="#e6e7e3">Email</th>
                <th align="center" bgcolor="#e6e7e3">Cell</th>
                <th align="center" bgcolor="#e6e7e3">Home</th>
                <th align="center" bgcolor="#e6e7e3">Address</th>
                <th align="center" bgcolor="#e6e7e3">City, State, Zip</th>
              </tr>
              <?php
              for ($i=0; $i<$obj_dogs->obj_all; $i++){
                $dogs = mysql_fetch_array($obj_dogs->result);
                if ($dogs) {
                ?>
              <tr>
                <td align="center"><?=$i+1?></td>
                <td align="center">&nbsp;</td>
                <td align="center"><?=$dogs['name']?></td>
                <td align="center">&nbsp;</td>
                <td align="center"><?=stripslashes($dogs['ans2'])?></td>
                <td align="center"><?=stripslashes($dogs['ans7'])?></td>
                <td align="center"><?=stripslashes($dogs['ans8'])?></td>
                <td align="center"><?=stripslashes($dogs['ans9'])?></td>
                <td align="center"><?=stripslashes($dogs['ans5'])?></td>
                <td align="center"><?=stripslashes($dogs['ans6'])?></td>
              </tr>
                <?php
                }
              }
              ?>
        </table>
</body>
</html>