<?php
//include('controller/U10_Przynaleznosci.php');
//include('controller/statusyANALYTICS.php');
//include('controller/karta_obciazen.php');
if(!isset($_POST['rok_akademicki'])) {
    $_POST['rok_akademicki']="2023";
    $_POST['semestr_ZL']=0;
}
//ogarnięcie dat
switch($_POST['semestr_ZL']){
    case 0:
        //zimowy
        $datastart=$_POST['rok_akademicki']."-09-30";
        $datastop=$_POST['rok_akademicki']+1 ."-03-01";
        $mcfirst="10";
        $mclast="02";
        $lz="zimowy";
        break;
    case 1:
        //letni
        $datastart=$_POST['rok_akademicki']+1 ."-03-01";
        $datastart=$_POST['rok_akademicki']+1 ."-09-30";
        $mcfirst="03";
        $mclast="09";
        $lz="letni";
        break;
}
$plan_query2="SELECT OSOBA.OS_IMIE_I, OSOBA.OS_NAZWISKO,OSOBA.OS_PESEL,Zajecia_Elem.ZJE_DATA_OD,Zajecia_Elem.ZJE_DATA_DO,Zajecia_Elem.ZJE_ILOSC_GODZ,GPrzedmiot.GP_ID_SPRZEDMIOT_FORMA FROM ZAjecia 
INNER JOIN GPracownik ON Zajecia.ZJ_ID_GPRAC=GPracownik.ID_GPRACOWNIK 
INNER JOIN AS_Pracownik ON GN_ID_PRACOWNIK=AS_Pracownik.ID_PRACOWNIK 
INNER JOIN OSOBA ON AS_Pracownik.N_ID_OSOBA=OSOBA.ID_OSOBA 
INNER JOIN GPrzedmiot ON GPrzedmiot.ID_GPRZEDMIOT=GPracownik.GN_ID_GPRZEDMIOT 
INNER JOIN Zajecia_Elem ON Zajecia_Elem.ZJE_ID_ZAJECIA=Zajecia.ID_ZAJECIA
WHERE OSOBA.OS_NAZWISKO='$_POST[wykladowca_nazwisko]' AND OSOBA.OS_IMIE_I='$_POST[wykladowca_imie]' "
        . "AND Zajecia_Elem.ZJE_DATA_OD>'$datastart' AND Zajecia_Elem.ZJE_DATA_OD<'$datastop' ORDER BY Zajecia_Elem.ZJE_DATA_OD ASC";


mysqli_query($kon,"UPDATE `rach_elementy` SET `forma`='Lab' WHERE `forma` like 'lab%' OR `forma` LIKE 'Lab%'");
mysqli_query($kon,"UPDATE `rach_elementy` SET `forma`='Wykład' WHERE `forma` LIKE '%ykład' "); 
mysqli_query($kon,"UPDATE `rach_elementy` SET `forma`='Ćwiczenia' WHERE `forma` LIKE '%wiczenia' "); 
mysqli_query($kon,"UPDATE `rach_elementy` SET `forma`='Projekt' WHERE `forma` LIKE '%rojekt' "); 
       include('view/topnav.php');
       ?>
      
       <div class="row" style="margin-top:70px;">
           <div class="col-md-2">
               <?php
       include('view/sidenav.php');
           ?>
           </div>
        <div class="col-md-10" style="padding-left:5%">
                 <div class="card mb-4 wow fadeIn">

        <!--Card content-->
        <div class="card-body d-sm-flex justify-content-between">

          <h4 class="mb-2 mb-sm-0 pt-1">
            <a href="#" target="_blank">Analytics</a>
            <span>/</span>
            <span>Karty obciążeń / Rachunki / Wydział IIZ / <?php echo $_POST['wykladowca_imie']." ".$_POST['wykladowca_nazwisko'];?></span>
          </h4>

          

        </div>

      </div>
              <div class="row wow fadeIn">

        <!--Grid column-->
        <div class="col-md-12 mb-4">

          <!--Card-->
          
     <div class="card">
            <div class="tab-content card">
        
         <div class="card-header text-center" >
             <h4>Wystaw za rok akademicki <?php echo $_POST['rok_akademicki'];?> semestr <?php echo $lz;?></h4>
            </div>
