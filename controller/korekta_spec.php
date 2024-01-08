<?php
//korekta specjalności
require_once('../config/config.php');
require_once('konekt_GURU.php');
require_once('konekt_MySQL.php');
$do_korekty=mysqli_query($kon,"SELECT DISTINCT `id_specjalnosc` FROM `studenci` "
        . "WHERE `collect_data`<'2023-07-02'");
foreach($do_korekty as $student){
    $nspec=sqlsrv_fetch_array(sqlsrv_query($conn,"SELECT SP_NAZWA FROM Std_specjalnosc "
            . "WHERE ID_SPECJALNOSC='$student[id_specjalnosc]'"));
    switch ($nspec[0]){
        case null:
        case '':
        
            $specjalnosc="BRAK";
            break;
        default:
            $specjalnosc=$nspec[0];
            break;
        
    }
    mysqli_query($kon,"UPDATE `studenci` SET `specjalnosc_nazwa`='$specjalnosc' WHERE "
            . "`id_specjalnosc`='$student[id_specjalnosc]' AND `specjalnosc_nazwa` IS NULL");
}
