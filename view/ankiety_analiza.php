<?php
       include('view/topnav.php');
       $ankieta_array=explode("-",$_POST['analiza']);
       $ankieta_dirty=$ankieta_array[1];
       $ankieta_cleaner=explode("20",$ankieta_dirty);
       $ankieta_clean=$ankieta_cleaner[0];
      $ac=trim($ankieta_clean);
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
            <span>ANALIZA ANKIETY <?php echo $ac; //echo strlen($ac);
            //echo $ile_naglowkow;?></span>
          </h4>

          

        </div>

      </div>
              <div class="row wow fadeIn">

        <!--Grid column-->
        <div class="col-md-12 mb-4">

          <!--Card-->
          
     <div class="card">
         
        <div class="card-header text-center"><?php echo $_POST['analiza'];?>
            <button class="btn btn-info btn-sm" data-toggle="modal" href="#" data-target="#modal-linki">Pokaż linki</button></div>
          
<div class="card-body">
    <?php switch($ac) {
       case "Ocena pracy nauczyciela":
           $nazwa_solver="Ocena pracy nauczyciela akademickiego";
    ?>
    <form method="POST" action="main.php?mode=survey1">
    <?php //print_r($_POST);
    $przedmioty=mysqli_query($kon,"SELECT `nazwisko`,`imie`,`tytul`,`przedmiot` FROM `$_POST[analiza]` "
            . "GROUP BY `przedmiot`");
    $ip=mysqli_num_rows($przedmioty);
     ?>   <select class="mdb-select" name="wykladowcy" required >
    <option value="" disabled selected>wybierz wykładowcę i przedmiot</option>
    
    <?php
    $k=0;
    do {
        $przedmiot=mysqli_fetch_array($przedmioty);
       $ia=mysqli_num_rows(mysqli_query($kon,"SELECT `rok_akademicki` FROM `$_POST[analiza]` WHERE `imie`='$przedmiot[1]'"
                . " AND `nazwisko`='$przedmiot[0]' AND `przedmiot`='$przedmiot[3]' AND `tytul`='$przedmiot[2]'"));
        //$ia="SELECT `rok_akademicki` FROM `$_POST[analiza]` WHERE `imie`='$przedmiot[1]'"
        //        . " AND `nazwisko`='$przedmiot[0]' AND `przedmiot`='$przedmiot[3]' AND `tytul`='$przedmiot[2]'";
        echo "<option value=\"$przedmiot[3];;$przedmiot[0];;$przedmiot[1];;$przedmiot[2]\">$przedmiot[3] $przedmiot[0] $przedmiot[1] $przedmiot[2] - $ia ankiet</option>";
        $k=$k+1;
    }
    while($k<$ip);
    ?>
</select>
        <input type="hidden" name="analiza" value="<?php echo $_POST['analiza'];?>"/>
        <button type="submit" class="btn btn-unique">Zbadaj</button></form>
        <?php break;
        case "Ocena Administracji":
             ?>
    <form method="POST" action="main.php?mode=survey2">
    <?php //print_r($_POST);
    $kierunki=mysqli_query($kon,"SELECT DISTINCT `kierunek` FROM `$_POST[analiza]` "
            . "WHERE 1");
    $ip=mysqli_num_rows($kierunki);
     ?>   <select class="mdb-select" name="kierunek" required >
    <option value="" disabled selected>wybierz kierunek studiów</option>
    
    <?php
    $k=0;
    do {
        $kierunek=mysqli_fetch_array($kierunki);
        echo "<option>$kierunek[0]</option>";
        $k=$k+1;
    }
    while($k<$ip);
    ?>
</select>
        <input type="hidden" name="analiza" value="<?php echo $_POST['analiza'];?>"/>
        <button type="submit" class="btn btn-unique">Zbadaj</button></form>
        
        
        
    <?php break;
    }
    
        ?>
    
  
    <hr/><h5 class="text-center">Wyniki zagregowane</h5> 
      
    <h5>Wypełniono <?php echo $ile;?> ankiet</h5>
    <a href="exports/csv/export.csv"><button type="button" class="btn btn-primary">Pobierz plik CSV</button></a>
    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#solver">Szukaj korelacji</button>
    <a class="button btn btn-unique" href="main.php?mode=deanreport6">Powrót</a>
