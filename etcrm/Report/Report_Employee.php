<?php
if(!defined('WEB_ROOT')) {	exit;}
###########################################################>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);

require_once 'Report_Employee_Form.php' ;
 
echo '<div style="clear: both!important;"></div>';	

#$SqlGetRow = Ticket_GetRow() ;
$SqlGetRow = "id,user_id,state";
if(isset($_POST['B1_Fliter'])){
    $End_SQL_Line = CustmerSqlFiterLine();
    $Start_Date = strtotime($_POST['date_from']);
    $End_Date =  strtotime($_POST['date_to']);
    $Countdayforloop =  CountDayForLoop_Confirm($_POST['date_from'],$_POST['date_to']) ;
    $SQLFiter = "SELECT $SqlGetRow FROM sales_ticket where id != '0' $End_SQL_Line ";
}else{
    $SQLFiter = "SELECT $SqlGetRow FROM sales_ticket where  date_add >= $Start_Date and date_add <= $End_Date ";
    $Countdayforloop = "";
}


echo '<div style="clear: both!important;"></div>';	
 

 
$TotalCount = $db->H_Total_Count($SQLFiter);
 
if($TotalCount > 0) {
$Name = $db->SelArr($SQLFiter);

#echo $SQLFiter .BR;

$ConfigDataTabel = $db->SelArr("SELECT id,name,name_en FROM config_data ");
$TicketState_Filter = assc_array_count_values($Name,"state");
#print_r3($TicketState_Filter);


ReportBlockPrint("col-md-3","اجمالى عدد التذاكر",$TotalCount,"fa-hdd-o","alert-inverse");


echo '<div style="clear: both!important;"></div>';

ReportBlockPrint("col-md-3",$AdminLangFile['report_t_review'],ArrIsset($TicketState_Filter,'1',"0"),"fa-eye-slash","alert-info");
ReportBlockPrint("col-md-3",$AdminLangFile['report_t_open'],ArrIsset($TicketState_Filter,'2',"0"),"fa-desktop","alert-success");
ReportBlockPrint("col-md-3",$AdminLangFile['report_close_review'],ArrIsset($TicketState_Filter,'4',"0"),"fa-times","alert-warning");
ReportBlockPrint("col-md-3",$AdminLangFile['report_close'],ArrIsset($TicketState_Filter,'5',"0"),"fa-trash-o");

 
$TicketUser_Filter =  GetChartVallFromArr_To_user($Name,"user_id","tbl_user");
#print_r3($TicketUser_Filter);



 
if(count($TicketUser_Filter) > '1'){
 
    
for ($i = 0; $i < count($TicketUser_Filter); $i++) {
    $ThisUserId = $TicketUser_Filter[$i]['id']; 
  
echo  New_Print_Alert("5",$TicketUser_Filter[$i]['name']);
ReportBlockPrint("col-md-3","اجمالى عدد التذاكر",$TicketUser_Filter[$i]['count'],"fa-hdd-o","alert-inverse");

$SQLFiter = "SELECT id,state FROM sales_ticket where user_id = '$ThisUserId'  ";

$Name_22 = $db->SelArr($SQLFiter);
$TicketState_Filter = assc_array_count_values($Name_22,"state");
 
echo '<div style="clear: both!important;"></div>';

ReportBlockPrint("col-md-3",$AdminLangFile['report_t_review'],ArrIsset($TicketState_Filter,'1',"0"),"fa-eye-slash","alert-info");
ReportBlockPrint("col-md-3",$AdminLangFile['report_t_open'],ArrIsset($TicketState_Filter,'2',"0"),"fa-desktop","alert-success");
ReportBlockPrint("col-md-3",$AdminLangFile['report_close_review'],ArrIsset($TicketState_Filter,'4',"0"),"fa-times","alert-warning");
ReportBlockPrint("col-md-3",$AdminLangFile['report_close'],ArrIsset($TicketState_Filter,'5',"0"),"fa-trash-o");



  



} 
    
    
}
 



#print_r3($TicketUser_Filter);


  
}else{
echo '<div class="alert alert-danger alert_danger_ar ">'.$AdminLangFile['mainform_alert_no_content'].'</div>';  
}
 



###########################################################<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
Close_Page();
    
?>