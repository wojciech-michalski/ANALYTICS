<?php
//Musze określić datę stop i datę start Jeżeli jst ustawiona data start i data stop - robi wg tych dat
//Jezeli nie są - lecę po miesiącach i ltach, jeżeli w ogóle - ustawiam na ostatnią rekrutację
include('../config/config.php');
include('konekt_GURU.php');
include('konekt_MySQL.php');
   $kierunki=mysqli_query($kon,"SELECT DISTINCT `kierunek`,`stopien` FROM `mapowanie` WHERE 1");
   foreach($kierunki as $kierunek){
       $ys=2018;
       do {
           $montharray=array("01","02","03","04","05","06","07","08","09","10","11","12");
           foreach($montharray as $miesiac){
               $data_start="$ys-$miesiac-01";
               switch($miesiac){
                    default:
                        $data_stop="$ys-$miesiac-31";
                        break;
                        case "02":
                            $data_stop="$ys-$miesiac-28";
                            break;
                         case "06":
                         case "04":
                         case "09":
                         case "11":
                            $data_stop="$ys-$miesiac-30";
                            break;
               }
              //teraz pobieram dane
                $sql="SELECT `kierunek`,`stopien`,`id_kierunek`,`id_typ`,`id_rodzaj` FROM `mapowanie` WHERE `kierunek`='$kierunek[kierunek]' AND `stopien`='$kierunek[stopien]' ";
                $przyn=mysqli_query($kon,$sql);
                $pcount=0;
                $how=mysqli_num_rows($przyn);
                 do {
        $war_value=mysqli_fetch_array($przyn);
        $pcount=$pcount+1;
        $warunki_przynaleznosci[]="(Przynaleznosc.G_ID_KIERUNEK='$war_value[2]' AND Przynaleznosc.G_ID_TYP='$war_value[3]' AND Przynaleznosc.G_ID_RODZAJ='$war_value[4]' )";
    }
    while($pcount<$how);
    $warunki="AND (".implode("OR ",$warunki_przynaleznosci);
    unset($warunki_przynaleznosci);
    $query="SELECT   DISTINCT RejestrWydrukow.RW_ID_PRZYNALEZNOSC
    , RejestrWydrukow.RW_DATA
    , Przynaleznosc.G_ID_RODZAJ
    , Przynaleznosc.G_ID_WYDZIAL
    , Przynaleznosc.G_ID_TYP
    
FROM  RejestrWydrukow  
INNER JOIN Przynaleznosc 
    ON RejestrWydrukow.RW_ID_PRZYNALEZNOSC = Przynaleznosc.ID_PRZYNALEZNOSC 
INNER JOIN Lista_Semestrow 
    ON Przynaleznosc.ID_Przynaleznosc = Lista_Semestrow.L_ID_PRZYNALEZNOSC
    WHERE  ((RejestrWydrukow.RW_ID_REJESTR_WYDRUKOW=8 OR 
    RejestrWydrukow.RW_ID_REJESTR_WYDRUKOW=26 OR RejestrWydrukow.RW_ID_REJESTR_WYDRUKOW=27 
    OR RejestrWydrukow.RW_ID_REJESTR_WYDRUKOW=28 OR RejestrWydrukow.RW_ID_REJESTR_WYDRUKOW=24
    OR RejestrWydrukow.RW_ID_REJESTR_WYDRUKOW=17 OR RejestrWydrukow.RW_ID_REJESTR_WYDRUKOW=25) 
    AND RejestrWydrukow.RW_DATA>'$data_start' AND RejestrWydrukow.RW_DATA<'$data_stop') $warunki )
";
    //echo "$query\n";
    $obrony=sqlsrv_query($conn,$query,array(), array( "Scrollable" => 'static'));

$ile_obron=sqlsrv_num_rows($obrony);
$q="INSERT INTO `rek_trends`(`kierunek`,`stopien`,`miesiac`,`rok`,`ilosc_umow`) "
        . "VALUES ('$kierunek[kierunek]','$kierunek[stopien]','$miesiac','$ys','$ile_obron')";
echo "$q\n";
mysqli_query($kon,$q);
		
           }
          $ys++; 
       }
       while($ys<2024);
   }
        
     
		?>
