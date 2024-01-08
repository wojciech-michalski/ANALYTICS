<?php
require_once('../config/config.php');
require_once('konekt_GURU.php');
require_once('konekt_MySQL.php');
$today=date('Y-m-d');
$collect="SELECT przynaleznosc.ID_PRZYNALEZNOSC,przynaleznosc.G_ID_KIERUNEK,przynaleznosc.G_ID_RODZAJ,przynaleznosc.G_ID_TYP,przynaleznosc.G_ID_TYP,przynaleznosc.G_RODZ_MIEJSCOWOSC,przynaleznosc.G_NUMER_ALBUMU,"
        . "przynaleznosc.G_DATA_ROZP,przynaleznosc.G_DATA_ROZP_NA_UCZELNI,przynaleznosc.G_DATA_UMOWY,przynaleznosc.G_ID_PROFIL,Student.T_ID_OSOBA,Student.ID_STUDENT FROM Przynaleznosc INNER JOIN Student ON Przynaleznosc.G_ID_STUDENT=Student.ID_STUDENT WHERE Przynaleznosc.G_AKTYWNY=1 AND Przynaleznosc.G_BAZA=2";
//echo $collect;
$collecting=sqlsrv_query($conn,$collect, array(), array( "Scrollable" => 'static' ));
$i=0;
$stan=sqlsrv_num_rows($collecting);

