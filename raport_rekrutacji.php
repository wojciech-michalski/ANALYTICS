<?php
include('controller/konekt_GURU.php');
include('controller/konekt_MySQL.php');


require('controller/raprekrutacji.php');

?>
<body>
  <!-- Main navigation -->
  <header>
    <!--Navbar-->
 <?php include('view/mainmenu.php');?>
    <!-- Full Page Intro -->
    <div class="view" style="background-image: url('view/img/wseiz_background.jpg'); background-repeat: no-repeat; background-size: cover; background-position: center center;">
      <!-- Mask & flexbox options-->
      <div class="mask rgba-gradient d-flex justify-content-center align-items-center">
        <!-- Content -->
        <div class="container" style="max-width:1900px !important;">
          <!--Grid row-->
          <div class="row">
            <!--Grid column-->
            <div class="col-md-12 gray-text text-center text-md-left mt-xl-5 mb-5 wow fadeInLeft" data-wow-delay="0.3s">
    <?php 
  //print_r($odsiewarray);?>
 
                
                <div class="card"style="overflow: scroll; height:600px; margin-top:4%;" >
    <div class="card-body">
        <h5 style="color:gray;">Zestawienie rekrutacji <?php echo "$ra dla: $kierunek_studiow $rodzaj_studiow $typ_studiow";?></h5>
        
       <table id="dtMaterialDesignExample" class="table table-striped table-condensed" cellspacing="0" width="100%">
  <thead>
    <tr>
     <?php
	$kolumny=array_keys($wyniki_zagregowane);
	foreach ($kolumny as &$naglowek) {
		$naglowek=explode (';',$naglowek);		
		echo "<th class=\"th-sm\"><span class=\"text-primary\">$naglowek[0]</span><br/><span class=\"text-warning\">$naglowek[1]</span><br/><span class=\"text-info\">$naglowek[2]</span></th>";
		
		}
		
	?>
	</tr></thead><tr>
	<?php
			foreach ($wyniki_zagregowane as &$ilosc) {
				echo "<td>$ilosc</td>";
				}
				?>
				</tr>
			<!---->
  </table>
        <table class="table table-striped" cellspacing="0" width="100%">
            <tr><td colspan="<?php echo $ile_zagregowanych;?>">SUMA: <?php echo array_sum($wyniki_zagregowane);?></td></tr>
        </table>
           
  <div id="chartContainer" class="img img-responsive" style="width: 100%; height:600px;"></div>
          
    
        
           </div></div>
            </div>
            <!--Grid column-->
            <!--Grid column-->
            <!--<div class="col-md-6 col-xl-5 mt-xl-5 wow fadeInRight" data-wow-delay="0.3s">
              <img src="view/img/admin-new.png" alt="" class="img-fluid">
            
            </div>-->
            <!--Grid column-->
          </div>
          <!--Grid row-->
        </div>
        <!-- Content -->
      </div>
      <!-- Mask & flexbox options-->
    </div>
    <!-- Full Page Intro -->
  </header>
  <script type="text/javascript">
window.onload = function () {
	var chart = new CanvasJS.Chart("chartContainer",
	{       exportEnabled: true,
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
       			<?php
			
			echo "text: \" Zestawienie rekrutacji od $data_start do $data_stop  \" \n";
			?>
		},
			axisX: {
				labelAngle: -90,
				labelFontSize: 10
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
			type: "column",
			dataPoints: [
			<?php
					// $ilosci - to wartości do wykresu
			// $kolumny_do_wykresu to kategorie
			$licznik_kawalkow=0;
				$kolumny=array_keys($wyniki_zagregowane);
		foreach ($wyniki_zagregowane as &$kawalki){
			$kolumna=$kolumny[$licznik_kawalkow];
			$kolumna=explode (';',$kolumna);		
						echo "{  y: $kawalki,exploded: true, label:\"$kolumna[0] $kolumna[1] $kolumna[2]\" },\n";
		$licznik_kawalkow=$licznik_kawalkow+1;
				}
			
			?>
					
			]
		}
		]
	});
	chart.render();
}
</script>
 <?php include('view/ocenydyplom_Modal.php');?>
  <?php include('view/footer.php');?>
  <script>
  $( document ).ready(function() {
    new WOW().init()
});
//$(document).ready(function() {
//    $('.mdb-select').materialSelect();
 // });
 $('.datepicker').pickadate({

min: new Date(2020,12,12),
max: new Date(2042,12,12),
labelMonthNext: 'Następny miesiąc',
labelMonthPrev: 'Poprzedni miesiąc',
labelMonthSelect: 'Wybierz miesiąc z listy',
labelYearSelect: 'Wybierz rok z listy',
selectMonths: true,
selectYears: 50,

// Escape any “rule” characters with an exclamation mark (!).
monthsFull: ['Styczeń', 'Luty', 'Marzec', 'Kwiecień', 'Maj', 'Czerwiec', 'Lipiec', 'Sierpień', 'Wrzesień', 'Październik',
'Listopad', 'Grudzień'],
monthsShort:['Sty', 'Lut', 'Mar', 'Kwi', 'Maj', 'Cze', 'Lip', 'Sie' , 'Wrz', 'Paź' , 'Lis' , 'Gru'],
format: 'yyyy-mm-dd',
firstDay: 1,
weekdaysShort: ['Nd', 'Pon', 'Wt', 'Śr', 'Czw', 'Pt', 'Sb'],
weekdaysFull: ['Niedziela', 'Poniedziałek', 'Wtorek', 'Środa', 'Czwartek', 'Piątek', 'Sobota'],
today: 'Dziś',
clear: 'wyczyść',
close: 'zamknij',
formatSubmit: 'yyyy-mm-dd'
 });
 
   
  </script>
</body>

</html>
