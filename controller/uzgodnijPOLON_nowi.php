<?php
$tabela118="POLON2022L";
$data="2022-10-26";
$ostatninumeralbumu="32803";
require('../config/config.php');
//require('controller/session_controller.php');
include('konekt_GURU.php');
include('konekt_MySQL.php');
$nowi_analytics=mysqli_query($kon,"SELECT `numer_albumu`,`id`,`data_rozpoczecia` FROM `studenci` WHERE `numer_albumu`>'$ostatninumeralbumu' AND `collect_data`='$data' AND `data_rozp_polon`=''");
$ilunowych=mysqli_num_rows($nowi_analytics);
$k=0;
do {
    $nowy=mysqli_fetch_array($nowi_analytics);
    $k=$k+1;
    if(strlen($nowy[0])!==5) {
        echo "Nie będę robił, bo numer albumu jest $nowy[0] \n";
    }
    else {
        $data_polon_=$nowy[2];
       $rok="$data_polon_[0]$data_polon_[1]$data_polon_[2]$data_polon_[3]";
       $miesiac="$data_polon_[5]$data_polon_[6]";
       $dzien="$data_polon_[8]$data_polon_[9]";
       if($rok=="1900") $data_polon="2022-10-01";
       else
       if($rok=="2022"&&($miesiac=="05"||$miesiac=="06"||$miesiac="07"||$miesiac="09")) $data_polon="2022-10-01";
else
    $data_polon=$data_polon_;

        echo "Będę poprawiał numer albumu $nowy[0] na datę $data_polon \n";
        mysqli_query($kon,"UPDATE `studenci` SET `data_rozp_polon`='$data_polon' WHERE `id`=$nowy[1]");
    }
}
while($k<$ilunowych);

