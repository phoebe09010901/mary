<?php
header("content-type:text/html;charset=utf-8");
require_once('set.php');

$page_id = 6;
$query = "select * from $table_name_pages where Fullkey='$page_id'";
$pages = $obj_pages->run_mysql_out($query);
//banner
$query = "select * from $table_name_banner where category=6 and pub=1 order by sort desc";
$obj_banner->run_mysql_list($query);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<meta name="viewport" content="width=device-width, initial-scale=1">

<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<link href="fonts.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="css/all.css">
<link rel="stylesheet" href="css/top_menu.css">

<title><?=Html_Title?></title>
<link rel="icon" type="image/png" href="favicon.png" />
<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
<link rel="apple-touch-icon" href="favicon_m.png"/>

<style type="text/css">
<!--
body {
	background: url(images/g_bg.jpg) repeat-x top left #c2cb56;
}
-->
</style>

<!-- 表單 開始 -->
<link rel="stylesheet" href="css/donate.css">
<style type="text/css">
.pagedonate_bar { font-size: 16px; color: #FFF;font-family: HelveticaNeueW01-55Roma;font-weight: normal;line-height: 20px;padding-bottom:0;margin: 305px 20px 0 30px;}
.pagedonate_bar p { margin: 0; }
.pagedonate_bar p + p { margin-top: 10px; }
h2.pagedonate_bar { margin-left:30px; }
div.pagedonate_bar { padding-top: 5px; }
#contribution .fieldlabel { font-weight: normal !important; }
#contribution .fieldlabel[for="custom1"], #contribution label[for="signup_optin"] { text-transform: none !important; }
#contribution input#processbutton {box-shadow: none; margin-bottom: 20px;}
#contribution .nested_table td+td {width: 52%;}
#lastname, #zip { width: 75%; }
#addr1, #addr2, #city, #email, #phone { width: 350px; }
.popuphelp img { display: inline; }
</style>
<link rel="stylesheet" href="css/display_page.css" type="text/css">
<!-- 表單 結束 -->

<!-- 輪播 開始 -->
<link rel="stylesheet" type="text/css" href="css/content_banner.css" />
<script src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/slideshow.js"></script>
<script type="text/javascript">
//<![CDATA[
	$(function() {
	Slideshow.initialize('#slideshow', [
	<?php
	for($i=0; $i<$obj_banner->obj_all; $i++) {
		$banner = mysql_fetch_array($obj_banner->result);
		if($banner) {
		?>
	{
		image: "banner/<?=$banner['file1']?>",
		desc: "",
		title: "<?=stripslashes($banner['title'])?>",
		url: "<?=$banner['url_to']?>",
		id: ""
	}
		<?php
		}
		if($i<$obj_banner->obj_all-1)
			echo ',';
	}
	mysql_data_seek($obj_banner->result, 0);
	?>
	]);

	});
//]]>
</script>
<!-- 輪播 結束 -->

</head>

<body>

<div id="wrapper_center_07">

	<?php include('include_top.php');?>

	<!----------- 內容 開始 ------------------>
	<div class="donate">
        <span class="ce_title15"><?=stripslashes($pages['title'])?></span>

        <div class="donate_1">
          	<div class="donate_1_1">
            	<div id="slideshow">
                <div class="container">
					<?php
                    for($i=0; $i<$obj_banner->obj_all; $i++) {
                        $banner = mysql_fetch_array($obj_banner->result);
                        if($banner) {
                        ?>
                        <div class="slide" id="slide-<?=$i?>" style="background-image: url(banner/<?=$banner['file1']?>); display: <?=($i==0)?'block':'none'?>;"></div>
                        <?php
                        }
                    }
                    ?>
                </div>
                </div>
          	</div>
          	<div class="donate_1_2">
            	<span class="ce_title12"><?=stripslashes($pages['content'])?></span>
          	</div>
		</div>

        <div class="donate_2_1">
        	<?=stripslashes($pages['content2'])?>
            <!--<div class="donate_2_1_1">Bank Transfer</div>-->
            <div class="contribheader" id="bsd-contribution-header-contributor">Bank Transfer</div>
            <div style="border-bottom:1px #ddd dashed; height:90px;">
            	如果您選擇銀行轉帳，請在匯款後填寫以下資料，我們將近快與您聯絡。<br /><br />
                銀行名稱：<br />
                銀行代碼：123<br />
                銀行帳號：1234-1234-1234-1234
            </div>
            <div style="margin-top:10px; margin-bottom:10px;">
                <label class="fieldlabel" style="color:#999999">Amount<br></label>
                <div style="width:100%; height:30px;">
                    <input type="radio" name="radiog_dark" id="radio1" class="css-checkbox" />
                    <label for="radio1" class="css-label3"><span class="checkbox">$25</span></label>&nbsp;&nbsp;
                    <input type="radio" name="radiog_dark" id="radio2" class="css-checkbox" />
                    <label for="radio2" class="css-label3"><span class="checkbox">$50</span></label>&nbsp;&nbsp;
                    <input type="radio" name="radiog_dark" id="radio3" class="css-checkbox" />
                    <label for="radio3" class="css-label3"><span class="checkbox">$100</span></label>&nbsp;&nbsp;
                    <input type="radio" name="radiog_dark" id="radio4" class="css-checkbox" />
                    <label for="radio4" class="css-label3"><span class="checkbox">$250</span></label>&nbsp;&nbsp;
                    <input type="radio" name="radiog_dark" id="radio5" class="css-checkbox" />
                    <label for="radio5" class="css-label3"><span class="checkbox">$500</span></label>&nbsp;&nbsp;
                    <input type="radio" name="radiog_dark" id="radio6" class="css-checkbox" />
                    <label for="radio6" class="css-label3"><span class="checkbox">$1000</span></label>&nbsp;&nbsp;
                    <input type="radio" name="radiog_dark" id="radio7" class="css-checkbox" />
                    <label for="radio7" class="css-label3"><span class="checkbox">$2500</span></label>
                </div>
                <div style="width:100%; height:30px;">
                    <input type="radio" name="radiog_dark" id="radio8" class="css-checkbox" />
                    <label for="radio8" class="css-label3"><span class="checkbox">Other： <input name="textfield" type="text" class="f3" id="textfield" /> (USD)</span></label>
                </div>
            </div>
            <div style=" margin-bottom:10px;">
                <label class="fieldlabel" style="color:#999999">country<br></label>
                <select id="country" name="country">
                    <option value=""></option>
                    <option value="AF">Afghanistan</option>
                    <option value="AL">Albania</option>
                    <option value="DZ">Algeria</option>
                    <option value="AS">American Samoa</option>
                    <option value="AD">Andorra</option>
                    <option value="AO">Angola</option>
                    <option value="AI">Anguilla</option>
                    <option value="AG">Antigua and Barbuda</option>
                    <option value="AR">Argentina</option>
                    <option value="AM">Armenia</option>
                    <option value="AW">Aruba</option>
                    <option value="AU">Australia</option>
                    <option value="AT">Austria</option>
                    <option value="AZ">Azerbaijan</option>
                    <option value="BS">Bahamas</option>
                    <option value="BH">Bahrain</option>
                    <option value="BD">Bangladesh</option>
                    <option value="BB">Barbados</option>
                    <option value="BY">Belarus</option>
                    <option value="BE">Belgium</option>
                    <option value="BZ">Belize</option>
                    <option value="BJ">Benin</option>
                    <option value="BM">Bermuda</option>
                    <option value="BT">Bhutan</option>
                    <option value="BO">Bolivia</option>
                    <option value="BA">Bosnia and Herzegovina</option>
                    <option value="BW">Botswana</option>
                    <option value="BR">Brazil</option>
                    <option value="VG">British Virgin Islands</option>
                    <option value="IO">British Indian Ocean Territory</option>
                    <option value="BN">Brunei</option>
                    <option value="BG">Bulgaria</option>
                    <option value="BF">Burkina Faso</option>
                    <option value="BI">Burundi</option>
                    <option value="KH">Cambodia</option>
                    <option value="CM">Cameroon</option>
                    <option value="CA">Canada</option>
                    <option value="CV">Cape Verde</option>
                    <option value="KY">Cayman Islands</option>
                    <option value="CF">Central African Republic</option>
                    <option value="TD">Chad</option>
                    <option value="CL">Chile</option>
                    <option value="CN">China</option>
                    <option value="CX">Christmas Island</option>
                    <option value="CO">Colombia</option>
                    <option value="KM">Comoros Islands</option>
                    <option value="CD">Congo, Democratic Republic of the</option>
                    <option value="CG">Congo, Republic of the</option>
                    <option value="CK">Cook Islands</option>
                    <option value="CR">Costa Rica</option>
                    <option value="CI">Cote D'ivoire</option>
                    <option value="HR">Croatia</option>
                    <option value="CY">Cyprus</option>
                    <option value="CZ">Czech Republic</option>
                    <option value="DK">Denmark</option>
                    <option value="DJ">Djibouti</option>
                    <option value="DM">Dominica</option>
                    <option value="DO">Dominican Republic</option>
                    <option value="TP">East Timor</option>
                    <option value="EC">Ecuador</option>
                    <option value="EG">Egypt</option>
                    <option value="SV">El Salvador</option>
                    <option value="GQ">Equatorial Guinea</option>
                    <option value="ER">Eritrea</option>
                    <option value="EE">Estonia</option>
                    <option value="ET">Ethiopia</option>
                    <option value="FK">Falkland Islands (Malvinas)</option>
                    <option value="FO">Faroe Islands</option>
                    <option value="FJ">Fiji</option>
                    <option value="FI">Finland</option>
                    <option value="FR">France</option>
                    <option value="GF">French Guiana</option>
                    <option value="PF">French Polynesia</option>
                    <option value="TF">French Southern Territories</option>
                    <option value="GA">Gabon</option>
                    <option value="GM">Gambia</option>
                    <option value="GE">Georgia</option>
                    <option value="DE">Germany</option>
                    <option value="GH">Ghana</option>
                    <option value="GI">Gibraltar</option>
                    <option value="GR">Greece</option>
                    <option value="GL">Greenland</option>
                    <option value="GD">Grenada</option>
                    <option value="GP">Guadeloupe</option>
                    <option value="GU">Guam</option>
                    <option value="GT">Guatemala</option>
                    <option value="GN">Guinea</option>
                    <option value="GW">Guinea-Bissau</option>
                    <option value="GY">Guyana</option>
                    <option value="HT">Haiti</option>
                    <option value="VA">Holy See (Vatican City State)</option>
                    <option value="HN">Honduras</option>
                    <option value="HK">Hong Kong</option>
                    <option value="HU">Hungary</option>
                    <option value="IS">Iceland</option>
                    <option value="IN">India</option>
                    <option value="ID">Indonesia</option>
                    <option value="IQ">Iraq</option>
                    <option value="IE">Republic of Ireland</option>
                    <option value="IL">Israel</option>
                    <option value="IT">Italy</option>
                    <option value="JM">Jamaica</option>
                    <option value="JP">Japan</option>
                    <option value="JO">Jordan</option>
                    <option value="KZ">Kazakhstan</option>
                    <option value="KE">Kenya</option>
                    <option value="KI">Kiribati</option>
                    <option value="KR">South Korea</option>
                    <option value="XK">Kosovo</option>
                    <option value="KW">Kuwait</option>
                    <option value="KG">Kyrgyzstan</option>
                    <option value="LA">Laos</option>
                    <option value="LV">Latvia</option>
                    <option value="LB">Lebanon</option>
                    <option value="LS">Lesotho</option>
                    <option value="LR">Liberia</option>
                    <option value="LY">Libya</option>
                    <option value="LI">Liechtenstein</option>
                    <option value="LT">Lithuania</option>
                    <option value="LU">Luxembourg</option>
                    <option value="MO">Macau</option>
                    <option value="MK">Macedonia</option>
                    <option value="MG">Madagascar</option>
                    <option value="MW">Malawi</option>
                    <option value="MY">Malaysia</option>
                    <option value="MV">Maldives</option>
                    <option value="ML">Mali</option>
                    <option value="MT">Malta</option>
                    <option value="MH">Marshall Islands</option>
                    <option value="MQ">Martinique</option>
                    <option value="MR">Mauritania</option>
                    <option value="MU">Mauritius</option>
                    <option value="YT">Mayotte</option>
                    <option value="MX">Mexico</option>
                    <option value="FM">Micronesia</option>
                    <option value="MD">Moldova, Republic of</option>
                    <option value="MC">Monaco</option>
                    <option value="MN">Mongolia</option>
                    <option value="ME">Montenegro</option>
                    <option value="MS">Montserrat</option>
                    <option value="MA">Morocco</option>
                    <option value="MZ">Mozambique</option>
                    <option value="MM">Myanmar</option>
                    <option value="NA">Namibia</option>
                    <option value="NR">Nauru</option>
                    <option value="NP">Nepal</option>
                    <option value="NL">Netherlands</option>
                    <option value="AN">Netherlands Antilles</option>
                    <option value="NC">New Caledonia</option>
                    <option value="NZ">New Zealand</option>
                    <option value="NI">Nicaragua</option>
                    <option value="NE">Niger</option>
                    <option value="NG">Nigeria</option>
                    <option value="NU">Niue</option>
                    <option value="NF">Norfolk Island</option>
                    <option value="MP">Northern Mariana Islands</option>
                    <option value="NO">Norway</option>
                    <option value="OM">Oman</option>
                    <option value="PK">Pakistan</option>
                    <option value="PW">Palau</option>
                    <option value="PA">Panama</option>
                    <option value="PG">Papua New Guinea</option>
                    <option value="PY">Paraguay</option>
                    <option value="PE">Peru</option>
                    <option value="PH">Philippines</option>
                    <option value="PN">Pitcairn Island</option>
                    <option value="PL">Poland</option>
                    <option value="PT">Portugal</option>
                    <option value="PR">Puerto Rico</option>
                    <option value="QA">Qatar</option>
                    <option value="RE">Reunion</option>
                    <option value="RO">Romania</option>
                    <option value="RU">Russian Federation</option>
                    <option value="RW">Rwanda</option>
                    <option value="KN">Saint Kitts and Nevis</option>
                    <option value="LC">Saint Lucia</option>
                    <option value="VC">Saint Vincent and the Grenadines</option>
                    <option value="WS">Samoa</option>
                    <option value="SM">San Marino</option>
                    <option value="ST">Sao Tome and Principe</option>
                    <option value="SA">Saudi Arabia</option>
                    <option value="SN">Senegal</option>
                    <option value="RS">Serbia</option>
                    <option value="SC">Seychelles</option>
                    <option value="SL">Sierra Leone</option>
                    <option value="SG">Singapore</option>
                    <option value="SK">Slovakia</option>
                    <option value="SI">Slovenia</option>
                    <option value="SB">Solomon Islands</option>
                    <option value="SO">Somalia</option>
                    <option value="ZA">South Africa</option>
                    <option value="SS">South Sudan</option>
                    <option value="ES">Spain</option>
                    <option value="LK">Sri Lanka</option>
                    <option value="SH">St. Helena</option>
                    <option value="PM">St. Pierre and Miquelon</option>
                    <option value="SR">Suriname</option>
                    <option value="SZ">Swaziland</option>
                    <option value="SE">Sweden</option>
                    <option value="CH">Switzerland</option>
                    <option value="TW">Taiwan</option>
                    <option value="TJ">Tajikistan</option>
                    <option value="TZ">Tanzania</option>
                    <option value="TH">Thailand</option>
                    <option value="TG">Togo</option>
                    <option value="TK">Tokelau</option>
                    <option value="TO">Tonga</option>
                    <option value="TT">Trinidad and Tobago</option>
                    <option value="TN">Tunisia</option>
                    <option value="TR">Turkey</option>
                    <option value="TM">Turkmenistan</option>
                    <option value="TC">Turks and Caicos Islands</option>
                    <option value="TV">Tuvalu</option>
                    <option value="UG">Uganda</option>
                    <option value="UA">Ukraine</option>
                    <option value="AE">United Arab Emirates</option>
                    <option value="GB">United Kingdom</option>
                    <option value="US" selected="selected">United States</option>
                    <option value="UY">Uruguay</option>
                    <option value="UZ">Uzbekistan</option>
                    <option value="VU">Vanuatu</option>
                    <option value="VE">Venezuela</option>
                    <option value="VN">Viet Nam</option>
                    <option value="VI">Virgin Islands (U.S.)</option>
                    <option value="WF">Wallis and Futuna Islands</option>
                    <option value="EH">Western Sahara</option>
                    <option value="YE">Yemen</option>
                    <option value="ZM">Zambia</option>
                    <option value="ZW">Zimbabwe</option>
                </select>
            </div>
            <div style=" margin-bottom:10px;">
                <table>
                	<tbody>
                    	<tr>
                        	<td><label class="fieldlabel" style="color:#999999">first name<br></label><input size="14" id="firstname" name="firstname" type="text"></td>
                            <td><label class="fieldlabel" style="color:#999999">last name<br></label><input size="22" id="lastname" name="lastname" type="text"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div style=" margin-bottom:10px;">
            	<label class="fieldlabel" style="color:#999999">address<br></label><input size="40" id="addr1" name="addr1" type="text"><br /><input size="40" id="addr2" name="addr2" type="text">
            </div>
            <div style=" margin-bottom:10px;">
            	<label class="fieldlabel" style="color:#999999">city<br></label><input size="20" id="city" name="city" type="text">
            </div>
            <div style=" margin-bottom:10px;">
            	<div style="float:left;">
                	<label class="fieldlabel" style="color:#999999">state/region/province<br></label>
                    <select name="state_cd" id="state_cd" class="state_cd">
                        <option value=""></option>
                        <option selected="selected" value="AK">AK</option>
                        <option value="AL">AL</option>
                        <option value="AR">AR</option>
                        <option value="AZ">AZ</option>
                        <option value="CA">CA</option>
                        <option value="CO">CO</option>
                        <option value="CT">CT</option>
                        <option value="DC">DC</option>
                        <option value="DE">DE</option>
                        <option value="FL">FL</option>
                        <option value="GA">GA</option>
                        <option value="HI">HI</option>
                        <option value="IA">IA</option>
                        <option value="ID">ID</option>
                        <option value="IL">IL</option>
                        <option value="IN">IN</option>
                        <option value="KS">KS</option>
                        <option value="KY">KY</option>
                        <option value="LA">LA</option>
                        <option value="MA">MA</option>
                        <option value="MD">MD</option>
                        <option value="ME">ME</option>
                        <option value="MI">MI</option>
                        <option value="MN">MN</option>
                        <option value="MO">MO</option>
                        <option value="MS">MS</option>
                        <option value="MT">MT</option>
                        <option value="NC">NC</option>
                        <option value="ND">ND</option>
                        <option value="NE">NE</option>
                        <option value="NH">NH</option>
                        <option value="NJ">NJ</option>
                        <option value="NM">NM</option>
                        <option value="NV">NV</option>
                        <option value="NY">NY</option>
                        <option value="OH">OH</option>
                        <option value="OK">OK</option>
                        <option value="OR">OR</option>
                        <option value="PA">PA</option>
                        <option value="RI">RI</option>
                        <option value="SC">SC</option>
                        <option value="SD">SD</option>
                        <option value="TN">TN</option>
                        <option value="TX">TX</option>
                        <option value="UT">UT</option>
                        <option value="VA">VA</option>
                        <option value="VT">VT</option>
                        <option value="WA">WA</option>
                        <option value="WI">WI</option>
                        <option value="WV">WV</option>
                        <option value="WY">WY</option>
                        <option value="--" disabled="disabled">---</option>
                        <option value="AA">AA</option>
                        <option value="AE">AE</option>
                        <option value="AP">AP</option>
                        <option value="AS">AS</option>
                        <option value="FM">FM</option>
                        <option value="GU">GU</option>
                        <option value="MH">MH</option>
                        <option value="MP">MP</option>
                        <option value="PR">PR</option>
                        <option value="PW">PW</option>
                        <option value="VI">VI</option>
                    </select>
                </div>
                <div style="float:left; margin-left:10px;">
                	<label class="fieldlabel" style="color:#999999">zip<br></label><input size="10" id="zip" name="zip" type="text">
                </div>
                <div class="clear"></div>
            </div>
            <div style=" margin-bottom:10px;">
                <label class="fieldlabel" style="color:#999999">email address<br></label><input class="text" size="40" id="email" name="email" type="email">
            </div>
            <div style=" margin-bottom:10px;">
                <label class="fieldlabel" style="color:#999999">phone number<br></label><input class="text" size="20" id="phone" name="phone" type="tel">
            </div>
            <div style=" margin-bottom:10px;">
                <input id="signup_optin" name="signup_optin" value="1" type="checkbox"><label for="signup_optin"><span class="radio">I want to stay in touch with the animals through email updates.</span></label>
            </div>
            <div style="margin-top:30px;"><div class="b3"><a href="#">Send</a></div></div>
        </div>

  <div class="donate_3_1">
        	<!--<div class="donate_3_1_1">Credit Card Payment</div>-->
            <div class="contribheader" id="bsd-contribution-header-contributor" style="margin-top:72px;">Credit Card Payment</div>
            <div style=" margin-bottom:10px;">
                <div style="margin-top:10px; margin-bottom:10px;">
                    <label class="fieldlabel" style="color:#999999">Amount<br></label>
                    <div style="width:100%; height:30px;">
                        <input type="radio" name="radiog_dark2" id="radio11" class="css-checkbox" />
                        <label for="radio11" class="css-label3"><span class="checkbox">$25</span></label>&nbsp;&nbsp;
                        <input type="radio" name="radiog_dark" id="radio12" class="css-checkbox" />
                        <label for="radio12" class="css-label3"><span class="checkbox">$50</span></label>&nbsp;&nbsp;
                        <input type="radio" name="radiog_dark2" id="radio13" class="css-checkbox" />
                        <label for="radio13" class="css-label3"><span class="checkbox">$100</span></label>&nbsp;&nbsp;
                        <input type="radio" name="radiog_dark2" id="radio14" class="css-checkbox" />
                        <label for="radio14" class="css-label3"><span class="checkbox">$250</span></label>&nbsp;&nbsp;
                        <input type="radio" name="radiog_dark2" id="radio15" class="css-checkbox" />
                        <label for="radio15" class="css-label3"><span class="checkbox">$500</span></label>&nbsp;&nbsp;
                        <input type="radio" name="radiog_dark2" id="radio16" class="css-checkbox" />
                        <label for="radio16" class="css-label3"><span class="checkbox">$1000</span></label>&nbsp;&nbsp;
                        <input type="radio" name="radiog_dark2" id="radio17" class="css-checkbox" />
                        <label for="radio17" class="css-label3"><span class="checkbox">$2500</span></label>
                    </div>
                    <div style="width:100%; height:30px;">
                        <input type="radio" name="radiog_dark2" id="radio18" class="css-checkbox" />
                        <label for="radio18" class="css-label3"><span class="checkbox">Other： <input name="textfield" type="text" class="f3" id="textfield" /> (USD)</span></label>
                    </div>
                </div>
            </div>
            <div style=" margin-bottom:10px;">
                <label class="fieldlabel" style="color:#999999">country<br></label>
                <select id="country" name="country">
                    <option value=""></option>
                    <option value="AF">Afghanistan</option>
                    <option value="AL">Albania</option>
                    <option value="DZ">Algeria</option>
                    <option value="AS">American Samoa</option>
                    <option value="AD">Andorra</option>
                    <option value="AO">Angola</option>
                    <option value="AI">Anguilla</option>
                    <option value="AG">Antigua and Barbuda</option>
                    <option value="AR">Argentina</option>
                    <option value="AM">Armenia</option>
                    <option value="AW">Aruba</option>
                    <option value="AU">Australia</option>
                    <option value="AT">Austria</option>
                    <option value="AZ">Azerbaijan</option>
                    <option value="BS">Bahamas</option>
                    <option value="BH">Bahrain</option>
                    <option value="BD">Bangladesh</option>
                    <option value="BB">Barbados</option>
                    <option value="BY">Belarus</option>
                    <option value="BE">Belgium</option>
                    <option value="BZ">Belize</option>
                    <option value="BJ">Benin</option>
                    <option value="BM">Bermuda</option>
                    <option value="BT">Bhutan</option>
                    <option value="BO">Bolivia</option>
                    <option value="BA">Bosnia and Herzegovina</option>
                    <option value="BW">Botswana</option>
                    <option value="BR">Brazil</option>
                    <option value="VG">British Virgin Islands</option>
                    <option value="IO">British Indian Ocean Territory</option>
                    <option value="BN">Brunei</option>
                    <option value="BG">Bulgaria</option>
                    <option value="BF">Burkina Faso</option>
                    <option value="BI">Burundi</option>
                    <option value="KH">Cambodia</option>
                    <option value="CM">Cameroon</option>
                    <option value="CA">Canada</option>
                    <option value="CV">Cape Verde</option>
                    <option value="KY">Cayman Islands</option>
                    <option value="CF">Central African Republic</option>
                    <option value="TD">Chad</option>
                    <option value="CL">Chile</option>
                    <option value="CN">China</option>
                    <option value="CX">Christmas Island</option>
                    <option value="CO">Colombia</option>
                    <option value="KM">Comoros Islands</option>
                    <option value="CD">Congo, Democratic Republic of the</option>
                    <option value="CG">Congo, Republic of the</option>
                    <option value="CK">Cook Islands</option>
                    <option value="CR">Costa Rica</option>
                    <option value="CI">Cote D'ivoire</option>
                    <option value="HR">Croatia</option>
                    <option value="CY">Cyprus</option>
                    <option value="CZ">Czech Republic</option>
                    <option value="DK">Denmark</option>
                    <option value="DJ">Djibouti</option>
                    <option value="DM">Dominica</option>
                    <option value="DO">Dominican Republic</option>
                    <option value="TP">East Timor</option>
                    <option value="EC">Ecuador</option>
                    <option value="EG">Egypt</option>
                    <option value="SV">El Salvador</option>
                    <option value="GQ">Equatorial Guinea</option>
                    <option value="ER">Eritrea</option>
                    <option value="EE">Estonia</option>
                    <option value="ET">Ethiopia</option>
                    <option value="FK">Falkland Islands (Malvinas)</option>
                    <option value="FO">Faroe Islands</option>
                    <option value="FJ">Fiji</option>
                    <option value="FI">Finland</option>
                    <option value="FR">France</option>
                    <option value="GF">French Guiana</option>
                    <option value="PF">French Polynesia</option>
                    <option value="TF">French Southern Territories</option>
                    <option value="GA">Gabon</option>
                    <option value="GM">Gambia</option>
                    <option value="GE">Georgia</option>
                    <option value="DE">Germany</option>
                    <option value="GH">Ghana</option>
                    <option value="GI">Gibraltar</option>
                    <option value="GR">Greece</option>
                    <option value="GL">Greenland</option>
                    <option value="GD">Grenada</option>
                    <option value="GP">Guadeloupe</option>
                    <option value="GU">Guam</option>
                    <option value="GT">Guatemala</option>
                    <option value="GN">Guinea</option>
                    <option value="GW">Guinea-Bissau</option>
                    <option value="GY">Guyana</option>
                    <option value="HT">Haiti</option>
                    <option value="VA">Holy See (Vatican City State)</option>
                    <option value="HN">Honduras</option>
                    <option value="HK">Hong Kong</option>
                    <option value="HU">Hungary</option>
                    <option value="IS">Iceland</option>
                    <option value="IN">India</option>
                    <option value="ID">Indonesia</option>
                    <option value="IQ">Iraq</option>
                    <option value="IE">Republic of Ireland</option>
                    <option value="IL">Israel</option>
                    <option value="IT">Italy</option>
                    <option value="JM">Jamaica</option>
                    <option value="JP">Japan</option>
                    <option value="JO">Jordan</option>
                    <option value="KZ">Kazakhstan</option>
                    <option value="KE">Kenya</option>
                    <option value="KI">Kiribati</option>
                    <option value="KR">South Korea</option>
                    <option value="XK">Kosovo</option>
                    <option value="KW">Kuwait</option>
                    <option value="KG">Kyrgyzstan</option>
                    <option value="LA">Laos</option>
                    <option value="LV">Latvia</option>
                    <option value="LB">Lebanon</option>
                    <option value="LS">Lesotho</option>
                    <option value="LR">Liberia</option>
                    <option value="LY">Libya</option>
                    <option value="LI">Liechtenstein</option>
                    <option value="LT">Lithuania</option>
                    <option value="LU">Luxembourg</option>
                    <option value="MO">Macau</option>
                    <option value="MK">Macedonia</option>
                    <option value="MG">Madagascar</option>
                    <option value="MW">Malawi</option>
                    <option value="MY">Malaysia</option>
                    <option value="MV">Maldives</option>
                    <option value="ML">Mali</option>
                    <option value="MT">Malta</option>
                    <option value="MH">Marshall Islands</option>
                    <option value="MQ">Martinique</option>
                    <option value="MR">Mauritania</option>
                    <option value="MU">Mauritius</option>
                    <option value="YT">Mayotte</option>
                    <option value="MX">Mexico</option>
                    <option value="FM">Micronesia</option>
                    <option value="MD">Moldova, Republic of</option>
                    <option value="MC">Monaco</option>
                    <option value="MN">Mongolia</option>
                    <option value="ME">Montenegro</option>
                    <option value="MS">Montserrat</option>
                    <option value="MA">Morocco</option>
                    <option value="MZ">Mozambique</option>
                    <option value="MM">Myanmar</option>
                    <option value="NA">Namibia</option>
                    <option value="NR">Nauru</option>
                    <option value="NP">Nepal</option>
                    <option value="NL">Netherlands</option>
                    <option value="AN">Netherlands Antilles</option>
                    <option value="NC">New Caledonia</option>
                    <option value="NZ">New Zealand</option>
                    <option value="NI">Nicaragua</option>
                    <option value="NE">Niger</option>
                    <option value="NG">Nigeria</option>
                    <option value="NU">Niue</option>
                    <option value="NF">Norfolk Island</option>
                    <option value="MP">Northern Mariana Islands</option>
                    <option value="NO">Norway</option>
                    <option value="OM">Oman</option>
                    <option value="PK">Pakistan</option>
                    <option value="PW">Palau</option>
                    <option value="PA">Panama</option>
                    <option value="PG">Papua New Guinea</option>
                    <option value="PY">Paraguay</option>
                    <option value="PE">Peru</option>
                    <option value="PH">Philippines</option>
                    <option value="PN">Pitcairn Island</option>
                    <option value="PL">Poland</option>
                    <option value="PT">Portugal</option>
                    <option value="PR">Puerto Rico</option>
                    <option value="QA">Qatar</option>
                    <option value="RE">Reunion</option>
                    <option value="RO">Romania</option>
                    <option value="RU">Russian Federation</option>
                    <option value="RW">Rwanda</option>
                    <option value="KN">Saint Kitts and Nevis</option>
                    <option value="LC">Saint Lucia</option>
                    <option value="VC">Saint Vincent and the Grenadines</option>
                    <option value="WS">Samoa</option>
                    <option value="SM">San Marino</option>
                    <option value="ST">Sao Tome and Principe</option>
                    <option value="SA">Saudi Arabia</option>
                    <option value="SN">Senegal</option>
                    <option value="RS">Serbia</option>
                    <option value="SC">Seychelles</option>
                    <option value="SL">Sierra Leone</option>
                    <option value="SG">Singapore</option>
                    <option value="SK">Slovakia</option>
                    <option value="SI">Slovenia</option>
                    <option value="SB">Solomon Islands</option>
                    <option value="SO">Somalia</option>
                    <option value="ZA">South Africa</option>
                    <option value="SS">South Sudan</option>
                    <option value="ES">Spain</option>
                    <option value="LK">Sri Lanka</option>
                    <option value="SH">St. Helena</option>
                    <option value="PM">St. Pierre and Miquelon</option>
                    <option value="SR">Suriname</option>
                    <option value="SZ">Swaziland</option>
                    <option value="SE">Sweden</option>
                    <option value="CH">Switzerland</option>
                    <option value="TW">Taiwan</option>
                    <option value="TJ">Tajikistan</option>
                    <option value="TZ">Tanzania</option>
                    <option value="TH">Thailand</option>
                    <option value="TG">Togo</option>
                    <option value="TK">Tokelau</option>
                    <option value="TO">Tonga</option>
                    <option value="TT">Trinidad and Tobago</option>
                    <option value="TN">Tunisia</option>
                    <option value="TR">Turkey</option>
                    <option value="TM">Turkmenistan</option>
                    <option value="TC">Turks and Caicos Islands</option>
                    <option value="TV">Tuvalu</option>
                    <option value="UG">Uganda</option>
                    <option value="UA">Ukraine</option>
                    <option value="AE">United Arab Emirates</option>
                    <option value="GB">United Kingdom</option>
                    <option value="US" selected="selected">United States</option>
                    <option value="UY">Uruguay</option>
                    <option value="UZ">Uzbekistan</option>
                    <option value="VU">Vanuatu</option>
                    <option value="VE">Venezuela</option>
                    <option value="VN">Viet Nam</option>
                    <option value="VI">Virgin Islands (U.S.)</option>
                    <option value="WF">Wallis and Futuna Islands</option>
                    <option value="EH">Western Sahara</option>
                    <option value="YE">Yemen</option>
                    <option value="ZM">Zambia</option>
                    <option value="ZW">Zimbabwe</option>
                </select>
            </div>
            <div style=" margin-bottom:10px;">
                <table>
                    <tbody>
                        <tr>
                            <td><label class="fieldlabel" style="color:#999999">first name<br></label><input size="14" id="firstname" name="firstname" type="text"></td>
                            <td><label class="fieldlabel" style="color:#999999">last name<br></label><input size="22" id="lastname" name="lastname" type="text"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div style=" margin-bottom:10px;">
                <label class="fieldlabel" style="color:#999999">address<br></label><input size="40" id="addr1" name="addr1" type="text"><br /><input size="40" id="addr2" name="addr2" type="text">
            </div>
            <div style=" margin-bottom:10px;">
                <label class="fieldlabel" style="color:#999999">city<br></label><input size="20" id="city" name="city" type="text">
            </div>
            <div style=" margin-bottom:10px;">
                <div style="float:left;">
                    <label class="fieldlabel" style="color:#999999">state/region/province<br></label>
                    <select name="state_cd" id="state_cd" class="state_cd">
                        <option value=""></option>
                        <option selected="selected" value="AK">AK</option>
                        <option value="AL">AL</option>
                        <option value="AR">AR</option>
                        <option value="AZ">AZ</option>
                        <option value="CA">CA</option>
                        <option value="CO">CO</option>
                        <option value="CT">CT</option>
                        <option value="DC">DC</option>
                        <option value="DE">DE</option>
                        <option value="FL">FL</option>
                        <option value="GA">GA</option>
                        <option value="HI">HI</option>
                        <option value="IA">IA</option>
                        <option value="ID">ID</option>
                        <option value="IL">IL</option>
                        <option value="IN">IN</option>
                        <option value="KS">KS</option>
                        <option value="KY">KY</option>
                        <option value="LA">LA</option>
                        <option value="MA">MA</option>
                        <option value="MD">MD</option>
                        <option value="ME">ME</option>
                        <option value="MI">MI</option>
                        <option value="MN">MN</option>
                        <option value="MO">MO</option>
                        <option value="MS">MS</option>
                        <option value="MT">MT</option>
                        <option value="NC">NC</option>
                        <option value="ND">ND</option>
                        <option value="NE">NE</option>
                        <option value="NH">NH</option>
                        <option value="NJ">NJ</option>
                        <option value="NM">NM</option>
                        <option value="NV">NV</option>
                        <option value="NY">NY</option>
                        <option value="OH">OH</option>
                        <option value="OK">OK</option>
                        <option value="OR">OR</option>
                        <option value="PA">PA</option>
                        <option value="RI">RI</option>
                        <option value="SC">SC</option>
                        <option value="SD">SD</option>
                        <option value="TN">TN</option>
                        <option value="TX">TX</option>
                        <option value="UT">UT</option>
                        <option value="VA">VA</option>
                        <option value="VT">VT</option>
                        <option value="WA">WA</option>
                        <option value="WI">WI</option>
                        <option value="WV">WV</option>
                        <option value="WY">WY</option>
                        <option value="--" disabled="disabled">---</option>
                        <option value="AA">AA</option>
                        <option value="AE">AE</option>
                        <option value="AP">AP</option>
                        <option value="AS">AS</option>
                        <option value="FM">FM</option>
                        <option value="GU">GU</option>
                        <option value="MH">MH</option>
                        <option value="MP">MP</option>
                        <option value="PR">PR</option>
                        <option value="PW">PW</option>
                        <option value="VI">VI</option>
                    </select>
                </div>
                <div style="float:left; margin-left:10px;">
                    <label class="fieldlabel" style="color:#999999">zip<br></label><input size="10" id="zip" name="zip" type="text">
                </div>
                <div class="clear"></div>
            </div>
            <div style=" margin-bottom:10px;">
                <label class="fieldlabel" style="color:#999999">email address<br></label><input class="text" size="40" id="email" name="email" type="email">
            </div>
            <div style=" margin-bottom:10px;">
                <label class="fieldlabel">phone number<br></label><input class="text" size="20" id="phone" name="phone" type="tel">
            </div>
            <div style=" margin-bottom:10px;">
                <input id="signup_optin" name="signup_optin" value="1" type="checkbox"><label for="signup_optin"><span class="radio">I want to stay in touch with the animals through email updates.</span></label>
            </div>
            <div style="margin-top:30px;"><div class="b3"><a href="#">Send</a></div></div>

    </div>
  	</div>
	<!----------- 內容 結束 ------------------>

</div>

<!-- 上方menu -->
<script src="js/minified.js?20140814"></script>

</body>
</html>
<?php include("include_bottom.php"); ?>
