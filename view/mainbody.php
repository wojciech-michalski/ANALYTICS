<?php
include('controller/U10_Przynaleznosci.php');
include('controller/statusyANALYTICS.php');
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
        <div class="container">
          <!--Grid row-->
          <div class="row">
            <!--Grid column-->
            <div class="col-md-6 white-text text-center text-md-left mt-xl-5 mb-5 wow fadeInLeft" data-wow-delay="0.3s">
              <h1 class="h1-responsive font-weight-bold mt-sm-5"> <?php echo $_SESSION['user'];?> </h1>
              <hr class="hr-light">
     
            </div>
            <!--Grid column-->
            <!--Grid column-->
            <div class="col-md-6 col-xl-5 mt-xl-5 wow fadeInRight" data-wow-delay="0.3s">
              <img src="view/img/admin-new.png" alt="" class="img-fluid">
            </div>
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
  <!-- Main navigation -->
  <!--Main Layout-->
  <!--<main>
    <div class="container">
      
      <div class="row py-5">
        
      </div>
      
    </div>
  </main>-->
  <!--Main Layout-->
  <!-- SCRIPTS -->
  <!-- JQuery -->
  <?php include('view/footer.php');?>
  <script>
  $( document ).ready(function() {
    new WOW().init()
});
  </script>
</body>

</html>