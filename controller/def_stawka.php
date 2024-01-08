<?php
//print_r($_POST);
require('../config/config.php');
require('session_controller.php');
include('konekt_MySQL.php');
$insert="INSERT INTO `koszta_osobowe`(`wykladowca_imie`,`wykladowca_nazwisko`,`wykladowca_pesel`,`rok_akademicki`,"
        . "`semestr_ZL`,`stawka_wyklad`,`stawka_cwiczenia`,`stawka_lab`,`stawka_projekt`,`stawka_wyklad_en`,"
        . "`stawka_cwiczenia_en`,`stawka_lab_en`,`stawka_projekt_en`,`waluta`) VALUES ("
        . "'$_POST[wykladowca_imie]','$_POST[wykladowca_nazwisko]',0,'$_POST[rok_akademicki]','$_POST[semestr_ZL]',"
        . "'$_POST[stawka_wyklad]','$_POST[stawka_cw]','$_POST[stawka_l]','$_POST[stawka_p]',"
        . "'$_POST[stawka_wyklad_en]','$_POST[stawka_cw_en]','$_POST[stawka_l_en]',"
        . "'$_POST[stawka_p_en]','PLN')";
//echo $insert;
mysqli_query($kon,$insert);
?>
 <meta http-equiv="Refresh" content="0; url=<?php echo $_SERVER['HTTP_REFERER'];?>" />
