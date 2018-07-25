<?php
//**********************************************
//	字串處理 function
//**********************************************	
	function is_email ($email, $checkDNS = false) {
		$index = strrpos($email,'@');
	
		if ($index === false)       return false;   //  No at-sign
		if ($index === 0)           return false;   //  No local part
		if ($index > 64)            return false;   //  Local part too long
	
		$localPart      = substr($email, 0, $index);
		$domain         = substr($email, $index + 1);
		$domainLength   = strlen($domain);
	
		if ($domainLength === 0)    return false;   //  No domain part
		if ($domainLength > 255)    return false;   //  Domain part too long
		
		if (preg_match('/^\\.|\\.\\.|\\.$/', $localPart) > 0)               return false;   //  Dots in wrong place
		
		if (preg_match('/^"(?:.)*"$/', $localPart) > 0) {
			//  Local part is a quoted string
			if (preg_match('/(?:.)+[^\\\\]"(?:.)+/', $localPart) > 0)   return false;   //  Unescaped quote character inside quoted string
		} else {
			if (preg_match('/[ @\\[\\]\\\\",]/', $localPart) > 0)
				//  Check all excluded characters are escaped
				$stripped = preg_replace('/\\\\[ @\\[\\]\\\\",]/', '', $localPart);
			if (preg_match('/[ @\\[\\]\\\\",]/', $stripped) > 0)        return false;   //  Unquoted excluded characters
		}
	
		//  Now let's check the domain part...
		if (preg_match('/^\\[(.)+]$/', $domain) === 1) {
			//  It's an address-literal
			$addressLiteral = substr($domain, 1, $domainLength - 2);
			$matchesIP      = array();
	
			//  Extract IPv4 part from the end of the address-literal (if there is one)
			if (preg_match('/\\b(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/', $addressLiteral, $matchesIP) > 0) {
				$index = strrpos($addressLiteral, $matchesIP[0]);
	
				if ($index === 0) {
					//  Nothing there except a valid IPv4 address, so...
					return true;
				} else {
					//  Assume it's an attempt at a mixed address (IPv6 + IPv4)
					if ($addressLiteral[$index - 1] !== ':')            return false;   //  Character preceding IPv4 address must be ':'
					if (substr($addressLiteral, 0, 5) !== 'IPv6:')      return false;   //  RFC5321 section 4.1.3
	
					$IPv6 = substr($addressLiteral, 5, ($index ===7) ? 2 : $index - 6);
					$groupMax = 6;
				}
			} else {
				//  It must be an attempt at pure IPv6
				if (substr($addressLiteral, 0, 5) !== 'IPv6:')          return false;   //  RFC5321 section 4.1.3
				$IPv6 = substr($addressLiteral, 5);
				$groupMax = 8;
			}
	
			$groupCount = preg_match_all('/^[0-9a-fA-F]{0,4}|\\:[0-9a-fA-F]{0,4}|(.)/', $IPv6, $matchesIP);
			$index      = strpos($IPv6,'::');
	
			if ($index === false) {
				//  We need exactly the right number of groups
				if ($groupCount !== $groupMax)                          return false;   //  RFC5321 section 4.1.3
			} else {
				if ($index !== strrpos($IPv6,'::'))                     return false;   //  More than one '::'
				$groupMax = ($index === 0 || $index === (strlen($IPv6) - 2)) ? $groupMax : $groupMax - 1;
				if ($groupCount > $groupMax)                            return false;   //  Too many IPv6 groups in address
			}
	
			//  Check for unmatched characters
			array_multisort($matchesIP[1], SORT_DESC);
			if ($matchesIP[1][0] !== '')                                    return false;   //  Illegal characters in address
	
			//  It's a valid IPv6 address, so...
			return true;
		} else {
			//  It's a domain name...
			$matches    = array();
			$groupCount = preg_match_all('/(?:[0-9a-zA-Z][0-9a-zA-Z-]{0,61}[0-9a-zA-Z]|[a-zA-Z])(?:\\.|$)|(.)/', $domain, $matches);
			$level      = count($matches[0]);
	
			if ($level == 1)                                            return false;   //  Mail host can't be a TLD
	
			$TLD = $matches[0][$level - 1];
			if (substr($TLD, strlen($TLD) - 1, 1) === '.')              return false;   //  TLD can't end in a dot
			if (preg_match('/^[0-9]+$/', $TLD) > 0)                     return false;   //  TLD can't be all-numeric
	
			//  Check for unmatched characters
			array_multisort($matches[1], SORT_DESC);
			if ($matches[1][0] !== '')                          return false;   //  Illegal characters in domain, or label longer than 63 characters
	
			//  Check DNS?
			if ($checkDNS && function_exists('checkdnsrr')) {
				if (!(checkdnsrr($domain, 'A') || checkdnsrr($domain, 'MX'))) {
					return false;   //  Domain doesn't actually exist
				}
			}
	
			//  Eliminate all other factors, and the one which remains must be the truth.
			//      (Sherlock Holmes, The Sign of Four)
			return true;
		}
	}
	function format_data($str, $type) {
		if($type=='text') {
			$str = htmlspecialchars( $str );
			$str = strip_tags( $str );
			$str = addslashes( $str );	
			return $str;
		}elseif($type=='content') {
			$str = addslashes( $str );	
			return $str;
		}elseif($type=='int') {
			if($str && !ereg ("^([0-9]){1,}$", $str)) {
				js_a_l('資料格式錯誤', 'back');exit;
			}
			return $str;
		}elseif($type=='number') {
			if($str && !is_numeric($str)) {
				js_a_l('資料格式錯誤', 'back');exit;
			}
			return $str;
		}elseif($type=='date') {
			$date = explode("-", $str);
			if(!checkdate($date[1], $date[2], $date[0])) {
				js_a_l('日期格式錯誤', 'back');exit;
			}
			return $str;
		}elseif($type=='email') {
			if(!is_email($str, true)) {
				return false;	
			}else {
				return $str;	
			}
		}
	}
	//big5 string substr
	function cnsubstr($str, $l2, $l3=0) {
	  	$I2 = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/";
	  	preg_match_all($I2, $str, $I3);
	  	if (count($I3[0]) - $l3 > $l2) {
			return implode('',array_slice($I3[0], $l3, $l2))."...";
	  	}
		return implode('',array_slice($I3[0], $l3, $l2));
	}
	//substr
	function string_len($str) {
		$this->str_len = mb_strlen($str, "UTF-8");
	}	
	//編碼轉換
	function big52utf8($str) {
		$blen = strlen($str);
		
		for($i=0; $i<$blen; $i++) {
		
			$sbit = ord(substr($str, $i, 1));
			//echo $sbit;
			//echo "<br>";
			if ($sbit < 129) {
				$this->out_string.=substr($str,$i,1);
			}elseif ($sbit > 128 && $sbit < 255) {
				$new_word = iconv("BIG5", "UTF-8", substr($str,$i,2));
				$this->out_string.=($new_word=="")?"?":$new_word;
				$i++;
			}
		}
		return $this->out_string;
	}	
	
	function auto_checksum($len){
		srand();
		$UpdateKey_a=array("2","3","4","5","6","7","8","9","A","B","C","D","E","F","G","H","J","K","L","M","N","P","Q","R","S","T","U","V","W","X","Y","Z");
		for($i=0;$i<$len;$i++){
			$run=rand(0,count($UpdateKey_a)-1);
			$UpdateKey.=$UpdateKey_a[$run];
		}
		return $UpdateKey;
	}
?>