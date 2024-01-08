<?php
include('controller/konekt_GURU.php');
include('controller/konekt_MySQL.php');


require('controller/rapwplat_bak.php');
?>
<body>
   
     
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
            <span>/</span><span>FINANSE</span><span>/</span>
            <span>RAPORT WPŁAT</span>
          </h4>

          

        </div>

      </div>
              <div class="row wow fadeIn">

        <!--Grid column-->
        <div class="col-md-12 mb-4">

          <!--Card-->
          
     <div class="card">
<div class="card-header text-center">
          Zestawienie wpłat <?php echo "dla $ilu_studentow studentów w roku akademickim $_POST[rok_akademicki] semestr $semestrnazwa";?>
            </div>
<div class="card-body">
<table class="table">
            <tr><th>Suma naliczeń</th><th>Suma faktycznych wpłat</th></tr>
            <tr><td><?php echo number_format($suma_naliczone, 2, ',', ' ');?> zł</td>
                <td><?php echo number_format($suma_oplacone + $suma_oplacone_po_terminie + $suma_oplacone_czesciowo, 2, ',', ' ') ;?> zł</td>
            </tr>
        </table>
       <table id="dtMaterialDesignExample" class="table table-striped table-condensed" cellspacing="0" width="100%">
  <thead>
    <tr>
        <th>Kierunki studiów</th><th>Stopnie studiów (typ studiów)</th><th>Rodaje studiów</th><th>tytuły zawodowe</th>
        <th>Rodzaj wpłaty</th><th>Opłacone w terminie</th><th>Opłacone po terminie</th><th>Opłacone częściowo</th>
        <th>Nieopłacone</th><th>Udział nieopłaconych</th><th>Udział opłaconych po terminie</th>
        <th>Udział opłaconych terminowo</th></tr>
				</thead>
        <tr><td><?php echo $kierunkidotabeli;?></td><td><?php echo $typydotabeli;?></td>
        <td><?php echo $rodzajedotabeli;?></td><td><?php echo $tytulydotabeli;?></td><td><?php echo $LOplatydotabelki;?></td>
        <td><?php echo "$ile_rat_w_terminie wpłat";?></td><td><?php echo "$ile_rat_po_terminie wpłat";?>
        </td><td><?php echo "$ile_rat_czesciowo wpłat";?></td><td><?php echo "$ile_rat_nieoplacone wpłat";?></td>
        <td><?php echo "$udzial_nieoplaconych %";?></td><td><?php echo "$udzial_nieterminowych %";?></td>
        <td><?php echo "$udzial_terminowych %";?></td></tr>
        
        <tr><td><strong>SUMA KWOTAMI</strong></td><td></td><td></td><td></td><td></td><td>
            <?php echo number_format($suma_oplacone, 2, ',', ' ')." zł";?></td><td>
            <?php echo number_format($suma_oplacone_po_terminie, 2, ',', ' ')." zł";?>
            </td><td><?php echo number_format($suma_oplacone_czesciowo, 2, ',', ' ')." zł";?></td>
            <td><?php  echo number_format($suma_nieoplacone, 2, ',', ' ')." zł";?>
            </td><td><?php echo "$udzial_nieoplaconych_k %";?></td><td><?php echo "$udzial_nieterminowych_k %";?></td>
            <td><?php echo "$udzial_terminowych_k %";?></td></tr>
       </table>
        
        <table class="table table-striped" cellspacing="0" width="100%">
            <tr><th>Miesiąc</th><th>Udział rat opłaconych w terminie (kwotowo)</th><th>Udział rat opłaconych po terminie (kwotowo)</th><th>Udział rat nieopłaconych (kwotowo)</th></tr>
       <?php require('controller/rapwplat_miesiacami.php');
       
           foreach (array_keys($resultarrayK) as $klucz){
               $udzialy=explode(";;",$resultarrayK["$klucz"]);
               echo "<tr><td>$miesiace[$klucz]</td><td>$udzialy[0] %</td><td>$udzialy[1] %</td><td>$udzialy[2] %</td></tr>";
               $miesiacslownie=$miesiace[$klucz];
               $labelelement[]=$miesiacslownie;
               $dataset1[]=$udzialy[0];
               $dataset2[]=$udzialy[1];
               $dataset3[]=$udzialy[2];
           }
           $chartlabels_=implode("\",\"",$labelelement);
           $chartlabels="[\"$chartlabels_\"]";
           $datasetA_=implode(",",$dataset1);
           $datasetA="[$datasetA_]";
           
           $datasetB_=implode(",",$dataset2);
           $datasetB="[$datasetB_]";
           
           $datasetC_=implode(",",$dataset3);
           $datasetC="[$datasetC_]";
        ?>
        </table>
           
         
        <canvas id="lineChart"></canvas>
                
       </div>
              

         
          </div>
          <!--/.Card-->

        </div>
        <!--Grid column-->

        <!--Grid column-->
        
        <!--Grid column-->

      </div>
        </div>
        
       </div>
    <?php// include('view/filtr_Modal.php');?>
      <?php include('view/footer.php');?>
     <script>
  var ctxL = document.getElementById("lineChart").getContext('2d');
var myLineChart = new Chart(ctxL, {
    type: 'line',
    
    data: {
        labels: <?php echo $chartlabels;?>,
        datasets: [
            {
                label: "Udział opłat terminowych",
                backgroundColor: "rgba(105, 0, 132, .2)",
                strokeColor: "rgba(105, 0, 132, 1)",
                pointColor: "rgba(105, 0, 132, 1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(105, 0, 132, 1)",
                data: <?php echo $datasetA;?>
            },
            {
                label: "Udział opłat po terminie",
                backgroundColor: "rgba(0, 137, 132, .2)",
                strokeColor: "rgba(0, 137, 132, 1)",
                pointColor: "rgba(0, 137, 132, 1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(0, 137, 132, 1)",
                data: <?php echo $datasetB;?>
            },
            {
                label: "Udział rat nieopłaconych",
                backgroundColor: "rgba(244, 67, 54, 0.7",
                strokeColor: "rgba(244, 67, 54, 1)",
                pointColor: "rgba(244, 67, 54, 1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(244, 67, 54, 1)",
                data: <?php echo $datasetC;?>
            }
        ]
    },
    options: {
        responsive: true
    }    
});
  </script>
  
  
  
 
</body>

</html>