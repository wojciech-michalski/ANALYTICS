  <?php 



require('controller/ank_sql.php');
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
            <span>ANKIETY SQL</span>
          </h4>

          

        </div>

      </div>
              <div class="row wow fadeIn">

        <!--Grid column-->
        <div class="col-md-12 mb-4">

          <!--Card-->
          
     <div class="card">
         
         

         
         <div class="card-header text-center"></div>
          
<div class="card-body">
     <div class="list-group">   
       <?php 
       $counter=0;
       foreach($listaankiet as $ankieta){
           $counter++;
           $dane=dane_ankiety($kon,$ankieta['ankieta']);
           $counterLabel="modal".$counter."Label";
           ?>
                 <div class="list-group-item list-group-item-action flex-column align-items-start">
    <div class="d-flex w-100 justify-content-between">
      <h5 class="mb-1"><?php echo $ankieta['nazwa'];?></h5>
      <small>od: <?php echo $dane['data_first'];?></small><br/> <small>do: <?php echo $dane['data_last'];?></small>
    </div>
    <p class="mb-1">Wypełniono: <?php echo $dane['wypelniono'];?> ankiet</p>
    <small>Ilość pytań: <?php echo $dane['ilosc_pytan'];?></small><hr/>
    
    <a href="main.php?mode=sql_analytics&ank=<?php echo $ankieta['ankieta'];?>"><button class="btn btn-unique">ANALIZA</button></a>
    <a href="<?php echo "$surveyurl/?ankieta=sql&ank=$ankieta[ankieta]";?>" target="_blank">
        <button  class="btn btn-deep-orange">POKAŻ</button></a>
        <a href="main.php?mode=ankieta_sql_edycja&ank=<?php echo $ankieta['ankieta'];?>" title="EDYTUJ ANKETĘ"><i class="fas fa-edit green-text" style="margin-left:60%;"></i></a>
        <a href="#" data-target="#<?php echo $ankieta['ankieta'];?>" data-toggle="modal" title="USUŃ ANKIETĘ" <i class="fas fa-trash-alt red-text" style="margin-left:3%;" ></i> </a>
        </div>
         <?php
 $modal_array[]=" <div class=\"modal fade\" id=\"$ankieta[ankieta]\" 
               tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"$ankieta[ankieta]Label\"
  aria-hidden=\"true\">
  <div class=\"modal-dialog modal-sm\" role=\"document\">
    <div class=\"modal-content\">
      <div class=\"modal-header\">
        <h4 class=\"modal-title w-100\" id=\"$ankieta[ankieta]Label\">USUWANIE ANKIETY</h4>
        <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">
          <span aria-hidden=\"true\">&times;</span>
        </button>
      </div>
      <div class=\"modal-body\">
       Czy na pewno chcesz usunąć ankietę $ankieta[nazwa] wraz z danymi ?
      </div>
      <div class=\"modal-footer\">
        <button type=\"button\" class=\"btn btn-warning btn-sm\" data-dismiss=\"modal\">Anuluj</button>
        <a href=\"core/usun_ankiete.php?ank=$ankieta[ankieta]\"><button type=\"button\" "
         . "class=\"btn btn-danger btn-sm\">TAK</button>
      </div>
    </div>
  </div>
          </div>";
      }
       
       ?>
            </div>
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

    <?php
    $modale=implode("\n",$modal_array);
    echo $modale;
    ?>
 
 <?php include('view/ocenydyplom_Modal.php');?>
      <?php include('view/footer.php');?>
  <script>
  $( document ).ready(function() {
    new WOW().init()
});
  </script>
  
  
 
</body>

</html>