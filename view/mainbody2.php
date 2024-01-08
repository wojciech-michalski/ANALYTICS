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
   


    function generuj_przebieg($sqlconnection,$kierun,$n){
       $startdate=strtotime("2022-09-12");
         $today=strtotime(date('Y-m-d'));
        $month=$startdate;
        //echo date('Y-m-d',$month);
        do {
            $datearray[]=date('Y-m-d',$month);
            $month=strtotime('+30 days',$month);
        }
        while ($month<$today);
        $labels_=implode("\",\"",$datearray);
                $labels="[\"$labels_\"]";
        $scripthead="var ctxL = document.getElementById(\"lineChart$n\").getContext('2d');
    var myLineChart = new Chart(ctxL, {
      type: 'line',
      data: {
        labels: $labels,\n"
                . "datasets: [{\n"
                . "";
        $background_rgba=array(105, 100, 232, .2);
        $bordercolor_rgba=array(200, 99, 132, .7);
        $kierunki=mysqli_query($sqlconnection,"SELECT DISTINCT `kierunek`,`forma`,`stopien`,`id` FROM `mapowanie` WHERE `aktywny`=1 AND `kierunek`='$kierun'");
            foreach ($kierunki as $kierunek){
                $datasets[$kierunek['id']]="$kierunek[kierunek] $kierunek[forma] $kierunek[stopien]";
                
                foreach ($datearray as $date){
                    $values[$date]=mysqli_num_rows(mysqli_query($sqlconnection,"SELECT `id` FROM `studenci` WHERE `id_mapowanie`='$kierunek[id]' AND `collect_data`='$date'"));
                }
                $valstring[$kierunek['id']]="[".implode(",",$values)."]";
                unset($values);
                $background[$kierunek['id']]="[\n'rgba(".implode(",",$background_rgba).")',\n"
                        . "],";
                $border[$kierunek['id']]="[\n'rgba(".implode(",",$bordercolor_rgba).")',\n"
                        . "],";        
                $background_rgba[0]=$background_rgba[0]-25;
                $background_rgba[1]=$background_rgba[1]+25;
                $background_rgba[2]=$background_rgba[2]-20;
                $background_rgba[3]=$background_rgba[3]+0.2;
                $bordercolor_rgba[0]=$bordercolor_rgba[0]+5;
                $bordercolor_rgba[1]=$bordercolor_rgba[1]+5;
                $bordercolor_rgba[2]=$bordercolor_rgba[2]+5;
                $bordercolor_rgba[3]=$bordercolor_rgba[3]+.2;
            }
          foreach(array_keys($datasets) as $id){
              $label="label: \"$datasets[$id]\",";
              $backgroundc="backgroundColor: $background[$id]";
              $borderc="borderColor:$border[$id]
                      borderWidth: 2,";
                     
              $val="data: $valstring[$id]\n"
                      . "}";
              $script_array[]="$label\n"
                      . "$backgroundc\n"
                      . "$borderc\n"
                      . "$val";
          }
          $datasets=implode(",\n{\n",$script_array);
          $script="$scripthead $datasets
                    ]
      },
      options: {
        responsive: true
      }
    });";
          return($script);
    }
    $kiery=mysqli_query($kon,"SELECT DISTINCT `kierunek` FROM `mapowanie` WHERE `aktywny`=1");
    $ilekier=mysqli_num_rows($kiery);
    $knum=0;
    do {
        $kier=mysqli_fetch_array($kiery);
            $przebiegi[]=generuj_przebieg($kon,$kier[0],$knum);
            echo "<div class=\"card-header text-center\">Stany studentów $kier[0] </div>
            <div class=\"card-body\">
              <canvas id=\"lineChart$knum\" ></canvas>

            </div>";
            $knum=$knum+1;
        }
        while($knum<$ilekier);

            
?>
         
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
  <?php foreach($przebiegi as $przebieg){
      echo $przebieg."\n";
  }
  echo $kolo;
  ?>
  </script>
  
 
</body>

</html>

