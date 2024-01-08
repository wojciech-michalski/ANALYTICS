<?php
       include('view/topnav.php');
       $ankieta_array=explode("-",$_POST['analiza']);
       $ankieta_dirty=$ankieta_array[1];
       $ankieta_cleaner=explode("20",$ankieta_dirty);
       $ankieta_clean=$ankieta_cleaner[0];
      
       $query=mysqli_query($kon,"SELECT * FROM `$_POST[analiza]` WHERE 1");
             
$ile=mysqli_num_rows($query);
$n=0;
$naglowki=mysqli_query($kon,"DESCRIBE `$_POST[analiza]`");
$ile_naglowkow=mysqli_num_rows($naglowki);
$k=0;
$rok_a=substr($_POST['analiza'],-11,11);
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
            <span>ANALIZA ANKIETY</span>
          </h4>

          

        </div>

      </div>
              <div class="row wow fadeIn">

        <!--Grid column-->
        <div class="col-md-12 mb-4">

          <!--Card-->
          
     <div class="card">
         
        <div class="card-header text-center"><?php echo $_POST['analiza'];?>
        <button class="btn btn-info btn-sm" data-toggle="modal" href="#" data-target="#modal-linki">Pokaż linki</button></div></div>
          
<div class="card-body">
    
      
    <h5>Wypełniono <?php echo $ile;?> ankiet</h5>
    <a href="exports/csv/export.csv"><button type="button" class="btn btn-primary">Pobierz plik CSV</button></a>
 <a class="button btn btn-unique" href="main.php?mode=deanreport6">Powrót</a>

        <?php
       // echo $ankieta_clean;
        do {
            $naglowek=mysqli_fetch_array($naglowki);
                        $csvhead[]="\"$naglowek[Field]\"";
            $k=$k+1;
        }
        while($k<$ile_naglowkow);
        $csvfirstrow=implode(";",$csvhead);
        ?>
  
      <?php
        do {
            $wiersz=mysqli_fetch_array($query);
            $n=$n+1;
        
            $j=0;
                        do {
                     
                            $csvrow[]="\"$wiersz[$j]\"";
                            $j=$j+1;
                             
                        }
                        while($j<$ile_naglowkow);
                    
                        $csvrows[]=implode(";",$csvrow);
                        unset($csvrow);
        }
      while($n<$ile);
      $csvrestrows=implode("\n",$csvrows);
      ?>
 
    <?php 
    //print_r($csvhead);
    $csvcomplete="$csvfirstrow \n $csvrestrows";
    //$csv=fopen('/var/www/html/naklad_pracy/MP/csv/export.csv',w);
    file_put_contents('/var/www/html/Analytics/exports/csv/export.csv', $csvcomplete);
    //fclose($csv);
        $naklad_pracy=mysqli_query($kon,"SELECT `imie`,`nazwisko`,`przedmiot`,`kierunek`,`stopien`,"
                . "`forma` FROM `$_POST[analiza]` WHERE 1 GROUP BY `przedmiot`");
        if(mysqli_num_rows($naklad_pracy)>0){
        foreach($csvhead as $klucz){
            $klucz=str_replace("\"","",$klucz);
            $cleanarray[$klucz]=0;
        }
        //print_r($cleanarray);
        foreach($csvhead as $pytanie){
            
             $pytanie=str_replace("\"","",$pytanie);
             switch ($pytanie){
                 case "kierunek":
                     case "przedmiot":
                 case "nazwisko":
                 case "L. godzin samodzielnej pracy w ramach przedmiotu jest:":
                 case "stopien":
                 case "forma":
                 case "rok_akademicki":
                     break;
                     
                 default:
        foreach($naklad_pracy as $przedmiot){
           
        
            $labels[]=$przedmiot['przedmiot'] ;
           // echo "SELECT `$pytanie` FROM `$_POST[analiza]` WHERE `przedmiot`="
            //        . "'$przedmiot[przedmiot]' AND `nazwisko`='$przedmiot[nazwisko]' AND `kierunek`='$przedmiot[kierunek]'"
           //         . " AND `stopien`='$przedmiot[stopien]' AND `forma`='$przedmiot[forma]'";
            $wartosc=mysqli_fetch_array(mysqli_query($kon,"SELECT SUM(`$pytanie`) FROM `$_POST[analiza]` WHERE `przedmiot`="
                    . "'$przedmiot[przedmiot]' AND `kierunek`='$przedmiot[kierunek]'"
                    . " AND `stopien`='$przedmiot[stopien]' AND `forma`='$przedmiot[forma]' AND "
                    . "`$pytanie`<>'L. godzin samodzielnej pracy w ramach przedmiotu jest:' AND `$pytanie`<>'nazwisko' "
                    . "AND `$pytanie`<>'przedmiot' AND `$pytanie`<>'kierunek' AND `$pytanie`<>'stopien' AND `$pytanie`<>'forma'"));
            if(is_numeric($wartosc[0])){
            $values["$przedmiot[przedmiot]"]=$values[$przedmiot['przedmiot']]+$wartosc[0];
           
            //AND `nazwisko`='$przedmiot[nazwisko]'
          //echo "$przedmiot[przedmiot] $pytanie $wartosc[0] <br/>";
           }
        }
             }
        }
        //print_r($values);
        //print_r($csvhead);
        $labels=array_unique($labels);
        foreach($naklad_pracy as $przedmiot){
            $p="$przedmiot[przedmiot] $przedmiot[nazwisko] $przedmiot[kierunek] $przedmiot[forma]$przedmiot[stopien]";
            foreach($csvhead as $pytanie){
                $pytanie=str_replace("\"","",$pytanie);
             switch ($pytanie){
                 case "kierunek":
                     case "przedmiot":
                 case "nazwisko":
                 case "L. godzin samodzielnej pracy w ramach przedmiotu jest:":
                 case "stopien":
                 case "forma":
                 case "rok_akademicki":
                     break;
                 default:
                    $wartosc=mysqli_fetch_array(mysqli_query($kon,"SELECT SUM(`$pytanie`) FROM `$_POST[analiza]` WHERE `przedmiot`="
                    . "'$przedmiot[przedmiot]' AND `kierunek`='$przedmiot[kierunek]'"
                    . " AND `stopien`='$przedmiot[stopien]' AND `forma`='$przedmiot[forma]' AND "
                    . "`$pytanie`<>'L. godzin samodzielnej pracy w ramach przedmiotu jest:' AND `$pytanie`<>'nazwisko' "
                    . "AND `$pytanie`<>'przedmiot' AND `$pytanie`<>'kierunek' AND `$pytanie`<>'stopien' AND `$pytanie`<>'forma'"));
                     $ilosc=mysqli_num_rows(mysqli_query($kon,"SELECT `$pytanie` FROM `$_POST[analiza]` WHERE `przedmiot`="
                    . "'$przedmiot[przedmiot]' AND `kierunek`='$przedmiot[kierunek]'"
                    . " AND `stopien`='$przedmiot[stopien]' AND `forma`='$przedmiot[forma]' AND "
                    . "`$pytanie`<>'L. godzin samodzielnej pracy w ramach przedmiotu jest:' AND `$pytanie`<>'nazwisko' "
                    . "AND `$pytanie`<>'przedmiot' AND `$pytanie`<>'kierunek' AND `$pytanie`<>'stopien' AND `$pytanie`<>'forma'"));
                     if($ilosc>0){
                         $srednia=round ($wartosc[0]/$ilosc,2);
                         $wartosci[$pytanie]=$srednia;
             }
             break;
                     }
                     
                     
            }
            $wyniki[$p]=$wartosci;
        }
      // print_r($wyniki);
       $iw= count($wyniki);
        foreach ($wyniki as $przedmiot_wyniki){
            $val['Lektura literatury niezbędnej do realizacji przedmiotu']=
                    $val['Lektura literatury niezbędnej do realizacji przedmiotu']+
                    $przedmiot_wyniki['Lektura literatury niezbędnej do realizacji przedmiotu'];
            $sredval['Lektura literatury niezbędnej do realizacji przedmiotu']=
                    round($val['Lektura literatury niezbędnej do realizacji przedmiotu']/$iw,2);
            
            $val['Przygotowanie się do zajęć']=
                    $val['Przygotowanie się do zajęć']+
                    $przedmiot_wyniki['Przygotowanie się do zajęć'];
            $sredval['Przygotowanie się do zajęć']=
                    round($val['Przygotowanie się do zajęć']/$iw,2);
            
              $val['Samodzielne ćwiczenia']=
                    $val['Samodzielne ćwiczenia']+
                    $przedmiot_wyniki['Samodzielne ćwiczenia'];
            $sredval['Samodzielne ćwiczenia']=
                    round($val['Samodzielne ćwiczenia']/$iw,2);
            
            $val['Opracowanie wyników np. ćwiczeń']=
                    $val['Opracowanie wyników np. ćwiczeń']+
                    $przedmiot_wyniki['Opracowanie wyników np. ćwiczeń'];
            $sredval['Opracowanie wyników np. ćwiczeń']=
                    round($val['Opracowanie wyników np. ćwiczeń']/$iw,2);
            
            $val['Wykonanie projektów']=
                    $val['Wykonanie projektów']+
                    $przedmiot_wyniki['Wykonanie projektów'];
            $sredval['Wykonanie projektów']=
                    round($val['Wykonanie projektów']/$iw,2);
            
            $val['Raporty, prawozdania, prezentacje, inne prace pisemne']=
                    $val['Raporty, prawozdania, prezentacje, inne prace pisemne']+
                    $przedmiot_wyniki['Raporty, prawozdania, prezentacje, inne prace pisemne'];
            $sredval['Raporty, prawozdania, prezentacje, inne prace pisemne']=
                    round($val['Raporty, prawozdania, prezentacje, inne prace pisemne']/$iw,2);
            
            $val['Przygotowanie pracy zaliczeniowej']=
                    $val['Przygotowanie pracy zaliczeniowej']+
                    $przedmiot_wyniki['Przygotowanie pracy zaliczeniowej'];
            $sredval['Przygotowanie pracy zaliczeniowej']=
                    round($val['Przygotowanie pracy zaliczeniowej']/$iw,2);
            
            $val['Przygotowanie się do sprawdzianu/kolokwium']=
                    $val['Przygotowanie się do sprawdzianu/kolokwium']+
                    $przedmiot_wyniki['Przygotowanie się do sprawdzianu/kolokwium'];
            $sredval['Przygotowanie się do sprawdzianu/kolokwium']=
                    round($val['Przygotowanie się do sprawdzianu/kolokwium']/$iw,2);
            
            $val['Przygotowanie się do egzaminu']=
                    $val['Przygotowanie się do egzaminu']+
                    $przedmiot_wyniki['Przygotowanie się do egzaminu'];
            $sredval['Przygotowanie się do egzaminu']=
                    round($val['Przygotowanie się do egzaminu']/$iw,2);
            
            $val['Inne (jakie?)']=
                    $val['Inne (jakie?)']+
                    $przedmiot_wyniki['Inne (jakie?)'];
            $sredval['Inne (jakie?)']=
                    round($val['Inne (jakie?)']/$iw,2);
        }
       //print_r($sredval);
        $sval=implode(",",$sredval);
        $labelki_=implode("\",\"",array_keys($sredval));
       $labelki= "\"".$labelki_."\"";
      //  echo $sval;
        $script="<script>"
                . "var ctxB = document.getElementById(\"barChart1\").getContext('2d');\n"
                . "var myBarChart = new Chart(ctxB, {\n"
                ."type: 'bar',\n"
                ."data: {\n"
                ."labels: [$labelki],\n"
                . "datasets: [{\n"
                ."label: 'średnia ilość godzin przeznaczona przez studenta',\n"
                . "data:[$sval],\n"
                . "backgroundColor: [\n
          'rgba(244, 67, 54, 0.7)',\n
          'rgba(3, 169, 244, 0.7)',\n
          'rgba(76, 175, 80, 0.7)',\n
          'rgba(255, 152, 0, 0.7)',\n
          'rgba(155, 2, 43, 0.7)',\n
          'rgba(55, 22, 143, 0.7)',\n
          'rgba(11, 111, 211, 0.7)',\n
          'rgba(211, 11, 111, 0.7)',\n
          'rgba(111, 211, 11, 0.7)',\n
          'rgba(0, 188, 212, 0.7)'],\n
        borderWidth: 1\n
      }]\n
    },\n
    options: {\n
      scales: {\n
        yAxes: [{\n
          ticks: {\n
            beginAtZero: true\n
          }\n
        }]\n
      }\n
    }\n
  });\n
  </script>";
        } else {
            echo "brak ankiet";
            
        }
