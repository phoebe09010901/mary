<?php
header("content-type:text/html;charset=utf-8");
header("Content-type:application/vnd.ms-excel");
header("Content-Disposition:filename=apply_".date("Ymd").".xls");
require_once("set.php");

$main_str   = 'dogs_apply';
$table_name = Proj_Name.'_'.$main_str;	

//data list
$query = "select * from ".$table_name."1 where output=1 order by create_time desc";	
$obj_dogs->run_mysql_list($query);
?><!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title><?=Html_Title?>後台管理系統</title>
</head>
<body>
          <table width="100%"  cellspacing="0" cellpadding="0" border="1">
              <tr style="color:#09F; font-weight:bolder">
                <th align="center" bgcolor="#FFFFFF">&nbsp;</th>
                <th colspan="3" align="center" bgcolor="#FFFFFF">Name of Available Dog</th>
                <th align="center" bgcolor="#FFFFFF">Reason(s) You Are Adopting</th>
                <th colspan="3" align="center" bgcolor="#FFFFFF">What traits are you looking for in your new dog?</th>
                <th colspan="29" align="center" bgcolor="#FFFFFF">APPLICANT’S INFORMATION</th>
                <th colspan="6" align="center" bgcolor="#FFFFFF">Emergency Contact</th>
                <th colspan="8" align="center" bgcolor="#FFFFFF">CAREGIVER(S) FOR THE DOG</th>
                <th colspan="9" align="center" bgcolor="#FFFFFF">DOG’S HOME ENVIRONMENT</th>
                <th colspan="24" align="center" bgcolor="#FFFFFF">OTHER PETS IN SAME HOUSEHOLD (CURRENT/PAST)</th>
                <th colspan="6" align="center" bgcolor="#FFFFFF">TRAINING</th>
                <th colspan="1" align="center" bgcolor="#FFFFFF">HOME INSPECTION/PHOTOGRAPHS</th>
                <th colspan="18" align="center" bgcolor="#FFFFFF">REFERENCES</th>
                <th colspan="5" align="center" bgcolor="#FFFFFF">OPTIONAL INFORMATION</th>
              </tr>
              <tr>
                <th align="center" bgcolor="#e6e7e3">Apply ID</th>
                <!-- apply1 -->
                <th align="center" bgcolor="#e6e7e3">1st Choice</th>
                <th align="center" bgcolor="#e6e7e3">2nd Choice</th>
                <th align="center" bgcolor="#e6e7e3">3rd Choice</th>
                <th align="center" bgcolor="#e6e7e3">check all that apply</th>
                <th align="center" bgcolor="#e6e7e3">Temperament</th>
                <th align="center" bgcolor="#e6e7e3">Age</th>
                <th align="center" bgcolor="#e6e7e3">Look/Color</th>
                <!-- apply2 -->
                <th align="center" bgcolor="#e6e7e3">First Name</th>
                <th align="center" bgcolor="#e6e7e3">Middle Name</th>
                <th align="center" bgcolor="#e6e7e3">Last Name</th>
                <th align="center" bgcolor="#e6e7e3">Email</th>
                <th align="center" bgcolor="#e6e7e3">Age</th>
                <th align="center" bgcolor="#e6e7e3">Occupation</th>
                <th align="center" bgcolor="#e6e7e3">Home Address</th>
                <th align="center" bgcolor="#e6e7e3">City</th>
                <th align="center" bgcolor="#e6e7e3">State</th>
                <th align="center" bgcolor="#e6e7e3">Zip Code</th>
                <th align="center" bgcolor="#e6e7e3">Home Tel</th>
                <th align="center" bgcolor="#e6e7e3">Cell Tel</th>
                <th align="center" bgcolor="#e6e7e3">Work Tel</th>
                <th align="center" bgcolor="#e6e7e3">When is a good time to call?</th>
                <th align="center" bgcolor="#e6e7e3">Time at Address</th>
                <th align="center" bgcolor="#e6e7e3">Housing Type</th>
                <th align="center" bgcolor="#e6e7e3">Housing</th>
                <th align="center" bgcolor="#e6e7e3">Landlord Name</th>
                <th align="center" bgcolor="#e6e7e3">Landlord Tel</th>
                <th align="center" bgcolor="#e6e7e3">Conﬁrm Landlord Allows Dogs</th>
                <th align="center" bgcolor="#e6e7e3">Other Members of the Household</th>
                <th align="center" bgcolor="#e6e7e3">Child(ren)’s Experience with Dogs</th>
                <th align="center" bgcolor="#e6e7e3">Child(ren) taught be respective to dogs?</th>
                <th align="center" bgcolor="#e6e7e3">All members of household aware of and agree to the adoption of a dog</th>
                <th align="center" bgcolor="#e6e7e3">Do you or any members of your household have any health conditions that may affect your ability to permanently care for the dog</th>
                <th align="center" bgcolor="#e6e7e3">If you decide to move in the future, plans for dog</th>
                <th align="center" bgcolor="#e6e7e3">Do you have any plans to move in the next 6 months?</th>
                <th align="center" bgcolor="#e6e7e3">Do you have any plans to take any extended trips/vacations in the next 3 months?</th>
                <th align="center" bgcolor="#e6e7e3">If yes, explain where, how long, and where the dog will be during that time</th>
                <th align="center" bgcolor="#e6e7e3">Contact Name</th>
                <th align="center" bgcolor="#e6e7e3">Tel</th>
                <th align="center" bgcolor="#e6e7e3">Home Address</th>
                <th align="center" bgcolor="#e6e7e3">City</th>
                <th align="center" bgcolor="#e6e7e3">State</th>
                <th align="center" bgcolor="#e6e7e3">Zip Code</th>
                <!-- apply3 -->
                <th align="center" bgcolor="#e6e7e3">Name</th>
                <th align="center" bgcolor="#e6e7e3">Age</th>
                <th align="center" bgcolor="#e6e7e3">Veterinarian Name</th>
                <th align="center" bgcolor="#e6e7e3">Vet Tel</th>
                <th align="center" bgcolor="#e6e7e3">Veterinarian Address</th>
                <th align="center" bgcolor="#e6e7e3">City</th>
                <th align="center" bgcolor="#e6e7e3">State</th>
                <th align="center" bgcolor="#e6e7e3">Zip Code</th>
                <!-- apply4 -->
                <th align="center" bgcolor="#e6e7e3">Where will the dog be normally kept</th>
                <th align="center" bgcolor="#e6e7e3">Time(s) of Day/Night</th>
                <th align="center" bgcolor="#e6e7e3">Number of days dog will be left alone</th>
                <th align="center" bgcolor="#e6e7e3">Outdoors: Yard</th>
                <th align="center" bgcolor="#e6e7e3">Fenced In</th>
                <th align="center" bgcolor="#e6e7e3">Height of fence</th>
                <th align="center" bgcolor="#e6e7e3">Any possibility of the dog escaping the yard</th>
                <th align="center" bgcolor="#e6e7e3">Indoors: Location(s) Dog will be kept/allowed while indoors</th>
                <th align="center" bgcolor="#e6e7e3">Types of outdoor activities/exercises plan to do with the dog</th>
                <!-- apply5 -->
                <th align="center" bgcolor="#e6e7e3">1st Pet Name</th>
                <th align="center" bgcolor="#e6e7e3">Type of pet</th>
                <th align="center" bgcolor="#e6e7e3">Breed</th>
                <th align="center" bgcolor="#e6e7e3">Gender</th>
                <th align="center" bgcolor="#e6e7e3">Age</th>
                <th align="center" bgcolor="#e6e7e3">Spayed/Neutered</th>
                <th align="center" bgcolor="#e6e7e3">Length of time owned 1st pet</th>
                <th align="center" bgcolor="#e6e7e3">Lives</th>
                <th align="center" bgcolor="#e6e7e3">Gets along with dogs</th>
                <th align="center" bgcolor="#e6e7e3">2nd Pet Name</th>
                <th align="center" bgcolor="#e6e7e3">Type of pet</th>
                <th align="center" bgcolor="#e6e7e3">Breed</th>
                <th align="center" bgcolor="#e6e7e3">Gender</th>
                <th align="center" bgcolor="#e6e7e3">Age</th>
                <th align="center" bgcolor="#e6e7e3">Spayed/Neutered</th>
                <th align="center" bgcolor="#e6e7e3">Length of time owned 2nd pet</th>
                <th align="center" bgcolor="#e6e7e3">Lives</th>
                <th align="center" bgcolor="#e6e7e3">Gets along with dogs</th>
                <th align="center" bgcolor="#e6e7e3">Have you ever lost or had to give up a pet before</th>
                <th align="center" bgcolor="#e6e7e3">If yes, what happened</th>
                <th align="center" bgcolor="#e6e7e3">Please provide details of the above incident(s) including type of pet, age, reason(s), and date occurred</th>
                <th align="center" bgcolor="#e6e7e3">Prior experience with a shelter/rescue group before</th>
                <th align="center" bgcolor="#e6e7e3">What you liked about it</th>
                <th align="center" bgcolor="#e6e7e3">What you did not like about it</th>
                <!-- apply6 -->
                <th align="center" bgcolor="#e6e7e3">Experience level</th>
                <th align="center" bgcolor="#e6e7e3">Have you or the primarycaregiver ever attended any dog training classes</th>
                <th align="center" bgcolor="#e6e7e3">If you have attended training classes, details</th>
                <th align="center" bgcolor="#e6e7e3">Will you consider training if needed</th>
                <th align="center" bgcolor="#e6e7e3">Are you aware that not all rescue dogs are completely house trained and accidents may occur?</th>
                <th align="center" bgcolor="#e6e7e3">Would the dog not being fully housetrained affect your ability to provide a permanent home</th>
                <!-- apply7 -->
                <th align="center" bgcolor="#e6e7e3">Agree that a representative from Adopt a Doggie may schedule a visit to your homeupon request to verify it is a suitable place for the dog, which may include photographs</th>
                <!-- apply8 -->
                <th align="center" bgcolor="#e6e7e3">Reference #1 Name</th>
                <th align="center" bgcolor="#e6e7e3">Relationship to this reference</th>
                <th align="center" bgcolor="#e6e7e3">Tel</th>
                <th align="center" bgcolor="#e6e7e3">Email</th>
                <th align="center" bgcolor="#e6e7e3">Home Address</th>
                <th align="center" bgcolor="#e6e7e3">City</th>
                <th align="center" bgcolor="#e6e7e3">State</th>
                <th align="center" bgcolor="#e6e7e3">Zip Code</th>
                <th align="center" bgcolor="#e6e7e3">Reference #2 Name</th>
                <th align="center" bgcolor="#e6e7e3">Relationship to this reference</th>
                <th align="center" bgcolor="#e6e7e3">Tel</th>
                <th align="center" bgcolor="#e6e7e3">Email</th>
                <th align="center" bgcolor="#e6e7e3">Home Address</th>
                <th align="center" bgcolor="#e6e7e3">City</th>
                <th align="center" bgcolor="#e6e7e3">State</th>
                <th align="center" bgcolor="#e6e7e3">Zip Code</th>
                <th align="center" bgcolor="#e6e7e3">Child(ren)’s Experience with Dogs</th>
                <th align="center" bgcolor="#e6e7e3">By signing this Adoption Application, you attest that all of the information provided within is accurate and truthful to the best of your knowledge</th>
                <!-- apply9 -->
                <th align="center" bgcolor="#e6e7e3">How did you hear about Adopt a Doggie</th>
                <th align="center" bgcolor="#e6e7e3">Would you like to be invited to the Adopt a Doggie Bay Area Dog Owners Facebook Page?</th>
                <th align="center" bgcolor="#e6e7e3">Would you like to be included on the Adopt a Doggie email list?</th>
                <th align="center" bgcolor="#e6e7e3">May we share your contact information with your dog’s rescuer after the adoption is ﬁnalized?</th>
                <th align="center" bgcolor="#e6e7e3">Additional comments or questions</th>
              </tr>
              <?php
              for ($i=0; $i<$obj_dogs->obj_all; $i++){
                $apply1 = mysql_fetch_array($obj_dogs->result);
                if ($apply1) {
					$query = "select * from ".$table_name."2 where apply_id='".$apply1['Fullkey']."'";
					$apply2 = $obj_menu1->run_mysql_out($query);
					$query = "select * from ".$table_name."3 where apply_id='".$apply1['Fullkey']."'";
					$apply3 = $obj_menu1->run_mysql_out($query);
					$query = "select * from ".$table_name."4 where apply_id='".$apply1['Fullkey']."'";
					$apply4 = $obj_menu1->run_mysql_out($query);
					$query = "select * from ".$table_name."5 where apply_id='".$apply1['Fullkey']."'";
					$apply5 = $obj_menu1->run_mysql_out($query);
					$query = "select * from ".$table_name."6 where apply_id='".$apply1['Fullkey']."'";
					$apply6 = $obj_menu1->run_mysql_out($query);
					$query = "select * from ".$table_name."7 where apply_id='".$apply1['Fullkey']."'";
					$apply7 = $obj_menu1->run_mysql_out($query);
					$query = "select * from ".$table_name."8 where apply_id='".$apply1['Fullkey']."'";
					$apply8 = $obj_menu1->run_mysql_out($query);
					$query = "select * from ".$table_name."9 where apply_id='".$apply1['Fullkey']."'";
					$apply9 = $obj_menu1->run_mysql_out($query);
                ?>
              <tr>
                <td align="center"><?=$apply1['Fullkey']?></td>
                <!-- apply1 -->
                <td align="center"><?=$apply1['ans1']?></td>
                <td align="center"><?=$apply1['ans2']?></td>
                <td align="center"><?=$apply1['ans3']?></td>
                <td align="center"><?php 
				if($apply1['ans4']){ echo $apply1['ans4'].', '; }
				if($apply1['ans5']){ echo $apply1['ans5'].', '; }
				if($apply1['ans6']){ echo $apply1['ans6'].', '; }
				if($apply1['ans7']){ echo $apply1['ans7'].', '; }
				if($apply1['ans8']){ echo $apply1['ans8'].', '; }
				if($apply1['ans9']){ echo $apply1['ans9'].':'.$apply1['ans10'].', '; }
				if($apply1['ans11']){ echo $apply1['ans11'].':'.$apply1['ans12']; }
				?></td>
                <td align="center"><?=$apply1['ans13']?></td>
                <td align="center"><?=$apply1['ans14']?></td>
                <td align="center"><?=$apply1['ans15']?></td>
                <!-- apply2 -->
                <td align="center"><?=$apply2['ans1']?></td>
                <td align="center"><?=$apply2['ans2']?></td>
                <td align="center"><?=$apply2['ans3']?></td>
                <td align="center"><?=$apply2['ans3']?></td>
                <td align="center"><?=$apply2['ans5']?></td>
                <td align="center"><?=$apply2['ans6']?></td>
                <td align="center"><?=$apply2['ans7']?></td>
                <td align="center"><?=$apply2['ans8']?></td>
                <td align="center"><?=$apply2['ans9']?></td>
                <td align="center"><?=$apply2['ans10']?></td>
                <td align="center"><?='('.$apply2['ans11'].')'.$apply2['ans12'].'-'.$apply2['ans13']?></td>
                <td align="center"><?='('.$apply2['ans14'].')'.$apply2['ans15'].'-'.$apply2['ans16']?></td>
                <td align="center"><?='('.$apply2['ans17'].')'.$apply2['ans18'].'-'.$apply2['ans19']?></td>
                <td align="center"><?=$apply2['ans20']?></td>
                <td align="center"><?=$apply2['ans21'].'month(s)'.$apply2['ans22'].'year(s)'?></td>
                <td align="center"><?php 
				if($apply2['ans23']=='Other'){ echo $apply2['ans23'].':'.$apply2['ans24']; }
				else{ echo $apply2['ans23']; }
				?></td>
                <td align="center"><?php 
				if($apply2['ans25']=='Other'){ echo $apply2['ans25'].':'.$apply2['ans26']; }
				else{ echo $apply2['ans25']; }
				?></td>
                <td align="center"><?=$apply2['ans27']?></td>
                <td align="center"><?='('.$apply2['ans28'].')'.$apply2['ans29'].'-'.$apply2['ans30']?></td>
                <td align="center"><?=$apply2['ans31']?></td>
                <td align="center"><?php 
				if($apply2['ans32']){ echo $apply2['ans32'].', '; }
				if($apply2['ans52']){ echo $apply2['ans52'].'(#'.$apply2['ans33'].' /Age '.$apply2['ans34'].'), '; }
				if($apply2['ans53']){ echo $apply2['ans53'].'(#'.$apply2['ans35'].'), '; }
				if($apply2['ans54']){ echo $apply2['ans54'].'(#'.$apply2['ans36'].')'; }
				?></td>
                <td align="center"><?=$apply2['ans37']?></td>
                <td align="center"><?=$apply2['ans38']?></td>
                <td align="center"><?=$apply2['ans39']?></td>
                <td align="center"><?php 
				if($apply2['ans40']=='No'){ echo $apply2['ans40'].':'.$apply2['ans41']; }
				else{ echo $apply2['ans40']; }
				?></td>
                <td align="center"><?=$apply2['ans42']?></td>
                <td align="center"><?=$apply2['ans49']?></td>
                <td align="center"><?=$apply2['ans50']?></td>
                <td align="center"><?=$apply2['ans51']?></td>
                <td align="center"><?=$apply2['ans43']?></td>
                <td align="center"><?=$apply2['ans44']?></td>
                <td align="center"><?=$apply2['ans45']?></td>
                <td align="center"><?=$apply2['ans46']?></td>
                <td align="center"><?=$apply2['ans47']?></td>
                <td align="center"><?=$apply2['ans48']?></td>
                <!-- apply3 -->
                <td align="center"><?=$apply3['ans1']?></td>
                <td align="center"><?=$apply3['ans2']?></td>
                <td align="center"><?=$apply3['ans3']?></td>
                <td align="center"><?='('.$apply3['ans4'].')'.$apply3['ans5'].'-'.$apply3['ans6']?></td>
                <td align="center"><?=$apply3['ans7']?></td>
                <td align="center"><?=$apply3['ans8']?></td>
                <td align="center"><?=$apply3['ans9']?></td>
                <td align="center"><?=$apply3['ans10']?></td>
                <!-- apply4 -->
                <td align="center"><?php 
				if($apply4['ans1']=='Other'){ echo $apply4['ans1'].':'.$apply4['ans2']; }
				else{ echo $apply4['ans1']; }
				?></td>
                <td align="center"><?php 
				if($apply4['ans3']=='Indoors'){ echo $apply4['ans3'].':'.$apply4['ans4']; }
				elseif($apply4['ans3']=='Outdoor'){ echo $apply4['ans3'].':'.$apply4['ans5']; }
				?></td>
                <td align="center"><?php 
				if($apply4['ans6']=='Weekdays'){ echo $apply4['ans6'].':'.$apply4['ans7']; }
				elseif($apply4['ans6']=='Weekends'){ echo $apply4['ans6'].':'.$apply4['ans8']; }
				?></td>
                <td align="center"><?=$apply4['ans9']?></td>
                <td align="center"><?=$apply4['ans10']?></td>
                <td align="center"><?=$apply4['ans11'].' feet'?></td>
                <td align="center"><?php 
				if($apply4['ans12']=='Yes'){ echo $apply4['ans12'].':'.$apply4['ans13']; }
				else{ echo $apply4['ans12']; }
				?></td>
                <td align="center"><?php 
				if($apply4['ans14']){ echo $apply4['ans14'].', '; }
				if($apply4['ans17']){ echo $apply4['ans17'].', '; }
				if($apply4['ans18']){ echo $apply4['ans18'].', '; }
				if($apply4['ans19']){ echo $apply4['ans19'].', '; }
				if($apply4['ans20']){ echo $apply4['ans20'].', '; }
				if($apply4['ans21']){ echo $apply4['ans21'].':'.$apply4['ans15']; }
				?></td>
                <td align="center"><?=$apply4['ans16']?></td>
                <!-- apply5 -->
                <td align="center"><?=$apply5['ans1'].'('.$apply5['ans33'].')'?></td>
                <td align="center"><?=$apply5['ans2']?></td>
                <td align="center"><?=$apply5['ans3']?></td>
                <td align="center"><?=$apply5['ans4']?></td>
                <td align="center"><?=$apply5['ans5'].'month(s)'.$apply5['ans6'].'year(s)'?></td>
                <td align="center"><?=$apply5['ans7']?></td>
                <td align="center"><?=$apply5['ans8'].'month(s)'.$apply5['ans9'].'year(s)'?></td>
                <td align="center"><?=$apply5['ans10']?></td>
                <td align="center"><?php 
				if($apply5['ans11']=='No'){ echo $apply5['ans11'].':'.$apply5['ans12']; }
				else{ echo $apply5['ans11']; }
				?></td>
                <td align="center"><?=$apply5['ans13'].'('.$apply5['ans34'].')'?></td>
                <td align="center"><?=$apply5['ans14']?></td>
                <td align="center"><?=$apply5['ans15']?></td>
                <td align="center"><?=$apply5['ans16']?></td>
                <td align="center"><?=$apply5['ans17'].'month(s)'.$apply5['ans18'].'year(s)'?></td>
                <td align="center"><?=$apply5['ans19']?></td>
                <td align="center"><?=$apply5['ans20'].'month(s)'.$apply5['ans21'].'year(s)'?></td>
                <td align="center"><?=$apply5['ans22']?></td>
                <td align="center"><?php 
				if($apply5['ans23']=='No'){ echo $apply5['ans23'].':'.$apply5['ans24']; }
				else{ echo $apply5['ans23']; }
				?></td>
                <td align="center"><?=$apply5['ans25']?></td>
                <td align="center"><?php 
				if($apply5['ans26']=='Other'){ echo $apply4['ans26'].':'.$apply4['ans27']; }
				else{ echo $apply5['ans26']; }
				?></td>
                <td align="center"><?=$apply5['ans28']?></td>
                <td align="center"><?php 
				if($apply5['ans29']=='Yes'){ echo $apply5['ans29'].':'.$apply5['ans30']; }
				else{ echo $apply5['ans29']; }
				?></td>
                <td align="center"><?=$apply5['ans31']?></td>
                <td align="center"><?=$apply5['ans32']?></td>
                <!-- apply6 -->
                <td align="center"><?=$apply6['ans1']?></td>
                <td align="center"><?=$apply6['ans2']?></td>
                <td align="center"><?='What Type:'.$apply6['ans3'].', When:'.$apply6['ans4'].', Where:'.$apply6['ans5']?></td>
                <td align="center"><?php 
				if($apply6['ans6']=='No'){ echo $apply6['ans6'].':'.$apply6['ans7']; }
				else{ echo $apply6['ans6']; }
				?></td>
                <td align="center"><?=$apply6['ans8']?></td>
                <td align="center"><?php 
				if($apply6['ans9']=='No'){ echo $apply6['ans9'].':'.$apply6['ans10']; }
				else{ echo $apply6['ans9']; }
				?></td>
                <!-- apply7 -->
                <td align="center"><?php 
				if($apply7['ans1']=='No'){ echo $apply7['ans1'].':'.$apply7['ans2']; }
				else{ echo $apply7['ans1']; }
				?></td>
                <!-- apply8 -->
                <td align="center"><?=$apply8['ans1']?></td>
                <td align="center"><?=$apply8['ans2']?></td>
                <td align="center"><?='('.$apply8['ans3'].')'.$apply8['ans4'].'-'.$apply8['ans5']?></td>
                <td align="center"><?=$apply8['ans6']?></td>
                <td align="center"><?=$apply8['ans7']?></td>
                <td align="center"><?=$apply8['ans8']?></td>
                <td align="center"><?=$apply8['ans9']?></td>
                <td align="center"><?=$apply8['ans10']?></td>
                <td align="center"><?=$apply8['ans11']?></td>
                <td align="center"><?=$apply8['ans12']?></td>
                <td align="center"><?='('.$apply8['ans13'].')'.$apply8['ans14'].'-'.$apply8['ans15']?></td>
                <td align="center"><?=$apply8['ans16']?></td>
                <td align="center"><?=$apply8['ans17']?></td>
                <td align="center"><?=$apply8['ans18']?></td>
                <td align="center"><?=$apply8['ans19']?></td>
                <td align="center"><?=$apply8['ans20']?></td>
                <td align="center"><?=$apply8['ans21']?></td>
                <td align="center"><?='Name:'.$apply8['ans22'].', Signature:'.$apply8['ans23'].', Date:'.$apply8['ans24']?></td>
                <!-- apply9 -->
                <td align="center"><?php 
				if($apply9['ans1']){ echo $apply9['ans1'].', '; }
				if($apply9['ans2']){ echo $apply9['ans2'].', '; }
				if($apply9['ans3']){ echo $apply9['ans3'].', '; }
				if($apply9['ans4']){ echo $apply9['ans4'].', '; }
				if($apply9['ans5']){ echo $apply9['ans5'].', '; }
				if($apply9['ans6']){ echo $apply9['ans6'].', '; }
				if($apply9['ans7']){ echo $apply9['ans7'].', '; }
				if($apply9['ans8']){ echo $apply9['ans8']; }
				?></td>
                <td align="center"><?=$apply9['ans9']?></td>
                <td align="center"><?=$apply9['ans10']?></td>
                <td align="center"><?=$apply9['ans11']?></td>
                <td align="center"><?=$apply9['ans12']?></td>
              </tr>
                <?php
                }
              }
              ?>
        </table>
</body>
</html>