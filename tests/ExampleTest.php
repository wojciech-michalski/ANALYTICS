<?php

declare(strict_types=1);
use PHPUnit\Framework\TestCase;

final class ExampleTest extends TestCase
{
 
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
}

