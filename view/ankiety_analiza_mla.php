<?php
function konwersja_znakow($string){
    $znaki=array(
        "ó" => "Ã³",
        "ż" => "Å¼",
        "ł"=> "Å‚",
        "ś"=> "Å›",
        "ć" => "Ä‡",
        "ń" => "Å„",
        "ę" => "Ä™",
        "ą" => "Ä…",
        "ź" => "Åº"
    ) ;
    //$k=1;
    //$string[0]=$string;
    foreach (array_keys($znaki) as $conv){
        $string=str_replace($znaki[$conv],$conv,$string);
     //   $k++;
    }
    
    return $string;
}
       include('view/topnav.php');
       $ankieta_array=explode("-",$_POST['analiza']);
       $ankieta_dirty=$ankieta_array[1];
       $ankieta_cleaner=explode("20",$ankieta_dirty);
       $ankieta_clean=$ankieta_cleaner[0];
    //  $warunki=implode("' OR `kierunek`='",$_POST['kierunki']);
     // $warunek="`kierunek`='$warunki' ";
   // echo "SELECT * FROM `$_POST[analiza]` WHERE $warunek";
        
       if(!isset($_POST['k'])){
           $query=mysqli_query($kon,"SELECT * FROM `$_POST[analiza]` WHERE 1");
           $kierunek_nazwa="Cała Uczelnia";
           $wydział_nazwa="";
           $querystring=1;
       } else {
           $kierunek=$_POST['k'];
           switch($kierunek) {
               case 1:
                   $wydzial_nazwa="Wydział Architektury";
                   $kierunek_nazwa="Architektura";
                   $querystring="(`kierunek_studiow`='Architektura' OR `kierunek_studiow` LIKE 'Architektura i Urba%')";
                   $querystring2="(`Kierunek studiów`='Architektura' OR `Kierunek studiów` LIKE 'Architektura i Urba%')";
                   break;
               default:
                   $kierunek_nazwa="Cała Uczelnia";
                   $wydział_nazwa="";
                   $querystring=" 1";
                   break;
               case 2:
                   $wydzial_nazwa="Wydział Architektury";
                   $kierunek_nazwa="Architektura Wnętrz";
                   $querystring=" (`kierunek_studiow` LIKE 'Architektura W%')";
                   break;
               case 3:
                   $wydzial_nazwa="Wydział Architektury";
                   $kierunek_nazwa="Architektura Krajobrazu";
                   $querystring=" (`kierunek_studiow` LIKE 'Architektura K%')";
                   break;
               case 4:
                   $wydzial_nazwa="Wydział Architektury";
                   $kierunek_nazwa="Wzornictwo";
                   $querystring=" (`kierunek_studiow` LIKE 'Wzornictwo')";
                   break;
               case 5:
                   $wydzial_nazwa="Wydział Architektury";
                   $kierunek_nazwa="Budownictwo";
                   $querystring=" (`kierunek_studiow` LIKE 'Budownictwo')";
                   break;
               case 6:
                   $wydzial_nazwa="Wydział Inżynierii i Zarządzania";
                   $kierunek_nazwa="Zarządzanie";
                   $querystring=" (`kierunek_studiow` LIKE 'Zarz%' AND `kierunek_studiow` NOT LIKE '%Produkcji')";
                   break;
               case 7:
                   $wydzial_nazwa="Wydział Inżynierii i Zarządzania";
                   $kierunek_nazwa="Zarządzanie i Inżynieria Produkcji";
                   $querystring=" (`kierunek_studiow` LIKE '%Produkcji')";
                   break;
               case 8:
                   $wydzial_nazwa="Wydział Inżynierii i Zarządzania";
                   $kierunek_nazwa="Ochrona Środowiska";
                   $querystring=" (`kierunek_studiow` LIKE 'Ochrona%') ";
                   break;
               case 9:
                   $wydzial_nazwa="Wydział Inżynierii i Zarządzania";
                   $kierunek_nazwa="Mechanika i Budowa Maszyn";
                   $querystring=" (`kierunek_studiow` LIKE 'Mechanika%') ";
                   break;
               case 10:
                   $wydzial_nazwa="Wydział Inżynierii i Zarządzania";
                   $kierunek_nazwa="Zdrowie Publiczne";
                   $querystring=" (`kierunek_studiow` LIKE 'Zdrowie%')";
                   break;
               case 11:
                   $wydzial_nazwa="Wydział Inżynierii i Zarządzania";
                   $kierunek_nazwa="Informatyka";
                   $querystring=" (`kierunek_studiow` LIKE 'Informatyka%') ";
                   break;
           }
       $query=mysqli_query($kon,"SELECT * FROM `$_POST[analiza]` WHERE $querystring");
       }
      // echo "SELECT `id` FROM `ankieta` WHERE `5_lat`=1 AND $querystring";
      // $query=mysqli_query($kon,"SELECT * FROM `$_POST[analiza]` WHERE 1");
       //$kierywidok=implode(" i ",$_POST['kierunki']);      
