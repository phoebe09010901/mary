<?php
//列表頁搜尋form
function search_form($this_page, $array_search, $match_row, $query_string) {
	$query_string = explode('&', $query_string);
	foreach($query_string as $key => $value) {
		$value = explode("=", $value);
		if($value[0]=='search_type')
			$search_type = $value[1];
	}
	?><form method="get" action="<?=$_SERVER['PHP_SELF']?>" name="search_form" id="search_form"><?php
	if($this_page=='dogs.php') {
	?><div style="float:left; padding-top:6px;"><input name="search_type" type="radio" id="search_type1" value="all" <?php if($search_type=='all'||!$search_type){echo 'checked';} ?>> <label for="search_type1">全部</label>&nbsp;&nbsp;<input name="search_type" type="radio" value="pub1" id="search_type2" <?php if($search_type=='pub1'){echo 'checked';} ?>> <label for="search_type2">上架</label>&nbsp;&nbsp;<input name="search_type" type="radio" value="pub0" id="search_type3" <?php if($search_type=='pub0'){echo 'checked';} ?>> <label for="search_type3">下架</label>&nbsp;&nbsp;</div><?php
	}
	if($this_page=='dogs_apply.php' || $this_page=='dogs_agreement.php') {
	?><div style="float:left; padding-top:6px;"><input name="search_type" type="radio" id="search_type1" value="all" <?php if($search_type=='all'||!$search_type){echo 'checked';} ?>> <label for="search_type1">全部</label>&nbsp;&nbsp;<input name="search_type" type="radio" value="state0" id="search_type2" <?php if($search_type=='state0'){echo 'checked';} ?>> <label for="search_type2">未處理</label>&nbsp;&nbsp;<input name="search_type" type="radio" value="state1" id="search_type3" <?php if($search_type=='state1'){echo 'checked';} ?>> <label for="search_type3">已處理</label>&nbsp;&nbsp;</div><?php
	}
	if($this_page=='dogs_airport.php') {
	?><div style="float:left; padding-top:6px;"><input name="search_type" type="radio" id="search_type1" value="all" <?php if($search_type=='all'||!$search_type){echo 'checked';} ?>> <label for="search_type1">全部</label>&nbsp;&nbsp;<input name="search_type" type="radio" value="output0" id="search_type2" <?php if($search_type=='output0'){echo 'checked';} ?>> <label for="search_type2">未處理</label>&nbsp;&nbsp;<input name="search_type" type="radio" value="output1" id="search_type3" <?php if($search_type=='output1'){echo 'checked';} ?>> <label for="search_type3">已處理</label>&nbsp;&nbsp;</div><?php
	}
	if($this_page=='dogs_boarding.php') {
	?><div style="float:left; padding-top:6px;"><input name="search_type" type="radio" id="search_type1" value="all" <?php if($search_type=='all'||!$search_type){echo 'checked';} ?>> <label for="search_type1">全部</label>&nbsp;&nbsp;<input name="search_type" type="radio" value="boarding0" id="search_type2" <?php if($search_type=='boarding0'){echo 'checked';} ?>> <label for="search_type2">未處理</label>&nbsp;&nbsp;<input name="search_type" type="radio" value="boarding1" id="search_type3" <?php if($search_type=='boarding1'){echo 'checked';} ?>> <label for="search_type3">已處理</label>&nbsp;&nbsp;</div><?php
	}
	if(count($query_string)>0) {
		foreach($query_string as $value) {
			$value = explode("=", $value);	
			if($value[0]!='search_row' && $value[0]!='keywords' && $value[0]!='search_type' && $value[0]) {
			?><input type="hidden" name="<?=$value[0]?>" value="<?=$value[1]?>" /><?php	
			}
		}
	}
	if(count($array_search)>0) {
		?>
    	<div class="toolselect">
        <select name="search_row" id="search_row" class="selectstyle"><?php
		foreach($array_search as $key=>$value) {
			?><option value="<?=$key?>" <?php if($key==$match_row){echo 'selected';} ?>><?=$value?></option><?php	
		}
		?></select>
        </div>
		<?php
	}
	?>
    <div class="pages_search">
       <input type="text" name="keywords" placeholder="search..."  class="searchstyle"/>
	   <div class="btn icomoon" onclick="$('#search_form').submit()">q</div>
    </div>
	</form><?php	
}
//跳頁用function1
function change_page1($page_num, $page_go, $page_all, $obj_all, $query_string, $query_string_value) {
	if(count($query_string) > 0) {
		foreach($query_string as $key => $value) {
			$url_string .= '&'.$query_string[$key].'='.$query_string_value[$key];
		}
	}
	
	//show the change function of page                            
	?><div style="width:100%; float:right; text-align:center; color:#FFF"><?php
	if($page_go==1){ ?><img src="images/no_01.png" height="12" border="0" /><?php } 
    else { 
		?><a href='<?=$_SERVER['PHP_SELF']?>?page_go=1<?=$url_string?>'><img src="images/no_01.png" height="12" border="0" /></a><?php
    } 
    ?>
    &nbsp;&nbsp;&nbsp;
    <? 
    if($page_go==1){ ?><img src="images/no_02.png" height="12" border="0" /><?php } 
    else { 
		$t = $page_go - 1; 
		?><a href='<?=$_SERVER['PHP_SELF']?>?page_go=<?=$t?><?=$url_string?>'><img src="images/no_02.png" height="12" border="0" /></a><?php
	} 
	?>
	&nbsp;&nbsp;&nbsp;
    <span style=" color:#FFF"><?=$page_num*($page_go-1)+1?> - <?=($page_go!=$page_all)?$page_num*($page_go):$obj_all?> of <?=$obj_all?></span>
	&nbsp;&nbsp;&nbsp;
	<? 
	if($page_go==$page_all || $page_all<=1){ ?><img src="images/no_03.png" height="12" border="0" /><?php } 
	else { 
		$t = $page_go + 1; 
		?><a href='<?=$_SERVER['PHP_SELF']?>?page_go=<?=$t?><?=$url_string?>'><img src="images/no_03.png" height="12" border="0" /></a><?php
	} 
	?>
	&nbsp;&nbsp;&nbsp;
	<? 
	if($page_go==$page_all || $page_all<=1){ ?><img src="images/no_04.png" height="12" border="0" /><?php } 
	else { 
		$t = $page_all; 
		?><a href='<?=$_SERVER['PHP_SELF']?>?page_go=<?=$t?><?=$url_string?>'><img src="images/no_04.png" height="12" border="0" /></a><?php
	} 
	?></div><?php
}
//跳頁用function2
function change_page2($page_go, $page_all, $query_string, $query_string_value) {
	if(count($query_string) > 0) {
		foreach($query_string as $key => $value) {
			$url_string .= '&'.$query_string[$key].'='.$query_string_value[$key];
		}
	}
	
	//show the change function of page
	$limit_page_num = 10;
	
    if($page_go==1){ ?><a href="#" class="page">上一頁</a>&nbsp;&nbsp;<?php } 
    else { 
		$t = $page_go - 1; 
		?><a href="<?=$_SERVER['PHP_SELF']?>?page_go=<?=$t?><?=$url_string?>" class="page">上一頁</a>&nbsp;&nbsp;<?php
	}
	if($page_all > 0) {
		if($page_all <= $limit_page_num) {
			$start_page = 1;
			$end_page   = $page_all;
		}elseif($page_all > $limit_page_num) {
			//設定開始頁數
			if($page_go-3 <= 1)
				$start_page = 1;
			elseif($page_go-3 > 1)
				$start_page = $page_go-3;
			//設定結束頁數
			if($page_go+3 >= $page_all)
				$end_page = $page_all;
			elseif($page_go+3 < $page_all)
				$end_page = $page_go+3;
			//echo $start_page.' / '.$end_page.' / '.$page_all."<br>";
			//調整顯示頁數
			if($end_page-$start_page+1 < $limit_page_num) {
				if($start_page - ($limit_page_num-($end_page-$start_page+1)) <= 1) {
					$end_page = $end_page + ($limit_page_num-($end_page-$start_page+1));
				}else {
					$start_page = $start_page - ($limit_page_num-($end_page-$start_page+1));
				}
			}
		}//echo $start_page.' / '.$end_page.' / '.$page_all;
		for ($i=$start_page; $i<=$end_page; $i++) { 
			if($i==$page_go)
				$show_page = '<strong>'.$i.'</strong>';
			else
				$show_page = $i;
			?><a href='<?=$_SERVER['PHP_SELF']?>?page_go=<?=$i?><?=$url_string?>' class="page"><?=$show_page?></a> <?php
		}
	}
	if($page_go==$page_all || $page_all<=1){ ?>&nbsp;&nbsp;<a href="#" class="page">下一頁</a><?php } 
	else { 
		$t = $page_go + 1; 
		?>&nbsp;&nbsp;<a href="<?=$_SERVER['PHP_SELF']?>?page_go=<?=$t?><?=$url_string?>" class="page">下一頁</a><?php
	}
}
function change_page_jyc_s($page_go, $page_all, $page_num, $obj_all, $query_string) {
	$url_string = $query_string;
	?>
    <ul class="pages_top pages">
    	<li class="pageselect">
        <SELECT onChange="MM_jumpMenu('this',this,0)" class="selectstyle" name=select> 
			<? 
            for ($i=1; $i<=$page_all; $i++) { 
                ?><OPTION value='<?=$_SERVER['PHP_SELF']?>?page_go=<?=$i?><?=$url_string?>' <? if($page_go==$i){ echo "selected"; }?>><?=$i?></OPTION><?php
            } 
            ?>		
        </SELECT>
        </li>
    </ul>
    <?php
}
function change_page_jyc($page_go, $page_all, $page_num, $obj_all, $query_string) {	
	//show the change function of page
	$url_string     = $query_string;
	$limit_page_num = 10;
	?><ul class="statusbar pages borderleft"><?php
    if($page_go==1){ ?><a href="#"><li class="left icon">u</li></a><?php } 
    else { 
		$t = $page_go - 1; 
		?><a href="<?=$_SERVER['PHP_SELF']?>?page_go=<?=$t?><?=$url_string?>"><li class="left icon">u</li></a><?php
	}
	if($page_all > 0) {
		if($page_all <= $limit_page_num) {
			$start_page = 1;
			$end_page   = $page_all;
		}elseif($page_all > $limit_page_num) {
			//設定開始頁數
			if($page_go-3 <= 1)
				$start_page = 1;
			elseif($page_go-3 > 1)
				$start_page = $page_go-3;
			//設定結束頁數
			if($page_go+3 >= $page_all)
				$end_page = $page_all;
			elseif($page_go+3 < $page_all)
				$end_page = $page_go+3;
			//echo $start_page.' / '.$end_page.' / '.$page_all."<br>";
			//調整顯示頁數
			if($end_page-$start_page+1 < $limit_page_num) {
				if($start_page - ($limit_page_num-($end_page-$start_page+1)) <= 1) {
					$end_page = $end_page + ($limit_page_num-($end_page-$start_page+1));
				}else {
					$start_page = $start_page - ($limit_page_num-($end_page-$start_page+1));
				}
			}
		}//echo $start_page.' / '.$end_page.' / '.$page_all;
		for ($i=$start_page; $i<=$end_page; $i++) { 
			if($i==$page_go) {
				?><a href='<?=$_SERVER['PHP_SELF']?>?page_go=<?=$i?><?=$url_string?>'><li class="left current"><?=$i?></li></a> <?php
			}else {
				?><a href='<?=$_SERVER['PHP_SELF']?>?page_go=<?=$i?><?=$url_string?>'><li class="left"><?=$i?></li></a> <?php
			}
				$show_page = $i;
			
		}
	}
	if($page_go==$page_all || $page_all<=1){ ?><a href="#"><li class="left icon">w</li></a><?php } 
	else { 
		$t = $page_go + 1; 
		?><a href="<?=$_SERVER['PHP_SELF']?>?page_go=<?=$t?><?=$url_string?>"><li class="left icon">w</li></a><?php
	}
	//上一頁
    if($page_go==1){ $prev_url = '#'; } 
    else { 
		$t = $page_go - 1; 
		$prev_url = $_SERVER['PHP_SELF'].'?page_go='.$t.$url_string;
	} 
	//下一頁
	if($page_go==$page_all || $page_all<=1){ $next_url = '#'; } 
	else { 
		$t = $page_go + 1; 
		$next_url = $_SERVER['PHP_SELF'].'?page_go='.$t.$url_string;
	} 
	//from - to
	$from = ($obj_all>0)?($page_go-1)*$page_num+1:1;
	$to   = ($page_go!=$page_all)?$page_go*$page_num:$obj_all;
	?>
      <li class="pageselect">
      <SELECT onChange="MM_jumpMenu('this',this,0)" class="selectstyle" name=select> 
		<? 
        for ($i=1; $i<=$page_all; $i++) { 
       		?><OPTION value='<?=$_SERVER['PHP_SELF']?>?page_go=<?=$i?><?=$url_string?>' <? if($page_go==$i){ echo "selected"; }?>><?=$i?></OPTION><?php
        } 
        ?>		
	  </SELECT>
      
      <div class="number">第<?=$page_go?>頁</div>
      <div class="arrow icomoon">s</div>
      </li>
      <li class="left"><div class="number"><?=$from?>-<?=$to?> of <?=$obj_all?>  <input name="prevpageButton" id="prevpageButton" type="button" value="<" onclick="location.href='<?=$prev_url?>'"/><input name="nextpageButton" id="nextpageButton" type="button" value=">" onclick="location.href='<?=$next_url?>'"/></div></li>
      <a href="#" onclick="javascript:history.back()"><li class="right icon">Z</li></a>
   </ul>
    <?php
}
?>