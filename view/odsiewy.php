
<?php include('controller/konekt_GURU.php');
include('controller/konekt_MySQL.php');
if(!isset($_GET['RA'])) {
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
    $semestr=$_POST['sem'];
    $semestrslownie=$_POST['smesl'];
    $raslownie=$_POST['raslownie'];
    $rok_akademicki=$_GET['RA'];
    $raslownie=$rok_akademicki."/".$rok_akademicki+1;
}
require('controller/odsiewy.php');
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
        <h5 style="color:gray;">Odsiewy dla roku akademickiego <?php echo $raslownie;?>  <button type="button" class="btn btn-primary"  data-toggle="modal" data-target="#odsiewModal">Zmień</button></h5>
       <table id="dtMaterialDesignExample" class="table table-striped table-condensed" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th class="th-sm">Nazwa kierunku      </th>
      <th class="th-sm">Stopień studiów      </th>
      <th class="th-sm">Forma studiów      </th>
      <th class="th-sm">Tytuł zawodowy</th>
      <th class="th-sm">Profil studiów</th>
       <th class="th-sm">Język studiów</th>
      <th class="th-sm">Stan studentów na dzień <?php echo $collectdata1;?></th>
      <th class="th-sm">Stan studentów na dzień <?php echo $collectdata2;?></th>
      <th class="th-sm">Odsiew</th>
    </tr>
  </thead>
  <?php foreach(array_keys($odsiewarray) as $odsiew) {
      $wierszyk=explode(";;",$odsiew);
      $startvalue=$odsiewarray["$odsiew"];
      $odsiewproc=round(100*($startvalue-$odsiewarray2[$odsiew])/$startvalue,2);
      echo "<tr><td>$wierszyk[0]</td><td>$wierszyk[2]</td><td>$wierszyk[1]</td><td>$wierszyk[4]</td><td>$wierszyk[5]</td><td>$wierszyk[3]</td><td>$startvalue</td><td>$odsiewarray2[$odsiew]</td><td>$odsiewproc %</td></tr>";
      
  }
  ?>
  <!--<tr><td colspan="6">Razem</td><td><?php echo array_sum($odsiewarray);?></td><td><?php echo array_sum($odsiewarray2);?></td><td><?php echo round(100*(array_sum($odsiewarray)-array_sum($odsiewarray2))/array_sum($odsiewarray),2);?> %</td></tr>-->
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
 <?php include('view/odsiew_Modal.php');?>
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

