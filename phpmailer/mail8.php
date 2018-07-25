<?php
// 請將這支程式連同上方三支程式放在同一個資料匣下才可以
include("class.phpmailer.php");

// 產生 Mailer 實體
$mail = new PHPMailer();

// 設定為 SMTP 方式寄信
$mail->IsSMTP();

// SMTP 伺服器的設定，以及驗證資訊
$mail->SMTPAuth = true;
$mail->Host = "mail.adoptadoggie.org"; //此處請填寫您的郵件伺服器位置,通常是mail.網址。如果您MX指到外地，那這邊填入www.XXX.com 即可
$mail->Port = 25; //ServerZoo主機的郵件伺服器port為 25

// 信件內容的編碼方式
$mail->CharSet = "utf-8";

// 信件處理的編碼方式
$mail->Encoding = "base64";

// SMTP 驗證的使用者資訊
$mail->Username = "contact@adoptadoggie.org";  // 此處為驗証電子郵件帳號,就是您在ServerZoo主機上新增的電子郵件帳號，＠後面請務必一定要打。
$mail->Password = "contact@tw100";  //此處為上方電子郵件帳號的密碼 (一定要正確不然會無法寄出)

// 信件內容設定
$mail->From = "cloud@adoptadoggie.org"; //此處為寄出後收件者顯示寄件者的電子郵件 (請設成與上方驗証電子郵件一樣的位址)
$mail->FromName = "系統測試"; //此處為寄出後收件者顯示寄件者的名稱
$mail->Subject = "PHPMailer寄信測試標題"; //此處為寄出後收件者顯示寄件者的電子郵件標題
$mail->Body = "這是一封測是信件哦!";   //信件內容
$mail->IsHTML(true);

// 收件人
$mail->AddAddress("cloudlin322@gmail.com", "XXX系統通知信"); //此處為收件者的電子信箱及顯示名稱

// 顯示訊息
if(!$mail->Send()) {
echo "Mail error: " . $mail->ErrorInfo;
}else {
echo "Mail sent";
}
?>
