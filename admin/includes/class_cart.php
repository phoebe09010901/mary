<?php
class cart {
	function get_total_price($member_id, $order_list) {	
		$table_name_prod   = Proj_Name.'_products';
		$table_name_member = Proj_Name.'_member';
		$table_name_shopping_business_rules = Proj_Name.'_shopping_business_rules';
		$obj_prod          = new mysql_page();
		$obj_member        = new mysql_page();
		$obj_rules         = new mysql_page();
		$member_id         = format_data($member_id, 'text');
		
		if($member_id) {
			$query = "select lv from ".$table_name_member." where id='".$member_id."'";
			$member= $obj_member->run_mysql_out($query);
		}
		
		if(count($order_list) > 0) {
			foreach($order_list as $key=>$value) {
				//products
				$query = "select price, price_b from ".$table_name_prod." where Fullkey='".$value['prod_id']."'";
				$prod  = $obj_prod->run_mysql_out($query);
				if(!$member['lv'] || $member['lv']=='normal')
					$total_price = $total_price + $value['prod_num'] * $prod['price'];
				elseif($member['lv']=='business')
					$total_price = $total_price + $value['prod_num'] * $prod['price_b'];
			}
		}
		//批發會員優惠
		if($member['lv']=='business') {
			$query = "select discount from ".$table_name_shopping_business_rules." where min_total_price<".$total_price." and pub=1 order by min_total_price desc limit 0, 1";
			$rules = $obj_rules->run_mysql_out($query);
			if($rules)
				$total_price = $total_price * $rules['discount'];
		}
		$total_data['total_price'] = $total_price;
		
		return $total_data;
	}
	function get_cart_price($cart_id) {
		$table_name_shopping_cart_rules = Proj_Name.'_shopping_cart_rules';
		$obj_rules = new mysql_page();
		$cart_id   = format_data($_GET['cart_id'], 'int');
		//cart data
		if($cart_id) {
			$query = "select name, cart_price from ".$table_name_shopping_cart_rules." where Fullkey='$cart_id'";
			$rules = $obj_rules->run_mysql_out($query);
			$cart_data['cart_name']  = $rules['name'];
			$cart_data['cart_price'] = $rules['cart_price'];
		}else {
			$cart_data['cart_name']  = '貨運';
			$cart_data['cart_price'] = 0;
		}
		return $cart_data;
	}
}
?>