<div class="card-body">
  <?php //print_r($_POST);
  //echo $plan_query;
 // echo $plan_query2;
  //echo $plan_query3;
  $plan=sqlsrv_query($conn,$plan_query2,array(), array( "Scrollable" => 'static'));
  $ile_zajec=sqlsrv_num_rows($plan);
  $plancounter=0;
  do{
      $zajecia=sqlsrv_fetch_array($plan);
      if (!isset($zajecia['ZJE_DATA_OD'])){
      $zajecia['ZJE_DATA_OD']=DateTime::createFromFormat('Y-m-d H:i:s',date('Y-m-d H:i:s'));
      $zajecia['ZJE_DATA_DO']=DateTime::createFromFormat('Y-m-d H:i:s',date('Y-m-d H:i:s'));
      } 
      else {
      $start=$zajecia['ZJE_DATA_OD']->format('Y-m-d H:i:s');
      $stop=$zajecia['ZJE_DATA_DO']->format('Y-m-d H:i:s');
      }
    // echo "$start $stop $zajecia[ZJE_ILOSC_GODZ] $zajecia[GP_ID_SPRZEDMIOT_FORMA]<br/>";
      $plancounter++;
      switch($zajecia['ZJE_DATA_OD']->format('m')) {
          case "01":
              $mc="styczeń";
              break;
          case "02":
              $mc="luty";
              break;
          case "03":
              $mc="marzec";
              break;
          case "04":
              $mc="kwiecień";
              break;
          case "05":
              $mc="maj";
              break;
          case "06":
              $mc="czerwiec";
              break;
          case "07":
              $mc="lipiec";
              break;
          case "08":
              $mc="sierpień";
              break;
          case "09":
              $mc="wrzesień";
              break;
          case "10":
              $mc="październik";
              break;
          case "11":
              $mc="listopad";
              break;
          case "12":
              $mc="grudzień";
              break;
      }
      $przedmiot=mysqli_fetch_array(mysqli_query($kon,
              "SELECT `przedmiot`,`forma_przedmiotu`,`kierunek`,`typ`,`rodzaj`,`nr_semestru` FROM `karta_obciazen` WHERE `ID_S_PRZEDMIOT_FORMA`='$zajecia[GP_ID_SPRZEDMIOT_FORMA]' AND `WYDZIAL`='$_POST[wydzial]'"));
      if(strlen($przedmiot['przedmiot'])>0){
      $rachunki[]=array(
          "start"=>$zajecia['ZJE_DATA_OD']->format('Y-m-d H:i:s'),
          "rok"=>$zajecia['ZJE_DATA_OD']->format('Y'),
          "miesiac"=>$mc,
          "imie"=>$zajecia['OS_IMIE_I'],
          "nazwisko"=>$zajecia['OS_NAZWISKO'],
          "godziny"=>$zajecia['ZJE_ILOSC_GODZ'],
          "przedmiot"=>$przedmiot['przedmiot'],
          "forma"=>$przedmiot['forma_przedmiotu'],
          "kierunek"=>$przedmiot['kierunek'],
          "typ"=>$przedmiot['typ'],
          "rodzaj"=>$przedmiot['rodzaj'],
          "semestr"=>$przedmiot['nr_semestru']
            );
      }
      else {echo "";}
      unset($start);
      unset($stop);
  }
  while($plancounter<$ile_zajec);
   foreach($rachunki as $rachunek){
       switch($miesiac){
    default:
       
       $qd="DELETE FROM `rach_elementy` WHERE `rok`='$rachunek[rok]' AND `miesiac`='$rachunek[miesiac]' "
               . "AND `imie`='$rachunek[imie]' AND `nazwisko`='$rachunek[nazwisko]' AND `godziny`='$rachunek[godziny]' "
               . "AND `przedmiot`='$rachunek[przedmiot]' AND `forma`='$rachunek[forma]' AND `kierunek`='$rachunek[kierunek]'"
               . " AND `typ`='$rachunek[typ]' AND `rodzaj`='$rachunek[rodzaj]' AND `semestr`='$rachunek[semestr]' AND `start`='$rachunek[start]'";
        break;
        case "styczeń":
        case "luty":
        case "marzec":
        case "kwiecień":
        case "maj":
        case "czerwiec":
         case "lipiec":
            $rokplus=$rachunek[rok]+1;
            $qd="DELETE FROM `rach_elementy` WHERE `rok`='$rokplus' AND `miesiac`='$rachunek[miesiac]' "
               . "AND `imie`='$rachunek[imie]' AND `nazwisko`='$rachunek[nazwisko]' AND `godziny`='$rachunek[godziny]' "
               . "AND `przedmiot`='$rachunek[przedmiot]' AND `forma`='$rachunek[forma]' AND `kierunek`='$rachunek[kierunek]'"
               . " AND `typ`='$rachunek[typ]' AND `rodzaj`='$rachunek[rodzaj]' AND `semestr`='$rachunek[semestr]' AND `start`='$rachunek[start]'";
        break;
}
      $qi="INSERT INTO `rach_elementy` (`rok`,`miesiac`,`imie`,`nazwisko`,`godziny`,`przedmiot`,`forma`,
          `kierunek`,`typ`,`rodzaj`,`start`,`semestr`) VALUES ('$rachunek[rok]','$rachunek[miesiac]','$rachunek[imie]',
              '$rachunek[nazwisko]','$rachunek[godziny]','$rachunek[przedmiot]','$rachunek[forma]',
                  '$rachunek[kierunek]','$rachunek[typ]','$rachunek[rodzaj]','$rachunek[start]','$rachunek[semestr]')";
      mysqli_query($kon,$qd);
      mysqli_query($kon,$qi);
   }
   //generowanie rachunków za kolejne miesiące
  
   switch($_POST['semestr_ZL']){
    case 0:
        //zimowy
        $rachunki_10=mysqli_query($kon,"SELECT * FROM `rach_elementy` WHERE `rok`='$_POST[rok_akademicki]' "
                . "AND `start`>'$datastart' AND `start`<'$datastop' AND `imie`='$_POST[wykladowca_imie]' "
                . "AND `nazwisko`='$_POST[wykladowca_nazwisko]' AND `miesiac`='październik'");
        $rachunki_11=mysqli_query($kon,"SELECT * FROM `rach_elementy` WHERE `rok`='$_POST[rok_akademicki]' "
                . "AND `start`>'$datastart' AND `start`<'$datastop' AND `imie`='$_POST[wykladowca_imie]' "
                . "AND `nazwisko`='$_POST[wykladowca_nazwisko]' AND `miesiac`='listopad'");
        $rachunki_12=mysqli_query($kon,"SELECT * FROM `rach_elementy` WHERE `rok`='$_POST[rok_akademicki]' "
                . "AND `start`>'$datastart' AND `start`<'$datastop' AND `imie`='$_POST[wykladowca_imie]' "
                . "AND `nazwisko`='$_POST[wykladowca_nazwisko]' AND `miesiac`='grudzień'");
        $rachunki_01=mysqli_query($kon,"SELECT * FROM `rach_elementy` WHERE `rok`='$_POST[rok_akademicki]' "
                . "AND `start`>'$datastart' AND `start`<'$datastop' AND `imie`='$_POST[wykladowca_imie]' "
                . "AND `nazwisko`='$_POST[wykladowca_nazwisko]' AND `miesiac`='styczeń'");
        $rachunki_02=mysqli_query($kon,"SELECT * FROM `rach_elementy` WHERE `rok`='$_POST[rok_akademicki]' "
                . "AND `start`>'$datastart' AND `start`<'$datastop' AND `imie`='$_POST[wykladowca_imie]' "
                . "AND `nazwisko`='$_POST[wykladowca_nazwisko]' AND `miesiac`='luty'");
        $rachunki_03=mysqli_query($kon,"SELECT * FROM `rach_elementy` WHERE `rok`='$_POST[rok_akademicki]' "
                . "AND `start`>'$datastart' AND `start`<'$datastop' AND `imie`='$_POST[wykladowca_imie]' "
                . "AND `nazwisko`='$_POST[wykladowca_nazwisko]' AND `miesiac`='marzec'");
        ?>
    <!--menu rachunków zimowy--> 
    <a class="btn btn-warning" href="#" data-toggle="modal" data-target="#october">Październik</a> 
    <a class="btn btn-secondary" href="#" data-toggle="modal" data-target="#november">Listopad</a>
    <a class="btn btn-light" href="#" data-toggle="modal" data-target="#december">Grudzień</a>
    <a class="btn btn-info" href="#" data-toggle="modal" data-target="#january">Styczeń</a>
    <a class="btn btn-primary" href="#" href="#" data-toggle="modal" data-target="#ferbuary">Luty</a>
    <?php
        break;
     case 1:
        //letni
        $rachunki_04=mysqli_query($kon,"SELECT * FROM `rach_elementy` WHERE `rok`='$_POST[rok_akademicki]' "
                . "AND `start`>'$datastart' AND `start`<'$datastop' AND `imie`='$_POST[wykladowca_imie]' "
                . "AND `nazwisko`='$_POST[wykladowca_nazwisko]' AND `miesiac`='kwiecień'");
        $rachunki_05=mysqli_query($kon,"SELECT * FROM `rach_elementy` WHERE `rok`='$_POST[rok_akademicki]' "
                . "AND `start`>'$datastart' AND `start`<'$datastop' AND `imie`='$_POST[wykladowca_imie]' "
                . "AND `nazwisko`='$_POST[wykladowca_nazwisko]' AND `miesiac`='maj'");
        $rachunki_06=mysqli_query($kon,"SELECT * FROM `rach_elementy` WHERE `rok`='$_POST[rok_akademicki]' "
                . "AND `start`>'$datastart' AND `start`<'$datastop' AND `imie`='$_POST[wykladowca_imie]' "
                . "AND `nazwisko`='$_POST[wykladowca_nazwisko]' AND `miesiac`='czerwiec'");
        $rachunki_07=mysqli_query($kon,"SELECT * FROM `rach_elementy` WHERE `rok`='$_POST[rok_akademicki]' "
                . "AND `start`>'$datastart' AND `start`<'$datastop' AND `imie`='$_POST[wykladowca_imie]' "
                . "AND `nazwisko`='$_POST[wykladowca_nazwisko]' AND `miesiac`='lipiec'");
        $rachunki_08=mysqli_query($kon,"SELECT * FROM `rach_elementy` WHERE `rok`='$_POST[rok_akademicki]' "
                . "AND `start`>'$datastart' AND `start`<'$datastop' AND `imie`='$_POST[wykladowca_imie]' "
                . "AND `nazwisko`='$_POST[wykladowca_nazwisko]' AND `miesiac`='sierpień'");
        $rachunki_09=mysqli_query($kon,"SELECT * FROM `rach_elementy` WHERE `rok`='$_POST[rok_akademicki]' "
                . "AND `start`>'$datastart' AND `start`<'$datastop' AND `imie`='$_POST[wykladowca_imie]' "
                . "AND `nazwisko`='$_POST[wykladowca_nazwisko]' AND `miesiac`='wrzesień'");
        ?>
     <!--menu rachunków letni--> 
        <a class="btn btn-success" href="#">Marzec</a> <a class="btn btn-dark-green" href="#">Kwiecień</a><a class="btn btn-pink" href="#">Maj</a>
    <a class="btn btn-unique" href="#">Czerwiec</a><a class="btn btn-amber" href="#">Lipiec</a>
    <?php
        break;
    
   }
   //RACH
   ?>
<div class="modal fade right" id="october" tabindex="-1" role="dialog" aria-labelledby="octoberLabel"
  aria-hidden="true">

  <!-- Add class .modal-full-height and then add class .modal-right (or other classes from list above) to set a position to the modal -->
  <div class="modal-dialog modal-lg modal-full-height modal-right" role="document">


    <div class="modal-content">
    
      <div class="modal-body">
      <div class="card">

    <h5 class="card-header info-color white-text text-center py-4">
        <strong>Dane do rachunku <?php echo "$_POST[wykladowca_imie] $_POST[wykladowca_nazwisko]";?></strong>
    </h5>

    <!--Card content-->
    <div class="card-body px-lg-5">
<?php $tyt_zaw=mysqli_fetch_array(mysqli_query($kon,"SELECT `wykladowca_tytul` FROM `karta_obciazen` WHERE `wykladowca_nazwisko`='$_POST[wykladowca_nazwisko]' AND "
        . "`wykladowca_imie`='$_POST[wykladowca_imie]' AND `wykladowca_tytul`<>'' ORDER BY `id` DESC"));
