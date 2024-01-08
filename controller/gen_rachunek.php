<?php
$referer=$_SERVER['HTTP_REFERER'];
   // print_r($_POST);
require('../config/config.php');
require('session_controller.php');
include('konekt_MySQL.php');

print_r($_POST);
//czyszczę rach_elementy
$czysc_rach_elementy=mysqli_query($kon,"DELETE FROM `rach_elementy` WHERE `rok`='$_POST[rok_akademicki]' AND `miesiac`='$_POST[miesiac]' "
        . "AND `imie`='$_POST[wykladowca_imie]' AND `nazwisko`='$_POST[wykladowca_nazwisko]'");
//parsuję wiersze z tabeli do elementów rachunku
$tabelka=explode("|;;|",$_POST['tabelka']);
$fr=array_shift($tabelka);
$sr=array_shift($tabelka);
//print_r($tabelka);
$count=count($tabelka);
echo $count;
foreach($tabelka as $rowek){
    
    $elementy=explode(",",$rowek);
    $kierunek=$elementy[2];
    $przedmiot=$elementy[3];
    $w=intval($elementy[4]);
    $c=intval($elementy[5]);
    $l=intval($elementy[6]);
    $p=intval($elementy[7]);
    $s=intval($elementy[8]);
    if($w>0) $forma="wykład";
    if($c>0) $forma="ćwiczenia";
    if($l>0) $forma="laboratorium";
    if($p>0) $forma="projekt";
    if($s>0) $forma="seminarium";
   // print_r($elementy);
    //parsowanie z kierunku typu, rodzju i semestru
    if(strpos($kierunek,"Niestacjonarne")){
        $kier_ar=explode("Niestacjonarne",$kierunek);
        $rodzaj="Niestacjonarne";
    }
    else 
    if(strpos($kierunek,"Stacjonarne")){
        $kier_ar=explode("Stacjonarne",$kierunek);
        $rodzaj="Stacjonarne";
    } else
    if(strpos($kierunek,"stacjonarne")){
        $kier_ar=explode("stacjonarne",$kierunek);
        $rodzaj="stacjonarne";
    }
    $semestr=intval(trim(str_replace("sem. ","",$kier_ar[1])));
    if(strpos($kier_ar[0],"II stopnia")){
        $typ_ar=explode("II stopnia",$kier_ar[0]);
        $kierunek_parse=$typ_ar[0];
        $typ="II stopnia $typ_ar[1]";
    }
    else 
        if(strpos($kier_ar[0],"I stopnia")){
        $typ_ar=explode("I stopnia",$kier_ar[0]);
        $kierunek_parse=$typ_ar[0];
        $typ="I stopnia $typ_ar[1]";
        }
        switch($_POST['miesiac']){
            case "Styczeń":
                $month="01";
                $rok=$_POST['rok_akademicki']+1;
                break;
            case "Luty":
                $month="02";
                $rok=$_POST['rok_akademicki']+1;
                break;
            case "Marzec":
                $month="03";
                $rok=$_POST['rok_akademicki']+1;
                break;
            case "Kwiecień":
                $month="04";
                $rok=$_POST['rok_akademicki']+1;
                break;
            case "Maj":
                $month="05";
                $rok=$_POST['rok_akademicki']+1;
                break;
            case "Czerwiec":
                $month="06";
                $rok=$_POST['rok_akademicki']+1;
                break;
            case "Lipiec":
                $month="07";
                $rok=$_POST['rok_akademicki']+1;
                break;
            case "Sierpień":
                $month="08";
                $rok=$_POST['rok_akademicki']+1;
                break;
            case "Wrzesień":
                $month="09";
                $rok=$_POST['rok_akademicki']+1;
                break;
            case "Październik":
                $month="10";
                $rok=$_POST['rok_akademicki'];
                break;
            case "Listopad":
                $month="11";
                $rok=$_POST['rok_akademicki'];
                break;
            case "Grudzień":
                $month="12";
                $rok=$_POST['rok_akademicki'];
                break;
        }
  //  print_r($kier_ar);
    $godziny=$w+$c+$l+$p+$s;
  //wyciągam ostatnie id z rach_elementy
    $maxid=mysqli_fetch_array(mysqli_query($kon,"SELECT MAX(`id`) FROM `rach_elementy`"));
    $id_array[]=$maxid[0]+1;
    $nowy_element_rach="INSERT INTO `rach_elementy`(`start`,`rok`,`miesiac`,`imie`,`nazwisko`,`godziny`,`przedmiot`,`forma`,"
            . "`kierunek`,`typ`,`rodzaj`,`semestr`) VALUES('$rok-$month-01','$_POST[rok_akademicki]',"
            . "'$_POST[miesiac]','$_POST[wykladowca_imie]','$_POST[wykladowca_nazwisko]','$godziny','$przedmiot','$forma',"
            . "'$kierunek_parse','$typ','$rodzaj','$semestr')";
   mysqli_query($kon,$nowy_element_rach);
   $pozycja="INSERT INTO `pozycje_tmp`(`symbol_studiow`,`przedmiot`,`c`,`w`,`l`,`p`,`s`,`miesiac`,`rok_akademicki`,`pesel`)"
           . "VALUES('$kierunek_parse $typ $rodzaj SEM. $semestr','$przedmiot','$c','$w','$l','$p','$s','$_POST[miesiac]','$_POST[rok_akademicki]','$_POST[pesel]')" ;
   mysqli_query($kon,$pozycja);
}
$id_pozycjeq="SELECT * FROM `pozycje_tmp` WHERE `miesiac`='$_POST[miesiac]' AND `rok_akademicki`='$_POST[rok_akademicki]' AND `pesel`='$_POST[pesel]' "
        . "GROUP BY `symbol_studiow`,`przedmiot` ORDER BY `id` DESC LIMIT $count";
