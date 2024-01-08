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
            <span>/</span><span>RAPORTY DZIEKANÓW</span><span>/</span>
            <span>OCENY NA DYPLOMACH</span>
          </h4>

          

        </div>

      </div>
              <div class="row wow fadeIn">

        <!--Grid column-->
        <div class="col-md-12 mb-4">

          <!--Card-->
          
     <div class="card">
<div class="card-header text-center">
         Zestawienie ocen na dyplomach dla roku akademickiego <?php echo $rok_akademicki;?>  (od <?php echo "$collectstart do $collectstop)";?><button type="button" class="btn btn-primary"  data-toggle="modal" data-target="#ocenydyplomModal">Zmień</button>
            </div>
<div class="card-body">
    <?php //print_r($oceny);?>
<table id="dtMaterialDesignExample" class="table table-striped table-responsive w-auto">
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
      <th class="th-sm">Ilość ocen 4.5 (dobry plus)</th>
      <th class="th-sm">Ilość ocen 4 (dobry)</th>
       <th class="th-sm">Ilość ocen 3.5 (dostateczny plus)</th>
      <th class="th-sm">Ilość ocen 3 (dostateczny)</th>
      <th class="th-sm">Ilość ocen 2 (niedostateczny)</th>
      <th class="th-sm">Suma obron</th>
    </tr>
  </thead>
  <?php 
  
  foreach(array_keys($oceny) as $przynaleznosc__) {
      $przyn_element=explode(";;",$przynaleznosc__);
   if (!isset($oceny[$przynaleznosc__]["5"])) $oceny[$przynaleznosc__]["5"]=0;
    if (!isset($oceny[$przynaleznosc__]["4.5"])) $oceny[$przynaleznosc__]["4.5"]=0;
   if (!isset($oceny[$przynaleznosc__]["4"])) $oceny[$przynaleznosc__]["4"]=0;
    if (!isset($oceny[$przynaleznosc__]["3.5"])) $oceny[$przynaleznosc__]["3.5"]=0;
   if (!isset($oceny[$przynaleznosc__]["3"])) $oceny[$przynaleznosc__]["3"]=0;
   if (!isset($oceny[$przynaleznosc__]["2"])) $oceny[$przynaleznosc__]["2"]=0;
   if(array_sum($oceny[$przynaleznosc__])>0){
      echo "<tr><td>$przyn_element[0]</td><td>$przyn_element[1]</td><td>$przyn_element[3]</td><td>$przyn_element[2]</td>"
              . "<td>$przyn_element[5]</td><td>$przyn_element[6]</td><td>$przyn_element[4]</td><td>".$oceny[$przynaleznosc__]["5"]."</td>"
              . "<td>".$oceny[$przynaleznosc__]["4.5"]."</td><td>".$oceny[$przynaleznosc__]["4"]."</td>". "<td>".$oceny[$przynaleznosc__]["3.5"]."</td><td>".$oceny[$przynaleznosc__]["3"]."</td>". "<td>".$oceny[$przynaleznosc__]["2"]."</td><td>".array_sum($oceny[$przynaleznosc__]) ."</td></tr>";
   } else
       echo "";
  }
  ?>
  
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
    <?php include('view/ocenydyplom_Modal.php');?>
     <?php include('view/odsiew_Modal.php');?>
      <?php include('view/footer.php');?>
  
  
  
 
</body>

</html>