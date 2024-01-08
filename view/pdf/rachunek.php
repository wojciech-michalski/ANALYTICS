
<style type="text/Css">
<!--
p
{
    font-size:12px;
    color:black;
}
.imnaz {
    font-size:14px;
}
.data {
    font-size:15px;
    font-weight:bold;
}
.razem {
    background-color:gray;
    font-weight:bold;
}
.podpis {
    font-size:11px;
    color:gray;
    margin-top:35px;
}
td {
    padding:4px;
    font-size:11px;
}
table.fixed { table-layout:fixed; }
table.fixed tr td{
word-wrap:break-word;
}
.symbol {
    width:250px;
}
.przedmiot {
    width:250px;
}
-->
</style>
<page>
    
    
    <p style='text-align:right;'>Załącznik nr 1 do umowy</p>
     <p style='text-align:right;'>Warszawa dn. <?php echo $rach_details[2];?></p>
     <h3 style='text-align: center;' >Wystawca rachunku - Zleceniobiorca</h3>
     <p class='imnaz'>Imię i Nazwisko: <span class='data'><?php echo "$tyt_zaw[0] $rach_details[wykladowca_imie] $rach_details[wykladowca_nazwisko]";?></span></p>
     <p class='imnaz'>PESEL: <span class='data'><?php echo $rach_details['pesel'] ;?></span></p>
     <p>Rachunek (całkowity/częściowy) * - potwierdzenie liczby godzin wykonania zlecenia</p>
          <p class='imnaz'> Za miesiąc: <span class='data'><?php echo $posarray[0]['miesiac'];?></span></p>
          <table class="fixed" border='0.5' cellspacing='0' >
               
              <tr>   
            <th  rowspan="2" style="font-size:0.8em;" id="liczba" style="width:2rem;">L.P.</th>
            <th rowspan="2" style="font-size:0.8em;" class='symbol'>Symbol studiów</th>
            <th rowspan="2" style="font-size:0.8em;" class='przedmiot'>Przedmiot</th>
          
            <th  colspan="5" style="font-size:0.8em;">Liczba</th>
            <th rowspan="2" style="font-size:0.8em;">Razem</th></tr>
        <tr>
            <th style="width:20px; font-size:0.7em;">w</th><th style="width:20px;">ć</th><th style="width:20px;">l</th><th style="width:20px;">p</th>
            <th style="width:20px;">s</th></tr>
        <?php 
        $lp=1;
        foreach ($posarray as $obciazenie){
     //       switch($obciazenie['forma']){
     //          case "Projekt":
     //          case "projekt":
     //              $p[$lp]=$obciazenie['godziny'];
     //              $l[$lp]=0;
    //               $c[$lp]=0;
     //              $w[$lp]=0;
    //               $s[$lp]=0;
     //              break;
    //           case "Lab.":
     //          case "laboratorium":
     //          case "lab.":
     //              $l[$lp]=$obciazenie['godziny'];
      //             $c[$lp]=0;
      //             $p[$lp]=0;
      //             $w[$lp]=0;
     //              $s[$lp]=0;
     //              break;
     //          case "ćwiczenia":
    //          case "Ćwiczenia":
    //               $c[$lp]=$obciazenie['godziny'];
    //               $l[$lp]=0;
    //               $p[$lp]=0;
    //               $w[$lp]=0;
     //              $s[$lp]=0;
     //              break;
     //          case "Wykład":
     //          case "wykład":
    //               $w[$lp]=$obciazenie['godziny'];
     //              $l[$lp]=0;
     //              $p[$lp]=0;
     //              $c[$lp]=0;
     //              $s[$lp]=0;
      //             break;
     //          case "Seminarium":
     //          case "seminarium":
     //              $s[$lp]=$obciazenie['godziny'];
     //              $l[$lp]=0;
     //              $p[$lp]=0;
     //              $c[$lp]=0;
     //              $w[$lp]=0;
     //              break;
               
               
    //        }
            $suma=$obciazenie['w']+$obciazenie['c']+$obciazenie['l']+$obciazenie['p']+$obciazenie['s'];
            $w[]=$obciazenie['w'];
            $c[]=$obciazenie['c'];
            $l[]=$obciazenie['l'];
            $p[]=$obciazenie['p'];
            $s[]=$obciazenie['s'];
            echo "<tr><td>$lp</td><td class=\"symbol\">$obciazenie[symbol]</td><td class=\"przedmiot\">$obciazenie[przedmiot]</td>"
                    . "<td>$obciazenie[w]</td><td>$obciazenie[c]</td><td>$obciazenie[l]</td><td>$obciazenie[p]</td>"
                    . "<td>$obciazenie[s]</td><td>$suma</td></tr>";
            $lp++;
        }
        ?>
        <tr><td colspan='3' style='text-align:right;'>RAZEM:</td><td class='razem'><?php echo array_sum($w);?></td><td class='razem'><?php echo array_sum($c);?></td>
            <td class='razem'><?php echo array_sum($l);?></td><td class='razem'><?php echo array_sum($p);?></td><td class='razem'><?php echo array_sum($s);?></td><td class='razem'>
                <?php echo array_sum($w)+array_sum($s)+array_sum($p)+array_sum($l)+array_sum($c);?>
            </td></tr>
          </table>
          <div style='margin-top:50px;'>
          <div style="display: inline-block;">
          <p class='data' ><?php echo "$tyt_zaw[0] $rach_details[wykladowca_imie] $rach_details[wykladowca_nazwisko]";?></p>
          <p class='podpis'>..........................................................<br/><!-- comment -->
              <em>(Podpis Wykładowcy-Zleceniobiorcy)</em></p></div>
          <div style="display: inline-block; position:relative;top:-110px;">
          <p class='data' style='text-align:right;'>Potwierdzam wykonanie zajęć</p>
          <p class='podpis' style='text-align:right;'>..............................................................<br/><!-- comment -->
              <em>(Pieczęć i podpis Kierownika Jednostki<br/><!-- comment -->
                  Dydaktycznej lub osoby upoważnionej)</em></p></div>
          </div>
                  <p>Liczba godzin ćwiczeń: <?php echo array_sum($c)+array_sum($l)+array_sum($p);?> x stawka za 1 godz. ............................zł brutto</p>
                  <p>Liczba godzin wykładów: <?php echo array_sum($w);?> x stawka za 1 godz. ............................zł brutto</p>
                  <p>Na ogólną kwotę rachunku brutto: ............................................................zł</p>
                  <p>Słownie .......................................................................................................</p>
                  <p class='data' style='margin-top:50px;' ><?php echo "$tyt_zaw[0] $rach_details[wykladowca_imie] $rach_details[wykladowca_nazwisko]";?></p>
                  <p class='podpis'>..........................................................<br/><!-- comment -->
              <em>(Podpis Wykładowcy-Zleceniobiorcy)</em></p>
</page>

