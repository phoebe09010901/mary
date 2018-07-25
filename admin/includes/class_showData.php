<?php
class showData {
	var $table_name_member;
	var $main_str_prod;
	var $table_name_prod;
	var $obj_member;
	var $obj_getstore;
	var $obj_getprod;
	var $member;
	var $obj_image;
	var $obj_cart;
	var $store_TotalNum1;
	var $store_TotalNum2;
	var $store_TotalPrice;
	
	function showData() {	
		$this->table_name_member  = Proj_Name.'_member';
		$this->main_str_prod      = "products";
		$this->table_name_prod    = Proj_Name.'_'.$this->main_str_prod;
		$this->obj_member         = new mysql_page();
		$this->obj_getstore       = new getData();
		$this->obj_getprod        = new getData();
		$this->obj_image          = new files();
		$this->obj_cart           = new cart();
	}
	//顯示地址
	function showAddress($twzipcode, $zipcode, $address) {
		if($zipcode==3001 || $zipcode==3002 || $zipcode==3003)
			$show_zipcode = 300;
		else
			$show_zipcode = $zipcode;	
		echo $show_zipcode.$twzipcode[$zipcode]['county'].$twzipcode[$zipcode]['area'].$address;
	}
	//首頁新進商品
	function showNewarrivalProducts() {
		$obj_prod = new mysql_page();
		$query = "select Fullkey, name, remark, file1 from ".$this->table_name_prod." where new_arrival=1 and pub=1 order by rand() limit 0, 3";	
		$obj_prod->run_mysql_list($query);
		?><div id="R_main_pro" class="R_main_pro">
            <div id="R_main_pro_title">商品新登場 New</div>
            <div id="R_main_pro_more"><a href="product_new.php">MORE</a></div>
            <?php
            for($i=0; $i<$obj_prod->obj_all; $i++) {
                $prod = mysql_fetch_array($obj_prod->result);
                if($prod){ $this->showProductsListData("New", $prod['Fullkey'], $i); }
            }
            ?>
        </div>
        <?php
	}
	//首頁特惠商品
	function showSpecProducts() {
		$obj_prod = new mysql_page();
		$query = "select Fullkey, name, remark, file1 from ".$this->table_name_prod." where spec=1 and pub=1 order by rand() limit 0, 3";	
		$obj_prod->run_mysql_list($query);
		?><div id="R_main_pro" class="R_main_pro">
            <div id="R_main_pro_title">特惠商品 On Sale</div>
            <div id="R_main_pro_more"><a href="product_spec.php">MORE</a></div>
            <?php
            for($i=0; $i<$obj_prod->obj_all; $i++) {
                $prod = mysql_fetch_array($obj_prod->result);
                if($prod){ $this->showProductsListData("Spec", $prod['Fullkey'], $i); }
            }
            ?>
        </div>
        <?php
	}
	//首頁熱門商品
	function showHotProducts() {
		$obj_prod = new mysql_page();
		//熱門商品
		$query = "select distinct p.Fullkey from ".$this->table_name_prod." p, ".$this->table_name_prod."_buy_counts pbc where p.Fullkey=pbc.prod_id and p.pub=1 and pbc.year=".date("Y")." and pbc.month=".date("m")." order by pbc.buy_counts desc limit 0, 3";
		$obj_prod->run_mysql_list($query);
		//如果沒有購買記錄，改抓瀏覽記錄
		if($obj_prod->obj_all==0) {
			$query = "select distinct p.Fullkey from ".$this->table_name_prod." p, ".$this->table_name_prod."_hit_counts pbc where p.Fullkey=pbc.prod_id and p.pub=1 and pbc.year=".date("Y")." and pbc.month=".date("m")." order by pbc.hit_counts desc limit 0, 3";
			$obj_prod->run_mysql_list($query);
		}
		?><div id="R_main_pro" class="R_main_pro">
            <div id="R_main_pro_title">熱門商品 Hot</div>
            <div id="R_main_pro_more"><a href="product_hot.php">MORE</a></div>
            <?php
            for($i=0; $i<$obj_prod->obj_all; $i++) {
                $prod = mysql_fetch_array($obj_prod->result);
                if($prod){ $this->showHotProductsListData("Hot", $prod['Fullkey'], $i); }
            }
            ?>
        </div>
        <?php
	}
	//呈現單項商品資料
	function showProductsListData($type, $prod_id, $i) {
		$obj_prod  = new mysql_page();
		$_width_s  = 270;
		$_height_s = 270;
		
		$query = "select Fullkey, name, file1, price, remark from ".$this->table_name_prod." where Fullkey='$prod_id'";	
		$prod  = $obj_prod->run_mysql_out($query);
		if($i%3!=2){ ?><div id="pro_a"><?php }
		if($prod) {
			?><div class="goods" id="<?=$type.'_'.$i?>" onMouseOver="gover('<?=$type.'_'.$i?>','gshow', '<?=$prod['Fullkey']?>')" onMouseOut="gout('gshow')" onClick="location.href='product.php?prod_id=<?=$prod['Fullkey']?>'">
			<a href="product.php?prod_id=<?=$prod['Fullkey']?>"><?php $this->obj_image->show_pic1($this->main_str_prod.'/thumb/'.$prod['file1'], $_width_s, $_height_s, $prod['name'], 'show_file'.$prod['Fullkey']); ?></a> 
			<span class="proname"><a href="product.php?prod_id=<?=$prod['Fullkey']?>"><?=cnsubstr($prod['name'], 13)?><br /><?=cnsubstr($prod['remark'], 13)?></a></span><br />
			<span class="red">NT <?=number_format($prod['price'])?> </span>
			</div><?php	
		}
		if($i%3!=2){ ?></div><?php }
	}
	//呈現單項熱門商品資料
	function showHotProductsListData($type, $prod_id, $i) {
		$obj_prod  = new mysql_page();
		$_width_s  = 270;
		$_height_s = 270;
		$query = "select Fullkey, name, file1, price, remark from ".$this->table_name_prod." where Fullkey='$prod_id'";	
		$prod  = $obj_prod->run_mysql_out($query);
		if($i%3!=2){ ?><div id="pro_a"><?php }
		if($prod) {
			?><div class="goods" id="<?=$type.'_'.$i?>" onMouseOver="gover('<?=$type.'_'.$i?>','gshow', '<?=$prod['Fullkey']?>')" onMouseOut="gout('gshow')" onClick="location.href='product.php?prod_id=<?=$prod['Fullkey']?>'">
			<a href="product.php?prod_id=<?=$prod['Fullkey']?>"><?php $this->obj_image->show_pic1($this->main_str_prod.'/thumb/'.$prod['file1'], $_width_s, $_height_s, $prod['name'], 'show_file'.$prod['Fullkey']); ?></a> 
          	<div id="R_main_pro_hot<?=$i+1?>">
        		<div id="R_main_pro_hot_text"><a href="product.php?prod_id=<?=$prod['Fullkey']?>" style="color:#FFF"><?=cnsubstr($prod['name'], 11)?></a><br />NT$ <?=number_format($prod['price'])?></div>
            </div></div><?php	
		}
		if($i%3!=2){ ?></div><?php }
	}
	//商品內頁瀏覽記錄
	function showMemberViewlog($memberIDkey) {
		$obj_prod  = new mysql_page();
		$_width_s  = 160;
		$_height_s = 160;
		$query = "select p.Fullkey, p.name, p.file1 from ".$this->table_name_prod." p, ".$this->table_name_member."_viewlog mt where p.Fullkey=mt.prod_id and mt.memberIDkey='$memberIDkey' order by mt.create_time desc limit 0, 4";	
		$obj_prod->run_mysql_list($query);
		?>
        <div id="R_main_procuct04"> 
          <span class="product_1g">瀏覽紀錄</span>
            <div id="R_main_procuct04_2"> 
		<?php
		for($i=0; $i<$obj_prod->obj_all; $i++) {
			$prod = mysql_fetch_array($obj_prod->result);	
			if($prod) {
			?>
            <div id="R_main_procuct04_2_pro"> 
              <div id="R_main_procuct04_2_pic"><a href="product.php?prod_id=<?=$prod['Fullkey']?>"><?php $this->obj_image->show_pic1($this->main_str_prod.'/thumb/'.$prod['file1'], $_width_s, $_height_s, $prod['name'], 'show_file'.$prod['Fullkey']); ?></a></div>   
              <span class="proname"><a href="product.php?prod_id=<?=$prod['Fullkey']?>"><?=cnsubstr($prod['name'], 9)?></a></span> 
            </div>  
            <?php	
			}
		}
		?>      
            </div><!--R_main_procuct04_2 大框結束-->
          <div id="R_main_procuct03_3"><a href="product_viewlog.php">更多瀏覽紀錄</a></div>
        </div><!--R_main_procuct04 結束-->
        <?php
	}
	//購物車內頁瀏覽記錄
	function showMemberTrackO($memberIDkey) {
		$obj_prod  = new mysql_page();
		$_width_s  = 150;
		$_height_s = 150;
		$query = "select p.Fullkey, p.name, p.file1, p.price from ".$this->table_name_prod." p, ".$this->table_name_member."_track mt where p.Fullkey=mt.prod_id and mt.memberIDkey='$memberIDkey' order by mt.create_time desc limit 0, 5";	
		$obj_prod->run_mysql_list($query);
		?><div id="cart_6">
          <div class="cart_40" id="cart_6_1">追蹤商品清單</div>
          <div id="cart_6_2">
		<?php
		for($i=0; $i<$obj_prod->obj_all; $i++) {
			$prod = mysql_fetch_array($obj_prod->result);	
			if($prod) {
			?><div id="cart_6_2_M_list">
             <div id="cart_6_2_M_list1"><a href="product.php?prod_id=<?=$prod['Fullkey']?>"><?php $this->obj_image->show_pic1($this->main_str_prod.'/thumb/'.$prod['file1'], $_width_s, $_height_s, $prod['name'], 'show_file'.$prod['Fullkey']); ?></a></div>
             <div id="cart_6_2_M_list2"><a href="product.php?prod_id=<?=$prod['Fullkey']?>"><?=cnsubstr($prod['name'], 9)?></a></div>
             <div id="cart_6_2_M_list2">NT <?=number_format($prod['price'])?></div>     
             <!--<div id="cart_6_2_M_list3"><a href="javascript:add_prod('normal', 'add_prod', <?=$prod['Fullkey']?>, $('#prod_num').val(), $('#prod_type').val());location.reload();">放入購物車</a> </div>-->
            </div><?php	
			}
		}
		?>  
          </div> 
        </div> 
        <div id="cart_center2">
          <div id="R_main_join_member_s"><a href="more_browse.php">顯示更多追蹤商品</a></div>
        </div> 
        <?php
	}
	//商品內頁推薦商品
	function showProductsPush() {
		$obj_prod  = new mysql_page();
		$_width_s  = 160;
		$_height_s = 160;
		$query = "select Fullkey, name, file1 from ".$this->table_name_prod." where push=1 and pub=1 order by rand() limit 0, 5";	
		$obj_prod->run_mysql_list($query);
		?>
        <div id="R_main_procuct04"> 
          <span class="product_1g">其它商品推薦</span>
            <div id="R_main_procuct04_2"> 
		<?php
		for($i=0; $i<$obj_prod->obj_all; $i++) {
			$prod = mysql_fetch_array($obj_prod->result);	
			if($prod) {
			?>
            <div id="R_main_procuct04_2_pro"> 
              <div id="R_main_procuct04_2_pic"><a href="product.php?prod_id=<?=$prod['Fullkey']?>"><?php $this->obj_image->show_pic1($this->main_str_prod.'/thumb/'.$prod['file1'], $_width_s, $_height_s, $prod['name'], 'show_file'.$prod['Fullkey']); ?></a></div>   
              <span class="proname"><a href="product.php?prod_id=<?=$prod['Fullkey']?>"><?=cnsubstr($prod['name'], 9)?></a></span> 
            </div>  
            <?php	
			}
		}
		?>      
            </div><!--R_main_procuct04_2 大框結束-->
        </div><!--R_main_procuct04 結束-->
        <?php
	}
	//購物車列表
	function showOrderlistData($storelist, $orderlist) {
		if(count($storelist)>0) {
			foreach($storelist as $key => $store_id) {
				$this->obj_getstore->storeData($store_id);	//共應商資料
				//表格頭
				?><div id="cart_list"> 
                 <div class="title_w" id="cart_1_green"><?=$this->obj_getstore->store['name']?></div>
                 <div id="cart_2">
                  <div class="cart_40" id="cart_2_top1">商品明細</div> 
                  <div class="cart_40" id="cart_2_top2">價格</div> 
                  <div class="cart_40" id="cart_2_top2">數量</div> 
                  <div class="cart_40" id="cart_2_top2">小計</div> 
                  <div class="cart_40" id="cart_2_top3">變更</div>
                <?php					
				$this->showOrderlistProductsData($orderlist, $store_id);
				//如果是尚品，有滿額免運
				if($store_id==1 && $this->store_TotalPrice>=No_Cart_Chart)
					$this->obj_getstore->store['cart_price'] = 0;
				//表格尾
				?><div class="cart_60" id="cart_3"> 
                  共<?=number_format($this->store_TotalNum1)?>項商品 (<?=number_format($this->store_TotalNum2)?>件) 小計: <span class="red" id="showStoreTotalPrice_<?=$store_id?>">$ <?=number_format($this->store_TotalPrice)?></span> + 運費<span class="red" id="ShowStoreCartPrice_<?=$store_id?>">$ <?=number_format($this->obj_getstore->store['cart_price'])?> </span><?php if($store_id==1){ ?><span class="title_list1_red"> (滿<?=number_format(No_Cart_Chart)?>免運費)</span><?php } ?></div>           
                  </div>
                </div> <?php
			}
		}
	}
	//購物車商品列表
	function showOrderlistProductsData($orderlist, $store_id) {
		$_width_s  = 100;
		$_height_s = 100;
		$this->store_TotalNum1  = 0;
		$this->store_TotalNum2  = 0;
		$this->store_TotalPrice = 0;
		foreach($orderlist as $key => $value) {
			if($value['store_id']==$store_id) {
				$this->obj_getprod->productsData($value['prod_id'], $value['prod_type']);
				$this->obj_getprod->productscategoryData($this->obj_getprod->prod['category']);
				$prod_price = round($this->obj_getprod->prod['price']*$this->obj_getprod->cate['onsale']);
			?><div id="prod_row_<?=$value['prod_id']?>_<?=$value['prod_type']?>"><div class="cart_40" id="cart_2_top1"> 
			   <div id="cart_h140">
			    <a href="product.php?prod_id=<?=$value['prod_id']?>"><?php $this->obj_image->show_pic1($this->main_str_prod.'/thumb/'.$this->obj_getprod->prod['file1'], $_width_s, $_height_s, $this->obj_getprod->prod['name'], 'show_file'.$this->obj_getprod->prod['Fullkey']); ?></a>
				<div class="main_16" id="cart_2_top1_1"><a href="product.php?prod_id=<?=$value['prod_id']?>"><?=$this->obj_getprod->prod['name'].'<br>['.$this->obj_getprod->type['name'].']'?></a></div> 
				<div class="red" id="cart_2_top1_2"></div>  
			   </div>    
			  </div> 
			  <div class id="cart_h140w105"><?=number_format($prod_price)?></div> 
			  <div class id="cart_h140w105">
				<select name="select" id="select" onchange="javascript:change_prod('change_prod', <?=$value['store_id']?>, <?=$this->obj_getprod->prod['Fullkey']?>, this.value, <?=$this->obj_getprod->type['Fullkey']?>);">
					<?php
                    for($i=1; $i<=10; $i++) {
                        ?><option value="<?=$i?>" <?php if($value['prod_num']==$i){echo 'selected';} ?>><?=$i?></option><?php
                    }
                    ?>
				</select>
			  </div> 
			  <div class id="cart_h140w105"><span id="prod_total_price_<?=$this->obj_getprod->prod['Fullkey']?>_<?=$this->obj_getprod->type['Fullkey']?>"><?=number_format($value['prod_num'] * $prod_price)?></span></div>
			  <div class id="cart_h140w156">
			   <div class="main_16" id="cart_L01">
				 <a href="javascript:remove_prod('remove_prod', '<?=$value['store_id']?>', '<?=$value['prod_id']?>', '<?=$value['prod_type']?>')">取消</a><br>
				 <a href="javascript:real_track('<?=$value['store_id']?>', '<?=$value['prod_id']?>', '<?=$value['prod_type']?>')">改追蹤商品</a>
			   </div>
			</div></div><?php	
				$this->store_TotalNum1++;
				$this->store_TotalNum2  = $this->store_TotalNum2 + $value['prod_num'];
				$this->store_TotalPrice = $this->store_TotalPrice + $value['prod_num'] * $prod_price;
			}
		}
	}
	//購物車確認列表
	function showOrderlistConfirmData($storelist, $orderlist) {
		if(count($storelist)>0) {
			foreach($storelist as $key => $store_id) {
				$this->obj_getstore->storeData($store_id);	//共應商資料				
				//表格頭
				?><div id="cart_list"> 
                 <div class="title_w" id="cart_1_green"><?=$this->obj_getstore->store['name']?></div>
                 <div id="cart_2">
                  <div class="cart_40" id="cart_2_top1_730">商品明細</div> 
                  <div class="cart_40" id="cart_2_top2_88">價格</div> 
                  <div class="cart_40" id="cart_2_top2_88">數量</div> 
                  <div class="cart_40" id="cart_2_top2_88R">小計</div> 
                <?php					
				$this->showOrderlistProductsConfirmData($orderlist, $store_id);				
				//如果是尚品，有滿額免運
				if($store_id==1 && $this->store_TotalPrice>=No_Cart_Chart)
					$this->obj_getstore->store['cart_price'] = 0;
				//表格尾
				?><div class="cart_60" id="cart_3"> 
                  共<?=number_format($this->store_TotalNum1)?>項商品 (<?=number_format($this->store_TotalNum2)?>件) 小計: <span class="red" id="showStoreTotalPrice_<?=$store_id?>">$ <?=number_format($this->store_TotalPrice)?></span> + 運費<span class="red" id="ShowStoreCartPrice_<?=$store_id?>">$ <?=number_format($this->obj_getstore->store['cart_price'])?> </span><?php if($store_id==1){ ?><span class="title_list1_red"> (滿<?=number_format(No_Cart_Chart)?>免運費)</span><?php } ?></div>           
                  </div>
                </div> <?php	
			}
		}
	}
	//購物車商品確認列表
	function showOrderlistProductsConfirmData($orderlist, $store_id) {
		$_width_s  = 100;
		$_height_s = 100;
		$this->store_TotalNum1  = 0;
		$this->store_TotalNum2  = 0;
		$this->store_TotalPrice = 0;
		foreach($orderlist as $key => $value) {
			if($value['store_id']==$store_id) {
				$this->obj_getprod->productsData($value['prod_id'], $value['prod_type']);
				$this->obj_getprod->productscategoryData($this->obj_getprod->prod['category']);
				$prod_price = round($this->obj_getprod->prod['price']*$this->obj_getprod->cate['onsale']);
			?><div class="cart_40" id="cart_2_top1_730"> 
               <div id="cart_h140">
                   <div id="cart_h140_L"><a href="product.php?prod_id=<?=$value['prod_id']?>"><?php $this->obj_image->show_pic1($this->main_str_prod.'/thumb/'.$this->obj_getprod->prod['file1'], $_width_s, $_height_s, $this->obj_getprod->prod['name'], 'show_file'.$this->obj_getprod->prod['Fullkey']); ?></a></div>
                   <div class="main_16" id="cart_2_top1_1"><a href="product.php?prod_id=<?=$value['prod_id']?>"><?=$this->obj_getprod->prod['name'].'<br>['.$this->obj_getprod->type['name'].']'?></a></div> 
                   <div class="red" id="cart_2_top1_2"></div>  
               </div>      
             </div> 
             <div class id="cart_h140w88"><?=number_format($prod_price)?></div> 
             <div class id="cart_h140w88"><?=number_format($value['prod_num'])?></div> 
             <div class id="cart_h140w88R"><?=number_format($value['prod_num'] * $prod_price)?></div><?php	
				$this->store_TotalNum1++;
				$this->store_TotalNum2  = $this->store_TotalNum2 + $value['prod_num'];
				$this->store_TotalPrice = $this->store_TotalPrice + $value['prod_num'] * $prod_price;
			}
		}
	}
}
?>