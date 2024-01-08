<?php

require('../config/config.php');
require('../controller/session_controller.php');
require('../controller/konekt_MySQL.php');
require('../controller/users.php');
include('../view/header_intro.php');
?>
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
            <div class="col-md-10 white-text text-center text-md-left mt-xl-5 mb-5 wow fadeInLeft" data-wow-delay="0.3s">
              <button data-toggle="modal"  data-target="#exampleModal" type="button" class="btn btn-light-blue">+ nowy użytkownik</button>
               
              <table id="dtMaterialDesignExample" class="table table-striped" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th class="th-sm">Nazwa użytkownika
      </th>
      <th class="th-sm">Adres email
      </th>
      <th class="th-sm">Grupa
      </th>
      <th class="th-sm">Aktywny
      </th>
      
      <th class="th-sm">Akcje
      </th>
    </tr>  </thead> <tbody>
     <?php
     $groups=mysqli_query($kon,"SELECT `id`,`nazwa` FROM `groups` WHERE `active`=1");
     $groupcounter=0;
     $ilegrup=mysqli_num_rows($groups);
     do {
         $grupa=mysqli_fetch_array($groups);
         $grupaoption[]="<option value=\"".$grupa['id']."\">".$grupa['nazwa']."</option>";
         $groupcounter=$groupcounter+1;
         
     }
     while($groupcounter<$ilegrup);
     $groupsoptions=implode("",$grupaoption);
     do {
         $user=mysqli_fetch_array($users);
         $k=$k+1;
         echo "<tr><td>".$user['name']."</td><td>".$user['email']."</td><td>".$user['nazwa']."</td><td>".$user['active']."</td><td><button type=\"button\" class=\"btn btn-unique btn-sm\">Dezaktywuj</button><button type=\"button\" data-toggle=\"modal\" data-target=\"#resetuserModal$k\" class=\"btn btn-light-green btn-sm\">Zmień hasło</button><button type=\"button\" data-target=\"#privilModal$k\" data-toggle=\"modal\" class=\"btn btn-yellow btn-sm\">Przydziel do grup</button><button type=\"button\" data-toggle=\"modal\" data-target=\"#removeuserModal$k\" class=\"btn btn-danger btn-sm\">Usuń</button></td></tr>";
          $modals[]="<div class=\"modal fade\" id=\"removeuserModal$k\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"exampleModalLabel$k\" aria-hidden=\"true\">
    <div class=\"modal-dialog\" role=\"document\">
        <div class=\"modal-content\">
            <div class=\"modal-header\">
                <h5 class=\"modal-title\" id=\"exampleModalLabel$k\">Usuń użytkownika</h5>
                <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">
                    <span aria-hidden=\"true\">&times;</span>
                </button>
            </div>
            <div class=\"modal-body\">
                <h4>Czy na pewno chcesz usunąć użytkownika ".$user['name']." ?</h4>
                   
 
            </div>
            <div class=\"modal-footer\">
              <button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">NIE</button>
              <a href=\"/core/userremove.php?id=".$user['id']."\"> <button type=\"button\" class=\"btn btn-primary\">TAK</button>  </a>
            </div>
        </div>
    </div>
</div>";
           $privs[]="<div class=\"modal fade\" id=\"privilModal$k\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"examplePrivLabel$k\" aria-hidden=\"true\">
    <div class=\"modal-dialog\" role=\"document\">
<form method=\"post\" action=\"/core/setusergroup.php?id=".$user['id']."\">        
<div class=\"modal-content\">
            <div class=\"modal-header\">
                <h5 class=\"modal-title\" id=\"examplePrivLabel$k\">Ustaw uprawnienia</h5>
                <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">
                    <span aria-hidden=\"true\">&times;</span>
                </button>
            </div>
            <div class=\"modal-body\">
                <h4>Przydzielasz użytkownika ".$user['name']." do grupy:</h4>
                  <div class=\"md-form\"\ style=\"margin-bottom:30%;\">
        <select class=\"mdb-select\" name=\"groups\">
    <option value=\"\" disabled selected>Przydziel do grupy</option>
    $groupsoptions
        </select>
<label>Wybierz grupę</label>
       
    </div>     
 
            </div>
            <div class=\"modal-footer\">
              <button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">NIE</button>
              <button type=\"submit\" class=\"btn btn-primary\">TAK</button>
            </div></form>
        </div>
    </div>
</div>";
           $respass[]="<div class=\"modal fade\" id=\"resetuserModal$k\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"resetModalLabel$k\" aria-hidden=\"true\">
    <div class=\"modal-dialog\" role=\"document\">
    <form method=\"post\" action=\"/core/changeuserpassword.php\">
        <div class=\"modal-content\">
            <div class=\"modal-header\">
                <h5 class=\"modal-title\" id=\"resetModalLabel$k\">Zmień hasło użytkownikowi</h5>
                <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">
                    <span aria-hidden=\"true\">&times;</span>
                </button>
            </div>
            <div class=\"modal-body\">
                <h4>Zmieniasz hasło użytkownika ".$user['name']." ?</h4>
                  <div class=\"md-form\">
    <input type=\"text\" id=\"form1\" class=\"form-control\" name=\"pass\" >
    <label for=\"form1\" class=\"\">Podaj nowe hasło</label>
</div> 
 <input type=\"hidden\" id=\"form1\" class=\"form-control\" name=\"id\" value=\"".$user['id']."\">
            </div>
            <div class=\"modal-footer\">
              <button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">NIE</button>
             <button type=\"submit\" class=\"btn btn-primary\">TAK</button>
            </div>
        </div>
    </div></form>
</div>";
         }
     while($k<$ilu);
     ?>
  </tbody></table>
               
            </div>
            <!--Grid column-->
            <!--Grid column-->
            <div class="col-md-2 col-xl-5 mt-xl-5 wow fadeInRight" data-wow-delay="0.3s">
                <h4>Użytkownicy</h4>
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
  </header><?php include('view/usermodal.php');?><?php
foreach ($modals as $modal){
     echo $modal;
 }
 foreach ($privs as $priv){
     echo $priv;
 }
 foreach ($respass as $res){
     echo $res;
 }
include('../view/footer.php');
?>
<script>
  $( document ).ready(function() {
    new WOW().init()
});
  </script>
