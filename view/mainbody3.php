<?php
include('controller/U10_Przynaleznosci.php');
include('controller/statusyANALYTICS.php');
?>
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
            <span>Przegląd</span>
          </h4>

          

        </div>

      </div>
              <div class="row wow fadeIn">

        <!--Grid column-->
        <div class="col-md-9 mb-4">

          <!--Card-->
          
     <div class="card">
<?php
 $startdate=strtotime("2022-09-12");
         $today=strtotime(date('Y-m-d'));
        $month=$startdate;
        //echo date('Y-m-d',$month);
        do {
            $datearray[]=date('Y-m-d',$month);
            $month=strtotime('+30 days',$month);
            
        }
        while ($month<$today);
   


    function generuj_przebieg($sqlconnection,$parametr,$n){
      $daty=mysqli_query($sqlconnection,"SELECT `data` FROM `trends` WHERE `parametr`='$parametr'");
      $ild=mysqli_num_rows($daty);
      $dc=0;
        do {
            $d=mysqli_fetch_array($daty);
            $dc++;
            $datearray[]=$d[0];
                  }
        while ($dc<$ild);
        $labels_=implode("\",\"",$datearray);
        $labels="[\"$labels_\"]";
        $scripthead="var ctxL = document.getElementById(\"lineChart$n\").getContext('2d');
    var myLineChart = new Chart(ctxL, {
      type: 'line',
      data: {
        labels: $labels,\n"
                . "datasets: [{\n"
                . "label: \"Ilość studentów z pominięciem ERASMUS\",\n"
                . "fillColor: \"rgba(220,20,20,0.2)\",\n"
                . "strokeColor: \"rgba(220,20,20,1)\",\n"
                . "pointColor: \"rgba(220,22,22,1)\",n"
                . "pointStrokeColor: \"#ff2222\",\n"
                . "pointHighlightFill: \"#ff2222\",\n"
                . "pointHighlightStroke: \"rgba(220,20,20,1)\",\n"
                . "";
                foreach ($datearray as $date){
                    $value=mysqli_fetch_array(mysqli_query($sqlconnection,"SELECT `wartosc` FROM `trends` "
                            . "WHERE `data`='$date' AND `parametr`='$parametr'"));
                    $values[$date]=$value[0];
                }
                $valstring="[".implode(",",$values)."]";
          $dataset="data: $valstring";
          $script="$scripthead $dataset
                    
      }]},\n
      options: {
        responsive: true
      }
    });";
          return($script);
    }
   
function generuj_przebieg2($sqlconnection,$n){
      $daty=mysqli_query($sqlconnection,"SELECT DISTINCT `rok` FROM `rek_trends` WHERE 1");
      $ild=mysqli_num_rows($daty);
      $dc=0;
        do {
            $d=mysqli_fetch_array($daty);
            $dc++;
            $datearray[]=$d[0];
                  }
        while ($dc<$ild);
        $labels_=implode("\",\"",$datearray);
        $labels="[\"$labels_\"]";
        $scripthead="var ctxL = document.getElementById(\"lineChart$n\").getContext('2d');
    var myLineChart = new Chart(ctxL, {
      type: 'line',
      data: {
        labels: $labels,\n"
                . "datasets: [{\n"
                . "label: \"Ogólna skuteczność rekrutacji latami\",\n"
                . "fillColor: \"rgba(220,20,20,0.2)\",\n"
                . "strokeColor: \"rgba(220,20,20,1)\",\n"
                . "pointColor: \"rgba(220,22,22,1)\",n"
                . "pointStrokeColor: \"#ff2222\",\n"
                . "pointHighlightFill: \"#ff2222\",\n"
                . "pointHighlightStroke: \"rgba(220,20,20,1)\",\n"
                . "";
                foreach ($datearray as $date){
                    $value=mysqli_fetch_array(mysqli_query($sqlconnection,"SELECT SUM(`ilosc_umow`) FROM `rek_trends` "
                            . "WHERE `rok`='$date' "));
                    $values[$date]=$value[0];
                }
                $valstring="[".implode(",",$values)."]";
          $dataset="data: $valstring";
          $script="$scripthead $dataset
                    
      }]},\n
      options: {
        responsive: true
      }
    });";
          return($script);
    }
            
