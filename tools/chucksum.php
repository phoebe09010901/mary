<?php
// ABOUT
// =======================================================
// imageCheck_zz 影象數字產生器 ver:0.2
// made by zenon blue,December 2006
// last modify 2007/07/25
// http://bluezz.tw/mybook/content.php?id=458
// service@bluezz.com.tw
// =======================================================
include('../admin/includes/config.php');

if(!$_GET["key_c"]) {
	$_SESSION['s_checksum']=auto_checksum(6);
	if($_GET['action']=='change') {
		$_SESSION['s_checksum'] = auto_checksum(6);
	}
	echo set_counter_img($_SESSION['s_checksum']);
}else {
	echo set_counter_img($_GET["key_c"]);
}
//===================隨機產生密碼(L3業者密碼自動產生)====================
function auto_checksum($len){
	srand();
	$UpdateKey_a=array("2","3","4","5","6","7","8","9","A","B","C","D","E","F","G","H","J","K","L","M","N","P","Q","R","S","T","U","V","W","X","Y","Z");
	for($i=0;$i<$len;$i++){
		$run=rand(0,count($UpdateKey_a)-1);
		$UpdateKey.=$UpdateKey_a[$run];
	}
	return $UpdateKey;
}

function set_counter_img($sum){ 
	for($i=0;$i < strlen($sum ) ;$i++){
		$src =Root_Path."images/check_code/". substr($sum,$i,1) .".png";		//找圖檔
		$srcSize = getImageSize($src);
		$srcImage = ImageCreateFromPNG($src);
		$null=Root_Path."images/check_code/null.png";	//空白
		$nullImage = ImageCreateFromPNG($null);
		if($i==0){
			$destSize[0]=$srcSize[0] * strlen($sum) ;
			$destSize[1]=$srcSize[1];			
			$rcImage=ImageCreate($destSize[0],$destSize[1]);
			$white=imageColorAllocate($rcImage,255,255,255);
			//$black=imageColorAllocate($rcImage,0,0,255);
			for($j=0;$j<10;$j++) {
				$black=imageColorAllocate($rcImage,rand(0,255),rand(0,255),rand(0,255));
				Imagearc($rcImage,rand(0,$destSize[0]),rand(0,$destSize[1]),rand(0,$destSize[0]*2),rand(0,$destSize[1]*2),0,360,$black);
			}
		}		
		//ImageCopyResized($rcImage, $srcImage, $srcSize[0] * $i + rand(0,3), rand(0,$srcSize[0]/4), 0, 0,rand($srcSize[0]/4 * 3 ,$srcSize[0]),rand($srcSize[1]/4 * 3,$srcSize[1]),$srcSize[0],$srcSize[1]);
		ImageCopyResampled($rcImage, $srcImage, $srcSize[0] * $i + rand(0,3), rand(0,$srcSize[0]/4), 0, 0,rand($srcSize[0]/4 * 3 ,$srcSize[0]),rand($srcSize[1]/4 * 3,$srcSize[1]),$srcSize[0],$srcSize[1]);
		imagedestroy($srcImage);
	}
	return imagePng($rcImage);
}
?>