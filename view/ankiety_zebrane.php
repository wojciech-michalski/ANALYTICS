  <?php 



require('controller/ank_z.php');
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
            <span>ANKIETY ZEBRANE</span>
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
     <div class="list-group">   
       <?php 
       $counter=0;
       foreach($listaankiet as $ankieta){
           $counter++;
           $dane=dane_ankiety($kon,$ankieta['ankieta']);
           $counterLabel="modal".$counter."Label";
           ?>
                 <div class="list-group-item list-group-item-action flex-column align-items-start">
    <div class="d-flex w-100 justify-content-between">
      <h5 class="mb-1"><?php echo $ankieta['nazwa'];?></h5>
      <small>od: <?php echo $dane['data_first'];?></small><br/> <small>do: <?php echo $dane['data_last'];?></small>
    </div>
    <p class="mb-1">Wypełniono: <?php echo $dane['wypelniono'];?> ankiet</p>
    <small>Ilość pytań: <?php echo $dane['ilosc_pytan'];?></small><hr/>
    
    <button data-target="#<?php echo "modal$counter";?>" data-toggle="modal" class="btn btn-unique">ANALIZA</button>
    <?php switch($ankieta['nazwa']){
          default:
              break;
              case "Ocena pracy nauczyciela akademickiego":
                  ?>
     <button data-target="#onaModal" data-toggle="modal" class="btn btn-indigo">Analiza wykładowcy zbiorczo</button>
     <?php
     break;
    }
    ?>
        </div>
        
      <?php
      //powiązanie nazwy widoku z nazwą ankiety
      switch($ankieta['nazwa']){
          case "Ocena pracy administracji wersja 2":
              $queryan="SHOW TABLES WHERE `Tables_in_analytics` LIKE 'ANALIZA-Ocena Administracji%' AND `Tables_in_analytics`<>"
                  . "'ANALIZA-Ocena Administracji 2020/21 L' AND `Tables_in_analytics`<>'ANALIZA-Ocena Administracji 2020/21 Z'"
                  . "AND `Tables_in_analytics`<>'ANALIZA-Ocena Administracji 2021/22 Z'";
              $deanreport=7;
              break;
          case "Ocena pracy administracji":
              $queryan="SHOW TABLES WHERE `Tables_in_analytics` = 'ANALIZA-Ocena Administracji 2020/21 L' OR `Tables_in_analytics`="
                  . "'ANALIZA-Ocena Administracji 2020/21 Z' OR `Tables_in_analytics`='ANALIZA-Ocena Administracji 2021/22 Z'";
              $deanreport=7;
              break;
          case "Ocena pracy nauczyciela akademickiego":
              $queryan="SHOW TABLES WHERE `Tables_in_analytics` LIKE 'ANALIZA-Ocena pracy nauczyciela%'";
              $deanreport=7;
              break;
          case "Ocena nakładu pracy studenta":
              $queryan="SHOW TABLES WHERE `Tables_in_analytics` LIKE 'ANALIZA-Ocena nakładu pracy studenta%'";
              $deanreport=8;
              break;
          case "Ocena praktyk zawodowych":
              $queryan="SHOW TABLES WHERE `Tables_in_analytics` LIKE 'ANALIZA - Ocena praktyk%'";
              $deanreport=12;
              break;
          case "Ankieta dotycząca szczepień na COVID 19":
              $queryan="SHOW TABLES WHERE `Tables_in_analytics` LIKE 'ANALIZA - COVID%'";
              $deanreport=13;
              break;
          case "Ankieta dotycząca powodów rezygnacji ze studiów":
              $queryan="SHOW TABLES WHERE `Tables_in_analytics` LIKE 'ANALIZA - rezygnacje%'";
              $deanreport=14;
              break;
          case "Monitoring losów absolwentów":
              $queryan="SHOW TABLES WHERE `Tables_in_analytics` = 'ankieta'";
              $deanreport=15;
              break;
          default:
              $queryan="SHOW TABLES WHERE `Tables_in_analytics` LIKE 'ANALIZA%'";
              $deanreport=7;
              break;
      }
      if(mysqli_num_rows(mysqli_query($kon,$queryan))>0){
      $lista_analiz=mysqli_query($kon,$queryan);
      
      foreach ($lista_analiz as $annaliza){
          $options[]="<option>$annaliza[Tables_in_analytics]</option>";
      }
      $form="<select class=\"mdb-select\" required name=\"analiza\">".implode("",$options)."</select>";
          unset($options);
           $modal_array[]=" <div class=\"modal fade\" id=\"modal$counter\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"$counterLabel\" aria-hidden=\"true\">
    <div class=\"modal-dialog\" role=\"document\"><form method=\"POST\" action=\"main.php?mode=deanreport$deanreport\">
        <div class=\"modal-content\">
            <div class=\"modal-header\">
                <h5 class=\"modal-title\" id=\"$counterLabel\">$ankieta[nazwa] - wybierz zakres analizy</h5>
                <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">
                    <span aria-hidden=\"true\">&times;</span>
                </button>
            </div>
            <div class=\"modal-body\">
                $form
            </div>
            <div class=\"modal-footer\">
                <button type=\"button\" class=\"btn btn-secondary btn-sm\" data-dismiss=\"modal\">ANULUJ</button>
                <button type=\"submit\" class=\"btn btn-primary btn-sm\">POKAŻ</button>
            </div>
        </div></form>
    </div>
</div>";
       }
       else {echo"<!-- nie ma takich ankiet-->";}
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
        
       </div>

    <?php
    $modale=implode("\n",$modal_array);
    echo $modale;
    ?>
 
 <?php include('view/ocenydyplom_Modal.php');?>
      <?php include('view/footer.php');?>
 <div class="modal fade" id="onaModal" tabindex="-1" role="dialog" aria-labelledby="onaModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" action="main.php?mode=survey1">
            <div class="modal-header">
                <h5 class="modal-title" id="onaModalLabel">Wybierz wykładowcę</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" value="ANALIZA-ocena pracy nauczyciela ALL" name="analiza">
                <div class="select-outline" >
           <select class="mdb-select md-form md-outline colorful-select dropdown-primary" id="onaSel"
                   searchable="Szukaj" name="wykladowcy" >
               <option data-secondary-text="Wyszukaj wykładowcę" selected ></option>
          <?php $towary=mysqli_query($kon,"SELECT `imie`,`nazwisko`,`tytul` FROM `ANALIZA-ocena pracy nauczyciela ALL` WHERE 1 GROUP BY `imie`,`nazwisko`");
                foreach($towary as $towar){
                    echo "<option style=\"font-size:0.7em !important;\" data-secondary-text=\"$towar[tytul]\" "
                            . "value=\"%;;$towar[nazwisko];;$towar[imie];;$towar[tytul]\">$towar[imie] $towar[nazwisko]</option>";
                }
          ?>
           </select></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Anuluj</button>
                <button type="submit" class="btn btn-sm btn-primary">Pokaż</button>
            </div></form>
        </div>
    </div>
</div>
  
  
 
</body>

</html>