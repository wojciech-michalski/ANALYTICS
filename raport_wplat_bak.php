<?php
include('controller/konekt_GURU.php');
include('controller/konekt_MySQL.php');


require('controller/rapwplat_bak.php');

?>
<body>
  <!-- Main navigation -->
  <header>
    <!--Navbar-->
 <?php include('view/mainmenu.php');?>
    <!-- Full Page Intro -->
    <div class="view" style="background-image: url('view/img/wseiz_background.jpg'); background-repeat: no-repeat; background-size: cover; background-position: center center;">
      <!-- Mask & flexbox options-->
      <div class="mask rgba-gradient d-flex justify-content-center align-items-center">
        <!-- Content -->
        <div class="container" style="max-width:1900px !important;">
          <!--Grid row-->
          <div class="row">
            <!--Grid column-->
            <div class="col-md-12 gray-text text-center text-md-left mt-xl-5 mb-5 wow fadeInLeft" data-wow-delay="0.3s">
    <?php 
  //print_r($odsiewarray);?>
 
                
                <div class="card"style="overflow: scroll; height:600px; margin-top:4%;" >
    <div class="card-body">
       <?php //echo "$iluquery <br/>Mam $ilu_studentow studentów ";?>
        <h5 style="color:gray;">Zestawienie wpłat <?php echo "dla $ilu_studentow studentów w roku akademickim $_POST[rok_akademicki] semestr $semestrnazwa";?></h5>
        
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
  
          
    
        
           </div></div>
            </div>
            <!--Grid column-->
            <!--Grid column-->
            <!--<div class="col-md-6 col-xl-5 mt-xl-5 wow fadeInRight" data-wow-delay="0.3s">
              <img src="view/img/admin-new.png" alt="" class="img-fluid">
            
            </div>-->
            <!--Grid column-->
          </div>
          <!--Grid row-->
        </div>
        <!-- Content -->
      </div>
      <!-- Mask & flexbox options-->
    </div>
    <!-- Full Page Intro -->
  </header>
  
 <?php include('view/ocenydyplom_Modal.php');?>
  <?php include('view/footer.php');?>
  <script>
  $( document ).ready(function() {
    new WOW().init()
});
//$(document).ready(function() {
//    $('.mdb-select').materialSelect();
 // });
 $('.datepicker').pickadate({

min: new Date(2020,12,12),
max: new Date(2042,12,12),
labelMonthNext: 'Następny miesiąc',
labelMonthPrev: 'Poprzedni miesiąc',
labelMonthSelect: 'Wybierz miesiąc z listy',
labelYearSelect: 'Wybierz rok z listy',
selectMonths: true,
selectYears: 50,

// Escape any “rule” characters with an exclamation mark (!).
monthsFull: ['Styczeń', 'Luty', 'Marzec', 'Kwiecień', 'Maj', 'Czerwiec', 'Lipiec', 'Sierpień', 'Wrzesień', 'Październik',
'Listopad', 'Grudzień'],
monthsShort:['Sty', 'Lut', 'Mar', 'Kwi', 'Maj', 'Cze', 'Lip', 'Sie' , 'Wrz', 'Paź' , 'Lis' , 'Gru'],
format: 'yyyy-mm-dd',
firstDay: 1,
weekdaysShort: ['Nd', 'Pon', 'Wt', 'Śr', 'Czw', 'Pt', 'Sb'],
weekdaysFull: ['Niedziela', 'Poniedziałek', 'Wtorek', 'Środa', 'Czwartek', 'Piątek', 'Sobota'],
today: 'Dziś',
clear: 'wyczyść',
close: 'zamknij',
formatSubmit: 'yyyy-mm-dd'
 });
 
   
  </script>
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