?>
        <!-- Form -->
        <form class="text-center" style="color: #757575;" action="controller/gen_rachunek.php" method="POST">
            <input type="hidden" name="rok_akademicki" value="<?php echo $_POST['rok_akademicki'];?>"/>
            <input type="hidden" name="semestr_ZL" value="<?php echo $_POST['semestr_ZL'];?>"/>
             <input type="hidden" name="wykladowca_imie" value="<?php echo $_POST['wykladowca_imie'];?>"/>
             <input type="hidden" name="wykladowca_nazwisko" value="<?php echo $_POST['wykladowca_nazwisko'];?>"/><input type="hidden" name="wydzial" value="2"/>
            <div class="row"><div class="col-md-6">
            <div class="md-form mt-3">
                <input type="text" id="materialSubscriptionFormPasswords" class="form-control" name="data" value="<?php echo date('Y-m-d');?>">
                <label for="materialSubscriptionFormPasswords">Data rachunku</label>
            </div></div><div class="col-md-6">
            <div class="md-form mt-3">
                <input type="text" id="materialSubscriptionFormPasswords" class="form-control" name="pesel" value="<?php echo $zajecia['OS_PESEL'];?>">
                <label for="materialSubscriptionFormPasswords">Pesel</label>
            </div>
            </div></div>
             <div class="row"><div class="col-md-6">
            <div class="md-form">
                <input type="text" id="materialSubscriptionFormEmail" class="form-control" name="tyt_zawodowy" value="<?php echo $tyt_zaw[0];?>">
                <label for="materialSubscriptionFormEmail">Tytuł zawodowy</label>
            </div></div><div class="col-md-6">
            <div class="md-form">
                <input type="text" id="materialSubscriptionFormEmail" class="form-control" name="miesiac" value="Październik">
                <label for="materialSubscriptionFormEmail">Miesiąc</label>
            </div></div></div>
            <div id="table" class="table-editable">
            <table class="table table-bordered table-sm table-condensed" >
                <span class="table-add float-right mb-3 mr-2"><a href="#!" class="text-success">
                        <i class="far fa-plus-square green-text fa-2x"></i></a></span>
                <tr> <th rowspan="2">USUŃ</th>
            <th rowspan="2" style="font-size:0.8em;" id="liczba" style="width:2rem;">L.P.</th>
            <th rowspan="2" style="font-size:0.8em;">Symbol studiów</th>
            <th rowspan="2" style="font-size:0.8em;">Przedmiot</th>
          
            <th  colspan="5" style="font-size:0.8em;">Liczba</th>
            <!--<th rowspan="2" style="font-size:0.8em;">Razem</th>--></tr>
        <tr>
            <th style="width:2.5rem; font-size:0.7em;">w</th><th style="width:2.5rem;">ć</th><th style="width:2.5rem;">l</th><th style="width:2.5rem;">p</th><th style="width:2.5rem;">s</th></tr>
        <tbody class="tbody">
                <?php 
                $obciazenia=mysqli_query($kon,"SELECT DISTINCT `przedmiot`,`forma`,`kierunek`,`typ`,`rodzaj`,`semestr` FROM `rach_elementy` "
                        . "WHERE `miesiac`='październik' AND `rok`='$_POST[rok_akademicki]' AND `nazwisko`='$_POST[wykladowca_nazwisko]' AND `imie`='$_POST[wykladowca_imie]'");
                $lp=1;
                foreach($obciazenia as $obciazenie){
                    $labs=mysqli_fetch_array(mysqli_query($kon,"SELECT SUM(`godziny`) FROM `rach_elementy` "
                            . "WHERE `forma`='Lab.' AND `miesiac`='październik' AND `rok`='$_POST[rok_akademicki]' AND `nazwisko`='$_POST[wykladowca_nazwisko]' AND `imie`='$_POST[wykladowca_imie]' "
                            . "AND `przedmiot`='$obciazenie[przedmiot]' AND `typ`='$obciazenie[typ]' AND `kierunek`='$obciazenie[kierunek]' AND `forma`='$obciazenie[forma]' "
                            . "AND `semestr`='$obciazenie[semestr]' AND `rodzaj`='$obciazenie[rodzaj]' "));
                    $pr=mysqli_fetch_array(mysqli_query($kon,"SELECT SUM(`godziny`) FROM `rach_elementy` "
                            . "WHERE `forma`='Projekt' AND `miesiac`='październik' AND `rok`='$_POST[rok_akademicki]' AND `nazwisko`='$_POST[wykladowca_nazwisko]' AND `imie`='$_POST[wykladowca_imie]' "
                            . "AND `przedmiot`='$obciazenie[przedmiot]' AND `typ`='$obciazenie[typ]' AND `kierunek`='$obciazenie[kierunek]' AND `forma`='$obciazenie[forma]' "
                            . "AND `semestr`='$obciazenie[semestr]' AND `rodzaj`='$obciazenie[rodzaj]' "));
                     $w=mysqli_fetch_array(mysqli_query($kon,"SELECT SUM(`godziny`) FROM `rach_elementy` "
                            . "WHERE `forma`='Wykład' AND `miesiac`='październik' AND `rok`='$_POST[rok_akademicki]' AND `nazwisko`='$_POST[wykladowca_nazwisko]' AND `imie`='$_POST[wykladowca_imie]' "
                            . "AND `przedmiot`='$obciazenie[przedmiot]' AND `typ`='$obciazenie[typ]' AND `kierunek`='$obciazenie[kierunek]' AND `forma`='$obciazenie[forma]' "
                            . "AND `semestr`='$obciazenie[semestr]' AND `rodzaj`='$obciazenie[rodzaj]' "));
                     $c=mysqli_fetch_array(mysqli_query($kon,"SELECT SUM(`godziny`) FROM `rach_elementy` "
                            . "WHERE `forma`='Ćwiczenia' AND `miesiac`='październik' AND `rok`='$_POST[rok_akademicki]' AND `nazwisko`='$_POST[wykladowca_nazwisko]' AND `imie`='$_POST[wykladowca_imie]' "
                            . "AND `przedmiot`='$obciazenie[przedmiot]' AND `typ`='$obciazenie[typ]' AND `kierunek`='$obciazenie[kierunek]' AND `forma`='$obciazenie[forma]' "
                            . "AND `semestr`='$obciazenie[semestr]' AND `rodzaj`='$obciazenie[rodzaj]' "));
                    echo "<tr><td><span class=\"table-remove\"><!--<button type=\"button\" "
                     . "class=\"btn btn-danger btn-rounded btn-sm my-0\"> - </button></span>-->"
                            . "<i class=\"far fa-trash-alt red-text\"></i></span></td><td>$lp</td>"
                            . "<td contenteditable=\"true\" id=\"przyn_$lp]\">$obciazenie[kierunek] $obciazenie[typ] $obciazenie[rodzaj] sem. $obciazenie[semestr]</td>"
                            . "<td contenteditable=\"true\" id=\"przed_$lp]\">$obciazenie[przedmiot]</td>"
                            . "<td contenteditable=\"true\" id=\"wyk_$lp]\">$w[0]</td>"
                            . "<td contenteditable=\"true\" id=\"cw_$lp]\">$c[0]</td>"
                            . "<td contenteditable=\"true\" id=\"lab_$lp]\">$labs[0]</td>"
                            . "<td contenteditable=\"true\" id=\"pr_$lp]\">$pr[0]</td>"
                            . "<td contenteditable=\"true\" id=\"s_$lp]\"></td>"
                            . "<!--<td contenteditable=\"true\">". $w[0]+$c[0]+$labs[0]+$pr[0] ."</td>--></tr>";
                    $lp++;
                    $larray[]=$labs[0];
                    $prarray[]=$pr[0];
                    $warray[]=$w[0];
                    $carray[]=$c[0];
                }
            ?>
         
        <!--<tr><<td colspan="3"><td><?php echo array_sum($warray);?></td><td><?php echo array_sum($carray);?></td><td><?php echo array_sum($larray);?></td>
            <td><?php echo array_sum($prarray);?></td><td></td><td><?php echo array_sum($warray)+array_sum($carray)+array_sum($larray)+array_sum($prarray);?></td></tr>-->
        </tbody> </table></div><hr/>
            <?php unset($larray);
                  unset($prarray);
                  unset($warray);
                  unset($carray);
                  unset($labs);
                  unset($pr);
                  unset($w);
                  unset($c);
                  ?>
            <div id="formAppend"></div>
            <div class="row"><div class="col-md-4"> <button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button></div>
                <div class="col-md-8"><button class="btn btn-indigo btn-block my-1 waves-effect" onclick="GetCellValues();" type="submit">ZAPISZ</button></div></div>

        </form>
        <!-- Form -->

    </div>

</div>
      </div>
     
    </div>
  </div>
</div>
    <!--Listopad-->
    <div class="modal fade right" id="november" tabindex="-1" role="dialog" aria-labelledby="novemberLabel"
  aria-hidden="true">

  <!-- Add class .modal-full-height and then add class .modal-right (or other classes from list above) to set a position to the modal -->
  <div class="modal-dialog modal-lg modal-full-height modal-right" role="document">


    <div class="modal-content">
    
      <div class="modal-body">
      <div class="card">

    <h5 class="card-header info-color white-text text-center py-4">
        <strong>Dane do rachunku <?php echo "$_POST[wykladowca_imie] $_POST[wykladowca_nazwisko]";?></strong>
    </h5>

    <!--Card content-->
    <div class="card-body px-lg-5">
