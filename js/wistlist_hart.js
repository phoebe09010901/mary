// JavaScript Document

$(function(){
	
	/* 這個可以運作，但是下面那段就失效了
	for (i=0; i<=5; i++) {
		document.write(i + "<BR>");
	}
	
	
	for (i=1; i<=100; i++) {
		$("#wist_icon_"+i).click(function(){
			$("#wist_icon_"+i).animate({
				top:'-100px',
				opacity:'0'
			},1000);
			$("#wist_icon3_"+i).animate({
				opacity:'1'
			},1000);
		});
	}
	*/
	
	$("#wist_icon_1").click(function(){
		$("#wist_icon_1").animate({
			top:'-100px',
			opacity:'0'
		},1000);
		$("#wist_icon3_1").animate({
			opacity:'1'
		},1000);
	});
	$("#wist_icon_2").click(function(){
		$("#wist_icon_2").animate({
			top:'-100px',
			opacity:'0'
		},1000);
		$("#wist_icon3_2").animate({
			opacity:'1'
		},1000);
	});
	
	
	
});