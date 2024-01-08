<?php
$referer=$_SERVER['HTTP_REFERER'];
   // print_r($_POST);
require('../config/config.php');
require('session_controller.php');
include('konekt_MySQL.php');
$tabledata=explode("|;;|",$_POST['tabelka']);
//print_r($tabledata);
foreach(array_keys($tabledata) as $wiersz){
    unset($grupy);
    echo "$tabledata[$wiersz]";
    $wierszarray=explode(",",$tabledata[$wiersz]);
   $ilelementow=count(explode(",",$tabledata[$wiersz]));
   $ilegrup=$ilelementow-10;
   //echo " - $ilegrup grup<br/>";
    //powinienem mieć 11 elementów
   $ss=$wierszarray[2];
   $p=$wierszarray[3];
   $lg=0;
   do{
       $grupy[]=$wierszarray[4+$lg];
       $lg++;
   }
   while ($lg<$ilegrup);
   $grstring=implode(",",$grupy);
   $iw=$wierszarray[4+$lg];
   $ic=$wierszarray[5+$lg];
   $il=$wierszarray[6+$lg];
   $ip=$wierszarray[7+$lg];
   $is=$wierszarray[8+$lg];
   $ir=$wierszarray[9+$lg];
   if($iw>0) {
       $fp="Wykład";
       $iloscgodzin=$iw;
   }
   else if ($ic>0) {
       $fp="Ćwiczenia";
       $iloscgodzin=$ic;
   }
   else if ($il>0) {
       $fp="Laboratorium";
       $iloscgodzin=$il;
   }
   else if ($ip>0) {
       $fp="Projekt";
       $iloscgodzin=$ip;
   }
   else if ($is>0) {
       $fp="Seminarium";
       $iloscgodzin=$is;
   }
   if($iloscgodzin>0 && strlen($grstring)>0){
   //echo "<hr/>";
   //echo "$wierszarray[2] $wierszarray[3] $grstring";
  // echo " $iw $ic $il $ip $is $ir";
   $wykladowca_tytul=mysqli_fetch_array(mysqli_query($kon,"SELECT `wykladowca_tytul` FROM `karta_obciazen` "
           . "WHERE `wykladowca_imie`='$_POST[wykladowca_imie]' AND `wykladowca_nazwisko`='$_POST[wykladowca_nazwisko]'"));
   $insert="INSERT INTO `karty_obciazen_w`(`wykladowca_imie`,`wykladowca_nazwisko`,`wykladowca_tytul`,`symbol_studiow`,`przedmiot`,"
           . "`przedmiot_forma`,`grupy`,`ilosc_godzin`,`rok_akademicki`,`semestr_ZL`,`jezyk`,`WYDZIAL`) VALUES ("
           . "'$_POST[wykladowca_imie]','$_POST[wykladowca_nazwisko]','$wykladowca_tytul[0]','$wierszarray[2]',"
           . "'$wierszarray[3]','$fp','$grstring','$iloscgodzin','$_POST[rok_akademicki]','$_POST[semestr_ZL]',"
           . "'$_POST[jezyk]',$_POST[wydzial])";
   //echo "$insert <br/>"; 
   mysqli_query($kon,$insert);
   }
   unset($iw);
   unset($ic);
   unset($il);
   unset($ip);
   unset($is);
   unset($ir);
   $wykladowca="$_POST[wykladowca_nazwisko];;$_POST[wykladowca_imie]";
   }
   ?>
<form method="POST" action="<?php echo $referer;?>" id="auto_s">
    <input type="hidden" name="wykladowca" value="<?php echo $wykladowca;?>"/>
    <input type="hidden" name="rok_akademicki" value="<?php echo $_POST['rok_akademicki'];?>"/>
    <input type="hidden" name="semestr_ZL" value="<?php echo $_POST['semestr_ZL'];?>"/>
    <input type="hidden" name="wydzial" value="<?php echo $_POST['wydzial'];?>"/>
</form>
   
<script>
    
    document.getElementById("auto_s").submit();
    </script>