<?php $tyt_zaw=mysqli_fetch_array(mysqli_query($kon,"SELECT `wykladowca_tytul` FROM `karta_obciazen` WHERE `wykladowca_nazwisko`='$_POST[wykladowca_nazwisko]' AND "
        . "`wykladowca_imie`='$_POST[wykladowca_imie]' AND `wykladowca_tytul`<>'' ORDER BY `id` DESC"));
?>
        <!-- Form -->
        <form class="text-center" style="color: #757575;" action="controller/gen_rachunek.php" method="POST">
            <input type="hidden" name="rok_akademicki" value="<?php echo $_POST['rok_akademicki'];?>"/>
            <input type="hidden" name="semestr_ZL" value="<?php echo $_POST['semestr_ZL'];?>"/>
             <input type="hidden" name="wykladowca_imie" value="<?php echo $_POST['wykladowca_imie'];?>"/>
             <input type="hidden" name="wykladowca_nazwisko" value="<?php echo $_POST['wykladowca_nazwisko'];?>"/><input type="hidden" name="wydzial" value="2"/>
            <div class="row"><div class="col-md-6">
            <div class="md-form mt-3">
                <input type="text" id="materialSubscriptionFormPasswords2" class="form-control" name="data" value="<?php echo date('Y-m-d');?>">
                <label for="materialSubscriptionFormPasswords2">Data rachunku</label>
            </div></div><div class="col-md-6">
            <div class="md-form mt-3">
                <input type="text" id="materialSubscriptionFormPasswords22" class="form-control" name="pesel" value="<?php echo $zajecia['OS_PESEL'];?>">
                <label for="materialSubscriptionFormPasswords22">Pesel</label>
            </div>
            </div></div>
             <div class="row"><div class="col-md-6">
            <div class="md-form">
                <input type="text" id="materialSubscriptionFormEmail2" class="form-control" name="tyt_zawodowy" value="<?php echo $tyt_zaw[0];?>">
                <label for="materialSubscriptionFormEmail2">Tytuł zawodowy</label>
            </div></div><div class="col-md-6">
            <div class="md-form">
                <input type="text" id="materialSubscriptionFormEmail22" class="form-control" name="miesiac" value="Listopad">
                <label for="materialSubscriptionFormEmail22">Miesiąc</label>
            </div></div></div>
            <div id="table2" class="table-editable">
                <?php unset($larray);
                  unset($prarray);
                  unset($warray);
                  unset($carray);
                  unset($labs);
                  unset($pr);
                  unset($w);
                  unset($c);
                  ?>
            <table class="table table-bordered table-sm table-condensed" >
                <span class="table-add2 float-right mb-3 mr-2"><a href="#!" class="text-success">
                        <i class="far fa-plus-square green-text fa-2x"></i></a></span>
                <tr> <th rowspan="2">USUŃ</th>
            <th rowspan="2" style="font-size:0.8em;" id="liczba2" style="width:2rem;">L.P.</th>
            <th rowspan="2" style="font-size:0.8em;">Symbol studiów</th>
            <th rowspan="2" style="font-size:0.8em;">Przedmiot</th>
          
            <th  colspan="5" style="font-size:0.8em;">Liczba</th>
            <!--<th rowspan="2" style="font-size:0.8em;">Razem</th>--></tr>
        <tr>
            <th style="width:2.5rem; font-size:0.7em;">w</th><th style="width:2.5rem;">ć</th><th style="width:2.5rem;">l</th><th style="width:2.5rem;">p</th><th style="width:2.5rem;">s</th></tr>
             <tbody class="tbody2">
                <?php 
                $obciazenia=mysqli_query($kon,"SELECT DISTINCT `przedmiot`,`forma`,`kierunek`,`typ`,`rodzaj`,`semestr` FROM `rach_elementy` "
                        . "WHERE `miesiac`='listopad' AND `rok`='$_POST[rok_akademicki]' AND `nazwisko`='$_POST[wykladowca_nazwisko]' AND `imie`='$_POST[wykladowca_imie]'");
                $lp2=1;
                foreach($obciazenia as $obciazenie){
                    $labs=mysqli_fetch_array(mysqli_query($kon,"SELECT SUM(`godziny`) FROM `rach_elementy` "
                            . "WHERE `forma`='Lab.' AND `miesiac`='listopad' AND `rok`='$_POST[rok_akademicki]' AND `nazwisko`='$_POST[wykladowca_nazwisko]' AND `imie`='$_POST[wykladowca_imie]' "
                            . "AND `przedmiot`='$obciazenie[przedmiot]' AND `typ`='$obciazenie[typ]' AND `kierunek`='$obciazenie[kierunek]' AND `forma`='$obciazenie[forma]' "
                            . "AND `semestr`='$obciazenie[semestr]' AND `rodzaj`='$obciazenie[rodzaj]' "));
                    $pr=mysqli_fetch_array(mysqli_query($kon,"SELECT SUM(`godziny`) FROM `rach_elementy` "
                            . "WHERE `forma`='Projekt' AND `miesiac`='listopad' AND `rok`='$_POST[rok_akademicki]' AND `nazwisko`='$_POST[wykladowca_nazwisko]' AND `imie`='$_POST[wykladowca_imie]' "
                            . "AND `przedmiot`='$obciazenie[przedmiot]' AND `typ`='$obciazenie[typ]' AND `kierunek`='$obciazenie[kierunek]' AND `forma`='$obciazenie[forma]' "
                            . "AND `semestr`='$obciazenie[semestr]' AND `rodzaj`='$obciazenie[rodzaj]' "));
                     $w=mysqli_fetch_array(mysqli_query($kon,"SELECT SUM(`godziny`) FROM `rach_elementy` "
                            . "WHERE `forma`='Wykład' AND `miesiac`='listopad' AND `rok`='$_POST[rok_akademicki]' AND `nazwisko`='$_POST[wykladowca_nazwisko]' AND `imie`='$_POST[wykladowca_imie]' "
                            . "AND `przedmiot`='$obciazenie[przedmiot]' AND `typ`='$obciazenie[typ]' AND `kierunek`='$obciazenie[kierunek]' AND `forma`='$obciazenie[forma]' "
                            . "AND `semestr`='$obciazenie[semestr]' AND `rodzaj`='$obciazenie[rodzaj]' "));
                     $c=mysqli_fetch_array(mysqli_query($kon,"SELECT SUM(`godziny`) FROM `rach_elementy` "
                            . "WHERE `forma`='Ćwiczenia' AND `miesiac`='listopad' AND `rok`='$_POST[rok_akademicki]' AND `nazwisko`='$_POST[wykladowca_nazwisko]' AND `imie`='$_POST[wykladowca_imie]' "
                            . "AND `przedmiot`='$obciazenie[przedmiot]' AND `typ`='$obciazenie[typ]' AND `kierunek`='$obciazenie[kierunek]' AND `forma`='$obciazenie[forma]' "
                            . "AND `semestr`='$obciazenie[semestr]' AND `rodzaj`='$obciazenie[rodzaj]' "));
                    echo "<tr><td><span class=\"table-remove2\"><!--<button type=\"button\" "
                     . "class=\"btn btn-danger btn-rounded btn-sm my-0\"> - </button></span>-->"
                            . "<i class=\"far fa-trash-alt red-text\"></i></span></td><td>$lp2</td>"
                            . "<td contenteditable=\"true\" id=\"przyn2_$lp2\">$obciazenie[kierunek] $obciazenie[typ] $obciazenie[rodzaj] sem. $obciazenie[semestr]</td>"
                            . "<td contenteditable=\"true\" id=\"przed2_$lp2>\">$obciazenie[przedmiot]</td>"
                            . "<td contenteditable=\"true\" id=\"wyk2_$lp2]\">$w[0]</td>"
                            . "<td contenteditable=\"true\" id=\"cw2_$lp2\">$c[0]</td>"
                            . "<td contenteditable=\"true\" id=\"lab2_$lp2\">$labs[0]</td>"
                            . "<td contenteditable=\"true\" id=\"pr2_$lp2\">$pr[0]</td>"
                            . "<td contenteditable=\"true\" id=\"s2_$lp2\"></td>"
                            . "<!--<td contenteditable=\"true\">". $w[0]+$c[0]+$labs[0]+$pr[0] ."</td>--></tr>";
                    $lp2++;
                    $larray[]=$labs[0];
                    $prarray[]=$pr[0];
                    $warray[]=$w[0];
                    $carray[]=$c[0];
                }
            ?>
         
        <!--<tr><<td colspan="3"><td><?php echo array_sum($warray);?></td><td><?php echo array_sum($carray);?></td><td><?php echo array_sum($larray);?></td>
            <td><?php echo array_sum($prarray);?></td><td></td><td><?php echo array_sum($warray)+array_sum($carray)+array_sum($larray)+array_sum($prarray);?></td></tr>-->
             </tbody> </table></div><hr/>
            <?php unset($larray);
                  unset($prarray);
                  unset($warray);
                  unset($carray);
                  unset($labs);
                  unset($pr);
                  unset($w);
                  unset($c);
                  ?>
            <div id="formAppend2"></div>
            <div class="row"><div class="col-md-4"> <button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button></div>
                <div class="col-md-8"><button class="btn btn-indigo btn-block my-1 waves-effect" onclick="GetCellValues2();" type="submit">ZAPISZ</button></div></div>

        </form>
        <!-- Form -->

    </div>

