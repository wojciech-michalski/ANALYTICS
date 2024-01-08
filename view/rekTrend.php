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
            <span>Raporty rekrutacji / Trend skuteczności</span>
          </h4>

          

        </div>

      </div>
              <div class="row wow fadeIn">

       

          <!--Card-->
       <div class="col-md-12 mb-4">   
     <div class="card">
<?php

   



      
        //echo date('Y-m-d',$month);
        $prevmonth_=date('m')-1;
      //  echo $prevmonth_;
        switch($prevmonth_){
            case 1:
                $prevmonth="01";
                $nazwa="styczeń";
                break;
            case 2:
                $prevmonth="02";
                $nazwa="luty";
                break;
            case 3:
                $prevmonth="03";
                $nazwa="marzec";
                break;
             case 4:
                $prevmonth="04";
                 $nazwa="kwiecień";
                break;
             case 5:
                $prevmonth="05";
                 $nazwa="maj";
                break;
             case 6:
                $prevmonth="06";
                 $nazwa="czerwiec";
                 break;
                  case 7:
                $prevmonth="07";
                      $nazwa="lipiec";
                break;
             case 8:
                $prevmonth="08";
                 $nazwa="sierpień";
                break;
             case 9:
                $prevmonth="09";
                 $nazwa="wrzesień";
                break;
            default:
                $prevmonth=$prevmonth_;
                break;
                break;
        }
        ?>
         <div class="card-header text-center">
             Skuteczność rekrutacji (ilość podpisanych umów) dla miesiąca <?php echo $nazwa;?> latami </div>
         
         <?php
        $y=2019;
        do {
        $datearray[]="$y";
      $y++;
        }
        while($y<2024);
       // print_r($datearray);
        $scripthead="var ctxL = document.getElementById(\"lineChart\").getContext('2d');
    var myLineChart = new Chart(ctxL, {
      type: 'line',
      data: {
        labels: [\"2019\",\"2020\",\"2021\",\"2022\",\"2023\"],\n"
                . "datasets: [{\n"
                . "";
       
        $background_rgba=array(150, 100, 100, .2);
        $bordercolor_rgba=array(200, 99, 132, .7);
        //echo "SELECT  `kierunek`,`stopien`,`rok`,`ilosc_umow` FROM `rek_trends` WHERE  `kierunek` NOT LIKE 'ERASMUS%' AND `miesiac`='$prevmonth'";
        $kierunki=mysqli_query($kon,"SELECT  `kierunek`,`stopien`,`rok`,`ilosc_umow`,`id` "
                . "FROM `rek_trends` WHERE  `kierunek` NOT LIKE 'ERASMUS%' AND "
                . "(`stopien`<>'Podyplomowe' AND `stopien`<>'Kurs' AND `stopien`<>'online') AND `miesiac`='$prevmonth' GROUP BY `kierunek`,`stopien`");
            foreach ($kierunki as $kierunek){
                switch($kierunek['kierunek']){
                    case 'Architektura':
                        $background_rgba=array(150, 10, 10, .2);
                        break;
                    case 'Architecture':
                        $background_rgba=array(180, 30, 10, .2);
                        break;
                    case 'Architektura Wnętrz':
                       $background_rgba=array(100, 80, 10, .2);
                        break; 
                    case 'Architektura Krajobrazu':
                       $background_rgba=array(70, 100, 10, .2);
                        break; 
                    case 'Wzornictwo':
                        $background_rgba=array(10, 10, 190, .2);
                        break;
                    case 'Budownictwo':
                        $background_rgba=array(10, 180, 10, .2);
                        break;
                    case 'Zarządzanie':
                        $background_rgba=array(100, 100, 10, .2);
                        break;
                    case 'Management':
                        $background_rgba=array(10, 10, 100, .2);
                        break;
                    case 'Zarządzanie i Inżynieria Produkcji':
                        $background_rgba=array(10, 10, 180, .2);
                        break;
                }
                $datasets[$kierunek['id']]="$kierunek[kierunek] $kierunek[stopien]";
                
                foreach ($datearray as $date){
                    $values_=mysqli_fetch_array(mysqli_query($kon,
                            "SELECT `ilosc_umow` FROM `rek_trends` WHERE `kierunek`='$kierunek[kierunek]' AND `miesiac`='$prevmonth' AND `rok`='$date' AND `stopien`='$kierunek[stopien]'"));
                
                    $values[]=$values_[0];
                }
                //print_r($values);
                $valstring[$kierunek['id']]="[".implode(",",$values)."]";
                unset($values);
                $background[$kierunek['id']]="[\n'rgba(".implode(",",$background_rgba).")',\n"
                        . "],";
                $border[$kierunek['id']]="[\n'rgba(".implode(",",$bordercolor_rgba).")',\n"
                        . "],";  
                
                if(strpos($kierunek['kierunek'],'Archite')||strpos($kierunek['kierunek'],'Wzornictwo')
                        ||strpos($kierunek['kierunek'],'Budownictwo')||strpos($kierunek['kierunek'],'Interior')){
                    //$background_rgba=array(150, 10, 10, .2); 
                $background_rgba[0]=$background_rgba[0]+15;
                $background_rgba[1]=$background_rgba[1];
                $background_rgba[2]=$background_rgba[2];
                $background_rgba[3]=$background_rgba[3]+0.2;
                } else 
                if(strpos($kierunek['kierunek'],'Zarządzanie')||strpos($kierunek['kierunek'],'Management')){
                    //$background_rgba=array(50, 150, 10, .2);
                    $background_rgba[0]=$background_rgba[0]-10;
                $background_rgba[1]=$background_rgba[1]+15;
                $background_rgba[2]=$background_rgba[2]+1;
                $background_rgba[3]=$background_rgba[3]+0.2;
                }
                else {
                  //  $background_rgba=array(15, 10, 50, .2);
                    $background_rgba[0]=$background_rgba[0];
                $background_rgba[1]=$background_rgba[1];
                $background_rgba[2]=$background_rgba[2]+45;
                $background_rgba[3]=$background_rgba[3]+0.2;
                }
                $bordercolor_rgba[0]=$bordercolor_rgba[0]+2;
                $bordercolor_rgba[1]=$bordercolor_rgba[1]+2;
                $bordercolor_rgba[2]=$bordercolor_rgba[2]+2;
                $bordercolor_rgba[3]=$bordercolor_rgba[3]+.2;
            }
           // print_r($valstring);
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
         
          //return($prevmonth);
  
    
            
?>
          <canvas id="lineChart" ></canvas> 
          </div>
          <!--/.Card-->

       

      </div>
        </div>
        
       </div>
       </div>

      <?php include('view/footer.php');?>
  
  <script>
  <?php echo $script;?>
  </script>
  
 
</body>

</html>