$ile=mysqli_num_rows($query);
$ile5lat=mysqli_num_rows(mysqli_query($kon,"SELECT `id` FROM `ankieta` WHERE `5_lat`=1 AND $querystring"));
                $ile3lata=mysqli_num_rows(mysqli_query($kon,"SELECT `id` FROM `ankieta` WHERE `3_lata`=1 AND $querystring"));
$n=0;
//$naglowki=mysqli_query($kon,"DESCRIBE `$_POST[analiza]`");
$naglowki=mysqli_query($kon,"SELECT `pytanie`,`tresc`,`typ`,`n` FROM `metryki` WHERE `ankieta`='ankieta' "
        . "AND `ordering`<35 ORDER BY `ordering` ASC");
$ile_naglowkow=mysqli_num_rows($naglowki);
$k=0;
//ROBIĘ CSV
$query=mysqli_query($kon,"SELECT * FROM `ANALIZA-Monitoring Losów Absolwentów` WHERE 1");
             
$nagl=mysqli_query($kon,"DESCRIBE `ANALIZA-Monitoring Losów Absolwentów`");
$ile_nagl=mysqli_num_rows($nagl);
$u=0;
   do {
            $naglowek=mysqli_fetch_array($nagl);
                        $csvhead[]="\"$naglowek[Field]\"";
            $u=$u+1;
        }
        while($u<$ile_nagl);
        $csvfirstrow=implode(";",$csvhead);
        ?>
  
      <?php
        do {
            $wiersz=mysqli_fetch_array($query);
            $n=$n+1;
        
            $j=0;
                        do {
                     
                            $csvrow[]="\"$wiersz[$j]\"";
                            $j=$j+1;
                             
                        }
                        while($j<$ile_naglowkow);
                    
                        $csvrows[]=implode(";",$csvrow);
                        unset($csvrow);
        }
      while($n<$ile);
      $csvrestrows=implode("\n",$csvrows);
      $csvcomplete="$csvfirstrow \n $csvrestrows";
    //$csv=fopen('/var/www/html/naklad_pracy/MP/csv/export.csv',w);
    file_put_contents('/var/www/html/Analytics/exports/csv/export.csv', $csvcomplete);
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
            <span>ANALIZA ANKIETY</span>
          </h4>

          

        </div>

      </div>
              <div class="row wow fadeIn">

        <!--Grid column-->
        <div class="col-md-12 mb-4">

          <!--Card-->
          
     <div class="card" >
         <div id="editor"></div>    
         <div class="card-header text-center">Monitoring Losów Absolwentów <?php echo "$wydzial_nazwa $kierunek_nazwa";?>
             <!--<span class="tmi"><i class="fas fa-file-pdf prefix fa-lg orange-text" onclick="generatePDF();" ></i> </span>  -->
            <br/>Wypełniono <?php echo $ile;?> ankiet</div>
            <nav class="navbar navbar-expand-lg navbar-light white scrolling-navbar">
        <div class="container-fluid">
        <ul class="navbar-nav nav-flex-icons">
           
         <li class="nav-item d-flex indigo-text" style="font-size:1em; ">
             <a href="exports/csv/export.csv" >
         <span class="tmi" style="padding-left:0.9rem;" title="pobierz csv">
             <i class="fas fa-file-csv prefix fa-lg info-text" ></i></span></a></li>
             <li class="nav-item d-flex indigo-text" style="font-size:1em; ">
               
             <a href="#" data-toggle="modal" data-target="#solver">
         <span class="tmi" style="padding-left:0.7rem;" title="szukaj korelacji">
             <i class="fas fa-random prefix fa-lg red-text" ></i></span></a></li>
           
            <li class="nav-item d-flex indigo-text" style="font-size:1em; ">
                 
             <a href="view/ankiety_html/mla/" target="_blank">
         <span class="tmi" style="padding-left:0.55rem;" title="Obejrzyj ankietę">
             <i class="far fa-eye prefix fa-lg blue-text" ></i></span></a></li>
                <li class="nav-item d-flex indigo-text" style="font-size:1em; ">
             
             <a href="#" data-toggle="modal" data-target="#sz">
         <span class="tmi" style="padding-left:0.7rem;" title="Obejrzyj sugestie zmian w programie kształcenia">
             <i class="fas fa-bullhorn prefix fa-lg amber-text" ></i></span></a></li>
             <li class="nav-item d-flex indigo-text" style="font-size:1em; ">
          <a href="main.php?mode=deanreport6">   
         <span class="tmi" style="padding-left:0.65rem;" title="powrót">
             <i class="fas fa-reply prefix fa-lg purple-text" ></i></span></a></li>
             
        </ul><form method="POST" action="main.php?mode=deanreport15" class="form-inline">
          <input type="hidden" name="analiza" value="ankieta"/><select class="mdb-select md-form" name="k">
  <option value="" disabled selected>Wybierz kierunek studiów</option>
  <option value="1">Architektura</option>
  <option value="2">Architektura Wnętrz</option>
  <option value="3">Architektura Krajobrazu</option>
  <option value="4">Wzornictwo</option>
  <option value="5">Budownictwo</option>
  <option value="6">Zarządzanie</option>
  <option value="7">Zarządzanie i Inżynieria Produkcji</option>
  <option value="8">Ochrona Środowiska</option>
  <option value="9">Mechanika i Budowa Maszyn</option>
  <option value="10">Zdrowie Publiczne</option>
  <option value="11">Informatyka</option>
        </select><button class="btn btn-success" type="submit">Pokaż</button> <a class="button btn btn-info" onclick="udostepnijAnkiete();">Udostępnij analizę</a>  
        </form> </div></nav>
      <!--<button onclick="generatePDF();">PDF</button>    -->