</div>
      </div>
     
    </div>
  </div>
</div>
    <!--Grudzień-->
    <div class="modal fade right" id="december" tabindex="-1" role="dialog" aria-labelledby="decemberLabel"
  aria-hidden="true">

  <!-- Add class .modal-full-height and then add class .modal-right (or other classes from list above) to set a position to the modal -->
  <div class="modal-dialog modal-lg modal-full-height modal-right" role="document">


    <div class="modal-content">
    
      <div class="modal-body">
      <div class="card">

    <h5 class="card-header info-color white-text text-center py-4">
        <strong>Dane do rachunku <?php echo "$_POST[wykladowca_imie] $_POST[wykladowca_nazwisko]";?></strong>
    </h5>

    <!--Card content-->
    <div class="card-body px-lg-5">
<?php $tyt_zaw=mysqli_fetch_array(mysqli_query($kon,"SELECT `wykladowca_tytul` FROM `karta_obciazen` WHERE `wykladowca_nazwisko`='$_POST[wykladowca_nazwisko]' AND "
        . "`wykladowca_imie`='$_POST[wykladowca_imie]' AND `wykladowca_tytul`<>'' ORDER BY `id` DESC"));
?>
        <!-- Form -->
        <form class="text-center" style="color: #757575;" action="controller/gen_rachunek.php" method="POST">
            <input type="hidden" name="rok_akademicki" value="<?php echo $_POST['rok_akademicki'];?>"/>
            <input type="hidden" name="semestr_ZL" value="<?php echo $_POST['semestr_ZL'];?>"/>
             <input type="hidden" name="wykladowca_imie" value="<?php echo $_POST['wykladowca_imie'];?>"/>
             <input type="hidden" name="wykladowca_nazwisko" value="<?php echo $_POST['wykladowca_nazwisko'];?>"/><input type="hidden" name="wydzial" value="2"/>
            <div class="row"><div class="col-md-6">
            <div class="md-form mt-3">
                <input type="text" id="materialSubscriptionFormPasswords3" class="form-control" name="data" value="<?php echo date('Y-m-d');?>">
                <label for="materialSubscriptionFormPasswords3">Data rachunku</label>
            </div></div><div class="col-md-6">
            <div class="md-form mt-3">
                <input type="text" id="materialSubscriptionFormPasswords32" class="form-control" name="pesel" value="<?php echo $zajecia['OS_PESEL'];?>">
                <label for="materialSubscriptionFormPasswords32">Pesel</label>
            </div>
            </div></div>
             <div class="row"><div class="col-md-6">
            <div class="md-form">
                <input type="text" id="materialSubscriptionFormEmail3" class="form-control" name="tyt_zawodowy" value="<?php echo $tyt_zaw[0];?>">
                <label for="materialSubscriptionFormEmail3">Tytuł zawodowy</label>
            </div></div><div class="col-md-6">
            <div class="md-form">
                <input type="text" id="materialSubscriptionFormEmail32" class="form-control" name="miesiac" value="Grudzień">
                <label for="materialSubscriptionFormEmail32">Miesiąc</label>
            </div></div></div>
            <div id="table3" class="table-editable">
            <table class="table table-bordered table-sm table-condensed" >
                <?php unset($larray);
                  unset($prarray);
                  unset($warray);
                  unset($carray);
                  unset($labs);
                  unset($pr);
                  unset($w);
                  unset($c);
                  ?>
                <span class="table-add3 float-right mb-3 mr-2"><a href="#!" class="text-success">
                        <i class="far fa-plus-square green-text fa-2x"></i></a></span>
                <tr> <th rowspan="2">USUŃ</th>
            <th rowspan="2" style="font-size:0.8em;" id="liczba3" style="width:2rem;">L.P.</th>
            <th rowspan="2" style="font-size:0.8em;">Symbol studiów</th>
            <th rowspan="2" style="font-size:0.8em;">Przedmiot</th>
          
            <th  colspan="5" style="font-size:0.8em;">Liczba</th>
            <!--<th rowspan="2" style="font-size:0.8em;">Razem</th>--></tr>
        <tr>
            <th style="width:2.5rem; font-size:0.7em;">w</th><th style="width:2.5rem;">ć</th><th style="width:2.5rem;">l</th><th style="width:2.5rem;">p</th><th style="width:2.5rem;">s</th></tr>
    <tbody class="tbody3">           
    <?php 
                $obciazenia=mysqli_query($kon,"SELECT DISTINCT `przedmiot`,`forma`,`kierunek`,`typ`,`rodzaj`,`semestr` FROM `rach_elementy` "
                        . "WHERE `miesiac`='grudzień' AND `rok`='$_POST[rok_akademicki]' AND `nazwisko`='$_POST[wykladowca_nazwisko]' AND `imie`='$_POST[wykladowca_imie]'");
                $lp3=1;
                foreach($obciazenia as $obciazenie){
                    $labs=mysqli_fetch_array(mysqli_query($kon,"SELECT SUM(`godziny`) FROM `rach_elementy` "
                            . "WHERE `forma`='Lab.' AND `miesiac`='grudzień' AND `rok`='$_POST[rok_akademicki]' AND `nazwisko`='$_POST[wykladowca_nazwisko]' AND `imie`='$_POST[wykladowca_imie]' "
                            . "AND `przedmiot`='$obciazenie[przedmiot]' AND `typ`='$obciazenie[typ]' AND `kierunek`='$obciazenie[kierunek]' AND `forma`='$obciazenie[forma]' "
                            . "AND `semestr`='$obciazenie[semestr]' AND `rodzaj`='$obciazenie[rodzaj]' "));
                    $pr=mysqli_fetch_array(mysqli_query($kon,"SELECT SUM(`godziny`) FROM `rach_elementy` "
                            . "WHERE `forma`='Projekt' AND `miesiac`='grudzień' AND `rok`='$_POST[rok_akademicki]' AND `nazwisko`='$_POST[wykladowca_nazwisko]' AND `imie`='$_POST[wykladowca_imie]' "
                            . "AND `przedmiot`='$obciazenie[przedmiot]' AND `typ`='$obciazenie[typ]' AND `kierunek`='$obciazenie[kierunek]' AND `forma`='$obciazenie[forma]' "
                            . "AND `semestr`='$obciazenie[semestr]' AND `rodzaj`='$obciazenie[rodzaj]' "));
                     $w=mysqli_fetch_array(mysqli_query($kon,"SELECT SUM(`godziny`) FROM `rach_elementy` "
                            . "WHERE `forma`='Wykład' AND `miesiac`='grudzień' AND `rok`='$_POST[rok_akademicki]' AND `nazwisko`='$_POST[wykladowca_nazwisko]' AND `imie`='$_POST[wykladowca_imie]' "
                            . "AND `przedmiot`='$obciazenie[przedmiot]' AND `typ`='$obciazenie[typ]' AND `kierunek`='$obciazenie[kierunek]' AND `forma`='$obciazenie[forma]' "
                            . "AND `semestr`='$obciazenie[semestr]' AND `rodzaj`='$obciazenie[rodzaj]' "));
                     $c=mysqli_fetch_array(mysqli_query($kon,"SELECT SUM(`godziny`) FROM `rach_elementy` "
                            . "WHERE `forma`='Ćwiczenia' AND `miesiac`='grudzień' AND `rok`='$_POST[rok_akademicki]' AND `nazwisko`='$_POST[wykladowca_nazwisko]' AND `imie`='$_POST[wykladowca_imie]' "
                            . "AND `przedmiot`='$obciazenie[przedmiot]' AND `typ`='$obciazenie[typ]' AND `kierunek`='$obciazenie[kierunek]' AND `forma`='$obciazenie[forma]' "
                            . "AND `semestr`='$obciazenie[semestr]' AND `rodzaj`='$obciazenie[rodzaj]' "));
                    echo "<tr><td><span class=\"table-remove3\"><!--<button type=\"button\" "
                     . "class=\"btn btn-danger btn-rounded btn-sm my-0\"> - </button></span>-->"
                            . "<i class=\"far fa-trash-alt red-text\"></i></span></td><td>$lp3</td>"
                            . "<td contenteditable=\"true\" id=\"przyn3_$lp3\">$obciazenie[kierunek] $obciazenie[typ] $obciazenie[rodzaj] sem. $obciazenie[semestr]</td>"
                            . "<td contenteditable=\"true\" id=\"przed3_$lp3\">$obciazenie[przedmiot]</td>"
                            . "<td contenteditable=\"true\" id=\"wyk3_$lp3\">$w[0]</td>"
                            . "<td contenteditable=\"true\" id=\"cw3_$lp3\">$c[0]</td>"
                            . "<td contenteditable=\"true\" id=\"lab3_$lp3\">$labs[0]</td>"
                            . "<td contenteditable=\"true\" id=\"pr3_$lp3\">$pr[0]</td>"
                            . "<td contenteditable=\"true\" id=\"s3_$lp3\"></td>"
                            . "<!--<td contenteditable=\"true\">". $w[0]+$c[0]+$labs[0]+$pr[0] ."</td>--></tr>";
                    $lp3++;
                    $larray[]=$labs[0];
                    $prarray[]=$pr[0];
                    $warray[]=$w[0];
                    $carray[]=$c[0];
                }
            ?>
         
        <!--<tr><<td colspan="3"><td><?php echo array_sum($warray);?></td><td><?php echo array_sum($carray);?></td><td><?php echo array_sum($larray);?></td>
            <td><?php echo array_sum($prarray);?></td><td></td><td><?php echo array_sum($warray)+array_sum($carray)+array_sum($larray)+array_sum($prarray);?></td></tr>-->
    </tbody></table></div><hr/>
            <?php unset($larray);
                  unset($prarray);
                  unset($warray);
                  unset($carray);
                  unset($labs);
                  unset($pr);
                  unset($w);
                  unset($c);
                  ?>
            <div id="formAppend3"></div>
            <div class="row"><div class="col-md-4"> <button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button></div>
                <div class="col-md-8"><button class="btn btn-indigo btn-block my-1 waves-effect" onclick="GetCellValues3();" type="submit">ZAPISZ</button></div></div>

        </form>
        <!-- Form -->

    </div>

