<?php
require_once("array_init.php");
require_once("array_twzipcode.php");

//變數宣告
$obj_menu1     = new mysql_page();
$obj_menu2     = new mysql_page();
$obj_menu3     = new mysql_page();
$obj_menu4     = new mysql_page();	
$obj_menu5     = new mysql_page();
$obj_menu6     = new mysql_page();	
$obj_menu7     = new mysql_page();	
$obj_menu8     = new mysql_page();	
$obj_menu9     = new mysql_page();	
$obj_menu10    = new mysql_page();		
$obj_pages     = new mysql_page();	
$obj_banner    = new mysql_page();	
$obj_news      = new mysql_page();	
$obj_video     = new mysql_page();
$obj_cate      = new mysql_page();
$obj_cate1     = new mysql_page();
$obj_cate2     = new mysql_page();
$obj_admin     = new mysql_page();	
$obj_board     = new mysql_page();	
$obj_forum     = new mysql_page();		
$obj_album     = new mysql_page();		
$obj_photo     = new mysql_page();	
$obj_edm       = new mysql_page();
$obj_prod      = new mysql_page();
$obj_dogs      = new mysql_page();
$obj_member    = new mysql_page();
$obj_teacher   = new mysql_page();
$obj_order     = new mysql_page();	
$obj_order_d   = new mysql_page();		
$obj_cont      = new mysql_page();	
$obj_system    = new mysql_page();
$obj_file      = new mysql_page();		
$obj_links     = new mysql_page();		
$obj_stores    = new mysql_page();		
$obj_hits      = new mysql_page();		
$obj_log       = new mysql_page();		
//table_name
$main_str_pages    = 'pages';
$table_name_pages  = Proj_Name.'_'.$main_str_pages;
$main_str_banner   = 'banner';
$table_name_banner = Proj_Name.'_'.$main_str_banner;
$main_str_news     = 'news';
$table_name_news   = Proj_Name.'_'.$main_str_news;
$main_str_video    = 'video';
$table_name_video  = Proj_Name.'_'.$main_str_video;
$main_str_prof     = 'teacher';
$table_name_prof   = Proj_Name.'_'.$main_str_prof;
$main_str_album    = 'album';
$table_name_album  = Proj_Name.'_'.$main_str_album;
$main_str_prod     = 'products';
$table_name_prod   = Proj_Name.'_'.$main_str_prod;
$main_str_dogs     = 'dogs';
$table_name_dogs   = Proj_Name.'_'.$main_str_dogs;
$main_str_order    = 'orderlist';
$table_name_order  = Proj_Name.'_'.$main_str_order;
$main_str_links    = 'links';
$table_name_links  = Proj_Name.'_'.$main_str_links;
$main_str_stores   = 'stores';
$table_name_stores = Proj_Name.'_'.$main_str_stores;
$main_str_down     = 'download';
$table_name_down   = Proj_Name.'_'.$main_str_down;
$main_str_cont     = 'contact_form';
$table_name_cont   = Proj_Name.'_'.$main_str_cont;
$main_str_member   = 'member';
$table_name_member = Proj_Name.'_'.$main_str_member;
$main_str_board    = 'board';
$table_name_board  = Proj_Name.'_'.$main_str_board;
$main_str_forum    = 'forum';
$table_name_forum  = Proj_Name.'_'.$main_str_forum;
$main_str_edm      = 'edm';
$table_name_edm    = Proj_Name.'_'.$main_str_edm;
$main_str_admin    = 'admin';
$table_name_admin  = Proj_Name.'_'.$main_str_admin;
$main_str_hit      = 'hit_counts';
$table_name_hit    = Proj_Name.'_'.$main_str_hit;
$main_str_sys      = 'system_set';
$table_name_sys    = Proj_Name.'_'.$main_str_sys;
//this page
$this_page = $_SERVER['PHP_SELF'];
$this_page = explode('/',$this_page);
$this_page = $this_page[count($this_page)-1];
switch($this_page) {
	case 'pages_category.php':
		$page_title = '頁面類別管理';
		break;
	case 'pages_category_handle.php':
		$page_title = '頁面類別管理';
		break;
	case 'pages.php':
		$page_title = '頁面編輯管理';
		break;
	case 'pages_handle.php':
		$page_title = '頁面編輯管理';
		break;
	case 'banner.php':
		$page_title = 'Banner管理';
		break;
	case 'banner_handle.php':
		$page_title = 'Banner管理';
		break;
	case 'news_category.php':
		$page_title = '文章類別管理';
		break;
	case 'news_category_handle.php':
		$page_title = '文章類別管理';
		break;
	case 'news.php':
		$page_title = '文章管理';
		break;
	case 'news_handle.php':
		$page_title = '文章管理';
		break;
	case 'video_category.php':
		$page_title = '影片類別管理';
		break;
	case 'video_category_handle.php':
		$page_title = '影片類別管理';
		break;
	case 'video.php':
		$page_title = '影片管理';
		break;
	case 'video_handle.php':
		$page_title = '影片管理';
		break;
	case 'teacher.php':
		$page_title = '教練陣容管理';
		break;
	case 'teacher_handle.php':
		$page_title = '教練陣容管理';
		break;
	case 'album.php':
		$page_title = '相簿管理';
		break;
	case 'album_handle.php':
		$page_title = '相簿管理';
		break;
	case 'album_photos.php':
		$page_title = '相簿照片管理';
		break;
	case 'products_category.php':
		$page_title = '商品類別管理';
		break;
	case 'products_category_handle.php':
		$page_title = '商品類別管理';
		break;
	case 'products.php':
		$page_title = '商品資料管理';
		break;
	case 'products_handle.php':
		$page_title = '商品資料管理';
		break;
	case 'dogs.php':
		$page_title = 'Dog&apos;s List';
		break;
	case 'dogs_handle.php':
		$page_title = 'Dog&apos;s List';
		break;
	case 'dogs_agreement.php':
		$page_title = 'Agreement';
		break;
	case 'dogs_apply.php':
		$page_title = 'Application';
		break;
	case 'dogs_airport.php':
		$page_title = 'Airport';
		break;
	case 'dogs_adopted.php':
		$page_title = 'Adopted';
		break;
	case 'dogs_boarding.php':
		$page_title = 'Boarding';
		break;
	case 'dogs_photos.php':
		$page_title = 'Rescue Photos';
		break;
	case 'orderlist.php':
		$page_title = '訂單資料管理';
		break;
	case 'orderlist_handle.php':
		$page_title = '訂單資料管理';
		break;
	case 'analyze.php':
		$page_title = '營業報表統計';
		break;
	case 'links.php':
		$page_title = '相關連結管理';
		break;
	case 'links_handle.php':
		$page_title = '相關連結管理';
		break;
	case 'stores.php':
		$page_title = '商家資訊管理';
		break;
	case 'stores_handle.php':
		$page_title = '商家資訊管理';
		break;
	case 'download.php':
		$page_title = '檔案下載管理';
		break;
	case 'download_handle.php':
		$page_title = '檔案下載管理';
		break;
	case 'contact_form.php':
		$page_title = '聯絡我們表單';
		break;
	//=====================================
	case 'member.php':
		$page_title = '會員資料管理';
		break;
	case 'member_handle.php':
		$page_title = '會員資料管理';
		break;
	case 'board.php':
		$page_title = '留言板管理';
		break;
	case 'forum.php':
		$page_title = '討論區管理';
		break;
	case 'forum_reply.php':
		$page_title = '討論區回覆留言管理';
		break;
	case 'forum_reply_handle.php':
		$page_title = '討論區回覆留言管理';
		break;
	case 'edm.php':
		$page_title = 'EDM 管理';
		break;
	case 'edm_handle.php':
		$page_title = 'EDM 管理';
		break;
	//=====================================
	case 'admin.php':
		$page_title = '帳號管理';
		break;
	case 'admin_handle.php':
		$page_title = '帳號管理';
		break;
	case 'web_setting.php':
		$page_title = '網站設定管理';
		break;
	case 'system_setting.php':
		$page_title = '系統設定管理';
		break;
	case 'login.php':
		$page_title = '登入會員';
		break;
}
?>