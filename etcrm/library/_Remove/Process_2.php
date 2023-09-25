<?php
if(!defined('WEB_ROOT')) {	exit;}









function  OPenFiterLine(){
  $End_SQL_Line = " "  ;
  if(isset($_POST['date_from'])){
  $End_SQL_Line .= CustmerSqlFiterLineFromPost_Date($_POST['date_from'],"date_add","From");  
  }
  if(isset($_POST['date_to'])){
  $End_SQL_Line .= CustmerSqlFiterLineFromPost_Date($_POST['date_to'],"date_add","To");  
  }     
  if(isset($_POST['emp_id'])){
  $End_SQL_Line .= CustmerSqlFiterLineFromPost($_POST['emp_id'],"user_id");    
  }     
  return $End_SQL_Line ;
}

function  CloseFiterLine(){
  $End_SQL_Line = " "  ;
  
  $End_SQL_Line .= CustmerSqlFiterLineFromPost_Date($_POST['date_from'],"close_date","From"); 
  $End_SQL_Line .= CustmerSqlFiterLineFromPost_Date($_POST['date_to'],"close_date","To");  
  $End_SQL_Line .= CustmerSqlFiterLineFromPost_2018('emp_id',"user_id"); 
  $End_SQL_Line .= CustmerSqlFiterLineFromPost_2018('close_type',"close_type"); 
  $End_SQL_Line .= CustmerSqlFiterLineFromPost_2018('close_type_2',"c_type_2");
  return $End_SQL_Line ;
}


function  CloseFiterForCustService(){
    
  $End_SQL_Line = " "  ;
  $End_SQL_Line .= CustmerSqlFiterLineFromPost_Date($_POST['date_from'],"close_date_2","From"); 
  $End_SQL_Line .= CustmerSqlFiterLineFromPost_Date($_POST['date_to'],"close_date_2","To");  
  $End_SQL_Line .= CustmerSqlFiterLineFromPost_2018('emp_id',"user_id"); 
  $End_SQL_Line .= CustmerSqlFiterLineFromPost_2018('close_type',"close_type"); 
  $End_SQL_Line .= CustmerSqlFiterLineFromPost_2018('close_type_2',"c_type_2");
  
  return $End_SQL_Line ;
}


#################################################################################################################################
###################################################   UpdateContact
#################################################################################################################################
function UpdateContact($db){
    $ThisIsTest = '0';
    $MyCustMerIdd = $_POST['cust_id'];
    $ticket_id =  $_POST['ticket_id'];
    $FollowDateVall = FollowDateConfirm();
        if( $FollowDateVall['FollowDateErr']  != '1'  ){
        Add_New_TicketForCust($ThisIsTest,"contact_review");
        if($ThisIsTest != '1'){
        Redirect_Page_2('index.php?view=SalesFollow');
        }
    }
}


#################################################################################################################################
###################################################   UpdateSupport
#################################################################################################################################
function UpdateSupport($db){
    $ThisIsTest = '0';
    $MyCustMerIdd = $_POST['cust_id'];
    $ticket_id =  $_POST['ticket_id'];
    $FollowDateVall = FollowDateConfirm();
        if( $FollowDateVall['FollowDateErr']  != '1'  ){
        Add_New_TicketForCust($ThisIsTest,"support_review");
        if($ThisIsTest != '1'){
        Redirect_Page_2('index.php?view=SalesFollow');
        }
    }
}


