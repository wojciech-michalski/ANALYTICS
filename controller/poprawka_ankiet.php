<?php
require_once('../config/config.php');

require_once('konekt_MySQL.php');
    $ankiety=mysqli_query($kon,"SELECT `id`,`rok_ukonczenia`,`data` FROM `ankieta` WHERE `3_lata`=0 AND `5_lat`=0 ");
    foreach($ankiety as $ankieta){
        $rok_ukonczenia=substr($ankieta['rok_ukonczenia'],0,4);
        $rok_wypelnienia=substr($ankieta['data'],0,4);
        echo "$rok_ukonczenia $rok_wypelnienia \n";
        $roznica=$rok_wypelnienia-$rok_ukonczenia;
        switch($roznica){
            default:
                break;
                case 3:
                    mysqli_query($kon,"UPDATE `ankieta` SET `3_lata`=1 WHERE `id`=$ankieta[id]");
                    echo "aktualizuję ankietę $ankieta[id] \n";
                    break;
                 case 5:
                    mysqli_query($kon,"UPDATE `ankieta` SET `5_lat`=1 WHERE `id`=$ankieta[id]");
                    echo "aktualizuję ankietę $ankieta[id] \n";
                    break;
        }
    }

