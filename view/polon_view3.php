<link href="https://fonts.googleapis.com/css?family=Fira+Mono">
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
            <span>POLON</span>
            <span>/</span>
            <span>PARAMETRY API</span>
          </h4>

          

        </div>

      </div>
              <div class="row wow fadeIn">

        <!--Grid column-->
        <div class="col-md-12 mb-4">

          <!--Card-->
          
     <div class="card">
<div class="card-header text-center">
          PARAMETRY SERWERA POLON
            </div>
<div class="card-body">
 <table class="table">
  <thead>
    <tr>
      <th scope="col">API URL</th>
      <th scope="col">API USER</th>
      <th scope="col">API PASS</th>
      <th scope="col">TOKEN HEADER</th>
    </tr>
  </thead>
  <tbody>
      <tr><td><?php echo $POLONAPIurl;?></td><td><?php echo $polonUser;?></td><td>*********</td><td>
          <?php echo $authTokenHeader;?></td></tr>
  </tbody></table><!-- comment -->    
       </div>
              
<div class="card-header text-center">
          PARAMETRY SYNCHRONIZACJI
            </div>
<div class="card-body">
 <table class="table">
  <thead>
    <tr>
      <th scope="col">HARMONOGRAM CRON</th>
      <th scope="col">OSTATNIA SYNCHRONIZACJA</th>
      <th scope="col">STATUS</th>
      <th scope="col">AKCJE</th>
    </tr>
  </thead>
  <tbody>
      <tr><td>daily</td><td><?php echo date('Y-m-d')." 06:01:15";?></td><td class="green-text"><i class="fas fa-angle-down"></i> OK</td><td>
             <a href="main.php?mode=PAPI&check=1" <button class="btn btn-success">SPRAWDŹ POŁĄCZENIE</button></td></tr>
  </tbody></table>        
          </div>
         <div class="card-header text-center">
             <a href="https://polon2-demo.opi.org.pl/" target="_blank"><button class="btn btn-indigo">ZALOGUJ DO POLON</button></a>
            </div>


        </div>
        <!--Grid column-->

        <!--Grid column-->
        
        <!--Grid column-->

      </div>
        </div>
        
       </div>
    <?php// include('view/filtr_Modal.php');?>
      <?php include('view/footer.php');
      if($_GET['check']==1){
          ?>
        <div class="modal fade" id="status" tabindex="-1" role="dialog" aria-labelledby="statusModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="statusModalLabel">TEST POŁĄCZENIA POLON API</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        STATUS: SUKCES
      </div>
      <div class="modal-footer">
          <a href="main.php?mode=PAPI"><button type="button" class="btn btn-secondary">ZAMKNIJ</button></a>
        
      </div>
    </div>
  </div>
</div>  
           
           <script>
               $('#status').modal('show');
               </script>
               <?php
      }
?>
  <script>
 // $( document ).ready(function() {
//    new WOW().init()
//});
  </script>
  <script src="termynal.js" data-termynal-container="#termynal"></script>
  
 
</body>

</html>