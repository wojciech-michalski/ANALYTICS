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
            <span>/</span> <span>RAPORTY DZIEKANÓW</span> <span>/</span>
            <span>ODSIEWY</span>
          </h4>

          

        </div>

      </div>
              <div class="row wow fadeIn">

        <!--Grid column-->
        <div class="col-md-12 mb-4">

          <!--Card-->
          
     <div class="card">
<div class="card-header text-center">
          Odsiewy dla roku akademickiego <?php echo $raslownie;?>  <button type="button" class="btn btn-primary"  data-toggle="modal" data-target="#odsiewModal">Zmień</button>
            </div>
<div class="card-body">
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
 
  
  
 
</body>

</html>