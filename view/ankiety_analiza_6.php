<?php
       include('view/topnav.php');
       $ankieta_array=explode("-",$_POST['analiza']);
       $ankieta_dirty=$ankieta_array[1];
       $ankieta_cleaner=explode("20",$ankieta_dirty);
       $ankieta_clean=$ankieta_cleaner[0];
    //  $warunki=implode("' OR `kierunek`='",$_POST['kierunki']);
     // $warunek="`kierunek`='$warunki' ";
   // echo "SELECT * FROM `$_POST[analiza]` WHERE $warunek";
       $query=mysqli_query($kon,"SELECT * FROM `$_POST[analiza]` WHERE 1");
       //$kierywidok=implode(" i ",$_POST['kierunki']);      
$ile=mysqli_num_rows($query);
$n=0;
$naglowki=mysqli_query($kon,"DESCRIBE `$_POST[analiza]`");
$ile_naglowkow=mysqli_num_rows($naglowki);
$k=0;
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
          
     <div class="card">
         
        <div class="card-header text-center"><?php echo $_POST['analiza'];?>
            <br/><?php
           
            ;?></div>
          
<div class="card-body">
    <h5>Wypełniono <?php echo $ile;?> ankiet</h5>
    <a href="exports/csv/export.csv"><button type="button" class="btn btn-primary">Pobierz plik CSV</button></a>
    <a class="button btn btn-unique" href="main.php?mode=deanreport6">Powrót</a>
 <?php
  do {
            $naglowek=mysqli_fetch_array($naglowki);
                        $csvhead[]="\"$naglowek[Field]\"";
            $k=$k+1;
        }
        while($k<$ile_naglowkow);
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
      ?>
 
    <?php 
    //print_r($csvhead);
    $csvcomplete="$csvfirstrow \n $csvrestrows";
    //$csv=fopen('/var/www/html/naklad_pracy/MP/csv/export.csv',w);
    file_put_contents('/var/www/html/Analytics/exports/csv/export.csv', $csvcomplete);
    $PYT1_ilosc_TAK=mysqli_num_rows(mysqli_query($kon,"SELECT `id` FROM `covid-19-2021` WHERE `PYT_1`='TAK'"));
    $PYT1_ilosc_NIE=mysqli_num_rows(mysqli_query($kon,"SELECT `id` FROM `covid-19-2021` WHERE `PYT_1`='NIE'"));
    $PYT1_iloscPDAWKA=mysqli_num_rows(mysqli_query($kon,"SELECT `id` FROM `covid-19-2021` WHERE `PYT_1`='przyjąłem 1 dawkę'"));
     $PYT2_ilosc_TAK=mysqli_num_rows(mysqli_query($kon,"SELECT `id` FROM `covid-19-2021` WHERE `PYT_2`='TAK'"));
    $PYT2_ilosc_NIE=mysqli_num_rows(mysqli_query($kon,"SELECT `id` FROM `covid-19-2021` WHERE `PYT_2`='NIE'"));
    $PYT2_ilosc_NIEWIEM=mysqli_num_rows(mysqli_query($kon,"SELECT `id` FROM `covid-19-2021` WHERE `PYT_2`='Nie wiem'"));

    
    ?><!--<h4 class="text-center">Czy poddałaś/poddałeś/ się szczepieniu przeciw Sars-CoV-2?</h4><hr/>-->
<div id="chartContainer" class="img img-responsive" style="width: 100%; height:450px;"></div>
<!--<h4 class="text-center">Czy zamierzasz w przyszłości przyjmować kolejne dawki szczepionki przeciw 
        Sars-CoV-2, jeśli takie będą zalecenia medyczne?</h4><hr/>-->
<div id="chartContainer2" class="img img-responsive" style="width: 100%; height:450px;"></div>
    <h4 class="text-center">Czy na Twoją decyzję o poddaniu się lub nie poddaniu się szczepieniu przeciw 
        Sars-CoV-2 miały istotny wpływ przede wszystkim (wybierz maksymalnie 3 najważniejsze dla Ciebie czynniki):</h4><hr/>
    <canvas id="PYT_3"></canvas>
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
      foreach ($scripts as $script){
     echo $script;
 }?>
  <script>
  $( document ).ready(function() {
    new WOW().init()
});
  </script>
  

  
 

<script type="text/javascript">
window.onload = function () {
    $(".loader").hide();
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
			
{  y: <?php echo $PYT2_ilosc_TAK;?>,exploded: true, legendText:"TAK", indexLabel: "TAK" },
{  y: <?php echo $PYT2_ilosc_NIE;?>,exploded: true, legendText:"NIE", indexLabel: "NIE" },
{  y: <?php echo $PYT2_ilosc_NIEWIEM;?>,exploded: true, legendText:"Nie wiem", indexLabel: "Nie wiem" },
					
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
 
</body>

</html>

