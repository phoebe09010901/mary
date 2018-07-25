<link href="css/page.css" rel="stylesheet" type="text/css" />
<link href="css/cloud_admin.css" rel="stylesheet" type="text/css" />
<link href="css/login.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="../jqwidgets/styles/jqx.base.css" type="text/css" />
<link rel="stylesheet" href="../jqwidgets/styles/jqx.shinyblack.css" type="text/css" />
<script type="text/javascript" src="../scripts/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="../scripts/gettheme.js"></script>
<script type="text/javascript" src="../jqwidgets/globalization/globalize.js"></script>
<script type="text/javascript" src="../jqwidgets/globalization/globalize.culture.zh-TW.js"></script>
<script type="text/javascript" src="../jqwidgets/jqxcore.js"></script>
<script type="text/javascript" src="../jqwidgets/jqxwindow.js"></script>
<script type="text/javascript" src="../jqwidgets/jqxtooltip.js"></script>
<script type="text/javascript" src="../jqwidgets/jqxscrollbar.js"></script>
<!-- dockpanel -->
<script type="text/javascript" src="../jqwidgets/jqxdockpanel.js"></script>
<!-- menu -->
<script type="text/javascript" src="../jqwidgets/jqxmenu.js"></script>
<script type="text/javascript" src="js/page.js"></script>
<!-- input -->
<script type="text/javascript" src="../jqwidgets/jqxbuttons.js"></script>
<script type="text/javascript" src="../jqwidgets/jqxcheckbox.js"></script>
<script type="text/javascript" src="../jqwidgets/jqxradiobutton.js"></script>
<script type="text/javascript" src="../jqwidgets/jqxdropdownlist.js"></script>
<script type="text/javascript" src="../jqwidgets/jqxcombobox.js"></script>
<!-- array -->
<script type="text/javascript" src="../js/js_array.js"></script>

<script type="text/javascript">
$(document).ready(function () {
	var theme = '<?=jqxStyle?>';
	
	$('.addButton').jqxButton({ width: 60, height: 25, theme: theme });
	$('.editButton').jqxButton({ width: 60, height: 25, theme: theme });
	$('.delButton').jqxButton({ width: 60, height: 25, theme: theme });
	$('#acceptInput').jqxCheckBox({ width: 130, theme: theme });
	$('#prevpageButton').jqxButton({ width: 25, height: 25, theme: theme });
	$('#nextpageButton').jqxButton({ width: 25, height: 25, theme: theme });
	
	$("#lang_list").change(function(){
		var set_lang = $("#lang_list").val();
		if(set_lang) {
			<?php
			if($main_str=='system_set')
				$change_page = 'web_setting';
			else
				$change_page = $main_str;
			?>
			location.href = '<?=$change_page?>.php?action=change_lang&set_lang='+set_lang;
		}						   
	});
});
</script>
<script type="text/javascript" charset="utf8">
<!--
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}
function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
//check email
function validateEmail(email) {
	regularExpression = /^[^\s]+@[^\s]+\.[^\s]{2,3}$/;
	if (regularExpression.test(email)) {
		return true;
	}else{
		return false;
	}
}
//check number
function isNumber(val){
	var reg = /^[0-9]*$/;
	return reg.test(val);
}
//check mobile
function isMobile(mobile) {
	error_msg = '';
	if ( !mobile.match(/^09[0-9]{8}$/) ) {
	  error_msg = '手機號碼長度必須為10碼數字，必定為09開頭';
	}
	return error_msg;
}
//Add data
function real_add() {
	location.href='<?=$main_str?>_handle.php?<?=$my_query_string?>';
}
//Edit data
function real_edit(id) {
	location.href = '<?=$main_str?>_handle.php?Fullkey='+id+'&page_go=<?=$page_go?>&<?=$my_query_string?>';
}
//Del data
function real_del(id, obj) {
	if(confirm('確定要刪除 '+obj+' 此筆紀錄?')) {
		location.href = '<?=$main_str?>.php?action=delete&Fullkey='+id;
	}
}
//select all
function real_select_all(checked) {
	$("input[name='IDlist[]']").prop("checked", checked);
	scan_batch();
}
//Change state
function change_power(id, row_name, value) {
	//alert(value);
	if(id) {
		if(value==true)
			value = 1;
		else if(value==false)
			value = 0;
		$.ajax({
			url: '<?=$main_str?>_data.php',
			type: 'GET',
			data: {action:'update_row', data_id:id, row_name:row_name, row_value:value},
			dataType: 'html',
			processData: true,
			success: function(request){<?php if($this_page!='dogs.php?search_type=pub1&category=1'){ ?>if(value==true){alert("資料更改成功");}else{alert("資料已下架");}<?php }else{ ?>if(row_name=='pub'){alert("資料更改成功");}else if(row_name=='verify'){alert("審核狀態變更成功");location.reload();}<?php } ?>},
			error: function(xhr, tStatus, err){alert('Ajax 發生錯誤，請與網站工程師連絡');}
		});	
	}
}
//Change data sort
function change_sort(id, row_name, value, e) {
	if(id && e.keyCode==13) {
		if(isNumber(value)) {
			$.ajax({
				url: '<?=$main_str?>_data.php',
				type: 'GET',
				data: {action:'update_row', data_id:id, row_name:row_name, row_value:value},
				dataType: 'html',
				processData: true,
				success: function(request){location.reload();},
				error: function(xhr, tStatus, err){alert('Ajax 發生錯誤，請與網站工程師連絡');}
			});	
		}else {
			alert("請輸入數字");	
		}
	}
}
</script>
<style type="text/css">
.<?=$main_str?>-table {
	margin-top: 10px;
	margin-bottom: 10px;
	width:100%;
}
</style>