<?php

require('../config/config.php');
require('../controller/session_controller.php');
require('../controller/konekt_MySQL.php');
require('../controller/groups.php');
include('../view/header_intro.php');
include('../view/topnav.php');
?>
    <div class="row" style="margin-top:70px;">
           <div class="col-md-2">
               <?php
       include('../view/sidenav.php');
           ?>
           </div>
        <div class="col-md-10" style="padding-left:5%">
                 <div class="card mb-4 wow fadeIn">

        <!--Card content-->
        <div class="card-body d-sm-flex justify-content-between">

          <h4 class="mb-2 mb-sm-0 pt-1">
            <a href="#" target="_blank">Analytics</a>
            <span>/</span>
            <span>ZARZĄDZANIE GRUPAMI</span>
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
    <div class="col-md-10 white-text text-center text-md-left mt-xl-5 mb-5 wow fadeInLeft" data-wow-delay="0.3s">
              <button data-toggle="modal"  data-target="#exampleModal" type="button" class="btn btn-light-blue">+ nowa grupa</button>
               
              <table id="dtMaterialDesignExampleG" class="table table-striped" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th class="th-sm">Nazwa grupy
      </th>
      <th class="th-sm">Uprawnienia
      </th>
           <th class="th-sm">Aktywna
      </th>
      
      <th class="th-sm">Akcje
      </th>
    </tr>  </thead> <tbody>
     <?php
     do {
         $group=mysqli_fetch_array($groups);
         $k=$k+1;
         echo "<tr><td>".$group['nazwa']."</td><td>".$group['module_privileges']."</td><td>".$group['active']."</td><td><button type=\"button\" class=\"btn btn-unique btn-sm\">Dezaktywuj</button><button type=\"button\" data-target=\"#privilModal$k\" data-toggle=\"modal\" class=\"btn btn-yellow btn-sm\">Przydziel uprawnienia do modułów</button><button type=\"button\" data-toggle=\"modal\" data-target=\"#removegroupModal$k\" class=\"btn btn-danger btn-sm\">Usuń</button></td></tr>";
         $modals[]="<div class=\"modal fade\" id=\"removegroupModal$k\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"exampleModalLabel$k\" aria-hidden=\"true\">
    <div class=\"modal-dialog\" role=\"document\">
        <div class=\"modal-content\">
            <div class=\"modal-header\">
                <h5 class=\"modal-title\" id=\"exampleModalLabel$k\">Usuń grupę</h5>
                <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">
                    <span aria-hidden=\"true\">&times;</span>
                </button>
            </div>
            <div class=\"modal-body\">
                <h4>Czy na pewno chcesz usunąć grupę ".$group['nazwa']." ?</h4>
                   
 
            </div>
            <div class=\"modal-footer\">
              <button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">NIE</button>
              <a href=\"/core/groupremove.php?id=".$group['id']."\"> <button type=\"button\" class=\"btn btn-primary\">TAK</button>  </a>
            </div>
        </div>
    </div>
</div>";
         $privs[]="<div class=\"modal fade\" id=\"privilModal$k\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"examplePrivLabel$k\" aria-hidden=\"true\">
    <div class=\"modal-dialog\" role=\"document\">
<form method=\"post\" action=\"/core/setgroupprivilleges.php?id=".$group['id']."\">        
<div class=\"modal-content\">
            <div class=\"modal-header\">
                <h5 class=\"modal-title\" id=\"examplePrivLabel$k\">Ustaw uprawnienia</h5>
                <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">
                    <span aria-hidden=\"true\">&times;</span>
                </button>
            </div>
            <div class=\"modal-body\">
                <h4>Ustawiasz uprawnienia dla grupy ".$group['nazwa']." </h4>
                  <div class=\"md-form\"\ style=\"margin-bottom:30%;\">
        <select class=\"mdb-select\" multiple name=\"modules[]\">
    <option value=\"\" disabled selected>Uprawnienia do modułów</option>
    <option value=\"ALL\">Wszystkie</option>
    <option value=\"Students\">Dane o studentach</option>
    <option value=\"Didactics\">Rozliczenie dydaktyki</option>
    <option value=\"Surveys\">Ankiety</option>
    <option value=\"Admin\">Administrator</option> </select>
<label>Wybierz jeden, lub więcej modułów</label>
       
    </div>     
 
            </div>
            <div class=\"modal-footer\">
              <button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">NIE</button>
              <button type=\"submit\" class=\"btn btn-primary\">TAK</button>
            </div></form>
        </div>
    </div>
</div>";
     }
     while($k<$ilu);
     ?>
  </tbody></table>
               
            </div></div></div></div>
 
       


      </div>
        </div>
        
       </div>

<?php include('../view/groupmodal.php');
 foreach ($modals as $modal){
     echo $modal;
 }
foreach ($privs as $priv){
     echo $priv;
 }
 ?>

      <?php include('../view/footer.php');?>
  <script>
  //$( document ).ready(function() {
 //   new WOW().init()
//});
  </script>
  
  
 
</body>

</html>

