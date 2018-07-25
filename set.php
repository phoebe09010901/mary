<?php
require_once('admin/includes/config.php');
require_once(Root_Includes_Path.'db_connect.php');
require_once(Root_Includes_Path.'class_mysql.php');		//class
require_once(Root_Includes_Path.'class_files.php');		//class
require_once(Root_Includes_Path.'string_init.php');		//string
require_once(Root_Includes_Path.'function_string.php');
require_once(Root_Includes_Path.'function_js.php');		//javascript function

//system set
$query  = "select company, company_email, company_phone, company_mobile, company_fax, company_zipcode, company_address, html_title, keywords, description, html_title from ".Proj_Name."_system_set";
$system = $obj_system->run_mysql_out($query);
define("Company_Name", $system['company']);
define("Company_Email", $system['company_email']);
define("Company_Phone", $system['company_phone']);
define("Company_Mobile", $system['company_mobile']);
define("Company_Fax", $system['company_fax']);
define("Company_Address", $system['company_zipcode'].$twzipcode[$system['company_zipcode']]['county'].$twzipcode[$system['company_zipcode']]['area'].$system['company_address']);
define("Html_Title", stripslashes($system['html_title']));
define("Keywords", $system['keywords']);
define("Description", $system['description']);
define("Control_Title", '::: '.$system['html_title'].'│後端管理系統 :::');
define("LoginPage_Title", $system['html_title']);

//****************
//	phpmailer
//****************
require_once(Root_Path.'phpmailer/class.phpmailer.php');	
$mail           = new PHPMailer();				//phpmailer 設定
$mail->IsSMTP();
$mail->SMTPAuth = true;							//設定為安全驗證方式
$mail->Host     = SMTP_Host;			//指定SMTP的服務器位址
$mail->Port     = SMTP_Port;							//設定SMTP服務的POST
$mail->CharSet  = "utf-8";						//設定信件字元編碼
$mail->Encoding = "base64";						//設定信件編碼，大部分郵件工具都支援此編碼方式
$mail->IsHTML(true);							//設置郵件格式為HTML
$mail->Username = SMTP_Username;			//SMTP的帳號
$mail->Password = SMTP_Password;				//SMTP的密碼

//****************
//	wishlist
//****************
if(!$_SESSION['wishlist']) {
	$_SESSION['wishlist'] = '|';
}
$tmp_wishlist = explode('|', $_SESSION['wishlist']);
$my_session_id = date("U");
//print_r($tmp_wishlist);
//echo count($tmp_wishlist);
?>