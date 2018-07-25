<?php
class jqx {
	//init
	function jqx() {
		$this->twzipcode_url = Host_Name.'twzipcode_data.php';
		$this->cnregion_url  = 'cnregion_data.php';
	}
	//下拉式縣市選單
	function twzipcode($twzipcode_id, $input_value) {
		$input_value = ($input_value)?$input_value:0;
		//twzipcode start
		echo 'var url = "'.$this->twzipcode_url.'";';
		// prepare the data
		echo 'var source =
		{
			datatype: "json",
			datafields: [
				{ name: \'label\' },
				{ name: \'value\' }
			],
			id: \'zipcode\',
			url: url,
			async: false
		};';
		echo 'var dataAdapter = new $.jqx.dataAdapter(source);';
		echo 'var to_index;';
		echo '$("#'.$twzipcode_id.'").jqxDropDownList({ selectedIndex: 0, source: dataAdapter, displayMember: "label", valueMember: "value", width: 200, height: 25, theme: theme, renderer: function (index, label, value) {';
		echo '	if(value=='.$input_value.') { to_index = index; }';
		echo '	return label;';
		echo '}});';
		echo '$("#'.$twzipcode_id.'").jqxDropDownList("selectIndex", to_index);';
		echo '$("#'.$twzipcode_id.'").jqxDropDownList("ensureVisible", to_index);';
		echo '$("#'.$twzipcode_id.'").on(\'select\', function (event) {
			if (event.args) {
				var args = event.args;
				var value = args.item.value;//alert(value);
			}
		});';
	}
	//大陸地區選單
	function cnregion($region_id, $input_value1, $input_value2, $input_value3) {
		$input_value1 = ($input_value1)?$input_value1:0;
		$input_value2 = ($input_value2)?$input_value2:0;
		$input_value3 = ($input_value3)?$input_value3:0;
		
		echo 'function get_cnregion_data(region_id, lv, parent_id, input_value) {
			var url = "cnregion_data.php?action=get_region&lv="+lv+"&parent_id="+parent_id;
			var source =
			{
				datatype: "json",
				datafields: [
					{ name: \'label\' },
					{ name: \'value\' },
					{ name: \'lv\' }
				],
				id: region_id,
				url: url,
				async: false
			};
			var dataAdapter = new $.jqx.dataAdapter(source);
			var to_index;
			$("#"+region_id+lv).jqxDropDownList({ selectedIndex: 0, source: dataAdapter, displayMember: "label", valueMember: "value", width: 200, height: 25, theme: theme, renderer: function (index, label, value) {	
				if(value==input_value) { to_index = index; }	
				return label;
			}});
			$("#"+region_id+lv).jqxDropDownList("selectIndex", to_index);
			$("#"+region_id+lv).jqxDropDownList("ensureVisible", to_index);
			$("#"+region_id+lv).on(\'select\', function (event) {
				if (event.args) {
					var args      = event.args;
					var parent_id = args.item.value;
					//取得 region 階層
					var url = "cnregion_data.php?action=get_lv&region_id="+parent_id;
					$.ajax({
						url: url,
						type: \'GET\',
						dataType: \'json\',
						processData: true,
						success: function(request){
							var cnregion_info = request;
							$.each(cnregion_info, function(key, value){
								$.each(value, function(key1, value1){	
									$.each(value1, function(key2, value2){	
										if(value2==1) {
											lv = parseInt(value2) + 1;
											get_cnregion_data(region_id, lv, parent_id);
											lv = parseInt(lv) + 1;
											get_cnregion_data(region_id, lv, 0);
										}else if(value2==2) {
											lv = parseInt(value2) + 1;
											get_cnregion_data(region_id, lv, parent_id);
										}
									});
								});
							});
						},
						error: function(xhr, tStatus, err){alert(\'Ajax 發生錯誤，\'+xhr.responseText +\'\n\n請與網站工程師連絡\');}
					});	
				}
			});
		}';
		echo 'get_cnregion_data("'.$region_id.'", 1, 1, '.$input_value1.');';
        echo 'get_cnregion_data("'.$region_id.'", 2, '.$input_value1.', '.$input_value2.');'; 
        echo 'get_cnregion_data("'.$region_id.'", 3, '.$input_value2.', '.$input_value3.');'; 
	}
	//datepicker
	function datepicker($datepicker_id, $input_date) {
		if(!$input_date) {
			$input_date = date("Y-m-d");	
		}
		$input_date = explode("-", $input_date);
		$year  = $input_date[0];
		$month = $input_date[1];
		$tmp_m = $month - 1;
		$day   = $input_date[2];
		
		echo 'var date = new Date();';
		echo 'date.setFullYear('.$year.', '.$tmp_m.', '.$day.');';
		echo '$(\'#'.$datepicker_id.'\').jqxDateTimeInput({ culture: \'tc-TC\', height: 22, value: $.jqx._jqxDateTimeInput.getDateTime(date), formatString: \'yyyy-MM-dd\', culture: \'zh-TW\', theme: theme });';
		echo '$(\'#'.$datepicker_id.'\').after(\'(點日曆表頭一次切換月/二次切換年)\');';
	}
}
?>