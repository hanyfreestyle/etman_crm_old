<?php
###########################################################>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);

$Ticket_Row = $db->H_CheckTheGet("id","id","sales_ticket","2");

 


#print_r3($Ticket_Row);

$TicketDes_Row = $db->H_CheckTheGet("DesId","id","sales_ticket_des","2");
#print_r3($TicketDes_Row);

    $ThisUserId = $Ticket_Row['user_id'];
    $ThisCustId = $Ticket_Row['cust_id'];
    $Ticket_UserInfo = $db->H_SelectOneRow("select * from tbl_user where user_id = '$ThisUserId' ");
    $Ticket_CustInfo = $db->H_SelectOneRow("select * from customer where id = '$ThisCustId' ");
    
    


   $Mass = ' ';
   $Mass .= "رقم التذكرة "." ".$Ticket_Row['id']." - " ;
   $Mass .= " ".$Ticket_CustInfo['name']." - ";
   $Mass .= " ".$Ticket_CustInfo['mobile']." ".BR.BR;
   
 
   
   $Mass .= " اسم الموظف المختص ".": ".$Ticket_UserInfo['name'].BR;
   $Mass .= " تاريخ المتابعة القادمة ".": ".ConvertDateToCalender_2($Ticket_Row['follow_date']).BR;
   $Mass .= "--------------------------------------------".BR;
   $Mass .= "اسم العميل : ".$Ticket_CustInfo['name'].BR;
   $Mass .= "رقم الهاتف : ".$Ticket_CustInfo['mobile'].BR;
   $Mass .= "المحافظة  : ".GetNameFromID("fi_city",$Ticket_Row['city_id'],"name").BR;
   $Mass .= "--------------------------------------------".BR;
   
   $Mass .= nl2br($TicketDes_Row['des']).BR;
   
   $Mass .= BR.BR.BR;
       /*
   #$Mass .= preg_replace( "/\r|\n/", "%0A", $Name[$i]['des'] )."%0A";
   $Mass .= preg_replace( "/\r/", "%0A", $Name[$i]['des'] )."%0A";  
   */
   #$Mass = '<div class="TrelloView">';
   
   
   echo New_Print_Alert("5",$Mass);
     



###########################################################<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<



Close_Page();
?>


