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
              
            </div>
<div class="card-body">
<button type="button" class="btn btn-info sqbaton" data-toggle="modal" data-target="#exampleModal">
    Analiza na dzień<br/><i class="fas fa-calendar-alt fa-3x"></i>
</button>
    <button type="button" class="btn btn-indigo sqbaton" data-toggle="modal" data-target="#kmonModal">
    zestawienie KMON<br/><i class="fas fa-th-list fa-3x"></i>
</button>
<button type="button" class="btn btn-success sqbaton" data-toggle="modal" data-target="#SGModal">
    zestawienie dla SG<br/><i class="fas fa-globe-africa fa-3x"></i>
</button>              

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

