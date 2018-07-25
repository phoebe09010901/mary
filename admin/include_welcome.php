目前語系：<select name="lang_list" id="lang_list"><?php
foreach($array_language as $key => $value) {
	?><option value="<?=$key?>" <?php if($_SESSION[Login_System_User]['lang']==$key){echo 'selected';} ?>><?=$value?></option><?php	
}
?></select> / <?=$array_admin[$_SESSION[Login_System_User]['lv']].'/'.'<a href="#">'.$_SESSION[Login_System_User]['name']?></a>