?><canvas id="barChart1"></canvas>
        
            </div>
       </div>
              

         
     </div>
          <!--/.Card-->

        </div>
        <!--Grid column-->

        <!--Grid column-->
        
        <!--Grid column-->

      </div>
        </div>
          <div class="modal fade" id="modal-linki" tabindex="-1" role="dialog" aria-labelledby="modal-linkiModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fluid" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-linkiModalLabel">Linki <?php echo $_POST['analiza'];?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              <?php 
              
             
              $linksquery="SELECT linki_ankiet.link,linki_ankiet.ankieta_nazwa,prowadzacy.rok_akademicki,"
                      . "prowadzacy.kierunek "
                      . "FROM `linki_ankiet` INNER JOIN `prowadzacy` ON linki_ankiet.id_prowadzacy=prowadzacy.id "
                      . "WHERE prowadzacy.rok_akademicki='$rok_a' AND `ankieta`='ocena_nakladu_pracy_studenta';";
                      
                 
             // echo $linksquery;
              ?>
              <table class="table table-striped table-sm">
        <thead><tr><th>L.P.</th>
                        <th>Kierunek studiów</th>
                        <th>link do ankiety</th>
            </tr></thead><tbody><?php
            $links=mysqli_query($kon,$linksquery);
          foreach ($links as $link) {
                    echo "<tr><td>$lp</td><td>$link[kierunek]</td><td>$link[link]</td></tr>";
                }
                ?>       
        </tbody>
              </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
                
            </div>
        </div>
    </div>
        </div> 
      

   
 
 <?php include('view/ocenydyplom_Modal.php');?>
      <?php include('view/footer.php');
      
     echo $script;
 ?>
 
  
  
 
</body>

</html>

