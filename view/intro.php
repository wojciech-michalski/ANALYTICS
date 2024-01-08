

<body>
  <!-- Main navigation -->
  <header>
    <!--Navbar-->
 <?php include('menu_intro.php');?>
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
              <h1 class="h1-responsive font-weight-bold mt-sm-5">Zaloguj się do systemu </h1>
              <hr class="hr-light">
              <form method="post" action="login.php">
    <p class="h5 text-center mb-4">Podaj nazwę użytkownika i hasło</p>

    <div class="md-form" class="text-white">
        <i class="fa fa-envelope prefix grey-text"></i>
        <input type="text" id="defaultForm-email" class="form-control white-text" name="user">
        <label for="defaultForm-email" class="text-white">Nazwa użytkownika</label>
    </div>

    <div class="md-form">
        <i class="fa fa-lock prefix grey-text"></i>
        <input type="password" id="defaultForm-pass" class="form-control white-text" name="pass">
        <label for="defaultForm-pass" class="text-white">Hasło</label>
        <span><a href="#" data-toggle="modal" data-target="#pass-remind" class="grey-text">Nie pamiętam hasła</a></span>
    </div>

    <div class="text-center">
        <button  class="btn btn-unique">Zaloguj</button>
    </div>
</form>
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
 <div class="modal fade" id="pass-remind" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content"><form method="POST" action="pass-reset.php">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Resetuj hasło</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              <div class="md-form">
    <input type="text" name="email" id="form1" class="form-control">
    <label for="form1" class="">Podaj swój email</label>
</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Anuluj</button>
                <button type="submit" class="btn btn-primary">Wyślij</button>
            </div></form>
        </div>
    </div>
</div>
                              
  <?php include('view/footer.php');?>
  <script>
  $( document ).ready(function() {
    new WOW().init()
});
  </script>
</body>

</html>