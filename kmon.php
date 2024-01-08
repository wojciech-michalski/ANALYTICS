<?php
include('controller/U10_Przynaleznosci.php');
include('controller/statusyANALYTICS.php');
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
            <span>/</span>
            <span>Zbieranie danych i analiza</span>
          </h4>

          

        </div>

      </div>
              <div class="row wow fadeIn">

        <!--Grid column-->
        <div class="col-md-12 mb-4">

          <!--Card-->
          
     <div class="card">
<div class="card-header text-center">
       Zestawienie Kobiety - Mężczyźni - Obcokrajowcy - Niepełnosprawni       
            </div>
<div class="card-body">

           <?php
 $querystart="SELECT studenci.id,studenci.plec,studenci.obywatelstwo,studenci.niepelnosprawnosc,studenci.id_mapowanie";
 // print_r($_POST);
  foreach($_POST['typy'] as $qtypy) {
  $typarray[]="mapowanie.stopien='$qtypy'";
  $typtextarray[]="<li>Stopień=$qtypy</li>";
 }

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
 foreach($_POST['jezyki'] as $qjezyki) {
   $jezarray[]="mapowanie.jezyk='$qjezyki'";
   $jeztextarray[]="<li>Język=$qjezyki</li>";
 }
 
 $kierstring=implode(" OR ",$kierarray);
 $typstring=implode(" OR ",$typarray);
 $rodzajstring=implode(" OR ",$rodzajarray);
 $tytulstring=implode(" OR ",$tytularray);
 $jezykstring=implode(" OR ",$jezarray);   
$querymiddle="FROM `studenci` INNER JOIN `mapowanie` ON studenci.id_mapowanie=mapowanie.id "
        . "WHERE studenci.collect_data='".$_POST['data']."' AND ($kierstring) AND ($tytulstring) AND "
        . " ($rodzajstring) AND ($typstring) AND($jezykstring)";
 $zapytanie= "$querystart ".$_POST['kolumny']." $querymiddle GROUP BY studenci.id_mapowanie";
 //echo $zapytanie;
$kmon=mysqli_query($kon,$zapytanie);

?>
     <table id="dtMaterialDesignExample" class="table table-striped table-condensed" cellspacing="0" width="90%" >
         <thead>  <tr><th>Przynależność</th><th>Stan studentów</th><th>Mężczyźni</th><th>Kobiety</th>
                 <th>Osoby z niepełnosprawnością</th><th>Obcokrajowcy</th></tr></thead>
         <tbody>
            <?php foreach ($kmon as $wiersz){
                $przyn=mysqli_fetch_array(mysqli_query($kon,"SELECT `kierunek`,`stopien`,`forma`,`jezyk`,`tytul`"
                        . " FROM `mapowanie` WHERE `id`='$wiersz[id_mapowanie]'"));
                $is=mysqli_num_rows(mysqli_query($kon,"SELECT `id` FROM `studenci` "
                        . "WHERE `collect_data`='$_POST[data]' AND `id_mapowanie`='$wiersz[id_mapowanie]'"));
                $im=mysqli_num_rows(mysqli_query($kon,"SELECT `id` FROM `studenci` "
                        . "WHERE `collect_data`='$_POST[data]' AND `id_mapowanie`='$wiersz[id_mapowanie]' "
                        . "AND `plec`='mężczyzna'"));
                $ik=mysqli_num_rows(mysqli_query($kon,"SELECT `id` FROM `studenci` "
                        . "WHERE `collect_data`='$_POST[data]' AND `id_mapowanie`='$wiersz[id_mapowanie]' "
                        . "AND `plec`='kobieta'"));
                $in=mysqli_num_rows(mysqli_query($kon,"SELECT `id` FROM `studenci` "
                        . "WHERE `collect_data`='$_POST[data]' AND `id_mapowanie`='$wiersz[id_mapowanie]' "
                        . "AND `niepelnosprawnosc`='TAK'"));
                $io=mysqli_num_rows(mysqli_query($kon,"SELECT `id` FROM `studenci` "
                        . "WHERE `collect_data`='$_POST[data]' AND `id_mapowanie`='$wiersz[id_mapowanie]' "
                        . "AND `obywatelstwo`<>'PL'"));
              echo "<tr><td>$przyn[kierunek]<br/>$przyn[stopien] $przyn[forma]<br/> $przyn[tytul] $przyn[jezyk]</td>"
                      . "<td>$is</td><td>$im</td><td>$ik</td><td>$in</td><td>$io</td></tr>";  
            }
            ?>
                     
         </tbody>
     </table>
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
    <?php include('view/filtr_Modal.php');?>
      <?php include('view/footer.php');?>

  
  
 
</body>

</html>