</div>
      </div>
     
    </div>
  </div>
</div>
        <!--Styczeń-->
    <div class="modal fade right" id="january" tabindex="-1" role="dialog" aria-labelledby="januaryLabel"
  aria-hidden="true">

  <!-- Add class .modal-full-height and then add class .modal-right (or other classes from list above) to set a position to the modal -->
  <div class="modal-dialog modal-lg modal-full-height modal-right" role="document">


    <div class="modal-content">
    
      <div class="modal-body">
      <div class="card">

    <h5 class="card-header info-color white-text text-center py-4">
        <strong>Dane do rachunku <?php echo "$_POST[wykladowca_imie] $_POST[wykladowca_nazwisko]";?></strong>
    </h5>

    <!--Card content-->
    <div class="card-body px-lg-5">
<?php $tyt_zaw=mysqli_fetch_array(mysqli_query($kon,"SELECT `wykladowca_tytul` FROM `karta_obciazen` WHERE `wykladowca_nazwisko`='$_POST[wykladowca_nazwisko]' AND "
        . "`wykladowca_imie`='$_POST[wykladowca_imie]' AND `wykladowca_tytul`<>'' ORDER BY `id` DESC"));
?>
        <!-- Form -->
        <form class="text-center" style="color: #757575;" action="controller/gen_rachunek.php" method="POST">
            <input type="hidden" name="rok_akademicki" value="<?php echo $_POST['rok_akademicki'];?>"/>
            <input type="hidden" name="semestr_ZL" value="<?php echo $_POST['semestr_ZL'];?>"/>
             <input type="hidden" name="wykladowca_imie" value="<?php echo $_POST['wykladowca_imie'];?>"/>
             <input type="hidden" name="wykladowca_nazwisko" value="<?php echo $_POST['wykladowca_nazwisko'];?>"/><input type="hidden" name="wydzial" value="2"/>
            <div class="row"><div class="col-md-6">
            <div class="md-form mt-3">
                <input type="text" id="materialSubscriptionFormPasswords4" class="form-control" name="data" value="<?php echo date('Y-m-d');?>">
                <label for="materialSubscriptionFormPasswords4">Data rachunku</label>
            </div></div><div class="col-md-6">
            <div class="md-form mt-3">
                <input type="text" id="materialSubscriptionFormPasswords42" class="form-control" name="pesel" value="<?php echo $zajecia['OS_PESEL'];?>">
                <label for="materialSubscriptionFormPasswords42">Pesel</label>
            </div>
            </div></div>
             <div class="row"><div class="col-md-6">
            <div class="md-form">
                <input type="text" id="materialSubscriptionFormEmail4" class="form-control" name="tyt_zawodowy" value="<?php echo $tyt_zaw[0];?>">
                <label for="materialSubscriptionFormEmail4">Tytuł zawodowy</label>
            </div></div><div class="col-md-6">
            <div class="md-form">
                <input type="text" id="materialSubscriptionFormEmail42" class="form-control" name="miesiac" value="Styczeń">
                <label for="materialSubscriptionFormEmail42">Miesiąc</label>
            </div></div></div>
            <div id="table4" class="table-editable">
                <?php unset($larray);
                  unset($prarray);
                  unset($warray);
                  unset($carray);
                  unset($labs[0]);
                  unset($pr[0]);
                  unset($w[0]);
                  unset($c[0]);
                  ?>
            <table class="table table-bordered table-sm table-condensed" >
                <span class="table-add4 float-right mb-3 mr-2"><a href="#!" class="text-success">
                        <i class="far fa-plus-square green-text fa-2x"></i></a></span>
                <tr> <th rowspan="2">USUŃ</th>
            <th rowspan="2" style="font-size:0.8em;" id="liczba4" style="width:2rem;">L.P.</th>
            <th rowspan="2" style="font-size:0.8em;">Symbol studiów</th>
            <th rowspan="2" style="font-size:0.8em;">Przedmiot</th>
          
            <th  colspan="5" style="font-size:0.8em;">Liczba</th>
            <!--<th rowspan="2" style="font-size:0.8em;">Razem</th>--></tr>
        <tr>
            <th style="width:2.5rem; font-size:0.7em;">w</th><th style="width:2.5rem;">ć</th><th style="width:2.5rem;">l</th><th style="width:2.5rem;">p</th><th style="width:2.5rem;">s</th></tr>
    <tbody class="tbody4">           
    <?php 
                $obciazenia=mysqli_query($kon,"SELECT DISTINCT `przedmiot`,`forma`,`kierunek`,`typ`,`rodzaj`,`semestr` FROM `rach_elementy` "
                        . "WHERE `miesiac`='styczeń' AND `rok`='".$_POST['rok_akademicki']+1 ."' AND `nazwisko`='$_POST[wykladowca_nazwisko]' AND `imie`='$_POST[wykladowca_imie]'");
                $lp4=1;
                foreach($obciazenia as $obciazenie){
                    $labs=mysqli_fetch_array(mysqli_query($kon,"SELECT SUM(`godziny`) FROM `rach_elementy` "
                            . "WHERE `forma`='Lab.' AND `miesiac`='styczeń' AND `rok`='".$_POST['rok_akademicki']+1 ."' AND `nazwisko`='$_POST[wykladowca_nazwisko]' AND `imie`='$_POST[wykladowca_imie]' "
                            . "AND `przedmiot`='$obciazenie[przedmiot]' AND `typ`='$obciazenie[typ]' AND `kierunek`='$obciazenie[kierunek]' AND `forma`='$obciazenie[forma]' "
                            . "AND `semestr`='$obciazenie[semestr]' AND `rodzaj`='$obciazenie[rodzaj]' "));
                    $pr=mysqli_fetch_array(mysqli_query($kon,"SELECT SUM(`godziny`) FROM `rach_elementy` "
                            . "WHERE `forma`='Projekt' AND `miesiac`='styczeń' AND `rok`='".$_POST['rok_akademicki']+1 ."' AND `nazwisko`='$_POST[wykladowca_nazwisko]' AND `imie`='$_POST[wykladowca_imie]' "
                            . "AND `przedmiot`='$obciazenie[przedmiot]' AND `typ`='$obciazenie[typ]' AND `kierunek`='$obciazenie[kierunek]' AND `forma`='$obciazenie[forma]' "
                            . "AND `semestr`='$obciazenie[semestr]' AND `rodzaj`='$obciazenie[rodzaj]' "));
                     $w=mysqli_fetch_array(mysqli_query($kon,"SELECT SUM(`godziny`) FROM `rach_elementy` "
                            . "WHERE `forma`='Wykład' AND `miesiac`='styczeń' AND `rok`='".$_POST['rok_akademicki']+1 ."' AND `nazwisko`='$_POST[wykladowca_nazwisko]' AND `imie`='$_POST[wykladowca_imie]' "
                            . "AND `przedmiot`='$obciazenie[przedmiot]' AND `typ`='$obciazenie[typ]' AND `kierunek`='$obciazenie[kierunek]' AND `forma`='$obciazenie[forma]' "
                            . "AND `semestr`='$obciazenie[semestr]' AND `rodzaj`='$obciazenie[rodzaj]' "));
                     $c=mysqli_fetch_array(mysqli_query($kon,"SELECT SUM(`godziny`) FROM `rach_elementy` "
                            . "WHERE `forma`='Ćwiczenia' AND `miesiac`='styczeń' AND `rok`='".$_POST['rok_akademicki']+1 ."' AND `nazwisko`='$_POST[wykladowca_nazwisko]' AND `imie`='$_POST[wykladowca_imie]' "
                            . "AND `przedmiot`='$obciazenie[przedmiot]' AND `typ`='$obciazenie[typ]' AND `kierunek`='$obciazenie[kierunek]' AND `forma`='$obciazenie[forma]' "
                            . "AND `semestr`='$obciazenie[semestr]' AND `rodzaj`='$obciazenie[rodzaj]' "));
                    echo "<tr><td><span class=\"table-remove4\"><!--<button type=\"button\" "
                     . "class=\"btn btn-danger btn-rounded btn-sm my-0\"> - </button></span>-->"
                            . "<i class=\"far fa-trash-alt red-text\"></i></span></td><td>$lp4</td>"
                            . "<td contenteditable=\"true\" id=\"przyn4_$lp4\">$obciazenie[kierunek] $obciazenie[typ] $obciazenie[rodzaj] sem. $obciazenie[semestr]</td>"
                            . "<td contenteditable=\"true\" id=\"przed4_$lp4\">$obciazenie[przedmiot]</td>"
                            . "<td contenteditable=\"true\" id=\"wyk4_$lp4\">$w[0]</td>"
                            . "<td contenteditable=\"true\" id=\"cw4_$lp4\">$c[0]</td>"
                            . "<td contenteditable=\"true\" id=\"lab4_$lp4\">$labs[0]</td>"
                            . "<td contenteditable=\"true\" id=\"pr4_$lp4\">$pr[0]</td>"
                            . "<td contenteditable=\"true\" id=\"s4_$lp4\"></td>"
                            . "<!--<td contenteditable=\"true\">". $w[0]+$c[0]+$labs[0]+$pr[0] ."</td>--></tr>";
                    $lp4++;
                    $larray[]=$labs[0];
                    $prarray[]=$pr[0];
                    $warray[]=$w[0];
                    $carray[]=$c[0];
                }
            ?>
         
       <!--<tr><<td colspan="3"><td><?php echo array_sum($warray);?></td><td><?php echo array_sum($carray);?></td><td><?php echo array_sum($larray);?></td>
            <td><?php echo array_sum($prarray);?></td><td></td><td><?php echo array_sum($warray)+array_sum($carray)+array_sum($larray)+array_sum($prarray);?></td></tr>-->
    </tbody></table></div><hr/>
            <?php unset($larray);
                  unset($prarray);
                  unset($warray);
                  unset($carray);
                  unset($labs[0]);
                  unset($pr[0]);
                  unset($w[0]);
                  unset($c[0]);
                  ?>
            <div id="formAppend4"></div>
            <div class="row"><div class="col-md-4"> <button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button></div>
                <div class="col-md-8"><button class="btn btn-indigo btn-block my-1 waves-effect" onclick="GetCellValues4();" type="submit">ZAPISZ</button></div></div>

        </form>
        <!-- Form -->

    </div>

