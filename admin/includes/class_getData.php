<?php
class getData {	
	function getData() {	
		$this->table_name_member  = Proj_Name.'_member';
		$this->table_name_prod    = Proj_Name.'_products';
		$this->table_name_stores  = Proj_Name.'_stores';
		$this->table_name_hits    = Proj_Name.'_hit_counts';
		$this->table_name_order   = Proj_Name.'_orderlist';
		$this->obj_member         = new mysql_page();
		$this->obj_prod           = new mysql_page();
		$this->obj_type           = new mysql_page();
		$this->obj_cate           = new mysql_page();
		$this->obj_store          = new mysql_page();
		$this->obj_hits           = new mysql_page();
		$this->obj_income         = new mysql_page();
		$this->obj_points         = new mysql_page();
		$this->obj_order          = new mysql_page();
		$this->allowUsePoints     = 0;
		$this->GetPoints          = 0;
	}
	//會員資料
	function memberData($IDkey) {
		//member data
		$query = "select Fullkey, id, name, id_number, contract_number, birthday, email, phone, mobile, zipcode, address, lv, orderEdm, inviter, inviter_bonus from ".$this->table_name_member." where Fullkey='$IDkey'";	
		$this->member = $this->obj_member->run_mysql_out($query);
		//member points
		$query = "select sum(points)-sum(used_points) as points from ".$this->table_name_member."_points where memberIDkey='".$this->member['Fullkey']."' and used=0 and pub=1 and (from_date<='".date("Y-m-d")."' and '".date("Y-m-d")."'<=to_date)";
		$points= $this->obj_member->run_mysql_out($query);
		$this->member['points'] = ($points['points'])?$points['points']:0;
		//等待生效購物金
		$query = "select sum(points) as points from ".$this->table_name_member."_points where memberIDkey='".$this->member['Fullkey']."' and used=0 and pub=1 and '".date("Y-m-d")."'<from_date";
		$points= $this->obj_member->run_mysql_out($query);
		$this->member['waiting_points'] = ($points['points'])?$points['points']:0;
		switch($this->member['lv']) {
		  case 'normal':
			$this->member['lv_str'] = '【網站會員】';
			break;
		  case 'dragon':
			$this->member['lv_str'] = '【龍海會員】';
			break;
		}
	}
	//會員購物時可使用之購物金
	function memberusepointsData($agreeUse, $memberIDkey, $total_price) {
		$this->memberData($memberIDkey);
		if($agreeUse==1) {
			switch($this->member['lv']) {
				case 'normal':	
					$this->allowUsePoints = round($total_price*Max_Points_Normal/100);
					$this->allowUsePoints = ($this->allowUsePoints<=$this->member['points'])?$this->allowUsePoints:$this->member['points'];
					break;
				case 'dragon':	
					$this->allowUsePoints = round($total_price*Max_Points_Dragon/100);
					$this->allowUsePoints = ($this->allowUsePoints<=$this->member['points'])?$this->allowUsePoints:$this->member['points'];
					break;
			}
		}	
	}
	//會員消費獲得購物金
	function membergetpointsData($memberIDkey, $total_price) {
		$this->memberData($memberIDkey);
		switch($this->member['lv']) {
			case 'normal':	
				$this->GetPoints = round($total_price*Get_Points_Normal/100);
				break;
			case 'dragon':	
				$this->GetPoints = round($total_price*Get_Points_Dragon/100);
				break;
		}
	}
	//會員紅利點數Log
	function memberpointslogData($memberIDkey, $action, $points) {
		//檢查是否有記錄
		$query = "select Fullkey from ".$this->table_name_member."_points_log where memberIDkey='$memberIDkey' and action='$action' and year='".date("Y")."' and month='".date("m")."' and day='".date("d")."'";
		$this->member = $this->obj_member->run_mysql_out($query);
		if(!$this->member) {
			$query = "insert into ".$this->table_name_member."_points_log(memberIDkey, points, action, year, month, day, create_time) values('$memberIDkey', '$points', '$action', '".date("Y")."', '".date("m")."', '".date("d")."', now())";
			$this->obj_member->run_mysql($query);
		}else {
			$query = "update ".$this->table_name_member."_points_log set points=points+".$points." where memberIDkey='$memberIDkey' and action='$action' and year='".date("Y")."' and month='".date("m")."' and day='".date("d")."'";	
			$this->obj_member->run_mysql($query);
		}
	}
	//商品類別資料
	function productscategoryData($category) {
		$query = "select pc1.Fullkey as cateID1, pc1.name as cateName1, pc1.onsale as onsale, pc2.Fullkey as cateID2, pc2.name as cateName2, pc3.Fullkey as cateID3, pc3.name as cateName3, pc3.file1 as cateFile3, pc3.banner_title as cateBannerTitle3, pc3.url_to as cateUrlto3 from ".$this->table_name_prod."_category pc1, ".$this->table_name_prod."_category pc2, ".$this->table_name_prod."_category pc3 where pc1.Fullkey=pc2.prev and pc2.Fullkey=pc3.prev and pc3.Fullkey='$category'";	
		$this->cate = $this->obj_cate->run_mysql_out($query);
	}
	//商品資料
	function productsData($prod_id, $type_id) {
		$query = "select Fullkey, category, store_id, name, price, file1 from ".$this->table_name_prod." where Fullkey='$prod_id'";
		$this->prod = $this->obj_prod->run_mysql_out($query);
		$query = "select Fullkey, name, stock from ".$this->table_name_prod."_type where Fullkey='$type_id'";
		$this->type = $this->obj_type->run_mysql_out($query);
	}
	//供應商資料 
	function storeData($store_id) {
		$query = "select Fullkey, name, cart_price from ".$this->table_name_stores." where Fullkey='$store_id'";	
		$this->store = $this->obj_store->run_mysql_out($query);
	}
	//瀏覽記錄
	function member_viewlog($memberIDkey, $prod_id) {
		$max_viewlog_num = 50;
		//檢查是否有記錄
		$query = "select Fullkey from ".$this->table_name_member."_viewlog where memberIDkey='$memberIDkey' and prod_id='$prod_id'";
		$this->member = $this->obj_member->run_mysql_out($query);
		if(!$this->member) {
			$query = "select Fullkey from ".$this->table_name_member."_viewlog where memberIDkey='$memberIDkey' order by create_time asc";
			$this->obj_member->run_mysql_list($query);
			if($this->member['counts']==$max_viewlog_num) {
				$this->member = mysql_fetch_array($this->obj_member->result);
				//拿掉最後一個
				$query = "delete from ".$this->table_name_member."_viewlog where Fullkey='".$this->member['Fullkey']."'";
				$this->obj_member->run_mysql($query);
			}
			$query = "insert into ".$this->table_name_member."_viewlog(memberIDkey, prod_id, create_time) values('$memberIDkey', '$prod_id', now())";
			$this->obj_member->run_mysql($query);
		}else {
			$query = "update ".$this->table_name_member."_viewlog set create_time=now() where memberIDkey='$memberIDkey' and prod_id='$prod_id'";	
			$this->obj_member->run_mysql($query);
		}
	}
	//訂單數量記錄
	function orderlistlogData($action) {	
		//檢查是否有記錄
		$query = "select Fullkey from ".$this->table_name_order."_log where action='$action' and year='".date("Y")."' and month='".date("m")."' and day='".date("d")."'";
		$this->obj_order->run_mysql_list($query);	
		if($this->obj_order->obj_all==0) {
			$query = "insert into ".$this->table_name_order."_log(order_num, action, year, month, day, create_time) values(1, '$action', '".date("Y")."', '".date("m")."', '".date("d")."', now())";
			$this->obj_order->run_mysql($query);	
		}else {
			$query = "update ".$this->table_name_order."_log set order_num=order_num+1 where action='$action' and year='".date("Y")."' and month='".date("m")."' and day='".date("d")."'";	
			$this->obj_order->run_mysql($query);
		}
	}
	//訂單金額記錄
	function orderlisttotalpricelogData($total_price, $action) {	
		//檢查是否有記錄
		$query = "select Fullkey from ".$this->table_name_order."_total_price_log where action='$action' and year='".date("Y")."' and month='".date("m")."' and day='".date("d")."'";
		$this->obj_order->run_mysql_list($query);	
		if($this->obj_order->obj_all==0) {
			$query = "insert into ".$this->table_name_order."_total_price_log(total_price, action, year, month, day, create_time) values('".$total_price."', '$action', '".date("Y")."', '".date("m")."', '".date("d")."', now())";
			$this->obj_order->run_mysql($query);	
		}else {
			$query = "update ".$this->table_name_order."_total_price_log set total_price=total_price+".$total_price." where action='$action' and year='".date("Y")."' and month='".date("m")."' and day='".date("d")."'";	
			$this->obj_member->run_mysql($query);
		}
	}
	//page hits
	function hit_counts($page_name, $ip) {
		$query = "insert into ".$this->table_name_hits."(hit_page, ip, create_time) values('$page_name', '$ip', now())";
		$this->obj_hits->run_mysql($query);
	}
	//products hit counts
	function products_hit_counts($prod_id) {
		$query = "select Fullkey from ".$this->table_name_prod."_hit_counts where prod_id='$prod_id' and year='".date("Y")."' and month='".date("m")."' and day='".date("d")."'";
		$this->obj_hits->run_mysql_list($query);
		if($this->obj_hits->obj_all==0) {
			$query = "insert into ".$this->table_name_prod."_hit_counts(prod_id, hit_counts, year, month, day) values('$prod_id', 1, '".date("Y")."', '".date("m")."', '".date("d")."')";
			$this->obj_hits->run_mysql($query);
		}else {
			$query = "update ".$this->table_name_prod."_hit_counts set hit_counts=hit_counts+1 where prod_id='$prod_id' and year='".date("Y")."' and month='".date("m")."' and day='".date("d")."'";
			$this->obj_hits->run_mysql($query);
		}
	}
	//products buy counts
	function products_buy_counts($prod_id, $prod_type, $prod_num) {
		$query = "select Fullkey from ".$this->table_name_prod."_buy_counts where prod_id='$prod_id' and prod_type='$prod_type' and year='".date("Y")."' and month='".date("m")."' and day='".date("d")."'";
		$this->obj_hits->run_mysql_list($query);
		if($this->obj_hits->obj_all==0) {
			$query = "insert into ".$this->table_name_prod."_buy_counts(prod_id, prod_type, buy_counts, year, month, day) values('$prod_id', '$prod_type', ".$prod_num.", '".date("Y")."', '".date("m")."', '".date("d")."')";
			$this->obj_hits->run_mysql($query);
		}else {
			$query = "update ".$this->table_name_prod."_buy_counts set buy_counts=buy_counts+".$prod_num." where prod_id='$prod_id' and prod_type='$prod_type' and year='".date("Y")."' and month='".date("m")."' and day='".date("d")."'";
			$this->obj_hits->run_mysql($query);
		}
	}
	//products buy total price
	function products_buy_total_price($prod_id, $prod_type, $prod_price, $prod_num) {
		$total_price = round($prod_price * $prod_num);
		$query = "select Fullkey from ".$this->table_name_prod."_buy_total_price where prod_id='$prod_id' and prod_type='$prod_type' and year='".date("Y")."' and month='".date("m")."' and day='".date("d")."'";
		$this->obj_hits->run_mysql_list($query);
		if($this->obj_hits->obj_all==0) {
			$query = "insert into ".$this->table_name_prod."_buy_total_price(prod_id, prod_type, total_price, year, month, day) values('$prod_id', '$prod_type', ".$total_price.", '".date("Y")."', '".date("m")."', '".date("d")."')";
			$this->obj_hits->run_mysql($query);
		}else {
			$query = "update ".$this->table_name_prod."_buy_total_price set total_price=total_price+".$total_price." where prod_id='$prod_id' and prod_type='$prod_type' and year='".date("Y")."' and month='".date("m")."' and day='".date("d")."'";
			$this->obj_hits->run_mysql($query);
		}
	}
	//products income
	function products_income($prod_id, $prod_type, $prod_price, $prod_cost, $prod_num) {
		$income = round(($prod_price - $prod_cost) * $prod_num);
		$query = "select Fullkey from ".$this->table_name_prod."_income where prod_id='$prod_id' and prod_type='$prod_type' and year='".date("Y")."' and month='".date("m")."' and day='".date("d")."'";
		$this->obj_income->run_mysql_list($query);
		if($this->obj_income->obj_all==0) {
			$query = "insert into ".$this->table_name_prod."_income(prod_id, prod_type, income, year, month, day) values('$prod_id', '$prod_type', ".$income.", '".date("Y")."', '".date("m")."', '".date("d")."')";
			$this->obj_income->run_mysql($query);
		}else {
			$query = "update ".$this->table_name_prod."_income set income=income+".$income." where prod_id='$prod_id' and prod_type='$prod_type' and year='".date("Y")."' and month='".date("m")."' and day='".date("d")."'";
			$this->obj_income->run_mysql($query);
		}
	}
	//products stock
	function products_stock($action, $prod_type, $prod_num) {
		if($action=="buy") {	//購買
			$query = "update ".$this->table_name_prod."_type set stock=stock-".$prod_num." where Fullkey='$prod_type'";	
		}elseif($action=="cancel") {	//退單
			$query = "update ".$this->table_name_prod."_type set stock=stock+".$prod_num." where Fullkey='$prod_type'";	
		}
		$this->obj_prod->run_mysql($query);
	} 
	//統計 -- 商品瀏覽/購買次數
	function AnalyzeproductscountsData($prod_id, $prod_type, $search_type, $search_range, $year, $month, $day) {
		switch($search_range) {
			case "everyMonth":	
				$where_str = "and year='$year' and month='$month'";
				break;
			case "everySeason":	
				if($month==1)
					$where_str = "and year='$year' and (month='01' or month='02' or month='03')";
				if($month==2)
					$where_str = "and year='$year' and (month='04' or month='05' or month='06')";
				if($month==3)
					$where_str = "and year='$year' and (month='07' or month='08' or month='09')";
				if($month==4)
					$where_str = "and year='$year' and (month='10' or month='11' or month='12')";
				break;
			case "everyDay":	
				$where_str = "and year='$year' and month='$month' and day='$day'";
				break;
		}
		if($search_type=='hit') {
			$query = "select sum(hit_counts) as counts from ".$this->table_name_prod."_hit_counts where prod_id='$prod_id' $where_str";
			$counts= $this->obj_prod->run_mysql_out($query);
			echo number_format($counts['counts']);
		}elseif($search_type=='buy_counts') {
			$query = "select sum(buy_counts) as counts from ".$this->table_name_prod."_buy_counts where prod_id='$prod_id' and prod_type='$prod_type' $where_str";
			$counts= $this->obj_prod->run_mysql_out($query);
			echo number_format($counts['counts']);
		}elseif($search_type=='buy_total_price') {
			$query = "select sum(total_price) as total_price from ".$this->table_name_prod."_buy_total_price where prod_id='$prod_id' and prod_type='$prod_type' $where_str";
			$prod  = $this->obj_prod->run_mysql_out($query);
			echo number_format($prod['total_price']);
		}elseif($search_type=='income') {
			$query = "select sum(income) as income from ".$this->table_name_prod."_income where prod_id='$prod_id' and prod_type='$prod_type' $where_str";
			$income= $this->obj_prod->run_mysql_out($query);
			echo number_format($income['income']);
		}
	}
	//統計 -- 訂單
	function AnalyzeorderlistData($action, $search_type, $search_range, $year, $month, $day) {
		switch($search_range) {
			case "everyMonth":	
				$where_str = "and year='$year' and month='$month'";
				break;
			case "everySeason":	
				if($month==1)
					$where_str = "and year='$year' and (month='01' or month='02' or month='03')";
				if($month==2)
					$where_str = "and year='$year' and (month='04' or month='05' or month='06')";
				if($month==3)
					$where_str = "and year='$year' and (month='07' or month='08' or month='09')";
				if($month==4)
					$where_str = "and year='$year' and (month='10' or month='11' or month='12')";
				break;
			case "everyDay":	
				$where_str = "and year='$year' and month='$month' and day='$day'";
				break;
		}
		if($search_type=="orderlist") {
			$query = "select sum(order_num) as order_num from ".$this->table_name_order."_log where action='$action' $where_str";
			$order = $this->obj_order->run_mysql_out($query);
			echo number_format($order['order_num']);
		}elseif($search_type=="orderlist_totalprice") {
			$query = "select sum(total_price) as total_price from ".$this->table_name_order."_total_price_log where action='$action' $where_str";
			$order = $this->obj_order->run_mysql_out($query);
			echo number_format($order['total_price']);
		}
	}
	//統計 -- 購物金
	function AnalyzeorderlistpointsData($action, $search_type, $search_range, $year, $month, $day) {
		switch($search_range) {
			case "everyMonth":	
				$where_str = "and year='$year' and month='$month'";
				break;
			case "everySeason":	
				if($month==1)
					$where_str = "and year='$year' and (month='01' or month='02' or month='03')";
				if($month==2)
					$where_str = "and year='$year' and (month='04' or month='05' or month='06')";
				if($month==3)
					$where_str = "and year='$year' and (month='07' or month='08' or month='09')";
				if($month==4)
					$where_str = "and year='$year' and (month='10' or month='11' or month='12')";
				break;
			case "everyDay":	
				$where_str = "and year='$year' and month='$month' and day='$day'";
				break;
		}
		$query = "select sum(points) as points from ".$this->table_name_member."_points_log where action='$action' $where_str";
		$points= $this->obj_points->run_mysql_out($query);
		echo number_format($points['points']);
	}
}
?>