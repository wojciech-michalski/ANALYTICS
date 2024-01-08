<?php
//include('controller/U10_Przynaleznosci.php');
//include('controller/statusyANALYTICS.php');
include('controller/karta_obciazen.php');
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
            <span>Karty obciążeń</span>
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
<div class="alert alert-success" role="alert">
  Dane dla roku akademickiego <?php echo $_POST['rok_akademicki']."/".$_POST['rok_akademicki']+1;?> 
  zostały przygotowane. <hr/><!-- comment -->
  <a href="main.php?mode=showcardA"><button class="btn btn-indigo">OK</button></a>
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
    <?php include('view/filtr_Modal.php');?>
      <?php include('view/footer.php');?>

  
  
 
</body>

</html>

