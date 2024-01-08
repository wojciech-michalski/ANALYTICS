<?php
require('../config/config.php');
include('../controller/konekt_GURU.php');
include('../controller/konekt_MySQL.php');
//usuwam tabele
//mysqli_query($kon,"TRUNCATE TABLE `Przynaleznosci`");
$kierunki=mysqli_query($kon,"SELECT DISTINCT `id_kierunek` FROM `studenci` WHERE 1");
$ile_kierunkow=mysqli_num_rows($kierunki);
$k=0;
do {
    $kierunek=mysqli_fetch_array($kierunki);
    $nazwa_kierunku=sqlsrv_fetch_array(sqlsrv_query($conn,"SELECT K_NAZWA FROM Std_Kierunek WHERE ID_KIERUNEK=$kierunek[0]"));
    echo "$nazwa_kierunku[0]";
    $typy=mysqli_query($kon,"SELECT DISTINCT `id_typ` FROM `studenci` WHERE `id_kierunek`=$kierunek[0]");
    $iletypow=mysqli_num_rows($typy);
    $t=0;
    do {
        $typ=mysqli_fetch_array($typy);
        $nazwa_typu=sqlsrv_fetch_array(sqlsrv_query($conn,"SELECT T_NAZWA FROM Std_TYP WHERE ID_TYP=$typ[0]"));
        $typy_studiow[]=$nazwa_typu[0];
        $rodzaje=mysqli_query($kon,"SELECT DISTINCT `id_rodzaj` FROM `studenci` WHERE `id_typ`=$typ[0]");
        $ilerodzajow=mysqli_num_rows($rodzaje);
        $r=0;
        do {
            $rodzaj=mysqli_fetch_array($rodzaje);
            $nazwa_rodzaju=sqlsrv_fetch_array(sqlsrv_query($conn,"SELECT R_NAZWA FROM Std_RODZAJ WHERE ID_RODZAJ=$rodzaj[0]"));
            $rodzaje_nazwy[]=$nazwa_rodzaju[0];
            $r=$r+1;
        }
        while($r<$ilerodzajow);
        echo"Rodzaje studiów:".print_r($rodzaje_nazwy);
        $t=$t+1;
    }
  
    while($t<$iletypow);
    echo " Typy studiów:".print_r($typy_studiow);
$k=$k+1;
unset($rodzaje_nazwy);
unset($typy_studiow);
echo "<hr/>";
}
while($k<$ile_kierunkow);
