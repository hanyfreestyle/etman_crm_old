<?php
if(!defined('WEB_ROOT')) {	exit;}
 
?>
<h3 class="H3_FontAr"><?php echo $PageTitle ?></h3>
<div class="row PanelMin"><div class="col-md-12">
<?php
if(!isset($_POST['B1'])){
UnsetAllSession('name');
}

Form_Open($ArrForm);

$Arr = array("Label" => 'on',"Active" => '0','Order'=> "order by count desc" );
$Err[] = NF_PrintSelect_2018("Chosen",$AdminLangFile['managedate_catname'],"col-md-3","cat_id",$Sub_DataTabel,"req","0",$Arr);


echo '<div style="clear: both!important;"></div>';

$MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => 'required','Dir'=> "Ar_Lang");
$Err[] = NF_PrintInput("Text",$AdminLangFile['managedate_data_name'],"name","1","1","req",$MoreS);

$MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => 'required', 'Dir'=> "En_Lang");
$Err[] = NF_PrintInput("Text",$AdminLangFile['managedate_data_name'].ENLANG,"name_en","1","1","req",$MoreS);


Form_Close_New("1",$Fs_ListUrl);


if(isset($_POST['B1'])){
if($Err != '1'){
Vall($Err,"CustSubAdd",$db,"1",$USER_PERMATION_Add);
}  
}            

?>
</div></div>