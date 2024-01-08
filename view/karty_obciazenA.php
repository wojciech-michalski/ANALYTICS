<?php
//include('controller/U10_Przynaleznosci.php');
//include('controller/statusyANALYTICS.php');
//include('controller/karta_obciazen.php');
if(!isset($_POST['rok_akademicki'])) {
    $_POST['rok_akademicki']="2023";
    $_POST['semestr_ZL']=0;
}
$wykladowca=explode(";;",$_POST['wykladowca']);

$queryA="SELECT * FROM `karta_obciazen` WHERE (`kierunek` LIKE 'Architektura%' "
        . "OR `kierunek`='Wzornictwo' OR `kierunek` ='AW' OR `kierunek`='Budownictwo') "
        . " AND `semestr_ZL`='$_POST[semestr_ZL]'"
        . " AND `rok_akademicki`='$_POST[rok_akademicki]' AND `wykladowca_imie`='$wykladowca[1]' "
        . "AND `wykladowca_nazwisko`='$wykladowca[0]' AND `ilosc_godzin`<>'0' AND `przedmiot` NOT LIKE 'Konsultacj%'"
        . "GROUP BY `kierunek`,`typ`,`rodzaj`,`nr_semestru`,`przedmiot` ";

$queryB="SELECT * FROM `karta_obciazen` WHERE (`kierunek` LIKE 'Architect%' OR `kierunek`='Design' "
        .  "OR `kierunek`='Civil Engineering' OR `kierunek` LIKE 'Interior%' OR `kierunek` LIKE 'Landscape%') AND `semestr_ZL`='$_POST[semestr_ZL]' "
        . " AND `rok_akademicki`='$_POST[rok_akademicki]' AND `wykladowca_imie`='$wykladowca[1]' "
        . "AND `wykladowca_nazwisko`='$wykladowca[0]' AND `ilosc_godzin`<>'0'"
        . "GROUP BY `kierunek`,`typ`,`rodzaj`,`nr_semestru`,`przedmiot` ";
?>
<form id="erase" method="POST" action="controller/erasetable.php">
    <input type="hidden" name="semestr_ZL" value="<?php echo $_POST['semestr_ZL'];?>"/>
    <input type="hidden" name="rok_akademicki" value="<?php echo $_POST['rok_akademicki'];?>"/>
    <input type="hidden" name="wykladowca_imie" value="<?php echo $wykladowca[1];?>"/>
    <input type="hidden" name="wykladowca_nazwisko" value="<?php echo $wykladowca[0];?>"/>
    <input type="hidden" name="wydzial" value="1"/>
</form>
<form id="rach" method="POST" action="main.php?mode=inv">
    <input type="hidden" name="semestr_ZL" value="<?php echo $_POST['semestr_ZL'];?>"/>
    <input type="hidden" name="rok_akademicki" value="<?php echo $_POST['rok_akademicki'];?>"/>
    <input type="hidden" name="wykladowca_imie" value="<?php echo $wykladowca[1];?>"/>
    <input type="hidden" name="wykladowca_nazwisko" value="<?php echo $wykladowca[0];?>"/>
    <input type="hidden" name="wydzial" value="1"/>
</form>   
     
  <?php 
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
            <span>Karty obciążeń</span>
          </h4>

          

        </div>

      </div>
              <div class="row wow fadeIn">

        <!--Grid column-->
        <div class="col-md-12 mb-4">

          <!--Card-->
          
     <div class="card">
         <ul class="nav nav-tabs nav-justified">
    <li class="nav-item">
        <a class="nav-link active" data-toggle="tab" href="#panel1" role="tab">Studia w języku polskim</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#panel2" role="tab">Studia w języku angielskim</a>
    </li>
   
</ul>   <div class="tab-content card">
         <div class="tab-pane fade fade in show active" id="panel1" role="tabpanel">
         <div class="card-header text-center" >
             <span id="toggleclear" style="display:none;"> <button class="btn btn-danger btn-sm" onclick="document.getElementById('erase').submit();"><i class="fas fa-trash"></i> Przelicz ponownie i popraw</button></span>
             <span id="togglsave"> <button class="btn btn-info" onclick="GetCellValues(); document.getElementById('auto_s').submit();"><i class="fas fa-save"></i> Zatwierdź</button></span>
             <span id="toggleedit"> <button class="btn btn-default" onclick="toggleTrash();"><i class="fas fa-pen"></i> Edytuj</button></span>
             <span id="toggleprint"  style="margin-left:20%; display:none;"> <button class="btn btn-default" onclick="generatePDFKO();"><i class="fas fa-file-pdf"  ></i> do PDF</button>
             <button class="btn btn-default" onclick="document.getElementById('rach').submit();"><i class="fas fa-file-pdf"  ></i> Rachunki</button></span>
            </div>
