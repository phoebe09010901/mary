// JavaScript Document
//將商品放入購物車
function add_prod(type, action, prod_id, prod_num, prod_type, prod_color, prod_size) {
	if(!prod_id || prod_id==0) {
		alert("請選擇商品");	
	}else if(!prod_type || prod_type==0) {
		alert("請選擇商品的規格");	
	}else if(!prod_color || prod_color==0) {
		alert("請選擇商品的顏色");	
	}else if(!prod_size || prod_size==0) {
		alert("請選擇商品的尺寸");	
	}else if(!isNumber(prod_num)) {
		alert("商品數量請輸入數字");	
	}else {
		$.ajax({
			url: 'ajax_data_cart.php',
			type: 'GET',
			data: {action:action, prod_id:prod_id, prod_num:prod_num, prod_type:prod_type, prod_color:prod_color, prod_size:prod_size},
			dataType: 'json',
			processData: true,
			success: function(request){
				var cart_info = request;
				if(cart_info.info=='success') {
					alert(cart_info.message);
					if(type=='quick') {
						location.href = 'cart.php?f=1';	
					}
				}else {
					alert(cart_info.message);	
				}
			},
			error: function(xhr, tStatus, err){alert('Ajax 發生錯誤，'+xhr.responseText +'\n\n請與網站工程師連絡');}
		});	
	}
}
//更新商品數量
function change_prod(action, prod_id, prod_num, prod_type, prod_color, prod_size) {
	$.ajax({
		url: 'ajax_data_cart.php',
		type: 'GET',
		data: {action:action, prod_id:prod_id, prod_num:prod_num, prod_type:prod_type, prod_color:prod_color, prod_size:prod_size},
		dataType: 'json',
		processData: true,
		success: function(request){
			var cart_info = request;
			if(cart_info.info=='success') {
				$("#prod_total_price_"+prod_id+"_"+prod_type+"_"+prod_color+"_"+prod_size).html('NT$ '+cart_info.prod_total_price+' (未稅)');
				get_total_price('total_price', 'show_total_price')
				//cal_cart();				
			}else {
				alert(cart_info.message);	
			}
		},
		error: function(xhr, tStatus, err){alert('Ajax 發生錯誤，'+xhr.responseText +'\n\n請與網站工程師連絡');}
	});	
}
//從購物車內移除商品
function remove_prod(action, prod_id, prod_num, prod_type, prod_color, prod_size, prod_price) {
	$.ajax({
		url: 'ajax_data_cart.php',
		type: 'GET',
		data: {action:action, prod_id:prod_id, prod_type:prod_type, prod_color:prod_color, prod_size:prod_size},
		dataType: 'json',
		processData: true,
		success: function(request){
			var cart_info = request;
			if(cart_info.info=='success') {
				$("#prod_row_"+prod_id+"_"+prod_type+"_"+prod_color+"_"+prod_size).hide("slow");
				get_total_price('total_price', 'show_total_price')
				//cal_cart();			
			}else {
				alert(cart_info.message);	
			}
		},
		error: function(xhr, tStatus, err){alert('Ajax 發生錯誤，'+xhr.responseText +'\n\n請與網站工程師連絡');}
	});	
}
//取得購物車內商品總數
function get_total_prod_num() {
	$.ajax({
		url: 'ajax_data_cart.php',
		type: 'GET',
		data: {action:'get_total_prod_num'},
		dataType: 'json',
		processData: true,
		success: function(request){
			var cart_info = request;
			if(cart_info.info)
				$("#total_prod_num").html(cart_info.info);
			else
				$("#total_prod_num").html('0');
		},
		error: function(xhr, tStatus, err){alert('Ajax 發生錯誤，'+xhr.responseText +'\n\n請與網站工程師連絡');}
	});	
}
//取得購物車內商品總金額
function get_total_price(input_id, total_price_tag_id) {
	$.ajax({
		url: 'ajax_data_cart.php',
		type: 'GET',
		data: {action:'get_total_price'},
		dataType: 'json',
		processData: true,
		success: function(request){
			var cart_info = request;
			if(cart_info.total_price) {
				$("#"+input_id).val(cart_info.total_price);
				$("#"+total_price_tag_id).html('NT$ '+cart_info.total_price+' (未稅)');
			}else {
				$("#"+input_id).val(0);
				$("#"+total_price_tag_id).html('0');			
			}
		},
		error: function(xhr, tStatus, err){alert('Ajax 發生錯誤，'+xhr.responseText +'\n\n請與網站工程師連絡');}
	});	
}
//計算運費
function cal_cart(cart_id, total_price_val_id, total_price_tag_id, cart_price_tag_id) {
	var total_price = $("#total_price").val();
	var cart_price  = 0;
	get_total_price(total_price_val_id, total_price_tag_id)
	$.ajax({
		url: 'ajax_data_cart.php',
		type: 'GET',
		data: {action:'get_cart_price', cart_id:cart_id},
		dataType: 'json',
		processData: true,
		success: function(request){
			var cart_info = request;
			
			total_price = parseInt(total_price) + parseInt(cart_info.cart_price);
			$("#"+total_price_tag_id).html('NT$ '+total_price+' (未稅)');
			$("#"+cart_price_tag_id).html('NT$ '+cart_info.cart_price+' ('+cart_info.cart_name+')');
		},
		error: function(xhr, tStatus, err){alert('Ajax 發生錯誤，'+xhr.responseText +'\n\n請與網站工程師連絡');}
	});	
}