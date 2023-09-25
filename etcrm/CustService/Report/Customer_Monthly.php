<?php
###########################################################>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);


$ThSisUser = "user_".$RowUsreInfo['user_id'] ; 

if(isset($_POST['B1_Fliter'])){ 
$Start_Date = strtotime($_POST['date_from']); 
$End_Date =  strtotime($_POST['date_to']); 
   
}else{
UnsetAllSession('date_from,date_to');
$Report_period =  ReportPeriod($ConfigP['report_period']);
$Start_Date = $Report_period['start']; 
$End_Date = $Report_period['end']; 
$row['date_from'] = ConvertDateToCalender_3($Start_Date) ;   
$row['date_to'] = ConvertDateToCalender_3($End_Date) ; 
}


FormFilter_CustService();

#################################################################################################################################
###################################################   
#################################################################################################################################

if($End_Date < $Start_Date  ){
echo '<div style="clear: both!important;"></div>';
New_Print_Alert("4",$AdminLangFile['leads_date_err']);
$ErrDate = '1' ;
} 
    
    
    
## @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@   التجميع   

$UserSQlFilter = $UserPerm ;


  

$Countdayforloop =  CountDayForLoop($Start_Date,$End_Date) ; 
if($Countdayforloop < MAXIMUM_DAYS){  
   
    
    
$SQLFiter = "SELECT id FROM cust_ticket where  date_add >= $Start_Date and date_add <= $End_Date  $UserSQlFilter";    
$TotalCount = $db->H_Total_Count($SQLFiter);


if($TotalCount > '0'){
    

$Name = $db->SelArr($SQLFiter);  



echo '<div style="clear: both!important;"></div>'; 
ReportBlockPrint("col-md-3",$AdminLangFile['report_number_of_tickets'],$TotalCount,"fa-hdd-o","alert-inverse");
ReportBlockPrint("col-md-3",$AdminLangFile['report_the_number_of_days'],$Countdayforloop,"fa-hdd-o","alert-inverse");
echo '<div style="clear: both!important;"></div>';
  
  
  


$Countdayforloop =  CountDayForLoop($Start_Date,$End_Date) ;     
    
## @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@   الايكون     




    
## @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@   التقرير الاول      
    
           

 


#-------------------------------------------------------------------------------------------------------------------------------------------------


$Countdayforloop =  CountDayForLoop($Start_Date,$End_Date) ; 

echo '<div style="clear: both!important;"></div>'.BR.BR;  
echo  New_Print_Alert("5"," تقرير اضافة الملاحظات ");
###################################################################################################################################################
###################################################################################################################################################
####################################################################  تقارير اضافة الملاحظات
###################################################################################################################################################
###################################################################################################################################################
  $Arr_NewTickets = array();
  $Start_Date_Print = $Start_Date ;
  $TotalCount = "0";
  $MonthData_Send = array();
  for ($x = 1; $x <= $Countdayforloop ; $x++) {
  $already = $db->H_Total_Count("SELECT id FROM customer_notes WHERE date_add = '$Start_Date_Print' $UserSQlFilter");
  $MonthData =  array(ConvertDateToCalender_chart($Start_Date_Print), $already); 
  array_push($MonthData_Send,$MonthData);  
  $Start_Date_Print = ($Start_Date_Print + 86400 ) ;  
  $TotalCount = $TotalCount +  $already ;
  }
  $Count_Ticket =  array(
     'label' =>" الملاحظات"." ". $TotalCount,
     'color' =>  "#7cbf62",
     'data' => $MonthData_Send
   );

array_push($Arr_NewTickets,$Count_Ticket);   
$fp = fopen('json/'.$ThSisUser.'_Notes.json', 'w');
fwrite($fp, json_encode($Arr_NewTickets));
fclose($fp);

echo '<div class="row">';
echo '<div class="col-lg-12">';
echo '<div data-source="json/'.$ThSisUser.'_Notes.json" class="chart-line flot-chart"></div>';
echo '</div>';
echo '</div>';
echo '<div style="clear: both!important;"></div>'.BR.BR;  
 
 
 
 

echo '<div style="clear: both!important;"></div>'.BR.BR;  
New_Print_Alert("1",$AdminLangFile['report_followup_report']); 
###################################################################################################################################################
###################################################################################################################################################
####################################################################  تقارير التذاكر الجديدة
###################################################################################################################################################
###################################################################################################################################################
  $Arr_NewTickets = array();
  $Start_Date_Print = $Start_Date ;
  $TotalCount = "0";
  $MonthData_Send = array();
  for ($x = 1; $x <= $Countdayforloop ; $x++) {
  

  $already = $db->H_Total_Count("SELECT id FROM cust_ticket WHERE date_add = '$Start_Date_Print' $UserSQlFilter ");
  $MonthData =  array(ConvertDateToCalender_chart($Start_Date_Print), $already); 
  array_push($MonthData_Send,$MonthData);  
  $Start_Date_Print = ($Start_Date_Print + 86400 ) ;  
  $TotalCount = $TotalCount +  $already ;
  }
  $Count_Ticket =  array(
     'label' => $AdminLangFile['report_new_ticket']." ". $TotalCount,
     'color' =>  "#5ab1ef",
     'data' => $MonthData_Send
   );

array_push($Arr_NewTickets,$Count_Ticket);   
$fp = fopen('json/'.$ThSisUser.'_new_tickets.json', 'w');
fwrite($fp, json_encode($Arr_NewTickets));
fclose($fp);

echo '<div class="row">';
echo '<div class="col-lg-12">';
echo '<div data-source="json/'.$ThSisUser.'_new_tickets.json" class="chart-line flot-chart"></div>';
echo '</div>';
echo '</div>';
echo '<div style="clear: both!important;"></div>'.BR.BR; 

###################################################################################################################################################
###################################################################################################################################################
####################################################################  تقارير التذاكر الجديدة
###################################################################################################################################################
###################################################################################################################################################
 


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@

###################################################################################################################################################
###################################################################################################################################################
####################################################################  تقارير المتابعات
###################################################################################################################################################
###################################################################################################################################################

 $Arr_Follow = array();
  $Start_Date_Print = $Start_Date ;
  $TotalCount = "0";
  $MonthData_Send = array();
  for ($x = 1; $x <= $Countdayforloop ; $x++) {
  $SQL = "SELECT id FROM cust_ticket_des WHERE date_add = '$Start_Date_Print' $UserSQlFilter ";
  $already = $db->H_Total_Count($SQL);
  $MonthData =  array(ConvertDateToCalender_chart($Start_Date_Print), $already); 
  array_push($MonthData_Send,$MonthData);  
  $Start_Date_Print = ($Start_Date_Print + 86400 ) ;  
  $TotalCount = $TotalCount +  $already ;
  }
  $Count_Follow =  array(
     'label' => $AdminLangFile['report_followup']." ". $TotalCount,
     'color' =>  "#7cbf62",
     'data' => $MonthData_Send
   );
  array_push($Arr_Follow,$Count_Follow);   
  
  
$fp = fopen('json/'.$ThSisUser.'_follow.json', 'w');
fwrite($fp, json_encode($Arr_Follow));
fclose($fp);


echo '<div class="row">';
echo '<div class="col-lg-12">';
echo '<div data-source="json/'.$ThSisUser.'_follow.json" class="chart-line flot-chart"></div>';
echo '</div>';
echo '</div>';
echo '<div style="clear: both!important;"></div>'.BR.BR;  


###################################################################################################################################################
###################################################################################################################################################
####################################################################  تقارير المتابعات
###################################################################################################################################################
###################################################################################################################################################




#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@

###################################################################################################################################################
###################################################################################################################################################
#################################################################### المتابعات للتذاكر الجديدة
###################################################################################################################################################
###################################################################################################################################################

  $Arr_Follow = array();
  $Start_Date_Print = $Start_Date ;
  $TotalCount = "0";
  $MonthData_Send = array();
  for ($x = 1; $x <= $Countdayforloop ; $x++) {
  $SQL = "SELECT id FROM cust_ticket_des WHERE  date_add = '$Start_Date_Print' and ticket_date = '$Start_Date_Print'  $UserSQlFilter ";
  $already = $db->H_Total_Count($SQL);
  
  $MonthData =  array(ConvertDateToCalender_chart($Start_Date_Print), $already); 
  array_push($MonthData_Send,$MonthData);  
  $Start_Date_Print = ($Start_Date_Print + 86400 ) ;  
  $TotalCount = $TotalCount +  $already ;
  }
  $Count_New_Follow =  array(
     'label' => $AdminLangFile['report_chart_new_follow']." ". $TotalCount,
     'color' =>  "#f5994e",
     'data' => $MonthData_Send
   );
  array_push($Arr_Follow,$Count_New_Follow);   
  
  
$fp = fopen('json/'.$ThSisUser.'_follow_new.json', 'w');
fwrite($fp, json_encode($Arr_Follow));
fclose($fp);


echo '<div class="row">';
echo '<div class="col-lg-12">';
echo '<div data-source="json/'.$ThSisUser.'_follow_new.json" class="chart-line flot-chart"></div>';
echo '</div>';
echo '</div>';
echo '<div style="clear: both!important;"></div>'.BR.BR;    


###################################################################################################################################################
###################################################################################################################################################
#################################################################### المتابعات للتذاكر الجديدة
###################################################################################################################################################
###################################################################################################################################################


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@

###################################################################################################################################################
###################################################################################################################################################
#################################################################### المتابعات للتذاكر السابقة
###################################################################################################################################################
###################################################################################################################################################

  $Arr_Follow_Old = array();
  $Start_Date_Print = $Start_Date ;
  $TotalCount = "0";
  $MonthData_Send = array();
  for ($x = 1; $x <= $Countdayforloop ; $x++) {
  $SQL = "SELECT id FROM cust_ticket_des WHERE  date_add = '$Start_Date_Print' and ticket_date != '$Start_Date_Print'  $UserSQlFilter ";
  $already = $db->H_Total_Count($SQL);

  
  $MonthData =  array(ConvertDateToCalender_chart($Start_Date_Print), $already); 
  array_push($MonthData_Send,$MonthData);  
  $Start_Date_Print = ($Start_Date_Print + 86400 ) ;  
  $TotalCount = $TotalCount +  $already ;
  }
  $Count_Old_Follow =  array(
     'label' => $AdminLangFile['report_old_ticket_follow']." ". $TotalCount,
     'color' =>  "#f35839",
     'data' => $MonthData_Send
   );
  array_push($Arr_Follow_Old,$Count_Old_Follow);   
  
  
$fp = fopen('json/'.$ThSisUser.'_follow_old.json', 'w');
fwrite($fp, json_encode($Arr_Follow_Old));
fclose($fp);


echo '<div class="row">';
echo '<div class="col-lg-12">';
echo '<div data-source="json/'.$ThSisUser.'_follow_old.json" class="chart-line flot-chart"></div>';
echo '</div>';
echo '</div>';
echo '<div style="clear: both!important;"></div>'.BR.BR;    


###################################################################################################################################################
###################################################################################################################################################
#################################################################### المتابعات للتذاكر السابقة
###################################################################################################################################################
###################################################################################################################################################




#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@

###################################################################################################################################################
###################################################################################################################################################
#################################################################### تقرير العملاء 
###################################################################################################################################################
###################################################################################################################################################
  
  $Arr_CustCount = array();
  $Start_Date_Print = $Start_Date ;
  $TotalCount = "0";
  $MonthData_Send = array();
  for ($x = 1; $x <= $Countdayforloop ; $x++) {
  
  $HetSQl  = "SELECT * FROM cust_ticket_des WHERE date_add = '$Start_Date_Print' $UserSQlFilter " ;
  $already = $db->H_Total_Count($HetSQl);
  if($already > '0'){
  $Name = $db->SelArr($HetSQl);  
  $VisitReport = assc_array_count_values( $Name ,"cat_id");
  $already_Send = count($VisitReport); 
  }else{
  $already_Send = "0";  
  }
  $MonthData =  array(ConvertDateToCalender_chart($Start_Date_Print), $already_Send); 
  array_push($MonthData_Send,$MonthData);  
  $Start_Date_Print = ($Start_Date_Print + 86400 ) ;  
  $TotalCount = $TotalCount +  $already_Send ;
  }
  $Count_Cusetmer =  array(
     'label' =>$AdminLangFile['report_clients']." ". $TotalCount,
     'color' =>  "#5ab1ef",
     'data' => $MonthData_Send
   );
  array_push($Arr_CustCount,$Count_Cusetmer);   
  


$fp = fopen('json/'.$ThSisUser.'_custcount.json', 'w');
fwrite($fp, json_encode($Arr_CustCount));
fclose($fp);


echo '<div class="row">';
echo '<div class="col-lg-12">';
echo '<div data-source="json/'.$ThSisUser.'_custcount.json" class="chart-line flot-chart"></div>';
echo '</div>';
echo '</div>';

echo '<div style="clear: both!important;"></div>'.BR.BR;  

###################################################################################################################################################
###################################################################################################################################################
#################################################################### تقرير العملاء 
###################################################################################################################################################
###################################################################################################################################################



 $AllData = array();
 array_push($AllData,$Count_Follow); 
 array_push($AllData,$Count_New_Follow); 
 array_push($AllData,$Count_Old_Follow); 
 
 $fp = fopen('json/'.$ThSisUser.'_all_case.json', 'w');
 fwrite($fp, json_encode($AllData));
 fclose($fp);


echo '<div class="row">';
echo '<div class="col-lg-12">';
echo '<div data-source="json/'.$ThSisUser.'_all_case.json" class="chart-line flot-chart"></div>';
echo '</div>';
echo '</div>';


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@


 $AllData = array();
 array_push($AllData,$Count_Follow); 
 array_push($AllData,$Count_Cusetmer); 
 
 
 $fp = fopen('json/'.$ThSisUser.'_all_case_2.json', 'w');
 fwrite($fp, json_encode($AllData));
 fclose($fp);


echo '<div class="row">';
echo '<div class="col-lg-12">';
echo '<div data-source="json/'.$ThSisUser.'_all_case_2.json" class="chart-line flot-chart"></div>';
echo '</div>';
echo '</div>';




}else{
echo '<div style="clear: both!important;"></div>';   
echo '<div class="alert alert-danger alert_danger_ar ">'.$AdminLangFile['mainform_alert_no_content'].'</div>';   
}
 
}else{
New_Print_Alert("4",$AdminLangFile['mainform_max_day_err_01']." ".MAXIMUM_DAYS." ".$AdminLangFile['mainform_max_day_err_02']); 
}


###########################################################<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
Close_Page();


?>    
 