<div class="card-body">
  
    <?php if(mysqli_num_rows(mysqli_query($kon,"SELECT `id` FROM `karty_obciazen_w` WHERE"
        . " `wykladowca_imie`='$wykladowca[1]' AND `wykladowca_nazwisko`='$wykladowca[0]' AND "
        . "`rok_akademicki`='$_POST[rok_akademicki]' AND `semestr_ZL`='$_POST[semestr_ZL]' AND "
            . "(`symbol_studiow` LIKE '%Architektura%' "
        . "OR `symbol_studiow` LIKE '%Wzornictwo%' OR `symbol_studiow` LIKE '%AW%' "
            . "OR `symbol_studiow` LIKE '%Budownictwo%')"))==0) {
        ?>
    
    <div id="koA" style="margin-left:5%;margin-right:5%;padding-bottom:10%;">
 <?php $obciazenia=mysqli_query($kon,$queryA);?>
    <h4 class="text-center" style="padding-top:2%;">KARTA OBCIĄŻEŃ DYDAKTYCZNYCH W WSEiZ</h4>
    <h5 class="text-center">WYDZIAŁ ARCHITEKTURY WSEiZ </h5>
    <p  class="text-left" style="font-size:0.9em;">Imię i nazwisko: <strong>
        <?php echo "$wykladowca[1] $wykladowca[0]";?></strong></p>     
    <p  class="text-left" style="font-size:0.9em;">Semestr: <?php switch($_POST['semestr_ZL']){
        case 0:
            echo "zimowy";
            break;
        case 1:
            echo "letni";
            break;
    }
?></p>
    <p class="text-left" style="font-size:0.9em;">Rok akademicki: <?php echo "$_POST[rok_akademicki]/".$_POST['rok_akademicki']+1;?></p>
    <h6 class="text-center">OBCIĄŻENIE PLANOWANE</H6>
    <form method="POST" action="controller/tableedit.php" id="auto_s">
    <table class="table table-bordered table-sm table-condensed" id="example">
        <tr> <!--<th rowspan="2"  style="border:0px white; display:none" class="znik" id="naglowek"></th>-->
            <th rowspan="2" style="font-size:0.8em;" id="liczba" style="width:2rem;">L.P.</th>
            <th rowspan="2" style="font-size:0.8em;">Symbol studiów</th>
            <th rowspan="2" style="font-size:0.8em;">Przedmiot</th>
            <th rowspan="2" style="font-size:0.8em;">Grupy</th>
            <th  colspan="5" style="font-size:0.8em;">Liczba</th>
            <th rowspan="2" style="font-size:0.8em;">Razem</th></tr>
        <tr>
            <th style="width:2.5rem; font-size:0.7em;">w</th><th style="width:2.5rem;">ć</th><th style="width:2.5rem;">l</th><th style="width:2.5rem;">p</th><th style="width:2.5rem;">s</th></tr>
        <?php $lp=1;
        $sumaicw=array();
        $sumail=array();
        $sumaiw=array();
        $sumaip=array();
        $suma=array();
        $sumais=array();
        foreach($obciazenia as $obciazenie){
            $iw=0;
            $icw=0;
            $il=0;
            $ip=0;
            $grupymariadb=mysqli_query($kon,"SELECT `id_grupy` FROM `karta_obciazen` "
                    . "WHERE `wykladowca_imie`='$wykladowca[1]' AND `wykladowca_nazwisko`='$wykladowca[0]'"
                    . "AND `przedmiot`='$obciazenie[przedmiot]' AND `typ`='$obciazenie[typ]' AND "
                    . "`forma_przedmiotu`='$obciazenie[forma_przedmiotu]' AND `kierunek`='$obciazenie[kierunek]'"
                    . " AND `rodzaj`='$obciazenie[rodzaj]' AND `nr_semestru`='$obciazenie[nr_semestru]' AND"
                    . " `rok_akademicki`='$obciazenie[rok_akademicki]' AND `semestr_ZL`='$obciazenie[semestr_ZL]'");
            foreach($grupymariadb as $grupa){
            $grupy=sqlsrv_query($conn,"SELECT E_SYMBOL_GRUPY FROM Grupa "
                    . "WHERE ID_GRUPY='$grupa[id_grupy]'", array(), array( "Scrollable" => 'static'));
            
                $group_=sqlsrv_fetch_array($grupy);
               
                $groups[]=$group_[0];
            
            }
            $grstring=implode(", ",$groups);
            $ig=mysqli_fetch_array(mysqli_query($kon,"SELECT SUM(`ilosc_godzin`) FROM `karta_obciazen` "
                    . "WHERE `wykladowca_imie`='$wykladowca[1]' AND `wykladowca_nazwisko`='$wykladowca[0]'"
                    . "AND `przedmiot`='$obciazenie[przedmiot]' AND `typ`='$obciazenie[typ]' AND "
                    . "`forma_przedmiotu`='$obciazenie[forma_przedmiotu]' AND `kierunek`='$obciazenie[kierunek]'"
                    . " AND `rodzaj`='$obciazenie[rodzaj]' AND `nr_semestru`='$obciazenie[nr_semestru]' AND"
                    . " `rok_akademicki`='$obciazenie[rok_akademicki]' AND `semestr_ZL`='$obciazenie[semestr_ZL]'"));
            switch($obciazenie['forma_przedmiotu']){
                case "Wykład":
                case "Lecture":
                     $iw=$ig[0];
                    $sumaiw[]=$iw;
                     break;
                case "Ćwiczenia":
                case "aud. ex.":
                    
                    $icw=$ig[0];
                        $sumaicw[]=$icw;
                    break;
                 case "Lab.":
                    case "lab. ex.":
                
                    $il=$ig[0];
                    $sumail[]=$il;
                    break;
                case "Projekt":
                case "Project":
                    $ip=$ig[0];
                    $sumaip[]=$ig[0];
                    break;
            }
            $suma[]=$ig[0];
            if($lp==mysqli_num_rows($obciazenia)) $dodajwiersz="<br/><br/><i class=\"far fa-plus-square green-text\" onclick=\"rowAdd('example',$lp);\"></i>";
                else $dodajwiersz="";
            echo "<tr id=\"rowek$lp\">"
                    . "<td style=\"border:0px white; display:none\" class=\"znik\">"
                    . "<i class=\"far fa-trash-alt red-text\" onclick=\"usunRowek('rowek$lp');\"></i>$dodajwiersz </td>"
                    . "<td contenteditable=\"false\" style=\"font-size:0.7em;\" class=\"edit\">$lp</td>"
                    . "<td contenteditable=\"false\" style=\"font-size:0.7em;\" class=\"edit\">$obciazenie[kierunek] $obciazenie[typ] $obciazenie[rodzaj] sem. $obciazenie[nr_semestru]</td>"
                    . "<td contenteditable=\"false\" style=\"font-size:0.7em;\" class=\"edit\">$obciazenie[przedmiot]</td>"
                    . "<td contenteditable=\"false\" style=\"font-size:0.8em;\" class=\"edit\">$grstring</td>"
                    . "<td contenteditable=\"false\" style=\"font-size:0.8em;\" class=\"edit iw\" id=\"iw$lp\" onclick=\"eDit('row$lp');\">$iw</td>"
                    . "<td contenteditable=\"false\" style=\"font-size:0.8em;\" class=\"edit icw\" id=\"icw$lp\" onclick=\"eDit('row$lp');\">$icw</td>"
                    . "<td contenteditable=\"false\" style=\"font-size:0.8em;\" class=\"edit il\" id=\"il$lp\" onclick=\"eDit('row$lp');\">$il</td>"
                    . "<td contenteditable=\"false\" style=\"font-size:0.8em;\" class=\"edit ip\" id=\"ip$lp\" onclick=\"eDit('row$lp');\">$ip</td>"
                    . "<td contenteditable=\"false\" style=\"font-size:0.8em;\" class=\"edit is\" id=\"is$lp\" onclick=\"eDit('row$lp');\">$is</td>"
                    . "<td contenteditable=\"false\" style=\"font-size:0.8em;\" class=\"edit ir\" id=\"row$lp\" onclick=\"eDit('row$lp')';\">$ig[0]"
                    . "</td></tr>";
            $lp++;
            unset($il);
            unset($ig);
            unset($iw);
            unset($icw);
            unset($ip);
            unset($groups);
            $rok_akademicki=$obciazenie['rok_akademicki'];
            $semestr_ZL=$obciazenie['semestr_ZL'];
        }
        ?>
        <tr><td id="suma" colspan="4">SUMA:</td><td id="sumaiw"><?php echo array_sum($sumaiw);?></td>
            <td id="sumaicw"><?php echo array_sum($sumaicw);?></td>
            <td id="sumail"><?php echo array_sum($sumail);?></td>
            <td id="sumaip"><?php echo array_sum($sumaip);?></td>
            <td id="sumais"><?php echo array_sum($sumais);?></td>
            <td id="sumall"><?php echo array_sum($suma);?></td></tr>
    </table>
        <input type="hidden" name="wykladowca_imie" value="<?php echo $wykladowca[1];?>"/>
        <input type="hidden" name="wykladowca_nazwisko" value="<?php echo $wykladowca[0];?>"/>
        <input type="hidden" name="rok_akademicki" value="<?php echo $rok_akademicki;?>"/>
        <input type="hidden" name="semestr_ZL" value="<?php echo $semestr_ZL;?>"/>
         <input type="hidden" name="jezyk" value="PL"/>
         <input type="hidden" name="wydzial" value="1"/>
        <div id="formAppend"></div>
      
        <button class="btn btn-sm btn-success" style="display:none;" id="save" onclick="GetCellValues();" type="submit" ><i class="fas fa-save"></i> zapisz</button></form>
    <p style="margin-top:4%; font-size:0.9em;"><em>Obciążenia przyjmuję do wykonania dn <?php echo date('Y-m-d');?>,
            <span style="margin-left:15%"> podpis ..................................................</span></em></p>
            <h6 class="text-center" style="margin-top:7%;font-weight:800 !important;">ROZLICZENIE</h6>						
            <h6 class="text-center">OBCIĄŻENIE WYKONANE zgodnie / niezgodnie z planem<sup>*</sup>    </h6>
            <h6 class="text-center">Zmiana planu<sup>*</sup>    </h6>
            <p class="text-muted text-left" style="margin-top:4%; font-size:0.9em;"><em>Potwierdzam wykonanie zajęć</em></p>
            <p class="text-muted text-left" style="font-size:0.9em;"><em>Podpis kierownika Dziekanatu .............................................................		
</em></p>

</div>
</div>
    <?php 
        }
        else {
            $queryA="SELECT * FROM `karty_obciazen_w` WHERE `semestr_ZL`='$_POST[semestr_ZL]'"
        . " AND `rok_akademicki`='$_POST[rok_akademicki]' AND `wykladowca_imie`='$wykladowca[1]' "
        . "AND `wykladowca_nazwisko`='$wykladowca[0]' AND `jezyk`='PL' AND `WYDZIAL`='1'";
        ?>
             <script>
                 document.getElementById('togglsave').style.display = "none";
                 document.getElementById('toggleedit').style.display = "none";
                 document.getElementById('toggleedit').style.display = "none";
                 document.getElementById('toggleprint').style.display = "inline";
                 document.getElementById('toggleclear').style.display = "inline";
                 </script>
        <div id="koA" style="margin-left:5%;margin-right:5%;">
 <?php $obciazenia=mysqli_query($kon,$queryA);?>
    <h4 class="text-center" >KARTA OBCIĄŻEŃ DYDAKTYCZNYCH W WSEiZ</h4>
    <h5 class="text-center">WYDZIAŁ ARCHITEKTURY WSEiZ </h5>
    <p  class="text-left" style="font-size:0.9em;">Imię i nazwisko: <strong>
        <?php echo "$wykladowca[1] $wykladowca[0]";?></strong></p>     
    <p  class="text-left" style="font-size:0.9em;">Semestr: <?php switch($_POST['semestr_ZL']){
        case 0:
            echo "zimowy";
            break;
        case 1:
            echo "letni";
            break;
    }
   
//    if(mysqli_num_rows($obciazenia)>12 && mysqli_num_rows($obciazenia)<15)  {
 //       $pagebreak="<span class=\"html2pdf__page-break\"></span>";
 //   }
 //   else {$pagebreak="";}
    //echo mysqli_num_rows($obciazenia);
    if(mysqli_num_rows($obciazenia)>10 && mysqli_num_rows($obciazenia)<13)  {
        $pagebreak2="<span class=\"html2pdf__page-break\"></span>";
        
    }
    else {$pagebreak2="";}
    $pagebreak3="<span class=\"html2pdf__page-break\"></span>";
?></p>
    <p class="text-left" style="font-size:0.9em;">Rok akademicki: <?php echo "$_POST[rok_akademicki]/".$_POST['rok_akademicki']+1;?></p>
    <h6 class="text-center">OBCIĄŻENIE PLANOWANE</H6>
    <form method="POST" action="controller/tableedit.php">
    <table class="table table-bordered table-sm table-condensed" id="example">
        <tr> <!--<th rowspan="2"  style="border:0px white; display:none" class="znik" id="naglowek"></th>-->
            <th rowspan="2" id="liczba" style="width:2rem;font-size:0.8em;">L.P.</th>
            <th rowspan="2" style="font-size:0.8em;">Symbol studiów</th>
            <th rowspan="2" style="font-size:0.8em;">Przedmiot</th>
            <th rowspan="2" style="font-size:0.8em;">Grupy</th>
            <th  colspan="5"style="font-size:0.8em;">Liczba</th>
            <th rowspan="2" style="font-size:0.8em;">Razem</th></tr>
        <tr><th style="width:2.5rem; font-size:0.7em;">w</th><th style="width:2.5rem;font-size:0.8em;">ć</th>
            <th style="width:2.5rem; font-size:0.8em;">l</th><th style="width:2.5rem;font-size:0.8em;">p</th>
            <th style="width:2.5rem;font-size:0.8em;">s</th></tr>
        <?php $lp=1;
       $sumaiw=array(0);
       $sumaicw=array(0);
       $sumail=array(0);
       $sumaip=array(0);
       $sumais=array(0);
        foreach($obciazenia as $obciazenie){
            
            
            switch($obciazenie['przedmiot_forma']){
                case "Wykład":
                    $iw=$obciazenie['ilosc_godzin'];
                    $sumaiw[]=$iw;
                    $icw=0;
                    $il=0;
                    $ip=0;
                    $is=0;
                    break;
                case "Ćwiczenia":
                    $icw=$obciazenie['ilosc_godzin'];
                    $sumaicw[]=$icw;
                    $iw=0;
                    $il=0;
                    $ip=0;
                    $is=0;
                    break;
                case "Laboratorium":
                    $il=$obciazenie['ilosc_godzin'];
                    $sumail[]=$il;
                    $icw=0;
                    $iw=0;
                    $ip=0;
                    $is=0;
                    break;
                case "Projekt":
                    $ip=$obciazenie['ilosc_godzin'];
                    $sumaip[]=$ip;
                    $icw=0;
                    $il=0;
                    $iw=0;
                    $is=0;
                    break;
                case "Seminarium":
                    $is=$obciazenie['ilosc_godzin'];
                    $sumais[]=$is;
                    $icw=0;
                    $il=0;
                    $ip=0;
                    $iw=0;
                    break;
            }
            if($lp==mysqli_num_rows($obciazenia)) $dodajwiersz="<br/><br/><i class=\"far fa-plus-square green-text\" onclick=\"rowAdd('example',$lp);\"></i>";
                else $dodajwiersz="";
              switch($lp){
        default:
            $page="";
            break;
            case 13:
               // $page=$pagebreak3;
                $page="</table>$pagebreak3 <table class=\"table table-bordered table-sm table-condensed\">"
                    . "<tr> 
            <th rowspan=\"2\" style=\"width:2rem;font-size:0.8em;\">L.P.</th>
            <th rowspan=\"2\" style=\"font-size:0.8em;\">Symbol studiów</th>
            <th rowspan=\"2\" style=\"font-size:0.8em;\">Przedmiot</th>
            <th rowspan=\"2\" style=\"font-size:0.8em;\">Grupy</th>
            <th  colspan=\"5\"style=\"font-size:0.8em;\">Liczba</th>
            <th rowspan=\"2\" style=\"font-size:0.8em;\">Razem</th></tr>
        <tr><th style=\"width:2.5rem; font-size:0.7em;\">w</th><th style=\"width:2.5rem;font-size:0.8em;\">ć</th>
            <th style=\"width:2.5rem; font-size:0.8em;\">l</th><th style=\"width:2.5rem;font-size:0.8em;\">p</th>
            <th style=\"width:2.5rem;font-size:0.8em;\">s</th></tr>";
                break;
              }
            echo "<tr id=\"rowek$lp\">"
                    . "<td style=\"border:0px white; display:none\" class=\"znik\">"
                    . "<i class=\"far fa-trash-alt red-text\" onclick=\"usunRowek('rowek$lp');\"></i>$dodajwiersz </td>"
                    . "<td contenteditable=\"false\" style=\"font-size:0.7em;\" class=\"edit\">$lp</td>"
                    . "<td contenteditable=\"false\" style=\"font-size:0.7em;\" class=\"edit\">$obciazenie[symbol_studiow]</td>"
                    . "<td contenteditable=\"false\" style=\"font-size:0.7em;\" class=\"edit\">$obciazenie[przedmiot] $obciazenie[forma]</td>"
                    . "<td contenteditable=\"false\" style=\"font-size:0.8em;\" class=\"edit\">$obciazenie[grupy]</td>"
                    . "<td contenteditable=\"false\" style=\"font-size:0.8em;\" class=\"edit iw\" id=\"iw$lp\" onclick=\"eDit('row$lp');\">$iw</td>"
                    . "<td contenteditable=\"false\" style=\"font-size:0.8em;\" class=\"edit icw\" id=\"icw$lp\" onclick=\"eDit('row$lp');\">$icw</td>"
                    . "<td contenteditable=\"false\" style=\"font-size:0.8em;\" class=\"edit il\" id=\"il$lp\" onclick=\"eDit('row$lp');\">$il</td>"
                    . "<td contenteditable=\"false\" style=\"font-size:0.8em;\" class=\"edit ip\" id=\"ip$lp\" onclick=\"eDit('row$lp');\">$ip</td>"
                    . "<td contenteditable=\"false\" style=\"font-size:0.8em;\" class=\"edit is\" id=\"is$lp\" onclick=\"eDit('row$lp');\">$is</td>"
                    . "<td contenteditable=\"false\" style=\"font-size:0.8em;\" class=\"edit ir\" id=\"row$lp\" onclick=\"eDit('row$lp')';\">". $iw+$icw+$il+$ip+$is .""
                    . "</td></tr>$page";
            $lp++;
            unset($il);
            unset($ig);
            unset($iw);
            unset($icw);
            unset($ip);
            unset($groups);
            $rok_akademicki=$obciazenie['rok_akademicki'];
            $semestr_ZL=$obciazenie['semestr_ZL'];
        }
        
        ?>
        <tr><td id="suma" colspan="4">SUMA:</td><td id="sumaiw"><?php echo array_sum($sumaiw);?></td>
            <td id="sumaicw"><?php echo array_sum($sumaicw);?></td>
            <td id="sumail"><?php echo array_sum($sumail);?></td>
            <td id="sumaip"><?php echo array_sum($sumaip);?></td>
            <td id="sumais"><?php echo array_sum($sumais);?></td>
            <td id="sumall"><?php echo array_sum($sumaicw)+array_sum($sumaiw)+array_sum($sumail)
            +array_sum($sumaip)+array_sum($sumais);?></td></tr>
    </table>
        <input type="hidden" name="wykladowca_imie" value="<?php echo $wykladowca[1];?>"/>
        <input type="hidden" name="wykladowca_nazwisko" value="<?php echo $wykladowca[0];?>"/>
        <input type="hidden" name="rok_akademicki" value="<?php echo $rok_akademicki;?>"/>
        <input type="hidden" name="semestr_ZL" value="<?php echo $semestr_ZL;?>"/>
         <input type="hidden" name="wydzial" value="1"/>
        <div id="formAppend"></div>
      <?php echo $pagebreak;?>
        <button class="btn btn-sm btn-success" style="display:none;" id="save" onclick="GetCellValues();" type="submit" ><i class="fas fa-save"></i> zapisz</button></form>
    <p style="margin-top:4%; font-size:0.9em;"><em>Obciążenia przyjmuję do wykonania dn <?php echo date('Y-m-d');?>,
            <span style="margin-left:15%"> podpis ..................................................</span></em></p>
            <?php echo $pagebreak2;?>
            <h6 class="text-center" style="margin-top:7%;font-weight:800 !important;">ROZLICZENIE</h6>						
            <h6 class="text-center">OBCIĄŻENIE WYKONANE zgodnie / niezgodnie z planem<sup>*</sup>    </h6>
            <h6 class="text-center">Zmiana planu<sup>*</sup>    </h6>
            <p class="text-muted text-left" style="margin-top:4%; font-size:0.9em;"><em>Potwierdzam wykonanie zajęć</em></p>
            <p class="text-muted text-left" style="font-size:0.9em;"><em>Podpis kierownika Dziekanatu .............................................................		
</em></p>

</div>
</div>
    <?php 
        }
        ?>
