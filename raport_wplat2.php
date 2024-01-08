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
            <span>/</span><span>FINANSE</span><span>/</span><span>RAPORT WPŁAT</span>
          
          </h4>

          

        </div>

      </div>
              <div class="row wow fadeIn">

        <!--Grid column-->
        <div class="col-md-12 mb-4">

          <!--Card-->
          
     <div class="card">
<div class="card-header text-center">
         Zestawienie wpłat <?php echo "dla: ".array_sum($ilu_studentow). " studentów w roku akademickim $_POST[rok_akademicki] semestr $semestrnazwa";?>
            </div>
<div class="card-body">
  <table id="dtMaterialDesignExample" class="table table-striped table-condensed" cellspacing="0" width="100%">
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
      <?php include('view/footer.php');?>
 
  
  
 
</body>

</html>