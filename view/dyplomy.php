<?php
include('controller/konekt_GURU.php');
include('controller/konekt_MySQL.php');

if(!isset($_POST['RA'])) {
    $data_rok=date('Y');
    $data_mc=date('m');
    switch ($data_mc){
        case "01":
        case "02":
            $rok_akademicki=$data_rok-1;
            $semestr="L";
            $semestrslownie="letni";
            $raslownie=$rok_akademicki ."/$data_rok";
            break;
        case "03":
        case "04":
        case "05":
        case "06":
        case "07":
        case "08":
        case "09":
            $rok_akademicki=$data_rok-1;
            $semestr="Z";
            $semestrslownie="zimowy";
            $raslownie="$rok_akademicki/".$rok_akademicki+1;
            break;
        case "10":
        case "11":
        case "12":
            $rok_akademicki=$data_rok-1;
            $semestr="L";
            $semestrslownie="letni";
            $raslownie="$rok_akademicki/".$rok_akademicki+1;
            break;
    } 
   
} else {
    
    $rok_akademicki=$_POST['RA'];
    
}
//echo $rok_akademicki;
require('controller/dyplomy.php');
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
        <h5 style="color:gray;">Zestawienie ocen na dyplomach dla roku akademickiego <?php echo $rok_akademicki;?>  (od <?php echo "$collectstart do $collectstop)";?><button type="button" class="btn btn-primary"  data-toggle="modal" data-target="#ocenydyplomModal">Zmień</button></h5>
        <?php //print_r($oceny);?>
       <table id="dtMaterialDesignExample" class="table table-striped" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th class="th-sm">Wydział      </th>
       <th class="th-sm">Kierunek Studiów      </th>
      <th class="th-sm">Stopień studiów      </th>
      <th class="th-sm">Forma studiów      </th>
      <th class="th-sm">Tytuł zawodowy</th>
      <th class="th-sm">Profil studiów</th>
       <th class="th-sm">Język studiów</th>
      <th class="th-sm">Ilość ocen 5 (bardzo dobry)</th>
      <th class="th-sm">Ilość ocen 4 (dobry)</th>
      <th class="th-sm">Ilość ocen 3 (dostateczny)</th>
      <th class="th-sm">Ilość ocen 2 (niedostateczny)</th>
      <th class="th-sm">Suma obron</th>
    </tr>
  </thead>
  <?php 
  foreach(array_keys($oceny) as $przynaleznosc__) {
      $przyn_element=explode(";;",$przynaleznosc__);
   if (!isset($oceny[$przynaleznosc__][5])) $oceny[$przynaleznosc__][5]=0;
   if (!isset($oceny[$przynaleznosc__][4])) $oceny[$przynaleznosc__][4]=0;
   if (!isset($oceny[$przynaleznosc__][3])) $oceny[$przynaleznosc__][3]=0;
   if (!isset($oceny[$przynaleznosc__][2])) $oceny[$przynaleznosc__][2]=0;
      echo "<tr><td>$przyn_element[0]</td><td>$przyn_element[1]</td><td>$przyn_element[3]</td><td>$przyn_element[2]</td>"
              . "<td>$przyn_element[5]</td><td>$przyn_element[6]</td><td>$przyn_element[4]</td><td>".$oceny[$przynaleznosc__][5]."</td>"
              . "<td>".$oceny[$przynaleznosc__][4]."</td>". "<td>".$oceny[$przynaleznosc__][3]."</td>". "<td>".$oceny[$przynaleznosc__][2]."</td><td>".array_sum($oceny[$przynaleznosc__]) ."</td></tr>";
  }
  ?>
  
       </table>
        
    
        
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
</body>

</html>
