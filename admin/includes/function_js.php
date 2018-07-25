<?php
//**********************************************
//	javascript 相關 function
//**********************************************
//javascript run alert & location
function js_a_l($alert, $location) {
	echo '<script language="javascript">';
	if($alert)
		echo 'alert(\''.$alert.'\');';
	if($location=='back')
		echo 'history.go(-1);';
	elseif($location=='close')
		echo 'window.close();';
	elseif($location=='fancyboxend') {
		?>$(document).ready(function() { parent.jQuery.fancybox.close(); });<?php
	}else
		echo 'location.href = \''.$location.'\';';
	echo '</script>';
}
?>