</div>
      </div>
     
    </div>
  </div>
</div>
        <!--Luty-->
        <div class="modal fade right" id="ferbuary" tabindex="-1" role="dialog" aria-labelledby="ferbuaryLabel"
  aria-hidden="true">

  <!-- Add class .modal-full-height and then add class .modal-right (or other classes from list above) to set a position to the modal -->
  <div class="modal-dialog modal-lg modal-full-height modal-right" role="document">


    <div class="modal-content">
    
      <div class="modal-body">
      <div class="card">

    <h5 class="card-header info-color white-text text-center py-4">
        <strong>Dane do rachunku <?php echo "$_POST[wykladowca_imie] $_POST[wykladowca_nazwisko]";?></strong>
    </h5>

    <!--Card content-->
    <div class="card-body px-lg-5">
<?php $tyt_zaw=mysqli_fetch_array(mysqli_query($kon,"SELECT `wykladowca_tytul` FROM `karta_obciazen` WHERE `wykladowca_nazwisko`='$_POST[wykladowca_nazwisko]' AND "
        . "`wykladowca_imie`='$_POST[wykladowca_imie]' AND `wykladowca_tytul`<>'' ORDER BY `id` DESC"));
?>
        <!-- Form -->
        <form class="text-center" style="color: #757575;" action="controller/gen_rachunek.php" method="POST">
            <input type="hidden" name="rok_akademicki" value="<?php echo $_POST['rok_akademicki'];?>"/>
            <input type="hidden" name="semestr_ZL" value="<?php echo $_POST['semestr_ZL'];?>"/>
             <input type="hidden" name="wykladowca_imie" value="<?php echo $_POST['wykladowca_imie'];?>"/>
             <input type="hidden" name="wykladowca_nazwisko" value="<?php echo $_POST['wykladowca_nazwisko'];?>"/><input type="hidden" name="wydzial" value="2"/>
            <div class="row"><div class="col-md-6">
            <div class="md-form mt-3">
                <input type="text" id="materialSubscriptionFormPasswords5" class="form-control" name="data" value="<?php echo date('Y-m-d');?>">
                <label for="materialSubscriptionFormPasswords5">Data rachunku</label>
            </div></div><div class="col-md-6">
            <div class="md-form mt-3">
                <input type="text" id="materialSubscriptionFormPasswords52" class="form-control" name="pesel" value="<?php echo $zajecia['OS_PESEL'];?>">
                <label for="materialSubscriptionFormPasswords52">Pesel</label>
            </div>
            </div></div>
             <div class="row"><div class="col-md-6">
            <div class="md-form">
                <input type="text" id="materialSubscriptionFormEmail5" class="form-control" name="tyt_zawodowy" value="<?php echo $tyt_zaw[0];?>">
                <label for="materialSubscriptionFormEmail5">Tytuł zawodowy</label>
            </div></div><div class="col-md-6">
            <div class="md-form">
                <input type="text" id="materialSubscriptionFormEmail52" class="form-control" name="miesiac" value="Luty">
                <label for="materialSubscriptionFormEmail452">Miesiąc</label>
            </div></div></div>
            <div id="table5" class="table-editable">
                <?php unset($larray);
                  unset($prarray);
                  unset($warray);
                  unset($carray);
                  unset($labs[0]);
                  unset($pr[0]);
                  unset($w[0]);
                  unset($c[0]);
                  ?>
            <table class="table table-bordered table-sm table-condensed" >
                <span class="table-add5 float-right mb-3 mr-2"><a href="#!" class="text-success">
                        <i class="far fa-plus-square green-text fa-2x"></i></a></span>
                <tr> <th rowspan="2">USUŃ</th>
            <th rowspan="2" style="font-size:0.8em;" id="liczba4" style="width:2rem;">L.P.</th>
            <th rowspan="2" style="font-size:0.8em;">Symbol studiów</th>
            <th rowspan="2" style="font-size:0.8em;">Przedmiot</th>
          
            <th  colspan="5" style="font-size:0.8em;">Liczba</th>
            <!--<th rowspan="2" style="font-size:0.8em;">Razem</th>--></tr>
        <tr>
            <th style="width:2.5rem; font-size:0.7em;">w</th><th style="width:2.5rem;">ć</th><th style="width:2.5rem;">l</th><th style="width:2.5rem;">p</th><th style="width:2.5rem;">s</th></tr>
    <tbody class="tbody5">           
    <?php 
                $obciazenia=mysqli_query($kon,"SELECT DISTINCT `przedmiot`,`forma`,`kierunek`,`typ`,`rodzaj`,`semestr` FROM `rach_elementy` "
                        . "WHERE `miesiac`='luty' AND `rok`='".$_POST['rok_akademicki']+1 ."' AND `nazwisko`='$_POST[wykladowca_nazwisko]' AND `imie`='$_POST[wykladowca_imie]'");
                $lp5=1;
                foreach($obciazenia as $obciazenie){
                    $labs=mysqli_fetch_array(mysqli_query($kon,"SELECT SUM(`godziny`) FROM `rach_elementy` "
                            . "WHERE `forma`='Lab.' AND `miesiac`='luty' AND `rok`='".$_POST['rok_akademicki']+1 ."' AND `nazwisko`='$_POST[wykladowca_nazwisko]' AND `imie`='$_POST[wykladowca_imie]' "
                            . "AND `przedmiot`='$obciazenie[przedmiot]' AND `typ`='$obciazenie[typ]' AND `kierunek`='$obciazenie[kierunek]' AND `forma`='$obciazenie[forma]' "
                            . "AND `semestr`='$obciazenie[semestr]' AND `rodzaj`='$obciazenie[rodzaj]' "));
                    $pr=mysqli_fetch_array(mysqli_query($kon,"SELECT SUM(`godziny`) FROM `rach_elementy` "
                            . "WHERE `forma`='Projekt' AND `miesiac`='luty' AND `rok`='".$_POST['rok_akademicki']+1 ."' AND `nazwisko`='$_POST[wykladowca_nazwisko]' AND `imie`='$_POST[wykladowca_imie]' "
                            . "AND `przedmiot`='$obciazenie[przedmiot]' AND `typ`='$obciazenie[typ]' AND `kierunek`='$obciazenie[kierunek]' AND `forma`='$obciazenie[forma]' "
                            . "AND `semestr`='$obciazenie[semestr]' AND `rodzaj`='$obciazenie[rodzaj]' "));
                     $w=mysqli_fetch_array(mysqli_query($kon,"SELECT SUM(`godziny`) FROM `rach_elementy` "
                            . "WHERE `forma`='Wykład' AND `miesiac`='luty' AND `rok`='".$_POST['rok_akademicki']+1 ."' AND `nazwisko`='$_POST[wykladowca_nazwisko]' AND `imie`='$_POST[wykladowca_imie]' "
                            . "AND `przedmiot`='$obciazenie[przedmiot]' AND `typ`='$obciazenie[typ]' AND `kierunek`='$obciazenie[kierunek]' AND `forma`='$obciazenie[forma]' "
                            . "AND `semestr`='$obciazenie[semestr]' AND `rodzaj`='$obciazenie[rodzaj]' "));
                     $c=mysqli_fetch_array(mysqli_query($kon,"SELECT SUM(`godziny`) FROM `rach_elementy` "
                            . "WHERE `forma`='Ćwiczenia' AND `miesiac`='luty' AND `rok`='".$_POST['rok_akademicki']+1 ."' AND `nazwisko`='$_POST[wykladowca_nazwisko]' AND `imie`='$_POST[wykladowca_imie]' "
                            . "AND `przedmiot`='$obciazenie[przedmiot]' AND `typ`='$obciazenie[typ]' AND `kierunek`='$obciazenie[kierunek]' AND `forma`='$obciazenie[forma]' "
                            . "AND `semestr`='$obciazenie[semestr]' AND `rodzaj`='$obciazenie[rodzaj]' "));
                    echo "<tr><td><span class=\"table-remove5\"><!--<button type=\"button\" "
                     . "class=\"btn btn-danger btn-rounded btn-sm my-0\"> - </button></span>-->"
                            . "<i class=\"far fa-trash-alt red-text\"></i></span></td><td>$lp5</td>"
                            . "<td contenteditable=\"true\" id=\"przyn5_$lp5\">$obciazenie[kierunek] $obciazenie[typ] $obciazenie[rodzaj] sem. $obciazenie[semestr]</td>"
                            . "<td contenteditable=\"true\" id=\"przed5_$lp5\">$obciazenie[przedmiot]</td>"
                            . "<td contenteditable=\"true\" id=\"wyk5_$lp5\">$w[0]</td>"
                            . "<td contenteditable=\"true\" id=\"cw5_$lp5\">$c[0]</td>"
                            . "<td contenteditable=\"true\" id=\"lab5_$lp5\">$labs[0]</td>"
                            . "<td contenteditable=\"true\" id=\"pr5_$lp5\">$pr[0]</td>"
                            . "<td contenteditable=\"true\" id=\"s5_$lp5\"></td>"
                            . "<!--<td contenteditable=\"true\">". $w[0]+$c[0]+$labs[0]+$pr[0] ."</td>--></tr>";
                    $lp5++;
                    $larray[]=$labs[0];
                    $prarray[]=$pr[0];
                    $warray[]=$w[0];
                    $carray[]=$c[0];
                }
            ?>
         
       <!--<tr><<td colspan="3"><td><?php echo array_sum($warray);?></td><td><?php echo array_sum($carray);?></td><td><?php echo array_sum($larray);?></td>
            <td><?php echo array_sum($prarray);?></td><td></td><td><?php echo array_sum($warray)+array_sum($carray)+array_sum($larray)+array_sum($prarray);?></td></tr>-->
    </tbody></table></div><hr/>
            <?php unset($larray);
                  unset($prarray);
                  unset($warray);
                  unset($carray);
                  unset($labs[0]);
                  unset($pr[0]);
                  unset($w[0]);
                  unset($c[0]);
                  ?>
            <div id="formAppend5"></div>
            <div class="row"><div class="col-md-4"> <button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button></div>
                <div class="col-md-8"><button class="btn btn-indigo btn-block my-1 waves-effect" onclick="GetCellValues5();" type="submit">ZAPISZ</button></div></div>

        </form>
        <!-- Form -->

    </div>

