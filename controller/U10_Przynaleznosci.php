<?php
//najpierw pobieram id typu z mysql
//$typyANALYTICS="SELECT DISTINCT `id_typ`"
//$typquery="SELECT DISTINCT T_NAZWA FROM Std_Typ WHERE T_AKTYWNY=1;";
//$formaquery="SELECT DISTINCT R_NAZWA COLLATE Latin1_General_CS_AS FROM Std_Rodzaj WHERE R_AKTYWNA=1" ;
$kierunkiquery="SELECT DISTINCT K_NAZWA FROM Std_Kierunek WHERE K_AKTYWNY=1";
//$typy=sqlsrv_query($conn,$typquery,array(), array( "Scrollable" => 'static'));
//$formy=sqlsrv_query($conn,$formaquery,array(), array( "Scrollable" => 'static'));
$kierunki=sqlsrv_query($conn,$kierunkiquery,array(), array( "Scrollable" => 'static'));
//$iletypow=sqlsrv_num_rows($typy);
//$ileform=sqlsrv_num_rows($formy);
$ilekierunkow=sqlsrv_num_rows($kierunki);
$typquery="SELECT DISTINCT `stopien` FROM `mapowanie` WHERE 1";
$typy=mysqli_query($kon,$typquery);
$formaquery="SELECT DISTINCT `forma` FROM `mapowanie` WHERE 1";
$formy=mysqli_query($kon,$formaquery);
$iletypow=mysqli_num_rows($typy);
$ileform=mysqli_num_rows($formy);
$tytulyquery="SELECT DISTINCT `tytul` FROM `mapowanie` WHERE 1";
$tytuly=mysqli_query($kon,$tytulyquery);
$iletytulow=mysqli_num_rows($tytuly);
$profilequery="SELECT DISTINCT `profil` FROM `mapowanie` WHERE 1";
$profile=mysqli_query($kon,$profilequery);
$ileprofili=mysqli_num_rows($profile);
$jezykiquery="SELECT DISTINCT `jezyk` FROM `mapowanie` WHERE 1";
$jezyki=mysqli_query($kon,$jezykiquery);
$ilejezykow=mysqli_num_rows($jezyki);