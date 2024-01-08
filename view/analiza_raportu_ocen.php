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
            <span>SEMESTRALNY RAPORT OCEN</span>
          </h4>

         

        </div>

      </div>
              <div class="row wow fadeIn">

        <!--Grid column-->
        <div class="col-md-12 mb-4">

          <!--Card-->
          
     <div class="card">
          <?php //include ('controller/raport_semestralny_ocen.php');
         ?>
         
     
         

         
         <div class="card-header text-center">
             <?php $dane_do_query=explode(";",$_POST['analiza']);
             switch ($dane_do_query[1]){
                 case 0:
                     $semZL="Zimowy";
                     break;
                 case 1:
                     $semZL="Letni";
                     break;
                 
             }
             echo "$dane_do_query[0]/".$dane_do_query[0]+1 ." semestr $semZL";
             ?>
         </div>
      <?php //print_r($_POST['kierunki']);
          //  print_r($_POST['stopnie']);
          //  print_r($_POST['formy']);
            $kierunki=implode("' OR `kierunek`='",$_POST['kierunki']);
            $warunek_na_kierunki="`kierunek`= '$kierunki'";
            $formy=implode("' OR `forma`='",$_POST['formy']);
            $warunek_na_formy="`forma`= '$formy'";
            $stopnie=implode("' OR `stopien`='",$_POST['stopnie']);
            $warunek_na_stopnie="`stopien`= '$stopnie'";
          //  echo $warunek_na_kierunki;
            ?>
