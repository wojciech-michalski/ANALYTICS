<?php

ini_set('max_execution_time', 3000);
// stare query, nie uwzględniające studentów z przedmiotami przydzielonymi bez specjalności (modułu)
//$lista_przedmiotowq="SELECT Przynaleznosc.G_NUMER_ALBUMU,Std_Rodzaj.R_DNAZWA,Std_Typ.T_DNAZWA,"
//        . "Std_Kierunek.K_DNAZWA,LPrzedmiot.ID_LPRZEDMIOT,LPrzedmiot.LP_WOLNY_ID_PRZEDMIOT, "
//        . "AS_Przedmiot.P_NAZWA,LPrzedmiot_Forma.LPF_ID_GPRZEDMIOT,GPrzedmiot.GP_ID_SPRZEDMIOT_FORMA,"
//        . "AS_FORMA.F_NAZWA,AS_FormaZal.FZ_NAZWA "
//        . "FROM LPrzedmiot INNER JOIN AS_Przedmiot ON AS_Przedmiot.ID_PRZEDMIOT=LPrzedmiot.LP_WOLNY_ID_PRZEDMIOT  "
//        . "INNER JOIN LPrzedmiot_Forma ON LPrzedmiot_Forma.LPF_ID_LPRZEDMIOT=LPrzedmiot.ID_LPRZEDMIOT "
//        . "INNER JOIN GPrzedmiot ON GPrzedmiot.ID_GPRZEDMIOT=LPrzedmiot_Forma.LPF_ID_GPRZEDMIOT "
//        . "INNER JOIN SPrzedmiot_Forma ON GPrzedmiot.GP_ID_SPRZEDMIOT_FORMA=SPrzedmiot_Forma.ID_S_PRZEDMIOT_FORMA "
//        . "INNER JOIN AS_Forma ON SPrzedmiot_Forma.SPF_ID_FORMA=AS_FORMA.ID_FORMA "
//        . "INNER JOIN Lista_Semestrow ON Lista_Semestrow.ID_LISTA_SEMESTROW=LPrzedmiot.LP_ID_LISTA_SEMESTROW "
 //       . "INNER JOIN Przynaleznosc ON Przynaleznosc.ID_PRZYNALEZNOSC=Lista_Semestrow.L_ID_PRZYNALEZNOSC "
//        . "INNER JOIN Std_Rodzaj ON Przynaleznosc.G_ID_RODZAJ=Std_Rodzaj.ID_RODZAJ "
//        . "INNER JOIN Std_Typ ON Przynaleznosc.G_ID_TYP=Std_Typ.ID_TYP "
 //       . "INNER JOIN Std_Kierunek ON Przynaleznosc.G_ID_KIERUNEK=Std_Kierunek.ID_Kierunek "
 //       . "INNER JOIN AS_FormaZal ON SPrzedmiot_Forma.SPF_ID_FORMAZAL=AS_FormaZal.ID_FORMAZAL "
 //       . "WHERE Lista_Semestrow.L_ROK='$rok_akademicki' AND  Lista_Semestrow.L_LETNI='$semestr'";

$lista_przedmiotowq="SELECT  p.G_NUMER_ALBUMU, ls.L_NR_SEMESTRU,Std_Rodzaj.R_DNAZWA,Std_Typ.T_DNAZWA,
    Std_Kierunek.K_DNAZWA,  asp.P_NAZWA,asf.F_NAZWA,op.OS_IMIE_I,op.OS_NAZWISKO,AS_Tytul.T_NAZWA, lpf.ID_LPRZEDMIOT_FORMA,
    lpf.LPF_ZALICZONY,AS_FormaZal.FZ_NAZWA
