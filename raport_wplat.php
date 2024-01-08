<?php
include('controller/konekt_GURU.php');
include('controller/konekt_MySQL.php');


require('controller/rapwplat.php');

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
         <div class="card-header text-center">Zestawienie wpłat <?php echo "dla: ".array_sum($ilu_studentow). " studentów w roku akademickim $_POST[rok_akademicki] semestr $semestrnazwa";?></div>
    <div class="card-body">
       <?php //echo "$iluquery <br/>Mam $ilu_studentow studentów ";?>
        <h5 style="color:gray;">Zestawienie wpłat <?php echo "dla: ".array_sum($ilu_studentow). " studentów w roku akademickim $_POST[rok_akademicki] semestr $semestrnazwa";?></h5>
        
       <table id="dtMaterialDesignExample" class="table table-striped table-condensed table-responsive" cellspacing="0" width="100%">
  <thead>
    <tr>
        <th>Kierunki studiów</th><th>Stopnie studiów (typ studiów)</th><th>Rodaje studiów</th><th>tytuły zawodowe</th>
        <th>Rodzaj wpłaty</th><th>Opłacone w terminie</th><th>Opłacone po terminie</th><th>Opłacone częściowo</th>
        <th>Nieopłacone</th><th>Udział nieopłaconych</th><th>Udział opłaconych po terminie</th>
        <th>Udział opłaconych terminowo</th></tr>
				</thead>
                                
     <?php foreach($tablearray1 as $kolumna1) {
         echo "<tr>";
        $kolumny=explode(";;",$kolumna1);
        foreach($kolumny as $kolumna){
            echo "<td>$kolumna</td>";
        }
        echo "</tr>";
     }        
      foreach($tablearray2 as $kolumna2) {
         echo "<tr>";
        $kolumny=explode(";;",$kolumna2);
        foreach($kolumny as $kolumna){
            echo "<td>$kolumna</td>";
        }
        echo "</tr>";
     }        
     ?>
                                      </table>
        
        <table class="table table-striped" cellspacing="0" width="100%">
           
        </table>
           <?php //require('controller/rapwplat_miesiacami.php');
           ?>
        
  <div id="chartContainer" class="img img-responsive" style="width: 100%; height:600px;"></div>
          
    
        
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
    
    <!-- Full Page Intro -->
  </header>
  
 <?php include('view/ocenydyplom_Modal.php');?>
  <?php include('view/footer.php');?>
  <script>
  
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
</body>

</html>
