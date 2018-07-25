<?php
require_once('includes/config.php');
require_once(Root_Includes_Path.'db_connect.php');
require_once(Root_Includes_Path.'class_mysql.php');		//class
require_once(Root_Includes_Path.'class_files.php');		//class
require_once(Root_Includes_Path.'string_init.php');		//string
require_once(Root_Includes_Path.'function_string.php');	
require_once(Root_Includes_Path.'function_js.php');		//javascript function

//system set
$query  = "select company, company_email, company_phone, company_fax, company_zipcode, company_address, html_title, keywords, description, html_title, products_category_lv_num, jqxStyle, from_date, to_date from ".Proj_Name."_system_set";
$system = $obj_system->run_mysql_out($query);
define("Company_Name", stripslashes($system['company']));
define("Company_Email", $system['company_email']);
define("Html_Title", stripslashes($system['html_title']));
define("Control_Title", '::: '.$system['html_title'].'│後端管理系統 :::');
define("LoginPage_Title", $system['html_title']);
define("Products_Category_Lv_Num", $system['products_category_lv_num']);
define("jqxStyle", $system['jqxStyle']);
define("From_Date", $system['from_date']);
define("To_Date", $system['to_date']);
define("News_Category_Lv_Num", 1);
//******************
//	常用function
//******************
if($this_page!='login.php') {
	//確認登入狀態
	if(!$_SESSION[Login_System_User]) {
		js_a_l('', 'login.php');exit;	
	}	
	//check if time out
	$_SESSION['my_action_time'] = (!$_SESSION['my_action_time'])?date("U"):$_SESSION['my_action_time'];
	$_SESSION['check_time']     = date("U");
	/*if(($_SESSION['check_time']-$_SESSION['my_action_time'])/60 < $limit_time) {
		$_SESSION['my_action_time'] = $_SESSION['check_time'];
	}else {
		unset($_SESSION[Login_System_User]);
		js_a_l('您閒置過久已被登出', 'login.php');exit;	
	}*/
}
//****************
//	phpmailer
//****************
require_once(Root_Path.'phpmailer/class.phpmailer.php');	
$mail           = new PHPMailer();				//phpmailer 設定
$mail->IsSMTP();
$mail->SMTPAuth = true;							//設定為安全驗證方式
$mail->CharSet  = "utf-8";						//設定信件字元編碼
$mail->Encoding = "base64";						//設定信件編碼，大部分郵件工具都支援此編碼方式
$mail->Host     = SMTP_Host;	//指定SMTP的服務器位址
$mail->Port     = SMTP_Port;							//設定SMTP服務的POST
$mail->Username = SMTP_Username;	//SMTP的帳號
$mail->Password = SMTP_Password;					//SMTP的密碼
$mail->IsHTML(true);							//設置郵件格式為HTML
//****************
//	語系
//****************
if($_GET['action']=='change_lang') {
	$lang = format_data($_GET['set_lang'], 'text');	
	if($array_language[$lang]) {
		$_SESSION[Login_System_User]['lang'] = $lang;	
	}else {
		js_a_l('無此語系', 'back');exit;	
	}
}
?>