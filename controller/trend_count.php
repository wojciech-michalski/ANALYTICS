<?php

include('konekt_MySQL.php');
$query="SELECT count(studenci.id) FROM `studenci` INNER JOIN `mapowanie` ON studenci.id_mapowanie=mapowanie.id "
        . "WHERE studenci.collect_data='2023-11-01' AND mapowanie.kierunek NOT LIKE 'ERASMUS%'";

//$insert="INSERT INTO `trends` (`data`,`parametr`,`wartosc`) VALUES ('2023-11-01','stan',3321)";