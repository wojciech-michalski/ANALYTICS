<?php

$rok_akademicki=$_POST['rok_akademicki'];
$semestrZL=$_POST['semestr_ZL'];
//muszę mieć: rok akademicki
//            semestr
//            wykładowcę
//            przedmiot / formę
//            ilość godzin
$GWINTquery="SELECT ls.L_NR_SEMESTRU,Std_Rodzaj.R_DNAZWA,Std_Typ.T_DNAZWA,
    Std_Kierunek.K_DNAZWA,  asp.P_NAZWA,asf.F_NAZWA,op.OS_IMIE_I,op.OS_NAZWISKO,AS_Tytul.T_NAZWA, lpf.ID_LPRZEDMIOT_FORMA,
    lpf.LPF_ZALICZONY,AS_FormaZal.FZ_NAZWA,spf.SPF_ILOSC_GODZ,gp.GP_ID_GRUPA,spf.ID_S_PRZEDMIOT_FORMA
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

	Where asp.P_NAZWA is not null  AND ls.L_ROK='$rok_akademicki' AND ls.L_LETNI='$semestrZL' ";
$lista_przedmiotow=sqlsrv_query($conn,$GWINTquery,array(), array( "Scrollable" => 'static'));
$ile=sqlsrv_num_rows($lista_przedmiotow);
//echo $ile;
$k=0;
do{
    $przedmiot=sqlsrv_fetch_array($lista_przedmiotow);
    switch($przedmiot[3]){
        case "AW":
            case "Architektura":
        case "Budownictwo":
        case "Wzornictwo":
        case "Architektura Krajobrazu":
        case "Architecture":
        case "Civil Engineering":
        case "Design":
        case "Inerior Design":
        case "Landscape Architecture":
            $wydzial=1; //Architektura
            break;
            case "Management":
            case "Management UA":
            case "Computer Engineering":
            case "Environmental Protection":
            case "Public health":
            case "Management and production engineering":
            case "Zarządzanie":
            case "Ochrona Środowiska":
            case "Mechanika i Budowa Maszyn":
            case "Zdrowie Publiczne":  
            case "Zarządzanie i Inżynieria Produkcji":
            case "Zarządzanie UA":
            case "Informatyka":
                
                $wydzial=2; //WIiZ
                break;
    }
    $insertTMP="INSERT INTO `karta_obiazen_TMP`(`nr_semestru`,`rodzaj`,`typ`,`kierunek`,`przedmiot`,"
           . "`forma_przedmiotu`,`wykladowca_imie`,`wykladowca_nawisko`,`wykladowca_tytul`,`ID_LPRZEDMIOT_FORMA`,"
            . "`ilosc_godzin`,`rok_akademicki`,`semestr_ZL`,`id_grupy`,`ID_S_PRZEDMIOT_FORMA`,`WYDZIAL`)"
            . " VALUES ('$przedmiot[0]','$przedmiot[1]','$przedmiot[2]','$przedmiot[3]','$przedmiot[4]',"
            . "'$przedmiot[5]','$przedmiot[6]','$przedmiot[7]','$przedmiot[8]','$przedmiot[9]','$przedmiot[12]',"
            . "'$rok_akademicki','$semestrZL','$przedmiot[13]','$przedmiot[14]',$wydzial)";
    //echo $insertTMP;
    mysqli_query($kon,$insertTMP);
   $k++;
    
}
while($k<$ile);
$lista_obciazen="SELECT `nr_semestru`,`rodzaj`,`typ`,`kierunek`,`przedmiot`,`forma_przedmiotu`,`wykladowca_imie`,"
        . "`wykladowca_nawisko`,`wykladowca_tytul`,`ID_LPRZEDMIOT_FORMA`,`ilosc_godzin`,`rok_akademicki`,"
        . "`semestr_ZL`,`id_grupy`,`ID_S_PRZEDMIOT_FORMA`,`WYDZIAL`"
        . "FROM `karta_obiazen_TMP` "
        . "GROUP BY `nr_semestru`,`rodzaj`,`typ`,`kierunek`,`przedmiot`,`forma_przedmiotu`,`wykladowca_imie`,"
        . "`wykladowca_nawisko`,`id_grupy`";
$locreatequery="INSERT INTO `karta_obciazen` (`nr_semestru`,`rodzaj`,`typ`,`kierunek`,`przedmiot`,"
        . "`forma_przedmiotu`,`wykladowca_imie`,`wykladowca_nazwisko`,`wykladowca_tytul`,`ID_LPRZEDMIOT_FORMA`,"
        . "`ilosc_godzin`,`rok_akademicki`,`semestr_ZL`,`id_grupy`,`ID_S_PRZEDMIOT_FORMA`,`WYDZIAL`) $lista_obciazen";
//echo $locreatequery;
mysqli_query($kon,$locreatequery);
mysqli_query($kon,"TRUNCATE TABLE `karta_obiazen_TMP`");