do {
    $record=sqlsrv_fetch_array($collecting);
    $i=$i+1;
    echo "<strong>Rekord nr $i</strong><br/>";
    if (sqlsrv_query($conn,"SELECT OS_DATA_URODZENIA,OS_EMAIL,OS_IMIE_I,OS_NAZWISKO,OS_OBCOKRAJOWIEC, OS_NARODOWOSC,OS_PASZPORT_KRAJ,"
            . "OS_PESEL,OS_NR_DOWOD,OS_NR_PASZPORTU,OS_PLEC,OS_KRAJ_POCHODZENIA FROM Osoba WHERE ID_OSOBA='".$record['T_ID_OSOBA']."'")) {
    $osoba=sqlsrv_fetch_array(sqlsrv_query($conn,"SELECT OS_DATA_URODZENIA,OS_EMAIL,OS_IMIE_I,OS_NAZWISKO,OS_OBCOKRAJOWIEC, OS_NARODOWOSC,OS_PASZPORT_KRAJ,"
            . "OS_PESEL,OS_NR_DOWOD,OS_NR_PASZPORTU,OS_PLEC,OS_KRAJ_POCHODZENIA FROM Osoba WHERE ID_OSOBA='".$record['T_ID_OSOBA']."'"));
    echo $osoba['OS_IMIE_I']." ".$osoba['OS_NAZWISKO']." ".$osoba['OS_KRAJ_POCHODZENIA']."<br/>";
            }
            else {
                break;
            }
  //ECTS DO POPRAWY ! ZLICZA CHUJOWO
    // echo "SELECT ID_LISTA_SEMESTROW FROM Lista_Semestrow WHERE L_ID_PRZYNALEZNOSC=".$record['ID_PRZYNALEZNOSC']."<br/>";
    $lista_semestrow=sqlsrv_query($conn,"SELECT ID_LISTA_SEMESTROW FROM Lista_Semestrow WHERE L_ID_PRZYNALEZNOSC='".$record['ID_PRZYNALEZNOSC']."'",array(), array( "Scrollable" => 'static'));
$ile_semestrow=sqlsrv_num_rows($lista_semestrow);
//echo "Mamy $ile_semestrow \n";
$k=0;
	do {
	    $semestr_= sqlsrv_fetch_array($lista_semestrow);
	    //$ects=mssql_fetch_array(mssql_query("SELECT sum (LP_WAGA) FROM Lprzedmiot WHERE LP_ID_LISTA_SEMESTROW='$semestr_[0]' AND LP_ZALICZONY='1'" ));
$ects=sqlsrv_fetch_array(sqlsrv_query($conn,"SELECT sum (LP_WAGA) FROM Lprzedmiot INNER JOIN U10..LOcena on U10..LOcena. LO_ID_LPRZEDMIOT_FORMA=U10..Lprzedmiot.ID_LPrzedmiot WHERE U10..Lprzedmiot.LP_ID_LISTA_SEMESTROW='$semestr_[0]' AND U10..LOcena.LO_Ocena>49"));
//$ects=mssql_fetch_array(mssql_query("SELECT sum (LP_WAGA) FROM Lprzedmiot WHERE LP_ID_LISTA_SEMESTROW='$semestr_[0]' AND LP_WAGA_Z_OCENA<>0" ));	
	    $punkty=$ects[0];
	  //echo "SELECT sum (LP_WAGA) FROM Lprzedmiot INNER JOIN U10..LOcena on U10..LOcena. LO_ID_LPRZEDMIOT_FORMA=U10..Lprzedmiot.ID_LPrzedmiot WHERE U10..Lprzedmiot.LP_ID_LISTA_SEMESTROW='$semestr_[0]' AND U10..LOcena.LO_Ocena>49<br/>";
	    //echo "\n";
	    $suma_ects[$k]=$punkty;
	    $k=$k+1;
	    }
	    while ($k<$ile_semestrow);
	    $ects_ectsUzyskane=array_sum($suma_ects);
	    unset($suma_ects);
echo "ECTS: $ects_ectsUzyskane <br/> ";
//KONIEC ECTS
// pobieram datę obrony
    
    
    $data_obrony_=sqlsrv_fetch_array(sqlsrv_query($conn,"SELECT Dyplom.DYP_DATE_EXAM FROM Dyplom WHERE Dyplom.DYP_ID_PRZYNALEZNOSC=".$record['ID_PRZYNALEZNOSC']."; "));
    switch($data_obrony_[0]) {
        case null:
            $data_obrony="BRAK";
            break;
        default:
            $data_obrony = $data_obrony_[0]->format('Y-m-d');
            break;
    }
    
echo "Data obrony: $data_obrony<br/>";

//koniec daty obrony
//Przynależność
$id_kierunku=$record['G_ID_KIERUNEK'];
$id_rodzaj=$record['G_ID_RODZAJ'];
$id_typ=$record['G_ID_TYP'];
$numer_albumu=$record['G_NUMER_ALBUMU'];
switch($record['G_DATA_ROZP']) {
    default:
        $data_rozp=$record['G_DATA_ROZP']->format('Y-m-d');
            break;
    case null:
        $data_rozp="BRAK";
        break;
    }
 switch($record['G_DATA_ROZP_NA_UCZELNI']) {
    default:
        $data_rozp_na_ucz=$record['G_DATA_ROZP_NA_UCZELNI']->format('Y-m-d');
            break;
    case null:
        $data_rozp_na_ucz="BRAK";
        break;
    }
$imie=$osoba['OS_IMIE_I'];
$nazwisko=$osoba['OS_NAZWISKO'];
switch($osoba['OS_PLEC']) {
    case '':
    case 0:
        $plec="BRAK";
        break;
    case 1:
        $plec="kobieta";
        break;
    case 2:
        $plec="mężczyzna";
        break;
}
//plec=$osoba['OS_PLEC'];
switch ($osoba['OS_OBCOKRAJOWIEC']){
    case 1:
        //echo "SELECT K_SKROT FROM AS_KRAJ WHERE ID_KRAJ=".$osoba['OS_KRAJ_POCHODZENIA']."<br/>";
        if (sqlsrv_query($conn,"SELECT K_SKROT FROM AS_KRAJ WHERE ID_KRAJ=".$osoba['OS_KRAJ_POCHODZENIA'])) {
            $obywatelstwo_=sqlsrv_fetch_array(sqlsrv_query($conn,"SELECT K_SKROT FROM AS_KRAJ WHERE ID_KRAJ=".$osoba['OS_KRAJ_POCHODZENIA']));
            $obywatelstwo=$obywatelstwo_[0];
        } else {
            switch(substr($osoba['OS_NARODOWOSC'],0,3)) {
                case "pol":
                case "Pol":
                    $obywatelstwo="PL";
                    break;
                 case "his" :
	    $obywatelstwo="ES";
	    break;
	    case "cze" :
	    $obywatelstwo="CS";
	    break;
	    case "ame" :
	    $obywatelstwo="US";
	    break;
	    case "ang" :
	    $obywatelstwo="AO";
	    break;
	    case "kol" :
	    $obywatelstwo="CO";
	    break;
	    case "ukr" :
	    $obywatelstwo="UA";
	    break;
	    case "Ukr" :
	    $obywatelstwo="UA";
	    break;
	    case "Syr":
	    $obywatelstwo="SY";
	    break;
	    case "Nan":
	    $obywatelstwo="NA";
	    break;
	    case "bra":
	    $obywatelstwo="BR";
	    break;
	    case "aze":
	    $obywatelstwo="AZ";
	    break;
	    case "Kaz":
	    $obywatelstwo="KZ";
	    break;
	    
	    case "bia" :
	    $obywatelstwo="BY";
	    break;
	    case "Bia" :
	    $obywatelstwo="BY";
	    break;
	    case "uzb" :
	    $obywatelstwo="UZ";
	    break;
	    case "por" :
	    $obywatelstwo="PT";
	    break;
	    case "ban" :
	    $obywatelstwo="BD";
	    break;
	    case "ros" :
	    $obywatelstwo="RU";
	    break;
	    case "mon" :
	    $obywatelstwo="MN";
	    break;
	    case "fra" :
	    $obywatelstwo="FR";
	    break;
	    case "łot" :
	    $obywatelstwo="LV";
	    break;
	    case "szw" :
	    $obywatelstwo="SE";
	    break;
	    case "wie" :
	    $obywatelstwo="VN";
	    break;
	    case "nie" :
	    $obywatelstwo="DE";
	    break;
	    case "lit" :
	    $obywatelstwo="LT";
	    break;
	    case "buł" :
	    $obywatelstwo="BG";
	    break;
	    case "tun" :
	    $obywatelstwo="TN";
	    break;
	    case "tur" :
	    $obywatelstwo="TR";
	    break;
	    case "tan" :
	    $obywatelstwo="TZ";
	    break;
	    case "chi" :
	    $obywatelstwo="CN";
	    break;
	    case "nor" :
	    $obywatelstwo="NO";
	    break;
	    case "kaz" :
	    $obywatelstwo="KZ";
	    break;
	    case "bry" :
	    $obywatelstwo="GB";
	    break;
	    case "ser" :
	    $obywatelstwo="RS";
	    break;
	    case "lib" :
	    $obywatelstwo="LB";
	    break;
	    case "zim" :
	    $obywatelstwo="ZW";
	    break;
	    case "węg" :
	    $obywatelstwo="HU";
	    break;
	    case "uzb" :
	    $obywatelstwo="UZ";
	    break;
	    case "nep" :
	    $obywatelstwo="NP";
	    break;
	    case "ind" :
	    $obywatelstwo="IN";
	    break;
	    case "tad":
	    $obywatelstwo="TJ";
	    break;
	    case "eti":
	    $obywatelstwo="ET";
	    break;
	    case "syr":
	    $obywatelstwo="SY";
	    break;
	    case "pal":
	    $obywatelstwo="PS";
	    break;
	    case "kan":
	    $obywatelstwo="CA";
	    break;
	    case "nam":
	    $obywatelstwo="NA";
	    break;
	    case "tan":
	    $obywatelstwo="TZ";
	    break;
	    case "pol":
	    $obywatelstwo="PL";
	    break;
	    case "Pol":
	    $obywatelstwo="PL";
	    break;
	    

            } 
        }
        
        
        break;
    default:
        $obywatelstwo="PL";
        break;
}
switch ($record['G_RODZ_MIEJSCOWOSC']){
    //case null:
    case -1:
      $typ_miejsc_polon="BRAK";
        break;
    case 0:
        $typ_miejsc_polon="MIASTO";
        break;
    case 1:
        $typ_miejsc_polon="WIEŚ";
        break;
        
}
//specjalność
$specjalnosci_id=sqlsrv_query($conn,"select md_id_specjalnosc from Modul where md_podstawowy='1' and MD_ID_PRZYNALEZNOSC=$record[0]");
    $specjalnosc_id=sqlsrv_fetch_array($specjalnosci_id);
    $nspec=sqlsrv_fetch_array(sqlsrv_query($conn,"SELECT SP_NAZWA FROM Std_specjalnosc WHERE ID_SPECJALNOSC='$specjalnosc_id[0]'"));
    switch ($nspec[0]){
        case null:
            $specjalnosc="BRAK";
            break;
        default:
            $specjalnosc=$nspec[0];
            break;
        
    }
 //pesel
    $pesel=$osoba['OS_PESEL'];
    $email=$osoba['OS_EMAIL'];
// dane semestru
    $nr_semestru=sqlsrv_fetch_array(sqlsrv_query($conn,"SELECT l_nr_semestru,L_ROK, L_LETNI,ID_LISTA_SEMESTROW FROM Lista_Semestrow WHERE L_ID_PRZYNALEZNOSC='$record[0]' AND l_aktywny='1'"));
    $daneSemestru_semestrStudenta=$nr_semestru[0];
    $daneSemestru_rok=$nr_semestru[1];
    switch($nr_semestru[2]){
        case 0:
            $semestrZL="Z";
            $odwrotnosc=1;
            break;
        case 1:
            $semestrZL="L";
            $odwrotnosc=0;
            break;
    }
//status
    if (sqlsrv_query($conn,"SELECT LS_ID_STATUS,LS_AKTYWNY,ID_LSTATUS FROM LStatus WHERE LS_ID_LISTA_SEMESTROW=$nr_semestru[3] AND LS_AKTYWNY=1;")){
    $statusid=sqlsrv_fetch_array(sqlsrv_query($conn,"SELECT LS_ID_STATUS,LS_AKTYWNY,ID_LSTATUS FROM LStatus WHERE LS_ID_LISTA_SEMESTROW=$nr_semestru[3] AND LS_AKTYWNY=1;"));
    if (sqlsrv_query($conn,"SELECT M_NAZWA FROM AS_Status WHERE ID_STATUS=$statusid[0]")) {
    $statusnazwa_=sqlsrv_fetch_array(sqlsrv_query($conn,"SELECT M_NAZWA FROM AS_Status WHERE ID_STATUS=$statusid[0]"));
    $status=$statusnazwa_[0];
    }
    else $status="BRAK";
        }
        else $status="BRAK";
//szkoła średnia
   // echo "SELECT  OSZ_SREDNIA_MIASTO, OSZ_SREDNIA_KRAJ FROM O_Szkola WHERE OSZ_ID_OSOBA=".$record['T_ID_OSOBA'];
        if (sqlsrv_query($conn,"SELECT  OSZ_SREDNIA_MIASTO, OSZ_SREDNIA_KRAJ FROM O_Szkola WHERE OSZ_ID_OSOBA=".$record['T_ID_OSOBA'])){
 $szkola_srednia=sqlsrv_fetch_array(sqlsrv_query($conn,"SELECT  OSZ_SREDNIA_MIASTO, OSZ_SREDNIA_KRAJ FROM O_Szkola WHERE OSZ_ID_OSOBA=".$record['T_ID_OSOBA']));
 $szkola_srednia_kraj=$szkola_srednia[1];
  $szkola_srednia_miasto=$szkola_srednia[0];
        } 
        else {
           $szkola_srednia_kraj="BRAK";
  $szkola_srednia_miasto="BRAK";
        }
// Niepełnosprwność
  if (sqlsrv_query($conn,"SELECT LinkNiepelnosprawnoscTyp.L_ID_Niepelnosprawnosc_TYP FROM LinkNiepelnosprawnoscTyp INNER JOIN O_Niepelnosprawnosc on LinkNiepelnosprawnoscTyp.L_ID_NIEPELNOSPRAWNOSC=O_Niepelnosprawnosc.ID_O_NIEPELNOSPRAWNOSC WHERE O_Niepelnosprawnosc.NIEP_ID_OSOBA=".$record['T_ID_OSOBA'],array(), array( "Scrollable" => 'static'))) {
  $czy_niepelnosprawnosc=sqlsrv_query($conn,"SELECT LinkNiepelnosprawnoscTyp.L_ID_Niepelnosprawnosc_TYP FROM LinkNiepelnosprawnoscTyp INNER JOIN O_Niepelnosprawnosc on LinkNiepelnosprawnoscTyp.L_ID_NIEPELNOSPRAWNOSC=O_Niepelnosprawnosc.ID_O_NIEPELNOSPRAWNOSC WHERE O_Niepelnosprawnosc.NIEP_ID_OSOBA=".$record['T_ID_OSOBA'],array(), array( "Scrollable" => 'static'));



if (sqlsrv_num_rows($czy_niepelnosprawnosc)==0) {
    $niepelnosprawnosc="BRAK";
    $niepelnosprawnosc_typ="";
}
    else {
	
	$id_niepelnosprawnosc=sqlsrv_fetch_array($czy_niepelnosprawnosc);
	$niepelnosprawnosc="TAK";
	if($id_niepelnosprawnosc[0]==""	){
	     $niepelnosprawnosc="BRAK";
	        $niepelnosprawnosc_typ="";
	      }
	else {
	$niepelnosprawnosc_typp=sqlsrv_fetch_array(sqlsrv_query($conn,"SELECT AS_Niepelnosprawnosc_Typ.NPT_NAZWA FROM AS_Niepelnosprawnosc_Typ WHERE AS_Niepelnosprawnosc_Typ.ID_NIEPELNOSPRAWNOSC_TYP='$id_niepelnosprawnosc[0]'"));
	$niepelnosprawnosc_typ=$niepelnosprawnosc_typp[0];
	}
    }
  }
  else {
      $niepelnosprawnosc="BRAK";
	        $niepelnosprawnosc_typ=""; 
  }
  //stypendium
  //stypendium
 // echo "SELECT STYP_ID_RODZAJ_STYP  FROM Stypendia INNER JOIN P_STYPENDIUM on P_STYPENDIUM.STPE_ID_STYPENDIA=Stypendia.ID_STYPENDIA WHERE P_STYPENDIUM.STPE_ID_PRZYNALEZNOSC='".$record['ID_PRZYNALEZNOSC']."' AND STYP_ROK='$daneSemestru_rok' AND STYP_LETNI<>'$odwrotnosc'<br/> ";
 if(sqlsrv_query($conn,"SELECT STYP_ID_RODZAJ_STYP FROM Stypendia INNER JOIN P_STYPENDIUM on P_STYPENDIUM.STPE_ID_STYPENDIA=Stypendia.ID_STYPENDIA WHERE P_STYPENDIUM.STPE_ID_PRZYNALEZNOSC='".$record['ID_PRZYNALEZNOSC']."' AND STYP_ROK='$daneSemestru_rok' AND STYP_LETNI<>'$odwrotnosc' ",array(), array( "Scrollable" => 'static'))) {
    $pobieranie=sqlsrv_query($conn,"SELECT STYP_ID_RODZAJ_STYP  FROM Stypendia INNER JOIN P_STYPENDIUM on P_STYPENDIUM.STPE_ID_STYPENDIA=Stypendia.ID_STYPENDIA WHERE P_STYPENDIUM.STPE_ID_PRZYNALEZNOSC='".$record['ID_PRZYNALEZNOSC']."' AND STYP_ROK='$daneSemestru_rok' AND STYP_LETNI<>'$odwrotnosc' ",array(), array( "Scrollable" => 'static'));
    if (sqlsrv_num_rows($pobieranie)==0)
    {
	
$stypendium="BRAK";		
	}
	else
	{
        			//$id_stypendiaa=sqlsrv_fetch_array($pobieranie);
   
	 // Rodzaj stypendium
	 
	 $stypendium="pobiera";
	 $ile_stypendiow=sqlsrv_num_rows($pobieranie);
	 $licznik=0;
	 do {
	    $pobieranie_BRA=sqlsrv_fetch_array($pobieranie);
            echo "<br/>SELECT STY_NAZWA FROM AS_StypendiaRodzaje WHERE ID_RODZAJ_STYPENDIUM='$pobieranie_BRA[0]'<br/>";
	 $rodzaj_stypendium=sqlsrv_fetch_array(sqlsrv_query($conn,"SELECT STY_NAZWA FROM AS_StypendiaRodzaje WHERE ID_RODZAJ_STYPENDIUM='$pobieranie_BRA[0]'"));
$rodzaje_stypendiow[$licznik]=$rodzaj_stypendium[0];		 
	 
	 
	     $licznik=$licznik+1;
	 }
	 while ($licznik<$ile_stypendiow);
	 $stypendium_rodzaj=implode(";",$rodzaje_stypendiow);
    }
 }
 else {
     $stypendium="BRAK";
     $stypendium_rodzaj="BRAK";
 }

echo "Niepełnosprawność: $niepelnosprawnosc TYP niepełnosprawności: $niepelnosprawnosc_typ<br/>";
echo "$typ_miejsc_polon <br/>";
echo $specjalnosc."<br/>";
echo "$obywatelstwo <br/>";
echo "Rok akademicki: $daneSemestru_rok  Numer semestru: $daneSemestru_semestrStudenta SEMESTR: $semestrZL Status: $status <br/>";
echo "Szkoła średnia kraj: $szkola_srednia_kraj Skoła średnia miasto: $szkola_srednia_miasto";
echo "<br/>Stypendium: $stypendium Rodzaj Stypendium: $stypendium_rodzaj ";
echo "<hr/>";
switch($obywatelstwo){
    case "PL":
        $dok_rodzaj="DO";
        $dok_nr=$osoba['OS_NR_DOWOD'];
        break;
    default:
        $dok_rodzaj="PS";
        $dok_nr=$osoba['OS_NR_PASZPORTU'];
        break;
}
// ID MAPOWANIA
if (mysqli_query($kon,"SELECT `id` FROM `mapowanie` WHERE `id_kierunek`=$id_kierunku AND `id_rodzaj`=$id_rodzaj AND `id_typ`=$id_typ")) {
$idmap=mysqli_fetch_array(mysqli_query($kon,"SELECT `id` FROM `mapowanie` WHERE `id_kierunek`=$id_kierunku AND `id_rodzaj`=$id_rodzaj AND `id_typ`=$id_typ"));
}
else 
    {
    $idmap[0]=0;
    }
switch($idmap[0]) {
    case '':
    $id_mapowanie=0;
    break;
    
    default:
    $id_mapowanie=$idmap[0];
    break;
    }
    switch($osoba['OS_DATA_URODZENIA']) {
    default:
         $data_urodzenia=$osoba['OS_DATA_URODZENIA']->format('Y-m-d');
            break;
    case null:
         $data_urodzenia="BRAK";
        break;
    }
 
   
//KONIEC ID MAPOWANIA
$insert="INSERT INTO `studenci`(`data_urodzenia`,`id_mapowanie`,`collect_data`,`id_kierunek`,`id_rodzaj`,`id_typ`,`numer_albumu`,`data_rozpoczecia`,`data_rozp_na_uczelni`,`imie`,`nazwisko`,`plec`,`obywatelstwo`,`polon_miejsc`,`id_specjalnosc`,`pesel`,`email`,`rok_semestru`,`typ_semestru`,`numer_semestru`,`status_studenta`,`szkola_srednia_kraj`,`stypendium`,`szkola_srednia_miasto`,`profil_studiow`,`dyplom_data_obrony`,`dokument_rodzaj`,`dokument_nr`,`ects`,`specjalizacja`,`niepelnosprawnosc`,`niepelnosprawnosc_typ`,`niepelnosprawnosc_dane_dod`,`stypendium_rodzaj`,`data_rozp_polon`,`polon_uid`,`data_umowy`,`specjalnosc_nazwa`)"
        . "VALUES ('".$data_urodzenia."',"
        . "$id_mapowanie,'$today',$id_kierunku,$id_rodzaj,$id_typ,'$numer_albumu','$data_rozp','$data_rozp_na_ucz','$imie','$nazwisko','$plec','$obywatelstwo','".$typ_miejsc_polon."','$specjalnosc_id[0]','".$osoba['OS_PESEL']."','".$osoba['OS_EMAIL']."','$daneSemestru_rok','$semestrZL','$daneSemestru_semestrStudenta','$status','$szkola_srednia_kraj','$stypendium','$szkola_srednia_miasto','','$data_obrony','$dok_rodzaj','$dok_nr','$ects_ectsUzyskane','','$niepelnosprawnosc','$niepelnosprawnosc_typ','','$stypendium_rodzaj','','','','$specjalnosc')";
echo "<br/>$insert<br/>";
if(mysqli_query($kon,$insert)) {
    echo "Pomyślnie dodałem $record[0] do bazy<hr/>";
}
else {
    echo "No kurwa nie udało się...";
}

unset($numer_albumu);
unset($data_rozp);
unset($data_rozp_na_ucz);
unset($imie);
unset($nazwisko);
unset($niepelnosprawnosc);
unset($niepelnosprawnosc_typ);
unset($stypendium);
unset($stypendium_rodzaj);
}
while($i<$stan);
      

