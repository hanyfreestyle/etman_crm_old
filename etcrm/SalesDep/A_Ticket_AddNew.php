<?php
if(!defined('WEB_ROOT')) {	exit;}
 

###########################################################>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);



$row_ticket = $db->H_CheckTheGet("id","id","sales_ticket","2");
 


if($row_ticket['user_id'] == $RowUsreInfo['user_id']  or $AdminConfig['leads'] == '1' and $row_ticket['state'] == '1' ){
if($row_ticket['c_type'] == '5'){    

$CustmerId = $row_ticket['cust_id'];
extract($row_ticket);

$row = $db->H_SelectOneRow("SELECT * FROM customer where id = '$CustmerId' ");
extract($row);


$Err = array();  
Form_Open($ArrForm);
 
/// تحديث التذكرة 
#New_Print_Alert("3",$AdminLangFile['salesdep_call_info']);
require_once '../_Pages/Ticket_Update_Form_Empty.php' ;   
 


// hidden
echo '<input type="hidden" name="old_user_id" value="'.$row_ticket['admin_id'].'" />'; 
echo '<input type="hidden" name="old_date" value="'.$row_ticket['date_time'].'" />';
echo '<input type="hidden" name="old_des" value="'.$row_ticket['notes'].'" />';
echo '<input type="hidden" name="ticket_date" value="'.$row_ticket['date_add'].'" />'; 

 
 
 

 
 
 
Form_Close_New("1","ListNew");

#echo $row['c_type'];

if(isset($_POST['B1'])){

if($row['c_type'] == '1'){    
Vall($Err,"NewTicketForOldCust",$db,"1",$USER_PERMATION_Edit);
}else{
if($ErrForm != '1'){    
Vall($Err,"NewTicketAdd",$db,"1",$USER_PERMATION_Edit);
}  
    
}    


}            


}else{
ErrMassPer(); 
}


}else{
ErrMassPer();   
}
 
 
###########################################################<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
Close_Page();
 	
?>
 