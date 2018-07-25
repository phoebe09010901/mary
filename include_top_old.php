<?php
	//抓取當前網址>檔名
	$path = $_SERVER['PHP_SELF'];
	$file = basename ($path, ".php");
	echo substr($file, 0, 0);
?>
	<div class="center_T">
    	<div class="fb"><a href="#"><img src="images/fb.png" width="26" height="26"></a></div>
        
        <div class="center_btn_L"><a href="index.php"><img src="images/logo.svg" width="158" height="162"></a></div>
        <?php if($file == 'index'){ echo "<div class=\"center_btn_Rindex\">"; } else if($file == 'donate') { echo "<div class=\"center_btn_R2\">"; } else { echo "<div class=\"center_btn_R\">";}?>
        	<div class="topbtn_allmenu">
            	<ul class="megamenu">
                    <li><?php if($file == 'adoption' || $file == 'adoption_1'){ echo "<span class=\"a_select\"><a href=\"adoption.php\">Adoption</a></span>"; } else { echo "<span class=\"top_btn_01\"><a href=\"adoption.php\">Adoption</a></span>"; }?></li>
                    <li><?php if($file == 'happytails'){ echo "<span class=\"b_select\"><a href=\"happytails.php\">Happy Tails</a></span>"; } else { echo "<span class=\"top_btn_02\"><a href=\"happytails.php\">Happy Tails</a></span>"; }?></li>
                    <li><?php if($file == 'rescue'){ echo "<span class=\"c_select\"><a href=\"rescue.php\">Rescue</a></span>"; } else { echo "<span class=\"top_btn_03\"><a href=\"rescue.php\">Rescue</a></span>"; }?></li>
                    <li><?php if($file == 'training'){ echo "<span class=\"d_select\"><a href=\"training.php\">Training</a></span>"; } else { echo "<span class=\"top_btn_04\"><a href=\"training.php\">Training</a></span>"; }?></li>
                    <li><?php if($file == 'about'){ echo "<span class=\"e_select\"><a href=\"about.php\">About</a></span>"; } else { echo "<span class=\"top_btn_05\"><a href=\"about.php\">About</a></span>"; }?>
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
                    <li><?php if($file == 'contact'){ echo "<span class=\"f_select\"><a href=\"contact.php\">Contact</a></span>"; } else { echo "<span class=\"top_btn_06\"><a href=\"contact.php\">Contact</a></span>"; }?></li>
                    <!--<li><?php if($file == 'donate'){ echo "<span class=\"g_select\"><a href=\"donate.php\">Donate</a></span>"; } else { echo "<span class=\"top_btn_07\"><a href=\"donate.php\">Donate</a></span>"; }?></li>-->
                    <li><span class="top_btn_08"><a href="#">Donate</a></span></li>
                    <li><span class="top_btn_08"><a href="#">Shop</a></span></li>
                </ul>
            </div>
        </div>
        <div style="width:1px; height:166px;"></div><!-- 撐高用 -->
    </div>