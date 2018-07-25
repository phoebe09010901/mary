<?php
/*$script_filename = getenv('PATH_TRANSLATED');
if (empty($script_filename)) {
	$script_filename = getenv('SCRIPT_FILENAME');
}
echo "實體路徑為 : <font color=blue>". $script_filename."</font><HR>";exit;*/
define("Host_Name", 'http://'.$_SERVER['HTTP_HOST'].'/');
define("Web_Control", Host_Name.'admin/');
define("Root_Path", $_SERVER['DOCUMENT_ROOT'].'/');
define("Root_Admin_Path", Root_Path.'admin/');
define("Root_Includes_Path", Root_Admin_Path.'includes/');
define("Proj_Name", 'marydog');
define("Login_User", Proj_Name.'_user_id');
define("Login_System_User", Proj_Name.'_admin_id');
define("Shopping_Data", Proj_Name.'_orderlist');

date_default_timezone_set("Asia/Taipei");
$limit_time  = 24;	//單位:分鐘
//SMTP
define("SMTP_Host", 'mail.adoptadoggie.org');
define("SMTP_Port", '25');
define("SMTP_Username", 'contact@adoptadoggie.org');
define("SMTP_Password", 'contact@tw100');
//Designer Information
define("Design_Company", '');
define("Design_Company_Web", '#');
define("Design_Company_Phone", '');
define("Design_Company_Email", '');
session_start();
?>
