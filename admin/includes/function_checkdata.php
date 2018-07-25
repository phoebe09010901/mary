<?php
//check id_number
function isIDnum($num){
   //先用RE語法初步檢驗輸入格式是否正確
   if(preg_match("/^[a-zA-Z][12][0-9]{8}$/",$num,$r)){
      //算出開頭英文字母的地區代碼
      $x=10+strpos("abcdefghjklmnpqrstuvxywzio",strtolower($num[0]));
      //檢查碼1=地區代碼十位數的數字+(個位數的數字x9)
      $chksum=($x-($x%10))/10+($x%10)*9; 
      //檢查碼2=身分數字部分依序乘上8,7,6,5,4,3,2,1然後加起來
      //如n123033877就是1*8+2*7+3*6+...+7*1
      for($i=1;$i<9;$i++){ 
         $chksum+=$num[$i]*(9-$i); 
      }
      //檢查碼=用10減去檢查碼1+檢查碼2的個位數,再取其個位數
      //然後用最後的檢查碼和身分證字號的最後一個數字比較
      //如果相同就是對的,不同就是錯的
      $chksum=(10-$chksum%10)%10; 
      if($chksum==$num[9])return true; 
   }
   return false;
} 
//check e-mail
function isEmail($email){
   if (eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,6}$", $email))
    return true;
  else
    return false;
}
//random string
function random_string($len){
	srand();
	$UpdateKey_a=array("2","3","4","5","6","7","8","9","A","B","C","D","E","F","G","H","J","K","L","M","N","P","Q","R","S","T","U","V","W","X","Y","Z");
	for($i=0;$i<$len;$i++){
		$run=rand(0,count($UpdateKey_a)-1);
		$UpdateKey.=$UpdateKey_a[$run];
	}
	return $UpdateKey;
}
?>