<?php
include('../config/config.php');
include('konekt_GURU.php');
//$hex_=sqlsrv_query($conn,"SELECT DOCUMENT FROM [WorkflowSystem].[dbo].[EXTENSION] WHERE ID_EXTENSION = 165", array(), array( "Scrollable" => 'static' ));
$hex_=sqlsrv_query($conn,"SELECT DOCUMENT FROM [WorkflowSystem].[dbo].[EXTENSION_DOCUMENT]"
        . " WHERE ID_EXTENSION_DOCUMENT = 1867", array(), array( "Scrollable" => 'static' ));
//$hex_=sqlsrv_query($conn,"SELECT NAME_EXTENDED FROM [WorkflowSystem].[dbo].[FRIENDLY_NAMES_FOR_TASK_FORM_FIELD] WHERE FIELD_TYPE = 2", array(), array( "Scrollable" => 'static' ));
$ile=sqlsrv_num_rows($hex_);
$n=0;
do {
    $hex= sqlsrv_fetch_array($hex_);
   //$bez0x=str_replace('0x','',$hex[0]);
    //$bin=hex2bin($hex[0]);
  //  echo " $hex[1] - $bin \n";
    echo " $hex[0] \n";
    $n++;
}
while ($n<$ile);
//$xml=file_get_contents('iksemel.xml');
//$q="INSERT INTO [WorkflowSystem].[dbo].[EXTENSION] (CREATE_TIME,CREATE_USER,UPDATE_TIME,UPDATE_USER,ACTIVE,PROCESS_ID,DOCUMENT,STD_VERSION,NAME_EXTENDED)
// VALUES ('2023-11-23 15:28:51.887','PYC','2023-11-23 15:28:51.887','PYC',1,'PYC','test',1,'PYC')";
//echo $q;
// $q="UPDATE [WorkflowSystem].[dbo].[EXTENSION] SET DOCUMENT='$xml' WHERE ID_EXTENSION=165";
//sqlsrv_query($conn,$q);
