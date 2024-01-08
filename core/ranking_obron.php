<?php
require('../config/config.php');
require('../controller/session_controller.php');
include('../controller/konekt_MySQL.php');
include('../controller/konekt_GURU.php');
include('view/header_intro.php');
$ra=$_POST['rok_akademicki'];
	$rok_akademicki=explode("/",$_POST['rok_akademicki']);
	$data_start="$rok_akademicki[0]0930";
	$data_stop=$rok_akademicki[1]+2000 ."1001";


$kierarray=$_POST['kierunki'];

//print_r($kierarray);
$kierstring_=implode("' OR Std_Kierunek.K_NAZWA='",$kierarray);
$kierstring="Std_Kierunek.K_NAZWA='$kierstring_'";
//echo "<br/>".$kierstring;
// warunki na typy
$typarray=$_POST['typy'];
//print_r($typarray);
$typstring_=implode("%' OR Std_Typ.T_NAZWA LIKE '",$typarray);
$typstring="Std_Typ.T_NAZWA LIKE '$typstring_%'";
//echo "<br/>".$typstring;
//warunki na rodzaje
$rodzarray=$_POST['rodzaje'];
$rodzstring_=implode("' OR Std_Rodzaj.R_NAZWA='",$rodzarray);
$rodzstring="Std_Rodzaj.R_NAZWA='$rodzstring_'";
//echo "<br/>".$rodzstring;
//waruki na tytuły
$tytularray=$_POST['tytuly'];
$tytulstring_=implode("' OR Std_Typ.T_TYTUL='",$tytularray);
$tytulstring="Std_Typ.T_TYTUL='$tytulstring_'";
//echo "<br/>".$tytulstring;
//warunki na profile
$profarray=$_POST['profile'];
foreach($profarray as $profil){
    switch($profil){
        case "Profil Ogólnoakademicki":
            $profile[]="Std_Rodzaj.R_ID_PROFIL_KSZTALCENIA=1";
            //id profil=1
            break;
        case "Profil Praktyczny":
            //id profil=2
            $profile[]="Std_Rodzaj.R_ID_PROFIL_KSZTALCENIA=2";
            break;
        default:
            //id profil NULL
            $profile[]="Std_Rodzaj.R_ID_PROFIL_KSZTALCENIA IS NULL";
            break;
    }
}
$profilstring=implode(" OR ",$profile);

$warunek_na_kierunek="AND ($kierstring)";
$warunek_na_typ="AND ($typstring)";
$warunek_na_rodzaj="AND ($rodzstring)";
$warunek_na_tytul="AND ($tytulstring)";
$warunek_na_profil="AND ($profilstring)";

$obrony="SELECT DYPLOM.DYP_OCENA_STUDIA, DYPLOM.DYP_DATE_EXAM, DYPLOM.DYP_ID_PRZYNALEZNOSC,"
        . " Przynaleznosc.G_ID_STUDENT,Przynaleznosc.G_ID_RODZAJ, DYPLOM.ID_DYPLOM,S_DodDaneDyplom.SDD_Wartosc"
        . " FROM S_DodDaneDyplom INNER JOIN DYPLOM ON DYPLOM.ID_DYPLOM=S_DodDaneDyplom.SDD_ID_DYPLOM"
        . " INNER JOIN Przynaleznosc ON Przynaleznosc.ID_PRZYNALEZNOSC=DYPLOM.DYP_ID_PRZYNALEZNOSC "
        . " INNER JOIN Std_Kierunek ON Std_Kierunek.ID_KIERUNEK=Przynaleznosc.G_ID_KIERUNEK INNER JOIN Std_Typ "
        . "ON Std_Typ.ID_TYP=Przynaleznosc.g_ID_TYP INNER JOIN Std_Rodzaj ON Std_Rodzaj.ID_RODZAJ=Przynaleznosc.G_ID_RODZAJ "
        . "WHERE S_DodDaneDyplom.SDD_ID_DD_TYP=11"
        . " AND Przynaleznosc.G_BAZA=4 $warunek_na_kierunek  $warunek_na_typ $warunek_na_rodzaj $warunek_na_profil"
        . "AND DYPLOM.DYP_DATE_EXAM>'$data_start' AND DYPLOM.DYP_DATE_EXAM<'$data_stop' "
        . "ORDER BY S_DodDaneDyplom.SDD_Wartosc DESC ";

//echo "<br/>".$obrony;
$obronieni=sqlsrv_query($conn,$obrony,array(), array( "Scrollable" => 'static'));
$ile_obron=sqlsrv_num_rows($obronieni);
//echo $ile_obron;
//echo "<br>";
//generowanie rankingu
$licznik_obron=0;
do {
	$obrona=sqlsrv_fetch_array($obronieni);
	$ocena[$licznik_obron]="$obrona[6];;$obrona[3];;$obrona[5]";
	$licznik_obron++;
	$sama_ocena[$licznik_obron]=$obrona[0];
	}
	while ($licznik_obron<$ile_obron);
//arsort($ocena); //Posortowanie rankingu
//print_r($ocena);
$piec_procent=round(0.05*$ile_obron);
?>
<h4>Ranking obron w roku akademickim <?php echo "$ra dla: $wydzial $kierunek_studiow $rodzaj_studiow $typ_studiow";?></h4>
<table class="table table-striped table-condensed table-bordered">
<caption> Obron: <?php echo "$ile_obron";?> <!--Średnia:--><?php 
$med=round(array_sum($sama_ocena)/$ile_obron,3);
//echo array_sum($sama_ocena);
//echo $med;
?></caption>
<tr>
<th>Imię</th><th>Nazwisko</th><th>Numer albumu</th><th>Ocena końcowa z studiów</th></tr>
<?php 
$licznik=0;
$counter=0;
	foreach ($ocena as &$wiersz) {
		$result=explode(";;",$wiersz);
		$wynik=$result[0];
		//warunek na kolorowanie klasy 5%
				if ($licznik<$piec_procent) {
					 $klasa="class=\"success\"";
					 $info="<span style=\"margin-left:5%;color:orange;\"><small>Student wśród 5% najlepszych absolwentów dla zadanego filtra </small></span>";
				}
						else {
							$klasa="";
							$info="";
						}
						$id_osoba=sqlsrv_fetch_array(sqlsrv_query($conn,"SELECT T_ID_OSOBA FROM Student WHERE ID_STUDENT=$result[1]"));
		$student=sqlsrv_fetch_array(sqlsrv_query($conn,"SELECT OSOBA.OS_IMIE_I,OSOBA.OS_NAZWISKO,Przynaleznosc.G_NUMER_ALBUMU FROM OSOBA INNER JOIN Student ON OSOBA.ID_OSOBA=Student.T_ID_OSOBA  INNER JOIN Przynaleznosc ON Student.ID_STUDENT=Przynaleznosc.G_ID_STUDENT WHERE Student.ID_STUDENT='$result[1]'"));
$test=$counter+1;
$proba=$ocena[$test];
$tt=explode(";;",$proba);
  if($tt[0]==$wynik)	$licznik=$licznik;
  else $licznik++;
		$counter++;
		//$imie=iconv("ISO-8859-2","UTF-8",$student[0]);
		//$nazwisko=iconv("ISO-8859-2","UTF-8",$student[1]);
                $imie=$student[0];
                $nazwisko=$student[1];
		echo "<tr $klasa><td>$imie</td><td>$nazwisko</td><td>$student[2]</td><td>$wynik $info</td></tr>";
}
?>
</table>

