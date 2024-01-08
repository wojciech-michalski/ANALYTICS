<?php
require_once('../config/config.php');
require_once('konekt_GURU.php');
require_once('konekt_MySQL.php');
$today=date('m-d');
$Y=date('Y');

$Y5=$Y-5;
$Y3=$Y-3;
$fya="$Y5-$today 00:00:00.000";
$tya="$Y3-$today 00:00:00.000";
//echo "5 lat temu: $fya \n";
//echo "3 lata temu $tya \n";
//zbieram dane z przed 5 lat:
$collect="SELECT przynaleznosc.ID_PRZYNALEZNOSC,przynaleznosc.G_ID_KIERUNEK,przynaleznosc.G_ID_RODZAJ,przynaleznosc.G_ID_TYP,przynaleznosc.G_ID_TYP,przynaleznosc.G_NUMER_ALBUMU,"
        . "Osoba.OS_EMAIL,DYPLOM.DYP_DATE_EXAM FROM Przynaleznosc "
        . "INNER JOIN Student ON Przynaleznosc.G_ID_STUDENT=Student.ID_STUDENT "
        . "INNER JOIN Osoba ON Student.T_ID_OSOBA=OSOBA.ID_OSOBA "
        . "INNER JOIN Dyplom ON Dyplom.DYP_ID_PRZYNALEZNOSC=Przynaleznosc.ID_Przynaleznosc "
        . "WHERE Przynaleznosc.G_AKTYWNY=1 AND Przynaleznosc.G_BAZA=4 AND Osoba.OS_EMAIL IS NOT NULL "
        . "AND (Dyplom.DYP_DATE_EXAM = '$fya' OR Dyplom.DYP_DATE_EXAM = '$tya')";
 
echo $collect;
$collecting=sqlsrv_query($conn,$collect, array(), array( "Scrollable" => 'static' ));
$i=0;
$stan=sqlsrv_num_rows($collecting);
do {
    unset($q);
   $dane=sqlsrv_fetch_array($collecting);
     if ($dane['DYP_DATE_EXAM']==$fya) {
       $q="INSERT INTO `absolwenci`(`id_kierunek`,`id_typ`,`id_rodzaj`,`data_obrony`,`email`,`ankieta_5`) "
               . "VALUES('$dane[G_ID_KIERUNEK]','$dane[G_ID_TYP]','$dane[G_ID_RODZAJ]','$fya','$dane[OS_EMAIL]',1)";
     } else {
         $q="INSERT INTO `absolwenci`(`id_kierunek`,`id_typ`,`id_rodzaj`,`data_obrony`,`email`,`ankieta_3`) "
               . "VALUES('$dane[G_ID_KIERUNEK]','$dane[G_ID_TYP]','$dane[G_ID_RODZAJ]','$tya','$dane[OS_EMAIL]',1)";
     }
       mysqli_query($kon,$q);
   $i++; 
  

}
while($i<$stan);
      
include('poprawka_ankiet.php');
