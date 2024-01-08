<?php
       include('view/topnav.php');
       $ankieta_array=explode("-",$_POST['analiza']);
       $ankieta_dirty=$ankieta_array[1];
       $ankieta_cleaner=explode("20",$ankieta_dirty);
       $ankieta_clean=$ankieta_cleaner[0];
      $warunki=explode(";;",$_POST['wykladowcy']);
      switch($warunki[0]) {
                default:
                    $warunek="`przedmiot`='$warunki[0]' AND `nazwisko`='$warunki[1]' AND `imie`='$warunki[2]' ";
                    break;
                case '%':
                    $warunek="`nazwisko`='$warunki[1]' AND `imie`='$warunki[2]' ";
                    break;
                        
      }
     // $warunek="`przedmiot`='$warunki[0]' AND `nazwisko`='$warunki[1]' AND `imie`='$warunki[2]' ";
    // $warunek=
       $query=mysqli_query($kon,"SELECT * FROM `$_POST[analiza]` WHERE $warunek");
             
$ile=mysqli_num_rows($query);
$n=0;
$naglowki=mysqli_query($kon,"DESCRIBE `$_POST[analiza]`");
$ile_naglowkow=mysqli_num_rows($naglowki);
$k=0;
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
         
        <div class="card-header text-center"><?php echo $_POST['analiza']; ?>
            <br/><?php
            echo "$warunki[0] $warunki[1] $warunki[2] $warunki[3]";
            ;?></div>
          
<div class="card-body">
    <h5>Wypełniono <?php echo $ile;?> ankiet</h5>
    <a href="exports/csv/export.csv"><button type="button" class="btn btn-primary">Pobierz plik CSV</button></a>
    <a class="button btn btn-unique" href="main.php?mode=deanreport6">Powrót</a>
<!--<table id="dtMaterialDesignExample" class="table table-striped"  cellspacing="0" width="80%">
  <thead>
    <tr>-->
        <?php
       // echo $ankieta_clean;
        do {
            $naglowek=mysqli_fetch_array($naglowki);
            //echo "<th>$naglowek[Field]</th>";
            $csvhead[]="\"$naglowek[Field]\"";
            $k=$k+1;
        }
        while($k<$ile_naglowkow);
        $csvfirstrow=implode(";",$csvhead);
        ?>
  </thead> <tbody>
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
                    . "WHERE `$header`=$label AND ($warunek)"));
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
          <!--/.Card-->

        </div>
        <!--Grid column-->

        <!--Grid column-->
        
        <!--Grid column-->

      </div>
        </div></div>
        
      

   
 
 <?php include('view/ocenydyplom_Modal.php');?>
      <?php include('view/footer.php');
      foreach ($scripts as $script){
     echo $script;
 }?>

  
  
 
</body>

</html>

