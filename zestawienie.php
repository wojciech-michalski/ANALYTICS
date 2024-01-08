
<?php include('controller/konekt_GURU.php');
include('controller/konekt_MySQL.php');
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
            <div class="col-md-12 white-text text-center text-md-left mt-xl-5 mb-5 wow fadeInLeft" data-wow-delay="0.3s">
    <?php 
  $querystart="SELECT";
  //print_r($_POST);
  foreach($_POST['typy'] as $qtypy) {
  $typarray[]="mapowanie.stopien='$qtypy'";
  $typtextarray[]="<li>Stopień=$qtypy</li>";
 }
 if($_POST['own']!=='') {
     $own="AND (".$_POST['own'].")";
     //$owntext=str_replace("\'","\\'");
 }
 else {$own="";}
 foreach($_POST['rodzaje'] as $qrodzaje) {
   $rodzajarray[]="mapowanie.forma='$qrodzaje'";
   $rodzajtextarray[]="<li>Forma=$qrodzaje</li>";
 } foreach($_POST['tytuly'] as $qtytuly) {
   $tytularray[]="mapowanie.tytul='$qtytuly'";
   $tytultextarray[]="<li>Tytuł zawodowy=$qtytuly</li>";
 }
 foreach($_POST['kierunki'] as $qkierunki) {
   $kierarray[]="mapowanie.kierunek='$qkierunki'";
   $kiertextarray[]="<li>Kierunek studiów=$qkierunki</li>";
 }
 foreach($_POST['statusy'] as $qstatusy) {
   $statusarray[]="studenci.status_studenta='$qstatusy'";
   $statustextarray[]="<li>Status=$qstatusy</li>";
 }
 $statusstring=implode(" OR ",$statusarray);
 $kierstring=implode(" OR ",$kierarray);
 $typstring=implode(" OR ",$typarray);
 $rodzajstring=implode(" OR ",$rodzajarray);
         $tytulstring=implode(" OR ",$tytularray);
 //echo "SELECT DISTINCT ".$_POST['kolumny']." FROM `studenci` INNER JOIN `mapowanie` ON mapowanie.id=studenci.id_mapowanie WHERE studenci.collect_data='".$_POST['data']."' AND ($kierstring) AND ($statusstring) AND ($rodzajstring) $own";
 $querymiddle="FROM `studenci` INNER JOIN `mapowanie` ON studenci.id_mapowanie=mapowanie.id WHERE studenci.collect_data='".$_POST['data']."' AND ($kierstring) AND ($tytulstring) AND ($statusstring) AND ($rodzajstring) AND ($typstring) $own";    
 $tabheaders=mysqli_query($kon,"SELECT DISTINCT ".$_POST['kolumny']." FROM `studenci` INNER JOIN `mapowanie` ON mapowanie.id=studenci.id_mapowanie WHERE studenci.collect_data='".$_POST['data']."' AND ($kierstring) AND ($tytulstring) AND ($statusstring) AND ($rodzajstring) AND ($typstring) AND ($tytulstring) $own");
 $ilekolumn=mysqli_num_rows($tabheaders);
 $k=0;
 $zapytanie= "$querystart ".$_POST['kolumny']." $querymiddle";
 //echo $zapytanie;
 ?>
                
                <div class="card"style="overflow: scroll; height:600px; margin-top:5%;" >
    <div class="card-body">
        <h5 style="color:gray;">Pokazuję <?php echo $_POST['kolumny'];?> dla daty: <?php echo $_POST['data'];?></h5>
                <a class="btn btn-sm btn-info" onclick="toastr.info('<ul style=\'font-size:0.8em;\'><?php echo implode("",$statustextarray);
                echo implode ("",$kiertextarray);
                echo implode ("",$rodzajtextarray);
                echo implode("",$typtextarray);
                echo implode("",$tytultextarray);
                //echo $owntext;
                ?></ul>',{timeOut: 8000});">Pokaż zastosowane filtry</a>
        <div class="row">
            <div class="col-md-4">
                  <table class="table table-hover table-responsive w-auto">
                      <tr><?php do {
                          $kolumna=mysqli_fetch_array($tabheaders);
                      $k=$k+1;
                      switch($kolumna[0]) {
                          default:
                               echo "<th>$kolumna[0]</th>";
                              break;
                              case '':
                               echo "<th>BRAK</th>";   
                                  break;
                              
                      }
                     
                      $nextquerycolumns[]=$kolumna[0];
                      }
                      while($k<$ilekolumn);
                      ?></tr><tr>
                      <?php
                      foreach ($nextquerycolumns as $column){
                         // echo "SELECT studenci.id` FROM `studenci` INNER JOIN `mapowanie` ON studenci.id_mapowanie=mapowanie.id WHERE studenci.collect_data='".$_POST['data']."' AND ($kierstring) AND ($statusstring) AND ($rodzajstring) AND ".$_POST['kolumny']."='$column' ";
                          $countquery=mysqli_num_rows(mysqli_query($kon,"SELECT studenci.id FROM `studenci` INNER JOIN `mapowanie` ON studenci.id_mapowanie=mapowanie.id WHERE studenci.collect_data='".$_POST['data']."' AND ($kierstring) AND($typstring) AND($tytulstring) AND ($statusstring) AND ($rodzajstring) AND ".$_POST['kolumny']."='$column' $own "));
                          echo "<td>$countquery</td>";
                          $ilosci[]=$countquery;
                      }
                      ?>
                      </tr>
                      <tr><th colspan="<?php echo $ilekolumn-1;?>">Znalezionych rekordów:</th><th><?php echo mysqli_num_rows(mysqli_query($kon,$zapytanie));?></th></tr>
                  </table></div>
            <div class="col-md-8">
    <?php include('controller/generuj_wykres.php');?>
        <div id="chartContainer" class="img img-responsive" style="width: 100%; height:450px;"></div>
            </div></div></div></div>
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