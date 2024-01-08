   <nav class="navbar navbar-expand-lg navbar-dark fixed-top scrolling-navbar">
      <div class="container">
        <a class="navbar-brand" href="/main.php">
          <img src="/view/img/alogo.png" style="height:40px;" />
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-7" aria-controls="navbar-7" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar-7">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link" href="/main.php?mode=analytics">Zbieranie danych i analiza
                
              </a>
            </li>
             <li class="nav-item">
                 <a class="nav-link" href="#" data-toggle="modal" data-target="#polonModal">POLON
                
                 </a></li>
                 <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Raporty Dziekanów</a>
                <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="/main.php?mode=deanreport1&RA=2022">Odsiewy</a>
                    <a class="dropdown-item" href="/main.php?mode=deanreport2">Oceny z prac dyplomowych</a>
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#rankingModal">Ranking obron</a>
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#rekrutacjaModal">Raporty rekrutacji</a>
                  <!--  <a class="dropdown-item" href="/core/privmanager.php">Uprawnienia</a>-->
                </div>
            </li>
                 <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Finanse</a>
                <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink2">
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#wplatyModal">Wpłaty</a>
                  
                  <!--  <a class="dropdown-item" href="/core/privmanager.php">Uprawnienia</a>-->
                </div>
            </li>
           <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Ankiety</a>
                <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="http://ankiety.wseiz.pl/MP" target="_blank">Ankiety</a>
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#mlaModal">Monitoring losów absolwentów</a>
                  <!--  <a class="dropdown-item" href="/core/privmanager.php">Uprawnienia</a>-->
                </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Rozliczenie dydaktyki</a>
            </li>
            <?php if($_SESSION['user']=='Admin') {
                ?>
             <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Administracja</a>
                <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="/core/usermanager.php">Użytkownicy</a>
                    <a class="dropdown-item" href="/core/groupmanager.php">Grupy</a>
                  <!--  <a class="dropdown-item" href="/core/privmanager.php">Uprawnienia</a>-->
                </div>
            </li>
            
            <?php
                        }
                        else echo "";
                        ?>
            </ul>
         <!-- <form class="form-inline">
            <div class="md-form my-0">
              <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
            </div>
          </form>-->
           <ul class="navbar-nav mr-auto"><li class="nav-item">
              <a href="/logout.php" class="nav-link">wyloguj</a>             
               </li></ul>
        </div>
      </div>
    </nav>

