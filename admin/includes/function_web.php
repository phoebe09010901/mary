<?php
//get web information
function get_web_info( $web_url ) {
	$ch = curl_init();
	$timeout = 300;
	curl_setopt ($ch, CURLOPT_URL, $web_url);
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
	curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, false); 
	curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, false);
	$web_info = curl_exec($ch);
	curl_close($ch);
	
	return $web_info;
}
//get ip address
function get_real_ip(){   
	$ip=false;   
	   
	if(!empty($_SERVER["HTTP_CLIENT_IP"])){   
		$ip=$_SERVER["HTTP_CLIENT_IP"];   
	}   
	if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {   
		$ips=explode (", ", $_SERVER['HTTP_X_FORWARDED_FOR']);   
		if ($ip) { array_unshift($ips, $ip); $ip=FALSE; }   
		for ($i=0; $i < count($ips); $i++) {   
			if (!eregi ("^(10|172.16|192.168).", $ips[$i])) {   
				$ip=$ips[$i];   
				break;   
			}   
		}   
	}   
	return ($ip ? $ip : $_SERVER['REMOTE_ADDR']);   
} 
//hitcount
function hitfun($page_name) {
	$ip     = get_real_ip();
	$query  = "Insert into ".Proj_Name."_hit_counts(hit_page, ip, create_time) values('$page_name', '$ip', now());";
	$result = mysql_query($query) or die(mysql_error());
} 
//youtube
function get_youtube_id($youtube) {
	$youtube = explode("//", $youtube);
	$youtube = explode("/", $youtube[count($youtube)-1]);
	$youtube_id = $youtube[count($youtube)-1];	
	
	return $youtube_id;
} 
?>