<div class="card-body" id="k2pdf"><!-- form cut -->
   <!-- <h5>Wypełniono <?php echo $ile;?> ankiet</h5>-->
    <!--<a href="exports/csv/export.csv"><button type="button" class="btn btn-primary">Pobierz plik CSV</button></a>-->
    <!--<button type="button" class="btn btn-info" data-toggle="modal" data-target="#solver">Szukaj korelacji</button>-->
   <!-- <a class="button btn btn-unique" href="main.php?mode=deanreport6">Powrót</a>-->
    <!--<a class="button btn btn-dark" href="view/ankiety_html/mla/" target="_blank">Obejrzyj ankietę</a>-->
    
       
       
    <?php foreach($naglowki as $pyt){
        switch($pyt['pytanie']){
         default:
        ?>
    <div class="row">
        <div class="col-md-3">
            <?php echo "<span class=\"grey-text\">".$pyt['pytanie'] . ".</span> ".$pyt['tresc'];
            ?><hr/>
            <ol type="a" style="font-size:0.8em; margin-left:10%;">
            <?php
            $warianty=mysqli_query($kon,"SELECT DISTINCT `$pyt[pytanie]_` FROM `ankieta` WHERE `$pyt[pytanie]_`<>''  ORDER BY `$pyt[pytanie]_` ASC ");
            foreach($warianty as $wariant){
                $war_=$wariant["$pyt[pytanie]_"];
                $war= konwersja_znakow($wariant["$pyt[pytanie]_"]);
                echo "<li>".$war." ";
              //teraz badam udział wariantu we
                //wszystkich ankietach
                //ankietach 3 letnich
                //ankietach 5 letnich
                $war_wszystkie=mysqli_num_rows(mysqli_query($kon,"SELECT `id` FROM `ankieta` "
                        . "WHERE `$pyt[pytanie]_`='$war_' AND $querystring"));
                
                $war_wszystkie_procentowo=round(($war_wszystkie/$ile)*100,2);
                $war_5lat=mysqli_num_rows(mysqli_query($kon,"SELECT `id` FROM `ankieta` "
                        . "WHERE `$pyt[pytanie]_`='$war_' AND `5_lat`=1 AND $querystring"));
                $war_3lata=mysqli_num_rows(mysqli_query($kon,"SELECT `id` FROM `ankieta` "
                        . "WHERE `$pyt[pytanie]_`='$war_' AND `3_lata`=1 AND $querystring"));
                $war5procentowo=round(($war_5lat/$ile5lat)*100,2);
                $war3procentowo=round(($war_3lata/$ile3lata)*100,2);
               // echo " wszystkie: $war_wszystkie_procentowo % 3 lata: $war3procentowo % 5 lat: $war5procentowo %";
                echo "</li>";
                $labels[]=$war;
                $valuesall[]=$war_wszystkie_procentowo;
                $values_3[]=$war3procentowo;
                $values_5[]=$war5procentowo;
            }
            $labelsstr=implode("\",\"",$labels);
            $lstring="\"$labelsstr\"";
            $valstring=implode(",",$valuesall);
            $val3string=implode(",",$values_3);
            $val5string=implode(",",$values_5);
                $scripts[]="var ctxP = document.getElementById(\"$pyt[pytanie]-all\").getContext('2d');
var myPieChart = new Chart(ctxP, {
    type: 'pie',
    data: {
        labels: [$lstring],
        datasets: [
            {
                data: [$valstring],
                backgroundColor: [\"#F7464A\", \"#46BFBD\", \"#FDB45C\", \"#949FB1\", \"#4D5360\", \"#60534D\", \"#ABCDEF\", \"#2ABBCC\"],
                hoverBackgroundColor: [\"#FF5A5E\", \"#5AD3D1\", \"#FFC870\", \"#A8B3C5\", \"#616774\", \"#FFC870\", \"#A8B3C5\", \"#2A6774\"]
            }
        ]
    },
    options: {
        responsive: true
    }    
});";
 $scripts[]="var ctxP = document.getElementById(\"$pyt[pytanie]-3\").getContext('2d');
var myPieChart = new Chart(ctxP, {
    type: 'pie',
    data: {
        labels: [$lstring],
        datasets: [
            {
                data: [$val3string],
                backgroundColor: [\"#F7464A\", \"#46BFBD\", \"#FDB45C\", \"#949FB1\", \"#4D5360\", \"#60534D\", \"#ABCDEF\", \"#2ABBCC\"],
                hoverBackgroundColor: [\"#FF5A5E\", \"#5AD3D1\", \"#FFC870\", \"#A8B3C5\", \"#616774\", \"#FFC870\", \"#A8B3C5\", \"#2A6774\"]
            }
        ]
    },
    options: {
        responsive: true
    }    
});";  
 $scripts[]="var ctxP = document.getElementById(\"$pyt[pytanie]-5\").getContext('2d');
var myPieChart = new Chart(ctxP, {
    type: 'pie',
    data: {
        labels: [$lstring],
        datasets: [
            {
                data: [$val5string],
                backgroundColor: [\"#F7464A\", \"#46BFBD\", \"#FDB45C\", \"#949FB1\", \"#4D5360\", \"#60534D\", \"#ABCDEF\", \"#2ABBCC\"],
                hoverBackgroundColor: [\"#FF5A5E\", \"#5AD3D1\", \"#FFC870\", \"#A8B3C5\", \"#616774\", \"#FFC870\", \"#A8B3C5\", \"#2A6774\"]
            }
        ]
    },
    options: {
        responsive: true
    }    
});";               
                ?>
            </ol>
        </div>
        <div class="col-md-9"><hr/>
            
            <div class="card card-body"><h4 class="card-title">Wszystkie ankiety:</h4>
                <canvas id="<?php echo "$pyt[pytanie]-all";?>"></canvas>
                <table class="table table-responsive-sm table-sm table-striped">
                    <thead><tr>
                        <?php foreach($labels as $labelka){
                            echo "<th>$labelka</th>";
                            }?></tr>
                    </thead>
                            <tbody><tr>
                        <?php foreach ($valuesall as $value){
                            echo "<td>$value %</td>";
                        }?>
                        </tr></tbody></tbody>
                </table>
            
            </div>
        <div class="card card-body"><h4 class="card-title">Ankiety wysłane 3 lata po obronie:</h4>
            <canvas id="<?php echo "$pyt[pytanie]-3";?>"></canvas>
        <table class="table table-responsive-sm table-sm table-striped">
                    <thead><tr>
                        <?php foreach($labels as $labelka){
                            echo "<th>$labelka</th>";
                            }?></tr>
                    </thead>
                            <tbody><tr>
                        <?php foreach ($values_3 as $value){
                            echo "<td>$value %</td>";
                        }?>
                        </tr></tbody></tbody>
                </table>
        </div>
        <div class="card card-body"><h4 class="card-title">Ankiety wysłane 5 lat po obronie:</h4>
            <canvas id="<?php echo "$pyt[pytanie]-5";?>"></canvas>
        <table class="table table-responsive-sm table-sm table-striped">
                    <thead><tr>
                        <?php foreach($labels as $labelka){
                            echo "<th>$labelka</th>";
                            }?></tr>
                    </thead>
                            <tbody><tr>
                        <?php foreach ($values_5 as $value){
                            echo "<td>$value %</td>";
                        }?>
                        </tr></tbody></tbody>
                </table>
        </div></div>
    </div><span class="html2pdf__page-break"></span>
    <?php
    
    break;
    case "PYT_1":
    case "PYT_2": 
        case "PYT_4":
            case "PYT_3":
                case "PYT_5":
                    break;
    }
    unset ($labels);
    unset ($valuesall);
    unset ($values_3);
    unset ($values_5);
            }
    ?>
       </div>
              

         
     </div>
          <!--/.Card-->

        </div>
        <!--Grid column-->

        <!--Grid column-->
        
        <!--Grid column-->

      </div>
        </div></div>
        
      

   
 
 <?php include('view/ocenydyplom_Modal.php');?>
      <?php include('view/footer.php');
     // foreach ($scripts as $script){
    // echo $script;
 //}?>
 <div class="modal fade top" id="solver" tabindex="-1" role="dialog" aria-labelledby="mySolverLabel"
  aria-hidden="true" data-backdrop="true">
  <div class="modal-dialog modal-frame modal-top modal-notify modal-info" role="document">
    <!--Content-->
    <div class="modal-content">
      <!--Body-->
      <div class="modal-body">
        <div class="row d-flex justify-content-center align-items-center">

          <p class="pt-3 pr-2">Wybierz element do znalezienia korelacji</p>
          <?php $roka=substr($_POST['analiza'],-5);?>
          <form method="post" action="main.php?mode=solver3">
            <input type="hidden" value="ankieta" name="ankieta"> 
           
    
              <select name="element"class="mdb-select md-form">
  <option value="" disabled selected>Wybierz badany parametr</option>
  <?php $metryki=mysqli_query($kon,"SELECT * FROM `metryki` WHERE `ankieta`='ankieta'");
            $halmacz=mysqli_num_rows($metryki);
                $counter=0;
                do {
                    $metryka=mysqli_fetch_array($metryki);
                    $counter=$counter+1;
                    echo "<option value=\"$metryka[0]\">$metryka[2] $metryka[3]</option>";
                }
                while ($counter<$halmacz);
                
                ?>
  
</select>
      <hr/>
   
          <button type="submit" class="btn btn-primary">Dalej <i class="fas fa-book ml-1"></i></button>
          <a type="button" class="btn btn-outline-primary waves-effect" data-dismiss="modal">Anuluj</a></form>
        </div>
      </div>
    </div>
    <!--/.Content-->
  </div>
</div>   
  
 <div class="modal fade top" id="sz" tabindex="-1" role="dialog" aria-labelledby="szLabel"
  aria-hidden="true" data-backdrop="true">
  <div class="modal-dialog modal-frame modal-top modal-notify modal-info" role="document">
    <!--Content-->
    <div class="modal-content">
      <!--Body-->
      <div class="modal-body">
       
            
            <?php 
            $szquery="SELECT `rok_ukonczenia`,`rodzaj_studiow`,`kierunek_studiow`,`specjalnosc`,`typ_studiow`,
                `pyt_32_` FROM `ankieta` WHERE `pyt_32_`<>''";
            $sz=mysqli_query($kon,$szquery);
                    
          ?>
   <table id="dtMaterialDesignExample" class="table table-striped table-condensed" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th class="th-sm">Nazwa kierunku      </th>
      <th class="th-sm">Stopień studiów      </th>
      <th class="th-sm">Forma studiów      </th>
       <th class="th-sm">Rok obrony      </th>
      <th class="th-sm">Sugestie zmian w programe kztałcenia</th>
    </tr>
  </thead>
  <tbody>
   <?php
        foreach($sz as $s){
            echo "<tr><td>".konwersja_znakow($s['kierunek_studiow'])."</td><td>".konwersja_znakow($s['rodzaj_studiow']).""
                    . "</td><td>".konwersja_znakow($s['typ_studiow'])."</td>"
                    . "<td>$s[rok_ukonczenia]</td><td>".konwersja_znakow($s['pyt_32_'])."</td></tr>";
        }
?>   
  </tbody>
   </table>    
         
        <a type="button" class="btn btn-outline-primary waves-effect" data-dismiss="modal">Zamknij</a> 
      </div>
    </div>
    <!--/.Content-->
  </div>
</div>  
  
 

<script type="text/javascript">
window.onload = function () {
	var chart = new CanvasJS.Chart("chartContainer2",
	{
            exportEnabled: true,
  zoomEnabled: true,
  toolbar: {
    itemBackgroundColor: "white", //Change it to "red"
    itemBackgroundColorOnHover: "#3e3e3e",
    fontColor: "black",
    fontColorOnHover: "white",
    buttonBorderColor: "#3e3e3e"
  },
		colorSet: "colorSet2",
		title:{
			    fontWeight: "bolder",
        fontColor: "#008B8B",
        fontFamily: "tahoma",        
        fontSize: 25,
        padding: 10,       
       			text: "Czy zamierzasz w przyszłości przyjmować kolejne dawki szczepionki przeciw Sars-CoV-2, jeśli takie będą zalecenia medyczne?" 
		},
                animationEnabled: true,
               
		legend:{
			verticalAlign: "bottom",
			horizontalAlign: "center"
		},
		data: [
		{        
			indexLabelFontSize: 13,
			indexLabelFontFamily: "Monospace",       
			indexLabelFontColor: "darkgrey", 
			indexLabelLineColor: "darkgrey",        
			indexLabelPlacement: "outside",
			type: "pie",       
			showInLegend: true,
			toolTipContent: "{y} - <strong>#percent%</strong>",
			dataPoints: [
			
{  y: <?php echo $PYT2_ilosc_TAK;?>exploded: true, legendText:"TAK", indexLabel: "TAK" },
{  y: <?php echo $PYT2_ilosc_NIE;?>exploded: true, legendText:"NIE", indexLabel: "NIE" },
{  y: <?php echo $PYT2_ilosc_NIEWIEM;?>exploded: true, legendText:"Nie wiem", indexLabel: "Nie wiem" },
					
			]
		}
		]
	});
	chart.render();
        	var chart = new CanvasJS.Chart("chartContainer",
	{
            exportEnabled: true,
  zoomEnabled: true,
  toolbar: {
    itemBackgroundColor: "white", //Change it to "red"
    itemBackgroundColorOnHover: "#3e3e3e",
    fontColor: "black",
    fontColorOnHover: "white",
    buttonBorderColor: "#3e3e3e"
  },
		colorSet: "colorSet2",
		title:{
			    fontWeight: "bolder",
        fontColor: "#008B8B",
        fontFamily: "tahoma",        
        fontSize: 25,
        padding: 10,       
       			text: "Czy poddałaś/poddałeś/ się szczepieniu przeciw Sars-CoV-2?" 
		},
                animationEnabled: true,
               
		legend:{
			verticalAlign: "bottom",
			horizontalAlign: "center"
		},
		data: [
		{        
			indexLabelFontSize: 13,
			indexLabelFontFamily: "Monospace",       
			indexLabelFontColor: "darkgrey", 
			indexLabelLineColor: "darkgrey",        
			indexLabelPlacement: "outside",
			type: "pie",       
			showInLegend: true,
			toolTipContent: "{y} - <strong>#percent%</strong>",
			dataPoints: [
			
{  y: <?php echo $PYT1_ilosc_TAK;?>,exploded: true, legendText:"TAK", indexLabel: "TAK" },
{  y: <?php echo $PYT1_ilosc_NIE;?>,exploded: true, legendText:"NIE", indexLabel: "NIE" },
{  y: <?php echo $PYT1_iloscPDAWKA;?>,exploded: true, legendText:"Przyjąłem 1 dawkę", indexLabel: "Przyjąłem 1 dawkę" },
					
			]
		}
		]
	});
	chart.render();
}
</script>

<script id="skrypty">

    
     <?php foreach ($scripts as $script){
         echo $script;
         echo "\n";
     }
     ?>
     </script>
     <script>
        function udostepnijAnkiete(){
        const hatemenel=document.getElementById('k2pdf').innerHTML;
        const javascript=document.getElementById('skrypty').innerHTML;
        console.log(hatemenel);
          $.ajax({
			url: 'controller/zapisz_ankiete.php',
			type: 'post',
			data: {request: 'zapiszA',hatemenel: hatemenel, javascript: javascript, kierunek: '<?php echo $kierunek_nazwa;?>'},
			dataType: 'json',
			success: function(response){
                       // console.log(response.comment);
                        if(response.status==1){
                            
                        toastr.info("Link: "+response.link+" skopiowany","Pomyślnie zapisano ankietę do widoku.<hr/>",{"closeButton": true,"showDuration": "500","hideDuration": "5000","onclick": null,"progressBar": true});
                        navigator.clipboard.writeText(response.link);

                        }
              }
          });
    }
    </script>
</body>

</html>

