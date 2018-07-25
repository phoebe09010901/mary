<?php
require_once(Root_Includes_Path.'class_category.php');		//class
$obj_cateloop  = new show_data_select();
//pages list
$query = "select Fullkey, title from ".$table_name_pages." where category=1 order by sort desc";
$obj_menu1->run_mysql_list($query);
//news list
$query = "select Fullkey, name from ".$table_name_news."_category where lang='".$_SESSION[Login_System_User]['lang']."' order by sort desc";
$obj_menu2->run_mysql_list($query);
//video list
$query = "select Fullkey, name from ".$table_name_video."_category where lang='".$_SESSION[Login_System_User]['lang']."' order by sort desc";
$obj_menu3->run_mysql_list($query);
?><div class="slidebar set_page_h">
<div class="skin page_shadow set_page_h">
    <div class="logo"><h2>
    <span class="shortname">J.Y.C.</span>
    <span class="fullname"><?=Company_Name?></span>
    </h2></div>
      <ul class="navigation">
         <li>
         	<a href="index.php"><span class="txt">首頁</span><span class="slideicon">A</span></a>
         </li>
         <li>
         	<a href="#"><span class="txt">Banner 管理</span><span class="slideicon">C</span></a>
         	<ul>
              <li><a href="banner.php?category=1">首頁 Banner</a></li>
              <li><a href="banner.php?category=2">Banner I</a></li>
              <li><a href="banner.php?category=3">Banner II</a></li>
         	</ul>
         </li>
         <li>
         	<a href="#"><span class="txt">Adoption</span><span class="slideicon">B</span></a>
         	<ul>
              <li><a href="pages_handle.php?category=2&Fullkey=7">Adoption</a></li>
              <li><a href="dogs.php?search_type=pub1&category=1">Doggie Profile</a></li>
              <li><a href="dogs_apply.php">Application</a></li>
              <li><a href="dogs_agreement.php">Agreement</a></li>
              <li><a href="dogs_airport.php">Airport</a></li>
              <li><a href="dogs_adopted.php">Adopted</a></li>
              <li><a href="dogs_boarding.php">Boarding</a></li>
         	</ul>
         </li>
         <li>
         	<a href="#"><span class="txt">Happy Tails</span><span class="slideicon">B</span></a>
         	<ul>
              <li><a href="video.php?category=1">Testimonials Videos</a></li>
              <li><a href="album.php?category=1">Adoption Photos</a></li>
              <li><a href="album.php?category=2">Monthly Meet Up Photos</a></li>
              <li><a href="album.php?category=4">Airport Pickup</a></li>
         	</ul>
         </li>
         <li>
         	<a href="#"><span class="txt">Rescue</span><span class="slideicon">B</span></a>
         	<ul>
              <li><a href="pages_handle.php?category=2&Fullkey=5">Rescue</a></li>
              <li><a href="banner.php?category=4">Rescue Banner</a></li>
              <li><a href="video.php?category=2">Rescue Videos</a></li>
              <li><a href="album.php?category=3">Adopted Dogs Photos</a></li>
         	</ul>
         </li>
         <li>
         	<a href="#"><span class="txt">Training</span><span class="slideicon">B</span></a>
         	<ul>
              <li><a href="pages_handle.php?category=2&Fullkey=4">Training</a></li>
              <li><a href="banner.php?category=5">Training Banner</a></li>
              <li><a href="video.php?category=3">Training Videos</a></li>
         	</ul>
         </li>
         <li>
         	<a href="#"><span class="txt">About</span><span class="slideicon">B</span></a>
         	<ul>
			 <?php
             for($i=0; $i<$obj_menu1->obj_all; $i++) {
                $menu = mysql_fetch_array($obj_menu1->result); 
                if($menu) {
                ?><li><a href="pages_handle.php?category=1&Fullkey=<?=$menu['Fullkey']?>"><?=$menu['title']?></a></li><?php	
                }
             }
             ?>
              <li><a href="news_category.php">文章管理</a>
                  <ul>
                 <?php
                 for($i=0; $i<$obj_menu2->obj_all; $i++) {
                    $menu = mysql_fetch_array($obj_menu2->result); 
                    if($menu) {
                    ?><li><a href="news.php?category=<?=$menu['Fullkey']?>"><?=$menu['name']?></a></li><?php	
                    }
                 }
                 ?>
                  </ul>
              </li>
         	</ul>
         </li>
         <li>
         	<a href="#"><span class="txt">Contact</span><span class="slideicon">B</span></a>
         	<ul>
              <li><a href="pages_handle.php?category=2&Fullkey=3">Contact</a></li>
              <li><a href="contact_form.php">連絡我們管理</a></li>
         	</ul>
         </li>
         <li>
         	<a href="#"><span class="txt">Donate</span><span class="slideicon">B</span></a>
         	<ul>
              <li><a href="pages_handle.php?category=2&Fullkey=6">Donate</a></li>
              <li><a href="banner.php?category=6">Donate Banner</a></li>
         	</ul>
         </li>
         <li type='separator'></li>
         <?php if($_SESSION[Login_System_User]['lv']=='admin') { ?>
         <li>
           <a href="web_setting.php"><span class="txt admintxt">網站設定管理</span><span class="adminbtn">Y</span></a>
         </li>
         <li>
           <a href="admin.php"><span class="txt admintxt">後台帳號管理</span><span class="adminbtn">X</span></a>
         </li>
         <?php } ?>
         <li>
           <a href="logout.php"><span class="txt admintxt">登出</span><span class="adminbtn">Z</span></a>
         </li>
      </ul>
      <div class="info_box"></div>
      <div class="info info_box">
         <span class="cms">Cloud. CMS</span>
         <span class="version">v1.0</span>
      </div>
   </div><!--skin end-->
</div><!--slidebar end-->