?>
     <canvas id="lineChart1"></canvas>    
     <canvas id="lineChart2"></canvas> 
          </div>
          <!--/.Card-->

        </div>
        <!--Grid column-->

        <!--Grid column-->
        <div class="col-md-3 mb-4">

          <!--Card-->
          <div class="card mb-4">

            <!-- Card header -->
            <div class="card-header text-center">
              Obcokrajowcy <?php echo mysqli_num_rows(mysqli_query($kon,"SELECT `id` FROM `studenci` WHERE `collect_data`"
                      . "='".date('Y-m-d')."' AND `obywatelstwo`<>'PL'"));?>
            </div>
<?php
    function generuj_kolo($sqlconnection,$kierun,$n) {
        $background_rgba=array(255, 10, 10, .2);
        $hoverBackgroundColor=array(200,20,20,.2);
        switch ($kierun) {
            case "ALL":
                $querystring="";
                break;
            default:
                $querystring="AND mapowanie.kierunek='$kierun'";
                break;
    }
        $scripthead="var ctxP = document.getElementById(\"pieChart$n\").getContext('2d');\n
    var myPieChart = new Chart(ctxP, {\n
      type: 'pie',\n
      data: {\n";
        $obywatelstwa=mysqli_query($sqlconnection,"SELECT DISTINCT `obywatelstwo` FROM `studenci` WHERE `obywatelstwo`<>'PL'");
        $io=mysqli_num_rows($obywatelstwa);
        $k=0;
        
            do{
                $obywatelstwo=mysqli_fetch_array($obywatelstwa);
                $k=$k+1;
                $q="SELECT studenci.id"
                        . " FROM `studenci` INNER JOIN `mapowanie` ON studenci.id_mapowanie=mapowanie.id "
                        . "WHERE studenci.obywatelstwo='$obywatelstwo[obywatelstwo]' AND `collect_data`='".date('Y-m-d')."' $querystring";
                $dataarray[$obywatelstwo[0]]=mysqli_num_rows(mysqli_query($sqlconnection,$q));
                //return($dataarray);
              // $background_rgba[0]=$background_rgba[0]-15;
             //  $background_rgba[1]=$background_rgba[1]+15;
            //  $background_rgba[2]=$background_rgba[2]+15;
             //  $hoverBackgroundColor[0]=$background_rgba[0]-5;
             //  $hoverBackgroundColor[1]=$background_rgba[1]+5;
             //  $hoverBackgroundColor[2]=$background_rgba[2]+5;
              // $bcolors[]="'rgba($background_rgba[0], $background_rgba[1], $background_rgba[2], .2)'";
              // $hcolors[]="'rgba($hoverBackgroundColor[0], $hoverBackgroundColor[1], $hoverBackgroundColor[2], .2)'";
            }
            
            
            while($k<$io);
            $labels_=implode("\",\"",array_keys($dataarray));
            $labels="labels: [\"$labels_\"],\ndatasets: [{\n";
            $data_=implode(",",$dataarray);
            $data="data: [$data_],\n";
            $colors=" backgroundColor: [\"#F7464A\", \"#46BFBD\", \"#FDB45C\", \"#949FB1\", \"#4D5360\",\"#CC0000\",\"#FF8800\",\"#007E33\",\"#0099CC\"],
          hoverBackgroundColor: [\"#FF5A5E\", \"#5AD3D1\", \"#FFC870\", \"#A8B3C5\", \"#616774\",\"#ff4444\",\"#ffbb33\",\"#00C851\",\"#33b5e5\"]\n }]
      },\n
      options: {\n
        responsive: true,\n
        legend: false\n
      }\n
    });\n";
            $script="$scripthead $labels $data $colors";
           return($script);
    }
   $przebieg=generuj_przebieg($kon,'stan',1);
   $przebieg2=generuj_przebieg2($kon,2);
    $kolo=generuj_kolo($kon,"ALL",1);
   
    ?>
         
            <div class="card-body">

              <canvas id="pieChart1"></canvas>

            </div>

          </div>
           <?php 
          function wylicz_trend($sqlconnection,$wydzial,$kierun,$datastart,$datastop){
              //funkcja liczy trend dla kierunku, lub całej uczelni.
              //porównuje stan z okresu start z okresem stop i zwraca tablicę w postaci przyrostu i stanu końcowego
              //$dstart=date('Y-m-d',$datastart);
              //$dstop=date('Y-m-d',$datastop);
               switch ($kierun) {
            case "ALL":
                $querystring="";
                break;
            default:
                $querystring="AND mapowanie.kierunek='$kierun'";
                break;
    }
    switch ($wydzial) {
            case "ALL":
                $querystring2="";
                break;
            case "Wydział Architektury":
                $querystring2="AND (mapowanie.wydzial='$wydzial' OR mapowanie.wydzial='Faculty of Architecture')";
                break;
             case "Wydział Inżynierii i Zarządzania":
                $querystring2="AND (mapowanie.wydzial='$wydzial' OR mapowanie.wydzial='Faculty of Engineering and Management')";
                break;
                default:
                $querystring2="AND mapowanie.wydzial='$wydzial'";
                break;
    }
              $qstart="SELECT studenci.id"
                        . " FROM `studenci` INNER JOIN `mapowanie` ON studenci.id_mapowanie=mapowanie.id "
                        . "WHERE `collect_data`='$datastart' $querystring $querystring2";
               $qstop="SELECT studenci.id"
                        . " FROM `studenci` INNER JOIN `mapowanie` ON studenci.id_mapowanie=mapowanie.id "
                        . "WHERE `collect_data`='$datastop' $querystring $querystring2";
              $stanstart=mysqli_num_rows(mysqli_query($sqlconnection,$qstart));
              $stanstop=mysqli_num_rows(mysqli_query($sqlconnection,$qstop));
              $diff=$stanstop-$stanstart;
              $trend=round(($diff/$stanstart)*100,2); //trend w procentach
              $stan=$stanstop;
              if ($diff>0) {
                  $spanclass="class=\"badge badge-success badge-pill pull-right\"";
                  $iclass="class=\"fas fa-arrow-up ml-1\"";
              }
                else {
                    $spanclass="class=\"badge badge-danger badge-pill pull-right\"";
                  $iclass="class=\"fas fa-arrow-down ml-1\"";
                }
              
              $wynik=array (
                  'trend' => $trend,
                  'stan' => $stanstop,
                  'klasaspan' => $spanclass,
                  'klasai'=> $iclass
              );
              return($wynik);
          }
          ?>
          <div class="card mb-4">

              <div class="card-header text-center">Ostatnie 3 miesiące</div>
            <div class="card-body">

             <?php
             $trendstart=new DateTimeImmutable(date('Y-m-d'));
             $trendstart=$trendstart->modify("-3 month");
             $trend=wylicz_trend($kon,"ALL","ALL",$trendstart->format("Y-m-d"),date('Y-m-d'));
                //print_r($trend);
                ?>
             
             <!-- List group links -->
              <div class="list-group list-group-flush">
                <a class="list-group-item list-group-item-action waves-effect">Uczelnia 
                  <span <?php echo $trend['klasaspan'];?>><?php echo "$trend[stan] $trend[trend] %";?>
                    <i <?php echo $trend['klasai'];?>></i>
                  </span>
                </a>
                  <?php $trendA=wylicz_trend($kon,"Wydział Architektury","ALL",$trendstart->format("Y-m-d"),date('Y-m-d'));?>
                <a class="list-group-item list-group-item-action waves-effect">Wydział Architektury
                  <span <?php echo $trendA['klasaspan'];?>><?php echo "$trendA[stan] $trendA[trend] %";?>
                    <i <?php echo $trendA['klasai'];?>></i>
                  </span>
                </a>
                  <?php $trendWiZ=wylicz_trend($kon,"Wydział Inżynierii i Zarządzania","ALL",$trendstart->format("Y-m-d"),date('Y-m-d'));?>
                 <a class="list-group-item list-group-item-action waves-effect">Wydział Inżynierii i Zarządzania
                  <span <?php echo $trendWiZ['klasaspan'];?>><?php echo "$trendWiZ[stan] $trendWiZ[trend] %";?>
                    <i <?php echo $trendWiZ['klasai'];?>></i>
                  </span>
                </a>
               
              </div>
              <!-- List group links -->

            </div>

          </div>
          <!--/.Card-->

        </div>
        <!--Grid column-->

      </div>
        </div>
        
       </div>
    
      <?php include('view/footer.php');?>
  
  <script>
  <?php 
      echo $przebieg."\n";
      echo $przebieg2."\n";
 
  echo $kolo;
  ?>
  </script>
  
 
</body>

</html>