FROM            AS_Forma AS asf RIGHT OUTER JOIN
                         SPrzedmiot_Forma AS spf ON asf.ID_FORMA = spf.SPF_ID_FORMA RIGHT OUTER JOIN
                         Osoba AS o INNER JOIN
                         Student AS s ON o.ID_OSOBA = s.T_ID_OSOBA INNER JOIN
                         Przynaleznosc AS p ON p.G_ID_STUDENT = s.ID_STUDENT INNER JOIN
                         Lista_Semestrow AS ls ON ls.L_ID_PRZYNALEZNOSC = p.ID_PRZYNALEZNOSC LEFT OUTER JOIN
                         LPrzedmiot AS lp ON lp.LP_ID_LISTA_SEMESTROW = ls.ID_LISTA_SEMESTROW LEFT OUTER JOIN
                         LPrzedmiot_Forma AS lpf ON lpf.LPF_ID_LPRZEDMIOT = lp.ID_LPRZEDMIOT LEFT OUTER JOIN
                         AS_Pracownik AS pracW ON pracW.ID_PRACOWNIK = lpf.LPF_PROWADZACY LEFT OUTER JOIN
                         Osoba AS opw ON opw.ID_OSOBA = pracW.N_ID_OSOBA LEFT OUTER JOIN
                         GPrzedmiot AS gp ON gp.ID_GPRZEDMIOT = lpf.LPF_ID_GPRZEDMIOT LEFT OUTER JOIN
                         GPracownik AS gprac ON gprac.GN_ID_GPRZEDMIOT = gp.ID_GPRZEDMIOT LEFT OUTER JOIN
                         AS_Pracownik AS prac ON prac.ID_PRACOWNIK = gprac.GN_ID_PRACOWNIK LEFT OUTER JOIN
                         Osoba AS op ON op.ID_OSOBA = prac.N_ID_OSOBA ON spf.ID_S_PRZEDMIOT_FORMA = gp.GP_ID_SPRZEDMIOT_FORMA LEFT OUTER JOIN
                         SPrzedmiot AS sp ON sp.ID_S_PRZEDMIOT = spf.SPF_ID_SPRZEDMIOT LEFT OUTER JOIN
                         AS_Przedmiot AS asp ON asp.ID_PRZEDMIOT = sp.SP_ID_PRZEDMIOT LEFT OUTER JOIN
                         PPrzedmiot AS pp ON pp.PP_ID_PRZEDMIOT = asp.ID_PRZEDMIOT FULL OUTER JOIN
                         KontrolaPrzedmiotow AS kp ON asp.ID_PRZEDMIOT = kp.KP_ID_PRZEDMIOT
						 left join AS_Tytul on prac.N_ID_TYTUL=AS_Tytul.ID_TYTUL
                        INNER JOIN Std_Rodzaj ON p.G_ID_RODZAJ=Std_Rodzaj.ID_RODZAJ 
			INNER JOIN Std_Typ ON p.G_ID_TYP=Std_Typ.ID_TYP 
			INNER JOIN Std_Kierunek ON p.G_ID_KIERUNEK=Std_Kierunek.ID_Kierunek 
                        INNER JOIN AS_FormaZal ON SPF_ID_FORMAZAL=AS_FormaZal.ID_FORMAZAL

	Where asp.P_NAZWA is not null  AND ls.L_ROK='$rok_akademicki' AND ls.L_LETNI='$semestr'";
