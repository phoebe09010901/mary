<?php
header("content-type:text/html;charset=utf-8");
require_once('set.php');

$dog_id = format_data($_GET['dog_id'], 'int');

//dogs
$query = "select * from $table_name_dogs where Fullkey='$dog_id'";
$dogs = $obj_dogs->run_mysql_out($query);
//form1
$query = "select * from ".$table_name_dogs."_form1 where dog_id='".$dogs['Fullkey']."'";
$form1 = $obj_dogs->run_mysql_out($query);
//form2
$query = "select * from ".$table_name_dogs."_form2 where dog_id='".$dogs['Fullkey']."'";
$form2 = $obj_dogs->run_mysql_out($query);
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
	background: url(images/a_bg.jpg) repeat-x top left #c2cb56;
}
-->
.topbtn_allmenu ul {
	list-style-type: none;
	display: block;
	margin: 0 auto;
}
.topbtn_allmenu ul li {
	display: block;
	float: left;
	position: relative;
}


.topbtn_allmenu ul ul {
	position: absolute;
	top:21px;
	left:-4px;
	width: 281px;
	height: 128px;
	padding: 0;
	display: none;
}
</style>

</head>

<body>

<div id="wrapper_center">

    <?php include('include_top.php');?>   

	<!----------- 內容 開始 ------------------> 
  	<div class="adoption">
    
    	<table width="0" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="554" valign="top"><table width="0" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="center" valign="top">
            <table width="0" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><table width="187" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td valign="top" background="images/a_main_01.jpg"><table width="0" border="0" cellpadding="0" cellspacing="0">
                      <tr>
                        <td height="82"></td>
                        <td class="re_main2">&nbsp;</td>
                        <td></td>
                      </tr>
                      <tr>
                        <td width="40"></td>
                        <td width="129" height="80" class="re_main2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td align="center" valign="middle" class="pro_main_s2"><?=stripslashes($dogs['name'])?>, <?=stripslashes($dogs['sex'])?><br> <?=($dogs['years']>0)?stripslashes($dogs['years']).' year(s)':''?><?=($dogs['month'])?' '.$dogs['month'].' month(s)':''?>, <?=stripslashes($dogs['weight'])?>lbs</td>
                          </tr>
                        </table></td>
                        <td width="10"></td>
                      </tr>
                      <tr>
                        <td height="75" colspan="3" valign="bottom" class="pro_title_2"><table width="0" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="20"></td>
                            <td><span style="color:<?=($dogs['sex']=='Male')?'#13A4A0':'#E84693'?>;"><?=stripslashes($dogs['name'])?></span></td>
                            </tr>
                          </table></td>
                      </tr>
                    </table></td>
                  </tr>
                </table></td>
                <td><table width="367" height="253" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <td valign="top">
                    <div style="width:96%; background-color:#efefef; padding:10px 0 10px 0; margin:10px 0 10px 0;">
                    	<?=stripslashes($dogs['content'])?>
                    </div>
                    </td>
                  </tr>
                </table></td>
              </tr>
            </table>
            <!-- 說明文(二) 開始 -->
            <div style="width:522px; text-align:left; margin-left:20px; line-height:21px; font-size: 13px; font-family: 'Myriad Pro'; float:left;">
			<?=stripslashes($dogs['content2'])?>
            </div>
            <!-- 說明文(二) 結束 -->
            </td>
          </tr>
          <tr>
            <td><img src="images/a_main_08.jpg" width="554" height="42" alt="" /></td>
          </tr>
          <tr>
            <td height="849" align="center" valign="top"><table width="94%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><table width="0" border="0" cellspacing="0" cellpadding="5">
                  <tr>
                    <td width="300" height="0" class="pro_main_s">Energy level:</td>
                    <td><table width="0" border="0" cellpadding="0" cellspacing="0">
                      <tr>
                        <td align="left"><table width="60" border="0" cellpadding="0" cellspacing="0">
                          <tr>
                            <td><input type="radio" name="radiog_dark" id="radio" class="css-checkbox" <?php if($form1['q1']==1){echo 'checked';} ?> />
                              <label for="radio" class="css-label radGroup2"><span class="checkbox">Low</span></label></td>
                          </tr>
                        </table></td>
                        <td align="left"><table width="80" border="0" cellpadding="0" cellspacing="0">
                          <tr>
                            <td><input name="radiog_dark" type="radio" class="css-checkbox" id="radio2" <?php if($form1['q1']==2){echo 'checked';} ?> />
                              <label for="radio2" class="css-label radGroup2"><span class="checkbox">Medium</span></label></td>
                          </tr>
                        </table></td>
                        <td align="left"><table width="60" border="0" cellpadding="0" cellspacing="0">
                          <tr>
                            <td><input type="radio" name="radiog_dark" id="radio3" class="css-checkbox" <?php if($form1['q1']==3){echo 'checked';} ?> />
                              <label for="radio3" class="css-label radGroup2"><span class="checkbox">High</span></label></td>
                          </tr>
                        </table></td>
                      </tr>
                    </table></td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td height="1" bgcolor="#b6cc3a"></td>
              </tr>
              <tr>
                <td height="0"><table width="0" border="0" cellspacing="0" cellpadding="5">
                  <tr>
                    <td width="300" height="0" class="pro_main_s">Ideal home environment:</td>
                    <td width="180"><table border="0" cellpadding="0" cellspacing="0">
                      <tr>
                        <td align="left"><table width="60" border="0" cellpadding="0" cellspacing="0">
                          <tr>
                            <td><input type="radio" name="radiog_dark2" id="radio4" class="css-checkbox" <?php if($form1['q2']==1){echo 'checked';} ?> />
                              <label for="radio4" class="css-label radGroup2"><span class="checkbox">Active</span></label></td>
                          </tr>
                        </table></td>
                        <td align="left"><table width="80" border="0" cellpadding="0" cellspacing="0">
                          <tr>
                            <td><input name="radiog_dark2" type="radio" class="css-checkbox" id="radio5" <?php if($form1['q2']==2){echo 'checked';} ?> />
                              <label for="radio5" class="css-label radGroup2"><span class="checkbox">Quiet</span></label></td>
                          </tr>
                        </table></td>
                        <td align="left"><table width="60" border="0" cellpadding="0" cellspacing="0">
                          <tr>
                            <td><input type="radio" name="radiog_dark2" id="radio6" class="css-checkbox" <?php if($form1['q2']==3){echo 'checked';} ?> />
                              <label for="radio6" class="css-label radGroup2"><span class="checkbox">Both</span></label></td>
                          </tr>
                        </table></td>
                      </tr>
                    </table></td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td height="1" bgcolor="#b6cc3a"></td>
              </tr>
              <tr>
                <td height="1"><table width="0" border="0" cellspacing="0" cellpadding="5">
                  <tr>
                    <td width="300" height="0" valign="top" class="pro_main_s">Is the dog good with strangers?</td>
                    <td width="180" valign="top"><table width="180" border="0" cellpadding="0" cellspacing="0">
                      <tr>
                        <td height="30" align="left"><table border="0" cellpadding="0" cellspacing="0">
                          <tr>
                            <td><input name="radiog_dark3" type="checkbox" class="css-checkbox" id="radio7" <?php if($form1['q3_1']==1){echo 'checked';} ?> />
                              <label for="radio7"><span class="checkbox">Friendly </span></label></td>
                          </tr>
                        </table></td>
                      </tr>
                      <tr>
                        <td height="30" align="left"><table border="0" cellpadding="0" cellspacing="0">
                          <tr>
                            <td><input type="checkbox" name="radiog_dark3" id="radio8" class="css-checkbox" <?php if($form1['q3_2']==1){echo 'checked';} ?> />
                              <label for="radio8"><span class="checkbox">Shy </span></label></td>
                          </tr>
                        </table></td>
                      </tr>
                      <tr>
                        <td height="0" align="left"><table border="0" cellpadding="0" cellspacing="0">
                          <tr>
                            <td height="20"><input type="checkbox" name="radiog_dark3" id="radio9" class="css-checkbox" <?php if($form1['q3_3']==1){echo 'checked';} ?> />
                              <label for="radio9"><span class="checkbox">Aggressive</span></label></td>
                          </tr>
                        </table></td>
                      </tr>
                    </table></td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td height="1" bgcolor="#b6cc3a"></td>
              </tr>
              <tr>
                <td valign="bottom"><table width="0" border="0" cellspacing="0" cellpadding="5">
                  <tr>
                    <td width="300" height="0" valign="top" class="pro_main_s">The dog is best with children of what age group?</td>
                    <td width="180" align="left" valign="top"><table width="180" border="0" cellpadding="0" cellspacing="0">
                      <tr>
                          <td height="30" align="left"><table border="0" cellpadding="0" cellspacing="0">
                            <tr>
                              <td><input type="radio" name="radiog_dark4" id="radio10" class="css-checkbox" <?php if($form1['q4']==1){echo 'checked';} ?> />
                                <label for="radio10" class="css-label radGroup2"><span class="checkbox">any ages </span></label></td>
                            </tr>
                          </table></td>
                        </tr>
                        <tr>
                          <td height="30" align="left"><table border="0" cellpadding="0" cellspacing="0">
                            <tr>
                              <td><input name="radiog_dark4" type="radio" class="css-checkbox" id="radio11" <?php if($form1['q4']==2){echo 'checked';} ?> />
                                <label for="radio11" class="css-label radGroup2"><span class="checkbox">under 5 years old </span></label></td>
                            </tr>
                          </table></td>
                        </tr>
                        <tr>
                          <td height="30" align="left"><table border="0" cellpadding="0" cellspacing="0">
                            <tr>
                              <td><input type="radio" name="radiog_dark4" id="radio12" class="css-checkbox" <?php if($form1['q4']==3){echo 'checked';} ?> />
                                <label for="radio12" class="css-label radGroup2"><span class="checkbox">over 5 years old </span></label></td>
                            </tr>
                          </table></td>
                        </tr>
                        <tr>
                          <td height="30" align="left"><table border="0" cellpadding="0" cellspacing="0">
                            <tr>
                              <td><input type="radio" name="radiog_dark4" id="radio13" class="css-checkbox" <?php if($form1['q4']==4){echo 'checked';} ?> />
                                <label for="radio13" class="css-label radGroup2"><span class="checkbox">over 10 years old</span></label></td>
                            </tr>
                          </table></td>
                        </tr>
                        <tr>
                          <td height="30" align="left"><table border="0" cellpadding="0" cellspacing="0">
                            <tr>
                              <td><input type="radio" name="radiog_dark4" id="radio14" class="css-checkbox" <?php if($form1['q4']==5){echo 'checked';} ?> />
                                <label for="radio14" class="css-label radGroup2"><span class="checkbox">over 15 years old</span></label></td>
                            </tr>
                          </table></td>
                        </tr>
                    </table></td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td height="1" bgcolor="#b6cc3a"></td>
              </tr>
              <tr>
                <td><table width="0" border="0" cellspacing="0" cellpadding="5">
                  <tr>
                    <td width="300" height="20" class="pro_main_s">Is the dog good with other dogs?</td>
                    <td><table border="0" cellpadding="0" cellspacing="0">
                      <tr>
                        <td height="25" align="left"><table width="100" border="0" cellpadding="0" cellspacing="0">
                          <tr>
                            <td><span class="checkbox">Small dogs</span></td>
                            </tr>
                          </table></td>
                        <td height="25" align="left"><table width="50" border="0" cellpadding="0" cellspacing="0">
                          <tr>
                            <td><input name="radiog_dark5" type="radio" class="css-checkbox" id="radio15" <?php if($form1['q5']==1){echo 'checked';} ?> />
                              <label for="radio15" class="css-label radGroup2"><span class="checkbox">Yes</span></label></td>
                            </tr>
                          </table></td>
                        <td height="25" align="left"><table width="50" border="0" cellpadding="0" cellspacing="0">
                          <tr>
                            <td><input type="radio" name="radiog_dark5" id="radio16" class="css-checkbox" <?php if($form1['q5']==2){echo 'checked';} ?> />
                              <label for="radio16" class="css-label radGroup2"><span class="checkbox">No</span></label></td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr>
                        <td height="25" align="left"><table width="100" border="0" cellpadding="0" cellspacing="0">
                          <tr>
                            <td><span class="checkbox">Big dogs </span></td>
                          </tr>
                        </table></td>
                        <td height="25" align="left"><table width="50" border="0" cellpadding="0" cellspacing="0">
                          <tr>
                            <td><input name="radiog_dark6" type="radio" class="css-checkbox" id="radio17" <?php if($form1['q6']==1){echo 'checked';} ?> />
                              <label for="radio17" class="css-label radGroup2"><span class="checkbox">Yes</span></label></td>
                          </tr>
                        </table></td>
                        <td height="25" align="left"><table width="50" border="0" cellpadding="0" cellspacing="0">
                          <tr>
                            <td><input type="radio" name="radiog_dark6" id="radio18" class="css-checkbox" <?php if($form1['q6']==2){echo 'checked';} ?> />
                              <label for="radio18" class="css-label radGroup2"><span class="checkbox">No</span></label></td>
                          </tr>
                        </table></td>
                      </tr>
                    </table></td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td height="1" bgcolor="#b6cc3a"></td>
              </tr>
              <tr>
                <td><table width="0" border="0" cellspacing="0" cellpadding="5">
                  <tr>
                    <td width="300" height="20" class="pro_main_s">Is the dog good with cats?<br /></td>
                    <td><table border="0" cellpadding="0" cellspacing="0">
                      <tr>
                        <td align="left"><table width="50" border="0" cellpadding="0" cellspacing="0">
                          <tr>
                            <td><input name="radiog_dark7" type="radio" class="css-checkbox" id="radio19" <?php if($form1['q7']==1){echo 'checked';} ?> />
                              <label for="radio19" class="css-label radGroup2"><span class="checkbox">Yes</span></label></td>
                            </tr>
                          </table></td>
                        <td align="left"><table width="50" border="0" cellpadding="0" cellspacing="0">
                          <tr>
                            <td><input type="radio" name="radiog_dark7" id="radio20" class="css-checkbox" <?php if($form1['q7']==2){echo 'checked';} ?> />
                              <label for="radio20" class="css-label radGroup2"><span class="checkbox">No</span></label></td>
                            </tr>
                          </table></td>
                        </tr>
                      </table></td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td height="1" bgcolor="#b6cc3a"></td>
              </tr>
              <tr>
                <td><table width="0" border="0" cellspacing="0" cellpadding="5">
                  <tr>
                    <td width="300" height="20" class="pro_main_s">Good on leash?<br /></td>
                    <td><table border="0" cellpadding="0" cellspacing="0">
                      <tr>
                        <td align="left"><table width="50" border="0" cellpadding="0" cellspacing="0">
                          <tr>
                            <td><input name="radiog_dark8" type="radio" class="css-checkbox" id="radio21" <?php if($form1['q8']==1){echo 'checked';} ?> />
                              <label for="radio21" class="css-label radGroup2"><span class="checkbox">Yes</span></label></td>
                            </tr>
                          </table></td>
                        <td align="left"><table width="50" border="0" cellpadding="0" cellspacing="0">
                          <tr>
                            <td><input type="radio" name="radiog_dark8" id="radio22" class="css-checkbox" <?php if($form1['q8']==2){echo 'checked';} ?> />
                              <label for="radio22" class="css-label radGroup2"><span class="checkbox">No</span></label></td>
                            </tr>
                          </table></td>
                        </tr>
                      </table></td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td height="1" bgcolor="#b6cc3a"></td>
              </tr>
              <tr>
                <td><table width="0" border="0" cellspacing="0" cellpadding="5">
                  <tr>
                    <td width="300" height="20" class="pro_main_s">House-trained?<br /></td>
                    <td><table border="0" cellpadding="0" cellspacing="0">
                      <tr>
                        <td align="left"><table width="50" border="0" cellpadding="0" cellspacing="0">
                          <tr>
                            <td><input name="radiog_dark9" type="radio" class="css-checkbox" id="radio23" <?php if($form1['q9']==1){echo 'checked';} ?> />
                              <label for="radio23" class="css-label radGroup2"><span class="checkbox">Yes</span></label></td>
                            </tr>
                          </table></td>
                        <td align="left"><table width="50" border="0" cellpadding="0" cellspacing="0">
                          <tr>
                            <td><input type="radio" name="radiog_dark9" id="radio24" class="css-checkbox" <?php if($form1['q9']==2){echo 'checked';} ?> />
                              <label for="radio24" class="css-label radGroup2"><span class="checkbox">No</span></label></td>
                            </tr>
                          </table></td>
                        </tr>
                      </table></td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td height="1" bgcolor="#b6cc3a"></td>
              </tr>
              <tr>
                <td><table width="0" border="0" cellspacing="0" cellpadding="5">
                  <tr>
                    <td width="300" height="20" class="pro_main_s">Crate-trained?<br /></td>
                    <td><table border="0" cellpadding="0" cellspacing="0">
                      <tr>
                        <td align="left"><table width="50" border="0" cellpadding="0" cellspacing="0">
                          <tr>
                            <td><input name="radiog_dark10" type="radio" class="css-checkbox" id="radio25" <?php if($form1['q10']==1){echo 'checked';} ?> />
                              <label for="radio25" class="css-label radGroup2"><span class="checkbox">Yes</span></label></td>
                            </tr>
                          </table></td>
                        <td align="left"><table width="50" border="0" cellpadding="0" cellspacing="0">
                          <tr>
                            <td><input type="radio" name="radiog_dark10" id="radio26" class="css-checkbox" <?php if($form1['q10']==2){echo 'checked';} ?> />
                              <label for="radio26" class="css-label radGroup2"><span class="checkbox">No</span></label></td>
                            </tr>
                          </table></td>
                        </tr>
                      </table></td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td height="1" bgcolor="#b6cc3a"></td>
              </tr>
              <tr>
                <td height="1"><table width="0" border="0" cellspacing="0" cellpadding="5">
                  <tr>
                    <td width="300" rowspan="3" valign="top" class="pro_main_s">How is the dog with men?<br /></td>
                    <td height="20"><table border="0" cellpadding="0" cellspacing="0">
                      <tr>
                        <td><input name="radiog_dark11" type="checkbox" class="css-checkbox" id="radio27" <?php if($form1['q11_1']==1){echo 'checked';} ?> />
                          <label for="radio27"><span class="checkbox">Friendly</span></label></td>
                      </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td height="20"><table border="0" cellpadding="0" cellspacing="0">
                      <tr>
                        <td><input name="radiog_dark11" type="checkbox" class="css-checkbox" id="radio28" <?php if($form1['q11_2']==1){echo 'checked';} ?>/>
                          <label for="radio28"><span class="checkbox">Shy </span></label></td>
                      </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td height="20"><table border="0" cellpadding="0" cellspacing="0">
                      <tr>
                        <td><input name="radiog_dark11" type="checkbox" class="css-checkbox" id="radio29" <?php if($form1['q11_3']==1){echo 'checked';} ?>/>
                          <label for="radio29"><span class="checkbox">Aggressive</span></label></td>
                      </tr>
                    </table></td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td height="1" bgcolor="#b6cc3a"></td>
              </tr>
              <tr>
                <td height="1"><table width="0" border="0" cellspacing="0" cellpadding="5">
                  <tr>
                    <td width="300" height="20" class="pro_main_s">Food aggression with people?</td>
                    <td><table border="0" cellpadding="0" cellspacing="0">
                      <tr>
                        <td align="left"><table width="50" border="0" cellpadding="0" cellspacing="0">
                          <tr>
                            <td><input name="radiog_dark12" type="radio" class="css-checkbox" id="radio30" <?php if($form1['q12']==1){echo 'checked';} ?> />
                              <label for="radio30" class="css-label radGroup2"><span class="checkbox">Yes</span></label></td>
                          </tr>
                        </table></td>
                        <td align="left"><table width="50" border="0" cellpadding="0" cellspacing="0">
                          <tr>
                            <td><input type="radio" name="radiog_dark12" id="radio31" class="css-checkbox" <?php if($form1['q12']==2){echo 'checked';} ?> />
                              <label for="radio31" class="css-label radGroup2"><span class="checkbox">No</span></label></td>
                          </tr>
                        </table></td>
                      </tr>
                    </table></td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td height="1" bgcolor="#b6cc3a"></td>
              </tr>
              <tr>
                <td height="1"><table width="0" border="0" cellspacing="0" cellpadding="5">
                  <tr>
                    <td width="300" height="20" class="pro_main_s">Food aggression with dogs?</td>
                    <td><table border="0" cellpadding="0" cellspacing="0">
                      <tr>
                        <td align="left"><table width="50" border="0" cellpadding="0" cellspacing="0">
                          <tr>
                            <td><input name="radiog_dark13" type="radio" class="css-checkbox" id="radio32" <?php if($form1['q13']==1){echo 'checked';} ?> />
                              <label for="radio32" class="css-label radGroup2"><span class="checkbox">Yes</span></label></td>
                          </tr>
                        </table></td>
                        <td align="left"><table width="50" border="0" cellpadding="0" cellspacing="0">
                          <tr>
                            <td><input type="radio" name="radiog_dark13" id="radio33" class="css-checkbox" <?php if($form1['q13']==2){echo 'checked';} ?> />
                              <label for="radio33" class="css-label radGroup2"><span class="checkbox">No</span></label></td>
                          </tr>
                        </table></td>
                      </tr>
                    </table></td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td height="1" bgcolor="#b6cc3a"></td>
              </tr>
              <tr>
                <td height="1"><table width="0" border="0" cellspacing="0" cellpadding="5">
                  <tr>
                    <td width="300" height="20" class="pro_main_s">Has the dog ever bitten anyone?</td>
                    <td><table border="0" cellpadding="0" cellspacing="0">
                      <tr>
                        <td align="left"><table width="50" border="0" cellpadding="0" cellspacing="0">
                          <tr>
                            <td><input name="radiog_dark14" type="radio" class="css-checkbox" id="radio34" <?php if($form1['q14']==1){echo 'checked';} ?> />
                              <label for="radio34" class="css-label radGroup2"><span class="checkbox">Yes</span></label></td>
                          </tr>
                        </table></td>
                        <td align="left"><table width="50" border="0" cellpadding="0" cellspacing="0">
                          <tr>
                            <td><input type="radio" name="radiog_dark14" id="radio35" class="css-checkbox" <?php if($form1['q14']==2){echo 'checked';} ?> />
                              <label for="radio35" class="css-label radGroup2"><span class="checkbox">No</span></label></td>
                          </tr>
                        </table></td>
                      </tr>
                    </table></td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td height="1" bgcolor="#b6cc3a"></td>
              </tr>
              <tr>
                <td height="1"><table width="0" border="0" cellspacing="0" cellpadding="5">
                  <tr>
                    <td width="300" height="0" valign="top" class="pro_main_s">Were the dog’s puppies, siblings, canine mother, canine father rescued?</td>
                    <td width="180" valign="top"><table width="180" border="0" cellpadding="0" cellspacing="0">
                      <tr>
                        <td height="30" align="left"><table border="0" cellpadding="0" cellspacing="0">
                          <tr>
                            <td height="20"><input name="radiog_dark15" type="checkbox" class="css-checkbox" id="radio36" <?php if($form1['q15_1']==1){echo 'checked';} ?> />
                              <label for="radio36"><span class="checkbox">Puppies</span></label></td>
                          </tr>
                        </table></td>
                      </tr>
                      <tr>
                        <td height="30" align="left" valign="middle"><table border="0" cellpadding="0" cellspacing="0">
                          <tr>
                            <td><input type="checkbox" name="radiog_dark15" id="radio37" class="css-checkbox" <?php if($form1['q15_2']==1){echo 'checked';} ?> />
                              <label for="radio37"><span class="checkbox">Siblings </span></label></td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr>
                        <td height="30" align="left" valign="middle"><table border="0" cellpadding="0" cellspacing="0">
                          <tr>
                            <td><input type="checkbox" name="radiog_dark15" id="radio38" class="css-checkbox" <?php if($form1['q15_3']==1){echo 'checked';} ?> />
                              <label for="radio38"><span class="checkbox">Mother </span></label></td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr>
                        <td height="30" align="left" valign="middle"><table border="0" cellpadding="0" cellspacing="0">
                          <tr>
                            <td><input type="checkbox" name="radiog_dark15" id="radio39" class="css-checkbox" <?php if($form1['q15_4']==1){echo 'checked';} ?> />
                              <label for="radio39"><span class="checkbox">Father</span></label></td>
                            </tr>
                          </table></td>
                      </tr>
                    </table></td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td height="1" bgcolor="#b6cc3a"></td>
              </tr>
              <tr>
                <td height="1"><table width="520" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="57" height="0" valign="top" class="pro_main_s"><div style="margin:5px 0 0 5px;">Notes：</div></td>
                    <td height="165" valign="top" class="pro_main_s" style="background:url(images/adoption_notes_bg.png) repeat-x;">
                    	<div style=" line-height:33px;"><?=stripslashes($form1['remark'])?></div></td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td><img src="images/a_main_10.jpg" width="554" height="48" alt="" /></td>
          </tr>
          <tr>
            <td height="568" align="center"><table width="94%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><table width="0" border="0" cellspacing="0" cellpadding="5">
                  <tr>
                    <td width="300" height="0" class="pro_main_s">Vaccination History<br /></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td height="0" class="pro_main_s"></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td height="0" class="pro_main_s">1    vaccination date:<br /></td>
                    <td class="pro_main_s"><?=stripslashes($form2['q1'])?></td>
                  </tr>
                  <tr>
                    <td height="0" class="pro_main_s">2    vaccination date:<br /></td>
                    <td class="pro_main_s"><?=stripslashes($form2['q2'])?></td>
                  </tr>
                  <tr>
                    <td height="0" class="pro_main_s">3    vaccination date:<br /></td>
                    <td class="pro_main_s"><?=stripslashes($form2['q3'])?></td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td height="1" bgcolor="#E25188"></td>
              </tr>
              <tr>
                <td height="40"><table width="0" border="0" cellspacing="0" cellpadding="5">
                  <tr>
                    <td width="300" height="0" class="pro_main_s">Rabies vaccination date:</td>
                    <td class="pro_main_s"><?=stripslashes($form2['q4'])?></td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td height="1" bgcolor="#E25188"></td>
              </tr>
              <tr>
                <td height="80"><table width="0" border="0" cellspacing="0" cellpadding="5">
                  <tr>
                    <td width="300" height="0" valign="top" class="pro_main_s">Idexx 4-1 Kit Test Result:</td>
                    <td width="180" valign="top"><table border="0" cellpadding="0" cellspacing="0">
                      <tr>
                        <td align="left"><table width="100" border="0" cellpadding="0" cellspacing="0">
                          <tr>
                            <td><input type="radio" name="r1" id="radio41" class="css-checkbox" <?php if($form2['q5']==1){echo 'checked';} ?> />
                              <label for="radio41" class="css-label2 radGroup2"><span class="checkbox">Negative</span></label></td>
                          </tr>
                        </table></td>
                        <td align="left"><table width="50" border="0" cellpadding="0" cellspacing="0">
                          <tr>
                            <td><input name="r1" type="radio" class="css-checkbox" id="radio42" <?php if($form2['q5']==2){echo 'checked';} ?> />
                              <label for="radio42" class="css-label2 radGroup2"><span class="checkbox">Positive</span></label></td>
                          </tr>
                        </table></td>
                      </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td height="0" valign="top" class="pro_main_s">Date:</td>
                    <td valign="top" class="pro_main_s"><?=stripslashes($form2['q6'])?></td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td height="1" bgcolor="#E25188"></td>
              </tr>
              <tr>
                <td height="100"><table width="0" border="0" cellspacing="0" cellpadding="5">
                  <tr>
                    <td width="300" height="0" valign="top" class="pro_main_s">Heartworm Result:</td>
                    <td width="180" valign="top"><table border="0" cellpadding="0" cellspacing="0">
                      <tr>
                        <td align="left"><table width="100" border="0" cellpadding="0" cellspacing="0">
                          <tr>
                            <td><input type="radio" name="r2" id="radio43" class="css-checkbox" <?php if($form2['q7']==1){echo 'checked';} ?> />
                              <label for="radio43" class="css-label2 radGroup2"><span class="checkbox">Negative</span></label></td>
                          </tr>
                        </table></td>
                        <td align="left"><table width="50" border="0" cellpadding="0" cellspacing="0">
                          <tr>
                            <td><input name="r2" type="radio" class="css-checkbox" id="radio44" <?php if($form2['q7']==2){echo 'checked';} ?> />
                              <label for="radio44" class="css-label2 radGroup2"><span class="checkbox">Positive</span></label></td>
                          </tr>
                        </table></td>
                      </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td height="0" valign="top" class="pro_main_s">Date:</td>
                    <td valign="top" class="pro_main_s"><?=stripslashes($form2['q8'])?></td>
                  </tr>
                  <tr>
                    <td height="0" valign="top" class="pro_main_s">Treatment Date: If positive.</td>
                    <td valign="top" class="pro_main_s"><?=stripslashes($form2['q9'])?></td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td height="1" bgcolor="#E25188"></td>
              </tr>
              <tr>
                <td height="100"><table width="0" border="0" cellspacing="0" cellpadding="5">
                  <tr>
                    <td width="300" height="0" valign="top" class="pro_main_s">Giardia Test Result:</td>
                    <td width="180" valign="top"><table border="0" cellpadding="0" cellspacing="0">
                      <tr>
                        <td align="left"><table width="100" border="0" cellpadding="0" cellspacing="0">
                          <tr>
                            <td><input type="radio" name="r3" id="radio45" class="css-checkbox" <?php if($form2['q10']==1){echo 'checked';} ?> />
                              <label for="radio45" class="css-label2 radGroup2"><span class="checkbox">Negative</span></label></td>
                          </tr>
                        </table></td>
                        <td align="left"><table width="50" border="0" cellpadding="0" cellspacing="0">
                          <tr>
                            <td><input name="r3" type="radio" class="css-checkbox" id="radio46" <?php if($form2['q10']==2){echo 'checked';} ?> />
                              <label for="radio46" class="css-label2 radGroup2"><span class="checkbox">Positive</span></label></td>
                          </tr>
                        </table></td>
                      </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td height="0" valign="top" class="pro_main_s">How long has it been on medication if tested<br />
                      positive for Giardia?</td>
                    <td valign="top" class="pro_main_s"><?=stripslashes($form2['q11'])?></td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td height="1" bgcolor="#E25188"></td>
              </tr>
              <tr>
                <td height="40"><table width="0" border="0" cellspacing="0" cellpadding="5">
                  <tr>
                    <td width="300" valign="top" class="pro_main_s">Deworming Date:</td>
                    <td height="20" class="pro_main_s"><?=stripslashes($form2['q12'])?></td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td height="1" bgcolor="#E25188"></td>
              </tr>
              <tr>
                <td height="40"><table width="0" border="0" cellspacing="0" cellpadding="5">
                  <tr>
                    <td width="300" valign="top" class="pro_main_s">Heartworm Preventative:</td>
                    <td height="20" class="pro_main_s"><?=stripslashes($form2['q13'])?></td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td height="1" bgcolor="#E25188"></td>
              </tr>
              <tr>
                <td height="40"><table width="0" border="0" cellspacing="0" cellpadding="5">
                  <tr>
                    <td width="300" valign="top" class="pro_main_s">Frontline Date:</td>
                    <td height="20" class="pro_main_s"><?=stripslashes($form2['q14'])?></td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td height="1" bgcolor="#E25188"></td>
              </tr>
              <tr>
                <td height="1"><table width="520" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="57" height="0" valign="top" class="pro_main_s"><div style="margin:5px 0 0 5px;">Notes：</div></td>
                    <td height="165" valign="top" class="pro_main_s" style="background:url(images/adoption_notes_bg.png) repeat-x;">
                    	<div style=" line-height:33px;"><?=stripslashes($form2['remark'])?></div></td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
        <td width="426" valign="top"><table width="0" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="426" height="682" valign="top" background="images/a_main_03.jpg"><table width="0" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="426" height="682" align="center" valign="top" background="images/a_main_03.jpg">
            
            <div id="container">
                <div id="products_example">
                    <div id="products">
                        <div class="slides_container">
                        <?php
                        for($i=1; $i<=3; $i++) {
                            if($dogs['file'.$i]){ ?><a href="#" target="_blank"><img src="dogs/<?=$dogs['file'.$i]?>" width="335" alt="<?=stripslashes($dogs['name'])?>"></a><?php }
                        }
                        ?>					
                        </div>
                        <div style="float:left; width:335px;">
                        	<div class="pro_title" style="float:left; padding:6px 5px 5px 10px; color:<?=($dogs['sex']=='Male')?'#13A4A0':'#E84693'?>;"><?=stripslashes($dogs['name'])?></div>
                        	<div class="pro_main" style="float:left; padding:12px 0 0 5px;"><?=stripslashes($dogs['sex'])?>, <?=($dogs['years']>0)?stripslashes($dogs['years']).' year(s)':''?><?=($dogs['month'])?' '.$dogs['month'].' month(s)':''?>, <?=stripslashes($dogs['weight'])?> lb</div>
                        </div>
                        <ul class="pagination">
                        <?php
                        for($i=1; $i<=3; $i++) {
                            if($dogs['file'.$i]){ ?><li <?php if($i==1){ ?>class="current"<?php } ?>><a rel="<?=$i-1?>" href="#"><img src="dogs/<?=$dogs['file'.$i]?>" width="100" alt="<?=stripslashes($dogs['name'])?>"></a></li><?php }
                        }
                        ?>					
                        </ul>
                    </div>
                </div>
            </div>
            
            
            
            
            
              <table width="335" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                  <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="5">
                        <tr>
                          <td align="left" valign="top"><table width="0" border="0" cellpadding="0">
                            <tr>
                              <td><a href="javascript:window.print();"><img src="images/a_main_2_01.jpg" width="41" height="67" border="0" /></a></td>
                              <td><a href="contact.php"><img src="images/a_main_2_02.jpg" width="65" height="67" border="0" /></a></td>
                            </tr>
                          </table></td>
                          <td align="right" valign="top">
                          <span class="in_btn_app1"><a href="adoption_1105a.php?dog_id=<?=$dogs['Fullkey']?>" target="_blank">APPLY</a></span>
 						  <span class="in_btn_app1"><a href="adoption_1105b.php?dog_id=<?=$dogs['Fullkey']?>" target="_blank">Agreement</a></span>
                          </td>
                          <td width="1" align="right" valign="top"></td>
                        </tr>
                      </table></td>
                    </tr>
                  </table></td>
                </tr>
            </table></td>
          </tr>
        </table></td>
          </tr>
          <tr>
            <td height="103" style="background:url(images/a_main_05.jpg) no-repeat;">
            <div style="width:369px; margin:5px 0 0 5px; padding:6px 0px 15px 15px;">
            	<div class="pro_main_s">
                	Please watch <a href="#" class="pro_main_g" style="color:<?=($dogs['sex']=='Male')?'#13A4A0':'#E84693'?>;"><?=stripslashes($dogs['name'])?> </a> videos below:
                    The videos will give you a good idea of the dog’s temperament:
                    (However, some dogs react differently with different owners.  The videos show how <a href="#" class="pro_main_g" style="color:<?=($dogs['sex']=='Male')?'#13A4A0':'#E84693'?>;"><?=stripslashes($dogs['name'])?> </a> is now in foster home).
                </div>
            </div>
            </td>
          </tr>
          <tr>
            <td height="45" style="background:url(images/a_main_06.jpg) no-repeat;"><table width="0" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="20">&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <!--
              <tr>
                <td width="68">&nbsp;</td>
                <td class="pro_main_02">Interact</td>
              </tr>
              -->
            </table></td>
          </tr>
          <tr>
            <td height="1679" valign="top"><table width="0" border="0" cellspacing="0" cellpadding="0">
              <?php
              for($i=1; $i<=8; $i++) {
                if($dogs['youtube'.$i]) {
                    $youtube = explode("//", $dogs['youtube'.$i]);
                    $youtube = explode("/", $youtube[count($youtube)-1]);
                    $youtube_id = $youtube[count($youtube)-1];
                    ?>
              <tr>
                <td>
                  <table width="0" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td width="6"></td>
                          <td><iframe width="398" height="224" src="//www.youtube.com/embed/<?=$youtube_id?>" frameborder="0" allowfullscreen="allowfullscreen"></iframe></td>
                          <td width="0"></td>
                        </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td height="25"><!--<table width="0" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td width="68">&nbsp;</td>
                          <td class="pro_main_02">&nbsp;</td>
                        </tr>
                      </table>--></td>
                    </tr>
                  </table></td>
              </tr>
                    <?php
                }
              }
              ?>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td valign="top">&nbsp;</td>
        <td align="right" valign="top">&nbsp;</td>
      </tr>
      <tr>
        <td valign="top"><div style="margin-left:20px; margin-top:3px;"><a href="adoption.php"><img src="images/a_main_12.png" alt="" /></a></div></td>
        <td align="right" valign="top">
        <div class="top" style="margin:0px 30px 40px 0;">
        	<a href="#top"><img src="images/top_01.png" width="28" height="28" /></a>
        </div>  
        </td>
      </tr>
    </table>
                     	
	</div>
	<!----------- 內容 結束 ------------------> 

</div>

<!-- 小圖輪播 開始 -->
<script src="js/jquery-1.4.4.min.js"></script>

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

<script src="js/slides.min.jquery.js"></script>
<script>
$(function(){
	$('#products').slides({
		preload: true,
		preloadImage: 'images/loading.gif',
		effect: 'slide, fade',
		crossfade: true,
		slideSpeed: 200,
		fadeSpeed: 500,
		generateNextPrev: true,
		generatePagination: false
	});
});
</script>
<link rel="stylesheet" href="css/global.css">
<!-- 小圖輪播 結束 -->

</body>
</html>