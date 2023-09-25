<?php
if(!defined('WEB_ROOT')) {	exit;}
 
if(isset($_POST['B1_Fliter'])){ 
   
}else{
    UnsetAllSession('date_from,date_to');
    if(isset($ConfigP['report_period'])){
    $Report_period =  ReportPeriod($ConfigP['report_period']);
    $Start_Date = $Report_period['start']; 
    $End_Date = $Report_period['end']; 
    $row['date_from'] = ConvertDateToCalender_3($Start_Date) ;   
    $row['date_to'] = ConvertDateToCalender_3($End_Date) ;
    }
}



if($ReqFilterDate == '1'){
$ReqFilde = "required";    
}else{
$ReqFilde = "";    
}


echo '<form class="FilterForm FilterFormStyle" method="POST" name="Filter" id="validate-form" data-parsley-validate >';
 
if($ConfigP['filter_cont'] == '1'){
Print_PagePanel_OPen("col-md-12",$AdminLangFile['reportconfig_filter_results_h1'],"0","0","Parent_Infos");  
}


$MoreS = array('Col' => "col-md-3",'Placeholder'=> "",'required' => $ReqFilde);
$Err[] = NF_PrintInput("DateEdit2",$AdminLangFile['report_from_date'],"date_from","0","0","option",$MoreS);  

$MoreS = array('Col' => "col-md-3",'Placeholder'=> "",'required' => $ReqFilde);
$Err[] = NF_PrintInput("DateEdit2",$AdminLangFile['report_to_date'],"date_to","0","0","option",$MoreS);


$Arr = array("Label" => 'on' ,"OtherIdd"=>"user_id", "Filter_Filde"=> "sales" , "Filter_Vall"=> "1");      
$Err[] = NF_PrintSelect_2018("Chosen",$AdminLangFile['report_employee_name'],"col-md-3","user_id","tbl_user","option",0,$Arr);


echo '<div style="clear: both!important;"></div>';
echo '<div class="col-md-12 col-sm-12 col-xs-12 form-group">';
echo '<input type="submit" name="B1_Fliter" class="ArButForm btn btn-default" value="'.$AdminLangFile['report_filter_but'].'" />';
echo '</div>';   
 
if($ConfigP['filter_cont'] == '1'){
Print_PagePanel_Close();       
}

 
echo '</form>';

echo '<div style="clear: both!important;"></div>'.BR.BR;
?>