//echo $lista_przedmiotowq;
if(mysqli_num_rows(mysqli_query($kon,"SELECT `id` FROM `analiza_ocen` WHERE `semestr`='$semestr' "
        . "AND `rok_akademicki`='$rok_akademicki'"))<1){
    ?>
<h4 class="animated bounce infinite">Trwa przygotowywanie danych. Proszę czekać</h4>
<?php
$lista_przedmiotow=sqlsrv_query($conn,$lista_przedmiotowq,array(), array( "Scrollable" => 'static'));
$ile=sqlsrv_num_rows($lista_przedmiotow);
echo $ile;
$k=0;
do{
$przedmiot=sqlsrv_fetch_array($lista_przedmiotow);
$k++;
    $qi="INSERT INTO `analiza_ocen`(`nr_albumu`,`kierunek`,`forma`,`stopien`,`przedmiot`,`forma_zajec`,`wykladowca`,"
            . "`id_forma`,`semestr`,`rok_akademicki`,`czy_zaliczony`,`forma_zaliczenia`) VALUES ('$przedmiot[G_NUMER_ALBUMU]','$przedmiot[K_DNAZWA]',"
            . "'$przedmiot[R_DNAZWA]','$przedmiot[T_DNAZWA]','$przedmiot[P_NAZWA]','$przedmiot[F_NAZWA]','$przedmiot[OS_IMIE_I] $przedmiot[OS_NAZWISKO]',"
            . "'$przedmiot[ID_LPRZEDMIOT_FORMA]','$semestr','$rok_akademicki','$przedmiot[LPF_ZALICZONY]','$przedmiot[FZ_NAZWA]')";
    //echo $qi;
    mysqli_query($kon,$qi);
}
while($k<$ile);
       
       
$lista=mysqli_query($kon,"SELECT `id_forma` FROM `analiza_ocen` WHERE `rok_akademicki`='$rok_akademicki' AND `semestr`='$semestr'");
foreach($lista as $wiersz){
// stare query, nie uwzględniające studentów z przedmiotami przydzielonymi bez specjalności (modułu)
//$oceny="SELECT Lista_Semestrow.L_LETNI,
 //   Lista_Semestrow.L_ROK,
 //   Przynaleznosc.G_NUMER_ALBUMU,
//    Lista_Semestrow.ID_LISTA_SEMESTROW,
//    Przynaleznosc.G_ID_RODZAJ
 //   ,Przynaleznosc.G_ID_TYP,
//    Przynaleznosc.G_ID_KIERUNEK,
 //   LPrzedmiot.ID_LPRZEDMIOT,
//    LPrzedmiot.LP_WOLNY_ID_PRZEDMIOT,
//   LPrzedmiot_Forma.LPF_ID_GPRZEDMIOT,
//    AS_Przedmiot.P_NAZWA,
//   LPrzedmiot_Forma.LPF_ID_GPRZEDMIOT,
//   GPrzedmiot.GP_ID_SPRZEDMIOT_FORMA,
//   AS_FORMA.F_NAZWA,
//    GPracownik.GN_ID_PRACOWNIK,
//   Osoba.OS_IMIE_I, 
//   Osoba.OS_Nazwisko,
//   LOcena.LO_OCENA,
//    LOcena.LO_TERMIN,
//    LOcena.LO_DATA,
//    LPrzedmiot_Forma.LPF_ZALICZONY,
//    AS_FormaZal.FZ_NAZWA
//    FROM LPrzedmiot INNER JOIN AS_Przedmiot
//    ON AS_Przedmiot.ID_PRZEDMIOT=LPrzedmiot.LP_WOLNY_ID_PRZEDMIOT  INNER JOIN LPrzedmiot_Forma 
//    ON LPrzedmiot_Forma.LPF_ID_LPRZEDMIOT=LPrzedmiot.ID_LPRZEDMIOT INNER JOIN GPrzedmiot 
//    ON GPrzedmiot.ID_GPRZEDMIOT=LPrzedmiot_Forma.LPF_ID_GPRZEDMIOT INNER JOIN SPrzedmiot_Forma 
 //   ON GPrzedmiot.GP_ID_SPRZEDMIOT_FORMA=SPrzedmiot_Forma.ID_S_PRZEDMIOT_FORMA INNER JOIN AS_Forma 
//    ON SPrzedmiot_Forma.SPF_ID_FORMA=AS_FORMA.ID_FORMA INNER JOIN Lista_Semestrow 
//    ON Lista_Semestrow.ID_LISTA_SEMESTROW=LPrzedmiot.LP_ID_LISTA_SEMESTROW INNER JOIN Przynaleznosc 
//    ON Przynaleznosc.ID_PRZYNALEZNOSC=Lista_Semestrow.L_ID_PRZYNALEZNOSC INNER JOIN GPracownik 
//    ON GPRacownik.GN_ID_GPRZEDMIOT=GPrzedmiot.ID_GPRZEDMIOT INNER JOIN AS_Pracownik 
//    ON AS_Pracownik.ID_PRACOWNIK=GPRacownik.GN_ID_PRACOWNIK INNER JOIN Osoba 
//    ON Osoba.ID_Osoba=AS_Pracownik.N_ID_OSOBA 
//INNER JOIN AS_FormaZal ON SPrzedmiot_Forma.SPF_ID_FORMAZAL=AS_FormaZal.ID_FORMAZAL
//INNER JOIN LOcena ON LOcena.LO_ID_LPRZEDMIOT_FORMA=LPrzedmiot_Forma.ID_LPRZEDMIOT_FORMA
//WHERE Lista_Semestrow.L_ROK='$rok_akademicki' AND  Lista_Semestrow.L_LETNI='$semestr' 
//    AND Przynaleznosc.G_NUMER_ALBUMU='$wiersz[nr_albumu]' AND LPrzedmiot.ID_LPRZEDMIOT_FORMA='$wiersz[id_forma]'";
$oceny="SELECT LOcena.LO_OCENA,LOcena.LO_TERMIN
	FROM LOcena WHERE LOcena.LO_ID_LPRZEDMIOT_FORMA='$wiersz[id_forma]'";
//echo $oceny;
$dduq=sqlsrv_query($conn,$oceny,array(), array( "Scrollable" => 'static'));
$id=sqlsrv_num_rows($dduq);
$p=0;
do{
    $ddu=sqlsrv_fetch_array($dduq);
    $p++;

//$imie=$ddu[15];
//$nazwisko=$ddu[16];
//$forma_zal=$ddu[21];
//$czy_zal=$ddu[20];
switch($ddu[0]) {
    case 90:
        $ocena=5;
        break;
    case 80:
        $ocena=4.5;
        break;
    case 70:
        $ocena=4;
        break;
    case 60:
        $ocena=3.5;
        break;
    case 50:
        $ocena=3;
        break;
    case "":
        $ocena="";
        break;
    case 0:
        $ocena=2;
        break;
}
//$nr_albumu=$ddu[2];
//$id_forma=$ddu[12];

switch($ddu[1]){
    case 1:
        $qu="UPDATE `analiza_ocen` SET `ocena_termin1`='$ocena'"
            
            . " WHERE `id_forma`='$wiersz[id_forma]' ";
        break;
    case 2:
        $qu="UPDATE `analiza_ocen` SET `ocena_termin2`='$ocena'"
           
            . " WHERE `id_forma`='$wiersz[id_forma]' ";
        break;
    default:
        $qu="UPDATE `analiza_ocen` SET `ocena_termin3`='$ocena'"
            
            . " WHERE `id_forma`='$wiersz[id_forma]' ";
        break;
}
mysqli_query($kon,$qu);
unset($ocena);
//echo $qu;
}
while($p<$id);
}
//teraz liczymy ocenę całkowitą
$numery_a=mysqli_query($kon,"SELECT `id`,`ocena_termin1`,`ocena_termin2`,`ocena_termin3` FROM `analiza_ocen` WHERE `rok_akademicki`='$rok_akademicki' AND `semestr`="
        . "'$semestr'");
foreach ($numery_a as $wierszyk){
    $oceny_array=array("t1"=>$wierszyk['ocena_termin1'],
        "t2"=>$wierszyk['ocena_termin2'],
        "t3"=>$wierszyk['ocena_termin3']);
    $ocena_calkowita=max($oceny_array);
    mysqli_query($kon,"UPDATE `analiza_ocen` SET `ocena_calkowita`='$ocena_calkowita' WHERE `id`='$wierszyk[id]'");
    unset($oceny_array);
    unset($ocena_calkowita);
}
 }
  else {echo "Dane zostały przygotowane";}