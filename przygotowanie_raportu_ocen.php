<?php include('view/topnav.php');
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
            <span>SEMESTRALNY RAPORT OCEN - PRZYGOTOWANIE DANYCH</span>
          </h4>

         

        </div>

      </div>
              <div class="row wow fadeIn">

        <!--Grid column-->
        <div class="col-md-12 mb-4">

          <!--Card-->
          
     <div class="card">

          <?php 
          $ddq=explode(";",$_POST['prepare']);
          $rok_akademicki=$ddq[0];
          $semestr=$ddq[1];
          include ('controller/raport_semestralny_ocen.php');
         ?>
        

        </div>
        <!--Grid column-->

        <!--Grid column-->
        
        <!--Grid column-->

      </div>
        </div>
        
       </div>

    
 
 <?php include('view/ocenydyplom_Modal.php');?>
      <?php include('view/footer.php');?>
  <script>
  $( document ).ready(function() {
    new WOW().init()
});
  </script>
  
  
 
</body>

</html>
