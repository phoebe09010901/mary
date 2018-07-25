//Menu js

var TabbedContent = {
	init: function() {	
		$(".tab_icon").click(function() {
			var current = $(this).find(".current");
			$(".tab_icon").removeClass('current');
			$(this).addClass('current');
			$("#icon_position").show().animate({width:"320px"},250);
		});
		
		$("#menu li").click(function() {
			var menuid = $(this).attr("id");
		    $('#submenu .link').removeClass('current').hide();
		    $('#'+'call'+menuid).fadeIn(200).addClass('current');	
		});
		
		$(".close").click(function(){
			$(".slidebar").animate({left:"-18%"},'fast');
			$(".main").animate({width:"92%"},'fast');
			$(".close").hide();
			$(".open").fadeIn();
		});
		$(".open").click(function(){
			$(".slidebar").animate({left:"0"},'fast');
			$(".main").animate({width:"80%"},'fast');
			$(".close").fadeIn();
			$(".open").hide();
		});
		$(".top").click(function(){
			jQuery('html,body').animate({scrollTop: '0px'}, 200);
			return false;
		});
		$(window).scroll(function() {
        	if ( $(this).scrollTop() > 200){
            $('.top').fadeIn('fast');
        	} else {
            $('.top').stop().fadeOut('fast');
        	}
    	});
		$(function(){
            $("ul.navigation > li:has(ul) > a").append('<div class="nav_arrow">w</div>');
            $("ul.navigation > li ul li:has(ul) > a").append('<div class="nav_arrow">w</div>');
});
	}
}

$(document).ready(function() {
	TabbedContent.init();
});