#################################################################################################################################
###################################################   Add_New_TicketForCust
#################################################################################################################################
function Add_New_TicketForCust($ThisIsTest,$FildeUpdate){
    global $db ;
    $ticket_id =  $_POST['ticket_id'];
    $FollowDateVall = FollowDateConfirm();
    $TAddDate = FULLDate_ForToday();
    $Ticket_Info = array ('id'=> NULL ,
        'cat_id'=> $_POST['ticket_id'] ,
        'ticket_date'=>  $_POST['ticket_date'],
        'cust_id'=>  $_POST['cust_id'],
        'date_add'=> $TAddDate['Stamp'] ,
        'date_time'=>  time() ,  
        'date_month'=> $TAddDate['Month']."-".$TAddDate['Year'],
        'follow_type'=> Clean_Mypost($_POST['follow_type']) ,
        'follow_state'=> Clean_Mypost($_POST['follow_state']) ,
        'follow_date'=> $FollowDateVall['FollowDate']  ,
        'des'=>  Clean_Mypost($_POST['des'])  ,
        'user_id'=> Clean_Mypost($_POST['follow_user_id']) ,
        'user_name'=> Clean_Mypost($_POST['follow_user_name']) ,
        'count_type'=> '3'  ,
    );
    if($_POST['follow_state'] == '1'){
    $Ticket_Update = array (
        'date_time' =>  time(),
        'follow_state'=> Clean_Mypost($_POST['follow_state']) ,
        'follow_date'=> $FollowDateVall['FollowDate']  ,
        'notes' =>  Clean_Mypost($_POST['des']) ,
        $FildeUpdate  =>  "0" ,
    );
    }else{
      $Ticket_Update = array (
        'date_time' =>  time(),
        'notes' =>  Clean_Mypost($_POST['des']) ,
        $FildeUpdate  =>  "0" ,
     );
    }
    if($FollowDateVall['FollowDateErr']  != '1'  ){
        if($ThisIsTest == '1'){
            print_r3($Ticket_Info);
            print_r3($Ticket_Update);
        }else{
            $add_server = $db->AutoExecute("sales_ticket_des",$Ticket_Info,AUTO_INSERT);
            $add_server = $db->AutoExecute("sales_ticket",$Ticket_Update,AUTO_UPDATE,"id = $ticket_id");
        }
    }
}









#################################################################################################################################
###################################################   AddOnlyComment
#################################################################################################################################
function AddOnlyComment($db){
    $ThisIsTest = "0";
    $ticket_id =  $_POST['ticket_id'];
    $TAddDate = FULLDate_ForToday();
    $Ticket_Info = array ('id'=> NULL ,
        'cat_id'=> $_POST['ticket_id'] ,
        'ticket_date'=>  $_POST['ticket_date'],
        'cust_id'=>  $_POST['cust_id'],
        'date_add'=> $TAddDate['Stamp'] ,
        'date_time'=>  time() ,  
        'date_month'=> $TAddDate['Month']."-".$TAddDate['Year'],
        'des'=>  Clean_Mypost($_POST['des'])  ,
        'user_id'=> Clean_Mypost($_POST['follow_user_id']) ,
        'user_name'=> Clean_Mypost($_POST['follow_user_name']) ,
        'count_type'=> '3'  ,
    );
     $Ticket_Update = array (
        'date_time' =>  time(),
        'notes' =>  Clean_Mypost($_POST['des']) ,
     );
       if($ThisIsTest == '1'){
            print_r3($Ticket_Info);
            print_r3($Ticket_Update);
        }else{
            $add_server = $db->AutoExecute("sales_ticket_des",$Ticket_Info,AUTO_INSERT);
            $add_server = $db->AutoExecute("sales_ticket",$Ticket_Update,AUTO_UPDATE,"id = $ticket_id");
            CountClosedT();
            Redirect_Page_2('index.php?view=CloseReview'); 
        }
    
    
}









#################################################################################################################################
###################################################   GetPermationForOpen
#################################################################################################################################
function GetPermationForOpen($ThisAccountFollow,$USER_ID){
    global $AdminConfig ;
    if($AdminConfig['leads'] == '1'){
    $UserPer = "1";   
    }elseif(count($ThisAccountFollow) >= '1' ){
      
       
     if (in_array($USER_ID, $ThisAccountFollow)){
        $UserPer = "1";
     }else{
        $UserPer = "0";
     }      
     }else{
       $UserPer = "0";
    }
    
     return  $UserPer ;
}

 
 
 
 
?>