<?php switch ($_SESSION['uprawnienia']) {
    default:
        ?>
<div class="sidebar-fixed position-fixed" >
     <a class="logo-wrapper waves-effect">
        <img src="view/img/alogo2.png" class="img-fluid" alt="">
      </a>
    
      <div class="list-group list-group-flush">
          <a class="list-group-item list-group-item-action waves-effect <?php echo $dashboardactiveclass;?>" data-toggle="collapse" href="#collapseExample2" aria-expanded="false" aria-controls="collapseExample">
          <i class="fas fa-chart-pie mr-3" style="padding-left:2%"></i>Przegląd</a>
          <div class="collapse" id="collapseExample2">
              <div style="margin-top:0px !important;">
        <a href="/main.php?mode=trends" class="list-group-item list-group-item-action waves-effect">
          <i class="fas fa-chart-bar mr-3"></i>Trendy dla kierunków
        </a></div>
              <div style="margin-top:-5px !important;">
        <a href="/main.php" class="list-group-item list-group-item-action waves-effect">
          <i class="fas fa-chart-line mr-3"></i>Trendy stanów studentów
        </a></div>
          </div>
        <a href="/main.php?mode=analytics" class="list-group-item list-group-item-action <?php echo $analactiveclass;?> waves-effect">
          <i class="fas fa-user mr-3 text-success"></i>Zbieranie danych i analiza</a>
        <a href="#" class="list-group-item list-group-item-action waves-effect <?php echo $polonactive;?>" data-toggle="modal" data-target="#polonModal">
          <i class="fas fa-table mr-3 text-info"></i>POLON</a>
        <a class="list-group-item list-group-item-action waves-effect <?php echo $deanactive;?>" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
          <i class="fas fa-map mr-3 deep-orange-text"></i>Raporty Dziekanów</a>
          <div class="collapse" id="collapseExample">
              <a onclick="spinner()" href="/main.php?mode=deanreport2" class="list-group-item list-group-item-action waves-effect">
              <i class="fas fa-user-graduate mr-3 deep-orange-text" style="padding-left:2%"></i><span style="font-size:0.9em;">Oceny z prac dyplomowych</span></a>
              <div style="margin-top:-8px !important;"><a onclick="spinner()" href="/main.php?mode=deanreport1&RA=2022" class="list-group-item list-group-item-action waves-effect">
                      <i class="fas fa-filter mr-3 deep-orange-text" style="padding-left:2%"></i><span style="font-size:0.9em;">Odsiewy</span></a></div>
         
          <div style="margin-top:-8px !important;"><a href="#" data-toggle="modal" data-target="#rankingModal" class="list-group-item list-group-item-action waves-effect">
                  <i class="far fa-chart-bar mr-3 deep-orange-text" style="padding-left:2%"></i><span style="font-size:0.9em;">Ranking obron</span></a></div>
           <div style="margin-top:-8px !important;"><a href="#" data-toggle="modal" data-target="#rekrutacjaModal" class="list-group-item list-group-item-action waves-effect">
                   <i class="far fa-chart-bar mr-3 deep-orange-text" style="padding-left:2%"></i><span style="font-size:0.9em;">Raporty rekrutacji</span></a></div>
          <div style="margin-top:-8px !important;"><a href="main.php?mode=deanreport9" class="list-group-item list-group-item-action waves-effect">
                   <i class="far fa-chart-bar mr-3 deep-orange-text" style="padding-left:2%"></i><span style="font-size:0.9em;">Semestralne raporty ocen</span></a></div>
          <div style="margin-top:-8px !important;"><a href="#" data-toggle="modal" data-target="#rankingOcenModal"class="list-group-item list-group-item-action waves-effect">
                      <i class="fas fa-balance-scale mr-3 deep-orange-text" style="padding-left:2%"></i><span style="font-size:0.9em;">Roczny ranking ocen</span></a></div>
         <div style="margin-top:-8px !important;"><a href="#" data-toggle="modal" data-target="#foreignModal"class="list-group-item list-group-item-action waves-effect">
                      <i class="fas fa-globe-americas mr-3 deep-orange-text" style="padding-left:2%"></i><span style="font-size:0.9em;">Zestawienie obcokrajowców</span></a></div>
         
          </div>
          
        <a class="list-group-item list-group-item-action waves-effect 
            <?php echo $moneyactive;?>" data-toggle="collapse" href="#collapseEx" aria-expanded="false" 
            aria-controls="collapseEx">
          <i class="fas fa-money-bill-alt mr-3 indigo-text"></i>Finanse</a>
          <div class="collapse" id="collapseEx">
   <a href="#" data-toggle="modal" data-target="#wplatyModal" class="list-group-item list-group-item-action waves-effect">
       <i class="fas fa-money-check-alt mr-3 indigo-text" style="padding-left:2%">
           
       </i><span style="font-size:0.9em;">Wpłaty</span></a>
       <a href="main.php?mode=cDEF" class="list-group-item list-group-item-action waves-effect">
       <i class="fas fa-dollar-sign mr-3 indigo-text" style="padding-left:2%">
           
       </i><span style="font-size:0.9em;">Definiowanie stawek</span></a>
          </div>
          <a class="list-group-item list-group-item-action waves-effect <?php echo $ankietyactive;?>"
             data-toggle="collapse" href="#collapseAn" aria-expanded="false" aria-controls="collapseAn">
          <i class="fas fa-chart-pie mr-3 blue-grey-text"></i>Ankiety</a>
          
          <div class="collapse" id="collapseAn">
   <a href="/main.php?mode=deanreport6" class="list-group-item list-group-item-action waves-effect">
       <i class="fas fa-clipboard-check mr-3 blue-grey-text" style="padding-left:2%"></i><span style="font-size:0.9em;">Ankiety zebrane</span></a>
       <a href="#" data-toggle="modal" data-target="#wystAnkModal"class="list-group-item list-group-item-action waves-effect">
       <i class="fas fa-edit mr-3 blue-grey-text" style="padding-left:2%"></i><span style="font-size:0.9em;">Wystaw ankietę</span></a>
          <a href="/main.php?mode=surveycreator" class="list-group-item list-group-item-action waves-effect">
       <i class="fas fa-cogs mr-3 blue-grey-text" style="padding-left:2%"></i><span style="font-size:0.9em;">Utwórz ankietę SQL</span></a>
        <a href="/main.php?mode=asql" class="list-group-item list-group-item-action waves-effect">
       <i class="fas fa-database mr-3 blue-grey-text" style="padding-left:2%"></i><span style="font-size:0.9em;">Ankiety SQL</span></a>
        
          </div>
                       <a class="list-group-item list-group-item-action waves-effect <?php echo $rdactive;?>" data-toggle="collapse"
                          href="#collapseRDYD" aria-expanded="false" aria-controls="collapseRDYD">
          <i class="fas fa-money-bill-alt mr-3"></i>Rozliczenie dydaktyki</a>
           <div class="collapse" id="collapseRDYD">
               <a href="main.php?mode=showcardA"  class="list-group-item list-group-item-action waves-effect">
       <i class="fas fa-clipboard-check mr-3" style="padding-left:2%"></i><span style="font-size:0.9em;">Karty Obciążeń Dziekanat A</span></a>
           <a href="main.php?mode=showcardI" class="list-group-item list-group-item-action waves-effect">
       <i class="fas fa-clipboard-check mr-3" style="padding-left:2%"></i><span style="font-size:0.9em;">Karty Obciążeń Dziekanat IIZ</span></a>
           </div>
      </div>

    </div>
    <?php
    break;
    case "{Surveys}":
        ?>
<div class="sidebar-fixed position-fixed" >
     <a class="logo-wrapper waves-effect">
        <img src="view/img/alogo2.png" class="img-fluid" alt="">
      </a>
      <div class="list-group list-group-flush">
        <a href="/main.php" class="list-group-item <?php echo $dashboardactiveclass;?> waves-effect">
          <i class="fas fa-chart-pie mr-3"></i>Przegląd
        </a>
        
          <a class="list-group-item list-group-item-action waves-effect <?php echo $ankietyactive;?>"
             data-toggle="collapse" href="#collapseAn" aria-expanded="false" aria-controls="collapseAn">
          <i class="fas fa-chart-pie mr-3 blue-grey-text"></i>Ankiety</a>
          
          <div class="collapse" id="collapseAn">
   <a href="/main.php?mode=deanreport6" class="list-group-item list-group-item-action waves-effect">
       <i class="fas fa-clipboard-check mr-3 blue-grey-text" style="padding-left:2%"></i><span style="font-size:0.9em;">Ankiety zebrane</span></a>
       <a href="#" data-toggle="modal" data-target="#wystAnkModal"class="list-group-item list-group-item-action waves-effect">
       <i class="fas fa-edit mr-3 blue-grey-text" style="padding-left:2%"></i><span style="font-size:0.9em;">Wystaw ankietę</span></a>
       <a href="/main.php?mode=surveycreator" class="list-group-item list-group-item-action waves-effect">
       <i class="fas fa-cogs mr-3 blue-grey-text" style="padding-left:2%"></i><span style="font-size:0.9em;">Utwórz ankietę SQL</span></a>
        <a href="/main.php?mode=asql" class="list-group-item list-group-item-action waves-effect">
       <i class="fas fa-database mr-3 blue-grey-text" style="padding-left:2%"></i><span style="font-size:0.9em;">Ankiety SQL</span></a>
        
          </div>
                      
      </div>

    </div>
<?php
        break;
    case "{Students,Didactics,Surveys}":
        ?>
       <div class="sidebar-fixed position-fixed" >
     <a class="logo-wrapper waves-effect">
        <img src="view/img/alogo2.png" class="img-fluid" alt="">
      </a>
      <div class="list-group list-group-flush">
        <a href="/main.php" class="list-group-item <?php echo $dashboardactiveclass;?> waves-effect">
          <i class="fas fa-chart-pie mr-3"></i>Przegląd
        </a>
        <a href="/main.php?mode=analytics" class="list-group-item list-group-item-action <?php echo $analactiveclass;?> waves-effect">
          <i class="fas fa-user mr-3 text-success"></i>Zbieranie danych i analiza</a>
      
        <a class="list-group-item list-group-item-action waves-effect <?php echo $deanactive;?>" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
          <i class="fas fa-map mr-3 deep-orange-text"></i>Raporty Dziekanów</a>
          <div class="collapse" id="collapseExample">
              <a onclick="spinner()" href="/main.php?mode=deanreport2" class="list-group-item list-group-item-action waves-effect">
              <i class="fas fa-user-graduate mr-3 deep-orange-text" style="padding-left:2%"></i><span style="font-size:0.9em;">Oceny z prac dyplomowych</span></a>
              <div style="margin-top:-8px !important;"><a onclick="spinner()" href="/main.php?mode=deanreport1&RA=2022" class="list-group-item list-group-item-action waves-effect">
                      <i class="fas fa-filter mr-3 deep-orange-text" style="padding-left:2%"></i><span style="font-size:0.9em;">Odsiewy</span></a></div>
         
          <div style="margin-top:-8px !important;"><a href="#" data-toggle="modal" data-target="#rankingModal" class="list-group-item list-group-item-action waves-effect">
                  <i class="far fa-chart-bar mr-3 deep-orange-text" style="padding-left:2%"></i><span style="font-size:0.9em;">Ranking obron</span></a></div>
           <div style="margin-top:-8px !important;"><a href="#" data-toggle="modal" data-target="#rekrutacjaModal" class="list-group-item list-group-item-action waves-effect">
                   <i class="far fa-chart-bar mr-3 deep-orange-text" style="padding-left:2%"></i><span style="font-size:0.9em;">Raporty rekrutacji</span></a></div>
          <div style="margin-top:-8px !important;"><a href="main.php?mode=deanreport9" class="list-group-item list-group-item-action waves-effect">
                   <i class="far fa-chart-bar mr-3 deep-orange-text" style="padding-left:2%"></i><span style="font-size:0.9em;">Semestralne raporty ocen</span></a></div>
                   <div style="margin-top:-8px !important;"><a href="#" data-toggle="modal" data-target="#rankingOcenModal"class="list-group-item list-group-item-action waves-effect">
                      <i class="fas fa-balance-scale mr-3 deep-orange-text" style="padding-left:2%"></i><span style="font-size:0.9em;">Roczny ranking ocen</span></a></div>
           <div style="margin-top:-8px !important;"><a href="#" data-toggle="modal" data-target="#foreignModal"class="list-group-item list-group-item-action waves-effect">
                      <i class="fas fa-globe-americas mr-3 deep-orange-text" style="padding-left:2%"></i><span style="font-size:0.9em;">Zestawienie obcokrajowców</span></a></div>
          </div>
          
      
          <a class="list-group-item list-group-item-action waves-effect <?php echo $ankietyactive;?>"
             data-toggle="collapse" href="#collapseAn" aria-expanded="false" aria-controls="collapseAn">
          <i class="fas fa-chart-pie mr-3 blue-grey-text"></i>Ankiety</a>
          
          <div class="collapse" id="collapseAn">
   <a href="/main.php?mode=deanreport6" class="list-group-item list-group-item-action waves-effect">
       <i class="fas fa-clipboard-check mr-3 blue-grey-text" style="padding-left:2%"></i><span style="font-size:0.9em;">Ankiety zebrane</span></a>
       
          
        <a href="/main.php?mode=asql" class="list-group-item list-group-item-action waves-effect">
       <i class="fas fa-database mr-3 blue-grey-text" style="padding-left:2%"></i><span style="font-size:0.9em;">Ankiety SQL</span></a>
        
          </div>
                     
      </div>

    </div>
    <?php
    break; 
 case "{Students}":
     ?>
     <div class="sidebar-fixed position-fixed" >
     <a class="logo-wrapper waves-effect">
        <img src="view/img/alogo2.png" class="img-fluid" alt="">
      </a>
      <div class="list-group list-group-flush">
        <a href="/main.php" class="list-group-item <?php echo $dashboardactiveclass;?> waves-effect">
          <i class="fas fa-chart-pie mr-3"></i>Przegląd
        </a>
        <a href="/main.php?mode=analytics" class="list-group-item list-group-item-action <?php echo $analactiveclass;?> waves-effect">
          <i class="fas fa-user mr-3 text-success"></i>Zbieranie danych i analiza</a>
        <a href="#" class="list-group-item list-group-item-action waves-effect <?php echo $polonactive;?>" data-toggle="modal" data-target="#polonModal">
          <i class="fas fa-table mr-3 text-info"></i>POLON</a>
      </div></div>
         <?php break;
}
?>

  </header>