<div class="card-body">
    <ul class="nav nav-tabs nav-justified">
   <?php 
   //echo "SELECT DISTINCT `kierunek` FROM `analiza_ocen` WHERE `semestr`='$dane_do_query[1]' AND `rok_akademicki`='$dane_do_query[0]'";
   $kierunkia=mysqli_query($kon,"SELECT DISTINCT `kierunek` FROM `analiza_ocen` WHERE `semestr`='$dane_do_query[1]' AND `rok_akademicki`='$dane_do_query[0]' "
           . "AND ($warunek_na_kierunki)");
   $ik=0;
   $ilekier=mysqli_num_rows($kierunkia);
   
   do{
       $kr=mysqli_fetch_array($kierunkia);
       echo "<li class=\"nav-item\" style=\"font-size:0.65em;\">
        <a class=\"nav-link\" data-toggle=\"tab\" href=\"#panel$ik\" role=\"tab\">$kr[0]</a>
    </li>";
       $ik++;
   }
   while($ik<$ilekier);
   ?>
    </ul>
    <div class="tab-content card"> 
        
       <?php
             $kierunkia=mysqli_query($kon,"SELECT DISTINCT `kierunek` FROM `analiza_ocen` WHERE `semestr`='$dane_do_query[1]' AND `rok_akademicki`='$dane_do_query[0]'"
                     . " AND ($warunek_na_kierunki)");
            $ik=0;
            $ilekier=mysqli_num_rows($kierunkia);
            do{
                echo " <div class=\"tab-pane fade in\" id=\"panel$ik\" role=\"tabpanel\"><a name=\"gora$ik\"></a>";
                $kr=mysqli_fetch_array($kierunkia);
                $kotwica=$ik;
                ?>
        <a class="btn btn-outline-info waves-effect" href="#analiza<?php echo $ik;
        $ik++;?>">Przejdź do analizy przedmiotów</a>
        <h5 class="text-center"><?php echo $kr[0];?></h5>
        <div style="overflow: scroll;">
         <table id="dtMaterialDesignExample<?php echo $ik-1;?>" class="table table-striped table-condensed" cellspacing="0" width="90%" >
           <thead><tr>
                   <th style="font-size:0.8em;">Stopień studiów</th><th style="font-size:0.8em;">Forma studiów</th>
           <th style="font-size:0.8em;">Przedmiot</th><th style="font-size:0.8em;">Forma przedmiotu</th>
           <th style="font-size:0.8em;">Ilość ocen 2</th>
           <th style="font-size:0.8em;">Udział ocen 2 </th>
           <th style="font-size:0.8em;">Ilość ocen 3</th>
           <th style="font-size:0.8em;">Udział ocen 3</th>
           <th style="font-size:0.8em;">Ilość ocen 3.5</th>
           <th style="font-size:0.8em;">Udział ocen 3.5</th>
           <th style="font-size:0.8em;">Ilość ocen 4</th>
            <th style="font-size:0.8em;">Udział ocen 4</th>
           <th style="font-size:0.8em;">Ilość ocen 4.5</th>
           <th style="font-size:0.8em;">Udział ocen 4.5</th>
           <th style="font-size:0.8em;">Ilość ocen 5</th>
           <th style="font-size:0.8em;">Udział ocen 5</th>
           <th style="font-size:0.8em;">Brak oceny</th>
           <th style="font-size:0.8em;">Udział Brak oceny</th>
           <th style="font-size:0.8em;">Ilość zaliczonych</th>
             <th style="font-size:0.8em;">Udział zaliczonych</th>
           <th style="font-size:0.8em;">Ilość niezaliczonych</th>
               <th style="font-size:0.8em;">Udział niezaliczonych</th></tr>
           </thead>
           <tbody>
              <?php
              
                $przedmioty=mysqli_query($kon,"SELECT DISTINCT `forma`,`stopien`,`przedmiot`,`forma_zajec` "
                        . "FROM `analiza_ocen` WHERE `rok_akademicki`='$dane_do_query[0]' AND `semestr`='$dane_do_query[1]' "
                        . "AND `kierunek`='$kr[0]' AND ($warunek_na_formy) "
                        . "AND ($warunek_na_stopnie) ORDER BY `przedmiot` ASC");
                foreach($przedmioty as $przedmiot){
                    echo "<tr><td style=\"font-size:0.8em;\">$przedmiot[stopien]</td>"
                            . "<td style=\"font-size:0.8em;\">$przedmiot[forma]</td>"
                            . "<td style=\"font-size:0.8em;\">$przedmiot[przedmiot]</td>"
                            . "<td style=\"font-size:0.8em;\">$przedmiot[forma_zajec]</td>";
                    //wrucam do maciery oceny i wyliczam maxa
                    $oceny2=mysqli_num_rows(mysqli_query($kon,"SELECT `id` FROM `analiza_ocen` "
                            . "WHERE `ocena_calkowita`='2' AND `rok_akademicki`='$dane_do_query[0]' AND"
                            . " `semestr`='$dane_do_query[1]' AND `kierunek`='$kr[0]' AND `stopien`='$przedmiot[stopien]'"
                            . " AND `forma`='$przedmiot[forma]' AND `przedmiot`='$przedmiot[przedmiot]' AND "
                            . "`forma_zajec`='$przedmiot[forma_zajec]'"));
                     $oceny3=mysqli_num_rows(mysqli_query($kon,"SELECT `id` FROM `analiza_ocen` "
                            . "WHERE `ocena_calkowita`='3' AND `rok_akademicki`='$dane_do_query[0]' AND"
                            . " `semestr`='$dane_do_query[1]' AND `kierunek`='$kr[0]' AND `stopien`='$przedmiot[stopien]'"
                            . " AND `forma`='$przedmiot[forma]' AND `przedmiot`='$przedmiot[przedmiot]' AND "
                            . "`forma_zajec`='$przedmiot[forma_zajec]' AND `forma_zaliczenia`<>'Zaliczenie'"));
                      $oceny35=mysqli_num_rows(mysqli_query($kon,"SELECT `id` FROM `analiza_ocen` "
                            . "WHERE `ocena_calkowita`='3.5' AND `rok_akademicki`='$dane_do_query[0]' AND"
                            . " `semestr`='$dane_do_query[1]' AND `kierunek`='$kr[0]' AND `stopien`='$przedmiot[stopien]'"
                            . " AND `forma`='$przedmiot[forma]' AND `przedmiot`='$przedmiot[przedmiot]' AND "
                            . "`forma_zajec`='$przedmiot[forma_zajec]'"));
                       $oceny4=mysqli_num_rows(mysqli_query($kon,"SELECT `id` FROM `analiza_ocen` "
                            . "WHERE `ocena_calkowita`='4' AND `rok_akademicki`='$dane_do_query[0]' AND"
                            . " `semestr`='$dane_do_query[1]' AND `kierunek`='$kr[0]' AND `stopien`='$przedmiot[stopien]'"
                            . " AND `forma`='$przedmiot[forma]' AND `przedmiot`='$przedmiot[przedmiot]' AND "
                            . "`forma_zajec`='$przedmiot[forma_zajec]'"));
                        $oceny45=mysqli_num_rows(mysqli_query($kon,"SELECT `id` FROM `analiza_ocen` "
                            . "WHERE `ocena_calkowita`='4.5' AND `rok_akademicki`='$dane_do_query[0]' AND"
                            . " `semestr`='$dane_do_query[1]' AND `kierunek`='$kr[0]' AND `stopien`='$przedmiot[stopien]'"
                            . " AND `forma`='$przedmiot[forma]' AND `przedmiot`='$przedmiot[przedmiot]' AND "
                            . "`forma_zajec`='$przedmiot[forma_zajec]'"));
                         $oceny5=mysqli_num_rows(mysqli_query($kon,"SELECT `id` FROM `analiza_ocen` "
                            . "WHERE `ocena_calkowita`='5' AND `rok_akademicki`='$dane_do_query[0]' AND"
                            . " `semestr`='$dane_do_query[1]' AND `kierunek`='$kr[0]' AND `stopien`='$przedmiot[stopien]'"
                            . " AND `forma`='$przedmiot[forma]' AND `przedmiot`='$przedmiot[przedmiot]' AND "
                            . "`forma_zajec`='$przedmiot[forma_zajec]'"));
                         $brak_oceny=mysqli_num_rows(mysqli_query($kon,"SELECT `id` FROM `analiza_ocen` "
                            . "WHERE `ocena_calkowita`='' AND `rok_akademicki`='$dane_do_query[0]' AND"
                            . " `semestr`='$dane_do_query[1]' AND `kierunek`='$kr[0]' AND `stopien`='$przedmiot[stopien]'"
                            . " AND `forma`='$przedmiot[forma]' AND `przedmiot`='$przedmiot[przedmiot]' AND "
                            . "`forma_zajec`='$przedmiot[forma_zajec]'"));
                         $zal=mysqli_num_rows(mysqli_query($kon,"SELECT `id` FROM `analiza_ocen` "
                            . "WHERE `czy_zaliczony`='1' AND `rok_akademicki`='$dane_do_query[0]' AND"
                            . " `semestr`='$dane_do_query[1]' AND `kierunek`='$kr[0]' AND `stopien`='$przedmiot[stopien]'"
                            . " AND `forma`='$przedmiot[forma]' AND `przedmiot`='$przedmiot[przedmiot]' AND "
                            . "`forma_zajec`='$przedmiot[forma_zajec]' AND `forma_zaliczenia`='Zaliczenie'"));
                         $nzal=mysqli_num_rows(mysqli_query($kon,"SELECT `id` FROM `analiza_ocen` "
                            . "WHERE `czy_zaliczony`<>'1' AND `rok_akademicki`='$dane_do_query[0]' AND"
                            . " `semestr`='$dane_do_query[1]' AND `kierunek`='$kr[0]' AND `stopien`='$przedmiot[stopien]'"
                            . " AND `forma`='$przedmiot[forma]' AND `przedmiot`='$przedmiot[przedmiot]' AND "
                            . "`forma_zajec`='$przedmiot[forma_zajec]' AND `forma_zaliczenia`='Zaliczenie'"));
                         
                         $suma=$brak_oceny+$oceny5+$oceny45+$oceny4+$oceny35+$oceny3+$oceny2+$zal+$nzal;
                    echo ""
                            . "<td style=\"font-size:0.8em;\">$oceny2</td><td style=\"font-size:0.8em;\">".round(($oceny2/$suma)*100,2)."%</td>"
                            . "<td style=\"font-size:0.8em;\">$oceny3</td><td style=\"font-size:0.8em;\">".round(($oceny3/$suma)*100,2)."%</td>"
                            . "<td style=\"font-size:0.8em;\">$oceny35</td><td style=\"font-size:0.8em;\">".round(($oceny35/$suma)*100,2)."%</td>"
                            . "<td style=\"font-size:0.8em;\">$oceny4</td><td style=\"font-size:0.8em;\">".round(($oceny4/$suma)*100,2)."%</td>"
                            . "<td style=\"font-size:0.8em;\">$oceny45</td><td style=\"font-size:0.8em;\">".round(($oceny45/$suma)*100,2)."%</td>"
                            . "<td style=\"font-size:0.8em;\">$oceny5</td><td style=\"font-size:0.8em;\">".round(($oceny5/$suma)*100,2)."%</td>"
                            . "<td style=\"font-size:0.8em;\">$brak_oceny</td><td style=\"font-size:0.8em;\">".round(($brak_oceny/$suma)*100,2)."%</td>"
                            . "<td style=\"font-size:0.8em;\">$zal</td><td style=\"font-size:0.8em;\">".round(($zal/$suma)*100,2)."%</td>"
                            . "<td style=\"font-size:0.8em;\">$nzal</td><td style=\"font-size:0.8em;\">".round(($nzal/$suma)*100,2)."%</td></tr>";
                }
              ?>
           </tbody>
         </table></div>
        <a name="analiza<?php echo $kotwica;?>"></a>
        <h5 class="text-center">ANALIZA PRZEDMIOTÓW</h5>
        <div class="row"><div class="col-md-4">
                <a class="btn btn-outline-info waves-effect" href="#gora<?php echo $kotwica;?>">Wróć do tabeli ocen i udziałów</a></div><!-- comment -->
                <div class="col-md-4"><a class="btn btn-outline-success waves-effect" href="#" id="below_x">Nie pokazuj wyników dla <10 zdających</a></div>
        <div class="col-md-4"><a class="btn btn-outline-indigo waves-effect" href="#" id="all_x">Pokazuj wszystkie wyniki</a></div></div>
        <div style="overflow: scroll;">
           
        <table id="dtMaterialDesignExamplen<?php echo $ik-1;?>" class="table table-condensed" cellspacing="0" width="90%" style="overflow: scroll;">
            <thead>
                <tr><th style="font-size:0.8em;">L.P.</th>
                    <th style="font-size:0.8em;">Przedmiot</th>
                    <th style="font-size:0.8em;">forma oceny</th>
                    <th style="font-size:0.8em;">Liczba zdających</th>
                    <th style="font-size:0.8em;">Ocena średnia / procent zaliczonych</th>
                    <th style="font-size:0.8em;">2</th>
                    <th style="font-size:0.8em;">3</th>
                    <th style="font-size:0.8em;">3.5</th>
                    <th style="font-size:0.8em;">4</th>
                    <th style="font-size:0.8em;">4.5</th>
                    <th style="font-size:0.8em;">5</th>
                    <th style="font-size:0.8em;">nb i brak oceny</th>
                    <th style="font-size:0.8em;">sprawność całkowita</th>
                    <th style="font-size:0.8em;">sprawność całkowita uwzględniająca nieobecności i brak oceny
                    </th></tr>
            </thead><tbody>
                <?php
                $przedmioty=mysqli_query($kon,"SELECT DISTINCT `przedmiot` FROM `analiza_ocen` WHERE `rok_akademicki`="
                        . "'$dane_do_query[0]' AND `semestr`='$dane_do_query[1]' AND `kierunek`='$kr[0]' AND ($warunek_na_formy)"
                        . " AND ($warunek_na_stopnie)");
                $u=0;
                foreach ($przedmioty as $przedmiot) {
                    //forma zajęć
                    $formy_zajec=mysqli_query($kon,"SELECT DISTINCT `forma_zajec` FROM `analiza_ocen` WHERE `rok_akademicki`="
                        . "'$dane_do_query[0]' AND `semestr`='$dane_do_query[1]' AND `kierunek`='$kr[0]' AND "
                            . "`przedmiot`='$przedmiot[przedmiot]' AND ($warunek_na_formy) AND ($warunek_na_stopnie)");
                    $u++;
                    echo "<tr><td style=\"background-color:#eceff1;font-size:0.8em;\">$u</td>"
                    . "<td style=\"background-color:#eceff1;font-size:0.8em;\">$przedmiot[przedmiot]</td>"
                            . "<td style=\"background-color:#eceff1;font-size:0.8em;\"</td>"
                            . "<td style=\"background-color:#eceff1;font-size:0.8em;\"</td>"
                            . "<td style=\"background-color:#eceff1;font-size:0.8em;\"</td>"
                            . "<td style=\"background-color:#eceff1;font-size:0.8em;\"</td>"
                            . "<td style=\"background-color:#eceff1;font-size:0.8em;\"</td>"
                            . "<td style=\"background-color:#eceff1;font-size:0.8em;\"</td>"
                            . "<td style=\"background-color:#eceff1;font-size:0.8em;\"</td>"
                            . "<td style=\"background-color:#eceff1;font-size:0.8em;\"</td>"
                            . "<td style=\"background-color:#eceff1;font-size:0.8em;\"</td>"
                            . "<td style=\"background-color:#eceff1;font-size:0.8em;\"</td>"
                            . "<td style=\"background-color:#eceff1;font-size:0.8em;\"</td>"
                            . "<td style=\"background-color:#eceff1;font-size:0.8em;\"</td>"
                            . "</tr>";
                    foreach ($formy_zajec as $forma_z){
                        //obliczam formy oceny
                        $fo=mysqli_fetch_array(mysqli_query($kon,"SELECT `forma_zaliczenia` FROM `analiza_ocen` WHERE"
                                . " `rok_akademicki`='$dane_do_query[0]' AND `semestr`='$dane_do_query[1]' AND "
                                . "`kierunek`='$kr[0]' AND `przedmiot`='$przedmiot[przedmiot]' AND `forma_zajec`="
                                . "'$forma_z[forma_zajec]' AND ($warunek_na_formy) AND ($warunek_na_stopnie)"));
                        //obliczam ilość zdających
                        $iz=mysqli_num_rows(mysqli_query($kon,"SELECT `id` FROM `analiza_ocen` WHERE"
                                . " `rok_akademicki`='$dane_do_query[0]' AND `semestr`='$dane_do_query[1]' AND "
                                . "`kierunek`='$kr[0]' AND `przedmiot`='$przedmiot[przedmiot]' AND `forma_zajec`="
                                . "'$forma_z[forma_zajec]' AND ($warunek_na_formy) AND ($warunek_na_stopnie)"));
                        //obliczam ilość 2,3 itd...
                        $i2=mysqli_num_rows(mysqli_query($kon,"SELECT `id` FROM `analiza_ocen` WHERE"
                                . " `rok_akademicki`='$dane_do_query[0]' AND `semestr`='$dane_do_query[1]' AND "
                                . "`kierunek`='$kr[0]' AND `przedmiot`='$przedmiot[przedmiot]' AND `forma_zajec`="
                                . "'$forma_z[forma_zajec]' AND `ocena_calkowita`='2' AND ($warunek_na_formy) AND ($warunek_na_stopnie)"));
                         $i3=mysqli_num_rows(mysqli_query($kon,"SELECT `id` FROM `analiza_ocen` WHERE"
                                . " `rok_akademicki`='$dane_do_query[0]' AND `semestr`='$dane_do_query[1]' AND "
                                . "`kierunek`='$kr[0]' AND `przedmiot`='$przedmiot[przedmiot]' AND `forma_zajec`="
                                . "'$forma_z[forma_zajec]' AND `ocena_calkowita`='3' AND ($warunek_na_formy) AND ($warunek_na_stopnie)"));
                          $i35=mysqli_num_rows(mysqli_query($kon,"SELECT `id` FROM `analiza_ocen` WHERE"
                                . " `rok_akademicki`='$dane_do_query[0]' AND `semestr`='$dane_do_query[1]' AND "
                                . "`kierunek`='$kr[0]' AND `przedmiot`='$przedmiot[przedmiot]' AND `forma_zajec`="
                                . "'$forma_z[forma_zajec]' AND `ocena_calkowita`='3.5' AND ($warunek_na_formy) AND ($warunek_na_stopnie)"));
                           $i4=mysqli_num_rows(mysqli_query($kon,"SELECT `id` FROM `analiza_ocen` WHERE"
                                . " `rok_akademicki`='$dane_do_query[0]' AND `semestr`='$dane_do_query[1]' AND "
                                . "`kierunek`='$kr[0]' AND `przedmiot`='$przedmiot[przedmiot]' AND `forma_zajec`="
                                . "'$forma_z[forma_zajec]' AND `ocena_calkowita`='4' AND ($warunek_na_formy) AND ($warunek_na_stopnie)"));
                            $i45=mysqli_num_rows(mysqli_query($kon,"SELECT `id` FROM `analiza_ocen` WHERE"
                                . " `rok_akademicki`='$dane_do_query[0]' AND `semestr`='$dane_do_query[1]' AND "
                                . "`kierunek`='$kr[0]' AND `przedmiot`='$przedmiot[przedmiot]' AND `forma_zajec`="
                                . "'$forma_z[forma_zajec]' AND `ocena_calkowita`='4.5' AND ($warunek_na_formy) AND ($warunek_na_stopnie)"));
                             $i5=mysqli_num_rows(mysqli_query($kon,"SELECT `id` FROM `analiza_ocen` WHERE"
                                . " `rok_akademicki`='$dane_do_query[0]' AND `semestr`='$dane_do_query[1]' AND "
                                . "`kierunek`='$kr[0]' AND `przedmiot`='$przedmiot[przedmiot]' AND `forma_zajec`="
                                . "'$forma_z[forma_zajec]' AND `ocena_calkowita`='5' AND ($warunek_na_formy) AND ($warunek_na_stopnie)"));
                              $inull=mysqli_num_rows(mysqli_query($kon,"SELECT `id` FROM `analiza_ocen` WHERE"
                                . " `rok_akademicki`='$dane_do_query[0]' AND `semestr`='$dane_do_query[1]' AND "
                                . "`kierunek`='$kr[0]' AND `przedmiot`='$przedmiot[przedmiot]' AND `forma_zajec`="
                                . "'$forma_z[forma_zajec]' AND (`ocena_calkowita`='' OR `ocena_calkowita` IS NULL) AND ($warunek_na_formy) AND ($warunek_na_stopnie)"));
                        echo "<tr><td style=\"font-size:0.5em;color:green;\">$u</td><td style=\"font-size:0.8em;color:green;\">"
                                . "<span style=\"color:gray;font-size:0.65em;\">$przedmiot[przedmiot]</span><hr/>"
                                . "$forma_z[forma_zajec]</td>"
                                . "<td style=\"font-size:0.8em;\">$fo[0]</td>"
                                . "<td style=\"font-size:0.8em;\">$iz</td>"
                                . "<td style=\"font-size:0.8em;\">";
                        //obliczam średnią
                        if($iz!=0&&($iz-$inull)!=0){
                        switch($fo[0]){
                            case "Zaliczenie":
                             $srednia=round(($i3+$i35+$i4+$i45+$i5)*100/($iz-$inull),2)."%";
                                break;
                            default:
                             //$srednia=round(($i2*2+$i3*3+$i35*3.5+$i4*4+$i45*4.5+$i5*5+$inull*2)/$iz,2); średnia liczona z nieobecnościami
                             $srednia=round(($i2*2+$i3*3+$i35*3.5+$i4*4+$i45*4.5+$i5*5)/($iz-$inull),2);
                               // echo "($i2*2+$i3*3+$i35*3.5+$i4*4+$i45*4.5+$i5*5+$inull*2)/$iz";
                                break;
                        }
                        $mianownik=round(($i3+$i35+$i4+$i45+$i5)*100/($iz-$inull),2) ;
                        $mianownik2=round(($i3+$i35+$i4+$i45+$i5)*100/$iz,2);
                        }
                        else {$srednia="BRAK";
                        $mianownik="BRAK";
                        $mianownik2="BRAK";
                        }
                        //$srednia=round(($i2*2+$i3*4+$i35*3.5+$i4*4+$i45*4.5+$i5*5)/$iz,2);
                        echo "$srednia</td>"
                                . "<td style=\"font-size:0.8em;\">".round(($i2/$iz)*100,2)."%</td>"
                                . "<td style=\"font-size:0.8em;\">".round(($i3/$iz)*100,2)."%</td>"
                                . "<td style=\"font-size:0.8em;\">".round(($i35/$iz)*100,2)."%</td>"
                                . "<td style=\"font-size:0.8em;\">".round(($i4/$iz)*100,2)."%</td>"
                                . "<td style=\"font-size:0.8em;\">".round(($i45/$iz)*100,2)."%</td>"
                                . "<td style=\"font-size:0.8em;\">".round(($i5/$iz)*100,2)."%</td>"
                                . "<td style=\"font-size:0.8em;\">".round(($inull/$iz)*100,2)."%</td>"
                                . "<td style=\"font-size:0.8em;\">".$mianownik ."%</td>"
                                . "<td style=\"font-size:0.8em;\">".$mianownik2 ."%</td></tr>";
                }
                }
                ?>
                
                
            </tbody>
            
        </table></div>
        <a class="btn btn-outline-info waves-effect" href="#gora<?php echo $kotwica;?>">Wróć do tabeli ocen i udziałów</a>
    <?php //echo  "SELECT DISTINCT `forma`,`stopien`,`przedmiot`,`forma_zajec` "
          //              . "FROM `analiza_ocen` WHERE `rok_akademicki`='$dane_do_query[0]' AND `semestr`='$dane_do_query[1]' "
          //              . "AND `kierunek`='$kr[0]' ORDER BY `przedmiot` ASC";
    ?>
    </div>
        <?php
            }
            while($ik<$ilekier);
       ?>
      
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

    
 
 <?php include('view/ocenydyplom_Modal.php');?>
      <?php include('view/footer.php');?>

  <script>
      $(document).ready(function () {
          <?php $lt=0;
          do {?>
$('#dtMaterialDesignExample<?php echo $lt;?>').DataTable( {
            "dom": 'Bfrtip',
            "buttons": [{
             extend: 'pdf',
             
                orientation: 'landscape'
            },
                    'copy'
            , 'csv', 'excel','print'],
            "order": [[ 0, "desc" ]],
            "language": {
            "lengthMenu": "Pokaż _MENU_ wyników na stronę",
            "zeroRecords": "Nic nie znalazłem :-(",
            "info": "strona _PAGE_ z _PAGES_",
            "infoEmpty": "Nic nie znaleziono",
            "infoFiltered": "(Znaleziono _TOTAL_ z _MAX_ rekordów)",
             "paginate": {
        "first":      "początek",
        "last":       "koniec",
        "next":       "Nast.",
        "previous":   "Poprz."
    },
            "search":  "Szukaj" 
        }  
    
});
$('#dtMaterialDesignExample<?php echo $lt;?>_wrapper').find('label').each(function () {
$(this).parent().append($(this).children());
});
$('#dtMaterialDesignExample<?php echo $lt;?>_wrapper .dataTables_filter').find('input').each(function () {
$('#dtMaterialDesignExample<?php echo $lt;?>_filter').attr("placeholder", "Szukaj");
$('input').removeClass('form-control-sm');
});
$('#dtMaterialDesignExample<?php echo $lt;?>_wrapper .dataTables_length').addClass('d-flex flex-row');
$('#dtMaterialDesignExample<?php echo $lt;?>_wrapper .dataTables_filter').addClass('md-form');
$('#dtMaterialDesignExample<?php echo $lt;?>_wrapper select').removeClass(
'custom-select custom-select-sm form-control form-control-sm');
$('#dtMaterialDesignExample<?php echo $lt;?>_wrapper select').addClass('mdb-select');
$('#dtMaterialDesignExample<?php echo $lt;?>_wrapper .mdb-select').materialSelect();
$('#dtMaterialDesignExample<?php echo $lt;?>_wrapper .dataTables_filter').find('label').remove();

var table=$('#dtMaterialDesignExamplen<?php echo $lt;?>').DataTable( {
            "dom": 'Bfrtip',
            "buttons": [{
             extend: 'pdf',
             
                orientation: 'landscape'
            },
                    'copy'
            , 'csv', 'excel','print'],
            "order": [[ 0, "asc" ]],
            "language": {
            "lengthMenu": "Pokaż _MENU_ wyników na stronę",
            "zeroRecords": "Nic nie znalazłem :-(",
            "info": "strona _PAGE_ z _PAGES_",
            "infoEmpty": "Nic nie znaleziono",
            "infoFiltered": "(Znaleziono _TOTAL_ z _MAX_ rekordów)",
             "paginate": {
        "first":      "początek",
        "last":       "koniec",
        "next":       "Nast.",
        "previous":   "Poprz."
    },
            "search":  "Szukaj" 
        }  
    
});
$( "#below_x" ).click(function() {
    filterBelowValue();
  });
  $( "#all_x" ).click(function() {
    filterAllValue();
  });
 function filterBelowValue() {
    var threshold = 10; // or whatever you want
    var colIdx = 3; // 4th column (first col has index of 0)
    $.fn.dataTable.ext.search.push(
      function( settings, data, dataIndex ) {
        return (data[colIdx] > threshold);
      }
    );

    table.column( 0 ).order( 'asc' ).draw();
  }
 function filterAllValue() {
 //   var threshold = 1; // or whatever you want
 //   var colIdx = 3; // 4th column (first col has index of 0)
//    $.fn.dataTable.ext.search.push(
 //     function( settings, data, dataIndex ) {
   //     return (data[colIdx] > threshold);
  //    }
  //  );
location.reload();
  // table.column( 0 ).order( 'asc' ).draw();
  }

$('#dtMaterialDesignExamplen<?php echo $lt;?>_wrapper').find('label').each(function () {
$(this).parent().append($(this).children());
});
$('#dtMaterialDesignExamplen<?php echo $lt;?>_wrapper .dataTables_filter').find('input').each(function () {
$('#dtMaterialDesignExamplen<?php echo $lt;?>_filter').attr("placeholder", "Szukaj");
$('input').removeClass('form-control-sm');
});
$('#dtMaterialDesignExamplen<?php echo $lt;?>_wrapper .dataTables_length').addClass('d-flex flex-row');
$('#dtMaterialDesignExamplen<?php echo $lt;?>_wrapper .dataTables_filter').addClass('md-form');
$('#dtMaterialDesignExamplen<?php echo $lt;?>_wrapper select').removeClass(
'custom-select custom-select-sm form-control form-control-sm');
$('#dtMaterialDesignExamplen<?php echo $lt;?>_wrapper select').addClass('mdb-select');
$('#dtMaterialDesignExamplen<?php echo $lt;?>_wrapper .mdb-select').materialSelect();
$('#dtMaterialDesignExamplen<?php echo $lt;?>_wrapper .dataTables_filter').find('label').remove();
<?php $lt++;
          }
          while($lt<$ik);
          ?>
});


  </script>
  
 
</body>

</html>