</div>
      </div>
     
    </div>
  </div>
</div>
        
    <?php
   //RACH
   
?>

</div>
    
</div>
 
       
        
        
    </div>
          <div class="card mb-4 wow fadeIn">
<div class="card-header text-center" >
             <h4>Wyświetl za rok akademicki <?php echo $_POST['rok_akademicki'];?> semestr <?php echo $lz;?></h4>
            </div>
        <!--Card content-->
        <div class="card-body d-sm-flex justify-content-between">
            <table class="table table-striped">
                <tr><th></th>
                    <th>Miesiąc</th>
                    <th>Data rachunku</th><!-- comment -->
                    <th>Numer</th><!-- comment -->
                </tr>
           
            <?php 
            //pobieram rachunki
            $pesel=sqlsrv_fetch_array(sqlsrv_query($conn,"SELECT OS_PESEL FROM OSOBA WHERE "
                    . "OS_IMIE_I='$_POST[wykladowca_imie]' AND OS_NAZWISKO='$_POST[wykladowca_nazwisko]' "
                    . "AND OS_PESEL IS NOT NULL AND OS_ID_TYTUL IS NOT NULL"));
            //echo $pesel[0];
            $rachq=mysqli_query($kon,"SELECT * FROM `rachunki` WHERE `pesel`='$pesel[0]' AND `wydzial`=2");
            foreach($rachq as $rachw){
                //wyciągam miesiąc
                $elem_array=explode(",",$rachw['id_pozycje']);
              //  print_r($elem_array);
                $first_element=$elem_array[0];
                $miesiac=mysqli_fetch_array(mysqli_query($kon,"SELECT `miesiac` FROM `pozycje_rachunkow` WHERE `id`='$first_element'"));
                $nrencoded=base64_encode($rachw['numer']);
                echo "<tr><td><a class=\"button btn btn-indigo\" href=\"controller/generator_rachunku.php?nr=$nrencoded\" target=\"_blank\">ZOBACZ</a>"
                        . "<a class=\"button btn btn-danger\" href=\"controller/usuwanie_rachunku.php?nr=$nrencoded\" target=\"_blank\" style=\"margin-left:5%;\">USUŃ</a>"
                        . "</td><td>$miesiac[0]</td><td>$rachw[data]</td><td>$rachw[numer]</td></tr>";
            }
            ?>
          
             </table>

          

        </div>

      </div>
          </div>
                  
          <!--/.Card-->
     </div>
        </div>
        <!--Grid column-->

        <!--Grid column-->
        
        <!--Grid column-->

      </div>
        
       
       
    <?php //include('view/filtr_Modal.php');?>
      <?php include('view/footer.php');?>

  
  
 
</body>
<?php include('view/js/edittable.js.php');?>
</html>

