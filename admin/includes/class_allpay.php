<?php
class allpay {
	//init
	function allpay() {
		$this->allpay_url_allinone = 'https://payment.allpay.com.tw/Cashier/AioCheckOut';
		$this->allpay_url_credit   = 'https://pay.allpay.com.tw/payment/gateway';
		$this->allpay_url_webatm   = 'https://pay.allpay.com.tw/payment/gateway';
		$this->allpay_url_atm      = 'https://pay.allpay.com.tw/payment/Srv/gateway';
		$this->allpay_url_cvs      = 'https://pay.allpay.com.tw/payment/Srv/gateway';
		$this->allpay_url_alipay   = 'https://pay.allpay.com.tw/payment/gateway';
		$this->allpay_url_tenpay   = 'https://pay.allpay.com.tw/payment/gateway';
		$this->MerchantID          = '1039504';
		$this->HashKey             = "7iaW4jEPoYuKALeG";
		$this->HashIV              = "sVezfs7H0iyYNowr";
	}
	//Padding PKCS7的 Function
	function addpadding($string, $blocksize=16) {
		$len = strlen($string);
		$pad = $blocksize - ($len % $blocksize);
		$string .= str_repeat(chr($pad), $pad);
		return $string;
	}	
	//AES與base64編碼 之加密Function 
	function encrypt($inputValue) {
		$str = trim(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $this->HashKey, $this->addpadding($inputValue), MCRYPT_MODE_CBC, $this->HashIV)));
		return $str;
	}
	//Padding PKCS7解密
	function strippadding($string) {
		$slast  = ord(substr($string, -1));
		$slastc = chr($slast);
		$pcheck = substr($string, -$slast);
		
		if (preg_match("/$slastc{" . $slast . "}/", $string)) {
			$string = substr($string, 0, strlen($string) - $slast);
			return $string;
		} else {
			return false;
		}
	}
	//AES與base64編碼解密
	function decrypt($sValue) {
		$sValue = str_replace(' ', '+', $sValue);
		$str    = $this->strippadding(mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $this->HashKey, base64_decode($sValue), MCRYPT_MODE_CBC, $this->HashIV));
		return $str;
	}
	//return data
	function allpay_return($XMLData) {
		//解密資料
		$rs = $this->decrypt($XMLData);
		//回傳結果解密
		return simplexml_load_string($rs);	
	}
	//All in one
	function allinone($TradeDesc, $ReturnURL, $ClientBackURL, $order_id, $total_price, $prod_list, $pay_type, $prod_name, $prod_counts, $prod_price, $Email, $PhoneNo, $UserName) {
		$MerchantTradeDate = date("Y/m/d H:i:s");
		$form_array = array(
			"MerchantID" => $this->MerchantID,
			"MerchantTradeNo" => $order_id,
			"MerchantTradeDate" => date("Y/m/d H:i:s"),
			"PaymentType" => "aio",
			"TotalAmount" => $total_price,
			"TradeDesc" => $TradeDesc,
			"ItemName" => $prod_list,
			"ReturnURL" => $ReturnURL,
			"ChoosePayment" => $pay_type,
			"ClientBackURL" => $ClientBackURL
		);
		if($pay_type=='Alipay') {
			$form_array['AlipayItemName']   = $prod_name;
			$form_array['AlipayItemCounts'] = $prod_counts;
			$form_array['AlipayItemPrice']  = $prod_price;
			$form_array['Email']            = $Email;
			$form_array['PhoneNo']          = $PhoneNo;
			$form_array['UserName']         = $UserName;
		}
		ksort($form_array);
		$encode_str = "HashKey=" . $this->HashKey . "&" . urldecode(http_build_query($form_array)) . "&HashIV=" . $this->HashIV;
		$encode_str = urlencode($encode_str);
		$encode_str = strtolower($encode_str);
		$CheckMacValue = strtoupper(md5($encode_str));
		
		$form_array["CheckMacValue"] = $CheckMacValue;
		?><form method="post" action="<?=$this->allpay_url_allinone?>" name="allpay_form" id="allpay_form">
        <?php
		foreach ($form_array as $key => $val) {
			echo "<input type='hidden' name='" . $key . "' value='" . $val . "'><BR>";
		}
		?>
        <!--<input type="submit" value="送出">-->
		</form><?php	
	}
	//Credit
	function credit_xml_base() {
		$xml = "
		<Root>
		<Data>
		<MerchantID>[+++MerchantID+++]</MerchantID>
		<MerchantTradeNo>[+++MerchantTradeNo+++]</MerchantTradeNo>
		<MerchantTradeDate>[+++MerchantTradeDate+++]</MerchantTradeDate>
		<TotalAmount>[+++TotalAmount+++]</TotalAmount>
		<TradeDesc>[+++TradeDesc+++]</TradeDesc>
		<CardNo>[+++CardNo+++]</CardNo>
		<CardValidMM>[+++CardValidMM+++]</CardValidMM>
		<CardValidYY>[+++CardValidYY+++]</CardValidYY>
		<CardCVV2>[+++CardCVV2+++]</CardCVV2>
		<UnionPay>[+++UnionPay+++]</UnionPay>
		<Installment>[+++Installment+++]</Installment>
		<ThreeD>[+++ThreeD+++]</ThreeD>
		<CharSet>[+++CharSet+++]</CharSet>
		<Enn>[+++Enn+++]</Enn>
		<BankOnly>[+++BankOnly+++]</BankOnly>
		<Redeem>[+++Redeem+++]</Redeem>
		<ReturnURL>[+++ReturnURL+++]</ReturnURL>
		<ServerReplyURL>[+++ServerReplyURL+++]</ServerReplyURL>
		<ClientBackURL>[+++ClientBackURL+++]</ClientBackURL>
		<Remark>[+++Remark+++]</Remark>
		</Data>
		</Root> ";
		//為避免產生的xml檔案包含空白、斷行，所以要進行斷行、空白刪除動作
		$xml = trim($xml);
		$xml = str_replace("\t", "", $xml);
		$xml = str_replace("\r\n", "", $xml);
		$xml = str_replace("\r", "", $xml);
		$xml = str_replace("\n", "", $xml);
		$xml = str_replace(" ", "", $xml);
		$xml = "<?xml version='1.0' encoding='utf-8' ?>" . $xml;
		return $xml;
	}
	function credit($TradeDesc, $ReturnURL, $ClientBackURL, $order_id, $total_price, $prod_list) {		
		$PaymentType       = 'CREDIT';  //CREDIT為固定參數		
		$MerchantTradeNo   = $order_id;  //廠商交易編號(不可重複)		
		$MerchantTradeDate = date('Y/m/d h:i:s');  //廠商交易時間		
		$TotalAmount       = $total_price; //交易金額		
		$TradeDesc         = urlencode($TradeDesc);//交易描述，要使用UTF8格式進行urlencode		
		$CardNo            = 0;	//信用卡卡號。(若要在AllPay顯示信用卡頁讓使用者輸入的話，請放0。 連同下面的CardValidMM、 CardValidYY及 CardCVV2也都請放0)		
		$CardValidMM       = 0;	//信用卡有效月份		
		$CardValidYY       = 0;	//信用卡有效年份		
		$CardCVV2          = 0;	//信用卡背後末三碼		
		$UnionPay          = '0';  //是否為銀聯卡。否-請帶0，是-請帶1。		
		$Installment       = '0';	//分期期數，若不分期請帶0		
		$ThreeD            = '0';  //是否使用3D驗證。使用-請帶1，不使用-請帶0。		
		$CharSet           = 'utf-8';	//中文編碼格式： utf-8或big5。本系統採用 utf-8 編碼格式。		
		$Enn               = '';	//英文交易時，請帶e，否則請放空值。		
		$BankOnly          = '';	//若無限制交易的銀行卡別，請放空值。		
		$Redeem            = '';	//請放空值。設為Y時，會進入紅利折抵的交易流程。		
		$ReturnURL         = urlencode($ReturnURL);	//接收授權結果通知網址(以client post方式返回)當這個參數有值時，系統不會停留在allpay的授權結果頁，而會直接將加密過後的授權結果轉導到ReturnURL。        		
		$ServerReplyURL    = urlencode($ReturnURL);  /*交易結束後歐付寶會以server post方式回傳付款結果到此網址，回傳的時間點會比 ReplyURL早。請先利用 CharSet 格式進行 UrlEncode*/		
		$ClientBackURL     = urlencode($ClientBackURL);	//回商家的網址，請先利用 CharSet 格式進行 UrlEncode
		$Remark            = urlencode($prod_list);	//備註，可空白，請先利用 CharSet 格式進行 UrlEncode    
		//欲傳遞的參數要組成xml
		$XMLData = $this->credit_xml_base(); 
		$XMLData= str_replace("[+++MerchantID+++]", $this->MerchantID, $XMLData); 
		$XMLData= str_replace("[+++MerchantTradeNo+++]", $MerchantTradeNo, $XMLData); 
		$XMLData= str_replace("[+++MerchantTradeDate+++]", $MerchantTradeDate, $XMLData);  
		$XMLData= str_replace("[+++TotalAmount+++]", $TotalAmount, $XMLData);  
		$XMLData= str_replace("[+++TradeDesc+++]", $TradeDesc, $XMLData);  
		$XMLData= str_replace("[+++CardNo+++]", $CardNo, $XMLData);  
		$XMLData= str_replace("[+++CardValidMM+++]", $CardValidMM, $XMLData);  
		$XMLData= str_replace("[+++CardValidYY+++]", $CardValidYY, $XMLData);  
		$XMLData= str_replace("[+++CardCVV2+++]", $CardCVV2, $XMLData);  
		$XMLData= str_replace("[+++UnionPay+++]", $UnionPay, $XMLData);  
		$XMLData= str_replace("[+++Installment+++]", $Installment, $XMLData);  
		$XMLData= str_replace("[+++ThreeD+++]", $ThreeD, $XMLData);  
		$XMLData= str_replace("[+++CharSet+++]", $CharSet, $XMLData);  
		$XMLData= str_replace("[+++Enn+++]", $Enn, $XMLData);  
		$XMLData= str_replace("[+++BankOnly+++]", $BankOnly, $XMLData);  
		$XMLData= str_replace("[+++Redeem+++]", $Redeem, $XMLData); 
		$XMLData= str_replace("[+++ReturnURL+++]", $ReturnURL, $XMLData);  
		$XMLData= str_replace("[+++ServerReplyURL+++]", $ServerReplyURL, $XMLData);   
		$XMLData= str_replace("[+++ClientBackURL+++]", $ClientBackURL, $XMLData);   
		$XMLData= str_replace("[+++Remark+++]", $Remark, $XMLData);   
		//echo '加密前: '.$XMLData.'<br>';
		//將 XMLData加密
		$Encode_XMLData = $this->encrypt($XMLData);
		
		$p = "
		<form name='alipay_form' id='allpay_form' method='post' action='".$this->allpay_url_credit."'>
		<input type='hidden' name='MerchantID' value='".$this->MerchantID."'>
		<input type='hidden' name='PaymentType' value='$PaymentType'>    
		<input type='hidden' name='XMLData' value='$Encode_XMLData'> 
		<input type='submit'> 
		</form>";
		echo $p;
	}
	//WebATM
	function webatm_xml_base() {
		$xml = "
		<Root>
		<Data>
		<MerchantID>[+++MerchantID+++]</MerchantID>
		<MerchantTradeNo>[+++MerchantTradeNo+++]</MerchantTradeNo>
		<MerchantTradeDate>[+++MerchantTradeDate+++]</MerchantTradeDate>
		<TotalAmount>[+++TotalAmount+++]</TotalAmount>
		<TradeDesc>[+++TradeDesc+++]</TradeDesc>
		<TradeCategory>[+++TradeCategory+++]</TradeCategory>
		<BankName>[+++BankName+++]</BankName>
		<CharSet>[+++CharSet+++]</CharSet>
		<ReplyURL>[+++ReplyURL+++]</ReplyURL>
		<BackURL>[+++BackURL+++]</BackURL>
		<Remark>[+++Remark+++]</Remark>
		<ServerReplyURL>[+++ServerReplyURL+++]</ServerReplyURL>
		</Data>
		</Root> ";
		//為避免產生的xml檔案包含空白、斷行，所以要進行斷行、空白刪除動作
		$xml = trim($xml);
		$xml = str_replace("\t", "", $xml);
		$xml = str_replace("\r\n", "", $xml);
		$xml = str_replace("\r", "", $xml);
		$xml = str_replace("\n", "", $xml);
		$xml = str_replace(" ", "", $xml);
		$xml = "<?xml version='1.0' encoding='utf-8' ?>" . $xml;
		return $xml;
	}
	function webatm($TradeDesc, $ReturnURL, $ClientBackURL, $order_id, $total_price, $prod_list) {
		$PaymentType       = 'WEB_ATM';	//WEB_ATM為固定參數
		$MerchantTradeNo   = $order_id;	//廠商交易編號(不可重複)
		$MerchantTradeDate = date('Y/m/d h:i:s');	//廠商交易時間
		$TotalAmount       = $total_price;	//交易金額1~50000
		$TradeDesc         = urlencode($TradeDesc);	//交易描述，要使用UTF8格式進行urlencode
		$TradeCategory     = '1';	//扣款種類，1：一般扣款
		$BankName          = 'ALL';	//請參考銀行代碼一覽表，指定銀行參數，將直接將畫面轉至該銀行
		$CharSet           = 'utf-8';	//中文編碼格式： utf-8或big5。本系統採用 utf-8 編碼格式。
		$ReplyURL          = urlencode($ClientBackURL);	//交易結束後以client端方式將頁面導回到廠商設定的網址。請先利用 CharSet 格式進行 UrlEncode
		$BackURL           = urlencode($ClientBackURL);	//回上一頁的網址，請先利用 CharSet 格式進行 UrlEncod
		$Remark            = urlencode($prod_list);	//備註，可空白，請先利用 CharSet 格式進行 UrlEncode    
		$ServerReplyURL    = urlencode($ReturnURL);	//交易結束後歐付寶會以server post方式回傳付款結果到此網址，回傳的時間點會比 ReplyURL早。請先利用 CharSet 格式進行 UrlEncode
		//欲傳遞的參數要組成xml
		$XMLData = $this->webatm_xml_base();   
		$XMLData= str_replace("[+++MerchantID+++]", $this->MerchantID, $XMLData); 
		$XMLData= str_replace("[+++MerchantTradeNo+++]", $MerchantTradeNo, $XMLData); 
		$XMLData= str_replace("[+++MerchantTradeDate+++]", $MerchantTradeDate, $XMLData);  
		$XMLData= str_replace("[+++TotalAmount+++]", $TotalAmount, $XMLData);  
		$XMLData= str_replace("[+++TradeDesc+++]", $TradeDesc, $XMLData);  
		$XMLData= str_replace("[+++TradeCategory+++]", $TradeCategory, $XMLData);  
		$XMLData= str_replace("[+++BankName+++]", $BankName, $XMLData);  
		$XMLData= str_replace("[+++CharSet+++]", $CharSet, $XMLData);  
		$XMLData= str_replace("[+++ReplyURL+++]", $ReplyURL, $XMLData);   
		$XMLData= str_replace("[+++BackURL+++]", $BackURL, $XMLData);   
		$XMLData= str_replace("[+++Remark+++]", $Remark, $XMLData);   
		$XMLData= str_replace("[+++ServerReplyURL+++]", $ServerReplyURL, $XMLData);  
		//echo '加密前: '.$XMLData.'<br>';
		//將 XMLData加密
		$Encode_XMLData = $this->encrypt($XMLData);
		
		$p = "
		<form name='allpay_form' id='allpay_form' method='post' action='".$this->allpay_url_webatm."'>
		<input type='hidden' name='MerchantID' value='".$this->MerchantID."'>
		<input type='hidden' name='PaymentType' value='$PaymentType'>    
		<input type='hidden' name='XMLData' value='$Encode_XMLData'> 
		<input type='submit'> 
		</form>";
		echo $p;
	}
	//Alipay
	function alipay_xml_base() {
		$xml = "
		<Root>
		<Data>
		<MerchantID>[+++MerchantID+++]</MerchantID>
		<MerchantTradeNo>[+++MerchantTradeNo+++]</MerchantTradeNo>
		<MerchantTradeDate>[+++MerchantTradeDate+++]</MerchantTradeDate>
		<TradeAmount>[+++TradeAmount+++]</TradeAmount>
		<ItemName>[+++ItemName+++]</ItemName>
		<ItemCounts>[+++ItemCounts+++]</ItemCounts>
		<ItemPrice>[+++ItemPrice+++]</ItemPrice>
		<ServerReplyURL>[+++ServerReplyURL+++]</ServerReplyURL>
		<ClientReplyURL>[+++ClientReplyURL+++]</ClientReplyURL>
		<Remark>[+++Remark+++]</Remark>
		<Email>[+++Email+++]</Email>
		<PhoneNo>[+++PhoneNo+++]</PhoneNo>
		<UserName>[+++UserName+++]</UserName>
		</Data>
		</Root> ";
		//為避免產生的xml檔案包含空白、斷行，所以要進行斷行、空白刪除動作
		$xml = trim($xml);
		$xml = str_replace("\t", "", $xml);
		$xml = str_replace("\r\n", "", $xml);
		$xml = str_replace("\r", "", $xml);
		$xml = str_replace("\n", "", $xml);
		$xml = str_replace(" ", "", $xml);
		$xml = "<?xml version='1.0' encoding='utf-8' ?>" . $xml;
		return $xml;
	}
	function alipay($TradeDesc, $ServerReplyURL, $ClientReplyURL, $order_id, $total_price, $prod_name, $prod_counts, $prod_price, $Email, $PhoneNo, $UserName) {
		$PaymentType       = 'ALIPAY';	//ALIPAY為固定參數
		$MerchantTradeNo   = $order_id;	//廠商交易編號(不可重複)
		$MerchantTradeDate = date('Y/m/d h:i:s');	//廠商交易時間
		$TradeAmount       = $total_price;	//交易金額
		$ItemName          = urlencode($prod_name);	//商品名稱，要使用UTF8格式進行urlencode
		$ItemCounts        = urlencode($prod_counts);	//商品名稱，要使用UTF8格式進行urlencode
		$ItemPrice         = urlencode($prod_price);	//商品名稱，要使用UTF8格式進行urlencode。
		$ServerReplyURL    = urlencode($ServerReplyURL);	//交易結束後，server端回傳付款結果的網址。請先利用 CharSet 格式進行 UrlEncode
		$ClientReplyURL    = urlencode($ClientReplyURL);	//交易結束後，頁面要導回的網址
		$Remark            = urlencode($prod_list);	//備註，可空白，請先利用 CharSet 格式進行 UrlEncode    
		$Email             = $Email;	//購買人信箱
		$PhoneNo           = $PhoneNo;	//購買人電話
		$UserName          = $UserName;	//購買人姓名
		//欲傳遞的參數要組成xml
		$XMLData = $this->alipay_xml_base();   
		$XMLData= str_replace("[+++MerchantID+++]", $this->MerchantID, $XMLData); 
		$XMLData= str_replace("[+++MerchantTradeNo+++]", $MerchantTradeNo, $XMLData); 
		$XMLData= str_replace("[+++MerchantTradeDate+++]", $MerchantTradeDate, $XMLData);  
		$XMLData= str_replace("[+++TradeAmount+++]", $TradeAmount, $XMLData);  
		$XMLData= str_replace("[+++ItemName+++]", $ItemName, $XMLData);  
		$XMLData= str_replace("[+++ItemCounts+++]", $ItemCounts, $XMLData);  
		$XMLData= str_replace("[+++ItemPrice+++]", $ItemPrice, $XMLData);  
		$XMLData= str_replace("[+++ServerReplyURL+++]", $ServerReplyURL, $XMLData);   
		$XMLData= str_replace("[+++ClientReplyURL+++]", $ClientReplyURL, $XMLData);  
		$XMLData= str_replace("[+++Remark+++]", $Remark, $XMLData);   
		$XMLData= str_replace("[+++Email+++]", $Email, $XMLData);  
		$XMLData= str_replace("[+++PhoneNo+++]", $PhoneNo, $XMLData);  
		$XMLData= str_replace("[+++UserName+++]", $UserName, $XMLData);   
		//echo '加密前: '.$XMLData.'<br>';
		//將 XMLData加密
		$Encode_XMLData = $this->encrypt($XMLData);
		
		$p = "
		<form name='allpay_form' id='allpay_form' method='post' action='".$this->allpay_url_alipay."'>
		<input type='hidden' name='MerchantID' value='".$this->MerchantID."'>
		<input type='hidden' name='PaymentType' value='$PaymentType'>    
		<input type='hidden' name='XMLData' value='$Encode_XMLData'> 
		<input type='submit'> 
		</form>";
		echo $p;
	}
	//Tenpay
	function tenpay_xml_base() {
		$xml = "
		<Root>
		<Data>
		<MerchantID>[+++MerchantID+++]</MerchantID>
		<MerchantTradeNo>[+++MerchantTradeNo+++]</MerchantTradeNo>
		<MerchantTradeDate>[+++MerchantTradeDate+++]</MerchantTradeDate>
		<TradeAmount>[+++TradeAmount+++]</TradeAmount>
		<ExpireTime>[+++ExpireTime+++]</ExpireTime>
		<ServerReplyURL>[+++ServerReplyURL+++]</ServerReplyURL>
		<ClientReplyURL>[+++ClientReplyURL+++]</ClientReplyURL>
		<Remark>[+++Remark+++]</Remark>
		</Data>
		</Root> ";
		//為避免產生的xml檔案包含空白、斷行，所以要進行斷行、空白刪除動作
		$xml = trim($xml);
		$xml = str_replace("\t", "", $xml);
		$xml = str_replace("\r\n", "", $xml);
		$xml = str_replace("\r", "", $xml);
		$xml = str_replace("\n", "", $xml);
		$xml = str_replace(" ", "", $xml);
		$xml = "<?xml version='1.0' encoding='utf-8' ?>" . $xml;
		return $xml;
	}
	function tenpay($TradeDesc, $ServerReplyURL, $ClientReplyURL, $order_id, $total_price, $prod_list) {
		$PaymentType       = 'TENPAY';	//ALIPAY為固定參數
		$MerchantTradeNo   = $order_id;	//廠商交易編號(不可重複)
		$MerchantTradeDate = date('Y/m/d h:i:s');	//廠商交易時間
		$TradeAmount       = $total_price;	//交易金額de    
		$ExpireTime        = '';	//付款截止時間，格式為yyyy/MM/dd HH:mm:ss。只能帶入送出交易後的72小時(三天)之內時間。不填則預設為送出交易後
		$ServerReplyURL    = urlencode($ServerReplyURL);	//交易結束後，server端回傳付款結果的網址。請先利用 CharSet 格式進行 UrlEncode
		$ClientReplyURL    = urlencode($ClientReplyURL);	//交易結束後，頁面要導回的網址
		$Remark            = urlencode($prod_list);	//備註，可空白，請先利用 CharSet 格式進行 UrlEnco
		//欲傳遞的參數要組成xml
		$XMLData = $this->tenpay_xml_base();   
		$XMLData= str_replace("[+++MerchantID+++]", $this->MerchantID, $XMLData); 
		$XMLData= str_replace("[+++MerchantTradeNo+++]", $MerchantTradeNo, $XMLData); 
		$XMLData= str_replace("[+++MerchantTradeDate+++]", $MerchantTradeDate, $XMLData);  
		$XMLData= str_replace("[+++TradeAmount+++]", $TradeAmount, $XMLData);  
		$XMLData= str_replace("[+++ExpireTime+++]", $ExpireTime, $XMLData); 
		$XMLData= str_replace("[+++ServerReplyURL+++]", $ServerReplyURL, $XMLData);   
		$XMLData= str_replace("[+++ClientReplyURL+++]", $ClientReplyURL, $XMLData);  
		$XMLData= str_replace("[+++Remark+++]", $Remark, $XMLData);   
		//echo '加密前: '.$XMLData.'<br>';
		//將 XMLData加密
		$Encode_XMLData = $this->encrypt($XMLData);
		
		$p = "
		<form name='allpay_form' id='allpay_form' method='post' action='".$this->allpay_url_tenpay."'>
		<input type='hidden' name='MerchantID' value='".$this->MerchantID."'>
		<input type='hidden' name='PaymentType' value='$PaymentType'>    
		<input type='hidden' name='XMLData' value='$Encode_XMLData'> 
		<input type='submit'> 
		</form>";
		echo $p;
	}
	//ATM
	function atm_xml_base() {
		$xml = "
		<Root>
		<Data>
		<MerchantID>[+++MerchantID+++]</MerchantID>
		<MerchantTradeNo>[+++MerchantTradeNo+++]</MerchantTradeNo>
		<MerchantTradeDate>[+++MerchantTradeDate+++]</MerchantTradeDate>
		<TradeAmount>[+++TradeAmount+++]</TradeAmount>
		<ExpireDate>[+++ExpireDate+++]</ExpireDate>
		<BankName>[+++BankName+++]</BankName>
		<ReplyURL>[+++ReplyURL+++]</ReplyURL>
		<Remark>[+++Remark+++]</Remark>
		</Data>
		</Root> ";
		//為避免產生的xml檔案包含空白、斷行，所以要進行斷行、空白刪除動作
		$xml = trim($xml);
		$xml = str_replace("\t", "", $xml);
		$xml = str_replace("\r\n", "", $xml);
		$xml = str_replace("\r", "", $xml);
		$xml = str_replace("\n", "", $xml);
		$xml = str_replace(" ", "", $xml);
		$xml = "<?xml version='1.0' encoding='utf-8' ?>" . $xml;
		return $xml;
	}
	function atm($TradeDesc, $ReplyURL, $ClientBackURL, $order_id, $total_price, $prod_list) {		
		$PaymentType       = 'vAccount';  //vAccount為固定參數		
		$MerchantTradeNo   = $order_id;  //廠商交易編號(不可重複)		
		$MerchantTradeDate = date('Y/m/d h:i:s');  //廠商交易時間		
		$TradeAmount       = $total_price; //交易金額 10~100,000		
		$ExpireDate        = '60';	//允許繳費有效天數，最長 60 天		
		$BankName          = 'CHINATRUST';  //銀行代碼		
		$ReplyURL          = urlencode($ReplyURL);  //交易結束後以client端方式將頁面導回到廠商設定的網址。請先利用 CharSet 格式進行 UrlEncode		
		$Remark            = urlencode($prod_list);	//備註，可空白，請先利用 CharSet 格式進行 UrlEncode
		//欲傳遞的參數要組成xml
		$XMLData = $this->atm_xml_base(); 
		$XMLData= str_replace("[+++MerchantID+++]", $this->MerchantID, $XMLData); 
		$XMLData= str_replace("[+++MerchantTradeNo+++]", $MerchantTradeNo, $XMLData); 
		$XMLData= str_replace("[+++MerchantTradeDate+++]", $MerchantTradeDate, $XMLData);  
		$XMLData= str_replace("[+++TradeAmount+++]", $TradeAmount, $XMLData);  
		$XMLData= str_replace("[+++ExpireDate+++]", $ExpireDate, $XMLData);  
		$XMLData= str_replace("[+++BankName+++]", $BankName, $XMLData);  
		$XMLData= str_replace("[+++ReplyURL+++]", $ReplyURL, $XMLData); 
		$XMLData= str_replace("[+++Remark+++]", $Remark, $XMLData);   
		//echo '加密前: '.$XMLData.'<br>';
		//將 XMLData加密
		$Encode_XMLData = $this->encrypt($XMLData);
		
		$PostData = 'MerchantID='.$this->MerchantID.'&PaymentType='.$PaymentType.'&XMLData='.$Encode_XMLData;
		// 以GET方式背景取號 (也可以使用curl)	
		$ch = curl_init();
		// 設定擷取的URL網址
		curl_setopt($ch, CURLOPT_URL, $this->allpay_url_atm.'?'.$PostData); //GET
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		$strAuth = curl_exec($ch);
		curl_close($ch);
		//print_r($strAuth);exit; //輸出結果
		
		$this->atm_getcode($strAuth);
		js_a_l('', $ClientBackURL);
		exit;
	}
	//取得ATM繳費虛擬帳號
	function atm_getcode($result_data) {
		$obj_order  = new mysql_page();
		$table_name = Proj_Name.'_orderlist';
		
		$result_data = simplexml_load_string($result_data);	
		if($result_data->Data->RtnCode==2) {
			$pay_info = "交易訊息: ".$result_data->Data->RtnMsg." | AllPay交易編號: ".$result_data->Data->TradeNo." | 交易時間: ".$result_data->Data->TradeDate." | 繳費銀行代碼: ".$result_data->Data->BankCode." | 繳費虛擬帳號: ".$result_data->Data->vAccount." | 繳費期限: ".$result_data->Data->ExpireDate.'<br>';
			$query = "update $table_name set pay_info='$pay_info' where Fullkey='".$result_data->Data->MerchantTradeNo."'";	
			$obj_order->run_mysql($query);
		}else {
			$pay_info = "交易狀態: ".$result_data->Data->RtnCode." | 交易訊息: ".$result_data->Data->RtnMsg.'<br>';
			$query = "update $table_name set pay_info='$pay_info' where Fullkey='".$result_data->Data->MerchantTradeNo."'";	
			$obj_order->run_mysql($query);
		}
	}
	//CVS
	function cvs_xml_base() {
		$xml = "
		<Root>
		<Data>
		<MerchantID>[+++MerchantID+++]</MerchantID>
		<MerchantTradeNo>[+++MerchantTradeNo+++]</MerchantTradeNo>
		<MerchantTradeDate>[+++MerchantTradeDate+++]</MerchantTradeDate>
		<TradeAmount>[+++TradeAmount+++]</TradeAmount>
		<TradeType>[+++TradeType+++]</TradeType>
		<TradeDesc>[+++TradeDesc+++]</TradeDesc>
		<Desc_1>[+++Desc_1+++]</Desc_1>
		<Desc_2>[+++Desc_2+++]</Desc_2>
		<Desc_3>[+++Desc_3+++]</Desc_3>
		<Desc_4>[+++Desc_4+++]</Desc_4>
		<ReplyURL>[+++ReplyURL+++]</ReplyURL>
		<Remark>[+++Remark+++]</Remark>
		</Data>
		</Root> ";
		//為避免產生的xml檔案包含空白、斷行，所以要進行斷行、空白刪除動作
		$xml = trim($xml);
		$xml = str_replace("\t", "", $xml);
		$xml = str_replace("\r\n", "", $xml);
		$xml = str_replace("\r", "", $xml);
		$xml = str_replace("\n", "", $xml);
		$xml = str_replace(" ", "", $xml);
		$xml = "<?xml version='1.0' encoding='utf-8' ?>" . $xml;
		return $xml;
	}
	function cvs($TradeDesc, $ReplyURL, $ClientBackURL, $order_id, $total_price, $prod_list, $CVS_type) {		
		$PaymentType       = $CVS_type;  //超商代碼(FAMIPORT、OK、萊爾富)：CVS_CVS、超商代碼(7-11 ibon)：CVS_IBON
		$MerchantTradeNo   = $order_id;  //廠商交易編號(不可重複)		
		$MerchantTradeDate = date('Y/m/d h:i:s');  //廠商交易時間		
		$TradeAmount       = $total_price; //交易金額 30 ~ 20,000		
		$TradeType         = $CVS_type;	//請帶跟Input參數的 PaymentType相同
		$TradeDesc         = urlencode($TradeDesc);  //交易描述		
		$Desc_1            = urlencode($Desc_1);  //交易描述		
		$Desc_2            = urlencode($Desc_2);  //交易描述		
		$Desc_3            = urlencode($Desc_3);  //交易描述		
		$Desc_4            = urlencode($Desc_4);  //交易描述		
		$ReplyURL          = urlencode($ClientBackURL);  //交易結束後以client端方式將頁面導回到廠商設定的網址。請先利用 CharSet 格式進行 UrlEncode		
		$Remark            = urlencode($prod_list);	//備註，可空白，請先利用 CharSet 格式進行 UrlEncode
		//欲傳遞的參數要組成xml
		$XMLData = $this->cvs_xml_base(); 
		$XMLData= str_replace("[+++MerchantID+++]", $this->MerchantID, $XMLData); 
		$XMLData= str_replace("[+++MerchantTradeNo+++]", $MerchantTradeNo, $XMLData); 
		$XMLData= str_replace("[+++MerchantTradeDate+++]", $MerchantTradeDate, $XMLData);  
		$XMLData= str_replace("[+++TradeAmount+++]", $TradeAmount, $XMLData);  
		$XMLData= str_replace("[+++TradeType+++]", $TradeType, $XMLData);  
		$XMLData= str_replace("[+++TradeDesc+++]", $TradeDesc, $XMLData);  
		$XMLData= str_replace("[+++Desc_1+++]", $Desc_1, $XMLData);  
		$XMLData= str_replace("[+++Desc_2+++]", $Desc_2, $XMLData);  
		$XMLData= str_replace("[+++Desc_3+++]", $Desc_3, $XMLData);  
		$XMLData= str_replace("[+++Desc_4+++]", $Desc_4, $XMLData);  
		$XMLData= str_replace("[+++ReplyURL+++]", $ReplyURL, $XMLData); 
		$XMLData= str_replace("[+++Remark+++]", $Remark, $XMLData);   
		//echo '加密前: '.$XMLData.'<br>';
		//將 XMLData加密
		$Encode_XMLData = $this->encrypt($XMLData);
		
		$PostData = 'MerchantID='.$this->MerchantID.'&PaymentType='.$PaymentType.'&XMLData='.$Encode_XMLData;
		// 以GET方式背景取號 (也可以使用curl)	
		$ch = curl_init();
		// 設定擷取的URL網址
		curl_setopt($ch, CURLOPT_URL, $this->allpay_url_cvs.'?'.$PostData); //GET
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		$strAuth = curl_exec($ch);
		curl_close($ch);
		//print_r($strAuth);exit; //輸出結果
		
		$this->cvs_getcode($strAuth);
		js_a_l('', $ClientBackURL);
		exit;
	}
	//取得便利超商繳費代碼
	function cvs_getcode($result_data) {
		$obj_order  = new mysql_page();
		$table_name = Proj_Name.'_orderlist';
		
		$result_data = simplexml_load_string($result_data);	
		if($result_data->Data->RtnCode==10100073) {
			$pay_info = "交易訊息: ".$result_data->Data->RtnMsg." | AllPay交易編號: ".$result_data->Data->TradeNo." | 交易時間: ".$result_data->Data->TradeDate." | 繳費代碼: ".$result_data->Data->PaymentNo." | 繳費期限: ".$result_data->Data->ExpireDate.'<br>';
			$query = "update $table_name set pay_info='$pay_info' where Fullkey='".$result_data->Data->MerchantTradeNo."'";	
			$obj_order->run_mysql($query);
		}else {
			$pay_info = "交易狀態: ".$result_data->Data->RtnCode." | 交易訊息: ".$result_data->Data->RtnMsg.'<br>';
			$query = "update $table_name set pay_info='$pay_info' where Fullkey='".$result_data->Data->MerchantTradeNo."'";	
			$obj_order->run_mysql($query);
		}
	}
}
?>