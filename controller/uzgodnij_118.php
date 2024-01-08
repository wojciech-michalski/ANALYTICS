<?php
$tabela118="POLON2022L";
$data="2022-10-26";
$ostatninumeralbumu="32803";
require('../config/config.php');
//require('controller/session_controller.php');
include('konekt_GURU.php');
include('konekt_MySQL.php');
//zestawiam połączenie z starym Analyticsem
//MySQL CONNECT
		$kon118=mysqli_connect("10.1.250.118","root","afrodyta","wseiz_analytics");
	if($kon118) {
	echo "Połączyłem się ze starym Analytics";
	}
		else die("Brak połączenia z bazą MySQL Analytics");
mysqli_set_charset($kon118, "utf8");

$dane_118=mysqli_query($kon118,"SELECT `NR_ALBUMU`,`DATA_ROZP_STUDIOW`,`POLON_ID_KIERUNKU` FROM `$tabela118` WHERE 1");
$ile118=mysqli_num_rows($dane_118);
$n=0;
do {
    $wiersz118=mysqli_fetch_array($dane_118);
    $n=$n+1;
    $czy_jest=mysqli_query($kon,"SELECT studenci.id FROM `studenci` INNER JOIN `mapowanie` ON studenci.id_mapowanie=mapowanie.id WHERE studenci.numer_albumu='$wiersz118[0]' AND mapowanie.kod_uruchomienia='$wiersz118[2]' AND studenci.collect_data='$data'");
    if (mysqli_num_rows($czy_jest)>0){
        $student2update=mysqli_fetch_array($czy_jest);
       // echo "Będę wstawiał datę rozpoczęcia studiów studentowi $wiersz118[0] na $wiersz118[1] \n";
        $query="UPDATE `studenci` SET `data_rozp_polon`='$wiersz118[1]' WHERE `id`=$student2update[0]";
       // mysqli_query($kon,$query);
        //echo "$query \n";
    }
    else {
        echo "Nie mam takiego studenta w nowym Analytics \n";
    }
}
while ($n<$ile118);
//Teraz zapuszczam nowych
