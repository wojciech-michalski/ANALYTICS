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
            <span>PRZYGOTOWANIE ANKIET <?php echo $ac; //echo strlen($ac);
            //echo $ile_naglowkow;?></span>
          </h4>

          

        </div>

      </div>
              <div class="row wow fadeIn">

        <!--Grid column-->
        <div class="col-md-12 mb-4">

          <!--Card-->
          
     <div class="card">
         
        <div class="card-header text-center"><?php echo $_POST['ankieta'];?></div>
          
<div class="card-body">
    
  <?php 
   
  
  switch($_POST['ankieta']){
    //ANKIETA OCENY ADMINISTRACJI
    case "ocena_administracji2":
   
        //insert wykładowców dla wydziałów i generowanie linków
        $link_base="$surveyurl/?ankieta=oa&p=";
        $lastid_=mysqli_fetch_array(mysqli_query($kon,"SELECT MAX(`id`) FROM `prowadzacy` WHERE 1"));
        $lastid=$lastid_[0];
        $last=$lastid_[0];
        $ankieta=$_POST['ankieta'];
    
        $qA="INSERT INTO `prowadzacy`(`imie`,`nazwisko`,`kierunek`,`rok_akademicki`) "
                . "VALUES ('Małgorzata','Leszczyńska-Domańska','Architektura','$_POST[rok_akademicki] $_POST[semestrZL]'); ";
        mysqli_query($kon,$qA);
        $lastid_=mysqli_fetch_array(mysqli_query($kon,"SELECT MAX(`id`) FROM `prowadzacy` WHERE 1"));
        $lastid=$lastid_[0];
        $qAlink=        "INSERT INTO `linki_ankiet`(`ankieta`,`ankieta_nazwa`,`link`,`id_prowadzacy`) "
                . "VALUES ('$ankieta','Ocena Pracy Administracji ". $_POST['rok_akademicki']." ". $_POST['semestrZL']."','$link_base".$lastid ."',$lastid); ";
        mysqli_query($kon,$qAlink);
        $qAK= "INSERT INTO `prowadzacy`(`imie`,`nazwisko`,`kierunek`,`rok_akademicki`) "
                . "VALUES ('Małgorzata','Leszczyńska-Domańska','Architektura Krajobrazu','$_POST[rok_akademicki] $_POST[semestrZL]'); ";
        mysqli_query($kon,$qAK);
        $lastid_=mysqli_fetch_array(mysqli_query($kon,"SELECT MAX(`id`) FROM `prowadzacy` WHERE 1"));
        $lastid=$lastid_[0];
        $qAKlink= "INSERT INTO `linki_ankiet`(`ankieta`,`ankieta_nazwa`,`link`,`id_prowadzacy`) "
                . "VALUES('$ankieta','Ocena Pracy Administracji ". $_POST['rok_akademicki']." ". $_POST['semestrZL']."','$link_base".$lastid ."',$lastid); ";
        mysqli_query($kon,$qAKlink);
        $qAW= "INSERT INTO `prowadzacy`(`imie`,`nazwisko`,`kierunek`,`rok_akademicki`) "
                . "VALUES ('Małgorzata','Leszczyńska-Domańska','Architektura Wnętrz','$_POST[rok_akademicki] $_POST[semestrZL]'); ";
        mysqli_query($kon,$qAW);
        $lastid_=mysqli_fetch_array(mysqli_query($kon,"SELECT MAX(`id`) FROM `prowadzacy` WHERE 1"));
        $lastid=$lastid_[0];
        $qAWlink= "INSERT INTO `linki_ankiet`(`ankieta`,`ankieta_nazwa`,`link`,`id_prowadzacy`) "
                . "VALUES('$ankieta','Ocena Pracy Administracji $_POST[rok_akademicki] $_POST[semestrZL]','$link_base".$lastid ."',$lastid); ";
        mysqli_query($kon,$qAWlink);
        $qB="INSERT INTO `prowadzacy`(`imie`,`nazwisko`,`kierunek`,`rok_akademicki`) "
                . "VALUES ('Małgorzata','Leszczyńska-Domańska','Budownictwo','$_POST[rok_akademicki] $_POST[semestrZL]');";
        mysqli_query($kon,$qB);
        $lastid_=mysqli_fetch_array(mysqli_query($kon,"SELECT MAX(`id`) FROM `prowadzacy` WHERE 1"));
        $lastid=$lastid_[0];
        $qBlink="INSERT INTO `linki_ankiet`(`ankieta`,`ankieta_nazwa`,`link`,`id_prowadzacy`) "
                . "VALUES('$ankieta','Ocena Pracy Administracji $_POST[rok_akademicki] $_POST[semestrZL]','$link_base".$lastid ."',$lastid); ";
        mysqli_query($kon,$qBlink);
        $qW= "INSERT INTO `prowadzacy`(`imie`,`nazwisko`,`kierunek`,`rok_akademicki`) "
                . "VALUES ('Małgorzata','Leszczyńska-Domańska','Wzornictwo','$_POST[rok_akademicki] $_POST[semestrZL]');";
        mysqli_query($kon,$qW);
        $lastid_=mysqli_fetch_array(mysqli_query($kon,"SELECT MAX(`id`) FROM `prowadzacy` WHERE 1"));
        $lastid=$lastid_[0];
        $qWlink="INSERT INTO `linki_ankiet`(`ankieta`,`ankieta_nazwa`,`link`,`id_prowadzacy`) "
                . "VALUES('$ankieta','Ocena Pracy Administracji $_POST[rok_akademicki] $_POST[semestrZL]','$link_base".$lastid ."',$lastid); ";
        mysqli_query($kon,$qWlink);
        
        $qMB="INSERT INTO `prowadzacy`(`imie`,`nazwisko`,`kierunek`,`rok_akademicki`) "
                . "VALUES ('Jan','Cetner','Mechanika i Budowa Maszyn','$_POST[rok_akademicki] $_POST[semestrZL]');";
        mysqli_query($kon,$qMB);
        $lastid_=mysqli_fetch_array(mysqli_query($kon,"SELECT MAX(`id`) FROM `prowadzacy` WHERE 1"));
        $lastid=$lastid_[0];
        $qMBlink="INSERT INTO `linki_ankiet`(`ankieta`,`ankieta_nazwa`,`link`,`id_prowadzacy`) "
                . "VALUES('$ankieta','Ocena Pracy Administracji $_POST[rok_akademicki] $_POST[semestrZL]','$link_base".$lastid ."',$lastid); ";
        mysqli_query($kon,$qMBlink);
        $qOS="INSERT INTO `prowadzacy`(`imie`,`nazwisko`,`kierunek`,`rok_akademicki`) "
                . "VALUES ('Jan','Cetner','Ochrona Środowiska','$_POST[rok_akademicki] $_POST[semestrZL]'); ";
        mysqli_query($kon,$qOS);
        $lastid_=mysqli_fetch_array(mysqli_query($kon,"SELECT MAX(`id`) FROM `prowadzacy` WHERE 1"));
        $lastid=$lastid_[0];
        $qOSlink="INSERT INTO `linki_ankiet`(`ankieta`,`ankieta_nazwa`,`link`,`id_prowadzacy`) "
                . "VALUES('$ankieta','Ocena Pracy Administracji $_POST[rok_akademicki] $_POST[semestrZL]','$link_base".$lastid ."',$lastid); ";
        mysqli_query($kon,$qOSlink);
        $qZ="INSERT INTO `prowadzacy`(`imie`,`nazwisko`,`kierunek`,`rok_akademicki`) "
                . "VALUES ('Jan','Cetner','Zarządzanie','$_POST[rok_akademicki] $_POST[semestrZL]');";
        mysqli_query($kon,$qZ);
         $lastid_=mysqli_fetch_array(mysqli_query($kon,"SELECT MAX(`id`) FROM `prowadzacy` WHERE 1"));
        $lastid=$lastid_[0];
        $qZlink="INSERT INTO `linki_ankiet`(`ankieta`,`ankieta_nazwa`,`link`,`id_prowadzacy`) "
                . "VALUES('$ankieta','Ocena Pracy Administracji $_POST[rok_akademicki] $_POST[semestrZL]','$link_base".$lastid ."',$lastid); ";
        mysqli_query($kon,$qZlink);
        $qZIP="INSERT INTO `prowadzacy`(`imie`,`nazwisko`,`kierunek`,`rok_akademicki`) "
                . "VALUES ('Jan','Cetner','Zarządzanie i Inżynieria Produkcji','$_POST[rok_akademicki] $_POST[semestrZL]'); ";
        mysqli_query($kon,$qZIP);
         $lastid_=mysqli_fetch_array(mysqli_query($kon,"SELECT MAX(`id`) FROM `prowadzacy` WHERE 1"));
        $lastid=$lastid_[0];
        $qZIPlink="INSERT INTO `linki_ankiet`(`ankieta`,`ankieta_nazwa`,`link`,`id_prowadzacy`) "
                . "VALUES('$ankieta','Ocena Pracy Administracji $_POST[rok_akademicki] $_POST[semestrZL]','$link_base".$lastid ."',$lastid); ";
        mysqli_query($kon,$qZIPlink);
        $qZP="INSERT INTO `prowadzacy`(`imie`,`nazwisko`,`kierunek`,`rok_akademicki`) "
                . "VALUES ('Jan','Cetner','Zdrowie Publiczne','$_POST[rok_akademicki] $_POST[semestrZL]'); ";
        mysqli_query($kon,$qZP);
         $lastid_=mysqli_fetch_array(mysqli_query($kon,"SELECT MAX(`id`) FROM `prowadzacy` WHERE 1"));
        $lastid=$lastid_[0];
        $qZPlink="INSERT INTO `linki_ankiet`(`ankieta`,`ankieta_nazwa`,`link`,`id_prowadzacy`) "
                . "VALUES ('$ankieta','Ocena Pracy Administracji $_POST[rok_akademicki] $_POST[semestrZL]','$link_base".$lastid ."',$lastid); ";
        mysqli_query($kon,$qZPlink);
        $qI= "INSERT INTO `prowadzacy`(`imie`,`nazwisko`,`kierunek`,`rok_akademicki`) "
                . "VALUES ('Jan','Cetner','Informatyka','$_POST[rok_akademicki] $_POST[semestrZL]'); ";
        mysqli_query($kon,$qI);
         $lastid_=mysqli_fetch_array(mysqli_query($kon,"SELECT MAX(`id`) FROM `prowadzacy` WHERE 1"));
        $lastid=$lastid_[0];
        $qIlink="INSERT INTO `linki_ankiet`(`ankieta`,`ankieta_nazwa`,`link`,`id_prowadzacy`) "
                . "VALUES ('$ankieta','Ocena Pracy Administracji $_POST[rok_akademicki] $_POST[semestrZL]','$link_base".$lastid ."',$lastid); ";
        mysqli_query($kon,$qIlink);
    //stworzenie widoku do analiz
        $vcreatequery="CREATE VIEW `ANALIZA-Ocena Administracji $_POST[rok_akademicki] $_POST[semestrZL]` AS (select `analytics`.`ocena_administracji2`.`PYT_1` AS `OBSŁUGA W DZIEKANACIE - DOSTĘPNOŚĆ`,"
                . "`analytics`.`ocena_administracji2`.`PYT_2` AS `OBSŁUGA W DZIEKANACIE - UZYSKIWANIE INFORMACJI`,"
                . "`analytics`.`ocena_administracji2`.`PYT_3` AS `OBSŁUGA W DZIEKANACIE - ŻYCZLIWOŚĆ`,"
                . "`analytics`.`ocena_administracji2`.`PYT_4` AS `OBSŁUGA W DZIEKANACIE - GOTOWOŚĆ DO POMOCY`,"
                . "`analytics`.`ocena_administracji2`.`PYT_5` AS `OBSŁUGA W DZIEKANACIE - TERMINOWOŚĆ ZAŁATWIANIA SPRAW`,"
                . "`analytics`.`ocena_administracji2`.`PYT_6` AS `OBSŁUGA W DZIEKANACIE - KULTURA OSOBISTA PRACOWNIKÓW`,"
                . "`analytics`.`ocena_administracji2`.`PYT_8` AS `WIRTUALNA UCZENIA - FUNKCJONALNOŚĆ`,"
                . "`analytics`.`ocena_administracji2`.`PYT_9` AS `WIRTUALNA UCZENIA - PRZYDATNOŚĆ`,"
                . "`analytics`.`ocena_administracji2`.`PYT_10` AS `WIRTUALNA UCZENIA - SZYBKOŚĆ AKTUALIZACJI INFORMACJI`,"
                . "`analytics`.`ocena_administracji2`.`PYT_11` AS `BIBLIOTEKA - GODZINY OTWARCIA I DOSTĘPNOŚĆ`,"
                . "`analytics`.`ocena_administracji2`.`PYT_12` AS `BIBLIOTEKA - ZBIORY`,"
                . "`analytics`.`ocena_administracji2`.`PYT_13` AS `TERMINY I GODZINY GODZINY ZAJĘĆ`,"
                . "`analytics`.`ocena_administracji2`.`PYT_14` AS `RACJONALNOŚĆ I DOGODNOŚĆ ORGANIZACJ PLANU ZAJĘĆ`,"
                . "`analytics`.`ocena_administracji2`.`PYT_15` AS `TERMIN UDOSTĘPNIANIA STUDENTOM PLANÓW ZAJĘĆ`,"
                . "`analytics`.`ocena_administracji2`.`PYT_16` AS `SPOSÓB UDOSTĘPNIANIA STUDENTOM PLANÓW ZAJĘĆ`,"
                . "`analytics`.`ocena_administracji2`.`PYT_17` AS `LICZEBNOŚĆ GRUP STUDENCKICH W AKTYWNYCH FORMACH ZAJĘĆ`,"
                . "`analytics`.`ocena_administracji2`.`PYT_18` AS `DOSTĘP DO REGULAMINÓW, PROGR. KSZTAŁCENIA I INNYCH`,"
                . "`analytics`.`ocena_administracji2`.`PYT_19` AS `CZY L. MIEJSC W SALACH JEST DOSTOSOWANA DO LICZBY STUDENTÓW`,"
                . "`analytics`.`ocena_administracji2`.`PYT_20` AS `STAN TECHNICZNY BUDYNKÓW W TÓRYCH ODBYWAJĄ SIĘ ZAJĘCIA`,"
                . "`analytics`.`ocena_administracji2`.`PYT_21` AS `UWZGL. POTRZEB OS. NIEPEŁNOSPRAWNYCH - GRÓJECKA`,"
                . "`analytics`.`ocena_administracji2`.`PYT_22` AS `UWZGL. POTRZEB OS. NIEPEŁNOSPRAWNYCH - REJTANA`,"
                . "`analytics`.`ocena_administracji2`.`PYT_23` AS `UWZGL. POTRZEB OS. NIEPEŁNOSPRAWNYCH - OLSZEWSKA`,"
                . "`analytics`.`ocena_administracji2`.`PYT_24` AS `SPRZĘT DYDAKTYCZNY WYKORZYSTYWANY NA ZAJĘCIACH`,"
                . "`analytics`.`ocena_administracji2`.`PYT_25` AS `WARUNKI W POMIESZCZENIACH DYDAKTYCZNYCH`,"
                . "`analytics`.`ocena_administracji2`.`PYT_26` AS `SPRZĘT KOMPUTEROWY WYKORZYSTYWANY PODCZAS ZAJĘĆ`,"
                . "`analytics`.`ocena_administracji2`.`PYT_27` AS `ZAPLECZE SOCJALNE UCZELNI`,"
                . "`analytics`.`ocena_administracji2`.`PYT_28` AS `JAKOŚĆ WYKORZYSTYWANEGO PODCZAS ZAJĘĆ SPRZĘTU DYDAKTYCZNEGO`,"
                . "`analytics`.`ocena_administracji2`.`PYT_29` AS `DLACZEGO NISKA ?`,"
                . "`analytics`.`ocena_administracji2`.`PYT_30` AS `INNE UWAGI I OPINIE`,"
                . "`analytics`.`prowadzacy`.`imie` AS `imie`,`analytics`.`prowadzacy`.`nazwisko` AS `nazwisko`,"
                . "`analytics`.`prowadzacy`.`przedmiot` AS `przedmiot`,`analytics`.`prowadzacy`.`tytul` AS `tytul`,"
                . "`analytics`.`prowadzacy`.`kierunek` AS `kierunek`,`analytics`.`prowadzacy`.`stopien` AS `stopien`,"
                . "`analytics`.`prowadzacy`.`forma` AS `forma`,`analytics`.`prowadzacy`.`grupa` AS `grupa`,"
                . "`analytics`.`prowadzacy`.`rok_akademicki` AS `rok_akademicki` FROM "
                . "(`analytics`.`ocena_administracji2` join `analytics`.`prowadzacy` "
                . "on(`analytics`.`ocena_administracji2`.`id_prowadzacy` = `analytics`.`prowadzacy`.`id`)) "
                . "WHERE `analytics`.`prowadzacy`.`rok_akademicki` = '$_POST[rok_akademicki] $_POST[semestrZL]')";
        mysqli_query($kon,$vcreatequery);
       //Wyświetlam linki
       ?>
    <table class="table table-striped table-sm">
        <thead><tr><th>L.P.</th>
                        <th>Kierunek studiów</th>
                        <th>link do ankiety</th>
            </tr></thead><tbody>
                <?php
                $links=mysqli_query($kon,"SELECT prowadzacy.kierunek,linki_ankiet.link FROM `linki_ankiet` "
                        . "INNER JOIN `prowadzacy` ON prowadzacy.id=linki_ankiet.id_prowadzacy "
                        . "WHERE linki_ankiet.ankieta='ocena_administracji2' AND prowadzacy.id>$last");
                foreach ($links as $link) {
                    echo "<tr><td>$lp</td><td>$link[kierunek]</td><td>$link[link]</td></tr>";
                }
                ?>
        </tbody>
    </table>
    <?php
        break;
         case "ocena_praktyk_zawodowych":
            //insert wykładowców dla wydziałów i generowanie linków
        $link_base="$surveyurl/?ankieta=opz&p=";
        $lastid_=mysqli_fetch_array(mysqli_query($kon,"SELECT MAX(`id`) FROM `prowadzacy` WHERE 1"));
        $lastid=$lastid_[0];
        $last=$lastid_[0];
        $ankieta=$_POST['ankieta'];
    //Architektura stacjonarne
        $qAs="INSERT INTO `prowadzacy`(`imie`,`nazwisko`,`kierunek`,`rok_akademicki`,`forma`) "
                . "VALUES ('Małgorzata','Leszczyńska-Domańska','Architektura','$_POST[rok_akademicki] $_POST[semestrZL]','stacjonarne'); ";
        mysqli_query($kon,$qAs);
        
        $lastid_=mysqli_fetch_array(mysqli_query($kon,"SELECT MAX(`id`) FROM `prowadzacy` WHERE 1"));
        $lastid=$lastid_[0];
        $qAslink=        "INSERT INTO `linki_ankiet`(`ankieta`,`ankieta_nazwa`,`link`,`id_prowadzacy`) "
                . "VALUES ('$ankieta','Ocena Praktyk Zawodowych ". $_POST['rok_akademicki']." ". $_POST['semestrZL']."','$link_base".$lastid ."',$lastid); ";
        mysqli_query($kon,$qAslink);
    //Architektura Stacjonarne    
        $qAS="INSERT INTO `prowadzacy`(`imie`,`nazwisko`,`kierunek`,`rok_akademicki`,`forma`) "
                . "VALUES ('Małgorzata','Leszczyńska-Domańska','Architektura','$_POST[rok_akademicki] $_POST[semestrZL]','Stacjonarne'); ";
        mysqli_query($kon,$qAS);
        
        $lastid_=mysqli_fetch_array(mysqli_query($kon,"SELECT MAX(`id`) FROM `prowadzacy` WHERE 1"));
        $lastid=$lastid_[0];
        $qASlink=        "INSERT INTO `linki_ankiet`(`ankieta`,`ankieta_nazwa`,`link`,`id_prowadzacy`) "
                . "VALUES ('$ankieta','Ocena Praktyk Zawodowych ". $_POST['rok_akademicki']." ". $_POST['semestrZL']."','$link_base".$lastid ."',$lastid); ";
        mysqli_query($kon,$qASlink);
    //Architektura Krajobrazu Stacjonarne    
        $qAKS= "INSERT INTO `prowadzacy`(`imie`,`nazwisko`,`kierunek`,`rok_akademicki`,`forma`) "
                . "VALUES ('Małgorzata','Leszczyńska-Domańska','Architektura Krajobrazu','$_POST[rok_akademicki] $_POST[semestrZL]','Stacjonarne'); ";
        mysqli_query($kon,$qAKS);
        $lastid_=mysqli_fetch_array(mysqli_query($kon,"SELECT MAX(`id`) FROM `prowadzacy` WHERE 1"));
        $lastid=$lastid_[0];
        $qAKSlink= "INSERT INTO `linki_ankiet`(`ankieta`,`ankieta_nazwa`,`link`,`id_prowadzacy`) "
                . "VALUES('$ankieta','Ocena Praktyk Zawodowych ". $_POST['rok_akademicki']." ". $_POST['semestrZL']."','$link_base".$lastid ."',$lastid); ";
        mysqli_query($kon,$qAKSlink);
    //Architektura Krajobrazu Niestacjonarne   
          $qAKN= "INSERT INTO `prowadzacy`(`imie`,`nazwisko`,`kierunek`,`rok_akademicki`,`forma`) "
                . "VALUES ('Małgorzata','Leszczyńska-Domańska','Architektura Krajobrazu','$_POST[rok_akademicki] $_POST[semestrZL]','Miestacjonarne'); ";
        mysqli_query($kon,$qAKN);
        $lastid_=mysqli_fetch_array(mysqli_query($kon,"SELECT MAX(`id`) FROM `prowadzacy` WHERE 1"));
        $lastid=$lastid_[0];
        $qAKNlink= "INSERT INTO `linki_ankiet`(`ankieta`,`ankieta_nazwa`,`link`,`id_prowadzacy`) "
                . "VALUES('$ankieta','Ocena Praktyk Zawodowych ". $_POST['rok_akademicki']." ". $_POST['semestrZL']."','$link_base".$lastid ."',$lastid); ";
        mysqli_query($kon,$qAKNlink);
    //Architektura Wnętrz Stacjonarne 
        $qAWS= "INSERT INTO `prowadzacy`(`imie`,`nazwisko`,`kierunek`,`rok_akademicki`,`forma`) "
                . "VALUES ('Małgorzata','Leszczyńska-Domańska','Architektura Wnętrz','$_POST[rok_akademicki] $_POST[semestrZL]','Stacjonarne'); ";
        mysqli_query($kon,$qAWS);
        $lastid_=mysqli_fetch_array(mysqli_query($kon,"SELECT MAX(`id`) FROM `prowadzacy` WHERE 1"));
        $lastid=$lastid_[0];
        $qAWSlink= "INSERT INTO `linki_ankiet`(`ankieta`,`ankieta_nazwa`,`link`,`id_prowadzacy`) "
                . "VALUES('$ankieta','Ocena Praktyk Zawodowych $_POST[rok_akademicki] $_POST[semestrZL]','$link_base".$lastid ."',$lastid); ";
        mysqli_query($kon,$qAWSlink);
    //Architektura Wnętrz Niestacjonarne 
        $qAWN= "INSERT INTO `prowadzacy`(`imie`,`nazwisko`,`kierunek`,`rok_akademicki`,`forma`) "
                . "VALUES ('Małgorzata','Leszczyńska-Domańska','Architektura Wnętrz','$_POST[rok_akademicki] $_POST[semestrZL]','Niestacjonarne'); ";
        mysqli_query($kon,$qAWN);
        $lastid_=mysqli_fetch_array(mysqli_query($kon,"SELECT MAX(`id`) FROM `prowadzacy` WHERE 1"));
        $lastid=$lastid_[0];
        $qAWNlink= "INSERT INTO `linki_ankiet`(`ankieta`,`ankieta_nazwa`,`link`,`id_prowadzacy`) "
                . "VALUES('$ankieta','Ocena Praktyk Zawodowych $_POST[rok_akademicki] $_POST[semestrZL]','$link_base".$lastid ."',$lastid); ";
        mysqli_query($kon,$qAWNlink);
     //Budownictwo Stacjonarne
        $qBS="INSERT INTO `prowadzacy`(`imie`,`nazwisko`,`kierunek`,`rok_akademicki`,`forma`) "
                . "VALUES ('Małgorzata','Leszczyńska-Domańska','Budownictwo','$_POST[rok_akademicki] $_POST[semestrZL]','Stacjonarne');";
        mysqli_query($kon,$qBS);
        $lastid_=mysqli_fetch_array(mysqli_query($kon,"SELECT MAX(`id`) FROM `prowadzacy` WHERE 1"));
        $lastid=$lastid_[0];
        $qBSlink="INSERT INTO `linki_ankiet`(`ankieta`,`ankieta_nazwa`,`link`,`id_prowadzacy`) "
                . "VALUES('$ankieta','Ocena Praktyk Zawodowych $_POST[rok_akademicki] $_POST[semestrZL]','$link_base".$lastid ."',$lastid); ";
        mysqli_query($kon,$qBSlink);
    //Budownictwo Niestacjonarne
        $qBN="INSERT INTO `prowadzacy`(`imie`,`nazwisko`,`kierunek`,`rok_akademicki`,`forma`) "
                . "VALUES ('Małgorzata','Leszczyńska-Domańska','Budownictwo','$_POST[rok_akademicki] $_POST[semestrZL]','Niestacjonarne');";
        mysqli_query($kon,$qBN);
        $lastid_=mysqli_fetch_array(mysqli_query($kon,"SELECT MAX(`id`) FROM `prowadzacy` WHERE 1"));
        $lastid=$lastid_[0];
        $qBNlink="INSERT INTO `linki_ankiet`(`ankieta`,`ankieta_nazwa`,`link`,`id_prowadzacy`) "
                . "VALUES('$ankieta','Ocena Praktyk Zawodowych $_POST[rok_akademicki] $_POST[semestrZL]','$link_base".$lastid ."',$lastid); ";
        mysqli_query($kon,$qBNlink);
    //Wzornictwo Niestacjonarne    
        $qWN= "INSERT INTO `prowadzacy`(`imie`,`nazwisko`,`kierunek`,`rok_akademicki`,`forma`) "
                . "VALUES ('Małgorzata','Leszczyńska-Domańska','Wzornictwo','$_POST[rok_akademicki] $_POST[semestrZL]','Niestacjonarne');";
        mysqli_query($kon,$qWN);
        $lastid_=mysqli_fetch_array(mysqli_query($kon,"SELECT MAX(`id`) FROM `prowadzacy` WHERE 1"));
        $lastid=$lastid_[0];
        $qWNlink="INSERT INTO `linki_ankiet`(`ankieta`,`ankieta_nazwa`,`link`,`id_prowadzacy`) "
                . "VALUES('$ankieta','Ocena Praktyk Zawodowych $_POST[rok_akademicki] $_POST[semestrZL]','$link_base".$lastid ."',$lastid); ";
        mysqli_query($kon,$qWNlink);
    //Wzornictwo Stacjonarne    
        $qWS= "INSERT INTO `prowadzacy`(`imie`,`nazwisko`,`kierunek`,`rok_akademicki`,`forma`) "
                . "VALUES ('Małgorzata','Leszczyńska-Domańska','Wzornictwo','$_POST[rok_akademicki] $_POST[semestrZL]','Stacjonarne');";
        mysqli_query($kon,$qWS);
        $lastid_=mysqli_fetch_array(mysqli_query($kon,"SELECT MAX(`id`) FROM `prowadzacy` WHERE 1"));
        $lastid=$lastid_[0];
        $qWSlink="INSERT INTO `linki_ankiet`(`ankieta`,`ankieta_nazwa`,`link`,`id_prowadzacy`) "
                . "VALUES('$ankieta','Ocena Praktyk Zawodowych $_POST[rok_akademicki] $_POST[semestrZL]','$link_base".$lastid ."',$lastid); ";
        mysqli_query($kon,$qWSlink);
    //Mechanika i Budowa Maszyn Stacjonarne
        $qMB="INSERT INTO `prowadzacy`(`imie`,`nazwisko`,`kierunek`,`rok_akademicki`,`forma`) "
                . "VALUES ('Jan','Cetner','Mechanika i Budowa Maszyn','$_POST[rok_akademicki] $_POST[semestrZL]','Stacjonarne');";
        mysqli_query($kon,$qMB);
        $lastid_=mysqli_fetch_array(mysqli_query($kon,"SELECT MAX(`id`) FROM `prowadzacy` WHERE 1"));
        $lastid=$lastid_[0];
        $qMBlink="INSERT INTO `linki_ankiet`(`ankieta`,`ankieta_nazwa`,`link`,`id_prowadzacy`) "
                . "VALUES('$ankieta','Ocena Praktyk Zawodowych $_POST[rok_akademicki] $_POST[semestrZL]','$link_base".$lastid ."',$lastid); ";
        mysqli_query($kon,$qMBlink);
    //Mechanika i Budowa Maszyn Niestacjonarne
         $qMB="INSERT INTO `prowadzacy`(`imie`,`nazwisko`,`kierunek`,`rok_akademicki`,`forma`) "
                . "VALUES ('Jan','Cetner','Mechanika i Budowa Maszyn','$_POST[rok_akademicki] $_POST[semestrZL]','Niestacjonarne');";
        mysqli_query($kon,$qMB);
        $lastid_=mysqli_fetch_array(mysqli_query($kon,"SELECT MAX(`id`) FROM `prowadzacy` WHERE 1"));
        $lastid=$lastid_[0];
        $qMBlink="INSERT INTO `linki_ankiet`(`ankieta`,`ankieta_nazwa`,`link`,`id_prowadzacy`) "
                . "VALUES('$ankieta','Ocena Praktyk Zawodowych $_POST[rok_akademicki] $_POST[semestrZL]','$link_base".$lastid ."',$lastid); ";
        mysqli_query($kon,$qMBlink);
    //Ochrona Środowiska Niestacjonarne
        $qOS="INSERT INTO `prowadzacy`(`imie`,`nazwisko`,`kierunek`,`rok_akademicki`,`forma`) "
                . "VALUES ('Jan','Cetner','Ochrona Środowiska','$_POST[rok_akademicki] $_POST[semestrZL]','Niestacjonarne'); ";
        mysqli_query($kon,$qOS);
        $lastid_=mysqli_fetch_array(mysqli_query($kon,"SELECT MAX(`id`) FROM `prowadzacy` WHERE 1"));
        $lastid=$lastid_[0];
        $qOSlink="INSERT INTO `linki_ankiet`(`ankieta`,`ankieta_nazwa`,`link`,`id_prowadzacy`) "
                . "VALUES('$ankieta','Ocena Praktyk Zawodowych $_POST[rok_akademicki] $_POST[semestrZL]','$link_base".$lastid ."',$lastid); ";
        mysqli_query($kon,$qOSlink);
    //Zarządzanie Niestacjonarne
        $qZ="INSERT INTO `prowadzacy`(`imie`,`nazwisko`,`kierunek`,`rok_akademicki`,`forma`) "
                . "VALUES ('Jan','Cetner','Zarządzanie','$_POST[rok_akademicki] $_POST[semestrZL]','Niestacjonarne');";
        mysqli_query($kon,$qZ);
         $lastid_=mysqli_fetch_array(mysqli_query($kon,"SELECT MAX(`id`) FROM `prowadzacy` WHERE 1"));
        $lastid=$lastid_[0];
        $qZlink="INSERT INTO `linki_ankiet`(`ankieta`,`ankieta_nazwa`,`link`,`id_prowadzacy`) "
                . "VALUES('$ankieta','Ocena Praktyk Zawodowych $_POST[rok_akademicki] $_POST[semestrZL]','$link_base".$lastid ."',$lastid); ";
        mysqli_query($kon,$qZlink);
    //Zarządzanie Stacjonarne
     $qZ="INSERT INTO `prowadzacy`(`imie`,`nazwisko`,`kierunek`,`rok_akademicki`,`forma`) "
                . "VALUES ('Jan','Cetner','Zarządzanie','$_POST[rok_akademicki] $_POST[semestrZL]','Stacjonarne');";
        mysqli_query($kon,$qZ);
         $lastid_=mysqli_fetch_array(mysqli_query($kon,"SELECT MAX(`id`) FROM `prowadzacy` WHERE 1"));
        $lastid=$lastid_[0];
        $qZlink="INSERT INTO `linki_ankiet`(`ankieta`,`ankieta_nazwa`,`link`,`id_prowadzacy`) "
                . "VALUES('$ankieta','Ocena Praktyk Zawodowych $_POST[rok_akademicki] $_POST[semestrZL]','$link_base".$lastid ."',$lastid); ";
        mysqli_query($kon,$qZlink);
    //Zarządzanie i Inżynieria Produkcji Niestacjonarne
        $qZIP="INSERT INTO `prowadzacy`(`imie`,`nazwisko`,`kierunek`,`rok_akademicki`,`forma`) "
                . "VALUES ('Jan','Cetner','Zarządzanie i Inżynieria Produkcji','$_POST[rok_akademicki] $_POST[semestrZL]','Niestacjonarne'); ";
        mysqli_query($kon,$qZIP);
         $lastid_=mysqli_fetch_array(mysqli_query($kon,"SELECT MAX(`id`) FROM `prowadzacy` WHERE 1"));
        $lastid=$lastid_[0];
        $qZIPlink="INSERT INTO `linki_ankiet`(`ankieta`,`ankieta_nazwa`,`link`,`id_prowadzacy`) "
                . "VALUES('$ankieta','Ocena Praktyk Zawodowych $_POST[rok_akademicki] $_POST[semestrZL]','$link_base".$lastid ."',$lastid); ";
        mysqli_query($kon,$qZIPlink);
    //Zdrowie Publiczne Stacjonarne
        $qZP="INSERT INTO `prowadzacy`(`imie`,`nazwisko`,`kierunek`,`rok_akademicki`,`forma`) "
                . "VALUES ('Jan','Cetner','Zdrowie Publiczne','$_POST[rok_akademicki] $_POST[semestrZL]','Stacjonarne'); ";
        mysqli_query($kon,$qZP);
         $lastid_=mysqli_fetch_array(mysqli_query($kon,"SELECT MAX(`id`) FROM `prowadzacy` WHERE 1"));
        $lastid=$lastid_[0];
        $qZPlink="INSERT INTO `linki_ankiet`(`ankieta`,`ankieta_nazwa`,`link`,`id_prowadzacy`) "
                . "VALUES ('$ankieta','Ocena Praktyk Zawodowych $_POST[rok_akademicki] $_POST[semestrZL]','$link_base".$lastid ."',$lastid); ";
        mysqli_query($kon,$qZPlink);
    //Zdrowie Publiczne Niestacjonarne
         $qZP="INSERT INTO `prowadzacy`(`imie`,`nazwisko`,`kierunek`,`rok_akademicki`,`forma`) "
                . "VALUES ('Jan','Cetner','Zdrowie Publiczne','$_POST[rok_akademicki] $_POST[semestrZL]','Niestacjonarne'); ";
        mysqli_query($kon,$qZP);
         $lastid_=mysqli_fetch_array(mysqli_query($kon,"SELECT MAX(`id`) FROM `prowadzacy` WHERE 1"));
        $lastid=$lastid_[0];
        $qZPlink="INSERT INTO `linki_ankiet`(`ankieta`,`ankieta_nazwa`,`link`,`id_prowadzacy`) "
                . "VALUES ('$ankieta','Ocena Praktyk Zawodowych $_POST[rok_akademicki] $_POST[semestrZL]','$link_base".$lastid ."',$lastid); ";
        mysqli_query($kon,$qZPlink);
    //Informatyka Stacjonarna
        $qI= "INSERT INTO `prowadzacy`(`imie`,`nazwisko`,`kierunek`,`rok_akademicki`,`forma`) "
                . "VALUES ('Jan','Cetner','Informatyka','$_POST[rok_akademicki] $_POST[semestrZL]','Stacjonarne'); ";
        mysqli_query($kon,$qI);
         $lastid_=mysqli_fetch_array(mysqli_query($kon,"SELECT MAX(`id`) FROM `prowadzacy` WHERE 1"));
        $lastid=$lastid_[0];
        $qIlink="INSERT INTO `linki_ankiet`(`ankieta`,`ankieta_nazwa`,`link`,`id_prowadzacy`) "
                . "VALUES ('$ankieta','Ocena Praktyk Zawodowych $_POST[rok_akademicki] $_POST[semestrZL]','$link_base".$lastid ."',$lastid); ";
        mysqli_query($kon,$qIlink);
    //Informatyka Niestacjonarna
        $qI= "INSERT INTO `prowadzacy`(`imie`,`nazwisko`,`kierunek`,`rok_akademicki`,`forma`) "
                . "VALUES ('Jan','Cetner','Informatyka','$_POST[rok_akademicki] $_POST[semestrZL]','Niestacjonarne'); ";
        mysqli_query($kon,$qI);
         $lastid_=mysqli_fetch_array(mysqli_query($kon,"SELECT MAX(`id`) FROM `prowadzacy` WHERE 1"));
        $lastid=$lastid_[0];
        $qIlink="INSERT INTO `linki_ankiet`(`ankieta`,`ankieta_nazwa`,`link`,`id_prowadzacy`) "
                . "VALUES ('$ankieta','Ocena Praktyk Zawodowych $_POST[rok_akademicki] $_POST[semestrZL]','$link_base".$lastid ."',$lastid); ";
        mysqli_query($kon,$qIlink);
    //stworzenie widoku do analiz
      
       //Wyświetlam linki
       ?>
    <table class="table table-striped table-sm">
        <thead><tr><th>L.P.</th>
                        <th>Kierunek studiów</th>
                        <th>Forma studiów</th>
                        <th>link do ankiety</th>
            </tr></thead><tbody>
                <?php
                $links=mysqli_query($kon,"SELECT prowadzacy.kierunek,prowadzacy.forma,linki_ankiet.link FROM `linki_ankiet` "
                        . "INNER JOIN `prowadzacy` ON prowadzacy.id=linki_ankiet.id_prowadzacy "
                        . "WHERE linki_ankiet.ankieta='ocena_praktyk_zawodowych' AND prowadzacy.id>$last");
                foreach ($links as $link) {
                    echo "<tr><td>$lp</td><td>$link[kierunek]</td><td>$link[forma]</td><td>$link[link]</td></tr>";
                }
                ?>
        </tbody>
    </table>
    <?php
        break; 
             break;
   case "ocena_pracy_nauczyciela":
    case "ocena_nakladu_pracy_studenta":
      // print_r($_POST);
       ?><h5 class="text-center">Zaimportuj wykładowców</h5>
       <div class="row"><div class="col-md-3">
                   <form method="POST" action="core/import.php" enctype="multipart/form-data">
                   <div class="file-field">
        <div class="btn btn-primary btn-sm">
            <span>Wybierz plik</span>
            <input type="hidden" name="rok_akademicki" 
                   value="<?php echo "$_POST[rok_akademicki] $_POST[semestrZL]";?>"/>
            <input type="hidden" name="ankieta" value="<?php echo $_POST['ankieta'];?>"/>
            <input type="file" accept=".txt,.TXT,.csv,.CSV" name="import" data-multiple-target="{target} files selected">
        </div>
        <div class="file-path-wrapper">
           <input class="file-path validate" type="text" placeholder="plik">
        </div>
    </div><button class="btn btn-indigo" type="submit">IMPORT</button>
                   </form></div>
               
               <div class="col-md-9">
                   <p class="text-muted">
                       Aby zaimportować wykładowców musimy przygotować plik CSV 
                       (można to zrobić za pomocą programu MS Excel). Kolumny pliku powinny być następujące:</p>
                   <a href="../core/patterns/wzorzec.csv" class="btn btn-warning btn-sm">Pobierz wzorzec</a>
                   <ol type="A">
                       <li>Imię</li>
                       <li>Nazwisko</li>
                       <li>Tytuł zawodowy</li>
                       <li>Przedmiot</li>
                       <li>Kierunek studiów</li>
                       <li>Stopień studiów</li>
                       <li>Forma studiów</li>
                       <li>Grupa</li>
                               <li>OPCJONALNIE:<ul>
                                       <li>Imię, nazwisko i tytuł zawodowy hospitującego</li>
                                        <li>Data hospitacji w formacie RRRR-MM-DD</li>
                                        <li>Rok studiów</li></ul></li>
                           
                   </ol><p class="text-muted">Kolejność kolumn musi być dokładnie taka jak na powyższej liście.
                   </p>
                   
               </div></div>
       <hr/>
  <!--    <h5 class="text-center">Dodaj ręcznie wykładowców</h5>
   
<div class="row">
    <div class="md-form form-group col-md-2" style="font-size:0.8em;">
       
        <input type="text" name="imie" id="imie" class="form-control validate">
        <label for="imie" data-error="wrong" data-success="right" style="font-size:0.8em;">Imię</label>
    </div>

    <div class="md-form form-group col-md-2">
       
        <input type="text" id="nazwisko" name="nazwisko" class="form-control validate">
        <label for="nazwisko" data-error="wrong" data-success="right" style="font-size:0.8em;">Nazwisko</label>
    </div>
 <div class="md-form form-group col-md-1">
       
        <input type="text" id="tyt" name="tyt" class="form-control validate">
        <label for="tyt" data-error="wrong" data-success="right" style="font-size:0.8em;">Tytuł naukowy</label>
    </div>
          <div class="md-form form-group col-md-2">
        
        <input type="text" id="przedmiot" name="przedmiot" class="form-control validate">
        <label for="przedmiot" data-error="wrong" data-success="right" style="font-size:0.8em;">Przedmiot</label>
    </div>
             <div class="md-form form-group col-md-2">
        
        <input type="text" id="kierunek" name="kierunek" class="form-control validate">
        <label for="kierunek" data-error="wrong" data-success="right" style="font-size:0.8em;">Kierunek studiów</label>
    </div>
          <div class="md-form form-group col-md-1">
        
        <input type="text" id="stopien" name="stopien" class="form-control validate">
        <label for="stopien" data-error="wrong" data-success="right" style="font-size:0.8em;">Stopień studiów</label>
    </div>
    <div class="md-form form-group col-md-1">
        
        <input type="text" id="forma" name="forma" class="form-control validate">
        <label for="forma" data-error="wrong" data-success="right" style="font-size:0.8em;">Forma studiów</label>
    </div></div>
    <div class="md-form form-group">
        <a class="btn btn-primary btn-sm">Dodaj</a>
    </div>

</form>-->
       <?php
       //wykładowców można zaimportować z listy
       break;
   
        
  }
  ?>
            </div>
       </div>
              

         
     </div>
          <!--/.Card-->

        </div>
        <!--Grid column-->

        <!--Grid column-->
        
        <!--Grid column-->

      </div>
        </div>
        
      

   
 
 <?php include('view/ocenydyplom_Modal.php');?>
      <?php include('view/footer.php');
      ?>
  <script>
  $( document ).ready(function() {
    new WOW().init()
});
  </script>
  
  
 
</body>

</html>

