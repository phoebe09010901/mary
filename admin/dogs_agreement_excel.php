<?php
header("content-type:text/html;charset=utf-8");
header("Content-type:application/vnd.ms-excel");
header("Content-Disposition:filename=agreement_".date("Ymd").".xls");
require_once("set.php");

$main_str   = 'dogs_agreement';
$table_name = Proj_Name.'_'.$main_str;	
$dog_id     = format_data($_GET['dog_id'], 'int');

//data list
if($dog_id) {
	$where_str .= "and d.Fullkey='".$dog_id."'";	
}
$query = "select d.name, da.* from $table_name_dogs d, $table_name da where d.Fullkey=da.dog_id and da.output=1 $where_str order by da.create_time desc";	
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
                <th align="center" bgcolor="#e6e7e3">Agreement ID</th>
                <th align="center" bgcolor="#e6e7e3">Dog's Name</th>
                <th align="center" bgcolor="#e6e7e3">Agreement Date</th>
                <th align="center" bgcolor="#e6e7e3">Rescuer</th>
                <th align="center" bgcolor="#e6e7e3">Adopter</th>
                <th align="center" bgcolor="#e6e7e3">Signature Block of Adopter</th>
                <th align="center" bgcolor="#e6e7e3">Printed Name of Adopter</th>
                <th align="center" bgcolor="#e6e7e3">Signature of Adopter</th>
                <th align="center" bgcolor="#e6e7e3">Date Signed</th>
                <th align="center" bgcolor="#e6e7e3">Address</th>
                <th align="center" bgcolor="#e6e7e3">City, State, Zip</th>
                <th align="center" bgcolor="#e6e7e3">Email</th>
                <th align="center" bgcolor="#e6e7e3">Cell</th>
                <th align="center" bgcolor="#e6e7e3">Home</th>
                <th align="center" bgcolor="#e6e7e3">Work</th>
                <th align="center" bgcolor="#e6e7e3">Signature Block of Adopter</th>
                <th align="center" bgcolor="#e6e7e3">Printed Name of Adopter</th>
                <th align="center" bgcolor="#e6e7e3">Signature of Adopter</th>
                <th align="center" bgcolor="#e6e7e3">Date Signed</th>
                <th align="center" bgcolor="#e6e7e3">Address</th>
                <th align="center" bgcolor="#e6e7e3">City, State, Zip</th>
                <th align="center" bgcolor="#e6e7e3">Email</th>
                <th align="center" bgcolor="#e6e7e3">Cell</th>
                <th align="center" bgcolor="#e6e7e3">Home</th>
                <th align="center" bgcolor="#e6e7e3">Work</th>
                <th align="center" bgcolor="#e6e7e3" style="width:100px">建立時間</th>
              </tr>
              <?php
              for ($i=0; $i<$obj_dogs->obj_all; $i++){
                $dogs = mysql_fetch_array($obj_dogs->result);
                if ($dogs) {
                ?>
              <tr>
                <td align="center"><?=$dogs['Fullkey']?></td>
                <td align="center"><?=$dogs['name']?></td>
                <td align="center"><?=$dogs['text1'].'-'.$dogs['text2'].'-'.$dogs['text3']?></td>
                <td align="center"><?=$dogs['text4']?></td>
                <td align="center"><?=$dogs['text5']?></td>
                <td align="center"><?=stripslashes($dogs['ans1'])?></td>
                <td align="center"><?=stripslashes($dogs['ans2'])?></td>
                <td align="center"><?=stripslashes($dogs['ans3'])?></td>
                <td align="center"><?=stripslashes($dogs['ans4'])?></td>
                <td align="center"><?=stripslashes($dogs['ans5'])?></td>
                <td align="center"><?=stripslashes($dogs['ans6'])?></td>
                <td align="center"><?=stripslashes($dogs['ans7'])?></td>
                <td align="center"><?=stripslashes($dogs['ans8'])?></td>
                <td align="center"><?=stripslashes($dogs['ans9'])?></td>
                <td align="center"><?=stripslashes($dogs['ans10'])?></td>
                <td align="center"><?=stripslashes($dogs['ans11'])?></td>
                <td align="center"><?=stripslashes($dogs['ans12'])?></td>
                <td align="center"><?=stripslashes($dogs['ans13'])?></td>
                <td align="center"><?=stripslashes($dogs['ans14'])?></td>
                <td align="center"><?=stripslashes($dogs['ans15'])?></td>
                <td align="center"><?=stripslashes($dogs['ans16'])?></td>
                <td align="center"><?=stripslashes($dogs['ans17'])?></td>
                <td align="center"><?=stripslashes($dogs['ans18'])?></td>
                <td align="center"><?=stripslashes($dogs['ans19'])?></td>
                <td align="center"><?=stripslashes($dogs['ans20'])?></td>
                <td align="center"><?=$dogs['create_time']?></td>
              </tr>
                <?php
                }
              }
              ?>
        </table>
</body>
</html>