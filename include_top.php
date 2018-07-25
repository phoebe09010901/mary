<?php
	//抓取當前網址>檔名
	$path = $_SERVER['PHP_SELF'];
	$file = basename ($path, ".php");
	echo substr($file, 0, 0);
?>
	<div class="center_T">
    	<div class="center_btn_L"><a href="index.php"><img src="images/logo.svg" width="158" height="162"></a></div>
        <?php if($file == 'index'){ echo "<div class=\"center_btn_Rindex\">"; } else if($file == 'donate') { echo "<div class=\"center_btn_R2\">"; } else { echo "<div class=\"center_btn_R\">";}?>
        	
            
            <div class="fb"><a href="#"><img src="images/fb.png" width="26" height="26"></a></div>
            
            <a class="fancybox fancybox.iframe" href="wishlist_01.php">
                <div class="wistlist">
					<?php if(count($tmp_wishlist)>2){ ?>
                    <div class="icon"><img src="images/wistlist_icon_02.png" width="100%"/></div>
                    <div class="text font-family_01 font-size_15 color_01">Wish List (<?=number_format(count($tmp_wishlist)-2)?>)</div>
					<?php }else{ ?>
                    <div class="icon"><img src="images/wistlist_icon.png" width="100%"/></div>
                    <div class="text font-family_01 font-size_15 color_01">Wish List (0)</div>
					<?php } ?>
                </div>
            </a>
            
            <div style="clear:both;"></div>
            
            <div id="MENU" class="topbtn_allmenu" <?php if($file == 'index'){ echo "style=\"margin-top: 98px;\">"; } else { echo "style=\"margin-top: 98px;\">"; }?>
                <ul class="megamenu">
                    <?php if($file == 'adoption' || $file == 'adoption_1'){ echo "<li id=\"MENU1\" class=\"a_select\"><a href=\"adoption.php\">Adoption</a></li>"; } else { echo "<li id=\"MENU1\" class=\"top_btn_01\"><a href=\"adoption.php\">Adoption</a></li>"; }?>
                    <?php if($file == 'happytails' || $file == 'happytails_2' || $file == 'happytails_3' || $file == 'happytails_3_photos' || $file == 'happytails_4' || $file == 'happytails_4_album'){ echo "<li id=\"MENU2\" class=\"b_select\"><a href=\"happytails.php\">Happy Tails</a></li>"; } else { echo "<li id=\"MENU2\" class=\"top_btn_02\"><a href=\"happytails.php\">Happy Tails</a></li>"; }?>
                    <?php if($file == 'rescue' || $file == 'rescue_2'){ echo "<li id=\"MENU3\" class=\"c_select\"><a href=\"rescue.php\">Rescue</a></li>"; } else { echo "<li id=\"MENU3\" class=\"top_btn_03\"><a href=\"rescue.php\">Rescue</a></li>"; }?>
                    <?php if($file == 'training'){ echo "<li id=\"MENU4\" class=\"d_select\"><a href=\"training.php\">Training</a></li>"; } else { echo "<li id=\"MENU4\" class=\"top_btn_04\"><a href=\"training.php\">Training</a></li>"; }?>
                    
                    <?php if($file == 'about'){ echo "<li id=\"MENU5\" class=\"e_select\"><a href=\"about.php\">About</a>"; } else { echo "<li id=\"MENU5\" class=\"top_btn_05\"><a href=\"about.php\">About</a>"; }?>
                        <ul id="SUB5">
                            <li>
                                <div class="top_btn_s_menu">
                                    <div class="top_btn_s_menu_btn">
                                        <span class="top_btns"><a href="about.php#Our Team">Our Team</a></span> <br />
                                        <span class="top_btns"><a href="about.php#Adoption Process">Adoption Process</a></span> <br />
                                        <span class="top_btns"><a href="about.php#Volunteer">Volunteer</a></span><br />
                                        <span class="top_btns"><a href="about.php#Partners">Partners</a></span> <br />
                                        <span class="top_btns"><a href="about.php#FAQ">FAQ</a></span> <br />
                                    </div>
                                    <div class="top_btn_s_menu_pic"><img src="images/000.jpg" width="106" height="90" /></div>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <?php if($file == 'contact'){ echo "<li id=\"MENU6\" class=\"f_select\"><a href=\"contact.php\">Contact</a></li>"; } else { echo "<li id=\"MENU6\" class=\"top_btn_06\"><a href=\"contact.php\">Contact</a></li>"; }?>
                    <li id="MENU6" class="top_btn_08"><a href="#">Donate</a></li>
                    <li id="MENU7" class="top_btn_08"><a href="#">Shop</a></li>
                </ul>
            </div>
        </div>
        <div style="width:1px; height:166px;"></div><!-- 撐高用 -->
    </div>