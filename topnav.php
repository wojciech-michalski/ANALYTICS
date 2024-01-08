 <nav class="navbar fixed-top navbar-expand-lg navbar-light white scrolling-navbar">
      <div class="container-fluid">
<ul class="navbar-nav nav-flex-icons">
    <li class="nav-item d-flex light-blue-text" style="font-size:1em;"><i class="fas fa-key prefix fa-2x light-blue-text"></i>&nbsp;&nbsp;<?php echo $_SESSION['user'];?></li>
    <?php switch($_GET['mode']){
        case "deanreport5":
         case "cDEF":
             ?>
             <li class="nav-item d-flex indigo-text" style="font-size:1em; margin-left:150%;">
             <a href="main.php?mode=cDEF" >
         <span class="tmi" style="padding-left:0.9rem;" title="definicja stawek"><i class="fas fa-dollar-sign prefix fa-lg indigo-text" ></i></span></a></li>
         <li class="nav-item d-flex indigo-text" style="font-size:1em; margin-left:2%;">
             <a href="main.php?mode=cDEF" >
         <span class="tmi" style="padding-left:0.5rem;" title="wpłaty"><i class="fas fa-money-check-alt prefix fa-lg indigo-text" ></i></span></a></li>
         <?php
         break;
        case "KMON":
        case "zestawienie":
        case "analytics":
            ?>
             <li class="nav-item d-flex success-text" style="font-size:1em; margin-left:150%;">
             <a href="#" data-toggle="modal" data-target="#exampleModal">
         <span class="tmi" style="padding-left:0.8rem;" title="analiza na dzień"><i class="fas fa-calendar-alt prefix fa-lg text-success" ></i></span></a></li>
         <li class="nav-item d-flex indigo-text" style="font-size:1em; margin-left:2%;">
             <a href="#" data-toggle="modal" data-target="#kmonModal">
         <span class="tmi" style="padding-left:0.7rem;" title="zestawienie kobiety, mężczyźni, obcokrajowcy, obcokrajowcy"><i class="fas fa-th-list prefix fa-lg text-success" ></i></span></a></li>
         <li class="nav-item d-flex indigo-text" style="font-size:1em; margin-left:2%;">
             <a href="#" data-toggle="modal" data-target="#SGModal">
         <span class="tmi" style="padding-left:0.7rem;" title="zestawienie dla straży granicznej"><i class="fas fa-globe-africa fa-lg text-success" ></i></span></a></li>
         <?php
    default:
        break;
        case "koI":
            case "showcardI":
        case "invI":
            ?>
            <li class="nav-item d-flex light-blue-text" style="font-size:1em; margin-left:90%;">
                <a href="main.php?mode=showcardI"><span class="tmi" title="karty zatwierdzone"><i class="fab fa-wpforms prefix fa-lg" ></i></span></a></li>
             <li class="nav-item d-flex light-blue-text" style="font-size:1em; margin-left:2%;">
                 <a href="#" data-target="#modalKartaObciazenI" data-toggle="modal"><span class="tmi" title="wystaw dla wykładowcy"><i class="far fa-plus-square prefix fa-lg" ></i></span></a></li>
              <li class="nav-item d-flex light-blue-text" style="font-size:1em; margin-left:2%;">
             <a href="#" data-target="#modalSzykujKartaObciazen" data-toggle="modal">
         <span class="tmi" title="przygotuj karty obciążeń"><i class="fas fa-users-cog prefix fa-lg" ></i></span></a></li>
         <li class="nav-item d-flex indigo-text" style="font-size:1em; margin-left:12%;">
             <a href="main.php?mode=cDEF" >
         <span class="tmi" style="padding-left:0.9rem;" title="definicja stawek"><i class="fas fa-dollar-sign prefix fa-lg indigo-text" ></i></span></a></li>
    <?php
    break;
case "koA":
            case "showcardA":
        case "cDEF":
        case "inv":
            ?>
            <li class="nav-item d-flex light-blue-text" style="font-size:1em; margin-left:90%;">
                <a href="main.php?mode=showcardA"><span class="tmi" title="karty zatwierdzone"><i class="fab fa-wpforms prefix fa-lg" ></i></span></a></li>
    <li class="nav-item d-flex light-blue-text" style="font-size:1em; margin-left:2%;">
        <a href="#" data-target="#modalKartaObciazen" data-toggle="modal">
         <span class="tmi" title="wystaw dla wykładowcy"><i class="far fa-plus-square prefix fa-lg" ></i></span></a></li>
         <li class="nav-item d-flex light-blue-text" style="font-size:1em; margin-left:2%;">
         <a href="#" data-target="#modalSzykujKartaObciazen" data-toggle="modal">
         <span class="tmi" title="przygotuj karty obciążeń"><i class="fas fa-users-cog prefix fa-lg" ></i></span></a></li>
         <li class="nav-item d-flex indigo-text" style="font-size:1em; margin-left:12%;">
             <a href="main.php?mode=cDEF" >
         <span class="tmi" style="padding-left:0.9rem;" title="definicja stawek"><i class="fas fa-dollar-sign prefix fa-lg indigo-text" ></i></span></a></li>
                    <?php
    break;
        case "deanreport2":
        case "deanreport9":
        case "deanreport1":
        case "deanreport3":
        case "deanreport4":  
        case "deanreport10":
        case "deanreport14":
        case "rektrend":
        case "foreigners":
            ?>
            <li class="nav-item d-flex light-blue-text" style="font-size:1em; margin-left:90%;">
                <a onclick="spinner();" href="main.php?mode=deanreport2"><span class="tmi" title="oceny z prac dyplomowych"><i class="fas fa-user-graduate prefix fa-lg deep-orange-text" ></i></span></a></li>
    <li class="nav-item d-flex light-blue-text" style="font-size:1em; margin-left:2%;">
        <a onclick="spinner();" href="main.php?mode=deanreport1&RA=2022"><span class="tmi" title="odsiewy"><i class="fas fa-filter prefix fa-lg deep-orange-text" ></i></span></a></li>
    <li class="nav-item d-flex light-blue-text" style="font-size:1em; margin-left:2%;">
        <a href="#" data-target="#rankingModal" data-toggle="modal"><span class="tmi" title="ranking obron"><i class="far fa-chart-bar prefix fa-lg deep-orange-text" ></i></span></a></li>
    <li class="nav-item d-flex light-blue-text" style="font-size:1em; margin-left:2%;">
        <a href="#" data-target="#rekrutacjaModal" data-toggle="modal"><span class="tmi" title="raporty rekrutacji"><i class="fas fa-graduation-cap prefix fa-lg deep-orange-text" ></i></span></a></li>
    <li class="nav-item d-flex light-blue-text" style="font-size:1em; margin-left:2%;">
        <a href="main.php?mode=deanreport9"><span class="tmi" title="raporty semestralne ocen"><i class="fas fa-marker prefix fa-lg deep-orange-text" ></i></span></a></li>
     <li class="nav-item d-flex light-blue-text" style="font-size:1em; margin-left:2%;">
        <a href="main.php?mode=rektrend"><span class="tmi" title="trend rekrutacji dla poprzedniego miesiąca"><i class="fas fa-chart-line prefix fa-lg deep-orange-text" ></i></span></a></li>
     <li class="nav-item d-flex light-blue-text" style="font-size:1em; margin-left:2%;">
        <a href="#" data-target="#rankingOcenModal" data-toggle="modal"><span class="tmi" style="padding-left:0.5rem;" title="ranking ocen z przedmiotów w roku akademickim"><i class="fas fa-balance-scale prefix fa-lg deep-orange-text" ></i></span></a></li>
     <li class="nav-item d-flex light-blue-text" style="font-size:1em; margin-left:2%;">        
     <a href="#" data-target="#foreignModal" data-toggle="modal"><span class="tmi" title="zestawienie cudzoziemców"><i class="fas fa-globe-americas prefix fa-lg deep-orange-text" ></i></span></a></li>
              <?php
    break;
    case "deanreport6":
        case "deanreport7":
        case "deanreport8":
        case "deanreport12":
        case "deanreport13":
        case "deanreport15":
        case "surveycreator":
        case "survey1":
        case "survey2":
        case "asql": 
        case "sql_analytics":
        case "ankieta_sql_edycja":
            case "solver3-1":
         ?>
         <li class="nav-item d-flex light-blue-text" style="font-size:1em; margin-left:90%;">
                <a onclick="spinner();" href="main.php?mode=deanreport6"><span class="tmi" title="ankiety zebrane">
                        <i class="fas fa-clipboard-check blue-grey-text prefix fa-lg deep-orange-text" ></i></span></a></li>
                        <li class="nav-item d-flex light-blue-text" style="font-size:1em; margin-left:2%;">
                <a onclick="spinner();" href="#" data-target="#wystAnkModal" data-toggle="modal"><span class="tmi" title="wystaw ankietę">
                        <i class="fas fa-edit blue-grey-text prefix fa-lg deep-orange-text" ></i></span></a></li>
                        <li class="nav-item d-flex light-blue-text" style="font-size:1em; margin-left:2%;">
                <a onclick="spinner();" href="main.php?mode=surveycreator" ><span class="tmi" title="utwórz ankietę SQL">
                        <i class="fas fa-cogs blue-grey-text prefix fa-lg deep-orange-text" ></i></span></a></li>
                         <li class="nav-item d-flex light-blue-text" style="font-size:1em; margin-left:2%;">
                <a onclick="spinner();" href="main.php?mode=asql" ><span class="tmi" title="ankiety SQL">
                        <i class="fas fa-database blue-grey-text prefix fa-lg deep-orange-text" ></i></span></a></li>
    <?php break;

         }?>
    
</ul>
       
<?php switch($_SESSION['uprawnienia']){
    case "{ALL}":
?>
          <!-- Right -->
          <ul class="navbar-nav nav-flex-icons" >
             <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Administracja</a>
                <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="/core/usermanager.php">Użytkownicy</a>
                    <a class="dropdown-item" href="/core/groupmanager.php">Grupy</a>
                  <!--  <a class="dropdown-item" href="/core/privmanager.php">Uprawnienia</a>-->
                </div>
            </li>
            <li class="nav-item">
              <a href="/logout.php" class="nav-link">wyloguj</a>             
               </li>
          </ul>
<?php break;
    default:
        ?>
          <ul class="navbar-nav nav-flex-icons" >
             
            <li class="nav-item">
              <a href="/logout.php" class="nav-link">wyloguj</a>             
               </li>
          </ul>
          <?php break;
}
?>
        </div>

      </div>
    </nav>
<?php include('view/modaLKartaObciazenPrepare.php');?>