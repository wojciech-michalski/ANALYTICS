<?php
       include('view/topnav.php');
       $tablename=$_GET['ank'];
       //echo "SELECT * FROM `$tablename` WHERE 1";
       $query=mysqli_query($kon,"SELECT * FROM `$tablename` WHERE 1");
       // echo "SELECT `pytanie`,`tresc` FROM `metryki` WHERE `ankieta`='$tablename'";     
$ile=mysqli_num_rows($query);
$n=0;
$naglowki=mysqli_query($kon,"SELECT `pytanie`,`tresc`,`nazwa` FROM `metryki` WHERE `ankieta`='$tablename'");
$ile_naglowkow=mysqli_num_rows($naglowki);
$k=0;
//$rok_a=substr($_POST['analiza'],-11,11);
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
            <span>ANALIZA ANKIETY <?php $nz= mysqli_fetch_array(mysqli_query($kon,"SELECT `nazwa` FROM `metryki`"
                    . "WHERE `ankieta`='$tablename'")); echo $nz[0]; //echo strlen($ac);
            //echo $ile_naglowkow;?></span>
          </h4>

          

        </div>

      </div>
              <div class="row wow fadeIn">

        <!--Grid column-->
        <div class="col-md-12 mb-4">

          <!--Card-->
          
     <div class="card">
         
        <div class="card-header text-center"><!--<?php echo $_POST['analiza'];?>
            <button class="btn btn-info btn-sm" data-toggle="modal" href="#" data-target="#modal-linki">Pokaż linki</button> --></div>
         
<div class="card-body">
    
  
    <hr/><h5 class="text-center">Wyniki zagregowane</h5> 
      
    <h5>Wypełniono <?php echo $ile;?> ankiet</h5>
    <a href="exports/csv/export.csv"><button type="button" class="btn btn-primary">Pobierz plik CSV</button></a>
    <a class="button btn btn-unique" href="main.php?mode=asql">Powrót</a>
<!--<table id="dtMaterialDesignExample" class="table table-striped"  cellspacing="0" width="80%">
  <thead>
    <tr>-->
        <?php
       $k=0;
        do {
            $naglowek=mysqli_fetch_array($naglowki);
            //echo "<th>$naglowek[Field]</th>";
            $csvhead[]="\"$naglowek[1]\"";
            $k=$k+1;
        }
        while($k<$ile_naglowkow);
        $csvfirstrow="id;data;".implode(";",$csvhead).";id_prowadzacy";
        
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
                        while($j<$ile_naglowkow+3);
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
       unset($labels);
        $header=str_replace("\"","",$header);
         $pytfield=mysqli_fetch_array(mysqli_query($kon,"SELECT `pytanie` FROM `metryki` "
                 . "WHERE `ankieta`='$tablename' AND `tresc`='$header'"));
         $headlabels=mysqli_query($kon,"SELECT DISTINCT `$pytfield[0]` FROM `$tablename` WHERE 1");
        foreach($headlabels as $label){
            $labels[]=$label[$pytfield[0]];
        }
               // $labels=array(1,2,3,4,5);
       
                      
        
        foreach($labels as $label){
          
            $value[$label]=mysqli_num_rows(mysqli_query($kon,"SELECT * FROM `$tablename` "
                    . "WHERE `$pytfield[0]`='$label '"));
            //echo $value[$label];
           $datachartvalues=implode(",",$value);
            // echo "SELECT * FROM `$_GET[view]` WHERE `$header`=$label";
        }
        $values[]=$datachartvalues;
        //generowanie js-ów
     
         $labelki="\"".implode("\",\"",$labels)."\"";
       
        $scripts[]="<script>"
                . "var ctxB = document.getElementById(\"barChart$l\").getContext('2d');\n"
                . "var myBarChart = new Chart(ctxB, {\n"
                ."type: 'bar',\n"
                ."data: {\n"
                ."labels: [$labelki],\n"
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
        
    
   
 
 <?php include('view/ocenydyplom_Modal.php');?>
      <?php include('view/footer.php');
      foreach ($scripts as $script){
     echo $script;
 }?>
  <script>
  $( document ).ready(function() {
    new WOW().init()
});
  </script>
  
  
 
</body>

</html>

