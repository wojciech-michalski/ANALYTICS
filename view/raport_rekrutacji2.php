  <?php 
  include('controller/konekt_GURU.php');
include('controller/konekt_MySQL.php');


require('controller/raprekrutacji.php');
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
            <span>RAPORT REKRUTACJI</span>
          </h4>

          

        </div>

      </div>
              <div class="row wow fadeIn">

        <!--Grid column-->
        <div class="col-md-12 mb-4">

          <!--Card-->
          
     <div class="card" >
<div class="card-header text-center">
         Zestawienie rekrutacji <i class="fas fa-file-pdf orange-text" onclick="generatePDF();" style="margin-left:20%"></i><?php //echo "$ra dla: $kierunek_studiow $rodzaj_studiow $typ_studiow";?>
            </div>
<div class="card-body" id="k2pdf">
<table id="dtMaterialDesignExample" class="table table-striped table-condensed table-responsive" cellspacing="0" width="100%">
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
        <table class="table table-striped table-condensed" cellspacing="0" >
            <tr><td colspan="<?php echo $ile_zagregowanych;?>">SUMA: <?php echo array_sum($wyniki_zagregowane);?></td></tr>
        </table>
           
  <div id="chartContainer" class="img img-responsive" style="width: 100%; height:600px;"></div>        
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
    <?php// include('view/filtr_Modal.php');?>
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
 
document.getElementsByClassName("loader")[0].style.display = "none";
  </script>
 
</body>

</html>