<!--<table id="dtMaterialDesignExample" class="table table-striped"  cellspacing="0" width="80%">
  <thead>
    <tr>-->
        <?php
       $k=0;
        do {
            $naglowek=mysqli_fetch_array($naglowki);
            //echo "<th>$naglowek[Field]</th>";
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
          //  echo "<tr>";
            $j=0;
                        do {
                     //       echo "<td>$wiersz[$j]</td>";
                            $csvrow[]="\"$wiersz[$j]\"";
                            $j=$j+1;
                             
                        }
                        while($j<$ile_naglowkow);
                      //  echo "<tr>";
                        $csvrows[]=implode(";",$csvrow);
                        unset($csvrow);
        }
      while($n<$ile);
      $csvrestrows=implode("\n",$csvrows);
      ?>
 <!-- </tbody>

</table>-->
    <?php 
    $csvcomplete="$csvfirstrow \n $csvrestrows";
    //$csv=fopen('/var/www/html/naklad_pracy/MP/csv/export.csv',w);
    file_put_contents('/var/www/html/Analytics/exports/csv/export.csv', $csvcomplete);
    //fclose($csv);
 
    //print_r($csvhead);
    $datachartlabels=implode(",",$csvhead);
     $l=0;
    foreach ($csvhead as $header){
       
        $header=str_replace("\"","",$header);
          
                $labels=array(1,2,3,4,5);
                      
        
        foreach($labels as $label){
            
            $value[$label]=mysqli_num_rows(mysqli_query($kon,"SELECT * FROM `$_POST[analiza]` "
                    . "WHERE `$header`=$label "));
           $datachartvalues=implode(",",$value);
            // echo "SELECT * FROM `$_GET[view]` WHERE `$header`=$label";
        }
        $values[]=$datachartvalues;
        //generowanie js-ów
     
         
       
        $scripts[]="<script>"
                . "var ctxB = document.getElementById(\"barChart$l\").getContext('2d');\n"
                . "var myBarChart = new Chart(ctxB, {\n"
                ."type: 'bar',\n"
                ."data: {\n"
                ."labels: [1,2,3,4,5],\n"
                . "datasets: [{\n"
                ."label: 'ilość odpowiedzi',\n"
                . "data:[$values[$l]],\n"
                . "backgroundColor: [\n
          'rgba(244, 67, 54, 0.7)',\n
          'rgba(3, 169, 244, 0.7)',\n
          'rgba(76, 175, 80, 0.7)',\n
          'rgba(255, 152, 0, 0.7)',\n
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
        $l=$l+1;
    
        }
    
 //echo "<br/> $l";
    $k=0;
    do {
        switch ($csvhead[$k]){
            default:
                 echo "<h3>$csvhead[$k]</h3><canvas id=\"barChart$k\"></canvas>";
                break;
                case "\"DLACZEGO NISKA ?\"":
                case "\"INNE UWAGI I OPINIE\"":
                case "\"imie\"":
                case "\"nazwisko\"":
                case "\"przedmiot\"":
                case "\"tytul\"":
                case "\"kierunek\"":
                case "\"stopien\"":
                case "\"forma\"":
                case "\"grupa\"":
                case "\"rok_akademicki\"":
                case "\"Czy chciałbyś/chciałabyś dodać coś od siebie\"":
                case "\"CZY POINFORMOWAŁ NA POCZĄTKU SEMESTRU O ZASADACH ZALICZANIA\"":
                case "\"CZY ODBYŁY SIĘ WSZYSTKIE ZAPLANOWANE ZAJĘCIA\"":
                    break;
        }
       
        $k=$k+1;
    }
    while($k<$l);
    ?>
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
              switch($ac){
                  case "Ocena Administracji":
             
              $linksquery="SELECT linki_ankiet.link,linki_ankiet.ankieta_nazwa,prowadzacy.rok_akademicki,"
                      . "prowadzacy.kierunek "
                      . "FROM `linki_ankiet` INNER JOIN `prowadzacy` ON linki_ankiet.id_prowadzacy=prowadzacy.id "
                      . "WHERE prowadzacy.rok_akademicki='$rok_a' AND `ankieta`='ocena_administracji2';";
                      break;
                  case "Ocena pracy nauczyciela":
                      $linksquery="SELECT linki_ankiet.link,linki_ankiet.ankieta_nazwa,prowadzacy.rok_akademicki,"
                      . "prowadzacy.kierunek "
                      . "FROM `linki_ankiet` INNER JOIN `prowadzacy` ON linki_ankiet.id_prowadzacy=prowadzacy.id "
                      . "WHERE prowadzacy.rok_akademicki='$rok_a' AND `ankieta`='ocena_pracy_nauczyciela';";
                      break;
              }
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
<?php switch($ac){
default:
    ?>
   <div class="modal fade top" id="solver" tabindex="-1" role="dialog" aria-labelledby="mySolverLabel"
  aria-hidden="true" data-backdrop="true">
  <div class="modal-dialog modal-frame modal-top modal-notify modal-info" role="document">
    <!--Content-->
    <div class="modal-content">
      <!--Body-->
      <div class="modal-body">
        <div class="row d-flex justify-content-center align-items-center">

          <p class="pt-3 pr-2">Wybierz element do znalezienia korelacji</p>
          <?php $roka=substr($_POST['analiza'],-5);?>
          <form method="post" action="main.php?mode=solver1">
            <input type="hidden" value="<?php echo $_POST['analiza'];?>" name="ankieta"> 
            <input type="hidden" name="rok_akademicki" value="<?php echo $roka;?>">
    
              <select name="element"class="mdb-select md-form">
  <option value="" disabled selected>Wybierz badany parametr</option>
  <?php $metryki=mysqli_query($kon,"SELECT * FROM `metryki` WHERE `nazwa`='$nazwa_solver'");
            $halmacz=mysqli_num_rows($metryki);
                $counter=0;
                do {
                    $metryka=mysqli_fetch_array($metryki);
                    $counter=$counter+1;
                    echo "<option value=\"$metryka[0]\">$metryka[2] $metryka[3]</option>";
                }
                while ($counter<$halmacz);
                
                ?>
  <option value="prowadzacy">Wykładowca</option>
</select>
      <hr/>
   
          <button type="submit" class="btn btn-primary">Dalej <i class="fas fa-book ml-1"></i></button>
          <a type="button" class="btn btn-outline-primary waves-effect" data-dismiss="modal">Anuluj</a></form>
        </div>
      </div>
    </div>
    <!--/.Content-->
  </div>
</div> 
 <?php break;
 case "Ocena Administracji":
     ?>
 <div class="modal fade top" id="solver" tabindex="-1" role="dialog" aria-labelledby="mySolverLabel"
  aria-hidden="true" data-backdrop="true">
  <div class="modal-dialog modal-frame modal-top modal-notify modal-info" role="document">
    <!--Content-->
    <div class="modal-content">
      <!--Body-->
      <div class="modal-body">
        <div class="row d-flex justify-content-center align-items-center">

          <p class="pt-3 pr-2">Wybierz element do znalezienia korelacji</p>
          <?php $roka=substr($_POST['analiza'],-5);
        //  echo "SELECT * FROM `metryki` WHERE `nazwa`='$_POST[analiza]'";?>
          <form method="post" action="main.php?mode=solver2">
            <input type="hidden" value="<?php echo $_POST['analiza'];?>" name="ankieta"> 
            <input type="hidden" name="rok_akademicki" value="<?php echo $roka;?>">
    
              <select name="element"class="mdb-select md-form">
  <option value="" disabled selected>Wybierz badany parametr</option>
  <?php $metryki=mysqli_query($kon,"SELECT * FROM `metryki` WHERE `ankieta`='ocena_administracji'");
            $halmacz=mysqli_num_rows($metryki);
                $counter=0;
                do {
                    $metryka=mysqli_fetch_array($metryki);
                    $counter=$counter+1;
                    echo "<option value=\"$metryka[0]\">$metryka[2] $metryka[3]</option>";
                }
                while ($counter<$halmacz);
                ?>
  <option value="prowadzacy">Kierunek studiów</option>
</select>
      <hr/>
   
          <button type="submit" class="btn btn-primary">Dalej <i class="fas fa-book ml-1"></i></button>
          <a type="button" class="btn btn-outline-primary waves-effect" data-dismiss="modal">Anuluj</a></form>
        </div>
      </div>
    </div>
    <!--/.Content-->
  </div>
</div> 
<?php
break;
}
?>
 <?php include('view/ocenydyplom_Modal.php');?>
      <?php include('view/footer.php');
      foreach ($scripts as $script){
     echo $script;
 }?>
 
  
  
 
</body>

</html>

