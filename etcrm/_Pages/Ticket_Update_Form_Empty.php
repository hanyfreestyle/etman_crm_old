<?php
New_Print_Alert("2","اضافة متابعة اليوم للتذكرة");  
#hidden
echo '<input type="hidden" value="1" name="follow_state" />'; 
echo '<input type="hidden" value="اضافة متابعة اليوم" name="des" />';
echo '<input type="hidden" value="130" name="follow_type" />';
echo '<input type="hidden" value="0" name="priority_id" />';
echo '<input type="hidden" value="'.date("m/d/Y").'" name="follow_date" />';




echo '<input type="hidden" name="cust_id" value="'.$row_ticket['cust_id'].'" />';
echo '<input type="hidden" name="ticket_id" value="'.$row_ticket['id'].'" />';
echo '<input type="hidden" name="follow_user_id" value="'.$RowUsreInfo['user_id'].'" />';
echo '<input type="hidden" name="follow_user_name" value="'.$RowUsreInfo['name'].'" />';
echo '<input type="hidden" name="ticket_date" value="'.$row_ticket['date_add'].'" />';
echo '<div style="clear: both!important;"></div>';




echo '<input type="hidden" value="'.$row['name'].'" name="name" />';
echo '<input type="hidden" value="'.$row['mobile'].'" name="mobile" />';
echo '<input type="hidden" value="'.$row['mobile_2'].'" name="mobile_2" />';
echo '<input type="hidden" value="'.$row['phone'].'" name="phone" />';

echo '<input type="hidden" value="'.$row['email'].'" name="email" />';
echo '<input type="hidden" value="'.$row['city_id'].'" name="city_id" />';
echo '<input type="hidden" value="'.$row['notes'].'" name="notes" />';
?>


