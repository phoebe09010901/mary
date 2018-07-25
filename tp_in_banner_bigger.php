<style type="text/css">
.bzBanner .content,.bzBanner .col,.bzBanner .col {width:97.5%; height:97.5%; position: absolute; top:0px; left:8px; }
/*.bzBanner .btn{position: absolute; bottom:25px; z-index:5; left:43.5%; }*/
.bzBanner .btn{ position: absolute; z-index:5;bottom:20px; width:100%;}
			
			
			
.bzBanner .btn i{display:block; float: left; width:9px; height:9px; padding:0 0px; border-radius:15px; margin-left:11px; background:#E8E8E8;cursor:pointer; border:#FFF 4px solid; }
.bzBanner .btn i:hover{background:#000; }
.bzBanner .btn i.act{opacity:0.8; filter:alpha(opacity=80); background:#000; }
.bzBanner .pre,.bzBanner .next{display:inline-block; width:72px; height:72px; background:url(bzbanner/btn.png) no-repeat; position:absolute; top:50%; margin-top:-50px; z-index:3;}
.bzBanner .pre{ position:absolute; top:50%; z-index:3; left:-23px; }
.bzBanner .next{position:absolute; top:50%; z-index:3; right:-23px; background-position:0 -72px; }
.bzBanner .pre:hover{position:absolute; top:50%; z-index:3; left:-23px; /*background-position:0 -144px;*/ }
.bzBanner .next:hover{position:absolute; top:50%; z-index:3; right:-23px; background-position:0 -72px; /*background-position:0 -216px;*/ }
.bzBanner .col a{color:white; }
.bzBanner .col span{display:inline-block; width:550px; height:200px; background:rgba(0,0,0,.1); position:absolute; z-index:3; bottom:70px; left:130px; }
.bzBanner .col span h3{font-weight:normal; font-size:28px; font-weight:normal; font-family:微软雅黑; padding:0px; margin:0px; padding-left:20px; line-height:70px; text-shadow:1px 1px rgba(0,0,0,.3); }
.bzBanner .col span p{display:inline-block; width:90%; line-height:25px; font-size: 14px; font-family:微软雅黑; margin:0px; padding:0px; padding-left:20px; text-shadow:1px 1px rgba(0,0,0,.3); }


.banner_text {
	position:absolute;
	left:370px;
	top:100px;
	display:block;
	width:100%;
	height:60px;
	color:#fff;
}
.banner_text2 {
	position:absolute;
	left:80px;
	top:50px;
	display:block;
	width:100%;
	height:60px;
	color:#fff;
}

.flick-sub-text {
	font-family: "Museo Sans 500";
	padding: 5px;
	font-weight: 500;
	line-height: 18px;
	color: #FFF;
	text-align: left;
	font-size: 18px;
	margin-top: 10px;
	margin-bottom: 10px;
}
.flick-sub-text2 {
	font-family: "Museo Sans 500";
	padding: 5px;
	font-weight: 500;
	line-height: 18px;
	color: #000;
	text-align: left;
	font-size: 18px;
	margin-top: 10px;
	margin-bottom: 10px;
}

.in_btn3 a{/*phoebe*/
	font-family: "Myriad Pro";
	font-size: 13px;
	color: #FFFFFF;
	background-color: #a7ca01;
	-webkit-border-radius: 3px;   /*元角*/
	padding-top: 5px;
	padding-right: 20px;
	padding-bottom: 5px;
	padding-left: 20px;
	font-weight: bolder;
	text-decoration:none;
	}		
.in_btn3 a:hover{
	font-family: "Myriad Pro";
	font-size: 13px;
	color: #d5e044;
	background-color: #e84693;
	-webkit-border-radius: 3px;   /*元角*/
	padding-top: 5px;
	padding-right: 20px;
	padding-bottom: 5px;
	padding-left: 20px;
	font-weight: bolder;
	}

</style>

<div class='bzBanner'>
	<div class='content'>
    	<?php
		//首頁Banner
		$query = "select * from $table_name_banner where category=1 and pub=1 order by sort desc";
		$obj_banner->run_mysql_list($query);
		for($i=0; $i<$obj_banner->obj_all; $i++) {
			$banner = mysql_fetch_array($obj_banner->result);	
			if($banner) {
				switch($banner['style']) {
					case 1:
						$class_style1 = "";
						$class_style2 = "";
						break;
					case 2:
						$class_style1 = "2";
						$class_style2 = "2";
						break;
					case 3:
						$class_style1 = "2";
						$class_style2 = "";
						break;
				}
			?>
    	<div class='col'>
        	<img src='banner/<?=$banner['file1']?>' width="100%" />
            <div class="banner_text<?=$class_style1?>">
          		<div class="flick-title<?=$class_style2?>"><?=str_replace("|", "<br>", stripslashes($banner['title']))?></div>
                <div class="flick-sub-text"><?=nl2br(stripslashes($banner['content']))?></div>
                <div class="in_btn3"><a href="<?=$banner['url_to']?>">LEARN MORE</a></div>
          	</div>
        </div>
            <?php	
			}
		}
		?>
	</div>
	<a class='pre' href='javascript:;' title='上一張' ></a>
	<a class='next' href='javascript:;' title='下一張' ></a>
</div>

<!-- 光箱 開始 -->
<script type="text/javascript" src="js/jquery-1.11.0.min.js"></script> 
<script type="text/javascript" src="js/jquery.fancybox.js?v=2.1.5"></script>
<link rel="stylesheet" type="text/css" href="css/jquery.fancybox.css?v=2.1.5" media="screen" />
<script type="text/javascript">
	$(document).ready(function() {
		$('.fancybox').fancybox();
	});
</script>
<!-- 光箱 結束 -->

<!-- banner動畫 開始 -->
<script type="text/javascript" src="banner111_files/bzbanner.min.js"></script>
<script type="text/javascript">
	$(function(){ benzi.bzBanner(); });
</script>
<!-- banner動畫 結束 -->

<!-- 上方menu 開始 -->
<script>
$(function(){
	$("#MENU > ul > li").hover(function(){
		var N = this.id.substr(4);
		$("#SUB"+N).stop(true,true).slideDown();
	},function(){
		var N = this.id.substr(4);
		$("#SUB"+N).stop(true,true).slideUp();
	});
});
</script>
<!-- 上方menu 結束 -->