//echo $id_pozycjeq;
$id_pozycje=mysqli_query($kon,$id_pozycjeq);
$count2=mysqli_num_rows($id_pozycje);
foreach($id_pozycje as $pos){
    $c=mysqli_fetch_array(mysqli_query($kon,"SELECT SUM(`c`) FROM `pozycje_tmp` WHERE `przedmiot`='$pos[przedmiot]' AND `symbol_studiow`='$pos[symbol_studiow]' "
            . "AND `miesiac`='$pos[miesiac]' AND `rok_akademicki`='$pos[rok_akademicki]' AND `pesel`='$pos[pesel]'"));
    $w=mysqli_fetch_array(mysqli_query($kon,"SELECT SUM(`w`) FROM `pozycje_tmp` WHERE `przedmiot`='$pos[przedmiot]' AND `symbol_studiow`='$pos[symbol_studiow]' "
            . "AND `miesiac`='$pos[miesiac]' AND `rok_akademicki`='$pos[rok_akademicki]' AND `pesel`='$pos[pesel]'"));
    $l=mysqli_fetch_array(mysqli_query($kon,"SELECT SUM(`l`) FROM `pozycje_tmp` WHERE `przedmiot`='$pos[przedmiot]' AND `symbol_studiow`='$pos[symbol_studiow]' "
            . "AND `miesiac`='$pos[miesiac]' AND `rok_akademicki`='$pos[rok_akademicki]' AND `pesel`='$pos[pesel]'"));
    $p=mysqli_fetch_array(mysqli_query($kon,"SELECT SUM(`p`) FROM `pozycje_tmp` WHERE `przedmiot`='$pos[przedmiot]' AND `symbol_studiow`='$pos[symbol_studiow]' "
            . "AND `miesiac`='$pos[miesiac]' AND `rok_akademicki`='$pos[rok_akademicki]' AND `pesel`='$pos[pesel]'"));
    $s=mysqli_fetch_array(mysqli_query($kon,"SELECT SUM(`s`) FROM `pozycje_tmp` WHERE `przedmiot`='$pos[przedmiot]' AND `symbol_studiow`='$pos[symbol_studiow]' "
            . "AND `miesiac`='$pos[miesiac]' AND `rok_akademicki`='$pos[rok_akademicki]' AND `pesel`='$pos[pesel]'"));
    $pozycjeq="INSERT INTO `pozycje_rachunkow`(`symbol_studiow`,`przedmiot`,`c`,`w`,`l`,`p`,`s`,`miesiac`,`rok_akademicki`,`pesel`)"
           . "VALUES('$pos[symbol_studiow]','$pos[przedmiot]','$c[0]','$w[0]','$l[0]','$p[0]','$s[0]','$pos[miesiac]','$pos[rok_akademicki]','$pos[pesel]')" ;
    mysqli_query($kon,$pozycjeq);
    
}
mysqli_query($kon,"TRUNCATE TABLE `pozycje_tmp`");
mysqli_query($kon,"TRUNCATE TABLE `rach_elementy`");

$id_elementy=mysqli_query($kon,"SELECT `id` FROM `pozycje_rachunkow` ORDER BY `id` DESC LIMIT $count2");
foreach($id_elementy as $element){
    $id[]=$element['id'];
}
$id_elementy=implode(",",$id);
//format rachunku: numer/miesiąc/rok
$lastnumq="SELECT `numer` FROM `rachunki` "
        . "WHERE `id`=(SELECT MAX(`id`) FROM `rachunki` WHERE `numer` LIKE '%/$month/%')";
//echo $lastnumq;
$lastnumber=mysqli_fetch_array(mysqli_query($kon,$lastnumq));
$last_number_array=explode("/",$lastnumber[0]);
$number=intval($last_number_array[0])+1;
$nr_rachunku="$number/$month/$rok";
//muszę napisać zabezpieczenie przed odświeżeniem !
$nrbase64=base64_encode($nr_rachunku);
$insert_rach="INSERT INTO `rachunki`(`id_pozycje`,`data`,`numer`,`pesel`,`wykladowca_imie`,`wykladowca_nazwisko`,`wydzial`) "
        . "VALUES ('$id_elementy','$_POST[data]','$nr_rachunku','$_POST[pesel]','$_POST[wykladowca_imie]',"
        . "'$_POST[wykladowca_nazwisko]','$_POST[wydzial]')";
mysqli_query($kon,$insert_rach);
?>
<script type="text/javascript">window.open('<?php echo $siteurl;?>/controller/generator_rachunku.php?nr=<?php echo $nrbase64;?>');</script>
<?php switch($_POST['wydzial']){
    case 1:
        ?>
<meta http-equiv="Refresh" content="0; url=../main.php?mode=showcardA" />
<?php break;
    case 2:
        ?>
<meta http-equiv="Refresh" content="0; url=../main.php?mode=showcardI" />
<?php
break;
}
