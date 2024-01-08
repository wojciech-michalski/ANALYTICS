<?php
//print_r($_FILES);
require('config/config.php');
require('controller/session_controller.php');
include('controller/konekt_MySQL.php');
if($_FILES['import']['tmp_name']=='') {
    ?><script>alert('Brak pliku importu ! nie mogę zaimportować wykładowców');</script>
     <meta http-equiv="Refresh" content="0; url=../main.php?mode=deanreport7" />
     <?php
     die();
}
else
$csv=file($_FILES['import']['tmp_name']);
//print_r($csv);
//Mam pobrany plik csv do tablicy
$csvhead=$csv[0];
$columns=explode(";",$csvhead);
unset($csv[0]); //usuwam pierwszy wiersz z tablicy
foreach($columns as $column){
    //$colprepared[]=str_replace("\"","`",$column);
    $column_=trim($column);
    $colprepared[]="`$column_`";
}
$querystart="INSERT INTO `prowadzacy`(".implode(",",$colprepared) .",`rok_akademicki`) VALUES (";
$nrwiersza=1;
foreach($csv as $row){
    $rowarray=explode(";",$row);
    foreach($rowarray as $wartosc){
       // $wartosc=mb_convert_encoding($str, "Windows-1252", "UTF-8");
        $wartosc_=iconv("WINDOWS-1250","UTF-8",$wartosc);
        $wars[]=str_replace("\"","",$wartosc_);
    }
    $warstring=implode("','",$wars);
    $query="$querystart'$warstring','$_POST[rok_akademicki]')";
    echo "$query <br/>";
    unset($wars);
    if(mysqli_query($kon,$query)){
        echo "Pomyślnie dodałem wiersz $nrwiersza<br/>";
//teraz link do ankiety
$lastid_=mysqli_fetch_array(mysqli_query($kon,"SELECT MAX(`id`) FROM `prowadzacy` WHERE 1"));
$lastid=$lastid_[0];
switch($_POST['ankieta']){
    case "ocena_pracy_nauczyciela":
        $link="$surveyurl/?ankieta=ow&p=$lastid";
$linkq="INSERT INTO `linki_ankiet`(`ankieta`,`ankieta_nazwa`,`link`,`id_prowadzacy`) VALUES "
        . "('ocena_pracy_nauczyciela','Ocena Pracy Nauczyciela Akademickiego $_POST[rok_akademicki]',"
        . "'$link','$lastid')";
if(mysqli_query($kon,$linkq)) {
    echo "<span style=\"color:green;\">Pomyślnie dodałem linki do ankiet</span><br/>";
} else {echo "<span style=\"color:red;\">Nie dodałem linków błąd !</span><br/>";}
        break;
    default:
        break;
    case "ocena_nakladu_pracy_studenta":
        $link="$surveyurl/?ankieta=onp&p=$lastid";
$linkq="INSERT INTO `linki_ankiet`(`ankieta`,`ankieta_nazwa`,`link`,`id_prowadzacy`) VALUES "
        . "('ocena_nakladu_pracy_studenta','Ocena Nakładu Pracy Studenta $_POST[rok_akademicki]',"
        . "'$link','$lastid')";
if(mysqli_query($kon,$linkq)) {
    echo "<span style=\"color:green;\">Pomyślnie dodałem linki do ankiet</span><br/>";
} else {echo "<span style=\"color:red;\">Nie dodałem linków błąd !</span><br/>";}
        break;
  
}


//        
} else echo "Nie udało się dodać wiersza $nrwiersza. Sprawdź plik CSV !<br/>";
$nrwiersza++;
}
//Zaimportowane, więc mogę przygotować widok
switch($_POST['ankieta']){
    case "ocena_pracy_nauczyciela":
        $viewcreatequery="CREATE VIEW `ANALIZA-Ocena pracy nauczyciela $_POST[rok_akademicki]` AS (select `analytics`.`ocena_pracy_nauczyciela`.`PYT_1` AS `OCEŃ PUNKTUALNOŚĆ ROZPOCZYNANIA I KOŃCZENIA SIĘ ZAJĘĆ`,"
            . "`analytics`.`ocena_pracy_nauczyciela`.`PYT_2` AS `CZY ODBYŁY SIĘ WSZYSTKIE ZAPLANOWANE ZAJĘCIA`,"
            . "`analytics`.`ocena_pracy_nauczyciela`.`PYT_3` AS `OCEŃ DOSTĘPNOŚĆ WYKŁADOWCY POZA ZAPLANOWANYMI ZAJĘCIAMI`,"
            . "`analytics`.`ocena_pracy_nauczyciela`.`PYT_4` AS `CZY POINFORMOWAŁ NA POCZĄTKU SEMESTRU O ZASADACH ZALICZANIA`,"
            . "`analytics`.`ocena_pracy_nauczyciela`.`PYT_5` AS `OCEŃ POZIOM PRZYGOTOWANIA WYKŁADOWCY DO ZAJĘĆ`,"
            . "`analytics`.`ocena_pracy_nauczyciela`.`PYT_6` AS `CZY PROWADZĄCY BYŁ OBIEKTYWNY W OCENIE TWOICH PRAC`,"
            . "`analytics`.`ocena_pracy_nauczyciela`.`PYT_7` AS `CZY PROWADZĄCY ZAJĘCIA BYŁ POZYTYWNIE NASTAWIONY DO STUDENTÓW`,"
            . "`analytics`.`ocena_pracy_nauczyciela`.`PYT_8` AS `CZY PROWADZĄCY UDZIELAŁ ODPOWIEDZI NA ZADAWANE PYTANIA`,"
            . "`analytics`.`ocena_pracy_nauczyciela`.`PYT_9` AS `CZY TREŚCI PROGRAMOWE PRZEKAZYWANE BYŁY W SPOSÓB ZROZUMIAŁY`,"
            . "`analytics`.`ocena_pracy_nauczyciela`.`PYT_10` AS `CZY ZAJĘCIA ZACHĘCIŁY DO SAMODZIELNGO POSZERZANIA WIEDZY`,"
            . "`analytics`.`ocena_pracy_nauczyciela`.`PYT_11` AS `CZY ZAJĘCIA BYŁY PROWADZONE W SPOSÓB INTERESUJĄCY`,"
            . "`analytics`.`ocena_pracy_nauczyciela`.`PYT_12` AS `CZY UWAŻASZ, ŻE ZAJĘCIA WZBOGACIŁY UMIEJĘTNOŚCI PRAKTYCZNE`,"
            . "`analytics`.`ocena_pracy_nauczyciela`.`PYT_13` AS `CZY PROWADZĄCY WYKORZYSTYWAŁ NOWOCZESNE METODY PREZENTACJI`,"
            . "`analytics`.`ocena_pracy_nauczyciela`.`PYT_14` AS `W JAKIM STOPNIU REALIZOWANY PROGRAM SPEŁNIŁ TWOJE OCZEKIWANIA`,"
            . "`analytics`.`ocena_pracy_nauczyciela`.`PYT_15` AS `OCEŃ KULTURĘ OSOBISTĄ PROWADZĄCEGO ZAJĘCIA`,"
            . "`analytics`.`ocena_pracy_nauczyciela`.`PYT_16` AS `Czy chciałbyś/chciałabyś dodać coś od siebie`,"
            . "`analytics`.`prowadzacy`.`imie` AS `imie`,`analytics`.`prowadzacy`.`nazwisko` AS `nazwisko`,"
            . "`analytics`.`prowadzacy`.`przedmiot` AS `przedmiot`,`analytics`.`prowadzacy`.`tytul` AS `tytul`,"
            . "`analytics`.`prowadzacy`.`kierunek` AS `kierunek`,`analytics`.`prowadzacy`.`stopien` AS `stopien`,"
            . "`analytics`.`prowadzacy`.`forma` AS `forma`,`analytics`.`prowadzacy`.`grupa` AS `grupa`,`analytics`."
            . "`prowadzacy`.`rok_akademicki` AS `rok_akademicki` from (`analytics`.`ocena_pracy_nauczyciela` "
            . "join `analytics`.`prowadzacy` on"
            . "(`analytics`.`ocena_pracy_nauczyciela`.`id_prowadzacy` = `analytics`.`prowadzacy`.`id`)) "
            . "where `analytics`.`prowadzacy`.`rok_akademicki` = '$_POST[rok_akademicki]')";
        break;
    case "ocena_nakladu_pracy_studenta":
        $viewcreatequery="CREATE VIEW `ANALIZA-Ocena nakładu pracy studenta $_POST[rok_akademicki]` AS 
            (select `analytics`.`ocena_nakladu_pracy_studenta`.`PYT_1` AS 
            `Lektura literatury niezbędnej do realizacji przedmiotu`,
            `analytics`.`ocena_nakladu_pracy_studenta`.`PYT_2` AS `Przygotowanie się do zajęć`,
            `analytics`.`ocena_nakladu_pracy_studenta`.`PYT_3` AS `Samodzielne ćwiczenia`,
            `analytics`.`ocena_nakladu_pracy_studenta`.`PYT_4` AS `Opracowanie wyników np. ćwiczeń`,
            `analytics`.`ocena_nakladu_pracy_studenta`.`PYT_5` AS `Wykonanie projektów`,
            `analytics`.`ocena_nakladu_pracy_studenta`.`PYT_6` AS `Raporty, prawozdania, prezentacje, inne prace pisemne`,
            `analytics`.`ocena_nakladu_pracy_studenta`.`PYT_7` AS `Przygotowanie pracy zaliczeniowej`,
            `analytics`.`ocena_nakladu_pracy_studenta`.`PYT_8` AS `Przygotowanie się do sprawdzianu/kolokwium`,
            `analytics`.`ocena_nakladu_pracy_studenta`.`PYT_9` AS `Przygotowanie się do egzaminu`,
            `analytics`.`ocena_nakladu_pracy_studenta`.`PYT_10` AS `Inne (jakie?)`,
            `analytics`.`ocena_nakladu_pracy_studenta`.`PYT_11` AS `LICZBA GODZIN PRACY SAMODZIELNEJ W RAMACH PRZEDMIOTU JEST:`,
            `analytics`.`prowadzacy`.`imie` AS `imie`,`analytics`.`prowadzacy`.
            `nazwisko` AS `nazwisko`,`analytics`.`prowadzacy`.`przedmiot` AS `przedmiot`,
            `analytics`.`prowadzacy`.`tytul` AS `tytul`,`analytics`.`prowadzacy`.`kierunek` AS `kierunek`,
            `analytics`.`prowadzacy`.`stopien` AS `stopien`,`analytics`.`prowadzacy`.`forma` AS `forma`,
            `analytics`.`prowadzacy`.`grupa` AS `grupa`,`analytics`.`prowadzacy`.`rok_akademicki` AS `rok_akademicki` 
            from (`analytics`.`ocena_nakladu_pracy_studenta` join `analytics`.`prowadzacy` 
            on(`analytics`.`ocena_nakladu_pracy_studenta`.`id_prowadzacy` = `analytics`.`prowadzacy`.`id`)) 
            where `analytics`.`prowadzacy`.`rok_akademicki` = '$_POST[rok_akademicki]')";
        break;
    }

        if(mysqli_query($kon,$viewcreatequery)){
            echo "Pomyślnie stworzyłem widok <strong>ANALIZA-Ocena pracy nauczyciela $_POST[rok_akademicki]</strong>";
            header("Location: ../main.php?mode=deanreport6");
        } else {echo "Niestety coś poszło mocno nie tak :-(";
        die();}

//$redirect=$_SERVER['HTTP_REFERER'];



