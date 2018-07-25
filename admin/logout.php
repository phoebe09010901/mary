<?php
header("content-type:text/html;charset=utf-8");
require_once('set.php');

unset($_SESSION[Login_System_User]);
unset($_SESSION['my_action_time']);

js_a_l('','login.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$html_title?></title>
<link href="css/R.css" rel="stylesheet" type="text/css">
</head>

<body style="background-position:center top; background-image:url(images/login.jpg);">
</body>
</html>