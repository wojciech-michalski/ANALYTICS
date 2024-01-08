<?php

$collectstart="$rok_akademicki-10-01";
$collectstop=$rok_akademicki+1 ."-09-30";

//Pobieram przynależności
$przynaleznosci=mysqli_query($kon,"SELECT * FROM `mapowanie` WHERE (`stopien`='I stopnia' OR `stopien`='II stopnia') AND `kierunek` NOT LIKE 'ERASMUS%'");
$po=mysqli_num_rows($przynaleznosci);
$pc=0;
do {
    $przynaleznosc=mysqli_fetch_array($przynaleznosci);
    $pc=$pc+1;
    //pobieram dane o obronach dla przynależności
    $dyplomquery="SELECT S_DodDaneDyplom.SDD_WARTOSC, Dyplom.DYP_DATE_EXAM, Dyplom.DYP_ID_PRZYNALEZNOSC,przynaleznosc.G_NUMER_ALBUMU FROM Dyplom INNER JOIN S_DodDaneDyplom ON Dyplom.ID_DYPLOM=S_DodDaneDyplom.SDD_ID_DYPLOM INNER JOIN PRZYNALEZNOSC ON Dyplom.DYP_ID_PRZYNALEZNOSC=PRZYNALEZNOSC.ID_PRZYNALEZNOSC WHERE S_DodDaneDyplom.SDD_ID_DD_TYP=11 AND Dyplom.DYP_DATE_EXAM>'$collectstart' AND Dyplom.DYP_DATE_EXAM<'$collectstop' AND Przynaleznosc.G_ID_TYP=$przynaleznosc[9] AND Przynaleznosc.G_ID_RODZAJ=$przynaleznosc[10] AND Przynaleznosc.G_ID_KIERUNEK=$przynaleznosc[8]";
    $queries[]=$dyplomquery;
    $dyplomy=sqlsrv_query($conn,$dyplomquery,array(), array( "Scrollable" => 'static'));
    $iledyplomow=sqlsrv_num_rows($dyplomy);
    $kd=0;
    do {
        unset($wylocokon);
        $dyplom=sqlsrv_fetch_array($dyplomy);
        $kd=$kd+1;
      //settype($dyplom[0],"float");  
        $dyplomfloat=str_replace(",",".",$dyplom[0]);
     if(floatval($dyplomfloat)>=3.81 && floatval($dyplomfloat)<=4.2 ) {
         $wylocokon="4";
     }
       if(floatval($dyplomfloat)>=4.21 && floatval($dyplomfloat)<=4.5 ) {
         $wylocokon="4.5";
     }
     
     if(floatval($dyplomfloat)>=4.51) {
         $wylocokon="5";
     }
      if(floatval($dyplomfloat)<3.51&&floatval($dyplomfloat)>3) {
         $wylocokon="3";
     }
     if(floatval($dyplomfloat)<3.81&&floatval($dyplomfloat)>3.50) {
         $wylocokon="3.5";
     }
     if(floatval($dyplomfloat)<3&&floatval($dyplomfloat)>2) {
         $wylocokon="2";
     }
    $oceny_dyplom[]="$przynaleznosc[1];;$przynaleznosc[2];;$przynaleznosc[4];;$przynaleznosc[5];;$przynaleznosc[6];;$przynaleznosc[7];;$przynaleznosc[13];;$wylocokon;;$dyplomfloat";
    $oceny_przynaleznosc["$przynaleznosc[1];;$przynaleznosc[2];;$przynaleznosc[4];;$przynaleznosc[5];;$przynaleznosc[6];;$przynaleznosc[7];;$przynaleznosc[13]"][]=$wylocokon;
    }
    while($kd<$iledyplomow);
}
while($pc<$po);
//print_r($oceny_przynaleznosc);
//mam tablicę posegregowaną po przynależnościach. Teraz muszę policzyć ilość ocen po przynależności
foreach(array_keys($oceny_przynaleznosc) as $przynaleznosc_) {
   // unset($oceny);
   // echo "<br/>Oceny dla $przynaleznosc_ :<br/>";
    $oceny[$przynaleznosc_]=array_count_values($oceny_przynaleznosc[$przynaleznosc_]);
    
}
//print_r($oceny);