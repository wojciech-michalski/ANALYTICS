<?php
//Musze określić datę stop i datę start Jeżeli jst ustawiona data start i data stop - robi wg tych dat
//Jezeli nie są - lecę po miesiącach i ltach, jeżeli w ogóle - ustawiam na ostatnią rekrutację
//print_r($_POST);
if (isset($_POST['data'])&& $_POST['data']!=="") {
    
        $data_start=$_POST['data'];
        $data_stop=$_POST['data2'];
        //echo "Data ustawiona<br/>";
}
else {
    if (isset ($_POST['rok'])&&isset($_POST['miesiace'])){
        
            $data_start="$_POST[rok]-".array_keys($miesiace,$_POST['miesiace'])[0]."-01";
            switch ($_POST['miesiace']){
                default:
                    $data_stop="$_POST[rok]-".array_keys($miesiace,$_POST['miesiace'])[0]."-31";
                    break;
                    case "Czerwiec":
                    case "Kwiecień":
                    case "Wrzesień":
                    case "Listpad":
                        $data_stop="$_POST[rok]-".array_keys($miesiace,$_POST['miesiace'])[0]."-30";
                        break;
                    case "Luty":
                        $data_stop="$_POST[rok]-".array_keys($miesiace,$_POST['miesiace'])[0]."-28"; 
                        break;
            }
           
            //echo $data_start;
            //echo $data_stop;
         
} else 
{
    switch(date("m")) {
        case 01:
        case 02:
        case 03:
        case 04:
            $data_start=date("Y")-1 ."-05-01";
            $data_stop=date("Y")-1 ."-10-31";
            break;
        default:
            $data_start=date("Y") ."-05-01";
            $data_stop=date("Y") ."-10-31";
            break;
    }
}}
//echo "Dtata start: $data_start Data stop: $data_stop";
$formy=implode("' OR `forma`='",$_POST['rodzaje']);
$typpy=implode("' OR `stopien`='",$_POST['typy']);
$tytt=implode("' OR `tytul`='",$_POST['tytuly']);
foreach($_POST['kierunki'] as $kierunek) {
   $sqlarray[]="SELECT `kierunek`,`forma`,`stopien`,`tytul`,`id_kierunek`,`id_typ`,`id_rodzaj` FROM `mapowanie` WHERE `kierunek`='$kierunek' AND (`forma`='$formy') AND (`stopien`='$typpy') AND (`tytul`='$tytt')";
}
foreach ($sqlarray as $query){
    $przyn=mysqli_query($kon,$query);
    $pcount=0;
    $how=mysqli_num_rows($przyn);
    do {
        $war_value=mysqli_fetch_array($przyn);
        $pcount=$pcount+1;
        $warunki_przynaleznosci[]="(Przynaleznosc.G_ID_KIERUNEK='$war_value[4]' AND Przynaleznosc.G_ID_TYP='$war_value[5]' AND Przynaleznosc.G_ID_RODZAJ='$war_value[6]' )";
    }
    while($pcount<$how);
}
$warunki="AND (".implode("OR ",$warunki_przynaleznosci);
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

	//echo $query;
	$obrony=sqlsrv_query($conn,$query,array(), array( "Scrollable" => 'static'));

$ile_obron=sqlsrv_num_rows($obrony);
$licznik=0;


	do {
		$obrona=sqlsrv_fetch_array($obrony);
		$data_obrony=$obrona[2];
		$id_przynaleznosc=$obrona[0];
		$id_rodzaj=$obrona[2];
		$kierunekdata=mysqli_fetch_array(mysqli_query($kon,"SELECT `kierunek`,`stopien`,`forma` FROM `mapowanie` WHERE `id_rodzaj`='$id_rodzaj'"));
                
$kierunek=$kierunekdata[0];
$typ_studiow=$kierunekdata[1];
$studia_formaStudiow=$kierunekdata[2];
	//przygotowanie tablicy
	$data_obrony=$obrona[1];
$wyniki[$licznik]="$kierunek;$typ_studiow;$studia_formaStudiow";
	

		$licznik=$licznik+1;
		}
		while ($licznik<$ile_obron);
		//print_r($wyniki);
	$ile_wynikow=count($wyniki);
	//echo $ile_wynikow;
	//echo "<br/>";
$wyniki_zagregowane=array_count_values ($wyniki);
//print_r($wyniki_zagregowane);
//arsort($wyniki_zagregowane);
//
	$ile_zagregowanych=count($wyniki_zagregowane);
    


		//Funkcja generująca wykres
		?>