</div>
    <!--KARTA OBCIĄŻEŃ JĘZ. ANGIELSKI -->
    <div class="tab-pane fade" id="panel2" role="tabpanel">
         <div class="card-header text-center" >
             <span id="toggleclear2" style="display:none;"> <button class="btn btn-danger btn-sm" onclick="document.getElementById('erase').submit();"><i class="fas fa-trash"></i> Przelicz ponownie i popraw</button></span>
             <span id="togglsave2"> <button class="btn btn-info" onclick="GetCellValues2(); document.getElementById('auto_ss').submit();"><i class="fas fa-save"></i> Zatwierdź</button></span>
             <span id="toggleedit2"> <button class="btn btn-default" onclick="toggleTrash2();"><i class="fas fa-pen"></i> Edytuj</button></span>
             <span id="toggleprint2" style="margin-left:20%; display:none;"><button class="btn btn-default" onclick="generatePDFKO2();" ><i class="fas fa-file-pdf"  ></i> do PDF</button></span>
            </div>
<div class="card-body">
  
    <?php if(mysqli_num_rows(mysqli_query($kon,"SELECT `id` FROM `karty_obciazen_w` WHERE"
        . " `wykladowca_imie`='$wykladowca[1]' AND `wykladowca_nazwisko`='$wykladowca[0]' AND "
            . "(`symbol_studiow` LIKE '%Architect%' OR `symbol_studiow` LIKE '%Design%' "
        .  "OR `symbol_studiow` LIKE '%Civil Engineering%' OR `symbol_studiow` LIKE '%Interior%' "
            . "OR `symbol_studiow` LIKE '%Landscape%') AND "
        . "`rok_akademicki`='$_POST[rok_akademicki]' AND `semestr_ZL`='$_POST[semestr_ZL]'"))==0) {
        ?>
    
    <div id="koB" style="margin-left:5%;margin-right:5%;padding-bottom:10%;">
 <?php $obciazenia=mysqli_query($kon,$queryB);?>
    <h4 class="text-center" style="padding-top:2%;">KARTA OBCIĄŻEŃ DYDAKTYCZNYCH W WSEiZ</h4>
    <h5 class="text-center">WYDZIAŁ ARCHITEKTURY WSEiZ </h5>
    <p  class="text-left" style="font-size:0.9em;">Imię i nazwisko: <strong>
        <?php echo "$wykladowca[1] $wykladowca[0]";?></strong></p>     
    <p  class="text-left" style="font-size:0.9em;">Semestr: <?php switch($_POST['semestr_ZL']){
        case 0:
            echo "zimowy";
            break;
        case 1:
            echo "letni";
            break;
    }
?></p>
    <p class="text-left" style="font-size:0.9em;">Rok akademicki: <?php echo "$_POST[rok_akademicki]/".$_POST['rok_akademicki']+1;?></p>
    <h6 class="text-center">OBCIĄŻENIE PLANOWANE</H6>
    <form method="POST" action="controller/tableedit.php" id="auto_ss">
    <table class="table table-bordered table-sm table-condensed" id="example2">
        <tr> <!--<th rowspan="2"  style="border:0px white; display:none" class="znik" id="naglowek"></th>-->
            <th rowspan="2" id="liczba2" style="width:2rem; font-size:0.8em;">L.P.</th>
            <th rowspan="2" style="font-size:0.8em;">Symbol studiów</th>
            <th rowspan="2" style="font-size:0.8em;">Przedmiot</th>
            <th rowspan="2" style="font-size:0.8em;">Grupy</th>
            <th  colspan="5" style="font-size:0.8em;">Liczba</th>
            <th rowspan="2"style="font-size:0.8em;">Razem</th></tr>
        <tr><th style="width:2.5rem;font-size:0.7em;">w</th><th style="width:2.5rem;font-size:0.7em;">ć</th>
            <th style="width:2.5rem;font-size:0.7em;">l</th><th style="width:2.5rem;font-size:0.7em;">p</th>
            <th style="width:2.5rem;font-size:0.7em;">s</th></tr>
        <?php $lp2=1;
        $sumaicw=array();
        $sumail=array();
        $sumaiw=array();
        $sumaip=array();
        $suma=array();
        $sumais=array();
        foreach($obciazenia as $obciazenie){
            $iw=0;
            $icw=0;
            $il=0;
            $ip=0;
            $grupymariadb=mysqli_query($kon,"SELECT `id_grupy` FROM `karta_obciazen` "
                    . "WHERE `wykladowca_imie`='$wykladowca[1]' AND `wykladowca_nazwisko`='$wykladowca[0]'"
                    . "AND `przedmiot`='$obciazenie[przedmiot]' AND `typ`='$obciazenie[typ]' AND "
                    . "`forma_przedmiotu`='$obciazenie[forma_przedmiotu]' AND `kierunek`='$obciazenie[kierunek]'"
                    . " AND `rodzaj`='$obciazenie[rodzaj]' AND `nr_semestru`='$obciazenie[nr_semestru]' AND"
                    . " `rok_akademicki`='$obciazenie[rok_akademicki]' AND `semestr_ZL`='$obciazenie[semestr_ZL]'");
            foreach($grupymariadb as $grupa){
            $grupy=sqlsrv_query($conn,"SELECT E_SYMBOL_GRUPY FROM Grupa "
                    . "WHERE ID_GRUPY='$grupa[id_grupy]'", array(), array( "Scrollable" => 'static'));
            
                $group_=sqlsrv_fetch_array($grupy);
               
                $groups[]=$group_[0];
            
            }
            $grstring=implode(", ",$groups);
            $ig=mysqli_fetch_array(mysqli_query($kon,"SELECT SUM(`ilosc_godzin`) FROM `karta_obciazen` "
                    . "WHERE `wykladowca_imie`='$wykladowca[1]' AND `wykladowca_nazwisko`='$wykladowca[0]'"
                    . "AND `przedmiot`='$obciazenie[przedmiot]' AND `typ`='$obciazenie[typ]' AND "
                    . "`forma_przedmiotu`='$obciazenie[forma_przedmiotu]' AND `kierunek`='$obciazenie[kierunek]'"
                    . " AND `rodzaj`='$obciazenie[rodzaj]' AND `nr_semestru`='$obciazenie[nr_semestru]' AND"
                    . " `rok_akademicki`='$obciazenie[rok_akademicki]' AND `semestr_ZL`='$obciazenie[semestr_ZL]'"));
            switch($obciazenie['forma_przedmiotu']){
                case "Wykład":
                case "Lecture":
                     $iw=$ig[0];
                    $sumaiw[]=$iw;
                     break;
                case "Ćwiczenia":
                case "aud. ex.":
                    
                    $icw=$ig[0];
                        $sumaicw[]=$icw;
                    break;
                 case "Lab.":
                    case "lab. ex.":
                
                    $il=$ig[0];
                    $sumail[]=$il;
                    break;
                case "Projekt":
                case "Project":
                    $ip=$ig[0];
                    $sumaip[]=$ig[0];
                    break;
            }
            $suma[]=$ig[0];
            if($lp2==mysqli_num_rows($obciazenia)) $dodajwiersz="<br/><br/><i class=\"far fa-plus-square green-text\" onclick=\"rowAdd2('example2',$lp2);\"></i>";
                else $dodajwiersz="";
            echo "<tr id=\"rowek2_$lp2\">"
                    . "<td style=\"border:0px white; display:none\" class=\"znik2\">"
                    . " <i class=\"far fa-trash-alt red-text\" onclick=\"usunRowek2('rowek2_$lp2');\"></i>$dodajwiersz</td>"
                    . "<td contenteditable=\"false\" style=\"font-size:0.7em;\" class=\"edit2\">$lp2</td>"
                    . "<td contenteditable=\"false\" style=\"font-size:0.7em;\" class=\"edit2\">$obciazenie[kierunek] $obciazenie[typ] $obciazenie[rodzaj] sem. $obciazenie[nr_semestru]</td>"
                    . "<td contenteditable=\"false\" style=\"font-size:0.7em;\" class=\"edit2\">$obciazenie[przedmiot]</td>"
                    . "<td contenteditable=\"false\" style=\"font-size:0.8em;\" class=\"edit2\">$grstring</td>"
                    . "<td contenteditable=\"false\" style=\"font-size:0.8em;\" class=\"edit2 iw2\" id=\"iw2_$lp2\" onclick=\"eDit2('row2_$lp2');\">$iw</td>"
                    . "<td contenteditable=\"false\" style=\"font-size:0.8em;\" class=\"edit2 icw2\" id=\"icw2_$lp2\" onclick=\"eDit2('row2_$lp2');\">$icw</td>"
                    . "<td contenteditable=\"false\" style=\"font-size:0.8em;\" class=\"edit2 il2\" id=\"il2_$lp2\" onclick=\"eDit2('row2_$lp2');\">$il</td>"
                    . "<td contenteditable=\"false\" style=\"font-size:0.8em;\" class=\"edit2 ip2\" id=\"ip2_$lp2\" onclick=\"eDit2('row2_$lp2');\">$ip</td>"
                    . "<td contenteditable=\"false\" style=\"font-size:0.8em;\" class=\"edit2 is2\" id=\"is2_$lp2\" onclick=\"eDit2('row2_$lp2');\">$is</td>"
                    . "<td contenteditable=\"false\" style=\"font-size:0.8em;\" class=\"edit2 ir2\" id=\"row2_$lp2\" onclick=\"eDit2('row2_$lp2')';\">$ig[0]"
                    . "</td></tr>";
            $lp2++;
            unset($il);
            unset($ig);
            unset($iw);
            unset($icw);
            unset($ip);
            unset($groups);
            $rok_akademicki=$obciazenie['rok_akademicki'];
            $semestr_ZL=$obciazenie['semestr_ZL'];
        }
        ?>
        <tr><td id="suma2" colspan="4">SUMA:</td><td id="sumaiw2"><?php echo array_sum($sumaiw);?></td>
            <td id="sumaicw2"><?php echo array_sum($sumaicw);?></td>
            <td id="sumail2"><?php echo array_sum($sumail);?></td>
            <td id="sumaip2"><?php echo array_sum($sumaip);?></td>
            <td id="sumais2"><?php echo array_sum($sumais);?></td>
            <td id="sumall2"><?php echo array_sum($sumaicw)+array_sum($sumaiw)+array_sum($sumail)
            +array_sum($sumaip)+array_sum($sumais);?></td></tr>
    </table>
        <input type="hidden" name="wykladowca_imie" value="<?php echo $wykladowca[1];?>"/>
        <input type="hidden" name="wykladowca_nazwisko" value="<?php echo $wykladowca[0];?>"/>
        <input type="hidden" name="rok_akademicki" value="<?php echo $rok_akademicki;?>"/>
        <input type="hidden" name="semestr_ZL" value="<?php echo $semestr_ZL;?>"/>
        <input type="hidden" name="jezyk" value="EN"/>
        <input type="hidden" name="wydzial" value="1"/>
        <div id="formAppend2"></div>
       
        <button class="btn btn-sm btn-success" style="display:none;" id="save2" onclick="GetCellValues2();" type="submit" ><i class="fas fa-save"></i> zapisz</button>
    <p style="margin-top:4%; font-size:0.9em;"><em>Obciążenia przyjmuję do wykonania dn <?php echo date('Y-m-d');?>,
            <span style="margin-left:15%"> podpis ..................................................</span></em></p>
            <h6 class="text-center" style="margin-top:7%;font-weight:800 !important;">ROZLICZENIE</h6>						
            <h6 class="text-center">OBCIĄŻENIE WYKONANE zgodnie / niezgodnie z planem<sup>*</sup>    </h6>
            <h6 class="text-center">Zmiana planu<sup>*</sup>    </h6>
            <p class="text-muted text-left" style="margin-top:4%; font-size:0.9em;"><em>Potwierdzam wykonanie zajęć</em></p>
            <p class="text-muted text-left" style="font-size:0.9em;"><em>Podpis kierownika Dziekanatu .............................................................		
</em></p>

</div>
</div>   
   <?php 
        }
        else {
             $queryB="SELECT * FROM `karty_obciazen_w` WHERE `semestr_ZL`='$_POST[semestr_ZL]'"
        . " AND `rok_akademicki`='$_POST[rok_akademicki]' AND `wykladowca_imie`='$wykladowca[1]' "
        . "AND `wykladowca_nazwisko`='$wykladowca[0]' AND `WYDZIAL`='1' AND `jezyk`='EN' ";
        
            ?>
          <script>
                 document.getElementById('togglsave2').style.display = "none";
                 document.getElementById('toggleedit2').style.display = "none";
                 document.getElementById('toggleprint2').style.display = "inline";
                 document.getElementById('toggleclear2').style.display = "inline";
                 </script>
             <div id="koB" style="margin-left:5%;margin-right:5%;padding-bottom:10%;">
 <?php $obciazenia=mysqli_query($kon,$queryB);?>
    <h4 class="text-center" style="padding-top:2%;">KARTA OBCIĄŻEŃ DYDAKTYCZNYCH W WSEiZ</h4>
    <h5 class="text-center">WYDZIAŁ ARCHITEKTURY WSEiZ </h5>
    <p  class="text-left" style="font-size:0.9em;">Imię i nazwisko: <strong>
        <?php echo "$wykladowca[1] $wykladowca[0]";?></strong></p>     
    <p  class="text-left" style="font-size:0.9em;">Semestr: <?php switch($_POST['semestr_ZL']){
        case 0:
            echo "zimowy";
            break;
        case 1:
            echo "letni";
            break;
    }
?></p>
    <p class="text-left" style="font-size:0.9em;">Rok akademicki: <?php echo "$_POST[rok_akademicki]/".$_POST['rok_akademicki']+1;?></p>
    <h6 class="text-center">OBCIĄŻENIE PLANOWANE</H6>
    <form method="POST" action="controller/tableedit.php">
    <table class="table table-bordered table-sm table-condensed" id="example2">
        <tr> <!--<th rowspan="2"  style="border:0px white; display:none" class="znik" id="naglowek"></th>-->
            <th rowspan="2" id="liczba2" style="width:2rem;font-size:0.8em;">L.P.</th>
            <th rowspan="2" style="font-size:0.8em;">Symbol studiów</th>
            <th rowspan="2" style="font-size:0.8em;">Przedmiot</th>
            <th rowspan="2" style="font-size:0.8em;">Grupy</th>
            <th  colspan="5" style="font-size:0.8em;">Liczba</th>
            <th rowspan="2" style="font-size:0.8em;">Razem</th></tr>
        <tr><th style="width:2.5rem;font-size:0.7em;">w</th><th style="width:2.5rem;font-size:0.7em;">ć</th>
            <th style="width:2.5rem;font-size:0.7em;">l</th><th style="width:2.5rem;font-size:0.7em;">p</th>
            <th style="width:2.5rem;font-size:0.7em;">s</th></tr>
        <?php $lp2=1;
        $sumaiw=array(0);
       $sumaicw=array(0);
       $sumail=array(0);
       $sumaip=array(0);
       $sumais=array(0);
        foreach($obciazenia as $obciazenie){
            
            
            switch($obciazenie['przedmiot_forma']){
                case "Wykład":
                    $iw=$obciazenie['ilosc_godzin'];
                    $sumaiw[]=$iw;
                    $icw=0;
                    $il=0;
                    $ip=0;
                    $is=0;
                    break;
                case "Ćwiczenia":
                    $icw=$obciazenie['ilosc_godzin'];
                    $sumaicw[]=$icw;
                    $iw=0;
                    $il=0;
                    $ip=0;
                    $is=0;
                    break;
                case "Laboratorium":
                    $il=$obciazenie['ilosc_godzin'];
                    $sumail[]=$il;
                    $icw=0;
                    $iw=0;
                    $ip=0;
                    $is=0;
                    break;
                case "Projekt":
                    $ip=$obciazenie['ilosc_godzin'];
                    $sumaip[]=$ip;
                    $icw=0;
                    $il=0;
                    $iw=0;
                    $is=0;
                    break;
                case "Seminarium":
                    $is=$obciazenie['ilosc_godzin'];
                    $sumais[]=$is;
                    $icw=0;
                    $il=0;
                    $ip=0;
                    $iw=0;
                    break;
            }
            if($lp2==mysqli_num_rows($obciazenia)) $dodajwiersz="<br/><br/><i class=\"far fa-plus-square green-text\" onclick=\"rowAdd2('example2',$lp2);\"></i>";
                else $dodajwiersz="";
            echo "<tr id=\"rowek2_$lp2\">"
                    . "<td style=\"border:0px white; display:none\" class=\"znik2\">"
                    . " <i class=\"far fa-trash-alt red-text\" onclick=\"usunRowek2('rowek2_$lp2');\"></i>$dodajwiersz</td>"
                    . "<td contenteditable=\"false\" style=\"font-size:0.7em;\" class=\"edit2\">$lp2</td>"
                    . "<td contenteditable=\"false\" style=\"font-size:0.7em;\" class=\"edit2\">$obciazenie[symbol_studiow]</td>"
                    . "<td contenteditable=\"false\" style=\"font-size:0.7em;\" class=\"edit2\">$obciazenie[przedmiot]</td>"
                    . "<td contenteditable=\"false\" style=\"font-size:0.8em;\" class=\"edit2\">$grstring</td>"
                    . "<td contenteditable=\"false\" style=\"font-size:0.8em;\" class=\"edit2 iw2\" id=\"iw2_$lp2\" onclick=\"eDit2('row2_$lp2');\">$iw</td>"
                    . "<td contenteditable=\"false\" style=\"font-size:0.8em;\" class=\"edit2 icw2\" id=\"icw2_$lp2\" onclick=\"eDit2('row2_$lp2');\">$icw</td>"
                    . "<td contenteditable=\"false\" style=\"font-size:0.8em;\" class=\"edit2 il2\" id=\"il2_$lp2\" onclick=\"eDit2('row2_$lp2');\">$il</td>"
                    . "<td contenteditable=\"false\" style=\"font-size:0.8em;\" class=\"edit2 ip2\" id=\"ip2_$lp2\" onclick=\"eDit2('row2_$lp2');\">$ip</td>"
                    . "<td contenteditable=\"false\" style=\"font-size:0.8em;\" class=\"edit2 is2\" id=\"is2_$lp2\" onclick=\"eDit2('row2_$lp2');\">$is</td>"
                    . "<td contenteditable=\"false\" style=\"font-size:0.8em;\" class=\"edit2 ir2\" id=\"row2_$lp2\" onclick=\"eDit2('row2_$lp2')';\">$obciazenie[ilosc_godzin]"
                    . "</td></tr>";
            $lp2++;
            unset($il);
            unset($ig);
            unset($iw);
            unset($icw);
            unset($ip);
            unset($groups);
            $rok_akademicki=$obciazenie['rok_akademicki'];
            $semestr_ZL=$obciazenie['semestr_ZL'];
        }
        ?>
        <tr><td id="suma2" colspan="4">SUMA:</td><td id="sumaiw2"><?php echo array_sum($sumaiw);?></td>
            <td id="sumaicw2"><?php echo array_sum($sumaicw);?></td>
            <td id="sumail2"><?php echo array_sum($sumail);?></td>
            <td id="sumaip2"><?php echo array_sum($sumaip);?></td>
            <td id="sumais2"><?php echo array_sum($sumais);?></td>
            <td id="sumall2"><?php echo array_sum($sumaicw)+array_sum($sumaiw)+array_sum($sumail)
            +array_sum($sumaip)+array_sum($sumais);?></td></tr>
    </table>
        <input type="hidden" name="wykladowca_imie" value="<?php echo $wykladowca[1];?>"/>
        <input type="hidden" name="wykladowca_nazwisko" value="<?php echo $wykladowca[0];?>"/>
        <input type="hidden" name="rok_akademicki" value="<?php echo $rok_akademicki;?>"/>
        <input type="hidden" name="semestr_ZL" value="<?php echo $semestr_ZL;?>"/>
        <input type="hidden" name="jezyk" value="EN"/>
        <input type="hidden" name="wydzial" value="1"/>
        <div id="formAppend2"></div>
       
        <button class="btn btn-sm btn-success" style="display:none;" id="save2" onclick="GetCellValues2();" type="submit" ><i class="fas fa-save"></i> zapisz</button>
    <p style="margin-top:4%; font-size:0.9em;"><em>Obciążenia przyjmuję do wykonania dn <?php echo date('Y-m-d');?>,
            <span style="margin-left:15%"> podpis ..................................................</span></em></p>
            <h6 class="text-center" style="margin-top:7%;font-weight:800 !important;">ROZLICZENIE</h6>						
            <h6 class="text-center">OBCIĄŻENIE WYKONANE zgodnie / niezgodnie z planem<sup>*</sup>    </h6>
            <h6 class="text-center">Zmiana planu<sup>*</sup>    </h6>
            <p class="text-muted text-left" style="margin-top:4%; font-size:0.9em;"><em>Potwierdzam wykonanie zajęć</em></p>
            <p class="text-muted text-left" style="font-size:0.9em;"><em>Podpis kierownika Dziekanatu .............................................................		
</em></p>

</div>
       
</div>   
         <?php }
        ?>
        
        
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
<script>
    
     function toggleTrash(){
         document.getElementsByClassName("znik").forEach(koszyk => koszyk.style.display="block");
         document.getElementById("suma").colSpan = "5";
         document.getElementById("liczba").colSpan = "2";
         document.getElementById("toggleedit").innerHTML = "<button class=\"btn btn-warning\" onclick=\"toggleBack();\"><i class=\"<i class=\"fas fa-share-square\"></i>\"></i> Wróć z edycji</button>";
         document.getElementsByClassName("edit").forEach(edit => edit.setAttribute('contenteditable','true'));
         document.getElementById("save").style.display="block";
     }
     function toggleTrash2(){
         document.getElementsByClassName("znik2").forEach(koszyk => koszyk.style.display="block");
         document.getElementById("suma2").colSpan = "5";
         document.getElementById("liczba2").colSpan = "2";
         document.getElementById("toggleedit2").innerHTML = "<button class=\"btn btn-warning\" onclick=\"toggleBack2();\"><i class=\"<i class=\"fas fa-share-square\"></i>\"></i> Wróć z edycji</button>";
         document.getElementsByClassName("edit2").forEach(edit => edit.setAttribute('contenteditable','true'));
         document.getElementById("save2").style.display="block";
     }
     function toggleBack() {
       document.getElementsByClassName("znik").forEach(koszyk => koszyk.style.display="none");  
       document.getElementById("suma").colSpan = "4";
       document.getElementById("liczba").colSpan = "1";
       document.getElementById("toggleedit").innerHTML = "<button class=\"btn btn-default\" onclick=\"toggleTrash();\"><i class=\"fas fa-pen\"></i> Edytuj</button>";
       document.getElementsByClassName("edit").forEach(edit => edit.setAttribute('contenteditable','false'));
        document.getElementById("save").style.display="none";
     }function toggleBack2() {
       document.getElementsByClassName("znik2").forEach(koszyk => koszyk.style.display="none");  
       document.getElementById("suma2").colSpan = "4";
       document.getElementById("liczba2").colSpan = "1";
       document.getElementById("toggleedit2").innerHTML = "<button class=\"btn btn-default\" onclick=\"toggleTrash2();\"><i class=\"fas fa-pen\"></i> Edytuj</button>";
       document.getElementsByClassName("edit2").forEach(edit => edit.setAttribute('contenteditable','false'));
        document.getElementById("save2").style.display="none";
     }
     function eDit(element) {
         const sumaiw=[];
         document.getElementsByClassName("iw").forEach(iwa => sumaiw.push(Number(iwa.innerText)));
         let sumiw=sumaiw.reduce((partialSum, a) => partialSum + a, 0);
         document.getElementById("sumaiw").innerText=sumiw;
          const sumaicw=[];
         document.getElementsByClassName("icw").forEach(iwa => sumaicw.push(Number(iwa.innerText)));
         let sumicw=sumaicw.reduce((partialSum, a) => partialSum + a, 0);
         document.getElementById("sumaicw").innerText=sumicw;
         const sumail=[];
         document.getElementsByClassName("il").forEach(iwa => sumail.push(Number(iwa.innerText)));
         let sumil=sumail.reduce((partialSum, a) => partialSum + a, 0);
         document.getElementById("sumail").innerText=sumil;
          const sumaip=[];
         document.getElementsByClassName("ip").forEach(iwa => sumaip.push(Number(iwa.innerText)));
         let sumip=sumaip.reduce((partialSum, a) => partialSum + a, 0);
         document.getElementById("sumaip").innerText=sumip;
           const sumais=[];
         document.getElementsByClassName("is").forEach(iwa => sumais.push(Number(iwa.innerText)));
         let sumis=sumais.reduce((partialSum, a) => partialSum + a, 0);
         document.getElementById("sumais").innerText=sumis;
         let sum_1=Number(document.getElementById("sumais").innerText);
         let sum_2=Number(document.getElementById("sumaip").innerText);
         let sum_3=Number(document.getElementById("sumail").innerText);
         let sum_4=Number(document.getElementById("sumaicw").innerText);
         let sum_5=Number(document.getElementById("sumaiw").innerText);
         var sumaall=sum_1+sum_2+sum_3+sum_4+sum_5;
         document.getElementById("sumall").innerText=sumaall;
        <?php 
        $scount=1;
        do {
            echo "let sw$scount=Number(document.getElementById(\"iw$scount\").innerText);\n";
            echo "let scw$scount=Number(document.getElementById(\"icw$scount\").innerText);\n";
            echo "let sl$scount=Number(document.getElementById(\"il$scount\").innerText);\n";
            echo "let sp$scount=Number(document.getElementById(\"ip$scount\").innerText);\n";
            echo "let ss$scount=Number(document.getElementById(\"is$scount\").innerText);\n";
            ?>
             var rowsum<?php echo $scount;?>= sw<?php echo $scount;?>+scw<?php echo $scount;?>+sl<?php echo $scount;?>+sp<?php echo $scount;?>+ss<?php echo $scount;?>;                 
             document.getElementById("row<?php echo $scount;?>").innerText=rowsum<?php echo $scount;?>; 
                          <?php
            $scount++;
        }while ($scount<$lp);
        ?>
        
     }
      function eDit2(element) {
         const sumaiw=[];
         document.getElementsByClassName("iw2").forEach(iwa => sumaiw.push(Number(iwa.innerText)));
         let sumiw=sumaiw.reduce((partialSum, a) => partialSum + a, 0);
         document.getElementById("sumaiw2").innerText=sumiw;
          const sumaicw=[];
         document.getElementsByClassName("icw2").forEach(iwa => sumaicw.push(Number(iwa.innerText)));
         let sumicw=sumaicw.reduce((partialSum, a) => partialSum + a, 0);
         document.getElementById("sumaicw2").innerText=sumicw;
         const sumail=[];
         document.getElementsByClassName("il2").forEach(iwa => sumail.push(Number(iwa.innerText)));
         let sumil=sumail.reduce((partialSum, a) => partialSum + a, 0);
         document.getElementById("sumail2").innerText=sumil;
          const sumaip=[];
         document.getElementsByClassName("ip2").forEach(iwa => sumaip.push(Number(iwa.innerText)));
         let sumip=sumaip.reduce((partialSum, a) => partialSum + a, 0);
         document.getElementById("sumaip2").innerText=sumip;
           const sumais=[];
         document.getElementsByClassName("is2").forEach(iwa => sumais.push(Number(iwa.innerText)));
         let sumis=sumais.reduce((partialSum, a) => partialSum + a, 0);
         document.getElementById("sumais2").innerText=sumis;
         let sum_1=Number(document.getElementById("sumais2").innerText);
         let sum_2=Number(document.getElementById("sumaip2").innerText);
         let sum_3=Number(document.getElementById("sumail2").innerText);
         let sum_4=Number(document.getElementById("sumaicw2").innerText);
         let sum_5=Number(document.getElementById("sumaiw2").innerText);
         var sumaall=sum_1+sum_2+sum_3+sum_4+sum_5;
         document.getElementById("sumall2").innerText=sumaall;
        <?php 
        $scount=1;
        do {
            echo "let sw$scount=Number(document.getElementById(\"iw2_$scount\").innerText);\n";
            echo "let scw$scount=Number(document.getElementById(\"icw2_$scount\").innerText);\n";
            echo "let sl$scount=Number(document.getElementById(\"il2_$scount\").innerText);\n";
            echo "let sp$scount=Number(document.getElementById(\"ip2_$scount\").innerText);\n";
            echo "let ss$scount=Number(document.getElementById(\"is2_$scount\").innerText);\n";
            ?>
             var rowsum2_<?php echo $scount;?>= sw<?php echo $scount;?>+scw<?php echo $scount;?>+sl<?php echo $scount;?>+sp<?php echo $scount;?>+ss<?php echo $scount;?>;                 
             document.getElementById("row2_<?php echo $scount;?>").innerText=rowsum2_<?php echo $scount;?>; 
                          <?php
            $scount++;
        }while ($scount<$lp2);
        ?>
        
     }
      function rowAdd(tableid,lastrow){
         var tabela = document.getElementById(tableid);
         var row = tabela.insertRow(lastrow+2);
         nrwiersza=lastrow+1;
         var kosz=row.insertCell(0);
         row.id="rowek"+nrwiersza;
         var liczbaP=row.insertCell(1);
         var symbolS=row.insertCell(2);
         var Przedmiot=row.insertCell(3);
         var Grupy=row.insertCell(4);
         var noweW=row.insertCell(5);
          noweW.id="iw"+nrwiersza;
          noweW.classList.add("edit");
          noweW.classList.add("iw");
          noweW.innerHTML="0";
          //noweW.onclick=eDit("row"+nrwiersza);
          
          var noweCW=row.insertCell(6);
          noweCW.id="icw"+nrwiersza;
          noweCW.classList.add("edit");
          noweCW.classList.add("icw");
          noweCW.innerHTML="0";
          
         var noweL=row.insertCell(7);
          noweL.id="il"+nrwiersza;
          noweL.classList.add("edit");
          noweL.classList.add("il");
          noweL.innerHTML="0";
          
         var noweP=row.insertCell(8);
          noweP.id="ip"+nrwiersza;
          noweP.classList.add("edit");
          noweP.classList.add("ip");
          noweP.innerHTML="0";
          
         var noweS=row.insertCell(9);
          noweS.id="is"+nrwiersza;
          noweS.classList.add("edit");
          noweS.classList.add("is");
          noweS.innerHTML="0";
          
         var noweR=row.insertCell(10);
          noweR.id="row"+nrwiersza;
          noweR.classList.add("edit");
          noweR.classList.add("ir");
         // noweR.onclick=eDit("row"+nrwiersza);
          noweR.setAttribute("onclick","eDit('row"+nrwiersza+"');przeliczNowyWiersz(\""+noweW.id+"\",\""+noweCW.id+"\",\""+noweL.id+"\",\""+noweP.id+"\",\""+noweS.id+"\",\""+noweR.id+"\");");
          noweW.setAttribute("onclick","eDit('row"+nrwiersza+"');przeliczNowyWiersz(\""+noweW.id+"\",\""+noweCW.id+"\",\""+noweL.id+"\",\""+noweP.id+"\",\""+noweS.id+"\",\""+noweR.id+"\");");
          noweS.setAttribute("onclick","eDit('row"+nrwiersza+"');przeliczNowyWiersz(\""+noweW.id+"\",\""+noweCW.id+"\",\""+noweL.id+"\",\""+noweP.id+"\",\""+noweS.id+"\",\""+noweR.id+"\");");
          noweP.setAttribute("onclick","eDit('row"+nrwiersza+"');przeliczNowyWiersz(\""+noweW.id+"\",\""+noweCW.id+"\",\""+noweL.id+"\",\""+noweP.id+"\",\""+noweS.id+"\",\""+noweR.id+"\");");
          noweCW.setAttribute("onclick","eDit('row"+nrwiersza+"');przeliczNowyWiersz(\""+noweW.id+"\",\""+noweCW.id+"\",\""+noweL.id+"\",\""+noweP.id+"\",\""+noweS.id+"\",\""+noweR.id+"\");");
          noweL.setAttribute("onclick","eDit('row"+nrwiersza+"');przeliczNowyWiersz(\""+noweW.id+"\",\""+noweCW.id+"\",\""+noweL.id+"\",\""+noweP.id+"\",\""+noweS.id+"\",\""+noweR.id+"\");");
         kosz.innerHTML="<i class=\"far fa-trash-alt red-text\" onclick=\"usunRowek('rowek"+nrwiersza+"');\"></i>";
         kosz.style.border="0px";
         liczbaP.innerText=nrwiersza;
         symbolS.setAttribute('contenteditable','true');
         Przedmiot.setAttribute('contenteditable','true');
         Grupy.setAttribute('contenteditable','true');
         noweW.setAttribute('contenteditable','true');
         noweCW.setAttribute('contenteditable','true');
         noweL.setAttribute('contenteditable','true');
         noweP.setAttribute('contenteditable','true');
         noweS.setAttribute('contenteditable','true');
         noweR.setAttribute('contenteditable','true');
         //sumowanie wierszy
        // Wid="\"iw"+nrwiersza+"\"";
        
         
     }
      function rowAdd2(tableid,lastrow){
         var tabela = document.getElementById(tableid);
         var row = tabela.insertRow(lastrow+2);
         nrwiersza=lastrow+1;
         var kosz=row.insertCell(0);
         row.id="rowek2_"+nrwiersza;
         var liczbaP=row.insertCell(1);
         var symbolS=row.insertCell(2);
         var Przedmiot=row.insertCell(3);
         var Grupy=row.insertCell(4);
         var noweW=row.insertCell(5);
          noweW.id="iw2_"+nrwiersza;
          noweW.classList.add("edit2");
          noweW.classList.add("iw2");
          noweW.innerHTML="0";
          //noweW.onclick=eDit("row"+nrwiersza);
          
          var noweCW=row.insertCell(6);
          noweCW.id="icw2_"+nrwiersza;
          noweCW.classList.add("edit2");
          noweCW.classList.add("icw2");
          noweCW.innerHTML="0";
          
         var noweL=row.insertCell(7);
          noweL.id="il2_"+nrwiersza;
          noweL.classList.add("edit2");
          noweL.classList.add("il2");
          noweL.innerHTML="0";
          
         var noweP=row.insertCell(8);
          noweP.id="ip2_"+nrwiersza;
          noweP.classList.add("edit2");
          noweP.classList.add("ip2");
          noweP.innerHTML="0";
          
         var noweS=row.insertCell(9);
          noweS.id="is2_"+nrwiersza;
          noweS.classList.add("edit2");
          noweS.classList.add("is2");
          noweS.innerHTML="0";
          
         var noweR=row.insertCell(10);
          noweR.id="row2_"+nrwiersza;
          noweR.classList.add("edit2");
          noweR.classList.add("ir2");
         // noweR.onclick=eDit("row"+nrwiersza);
          noweR.setAttribute("onclick","eDit2('row2_"+nrwiersza+"');przeliczNowyWiersz(\""+noweW.id+"\",\""+noweCW.id+"\",\""+noweL.id+"\",\""+noweP.id+"\",\""+noweS.id+"\",\""+noweR.id+"\");");
          noweW.setAttribute("onclick","eDit2('row2_"+nrwiersza+"');przeliczNowyWiersz(\""+noweW.id+"\",\""+noweCW.id+"\",\""+noweL.id+"\",\""+noweP.id+"\",\""+noweS.id+"\",\""+noweR.id+"\");");
          noweS.setAttribute("onclick","eDit2('row2_"+nrwiersza+"');przeliczNowyWiersz(\""+noweW.id+"\",\""+noweCW.id+"\",\""+noweL.id+"\",\""+noweP.id+"\",\""+noweS.id+"\",\""+noweR.id+"\");");
          noweP.setAttribute("onclick","eDit2('row2_"+nrwiersza+"');przeliczNowyWiersz(\""+noweW.id+"\",\""+noweCW.id+"\",\""+noweL.id+"\",\""+noweP.id+"\",\""+noweS.id+"\",\""+noweR.id+"\");");
          noweCW.setAttribute("onclick","eDit2('row2_"+nrwiersza+"');przeliczNowyWiersz(\""+noweW.id+"\",\""+noweCW.id+"\",\""+noweL.id+"\",\""+noweP.id+"\",\""+noweS.id+"\",\""+noweR.id+"\");");
          noweL.setAttribute("onclick","eDit2('row2_"+nrwiersza+"');przeliczNowyWiersz(\""+noweW.id+"\",\""+noweCW.id+"\",\""+noweL.id+"\",\""+noweP.id+"\",\""+noweS.id+"\",\""+noweR.id+"\");");
         kosz.innerHTML="<i class=\"far fa-trash-alt red-text\" onclick=\"usunRowek2('rowek2_"+nrwiersza+"');\"></i>";
         kosz.style.border="0px";
         liczbaP.innerText=nrwiersza;
         symbolS.setAttribute('contenteditable','true');
         Przedmiot.setAttribute('contenteditable','true');
         Grupy.setAttribute('contenteditable','true');
         noweW.setAttribute('contenteditable','true');
         noweCW.setAttribute('contenteditable','true');
         noweL.setAttribute('contenteditable','true');
         noweP.setAttribute('contenteditable','true');
         noweS.setAttribute('contenteditable','true');
         noweR.setAttribute('contenteditable','true');
         //sumowanie wierszy
        // Wid="\"iw"+nrwiersza+"\"";
        
         
     }
     function usunRowek(rowekid) {
        document.getElementById(rowekid).style.display = "none";
        document.getElementById(rowekid).innerHTML="";
        eDit();
     }
     function przeliczNowyWiersz(w,cw,s,p,l,r){
        sumaW=Number(document.getElementById(w).innerText)+Number(document.getElementById(cw).innerText)+Number(document.getElementById(s).innerText)+Number(document.getElementById(p).innerText)+Number(document.getElementById(l).innerText);
         console.log(w);
         document.getElementById(r).innerText=sumaW;
    }
      function usunRowek2(rowekid) {
        document.getElementById(rowekid).style.display = "none";
        document.getElementById(rowekid).innerHTML="";
        eDit2();
     }
     function GetCellValues() {
        var table = Array.prototype.map.call(document.querySelectorAll('#example tr'), function(tr){
        return Array.prototype.map.call(tr.querySelectorAll('td'), function(td){
         return td.innerText;
         });
          });
          const naglowek=table.pop();
          //const naglowek2=table.pop();
          //const stopka=table.shift();
          //let rowArray=[];
        
          let tablestring=table.join("|;;|");
         // console.log(tablestring);
          document.getElementById("formAppend").innerHTML="<input type=\"hidden\" name=\"tabelka\" value=\"" + tablestring +"\"/>";
  
}
     function GetCellValues2() {
        var table = Array.prototype.map.call(document.querySelectorAll('#example2 tr'), function(tr){
        return Array.prototype.map.call(tr.querySelectorAll('td'), function(td){
         return td.innerText;
         });
          });
          const naglowek=table.pop();
          //const naglowek2=table.pop();
          //const stopka=table.shift();
          //let rowArray=[];
        
          let tablestring=table.join("|;;|");
         // console.log(tablestring);
          document.getElementById("formAppend2").innerHTML="<input type=\"hidden\" name=\"tabelka\" value=\"" + tablestring +"\"/>";
  
}
</script>

</html>

