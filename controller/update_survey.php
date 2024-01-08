<?php
require('../config/config.php');
require('session_controller.php');
include('konekt_MySQL.php');
$surveycorrected=str_replace("<text_area","<textarea",$_POST['ankieta']);
$surveycorrected=str_replace("</text_area>","</textarea>",$surveycorrected);
$surveyarray=explode("<!--PYT_",$surveycorrected);
foreach($surveyarray as $pytanie){
    $pytcleanarray=explode("-->",$pytanie);
    $pythtml=$pytcleanarray[1];
    $pytnumber_=explode(" ",$pytcleanarray[0]);
    $nrpyt=$pytnumber_[0];
    $nr_pytania="PYT_$nrpyt";
    $sql="UPDATE `metryki` SET `html`='$pythtml' WHERE `ankieta`='$_POST[nazwa]' AND `pytanie`='$nr_pytania'";
    mysqli_query($kon,$sql);
}
?>
 <meta http-equiv="Refresh" content="0; url=<?php echo $_SERVER['HTTP_REFERER'];?>" />